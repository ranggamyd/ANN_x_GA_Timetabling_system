<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKelasTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kelas' => [
                'type'           => 'SERIAL',
                // 'constraint'     => 11,
                'auto_increment' => true,
            ],
            'nama_kelas' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'id_mata_kuliah' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'prediksi_peserta' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
        ]);

        $this->forge->addPrimaryKey('id_kelas');
        // $this->forge->addForeignKey('id_mata_kuliah', 'mata_kuliah', 'id_mata_kuliah');
        $this->forge->createTable('kelas');
    }

    public function down()
    {
        $this->forge->dropTable('kelas');
    }
}
