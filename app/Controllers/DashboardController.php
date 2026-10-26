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

            // 🔹 Daftar mahasiswa + NIM + jumlah jurnal per status.
            //    Mahasiswa yang punya jurnal menunggu persetujuan tampil paling atas.
            $profileTable = (new MahasiswaProfileModel())->builder()->getTable();

            $mahasiswa = $userModel
                ->select("users.id, users.name, {$profileTable}.nim,
                    COUNT(journals.id) AS total_jurnal,
                    SUM(CASE WHEN journals.status = 'pending'  THEN 1 ELSE 0 END) AS total_pending,
                    SUM(CASE WHEN journals.status = 'approved' THEN 1 ELSE 0 END) AS total_approved,
                    SUM(CASE WHEN journals.status = 'rejected' THEN 1 ELSE 0 END) AS total_rejected,
                    MAX(CASE WHEN journals.status = 'pending' THEN journals.tanggal END) AS pending_terakhir", false)
                ->join($profileTable, "{$profileTable}.user_id = users.id", 'left')
                ->join('journals', 'journals.user_id = users.id', 'left')
                ->where('users.role', 'mahasiswa')
                ->groupBy("users.id, users.name, {$profileTable}.nim")
                ->orderBy('total_pending', 'DESC')
                ->orderBy('users.name', 'ASC')
                ->findAll();

            // 🔹 Ringkasan untuk kartu statistik
            $stats = [
                'pending'       => (int) array_sum(array_column($mahasiswa, 'total_pending')),
                'total'         => (int) array_sum(array_column($mahasiswa, 'total_jurnal')),
                'approved'      => (int) array_sum(array_column($mahasiswa, 'total_approved')),
                'rejected'      => (int) array_sum(array_column($mahasiswa, 'total_rejected')),
                'mhs_pending'   => count(array_filter($mahasiswa, static fn ($m) => (int) $m['total_pending'] > 0)),
            ];

            return view('mentor/dashboard', [
                'mentor'        => $mentor,
                'mentorProfile' => $mentorProfile,
                'mahasiswa'     => $mahasiswa,
                'stats'         => $stats,
            ]);
        }

        // ================= DASHBOARD MAHASISWA =================
        $userId = session()->get('id');

        $profile = (new MahasiswaProfileModel())
            ->where('user_id', $userId)
            ->first();

        $journalModel = new JournalModel();

        $totalJurnal = $journalModel
            ->where('user_id', $userId)
            ->countAllResults();

        // Hari hadir = jumlah tanggal berbeda yang sudah diisi jurnal.
        // Dua jurnal di tanggal yang sama tetap dihitung 1 hari.
        $hariHadir = $journalModel
            ->distinct()
            ->select('tanggal')
            ->where('user_id', $userId)
            ->countAllResults();

        return view('mahasiswa/dashboard', [
            'profile'     => $profile,
            'totalJurnal' => $totalJurnal,
            'hariHadir'   => $hariHadir,
        ]);
    }

    public function mentor()
    {
        // proteksi role
        if (session()->get('role') !== 'mentor') {
            return redirect()->to('/dashboard');
        }

        $mentor = (new MentorProfileModel())
            ->where('user_id', session()->get('id'))
            ->first();

        return view('dashboard/mentor', [
            'mentor' => $mentor,
        ]);
    }
}
