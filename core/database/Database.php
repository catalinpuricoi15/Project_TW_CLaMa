<?php

namespace core\database;

use core\Application;

class Database
{

    public \PDO $pdo;

    public function __construct()
    {
        $config = Application::$app->config->get('database');
        $this->pdo = new \PDO($config['DB_CONNECTION'] . ";dbname={$config['DB_NAME']}", $config['DB_USER'], $config['DB_PASS'], $config['DB_OPTIONS']);
    }

    public function applyMigrations()
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $newMigrations = [];
        $files = scandir(Application::$ROOT_DIR . '/migrations');
        $toApplyMigrations = array_diff($files, $appliedMigrations);
        foreach ($toApplyMigrations as $migration) {
            if ($migration == '.' || $migration == '..') {
                continue;
            }

            require_once Application::$ROOT_DIR . '/migrations/' . $migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();
            $this->log("Applying migration $migration");
            $instance->up();
            $this->log("Applied migration $migration");
            $newMigrations[] = $migration;
        }
        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            $this->log("All migrations are applied");
        }
    }

    public function createMigrationsTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(256),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
        ) ENGINE  = INNODB;");
    }

    public function getAppliedMigrations()
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function saveMigrations(array $migrations)
    {
        $str = implode(",", array_map(fn($m) => "('$m')", $migrations));

        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUE $str  ");
        $statement->execute();
    }

    protected function log($message)
    {
        echo '[' . date('Y-m-d H:i:s') . '] - ' . $message . PHP_EOL;
    }

    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }

    private function removeMigrationRecord(string $migration)
    {
        $statement = $this->pdo->prepare("DELETE FROM migrations WHERE migration='{$migration}'");
        $statement->execute();
    }

    public function downMigrations()
    {
        $appliedMigrations = $this->getAppliedMigrations();

        for ($i = count($appliedMigrations) - 1; $i > 0; $i--) {
            $migration = $appliedMigrations[$i];
            require_once Application::$ROOT_DIR . "/migrations/$migration";
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();
            $this->log("Deleting migration $migration");
            $instance->down();
            $this->removeMigrationRecord($migration);
            $this->log("Migration $migration deleted");
        }
    }

    public static function find($tableName, $where = [], $separator = "AND", $orderBy = "")
    {
        if ($where != []) {
            $attributes = array_keys($where);

            $parameters = implode(
                $separator,
                array_map(fn($attribute) => " $attribute  = :$attribute ", $attributes)
            );
            $sql = "SELECT * FROM $tableName WHERE $parameters;";
        } else {
            $sql = "SELECT * FROM $tableName";
        }

        if (!empty($orderBy)) {
            $sql = "SELECT * FROM $tableName WHERE $parameters ORDER BY $orderBy[0] $orderBy[1];";
        }

        $statement = Application::$app->database->pdo->prepare($sql);

        foreach ($where as $key => $value) {
            $statement->bindValue(":$key", $value);
        }
        try {
            $statement->execute();
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            die(var_dump($e->getMessage()));
        }
    }
}
