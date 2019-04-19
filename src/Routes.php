<?php

namespace NotesApp;

class Routes
{
    public static function routes()
    {
        return [
            '/' => ['GET', 'HomeController@index', ['Guest']],
            '/login' => ['POST', 'AuthController@login', ['Guest']],
            '/register' => ['GET', 'UserController@register', ['Guest']],
            '/create-account' => ['POST', 'UserController@store', ['Guest']],
            '/logout' => ['GET', 'UserController@logout', ['Auth']],

            '/notes' => ['GET', 'NoteController@index', ['Auth']],
            '/notes/{id:\d+}' => ['GET', 'NoteController@show', ['Auth']],
            '/notes/edit/{id:\d+}' => ['GET', 'NoteController@edit', ['Auth']],
            '/notes/update/{id:\d+}' => ['POST', 'NoteController@update', ['Auth']],
            '/notes/create' => ['GET', 'NoteController@create', ['Auth']],
            '/notes/store' => ['POST', 'NoteController@store', ['Auth']],
            '/notes/delete/{id:\d+}' => ['GET', 'NoteController@delete', ['Auth']],

            '/upload' => ['GET', 'CSVController@upload', ['Auth']],
            '/parse' => ['POST', 'CSVController@parse', ['Auth']],
            '/chart' => ['GET', 'UserController@countryStatistic', ['Auth']],
        ];
    }
}

