<?php

namespace NotesApp\App;

use DI;
use NotesApp\Middlewares\MiddlewareInterface;

class MiddlewareProvider
{

    protected $middlewarePath = 'NotesApp\Middlewares';
    protected $middlewares = [];

    public function goTroughMiddlewares()
    {
        foreach ($this->middlewares as $middleware) {
            /** @var MiddlewareInterface $middleware */
            return $middleware->check();
        }
    }

    public function setMiddleware(array $middlewares): bool
    {

        foreach ($middlewares as $middleware) {
            $class = $this->middlewarePath . '\\' . $middleware;

            /** @var DI\Container $container */
            $container = DIProvider::getContainer();
            $middleware = $container->get($class);
            /** @var MiddlewareInterface $middleware */

            if (false === $middleware instanceof MiddlewareInterface) {
                return false;
            }
            /** @var MiddlewareInterface $middleware */
            $this->addMiddleware($middleware);
            return true;
        }
    }

    protected function addMiddleware(MiddlewareInterface $middleware) :void
    {
        $this->middlewares[] = $middleware;
    }

}
