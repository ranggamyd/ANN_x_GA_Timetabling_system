<?php

namespace App\Controllers;

class Jadwal extends \CodeIgniter\Controller
{
    protected $prodiModel;
    protected $dosenModel;
    protected $mataKuliahModel;
    protected $kelasModel;
    protected $waktuModel;
    protected $jadwalDosenModel;
    protected $pengampuModel;
    protected $ruangModel;
    protected $ruangProdiModel;
    protected $settingModel;
    protected $jadwalModel;

    protected $algen;
    protected $geneticAlgorithm;

    public function __construct()
    {
        // if (!session()->has('id_user')) {
        //     session()->set('referred_from', current_url());
        //     session()->setFlashdata('error', 'Mohon login kembali !');

        //     header("Location: /login");
        //     exit();
        // }

        $this->prodiModel = new \App\Models\ProdiModel();
        $this->dosenModel = new \App\Models\DosenModel();
        $this->mataKuliahModel = new \App\Models\MataKuliahModel();
        $this->kelasModel = new \App\Models\KelasModel();
        $this->waktuModel = new \App\Models\WaktuModel();
        $this->jadwalDosenModel = new \App\Models\JadwalDosenModel();
        $this->pengampuModel = new \App\Models\PengampuModel();
        $this->ruangModel = new \App\Models\RuangModel();
        $this->ruangProdiModel = new \App\Models\RuangProdiModel();
        $this->settingModel = new \App\Models\SettingModel();
        $this->jadwalModel = new \App\Models\JadwalModel();

        $this->algen = new \App\Libraries\Genetic3();
        $this->geneticAlgorithm = new \App\Libraries\GeneticAlgorithm();
    }

    public function cekJadwalBentrok($jadwal)
    {
        // Inisialisasi array untuk menyimpan informasi jadwal yang bentrok
        $jadwalBentrok = [];

        // Loop untuk membandingkan setiap jadwal dengan yang lain
        for ($i = 0; $i < count($jadwal); $i++) {
            for ($j = $i + 1; $j < count($jadwal); $j++) {
                // Pengecekan aturan-aturan yang telah dijelaskan
                if ($this->isBentrokRuangan($jadwal[$i], $jadwal[$j])) {
                    $jadwalBentrok[] = [
                        $jadwal[$i],
                        $jadwal[$j],
                        'Bentrok Ruangan' => [
                            'Bentrok Ruangan pada ' . $jadwal[$i]['nama_ruang'] . ', Hari: ' . $jadwal[$i]['hari'] . ', Kelas: ' . $jadwal[$i]['nama_kelas'] . ', Jam: ' . $jadwal[$i]['jam_mulai'] . '-' . $jadwal[$i]['jam_selesai'],
                            'Bentrok Ruangan pada ' . $jadwal[$j]['nama_ruang'] . ', Hari: ' . $jadwal[$j]['hari'] . ', Kelas: ' . $jadwal[$j]['nama_kelas'] . ', Jam: ' . $jadwal[$j]['jam_mulai'] . '-' . $jadwal[$j]['jam_selesai'],
                        ]
                    ];
                }

                if ($this->isBentrokWaktuLibur($jadwal[$j])) {
                    $jadwalBentrok[] = [
                        $jadwal[$j],
                        'Bentrok Jadwal Dosen' => 'Dosen tidak dapat mengajar pada Hari: ' . $jadwal[$j]['hari'] . ', Kelas: ' . $jadwal[$j]['nama_kelas'] . ', Jam: ' . $jadwal[$j]['jam_mulai'] . '-' . $jadwal[$j]['jam_selesai'],
                    ];
                }
            }
        }

        return $jadwalBentrok;
    }

    private function isBentrokRuangan($jadwal1, $jadwal2)
    {
        if (
            $jadwal1['id_ruang'] == $jadwal2['id_ruang'] &&
            $jadwal1['hari'] == $jadwal2['hari'] &&
            ($jadwal1['jam_mulai'] >= $jadwal2['jam_mulai'] && $jadwal1['jam_mulai'] < $jadwal2['jam_selesai'] ||
                $jadwal2['jam_mulai'] >= $jadwal1['jam_mulai'] && $jadwal2['jam_mulai'] < $jadwal1['jam_selesai'])
        ) return true;

        return false;
    }

