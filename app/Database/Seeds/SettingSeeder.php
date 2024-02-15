<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'tahun_akademik' => '2024',
                'paket_semester' => 'Genap',
                'learning_rate' => 0.7,
                'epochs' => 1000000,
                'momentum' => 0.1,
                'threshold' => 0.0000001,
                'min_peserta' => 5,
                'max_peserta' => 30,
                'populasi' => 30,
                'generasi' => 10,
                'crossover' => 0.6,
                'mutasi' => 0.4,
            ],
        ];

        $this->db->table('setting')->insertBatch($data);
    }
}
