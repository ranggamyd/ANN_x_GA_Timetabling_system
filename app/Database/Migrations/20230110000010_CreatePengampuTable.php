<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePengampuTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pengampu' => [
                'type'           => 'SERIAL',
                // 'constraint'     => 11,
                'auto_increment' => true,
            ],
            'id_kelas' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'id_dosen' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
        ]);

        $this->forge->addPrimaryKey('id_pengampu');
        // $this->forge->addForeignKey('id_dosen', 'dosen', 'id_dosen');
        // $this->forge->addForeignKey('id_kelas', 'kelas', 'id_kelas');
        $this->forge->createTable('pengampu');
    }

    public function down()
    {
        $this->forge->dropTable('pengampu');
    }
}
