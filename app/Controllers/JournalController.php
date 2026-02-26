<?php

namespace App\Controllers;

use App\Models\JournalModel;
use Dompdf\Dompdf;
use App\Models\MahasiswaProfileModel;


class JournalController extends BaseController
{
    protected $journal;

    public function __construct()
    {
        $this->journal = new JournalModel();
    }

    // =========================
    // LIST JURNAL MAHASISWA
    // =========================
    public function index()
{
    if (session()->get('role') !== 'mahasiswa') {
        return redirect()->to('/dashboard');
    }

    $userId = session()->get('id');

    $journals = $this->journal
        ->where('user_id', $userId)
        ->orderBy('tanggal', 'ASC')
        ->findAll();

    $totalJurnal = $this->journal
        ->where('user_id', $userId)
        ->countAllResults();

    $totalPending = $this->journal
        ->where('user_id', $userId)
        ->where('status', 'pending')
        ->countAllResults();

    $totalApproved = $this->journal
        ->where('user_id', $userId)
        ->where('status', 'approved')
        ->countAllResults();

    $totalRejected = $this->journal
        ->where('user_id', $userId)
        ->where('status', 'rejected')
        ->countAllResults();

    return view('journal/index', [
        'journals'      => $journals,
        'totalJurnal'   => $totalJurnal,
        'totalPending'  => $totalPending,
        'totalApproved' => $totalApproved,
        'totalRejected' => $totalRejected,
    ]);
}

    // =========================
    // FORM TAMBAH
    // =========================
    public function create()
    {
        return view('journal/create');
    }

    // =========================
    // SIMPAN JURNAL
    // =========================
    public function store()
    {
        $tanggal = $this->request->getPost('tanggal');

        // Validasi hari Senin–Jumat
        $day = date('N', strtotime($tanggal));
        if ($day > 5) {
            return redirect()->back()
                ->with('error', 'Jurnal hanya boleh diisi hari Senin–Jumat');
        }

        $this->journal->insert([
            'user_id'     => session()->get('id'),
            'minggu'      => ceil(date('j', strtotime($tanggal)) / 7),
            'tanggal'     => $tanggal,
            'hari'        => date('l', strtotime($tanggal)),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'status'      => 'pending',
            'mentor_note' => null
        ]);

        return redirect()->to('/journal')
            ->with('success', 'Jurnal berhasil disimpan');
    }

    // =========================
    // FORM EDIT
    // =========================
    public function edit($id)
    {
        $journal = $this->journal->find($id);

        if (! $journal || $journal['user_id'] != session()->get('id')) {
            return redirect()->to('/journal')
                ->with('error', 'Akses ditolak');
        }

        // Hanya boleh edit jika masih pending
        if ($journal['status'] !== 'pending') {
            return redirect()->to('/journal')
                ->with('error', 'Jurnal yang sudah diproses tidak bisa diedit');
        }

        return view('journal/edit', ['journal' => $journal]);
    }

    // =========================
    // UPDATE
    // =========================
    public function update($id)
    {
        $journal = $this->journal->find($id);

        if (! $journal || $journal['user_id'] != session()->get('id')) {
            return redirect()->to('/journal')
                ->with('error', 'Akses ditolak');
        }

        if ($journal['status'] !== 'pending') {
            return redirect()->to('/journal')
                ->with('error', 'Jurnal tidak bisa diubah');
        }

        $this->journal->update($id, [
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'status'      => 'pending',
            'mentor_note' => null
        ]);

        return redirect()->to('/journal')
            ->with('success', 'Jurnal berhasil diperbarui');
    }

    // =========================
    // HAPUS
    // =========================
    public function delete($id)
    {
        $journal = $this->journal->find($id);

        if (! $journal || $journal['user_id'] != session()->get('id')) {
            return redirect()->to('/journal')
                ->with('error', 'Akses ditolak');
        }

        if ($journal['status'] !== 'pending') {
            return redirect()->to('/journal')
                ->with('error', 'Jurnal tidak bisa dihapus');
        }

        $this->journal->delete($id);

        return redirect()->to('/journal')
            ->with('success', 'Jurnal berhasil dihapus');
    }

public function downloadPdf()
{
    // proteksi role
    if (session()->get('role') !== 'mahasiswa') {
        return redirect()->to('/dashboard');
    }

    $userId = session()->get('id');

    $profileModel = new MahasiswaProfileModel();
    $journalModel = new JournalModel();

    // ambil profil mahasiswa
    $profile = $profileModel
        ->where('user_id', $userId)
        ->first();

    if (! $profile) {
        return redirect()->back()->with('error', 'Profil mahasiswa belum lengkap');
    }

    // ambil jurnal mahasiswa
    $journals = $journalModel
        ->where('user_id', $userId)
        ->orderBy('tanggal', 'ASC')
        ->findAll();

    // kirim ke view PDF
    $html = view('journal/pdf', [
        'profile'  => $profile,
        'journals' => $journals
    ]);

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    return $dompdf->stream(
        'jurnal-magang.pdf',
        ['Attachment' => true]
    );
}
}