<?php

namespace App\Models;

use CodeIgniter\Model;

class WilayahModel extends Model
{
    // Variable
    protected $table            = 'wilayah';
    protected $allowedFields    = ['id', 'name', 'geojson', 'warna'];

    // Get all data
    public function getData()
    {
        return $this->db->table('wilayah')->get()->getResultArray();
    }

    // Get data where id
    public function getDataWhere($id)
    {
        return $this->db->table('wilayah')->where('id', $id)->get()->getResultArray();
    }

    // Insert data
    public function insertData($data)
    {
        return $this->db->table('wilayah')->insert($data);
    }

    // Update data
    public function updateData($id, $data)
    {
        return $this->db->table('wilayah')->update($id, $data);
    }

    // Delete data
    public function deleteData($id)
    {
        return $this->db->table('wilayah')->delete($id);
    }
    
    // Counting 
    public function countData()
    {
        return $this->db->table('wilayah')->countAllResults();
    }
}
