<?php

namespace App\Models;

use CodeIgniter\Model;

class loginModel extends Model
{
    // cek login
    protected $table = 'users';
    protected $allowedFields = ['id_user', 'username', 'password', 'fullname', 'status', 'id_lembaga'];

    
    public function cek_status($status)
    {
        return $this->db->table('users')->where(array('status' => $status))
        ->get()->getRowArray();
    }
}
