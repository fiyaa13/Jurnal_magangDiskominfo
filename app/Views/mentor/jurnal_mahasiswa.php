<h2>📘 Jurnal Mahasiswa</h2>

<a href="/mentor/mahasiswa">⬅ Kembali</a>

<hr>

<?php if (empty($journals)): ?>
    <p>Belum ada jurnal.</p>
<?php else: ?>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Tanggal</th>
            <th>Kegiatan</th>
            <th>Status</th>
        </tr>

        <?php foreach ($journals as $j): ?>
            <tr>
                <td><?= esc($j['tanggal']) ?></td>
                <td><?= esc($j['kegiatan']) ?></td>
                <td><?= esc($j['status']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>