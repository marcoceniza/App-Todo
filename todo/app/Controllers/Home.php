<?php

namespace App\Controllers;
header('Access-Control-Allow-Origin: *');

use App\Models\TodoModel;

class Home extends BaseController
{
    public function index()
    {
        $model = new TodoModel();

        $data = $model->fetchData();

        return $this->response->setJSON(['result' => $data]);
    }
}
