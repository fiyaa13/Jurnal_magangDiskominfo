<?php

namespace App\Controllers;

use App\Models\UserModel;

/**
 * Halaman admin: ringkasan, kelola mahasiswa (atur pembimbing),
 * kelola mentor (verifikasi), reset password, dan hapus akun.
 */
class AdminController extends BaseController
{
    /** Lapis kedua selain filter route: hanya admin yang boleh masuk. */
    private function bukanAdmin()
    {
        return session()->get('role') !== 'admin' ? redirect()->to('/dashboard') : null;
    }

    /** Angka kecil di menu sidebar admin. */
    private function hitungMenu(): array
    {
        $db = db_connect();

        return [
            'mentor'    => $db->table('users')->where('role', 'mentor')->where('is_verified', 0)->countAllResults(),
            'mahasiswa' => $db->table('mahasiswa_profiles')->where('mentor_id', null)->countAllResults(),
        ];
    }

    // =========================
    // RINGKASAN
    // =========================
    public function index()
    {
        if ($r = $this->bukanAdmin()) {
            return $r;
        }

        $db = db_connect();

        $jurnal = ['pending' => 0, 'approved' => 0, 'rejected' => 0];
        foreach ($db->table('journals')->select('status, COUNT(*) AS n')->groupBy('status')->get()->getResultArray() as $row) {
            $jurnal[$row['status']] = (int) $row['n'];
        }

        $stats = [
            'mahasiswa'        => $db->table('users')->where('role', 'mahasiswa')->countAllResults(),
            'mentor_aktif'     => $db->table('users')->where('role', 'mentor')->where('is_verified', 1)->countAllResults(),
            'mentor_menunggu'  => $db->table('users')->where('role', 'mentor')->where('is_verified', 0)->countAllResults(),
            'tanpa_pembimbing' => $db->table('mahasiswa_profiles')->where('mentor_id', null)->countAllResults(),
            'jurnal'           => $jurnal,
            'jurnal_total'     => array_sum($jurnal),
        ];

        $mentorMenunggu = $db->table('users u')
            ->select('u.id, u.name, u.email, u.created_at, mp.nip, mp.jabatan, mp.bidang')
            ->join('mentor_profiles mp', 'mp.user_id = u.id', 'left')
            ->where('u.role', 'mentor')
            ->where('u.is_verified', 0)
            ->orderBy('u.created_at', 'ASC')
            ->get()->getResultArray();

        return view('admin/index', [
            'stats'          => $stats,
            'mentorMenunggu' => $mentorMenunggu,
            'menu'           => $this->hitungMenu(),
        ]);
    }

    // =========================
    // DAFTAR MAHASISWA
    // =========================
    public function mahasiswa()
    {
        if ($r = $this->bukanAdmin()) {
            return $r;
        }

        $db = db_connect();

        $mahasiswa = $db->table('users u')
            ->select('u.id, u.name, u.email, p.nim, p.asal_universitas, p.bidang_magang, p.periode_magang, p.mentor_id, m.name AS nama_pembimbing', false)
            ->select('(SELECT COUNT(*) FROM journals j WHERE j.user_id = u.id) AS total_jurnal', false)
            ->select("(SELECT COUNT(*) FROM journals j WHERE j.user_id = u.id AND j.status = 'pending') AS total_pending", false)
            ->join('mahasiswa_profiles p', 'p.user_id = u.id', 'left')
            ->join('users m', 'm.id = p.mentor_id', 'left')
            ->where('u.role', 'mahasiswa')
            ->orderBy('(p.mentor_id IS NULL)', 'DESC', false)
            ->orderBy('u.name', 'ASC')
            ->get()->getResultArray();

        $daftarMentor = $db->table('users u')
            ->select('u.id, u.name, mp.bidang')
            ->join('mentor_profiles mp', 'mp.user_id = u.id', 'left')
            ->where('u.role', 'mentor')
            ->where('u.is_verified', 1)
            ->orderBy('u.name', 'ASC')
            ->get()->getResultArray();

        return view('admin/mahasiswa', [
            'mahasiswa'    => $mahasiswa,
            'daftarMentor' => $daftarMentor,
            'menu'         => $this->hitungMenu(),
        ]);
    }

    // =========================
    // DAFTAR MENTOR
    // =========================
    public function mentor()
    {
        if ($r = $this->bukanAdmin()) {
            return $r;
        }

        $mentor = db_connect()->table('users u')
            ->select('u.id, u.name, u.email, u.is_verified, u.created_at, mp.nip, mp.jabatan, mp.bidang')
            ->select('(SELECT COUNT(*) FROM mahasiswa_profiles p WHERE p.mentor_id = u.id) AS jumlah_bimbingan', false)
            ->join('mentor_profiles mp', 'mp.user_id = u.id', 'left')
            ->where('u.role', 'mentor')
            ->orderBy('u.is_verified', 'ASC')
            ->orderBy('u.name', 'ASC')
            ->get()->getResultArray();

        return view('admin/mentor', [
            'mentor' => $mentor,
            'menu'   => $this->hitungMenu(),
        ]);
    }