    private function isBentrokWaktuLibur($jadwal)
    {
        foreach ($this->jadwalDosenModel
            ->join('waktu', 'jadwal_dosen.id_waktu = waktu.id_waktu', 'left')->findAll() as $libur) {
            if (
                $jadwal['id_dosen'] == $libur['id_dosen'] &&
                $jadwal['hari'] == $libur['hari'] &&
                $jadwal['jam_mulai'] >= $libur['jam_mulai'] &&
                $jadwal['jam_selesai'] <= $libur['jam_selesai']
            ) return true;
        }

        return false;
    }

    public function index()
    {
        $id_prodi = $this->request->getGet('id_prodi');
        $semester = $this->request->getGet('semester');
        $kelas = $this->request->getGet('kelas');

        $filters = [];
        if (!empty($id_prodi)) $filters['mata_kuliah.id_prodi'] = $id_prodi;
        if (!empty($semester)) $filters['mata_kuliah.semester'] = $semester;
        if (!empty($kelas)) $filters['kelas.nama_kelas LIKE'] = '%' . $kelas . '%';

        // Mendapatkan jadwal dari database
        $jadwalList = $this->jadwalModel
            ->select('jadwal.*, kelas.*, mata_kuliah.*, prodi.*, dosen.*, ruang.*')
            ->select('waktu.hari, waktu.jam_mulai')
            ->where($filters)
            ->join('waktu', 'jadwal.id_waktu = waktu.id_waktu', 'left')
            ->join('kelas', 'jadwal.id_kelas = kelas.id_kelas', 'left')
            ->join('mata_kuliah', 'kelas.id_mata_kuliah = mata_kuliah.id_mata_kuliah', 'left')
            ->join('prodi', 'mata_kuliah.id_prodi = prodi.id_prodi', 'left')
            ->join('pengampu', 'kelas.id_kelas = pengampu.id_kelas', 'left')
            ->join('dosen', 'pengampu.id_dosen = dosen.id_dosen', 'left')
            ->join('ruang', 'jadwal.id_ruang = ruang.id_ruang', 'left')
            ->findAll();

        // dd($jadwalList);
        $jadwalBentrok = $this->cekJadwalBentrok($jadwalList);
        // dd($jadwalBentrok);

        $data = [
            'title' => 'Jadwal Kuliah',
            'setting' => $this->settingModel->first(),
            'jadwal' => $this->jadwalModel
                ->select('jadwal.*, kelas.*, mata_kuliah.*, prodi.*, ruang.*')
                ->select('waktu.hari, waktu.jam_mulai')
                ->where($filters)
                ->join('waktu', 'jadwal.id_waktu = waktu.id_waktu', 'left')
                ->join('kelas', 'jadwal.id_kelas = kelas.id_kelas', 'left')
                ->join('mata_kuliah', 'kelas.id_mata_kuliah = mata_kuliah.id_mata_kuliah', 'left')
                ->join('prodi', 'mata_kuliah.id_prodi = prodi.id_prodi', 'left')
                ->join('ruang', 'jadwal.id_ruang = ruang.id_ruang', 'left')
                ->findAll(),
            'prodi' => $this->prodiModel->orderBy('kode_prodi')->findAll(),
            'semester_list' => $this->jadwalModel
                ->select('semester')
                ->distinct('semester')
                ->join('kelas', 'jadwal.id_kelas = kelas.id_kelas', 'left')
                ->join('mata_kuliah', 'kelas.id_mata_kuliah = mata_kuliah.id_mata_kuliah', 'left')
                ->orderBy('semester')
                ->findAll(),
            'kelas_list' => $this->kelasModel->distinct()
                ->select('SUBSTRING(nama_kelas, 5, 2) as kelas')
                ->orderBy('kelas', 'ASC')
                ->findAll(),
            'id_prodi' => $id_prodi,
            'semester' => $semester,
            'kelas' => $kelas,
        ];

        return view('jadwal/index', $data);
    }

