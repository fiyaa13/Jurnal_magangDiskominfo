<?php

namespace App\Models;

use CodeIgniter\Model;

class JournalModel extends Model
{
    protected $table = 'journals';
    protected $primaryKey = 'id';

    protected $allowedFields = [
    'user_id',
    'minggu',
    'tanggal',
    'hari',
    'deskripsi',
    'status',
    'mentor_note'
];

    protected $useTimestamps = false;
}
