<?php
/**
 * Partial: topbar (brand, judul halaman, user, logout)
 *
 * Pemakaian:
 *   <?= view('partials/topbar', ['pageTitle' => 'Dashboard Mahasiswa']) ?>
 */
helper('user');
$user      = current_user_display();
$pageTitle = $pageTitle ?? '';
?>
<header class="topbar">
  <div class="tb-l">
    <div class="tb-logo">
      <svg viewBox="0 0 24 24" aria-hidden="true">
        <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20" />
      </svg>
    </div>
    <div class="tb-brand">
      <b>Sistem Jurnal Magang</b>
      <span>Diskominfo Wonogiri</span>
    </div>
    <?php if ($pageTitle !== ''): ?>
      <div class="tb-sep"></div>
      <span class="tb-page"><?= esc($pageTitle) ?></span>
    <?php endif; ?>
  </div>
  <div class="tb-r">
    <div class="tb-chip">
      <div class="tb-av"><?= esc($user['initials']) ?></div>
      <span class="tb-uname"><?= esc($user['name']) ?></span>
    </div>
    <a href="<?= esc(base_url('logout'), 'attr') ?>" class="btn-out">
      <svg viewBox="0 0 24 24" aria-hidden="true">
        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
        <polyline points="16 17 21 12 16 7" />
        <line x1="21" y1="12" x2="9" y2="12" />
      </svg>
      Logout
    </a>
  </div>
</header>