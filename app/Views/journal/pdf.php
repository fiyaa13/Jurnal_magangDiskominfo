<?php
/**
 * Cetak PDF Jurnal Magang — dirender oleh Dompdf (A4 portrait)
 * Variabel dari controller: $profile (array), $journals (array), $nama (string)
 */
$profile  = $profile ?? [];
$journals = $journals ?? [];
$nama     = $nama ?? '-';

$namaHari  = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
$namaBulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
              'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

// "2026-10-26" -> "26 Oktober 2026"
$tglIndo = static function (string $tanggal) use ($namaBulan): string {
    $ts = strtotime($tanggal);
    return $ts ? date('j', $ts) . ' ' . $namaBulan[(int) date('n', $ts)] . ' ' . date('Y', $ts) : $tanggal;
};

// "2026-10-26" -> "26 Okt 2026" (untuk kolom tabel yang sempit)
$tglPendek = static function (string $tanggal) use ($namaBulan): string {
    $ts = strtotime($tanggal);
    if (! $ts) {
        return $tanggal;
    }
    $bulan = (int) date('n', $ts) === 8 ? 'Agu' : mb_substr($namaBulan[(int) date('n', $ts)], 0, 3);
    return date('j', $ts) . ' ' . $bulan . ' ' . date('Y', $ts);
};

// "2026-10-26" -> "Senin"
$hariIndo = static function (string $tanggal) use ($namaHari): string {
    $ts = strtotime($tanggal);
    return $ts ? $namaHari[(int) date('w', $ts)] : '';
};

$labelStatus = [
    'approved' => 'Disetujui',
    'rejected' => 'Ditolak',
    'pending'  => 'Menunggu',
];

$identitas = [
    'Nama'             => $nama,
    'NIM'              => $profile['nim'] ?? '-',
    'Asal Universitas' => $profile['asal_universitas'] ?? '-',
    'Bidang Magang'    => $profile['bidang_magang'] ?? '-',
    'Periode Magang'   => $profile['periode_magang'] ?? '-',
];

$jumlahJurnal = count($journals);
$hariHadir    = count(array_unique(array_column($journals, 'tanggal')));
$disetujui    = count(array_filter($journals, static fn ($j) => ($j['status'] ?? '') === 'approved'));
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Jurnal Magang — <?= esc($nama) ?></title>
  <style>
    @page { margin: 2cm 2cm 2.4cm 2.5cm; }

    body {
      font-family: "Times New Roman", Times, serif;
      font-size: 11pt;
      line-height: 1.4;
      color: #000;
    }

    /* ── Kop ── */
    .kop {
      text-align: center;
      padding-bottom: 8px;
      margin-bottom: 18px;
      border-bottom: 3px double #000;
    }
    .kop .instansi { font-size: 11pt; letter-spacing: 0.5px; }
    .kop h1 { font-size: 15pt; letter-spacing: 1px; margin: 4px 0 2px; }
    .kop .sub { font-size: 10pt; }

    /* ── Identitas ── */
    table.identitas { border-collapse: collapse; margin-bottom: 6px; }
    table.identitas td { padding: 2px 0; vertical-align: top; }
    table.identitas .label { width: 125px; }
    table.identitas .titik { width: 14px; }

    .ringkasan { font-size: 10pt; margin-top: 6px; }

    h2 {
      font-size: 11pt;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin: 18px 0 8px;
    }

    /* ── Tabel jurnal ── */
    table.jurnal { width: 100%; border-collapse: collapse; }
    table.jurnal thead { display: table-header-group; }
    table.jurnal tr { page-break-inside: avoid; }

    table.jurnal th,
    table.jurnal td {
      border: 1px solid #000;
      padding: 5px 6px;
      vertical-align: top;
    }

    table.jurnal th {
      background: #e5e5e5;
      font-size: 10.5pt;
      text-align: center;
      vertical-align: middle;
    }

    .c-no      { width: 26px; text-align: center; }
    .c-tanggal { width: 92px; }
    .c-status  { width: 66px; text-align: center; }
    .c-catatan { width: 120px; }

    .hari { font-weight: bold; }
    .kosong { text-align: center; font-style: italic; padding: 16px; }

    /* ── Tanda tangan ── */
    table.ttd { width: 100%; margin-top: 36px; page-break-inside: avoid; }
    table.ttd td { width: 50%; text-align: center; vertical-align: top; }
    .ttd .ruang { height: 64px; }
    .ttd .nama { font-weight: bold; text-decoration: underline; }

    /* ── Footer tiap halaman ── */
    .footer {
      position: fixed;
      bottom: -1.5cm;
      left: 0;
      right: 0;
      padding-top: 4px;
      border-top: 1px solid #999;
      font-size: 9pt;
      color: #555;
    }
    /* "Halaman X dari Y" di kanan footer ditulis oleh controller (page_script Dompdf) */
  </style>
</head>

<body>

  <div class="footer">
    Jurnal Magang · <?= esc($nama) ?> (<?= esc($profile['nim'] ?? '-') ?>)
  </div>

  <div class="kop">
    <div class="instansi">DINAS KOMUNIKASI DAN INFORMATIKA KABUPATEN WONOGIRI</div>
    <h1>JURNAL KEGIATAN MAGANG MAHASISWA</h1>
    <div class="sub">Sistem Jurnal Magang</div>
  </div>

  <table class="identitas">
    <?php foreach ($identitas as $label => $nilai): ?>
      <tr>
        <td class="label"><?= $label ?></td>
        <td class="titik">:</td>
        <td><?= esc($nilai) ?></td>
      </tr>
    <?php endforeach; ?>
  </table>

  <div class="ringkasan">
    Jumlah jurnal: <b><?= $jumlahJurnal ?></b> &nbsp;·&nbsp;
    Hari hadir: <b><?= $hariHadir ?> hari</b> &nbsp;·&nbsp;
    Disetujui mentor: <b><?= $disetujui ?></b>
  </div>

  <h2>Rincian Kegiatan</h2>

  <table class="jurnal">
    <thead>
      <tr>
        <th class="c-no">No</th>
        <th class="c-tanggal">Hari / Tanggal</th>
        <th>Uraian Kegiatan</th>
        <th class="c-status">Status</th>
        <th class="c-catatan">Catatan Mentor</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($journals): ?>
        <?php foreach ($journals as $i => $j): ?>
          <tr>
            <td class="c-no"><?= $i + 1 ?></td>
            <td>
              <span class="hari"><?= $hariIndo($j['tanggal']) ?></span><br>
              <?= $tglPendek($j['tanggal']) ?>
            </td>
            <td><?= nl2br(esc($j['deskripsi'])) ?></td>
            <td class="c-status"><?= $labelStatus[$j['status']] ?? esc($j['status']) ?></td>
            <td><?= ! empty($j['mentor_note']) ? nl2br(esc($j['mentor_note'])) : '-' ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="5" class="kosong">Belum ada jurnal kegiatan.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>

  <table class="ttd">
    <tr>
      <td>
        Mengetahui,<br>Pembimbing Lapangan
        <div class="ruang"></div>
        (.................................................)<br>
        NIP. ........................................
      </td>
      <td>
        Wonogiri, <?= $tglIndo(date('Y-m-d')) ?><br>Mahasiswa
        <div class="ruang"></div>
        <span class="nama"><?= esc($nama) ?></span><br>
        NIM. <?= esc($profile['nim'] ?? '-') ?>
      </td>
    </tr>
  </table>

</body>

</html>