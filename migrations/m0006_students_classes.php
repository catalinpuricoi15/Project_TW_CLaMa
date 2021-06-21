<?php

use core\Application;

class m0006_students_classes

{
    public function up()
    {
        $database = Application::$app->database;
        $SQL = "CREATE TABLE students_classes (
                id INT AUTO_INCREMENT PRIMARY KEY,
                idUser INT NOT NULL,
                idClass INT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (idUser) references users(id) on delete CASCADE,
                FOREIGN KEY (idClass) references classes(id) on delete CASCADE
                  )  ENGINE=INNODB;";
        $database->pdo->exec($SQL);
    }

    public function down(){
        $database = Application::$app->database;
        $SQL = "DROP TABLE students_classes";
        $database->pdo->exec($SQL);
    }
}
