<?php

use App\Controller\HomeController;
use System\Application;

/**
 * For Routing Application
 * 
 * $app = new Application();
 * @param Application $app
 */


$app->router->get('/', [HomeController::class, 'show']);
$app->router->post('/', [HomeController::class, 'index']);
