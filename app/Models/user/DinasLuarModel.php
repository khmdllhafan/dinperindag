<?php

namespace App\Models\user;

use CodeIgniter\Model;

class DinasLuarModel extends Model
{
    protected $table = 'perjalanan_dinas';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'no_sp', 'tanggal', 'jenis_dinas', 'nama',
        'tujuan', 'kegiatan', 'tanggal_pulang', 'pembuat'
    ];
}
