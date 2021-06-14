<?php

namespace controllers;
use core\Application;
use core\Controller;
use core\middlewares\AuthMiddleware;
use core\Request;
use core\Response;
use models\ContactForm;

class SiteController extends Controller
{

    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware());
    }

    public function home()
    {
        $this->setLayout('main');
       return $this->render('home');
    }

    public function contact(Request $request, Response $response){
        $contact = new ContactForm();
        if($request->isPost()){
            $contact->loadData($request->getBody());
            if($contact->validate()
//                && $contact->send()
){
                Application::$app->session->setFlash('success', 'Multumim pentru cerere!');
                return $response->redirect('/contact');
            }
        }
        return $this->render('contact', [
            'model' => $contact
        ]);
    }

}