    public function timetable()
    {
        $id_prodi = $this->request->getGet('id_prodi');
        $semester = $this->request->getGet('semester');
        $kelas = $this->request->getGet('kelas');

        $filters = [];
        if (!empty($id_prodi)) $filters['mata_kuliah.id_prodi'] = $id_prodi;
        if (!empty($semester)) $filters['mata_kuliah.semester'] = $semester;
        if (!empty($kelas)) $filters['kelas.nama_kelas LIKE'] = '%' . $kelas . '%';

        $ruang = $this->ruangModel->orderBy('nama_ruang')->findAll();
        $waktu = $this->waktuModel->findAll();

        $jadwal = $this->jadwalModel
            ->select('jadwal.*, kelas.*, mata_kuliah.*, prodi.*, ruang.*')
            ->select('waktu.hari, waktu.jam_mulai')
            ->where($filters)
            ->join('waktu', 'jadwal.id_waktu = waktu.id_waktu', 'left')
            ->join('kelas', 'jadwal.id_kelas = kelas.id_kelas', 'left')
            ->join('mata_kuliah', 'kelas.id_mata_kuliah = mata_kuliah.id_mata_kuliah', 'left')
            ->join('pengampu', 'kelas.id_kelas = pengampu.id_kelas', 'left')
            ->join('dosen', 'pengampu.id_dosen = dosen.id_dosen', 'left')
            ->join('prodi', 'mata_kuliah.id_prodi = prodi.id_prodi', 'left')
            ->join('ruang', 'jadwal.id_ruang = ruang.id_ruang', 'left')
            ->findAll();

        $hari = ["Senin", "Selasa", "Rabu", "Kamis", "Jum'at"];

        $waktu_transform = [];
        foreach ($hari as $key => $value) {
            $waktu_transform[$key]['hari'] = $value;
            $waktu_transform[$key]['data'] = [];

            $jam_ke = 1;
            foreach ($waktu as $i => $item) {
                if ($value == $item['hari'] and $item['hari'] == "Jum'at" and $jam_ke == 5) $jam_ke = $jam_ke + 2;
                if ($value == $item['hari']) {
                    $item['jam_ke'] = $jam_ke++;
                    $waktu_transform[$key]['data'][] = $item;
                }
            }
        }

        $table_header = "<thead class='text-center' style='width: 100px'><tr><th class='bg-primary text-white text-uppercase' rowspan='2'>RUANG/WAKTU</th>";
        $table_header2 = "<tr>";

        foreach ($waktu_transform as $key => $value) {
            $hari = $value['hari'];
            $table_header .= "<th colspan='10' class='bg-primary text-white text-uppercase'><h2>$hari<h2></th>";

            foreach ($value['data'] as $i => $item) {
                $jam_ke = $item['jam_ke'];
                $table_header2 .= "<th class='bg-warning text-uppercase'>$jam_ke</th>";
            }
        }

        $table_header2 .= "</tr>";
        $table_header .= "</tr>$table_header2</thead>";
        $table_body = "<tbody>";

        foreach ($ruang as $key => $value) {
            $nama_ruang = $value['nama_ruang'];
            $table_body .= "<tr style='height: 80px'><th class='bg-light text-center'>$nama_ruang</th>";

            $period = 0;
            foreach ($waktu as $i => $time) {
                $colspan = '';
                $class = '';
                $label = '';
                if ($period == 0) {
                    foreach ($jadwal as $j => $item) {
                        $dosen = $this->pengampuModel->where('id_kelas', $item['id_kelas'])->join('dosen', 'dosen.id_dosen = pengampu.id_dosen')->first()['nama_dosen'];
                        if ($value['id_ruang'] == $item['id_ruang'] and $time['id_waktu'] == $item['id_waktu']) {
                            $colspan = $item['sks'];
                            $label = "<b>" . $item['nama_kelas'] . "</b><br>" .
                                "<p style='white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 300px; margin-bottom: 0;'>" . $item['nama_mata_kuliah'] . "</p>" .
                                "<span class='badge badge-warning'>" . $item['hari'] . ', ' . date('H:i', strtotime($item['jam_mulai'])) . '-' . date('H:i', strtotime($item['jam_selesai'])) . "</span>" .
                                "<span class='badge badge-info ml-1'>" . $item['semester'] . "</span>" .
                                "<span class='badge badge-success ml-1'>" . $dosen . "</span>";
                            $class = "bg-primary text-white";
                            $period = $item['sks'] - 1;
                        }
                    }

                    $table_body .= "<td class='$class' colspan='$colspan'>$label</td>";
                } else $period--;
            }

            $table_body .= "</tr>";
        }

        $table_body .= "</tbody>";

        $data = [
            'title' => 'Jadwal Kuliah',
            'setting' => $this->settingModel->first(),
            'table_header' => $table_header,
            'table_body' => $table_body,
            'prodi' => $this->prodiModel->orderBy('kode_prodi')->findAll(),
            'semester_list' => $this->jadwalModel
                ->select('semester')
                ->distinct('semester')
                ->join('kelas', 'jadwal.id_kelas = kelas.id_kelas', 'left')
                ->join('mata_kuliah', 'kelas.id_mata_kuliah = mata_kuliah.id_mata_kuliah', 'left')
                ->orderBy('semester')
                ->findAll(),
            'kelas_list' => $this->kelasModel->distinct()
                ->select('SUBSTRING(nama_kelas, 5, 2) as kelas')
                ->orderBy('kelas', 'ASC')
                ->findAll(),
            'id_prodi' => $id_prodi,
            'semester' => $semester,
            'kelas' => $kelas,
        ];

        return view('jadwal/timetable', $data);
    }

