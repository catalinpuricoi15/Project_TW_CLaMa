<?php

namespace controllers;

use core\Application;
use core\Controller;
use core\database\Database;
use core\exceptions\NotFoundException;
use core\middlewares\AuthMiddleware;
use core\Request;
use core\Response;
use models\Assignment;
use models\Catalog;
use models\ClassForm;
use models\User;

class ClassesController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware());
    }

    public function index()
    {
        if (!Application::$app->user->isStudent()) {
            $classes = ClassForm::find(['idUser' => Application::$app->user->id]);
            return $this->render('classes/index',
                compact('classes') // = ['classes' => $classes]
            );
        } else {
            $idClasses = Database::find('students_classes', ['idUser' => Application::$app->user->id
            ]);
            $classes = [];
            foreach ($idClasses as $item) {
                $classes[] = ClassForm::findOne(['id' => $item['idClass']]);
            }
            return $this->render('classes/index',
                compact('classes'));
        }
    }

    public function catalog(Request $request, Response $response)
    {
        $idClass = $request->getParamForRoute('/class/catalog/');
        $class = ClassForm::findOne(['id' => $idClass]);
        $assignments = $class->assignments();
        $catalog = new Catalog();
        $students = [];
        $idStudents = Database::find('students_classes', ['idClass' => $idClass]);

        foreach ($idStudents as $item){
            $students[] = User::findOne(['id' => $item['idUser']]);
        }

        $catalog->assignments = $assignments;
        $catalog->students = $students;

        return $this->render('catalog',['catalog' => $catalog]);
    }


    public function save()
    {
        $classForm = new ClassForm();
        return $this->render('classes/save',
            ['model' => $classForm]);
    }

    public function show(Request $request)
    {
        $idClass = $request->getParamForRoute('/class/');
        $class = ClassForm::findOne(['id' => $idClass]);
        $assignments = Assignment::find(['idClass' => $idClass]);
        return $this->render('classes/show', [
            'class' => $class,
            'model' => new Assignment(),
            'assignments' => $assignments
        ]);
    }

    public function edit()
    {
        return $this->render('classes/edit');
    }

    public function store(Request $request, Response $response)
    {
        $classForm = new ClassForm();
        $classForm->loadData($request->getBody());
        if ($classForm->validate()) {
            $randomString = substr(md5(rand()), 0, 6);
            $classForm->code = $randomString;
            $classForm->save();
            $response->redirect('/classes');
            return;
        }
        return $this->render('classes/save', [
            'model' => $classForm
        ]);
    }

    public function updateNrOfAssignments(Request $request, Response $response)
    {
        $idClass = $request->getParamForRoute('/changeNrOfAssignments/');
        $class = ClassForm::findOne(['id' => $idClass]);
        if ($class == false)
            throw new NotFoundException();
        $changeNrOfAssigments = $request->getBody()['numberOfAssignments'];
        $class->update(['numberOfAssignments' => $changeNrOfAssigments]);
        $response->redirect("/class/$idClass");
        return;
    }
}