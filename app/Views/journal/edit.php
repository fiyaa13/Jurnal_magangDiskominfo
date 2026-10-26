<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Jurnal — SIAMANG</title>
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
      --blue: #007BFF;
      --blue-h: #0056B3;
      --sky: #93c5fd;
      --bg: #f0f4f8;
      --white: #ffffff;
      --border: #e2eaf3;
      --text: #003366;
      --sub: #4a6fa5;
      --glass: rgba(255, 255, 255, 0.07);
      --edge: rgba(255, 255, 255, 0.11);
      --faint: rgba(255, 255, 255, 0.18);
      --red: #ef4444;
      --red-l: #fef2f2;
      --red-b: #fecaca;
      --amber: #f59e0b;
      --amber-l: #fef3c7;
      --green: #10b981;
    }

    html,
    body {
      min-height: 100%;
      font-family: 'Inter', sans-serif;
      background: var(--bg);
      color: var(--text);
    }

    /* ═══ TOPBAR ═══ */
    .topbar {
      position: fixed;
      inset: 0 0 auto;
      z-index: 200;
      height: 56px;
      padding: 0 1.75rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: var(--navy);
      border-bottom: 1px solid rgba(255, 255, 255, 0.07);
    }

    .tb-l {
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .tb-logo {
      width: 32px;
      height: 32px;
      border-radius: 8px;
      background: var(--blue);
      box-shadow: 0 0 16px rgba(0, 123, 255, 0.45);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .tb-logo svg {
      width: 15px;
      height: 15px;
      stroke: white;
      fill: none;
      stroke-width: 2;
    }

    .tb-brand b {
      display: block;
      font-size: 0.78rem;
      font-weight: 800;
      color: white;
      line-height: 1;
      letter-spacing: 0.03em;
    }

    .tb-brand span {
      display: block;
      font-size: 0.59rem;
      color: var(--faint);
      margin-top: 1px;
    }

    .tb-sep {
      width: 1px;
      height: 20px;
      background: rgba(255, 255, 255, 0.1);
    }

    .tb-page {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-style: italic;
      font-size: 0.88rem;
      color: rgba(255, 255, 255, 0.45);
    }

    .tb-r {
      display: flex;
      align-items: center;
      gap: 0.6rem;
    }

    .tb-chip {
      display: flex;
      align-items: center;
      gap: 0.45rem;
      padding: 0.24rem 0.7rem 0.24rem 0.26rem;
      background: var(--glass);
      border: 1px solid var(--edge);
      border-radius: 99px;
    }

    .tb-av {
      width: 26px;
      height: 26px;
      border-radius: 50%;
      background: var(--blue);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.58rem;
      font-weight: 800;
      color: white;
    }

    .tb-av svg {
      width: 14px;
      height: 14px;
      stroke: white;
      fill: none;
      stroke-width: 2;
    }

    .tb-uname {
      font-size: 0.72rem;
      font-weight: 600;
      color: rgba(255, 255, 255, 0.82);
    }

    .btn-out {
      display: flex;
      align-items: center;
      gap: 0.32rem;
      padding: 0.3rem 0.75rem;
      border-radius: 7px;
      background: rgba(239, 68, 68, 0.12);
      border: 1px solid rgba(239, 68, 68, 0.22);
      font-family: 'Inter', sans-serif;
      font-size: 0.68rem;
      font-weight: 700;
      color: #fca5a5;
      transition: all 0.18s;
      text-decoration: none;
    }

    .btn-out:hover {
      background: rgba(239, 68, 68, 0.24);
      color: white;
    }

    .btn-out svg {
      width: 12px;
      height: 12px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2.5;
    }

    /* ═══ SHELL ═══ */
    .shell {
      display: flex;
      min-height: 100vh;
      padding-top: 56px;
    }

    /* ═══ SIDEBAR ═══ */
    .sidebar {
      width: 240px;
      flex-shrink: 0;
      background: var(--navy);
      display: flex;
      flex-direction: column;
      border-right: 1px solid rgba(255, 255, 255, 0.07);
      overflow: hidden;
      position: relative;
      min-height: calc(100vh - 56px);
    }

    .sidebar::before {
      content: '';
      position: absolute;
      pointer-events: none;
      width: 400px;
      height: 400px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(0, 123, 255, 0.14) 0%, transparent 60%);
      top: -100px;
      left: -100px;
    }

    .sb-profile {
      padding: 1.6rem 1.4rem 1.4rem;
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
      font-size: 1.1rem;
      font-weight: 800;
      color: white;
      margin-bottom: 0.75rem;
    }

    .sb-av svg {
      width: 24px;
      height: 24px;
      stroke: white;
      fill: none;
      stroke-width: 2;
    }

    .sb-name {
      font-size: 0.88rem;
      font-weight: 700;
      color: white;
      margin-bottom: 3px;
    }

    .sb-nim {
      font-size: 0.62rem;
      color: rgba(255, 255, 255, 0.4);
      margin-bottom: 0.6rem;
    }

    .sb-badge {
      display: inline-block;
      padding: 0.18rem 0.7rem;
      border-radius: 99px;
      background: rgba(0, 123, 255, 0.2);
      border: 1px solid rgba(0, 123, 255, 0.35);
      font-size: 0.62rem;
      font-weight: 700;
      color: var(--sky);
      letter-spacing: 0.04em;
    }

    .sb-menu {
      flex: 1;
      padding: 1.2rem 0.9rem;
      position: relative;
      z-index: 1;
    }

    .sb-section-label {
      font-size: 0.57rem;
      font-weight: 700;
      letter-spacing: 0.14em;
      text-transform: uppercase;
      color: rgba(255, 255, 255, 0.25);
      padding: 0 0.6rem;
      margin-bottom: 0.5rem;
    }

    .sb-item {
      display: flex;
      align-items: center;
      gap: 0.7rem;
      padding: 0.65rem 0.75rem;
      border-radius: 10px;
      margin-bottom: 2px;
      text-decoration: none;
      transition: all 0.18s;
      color: rgba(255, 255, 255, 0.5);
      font-size: 0.78rem;
      font-weight: 500;
    }

    .sb-item:hover {
      background: rgba(255, 255, 255, 0.06);
      color: rgba(255, 255, 255, 0.85);
    }

    .sb-item.active {
      background: rgba(0, 123, 255, 0.22);
      border: 1px solid rgba(0, 123, 255, 0.3);
      color: white;
      font-weight: 700;
    }

    .sb-item svg {
      width: 15px;
      height: 15px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2;
      flex-shrink: 0;
    }

    .sb-foot {
      padding: 1rem 1.4rem;
      border-top: 1px solid rgba(255, 255, 255, 0.06);
      position: relative;
      z-index: 1;
    }

    .sb-foot-txt {
      font-size: 0.58rem;
      color: rgba(255, 255, 255, 0.18);
      text-align: center;
      line-height: 1.6;
    }

    /* ═══ MAIN ═══ */
    .main {
      flex: 1;
      display: flex;
      align-items: flex-start;
      justify-content: center;
      padding: 2.5rem 2rem;
    }

    /* ═══ FORM CARD ═══ */
    .form-card {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 20px;
      width: 100%;
      max-width: 720px;
      box-shadow: 0 4px 24px rgba(0, 51, 102, 0.08);
      overflow: hidden;
      animation: fadeUp 0.45s ease both;
    }

    /* Header — amber untuk membedakan dari create (biru) */
    .card-header {
      background: linear-gradient(135deg, #78350f 0%, #92400e 100%);
      padding: 1.5rem 2rem;
      position: relative;
      overflow: hidden;
    }

    .card-header::before {
      content: '';
      position: absolute;
      pointer-events: none;
      width: 300px;
      height: 300px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(245, 158, 11, 0.2) 0%, transparent 65%);
      top: -100px;
      right: -60px;
    }

    .card-header-tag {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      font-size: 0.62rem;
      font-weight: 700;
      color: #fde68a;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      margin-bottom: 8px;
      position: relative;
      z-index: 1;
    }

    .card-header-tag svg {
      width: 10px;
      height: 10px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2;
    }

    /* H2 asli dari PHP */
    .form-card h2 {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 1.6rem;
      font-weight: 400;
      color: white;
      line-height: 1.15;
      position: relative;
      z-index: 1;
    }

    /* badge tanggal jurnal */
    .journal-meta {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      margin-top: 10px;
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.15);
      border-radius: 99px;
      padding: 4px 12px;
      font-size: 0.68rem;
      color: rgba(255, 255, 255, 0.75);
      font-weight: 500;
      position: relative;
      z-index: 1;
    }

    .journal-meta svg {
      width: 11px;
      height: 11px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2;
    }

    .card-body {
      padding: 2rem;
    }

    /* info note amber */
    .info-note {
      display: flex;
      align-items: flex-start;
      gap: 8px;
      background: var(--amber-l);
      border: 1px solid rgba(245, 158, 11, 0.25);
      border-radius: 9px;
      padding: 10px 12px;
      margin-bottom: 20px;
    }

    .info-note svg {
      width: 14px;
      height: 14px;
      stroke: var(--amber);
      fill: none;
      stroke-width: 2;
      flex-shrink: 0;
      margin-top: 1px;
    }

    .info-note p {
      font-size: 0.72rem;
      color: #92400e;
      line-height: 1.55;
    }

    .info-note strong {
      font-weight: 600;
    }

    /* section divider */
    .sec-div {
      display: flex;
      align-items: center;
      gap: 12px;
      margin: 20px 0 16px;
    }

    .sec-div-line {
      flex: 1;
      height: 1px;
      background: var(--border);
    }

    .sec-div-label {
      font-size: 0.62rem;
      font-weight: 700;
      color: var(--sub);
      text-transform: uppercase;
      letter-spacing: 0.1em;
      white-space: nowrap;
    }

    /* ── FORM FIELDS ── */
    .field {
      margin-bottom: 1.2rem;
    }

    .field label {
      display: block;
      font-size: 0.71rem;
      font-weight: 600;
      color: #475569;
      margin-bottom: 7px;
    }

    .field label .req {
      color: var(--red);
      margin-left: 1px;
    }

    .field label .opt {
      color: var(--sub);
      font-weight: 400;
      font-size: 0.65rem;
      margin-left: 4px;
    }

    .iw {
      position: relative;
    }

    .iw .ico {
      position: absolute;
      left: 13px;
      top: 50%;
      transform: translateY(-50%);
      color: #b0bec5;
      pointer-events: none;
      display: flex;
    }

    .iw .ico svg {
      width: 14px;
      height: 14px;
      stroke: currentColor;
      fill: none;
      stroke-width: 1.8;
    }

    .iw-textarea .ico {
      top: 14px;
      transform: none;
    }

    /* input asli dari PHP — readonly tetap dipertahankan */
    .iw input[type="date"],
    .iw textarea {
      width: 100%;
      padding: 10px 14px 10px 38px;
      border: 1.5px solid var(--border);
      border-radius: 10px;
      font-size: 0.83rem;
      font-family: 'Inter', sans-serif;
      color: var(--text);
      background: #f8fafc;
      outline: none;
      transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
    }

    /* readonly styling */
    .iw input[readonly] {
      background: #f1f5f9;
      color: var(--sub);
      cursor: not-allowed;
      border-color: var(--border);
    }

    .iw input[readonly]:focus {
      border-color: var(--border);
      box-shadow: none;
    }

    .readonly-note {
      font-size: 0.63rem;
      color: var(--sub);
      margin-top: 5px;
      display: flex;
      align-items: center;
      gap: 4px;
    }

    .readonly-note svg {
      width: 11px;
      height: 11px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2;
    }

    .iw textarea {
      resize: vertical;
      min-height: 120px;
      line-height: 1.65;
      padding-top: 12px;
      padding-bottom: 12px;
      vertical-align: top;
    }

    .iw input[type="date"]:focus,
    .iw textarea:focus {
      border-color: var(--amber);
      background: white;
      box-shadow: 0 0 0 3.5px rgba(245, 158, 11, 0.1);
    }

    /* upload zone */
    .upload-zone {
      border: 2px dashed var(--border);
      border-radius: 12px;
      padding: 1.5rem;
      text-align: center;
      cursor: pointer;
      transition: border-color 0.2s, background 0.2s;
      background: #f8fafc;
      position: relative;
    }

    .upload-zone:hover,
    .upload-zone.drag-over {
      border-color: var(--amber);
      background: var(--amber-l);
    }

    .upload-zone input[type="file"] {
      position: absolute;
      inset: 0;
      opacity: 0;
      cursor: pointer;
      width: 100%;
      height: 100%;
    }

    .upload-ic {
      width: 48px;
      height: 48px;
      border-radius: 12px;
      background: var(--amber-l);
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 10px;
      transition: background 0.2s;
    }

    .upload-zone:hover .upload-ic {
      background: #fde68a;
    }

    .upload-ic svg {
      width: 22px;
      height: 22px;
      stroke: var(--amber);
      fill: none;
      stroke-width: 1.8;
    }

    .upload-title {
      font-size: 0.84rem;
      font-weight: 600;
      color: var(--text);
      margin-bottom: 4px;
    }

    .upload-sub {
      font-size: 0.71rem;
      color: var(--sub);
      font-weight: 300;
    }

    .upload-sub span {
      color: var(--amber);
      font-weight: 600;
    }

    .upload-formats {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      margin-top: 10px;
    }

    .fmt-tag {
      display: inline-flex;
      align-items: center;
      gap: 4px;
      padding: 3px 9px;
      border-radius: 999px;
      font-size: 0.62rem;
      font-weight: 700;
      letter-spacing: 0.05em;
      background: var(--amber-l);
      color: #92400e;
      border: 1px solid #fde68a;
    }

    .size-tag {
      font-size: 0.62rem;
      color: var(--sub);
    }

    /* existing photo */
    .existing-photo {
      border: 1px solid var(--border);
      border-radius: 10px;
      overflow: hidden;
      margin-bottom: 12px;
    }

    .existing-photo img {
      width: 100%;
      max-height: 180px;
      object-fit: cover;
      display: block;
    }

    .existing-label {
      font-size: 0.7rem;
      padding: 8px 12px;
      background: #f8fafc;
      border-top: 1px solid var(--border);
      display: flex;
      align-items: center;
      gap: 6px;
      color: var(--sub);
    }

    .existing-label svg {
      width: 13px;
      height: 13px;
      stroke: var(--amber);
      fill: none;
      stroke-width: 2;
    }

    /* preview */
    #preview-wrap {
      display: none;
      margin-top: 12px;
      border: 1px solid var(--border);
      border-radius: 10px;
      overflow: hidden;
      position: relative;
    }

    #preview-img {
      width: 100%;
      max-height: 200px;
      object-fit: cover;
      display: block;
    }

    .preview-overlay {
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.45);
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0;
      transition: opacity 0.2s;
      cursor: pointer;
    }

    #preview-wrap:hover .preview-overlay {
      opacity: 1;
    }

    .preview-overlay span {
      font-size: 0.72rem;
      font-weight: 600;
      color: white;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .preview-overlay span svg {
      width: 14px;
      height: 14px;
      stroke: white;
      fill: none;
      stroke-width: 2;
    }

    .preview-name {
      font-size: 0.7rem;
      color: var(--sub);
      padding: 8px 12px;
      background: #f8fafc;
      border-top: 1px solid var(--border);
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .preview-name svg {
      width: 13px;
      height: 13px;
      stroke: var(--green);
      fill: none;
      stroke-width: 2;
    }

    /* buttons */
    .card-footer {
      padding: 1.25rem 2rem;
      border-top: 1px solid var(--border);
      display: flex;
      gap: 10px;
    }

    .btn-save {
      flex: 1;
      padding: 12px;
      background: var(--ink);
      color: white;
      border: none;
      border-radius: 10px;
      font-size: 0.84rem;
      font-weight: 700;
      font-family: 'Inter', sans-serif;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      position: relative;
      overflow: hidden;
      box-shadow: 0 4px 14px rgba(0, 51, 102, 0.18);
      transition: transform 0.15s, box-shadow 0.15s;
    }

    .btn-save::before {
      content: '';
      position: absolute;
      inset: 0;
      background: var(--amber);
      transform: translateX(-101%);
      transition: transform 0.35s cubic-bezier(.22, .61, .36, 1);
    }

    .btn-save:hover {
      transform: translateY(-1px);
      box-shadow: 0 6px 20px rgba(245, 158, 11, 0.3);
    }

    .btn-save:hover::before {
      transform: translateX(0);
    }

    .btn-save span,
    .btn-save svg {
      position: relative;
      z-index: 1;
    }

    .btn-save svg {
      width: 15px;
      height: 15px;
      stroke: white;
      fill: none;
      stroke-width: 2.2;
    }

    .btn-cancel {
      flex: 1;
      padding: 12px;
      text-align: center;
      background: var(--red-l);
      color: #dc2626;
      border: 1.5px solid var(--red-b);
      border-radius: 10px;
      font-size: 0.84rem;
      font-weight: 700;
      font-family: 'Inter', sans-serif;
      text-decoration: none;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      transition: all 0.2s;
    }

    .btn-cancel:hover {
      background: #dc2626;
      color: white;
      border-color: #dc2626;
    }

    .btn-cancel svg {
      width: 15px;
      height: 15px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2.2;
    }

    @keyframes fadeUp {
      from {
        opacity: 0;
        transform: translateY(16px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @media (max-width: 900px) {
      .sidebar {
        display: none;
      }

      .main {
        padding: 1.5rem 1rem;
      }
    }

    @media (max-width: 500px) {
      .card-footer {
        flex-direction: column;
      }
    }
  </style>
</head>

<body>

  <!-- ═══ TOPBAR ═══ -->
  <header class="topbar">
    <div class="tb-l">
      <div class="tb-logo"><svg viewBox="0 0 24 24">
          <rect x="2" y="3" width="20" height="14" rx="2" />
          <path d="M8 21h8M12 17v4" />
        </svg></div>
      <div class="tb-brand"><b>SIAMANG</b><span>Sistem Absensi Magang</span></div>
      <div class="tb-sep"></div>
      <span class="tb-page">Edit Jurnal</span>
    </div>
    <div class="tb-r">
      <div class="tb-chip">
        <div class="tb-av">
          <svg viewBox="0 0 24 24">
            <circle cx="12" cy="8" r="4" />
            <path d="M4 20c0-4 4-6 8-6s8 2 8 6" />
          </svg>
        </div>
        <span class="tb-uname"><?= esc(session()->get('name')) ?></span>
      </div>
      <a href="<?= base_url('logout') ?>" class="btn-out">
        <svg viewBox="0 0 24 24">
          <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
          <polyline points="16 17 21 12 16 7" />
          <line x1="21" y1="12" x2="9" y2="12" />
        </svg>
        Log Out
      </a>
    </div>
  </header>

  <div class="shell">

    <!-- ═══ SIDEBAR ═══ -->
    <aside class="sidebar">
      <div class="sb-profile">
        <div class="sb-av">
          <svg viewBox="0 0 24 24">
            <circle cx="12" cy="8" r="4" />
            <path d="M4 20c0-4 4-6 8-6s8 2 8 6" />
          </svg>
        </div>
        <div class="sb-name"><?= esc(session()->get('name')) ?></div>
        <div class="sb-nim">NIM · <?= esc($profile['nim'] ?? '-') ?></div>
        <span class="sb-badge"><?= esc($profile['bidang_magang'] ?? 'Magang') ?></span>
      </div>
      <nav class="sb-menu">
        <div class="sb-section-label">Menu Utama</div>
        <a class="sb-item" href="<?= base_url('dashboard') ?>">
          <svg viewBox="0 0 24 24">
            <rect x="3" y="3" width="7" height="7" rx="1" />
            <rect x="14" y="3" width="7" height="7" rx="1" />
            <rect x="3" y="14" width="7" height="7" rx="1" />
            <rect x="14" y="14" width="7" height="7" rx="1" />
          </svg>
          Dashboard
        </a>
        <a class="sb-item active" href="<?= base_url('journal') ?>">
          <svg viewBox="0 0 24 24">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
            <polyline points="14 2 14 8 20 8" />
          </svg>
          E-Journal Harian
        </a>
      </nav>
      <div class="sb-foot">
        <div class="sb-foot-txt">© 2026 SIAMANG<br>Diskominfo</div>
      </div>
    </aside>

    <!-- ═══ MAIN ═══ -->
    <main class="main">
      <div class="form-card">

        <!-- Header card — amber (beda dari create yang navy) -->
        <div class="card-header">
          <div class="card-header-tag">
            <svg viewBox="0 0 24 24">
              <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
              <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
            </svg>
            Edit E-Journal
          </div>

          <!-- ============================================= -->
          <!-- KODE PHP ASLI — tidak ada yang diubah         -->
          <!-- ============================================= -->
          <h2>Edit Jurnal</h2>
          <!-- ============================================= -->

          <div class="journal-meta">
            <svg viewBox="0 0 24 24">
              <rect x="3" y="4" width="18" height="18" rx="2" />
              <line x1="16" y1="2" x2="16" y2="6" />
              <line x1="8" y1="2" x2="8" y2="6" />
              <line x1="3" y1="10" x2="21" y2="10" />
            </svg>
            Jurnal: <?= esc($journal['tanggal']) ?>
          </div>
        </div>

        <div class="card-body">

          <div class="info-note">
            <svg viewBox="0 0 24 24">
              <circle cx="12" cy="12" r="10" />
              <line x1="12" y1="8" x2="12" y2="12" />
              <line x1="12" y1="16" x2="12.01" y2="16" />
            </svg>
            <p><strong>Perhatian:</strong> Tanggal jurnal tidak dapat diubah. Kamu hanya bisa mengedit deskripsi dan foto bukti selama jurnal masih berstatus <strong>pending</strong>.</p>
          </div>

          <!-- ============================================= -->
          <!-- FORM PHP ASLI — action, name, value, readonly -->
          <!-- tidak ada yang diubah                         -->
          <!-- ============================================= -->
          <form action="<?= base_url('journal/update/' . $journal['id']) ?>" method="post" enctype="multipart/form-data">

            <div class="sec-div">
              <div class="sec-div-line"></div>
              <span class="sec-div-label">Data Jurnal</span>
              <div class="sec-div-line"></div>
            </div>

            <div class="field">
              <label>Tanggal</label>
              <div class="iw">
                <div class="ico"><svg viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2" />
                    <line x1="16" y1="2" x2="16" y2="6" />
                    <line x1="8" y1="2" x2="8" y2="6" />
                    <line x1="3" y1="10" x2="21" y2="10" />
                  </svg></div>
                <input type="date" name="tanggal"
                  value="<?= $journal['tanggal']; ?>"
                  readonly>
              </div>
              <div class="readonly-note">
                <svg viewBox="0 0 24 24">
                  <rect x="3" y="11" width="18" height="11" rx="2" />
                  <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                </svg>
                Tanggal tidak dapat diubah
              </div>
            </div>

            <div class="field">
              <label>Deskripsi Kegiatan <span class="req">*</span></label>
              <div class="iw iw-textarea">
                <div class="ico"><svg viewBox="0 0 24 24">
                    <line x1="17" y1="10" x2="3" y2="10" />
                    <line x1="21" y1="6" x2="3" y2="6" />
                    <line x1="21" y1="14" x2="3" y2="14" />
                    <line x1="17" y1="18" x2="3" y2="18" />
                  </svg></div>
                <textarea name="deskripsi" rows="5" required><?= esc($journal['deskripsi']); ?></textarea>
              </div>
            </div>

            <!-- Bukti Upload — konsisten dengan halaman create -->
            <div class="sec-div">
              <div class="sec-div-line"></div>
              <span class="sec-div-label">Bukti Kegiatan</span>
              <div class="sec-div-line"></div>
            </div>

            <!-- Foto yang sudah ada (jika ada) -->
            <?php if (!empty($journal['bukti'])): ?>
              <div class="field">
                <label>Foto Bukti Saat Ini</label>
                <div class="existing-photo">
                  <img src="<?= base_url('uploads/jurnal/' . esc($journal['bukti'])) ?>" alt="Bukti jurnal">
                  <div class="existing-label">
                    <svg viewBox="0 0 24 24">
                      <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                      <polyline points="22 4 12 14.01 9 11.01" />
                    </svg>
                    <?= esc($journal['bukti']) ?> — Foto akan diganti jika kamu upload yang baru
                  </div>
                </div>
              </div>
            <?php endif; ?>

            <div class="field">
              <label>
                Ganti Foto Bukti
                <span class="opt">(opsional — kosongkan jika tidak ingin mengubah)</span>
              </label>
              <div class="upload-zone" id="upload-zone">
                <input type="file" name="bukti" id="file-input"
                  accept="image/jpeg,image/jpg,image/png"
                  onchange="previewImage(this)">
                <div class="upload-ic">
                  <svg viewBox="0 0 24 24">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                    <polyline points="17 8 12 3 7 8" />
                    <line x1="12" y1="3" x2="12" y2="15" />
                  </svg>
                </div>
                <div class="upload-title">Klik atau drag foto baru ke sini</div>
                <div class="upload-sub">Format yang didukung: <span>JPG, JPEG, PNG</span></div>
                <div class="upload-formats">
                  <span class="fmt-tag">JPG</span>
                  <span class="fmt-tag">JPEG</span>
                  <span class="fmt-tag">PNG</span>
                  <span class="size-tag">· Maks. 2MB</span>
                </div>
              </div>

              <div id="preview-wrap">
                <img id="preview-img" src="" alt="Preview">
                <div class="preview-overlay" onclick="clearFile()">
                  <span>
                    <svg viewBox="0 0 24 24">
                      <polyline points="3 6 5 6 21 6" />
                      <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                    </svg>
                    Hapus pilihan
                  </span>
                </div>
                <div class="preview-name">
                  <svg viewBox="0 0 24 24">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                    <polyline points="22 4 12 14.01 9 11.01" />
                  </svg>
                  <span id="preview-filename">—</span>
                </div>
              </div>
            </div>

            <!-- BUTTON GROUP PHP ASLI — href & action tetap -->
            <div style="display:flex; gap:10px; margin-top:4px;">
              <button type="submit" class="btn-save">
                <span>Simpan Perubahan</span>
                <svg viewBox="0 0 24 24">
                  <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                  <polyline points="17 21 17 13 7 13 7 21" />
                  <polyline points="7 3 7 8 15 8" />
                </svg>
              </button>
              <a href="<?= base_url('journal') ?>" class="btn-cancel">
                <svg viewBox="0 0 24 24">
                  <line x1="19" y1="12" x2="5" y2="12" />
                  <polyline points="12 19 5 12 12 5" />
                </svg>
                Batal
              </a>
            </div>

          </form>
          <!-- ============================================= -->

        </div>
      </div>
    </main>
  </div>

  <script>
    function previewImage(input) {
      const file = input.files[0];
      if (!file) return;
      const allowed = ['image/jpeg', 'image/jpg', 'image/png'];
      if (!allowed.includes(file.type)) {
        alert('Format tidak didukung. Gunakan JPG, JPEG, atau PNG.');
        clearFile();
        return;
      }
      if (file.size > 2 * 1024 * 1024) {
        alert('Ukuran file terlalu besar. Maksimal 2MB.');
        clearFile();
        return;
      }
      const reader = new FileReader();
      reader.onload = e => {
        document.getElementById('preview-img').src = e.target.result;
        document.getElementById('preview-filename').textContent =
          file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)';
        document.getElementById('preview-wrap').style.display = 'block';
      };
      reader.readAsDataURL(file);
    }

    function clearFile() {
      document.getElementById('file-input').value = '';
      document.getElementById('preview-wrap').style.display = 'none';
      document.getElementById('preview-img').src = '';
    }

    const zone = document.getElementById('upload-zone');
    zone.addEventListener('dragover', e => {
      e.preventDefault();
      zone.classList.add('drag-over');
    });
    zone.addEventListener('dragleave', () => zone.classList.remove('drag-over'));
    zone.addEventListener('drop', e => {
      e.preventDefault();
      zone.classList.remove('drag-over');
    });
  </script>
</body>

</html>