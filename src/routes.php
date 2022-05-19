<?php

use App\Example\Controller\ExampleController;
use Core\RouteCollection;

$routes = new RouteCollection();

/* -------------------------------------------------------------------------- */
/*                        Route Application Start Here                        */
/* -------------------------------------------------------------------------- */


/* ---------------------------- Route With Prefix --------------------------- */
$routes->prefix('example', function ($routes) {
    $routes->push('example', '', [ExampleController::class, 'index']);
    $routes->push('example_create', '/create', [ExampleController::class, 'create']);
    $routes->push('example_store', '/store', [ExampleController::class, 'store']);
    $routes->push('example_edit', '/{id}/edit', [ExampleController::class, 'edit']);
    $routes->push('example_update', '/{id}/update', [ExampleController::class, 'update']);
    $routes->push('example_detail', '/{id}/detail', [ExampleController::class, 'detail']);
    $routes->push('example_delete', '/{id}/delete', [ExampleController::class, 'delete']);
});
/* -------------------------------------------------------------------------- */

/* -------------------------- Route Without Prefix -------------------------- */
$routes->push('example', '/example', [ExampleController::class, 'index']);
/* -------------------------------------------------------------------------- */

/* ------------------------------- Maintenance ------------------------------ */
$routes->push('maintenance', '/maintenance', [MaintenanceController::class, 'index']);
/* -------------------------------------------------------------------------- */


return $routes;
