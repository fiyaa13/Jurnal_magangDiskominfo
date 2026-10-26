<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa - Sistem Jurnal Magang</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: #f0f4f8;
            color: #003366;
            min-height: 100vh;
        }

        .navbar {
            background: linear-gradient(135deg, #003366 0%, #0056B3 100%);
            padding: 0 40px;
            height: 70px;
            display: flex;
            align-items: center;
            box-shadow: 0 2px 12px rgba(0, 51, 102, 0.15);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .navbar-logo {
            width: 38px;
            height: 38px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
        }

        .navbar-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #FFFFFF;
            font-size: 18px;
            font-weight: 700;
        }

        .navbar-subtitle {
            color: rgba(255, 255, 255, 0.7);
            font-size: 12px;
            margin-top: 1px;
        }

        .main-content {
            max-width: 1100px;
            margin: 0 auto;
            padding: 32px 24px 60px;
        }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .page-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 24px;
            font-weight: 800;
            color: #003366;
            letter-spacing: -0.4px;
        }

        /* ===== SEARCH ===== */
        .search-card {
            background: #FFFFFF;
            border-radius: 16px;
            padding: 20px 28px;
            margin-bottom: 24px;
            box-shadow: 0 1px 4px rgba(0, 51, 102, 0.06);
            border: 1px solid #e2eaf3;
        }

        .search-form {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .search-input {
            flex: 1;
            padding: 12px 18px;
            border: 1px solid #d0ddef;
            border-radius: 10px;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            color: #003366;
            transition: all 0.2s ease;
            background: #f7fafd;
        }

        .search-input:focus {
            outline: none;
            border-color: #007BFF;
            background: #FFFFFF;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
        }

        .search-input::placeholder {
            color: #95afc7;
        }

        .btn-search {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: #007BFF;
            color: #FFFFFF;
            border: none;
            border-radius: 10px;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-search:hover {
            background: #0056B3;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.25);
        }

        .btn-search svg {
            width: 16px;
            height: 16px;
        }

        /* ===== TABLE ===== */
        .table-card {
            background: #FFFFFF;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 1px 4px rgba(0, 51, 102, 0.06);
            border: 1px solid #e2eaf3;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: linear-gradient(135deg, #003366 0%, #0056B3 100%);
        }

        thead th {
            padding: 16px 20px;
            color: #FFFFFF;
            font-size: 13px;
            font-weight: 600;
            text-align: left;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        tbody tr {
            border-bottom: 1px solid #edf2f7;
            transition: background 0.15s ease;
        }

        tbody tr:last-child {
            border-bottom: none;
        }

        tbody tr:hover {
            background: #f7fafd;
        }

        tbody td {
            padding: 18px 20px;
            font-size: 14px;
            color: #003366;
        }

        .mhs-name-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .mhs-avatar-sm {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #007BFF, #0056B3);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #FFFFFF;
            font-weight: 700;
            font-size: 14px;
            flex-shrink: 0;
        }

        .btn-lihat {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 18px;
            background: #007BFF;
            color: #FFFFFF;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-lihat:hover {
            background: #0056B3;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.25);
        }

        .btn-lihat svg {
            width: 15px;
            height: 15px;
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 0 20px;
                height: 60px;
            }

            .navbar-title {
                font-size: 15px;
            }

            .navbar-subtitle {
                display: none;
            }

            .main-content {
                padding: 20px 16px 40px;
            }

            .page-title {
                font-size: 20px;
            }

            .search-form {
                flex-direction: column;
            }

            .btn-search {
                width: 100%;
                justify-content: center;
            }

            thead th {
                padding: 12px 14px;
                font-size: 12px;
            }

            tbody td {
                padding: 14px;
                font-size: 13px;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="navbar-brand">
            <div class="navbar-logo">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20" />
                </svg>
            </div>
            <div>
                <div class="navbar-title">Sistem Jurnal Magang</div>
                <div class="navbar-subtitle">Diskominfo Wonogiri</div>
            </div>
        </div>
    </nav>

    <div class="main-content">

        <div class="page-header">
            <h1 class="page-title">Daftar Mahasiswa Magang</h1>
        </div>

        <!-- SEARCH -->
        <div class="search-card">
            <form method="get" class="search-form">
                <input type="text" name="q" class="search-input" placeholder="Cari nama mahasiswa..." value="<?= esc($keyword ?? '') ?>">
                <button type="submit" class="btn-search">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                    Cari
                </button>
            </form>
        </div>

        <!-- TABLE -->
        <div class="table-card">
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mahasiswa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($mahasiswa as $i => $m): ?>
                            <tr>
                                <td style="width: 60px; text-align: center; font-weight: 600; color: #7a9bc5;"><?= $i + 1 ?></td>
                                <td>
                                    <div class="mhs-name-cell">
                                        <div class="mhs-avatar-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="#FFFFFF"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                                <circle cx="12" cy="7" r="4" />
                                            </svg>
                                        </div>
                                        <strong><?= esc($m['name']) ?></strong>
                                    </div>
                                </td>
                                <td>
                                    <a href="/mentor/mahasiswa/<?= $m['id'] ?>" class="btn-lihat">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg>
                                        Lihat Jurnal
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>

</html>