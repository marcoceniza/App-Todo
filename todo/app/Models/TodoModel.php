<?php

namespace App\Models;

use CodeIgniter\Model;

class TodoModel extends Model
{
    protected $table = 'todo';
    protected $allowedFields = ['user_id', 'title', 'description', 'status'];
    protected $useTimestamps = true;

    public function fetchData()
    {
        return $this->findAll();
    }
}