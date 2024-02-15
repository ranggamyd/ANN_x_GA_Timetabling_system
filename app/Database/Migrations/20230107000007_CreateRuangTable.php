<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRuangTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_ruang' => [
                'type'           => 'SERIAL',
                // 'constraint'     => 11,
                'auto_increment' => true,
            ],
            'kode_ruang' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'nama_ruang' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'kapasitas' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            // 'gedung' => [
            //     'type'       => 'VARCHAR',
            //     'constraint' => '255',
            // ],
        ]);

        $this->forge->addPrimaryKey('id_ruang');
        $this->forge->createTable('ruang');
    }

    public function down()
    {
        $this->forge->dropTable('ruang');
    }
}
