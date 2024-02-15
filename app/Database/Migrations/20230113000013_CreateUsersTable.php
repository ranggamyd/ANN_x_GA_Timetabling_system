<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user' => [
                'type' => 'SERIAL',
                // 'constraint' => 11,
                'auto_increment' => true,
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'avatar' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'default' => 'default_avatar.jpg',
            ],
            'role' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
                'default' => 'Administrator',
            ],
        ]);

        $this->forge->addKey('id_user', true);
        $this->forge->createTable('users', true);
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
