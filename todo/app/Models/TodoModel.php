<?php

namespace App\Models;

use CodeIgniter\Model;

class TodoModel extends Model
{
    protected $table = 'todo';
    protected $allowedFields = ['username', 'password'];

    public function fetchData()
    {

    }
}