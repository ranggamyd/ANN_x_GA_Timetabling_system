<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProdiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'kode_prodi' => 'C1A',
                'nama_prodi' => 'S1 Peternakan',
                'fakultas'   => 'Teknik',
            ],
            [
                'kode_prodi' => 'C1B',
                'nama_prodi' => 'S1 Teknik Industri',
                'fakultas'   => 'Teknik',
            ],
            [
                'kode_prodi' => 'C1C',
                'nama_prodi' => 'S1 Teknik Informatika',
                'fakultas'   => 'Teknik',
            ]
        ];

        $this->db->table('prodi')->insertBatch($data);
    }
}
