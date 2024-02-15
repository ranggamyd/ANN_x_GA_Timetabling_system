<?php

namespace App\Controllers;

class Ruang extends \CodeIgniter\Controller
{
    protected $prodiModel;
    protected $ruangModel;
    protected $ruangProdiModel;

    public function __construct()
    {
        if (!session()->has('id_user')) {
            session()->set('referred_from', current_url());
            session()->setFlashdata('error', 'Mohon login kembali !');

            header("Location: /login");
            exit();
        }

        $this->prodiModel = new \App\Models\ProdiModel();
        $this->ruangModel = new \App\Models\RuangModel();
        $this->ruangProdiModel = new \App\Models\RuangProdiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Ruang',
            'ruang' => $this->ruangModel->orderBy('nama_ruang')->findAll(),
        ];

        return view('ruang/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Ruang',
            'prodi' => $this->prodiModel->orderBy('kode_prodi')->findAll(),
        ];

        return view('ruang/create', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'kode_ruang' => [
                'rules' => 'is_unique[ruang.kode_ruang]',
                'errors' => ['is_unique' => 'Kode ruang sudah digunakan !'],
            ],
        ])) {
            return redirect()->back()->withInput()
                ->with('error', 'Ruang gagal ditambahkan !')
                ->with('validation',  $this->validator);
        }

        $ruang = $this->ruangModel->insert([
            'kode_ruang' => $this->request->getPost('kode_ruang'),
            'nama_ruang' => $this->request->getPost('nama_ruang'),
            'kapasitas' => $this->request->getPost('kapasitas'),
            // 'gedung' => $this->request->getPost('gedung'),
        ]);

        foreach ($this->request->getPost('id_prodi') as $item) {
            $this->ruangProdiModel->insert(['id_ruang' => $ruang, 'id_prodi' => $item]);
        }

        return redirect()->to('ruang')->with('success', 'Ruang berhasil ditambahkan !');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Ruang',
            'ruang' => $this->ruangModel->find($id),
            'prodi' => $this->prodiModel->orderBy('kode_prodi')->findAll(),
        ];

        return view('ruang/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'kode_ruang' => [
                'rules' => "is_unique[ruang.kode_ruang,id_ruang,$id]",
                'errors' => ['is_unique' => 'Kode ruang sudah digunakan !'],
            ],
        ])) {
            return redirect()->back()->withInput()
                ->with('error', 'Ruang gagal diperbarui !')
                ->with('validation',  $this->validator);
        }

        $ruang = $this->ruangModel->update($id, [
            'kode_ruang' => $this->request->getPost('kode_ruang'),
            'nama_ruang' => $this->request->getPost('nama_ruang'),
            'kapasitas' => $this->request->getPost('kapasitas'),
            // 'gedung' => $this->request->getPost('gedung'),
        ]);

        $this->ruangProdiModel->where('id_ruang', $id)->delete();

        foreach ($this->request->getPost('id_prodi') as $item) {
            $this->ruangProdiModel->insert(['id_ruang' => $id,'id_prodi' => $item]);
        }

        return redirect()->to('ruang')->with('success', 'Ruang berhasil diperbarui !');
    }

    public function delete($id)
    {
        $this->ruangModel->delete($id);

        return redirect()->to('ruang')->with('success', 'Ruang berhasil dihapus !');
    }
}
