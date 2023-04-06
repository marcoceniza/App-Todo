<?php

namespace App\Controllers;
// defined('BASEPATH') or exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');

use App\Models\TodoModel;
use CodeIgniter\RESTful\ResourceController;

class Home extends BaseController
{
    public function index()
    {
        $model = new TodoModel();

        $result = $model->fetchData();
        return $this->response->setJSON(['result' => $result]);
    }

    public function addDataController()
    {
        $model = new TodoModel();

        $post = $this->request->getPost(['user_id', 'title', 'description']);

        $data = [
            'user_id' => $post['user_id'],
            'title' => $post['title'],
            'description' => $post['description'],
        ];

        $result = $model->addData($data);

        return $this->response->setJSON(['result' => $result]);
    }

    public function deleteController()
    {
        $model = new TodoModel();

        $result = $model->deleteData($id);
        
        return $this->response->setJSON(['data' => $result]);
    }
}
