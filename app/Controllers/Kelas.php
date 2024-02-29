<?php

namespace App\Controllers;

class Kelas extends \CodeIgniter\Controller
{
    protected $mataKuliahModel;
    protected $dosenModel;
    protected $pengampuModel;
    protected $settingModel;
    protected $kelasModel;

    public function __construct()
    {
        if (!session()->has('id_user')) {
            session()->set('referred_from', current_url());
            session()->setFlashdata('error', 'Mohon login kembali !');

            header("Location: /login");
            exit();
        }

        $this->mataKuliahModel = new \App\Models\MataKuliahModel();
        $this->dosenModel = new \App\Models\DosenModel();
        $this->pengampuModel = new \App\Models\PengampuModel();
        $this->settingModel = new \App\Models\SettingModel();
        $this->kelasModel = new \App\Models\KelasModel();
    }

    public function index()
    {
        $setting = $this->settingModel->first();

        $filters = [];
        if (!empty($setting['paket_semester'])) $filters['mata_kuliah.paket'] = $setting['paket_semester'];
        $filters['mata_kuliah.is_active'] = "t";

        $data = [
            'title' => 'Daftar Kelas',
            'setting' => $this->settingModel->first(),
            'kelas' => $this->kelasModel
                ->where($filters)
                ->join('mata_kuliah', 'kelas.id_mata_kuliah = mata_kuliah.id_mata_kuliah', 'left')
                ->join('prodi', 'mata_kuliah.id_prodi = prodi.id_prodi', 'left')
                ->orderBy('kode_prodi')
                ->orderBy('semester')
                ->orderBy('kode_mata_kuliah')
                ->orderBy('nama_kelas')
                ->findAll(),
            'mata_kuliah' => $this->mataKuliahModel
                ->where($filters)
                ->join('prodi', 'mata_kuliah.id_prodi = prodi.id_prodi', 'left')
                ->orderBy('kode_prodi')
                ->orderBy('semester')
                ->orderBy('kode_mata_kuliah')
                ->findAll(),
            'dosen' => $this->dosenModel->orderBy('nama_dosen')->findAll(),
        ];

        return view('kelas/index', $data);
    }

    public function generate()
    {
        $setting = $this->settingModel->first();

        $filters = [];
        if (!empty($setting['paket_semester'])) $filters['mata_kuliah.paket'] = $setting['paket_semester'];
        $filters['mata_kuliah.is_active'] = "t";

        $mata_kuliah = $this->mataKuliahModel
            ->where($filters)
            ->join('prodi', 'mata_kuliah.id_prodi = prodi.id_prodi', 'left')
            ->orderBy('kode_prodi')
            ->orderBy('semester')
            ->orderBy('kode_mata_kuliah')
            ->findAll();

        $this->kelasModel->truncate('kelas');

        foreach ($mata_kuliah as $item) {
            if (!$item['prediksi_peminat']) return redirect()->to('prediksi')->with('error', 'Mohon isi jumlah peserta mata kuliah dengan melakukan prediksi peserta !');

            $max_peserta = $item['max_peserta'] ?: $setting['max_peserta'];
            $jml_kelas = ceil($item['prediksi_peminat'] / $max_peserta);
            $sisa = $item['prediksi_peminat'] % $jml_kelas;
            $jml_peserta_per_kelas = floor($item['prediksi_peminat'] / $jml_kelas);
            $sisa_pertama = $sisa;

            for ($i = 1; $i <= $jml_kelas; $i++) {
                $jml_peserta_kelas = $jml_peserta_per_kelas;

                if ($sisa_pertama > 0) {
                    $jml_peserta_kelas++;
                    $sisa_pertama--;
                }

                $prefix = $item['kode_prodi'];
                $kode_mata_kuliah = $item['kode_mata_kuliah'];
                $nama_kelas = $prefix . '-R' . $i . '-' . $kode_mata_kuliah;

                $this->kelasModel->save([
                    'nama_kelas' => $nama_kelas,
                    'id_mata_kuliah' => $item['id_mata_kuliah'],
                    'prediksi_peserta' => $jml_peserta_kelas,
                ]);
            }
        }

        $total_waktu = number_format((float)microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"], 2, ',', '');

        return redirect()->to('kelas')->with('successWithTime', 'Kelas berhasil dibangkitkan ! Waktu pemrosesan <strong>' . $total_waktu . '</strong> detik.');
    }

    public function store()
    {
        if (!$this->validate([
            'nama_kelas' => [
                'rules' => 'is_unique[kelas.nama_kelas]',
                'errors' => ['is_unique' => 'Nama kelas sudah digunakan !'],
            ],
        ])) {
            return redirect()->back()->withInput()
                ->with('error', 'Kelas gagal ditambahkan !')
                ->with('validation',  $this->validator);
        }

        $this->kelasModel->save([
            'nama_kelas' => $this->request->getPost('nama_kelas'),
            'id_mata_kuliah' => $this->request->getPost('id_mata_kuliah'),
            'prediksi_peserta' => $this->request->getPost('prediksi_peserta'),
        ]);

        return redirect()->to('kelas')->with('success', 'Kelas berhasil ditambahkan !');
    }

    public function updatePengampu($id)
    {
        if ($this->request->getPost('semua_mata_kuliah')) {
            $kelas = $this->kelasModel->find($id);
            $kelas_mata_kuliah = $this->kelasModel->where('id_mata_kuliah', $kelas['id_mata_kuliah'])->find();

            foreach ($kelas_mata_kuliah as $item) {
                $this->pengampuModel->where('id_kelas', $item['id_kelas'])->delete();
                $this->pengampuModel->save(['id_kelas' => $item['id_kelas'], 'id_dosen' => $this->request->getPost('id_dosen')]);
            }
        } else {
            $this->pengampuModel->where('id_kelas', $id)->delete();
            $this->pengampuModel->save(['id_kelas' => $id, 'id_dosen' => $this->request->getPost('id_dosen')]);
        }

        return redirect()->to('kelas')->with('success', 'Dosen Pengampu berhasil diperbarui !');
    }

    public function delete($id)
    {
        $this->kelasModel->delete($id);
        $this->pengampuModel->where('id_kelas', $id)->delete();

        return redirect()->to('kelas')->with('success', 'Kelas berhasil dihapus !');
    }

    public function randomizePengampu()
    {
        $this->pengampuModel->truncate('pengampu');

        foreach ($this->mataKuliahModel->findAll() as $item) {
            $kelas = $this->kelasModel->where('id_mata_kuliah', $item['id_mata_kuliah'])->find();
            $id_dosen = mt_rand(1, 31);
            if (!empty($kelas)) {
                foreach ($kelas as $k) {
                    $this->pengampuModel->save(['id_kelas' => $k['id_kelas'], 'id_dosen' => $id_dosen]);
                }
            }
        }

        return redirect()->to('kelas')->with('success', 'Dosen Pengampu berhasil diperbarui !');
    }
}
