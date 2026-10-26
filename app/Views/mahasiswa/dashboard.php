<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Mahasiswa — SIAMANG</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
  <style>
    *,
    *::before,
    *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    :root {
      --ink: #003366;
      --navy: #003366;
      --navy2: #0056B3;
      --blue: #007BFF;
      --blue-l: #0056B3;
      --sky: #93c5fd;
      --bg: #f0f4f8;
      --white: #ffffff;
      --border: #e2eaf3;
      --text: #003366;
      --sub: #4a6fa5;
      --glass: rgba(255, 255, 255, 0.07);
      --edge: rgba(255, 255, 255, 0.11);
      --faint: rgba(255, 255, 255, 0.18);
      --green: #10b981;
      --green-l: #f0fdf4;
      --amber: #f59e0b;
      --amber-l: #fffbeb;
    }

    html,
    body {
      height: 100%;
      overflow: hidden;
      font-family: 'Inter', system-ui, -apple-system, sans-serif;
      background: var(--bg);
      color: #003366;
    }

    /* ═══ TOPBAR ═══ */
    .topbar {
      position: fixed;
      inset: 0 0 auto;
      z-index: 200;
      height: 70px;
      padding: 0 40px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: linear-gradient(135deg, #003366 0%, #0056B3 100%);
      box-shadow: 0 2px 12px rgba(0, 51, 102, 0.15);
    }

    .tb-l {
      display: flex;
      align-items: center;
      gap: 14px;
    }

    .tb-logo {
      width: 38px;
      height: 38px;
      border-radius: 10px;
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(10px);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .tb-logo svg {
      width: 20px;
      height: 20px;
      stroke: white;
      fill: none;
      stroke-width: 2;
    }

    .tb-brand b {
      display: block;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 18px;
      font-weight: 700;
      color: #FFFFFF;
      line-height: 1;
      letter-spacing: -0.3px;
    }

    .tb-brand span {
      display: block;
      font-size: 12px;
      font-weight: 400;
      color: rgba(255, 255, 255, 0.7);
      margin-top: 1px;
    }

    .tb-sep {
      width: 1px;
      height: 20px;
      background: rgba(255, 255, 255, 0.1);
    }

    .tb-page {
      font-family: 'Inter', sans-serif;
      font-size: 14px;
      font-weight: 400;
      color: rgba(255, 255, 255, 0.7);
    }

    .tb-r {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .tb-chip {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 4px 12px 4px 4px;
      background: rgba(255, 255, 255, 0.12);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 99px;
    }

    .tb-av {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      background: var(--blue);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 11px;
      font-weight: 700;
      color: white;
    }

    .tb-uname {
      font-size: 14px;
      font-weight: 500;
      color: rgba(255, 255, 255, 0.9);
    }

    .btn-out {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      cursor: pointer;
      padding: 9px 20px;
      border-radius: 8px;
      background: rgba(255, 255, 255, 0.12);
      border: 1px solid rgba(255, 255, 255, 0.2);
      font-family: 'Inter', sans-serif;
      font-size: 14px;
      font-weight: 500;
      color: #FFFFFF;
      transition: all 0.2s ease;
      text-decoration: none;
      backdrop-filter: blur(10px);
    }

    .btn-out:hover {
      background: rgba(255, 255, 255, 0.22);
      border-color: rgba(255, 255, 255, 0.35);
      transform: translateY(-1px);
    }

    .btn-out svg {
      width: 16px;
      height: 16px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2;
    }

    /* ═══ SHELL ═══ */
    .shell {
      display: flex;
      height: 100vh;
      padding-top: 70px;
    }

    /* ═══ SIDEBAR ═══ */
    .sidebar {
      width: 240px;
      flex-shrink: 0;
      background: linear-gradient(135deg, #003366 0%, #0056B3 100%);
      display: flex;
      flex-direction: column;
      border-right: 1px solid rgba(255, 255, 255, 0.07);
      overflow: hidden;
      position: relative;
    }

    .sidebar::before {
      content: '';
      position: absolute;
      pointer-events: none;
      width: 400px;
      height: 400px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(0, 123, 255, 0.12) 0%, transparent 60%);
      top: -100px;
      left: -100px;
    }

    .sb-profile {
      padding: 24px 20px 20px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.07);
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      position: relative;
      z-index: 1;
    }

    .sb-av {
      width: 58px;
      height: 58px;
      border-radius: 50%;
      background: linear-gradient(135deg, #0056B3, #007BFF);
      border: 2.5px solid rgba(255, 255, 255, 0.18);
      box-shadow: 0 0 0 5px rgba(0, 123, 255, 0.15);
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 18px;
      font-weight: 800;
      color: white;
      margin-bottom: 12px;
    }

    .sb-name {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 14px;
      font-weight: 700;
      color: white;
      margin-bottom: 4px;
    }

    .sb-nim {
      font-size: 12px;
      font-weight: 400;
      color: rgba(255, 255, 255, 0.5);
      margin-bottom: 10px;
    }

    .sb-badge {
      display: inline-block;
      padding: 3px 12px;
      border-radius: 99px;
      background: rgba(0, 123, 255, 0.2);
      border: 1px solid rgba(0, 123, 255, 0.35);
      font-size: 11px;
      font-weight: 600;
      color: var(--sky);
      letter-spacing: 0.04em;
    }

    .sb-menu {
      flex: 1;
      padding: 18px 12px;
      overflow-y: auto;
      position: relative;
      z-index: 1;
    }

    .sb-menu::-webkit-scrollbar {
      display: none;
    }

    .sb-section-label {
      font-size: 11px;
      font-weight: 600;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      color: rgba(255, 255, 255, 0.3);
      padding: 0 8px;
      margin-bottom: 8px;
    }

    .sb-item {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 12px;
      border-radius: 10px;
      margin-bottom: 2px;
      text-decoration: none;
      transition: all 0.2s;
      color: rgba(255, 255, 255, 0.55);
      font-size: 14px;
      font-weight: 500;
      border: 1px solid transparent;
    }

    .sb-item:hover {
      background: rgba(255, 255, 255, 0.06);
      color: rgba(255, 255, 255, 0.85);
    }

    .sb-item.active {
      background: rgba(0, 123, 255, 0.2);
      border-color: rgba(0, 123, 255, 0.3);
      color: white;
      font-weight: 600;
    }

    .sb-item svg {
      width: 16px;
      height: 16px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2;
      flex-shrink: 0;
    }

    .sb-foot {
      padding: 16px 20px;
      border-top: 1px solid rgba(255, 255, 255, 0.06);
      position: relative;
      z-index: 1;
    }

    .sb-foot-txt {
      font-size: 12px;
      color: rgba(255, 255, 255, 0.2);
      text-align: center;
      line-height: 1.6;
    }

    /* ═══ MAIN ═══ */
    .main {
      flex: 1;
      overflow-y: auto;
      background: var(--bg);
      scrollbar-width: thin;
      scrollbar-color: #c0d4e8 transparent;
    }

    .main::-webkit-scrollbar {
      width: 5px;
    }

    .main::-webkit-scrollbar-thumb {
      background: #c0d4e8;
      border-radius: 99px;
    }

    .content {
      max-width: 1100px;
      margin: 0 auto;
      padding: 32px 36px 60px;
    }

    /* ── Page heading ── */
    .page-eyebrow {
      font-size: 12px;
      font-weight: 600;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: #007BFF;
      margin-bottom: 6px;
    }

    .content h2 {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 26px;
      font-weight: 800;
      color: #003366;
      letter-spacing: -0.5px;
      line-height: 1.15;
      margin-bottom: 6px;
    }

    .content>p {
      font-size: 16px;
      font-weight: 400;
      color: #4a6fa5;
      margin-bottom: 0;
    }

    .content>p strong {
      color: #007BFF;
      font-weight: 600;
    }

    .content>hr {
      display: none;
    }

    /* Welcome card */
    .welcome-card {
      background: linear-gradient(135deg, #003366 0%, #0056B3 100%);
      border-radius: 16px;
      padding: 28px 32px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin: 20px 0 24px;
      overflow: hidden;
      position: relative;
      box-shadow: 0 4px 20px rgba(0, 51, 102, 0.18);
    }

    .welcome-card::before {
      content: '';
      position: absolute;
      pointer-events: none;
      width: 360px;
      height: 360px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(0, 123, 255, 0.15) 0%, transparent 60%);
      top: -130px;
      right: -60px;
    }

    .wc-left {
      position: relative;
      z-index: 1;
    }

    .wc-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 4px 12px;
      border-radius: 99px;
      margin-bottom: 12px;
      background: rgba(0, 123, 255, 0.2);
      border: 1px solid rgba(0, 123, 255, 0.35);
      font-size: 11px;
      font-weight: 600;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: var(--sky);
    }

    .wc-dot {
      width: 5px;
      height: 5px;
      border-radius: 50%;
      background: var(--sky);
      animation: blink 2s ease infinite;
    }

    @keyframes blink {

      0%,
      100% {
        opacity: 1
      }

      50% {
        opacity: 0.3
      }
    }

    .wc-title {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 22px;
      font-weight: 700;
      color: white;
      line-height: 1.2;
      margin-bottom: 6px;
      letter-spacing: -0.3px;
    }

    .wc-title em {
      font-style: normal;
      color: var(--sky);
    }

    .wc-sub {
      font-size: 14px;
      font-weight: 400;
      color: rgba(255, 255, 255, 0.55);
    }

    .wc-right {
      position: relative;
      z-index: 1;
      text-align: right;
    }

    .wc-clock {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 48px;
      font-weight: 800;
      color: rgba(255, 255, 255, 0.1);
      line-height: 1;
      letter-spacing: -2px;
      user-select: none;
    }

    /* Section label */
    .section-label {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 17px;
      font-weight: 700;
      color: #003366;
      margin-bottom: 14px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .section-label .icon {
      width: 32px;
      height: 32px;
      background: #e8f0fe;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .section-label .icon svg {
      width: 18px;
      height: 18px;
      stroke: #007BFF;
      fill: none;
      stroke-width: 2;
    }

    /* Info row */
    .info-row {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 14px;
      margin-bottom: 24px;
    }

    .info-card {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 12px;
      padding: 18px 20px;
      display: flex;
      align-items: center;
      gap: 14px;
      box-shadow: 0 1px 4px rgba(0, 51, 102, 0.06);
      transition: box-shadow 0.2s;
    }

    .info-card:hover {
      box-shadow: 0 4px 16px rgba(0, 51, 102, 0.1);
    }

    .ic-icon {
      width: 42px;
      height: 42px;
      border-radius: 10px;
      flex-shrink: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #e8f0fe;
    }

    .ic-icon.green {
      background: var(--green-l);
    }

    .ic-icon.amber {
      background: var(--amber-l);
    }

    .ic-icon svg {
      width: 18px;
      height: 18px;
      fill: none;
      stroke-width: 2;
      stroke: #007BFF;
    }

    .ic-icon.green svg {
      stroke: var(--green);
    }

    .ic-icon.amber svg {
      stroke: var(--amber);
    }

    .ic-label {
      font-size: 12px;
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 0.06em;
      color: #7a9bc5;
      margin-bottom: 3px;
    }

    .ic-val {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 16px;
      font-weight: 700;
      color: #003366;
    }

    /* Profile card */
    .profile-card {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 24px 28px;
      margin-bottom: 24px;
      box-shadow: 0 1px 4px rgba(0, 51, 102, 0.06);
    }

    .content h4 {
      display: none;
    }

    .content ul {
      list-style: none;
    }

    .profile-card ul {
      list-style: none;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 14px;
    }

    .profile-card ul li {
      display: flex;
      flex-direction: column;
      gap: 4px;
      padding: 14px 18px;
      background: #f7fafd;
      border-radius: 10px;
      border: 1px solid #e8f0fe;
    }

    .profile-card ul li strong {
      font-size: 12px;
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 0.06em;
      color: #7a9bc5;
    }

    .profile-card ul li .val {
      font-size: 15px;
      font-weight: 600;
      color: #003366;
    }

    /* Empty state */
    .empty-state {
      display: flex;
      align-items: center;
      gap: 10px;
      background: var(--amber-l);
      border: 1px solid rgba(245, 158, 11, 0.2);
      border-radius: 10px;
      padding: 14px 18px;
      font-size: 14px;
      font-weight: 500;
      color: var(--amber);
    }

    .empty-state svg {
      width: 16px;
      height: 16px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2;
      flex-shrink: 0;
    }

    /* Nav grid */
    .nav-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 12px;
    }

    .nav-card {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 12px;
      padding: 20px 22px;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 14px;
      transition: all 0.2s ease;
      box-shadow: 0 1px 4px rgba(0, 51, 102, 0.06);
    }

    .nav-card:hover {
      border-color: #007BFF;
      transform: translateY(-1px);
      box-shadow: 0 4px 16px rgba(0, 123, 255, 0.12);
    }

    .nc-ic {
      width: 42px;
      height: 42px;
      border-radius: 10px;
      flex-shrink: 0;
      background: #e8f0fe;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background 0.2s;
    }

    .nav-card:hover .nc-ic {
      background: #007BFF;
    }

    .nc-ic svg {
      width: 18px;
      height: 18px;
      stroke: #007BFF;
      fill: none;
      stroke-width: 2;
      transition: stroke 0.2s;
    }

    .nav-card:hover .nc-ic svg {
      stroke: white;
    }

    .nc-title {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 15px;
      font-weight: 700;
      color: #003366;
      margin-bottom: 3px;
    }

    .nc-desc {
      font-size: 13px;
      font-weight: 400;
      color: #4a6fa5;
      line-height: 1.4;
    }

    .nav-ul {
      display: none;
    }

    .logout-raw {
      display: none;
    }

    /* ═══ RESPONSIVE ═══ */
    @media (max-width: 768px) {
      .sidebar {
        display: none;
      }

      .topbar {
        padding: 0 20px;
        height: 60px;
      }

      .shell {
        padding-top: 60px;
      }

      .tb-brand span {
        display: none;
      }

      .info-row {
        grid-template-columns: 1fr;
      }

      .nav-grid {
        grid-template-columns: 1fr;
      }

      .profile-card ul {
        grid-template-columns: 1fr;
      }

      .content {
        padding: 20px 16px 40px;
      }

      .content h2 {
        font-size: 22px;
      }

      .welcome-card {
        padding: 22px 20px;
        border-radius: 12px;
      }

      .wc-clock {
        font-size: 36px;
      }
    }
  </style>
</head>

<body>

  <!-- ═══ TOPBAR ═══ -->
  <header class="topbar">
    <div class="tb-l">
      <div class="tb-logo">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20" />
        </svg>
      </div>
      <div class="tb-brand">
        <b>Sistem Jurnal Magang</b>
        <span>Diskominfo Wonogiri</span>
      </div>
      <div class="tb-sep"></div>
      <span class="tb-page">Dashboard Mahasiswa</span>
    </div>
    <div class="tb-r">
      <div class="tb-chip">
        <div class="tb-av" id="tb-initials">?</div>
        <span class="tb-uname" id="tb-name">—</span>
      </div>
      <a href="/logout" class="btn-out">
        <svg viewBox="0 0 24 24">
          <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
          <polyline points="16 17 21 12 16 7" />
          <line x1="21" y1="12" x2="9" y2="12" />
        </svg>
        Logout
      </a>
    </div>
  </header>

  <div class="shell">

    <!-- ═══ SIDEBAR ═══ -->
    <aside class="sidebar">
      <div class="sb-profile">
        <div class="sb-av" id="sb-initials">?</div>
        <div class="sb-name" id="sb-name">—</div>
        <div class="sb-nim" id="sb-nim">NIM · —</div>
        <span class="sb-badge" id="sb-bidang">Magang</span>
      </div>

      <nav class="sb-menu">
        <div class="sb-section-label">Menu Utama</div>
        <a class="sb-item active" href="/journal">
          <svg viewBox="0 0 24 24">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
            <polyline points="14 2 14 8 20 8" />
            <line x1="16" y1="13" x2="8" y2="13" />
            <line x1="16" y1="17" x2="8" y2="17" />
          </svg>
          Jurnal Magang
        </a>
      </nav>

      <div class="sb-foot">
        <div class="sb-foot-txt">© 2026 Sistem Jurnal Magang<br>Diskominfo Wonogiri</div>
      </div>
    </aside>

    <!-- ═══ MAIN ═══ -->
    <main class="main">
      <div class="content">

        <div class="page-eyebrow">Dashboard</div>
        <h2>Dashboard Mahasiswa</h2>
        <p>Selamat datang, <strong><?= esc(session()->get('name')) ?></strong></p>
        <hr>

        <!-- Welcome card -->
        <div class="welcome-card">
          <div class="wc-left">
            <div class="wc-badge"><span class="wc-dot"></span>Magang Aktif</div>
            <div class="wc-title">Halo, <em id="wc-name"><?= esc(session()->get('name')) ?></em></div>
            <div class="wc-sub" id="wc-sub">Selamat bekerja hari ini 💪</div>
          </div>
          <div class="wc-right">
            <div class="wc-clock" id="clock">--:--</div>
          </div>
        </div>

        <!-- Info stats -->
        <div class="info-row">
          <div class="info-card">
            <div class="ic-icon">
              <svg viewBox="0 0 24 24">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                <polyline points="14 2 14 8 20 8" />
              </svg>
            </div>
            <div>
              <div class="ic-label">Total Jurnal</div>
              <div class="ic-val">0 entri</div>
            </div>
          </div>
          <div class="info-card">
            <div class="ic-icon green">
              <svg viewBox="0 0 24 24">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                <polyline points="22 4 12 14.01 9 11.01" />
              </svg>
            </div>
            <div>
              <div class="ic-label">Hari Hadir</div>
              <div class="ic-val">0 hari</div>
            </div>
          </div>
          <div class="info-card">
            <div class="ic-icon amber">
              <svg viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" />
                <path d="M12 8v4l3 3" />
              </svg>
            </div>
            <div>
              <div class="ic-label">Periode Magang</div>
              <div class="ic-val" id="stat-periode">—</div>
            </div>
          </div>
        </div>

        <!-- Data Mahasiswa -->
        <div class="section-label">
          <span class="icon">
            <svg viewBox="0 0 24 24">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
              <circle cx="12" cy="7" r="4" />
            </svg>
          </span>
          Data Mahasiswa
        </div>
        <div class="profile-card">
          <h4>Data Mahasiswa</h4>
          <?php if ($profile): ?>
            <ul>
              <li>
                <strong>NIM</strong>
                <span class="val"><?= esc($profile['nim']) ?></span>
              </li>
              <li>
                <strong>Asal Universitas</strong>
                <span class="val"><?= esc($profile['asal_universitas']) ?></span>
              </li>
              <li>
                <strong>Bidang Magang</strong>
                <span class="val"><?= esc($profile['bidang_magang']) ?></span>
              </li>
              <li>
                <strong>Periode Magang</strong>
                <span class="val"><?= esc($profile['periode_magang']) ?></span>
              </li>
            </ul>
          <?php else: ?>
            <div class="empty-state">
              <svg viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" />
                <line x1="12" y1="8" x2="12" y2="12" />
                <line x1="12" y1="16" x2="12.01" y2="16" />
              </svg>
              Data profil mahasiswa belum lengkap.
            </div>
          <?php endif; ?>
        </div>

        <!-- Akses Cepat -->
        <div class="section-label">
          <span class="icon">
            <svg viewBox="0 0 24 24">
              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
              <polyline points="14 2 14 8 20 8" />
              <line x1="16" y1="13" x2="8" y2="13" />
              <line x1="16" y1="17" x2="8" y2="17" />
            </svg>
          </span>
          Akses Cepat
        </div>
        <div class="nav-grid">
          <a class="nav-card" href="/journal">
            <div class="nc-ic">
              <svg viewBox="0 0 24 24">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                <polyline points="14 2 14 8 20 8" />
                <line x1="16" y1="13" x2="8" y2="13" />
                <line x1="16" y1="17" x2="8" y2="17" />
              </svg>
            </div>
            <div>
              <div class="nc-title">Jurnal Magang</div>
              <div class="nc-desc">Tulis dan kelola catatan kegiatan magang harian kamu</div>
            </div>
          </a>
        </div>

        <ul class="nav-ul">
          <li><a href="/journal">📘 Jurnal Magang</a></li>
        </ul>
        <a href="/logout" class="logout-raw">🚪 Logout</a>

      </div>
    </main>

  </div>

  <script>
    function tick() {
      const now = new Date();
      const el = document.getElementById('clock');
      if (el) el.textContent =
        String(now.getHours()).padStart(2, '0') + ':' +
        String(now.getMinutes()).padStart(2, '0');
    }
    tick();
    setInterval(tick, 1000);

    function initProfile() {
      const nameEl = document.querySelector('.wc-title em');
      const name = nameEl ? nameEl.textContent.trim() : '—';
      const initials = name.split(' ').map(w => w[0]).slice(0, 2).join('').toUpperCase();

      const tbInit = document.getElementById('tb-initials');
      const tbName = document.getElementById('tb-name');
      const sbInit = document.getElementById('sb-initials');
      const sbName = document.getElementById('sb-name');
      if (tbInit) tbInit.textContent = initials;
      if (tbName) tbName.textContent = name;
      if (sbInit) sbInit.textContent = initials;
      if (sbName) sbName.textContent = name;

      const vals = document.querySelectorAll('.profile-card .val');
      if (vals.length >= 1) {
        const nim = document.getElementById('sb-nim');
        if (nim) nim.textContent = 'NIM · ' + vals[0].textContent.trim();
      }
      if (vals.length >= 3) {
        const badge = document.getElementById('sb-bidang');
        if (badge) badge.textContent = vals[2].textContent.trim();
        const stat = document.getElementById('stat-periode');
        if (stat && vals[3]) stat.textContent = vals[3].textContent.trim();
      }

      const sub = document.getElementById('wc-sub');
      if (sub) {
        const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        const now = new Date();
        sub.textContent = days[now.getDay()] + ', ' + now.getDate() + ' ' + months[now.getMonth()] + ' ' + now.getFullYear();
      }
    }
    initProfile();
  </script>

</body>

</html>