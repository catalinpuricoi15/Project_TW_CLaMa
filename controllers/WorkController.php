<?php


namespace controllers;


use core\Application;
use core\Controller;
use core\FileManager;
use core\middlewares\AuthMiddleware;
use core\Request;
use core\Response;
use models\Assignment;
use models\ClassForm;
use models\Work;

class WorkController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware());
    }

    public function store(Request $request, Response $response){

        $work = new Work();
        $work->loadData($request->getBody());
        $idAssignment = $work->idAssignment;
        $fileName = Application::$app->user->getDisplayUsername() . "_" . $idAssignment;
        $fileDestinationPath = "/storage/filesStudentsAssignments/$fileName";
        $work->file = FileManager::uploadFile('file', $fileDestinationPath);

        if ($work->validate()) {
            $work->save();
            $response->redirect("/class/assignment/$idAssignment");
            return;
        }

        $works = Work::find(['idAssignment' => $idAssignment]);
        $studentWork = Work::findOne(['idAssignment' => $idAssignment,
            'idUser' => Application::$app->user->id
        ]);
        $assignment = Assignment::findOne(['id' => $idAssignment]);

        return $this->render('assignment', [
            'works' => $works,
            'model' => $work,
            'assignment' =>  $assignment,
            'studentWork' => $studentWork
        ]);
    }

    public function addGrade(Request $request, Response $response){
        $body = $request->getBody();
        $work = Work::findOne(['id' => $body['idWork']]);
        $work->update(['grade' =>  $body['grade']]);
        $response->redirect("/class/assignment/$work->idAssignment");
    }
}