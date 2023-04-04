<?php

namespace App\Models;
header('Access-Control-Allow-Origin: *');
use CodeIgniter\Model;

class TodoModel extends Model
{
    protected $table = 'todo';
    protected $allowedFields = ['user_id', 'title', 'description', 'status'];
    protected $useTimestamps = true;

    public function fetchData()
    {
        $builder = $this->db->table('user')->select('*');
        $builder->join('todo', 'todo.user_id = user.id');
        $result = $builder->get()->getResult();
        return $result;
    }

    public function addData()
    {
        return $this->insert($data);
    }
}