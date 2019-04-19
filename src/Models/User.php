<?php

namespace NotesApp\Models;

/**
 * Class User
 * @package NotesApp\Models
 * @property int $id
 * @property $first_name
 * @property $last_name
 * @property $email
 * @property $password
 * @property $gender
 * @property $is_active
 * @property $country
 * @property $created_at
 * @property $updated_at
 */
class User extends Model
{
    protected $fields = [
        'id',
        'first_name',
        'last_name',
        'email',
        'password',
        'gender',
        'is_active',
        'country',
        'created_at',
        'updated_at'
    ];
}
