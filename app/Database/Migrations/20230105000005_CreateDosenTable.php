<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDosenTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_dosen' => [
                'type'           => 'SERIAL',
                // 'constraint'     => 11,
                'auto_increment' => true,
            ],
            'nidn' => [
                'type'       => 'VARCHAR',
                'constraint' => '18',
                'null'       => true,
            ],
            'nama_dosen' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'no_hp' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'id_prodi' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            // 'id_user' => [
            //     'type'       => 'INT',
            //     'constraint' => 11,
            //     'null'       => true,
            // ],
        ]);

        $this->forge->addPrimaryKey('id_dosen');
        // $this->forge->addForeignKey('id_user', 'user', 'id_user');
        $this->forge->createTable('dosen');
    }

    public function down()
    {
        $this->forge->dropTable('dosen');
    }
}
