<?php

namespace App\Controllers;
header('Access-Control-Allow-Origin: *');

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

        $result = $model->insert($data);

        return $this->response->setJSON(['result' => $result]);
    }
}
