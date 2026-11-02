<?php

namespace App\Controllers\admin;
use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        return view('/admin/main');
    }
}