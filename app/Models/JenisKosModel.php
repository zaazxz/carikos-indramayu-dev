<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisKosModel extends Model
{
    protected $table            = 'jenis_kos';
    protected $allowedFields    = ['type', 'marker', 'created_at', 'updated_at'];

    public function getJenisKos()
    {
        return $this->db->table('jenis_kos')->get()->getResultArray();
    }

}
