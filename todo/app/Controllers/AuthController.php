<?php

namespace App\Controllers;
header("Access-Control-Allow-Origin: *");

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        $model = new UserModel();
        $post = $this->request->getPost(['email', 'password']);

        $user = $model->where('email', $post['email'])->first();

        if($post['email'] !== $user['email'] || $post['password'] !== $user['password']) {
            return $this->response->setJSON(['error' => 'Incorrect Email or Password!']);
        }

        $token = bin2hex(random_bytes(16));

        return $this->response->setJSON([
            'user' => $user,
            'token' => $token
        ]);
    }
}

?>