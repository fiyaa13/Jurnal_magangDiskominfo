<h2>Validasi Jurnal Mahasiswa</h2>

<table border="1" cellpadding="8">
<tr>
    <th>Nama Mahasiswa</th>
    <th>Tanggal</th>
    <th>Deskripsi</th>
    <th>Status</th>
    <th>Catatan Mentor</th>
    <th>Aksi</th>
</tr>

    <?php foreach ($journals as $j): ?>
    <tr>
        <td><?= esc($j['nama_mahasiswa']) ?></td>
<td><?= esc($j['tanggal']) ?></td>
<td><?= esc($j['deskripsi']) ?></td>
<td><?= esc($j['status']) ?></td>
<td><?= esc($j['mentor_note'] ?? '-') ?></td>
        <td>

            <?php if ($j['status'] == 'pending'): ?>

            <!-- APPROVE -->
            <form action="/mentor/journal/approve/<?= $j['id'] ?>" method="post" style="margin-bottom:5px">
                <?= csrf_field() ?>
                <textarea name="mentor_note" placeholder="Catatan mentor"></textarea><br>
                <button type="submit">✅ Setujui</button>
            </form>

            <!-- REJECT -->
            <form action="/mentor/journal/reject/<?= $j['id'] ?>" method="post">
                <?= csrf_field() ?>
                <textarea name="mentor_note" placeholder="Alasan penolakan"></textarea><br>
                <button type="submit">❌ Tolak</button>
            </form>

            <?php else: ?>
                ✔ Sudah divalidasi
            <?php endif ?>
    </td>
</tr>
<?php endforeach ?>
</table>
<a href="/dashboard">⬅️ Kembali ke Dashboard</a>