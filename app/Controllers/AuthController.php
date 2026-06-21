<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        helper('form');
        $this->userModel = new UserModel();
    }

    public function login()
    {
        if (!$this->request->getPost()) {
            return view('v_login');
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $dataUser = $this->userModel->where('username', $username)->first();

        if (!$dataUser) {
            session()->setFlashdata('failed', 'Username tidak ditemukan');
            return redirect()->to('/login');
        }

        if (!password_verify($password, $dataUser['password'])) {
            session()->setFlashdata('failed', 'Username & Password salah');
            return redirect()->to('/login');
        }

        session()->set([
            'id'        => $dataUser['id'],
            'username'  => $dataUser['username'],
            'role'      => $dataUser['role'],
            'logged_in' => true,
        ]);

        return redirect()->to('/');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
