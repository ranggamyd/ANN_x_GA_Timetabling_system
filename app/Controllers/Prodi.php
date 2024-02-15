<?php

namespace App\Controllers;

class Prodi extends \CodeIgniter\Controller
{
    protected $prodiModel;

    public function __construct()
    {
        if (!session()->has('id_user')) {
            session()->set('referred_from', current_url());
            session()->setFlashdata('error', 'Mohon login kembali !');

            header("Location: /login");
            exit();
        }

        $this->prodiModel = new \App\Models\ProdiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Program Studi',
            'prodi' => $this->prodiModel->orderBy('kode_prodi')->findAll(),
        ];

        return view('prodi/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Program Studi',
            'fakultas' => ['Teknik', 'Hukum', 'Ilmu Sosial & Politik', 'Kesehatan', 'Ekonomi & Bisnis', 'Keguruan', 'Agama Islam']
        ];

        return view('prodi/create', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'kode_prodi' => [
                'rules' => 'is_unique[prodi.kode_prodi]',
                'errors' => ['is_unique' => 'Kode prodi sudah digunakan !'],
            ],
        ])) {
            return redirect()->back()->withInput()
                ->with('error', 'Program studi gagal ditambahkan !')
                ->with('validation',  $this->validator);
        }

        $this->prodiModel->save([
            'kode_prodi' => $this->request->getPost('kode_prodi'),
            'nama_prodi' => $this->request->getPost('nama_prodi'),
            'fakultas' => $this->request->getPost('fakultas'),
            'deskripsi' => $this->request->getPost('deskripsi'),
        ]);

        return redirect()->to('prodi')->with('success', 'Program studi berhasil ditambahkan !');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Program Studi',
            'prodi' => $this->prodiModel->find($id),
            'fakultas' => ['Teknik', 'Hukum', 'Ilmu Sosial & Politik', 'Kesehatan', 'Ekonomi & Bisnis', 'Keguruan', 'Agama Islam']
        ];

        return view('prodi/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'kode_prodi' => [
                'rules' => "is_unique[prodi.kode_prodi,id_prodi,$id]",
                'errors' => ['is_unique' => 'Kode prodi sudah digunakan !'],
            ],
        ])) {
            return redirect()->back()->withInput()
                ->with('error', 'Program studi gagal diperbarui !')
                ->with('validation',  $this->validator);
        }

        $this->prodiModel->save([
            'id_prodi' => $id,
            'kode_prodi' => $this->request->getPost('kode_prodi'),
            'nama_prodi' => $this->request->getPost('nama_prodi'),
            'fakultas' => $this->request->getPost('fakultas'),
            'deskripsi' => $this->request->getPost('deskripsi'),
        ]);

        return redirect()->to('prodi')->with('success', 'Program studi berhasil diperbarui !');
    }

    public function delete($id)
    {
        $this->prodiModel->delete($id);

        return redirect()->to('prodi')->with('success', 'Program studi berhasil dihapus !');
    }
}
