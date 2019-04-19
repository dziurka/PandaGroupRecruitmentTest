<?php

namespace NotesApp\Views;

use NotesApp\App\Request;
use Zend\Diactoros\Response;

class View {

    protected $user;
    protected $response;
    protected $request;

    public function __construct(Request $request, Response $response)
    {
        $this->response = $response;
        $this->request = $request;
    }

    public function render(string $path = '', array $data = [])
    {
        if($path === null) {
            echo "<h1>404</h1>";
        } else {
            $data[] = $data;
            $data['isLogin'] = null !== $this->request->user();
            $data['user'] = $this->request->user();
            require_once dirname(__DIR__) . '/Views/html/'.$path.'.php';
        }

        $response = $this->response->withHeader('Content-Type', 'text/html');
        return $response;
    }
}
