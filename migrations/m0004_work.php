<?php

use core\Application;

class m0004_work

{
    public function up()
    {
        $database = Application::$app->database;
        $SQL = "CREATE TABLE work (
                id INT AUTO_INCREMENT PRIMARY KEY,
                idAssignment INT NOT NULL,
                idUser INT NOT NULL,
                url VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (idAssignment) references assignments(id) on delete CASCADE,
                FOREIGN KEY (idUser) references users(id) on delete CASCADE
                  )  ENGINE=INNODB;";
        $database->pdo->exec($SQL);
    }

    public function down(){
        $database = Application::$app->database;
        $SQL = "DROP TABLE work";
        $database->pdo->exec($SQL);
    }
}
