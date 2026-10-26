<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pilih Registrasi — Sistem Jurnal Magang</title>
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
      --green: #10b981;
      --green-lt: #d1fae5;
      --amber: #f59e0b;
    }

    html,
    body {
      height: 100%;
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

    .left-top {
      position: relative;
      z-index: 2;
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

    .hero-eyebrow {
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

    /* step guide */
    .steps {
      position: relative;
      z-index: 2;
      margin: 44px 0;
      opacity: 0;
      animation: rise 0.7s 0.4s forwards;
    }

    .steps-title {
      font-size: 11px;
      font-weight: 600;
      color: rgba(255, 255, 255, 0.25);
      text-transform: uppercase;
      letter-spacing: 0.12em;
      margin-bottom: 18px;
    }

    .step {
      display: flex;
      align-items: flex-start;
      gap: 14px;
      padding: 10px 0;
      position: relative;
    }

    .step+.step::before {
      content: '';
      position: absolute;
      left: 15px;
      top: -12px;
      width: 1px;
      height: 14px;
      background: rgba(255, 255, 255, 0.08);
    }

    .step-num {
      width: 30px;
      height: 30px;
      border-radius: 8px;
      flex-shrink: 0;
      background: rgba(255, 255, 255, 0.08);
      border: 1px solid rgba(255, 255, 255, 0.12);
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 12px;
      font-weight: 700;
      color: #93c5fd;
    }

    .step-body-title {
      font-size: 14px;
      font-weight: 600;
      color: rgba(255, 255, 255, 0.85);
    }

    .step-body-desc {
      font-size: 12px;
      font-weight: 400;
      color: rgba(255, 255, 255, 0.35);
      margin-top: 2px;
    }

    /* info card */
    .info-card {
      position: relative;
      z-index: 2;
      border: 1px solid rgba(255, 255, 255, 0.08);
      background: rgba(255, 255, 255, 0.04);
      border-radius: 14px;
      padding: 18px 20px;
      opacity: 0;
      animation: rise 0.7s 0.55s forwards;
    }

    .info-card-head {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 12px;
      font-weight: 600;
      color: rgba(255, 255, 255, 0.5);
      margin-bottom: 12px;
    }

    .info-card-head svg {
      width: 13px;
      height: 13px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2;
    }

    .info-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 7px 0;
      border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .info-row:last-child {
      border-bottom: none;
      padding-bottom: 0;
    }

    .info-key {
      font-size: 12px;
      font-weight: 400;
      color: rgba(255, 255, 255, 0.3);
    }

    .info-val {
      font-size: 12px;
      font-weight: 600;
      color: rgba(255, 255, 255, 0.7);
    }

    .badge-green {
      display: inline-flex;
      align-items: center;
      gap: 4px;
      background: rgba(16, 185, 129, 0.15);
      border-radius: 999px;
      padding: 2px 8px;
      font-size: 11px;
      font-weight: 600;
      color: #6ee7b7;
    }

    .badge-green::before {
      content: '';
      width: 5px;
      height: 5px;
      border-radius: 50%;
      background: #6ee7b7;
      display: block;
    }

    .copy {
      font-size: 12px;
      color: rgba(255, 255, 255, 0.2);
      text-align: center;
      margin-top: 14px;
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
      padding: 48px 44px;
      min-height: 100vh;
    }

    .form-box {
      width: 100%;
      max-width: 380px;
      animation: rise 0.5s 0.1s both;
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

      .panel-right {
        padding: 40px 24px;
        align-items: flex-start;
        padding-top: 60px;
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

    /* heading */
    .fh {
      margin-bottom: 28px;
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

    .fh h1 {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 26px;
      font-weight: 800;
      color: #003366;
      letter-spacing: -0.5px;
      line-height: 1.15;
      margin-bottom: 6px;
    }

    .fh p {
      font-size: 14px;
      font-weight: 400;
      color: #4a6fa5;
    }

    /* role cards */
    .role-cards {
      display: flex;
      flex-direction: column;
      gap: 14px;
      margin-bottom: 24px;
    }

    .role-card {
      display: flex;
      align-items: center;
      gap: 16px;
      width: 100%;
      padding: 20px;
      background: #f7fafd;
      border: 1.5px solid var(--line);
      border-radius: 14px;
      cursor: pointer;
      text-align: left;
      text-decoration: none;
      transition: border-color 0.22s, background 0.22s, box-shadow 0.22s, transform 0.18s;
      position: relative;
      overflow: hidden;
    }

    .role-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(0, 51, 102, 0.08);
    }

    .role-card.mhs:hover {
      border-color: var(--blue);
      background: #eff6ff;
    }

    .role-card.mhs:hover .role-ic {
      background: var(--blue);
      border-color: var(--blue);
    }

    .role-card.mhs:hover .role-ic svg {
      stroke: #fff;
    }

    .role-card.mhs:hover .role-arrow {
      color: var(--blue);
      transform: translateX(4px);
    }

    .role-card.mnt:hover {
      border-color: var(--green);
      background: #f0fdf7;
    }

    .role-card.mnt:hover .role-ic {
      background: var(--green);
      border-color: var(--green);
    }

    .role-card.mnt:hover .role-ic svg {
      stroke: #fff;
    }

    .role-card.mnt:hover .role-arrow {
      color: var(--green);
      transform: translateX(4px);
    }

    .role-ic {
      width: 48px;
      height: 48px;
      border-radius: 12px;
      flex-shrink: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1.5px solid var(--line);
      background: #fff;
      transition: all 0.22s;
    }

    .role-ic svg {
      width: 22px;
      height: 22px;
      fill: none;
      stroke-width: 2;
      transition: stroke 0.2s;
    }

    .role-card.mhs .role-ic svg {
      stroke: var(--blue);
    }

    .role-card.mnt .role-ic svg {
      stroke: var(--green);
    }

    .role-info {
      flex: 1;
      min-width: 0;
    }

    .role-tag {
      display: inline-block;
      font-size: 11px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      border-radius: 4px;
      padding: 2px 8px;
      margin-bottom: 5px;
    }

    .role-card.mhs .role-tag {
      background: var(--sky);
      color: var(--blue);
    }

    .role-card.mnt .role-tag {
      background: var(--green-lt);
      color: var(--green);
    }

    .role-title {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 15px;
      font-weight: 700;
      color: #003366;
      margin-bottom: 3px;
    }

    .role-desc {
      font-size: 12px;
      font-weight: 400;
      color: #4a6fa5;
      line-height: 1.4;
    }

    .role-arrow {
      flex-shrink: 0;
      color: #c0d4e8;
      transition: color 0.2s, transform 0.2s;
    }

    .role-arrow svg {
      width: 18px;
      height: 18px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2.2;
    }

    /* divider */
    .or-divider {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 18px;
      font-size: 11px;
      font-weight: 600;
      color: #c0d4e8;
      text-transform: uppercase;
      letter-spacing: 0.1em;
    }

    .or-divider::before,
    .or-divider::after {
      content: '';
      flex: 1;
      height: 1px;
      background: var(--line);
    }

    /* back link */
    .back-row {
      text-align: center;
    }

    .back-link {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 14px;
      font-weight: 500;
      color: #4a6fa5;
      text-decoration: none;
      transition: color 0.2s;
    }

    .back-link:hover {
      color: #003366;
    }

    .back-link svg {
      width: 14px;
      height: 14px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2.2;
      transition: transform 0.2s;
    }

    .back-link:hover svg {
      transform: translateX(-3px);
    }

    /* switch */
    .switch-row {
      text-align: center;
      font-size: 14px;
      font-weight: 400;
      color: #4a6fa5;
      margin-top: 20px;
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

      <div class="left-top">
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

        <div class="hero-eyebrow">
          <div class="pulse-dot"></div> Bergabung Sekarang
        </div>
        <h1 class="hero-h1">Mulai <em>Perjalanan</em><br>Magangmu</h1>
        <p class="hero-p">Daftarkan dirimu ke sistem jurnal digital Diskominfo dan mulai catat kegiatan magang secara mudah dan terstruktur.</p>
      </div>

      <div class="steps">
        <div class="steps-title">Cara Mendaftar</div>
        <div class="step">
          <div class="step-num">01</div>
          <div>
            <div class="step-body-title">Pilih Jenis Akun</div>
            <div class="step-body-desc">Mahasiswa atau Mentor — sesuai peranmu</div>
          </div>
        </div>
        <div class="step">
          <div class="step-num">02</div>
          <div>
            <div class="step-body-title">Isi Data Diri</div>
            <div class="step-body-desc">Lengkapi formulir registrasi dengan data valid</div>
          </div>
        </div>
        <div class="step">
          <div class="step-num">03</div>
          <div>
            <div class="step-body-title">Buat Kata Sandi</div>
            <div class="step-body-desc">Tentukan kata sandi yang kuat dan aman</div>
          </div>
        </div>
        <div class="step">
          <div class="step-num">04</div>
          <div>
            <div class="step-body-title">Mulai Jurnal</div>
            <div class="step-body-desc">Login dan catat kegiatanmu setiap hari</div>
          </div>
        </div>
      </div>

      <div>
        <div class="info-card">
          <div class="info-card-head">
            <svg viewBox="0 0 24 24">
              <circle cx="12" cy="12" r="10" />
              <line x1="12" y1="8" x2="12" y2="12" />
              <line x1="12" y1="16" x2="12.01" y2="16" />
            </svg>
            Info Sistem
          </div>
          <div class="info-row">
            <span class="info-key">Peserta Aktif</span>
            <span class="info-val">50+ Mahasiswa</span>
          </div>
          <div class="info-row">
            <span class="info-key">Unit Kerja</span>
            <span class="info-val">8+ Bidang</span>
          </div>
          <div class="info-row">
            <span class="info-key">Status Sistem</span>
            <span class="info-val"><span class="badge-green">Aktif</span></span>
          </div>
          <div class="info-row">
            <span class="info-key">Periode</span>
            <span class="info-val">3 Bulan / Batch</span>
          </div>
        </div>
        <p class="copy">© 2026 Dinas Komunikasi dan Informatika Wonogiri</p>
      </div>
    </div>

    <!-- RIGHT PANEL -->
    <div class="panel-right">
      <div class="form-box">

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
              <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
              <circle cx="8.5" cy="7" r="4" />
              <line x1="20" y1="8" x2="20" y2="14" />
              <line x1="23" y1="11" x2="17" y2="11" />
            </svg>
            Buat Akun Baru
          </div>
          <h1>Pilih Jenis Registrasi</h1>
          <p>Daftar sesuai peranmu di sistem jurnal magang Diskominfo</p>
        </div>

        <div class="role-cards">

          <!-- Mahasiswa -->
          <a href="<?= base_url('register/mahasiswa') ?>" class="role-card mhs">
            <div class="role-ic">
              <svg viewBox="0 0 24 24">
                <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
                <path d="M6 12v5c3 3 9 3 12 0v-5" />
              </svg>
            </div>
            <div class="role-info">
              <span class="role-tag">Mahasiswa</span>
              <div class="role-title">Registrasi Mahasiswa</div>
              <div class="role-desc">Untuk peserta magang yang akan mengisi jurnal kegiatan harian</div>
            </div>
            <div class="role-arrow">
              <svg viewBox="0 0 24 24">
                <polyline points="9 18 15 12 9 6" />
              </svg>
            </div>
          </a>

          <!-- Mentor -->
          <a href="<?= base_url('register/mentor') ?>" class="role-card mnt">
            <div class="role-ic">
              <svg viewBox="0 0 24 24">
                <rect x="2" y="7" width="20" height="14" rx="2" />
                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" />
              </svg>
            </div>
            <div class="role-info">
              <span class="role-tag">Mentor</span>
              <div class="role-title">Registrasi Mentor</div>
              <div class="role-desc">Untuk pembimbing magang yang memantau dan memvalidasi jurnal peserta</div>
            </div>
            <div class="role-arrow">
              <svg viewBox="0 0 24 24">
                <polyline points="9 18 15 12 9 6" />
              </svg>
            </div>
          </a>

        </div>

        <div class="or-divider">atau</div>

        <div class="back-row">
          <a href="<?= base_url('login') ?>" class="back-link">
            <svg viewBox="0 0 24 24">
              <polyline points="15 18 9 12 15 6" />
            </svg>
            Kembali ke halaman login
          </a>
        </div>

        <div class="switch-row">
          Sudah punya akun? <a href="<?= base_url('login') ?>">Masuk di sini</a>
        </div>

      </div>
    </div>

  </div>

</body>

</html>