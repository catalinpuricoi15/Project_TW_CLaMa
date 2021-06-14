<?php

namespace controllers;

use core\Application;
use core\Controller;
use core\middlewares\AuthMiddleware;
use core\Response;
use models\ClassForm;
use models\Request as Model;
use core\Request;

class RequestController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware());
    }

    public function show(Request $request){
        $idClass = $request->getParamForRoute('/class/request/');
        $requests = Model::find(['idClass' => $idClass]);
        return $this->render('profesori/requests', [
            'requests' => $requests
        ]);
    }

    public function addRequest(Request $request, Response $response){
        $classRequest = new Model();
        $classRequest->loadData($request->getBody());
        $code = $request->getBody()['code'];
        if(Model::isValid($request->getBody()['code'])){
            $classRequest->idUser = Application::$app->user->id;
            $classRequest->idClass = ClassForm::findOne(['code' => $code])->idUser;
            $classRequest->save();
            Application::$app->session->setFlash('success', 'Cerere trimisa cu succes!!');
            $response->redirect("/classes");
            return;
        }

        return $response->redirect("/classes");

    }

}