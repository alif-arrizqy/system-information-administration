<?php

namespace App\Models;

use CodeIgniter\Model;

class usersModel extends Model
{

    public function get_info_login_lembaga()
    {
        $id = session()->get('id_lembaga');
        $query = $this->db->query("SELECT * FROM lembaga WHERE id_lembaga = '$id' ORDER BY id_lembaga DESC LIMIT 1");
        return $query;
    }

    public function get_all_users()
    {
        return $this->db->query("SELECT * FROM users")->getResultArray();
    }

    public function save_users($kirimdata)
    {
        return $this->db->table('users')->insert($kirimdata);
    }

    public function update_users($kirimdata)
    {
        return $this->db->table('users')->update($kirimdata);
    }

    public function delete_users($id_user)
    {
        return $this->db->query("DELETE FROM users WHERE id_user = '$id_user'");
    }
}