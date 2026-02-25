<h2>Jurnal Magang Saya</h2>

<a href="<?= base_url('journal/create') ?>">➕ Tambah Jurnal</a>

<br><br>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Tanggal</th>
        <th>Deskripsi</th>
        <th>Status</th>
        <th>Catatan Mentor</th>
        <th>Aksi</th>
    </tr>

    <?php if (!empty($journals)): ?>
        <?php foreach ($journals as $j): ?>
            <tr>
                <td><?= esc($j['tanggal']) ?></td>
                <td><?= esc($j['deskripsi']) ?></td>

                <td>
                    <?php if ($j['status'] === 'approved'): ?>
                        <span style="color:green;font-weight:bold;">✔ Disetujui</span>
                    <?php elseif ($j['status'] === 'rejected'): ?>
                        <span style="color:red;font-weight:bold;">❌ Ditolak</span>
                    <?php else: ?>
                        <span style="color:orange;">⏳ Menunggu</span>
                    <?php endif ?>
                </td>

                <td>
                    <?= !empty($j['mentor_note']) ? esc($j['mentor_note']) : '-' ?>
                </td>

                <!-- ✅ AKSI -->
                <td>
    <?php if ($j['status'] === 'pending'): ?>

        <!-- EDIT -->
        <a href="<?= base_url('journal/edit/' . $j['id']) ?>">
            ✏️ Edit
        </a>

        <!-- HAPUS (GET, AMAN) -->
        <a href="<?= base_url('journal/delete/' . $j['id']) ?>"
           onclick="return confirm('Yakin hapus jurnal ini?')">
            🗑️ Hapus
        </a>

    <?php else: ?>
        <span style="color:gray;">-</span>
    <?php endif ?>
</td>
            </tr>
        <?php endforeach ?>
    <?php else: ?>
        <tr>
            <td colspan="5" style="text-align:center;">
                Belum ada jurnal.
            </td>
        </tr>
    <?php endif ?>
</table>

<br>
<a href="<?= base_url('dashboard') ?>">⬅️ Kembali ke Dashboard</a>