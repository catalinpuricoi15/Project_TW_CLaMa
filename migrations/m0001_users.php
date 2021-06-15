<?php

use core\Application;

class m0001_users
{
    public function up()
    {
        $database = Application::$app->database;
        $SQL = "CREATE TABLE users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(255) NOT NULL UNIQUE,
                email VARCHAR(255) NOT NULL UNIQUE,
                firstname VARCHAR(255) NOT NULL,
                lastname VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL,
                adresa VARCHAR(255),
                oras VARCHAR(255),
                type VARCHAR(20) NOT NULL,
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
