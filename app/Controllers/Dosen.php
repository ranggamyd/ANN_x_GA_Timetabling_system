<?php

namespace App\Controllers;

class Dosen extends \CodeIgniter\Controller
{
    protected $settingModel;
    protected $prodiModel;
    protected $mataKuliahModel;
    protected $dosenModel;

    public function __construct()
    {
        if (!session()->has('id_user')) {
            session()->set('referred_from', current_url());
            session()->setFlashdata('error', 'Mohon login kembali !');

            header("Location: /login");
            exit();
        }

        $this->settingModel = new \App\Models\SettingModel();
        $this->prodiModel = new \App\Models\ProdiModel();
        $this->mataKuliahModel = new \App\Models\MataKuliahModel();
        $this->dosenModel = new \App\Models\DosenModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Dosen',
            'dosen' => $this->dosenModel
                ->join('prodi', 'dosen.id_prodi = prodi.id_prodi', 'left')
                ->orderBy('kode_prodi')
                ->orderBy('nama_dosen')
                ->findAll(),
        ];

        return view('dosen/index', $data);
    }

    public function create()
    {
        $setting = $this->settingModel->first();

        $filters = [];
        if (!empty($setting['paket_semester'])) $filters['mata_kuliah.paket'] = $setting['paket_semester'];
        $filters['mata_kuliah.is_active'] = "t";

        $data = [
            'title' => 'Tambah Dosen',
            'mata_kuliah' => $this->mataKuliahModel
                ->where($filters)
                ->join('prodi', 'mata_kuliah.id_prodi = prodi.id_prodi', 'left')
                ->orderBy('mata_kuliah.is_active', 'desc')
                ->orderBy('kode_prodi')
                ->orderBy('semester')
                ->orderBy('kode_mata_kuliah')
                ->findAll(),
            'prodi' => $this->prodiModel->orderBy('kode_prodi')->findAll(),
        ];

        return view('dosen/create', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'nidn' => [
                'rules' => 'is_unique[dosen.nidn]',
                'errors' => ['is_unique' => 'Kode dosen sudah digunakan !'],
            ]
        ])) {
            return redirect()->back()->withInput()
                ->with('error', 'Dosen gagal ditambahkan !')
                ->with('validation',  $this->validator);
        }

        $this->dosenModel->save([
            'nidn' => $this->request->getPost('nidn'),
            'nama_dosen' => $this->request->getPost('nama_dosen'),
            'email' => $this->request->getPost('email'),
            'no_hp' => $this->request->getPost('no_hp'),
        ]);

        return redirect()->to('dosen')->with('success', 'Dosen berhasil ditambahkan !');
    }

    public function edit($id)
    {
        $setting = $this->settingModel->first();

        $filters = [];
        if (!empty($setting['paket_semester'])) $filters['mata_kuliah.paket'] = $setting['paket_semester'];
        $filters['mata_kuliah.is_active'] = "t";
        
        $data = [
            'title' => 'Edit Dosen',
            'dosen' => $this->dosenModel->find($id),
            'mata_kuliah' => $this->mataKuliahModel
                ->where($filters)
                ->join('prodi', 'mata_kuliah.id_prodi = prodi.id_prodi', 'left')
                ->orderBy('mata_kuliah.is_active', 'desc')
                ->orderBy('kode_prodi')
                ->orderBy('semester')
                ->orderBy('kode_mata_kuliah')
                ->findAll(),
            'prodi' => $this->prodiModel->orderBy('kode_prodi')->findAll(),
        ];

        return view('dosen/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'nidn' => [
                'rules' => "is_unique[dosen.nidn,id_dosen,$id]",
                'errors' => ['is_unique' => 'Kode dosen sudah digunakan !'],
            ]
        ])) {
            return redirect()->back()->withInput()
                ->with('error', 'Dosen gagal diperbarui !')
                ->with('validation',  $this->validator);
        }

        $this->dosenModel->save([
            'id_dosen' => $id,
            'nidn' => $this->request->getPost('nidn'),
            'nama_dosen' => $this->request->getPost('nama_dosen'),
            'email' => $this->request->getPost('email'),
            'no_hp' => $this->request->getPost('no_hp'),
        ]);

        return redirect()->to('dosen')->with('success', 'Dosen berhasil diperbarui !');
    }

    public function delete($id)
    {
        $this->dosenModel->delete($id);

        return redirect()->to('dosen')->with('success', 'Dosen berhasil dihapus !');
    }
}
