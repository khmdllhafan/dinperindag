<?php

namespace App\Controllers\user;

use App\Models\user\DinasLuarModel;
use App\Controllers\BaseController;

class DinasLuar extends BaseController
{
    public function index()
    {
        $dinasModel = new DinasLuarModel();

        // Urut berdasarkan tanggal DESC
        $data['dinas_luar'] = $dinasModel->orderBy('tanggal', 'DESC')->findAll();

        // Tampilkan view yang sesuai folder
        return view('user/dinas_luar', $data);
    }



    public function simpan()
    {

        // Ambil data dari form
        $data = [
            'no_sp'          => $this->request->getPost('no_sp'),
            'tanggal'        => $this->request->getPost('tanggal'),
            'jenis_dinas'    => $this->request->getPost('jenis_dinas'), // INI PENTING!
            'nama'           => $this->request->getPost('nama'),
            'tujuan'         => $this->request->getPost('tujuan'),
            'kegiatan'       => $this->request->getPost('kegiatan'),
            'tanggal_pulang' => $this->request->getPost('tanggal_pulang'),
            'pembuat'        => $this->request->getPost('pembuat'),
        ];

        // Simpan ke database
        $model = new \App\Models\user\DinasLuarModel();
        $model->insert($data);

        // Redirect ke halaman dinasluar dengan flash message
        return redirect()->to(base_url('user/dashboard'))->with('success', 'Data berhasil ditambahkan');
    }

}
