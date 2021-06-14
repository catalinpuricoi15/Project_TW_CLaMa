<?php

use controllers\ProfessorController;
use core\Application;
use controllers\AuthController;
use controllers\SiteController;
require_once "./autoLoad.php";

$app = new Application(dirname(__DIR__));

$app->router->get('/logout', [AuthController::class, 'logout']);
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/settings', [AuthController::class, 'settings']);

$app->router->get('/home', [SiteController::class, 'home']);
$app->router->post('/contact', [SiteController::class, 'contact']);
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->get('/assignment', [ProfessorController::class, 'assignment']);
$app->router->get('/attendace', [ProfessorController::class, 'attendace']);
$app->router->get('/catalog', [ProfessorController::class, 'catalog']);
$app->router->get('/class', [ProfessorController::class, 'class']);
$app->router->get('/classes', [ProfessorController::class, 'classes']);
$app->router->get('/newClass', [ProfessorController::class, 'newClass']);
$app->router->get('/requests', [ProfessorController::class, 'requests']);

$app->run();
