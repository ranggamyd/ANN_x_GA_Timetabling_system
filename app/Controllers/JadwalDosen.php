<?php

namespace App\Controllers;

class JadwalDosen extends \CodeIgniter\Controller
{
    protected $dosenModel;
    protected $waktuModel;
    protected $jadwalDosenModel;

    public function __construct()
    {
        if (!session()->has('id_user')) {
            session()->set('referred_from', current_url());
            session()->setFlashdata('error', 'Mohon login kembali !');

            header("Location: /login");
            exit();
        }

        $this->dosenModel = new \App\Models\DosenModel();
        $this->waktuModel = new \App\Models\WaktuModel();
        $this->jadwalDosenModel = new \App\Models\JadwalDosenModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Jadwal Dosen',
            'dosen' => $this->dosenModel->orderBy('nama_dosen')->findAll(),
        ];

        return view('jadwal_dosen/index', $data);
    }

    public function edit($id_dosen)
    {
        $jadwalDosen = $this->jadwalDosenModel->where('id_dosen', $id_dosen)->find();

        $jadwal_dosen = [];
        foreach ($jadwalDosen as $item) {
            $jadwal_dosen[$item['id_waktu']] = 0;
        }

        $data = [
            'title' => 'Edit Jadwal Dosen',
            'dosen' => $this->dosenModel->find($id_dosen),
            'waktu' => $this->waktuModel->findAll(),
            'jadwal_dosen' => $jadwal_dosen,
        ];

        return view('jadwal_dosen/edit', $data);
    }

    public function update($id_dosen)
    {
        $this->jadwalDosenModel->where('id_dosen', $id_dosen)->delete();

        foreach ($this->request->getPost('ketersediaan') as $idWaktu => $status) {
            // save hanya bagi yang tidak bersedia
            if ($status == 0) $this->jadwalDosenModel->save(['id_dosen' => $id_dosen, 'id_waktu' => $idWaktu]);
        }

        return redirect()->to('jadwal_dosen/edit/' . $id_dosen)->with('success', 'Jadwal Dosen berhasil diperbarui !');
    }
}
