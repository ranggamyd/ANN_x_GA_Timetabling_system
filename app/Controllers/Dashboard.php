<?php

namespace App\Controllers;

class Dashboard extends \CodeIgniter\Controller
{
    protected $prodiModel;
    protected $mataKuliahModel;
    protected $dosenModel;
    protected $ruangModel;
    protected $settingModel;
    protected $kelasModel;
    protected $jadwalModel;

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
        $this->dosenModel = new \App\Models\DosenModel();
        $this->ruangModel = new \App\Models\RuangModel();
        $this->settingModel = new \App\Models\SettingModel();
        $this->kelasModel = new \App\Models\KelasModel();
        $this->jadwalModel = new \App\Models\JadwalModel();
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

        $data = [
            'title' => 'Dashboard',
            'total_prodi' => $this->prodiModel->countAllResults(),
            'total_matkul' => $this->mataKuliahModel->countAllResults(),
            'total_matkul_aktif' => $this->mataKuliahModel->where('is_active', "t")->countAllResults(),
            'total_dosen' => $this->dosenModel->countAllResults(),
            'total_ruang' => $this->ruangModel->countAllResults(),
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

        return view('dashboard', $data);
    }
}
