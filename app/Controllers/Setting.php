<?php

namespace App\Controllers;

class Setting extends \CodeIgniter\Controller
{
    protected $settingModel;
    protected $mataKuliahModel;
    protected $historiPeminatModel;
    protected $jadwalDosenModel;
    protected $kelasModel;
    protected $pengampuModel;
    protected $jadwalModel;

    public function __construct()
    {
        if (!session()->has('id_user')) {
            session()->set('referred_from', current_url());
            session()->setFlashdata('error', 'Mohon login kembali !');

            header("Location: /login");
            exit();
        }

        $this->settingModel = new \App\Models\SettingModel();
        $this->mataKuliahModel = new \App\Models\MataKuliahModel();
        $this->historiPeminatModel = new \App\Models\HistoriPeminatModel();
        $this->jadwalDosenModel = new \App\Models\JadwalDosenModel();
        $this->kelasModel = new \App\Models\KelasModel();
        $this->pengampuModel = new \App\Models\PengampuModel();
        $this->jadwalModel = new \App\Models\JadwalModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Pengaturan GNA',
            'setting' => $this->settingModel->first(),
        ];

        return view('setting/index', $data);
    }

    public function update($id)
    {
        $this->settingModel->save([
            'id_setting' => $id,
            'tahun_akademik' => $this->request->getPost('tahun_akademik'),
            'paket_semester' => $this->request->getPost('paket_semester'),
            'learning_rate' => $this->request->getPost('learning_rate'),
            'epochs' => $this->request->getPost('epochs'),
            'momentum' => $this->request->getPost('momentum'),
            'threshold' => $this->request->getPost('threshold'),
            'min_peserta' => $this->request->getPost('min_peserta'),
            'max_peserta' => $this->request->getPost('max_peserta'),
            'populasi' => $this->request->getPost('populasi'),
            'generasi' => $this->request->getPost('generasi'),
            'crossover' => $this->request->getPost('crossover'),
            'mutasi' => $this->request->getPost('mutasi'),
        ]);

        return redirect()->to('setting')->with('success', 'Pengaturan berhasil disimpan !');
    }

    // Development Mode
    public function setDevelopment()
    {
        $this->historiPeminatModel->truncate();
        $this->jadwalDosenModel->truncate();
        $this->kelasModel->truncate();
        $this->pengampuModel->truncate();
        $this->jadwalModel->truncate();

        // Set Only IT Active Courses
        foreach ($this->mataKuliahModel->findAll() as $item) {
            $this->mataKuliahModel->save([
                'id_mata_kuliah' => $item['id_mata_kuliah'],
                'is_active' => false,
                'tahun_prediksi' => null,
                'prediksi_peminat' => null,
            ]);

            if ($item['id_prodi'] == 3) {
                $this->mataKuliahModel->save([
                    'id_mata_kuliah' => $item['id_mata_kuliah'],
                    'is_active' => true,
                    'tahun_prediksi' => null,
                    'prediksi_peminat' => null,
                ]);
            }
        }

        // Set Only 3 Classes
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

        return redirect()->to('setting')->with('success', 'Pengaturan berhasil disimpan !');
    }

    // Production Mode
    public function setProduction()
    {
        $this->historiPeminatModel->truncate();
        $this->jadwalDosenModel->truncate();
        $this->kelasModel->truncate();
        $this->pengampuModel->truncate();
        $this->jadwalModel->truncate();

        // Set All Active Courses
        foreach ($this->mataKuliahModel->findAll() as $item) {
            $this->mataKuliahModel->save([
                'id_mata_kuliah' => $item['id_mata_kuliah'],
                'is_active' => true,
                'tahun_prediksi' => null,
                'prediksi_peminat' => null,
            ]);
        }

        // Set 5 Classes
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

        return redirect()->to('setting')->with('success', 'Pengaturan berhasil disimpan !');
    }
}
