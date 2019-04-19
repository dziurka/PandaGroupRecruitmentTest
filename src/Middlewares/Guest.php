<?php

namespace NotesApp\Middlewares;

use NotesApp\App\Helpers\ResponseHelper;
use NotesApp\App\Request;

class Guest extends Middleware implements MiddlewareInterface
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function check()
    {
        if (null !== $this->request->user()) {
            return ResponseHelper::redirect('notes');
        };

        return $this->next();
    }
}
