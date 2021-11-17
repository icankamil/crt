<?php

use Symfony\Component\Routing;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\RedirectResponse;

$routes = new Routing\RouteCollection();
$app = new GlobalFunc;

// ROUTE APPLICATION START BELOW!!! 
// --------------------------------

$routes->add('welcome', new Route('/', [
    '_controller' => function (Request $request) {
        global $app;
        return $app->render_template('welcome');
    }
]));

// login admin

$routes->add('adminLogin', new Route('/admin', [
    '_controller' => 'App\Login\Controller\LoginController::index',
]));

$routes->add('adminLoginAction', new Route('/admin/login', [
    '_controller' => 'App\Login\Controller\LoginController::login',
]));

$routes->add('adminLogout', new Route('/admin/logout', [
    '_controller' => 'App\Login\Controller\LoginController::logout',
]));

// CRUD Minat
$routes->add('minat', new Route('/minat', [
    '_controller' => 'App\Minat\Controller\MinatController::index',
]));
$routes->add('minatCreate', new Route('/minat/create', [
    '_controller' => 'App\Minat\Controller\MinatController::create',
]));
$routes->add('minatStore', new Route('/minat/store', [
    '_controller' => 'App\Minat\Controller\MinatController::store',
]));
$routes->add('minatEdit', new Route('/minat/{id}/edit', [
    '_controller' => 'App\Minat\Controller\MinatController::edit',
]));
$routes->add('minatDetail', new Route('/minat/{id}', [
    '_controller' => 'App\Minat\Controller\MinatController::detail',
]));
$routes->add('minatUpdate', new Route('/minat/{id}/update', [
    '_controller' => 'App\Minat\Controller\MinatController::update',
]));
$routes->add('minatDelete', new Route('/minat/{id}/delete', [
    '_controller' => 'App\Minat\Controller\MinatController::delete',
]));
$routes->add('minatCancel', new Route('/minat/{id}/cancel', [
    '_controller' => 'App\Minat\Controller\MinatController::cancel',
]));


return $routes;
