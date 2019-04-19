<?php

namespace NotesApp\Services;

use NotesApp\App\DIProvider;
use NotesApp\Models\User;
use NotesApp\Repository\UserRepository;

class LoginService
{
    /** @var string */
    protected $login;
    /** @var string */
    protected $password;

    /** @var UserRepository */
    protected $repository;

    public function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = $password;

        $this->repository = DIProvider::getContainer()->get(UserRepository::class);
    }

    public function authenticate(): ?User
    {
        $user = $this->repository->findBy([
            'email' => $this->login
        ]);

        if (false === password_verify($this->password, $user->password)) {
            return null;
        };

        $this->addSession($user);

        return $user;
    }

    protected function addSession(User $user)
    {
        $_SESSION['user'] = $user->toArray();
    }
}
