<?php

namespace App\Controllers;

use App\Models\JournalModel;

class MentorController extends BaseController
{
    protected $journal;

    public function __construct()
    {
        $this->journal = new JournalModel();
    }

    // 📋 jurnal pending
    public function index()
    {
        if (session()->get('role') !== 'mentor') {
            return redirect()->to('/dashboard');
        }

        $data['journals'] = $this->journal
            ->select('journals.*, users.name AS nama_mahasiswa')
            ->join('users', 'users.id = journals.user_id')
            ->where('journals.status', 'pending')
            ->orderBy('journals.tanggal', 'ASC')
            ->findAll();

        return view('mentor/journal', $data);
    }

    // ✅ approve
    public function approve($id)
    {
        $this->journal->update($id, [
            'status'      => 'approved',
            'mentor_note' => $this->request->getPost('mentor_note')
        ]);

        return redirect()->back();
    }

    // ❌ reject
    public function reject($id)
    {
        $this->journal->update($id, [
            'status'      => 'rejected',
            'mentor_note' => $this->request->getPost('mentor_note')
        ]);

        return redirect()->back();
    }

    // 📚 RIWAYAT VALIDASI
    public function history()
{
    // 🔐 proteksi mentor
    if (session()->get('role') !== 'mentor') {
        return redirect()->to('/dashboard');
    }

    $data['journals'] = $this->journal
        ->select('journals.*, users.name AS nama_mahasiswa')
        ->join('users', 'users.id = journals.user_id')
        ->whereIn('journals.status', ['approved', 'rejected'])
        ->orderBy('journals.updated_at', 'DESC')
        ->findAll();

    return view('mentor/history', $data);
}
public function mahasiswa()
{
    $this->protectMentor();

    $userModel = new UserModel();

    $keyword = $this->request->getGet('q');

    $userModel->where('role', 'mahasiswa');

    if ($keyword) {
        $userModel->like('name', $keyword);
    }

    $data['mahasiswa'] = $userModel->findAll();
    $data['keyword']   = $keyword;

    return view('mentor/mahasiswa', $data);
}
public function detailMahasiswa($userId)
{
    $this->protectMentor();

    $data['journals'] = $this->journal
        ->where('user_id', $userId)
        ->orderBy('tanggal', 'ASC')
        ->findAll();

    return view('mentor/jurnal_mahasiswa', $data);
}
}