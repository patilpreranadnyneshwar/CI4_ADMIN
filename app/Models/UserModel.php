<?php
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model{
    protected $table='register';
    protected $allowedFields=[
        'firstname',
        'lastname',
        'email',
        'password',
        'created_at',
        'token'
    ];
}