<?php

namespace App\Models;

use CodeIgniter\Model;

class TodoModel extends Model
{
    protected $table = 'user';
    protected $allowedFields = ['email', 'username', 'password'];
}