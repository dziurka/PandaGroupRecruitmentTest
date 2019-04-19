<?php

namespace NotesApp\Controllers;

use Carbon\Carbon;
use NotesApp\App\Helpers\ResponseHelper;
use NotesApp\App\Helpers\Validation;
use NotesApp\App\Helpers\URLHelper;
use NotesApp\Models\Note;
use NotesApp\Repository\NoteRepository;
use NotesApp\App\Request;

class NoteController extends Controller
{
    /** @var NoteRepository */
    private $repository;
    /** @var Request */
    private $request;

    public function __construct(NoteRepository $repository, Request $request)
    {
        $this->repository = $repository;
        $this->request = $request;
    }

    public function index()
    {
        $data = [
            'notes' => $this->repository->indexUserNotes($this->request->user())
        ];

        return ResponseHelper::view('notes-index', $data);
    }

    public function create()
    {
        return ResponseHelper::view('notes-create');
    }

    public function store()
    {
        $requiredData = [
            'name', 'description'
        ];

        if (false === Validation::issetFormInput('POST', $requiredData)) {
            return ResponseHelper::redirect('notes/create', 'Complete all fields');
        }

        $note = new Note();
        $note->name = trim($_POST['name']);
        $note->description = trim($_POST['description']);
        $note->user_id = $this->request->user()->id;
        $note->is_active = 1;
        $note->created_at = Carbon::now();

        if (false === $this->repository->create($note)) {
            return ResponseHelper::redirect('notes', 'Error occurred');
        }

        return ResponseHelper::redirect('notes');
    }

    public function show()
    {
        $noteId = (int)URLHelper::getPathParameters()[2];
        $note = $this->repository->find($noteId);
        if (null === $note) {
            return ResponseHelper::redirect('notes','Note doesn\'t exist');
        }

        if (false === $this->isUsersNote($note)) {
            ResponseHelper::redirect('notes','Access danied');
        }

        return ResponseHelper::view('notes-show',[
            'note' => $note
        ]);
    }

    public function edit()
    {
        $noteId = (int)URLHelper::getPathParameters()[3];
        $note = $this->repository->find($noteId);

        if (!$note) {
            return ResponseHelper::redirect('notes','Note doesn\'t exist');
        }

        if (false === $this->isUsersNote($note)) {
            ResponseHelper::redirect('notes','Access danied');
        }

        return ResponseHelper::view('notes-edit', [
            'note' => $note
        ]);
    }

    public function update()
    {
        $requiredData = [
            'name', 'description'
        ];

        if (false === Validation::issetFormInput('POST', $requiredData)) {
            return ResponseHelper::redirect('notes/create', 'Complete all fields');
        }

        $noteId = (int)URLHelper::getPathParameters()[3];
        $note = $this->repository->find($noteId);
        if (!$note) {
            return ResponseHelper::redirect('notes','Note doesn\'t exist');
        }

        if (false === $this->isUsersNote($note)) {
            ResponseHelper::redirect('notes','Access danied');
        }

        $note->name = trim($_POST['name']);
        $note->description = trim($_POST['description']);
        $note->updated_at = Carbon::now();

        if (false === $this->repository->update($note)) {
            ResponseHelper::redirect('notes','Error occurred during edit');
        }

        return ResponseHelper::redirect('notes');
    }

    public function delete()
    {
        $noteId = (int)URLHelper::getPathParameters()[3];
        $note = $this->repository->find($noteId);

        if (!$note) {
            return ResponseHelper::redirect('notes','Note doesn\'t exist');
        }

        if (false === $this->isUsersNote($note)) {
            ResponseHelper::redirect('notes','Access danied');
        }

        if (false === $this->repository->delete($note)) {
            ResponseHelper::redirect('notes','Error occurred during editing');
        }

        return ResponseHelper::redirect('notes', 'Note deleted');
    }

    protected function isUsersNote(Note $note) {
        return $this->request->user()->id == $note->user_id;
    }
}
