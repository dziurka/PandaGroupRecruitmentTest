<?php

namespace NotesApp\Repository;

use PDO;
use PDOException;

class DB {

    private $host = 'localhost';
    private $dbname = 'notes';
    private $user = 'root';
    private $pass = 'Haslo1234';
    private $pdo;

    public function __construct()
    {
        try
        {
            $pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8", $this->user, $this->pass);
            $this->pdo = $pdo;
        }
        catch(PDOException $e)
        {
            echo 'Error occurred in DB connection' . $e->getMessage();
        }
    }

    public function conn()
    {
        return $this->pdo;
    }

}
