<?php

namespace App\Libraries;

class GeneticAlgorithm
{
    private $prodi;
    private $kelas;
    private $ruang;
    private $waktu;
    private $setting;
    private $populasi = [];

    public function initialize($prodi, $kelas, $ruang, $waktu, $setting)
    {
        $this->prodi = $prodi;
        $this->kelas = $kelas;
        $this->ruang = $ruang;
        $this->waktu = $waktu;
        $this->setting = $setting;

        // Inisialisasi populasi
        for ($i = 0; $i < $this->setting['populasi']; $i++) {
            $individu = $this->generateIndividual();
            $this->populasi[] = $individu;
        }

        d($this->prodi);
        d($this->kelas);
        d($this->ruang);
        d($this->waktu);
        d($this->setting);
        dd($this->populasi);

        return $this->populasi;
    }

    public function run()
    {
        for ($generasi = 1; $generasi <= $setting['generasi']; $generasi++) {
            $populasi = $this->selection($populasi);
            $populasi = $this->crossover($populasi, $setting['crossover']);
            $populasi = $this->mutation($populasi, $setting['mutasi']);
            $this->evaluate($populasi, $kelas, $ruang, $waktu);
        }

        return $this->getBestSchedule($populasi);
    }

    private function generateIndividual()
    {
        $individu = [];

        foreach ($this->kelas as $kelas) {
            $waktuRandom = $this->selectRandomTime($individu, $kelas);
            $ruangRandom = $this->selectRandomRoom($waktuRandom, $kelas);

            $individu[] = [
                'kelas_id'   => $kelas['id_kelas'],
                'ruang_id'   => $ruangRandom['id_ruang'],
                'waktu_id'   => $waktuRandom['id_waktu'],
                'jam_selesai' => $waktuRandom['jam_selesai']
            ];
        }

        return $individu;
    }

    private function selectRandomTime($individu, $kelas)
    {
        $waktuTersedia = $this->getAvailableTimesForClass($individu, $kelas);

        $waktuRandom = $waktuTersedia[array_rand($waktuTersedia)];

        while (!$this->checkTimeConstraints($waktuRandom, $individu, $kelas)) {
            $waktuRandom = $waktuTersedia[array_rand($waktuTersedia)];
        }

        $jam_mulai = strtotime($waktuRandom['jam_mulai']);
        $durasi = $kelas['mata_kuliah']['sks'] * 50;
        $jam_selesai = date('H:i:s', strtotime('+' . $durasi . ' minutes', $jam_mulai));

        $waktuRandom['jam_selesai'] = $jam_selesai;

        return $waktuRandom;
    }

    private function getAvailableTimesForClass($individu, $kelas)
    {
        $waktuTersedia = [];

        foreach ($this->waktu as $waktu) {
            $isWaktuTersedia = true;

            foreach ($individu as $jadwal) {
                if (
                    $waktu['id_waktu'] == $jadwal['id_waktu'] &&
                    $jadwal['id_kelas'] != $kelas['id_kelas']
                ) {
                    $isWaktuTersedia = false;
                    break;
                }
            }

            if ($isWaktuTersedia) $waktuTersedia[] = $waktu;
        }

        return $waktuTersedia;
    }

    private function selectRandomRoom($waktuRandom, $kelas)
    {
        $ruangRandom = array_rand($this->ruang);

        while (!$this->checkRoomConstraints($ruangRandom, $waktuRandom, $kelas)) {
            $ruangRandom = array_rand($this->ruang);
        }

        return $this->ruang[$ruangRandom];
    }

