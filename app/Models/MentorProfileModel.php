<?php

namespace App\Models;

use CodeIgniter\Model;

class MentorProfileModel extends Model
{
    protected $table = 'mentor_profiles';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'nip',
        'jabatan',
        'bidang'
    ];

    protected $useTimestamps = false;
}