<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJadwalDosenTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_jadwal_dosen' => [
                'type'           => 'SERIAL',
                // 'constraint'     => 11,
                'auto_increment' => true,
            ],
            'id_dosen' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'id_waktu' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id_jadwal_dosen');
        // $this->forge->addForeignKey('id_dosen', 'dosen', 'id_dosen');
        // $this->forge->addForeignKey('id_waktu', 'waktu', 'id_waktu');
        $this->forge->createTable('jadwal_dosen');
    }

    public function down()
    {
        $this->forge->dropTable('jadwal_dosen');
    }
}
