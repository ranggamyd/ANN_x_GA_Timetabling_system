<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateWaktuTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_waktu' => [
                'type'           => 'SERIAL',
                // 'constraint'     => 11,
                'auto_increment' => true,
            ],
            'hari' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'jam_mulai' => [
                'type'       => 'TIME',
            ],
            'jam_selesai' => [
                'type'       => 'TIME',
            ],
        ]);

        $this->forge->addPrimaryKey('id_waktu');
        $this->forge->createTable('waktu');
    }

    public function down()
    {
        $this->forge->dropTable('waktu');
    }
}
