<h2>Riwayat Validasi Jurnal</h2>

<a href="/mentor/journal">⬅ Kembali ke Jurnal Pending</a>

<table border="1" cellpadding="8">
<tr>
    <th>Nama Mahasiswa</th>
    <th>Tanggal</th>
    <th>Deskripsi</th>
    <th>Status</th>
    <th>Catatan Mentor</th>
</tr>

<?php foreach ($journals as $j): ?>
<tr>
    <td><?= esc($j['nama_mahasiswa']) ?></td>
    <td><?= esc($j['tanggal']) ?></td>
    <td><?= esc($j['deskripsi']) ?></td>
    <td>
        <?php if ($j['status'] === 'approved'): ?>
            <span style="color:green">✔ Disetujui</span>
        <?php else: ?>
            <span style="color:red">❌ Ditolak</span>
        <?php endif ?>
    </td>
    <td><?= esc($j['mentor_note'] ?? '-') ?></td>
</tr>
<?php endforeach ?>
</table>