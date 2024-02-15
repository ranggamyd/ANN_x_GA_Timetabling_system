<?php

namespace App\Models;

class UserModel extends \CodeIgniter\Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id_user';
    protected $allowedFields    = ['id_user', 'username', 'password', 'avatar', 'role'];
}
