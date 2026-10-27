<?php

namespace App\Controllers;

use App\Models\MahasiswaProfileModel;
use App\Models\MentorProfileModel;
use App\Models\UserModel;

class Auth extends BaseController
{
    // ================= LOGIN =================
    public function login()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }

        return view('auth/login');
    }

    /**
     * Login dengan email ATAU NIM.
     * - Ada "@"   → dicari sebagai email di tabel users
     * - Tanpa "@" → dicari sebagai NIM di tabel mahasiswa_profiles
     */
    public function process()
    {
        $identity = trim((string) $this->request->getPost('identity'));
        $password = (string) $this->request->getPost('password');

        if ($identity === '' || $password === '') {
            return redirect()->back()->withInput()
                ->with('error', 'Email/NIM dan password wajib diisi.');
        }

        $userModel = new UserModel();
        $user      = null;

        if (str_contains($identity, '@')) {
            $user = $userModel->where('email', mb_strtolower($identity))->first();
        } else {
            $profile = (new MahasiswaProfileModel())
                ->where('nim', mb_strtoupper($identity))
                ->first();

            if ($profile) {
                $user = $userModel->find($profile['user_id']);
            }
        }

        // Pesan sengaja dibuat sama, supaya orang lain tidak bisa menebak
        // email/NIM mana yang terdaftar.
        if (! $user || ! password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()
                ->with('error', 'Email/NIM atau password salah.');
        }

        // Mentor baru harus diverifikasi admin dulu
        if ($user['role'] === 'mentor' && isset($user['is_verified']) && (int) $user['is_verified'] === 0) {
            return redirect()->back()->withInput()
                ->with('error', 'Akun mentor kamu masih menunggu verifikasi admin. Coba lagi setelah disetujui.');
        }

        session()->regenerate();
        session()->set([
            'logged_in' => true,
            'id'        => $user['id'],
            'name'      => $user['name'],
            'role'      => $user['role'],
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
        // Rapikan isian dulu: spasi dibuang, email huruf kecil, NIM huruf besar
        $data = [
            'name'             => trim((string) $this->request->getPost('name')),
            'email'            => mb_strtolower(trim((string) $this->request->getPost('email'))),
            'password'         => (string) $this->request->getPost('password'),
            'nim'              => mb_strtoupper(preg_replace('/\s+/', '', (string) $this->request->getPost('nim'))),
            'asal_universitas' => trim((string) $this->request->getPost('asal_universitas')),
            'bidang_magang'    => trim((string) $this->request->getPost('bidang_magang')),
            'periode_magang'   => trim((string) $this->request->getPost('periode_magang')),
        ];

        $rules = [
            'name'             => 'required|max_length[100]',
            'email'            => 'required|valid_email|is_unique[users.email]',
            'password'         => 'required|min_length[8]',
            'nim'              => 'required|alpha_numeric|max_length[30]|is_unique[mahasiswa_profiles.nim]',
            'asal_universitas' => 'required',
            'bidang_magang'    => 'required',
            'periode_magang'   => 'required',
        ];

        $messages = [
            'name'             => ['required' => 'Nama lengkap wajib diisi.'],
            'email'            => [
                'required'    => 'Email wajib diisi.',
                'valid_email' => 'Format email tidak valid.',
                'is_unique'   => 'Email ini sudah terdaftar. Silakan login atau gunakan email lain.',
            ],
            'password'         => [
                'required'   => 'Password wajib diisi.',
                'min_length' => 'Password minimal 8 karakter.',
            ],
            'nim'              => [
                'required'      => 'NIM wajib diisi.',
                'alpha_numeric' => 'NIM hanya boleh berisi huruf dan angka.',
                'is_unique'     => 'NIM ini sudah terdaftar. Silakan login dengan NIM tersebut.',
            ],
            'asal_universitas' => ['required' => 'Asal universitas wajib diisi.'],
            'bidang_magang'    => ['required' => 'Bidang magang wajib diisi.'],
            'periode_magang'   => ['required' => 'Periode magang wajib diisi.'],
        ];

        if (! $this->validateData($data, $rules, $messages)) {
            return redirect()->back()->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            $userId = (new UserModel())->insert([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => password_hash($data['password'], PASSWORD_DEFAULT),
                'role'     => 'mahasiswa',
            ]);

            if (! $userId) {
                throw new \RuntimeException($db->error()['message'] ?? 'Gagal menyimpan akun.');
            }

            $profil = [
                'user_id'          => $userId,
                'nim'              => $data['nim'],
                'asal_universitas' => $data['asal_universitas'],
                'bidang_magang'    => $data['bidang_magang'],
                'periode_magang'   => $data['periode_magang'],
            ];

            // Kolom `nama` hanya diisi kalau memang ada di tabel
            if ($db->fieldExists('nama', 'mahasiswa_profiles')) {
                $profil['nama'] = $data['name'];
            }

            if ((new MahasiswaProfileModel())->insert($profil) === false) {
                throw new \RuntimeException($db->error()['message'] ?? 'Gagal menyimpan profil mahasiswa.');
            }

            $db->transCommit();
        } catch (\Throwable $e) {
            $db->transRollback();

            return $this->registrasiGagal('mahasiswa', $e->getMessage());
        }

        return redirect()->to('/login')
            ->with('success', 'Registrasi berhasil. Silakan login dengan email atau NIM kamu.');
    }

    // ================= REGISTER MENTOR =================
    public function registerMentor()
    {
        return view('auth/register_mentor');
    }

    public function saveMentor()
    {
        $data = [
            'nama'     => trim((string) $this->request->getPost('nama')),
            'email'    => mb_strtolower(trim((string) $this->request->getPost('email'))),
            'password' => (string) $this->request->getPost('password'),
            'nip'      => preg_replace('/\s+/', '', (string) $this->request->getPost('nip')),
            'jabatan'  => trim((string) $this->request->getPost('jabatan')),
            'bidang'   => trim((string) $this->request->getPost('bidang')),
        ];

        $rules = [
            'nama'     => 'required|max_length[100]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
            'nip'      => 'required|numeric|max_length[30]|is_unique[mentor_profiles.nip]',
            'jabatan'  => 'required',
            'bidang'   => 'required',
        ];

        $messages = [
            'nama'     => ['required' => 'Nama mentor wajib diisi.'],
            'email'    => [
                'required'    => 'Email wajib diisi.',
                'valid_email' => 'Format email tidak valid.',
                'is_unique'   => 'Email ini sudah terdaftar. Silakan login atau gunakan email lain.',
            ],
            'password' => [
                'required'   => 'Password wajib diisi.',
                'min_length' => 'Password minimal 8 karakter.',
            ],
            'nip'      => [
                'required'  => 'NIP wajib diisi.',
                'numeric'   => 'NIP hanya boleh berisi angka.',
                'is_unique' => 'NIP ini sudah terdaftar.',
            ],
            'jabatan'  => ['required' => 'Jabatan wajib diisi.'],
            'bidang'   => ['required' => 'Bidang wajib diisi.'],
        ];

        if (! $this->validateData($data, $rules, $messages)) {
            return redirect()->back()->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            $akun = [
                'name'     => $data['nama'],
                'email'    => $data['email'],
                'password' => password_hash($data['password'], PASSWORD_DEFAULT),
                'role'     => 'mentor',
            ];

            // Mentor baru menunggu verifikasi admin
            if ($db->fieldExists('is_verified', 'users')) {
                $akun['is_verified'] = 0;
            }

            $userId = (new UserModel())->insert($akun);

            if (! $userId) {
                throw new \RuntimeException($db->error()['message'] ?? 'Gagal menyimpan akun.');
            }

            $profil = [
                'user_id' => $userId,
                'nip'     => $data['nip'],
                'jabatan' => $data['jabatan'],
                'bidang'  => $data['bidang'],
            ];

            if ($db->fieldExists('nama', 'mentor_profiles')) {
                $profil['nama'] = $data['nama'];
            }

            if ((new MentorProfileModel())->insert($profil) === false) {
                throw new \RuntimeException($db->error()['message'] ?? 'Gagal menyimpan profil mentor.');
            }

            $db->transCommit();
        } catch (\Throwable $e) {
            $db->transRollback();

            return $this->registrasiGagal('mentor', $e->getMessage());
        }

        return redirect()->to('/login')
            ->with('success', 'Registrasi mentor berhasil. Akun kamu bisa dipakai login setelah diverifikasi admin.');
    }

    /**
     * Registrasi gagal di database: catat penyebabnya ke log (writable/logs),
     * dan tampilkan detailnya hanya di mode development.
     */
    private function registrasiGagal(string $jenis, string $detail)
    {
        log_message('error', 'Registrasi {jenis} gagal: {detail}', ['jenis' => $jenis, 'detail' => $detail]);

        $pesan = 'Registrasi gagal disimpan. Silakan coba lagi.';
        if (ENVIRONMENT !== 'production' && $detail !== '') {
            $pesan .= ' (Detail: ' . $detail . ')';
        }

        return redirect()->back()->withInput()->with('error', $pesan);
    }

    // ================= LOGOUT =================
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}