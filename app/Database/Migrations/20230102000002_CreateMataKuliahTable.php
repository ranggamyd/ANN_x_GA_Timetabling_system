<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMataKuliahTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_mata_kuliah' => [
                'type'           => 'SERIAL',
                // 'constraint'     => 11,
                'auto_increment' => true,
            ],
            'kode_mata_kuliah' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'null'       => true,
            ],
            'nama_mata_kuliah' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'sks' => [
                'type'       => 'INT',
                'constraint' => 3,
            ],
            'semester' => [
                'type'       => 'INT',
                'constraint' => 3,
            ],
            'paket' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'default'    => 'Genap',
            ],
            'sifat' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'default'    => 'Wajib',
            ],
            'id_prodi' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'is_active' => [
                'type'       => 'BOOLEAN',
                'default'    => '1',
            ],
            'tahun_prediksi' => [
                'type'       => 'INT',
                'constraint' => 4,
                'null'       => true,
            ],
            'prediksi_peminat' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'max_peserta' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id_mata_kuliah');
        // $this->forge->addForeignKey('id_prodi', 'prodi', 'id_prodi');
        $this->forge->createTable('mata_kuliah');
    }

    public function down()
    {
        $this->forge->dropTable('mata_kuliah');
    }
}
