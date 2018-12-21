<?php

namespace App;

use Core\Model;

class User extends Model
{
    protected static $table = 'users';

    protected $fillable = [
        'email', 'first_name', 'last_name', 'phone', 'role_id'
    ];
}