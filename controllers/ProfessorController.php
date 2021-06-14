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

    public function assignment()
    {
        return $this->render('profesori/assignment');
    }

    public function attendace()
    {
        return $this->render('profesori/attendace');
    }

    public function catalog()
    {
        return $this->render('profesori/catalog');
    }

    public function class()
    {
        return $this->render('profesori/class');
    }

    public function classes()
    {
        return $this->render('profesori/classes');
    }

    public function newClass()
    {
        return $this->render('profesori/newClass');
    }
    public function requests()
    {
        return $this->render('profesori/request');
    }
}