<?php

namespace App\Models;

use CodeIgniter\Model;

class PemesananModel extends Model
{
    protected $table = 'pemesanan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_user',
        'id_kos',
        'identity_document',
        'proof_of_payment',
        'status',
        'start_date',
        'outstanding_balance',
        'created_at',
        'updated_at',
    ];

    public function getData()
    {
        return $this->db->table('pemesanan')
            ->select('
                pemesanan.*,

                kos.name as name,
                kos.price as price,
                kos.coordinat as coordinat,
                kos.address as address,
                kos.photo as photo,
                kos.id_user as owner,

                user_pemesan.id as reserver_id,
                user_pemesan.name as reserver,

                user_owner.id as owner_id,
                user_owner.name as owner_name,
                user_owner.account as account,
                user_owner.account_username as account_username,
                user_owner.account_id as account_id,
                user_owner.phone as phone
            ')
            ->join('kos', 'kos.id = pemesanan.id_kos')
            ->join('users as user_pemesan', 'user_pemesan.id = pemesanan.id_user')
            ->join('users as user_owner', 'user_owner.id = kos.id_user')
            ->get()
            ->getResultArray();
    }

    public function getDataWhere($id_user, $id_kos)
    {
        return $this->db->table('pemesanan')
            ->select('
                pemesanan.*, 

                kos.name as name,
                kos.price as price,
                kos.coordinat as coordinat,
                kos.address as address,
                kos.photo as photo,
                kos.flood_info as flood_info,
                kos.bathroom as bathroom,
                kos.air_conditioner as air_conditioner,
                kos.wifi as wifi,
                kos.available as available,
                kos.id_user as owner,
                kos.id_jenis as jenis_kos,

                jenis_kos.type as type_kos,

                user_pemesan.name as reserver_name,
                user_pemesan.phone as reserver_phone,
                user_pemesan.email as reserver_email,
                user_pemesan.account as reserver_account,
                user_pemesan.account_username as reserver_account_username,
                user_pemesan.foto as reserver_foto,

                user_owner.name as owner_name,
                user_owner.account as owner_account,
                user_owner.account_username as owner_account_username,
                user_owner.account_id as owner_account_id,
                user_owner.phone as owner_phone,


                ')
            ->join('kos', 'kos.id = pemesanan.id_kos')
            ->join('jenis_kos', 'jenis_kos.id = kos.id_jenis')
            ->join('users as user_pemesan', 'user_pemesan.id = pemesanan.id_user')
            ->join('users as user_owner', 'user_owner.id = kos.id_user')
            ->where('pemesanan.id_user', $id_user)
            ->where('pemesanan.id_kos', $id_kos)
            ->get()
            ->getResultArray();
    }

    public function getDataById($id)
    {
        return $this->db->table('pemesanan')
            ->select('
            pemesanan.*, 

            kos.name as name,
            kos.price as price,
            kos.coordinat as coordinat,
            kos.address as address,
            kos.photo as photo,
            kos.flood_info as flood_info,
            kos.bathroom as bathroom,
            kos.air_conditioner as air_conditioner,
            kos.wifi as wifi,
            kos.available as available,
            kos.id_user as owner,
            kos.id_jenis as jenis_kos,

            jenis_kos.type as type_kos,

            user_pemesan.name as reserver_name,
            user_pemesan.phone as reserver_phone,
            user_pemesan.email as reserver_email,
            user_pemesan.account as reserver_account,
            user_pemesan.account_username as reserver_account_username,
            user_pemesan.foto as reserver_foto,

            user_owner.name as owner_name,
            user_owner.account as owner_account,
            user_owner.account_username as owner_account_username,
            user_owner.account_id as owner_account_id,
            user_owner.phone as owner_phone
        ')
            ->join('kos', 'kos.id = pemesanan.id_kos')
            ->join('jenis_kos', 'jenis_kos.id = kos.id_jenis')
            ->join('users as user_pemesan', 'user_pemesan.id = pemesanan.id_user')
            ->join('users as user_owner', 'user_owner.id = kos.id_user')
            ->where('pemesanan.id', $id)
            ->get()
            ->getRowArray();
    }
}
