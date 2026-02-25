<h2>Registrasi Mentor</h2>

<form action="<?= base_url('register/mentor') ?>" method="post">

    <label>Nama Mentor</label><br>
    <input type="text" name="name" required><br><br>

    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <hr>

    <label>NIP</label><br>
    <input type="text" name="nip" required><br><br>

    <label>Jabatan</label><br>
    <input type="text" name="jabatan" required><br><br>

    <label>Bidang</label><br>
    <input type="text" name="bidang" required><br><br>

    <button type="submit">Daftar sebagai Mentor</button>

</form>

<br>
<a href="<?= base_url('login') ?>">Sudah punya akun? Login</a>