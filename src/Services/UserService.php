<?php

namespace NotesApp\Services;

use NotesApp\Repository\UserRepository;
use Zend\Diactoros\Request;

class UserService
{

    protected $request;
    protected $repository;

    public function __construct(Request $request, UserRepository $userRepository)
    {
        $this->request = $request;
        $this->repository = $userRepository;
    }

    public function logout(): bool
    {
        unset($_SESSION['user']);
        return true;
    }
}
