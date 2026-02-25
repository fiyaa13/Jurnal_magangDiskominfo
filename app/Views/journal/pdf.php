<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Jurnal Magang</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2, h3 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 6px; }
        th { background: #eee; }
    </style>
</head>
<body>

<h2>JURNAL MAGANG MAHASISWA</h2>

<p>
    <strong>Nama:</strong> <?= esc($nama) ?><br>
    <strong>Tanggal Cetak:</strong> <?= date('d-m-Y') ?>
</p>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Deskripsi</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($journals as $i => $j): ?>
        <tr>
            <td><?= $i + 1 ?></td>
            <td><?= date('d-m-Y', strtotime($j['tanggal'])) ?></td>
            <td><?= esc($j['deskripsi']) ?></td>
            <td><?= ucfirst($j['status']) ?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

</body>
</html>