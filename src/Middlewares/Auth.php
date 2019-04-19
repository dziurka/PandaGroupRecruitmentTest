<?php

namespace NotesApp\Middlewares;

use NotesApp\App\Helpers\ResponseHelper;
use NotesApp\App\Request;

class Auth extends Middleware implements MiddlewareInterface
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function check()
    {
        if (null === $this->request->user()) {
            if (isset($_SESSION) && isset($_SESSION['user'])) {
                unset($_SESSION['user']);
            }
            return ResponseHelper::redirect('','You must log in first');
        };

        return $this->next();
    }
}
