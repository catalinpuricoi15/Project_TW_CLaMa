<?php

namespace core\database;

use core\Application;
use core\Model;

abstract class DbModel extends Model
{
    abstract public function tableName(): string;

    abstract public function attributes(): array;

    abstract public static function primaryKey(): string;

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $statement = self::prepare("INSERT INTO $tableName(" . implode(',', $attributes) . ")
                     VALUES (" . implode(',', $params) . ")");

        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();
        return true;
    }

    public static function prepare($sql)
    {
        return Application::$app->database->pdo->prepare($sql);
    }

    public static function findOne($where)
    {
        $tableName = (new static)->tableName();
        $attributes = array_keys($where);
        $sql = implode("AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }

        $statement->execute();
        return $statement->fetchObject(static::class);

    }

    public static function find($where = [], $separator = "AND", $orderBy = "")
    {
        $tableName = (new static)->tableName();
        if ($where != []) {
            $attributes = array_keys($where);

            $parameters = implode(
                $separator,
                array_map(fn($attribute) => " $attribute  = :$attribute ", $attributes)
            );
            $sql = "SELECT * FROM $tableName WHERE $parameters;";
        }else{
            $sql = "SELECT * FROM $tableName";
        }

        if (!empty($orderBy)) {
            $sql = "SELECT * FROM $tableName WHERE $parameters ORDER BY $orderBy[0] $orderBy[1];";
        }

        $statement = self::prepare($sql);

        foreach ($where as $key => $value) {
            $statement->bindValue(":$key", $value);
        }
        try {
            $statement->execute();
            return $statement->fetchAll(\PDO::FETCH_CLASS, static::class);
        } catch (\PDOException $e) {
            die(var_dump($e->getMessage()));
        }
    }

    public function belongsTo($column, $class)
    {
        return $class::findOne([$class::primaryKey() => $this->{$column}]);
    }
}