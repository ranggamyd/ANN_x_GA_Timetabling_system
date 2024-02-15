<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAngkatanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_angkatan_prodi' => [
                'type' => 'SERIAL',
                // 'constraint' => 11,
                'auto_increment' => true,
            ],
            'id_prodi' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'tahun' => [
                'type'       => 'INT',
                'constraint' => 4,
            ],
            'jumlah_mahasiswa' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
        ]);

        $this->forge->addKey('id_angkatan', true);
        // $this->forge->addForeignKey('id_prodi', 'prodi', 'id_prodi');
        // $this->forge->createTable('angkatan_prodi', true);
    }

    public function down()
    {
        $this->forge->dropTable('angkatan_prodi');
    }
}
