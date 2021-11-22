<?php

use App\HomeController;
use App\Login\Controller\LoginController;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

/**
 * Route Application Start Here
 * 
 */

$routes->add('welcome', '/', [HomeController::class, 'index']);
$routes->add('admin_login', '/admin', [LoginController::class, 'index']);


return $routes;
