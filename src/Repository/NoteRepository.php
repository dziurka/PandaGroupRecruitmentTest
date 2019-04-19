<?php

namespace NotesApp\Repository;

use NotesApp\Models\Note;
use NotesApp\Models\User;
use PDO;
use PDOException;

class NoteRepository extends Repository
{
    public function indexUserNotes(User $user): array
    {
        $query = 'SELECT * FROM notes WHERE user_id = "' . $user->id . '"';

        $response = $this->conn->query($query);

        if (false === $response) {
            throw new PDOException('Cannot connect with mysql server.');
        }

        return $response->fetchAll(PDO::FETCH_CLASS, Note::class);
    }

    public function find(int $noteId): ?Note
    {
        return $this->findBy('id', $noteId);
    }

    public function findBy($attribute, $value = ''): ?Note
    {

        if (!is_array($attribute)) {
            $query = 'SELECT * FROM notes WHERE ' . $attribute . ' = "' . $value . '"';
        } else {
            $query = 'SELECT * FROM notes WHERE ';

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

        $note = $response->fetchObject(Note::class);

        if (!$note) {
            return null;
        }

        return $note;
    }

    public function create($note): bool
    {
        if (false === is_array($note)) {
            $q = 'INSERT INTO notes.notes(name, description, is_active, user_id, created_at, updated_at)';
            $q .= ' VALUES(';
            $q .= '\'' . $note->name . '\', ';
            $q .= '\'' . $note->description . '\', ';
            $q .= '' . $note->is_active . ', ';
            $q .= '' . $note->user_id . ', ';
            $q .= '\'' . $note->created_at . '\', ';
            $q .= ($note->updated_at) ? '\'' . $note->updated_at . '\' ' : 'NULL ';
            $q .= ');';
        } else {
            $q = 'INSERT INTO notes.notes(name, description, is_active, user_id, created_at, updated_at)';
            $q .= ' VALUES';

            $notesQty = count($note);

            foreach ($note as $key => $item) {
                $q .= ' (';
                $q .= '\'' . $item->name . '\', ';
                $q .= '\'' . $item->description . '\', ';
                $q .= '' . $item->is_active . ', ';
                $q .= '' . $item->user_id . ', ';
                $q .= '\'' . $item->created_at . '\', ';
                $q .= ($item->updated_at) ? '\'' . $item->updated_at . '\' ' : 'NULL ';
                $q .= ')';

                if ($key -1  != $notesQty) {
                    $q .= ',';
                }
            }
        }

        $query = $this->conn->query($q);

        if (false === $query) {
            return false;
        }

        return true;
    }

    public function update(Note $note): bool
    {
        $q = 'UPDATE notes.notes ';
        $q .= 'SET ';
        foreach ($note->toArray() as $key => $item) {
            $q .= $key . ' = \'' . $item . '\', ';
        }
        $q = substr($q, 0, -2);
        $q .= ' WHERE id = ' . $note->id;
        $q .= ';';

        $query = $this->conn->query($q);
        if (false === $query) {
            return false;
        }
        return true;
    }

    public function delete(Note $note): bool
    {
        $q = 'DELETE FROM notes.notes WHERE id = ' . $note->id . ';';
        $query = $this->conn->query($q);
        if (false === $query) {
            return false;
        }
        return true;
    }
}
