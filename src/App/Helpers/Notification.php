<?php

namespace NotesApp\App\Helpers;

abstract class Notification
{
    public static function getSessionMessage(): string
    {
        if (true === self::isSessionMessage()) {
            $message = $_SESSION['message'];
            unset($_SESSION['message']);
            return $message;
        }
        return null;
    }

    public static function setSessionMessage(string $message): void
    {
        $_SESSION['message'] = $message;
    }

    public static function isSessionMessage(): bool
    {
        return isset($_SESSION['message']);
    }
}
