<?php

namespace App\Controllers;

use App\Models\MahasiswaProfileModel;

class DashboardController extends BaseController
{
    public function index()
    {
        if (! session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        // DASHBOARD MENTOR
        if (session()->get('role') === 'mentor') {
            return view('mentor/dashboard');
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