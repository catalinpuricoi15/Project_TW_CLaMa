<?php

namespace controllers;

use core\Controller;
use core\middlewares\AuthMiddleware;

class ProfessorController extends Controller
{

    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware());
    }

    public function attendance()
    {
        return $this->render('attendance');
    }

    public function requests()
    {
        return $this->render('request');
    }
}