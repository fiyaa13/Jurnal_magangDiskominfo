<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaProfileModel extends Model
{
    protected $table = 'mahasiswa_profiles';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'nama',
        'nim',
        'asal_universitas',
        'bidang_magang',
        'periode_magang'
    ];

    protected $useTimestamps = false;
}
