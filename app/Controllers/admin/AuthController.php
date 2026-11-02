<?php
namespace App\Controllers\admin;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function login()
    {
        return view('/admin/login');
    }

    public function processLogin()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $hashedPassword = sha1($password);
        $db = \Config\Database::connect();
        $query = $db->table('user')->where('username', $username)->get();
        if ($query->getNumRows() > 0) {
            $user = $query->getRow();
            if ($user->password === $hashedPassword) {
                // Simpan sesi login
                session()->set('isLoggedIn', true);
                session()->set('username', $user->username);
                return redirect()->to('/admin/main');
            }
        }
        return redirect()->back()->with('error', 'username atau password salah.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin')->with('success', 'Logout berhasil!');
    }
}