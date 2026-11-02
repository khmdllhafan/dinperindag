<?php

namespace App\Controllers\user;

use CodeIgniter\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function process()
    {
        $validation = \Config\Services::validation();

        // Aturan validasi
        $rules = [
            'username' => 'required|min_length[3]|is_unique[user.username]',
            'password' => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]'
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('error', 'Registrasi gagal. Periksa kembali input Anda.');
            return redirect()->to(base_url('register'))->withInput();
        }

        // Simpan data ke database
        $userModel = new \App\Models\user\UserModel();
        $userModel->save([
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ]);

        // Set Flashdata sukses
        session()->setFlashdata('success', 'Registrasi berhasil! Silakan login.');

        // Redirect ke halaman login
        return redirect()->to(base_url('login'));
    }
}
