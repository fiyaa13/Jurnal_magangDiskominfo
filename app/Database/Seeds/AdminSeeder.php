<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\CLI\CLI;
use CodeIgniter\Database\Seeder;

/**
 * Membuat akun admin pertama.
 * Akun admin TIDAK bisa dibuat lewat halaman registrasi publik.
 *
 * Jalankan: php spark db:seed AdminSeeder
 *
 * Data admin diambil dari file .env (opsional):
 *   ADMIN_NAME     = "Administrator"
 *   ADMIN_EMAIL    = "admin@wonogirikab.go.id"
 *   ADMIN_PASSWORD = "isi-password-kuat"
 *
 * Jika ADMIN_PASSWORD tidak diisi, password acak dibuat dan
 * ditampilkan SEKALI di terminal. Catat, lalu segera ganti.
 */
class AdminSeeder extends Seeder
{
    public function run()
    {
        $nama     = trim((string) env('ADMIN_NAME', 'Administrator'));
        $email    = mb_strtolower(trim((string) env('ADMIN_EMAIL', 'admin@siamang.local')));
        $password = (string) env('ADMIN_PASSWORD', '');

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            CLI::error("ADMIN_EMAIL tidak valid: {$email}");
            return;
        }

        $users = new UserModel();

        if ($users->where('email', $email)->first()) {
            CLI::write("Akun dengan email {$email} sudah ada. Tidak ada yang diubah.", 'yellow');
            return;
        }

        $passwordAcak = $password === '';
        if ($passwordAcak) {
            $password = $this->passwordAcak();
        } elseif (strlen($password) < 8) {
            CLI::error('ADMIN_PASSWORD minimal 8 karakter.');
            return;
        }

        $id = $users->insert([
            'name'     => $nama,
            'email'    => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role'     => 'admin',
        ]);

        if (! $id) {
            $err = $this->db->error()['message'] ?? 'tidak diketahui';
            CLI::error("Gagal membuat akun admin: {$err}");
            CLI::write("Jika pesannya soal kolom 'role', jalankan dulu: php spark migrate", 'yellow');
            return;
        }

        CLI::write('Akun admin berhasil dibuat.', 'green');
        CLI::write("  Email    : {$email}");

        if ($passwordAcak) {
            CLI::write("  Password : {$password}", 'yellow');
            CLI::write('  Password ini hanya ditampilkan sekali. Catat sekarang.', 'yellow');
        } else {
            CLI::write('  Password : (sesuai ADMIN_PASSWORD di .env)');
            CLI::write('  Hapus ADMIN_PASSWORD dari .env setelah ini.', 'yellow');
        }
    }

    /** Password acak 14 karakter tanpa huruf yang mirip (0/O, 1/l/I). */
    private function passwordAcak(): string
    {
        $huruf = 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $hasil = '';

        for ($i = 0; $i < 14; $i++) {
            $hasil .= $huruf[random_int(0, strlen($huruf) - 1)];
        }

        return $hasil;
    }
}