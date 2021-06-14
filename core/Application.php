<?php

namespace core;

use core\database\Database;
use core\database\DbModel;

class Application
{
    public static string $ROOT_DIR;

    public string $layout = 'main';
    public string $userClass;
    public Router $router;
    public Request $request;
    public Response $response;
    public static Application $app;
    public ?Controller $controller = null;
    public Database $database;
    public Config $config;
    public Session $session;
    public ?UserModel $user;
    public View $view;

    public function __construct($rootPath)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->controller = new Controller();
        $this->controller->setLayout("auth");
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);
        $this->config = new Config();
        $this->userClass = Application::$app->config->get('userClass');
        $this->database = new Database();
        $this->view = new View();


        $primaryValue = $this->session->get('user');
        if ($primaryValue) {
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        } else {
            $this->user = null;
        }
    }

    public function getController()
    {
        return $this->controller;
    }

    public function setController(Controller $controller)
    {
        $this->controller = $controller;
    }

    public function login(DbModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }

    public static function isGuest(){
        return !self::$app->user;
    }

//    public static function isProfesor(){
//        return !self::$app->type;
//    }

    public function run()
    {
        try {
            echo $this->router->resolve();
        }catch (\Exception $e){
            echo $this->view->renderView('_error', [
                'exception' => $e
            ]);
        }
    }
}