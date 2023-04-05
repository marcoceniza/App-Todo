<?php

namespace App\Models;

use CodeIgniter\Model;

class TodoModel extends Model
{
    protected $table = 'todo';
    protected $allowedFields = ['id', 'email', 'username', 'password', 'todo_id', 'user_id', 'title', 'description', 'status'];
    protected $useTimestamps = true;
    protected $primaryKey = 'user_id';

    public function fetchData()
    {
        $builder = $this->db->table('user')->select('*');
        $builder->join('todo', 'todo.user_id = user.id');
        $result = $builder->get()->getResult();
        return $result;
    }

    public function deleteData()
    {
        $query = $this->db->table('user')->select('*');
        $query->join('todo', 'todo.user_id = user.id');
        $result = $query->findAll();

        return $result;
    }
}