<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\UserModel;

class Users extends Controller
{
    protected $userModel;

    public function __construct()
    {
        if (!session()->has('id_user')) {
            session()->set('referred_from', current_url());
            session()->setFlashdata('error', 'Mohon login kembali !');

            header("Location: /login");
            exit();
        }

        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Pengguna',
            'users' => $this->userModel->orderBy('id_user')->findAll(),
        ];

        return view('users/index', $data);
    }

    public function show($id)
    {
        $data = [
            'title' => 'Detail Pengguna',
            'users' => $this->userModel->find($id),
        ];

        return view('users/show', $data);
    }

    public function create()
    {
        $data = ['title' => 'Tambah Pengguna'];

        return view('users/create', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'username' => [
                'rules' => 'is_unique[users.username]',
                'errors' => ['is_unique' => 'Nama pengguna sudah digunakan !'],
            ],
            'password_conf' => [
                'rules' => 'matches[password]',
                'errors' => ['matches' => 'Konfirmasi password tidak sesuai !'],
            ],
        ])) {
            return redirect()->back()->withInput()
                ->with('error', 'Pengguna gagal ditambahkan !')
                ->with('validation',  $this->validator);
        }

        $this->userModel->save([
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
        ]);

        return redirect()->to('users')->with('success', 'Pengguna berhasil ditambahkan !');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Pengguna',
            'users' => $this->userModel->find($id),
        ];

        return view('users/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'username' => [
                'rules' => "is_unique[users.username,id_users,$id]",
                'errors' => ['is_unique' => 'Nama pengguna sudah digunakan !'],
            ],
            'password_conf' => [
                'rules' => 'matches[password]',
                'errors' => ['matches' => 'Konfirmasi password tidak sesuai !'],
            ],
        ])) {
            return redirect()->back()->withInput()
                ->with('error', 'Pengguna gagal diperbarui !')
                ->with('validation',  $this->validator);
        }

        $this->userModel->save([
            'id_users' => $id,
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
        ]);

        return redirect()->to('users')->with('success', 'Pengguna berhasil diperbarui !');
    }

    public function delete($id)
    {
        $this->userModel->delete($id);

        return redirect()->to('users')->with('success', 'Pengguna berhasil dihapus !');
    }
}
