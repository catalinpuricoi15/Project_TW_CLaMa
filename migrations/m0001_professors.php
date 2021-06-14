<?php

use core\Application;

class m0001_professors
{
    public function up()
    {
        $database = Application::$app->database;
        $SQL = "CREATE TABLE professors (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(255) NOT NULL UNIQUE,
                email VARCHAR(255) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                firstname VARCHAR(255),
                lastname VARCHAR(255),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )  ENGINE=INNODB;";
        $database->pdo->exec($SQL);
    }

    public function down(){
        $database = Application::$app->database;
        $SQL = "DROP TABLE professors";
        $database->pdo->exec($SQL);
    }
}
