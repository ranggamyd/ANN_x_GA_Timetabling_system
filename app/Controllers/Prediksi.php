<?php

namespace App\Controllers;

class Prediksi extends \CodeIgniter\Controller
{
    protected $prodiModel;
    protected $mataKuliahModel;
    protected $historiPeminatModel;
    protected $settingModel;
    protected $prediksiModel;

    protected $backpropagation;

    public function __construct()
    {
        if (!session()->has('id_user')) {
            session()->set('referred_from', current_url());
            session()->setFlashdata('error', 'Mohon login kembali !');

            header("Location: /login");
            exit();
        }

        $this->prodiModel = new \App\Models\ProdiModel();
        $this->mataKuliahModel = new \App\Models\MataKuliahModel();
        $this->historiPeminatModel = new \App\Models\HistoriPeminatModel();
        $this->settingModel = new \App\Models\SettingModel();
        $this->prediksiModel = new \App\Models\PrediksiModel();

        $this->backpropagation = new \App\Libraries\Backpropagation();
    }

    public function index()
    {
        $setting = $this->settingModel->first();

        $filters = [];
        if (!empty($setting['paket_semester'])) $filters['mata_kuliah.paket'] = $setting['paket_semester'];
        $filters['mata_kuliah.is_active'] = "t";

        $data = [
            'title' => 'Prediksi Peserta',
            'setting' => $setting,
            'mata_kuliah' => $this->mataKuliahModel
                ->where($filters)
                ->join('prodi', 'mata_kuliah.id_prodi = prodi.id_prodi', 'left')
                ->orderBy('kode_prodi')
                ->orderBy('semester')
                ->orderBy('kode_mata_kuliah')
                ->findAll(),
        ];

        return view('prediksi/index', $data);
    }

    public function rekap()
    {
        $setting = $this->settingModel->first();

        $filters = [];
        if (!empty($setting['paket_semester'])) $filters['mata_kuliah.paket'] = $setting['paket_semester'];
        $filters['mata_kuliah.is_active'] = "t";

        $tahun = [];
        $a = $this->historiPeminatModel->select('MIN(tahun)')->first();
        $b = $this->historiPeminatModel->select('MAX(tahun)')->first();
        for ($i = $a['min']; $i <= $b['max']; $i++) {
            $tahun[] = $a['min']++;
        };

        sort($tahun);

        $data = [
            'title' => 'Rekap Mata Kuliah',
            'setting' => $setting,
            'mata_kuliah' => $this->mataKuliahModel
                ->where($filters)
                ->join('prodi', 'mata_kuliah.id_prodi = prodi.id_prodi', 'left')
                ->orderBy('kode_prodi')
                ->orderBy('semester')
                ->orderBy('kode_mata_kuliah')
                ->findAll(),
            'tahun' => $tahun,
            'prodi' => $this->prodiModel->orderBy('kode_prodi')->findAll()
        ];

        return view('prediksi/rekap', $data);
    }

    public function prediksi()
    {
        $setting = $this->settingModel->first();

        $filters = [];
        if (!empty($setting['paket_semester'])) $filters['mata_kuliah.paket'] = $setting['paket_semester'];
        $filters['mata_kuliah.is_active'] = "t";

        $tahun = [];
        for ($i = 1; $i <= 3; $i++) {
            $tahun[] = $setting['tahun_akademik'] - $i;
        };

        sort($tahun);

        $data = [
            'title' => 'Prediksi Peserta',
            'setting' => $setting,
            'mata_kuliah' => $this->mataKuliahModel
                ->where($filters)
                ->join('prodi', 'mata_kuliah.id_prodi = prodi.id_prodi', 'left')
                ->orderBy('kode_prodi')
                ->orderBy('semester')
                ->orderBy('kode_mata_kuliah')
                ->findAll(),
            'tahun' => $tahun,
            'prodi' => $this->prodiModel->orderBy('kode_prodi')->findAll()
        ];

        return view('prediksi/prediksi', $data);
    }

