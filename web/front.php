<?php

require_once __DIR__.'/../vendor/autoload.php';

use App\Auth\Controller\AuthController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;

// $auth = new AuthController();

$request = Request::createFromGlobals();
$routes = include __DIR__.'/../src/routes.php';

$context = new Routing\RequestContext();
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

$framework = new Core\Framework($matcher, $controllerResolver, $argumentResolver);
$framework = new HttpKernel\HttpCache\HttpCache(
    $framework,
    new HttpKernel\HttpCache\Store(__DIR__.'/../cache')
);

$response = $framework->handle($request);

$response->send();

// ============== For installation only ============
// symlink("/home/sinovatif/public_html/goals/src/assets", "/home/sinovatif/public_html/goals/web/assets");
