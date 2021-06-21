<?php

use core\Application;

class m0005_request

{
    public function up()
    {
        $database = Application::$app->database;
        $SQL = "CREATE TABLE requests (
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
        $SQL = "DROP TABLE requests";
        $database->pdo->exec($SQL);
    }
}
