<?php

namespace App\Controllers;

use App\Models\MahasiswaProfileModel;
use App\Models\JournalModel;
use App\Models\UserModel;
use App\Models\MentorProfileModel;

class DashboardController extends BaseController
{
    public function index()
    {
        if (! session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        // ================= DASHBOARD MENTOR =================
        if (session()->get('role') === 'mentor') {

            $userModel          = new UserModel();
            $mentorProfileModel = new MentorProfileModel();

            // 🔹 Data mentor (nama dari users)
            $mentor = $userModel->find(session()->get('id'));

            // 🔹 Profile mentor (nip, jabatan, bidang)
            $mentorProfile = $mentorProfileModel
                ->where('user_id', session()->get('id'))
                ->first();

            // 🔹 Daftar mahasiswa + total jurnal
            $mahasiswa = $userModel
                ->select('users.id, users.name, COUNT(journals.id) AS total_jurnal')
                ->join('journals', 'journals.user_id = users.id', 'left')
                ->where('users.role', 'mahasiswa')
                ->groupBy('users.id')
                ->findAll();

            return view('mentor/dashboard', [
                'mentor'        => $mentor,
                'mentorProfile' => $mentorProfile,
                'mahasiswa'     => $mahasiswa
            ]);
        }

        // ================= DASHBOARD MAHASISWA =================
        $profileModel = new MahasiswaProfileModel();

        $profile = $profileModel
            ->where('user_id', session()->get('id'))
            ->first();

        return view('mahasiswa/dashboard', [
            'profile' => $profile
        ]);
    }
}