    // =========================
    // VERIFIKASI MENTOR
    // =========================
    public function verifikasi($id)
    {
        if ($r = $this->bukanAdmin()) {
            return $r;
        }

        $user = (new UserModel())->find($id);

        if (! $user || $user['role'] !== 'mentor') {
            return redirect()->back()->with('error', 'Akun mentor tidak ditemukan.');
        }

        (new UserModel())->update($id, ['is_verified' => 1]);

        return redirect()->back()->with('success', "Akun mentor {$user['name']} sudah diverifikasi dan bisa login.");
    }

    // =========================
    // ATUR PEMBIMBING
    // =========================
    public function setPembimbing($id)
    {
        if ($r = $this->bukanAdmin()) {
            return $r;
        }

        $db       = db_connect();
        $mentorId = (int) $this->request->getPost('mentor_id');

        $mahasiswa = (new UserModel())->find($id);
        if (! $mahasiswa || $mahasiswa['role'] !== 'mahasiswa') {
            return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan.');
        }

        if ($db->table('mahasiswa_profiles')->where('user_id', $id)->countAllResults() === 0) {
            return redirect()->back()->with('error', "Profil {$mahasiswa['name']} belum ada, jadi pembimbing belum bisa diatur.");
        }

        $namaMentor = null;
        if ($mentorId > 0) {
            $mentor = (new UserModel())->find($mentorId);
            if (! $mentor || $mentor['role'] !== 'mentor' || (int) $mentor['is_verified'] !== 1) {
                return redirect()->back()->with('error', 'Mentor yang dipilih tidak valid atau belum diverifikasi.');
            }
            $namaMentor = $mentor['name'];
        }

        $db->table('mahasiswa_profiles')
            ->where('user_id', $id)
            ->update(['mentor_id' => $mentorId > 0 ? $mentorId : null]);

        return redirect()->back()->with('success', $namaMentor
            ? "Pembimbing {$mahasiswa['name']} diatur ke {$namaMentor}."
            : "Pembimbing {$mahasiswa['name']} dikosongkan.");
    }

    // =========================
    // RESET PASSWORD
    // =========================
    public function resetPassword($id)
    {
        if ($r = $this->bukanAdmin()) {
            return $r;
        }

        $user = (new UserModel())->find($id);

        if (! $user || ! in_array($user['role'], ['mahasiswa', 'mentor'], true)) {
            return redirect()->back()->with('error', 'Akun tidak ditemukan.');
        }

        $baru = $this->passwordAcak();
        (new UserModel())->update($id, ['password' => password_hash($baru, PASSWORD_DEFAULT)]);

        return redirect()->back()->with('password_baru', [
            'nama'     => $user['name'],
            'email'    => $user['email'],
            'password' => $baru,
        ]);
    }

    // =========================
    // HAPUS AKUN (juga dipakai untuk menolak pendaftaran mentor)
    // =========================
    public function hapus($id)
    {
        if ($r = $this->bukanAdmin()) {
            return $r;
        }

        $user = (new UserModel())->find($id);

        if (! $user || ! in_array($user['role'], ['mahasiswa', 'mentor'], true)) {
            return redirect()->back()->with('error', 'Akun tidak ditemukan atau tidak boleh dihapus.');
        }

        $db        = db_connect();
        $fileBukti = [];

        $db->transBegin();

        try {
            if ($user['role'] === 'mahasiswa') {
                $fileBukti = array_filter(array_column(
                    $db->table('journals')->select('bukti')->where('user_id', $id)->get()->getResultArray(),
                    'bukti'
                ));
                $db->table('journals')->where('user_id', $id)->delete();
                $db->table('mahasiswa_profiles')->where('user_id', $id)->delete();
            } else {
                $db->table('mahasiswa_profiles')->where('mentor_id', $id)->update(['mentor_id' => null]);
                $db->table('mentor_profiles')->where('user_id', $id)->delete();
            }

            $db->table('users')->where('id', $id)->delete();

            if ($db->transStatus() === false) {
                throw new \RuntimeException($db->error()['message'] ?? 'Gagal menghapus akun.');
            }

            $db->transCommit();
        } catch (\Throwable $e) {
            $db->transRollback();
            log_message('error', 'Hapus akun {id} gagal: {msg}', ['id' => $id, 'msg' => $e->getMessage()]);

            return redirect()->back()->with('error', 'Akun gagal dihapus. Detail tercatat di log.');
        }

        // File foto dihapus setelah database berhasil
        foreach ($fileBukti as $nama) {
            $path = WRITEPATH . 'uploads/bukti/' . basename($nama);
            if (is_file($path)) {
                unlink($path);
            }
        }

        $label = (int) ($user['is_verified'] ?? 1) === 0 ? 'Pendaftaran mentor' : 'Akun';

        return redirect()->back()->with('success', "{$label} {$user['name']} sudah dihapus.");
    }

    /** Password sementara 10 karakter tanpa huruf yang mirip (0/O, 1/l/I). */
    private function passwordAcak(): string
    {
        $huruf = 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $hasil = '';
        for ($i = 0; $i < 10; $i++) {
            $hasil .= $huruf[random_int(0, strlen($huruf) - 1)];
        }

        return $hasil;
    }
}