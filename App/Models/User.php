<?php

namespace App\Models;


use App\Model;

class User extends Model
{
    const TABLE = 'users';

    public $email;
    public $name;
}