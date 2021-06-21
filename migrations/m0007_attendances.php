<?php

use core\Application;

class m0007_attendances

{
    public function up()
    {
        $database = Application::$app->database;
        $SQL = "CREATE TABLE attendances (
                id INT AUTO_INCREMENT PRIMARY KEY,
                idUser INT NOT NULL,
                idAssignment INT NOT NULL,
                FOREIGN KEY (idUser) references users(id) on delete CASCADE,
                FOREIGN KEY (idAssignment) references assignments(id) on delete CASCADE
                  )  ENGINE=INNODB;";
        $database->pdo->exec($SQL);
    }

    public function down(){
        $database = Application::$app->database;
        $SQL = "DROP TABLE attendances";
        $database->pdo->exec($SQL);
    }
}
