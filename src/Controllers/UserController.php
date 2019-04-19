<?php

namespace NotesApp\Controllers;

use NotesApp\App\Helpers\ResponseHelper;
use NotesApp\App\Helpers\Validation;
use NotesApp\Models\User;
use NotesApp\Repository\UserRepository;
use NotesApp\Services\UserService;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Request;
use Carbon\Carbon;

class UserController extends Controller
{
    private $request;
    private $userRepository;
    private $userService;

    public function __construct(Request $request, UserRepository $userRepository, UserService $userService)
    {
        $this->request = $request;
        $this->userRepository = $userRepository;
        $this->userService = $userService;
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
            return ResponseHelper::redirect('register','Complete all fields');
        }

        $user = new User();
        $user->first_name = trim($_POST['first_name']);
        $user->last_name = trim($_POST['last_name']);
        $user->email = trim($_POST['email']);
        $user->gender = ($_POST['gender'] === "male") ? 'Male' : 'Female';
        $user->is_active = 1;
        $user->password = password_hash($_POST['password'], PASSWORD_BCRYPT, ['cost' => 11]);
        $user->created_at = Carbon::now();;

        if (false === $this->userRepository->store($user)) {
            return  ResponseHelper::redirect('register','Error occurred');
        }

        return  ResponseHelper::redirect('','Successfully registered');
    }

    public function logout()
    {
        $this->userService->logout();
        return  ResponseHelper::redirect('','Successfully logout');
    }

    public function countryStatistic()
    {
        $stats = $this->userRepository->getCountryStatistic();

        if (true === empty($stats)) {
            ResponseHelper::redirect('','There no any statistics');
        }

        $countries = [];
        $levels = [];

        foreach ($stats as $item) {
            $countries[] = $item['country'];
            $levels[] = $item['num'];
        }

        return ResponseHelper::view('chart', [
            'countries' => $countries,
            'levels' => $levels
        ]);
    }
}
