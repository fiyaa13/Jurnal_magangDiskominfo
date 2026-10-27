<?php
/**
 * Dashboard Mahasiswa — SIAMANG
 * Variabel dari controller: $profile (array|null), $totalJurnal (int), $hariHadir (int)
 */
helper('user');
$displayName = current_user_display()['name'];

$profile     = $profile ?? null;
$totalJurnal = $totalJurnal ?? 0;
$hariHadir   = $hariHadir ?? 0;

$profileFields = [
    'nim'              => 'NIM',
    'asal_universitas' => 'Asal Universitas',
    'bidang_magang'    => 'Bidang Magang',
    'periode_magang'   => 'Periode Magang',
    'pembimbing'       => 'Pembimbing Lapangan',
];
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Mahasiswa — SIAMANG</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('css/siamang.css') ?>">
  <style>
    /* ═══ KOMPONEN HALAMAN ═══ */
    .ico {
      width: 18px;
      height: 18px;
      flex-shrink: 0;
      fill: none;
      stroke: currentColor;
      stroke-width: 2;
    }

    .icon-box {
      width: 42px;
      height: 42px;
      flex-shrink: 0;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: var(--tint);
      color: var(--blue);
      transition: background 0.2s, color 0.2s;
    }

    .icon-box.sm { width: 32px; height: 32px; border-radius: 8px; }
    .icon-box.green { background: var(--green-l); color: var(--green); }
    .icon-box.amber { background: var(--amber-l); color: var(--amber); }

    .card {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 12px;
      box-shadow: var(--shadow);
      transition: all 0.2s ease;
    }

    .label {
      font-size: 12px;
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 0.06em;
      color: var(--muted);
    }

    /* Welcome card */
    .welcome-card {
      background: var(--grad);
      border-radius: 16px;
      padding: 28px 32px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin: 20px 0 24px;
      box-shadow: 0 4px 20px rgba(0, 51, 102, 0.18);
    }
    .welcome-card::before { width: 360px; height: 360px; top: -130px; right: -60px; }

    .wc-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 4px 12px;
      margin-bottom: 12px;
      border-radius: 99px;
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

    @keyframes blink { 50% { opacity: 0.3; } }

    .wc-title {
      font-family: var(--font-head);
      font-size: 22px;
      font-weight: 700;
      color: #fff;
      line-height: 1.2;
      margin-bottom: 6px;
      letter-spacing: -0.3px;
    }
    .wc-title em { font-style: normal; color: var(--sky); }

    .wc-sub { font-size: 14px; color: rgba(255, 255, 255, 0.55); }

    .wc-clock {
      font-family: var(--font-head);
      font-size: 48px;
      font-weight: 800;
      color: rgba(255, 255, 255, 0.1);
      line-height: 1;
      letter-spacing: -2px;
      user-select: none;
    }

    /* Section label */
    .section-label {
      font-family: var(--font-head);
      font-size: 17px;
      font-weight: 700;
      margin-bottom: 14px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    /* Info row */
    .info-row {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 14px;
      margin-bottom: 24px;
    }

    .info-card { padding: 18px 20px; display: flex; align-items: center; gap: 14px; }
    .info-card:hover { box-shadow: var(--shadow-h); }
    .info-card .label { margin-bottom: 3px; }

    .ic-val { font-family: var(--font-head); font-size: 16px; font-weight: 700; }

    /* Profile card */
    .profile-card { border-radius: 16px; padding: 24px 28px; margin-bottom: 24px; }

    .profile-card ul { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }

    .profile-card li {
      display: flex;
      flex-direction: column;
      gap: 4px;
      padding: 14px 18px;
      background: var(--tint-bg);
      border-radius: 10px;
      border: 1px solid var(--tint);
    }

    .profile-card .val { font-size: 15px; font-weight: 600; }
    .profile-card li:last-child:nth-child(odd) { grid-column: 1 / -1; }

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
    .empty-state .ico { width: 16px; height: 16px; }

    /* Nav grid */
    .nav-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; }

    .nav-card { padding: 20px 22px; display: flex; align-items: center; gap: 14px; }

    .nav-card:hover {
      border-color: var(--blue);
      transform: translateY(-1px);
      box-shadow: 0 4px 16px rgba(0, 123, 255, 0.12);
    }
    .nav-card:hover .icon-box { background: var(--blue); color: #fff; }

    .nc-title {
      font-family: var(--font-head);
      font-size: 15px;
      font-weight: 700;
      color: var(--navy);
      margin-bottom: 3px;
    }

    .nc-desc { font-size: 13px; color: var(--sub); line-height: 1.4; }

    @media (max-width: 768px) {
      .info-row, .nav-grid, .profile-card ul { grid-template-columns: 1fr; }
      .welcome-card { padding: 22px 20px; border-radius: 12px; }
      .wc-clock { font-size: 36px; }
    }
  </style>
</head>

<body>

  <!-- Ikon halaman, didefinisikan sekali dan dipakai ulang dengan <use> -->
  <svg width="0" height="0" style="position:absolute" aria-hidden="true">
    <symbol id="i-file" viewBox="0 0 24 24">
      <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
      <polyline points="14 2 14 8 20 8" />
    </symbol>
    <symbol id="i-journal" viewBox="0 0 24 24">
      <use href="#i-file" />
      <line x1="16" y1="13" x2="8" y2="13" />
      <line x1="16" y1="17" x2="8" y2="17" />
    </symbol>
    <symbol id="i-check" viewBox="0 0 24 24">
      <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
      <polyline points="22 4 12 14.01 9 11.01" />
    </symbol>
    <symbol id="i-clock" viewBox="0 0 24 24">
      <circle cx="12" cy="12" r="10" />
      <path d="M12 8v4l3 3" />
    </symbol>
    <symbol id="i-user" viewBox="0 0 24 24">
      <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
      <circle cx="12" cy="7" r="4" />
    </symbol>
    <symbol id="i-alert" viewBox="0 0 24 24">
      <circle cx="12" cy="12" r="10" />
      <line x1="12" y1="8" x2="12" y2="12" />
      <line x1="12" y1="16" x2="12.01" y2="16" />
    </symbol>
  </svg>

  <?= view('partials/topbar', ['pageTitle' => 'Dashboard Mahasiswa']) ?>

  <div class="shell">

    <?= view('partials/sidebar', [
      'active'  => 'dashboard',
      'profile' => $profile,
      'counts'  => ['journal' => $totalJurnal],
    ]) ?>

    <main class="main">
      <div class="content">

        <div class="page-eyebrow">Dashboard</div>
        <h2 class="page-title">Dashboard Mahasiswa</h2>

        <!-- Welcome card -->
        <div class="welcome-card glow">
          <div>
            <div class="wc-badge"><span class="wc-dot"></span>Magang Aktif</div>
            <div class="wc-title">Halo, <em><?= esc($displayName) ?></em></div>
            <div class="wc-sub" id="wc-date">Selamat bekerja hari ini 💪</div>
          </div>
          <div class="wc-clock" id="clock">--:--</div>
        </div>

        <!-- Info stats -->
        <div class="info-row">
          <div class="info-card card">
            <div class="icon-box"><svg class="ico"><use href="#i-file" /></svg></div>
            <div>
              <div class="label">Total Jurnal</div>
              <div class="ic-val"><?= esc($totalJurnal) ?> entri</div>
            </div>
          </div>
          <div class="info-card card">
            <div class="icon-box green"><svg class="ico"><use href="#i-check" /></svg></div>
            <div>
              <div class="label">Hari Hadir</div>
              <div class="ic-val"><?= esc($hariHadir) ?> hari</div>
            </div>
          </div>
          <div class="info-card card">
            <div class="icon-box amber"><svg class="ico"><use href="#i-clock" /></svg></div>
            <div>
              <div class="label">Periode Magang</div>
              <div class="ic-val"><?= esc($profile['periode_magang'] ?? '—') ?></div>
            </div>
          </div>
        </div>

        <!-- Data Mahasiswa -->
        <div class="section-label">
          <span class="icon-box sm"><svg class="ico"><use href="#i-user" /></svg></span>
          Data Mahasiswa
        </div>
        <div class="profile-card card">
          <?php if ($profile): ?>
            <ul>
              <?php foreach ($profileFields as $key => $label): ?>
                <li>
                  <strong class="label"><?= $label ?></strong>
                  <span class="val"><?= esc($profile[$key] ?? '—') ?></span>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php else: ?>
            <div class="empty-state">
              <svg class="ico"><use href="#i-alert" /></svg>
              Data profil mahasiswa belum lengkap.
            </div>
          <?php endif; ?>
        </div>

        <!-- Akses Cepat -->
        <div class="section-label">
          <span class="icon-box sm"><svg class="ico"><use href="#i-journal" /></svg></span>
          Akses Cepat
        </div>
        <div class="nav-grid">
          <a class="nav-card card" href="<?= base_url('journal') ?>">
            <div class="icon-box"><svg class="ico"><use href="#i-file" /></svg></div>
            <div>
              <div class="nc-title">E-Journal Harian</div>
              <div class="nc-desc">Tulis dan kelola catatan kegiatan magang harian kamu</div>
            </div>
          </a>
        </div>

      </div>
    </main>

  </div>

  <script>
    const clockEl = document.getElementById('clock');
    const dateEl = document.getElementById('wc-date');

    function tick() {
      const now = new Date();
      clockEl.textContent =
        String(now.getHours()).padStart(2, '0') + ':' +
        String(now.getMinutes()).padStart(2, '0');
      dateEl.textContent = now.toLocaleDateString('id-ID', {
        weekday: 'long', day: 'numeric', month: 'long', year: 'numeric'
      });
    }

    tick();
    setInterval(tick, 1000);
  </script>

</body>

</html>