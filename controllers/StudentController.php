<?php

namespace controllers;

use core\Controller;
use core\middlewares\AuthMiddleware;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware());
    }

}