    private function checkTimeConstraints($waktu, $jadwalIndividu, $kelas)
    {
        // // 1. Pastikan waktu sesuai dengan durasi 07.30-17.20 dengan 10 sesi per hari
        // if ($waktu['jam_mulai'] < 7 || ($waktu['jam_mulai'] == 17 && $waktu['jam_selesai'] > 20)) {
        //     return false;
        // }

        // // 2. Tidak ada kelas pada hari Jumat 11.30-13.00
        // if ($waktu['hari'] == 'Jumat' && ($waktu['jam_mulai'] <= 13 && $waktu['jam_selesai'] >= 11.5)) {
        //     return false;
        // }

        // 3. Mata kuliah dengan semester yang sama dapat dipilih oleh mahasiswa tanpa bentrok waktu
        foreach ($jadwalIndividu as $jadwal) {
            if ($jadwal['kelas_id'] != $kelas['id_kelas']) continue;

            $waktuKonflik = $this->getWaktuById($jadwal['waktu_id']);

            if (
                $waktuKonflik['hari'] == $waktu['hari'] &&
                ($waktu['jam_mulai'] < $waktuKonflik['jam_selesai'] && $waktu['jam_selesai'] > $waktuKonflik['jam_mulai'])
            ) return false;
        }

        // 4. Setiap dosen mengajar satu kelas pada satu waktu
        $dosenId = $this->getDosenByKelasId($kelas['id_kelas']);
        foreach ($jadwalIndividu as $jadwal) {
            $dosenKonflik = $this->getDosenByKelasId($jadwal['kelas_id']);
            if ($dosenKonflik == $dosenId && $waktu['hari'] == $this->getWaktuById($jadwal['waktu_id'])['hari']) return false;
        }

        // 5. Mata kuliah wajib pada semester dan program studi yang sama tidak dijadwalkan secara bersamaan.
        foreach ($jadwalIndividu as $jadwal) {
            $kelasKonflik = $this->getKelasById($jadwal['kelas_id']);
            if ($kelasKonflik['id_prodi'] == $kelas['id_prodi'] && $kelasKonflik['semester'] == $kelas['semester']) return false;
        }

        return true;
    }

    private function checkRoomConstraints($ruang, $waktu, $kelas)
    {
        // // 1. Ruang kelas diisi dengan jumlah yang mencapai kapasitas ruang
        // $jumlahPesertaKelas = $kelas['peserta'];
        // if ($ruang['kapasitas'] < $jumlahPesertaKelas) {
        //     return false;
        // }

        // 2. Jadwal kelas mata kuliah disesuaikan dengan rekomendasi waktu dosen untuk ketersediaan mengajar
        $dosenId = $this->getDosenByKelasId($kelas['id_kelas']);
        $dosenJadwalKetidakbersediaan = $this->getJadwalKetidakbersediaanDosen($dosenId);

        foreach ($dosenJadwalKetidakbersediaan as $jadwalKetidakbersediaan) {
            if ($jadwalKetidakbersediaan['waktu_id'] == $waktu['id_waktu']) return false;
        }

        // 3. Kelas mata kuliah diadakan sesuai dengan ruang yang tersedia untuk program studi.
        $ruangProdi = $this->getRuangProdiByRuangId($ruang);
        if ($ruangProdi['id_prodi'] != $kelas['mata_kuliah']['id_prodi']) return false;

        // // 4. Maksimal 8 SKS kelas mata kuliah pada semester yang sama dijadwalkan dalam sehari
        // $totalSKS = $this->getTotalSKSByHari($waktu['hari'], $jadwalIndividu, $kelas);
        // if ($totalSKS + $kelas['sks'] > 8) {
        //     return false;
        // }

        // // 5. Mata kuliah wajib dan pilihan tidak dijadwalkan pada waktu yang sama
        // foreach ($jadwalIndividu as $jadwal) {
        //     $kelasKonflik = $this->getKelasById($jadwal['kelas_id']);
        //     if ($kelasKonflik['sifat'] != $kelas['sifat'] && $waktu['hari'] == $this->getWaktuById($jadwal['waktu_id'])['hari']) {
        //         return false;
        //     }
        // }

        return true;
    }

    // Fungsi untuk mendapatkan waktu berdasarkan ID
    private function getWaktuById($waktuId)
    {
        foreach ($this->waktu as $waktu) {
            if ($waktu['id_waktu'] == $waktuId) return $waktu;
        }

        return null; // Return null jika tidak ditemukan kelas dengan ID yang sesuai
    }


