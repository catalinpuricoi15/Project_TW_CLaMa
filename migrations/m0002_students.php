<?php

use core\Application;

class m0002_students
{
    public function up()
    {
        $database = Application::$app->database;
        $SQL = "CREATE TABLE students (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(255) NOT NULL UNIQUE,
                email VARCHAR(255) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                firstname VARCHAR(255),
                lastname VARCHAR(255),
                year VARCHAR(20) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )  ENGINE=INNODB;";
        $database->pdo->exec($SQL);
    }

    public function down(){
        $database = Application::$app->database;
        $SQL = "DROP TABLE students";
        $database->pdo->exec($SQL);
    }
}
