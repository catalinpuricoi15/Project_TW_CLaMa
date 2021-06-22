<?php

namespace controllers;

use core\Application;
use core\Controller;
use core\Request;
use core\Response;
use models\LoginForm;
use models\Professor;
use models\Student;
use models\User;

class AuthController extends Controller
{
    public function redirect(Request $request, Response $response)
    {
        $response->redirect('/login');
    }

    public function login(Request $request, Response $response)
    {
        $loginForm = new LoginForm();
        if ($request->isPost()) {
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login()) {
                $response->redirect('/home');
                return;
            }
        }

        $this->setLayout('auth');
        return $this->render('auth', [
            'model' => $loginForm
        ]);
    }

    public function register(Request $request)
    {
        $this->setLayout('auth');
        $user = new User();
        if ($request->isPost()) {

            $user->loadData($request->getBody());

            if ($user->validate() && $user->save()) {

                Application::$app->session->setFlash('success', 'Inregistrare realizata cu succes!!');
                Application::$app->response->redirect('/login');
                exit;
            }

            return $this->render('auth', [
                'model' => $user
            ]);
        }

        return $this->render('auth', [
            'model' => $user
        ]);
    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/login');
    }

    public function settings()
    {
        return $this->render('settings');
    }

    public function updateAccountData(Request $request, Response $response)
    {
        $body = $request->getBody();
        foreach (array_keys($body) as $attribute) {
            Application::$app->user->{$attribute} = $body[$attribute];
        }
        Application::$app->user->update($body);
        $response->redirect("/home");
    }
}