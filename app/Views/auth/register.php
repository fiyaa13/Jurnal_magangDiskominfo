<h2>Register Akun</h2>

<?php if (session()->getFlashdata('error')): ?>
    <p style="color:red;">
        <?= session()->getFlashdata('error') ?>
    </p>
<?php endif ?>

<form action="/register" method="post">
    <?= csrf_field() ?>

    <label>Nama</label><br>
    <input type="text" name="name" required><br><br>

    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <label>Role</label><br>
    <select name="role" required>
        <option value="">-- Pilih Role --</option>
        <option value="mahasiswa">Mahasiswa</option>
        <option value="mentor">Mentor</option>
    </select><br><br>

    <button type="submit">Daftar</button>
</form>

<hr>

<a href="/login">⬅️ Kembali ke Login</a>