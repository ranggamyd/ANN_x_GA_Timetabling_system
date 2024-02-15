<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProdiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_prodi' => [
                'type'           => 'SERIAL',
                // 'constraint'     => 11,
                'auto_increment' => true,
            ],
            'kode_prodi' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'nama_prodi' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'fakultas' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'deskripsi' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id_prodi');
        $this->forge->createTable('prodi');
    }

    public function down()
    {
        $this->forge->dropTable('prodi');
    }
}
