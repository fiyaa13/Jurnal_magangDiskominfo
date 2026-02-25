<h2>Registrasi Mahasiswa Magang</h2>

<form action="<?= base_url('register/mahasiswa') ?>" method="post">

    <label>Nama Lengkap</label><br>
    <input type="text" name="name" required><br><br>

    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <hr>

    <label>NIM</label><br>
    <input type="text" name="nim" required><br><br>

    <label>Asal Universitas</label><br>
    <input type="text" name="asal_universitas" required><br><br>

    <label>Bidang Magang</label><br>
    <input type="text" name="bidang_magang" required><br><br>

    <label>Periode Magang</label><br>
    <input type="text" name="periode_magang" placeholder="Contoh: Jan–Jun 2026" required><br><br>

    <button type="submit">Daftar sebagai Mahasiswa</button>

</form>

<br>
<a href="<?= base_url('login') ?>">Sudah punya akun? Login</a>