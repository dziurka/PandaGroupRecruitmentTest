<?php

namespace NotesApp\Repository;

use NotesApp\Models\User;
use PDO;
use PDOException;

class UserRepository extends Repository
{
    public function index()
    {
        $query = 'SELECT * FROM users';

        $response = $this->conn->query($query);

        if (false === $response) {
            throw new PDOException('Cannot connect with mysql server.');
        }

        return $response->fetchAll(PDO::FETCH_CLASS, User::class);
    }

    public function find(int $userId): ?User
    {
        return $this->findBy('id', $userId);
    }

    public function findBy($attribute, $value = ''): ?User
    {

        if (false === is_array($attribute)) {
            $query = 'SELECT * FROM users WHERE ' . $attribute . ' = "' . $value . '"';
        } else {
            $query = 'SELECT * FROM users WHERE ';

            $paramsQty = count($attribute);

            $i = 0;
            foreach ($attribute as $key => $value) {
                $i++;
                $query .= $key . ' = "' . $value . '"';
                if ($i !== $paramsQty) {
                    $query .= ' AND ';
                }
            }
        }

        $response = $this->conn->query($query);

        if (false === $response) {
            throw new PDOException('Cannot connect with mysql server.');
        }

        $user = $response->fetchObject(User::class);

        if (!$user) {
            return null;
        }

        return $user;
    }

    /**
     * @param User|array $user
     * @return bool
     */
    public function store($user): bool
    {
        if (false === is_array($user)) {
            $q = 'INSERT INTO notes.users(first_name, last_name, email, gender, is_active, password, country, created_at, updated_at)';
            $q .= ' VALUES(';
            $q .= '\'' . $user->first_name . '\', ';
            $q .= '\'' . $user->last_name . '\', ';
            $q .= '\'' . $user->email . '\', ';
            $q .= '\'' . $user->gender . '\', ';
            $q .= '' . $user->is_active . ', ';
            $q .= '\'' . $user->password . '\', ';
            $q .= ($user->country) ? '\'' . $user->country . '\', ' : 'NULL, ';
            $q .= ($user->created_at) ? '\'' . $user->created_at . '\', ' : 'NULL, ';
            $q .= ($user->updated_at) ? '\'' . $user->updated_at . '\'' : 'NULL';
            $q .= ');';
        } else {
            $q = 'INSERT INTO notes.users(first_name, last_name, email, gender, is_active, password, country, created_at, updated_at)';
            $q .= ' VALUES';

            $userQty = count($user);

            $i = 0;
            foreach ($user as $key => $item) {
                $i++;
                $q .= '(';
                $q .= '"' . $item->first_name . '", ';
                $q .= '"' . $item->last_name . '", ';
                $q .= '"' . $item->email . '", ';
                $q .= '"' . $item->gender . '", ';
                $q .= $item->is_active . ', ';
                $q .= '"' . $item->password . '", ';
                $q .= ($item->country) ? '"' . $item->country . '", ' : 'NULL, ';
                $q .= ($item->created_at) ? '"' . $item->created_at . '", ' : 'NULL, ';
                $q .= ($item->updated_at) ? '"' . $item->updated_at . '", ' : 'NULL';
                $q .= ')';

                if ($i !== $userQty) {
                    $q .= ', ';
                }
            }
        }

        $response = $this->conn->query($q);
        return false !== $response;
    }

    public function getCountryStatistic(): array
    {
        $q = 'SELECT country, count(1) as num FROM users GROUP BY country;';
        return $this->conn->query($q)->fetchAll();
    }
}
