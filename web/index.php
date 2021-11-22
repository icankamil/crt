<?php

date_default_timezone_set("Asia/Jakarta");

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

$request = Request::createFromGlobals();
$routes = include __DIR__.'/../src/routes.php';

$context = new Routing\RequestContext();
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

$framework = new Core\Framework($matcher, $controllerResolver, $argumentResolver);

$response = $framework->handle($request);

$response->send();