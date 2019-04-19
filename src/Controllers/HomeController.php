<?php

namespace NotesApp\Controllers;

use NotesApp\App\Helpers\ResponseHelper;

class HomeController extends Controller  {

    public $response;

    public function index()
    {
        return ResponseHelper::view('login');
    }
}
