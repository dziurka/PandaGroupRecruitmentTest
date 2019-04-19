<?php

namespace NotesApp\App\Helpers;

abstract class Validation
{

    public static function isEmail(string $email): bool
    {
        return !(false === filter_var(trim($email), FILTER_VALIDATE_EMAIL));
    }

    public static function issetFormInput(string $httpMethod, array $data): bool
    {
        if ($httpMethod === 'GET') {
            foreach ($data as $item) {
                if (false === isset($_GET[$item]) ||
                    true === empty($_GET[$item])) {
                    return false;
                }
            }
        } else if ($httpMethod === 'POST') {
            foreach ($data as $item) {
                if (false === isset($_POST[$item]) ||
                    true === empty($_POST[$item])) {
                    return false;
                }
            }
        }
        return true;
    }

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
