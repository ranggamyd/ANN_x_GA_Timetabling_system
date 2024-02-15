<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSettingTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_setting' => [
                'type'           => 'SERIAL',
                // 'constraint'     => 11,
                'auto_increment' => true,
            ],
            'tahun_akademik' => [
                'type'       => 'INT',
                'constraint' => '4',
            ],
            'paket_semester' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'default'    => 'Genap',
            ],
            'learning_rate' => [
                'type'       => 'DECIMAL',
            ],
            'epochs' => [
                'type'       => 'DECIMAL',
            ],
            'momentum' => [
                'type'       => 'DECIMAL',
            ],
            'threshold' => [
                'type'       => 'DECIMAL',
            ],
            'min_peserta' => [
                'type'       => 'INT',
            ],
            'max_peserta' => [
                'type'       => 'INT',
            ],
            'populasi' => [
                'type'       => 'INT',
            ],
            'generasi' => [
                'type'       => 'INT',
            ],
            'crossover' => [
                'type'       => 'DECIMAL',
            ],
            'mutasi' => [
                'type'       => 'DECIMAL',
            ],
        ]);

        $this->forge->addPrimaryKey('id_setting');
        $this->forge->createTable('setting');
    }

    public function down()
    {
        $this->forge->dropTable('setting');
    }
}
