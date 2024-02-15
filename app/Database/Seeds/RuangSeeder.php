<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RuangSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'kode_ruang' => 'A.201',
                'nama_ruang' => 'Machdor A.201',
                'kapasitas' => 30,
            ],
            [
                'kode_ruang' => 'A.202',
                'nama_ruang' => 'Machdor A.202',
                'kapasitas' => 30,
            ],
            [
                'kode_ruang' => 'A.203',
                'nama_ruang' => 'Machdor A.203',
                'kapasitas' => 30,
            ],
            [
                'kode_ruang' => 'A.204',
                'nama_ruang' => 'Machdor A.204',
                'kapasitas' => 30,
            ],
            [
                'kode_ruang' => 'A.205',
                'nama_ruang' => 'Machdor A.205',
                'kapasitas' => 30,
            ],
            [
                'kode_ruang' => 'A.301',
                'nama_ruang' => 'Machdor A.301',
                'kapasitas' => 30,
            ],
            [
                'kode_ruang' => 'A.302',
                'nama_ruang' => 'Machdor A.302',
                'kapasitas' => 30,
            ],
            [
                'kode_ruang' => 'A.303',
                'nama_ruang' => 'Machdor A.303',
                'kapasitas' => 30,
            ],
            [
                'kode_ruang' => 'A.304',
                'nama_ruang' => 'Machdor A.304',
                'kapasitas' => 30,
            ],
            [
                'kode_ruang' => 'A.305',
                'nama_ruang' => 'Machdor A.305',
                'kapasitas' => 30,
            ],
            [
                'kode_ruang' => 'A.401',
                'nama_ruang' => 'Machdor A.401',
                'kapasitas' => 30,
            ],
            [
                'kode_ruang' => 'A.402',
                'nama_ruang' => 'Machdor A.402',
                'kapasitas' => 30,
            ],
            [
                'kode_ruang' => 'A.403',
                'nama_ruang' => 'Machdor A.403',
                'kapasitas' => 30,
            ],
            [
                'kode_ruang' => 'A.404',
                'nama_ruang' => 'Machdor A.404',
                'kapasitas' => 30,
            ],
            [
                'kode_ruang' => 'A.405',
                'nama_ruang' => 'Machdor A.405',
                'kapasitas' => 30,
            ],
            [
                'kode_ruang' => 'B.501',
                'nama_ruang' => 'Djuanda B.501',
                'kapasitas' => 30,
            ],
            [
                'kode_ruang' => 'B.502',
                'nama_ruang' => 'Djuanda B.502',
                'kapasitas' => 30,
            ],
            [
                'kode_ruang' => 'B.503',
                'nama_ruang' => 'Djuanda B.503',
                'kapasitas' => 30,
            ],
            [
                'kode_ruang' => 'B.504',
                'nama_ruang' => 'Djuanda B.504',
                'kapasitas' => 30,
            ],
            [
                'kode_ruang' => 'B.505',
                'nama_ruang' => 'Djuanda B.505',
                'kapasitas' => 30,
            ],
            [
                'kode_ruang' => 'B.601',
                'nama_ruang' => 'Djuanda B.601',
                'kapasitas' => 30,
            ],
            [
                'kode_ruang' => 'B.602',
                'nama_ruang' => 'Djuanda B.602',
                'kapasitas' => 30,
            ],
            [
                'kode_ruang' => 'B.603',
                'nama_ruang' => 'Djuanda B.603',
                'kapasitas' => 30,
            ],
            [
                'kode_ruang' => 'B.604',
                'nama_ruang' => 'Djuanda B.604',
                'kapasitas' => 30,
            ],
            [
                'kode_ruang' => 'B.605',
                'nama_ruang' => 'Djuanda B.605',
                'kapasitas' => 30,
            ],
        ];

        $this->db->table('ruang')->insertBatch($data);
    }
}
