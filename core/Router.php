<?php

namespace core;

use core\exceptions\NotFoundException;

class Router
{
    public Request $request;
    public Response $response;
    protected array $routes = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {

        $this->routes['post'][$path] = $callback;
    }

    public function regex($path, $callback, $method)
    {
        $this->routes['regex'][$method][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->match($path, $method);

        if ($callback === false) {
            $this->response->setStatusCode(404);
            throw new NotFoundException();
        }

        if (is_string($callback)) {
            return Application::$app->view->renderView($callback);
        }
        if(is_array($callback)){
            /** @var Controller $controller */
            $controller = new $callback[0]();
            Application::$app->controller = $controller;
            $controller->action = $callback[1];

            foreach ($controller->getMiddlewares() as $middleware){
                $middleware->execute();
            }

            $callback[0] = $controller;
        }
        return call_user_func($callback, $this->request, $this->response);
    }

    private function match(mixed $path, string $method)
    {

        $selectedRoute = $this->routes[$method][$path] ?? false;

        if($selectedRoute === false){
            foreach ($this->routes['regex'][$method] as $route => $callback){
                if(preg_match($route, $path)){
                    $selectedRoute = $callback;
                    break;
                }
            }
        }

        if($selectedRoute === false){
            throw new NotFoundException();
        }

        return $selectedRoute;
    }



}