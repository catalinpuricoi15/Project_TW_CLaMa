<?php

use core\Application;

class m0004_assignments

{
    public function up()
    {
        $database = Application::$app->database;
        $SQL = "CREATE TABLE assignments (
                id INT AUTO_INCREMENT PRIMARY KEY,
                idClass INT NOT NULL,
                title VARCHAR(255) NOT NULL,
                requirement TEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                deadline DATE NOT NULL,
                FOREIGN KEY (idClass) references classes(id) on delete CASCADE
                )  ENGINE=INNODB;";
        $database->pdo->exec($SQL);
    }

    public function down(){
        $database = Application::$app->database;
        $SQL = "DROP TABLE assignments";
        $database->pdo->exec($SQL);
    }
}
