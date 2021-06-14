<?php

namespace controllers;

use core\Controller;

class AssignmentController extends Controller
{
    public function assignment()
    {
        return $this->render('profesori/assignment');
    }

}