<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DosenSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nidn' => '0416086408',
                'nama_dosen' => 'Agust Isa Martinus, MT',
                'id_prodi' => 3
            ],
            [
                'nidn' => '0421117105',
                'nama_dosen' => 'Dian Novianti, M.Kom',
                'id_prodi' => 3
            ],
            [
                'nidn' => '428117601',
                'nama_dosen' => 'Dr. Wahyu Triono, M.MPd',
                'id_prodi' => 3
            ],
            [
                'nidn' => '0402057307',
                'nama_dosen' => 'Freddy Wicaksono, M.Kom',
                'id_prodi' => 3
            ],
            [
                'nidn' => '0408118304',
                'nama_dosen' => 'Harry Gunawan,S.Kom,M.Kom',
                'id_prodi' => 3
            ],
            [
                'nidn' => '0403079201',
                'nama_dosen' => 'Lia Farhatuaini,S.Kom,M.Cs',
                'id_prodi' => 3
            ],
            [
                'nidn' => '406067407',
                'nama_dosen' => 'Maksudi, M.T',
                'id_prodi' => 3
            ],
            [
                'nidn' => '0412068907',
                'nama_dosen' => 'Muhamad Imam, M.Kom',
                'id_prodi' => 3
            ],
            [
                'nidn' => null,
                'nama_dosen' => 'Pahla W.M.Kom',
                'id_prodi' => 3
            ],
            [
                'nidn' => null,
                'nama_dosen' => 'Suhana Minah Jaya, M.T',
                'id_prodi' => 3
            ],
            [
                'nidn' => '0017057402',
                'nama_dosen' => 'Supriyono, M.Cs',
                'id_prodi' => 3
            ],
            [
                'nidn' => '0407039501',
                'nama_dosen' => 'Vega Purwayoga,S.Kom,M.Kom',
                'id_prodi' => 3
            ],
            [
                'nidn' => '424038902',
                'nama_dosen' => 'Deni, M.Si',
                'id_prodi' => 3
            ],
            [
                'nidn' => '0425036001',
                'nama_dosen' => 'Iskandar, M.Kom',
                'id_prodi' => 3
            ],
            [
                'nidn' => '0405108905',
                'nama_dosen' => 'Sokid,MT',
                'id_prodi' => 3
            ],
            [
                'nidn' => '0423047203',
                'nama_dosen' => 'Nuri Kartini, M.T.,IPM.,AER',
                'id_prodi' => 3
            ],
            [
                'nidn' => '0431038001',
                'nama_dosen' => 'Arie Susetio Utami, S.Si, MT.',
                'id_prodi' => 3
            ],
            [
                'nidn' => '0412027702',
                'nama_dosen' => 'Arif Nurudin, MT',
                'id_prodi' => 2
            ],
            [
                'nidn' => "0418108101",
                'nama_dosen' => 'Budi Susanto, M.Sc',
                'id_prodi' => 2
            ],
            [
                'nidn' => null,
                'nama_dosen' => 'Een Nur Aeni, ST, ME.',
                'id_prodi' => 2
            ],
            [
                'nidn' => '0424047503',
                'nama_dosen' => 'Johan,MT',
                'id_prodi' => 2
            ],
            [
                'nidn' => '0428107102',
                'nama_dosen' => 'Hisyam Hermawan, S.SiT. MM.',
                'id_prodi' => 2
            ],
            [
                'nidn' => '0427117602',
                'nama_dosen' => 'M. Nana Trisolvena, MT',
                'id_prodi' => 2
            ],
            [
                'nidn' => '0423038206',
                'nama_dosen' => 'Tri Budi Prasetyo, ST, M.Si',
                'id_prodi' => 2
            ],
            [
                'nidn' => '0413078901',
                'nama_dosen' => 'Bastoni, M.Sc.',
                'id_prodi' => 1
            ],
            [
                'nidn' => '404038802',
                'nama_dosen' => 'Bayu Arisandi, MP',
                'id_prodi' => 1
            ],
            [
                'nidn' => '0427118303',
                'nama_dosen' => 'Dien Iftitah, M.Si',
                'id_prodi' => 1
            ],
            [
                'nidn' => '0004076001',
                'nama_dosen' => 'Dr. Ir. Devi Yuliananda MS',
                'id_prodi' => 1
            ],
            [
                'nidn' => '0421078204',
                'nama_dosen' => 'Fitri Dian Perwitasari, M.Si',
                'id_prodi' => 1
            ],
            [
                'nidn' => '0421056402',
                'nama_dosen' => 'Ir. Mus Nilamcaya, MP',
                'id_prodi' => 1
            ],
            [
                'nidn' => "0022076301",
                'nama_dosen' => 'Prof. Dr. Drh. Retno Widyani, MS., MH',
                'id_prodi' => 1
            ],
        ];

        $this->db->table('dosen')->insertBatch($data);
    }
}
