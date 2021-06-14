<?php

use core\Application;

class m0003_classes

{
    public function up()
    {
        $database = Application::$app->database;
        $SQL = "CREATE TABLE classes (
                id INT AUTO_INCREMENT PRIMARY KEY,
                idProfessor INT NOT NULL,
                subject VARCHAR(255) NOT NULL,
                numberOfNotes INT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (idProfessor) references professors(id) on delete CASCADE
                )  ENGINE=INNODB;";
        $database->pdo->exec($SQL);
    }

    public function down(){
        $database = Application::$app->database;
        $SQL = "DROP TABLE classes";
        $database->pdo->exec($SQL);
    }
}
