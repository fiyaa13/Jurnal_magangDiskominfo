<h2>Tambah Jurnal Magang</h2>

<form action="<?= site_url('journal/store') ?>" method="post">
    <?= csrf_field(); ?>

    <label>Tanggal</label><br>
    <input type="date" name="tanggal" required><br><br>

    <label>Deskripsi</label><br>
    <textarea name="deskripsi" required></textarea><br><br>

    <button type="submit">Simpan</button>
</form>

<a href="<?= site_url('journal') ?>">⬅️ Kembali</a>