<?php

namespace NotesApp\Middlewares;

abstract class Middleware {
    public function next()
    {
        return true;
    }
}
