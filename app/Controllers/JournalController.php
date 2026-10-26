<?php

namespace App\Controllers;

use App\Models\JournalModel;
use App\Models\MahasiswaProfileModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use Dompdf\Dompdf;

class JournalController extends BaseController
{
    protected $journal;

    public function __construct()
    {
        $this->journal = new JournalModel();
    }

    // =========================
    // HELPER INTERNAL
    // =========================

    /** Profil mahasiswa yang sedang login (null jika belum diisi). */
    private function currentProfile(): ?array
    {
        return (new MahasiswaProfileModel())
            ->where('user_id', session()->get('id'))
            ->first();
    }

    /** Data yang dibutuhkan sidebar di setiap halaman jurnal. */
    private function sidebarData(): array
    {
        return [
            'profile'     => $this->currentProfile(),
            'totalJurnal' => $this->journal
                ->where('user_id', session()->get('id'))
                ->countAllResults(),
        ];
    }

    // =========================
    // LIST JURNAL MAHASISWA
    // =========================
    public function index()
    {
        if (session()->get('role') !== 'mahasiswa') {
            return redirect()->to('/dashboard');
        }

        $journals = $this->journal
            ->where('user_id', session()->get('id'))
            ->orderBy('tanggal', 'ASC')
            ->findAll();

        // Semua jurnal sudah diambil di atas, jadi hitung dari hasil itu
        // (sebelumnya 4 query COUNT terpisah ke database)
        $perStatus = array_count_values(array_column($journals, 'status'));

        return view('journal/index', [
            'profile'       => $this->currentProfile(),
            'journals'      => $journals,
            'totalJurnal'   => count($journals),
            'totalPending'  => $perStatus['pending'] ?? 0,
            'totalApproved' => $perStatus['approved'] ?? 0,
            'totalRejected' => $perStatus['rejected'] ?? 0,
        ]);
    }

    // =========================
    // FORM TAMBAH
    // =========================
    public function create()
    {
        if (session()->get('role') !== 'mahasiswa') {
            return redirect()->to('/dashboard');
        }

        return view('journal/create', $this->sidebarData());
    }

    // =========================
    // SIMPAN JURNAL
    // =========================
    public function store()
    {
        if (session()->get('role') !== 'mahasiswa') {
            return redirect()->to('/dashboard');
        }

        $tanggal = $this->request->getPost('tanggal');

        // Validasi hari Senin–Jumat
        $day = date('N', strtotime($tanggal));
        if ($day > 5) {
            return redirect()->back()->withInput()
                ->with('error', 'Jurnal hanya boleh diisi hari Senin–Jumat');
        }

        // Foto bukti (opsional): JPG/PNG, maksimal 2 MB
        $namaBukti = null;
        $file      = $this->request->getFile('bukti');

        if ($file !== null && $file->getError() !== UPLOAD_ERR_NO_FILE) {
            $valid = $this->validate([
                'bukti' => [
                    'rules'  => 'uploaded[bukti]|is_image[bukti]|mime_in[bukti,image/jpg,image/jpeg,image/png]|max_size[bukti,2048]',
                    'errors' => [
                        'uploaded' => 'Foto bukti gagal diunggah, coba lagi.',
                        'is_image' => 'File bukti harus berupa gambar.',
                        'mime_in'  => 'Format foto bukti harus JPG, JPEG, atau PNG.',
                        'max_size' => 'Ukuran foto bukti maksimal 2 MB.',
                    ],
                ],
            ]);

            if (! $valid) {
                return redirect()->back()->withInput()
                    ->with('error', $this->validator->getError('bukti'));
            }

            $namaBukti = $file->getRandomName();
            $file->move($this->buktiDir(), $namaBukti);
        }

        $this->journal->insert([
            'user_id'     => session()->get('id'),
            'minggu'      => ceil(date('j', strtotime($tanggal)) / 7),
            'tanggal'     => $tanggal,
            'hari'        => date('l', strtotime($tanggal)),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'bukti'       => $namaBukti,
            'status'      => 'pending',
            'mentor_note' => null,
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

        return view('journal/edit', ['journal' => $journal] + $this->sidebarData());
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
            'mentor_note' => null,
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

        // Hapus juga file foto buktinya
        if (! empty($journal['bukti']) && is_file($this->buktiDir() . basename($journal['bukti']))) {
            unlink($this->buktiDir() . basename($journal['bukti']));
        }

        return redirect()->to('/journal')
            ->with('success', 'Jurnal berhasil dihapus');
    }

    // =========================
    // TAMPILKAN FOTO BUKTI
    // Hanya pemilik jurnal dan mentor yang boleh melihat.
    // =========================
    public function bukti($id)
    {
        $journal = $this->journal->find($id);
        $role    = session()->get('role');

        $bolehLihat = $journal
            && ! empty($journal['bukti'])
            && ($role === 'mentor' || ($role === 'mahasiswa' && $journal['user_id'] == session()->get('id')));

        $path = $bolehLihat ? $this->buktiDir() . basename($journal['bukti']) : null;

        if ($path === null || ! is_file($path)) {
            throw PageNotFoundException::forPageNotFound('Foto bukti tidak ditemukan');
        }

        return $this->response
            ->setHeader('Content-Type', mime_content_type($path) ?: 'image/jpeg')
            ->setHeader('Cache-Control', 'private, max-age=86400')
            ->setBody(file_get_contents($path));
    }

    /** Folder penyimpanan foto bukti (di luar folder public, jadi tidak bisa diakses langsung). */
    private function buktiDir(): string
    {
        return WRITEPATH . 'uploads/bukti/';
    }

    // =========================
    // DOWNLOAD PDF
    // =========================
    public function downloadPdf()
    {
        if (session()->get('role') !== 'mahasiswa') {
            return redirect()->to('/dashboard');
        }

        $profile = $this->currentProfile();

        if (! $profile) {
            return redirect()->back()->with('error', 'Profil mahasiswa belum lengkap');
        }

        $journals = $this->journal
            ->where('user_id', session()->get('id'))
            ->orderBy('tanggal', 'ASC')
            ->findAll();

        $html = view('journal/pdf', [
            'profile'  => $profile,
            'journals' => $journals,
            'nama'     => session()->get('name'),
        ]);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // "Halaman X dari Y" di kanan bawah setiap halaman
        $dompdf->getCanvas()->page_script(static function ($pageNumber, $pageCount, $canvas, $fontMetrics) {
            $text  = "Halaman {$pageNumber} dari {$pageCount}";
            $font  = $fontMetrics->getFont('Times-Roman');
            $size  = 9;
            $width = $fontMetrics->getTextWidth($text, $font, $size);
            // tepi kanan = lebar kertas − margin kanan 2 cm (56.7 pt)
            $canvas->text($canvas->get_width() - 56.7 - $width, $canvas->get_height() - 36, $text, $font, $size, [0.33, 0.33, 0.33]);
        });

        // contoh nama file: jurnal-magang-K3523015.pdf
        $nim = preg_replace('/[^A-Za-z0-9]/', '', (string) ($profile['nim'] ?? ''));

        return $dompdf->stream('jurnal-magang' . ($nim !== '' ? '-' . $nim : '') . '.pdf', ['Attachment' => true]);
    }
}
