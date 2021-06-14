<?php

namespace core;

use models\User;

class Config{
    protected $config = [
        'userClass' => User::class,
        'database' => [
            'DB_NAME' => 'classhub',
            'DB_USER' => 'root',
            'DB_PASS' => '',
            'DB_CONNECTION' => 'mysql:host=127.0.0.1',
            'DB_OPTIONS' => [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            ]
        ]
    ];

    public function get($key){
        return $this->config[$key];
    }

    public function set($key, $value){
        $this->config[$key] = $value;
        return $this;
    }

}