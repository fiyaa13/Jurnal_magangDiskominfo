<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>

    <h2>Dashboard Mahasiswa</h2>

    <p>Selamat datang, <b><?= session()->get('name'); ?></b></p>

    <a href="/logout">Logout</a>

</body>
</html>
