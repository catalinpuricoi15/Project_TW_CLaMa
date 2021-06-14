<?php

namespace controllers;

use core\Controller;
use core\middlewares\AuthMiddleware;
use core\Request;
use core\Response;
use models\Assignment;
use models\ClassForm;

class AssignmentController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware());
    }

    public function assignment()
    {
        return $this->render('profesori/assignment');
    }

    public function store(Request $request, Response $response){
        $assignment = new Assignment();
        $assignment->loadData($request->getBody());
        $idClass = $request->getBody()['idClass'];
        if ($assignment->validate()) {
            $assignment->save();
            $response->redirect("/class/$idClass");
            return;
        }

        $classForm = ClassForm::findOne(['id' => $idClass]);
        return $this->render('profesori/classes/show', [
            'class' => $classForm,
            'model' => $assignment
        ]);
    }

}