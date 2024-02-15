<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHistoriPeminatTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_histori_peminat' => [
                'type'           => 'SERIAL',
                // 'constraint'     => 11,
                'auto_increment' => true,
            ],
            'id_mata_kuliah' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'tahun' => [
                'type'       => 'INT',
                'constraint' => 4,
            ],
            'jumlah_peminat' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            // 'persentase' => [
            //     'type'       => 'DECIMAL',
            // ],
        ]);

        $this->forge->addPrimaryKey('id_histori_peminat');
        // $this->forge->addForeignKey('id_mata_kuliah', 'mata_kuliah', 'id_mata_kuliah');
        $this->forge->createTable('histori_peminat');
    }

    public function down()
    {
        $this->forge->dropTable('histori_peminat');
    }
}
