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
            ],
            [
                'nidn' => '0421117105',
                'nama_dosen' => 'Dian Novianti, M.Kom',
            ],
            [
                'nidn' => '428117601',
                'nama_dosen' => 'Dr. Wahyu Triono, M.MPd',
            ],
            [
                'nidn' => '0402057307',
                'nama_dosen' => 'Freddy Wicaksono, M.Kom',
            ],
            [
                'nidn' => '0408118304',
                'nama_dosen' => 'Harry Gunawan,S.Kom,M.Kom',
            ],
            [
                'nidn' => '0403079201',
                'nama_dosen' => 'Lia Farhatuaini,S.Kom,M.Cs',
            ],
            [
                'nidn' => '406067407',
                'nama_dosen' => 'Maksudi, M.T',
            ],
            [
                'nidn' => '0412068907',
                'nama_dosen' => 'Muhamad Imam, M.Kom',
            ],
            [
                'nidn' => null,
                'nama_dosen' => 'Pahla W.M.Kom',
            ],
            [
                'nidn' => null,
                'nama_dosen' => 'Suhana Minah Jaya, M.T',
            ],
            [
                'nidn' => '0017057402',
                'nama_dosen' => 'Supriyono, M.Cs',
            ],
            [
                'nidn' => '0407039501',
                'nama_dosen' => 'Vega Purwayoga,S.Kom,M.Kom',
            ],
            [
                'nidn' => '424038902',
                'nama_dosen' => 'Deni, M.Si',
            ],
            [
                'nidn' => '0425036001',
                'nama_dosen' => 'Iskandar, M.Kom',
            ],
            [
                'nidn' => '0405108905',
                'nama_dosen' => 'Sokid,MT',
            ],
            [
                'nidn' => '0423047203',
                'nama_dosen' => 'Nuri Kartini, M.T.,IPM.,AER',
            ],
            [
                'nidn' => '0431038001',
                'nama_dosen' => 'Arie Susetio Utami, S.Si, MT.',
            ],
            [
                'nidn' => '0412027702',
                'nama_dosen' => 'Arif Nurudin, MT',
            ],
            [
                'nidn' => "0418108101",
                'nama_dosen' => 'Budi Susanto, M.Sc',
            ],
            [
                'nidn' => null,
                'nama_dosen' => 'Een Nur Aeni, ST, ME.',
            ],
            [
                'nidn' => '0424047503',
                'nama_dosen' => 'Johan,MT',
            ],
            [
                'nidn' => '0428107102',
                'nama_dosen' => 'Hisyam Hermawan, S.SiT. MM.',
            ],
            [
                'nidn' => '0427117602',
                'nama_dosen' => 'M. Nana Trisolvena, MT',
            ],
            [
                'nidn' => '0423038206',
                'nama_dosen' => 'Tri Budi Prasetyo, ST, M.Si',
            ],
            [
                'nidn' => '0413078901',
                'nama_dosen' => 'Bastoni, M.Sc.',
            ],
            [
                'nidn' => '404038802',
                'nama_dosen' => 'Bayu Arisandi, MP',
            ],
            [
                'nidn' => '0427118303',
                'nama_dosen' => 'Dien Iftitah, M.Si',
            ],
            [
                'nidn' => '0004076001',
                'nama_dosen' => 'Dr. Ir. Devi Yuliananda MS',
            ],
            [
                'nidn' => '0421078204',
                'nama_dosen' => 'Fitri Dian Perwitasari, M.Si',
            ],
            [
                'nidn' => '0421056402',
                'nama_dosen' => 'Ir. Mus Nilamcaya, MP',
            ],
            [
                'nidn' => "0022076301",
                'nama_dosen' => 'Prof. Dr. Drh. Retno Widyani, MS., MH',
            ],
        ];

        $this->db->table('dosen')->insertBatch($data);
    }
}
