<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAutoRejectEvent extends Migration
{
    public function up()
    {
        // Buat event scheduler MySQL
        $sql = "
            CREATE EVENT IF NOT EXISTS auto_reject_pemesanan
            ON SCHEDULE EVERY 5 MINUTE
            DO
            BEGIN
            UPDATE pemesanan
                SET status = 'Rejected'
                WHERE status = 'Pending'
                    AND proof_of_payment IS NULL
                    AND created_at <= NOW() - INTERVAL 1 HOUR;
            END
        ";

        // Event test Interval 5 menit
        // $sql = "
        //     CREATE EVENT IF NOT EXISTS auto_reject_pemesanan
        //     ON SCHEDULE EVERY 1 MINUTE
        //     DO
        //     BEGIN
        //     UPDATE pemesanan
        //         SET status = 'Rejected'
        //         WHERE status = 'Pending'
        //             AND proof_of_payment IS NULL
        //             AND created_at <= NOW() - INTERVAL 5 MINUTE;
        //     END
        // ";

        $this->db->query($sql);
    }

    public function down()
    {
        // Drop event kalau rollback migration
        $sql = "DROP EVENT IF EXISTS auto_reject_pemesanan;";
        $this->db->query($sql);
    }
}
