<?php

namespace App\Controllers;
// defined('BASEPATH') or exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
// header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

use App\Models\TodoModel;

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

        $id = $this->request->getPost('id');

        $result = $model->deleteData($id);
        
        return $this->response->setJSON(['result' => $result]);
    }
}