    public function lakukan_prediksi()
    {
        foreach ($this->request->getPost('jumlah_peminat') as $id_mata_kuliah => $tahun) {
            foreach ($tahun as $t => $jumlah_peminat) {
                if (!empty($this->historiPeminatModel->where(['id_mata_kuliah' => $id_mata_kuliah, 'tahun' => $t])->first())) {
                    $this->historiPeminatModel->where(['id_mata_kuliah' => $id_mata_kuliah, 'tahun' => $t])->set(['jumlah_peminat' => $jumlah_peminat])->update();
                } else {
                    $this->historiPeminatModel->save([
                        'id_mata_kuliah' => $id_mata_kuliah,
                        'tahun' => $t,
                        'jumlah_peminat' => $jumlah_peminat
                    ]);
                }
            }
        }

        $setting = $this->settingModel->first();

        $layer_formation = explode('-', '3-3-1');
        $numLayers = count($layer_formation);
        $jml_unit_in = $layer_formation[0];
        $jml_unit_out = $layer_formation[($numLayers - 1)];
        $length_input_data_train = $jml_unit_in + $jml_unit_out;

        $periode_tahun_prediksi = 6;

        $filters = [];
        if (!empty($setting['paket_semester'])) $filters['mata_kuliah.paket'] = $setting['paket_semester'];
        $filters['mata_kuliah.is_active'] = "t";

        $mkk = $this->mataKuliahModel
            ->where($filters)
            ->join('prodi', 'mata_kuliah.id_prodi = prodi.id_prodi', 'left')
            ->orderBy('kode_prodi')
            ->orderBy('semester')
            ->orderBy('kode_mata_kuliah')
            ->findAll();

        foreach ($mkk as $key => $value) {
            $rekap_makul[$key] = $this->prediksiModel->get_recap_by_id($value['id_mata_kuliah']);
            $i = 0;

            for ($i = 0; $i < $periode_tahun_prediksi; $i++) {
                if ($i + ($length_input_data_train - 1) < $periode_tahun_prediksi) {
                    for ($j = $i; $j <= $i + ($length_input_data_train - 1); $j++) {
                        $max_lokal = $rekap_makul[$key][$j]['max_lokal']; //peminat terbanyak
                        $min_lokal = $rekap_makul[$key][$j]['min_lokal']; //peminat terendah
                        $data_raw[$key][$i][] = $rekap_makul[$key][$j]['jml_peminat'];
                        $data[$key][$i][] = $rekap_makul[$key][$j]['interpolasi_0']; //mengenali pola
                    }
                }
            }

            for ($k = ($periode_tahun_prediksi - $jml_unit_in); $k < $periode_tahun_prediksi; $k++) {
                $testDataUji[$key][] = $rekap_makul[$key][$k]['jml_peminat'];
            }

            $arrData[] = [
                'id' => $value['id_mata_kuliah'],
                'kode' => $value['kode_mata_kuliah'],
                'nama' => $value['nama_mata_kuliah'],
                'dataTrain' => $data_raw[$key],
                'dataTestUji' => [$testDataUji[$key]],
                'max_lokal' => $max_lokal,
                'min_lokal' => $min_lokal
            ];
        }

        foreach ($arrData as $a => $item) {
            foreach ($item['dataTrain'] as $b => $itemm) {
                for ($i = 0; $i < count($itemm) - 1; $i++) {
                    $arrData[$a]['dataTest'][$b][] = $itemm[$i];
                }
            }
        }

        $return = [];
        $maxmin = $this->prediksiModel->get_maxmin_jml_peminat_recap();
        if (!empty($arrData)) {
            foreach ($arrData as $key => $value) {
                $this->backpropagation->set($numLayers, $layer_formation, $setting['learning_rate'], $setting['momentum'], $maxmin[0]['mins'], $maxmin[0]['maks'], $setting['epochs'], $setting['threshold']);

                $this->backpropagation->createWeight();

                $result = $this->backpropagation->run($value);

                $return[] = $result;
            }
        }

        if (!empty($return)) {
            foreach ($return as $key => $value) {
                $this->mataKuliahModel->save([
                    'id_mata_kuliah' => $value['id'],
                    'tahun_prediksi' => $setting['tahun_akademik'],
                    'prediksi_peminat' => $value['hasil_prediksi'],
                ]);
            }
        }

        $total_waktu = number_format((float)microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"], 2, ',', '');

        return redirect()->to('prediksi')->with('successWithTime', 'Peminat berhasil diprediksi ! Waktu pemrosesan <strong>' . $total_waktu . '</strong> detik.');
    }

    public function set3Kelas()
    {
        $this->historiPeminatModel->truncate();

        $data = [];
        foreach ($this->mataKuliahModel->findAll() as $item) {
            for ($i = 2018; $i <= 2023; $i++) {
                $data[] = [
                    'id_mata_kuliah' => $item['id_mata_kuliah'],
                    'tahun' => $i,
                    'jumlah_peminat' => mt_rand(60, 90),
                ];
            }
        }

        $this->historiPeminatModel->insertBatch($data);

        return redirect()->to('prediksi/prediksi')->with('success', 'Histori peminat berhasil diperbarui !');
    }

    public function set5Kelas()
    {
        $this->historiPeminatModel->truncate();

        $data = [];
        foreach ($this->mataKuliahModel->findAll() as $item) {
            for ($i = 2018; $i <= 2023; $i++) {
                $data[] = [
                    'id_mata_kuliah' => $item['id_mata_kuliah'],
                    'tahun' => $i,
                    'jumlah_peminat' => mt_rand(120, 150),
                ];
            }
        }

        $this->historiPeminatModel->insertBatch($data);

        return redirect()->to('prediksi/prediksi')->with('success', 'Histori peminat berhasil diperbarui !');
    }
}
