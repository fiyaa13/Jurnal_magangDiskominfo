<?php $errors = session()->getFlashdata('errors') ?? []; ?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrasi Mahasiswa — Sistem Jurnal Magang</title>
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
      --amber: #f59e0b;
      --amber-lt: #fffbeb;
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
      grid-template-columns: 1fr 520px;
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
      background: radial-gradient(circle, rgba(245, 158, 11, 0.12), transparent 65%);
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

    .preview {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      opacity: 0;
      animation: rise 0.7s 0.4s forwards;
    }

    .preview-label {
      font-size: 11px;
      font-weight: 600;
      color: rgba(255, 255, 255, 0.25);
      text-transform: uppercase;
      letter-spacing: 0.12em;
      margin-bottom: 14px;
    }

    .preview-card {
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.08);
      border-radius: 14px;
      padding: 18px 20px;
    }

    .preview-row {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 8px 0;
      border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .preview-row:last-child {
      border-bottom: none;
      padding-bottom: 0;
    }

    .preview-ic {
      width: 28px;
      height: 28px;
      border-radius: 7px;
      flex-shrink: 0;
      background: rgba(255, 255, 255, 0.06);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .preview-ic svg {
      width: 13px;
      height: 13px;
      stroke: #93c5fd;
      fill: none;
      stroke-width: 2;
    }

    .preview-key {
      font-size: 12px;
      font-weight: 400;
      color: rgba(255, 255, 255, 0.35);
      flex: 1;
    }

    .preview-req {
      font-size: 11px;
      font-weight: 600;
      color: #fca5a5;
      background: rgba(239, 68, 68, 0.12);
      border-radius: 4px;
      padding: 2px 7px;
    }

    .left-foot {
      opacity: 0;
      animation: rise 0.7s 0.55s forwards;
    }

    .copy {
      font-size: 12px;
      color: rgba(255, 255, 255, 0.2);
      text-align: center;
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
      overflow-y: auto;
    }

    .form-inner {
      padding: 48px 44px;
      min-height: 100%;
    }

    @media (max-width: 960px) {
      .form-inner {
        padding: 40px 24px;
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

    /* tag */
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
      margin-bottom: 24px;
    }

    /* section divider */
    .sec-div {
      display: flex;
      align-items: center;
      gap: 10px;
      margin: 20px 0 14px;
    }

    .sec-div-line {
      flex: 1;
      height: 1px;
      background: var(--line);
    }

    .sec-div-label {
      font-size: 11px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      white-space: nowrap;
    }

    .sec-div-ic {
      width: 24px;
      height: 24px;
      border-radius: 6px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .sec-div-ic svg {
      width: 12px;
      height: 12px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2.2;
    }

    .sec-div.blue .sec-div-ic {
      background: var(--sky);
      color: var(--blue);
    }

    .sec-div.blue .sec-div-label {
      color: var(--blue);
    }

    .sec-div.amber .sec-div-ic {
      background: var(--amber-lt);
      color: var(--amber);
    }

    .sec-div.amber .sec-div-label {
      color: var(--amber);
    }

    /* form grid */
    .form-grid-2 {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 0 12px;
    }

    @media (max-width: 580px) {
      .form-grid-2 {
        grid-template-columns: 1fr;
      }
    }

    /* ── FORM FIELDS ── */
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

    form input[type="text"],
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
      margin-bottom: 0;
    }

    form input[type="text"]:focus,
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

    /* pw strength */
    .pw-strength {
      margin: -6px 0 10px;
    }

    .pw-bars {
      display: flex;
      gap: 4px;
      margin-bottom: 4px;
    }

    .pw-bar {
      height: 3px;
      flex: 1;
      border-radius: 999px;
      background: var(--line);
      transition: background 0.3s;
    }

    .pw-lbl {
      font-size: 12px;
      font-weight: 400;
      color: #4a6fa5;
    }

    /* submit button */
    form button[type="submit"] {
      width: 100%;
      padding: 13px;
      margin-top: 20px;
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

    form button[type="submit"] span,
    form button[type="submit"] svg {
      position: relative;
      z-index: 1;
    }

    form button[type="submit"] svg {
      width: 16px;
      height: 16px;
      stroke: #fff;
      fill: none;
      stroke-width: 2.2;
    }

    /* switch row */
    .switch-row {
      text-align: center;
      font-size: 14px;
      font-weight: 400;
      color: #4a6fa5;
      margin-top: 18px;
    }

    .switch-row a {
      color: var(--blue);
      font-weight: 600;
      text-decoration: none;
    }

    .switch-row a:hover {
      text-decoration: underline;
    }


    /* ── Pesan validasi ── */
    .form-alert {
      display: flex;
      align-items: flex-start;
      gap: 8px;
      background: #fef2f2;
      border: 1px solid #fecaca;
      border-radius: 10px;
      padding: 12px 14px;
      margin-bottom: 18px;
      font-size: 13px;
      font-weight: 500;
      line-height: 1.5;
      color: #dc2626;
    }

    .form-alert svg {
      width: 16px;
      height: 16px;
      flex-shrink: 0;
      margin-top: 1px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2;
    }

    form input.is-invalid {
      border-color: #ef4444 !important;
      background: #fef2f2 !important;
    }

    .field-error {
      display: flex;
      align-items: center;
      gap: 5px;
      margin: -8px 0 14px;
      font-size: 12px;
      font-weight: 500;
      color: #dc2626;
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
            <div class="pulse-dot"></div> Registrasi Mahasiswa
          </div>
          <h1 class="hero-h1">Daftar &amp;<br><em>Mulai Jurnal</em></h1>
          <p class="hero-p">Lengkapi data dirimu untuk bergabung ke sistem jurnal digital Diskominfo Wonogiri.</p>
        </div>

        <div class="preview">
          <div class="preview-label">Informasi yang Dibutuhkan</div>
          <div class="preview-card">
            <div class="preview-row">
              <div class="preview-ic"><svg viewBox="0 0 24 24">
                  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                  <circle cx="12" cy="7" r="4" />
                </svg></div>
              <span class="preview-key">Nama Lengkap</span>
              <span class="preview-req">Wajib</span>
            </div>
            <div class="preview-row">
              <div class="preview-ic"><svg viewBox="0 0 24 24">
                  <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                  <polyline points="22,6 12,13 2,6" />
                </svg></div>
              <span class="preview-key">Email Aktif</span>
              <span class="preview-req">Wajib</span>
            </div>
            <div class="preview-row">
              <div class="preview-ic"><svg viewBox="0 0 24 24">
                  <rect x="3" y="11" width="18" height="11" rx="2" />
                  <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                </svg></div>
              <span class="preview-key">Password</span>
              <span class="preview-req">Min. 8 karakter</span>
            </div>
            <div class="preview-row">
              <div class="preview-ic"><svg viewBox="0 0 24 24">
                  <rect x="1" y="4" width="22" height="16" rx="2" />
                  <line x1="1" y1="10" x2="23" y2="10" />
                </svg></div>
              <span class="preview-key">NIM</span>
              <span class="preview-req">Wajib</span>
            </div>
            <div class="preview-row">
              <div class="preview-ic"><svg viewBox="0 0 24 24">
                  <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
                  <path d="M6 12v5c3 3 9 3 12 0v-5" />
                </svg></div>
              <span class="preview-key">Asal Universitas</span>
              <span class="preview-req">Wajib</span>
            </div>
            <div class="preview-row">
              <div class="preview-ic"><svg viewBox="0 0 24 24">
                  <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                </svg></div>
              <span class="preview-key">Bidang &amp; Periode Magang</span>
              <span class="preview-req">Wajib</span>
            </div>
          </div>
        </div>

        <div class="left-foot">
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

        <div class="fh-tag">
          <svg viewBox="0 0 24 24">
            <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
            <path d="M6 12v5c3 3 9 3 12 0v-5" />
          </svg>
          Mahasiswa Magang
        </div>

        <h2>Registrasi Mahasiswa Magang</h2>
        <p class="fh-sub">Lengkapi semua data di bawah ini untuk membuat akun</p>

        <?php if ($errors || session()->getFlashdata('error')): ?>
          <div class="form-alert" role="alert">
            <svg viewBox="0 0 24 24">
              <circle cx="12" cy="12" r="10" />
              <line x1="12" y1="8" x2="12" y2="12" />
              <line x1="12" y1="16" x2="12.01" y2="16" />
            </svg>
            <span><?= esc(session()->getFlashdata('error') ?? 'Periksa kembali isian yang ditandai merah di bawah.') ?></span>
          </div>
        <?php endif ?>


        <form action="<?= base_url('register/mahasiswa') ?>" method="post">
          <?= csrf_field() ?>

          <!-- Seksi Data Akun -->
          <div class="sec-div blue">
            <div class="sec-div-ic"><svg viewBox="0 0 24 24">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                <circle cx="12" cy="7" r="4" />
              </svg></div>
            <span class="sec-div-label">Data Akun</span>
            <div class="sec-div-line"></div>
          </div>

          <label>Nama Lengkap</label><br>
          <div class="iw">
            <div class="ico"><svg viewBox="0 0 24 24">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                <circle cx="12" cy="7" r="4" />
              </svg></div>
            <input <?= isset($errors['name']) ? 'class="is-invalid" ' : '' ?>type="text" name="name" value="<?= esc(old('name'), 'attr') ?>" placeholder="Nama lengkap sesuai KTP" required>
          </div>
          <?php if (isset($errors['name'])): ?><p class="field-error"><?= esc($errors['name']) ?></p><?php endif ?><br>

          <label>Email</label><br>
          <div class="iw">
            <div class="ico"><svg viewBox="0 0 24 24">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                <polyline points="22,6 12,13 2,6" />
              </svg></div>
            <input <?= isset($errors['email']) ? 'class="is-invalid" ' : '' ?>type="email" name="email" value="<?= esc(old('email'), 'attr') ?>" placeholder="email@kampus.ac.id" required>
          </div>
          <?php if (isset($errors['email'])): ?><p class="field-error"><?= esc($errors['email']) ?></p><?php endif ?><br>

          <label>Password</label><br>
          <div class="iw has-toggle">
            <div class="ico"><svg viewBox="0 0 24 24">
                <rect x="3" y="11" width="18" height="11" rx="2" />
                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
              </svg></div>
            <input <?= isset($errors['password']) ? 'class="is-invalid" ' : '' ?>type="password" name="password" id="pw-input" placeholder="Min. 8 karakter" oninput="updateStrength()" required>
            <button type="button" class="pw-btn" id="pw-toggle-btn" onclick="togglePw()">
              <svg viewBox="0 0 24 24">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                <circle cx="12" cy="12" r="3" />
              </svg>
            </button>
          </div>
          <?php if (isset($errors['password'])): ?><p class="field-error"><?= esc($errors['password']) ?></p><?php endif ?>
          <div class="pw-strength">
            <div class="pw-bars">
              <div class="pw-bar" id="b1"></div>
              <div class="pw-bar" id="b2"></div>
              <div class="pw-bar" id="b3"></div>
              <div class="pw-bar" id="b4"></div>
            </div>
            <span class="pw-lbl" id="pw-lbl">Minimal 8 karakter</span>
          </div><br>

          <hr>

          <!-- Seksi Data Magang -->
          <div class="sec-div amber">
            <div class="sec-div-ic"><svg viewBox="0 0 24 24">
                <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
                <path d="M6 12v5c3 3 9 3 12 0v-5" />
              </svg></div>
            <span class="sec-div-label">Data Magang</span>
            <div class="sec-div-line"></div>
          </div>

          <label>NIM</label><br>
          <div class="iw">
            <div class="ico"><svg viewBox="0 0 24 24">
                <rect x="1" y="4" width="22" height="16" rx="2" />
                <line x1="1" y1="10" x2="23" y2="10" />
              </svg></div>
            <input <?= isset($errors['nim']) ? 'class="is-invalid" ' : '' ?>type="text" name="nim" value="<?= esc(old('nim'), 'attr') ?>" placeholder="Nomor Induk Mahasiswa" required>
          </div>
          <?php if (isset($errors['nim'])): ?><p class="field-error"><?= esc($errors['nim']) ?></p><?php endif ?><br>

          <label>Asal Universitas</label><br>
          <div class="iw">
            <div class="ico"><svg viewBox="0 0 24 24">
                <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
                <path d="M6 12v5c3 3 9 3 12 0v-5" />
              </svg></div>
            <input <?= isset($errors['asal_universitas']) ? 'class="is-invalid" ' : '' ?>type="text" name="asal_universitas" value="<?= esc(old('asal_universitas'), 'attr') ?>" placeholder="Nama universitas" required>
          </div>
          <?php if (isset($errors['asal_universitas'])): ?><p class="field-error"><?= esc($errors['asal_universitas']) ?></p><?php endif ?><br>

          <div class="form-grid-2">
            <div>
              <label>Bidang Magang</label><br>
              <div class="iw">
                <div class="ico"><svg viewBox="0 0 24 24">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                    <polyline points="9 22 9 12 15 12 15 22" />
                  </svg></div>
                <input <?= isset($errors['bidang_magang']) ? 'class="is-invalid" ' : '' ?>type="text" name="bidang_magang" value="<?= esc(old('bidang_magang'), 'attr') ?>" placeholder="Contoh: Bidang TI" required>
              </div>
          <?php if (isset($errors['bidang_magang'])): ?><p class="field-error"><?= esc($errors['bidang_magang']) ?></p><?php endif ?><br>
            </div>
            <div>
              <label>Periode Magang</label><br>
              <div class="iw">
                <div class="ico"><svg viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2" />
                    <line x1="16" y1="2" x2="16" y2="6" />
                    <line x1="8" y1="2" x2="8" y2="6" />
                    <line x1="3" y1="10" x2="21" y2="10" />
                  </svg></div>
                <input <?= isset($errors['periode_magang']) ? 'class="is-invalid" ' : '' ?>type="text" name="periode_magang" value="<?= esc(old('periode_magang'), 'attr') ?>" placeholder="Contoh: Jan–Jun 2026" required>
              </div>
          <?php if (isset($errors['periode_magang'])): ?><p class="field-error"><?= esc($errors['periode_magang']) ?></p><?php endif ?><br>
            </div>
          </div>

          <button type="submit">
            <span>Daftar sebagai Mahasiswa</span>
            <svg viewBox="0 0 24 24">
              <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
              <circle cx="8.5" cy="7" r="4" />
              <line x1="20" y1="8" x2="20" y2="14" />
              <line x1="23" y1="11" x2="17" y2="11" />
            </svg>
          </button>

        </form>

        <div class="switch-row">
          Sudah punya akun? <a href="<?= base_url('login') ?>">Masuk di sini</a>
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

    function updateStrength() {
      const pw = document.getElementById('pw-input').value;
      let score = 0;
      if (pw.length >= 8) score++;
      if (/[A-Z]/.test(pw)) score++;
      if (/[0-9]/.test(pw)) score++;
      if (/[^A-Za-z0-9]/.test(pw)) score++;
      const color = score <= 1 ? '#ef4444' : score <= 2 ? '#f59e0b' : '#007BFF';
      for (let i = 1; i <= 4; i++) {
        document.getElementById('b' + i).style.background = i <= score ? color : 'var(--line)';
      }
      const labels = ['Minimal 8 karakter', 'Lemah', 'Cukup', 'Kuat', 'Sangat Kuat'];
      const colors = ['#4a6fa5', '#ef4444', '#f59e0b', '#007BFF', '#007BFF'];
      const lbl = document.getElementById('pw-lbl');
      lbl.textContent = pw === '' ? labels[0] : labels[score];
      lbl.style.color = pw === '' ? colors[0] : colors[score];
    }
  </script>
</body>

</html>