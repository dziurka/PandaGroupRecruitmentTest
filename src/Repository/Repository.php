<?php

namespace NotesApp\Repository;

abstract class Repository
{
    /** @var \PDO */
    protected $conn;

    public function __construct(DB $conn)
    {
        $this->conn = $conn->conn();
    }
}