    // Fungsi untuk mendapatkan ID dosen berdasarkan ID kelas
    private function getDosenByKelasId($kelasId)
    {
        foreach ($this->kelas as $kelas) {
            if ($kelas['id_kelas'] == $kelasId) {
                // Dapatkan ID dosen dari data kelas
                // $idDosen = $kelas['pengampu']['dosen']['id_dosen'];
                return $kelas['pengampu']['dosen']['id_dosen'];

                // // Temukan data dosen berdasarkan ID
                // foreach ($this->dosenData as $dosen) {
                //     if ($dosen['id_dosen'] == $idDosen) {
                //         return $dosen;
                //     }
                // }
            }
        }

        return null; // Return null jika tidak ditemukan dosen dengan ID yang sesuai
    }
    // Fungsi untuk mendapatkan jadwal ketidakbersediaan dosen
    private function getJadwalKetidakbersediaanDosen($dosenId)
    {
        $result = [];

        foreach ($this->kelas as $kelas) {
            if (isset($kelas['pengampu']['dosen']['id_dosen']) && $kelas['pengampu']['dosen']['id_dosen'] == $dosenId) {
                // Temukan jadwal ketidakbersediaan dosen dari atribut kelas
                foreach ($kelas['pengampu']['dosen']['jadwal_libur_dosen'] as $jadwalDosen) {
                    // Dapatkan informasi waktu dan tambahkan ke hasil
                    $waktuId = $jadwalDosen['id_waktu'];
                    $result[] = [
                        'id_dosen' => $dosenId,
                        'id_waktu' => $waktuId,
                        // ... (tambahkan atribut-atribut lain yang mungkin Anda butuhkan)
                    ];
                }
            }
        }

        return $result;
    }

    // Fungsi untuk mendapatkan ruang prodi berdasarkan ID ruang
    private function getRuangProdiByRuangId($ruangId)
    {
        foreach ($this->ruang as $ruang) {
            if ($ruang['id_ruang'] == $ruangId) {
                // Temukan informasi prodi-prodi yang terkait dengan ID ruang
                $ruangProdiIds = array_column($ruang['ruang_prodi'], 'id_prodi');

                // Cari data prodi yang sesuai berdasarkan ID prodi
                $prodi = [];
                foreach ($ruangProdiIds as $prodiId) {
                    foreach ($this->prodi as $prodi) {
                        if ($prodi['id_prodi'] == $prodiId) {
                            $prodi[] = $prodi;
                        }
                    }
                }

                return $prodi;
            }
        }

        return null; // Return null jika tidak ditemukan informasi ruang prodi dengan ID yang sesuai
    }

    // // Fungsi untuk mendapatkan total SKS pada hari tertentu
    // private function getTotalSKSByHari($hari, $jadwalIndividu, $kelas)
    // {
    //     $totalSKS = 0;

    //     foreach ($jadwalIndividu as $jadwal) {
    //         $waktu = $this->getWaktuById($jadwal['waktu_id']);
    //         $kelasKonflik = $this->getKelasById($jadwal['kelas_id']);

    //         if ($waktu['hari'] == $hari && $kelasKonflik['semester'] == $kelas['semester']) {
    //             $totalSKS += $kelasKonflik['sks'];
    //         }
    //     }

    //     return $totalSKS;
    // }

    // Fungsi untuk mendapatkan kelas berdasarkan ID
    private function getKelasById($kelasId)
    {
        foreach ($this->kelas as $kelas) {
            if ($kelas['id_kelas'] == $kelasId) return $kelas;
        }

        return null; // Return null jika tidak ditemukan kelas dengan ID yang sesuai
    }

    // Metode Roulette Wheel Selection
    private function selection($populasi)
    {
        $totalFitness = array_sum(array_column($populasi, 'fitness'));
        $seleksi = [];

        // Pilih individu dengan probabilitas proporsional terhadap nilai fitness
        for ($i = 0; $i < count($populasi); $i++) {
            $random = mt_rand(0, $totalFitness);
            $akumulasiFitness = 0;

            foreach ($populasi as $individu) {
                $akumulasiFitness += $individu['fitness'];

                if ($akumulasiFitness >= $random) {
                    $seleksi[] = $individu;
                    break;
                }
            }
        }

        return $seleksi;
    }

