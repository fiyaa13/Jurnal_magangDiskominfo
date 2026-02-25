<h2>Dashboard Mahasiswa</h2>

<p>Selamat datang, <strong><?= esc(session()->get('name')) ?></strong></p>

<hr>

<ul>
    <li>
        <a href="/journal">📘 Jurnal Magang</a>
    </li>
</ul>

<a href="/logout">🚪 Logout</a>