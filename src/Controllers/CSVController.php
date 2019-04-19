<?php

namespace NotesApp\Controllers;

use NotesApp\App\Helpers\ResponseHelper;
use NotesApp\App\Request;
use NotesApp\Models\User;
use NotesApp\Repository\UserRepository;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

class CSVController extends Controller
{

    protected $csv;
    protected $request;
    protected $userRepository;

    public function __construct(Csv $csv, Request $request, UserRepository $userRepository)
    {
        $this->csv = $csv;
        $this->request = $request;
        $this->userRepository = $userRepository;
    }

    public function upload()
    {
        return ResponseHelper::view('upload-csv');
    }

    public function parse()
    {
        if (false === isset($_FILES['csv']) ||
            $_FILES['csv']['size'] == 0) {

            return ResponseHelper::redirect('upload', 'Upload file');
        }
        ini_set('max_execution_time', 900);

        $spreadsheet = $this->csv->load($_FILES['csv']['tmp_name']);

        $worksheet = $spreadsheet->getActiveSheet();

        $allowedData = [
            'first_name', 'last_name', 'email', 'gender', 'password', 'is_active', 'created_at', 'updated_at', 'country'
        ];

        $requiredData = [
            'first_name', 'last_name', 'email', 'gender', 'password', 'is_active', 'created_at', 'country'
        ];

        $worksheet = $worksheet->toArray();
        $titles = $worksheet[0];
        $allowedColumns = [];
        foreach ($titles as $key => $title) {
            if (in_array($title, $allowedData)) {
                $allowedColumns[$title] = $key;
            };
        }

        if (count($requiredData) > count($allowedColumns)) {
            return ResponseHelper::redirect('', 'There no needed column');
        }


        $chunkOfUser = [];
        $limitOfChunk = 50;

        for ($i = 1, $j = 1; $i < count($worksheet); $i++, $j++) {

            $user = new User();

            foreach ($worksheet[$i] as $key => $item) {
                if (in_array($key, $allowedColumns)) {

                    if ($titles[$key] == 'password') {
                        $pass = password_hash($item, PASSWORD_BCRYPT, ['cost' => 11]);
                        $user->password = $pass;
                    } else {
                        $user->{$titles[$key]} = $item;
                    }
                }
            }


            $chunkOfUser[] = $user;

            if ($j >= $limitOfChunk && $limitOfChunk !== 0) {
                if (false === $this->userRepository->store($chunkOfUser)) {
                    return ResponseHelper::redirect('', 'Error during save data from csv');
                }
                unset($chunkOfUser);
                $chunkOfUser = [];
                $j = 0;
            }
        }

        if ($limitOfChunk === 0 || count($chunkOfUser)) {
            if (false === $this->userRepository->store($chunkOfUser)) {
                return ResponseHelper::redirect('', 'Error during save data from csv');
            }
        }

        return ResponseHelper::redirect('', 'File uploaded successfully');
    }
}
