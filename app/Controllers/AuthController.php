<?php

namespace App\Controllers;

class AuthController extends BaseController
{
    public function __construct()
    {
        helper('form');
    }

    public function login()
    {
        // Jika belum submit form
        if(!$this->request->getPost())
        {
            return view('v_login');
        }

        // Data user dummy
        $dataUser = [
            'username' => 'april',
            'password' => md5('123'),
            'role'     => 'admin'
        ];

        // Ambil input user
        $username = $this->request->getPost('username');
        $password = md5($this->request->getPost('password'));

        // Cek username
        if($username != $dataUser['username'])
        {
            session()->setFlashdata(
                'failed',
                'Username tidak ditemukan'
            );

            return redirect()->to('/login');
        }

        // Cek password
        if($password != $dataUser['password'])
        {
            session()->setFlashdata(
                'failed',
                'Username & Password salah'
            );

            return redirect()->to('/login');
        }

        // Simpan session login
        session()->set([
            'username' => $dataUser['username'],
            'role'     => $dataUser['role'],
            'logged_in'=> true
        ]);

        return redirect()->to('/');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }
}