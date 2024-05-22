<?php

namespace System;

use System\Session\Session;

class Application
{

    public  Router $router;
    public Request $request;
    public Response $response;
    public static Application $app;

    public static string $ROOT_DIR;


    public function __construct($rooteDir)
    {
        self::$ROOT_DIR = $rooteDir;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
    }

    public function run()
    {

        $this->router->resolve();
    }
}
