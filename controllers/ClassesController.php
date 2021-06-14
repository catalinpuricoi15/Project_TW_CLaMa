<?php

namespace controllers;

use core\Controller;

class ClassesController extends Controller
{
    public function index()
    {
        return $this->render('profesori/classes/index');
    }

    public function save()
    {
        return $this->render('profesori/classes/save');
    }

    public function show()
    {
        return $this->render('profesori/classes/show');
    }

    public function edit()
    {
        return $this->render('profesori/classes/edit');
    }
}