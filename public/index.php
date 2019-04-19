<?php
session_start();

use Middlewares\FastRoute;
use Middlewares\RequestHandler;
use Narrowspark\HttpEmitter\SapiEmitter;
use NotesApp\App\DIProvider;
use NotesApp\App\RoutesProvider;
use Relay\Relay;
use Zend\Diactoros\ServerRequestFactory;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$DIProvider = new DIProvider();
$container = $DIProvider::getContainer();

$routes = $container->get(RoutesProvider::class);
$routes = $routes->getDispatchedRoutes();

$middlewareQueue[] = new FastRoute($routes);
$middlewareQueue[] = new RequestHandler($container);

$requestHandler = new Relay($middlewareQueue);
$response = $requestHandler->handle(ServerRequestFactory::fromGlobals());

$emitter = new SapiEmitter();
return $emitter->emit($response);
