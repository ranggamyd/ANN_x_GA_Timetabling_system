<?php

namespace App\Controllers;

class Setting extends \CodeIgniter\Controller
{
    protected $settingModel;

    public function __construct()
    {
        if (!session()->has('id_user')) {
            session()->set('referred_from', current_url());
            session()->setFlashdata('error', 'Mohon login kembali !');

            header("Location: /login");
            exit();
        }

        $this->settingModel = new \App\Models\SettingModel();
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
}
