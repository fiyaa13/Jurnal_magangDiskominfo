<h2>Edit Jurnal</h2>

<form action="<?= base_url('journal/update/' . $journal['id']) ?>" method="post">

    <p>
        Tanggal <br>
        <input type="date" name="tanggal"
               value="<?= $journal['tanggal']; ?>"
               readonly>
    </p>

    <p>
        Deskripsi <br>
        <textarea name="deskripsi" rows="5" required><?= esc($journal['deskripsi']); ?></textarea>
    </p>

    <button type="submit">💾 Simpan Perubahan</button>
    <a href="<?= base_url('journal') ?>">⬅️ Batal</a>

</form>