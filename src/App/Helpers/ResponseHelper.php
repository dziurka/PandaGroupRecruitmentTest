<?php

namespace NotesApp\App\Helpers;

use NotesApp\App\DIProvider;
use NotesApp\Views\View;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response;

abstract class ResponseHelper
{
    public static function redirect(string $route, string $message = null) :ResponseInterface
    {
        if (true == $message) {
            Validation::setSessionMessage($message);
        }

        $res = new Response();
        $res= $res->withHeader('Location', '/' . $route)->withStatus(301);

        return $res;
    }

    public static function view(string $path, array $data = []) :ResponseInterface
    {
        $container = DIProvider::getContainer();
        $view = $container->get(View::class);

        return $view->render($path, $data);
    }
}