    private function crossover($populasi)
    {
        $jumlahIndividu = count($populasi);
        $jumlahPasangan = floor($jumlahIndividu / 2);
        $offspring = [];

        for ($i = 0; $i < $jumlahPasangan; $i++) {
            // Cek apakah akan dilakukan crossover berdasarkan probabilitas
            if (mt_rand(0, 100) < ($this->setting['crossover'] * 100)) {
                // Pilih dua orang tua secara acak
                $parent1 = $populasi[mt_rand(0, $jumlahIndividu - 1)];
                $parent2 = $populasi[mt_rand(0, $jumlahIndividu - 1)];

                // Pilih dua titik crossover (n = 2)
                $titikCrossover1 = mt_rand(1, min(count($parent1['gen']), count($parent2['gen'])) - 1);
                $titikCrossover2 = mt_rand($titikCrossover1 + 1, min(count($parent1['gen']), count($parent2['gen'])));

                // Lakukan crossover
                $child1['gen'] = array_merge(
                    array_slice($parent1['gen'], 0, $titikCrossover1),
                    array_slice($parent2['gen'], $titikCrossover1, $titikCrossover2 - $titikCrossover1),
                    array_slice($parent1['gen'], $titikCrossover2)
                );

                $child2['gen'] = array_merge(
                    array_slice($parent2['gen'], 0, $titikCrossover1),
                    array_slice($parent1['gen'], $titikCrossover1, $titikCrossover2 - $titikCrossover1),
                    array_slice($parent2['gen'], $titikCrossover2)
                );

                // Tambahkan anak-anak ke offspring
                $offspring[] = $child1;
                $offspring[] = $child2;
            } else {
                // Jika tidak dilakukan crossover, tambahkan orang tua langsung ke offspring
                $offspring[] = $populasi[2 * $i];
                $offspring[] = $populasi[2 * $i + 1];
            }
        }

        return $offspring;
    }

    private function mutation($populasi)
    {
        $jumlahIndividu = count($populasi);
        $mutasi = [];

        for ($i = 0; $i < $jumlahIndividu; $i++) {
            // Cek apakah akan dilakukan mutasi berdasarkan probabilitas
            if (mt_rand(0, 100) < ($this->setting['mutasi'] * 100)) {
                // Pilih individu untuk dimutasi
                $individu = $populasi[$i];

                // Pilih satu gen secara acak untuk dimutasi
                $genIndex = mt_rand(0, count($individu['gen']) - 1);

                // Pilih kelas yang sesuai dengan gen yang dipilih
                $kelas = $this->getKelasById($individu['gen'][$genIndex]);

                // Pilih waktu dan ruang secara acak untuk mutasi
                $waktuRandom = $this->selectRandomTime($individu, $kelas);
                $ruangRandom = $this->selectRandomRoom($waktuRandom, $kelas);

                // Update gen yang dipilih dengan waktu dan ruang yang baru
                $individu['gen'][$genIndex] = $waktuRandom['id_waktu'];

                // Tambahkan individu yang telah dimutasi ke array mutasi
                $mutasi[] = $individu;
            } else {
                // Jika tidak dilakukan mutasi, tambahkan individu langsung ke array mutasi
                $mutasi[] = $populasi[$i];
            }
        }

        return $mutasi;
    }

    private function evaluate($populasi, $kelas, $ruang, $waktu)
    {
        foreach ($populasi as &$jadwalIndividu) {
            // Implementasi evaluasi penjadwalan
            // Hitung fitness berdasarkan konflik jadwal, preferensi, dll.
            $fitness = $this->calculateFitness($jadwalIndividu, $kelas, $ruang, $waktu);

            // Simpan nilai fitness ke dalam individu jadwal
            $jadwalIndividu['fitness'] = $fitness;
        }
    }

    private function calculateFitness($jadwalIndividu, $kelas, $ruang, $waktu)
    {
        // Implementasi perhitungan fitness
        // Misalnya, kurangi nilai fitness jika terdapat konflik jadwal atau melanggar preferensi
    }

    private function getBestSchedule($populasi)
    {
        // Implementasi untuk mendapatkan jadwal terbaik berdasarkan nilai fitness
        // Misalnya, pilih individu dengan nilai fitness tertinggi
    }
}
