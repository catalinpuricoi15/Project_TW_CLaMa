<?php

use core\Application;
require_once "./public/autoLoad.php";

$app = new Application(__DIR__);

$app->database->applyMigrations();
