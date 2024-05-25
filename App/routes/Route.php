<?php

use App\Controller\WelcomeController;
use System\Application;

/**
 * For Routing Application
 * 
 * $app = new Application();
 * @param Application $app
 */


$app->router->get('/', [WelcomeController::class, 'index']);
