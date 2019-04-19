<?php

namespace NotesApp\Models;

use Carbon\Carbon;

/**
 * Class Note
 * @package NotesApp\Models
 * @property int $id
 * @property string $name
 * @property string $description
 * @property bool $is_active
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $user_id
 */
class Note extends Model
{
    protected $fields = [
        'id',
        'name',
        'description',
        'is_active',
        'created_at',
        'updated_at',
        'user_id',
    ];
}
