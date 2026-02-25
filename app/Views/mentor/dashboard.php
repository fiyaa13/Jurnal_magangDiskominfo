<h2>Dashboard Mentor</h2>

<p>Selamat datang, <strong><?= esc(session()->get('name')) ?></strong></p>

<hr>

<ul>
    <li>
        <a href="/mentor/journal">📋 Validasi Jurnal Mahasiswa</a>
    </li>

    <li>
        <a href="/mentor/history">🗂 Riwayat Validasi Jurnal</a>
    </li>

    <li>
        <a href="/mentor/mahasiswa">👨‍🎓 Daftar Mahasiswa</a>
    </li>
</ul>

<a href="/logout">🚪 Logout</a>