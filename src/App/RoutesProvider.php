<?php

namespace NotesApp\App;

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;
use NotesApp\Routes;

class RoutesProvider
{
    private $pathToControllers = 'NotesApp\Controllers';
    private $dispatchedRoutes;
    protected $middlewareProvider;

    public function __construct(MiddlewareProvider $middlewareProvider)
    {
        $this->middlewareProvider = $middlewareProvider;

        $this->dispatchedRoutes = simpleDispatcher(function (RouteCollector $r) {
            $this->explodeRoutes($r);
        });
    }

    private function explodeRoutes(RouteCollector $r)
    {
        $routes = $this->getRoutes();

        foreach ($routes as $key => $item) {
            $r->addRoute($item['http'], $key, function () use ($item) {

                if (true === isset($item['middleware'])) {
                    $next = $this->troughMiddleware($item['middleware']);
                    if (true !== $next) {
                        return $next;
                    }
                }

                $container = DIProvider::getContainer();
                $c = $container->get($item['controller']);
                $method = $item['method'];

                return $c->$method();
            });
        }
    }

    private function getRoutes()
    {
        $routes = Routes::routes();
        $controllerAndMethod = [];

        foreach ($routes as $path => $route) {
            $e = explode('@', $route[1]);
            $controllerAndMethod[$path] = [
                'http' => $route[0],
                'controller' => $this->pathToControllers . '\\' . $e[0],
                'method' => $e[1],
            ];
            if (sizeof($route) === 3) {
                $controllerAndMethod[$path]['middleware'] = $route[2];
            }
        }

        return $controllerAndMethod;
    }

    private function troughMiddleware(array $middlewares)
    {
        if (false === $this->middlewareProvider->setMiddleware($middlewares)) {
            return false;
        }
        return $this->middlewareProvider->goTroughMiddlewares();
    }

    public function getDispatchedRoutes()
    {
        return $this->dispatchedRoutes;
    }
}
