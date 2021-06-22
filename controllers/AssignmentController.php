<?php

namespace controllers;

use core\Application;
use core\Controller;
use core\FileManager;
use core\middlewares\AuthMiddleware;
use core\Model;
use core\Request;
use core\Response;
use models\Assignment;
use models\ClassForm;
use models\Work;

class AssignmentController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware());
    }

    public function show(Request $request){

        $idAssignment = $request->getParamForRoute('/class/assignment/');
        $works = Work::find(['idAssignment' => $idAssignment]);
        $studentWork = Work::findOne(['idAssignment' => $idAssignment,
        'idUser' => Application::$app->user->id
            ]);
        $assignment = Assignment::findOne(['id' => $idAssignment]);
        return $this->render('assignment', [
            'works' => $works,
            'model' => new Work(),
            'assignment' =>  $assignment,
            'studentWork' => $studentWork
        ]);
    }

    public function assignment()
    {
        return $this->render('assignment');
    }

    public function store(Request $request, Response $response){
        $assignment = new Assignment();
        $assignment->loadData($request->getBody());
        $idClass = $request->getBody()['idClass'];
        $classForm = ClassForm::findOne(['id' => $idClass]);

        if ($assignment->validate()) {
            if(array_key_exists('file', $_FILES) && $_FILES['file']['size'] != 0) {
                $fileName = Application::$app->user->getDisplayUsername() . "_" . date("Y-M-D");
                $fileDestinationPath = "/storage/filesProfessorsAssignments/$fileName";
                $assignment->file = FileManager::uploadFile('file', $fileDestinationPath);
            }
            $assignment->save();
            $classForm->update(['numberofAssignments' => $classForm->numberOfAssignments-1]);
            $response->redirect("/class/$idClass");
            return;
        }

        return $this->render('classes/show', [
            'class' => $classForm,
            'model' => $assignment
        ]);
    }

    public function createCodAttendance(Request $request, Response $response){
        $body = $request->getBody();
        $assignment = Assignment::findOne(['id' => $body['idAssignment']]);
        $assignment->update(['code_attendance' => (substr(md5(rand()), 0, 6)),
            'attendance_created_at' => date("y-m-d H:i:s")]);
        $response->redirect("/class/assignment/$assignment->id");
    }


}