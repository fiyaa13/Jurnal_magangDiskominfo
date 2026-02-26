<?php

namespace App\Controllers;

use App\Models\MahasiswaProfileModel;
use App\Models\JournalModel;
use App\Models\UserModel;

class DashboardController extends BaseController
{
    public function index()
    {
        if (! session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        // DASHBOARD MENTOR
        if (session()->get('role') === 'mentor') {
             $userModel    = new UserModel();
            $journalModel = new JournalModel();

            // Ambil daftar mahasiswa + jumlah jurnal
            $mahasiswa = $userModel
                ->select('users.id, users.name, COUNT(journals.id) AS total_jurnal')
                ->join('journals', 'journals.user_id = users.id', 'left')
                ->where('users.role', 'mahasiswa')
                ->groupBy('users.id')
                ->findAll();
            return view('mentor/dashboard', ['mahasiswa'
            => $mahasiswa]);
        }

        // DASHBOARD MAHASISWA
        $profileModel = new MahasiswaProfileModel();

        $profile = $profileModel
            ->where('user_id', session()->get('id'))
            ->first();

        return view('mahasiswa/dashboard', [
            'profile' => $profile
        ]);
    }
}