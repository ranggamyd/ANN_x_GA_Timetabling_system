<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJadwalTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_jadwal' => [
                'type'           => 'SERIAL',
                // 'constraint'     => 11,
                'auto_increment' => true,
            ],
            'id_waktu' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'jam_selesai' => [
                'type'       => 'TIME',
            ],
            'id_kelas' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'id_ruang' => [
                'type'       => 'INT',
                'constraint' => 11,
            ]
        ]);

        $this->forge->addPrimaryKey('id_jadwal');
        // $this->forge->addForeignKey('id_kelas', 'kelas', 'id_kelas');
        // $this->forge->addForeignKey('id_waktu', 'waktu', 'id_waktu');
        // $this->forge->addForeignKey('id_ruang', 'ruang', 'id_ruang');
        $this->forge->createTable('jadwal');
    }

    public function down()
    {
        $this->forge->dropTable('jadwal');
    }
}
