<?php

namespace App\Models;
header('Access-Control-Allow-Origin: *');
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $allowedFields = ['email', 'username', 'password'];
}