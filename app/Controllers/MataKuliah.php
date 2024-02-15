<?php

namespace App\Controllers;

class MataKuliah extends \CodeIgniter\Controller
{
    protected $prodiModel;
    protected $mataKuliahModel;

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
    }

    public function index()
    {
        $id_prodi = $this->request->getGet('id_prodi');
        $paket = $this->request->getGet('paket');

        $filters = [];
        if (!empty($id_prodi)) $filters['mata_kuliah.id_prodi'] = $id_prodi;
        if (!empty($paket)) $filters['mata_kuliah.paket'] = $paket;

        $data = [
            'title' => 'Daftar Mata Kuliah',
            'mata_kuliah' => $this->mataKuliahModel
                ->where($filters)
                ->join('prodi', 'mata_kuliah.id_prodi = prodi.id_prodi', 'left')
                ->orderBy('mata_kuliah.is_active', 'desc')
                ->orderBy('kode_prodi')
                ->orderBy('semester')
                ->orderBy('kode_mata_kuliah')
                ->findAll(),
            'prodi' => $this->prodiModel->orderBy('kode_prodi')->findAll(),
            'id_prodi' => $id_prodi,
            'paket' => $paket,
        ];

        return view('mata_kuliah/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Mata Kuliah',
            'prodi' => $this->prodiModel->orderBy('kode_prodi')->findAll(),
        ];

        return view('mata_kuliah/create', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'kode_mata_kuliah' => [
                'rules' => 'is_unique[mata_kuliah.kode_mata_kuliah]',
                'errors' => ['is_unique' => 'Kode mata kuliah sudah digunakan !'],
            ],
        ])) {
            return redirect()->back()->withInput()
                ->with('error', 'Mata kuliah gagal ditambahkan !')
                ->with('validation',  $this->validator);
        }

        $this->mataKuliahModel->save([
            'kode_mata_kuliah' => $this->request->getPost('kode_mata_kuliah'),
            'nama_mata_kuliah' => $this->request->getPost('nama_mata_kuliah'),
            'sks' => $this->request->getPost('sks'),
            'semester' => $this->request->getPost('semester'),
            'paket' => $this->request->getPost('semester') % 2 == 0 ? 'Genap' : 'Ganjil',
            'sifat' => $this->request->getPost('sifat'),
            'id_prodi' => $this->request->getPost('id_prodi'),
        ]);

        return redirect()->to('mata_kuliah')->with('success', 'Mata kuliah berhasil ditambahkan !');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Mata Kuliah',
            'mata_kuliah' => $this->mataKuliahModel->find($id),
            'prodi' => $this->prodiModel->orderBy('kode_prodi')->findAll(),
        ];

        return view('mata_kuliah/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'kode_mata_kuliah' => [
                'rules' => 'is_unique[mata_kuliah.kode_mata_kuliah]',
                'errors' => ['is_unique' => 'Kode mata kuliah sudah digunakan !'],
            ],
        ])) {
            return redirect()->back()->withInput()
                ->with('error', 'Mata kuliah gagal diperbarui !')
                ->with('validation',  $this->validator);
        }

        $this->mataKuliahModel->save([
            'id_mata_kuliah' => $id,
            'kode_mata_kuliah' => $this->request->getPost('kode_mata_kuliah'),
            'nama_mata_kuliah' => $this->request->getPost('nama_mata_kuliah'),
            'sks' => $this->request->getPost('sks'),
            'semester' => $this->request->getPost('semester'),
            'paket' => $this->request->getPost('semester') % 2 == 0 ? 'Genap' : 'Ganjil',
            'sifat' => $this->request->getPost('sifat'),
            'id_prodi' => $this->request->getPost('id_prodi'),
        ]);

        return redirect()->to('mata_kuliah')->with('success', 'Mata kuliah berhasil diperbarui !');
    }

    public function delete($id)
    {
        $this->mataKuliahModel->delete($id);

        return redirect()->to('mata_kuliah')->with('success', 'Mata kuliah berhasil dihapus !');
    }

    public function setAllActive()
    {
        foreach ($this->mataKuliahModel->findAll() as $item) {
            $this->mataKuliahModel->save([
                'id_mata_kuliah' => $item['id_mata_kuliah'],
                'is_active' => true
            ]);
        }

        return redirect()->to('mata_kuliah')->with('success', 'Mata kuliah berhasil diperbarui !');
    }

    public function setAllITActive()
    {
        foreach ($this->mataKuliahModel->findAll() as $item) {
            $this->mataKuliahModel->save([
                'id_mata_kuliah' => $item['id_mata_kuliah'],
                'is_active' => false
            ]);

            if ($item['id_prodi'] == 3) {
                $this->mataKuliahModel->save([
                    'id_mata_kuliah' => $item['id_mata_kuliah'],
                    'is_active' => true
                ]);
            }
        }

        return redirect()->to('mata_kuliah')->with('success', 'Mata kuliah berhasil diperbarui !');
    }
}
