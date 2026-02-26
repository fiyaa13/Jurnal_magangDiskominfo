<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Times New Roman, serif; }
        .header { text-align: center; margin-bottom: 20px; }
        table { width: 100%; margin-bottom: 20px; }
        td { padding: 4px; }
    </style>
</head>
<body>

<div class="header">
    <h3>JURNAL MAGANG MAHASISWA</h3>
</div>

<table>
    <tr>
        <td width="30%">Nama</td>
        <td>: <?= $mahasiswa['nama']; ?></td>
    </tr>
    <tr>
        <td>NIM</td>
        <td>: <?= $mahasiswa['nim']; ?></td>
    </tr>
    <tr>
        <td>Asal Universitas</td>
        <td>: <?= $mahasiswa['asal_universitas']; ?></td>
    </tr>
    <tr>
        <td>Bidang Magang</td>
        <td>: <?= $mahasiswa['bidang_magang']; ?></td>
    </tr>
    <tr>
        <td>Periode Magang</td>
        <td>: <?= $mahasiswa['periode_magang']; ?></td>
    </tr>
</table>

<hr>

<!-- isi jurnal di bawah sini -->
<p>Isi jurnal kegiatan magang...</p>

</body>
</html>