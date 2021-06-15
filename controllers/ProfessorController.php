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

    public function attendace()
    {
        return $this->render('profesori/attendace');
    }


    public function requests()
    {
        return $this->render('profesori/request');
    }
}