<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRuangProdiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_ruang_prodi' => [
                'type'           => 'SERIAL',
                // 'constraint'     => 11,
                'auto_increment' => true,
            ],
            'id_ruang' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'id_prodi' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
        ]);

        $this->forge->addPrimaryKey('id_ruang_prodi');
        // $this->forge->addForeignKey('id_prodi', 'prodi', 'id_prodi');
        // $this->forge->addForeignKey('id_ruang', 'ruang', 'id_ruang');
        $this->forge->createTable('ruang_prodi');
    }

    public function down()
    {
        $this->forge->dropTable('ruang_prodi');
    }
}
