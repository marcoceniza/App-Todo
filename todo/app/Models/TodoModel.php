<?php

namespace App\Models;

use CodeIgniter\Model;

class TodoModel extends Model
{
    protected $table = 'todo';
    protected $allowedFields = ['id', 'email', 'username', 'password', 'todo_id', 'user_id', 'title', 'description', 'status'];
    protected $useTimestamps = true;
    protected $primaryKey = 'todo_id';

    public function fetchData()
    {
        $query = $this->join('user', 'user.id = todo.user_id')->findAll();
        return $query;
    }

    public function addData($data)
    {
        $query = $this->insert($data);
        return $query;
    }

    public function deleteData($id)
    {
        $query = $this->delete($id);
        return $query;
    }
}