<?php

namespace App\Controllers;

use App\Models\JournalModel;

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
        $data['journals'] = $this->journal
            ->where('user_id', session()->get('id'))
            ->orderBy('tanggal', 'ASC')
            ->findAll();

        return view('journal/index', $data);
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
            'user_id'   => session()->get('id'),
            'minggu'    => ceil(date('j', strtotime($tanggal)) / 7),
            'tanggal'   => $tanggal,
            'hari'      => date('l', strtotime($tanggal)),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'status'    => 'pending',
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

        if (!$journal || $journal['user_id'] != session()->get('id')) {
            return redirect()->to('/journal')
                ->with('error', 'Akses ditolak');
        }

        return view('journal/edit', compact('journal'));
    }

    // =========================
    // UPDATE
    // =========================
    public function update($id)
    {
        $journal = $this->journal->find($id);

        if (!$journal || $journal['user_id'] != session()->get('id')) {
            return redirect()->to('/journal')
                ->with('error', 'Akses ditolak');
        }

        $this->journal->update($id, [
            'deskripsi' => $this->request->getPost('deskripsi'),
            'status'    => 'pending', // reset saat diedit
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

        if (!$journal || $journal['user_id'] != session()->get('id')) {
            return redirect()->to('/journal')
                ->with('error', 'Akses ditolak');
        }

        $this->journal->delete($id);

        return redirect()->to('/journal')
            ->with('success', 'Jurnal berhasil dihapus');
    }
}