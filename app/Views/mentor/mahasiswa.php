<h2>📋 Daftar Mahasiswa Magang</h2>

<form method="get">
    <input type="text" name="q" placeholder="Cari nama mahasiswa"
           value="<?= esc($keyword ?? '') ?>">
    <button type="submit">Cari</button>
</form>

<hr>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama Mahasiswa</th>
        <th>Aksi</th>
    </tr>

    <?php foreach ($mahasiswa as $i => $m): ?>
        <tr>
            <td><?= $i + 1 ?></td>
            <td><?= esc($m['name']) ?></td>
            <td>
                <a href="/mentor/mahasiswa/<?= $m['id'] ?>">
                    📘 Lihat Jurnal
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>