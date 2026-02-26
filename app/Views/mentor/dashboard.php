<h2>Dashboard Mentor</h2>

<p>Selamat datang, <strong><?= esc(session()->get('name')) ?></strong></p>

<hr>

<h3>📋 Daftar Mahasiswa Magang</h3>

<?php if (empty($mahasiswa)) : ?>
    <p>Belum ada mahasiswa yang mengisi jurnal.</p>
<?php else : ?>
    <ul>
        <?php foreach ($mahasiswa as $mhs) : ?>
            <li>
                <strong><?= esc($mhs['name']) ?></strong><br>
                Total jurnal: <?= $mhs['total_jurnal'] ?><br>
                <a href="/mentor/journal?user_id=<?= $mhs['id'] ?>">
                    📘 Lihat Jurnal
                </a>
            </li>
            <hr>
        <?php endforeach ?>
    </ul>
<?php endif ?>

<a href="/logout">🚪 Logout</a>