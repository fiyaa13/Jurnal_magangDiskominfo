<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mentor - Sistem Jurnal Magang</title>
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

        /* ===== HEADER / NAVBAR ===== */
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
            font-size: 20px;
            backdrop-filter: blur(10px);
        }

        .navbar-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #FFFFFF;
            font-size: 18px;
            font-weight: 700;
            letter-spacing: -0.3px;
        }

        .navbar-subtitle {
            color: rgba(255, 255, 255, 0.7);
            font-size: 12px;
            font-weight: 400;
            margin-top: 1px;
        }

        .navbar-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btn-logout {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 20px;
            background: rgba(255, 255, 255, 0.12);
            color: #FFFFFF;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
            backdrop-filter: blur(10px);
        }

        .btn-logout:hover {
            background: rgba(255, 255, 255, 0.22);
            border-color: rgba(255, 255, 255, 0.35);
            transform: translateY(-1px);
        }

        /* ===== MAIN CONTENT ===== */
        .main-content {
            max-width: 1100px;
            margin: 0 auto;
            padding: 32px 24px 60px;
        }

        /* ===== WELCOME SECTION ===== */
        .welcome-card {
            background: #FFFFFF;
            border-radius: 16px;
            padding: 32px 36px;
            margin-bottom: 28px;
            box-shadow: 0 1px 4px rgba(0, 51, 102, 0.06);
            border: 1px solid #e2eaf3;
        }

        .welcome-header {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 26px;
            font-weight: 800;
            color: #003366;
            margin-bottom: 6px;
            letter-spacing: -0.5px;
        }

        .welcome-name {
            font-size: 16px;
            color: #4a6fa5;
            font-weight: 400;
        }

        .welcome-name strong {
            color: #007BFF;
            font-weight: 600;
        }

        /* ===== BIODATA MENTOR ===== */
        .biodata-card {
            background: #FFFFFF;
            border-radius: 16px;
            padding: 28px 36px;
            margin-bottom: 28px;
            box-shadow: 0 1px 4px rgba(0, 51, 102, 0.06);
            border: 1px solid #e2eaf3;
        }

        .biodata-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 17px;
            font-weight: 700;
            color: #003366;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .biodata-title .icon {
            width: 32px;
            height: 32px;
            background: #e8f0fe;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .biodata-title .icon svg {
            width: 18px;
            height: 18px;
            color: #007BFF;
        }

        .biodata-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 16px;
        }

        .biodata-item {
            padding: 14px 18px;
            background: #f7fafd;
            border-radius: 10px;
            border: 1px solid #e8f0fe;
        }

        .biodata-label {
            font-size: 12px;
            color: #7a9bc5;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            margin-bottom: 4px;
        }

        .biodata-value {
            font-size: 15px;
            font-weight: 600;
            color: #003366;
        }

        /* ===== DAFTAR MAHASISWA ===== */
        .section-card {
            background: #FFFFFF;
            border-radius: 16px;
            padding: 28px 36px;
            margin-bottom: 28px;
            box-shadow: 0 1px 4px rgba(0, 51, 102, 0.06);
            border: 1px solid #e2eaf3;
        }

        .section-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 17px;
            font-weight: 700;
            color: #003366;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title .icon {
            width: 32px;
            height: 32px;
            background: #e8f0fe;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .section-title .icon svg {
            width: 18px;
            height: 18px;
            color: #007BFF;
        }

        .mhs-empty {
            text-align: center;
            padding: 40px 20px;
            color: #7a9bc5;
            font-size: 15px;
        }

        .mhs-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .mhs-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 22px;
            background: #f7fafd;
            border-radius: 12px;
            border: 1px solid #e8f0fe;
            transition: all 0.2s ease;
        }

        .mhs-item:hover {
            border-color: #007BFF;
            box-shadow: 0 2px 12px rgba(0, 123, 255, 0.08);
            transform: translateY(-1px);
        }

        .mhs-info {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .mhs-avatar {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, #007BFF, #0056B3);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #FFFFFF;
            font-weight: 700;
            font-size: 16px;
        }

        .mhs-name {
            font-size: 15px;
            font-weight: 600;
            color: #003366;
            margin-bottom: 2px;
        }

        .mhs-jurnal-count {
            font-size: 13px;
            color: #7a9bc5;
        }

        .mhs-jurnal-count span {
            font-weight: 600;
            color: #0056B3;
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
            width: 16px;
            height: 16px;
        }

        /* ===== RESPONSIVE ===== */
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

            .welcome-card,
            .biodata-card,
            .section-card {
                padding: 22px 20px;
                border-radius: 12px;
            }

            .welcome-header {
                font-size: 22px;
            }

            .biodata-grid {
                grid-template-columns: 1fr;
            }

            .mhs-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 14px;
            }

            .btn-lihat {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
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
        <div class="navbar-actions">
            <a href="/logout" class="btn-logout">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                    <polyline points="16 17 21 12 16 7" />
                    <line x1="21" y1="12" x2="9" y2="12" />
                </svg>
                Logout
            </a>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <div class="main-content">

        <!-- WELCOME -->
        <div class="welcome-card">
            <h1 class="welcome-header">Dashboard Mentor</h1>
            <p class="welcome-name">Selamat datang, <strong><?= esc(session()->get('name')) ?></strong></p>
        </div>

        <!-- BIODATA MENTOR -->
        <div class="biodata-card">
            <h2 class="biodata-title">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                </span>
                Biodata Mentor
            </h2>
            <div class="biodata-grid">
                <div class="biodata-item">
                    <div class="biodata-label">Nama Lengkap</div>
                    <div class="biodata-value"><?= esc(session()->get('name')) ?></div>
                </div>
                <div class="biodata-item">
                    <div class="biodata-label">NIP</div>
                    <div class="biodata-value">
                        <?= esc($mentorProfile['nip'] ?? '-') ?>
                    </div>
                </div>

                <div class="biodata-item">
                    <div class="biodata-label">Jabatan</div>
                    <div class="biodata-value">
                        <?= esc($mentorProfile['jabatan'] ?? '-') ?>
                    </div>
                </div>

                <div class="biodata-item">
                    <div class="biodata-label">Bidang</div>
                    <div class="biodata-value">
                        <?= esc($mentorProfile['bidang'] ?? '-') ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- DAFTAR MAHASISWA -->
        <div class="section-card">
            <h2 class="section-title">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                </span>
                Daftar Mahasiswa Magang
            </h2>

            <?php if (empty($mahasiswa)) : ?>
                <div class="mhs-empty">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#c0d4e8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:12px">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <line x1="19" y1="8" x2="19" y2="14" />
                        <line x1="22" y1="11" x2="16" y2="11" />
                    </svg>
                    <p>Belum ada mahasiswa yang mengisi jurnal.</p>
                </div>
            <?php else : ?>
                <ul class="mhs-list">
                    <?php foreach ($mahasiswa as $mhs) : ?>
                        <li class="mhs-item">
                            <div class="mhs-info">
                                <div class="mhs-avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                        viewBox="0 0 24 24" fill="none" stroke="#FFFFFF"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                        <circle cx="12" cy="7" r="4" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="mhs-name">
                                        <?= esc($mhs['name'] ?? '-') ?>
                                    </div>
                                    <div class="mhs-jurnal-count">
                                        Total jurnal: <span><?= $mhs['total_jurnal'] ?? 0 ?></span>
                                    </div>
                                </div>
                            </div>
                            <a href="/mentor/journal?user_id=<?= $mhs['id'] ?>" class="btn-lihat">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                                Lihat Jurnal
                            </a>
                        </li>
                    <?php endforeach ?>
                </ul>
            <?php endif ?>
        </div>

    </div>

</body>

</html>