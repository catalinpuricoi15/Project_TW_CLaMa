<?php

use controllers\AssignmentController;
use controllers\ClassesController;
use controllers\ProfessorController;
use controllers\RequestController;
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
$app->router->get('/assignment', [AssignmentController::class, 'assignment']);
$app->router->get('/attendace', [ProfessorController::class, 'attendace']);
$app->router->get('/catalog', [ProfessorController::class, 'catalog']);
$app->router->get('/requests', [ProfessorController::class, 'requests']);
$app->router->get('/class', [ClassesController::class, 'show']);
$app->router->get('/classes', [ClassesController::class, 'index']);
$app->router->get('/editClass', [ClassesController::class, 'edit']);
$app->router->get('/newClass', [ClassesController::class, 'save']);
$app->router->post('/newRequest', [RequestController::class, 'addRequest']);
$app->router->post('/newClass', [ClassesController::class, 'store']);
$app->router->post('/newAssignment', [AssignmentController::class, 'store']);
$app->router->regex('/class\/[0-9]+/', [ClassesController::class, 'show'], 'get');
$app->router->regex('/class\/request\/[0-9]+/', [RequestController::class, 'show'], 'get');


$app->run();
