<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AngkatanProdiSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        for ($p = 1; $p <= 3; $p++) {
            for ($t = 2017; $t <= 2022; $t++) {
                $data[] =
                    [
                        'id_prodi' => $p,
                        'tahun' => $t,
                        'jumlah_mahasiswa' => mt_rand(80, 150),
                    ];
            }
        };

        $this->db->table('angkatan_prodi')->insertBatch($data);
    }
}
