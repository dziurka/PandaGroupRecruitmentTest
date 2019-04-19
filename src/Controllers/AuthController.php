<?php

namespace NotesApp\Controllers;

use NotesApp\App\DIProvider;
use NotesApp\App\Helpers\ResponseHelper;
use NotesApp\App\Helpers\Validation;
use NotesApp\Models\User;
use NotesApp\Repository\UserRepository;
use NotesApp\Services\LoginService;
use NotesApp\Views\View;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Request;
use Carbon\Carbon;
use Zend\Diactoros\Response;

class AuthController extends Controller
{
    /** @var UserRepository */
    private $repository;
    /** @var Request */
    private $request;

    public function __construct(UserRepository $repository, Request $request)
    {
        $this->repository = $repository;
        $this->request = $request;
    }

    public function login()
    {
        $properData = Validation::issetFormInput('POST', [
            'email', 'password'
        ]);

        $loginService = new LoginService($_POST['email'], $_POST['password']);

        if (false === $properData || null === $user = $loginService->authenticate()) {
            return ResponseHelper::redirect('', 'Incorrect credentials');
        }

        return ResponseHelper::redirect('notes');
    }

    public function register()
    {
        return ResponseHelper::view('register');
    }

    public function store(): ResponseInterface
    {
        $requiredData = [
            'first_name', 'last_name', 'email', 'gender', 'password'
        ];

        if (false === Validation::issetFormInput('POST', $requiredData) ||
            false === Validation::isEmail($_POST['email'])) {
            return ResponseHelper::redirect('register', 'Complete all fields');
        }

        $data = [
            'first_name' => trim($_POST['first_name']),
            'last_name' => trim($_POST['last_name']),
            'email' => trim($_POST['email']),
            'gender' => ($_POST['gender'] === '0') ? 'male' : 'female',
            'is_active' => 1,
            'password' => password_hash($_POST['password'], PASSWORD_BCRYPT, ['cost' => 11]),
            'created_at' => Carbon::now(),
            'updated_at' => null,
            'country' => null
        ];

        if (false === $this->user->register($data)) {
            return ResponseHelper::redirect('register', 'Error occurred');
        }

        return ResponseHelper::redirect('', 'Successfully registered');
    }

    public function logout()
    {
        $this->user->logout();
        return ResponseHelper::redirect('', 'Successfully logout');
    }
}
