<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{

        /*

            'id'                : not null, auto_increment, int
            'name'              : not null, varchar(100), text
            'email'             : not null, varchar(100), email
            'account'           : null
            'account_username'  : null
            'account_id'        : null
            'phone'             : null
            'password'          : not null    
            'level'             : null
            'foto'              : null
            'status'            : null
            'created_at'        : not null
            'updated_at'        : not null

        */

    // Variable
    protected $table      = 'users';
    protected $allowedFields = ['name', 'email', 'phone', 'account', 'account_username', 'account_id', 'password', 'level', 'foto', 'status', 'created_at', 'updated_at'];

    // Getting all data
    public function getData()
    {
        return $this->db->table('users')->get()->getResultArray();
    }

    // Getting data where id
    public function getDataWhere($id)
    {
        return $this->db->table('users')->where('id', $id)->get()->getResultArray();
    }

    // Insert data
    public function insertData($data)
    {
        return $this->db->table('users')->insert($data);
    }

    // Update data
    public function updateData($id, $data)
    {
        return $this->db->table('users')->update($id, $data);
    }

    // Delete data
    public function deleteData($id)
    {
        return $this->db->table('users')->delete($id);
    }

}
