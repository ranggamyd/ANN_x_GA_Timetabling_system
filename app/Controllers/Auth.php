<?php

namespace App\Controllers;

class Auth extends \CodeIgniter\Controller
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new \App\Models\UserModel();
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');

            $user = $this->userModel->where('username', $username)->first();

            if ($user && password_verify($password, $user['password'])) {
                session()->set([
                    'id_user' => $user['id_user'],
                    'username' => $user['username'],
                    'role' => $user['role'],
                    'avatar' => $user['avatar'],
                ]);

                return redirect()->to('dashboard')->with('success', 'Berhasil Masuk\nSelamat datang kembali !');
            } else {
                return redirect()->back()->withInput()->with('error', 'Gagal Masuk\nKredensial tidak sesuai !');
            }
        }

        $data = ['title' => 'Login'];

        return view('auth/login', $data);
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('login')->with('success', 'Berhasil keluar !');
    }

    // public function profile()
    // {
    //     $userId = session()->get('id_user');
    //     $user = $this->userModel->find($userId);

    //     if ($this->request->is('post')) {
    //         $data = [
    //             'username' => $this->request->getVar('username'),
    //         ];

    //         $avatar = $this->request->getFile('avatar');
    //         if ($avatar->isValid() && $avatar->hasMoved()) {
    //             $newAvatarName = $avatar->getRandomName();
    //             $avatar->move(ROOTPATH . 'public/uploads/avatars', $newAvatarName);

    //             $data['avatar'] = $newAvatarName;
    //         }

    //         $this->userModel->update($userId, $data);

    //         return redirect()->to('/dashboard');
    //     }

    //     return view('auth/profile', ['user' => $user]);
    // }

    // public function register()
    // {
    //     if ($this->request->is('post')) {
    //         $avatar = $this->request->getFile('avatar');

    //         if ($avatar->isValid() && $avatar->hasMoved()) {
    //             $newAvatarName = $avatar->getRandomName();
    //             $avatar->move(ROOTPATH . 'public/uploads/avatars', $newAvatarName);

    //             $data = [
    //                 'username' => $this->request->getVar('username'),
    //                 'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
    //                 'role' => 'dosen',
    //                 'avatar' => $newAvatarName,
    //             ];

    //             $this->userModel->insert($data);

    //             // Redirect atau tampilkan pesan sukses
    //         }
    //     }

    //     return view('auth/register');
    // }
}
