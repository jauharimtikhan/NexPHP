<?php

namespace System;



class Router
{
    protected array $routes = [];
    public Request $request;
    public Response $response;


    public function __construct(Request $request, Response $response)
    {
        $this->response = $response;
        $this->request = $request;
    }

    public function get($path,  $callback)
    {
        $this->addRoute('get', $path, $callback);
    }

    public function post($path,  $callback)
    {
        $this->addRoute('post', $path, $callback);
    }

    private function addRoute($method, $uri, $action)
    {

        $this->routes[] = ['method' => $method, 'uri' => $uri, 'action' => $action];
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        foreach ($this->routes as $route) {
            if ($route['method'] === $method) {
                if ($route['uri'] === $path) {
                    $this->callAction($route['action']);
                    return;
                } else {
                    $this->response->setStatusCode(404);
                }
            } else {
                $this->response->setStatusCode(405);
            }
        }
        $this->response->setStatusCode(404);
    }

    private function callAction($action)
    {
        if (!$action) {
            throw new \Exception("Action not found");
        }
        if (is_callable($action)) {
            return call_user_func($action);
        } elseif (is_array($action)) {
            $controllerName = $action[0];
            $controllerMethod = $action[1];

            if (class_exists($controllerName)) {
                $controller = new $controllerName();
                if (method_exists($controller, $controllerMethod)) {
                    return call_user_func([$controller, $controllerMethod]);
                } else {
                    throw new \Exception("{$controllerName}::{$controllerMethod} not found");
                }
            }
        }
    }
}
