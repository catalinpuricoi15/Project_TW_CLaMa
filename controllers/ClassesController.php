<?php

namespace controllers;

use core\Application;
use core\Controller;
use core\middlewares\AuthMiddleware;
use core\Request;
use core\Response;
use models\Assignment;
use models\ClassForm;

class ClassesController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware());
    }

    public function index()
    {
        $classes = ClassForm::find(['idUser' => Application::$app->user->id]);
        return $this->render('profesori/classes/index',
        compact('classes')
        );
    }

    public function save()
    {
        $classForm = new ClassForm();
        return $this->render('profesori/classes/save',
        ['model' =>  $classForm]);
    }

    public function show(Request $request)
    {
        $idClass = $request->getParamForRoute('/class/');
        $class = ClassForm::findOne(['id' => $idClass]);
        return $this->render('profesori/classes/show', [
            'class' => $class,
            'model' => new Assignment()
            ]);
    }

    public function edit()
    {
        return $this->render('profesori/classes/edit');
    }

    public function store(Request $request, Response $response){
        $classForm = new ClassForm();
        $classForm->loadData($request->getBody());
        if ($classForm->validate()) {
            $randomString = substr(md5(rand()), 0, 6);
            $classForm->code = $randomString;
            $classForm->save();
            $response->redirect('/classes');
            return;
        }
        return $this->render('profesori/classes/save', [
            'model' => $classForm
        ]);
    }
}