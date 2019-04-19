<?php

namespace NotesApp\App\Helpers;

abstract class URLHelper
{
    public static function getCurrentURL()
    {
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        return $actual_link;
    }

    public static function getPath()
    {
        $link = parse_url(self::getCurrentURL());
        return $link['path'];
    }

    public static function getHostname()
    {
        $link = parse_url(self::getCurrentURL());
        return $link['hostname'];
    }

    public static function getPathParameters(): array
    {
        $link = parse_url(self::getCurrentURL());
        $pathParameters = explode('/', $link['path']);
        return $pathParameters;
    }
}
