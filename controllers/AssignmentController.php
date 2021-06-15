<?php

namespace controllers;

use core\Controller;
use core\middlewares\AuthMiddleware;
use core\Model;
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

//    public function index()
//    {
//        $assignment = Assignment::find(['idClass' => ClassForm::class->]);
//        return $this->render('profesori/classes/index',
//            compact('classes')
//        );
//    }
    public function show(Request $request){
        $idClass = $request->getParamForRoute('/class/');
        $assignments = Model::find(['idClass' => $idClass]);
        return $this->render('profesori/show', [
            'assignments' => $assignments
        ]);
    }

    public function assignment()
    {
        return $this->render('profesori/assignment');
    }

    public function store(Request $request, Response $response){
        $assignment = new Assignment();
        $assignment->loadData($request->getBody());
        $idClass = $request->getBody()['idClass'];
        $classForm = ClassForm::findOne(['id' => $idClass]);

        if ($assignment->validate()) {
            $assignment->save();
            $classForm->update(['numberofAssignments' => $classForm->numberOfAssignments-1]);
            $response->redirect("/class/$idClass");
            return;
        }

        return $this->render('profesori/classes/show', [
            'class' => $classForm,
            'model' => $assignment
        ]);
    }

}