<?php

namespace App\Database\Seeds;

use App\Models\ProdiModel;
use App\Models\RuangModel;
use App\Models\RuangProdiModel;

use CodeIgniter\Database\Seeder;

class RuangProdiSeeder extends Seeder
{
    public function run()
    {

        $prodi = new ProdiModel();
        $ruang = new RuangModel();
        $ruangProdi = new RuangProdiModel();

        $ruangProdi->truncate();

        $data = [];
        foreach ($prodi->findAll() as $p) {
            foreach ($ruang->findAll() as $r) {
                $data[] = [
                    'id_prodi' => $p['id_prodi'],
                    'id_ruang' => $r['id_ruang'],
                ];
            }
        }

        $ruangProdi->insertBatch($data);

        for ($i = 1; $i <= 5; $i++) {
            $ruangProdi->where(['id_prodi' => 1, 'id_ruang' => $i + 10])->delete();
            $ruangProdi->where(['id_prodi' => 2, 'id_ruang' => $i + 5])->delete();
            $ruangProdi->where(['id_prodi' => 3, 'id_ruang' => $i])->delete();
        }
    }
}
