<?php

namespace App\Controllers;

use App\Models\MahasiswaProfileModel;
use Dompdf\Dompdf;

class Mahasiswa extends BaseController
{
    public function downloadPdf()
    {
        if (session()->get('role') !== 'mahasiswa') {
            return redirect()->to('/dashboard');
        }

        $profileModel = new MahasiswaProfileModel();

        // ambil data mahasiswa berdasarkan user login
        $dataMahasiswa = $profileModel->where(
            'user_id',
            session()->get('user_id')
        )->first();

        if (!$dataMahasiswa) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan');
        }

        $html = view('mahasiswa/pdf_jurnal', [
            'mahasiswa' => $dataMahasiswa
        ]);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('Jurnal_Mahasiswa.pdf', ['Attachment' => true]);
    }
}