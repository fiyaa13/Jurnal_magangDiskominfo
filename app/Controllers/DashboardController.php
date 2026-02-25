<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
{
    if (! session()->get('logged_in')) {
        return redirect()->to('/login');
    }

    if (session()->get('role') === 'mentor') {
        return view('mentor/dashboard');
    }

    return view('mahasiswa/dashboard');
}
}