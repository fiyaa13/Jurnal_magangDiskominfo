<h2>Dashboard Mahasiswa</h2>

<p>Selamat datang, <strong><?= esc(session()->get('name')) ?></strong></p>

<hr>

<h4>📄 Data Mahasiswa</h4>

<?php if ($profile): ?>
    <ul>
        <li><strong>NIM:</strong> <?= esc($profile['nim']) ?></li>
        <li><strong>Asal Universitas:</strong> <?= esc($profile['asal_universitas']) ?></li>
        <li><strong>Bidang Magang:</strong> <?= esc($profile['bidang_magang']) ?></li>
        <li><strong>Periode Magang:</strong> <?= esc($profile['periode_magang']) ?></li>
    </ul>
<?php else: ?>
    <p><em>Data profil mahasiswa belum lengkap.</em></p>
<?php endif; ?>

<hr>

<ul>
    <li>
        <a href="/journal">📘 Jurnal Magang</a>
    </li>
</ul>

<a href="/logout">🚪 Logout</a>