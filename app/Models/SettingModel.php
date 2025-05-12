<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    // Variable
    protected $table = 'setting';
    protected $allowedFields = ['id', 'coordinat', 'zoom', 'created_at', 'updated_at'];

    public function getSetting()
    {
        return $this->db->table('setting')->get()->getResultArray();
    }

}