    public function generate()
    {
        $setting = $this->settingModel->first();

        $filters = [];
        if (!empty($setting['paket_semester'])) $filters['mata_kuliah.paket'] = $setting['paket_semester'];
        $filters['mata_kuliah.is_active'] = "t";

        $kelas = $this->kelasModel
            ->where($filters)
            ->join('mata_kuliah', 'kelas.id_mata_kuliah = mata_kuliah.id_mata_kuliah', 'left')
            ->join('prodi', 'mata_kuliah.id_prodi = prodi.id_prodi', 'left')
            ->join('pengampu', 'kelas.id_kelas = pengampu.id_kelas', 'left')
            ->join('dosen', 'pengampu.id_dosen = dosen.id_dosen', 'left')
            ->orderBy('kode_prodi')
            ->orderBy('semester')
            ->orderBy('kode_mata_kuliah')
            ->orderBy('nama_kelas')
            ->findAll();
        $ruang = $this->ruangModel->orderBy('nama_ruang')->findAll();
        $waktu = $this->waktuModel->findAll();
        $prodi = $this->prodiModel->orderBy('kode_prodi')->findAll();

        if (empty($kelas)) return redirect()->to('kelas')->with('error', 'Mohon bangkitkan kelas terlebih dahulu !');

        if (!empty($kelas) && !empty($ruang) && !empty($waktu)) {
            foreach ($kelas as $key => $value) {
                $pengampu = $this->pengampuModel->where('id_kelas', $value['id_kelas'])->first();
                if (!$pengampu) return redirect()->to('kelas')->with('error', 'Mohon isi pengampu untuk semua kelas !');

                $ruangProdi = $this->ruangProdiModel->where('id_prodi', $value['id_prodi'])->findAll();
                $kelas[$key]['ruang_prodi'] = $ruangProdi;

                $alternatif_waktu_ajar = $this->jadwalDosenModel->where('id_dosen', $value['id_dosen'])->findAll();
                $kelas[$key]['alternatif_waktu_ajar'] = $alternatif_waktu_ajar;
            }

            foreach ($ruang as $key => $value) {
                $ruangProdi = $this->ruangProdiModel->where('id_ruang', $value['id_ruang'])->findAll();
                $ruang[$key]['prodi'] = $ruangProdi;
            }

            echo "<b>== INISIALISASI ==</b><br>";
            $this->algen->initialize($prodi, $kelas, $ruang, $waktu, $setting);

            $generasi = $setting['generasi'];
            for ($i = 1; $i <= $generasi; $i++) {
                echo "<b>== GENERASI ($i/$generasi) ==</b><br>";
                $i == 1 ? $this->algen->generate_population() : $this->algen->update_population();

                echo "<b>== COUNT FITNESS ==</b>";
                $this->algen->count_fitness();

                echo "<b>== ROULETTE WHEEL SELECTION ==</b>";
                $this->algen->roulette_wheel_selection();

                echo "<b>== CROSSOVER ==</b>";
                $this->algen->crossover();

                echo "<b>== MUTATION ==</b>";
                $this->algen->mutation();

                echo "<b>== UPDATE SELECTION ==</b>";
                $this->algen->update_selection();
            }

            $solusi = $this->algen->get_solution();
            $solusi = $solusi['arr_gen'];

            usort(
                $solusi,
                function ($a, $b) {
                    $dayOrder = array('Senin', 'Selasa', 'Rabu', 'Kamis', "Jum'at");
                    $dayComparison = array_search($a['hari'], $dayOrder) - array_search($b['hari'], $dayOrder);
                    if ($dayComparison !== 0) return $dayComparison;

                    $timeComparison = strcmp($a['jam_mulai'], $b['jam_mulai']);
                    if ($timeComparison !== 0) return $timeComparison;

                    if ($a['id_ruang'] !== $b['id_ruang']) return $a['id_ruang'] - $b['id_ruang'];

                    return strcmp($a['nama_kelas'], $b['nama_kelas']);
                }
            );

            d($solusi);
        }

        $total_waktu = number_format((float)microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"], 2, ',', '');
        // dd('Jadwal kuliah berhasil disimpan ! Waktu pemrosesan <strong>' . $total_waktu . '</strong> detik.');

        if (!empty($solusi)) {
            $this->jadwalModel->truncate();

            foreach ($solusi as $a => $item) {
                $this->jadwalModel->save([
                    'id_waktu' => $item['id_waktu'],
                    'jam_selesai' => $item['jam_selesai'],
                    'id_kelas' => $item['id_kelas'],
                    'id_ruang' => $item['id_ruang'],
                ]);
            }
        }

        return redirect()->to('jadwal')->with('successWithTime', 'Jadwal kuliah berhasil disimpan ! Waktu pemrosesan <strong>' . $total_waktu . '</strong> detik.');
    }

    // public function generate()
    // {
    //     $setting = $this->settingModel->first();

    //     // $filters = [];
    //     // if (!empty($setting['paket_semester'])) $filters['mata_kuliah.paket'] = $setting['paket_semester'];
    //     // $filters['mata_kuliah.is_active'] = "t";

    //     $kelas = $this->kelasModel
    //         // ->where($filters)
    //         // ->join('mata_kuliah', 'kelas.id_mata_kuliah = mata_kuliah.id_mata_kuliah', 'left')
    //         // ->join('prodi', 'mata_kuliah.id_prodi = prodi.id_prodi', 'left')
    //         // ->join('pengampu', 'kelas.id_kelas = pengampu.id_kelas', 'left')
    //         // ->join('dosen', 'pengampu.id_dosen = dosen.id_dosen', 'left')
    //         // ->orderBy('kode_prodi')
    //         // ->orderBy('semester')
    //         // ->orderBy('kode_mata_kuliah')
    //         ->orderBy('nama_kelas')
    //         ->findAll();
    //     $ruang = $this->ruangModel->orderBy('nama_ruang')->findAll();
    //     $waktu = $this->waktuModel->findAll();
    //     $prodi = $this->prodiModel->orderBy('kode_prodi')->findAll();

    //     if (empty($kelas)) return redirect()->to('kelas')->with('error', 'Mohon bangkitkan kelas terlebih dahulu !');

    //     if (!empty($kelas) && !empty($ruang) && !empty($waktu)) {
    //         foreach ($kelas as $key => $value) {
    //             $mataKuliah = $this->mataKuliahModel->where('id_mata_kuliah', $value['id_mata_kuliah'])->first();
    //             $kelas[$key]['mata_kuliah'] = $mataKuliah;

    //             $pengampu = $this->pengampuModel->where('id_kelas', $value['id_kelas'])->first();
    //             $dosen = $this->dosenModel->where('id_dosen', $pengampu['id_dosen'])->first();
    //             $jadwal_libur_dosen = $this->jadwalDosenModel->where('id_dosen', $dosen['id_dosen'])->findAll();
    //             $pengampu['dosen'] = $dosen;
    //             $pengampu['dosen']['jadwal_libur_dosen'] = $jadwal_libur_dosen;
    //             $kelas[$key]['pengampu'] = $pengampu;
    //         }

    //         foreach ($ruang as $key => $value) {
    //             $ruangProdi = $this->ruangProdiModel->where('id_ruang', $value['id_ruang'])->findAll();
    //             $ruang[$key]['ruang_prodi'] = $ruangProdi;
    //         }

    //         echo "<b>== INISIALISASI ==</b><br>";
    //         $this->geneticAlgorithm->initialize($prodi, $kelas, $ruang, $waktu, $setting);
    //     }
    // }
}
