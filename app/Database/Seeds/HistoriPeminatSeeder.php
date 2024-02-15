<?php

namespace App\Database\Seeds;

use App\Models\ProdiModel;
use App\Models\MataKuliahModel;
use App\Models\AngkatanProdiModel;

use CodeIgniter\Database\Seeder;

class HistoriPeminatSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_mata_kuliah' => 1,
                'jumlah_peminat' => 273,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 1,
                'jumlah_peminat' => 362,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 1,
                'jumlah_peminat' => 240,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 1,
                'jumlah_peminat' => 716,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 1,
                'jumlah_peminat' => 678,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 1,
                'jumlah_peminat' => 528,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 2,
                'jumlah_peminat' => 0,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 2,
                'jumlah_peminat' => 0,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 2,
                'jumlah_peminat' => 0,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 2,
                'jumlah_peminat' => 98,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 2,
                'jumlah_peminat' => 210,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 2,
                'jumlah_peminat' => 196,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 3,
                'jumlah_peminat' => 83,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 3,
                'jumlah_peminat' => 119,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 3,
                'jumlah_peminat' => 104,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 3,
                'jumlah_peminat' => 79,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 3,
                'jumlah_peminat' => 89,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 3,
                'jumlah_peminat' => 120,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 4,
                'jumlah_peminat' => 107,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 4,
                'jumlah_peminat' => 66,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 4,
                'jumlah_peminat' => 72,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 4,
                'jumlah_peminat' => 89,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 4,
                'jumlah_peminat' => 101,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 4,
                'jumlah_peminat' => 95,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 5,
                'jumlah_peminat' => 60,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 5,
                'jumlah_peminat' => 85,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 5,
                'jumlah_peminat' => 100,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 5,
                'jumlah_peminat' => 69,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 5,
                'jumlah_peminat' => 63,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 5,
                'jumlah_peminat' => 89,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 6,
                'jumlah_peminat' => 94,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 6,
                'jumlah_peminat' => 61,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 6,
                'jumlah_peminat' => 78,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 6,
                'jumlah_peminat' => 101,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 6,
                'jumlah_peminat' => 107,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 6,
                'jumlah_peminat' => 119,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 7,
                'jumlah_peminat' => 62,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 7,
                'jumlah_peminat' => 66,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 7,
                'jumlah_peminat' => 111,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 7,
                'jumlah_peminat' => 88,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 7,
                'jumlah_peminat' => 80,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 7,
                'jumlah_peminat' => 113,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 8,
                'jumlah_peminat' => 110,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 8,
                'jumlah_peminat' => 100,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 8,
                'jumlah_peminat' => 104,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 8,
                'jumlah_peminat' => 95,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 8,
                'jumlah_peminat' => 77,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 8,
                'jumlah_peminat' => 76,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 9,
                'jumlah_peminat' => 90,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 9,
                'jumlah_peminat' => 86,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 9,
                'jumlah_peminat' => 96,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 9,
                'jumlah_peminat' => 116,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 9,
                'jumlah_peminat' => 118,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 9,
                'jumlah_peminat' => 88,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 10,
                'jumlah_peminat' => 82,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 10,
                'jumlah_peminat' => 73,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 10,
                'jumlah_peminat' => 69,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 10,
                'jumlah_peminat' => 63,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 10,
                'jumlah_peminat' => 106,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 10,
                'jumlah_peminat' => 73,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 11,
                'jumlah_peminat' => 77,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 11,
                'jumlah_peminat' => 74,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 11,
                'jumlah_peminat' => 108,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 11,
                'jumlah_peminat' => 60,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 11,
                'jumlah_peminat' => 92,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 11,
                'jumlah_peminat' => 70,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 12,
                'jumlah_peminat' => 73,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 12,
                'jumlah_peminat' => 116,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 12,
                'jumlah_peminat' => 95,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 12,
                'jumlah_peminat' => 103,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 12,
                'jumlah_peminat' => 78,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 12,
                'jumlah_peminat' => 69,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 13,
                'jumlah_peminat' => 66,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 13,
                'jumlah_peminat' => 63,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 13,
                'jumlah_peminat' => 76,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 13,
                'jumlah_peminat' => 83,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 13,
                'jumlah_peminat' => 91,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 13,
                'jumlah_peminat' => 77,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 14,
                'jumlah_peminat' => 82,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 14,
                'jumlah_peminat' => 60,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 14,
                'jumlah_peminat' => 93,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 14,
                'jumlah_peminat' => 79,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 14,
                'jumlah_peminat' => 94,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 14,
                'jumlah_peminat' => 91,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 15,
                'jumlah_peminat' => 81,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 15,
                'jumlah_peminat' => 97,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 15,
                'jumlah_peminat' => 63,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 15,
                'jumlah_peminat' => 105,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 15,
                'jumlah_peminat' => 67,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 15,
                'jumlah_peminat' => 114,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 16,
                'jumlah_peminat' => 99,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 16,
                'jumlah_peminat' => 94,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 16,
                'jumlah_peminat' => 83,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 16,
                'jumlah_peminat' => 105,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 16,
                'jumlah_peminat' => 106,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 16,
                'jumlah_peminat' => 89,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 17,
                'jumlah_peminat' => 83,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 17,
                'jumlah_peminat' => 71,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 17,
                'jumlah_peminat' => 88,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 17,
                'jumlah_peminat' => 61,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 17,
                'jumlah_peminat' => 64,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 17,
                'jumlah_peminat' => 98,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 18,
                'jumlah_peminat' => 67,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 18,
                'jumlah_peminat' => 66,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 18,
                'jumlah_peminat' => 98,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 18,
                'jumlah_peminat' => 86,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 18,
                'jumlah_peminat' => 85,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 18,
                'jumlah_peminat' => 75,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 19,
                'jumlah_peminat' => 96,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 19,
                'jumlah_peminat' => 101,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 19,
                'jumlah_peminat' => 111,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 19,
                'jumlah_peminat' => 67,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 19,
                'jumlah_peminat' => 101,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 19,
                'jumlah_peminat' => 113,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 20,
                'jumlah_peminat' => 82,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 20,
                'jumlah_peminat' => 97,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 20,
                'jumlah_peminat' => 108,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 20,
                'jumlah_peminat' => 66,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 20,
                'jumlah_peminat' => 116,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 20,
                'jumlah_peminat' => 95,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 21,
                'jumlah_peminat' => 100,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 21,
                'jumlah_peminat' => 118,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 21,
                'jumlah_peminat' => 109,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 21,
                'jumlah_peminat' => 89,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 21,
                'jumlah_peminat' => 84,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 21,
                'jumlah_peminat' => 77,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 22,
                'jumlah_peminat' => 87,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 22,
                'jumlah_peminat' => 103,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 22,
                'jumlah_peminat' => 115,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 22,
                'jumlah_peminat' => 106,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 22,
                'jumlah_peminat' => 118,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 22,
                'jumlah_peminat' => 65,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 23,
                'jumlah_peminat' => 88,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 23,
                'jumlah_peminat' => 94,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 23,
                'jumlah_peminat' => 82,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 23,
                'jumlah_peminat' => 97,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 23,
                'jumlah_peminat' => 93,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 23,
                'jumlah_peminat' => 78,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 24,
                'jumlah_peminat' => 77,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 24,
                'jumlah_peminat' => 95,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 24,
                'jumlah_peminat' => 89,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 24,
                'jumlah_peminat' => 78,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 24,
                'jumlah_peminat' => 117,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 24,
                'jumlah_peminat' => 117,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 25,
                'jumlah_peminat' => 76,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 25,
                'jumlah_peminat' => 102,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 25,
                'jumlah_peminat' => 113,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 25,
                'jumlah_peminat' => 73,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 25,
                'jumlah_peminat' => 105,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 25,
                'jumlah_peminat' => 96,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 26,
                'jumlah_peminat' => 83,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 26,
                'jumlah_peminat' => 107,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 26,
                'jumlah_peminat' => 76,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 26,
                'jumlah_peminat' => 112,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 26,
                'jumlah_peminat' => 111,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 26,
                'jumlah_peminat' => 107,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 27,
                'jumlah_peminat' => 91,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 27,
                'jumlah_peminat' => 91,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 27,
                'jumlah_peminat' => 91,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 27,
                'jumlah_peminat' => 97,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 27,
                'jumlah_peminat' => 112,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 27,
                'jumlah_peminat' => 104,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 28,
                'jumlah_peminat' => 112,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 28,
                'jumlah_peminat' => 82,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 28,
                'jumlah_peminat' => 103,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 28,
                'jumlah_peminat' => 73,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 28,
                'jumlah_peminat' => 104,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 28,
                'jumlah_peminat' => 73,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 29,
                'jumlah_peminat' => 71,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 29,
                'jumlah_peminat' => 87,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 29,
                'jumlah_peminat' => 82,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 29,
                'jumlah_peminat' => 86,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 29,
                'jumlah_peminat' => 61,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 29,
                'jumlah_peminat' => 64,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 30,
                'jumlah_peminat' => 107,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 30,
                'jumlah_peminat' => 117,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 30,
                'jumlah_peminat' => 83,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 30,
                'jumlah_peminat' => 99,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 30,
                'jumlah_peminat' => 81,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 30,
                'jumlah_peminat' => 73,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 31,
                'jumlah_peminat' => 82,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 31,
                'jumlah_peminat' => 89,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 31,
                'jumlah_peminat' => 103,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 31,
                'jumlah_peminat' => 102,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 31,
                'jumlah_peminat' => 72,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 31,
                'jumlah_peminat' => 117,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 32,
                'jumlah_peminat' => 120,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 32,
                'jumlah_peminat' => 66,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 32,
                'jumlah_peminat' => 73,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 32,
                'jumlah_peminat' => 67,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 32,
                'jumlah_peminat' => 71,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 32,
                'jumlah_peminat' => 92,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 33,
                'jumlah_peminat' => 85,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 33,
                'jumlah_peminat' => 102,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 33,
                'jumlah_peminat' => 117,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 33,
                'jumlah_peminat' => 68,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 33,
                'jumlah_peminat' => 94,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 33,
                'jumlah_peminat' => 80,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 34,
                'jumlah_peminat' => 93,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 34,
                'jumlah_peminat' => 100,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 34,
                'jumlah_peminat' => 118,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 34,
                'jumlah_peminat' => 118,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 34,
                'jumlah_peminat' => 103,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 34,
                'jumlah_peminat' => 115,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 35,
                'jumlah_peminat' => 116,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 35,
                'jumlah_peminat' => 61,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 35,
                'jumlah_peminat' => 100,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 35,
                'jumlah_peminat' => 107,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 35,
                'jumlah_peminat' => 87,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 35,
                'jumlah_peminat' => 99,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 36,
                'jumlah_peminat' => 69,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 36,
                'jumlah_peminat' => 99,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 36,
                'jumlah_peminat' => 77,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 36,
                'jumlah_peminat' => 96,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 36,
                'jumlah_peminat' => 108,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 36,
                'jumlah_peminat' => 77,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 37,
                'jumlah_peminat' => 99,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 37,
                'jumlah_peminat' => 102,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 37,
                'jumlah_peminat' => 117,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 37,
                'jumlah_peminat' => 120,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 37,
                'jumlah_peminat' => 82,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 37,
                'jumlah_peminat' => 80,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 38,
                'jumlah_peminat' => 111,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 38,
                'jumlah_peminat' => 68,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 38,
                'jumlah_peminat' => 60,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 38,
                'jumlah_peminat' => 120,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 38,
                'jumlah_peminat' => 92,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 38,
                'jumlah_peminat' => 77,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 39,
                'jumlah_peminat' => 62,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 39,
                'jumlah_peminat' => 69,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 39,
                'jumlah_peminat' => 85,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 39,
                'jumlah_peminat' => 95,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 39,
                'jumlah_peminat' => 63,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 39,
                'jumlah_peminat' => 108,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 40,
                'jumlah_peminat' => 60,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 40,
                'jumlah_peminat' => 113,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 40,
                'jumlah_peminat' => 73,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 40,
                'jumlah_peminat' => 70,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 40,
                'jumlah_peminat' => 86,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 40,
                'jumlah_peminat' => 99,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 41,
                'jumlah_peminat' => 87,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 41,
                'jumlah_peminat' => 101,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 41,
                'jumlah_peminat' => 113,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 41,
                'jumlah_peminat' => 90,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 41,
                'jumlah_peminat' => 77,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 41,
                'jumlah_peminat' => 119,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 42,
                'jumlah_peminat' => 74,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 42,
                'jumlah_peminat' => 89,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 42,
                'jumlah_peminat' => 79,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 42,
                'jumlah_peminat' => 93,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 42,
                'jumlah_peminat' => 63,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 42,
                'jumlah_peminat' => 66,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 43,
                'jumlah_peminat' => 71,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 43,
                'jumlah_peminat' => 108,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 43,
                'jumlah_peminat' => 82,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 43,
                'jumlah_peminat' => 96,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 43,
                'jumlah_peminat' => 69,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 43,
                'jumlah_peminat' => 115,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 44,
                'jumlah_peminat' => 100,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 44,
                'jumlah_peminat' => 81,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 44,
                'jumlah_peminat' => 87,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 44,
                'jumlah_peminat' => 71,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 44,
                'jumlah_peminat' => 85,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 44,
                'jumlah_peminat' => 77,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 45,
                'jumlah_peminat' => 71,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 45,
                'jumlah_peminat' => 108,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 45,
                'jumlah_peminat' => 114,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 45,
                'jumlah_peminat' => 62,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 45,
                'jumlah_peminat' => 107,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 45,
                'jumlah_peminat' => 99,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 46,
                'jumlah_peminat' => 62,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 46,
                'jumlah_peminat' => 85,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 46,
                'jumlah_peminat' => 83,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 46,
                'jumlah_peminat' => 113,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 46,
                'jumlah_peminat' => 69,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 46,
                'jumlah_peminat' => 67,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 47,
                'jumlah_peminat' => 69,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 47,
                'jumlah_peminat' => 83,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 47,
                'jumlah_peminat' => 77,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 47,
                'jumlah_peminat' => 119,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 47,
                'jumlah_peminat' => 70,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 47,
                'jumlah_peminat' => 94,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 48,
                'jumlah_peminat' => 72,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 48,
                'jumlah_peminat' => 105,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 48,
                'jumlah_peminat' => 60,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 48,
                'jumlah_peminat' => 66,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 48,
                'jumlah_peminat' => 89,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 48,
                'jumlah_peminat' => 108,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 49,
                'jumlah_peminat' => 68,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 49,
                'jumlah_peminat' => 109,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 49,
                'jumlah_peminat' => 99,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 49,
                'jumlah_peminat' => 84,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 49,
                'jumlah_peminat' => 69,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 49,
                'jumlah_peminat' => 65,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 50,
                'jumlah_peminat' => 102,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 50,
                'jumlah_peminat' => 114,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 50,
                'jumlah_peminat' => 81,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 50,
                'jumlah_peminat' => 95,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 50,
                'jumlah_peminat' => 83,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 50,
                'jumlah_peminat' => 92,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 51,
                'jumlah_peminat' => 68,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 51,
                'jumlah_peminat' => 87,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 51,
                'jumlah_peminat' => 97,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 51,
                'jumlah_peminat' => 69,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 51,
                'jumlah_peminat' => 80,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 51,
                'jumlah_peminat' => 76,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 52,
                'jumlah_peminat' => 109,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 52,
                'jumlah_peminat' => 74,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 52,
                'jumlah_peminat' => 92,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 52,
                'jumlah_peminat' => 95,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 52,
                'jumlah_peminat' => 69,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 52,
                'jumlah_peminat' => 71,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 53,
                'jumlah_peminat' => 66,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 53,
                'jumlah_peminat' => 61,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 53,
                'jumlah_peminat' => 73,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 53,
                'jumlah_peminat' => 96,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 53,
                'jumlah_peminat' => 114,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 53,
                'jumlah_peminat' => 94,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 54,
                'jumlah_peminat' => 90,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 54,
                'jumlah_peminat' => 62,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 54,
                'jumlah_peminat' => 92,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 54,
                'jumlah_peminat' => 73,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 54,
                'jumlah_peminat' => 100,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 54,
                'jumlah_peminat' => 67,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 55,
                'jumlah_peminat' => 71,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 55,
                'jumlah_peminat' => 112,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 55,
                'jumlah_peminat' => 76,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 55,
                'jumlah_peminat' => 109,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 55,
                'jumlah_peminat' => 99,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 55,
                'jumlah_peminat' => 81,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 56,
                'jumlah_peminat' => 99,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 56,
                'jumlah_peminat' => 120,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 56,
                'jumlah_peminat' => 80,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 56,
                'jumlah_peminat' => 79,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 56,
                'jumlah_peminat' => 80,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 56,
                'jumlah_peminat' => 79,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 57,
                'jumlah_peminat' => 115,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 57,
                'jumlah_peminat' => 95,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 57,
                'jumlah_peminat' => 99,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 57,
                'jumlah_peminat' => 80,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 57,
                'jumlah_peminat' => 62,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 57,
                'jumlah_peminat' => 116,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 58,
                'jumlah_peminat' => 85,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 58,
                'jumlah_peminat' => 98,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 58,
                'jumlah_peminat' => 60,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 58,
                'jumlah_peminat' => 60,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 58,
                'jumlah_peminat' => 91,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 58,
                'jumlah_peminat' => 118,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 59,
                'jumlah_peminat' => 106,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 59,
                'jumlah_peminat' => 117,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 59,
                'jumlah_peminat' => 67,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 59,
                'jumlah_peminat' => 84,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 59,
                'jumlah_peminat' => 80,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 59,
                'jumlah_peminat' => 67,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 60,
                'jumlah_peminat' => 84,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 60,
                'jumlah_peminat' => 119,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 60,
                'jumlah_peminat' => 83,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 60,
                'jumlah_peminat' => 105,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 60,
                'jumlah_peminat' => 80,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 60,
                'jumlah_peminat' => 69,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 61,
                'jumlah_peminat' => 60,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 61,
                'jumlah_peminat' => 92,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 61,
                'jumlah_peminat' => 85,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 61,
                'jumlah_peminat' => 76,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 61,
                'jumlah_peminat' => 113,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 61,
                'jumlah_peminat' => 79,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 62,
                'jumlah_peminat' => 107,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 62,
                'jumlah_peminat' => 66,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 62,
                'jumlah_peminat' => 99,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 62,
                'jumlah_peminat' => 118,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 62,
                'jumlah_peminat' => 93,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 62,
                'jumlah_peminat' => 98,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 63,
                'jumlah_peminat' => 120,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 63,
                'jumlah_peminat' => 104,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 63,
                'jumlah_peminat' => 89,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 63,
                'jumlah_peminat' => 78,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 63,
                'jumlah_peminat' => 103,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 63,
                'jumlah_peminat' => 106,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 64,
                'jumlah_peminat' => 61,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 64,
                'jumlah_peminat' => 114,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 64,
                'jumlah_peminat' => 66,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 64,
                'jumlah_peminat' => 95,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 64,
                'jumlah_peminat' => 77,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 64,
                'jumlah_peminat' => 85,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 65,
                'jumlah_peminat' => 67,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 65,
                'jumlah_peminat' => 103,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 65,
                'jumlah_peminat' => 101,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 65,
                'jumlah_peminat' => 106,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 65,
                'jumlah_peminat' => 116,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 65,
                'jumlah_peminat' => 81,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 66,
                'jumlah_peminat' => 67,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 66,
                'jumlah_peminat' => 103,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 66,
                'jumlah_peminat' => 100,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 66,
                'jumlah_peminat' => 64,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 66,
                'jumlah_peminat' => 107,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 66,
                'jumlah_peminat' => 113,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 67,
                'jumlah_peminat' => 94,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 67,
                'jumlah_peminat' => 62,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 67,
                'jumlah_peminat' => 112,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 67,
                'jumlah_peminat' => 94,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 67,
                'jumlah_peminat' => 64,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 67,
                'jumlah_peminat' => 99,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 68,
                'jumlah_peminat' => 80,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 68,
                'jumlah_peminat' => 61,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 68,
                'jumlah_peminat' => 71,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 68,
                'jumlah_peminat' => 99,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 68,
                'jumlah_peminat' => 60,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 68,
                'jumlah_peminat' => 65,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 69,
                'jumlah_peminat' => 61,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 69,
                'jumlah_peminat' => 65,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 69,
                'jumlah_peminat' => 77,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 69,
                'jumlah_peminat' => 120,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 69,
                'jumlah_peminat' => 97,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 69,
                'jumlah_peminat' => 67,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 70,
                'jumlah_peminat' => 95,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 70,
                'jumlah_peminat' => 120,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 70,
                'jumlah_peminat' => 102,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 70,
                'jumlah_peminat' => 80,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 70,
                'jumlah_peminat' => 117,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 70,
                'jumlah_peminat' => 87,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 71,
                'jumlah_peminat' => 113,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 71,
                'jumlah_peminat' => 118,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 71,
                'jumlah_peminat' => 96,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 71,
                'jumlah_peminat' => 89,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 71,
                'jumlah_peminat' => 63,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 71,
                'jumlah_peminat' => 80,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 72,
                'jumlah_peminat' => 93,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 72,
                'jumlah_peminat' => 69,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 72,
                'jumlah_peminat' => 65,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 72,
                'jumlah_peminat' => 111,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 72,
                'jumlah_peminat' => 88,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 72,
                'jumlah_peminat' => 76,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 73,
                'jumlah_peminat' => 90,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 73,
                'jumlah_peminat' => 87,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 73,
                'jumlah_peminat' => 105,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 73,
                'jumlah_peminat' => 92,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 73,
                'jumlah_peminat' => 110,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 73,
                'jumlah_peminat' => 69,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 74,
                'jumlah_peminat' => 77,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 74,
                'jumlah_peminat' => 79,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 74,
                'jumlah_peminat' => 70,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 74,
                'jumlah_peminat' => 69,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 74,
                'jumlah_peminat' => 103,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 74,
                'jumlah_peminat' => 98,
                'tahun' => 2023
            ],
            [
                'id_mata_kuliah' => 75,
                'jumlah_peminat' => 75,
                'tahun' => 2018
            ],
            [
                'id_mata_kuliah' => 75,
                'jumlah_peminat' => 60,
                'tahun' => 2019
            ],
            [
                'id_mata_kuliah' => 75,
                'jumlah_peminat' => 108,
                'tahun' => 2020
            ],
            [
                'id_mata_kuliah' => 75,
                'jumlah_peminat' => 93,
                'tahun' => 2021
            ],
            [
                'id_mata_kuliah' => 75,
                'jumlah_peminat' => 113,
                'tahun' => 2022
            ],
            [
                'id_mata_kuliah' => 75,
                'jumlah_peminat' => 64,
                'tahun' => 2023
            ]
        ];

        // $dataWithPercentage = $this->count_percentage($data);
        // $mata_kuliah = new MataKuliahModel();
        // $data = [];
        // foreach ($mata_kuliah->findAll() as $item) {
        //     for ($i = 2018; $i <= 2023; $i++) {
        //         $data[] = [
        //             'id_mata_kuliah' => $item['id_mata_kuliah'],
        //             'tahun' => $i,
        //             'jumlah_peminat' => mt_rand(77, 128),
        //         ];
        //     }
        // }

        $this->db->table('histori_peminat')->insertBatch($data);
    }

    // private function count_percentage($data)
    // {
    //     $mataKuliahModel = new MataKuliahModel();
    //     $angkatanProdiModel = new AngkatanProdiModel();

    //     $mata_kuliah = $mataKuliahModel->findAll();
    //     $angkatan_prodi = $angkatanProdiModel->findAll();

    //     foreach ($data as &$item) {
    //         $mk = array_filter($mata_kuliah, function ($mk) use ($item) {
    //             return $mk['id_mata_kuliah'] == $item['id_mata_kuliah'];
    //         });

    //         $mk = reset($mk);
    //         $id_prodi = $mk['id_prodi'];
    //         $ap = array_filter($angkatan_prodi, function ($ap) use ($id_prodi, $item) {
    //             return $ap['id_prodi'] == $id_prodi && $ap['tahun'] == $item['tahun'];
    //         });

    //         if (!empty($ap)) {
    //             $ap = reset($ap);
    //             $item['persentase'] = ($item['jumlah_peminat'] / $ap['jumlah_mahasiswa']) * 100;
    //         } else {
    //             $item['persentase'] = 0;
    //         }
    //     }

    //     return $data;
    // }
}
