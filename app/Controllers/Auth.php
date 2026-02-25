<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\MahasiswaProfileModel;

class Auth extends BaseController
{
    // ================= LOGIN =================
    public function login()
    {
        return view('auth/login');
    }

    public function process()
    {
        $userModel = new UserModel();

        $user = $userModel
            ->where('email', $this->request->getPost('email'))
            ->first();

        if (! $user) {
            return redirect()->back()->with('error', 'Email tidak ditemukan');
        }

        if (! password_verify(
            $this->request->getPost('password'),
            $user['password']
        )) {
            return redirect()->back()->with('error', 'Password salah');
        }

        session()->set([
            'logged_in' => true,
            'id'        => $user['id'],
            'name'      => $user['name'],
            'role'      => $user['role']
        ]);

        return redirect()->to('/dashboard');
    }

    // ================= REGISTER MAHASISWA =================
    public function registerMahasiswa()
    {
        return view('auth/register_mahasiswa');
    }

    public function saveMahasiswa()
{
    $userModel    = new UserModel();
    $profileModel = new MahasiswaProfileModel();

    // 1️⃣ SIMPAN KE TABEL USERS
    $userId = $userModel->insert([
        'name'     => $this->request->getPost('name'),
        'email'    => $this->request->getPost('email'),
        'password' => password_hash(
            $this->request->getPost('password'),
            PASSWORD_DEFAULT
        ),
        'role'     => 'mahasiswa',
    ]);

    // 2️⃣ SIMPAN KE TABEL MAHASISWA_PROFILES
    $profileModel->insert([
        'user_id'          => $userId,
        'nim'              => $this->request->getPost('nim'),
        'asal_universitas' => $this->request->getPost('asal_universitas'),
        'bidang_magang'    => $this->request->getPost('bidang_magang'),
        'periode_magang'   => $this->request->getPost('periode_magang'),
    ]);

    return redirect()->to('/login')
        ->with('success', 'Registrasi mahasiswa berhasil');
}

    // ================= REGISTER MENTOR =================
    public function registerMentor()
    {
        return view('auth/register_mentor');
    }

    public function saveMentor()
    {
        $userModel = new UserModel();

        $userModel->insert([
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),
            'role'     => 'mentor',
        ]);

        return redirect()->to('/login')
            ->with('success', 'Registrasi mentor berhasil');
    }

    // ================= LOGOUT =================
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}