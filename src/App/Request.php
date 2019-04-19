<?php

namespace NotesApp\App;

use NotesApp\Models\User;
use NotesApp\Repository\UserRepository;

class Request extends \Zend\Diactoros\Request
{
    public function user(): ?User
    {
        if (isset($_SESSION) && isset($_SESSION['user'])) {
            $userRepository = DIProvider::getContainer()->get(UserRepository::class);
            return $userRepository->find((int)$_SESSION['user']['id']);
        }

        return null;
    }
}
