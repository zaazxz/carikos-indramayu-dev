<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    public function getData()
    {
        return $this->db->table('users')->get()->getResultArray();
    }
}
