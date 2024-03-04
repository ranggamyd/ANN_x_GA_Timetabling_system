<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDosenMataKuliahTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_dosen_mata_kuliah' => [
                'type'           => 'SERIAL',
                // 'constraint'     => 11,
                'auto_increment' => true,
            ],
            'id_dosen' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'id_mata_kuliah' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id_dosen_mata_kuliah');
        // $this->forge->addForeignKey('id_dosen', 'dosen', 'id_dosen');
        // $this->forge->addForeignKey('id_waktu', 'waktu', 'id_waktu');
        $this->forge->createTable('dosen_mata_kuliah');
    }

    public function down()
    {
        $this->forge->dropTable('dosen_mata_kuliah');
    }
}
