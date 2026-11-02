<?php

namespace App\Controllers\user;

use App\Models\user\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    protected ?UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function register()
    {
        log_message('info', 'Metode register dipanggil!');
        return view('user/register');
    }

    public function registerUser()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Enjripsi Password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $userModel = new \App\Models\user\UserModel();
        $userModel->save([
            'username' => $username,
            'password' => $hashedPassword
        ]);

        return redirect()->to('/user/login')->with('success', 'Registrasi berhasil!');
    }


    public function registerProcess()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $confirm_password = $this->request->getPost('confirm_password');

        // Cek username sudah ada
        $existingUser = $this->userModel->where('username', $username)->first();
        if ($existingUser) {
            session()->setFlashdata('error', 'Username sudah terdaftar! Pilih username lain.');
            return redirect()->back()->withInput();
        }

        // Cek kecocokan password dan konfirmasi password
        if ($password !== $confirm_password) {
            session()->setFlashdata('error', 'Password dan konfirmasi tidak cocok!');
            return redirect()->back()->withInput();
        }

        // Simpan data jika valid
        $this->userModel->save([
            'username' => $username,
            'password' => password_hash($password, PASSWORD_BCRYPT)
        ]);

        session()->setFlashdata('success', 'Registrasi berhasil! Silakan login.');
        return redirect()->to('/user/login');
    }

    public function login()
    {
        // Cek user sudah login
        if (session()->get('logged_in')) {
            return redirect()->to('/user/dashboard');
        }

        return view('user/login'); // Tampilkan halaman login
    }

    public function loginProcess()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new \App\Models\user\UserModel();
        $user = $userModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            // Set session data
            session()->set([
                'username' => $user['username'],
                'logged_in' => true,
            ]);

            // Redirect ke dashboard
            return redirect()->to('/user/dashboard')->with('success', 'Login berhasil! Selamat datang di halaman utama.');
        } else {
            // Jika login gagal
            session()->setFlashdata('error', 'Username atau password salah.');
            return redirect()->back();
        }
    }

    public function logout()
    {
        // Hapus session
        session()->destroy();
        return redirect()->to('/user');
    }
}
