<?php

namespace App\Models;

use CodeIgniter\Model;

class KosModel extends Model
{

    // Variables
    protected $table = 'kos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'id_jenis', 'price', 'available', 'id_user', 'coordinat', 'photo', 'address', 'bathroom', 'air_conditioner', 'wifi', 'id_wilayah', 'flood_info', 'status', 'created_at', 'updated_at'];

    // Function
    public function getData()
    {
        return $this->db->table('kos')
            ->select('kos.*, jenis_kos.type as type, users.name as owner, wilayah.name as wilayah')
            ->join('jenis_kos', 'jenis_kos.id = kos.id_jenis')
            ->join('users', 'users.id = kos.id_user')
            ->join('wilayah', 'wilayah.id = kos.id_wilayah')
            ->get()
            ->getResultArray();
    }

    public function getDataWhere($id)
    {
        return $this->db->table('kos')
            ->select('kos.*, 
                jenis_kos.type as type, 
                users.name as owner, 
                users.account as account,
                users.account_username as account_username,
                users.account_id as account_id,
                users.phone as phone,
                wilayah.name as wilayah_name,
                wilayah.geojson as wilayah_coordinat,
                wilayah.warna as wilayah_warna
                ')
            ->join('jenis_kos', 'jenis_kos.id = kos.id_jenis')
            ->join('users', 'users.id = kos.id_user')
            ->join('wilayah', 'wilayah.id = kos.id_wilayah')
            ->where('kos.id', $id)
            ->get()
            ->getResultArray();
    }

    // get Data where id_user
    public function getDataWhereUser($id_user)
    {
        return $this->db->table('kos')->where('id_user', $id_user)->get()->getResultArray();
    }

    // get data where id_jenis
    public function getDataWhereJenis($id_jenis)
    {
        return $this->db->table('kos')->where('id_jenis', $id_jenis)->get()->getResultArray();
    }

    // get data where id wilayah
    public function getDataWhereWilayah($id_wilayah)
    {
        return $this->db->table('kos')->where('id_wilayah', $id_wilayah)->get()->getResultArray();
    }
}
