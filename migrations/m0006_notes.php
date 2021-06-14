<?php

use core\Application;

class m0006_notes

{
    public function up()
    {
        $database = Application::$app->database;
        $SQL = "CREATE TABLE notes (
                id INT AUTO_INCREMENT PRIMARY KEY,
                idWork INT NOT NULL,
                idStudent INT NOT NULL,
                value DOUBLE NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (idWork) references work(id) on delete CASCADE,
                FOREIGN KEY (idStudent) references students(id) on delete CASCADE
                  )  ENGINE=INNODB;";
        $database->pdo->exec($SQL);
    }

    public function down(){
        $database = Application::$app->database;
        $SQL = "DROP TABLE notes";
        $database->pdo->exec($SQL);
    }
}
