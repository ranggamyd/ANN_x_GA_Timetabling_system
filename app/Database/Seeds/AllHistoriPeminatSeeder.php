<?php

namespace App\Database\Seeds;

use App\Models\MataKuliahModel;

use CodeIgniter\Database\Seeder;

class AllHistoriPeminatSeeder extends Seeder
{
    public function run()
    {
        $mata_kuliah = new MataKuliahModel();
        $data = [];
        foreach ($mata_kuliah->findAll() as $item) {
            for ($i = 2018; $i <= 2023; $i++) {
                $data[] = [
                    'id_mata_kuliah' => $item['id_mata_kuliah'],
                    'tahun' => $i,
                    'jumlah_peminat' => mt_rand(60, 90),
                ];
            }
        }

        $this->db->table('histori_peminat')->insertBatch($data);
    }
}
