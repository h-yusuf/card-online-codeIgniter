<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'id_user';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = ['username', 'password', 'nama', 'last_login'];

    protected $validationRules    = [
        'id_user' => 'string',
        'username' => 'required|is_unique[user.username,id_user,{id_user}]',
    ];

    protected $validationMessages = [
        'username'        => [
            'is_unique' => 'Maaf, Username {value} Sudah Ada',
        ],
    ];
}
