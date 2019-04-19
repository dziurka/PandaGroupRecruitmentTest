<?php

namespace NotesApp\App;

use DI\ContainerBuilder;
use NotesApp\Controllers\Controller;
use Zend\Diactoros\Response;
use DI;

class DIProvider
{
    private static $container;

    public function __construct()
    {
        $DIDefinitions = $this->getDefinitions();

        $containerBuilder = new ContainerBuilder();
        $containerBuilder->addDefinitions($DIDefinitions);

        $container = $containerBuilder->build();
        self::$container = $container;
    }

    private function getDefinitions()
    {
        $definitions = [
            Controller::class => DI\create(Controller::class)
                ->constructor(DI\get('View'), DI\get('Response')),
            'Response' => function () {
                return new Response();
            },
        ];

        return $definitions;
    }

    public static function getContainer()
    {
        return self::$container;
    }
}
