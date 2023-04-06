<?php

namespace App\Controllers;
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');

use App\Models\UserModel;

class RegisterController extends BaseController
{
    public function register()
    {
        $model = new UserModel();

        $post = $this->request->getPost(['email', 'username', 'password']);

        $data = [
            'email' => $post['email'],
            'username' => $post['username'],
            'password' => $post['password'],
        ];

        $result = $model->insert($data);

        return $this->response->setJSON(['result' => $result]);
    }
}
