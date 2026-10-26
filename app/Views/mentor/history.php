<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Validasi - Sistem Jurnal Magang</title>
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
            justify-content: space-between;
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
            max-width: 1200px;
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

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 22px;
            background: #FFFFFF;
            color: #003366;
            border: 1px solid #d0ddef;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-back:hover {
            border-color: #007BFF;
            color: #007BFF;
            box-shadow: 0 2px 8px rgba(0, 123, 255, 0.1);
        }

        .btn-back svg {
            width: 16px;
            height: 16px;
        }

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

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .badge-approved {
            background: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
        }

        .badge-rejected {
            background: #ffebee;
            color: #c62828;
            border: 1px solid #ffcdd2;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #7a9bc5;
        }

        .empty-state svg {
            margin-bottom: 14px;
        }

        .empty-state p {
            font-size: 15px;
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
            <h1 class="page-title">Riwayat Validasi Jurnal</h1>
            <a href="/mentor/journal" class="btn-back">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6" />
                </svg>
                Kembali ke Jurnal Pending
            </a>
        </div>

        <div class="table-card">
            <div class="table-wrapper">
                <?php if (empty($journals)): ?>
                    <div class="empty-state">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#c0d4e8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                            <polyline points="14 2 14 8 20 8" />
                            <line x1="12" y1="18" x2="12" y2="12" />
                            <line x1="9" y1="15" x2="15" y2="15" />
                        </svg>
                        <p>Belum ada riwayat validasi jurnal.</p>
                    </div>
                <?php else: ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Nama Mahasiswa</th>
                                <th>Tanggal</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Catatan Mentor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($journals as $j): ?>
                                <tr>
                                    <td><strong><?= esc($j['nama_mahasiswa']) ?></strong></td>
                                    <td><?= esc($j['tanggal']) ?></td>
                                    <td><?= esc($j['deskripsi']) ?></td>
                                    <td>
                                        <?php if ($j['status'] === 'approved'): ?>
                                            <span class="badge badge-approved">Disetujui</span>
                                        <?php else: ?>
                                            <span class="badge badge-rejected">Ditolak</span>
                                        <?php endif ?>
                                    </td>
                                    <td><?= esc($j['mentor_note'] ?? '-') ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                <?php endif ?>
            </div>
        </div>

    </div>

</body>

</html>