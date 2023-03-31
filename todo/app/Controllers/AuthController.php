<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class AuthController extends BaseController
{
    use ResponseTrait;

    public function login()
    {
        $model = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)
                      ->first();

        if ($user && password_verify($password, $user['password'])) {
            // Generate a token and store it in the user's session
            $token = bin2hex(random_bytes(16));
            $_SESSION['user_token'] = $token;

            // Return the user's information and token to the client
            return $this->respond([
                'user' => $user,
                'token' => $token
            ]);
        } else {
            return $this->failUnauthorized('Invalid login credentials');
        }
    }

    public function logout()
    {
        // Remove the user's token from their session
        unset($_SESSION['user_token']);
        return $this->respondDeleted();
    }
}

?>