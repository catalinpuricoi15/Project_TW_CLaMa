<?php

use controllers\AssignmentController;
use controllers\AttendanceController;
use controllers\AuthController;
use controllers\ClassesController;
use controllers\ProfessorController;
use controllers\RequestController;
use controllers\SiteController;
use controllers\WorkController;
use core\Application;

require_once "./autoLoad.php";

$app = new Application(dirname(__DIR__));


/**GET*/
$app->router->get('/', [AuthController::class, 'redirect']);
$app->router->get('/logout', [AuthController::class, 'logout']);
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->get('/settings', [AuthController::class, 'settings']);
$app->router->get('/home', [SiteController::class, 'home']);
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->get('/assignment', [AssignmentController::class, 'assignment']);
$app->router->get('/attendance', [ProfessorController::class, 'attendance']);
$app->router->get('/catalog', [ProfessorController::class, 'catalog']);
$app->router->get('/requests', [ProfessorController::class, 'requests']);
$app->router->get('/classes', [ClassesController::class, 'index']);
$app->router->get('/editClass', [ClassesController::class, 'edit']);
$app->router->get('/newClass', [ClassesController::class, 'save']);
$app->router->get('/showCodAttendance', [AssignmentController::class, 'showCodAttendance']);

/**POST*/
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->post('/settings', [AuthController::class, 'updateAccountData']);
$app->router->post('/contact', [SiteController::class, 'contact']);
$app->router->post('/newClass', [ClassesController::class, 'store']);
$app->router->post('/newRequest', [RequestController::class, 'addRequest']);
$app->router->post('/newAssignment', [AssignmentController::class, 'store']);
$app->router->post('/newWork', [WorkController::class, 'store']);
$app->router->post('/addGrade', [WorkController::class, 'addGrade']);
$app->router->post('/createCodAttendance', [AssignmentController::class, 'createCodAttendance']);
$app->router->post('/confirmAttendance', [AttendanceController::class, 'confirmAttendance']);

/**REGEX*/
$app->router->regex('/class\/[0-9]+/', [ClassesController::class, 'show'], 'get');
$app->router->regex('/class\/request\/[0-9]+/', [RequestController::class, 'show'], 'get');
$app->router->regex('/changeNrOfAssignments\/[0-9]+/', [ClassesController::class, 'updateNrOfAssignments'], 'post');
$app->router->regex('/class\/catalog\/[0-9]+/', [ClassesController::class, 'catalog'], 'get');
$app->router->regex('/class\/request\/[0-9]+/', [RequestController::class, 'validateRequest'], 'post');
$app->router->regex('/class\/assignment\/[0-9]+/', [AssignmentController::class, 'show'], 'get');

$app->run();
