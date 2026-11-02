<?php

namespace App\Controllers\user;

use App\Models\user\DinasLuarModel;
use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $model = new DinasLuarModel();
        $data['dinasluar'] = $model->findAll(); // <- ini penting!

        return view('user/dashboard', $data); // <- ini juga!
    }

    public function getChartData()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('perjalanan_dinas');

        $tahun = date('Y'); // bisa kamu ganti jadi dynamic kalau mau pakai filter tahun

        $query = $builder->select("MONTH(tanggal) AS bulan, COUNT(*) AS jumlah")
            ->where("YEAR(tanggal)", $tahun)
            ->groupBy("MONTH(tanggal)")
            ->orderBy("MONTH(tanggal)", "ASC")
            ->get();

        $result = $query->getResultArray();

        // Inisialisasi 12 bulan kosong
        $data = array_fill(0, 12, 0);

        // Isi sesuai bulan (bulan mulai dari 1, array index dari 0)
        foreach ($result as $row) {
            $data[$row['bulan'] - 1] = (int) $row['jumlah'];
        }

        return $this->response->setJSON($data);
    }
}
