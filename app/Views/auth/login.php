<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login — Sistem Jurnal Magang</title>
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
      --sky: #e8f0fe;
      --mist: #f0f4f8;
      --line: #e2eaf3;
      --dim: #4a6fa5;
      --danger: #ef4444;
      --green: #10b981;
      --green-lt: #d1fae5;
    }

    html,
    body {
      min-height: 100%;
      font-family: 'Inter', system-ui, -apple-system, sans-serif;
      background: var(--mist);
      color: #003366;
    }

    /* ─── LAYOUT ─── */
    .shell {
      display: grid;
      grid-template-columns: 1fr 480px;
      min-height: 100vh;
    }

    @media (max-width: 960px) {
      .shell {
        grid-template-columns: 1fr;
      }

      .panel-left {
        display: none;
      }
    }

    /* ─── LEFT PANEL ─── */
    .panel-left {
      position: relative;
      background: linear-gradient(135deg, #003366 0%, #0056B3 100%);
      overflow: hidden;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 48px 52px;
    }

    .panel-left::before {
      content: '';
      position: absolute;
      inset: 0;
      background-image: radial-gradient(circle, rgba(255, 255, 255, 0.06) 1px, transparent 1px);
      background-size: 28px 28px;
      pointer-events: none;
    }

    .orb {
      position: absolute;
      border-radius: 50%;
      filter: blur(80px);
      pointer-events: none;
    }

    .orb-1 {
      width: 520px;
      height: 520px;
      top: -140px;
      left: -120px;
      background: radial-gradient(circle, rgba(0, 123, 255, 0.25), transparent 65%);
    }

    .orb-2 {
      width: 360px;
      height: 360px;
      bottom: -80px;
      right: -80px;
      background: radial-gradient(circle, rgba(16, 185, 129, 0.12), transparent 65%);
    }

    .left-inner {
      position: relative;
      z-index: 2;
      display: flex;
      flex-direction: column;
      height: 100%;
      justify-content: space-between;
    }

    .brand {
      display: inline-flex;
      align-items: center;
      gap: 14px;
      text-decoration: none;
      margin-bottom: 64px;
    }

    .brand-mark {
      width: 38px;
      height: 38px;
      border-radius: 10px;
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(10px);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .brand-mark svg {
      width: 20px;
      height: 20px;
      stroke: #fff;
      fill: none;
      stroke-width: 2;
    }

    .brand-name {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 18px;
      font-weight: 700;
      color: #fff;
      letter-spacing: -0.3px;
      display: block;
      line-height: 1;
    }

    .brand-sub {
      font-size: 12px;
      font-weight: 400;
      color: rgba(255, 255, 255, 0.6);
      display: block;
      margin-top: 2px;
    }

    .eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 11px;
      font-weight: 600;
      color: #93c5fd;
      text-transform: uppercase;
      letter-spacing: 0.12em;
      margin-bottom: 18px;
      opacity: 0;
      animation: rise 0.7s 0.1s forwards;
    }

    .pulse-dot {
      width: 7px;
      height: 7px;
      border-radius: 50%;
      background: #93c5fd;
      animation: ping 1.6s ease-in-out infinite;
    }

    @keyframes ping {

      0%,
      100% {
        transform: scale(1);
        opacity: 1
      }

      50% {
        transform: scale(.7);
        opacity: .4
      }
    }

    .hero-h1 {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 3rem;
      line-height: 1.1;
      color: #fff;
      font-weight: 800;
      letter-spacing: -1px;
      margin-bottom: 20px;
      opacity: 0;
      animation: rise 0.7s 0.2s forwards;
    }

    .hero-h1 em {
      color: #93c5fd;
      font-style: normal;
    }

    .hero-p {
      font-size: 14px;
      font-weight: 400;
      color: rgba(255, 255, 255, 0.5);
      line-height: 1.7;
      max-width: 380px;
      opacity: 0;
      animation: rise 0.7s 0.3s forwards;
    }

    .features {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      opacity: 0;
      animation: rise 0.7s 0.4s forwards;
    }

    .feat {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 10px 12px;
      border-radius: 10px;
      transition: background 0.2s;
    }

    .feat:hover {
      background: rgba(255, 255, 255, 0.05);
    }

    .feat-ic {
      width: 34px;
      height: 34px;
      border-radius: 9px;
      flex-shrink: 0;
      background: rgba(255, 255, 255, 0.08);
      border: 1px solid rgba(255, 255, 255, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .feat-ic svg {
      width: 15px;
      height: 15px;
      stroke: #93c5fd;
      fill: none;
      stroke-width: 2;
    }

    .feat-title {
      font-size: 14px;
      font-weight: 600;
      color: rgba(255, 255, 255, 0.85);
    }

    .feat-desc {
      font-size: 12px;
      font-weight: 400;
      color: rgba(255, 255, 255, 0.35);
      margin-top: 2px;
    }

    .stats-wrap {
      opacity: 0;
      animation: rise 0.7s 0.55s forwards;
    }

    .stats-row {
      display: flex;
      gap: 1px;
      background: rgba(255, 255, 255, 0.07);
      border: 1px solid rgba(255, 255, 255, 0.07);
      border-radius: 14px;
      overflow: hidden;
    }

    .stat {
      flex: 1;
      padding: 16px 10px;
      text-align: center;
      background: rgba(255, 255, 255, 0.03);
      transition: background 0.2s;
    }

    .stat:hover {
      background: rgba(255, 255, 255, 0.07);
    }

    .stat-n {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 28px;
      font-weight: 800;
      color: #fff;
      line-height: 1;
    }

    .stat-n sup {
      font-size: 14px;
      color: #93c5fd;
      font-weight: 600;
    }

    .stat-l {
      font-size: 11px;
      font-weight: 500;
      color: rgba(255, 255, 255, 0.3);
      margin-top: 5px;
      text-transform: uppercase;
      letter-spacing: 0.04em;
    }

    .copy {
      font-size: 12px;
      color: rgba(255, 255, 255, 0.2);
      text-align: center;
      margin-top: 12px;
    }

    @keyframes rise {
      from {
        opacity: 0;
        transform: translateY(14px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* ─── RIGHT PANEL ─── */
    .panel-right {
      background: #fff;
      border-left: 1px solid var(--line);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .form-inner {
      width: 100%;
      max-width: 380px;
      padding: 48px 44px;
      animation: rise 0.5s 0.1s both;
    }

    @media (max-width: 960px) {
      .form-inner {
        padding: 60px 24px;
      }
    }

    .mobile-brand {
      display: none;
      align-items: center;
      gap: 10px;
      margin-bottom: 32px;
    }

    @media (max-width: 960px) {
      .mobile-brand {
        display: flex;
      }
    }

    .mobile-brand-mark {
      width: 36px;
      height: 36px;
      border-radius: 9px;
      background: linear-gradient(135deg, #003366, #0056B3);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .mobile-brand-mark svg {
      width: 18px;
      height: 18px;
      stroke: #fff;
      fill: none;
      stroke-width: 2;
    }

    .mobile-brand-name {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 16px;
      font-weight: 700;
      color: #003366;
    }

    /* heading area */
    .fh {
      margin-bottom: 24px;
    }

    .fh-tag {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      font-size: 11px;
      font-weight: 600;
      color: var(--blue);
      background: var(--sky);
      border-radius: 999px;
      padding: 4px 12px;
      margin-bottom: 14px;
      letter-spacing: 0.06em;
      text-transform: uppercase;
    }

    .fh-tag svg {
      width: 10px;
      height: 10px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2.5;
    }

    /* H2 dari PHP */
    .form-inner h2 {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 26px;
      font-weight: 800;
      color: #003366;
      letter-spacing: -0.5px;
      line-height: 1.15;
      margin-bottom: 6px;
    }

    .fh-sub {
      font-size: 14px;
      font-weight: 400;
      color: #4a6fa5;
      margin-bottom: 20px;
    }

    /* Flash messages dari PHP */
    .form-inner p[style*="color:red"],
    .form-inner p[style*="color: red"] {
      all: unset;
      display: flex;
      align-items: center;
      gap: 8px;
      background: #fef2f2;
      border: 1px solid #fecaca;
      border-radius: 9px;
      padding: 10px 14px;
      font-size: 13px;
      font-weight: 500;
      color: var(--danger);
      margin-bottom: 16px;
      font-family: 'Inter', sans-serif;
    }

    .form-inner p[style*="color:green"],
    .form-inner p[style*="color: green"] {
      all: unset;
      display: flex;
      align-items: center;
      gap: 8px;
      background: var(--green-lt);
      border: 1px solid rgba(16, 185, 129, 0.25);
      border-radius: 9px;
      padding: 10px 14px;
      font-size: 13px;
      font-weight: 500;
      color: var(--green);
      margin-bottom: 16px;
      font-family: 'Inter', sans-serif;
    }

    /* Form */
    form br {
      display: none;
    }

    form hr {
      display: none;
    }

    form label {
      display: block;
      font-size: 12px;
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 0.06em;
      color: #7a9bc5;
      margin-bottom: 7px;
    }

    .iw {
      position: relative;
      margin-bottom: 14px;
    }

    .iw input {
      margin-bottom: 0 !important;
    }

    .iw .ico {
      position: absolute;
      left: 13px;
      top: 50%;
      transform: translateY(-50%);
      color: #b0bec5;
      pointer-events: none;
      display: flex;
      align-items: center;
      z-index: 1;
    }

    .iw .ico svg {
      width: 14px;
      height: 14px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2;
    }

    .iw.has-toggle input {
      padding-right: 42px !important;
    }

    form input[type="email"],
    form input[type="password"] {
      width: 100%;
      padding: 11px 14px 11px 40px;
      border: 1.5px solid var(--line);
      border-radius: 10px;
      font-size: 14px;
      font-family: 'Inter', sans-serif;
      font-weight: 400;
      color: #003366;
      background: #f7fafd;
      outline: none;
      transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
    }

    form input[type="email"]:focus,
    form input[type="password"]:focus {
      border-color: var(--blue);
      background: #fff;
      box-shadow: 0 0 0 3.5px rgba(0, 123, 255, 0.1);
    }

    form input::placeholder {
      color: #c0d4e8;
      font-weight: 400;
    }

    .pw-btn {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      cursor: pointer;
      color: #b0bec5;
      display: flex;
      padding: 0;
      transition: color 0.2s;
    }

    .pw-btn:hover {
      color: var(--blue);
    }

    .pw-btn svg {
      width: 15px;
      height: 15px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2;
    }

    /* Submit button */
    form button[type="submit"] {
      width: 100%;
      padding: 13px;
      margin-top: 8px;
      background: linear-gradient(135deg, #003366 0%, #0056B3 100%);
      color: #fff;
      border: none;
      border-radius: 10px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 15px;
      font-weight: 700;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      position: relative;
      overflow: hidden;
      box-shadow: 0 4px 16px rgba(0, 51, 102, 0.2);
      transition: transform 0.15s, box-shadow 0.15s;
    }

    form button[type="submit"]::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, #007BFF 0%, #0056B3 100%);
      transform: translateX(-101%);
      transition: transform 0.38s cubic-bezier(.22, .61, .36, 1);
    }

    form button[type="submit"]:hover {
      transform: translateY(-1px);
      box-shadow: 0 6px 24px rgba(0, 123, 255, 0.3);
    }

    form button[type="submit"]:hover::before {
      transform: translateX(0);
    }

    form button[type="submit"] span {
      position: relative;
      z-index: 1;
    }

    form button[type="submit"] svg {
      position: relative;
      z-index: 1;
      width: 16px;
      height: 16px;
      stroke: #fff;
      fill: none;
      stroke-width: 2.2;
    }

    /* Divider & bottom */
    .bottom-divider {
      display: flex;
      align-items: center;
      gap: 12px;
      margin: 22px 0 18px;
      font-size: 11px;
      font-weight: 600;
      color: #c0d4e8;
      text-transform: uppercase;
      letter-spacing: 0.1em;
    }

    .bottom-divider::before,
    .bottom-divider::after {
      content: '';
      flex: 1;
      height: 1px;
      background: var(--line);
    }

    /* P & A dari PHP — disembunyikan, diganti switch-row */
    .form-inner>p:not([style]) {
      display: none;
    }

    .form-inner>a {
      display: none;
    }

    .switch-row {
      text-align: center;
      font-size: 14px;
      font-weight: 400;
      color: #4a6fa5;
    }

    .switch-row a {
      color: var(--blue);
      font-weight: 600;
      text-decoration: none;
    }

    .switch-row a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>

  <div class="shell">

    <!-- LEFT PANEL -->
    <div class="panel-left">
      <div class="orb orb-1"></div>
      <div class="orb orb-2"></div>
      <div class="left-inner">

        <div>
          <a href="#" class="brand">
            <div class="brand-mark">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20" />
              </svg>
            </div>
            <div>
              <span class="brand-name">Sistem Jurnal Magang</span>
              <span class="brand-sub">Diskominfo Wonogiri</span>
            </div>
          </a>
          <div class="eyebrow">
            <div class="pulse-dot"></div> Jurnal Digital 2026
          </div>
          <h1 class="hero-h1">Catat Kegiatan<br>Magang dengan <em>Mudah</em></h1>
          <p class="hero-p">Sistem jurnal digital untuk peserta magang Diskominfo. Tulis, pantau, dan validasi kegiatan magang harianmu kapan saja.</p>
        </div>

        <div class="features">
          <div class="feat">
            <div class="feat-ic">
              <svg viewBox="0 0 24 24">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                <polyline points="14 2 14 8 20 8" />
                <line x1="16" y1="13" x2="8" y2="13" />
                <line x1="16" y1="17" x2="8" y2="17" />
              </svg>
            </div>
            <div>
              <div class="feat-title">Jurnal Kegiatan Harian</div>
              <div class="feat-desc">Catat aktivitas magang setiap hari dengan mudah</div>
            </div>
          </div>
          <div class="feat">
            <div class="feat-ic">
              <svg viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
              </svg>
            </div>
            <div>
              <div class="feat-title">Validasi oleh Mentor</div>
              <div class="feat-desc">Jurnal diperiksa dan divalidasi langsung oleh mentor</div>
            </div>
          </div>
          <div class="feat">
            <div class="feat-ic">
              <svg viewBox="0 0 24 24">
                <rect x="3" y="4" width="18" height="18" rx="2" />
                <line x1="16" y1="2" x2="16" y2="6" />
                <line x1="8" y1="2" x2="8" y2="6" />
                <line x1="3" y1="10" x2="21" y2="10" />
              </svg>
            </div>
            <div>
              <div class="feat-title">Rekap Kegiatan Bulanan</div>
              <div class="feat-desc">Lihat histori lengkap jurnal selama periode magang</div>
            </div>
          </div>
          <div class="feat">
            <div class="feat-ic">
              <svg viewBox="0 0 24 24">
                <polyline points="9 11 12 14 22 4" />
                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
              </svg>
            </div>
            <div>
              <div class="feat-title">Laporan Siap Cetak</div>
              <div class="feat-desc">Ekspor jurnal sebagai laporan akhir magang</div>
            </div>
          </div>
        </div>

        <div class="stats-wrap">
          <div class="stats-row">
            <div class="stat">
              <div class="stat-n">50<sup>+</sup></div>
              <div class="stat-l">Peserta Aktif</div>
            </div>
            <div class="stat">
              <div class="stat-n">3<sup>bln</sup></div>
              <div class="stat-l">Periode Magang</div>
            </div>
            <div class="stat">
              <div class="stat-n">8<sup>+</sup></div>
              <div class="stat-l">Unit Kerja</div>
            </div>
          </div>
          <p class="copy">© 2026 Dinas Komunikasi dan Informatika Wonogiri</p>
        </div>

      </div>
    </div>

    <!-- RIGHT PANEL -->
    <div class="panel-right">
      <div class="form-inner">

        <div class="mobile-brand">
          <div class="mobile-brand-mark">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20" />
            </svg>
          </div>
          <span class="mobile-brand-name">Sistem Jurnal Magang</span>
        </div>

        <div class="fh">
          <div class="fh-tag">
            <svg viewBox="0 0 24 24">
              <circle cx="12" cy="12" r="10" />
              <polyline points="12 6 12 12 16 14" />
            </svg>
            Portal Masuk
          </div>
        </div>

        <!-- KODE PHP ASLI — tidak ada yang diubah -->

        <h2>Login</h2>
        <p class="fh-sub">Masuk untuk mencatat kegiatan magang harianmu</p>

        <?php if (session()->getFlashdata('error')): ?>
          <p style="color:red;">
            <?= session()->getFlashdata('error') ?>
          </p>
        <?php endif ?>

        <?php if (session()->getFlashdata('success')): ?>
          <p style="color:green;">
            <?= session()->getFlashdata('success') ?>
          </p>
        <?php endif ?>

        <form action="/login" method="post">
          <?= csrf_field() ?>

          <label>Email</label><br>
          <div class="iw">
            <div class="ico">
              <svg viewBox="0 0 24 24">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                <polyline points="22,6 12,13 2,6" />
              </svg>
            </div>
            <input type="email" name="email" placeholder="email@kampus.ac.id" required>
          </div><br>

          <label>Password</label><br>
          <div class="iw has-toggle">
            <div class="ico">
              <svg viewBox="0 0 24 24">
                <rect x="3" y="11" width="18" height="11" rx="2" />
                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
              </svg>
            </div>
            <input type="password" name="password" id="pw-input" placeholder="••••••••" required>
            <button type="button" class="pw-btn" id="pw-toggle-btn" onclick="togglePw()">
              <svg viewBox="0 0 24 24">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                <circle cx="12" cy="12" r="3" />
              </svg>
            </button>
          </div><br>

          <button type="submit">
            <span>Login</span>
            <svg viewBox="0 0 24 24">
              <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
              <polyline points="10 17 15 12 10 7" />
              <line x1="15" y1="12" x2="3" y2="12" />
            </svg>
          </button>
        </form>

        <hr>

        <p>Belum punya akun?</p>
        <a href="/register">➕ Daftar di sini</a>

        <!-- akhir PHP asli -->

        <div class="bottom-divider">atau</div>
        <div class="switch-row">
          Belum punya akun? <a href="/register">Daftar sekarang</a>
        </div>

      </div>
    </div>

  </div>

  <script>
    function togglePw() {
      const inp = document.getElementById('pw-input');
      const btn = document.getElementById('pw-toggle-btn');
      const hide = inp.type === 'password';
      inp.type = hide ? 'text' : 'password';
      btn.innerHTML = hide ?
        '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>' :
        '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>';
    }
  </script>
</body>

</html>