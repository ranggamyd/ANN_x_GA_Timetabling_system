<?php

namespace App\Controllers;

class Report extends \CodeIgniter\Controller
{
    protected $dosenModel;

    public function __construct()
    {
        if (!session()->has('id_user')) {
            session()->set('referred_from', current_url());
            session()->setFlashdata('error', 'Mohon login kembali !');

            header("Location: /login");
            exit();
        }

        $this->dosenModel = new \App\Models\DosenModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Laporan Keseimbangan',
            'dosen' => $this->dosenModel
                ->join('prodi', 'dosen.id_prodi = prodi.id_prodi', 'left')
                ->orderBy('nama_dosen')
                ->findAll()
        ];

        return view('report/index', $data);
    }
}
