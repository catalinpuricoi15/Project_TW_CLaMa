<?php

namespace core\database;

use core\Application;
use core\Model;
use Exception;
use PDOException;
use ReflectionClass;

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
        $sql = implode(" AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
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
        } else {
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

    public function belongsToMany($class, $columnName = null, $orderBy = [])
    {
        try {
            $searchedClass = new ReflectionClass($class);
            $currentClassName = $columnName ?? (new ReflectionClass($this))->getShortName();
            $searchedTableName = $searchedClass->getMethod("tableName")->invoke(new $class());

            $sql = "SELECT * FROM $searchedTableName WHERE id$currentClassName=:$currentClassName";

            if (!empty($orderBy)) {
                $order = $orderBy[1] ?? '';
                $sql = $sql . " ORDER BY $orderBy[0] $order";
            }

            $statement = self::prepare($sql);
            $statement->bindValue(":$currentClassName", $this->id);

            $statement->execute();
            return $statement->fetchAll(\PDO::FETCH_CLASS, $class);

        } catch (Exception $e) {
            die(var_dump($e->getMessage()));
        }
    }

    public function delete(): bool
    {

        $tableName = $this->tableName();
        $sql = "DELETE FROM $tableName WHERE id=:id";
        $statement = self::prepare($sql);
        $statement->bindValue(":id", $this->id);

        try {
            $statement->execute();
            return true;
        } catch (Exception $e) {
            die(var_dump($e->getMessage()));
        }
    }


    public function update(array $data)
    {
        $tableName = $this->tableName();
        $colums = array_keys($data);

        $values = implode(",",
            array_map(fn($key) => " $key=:$key ", $colums)
        );


        $primaryKey = $this->primaryKey();
        $primaryKeyValue = $this->{$primaryKey};
        $sql = "UPDATE $tableName SET $values WHERE $primaryKey = $primaryKeyValue; ";

        $statement = self::prepare($sql);

        foreach ($data as $key => $value) {
            $statement->bindValue(":$key", $value);
        }

        try {
            $statement->execute();
            return true;
        } catch (Exception $e) {
            die(var_dump($e->getMessage()));
        }
    }

    public function saveRelationship(array $payload, string $tableName)
    {
        $attributes = array_keys($payload);
        $parameters = array_values($payload);
        $parameterizedAttributes = array_map(function ($param) {
            return ":{$param}";
        }, $attributes);;

        $sql = sprintf("insert into %s(%s) values(%s)",
            $tableName,
            implode(', ', $attributes),
            implode(',', $parameterizedAttributes)
        );

        $statement = self::prepare($sql);

        try {
            foreach ($attributes as $key => $attribute) {
                $statement->bindValue(":$attribute", $parameters[$key]);
            }

            $result = $statement->execute();

            return $result;
        } catch (PDOException $e) {
            die(var_dump($e->getMessage()));
        }
    }



}