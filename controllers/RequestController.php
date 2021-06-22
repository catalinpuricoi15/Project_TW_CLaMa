<?php

namespace controllers;

use core\Application;
use core\Controller;
use core\database\Database;
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

    public function show(Request $request)
    {
        $idClass = $request->getParamForRoute('/class/request/');
        $requests = Model::find(['idClass' => $idClass]);
        return $this->render('requests', [
            'requests' => $requests
        ]);
    }

    public function addRequest(Request $request, Response $response)
    {
        $classRequest = new Model();
        $classRequest->loadData($request->getBody());
        $code = $request->getBody()['code'];

        $verif_01 = Model::findOne(['idUser' => $request->getBody()['idUser'],
            'idClass' => ClassForm::findOne(['code' => $code])->id
        ]);

        $verif_02 = count(Database::find('students_classes', ['idUser' => Application::$app->user->id,
            'idClass' => ClassForm::findOne(['code' => $code])->id
        ])) == 0;

        if (!$verif_01 && $verif_02 && Model::isValid($request->getBody()['code'])) {
            $classRequest->idUser = Application::$app->user->id;
            $classRequest->idClass = ClassForm::findOne(['code' => $code])->id;
            $classRequest->save();
            Application::$app->session->setFlash('success', 'Cerere trimisa cu succes!!');
            $response->redirect("/classes");
            return;
        }

        return $response->redirect("/classes");

    }

    public function validateRequest(Request $request, Response $response)
    {

        header("Access-Control-Allow-Origin:*");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

        $id = $request->getParamForRoute('/class/request/');
        $classRequest = Model::findOne(['id' => $id]);
        $accepted = $request->getBody()['accepted'];
        if ($accepted == "true") {
            $classRequest->saveRelationship(['idUser' => $classRequest->idUser,
                'idClass' => $classRequest->idClass
            ], 'students_classes');
            $classRequest->delete();
            return json_encode('Student adaugat');
        } else {
            $classRequest->delete();
            return json_encode('Student sters');
        }

    }

}