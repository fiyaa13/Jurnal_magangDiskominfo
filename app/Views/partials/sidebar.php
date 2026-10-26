<?php
/**
 * Partial: sidebar mahasiswa (profil + menu utama + footer)
 *
 * Pemakaian:
 *   <?= view('partials/sidebar', ['active' => 'dashboard', 'profile' => $profile ?? null]) ?>
 *
 * $active  : kunci menu yang sedang aktif ('dashboard' | 'journal')
 * $profile : array data mahasiswa (nim, bidang_magang, ...) atau null
 * $counts  : (opsional) angka badge per menu, mis. ['journal' => $totalJurnal]
 */
helper('user');
$user    = current_user_display();
$profile = $profile ?? null;
$active  = $active ?? '';
$counts  = $counts ?? [];

$menu = [
    'dashboard' => [
        'label' => 'Dashboard',
        'url'   => base_url('dashboard'),
        'icon'  => '<rect x="3" y="3" width="7" height="7" rx="1" /><rect x="14" y="3" width="7" height="7" rx="1" /><rect x="3" y="14" width="7" height="7" rx="1" /><rect x="14" y="14" width="7" height="7" rx="1" />',
    ],
    'journal' => [
        'label' => 'E-Journal Harian',
        'url'   => base_url('journal'),
        'icon'  => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" /><polyline points="14 2 14 8 20 8" />',
    ],
];
?>
<aside class="sidebar glow">
  <div class="sb-profile">
    <div class="sb-av"><?= esc($user['initials']) ?></div>
    <div class="sb-name"><?= esc($user['name']) ?></div>
    <div class="sb-nim">NIM · <?= esc($profile['nim'] ?? '—') ?></div>
    <span class="sb-badge"><?= esc($profile['bidang_magang'] ?? 'Magang') ?></span>
  </div>

  <nav class="sb-menu">
    <div class="sb-section-label">Menu Utama</div>
    <?php foreach ($menu as $key => $item): ?>
      <?php $isActive = $key === $active; ?>
      <a class="sb-item<?= $isActive ? ' active' : '' ?>" href="<?= esc($item['url'], 'attr') ?>"<?= $isActive ? ' aria-current="page"' : '' ?>>
        <svg viewBox="0 0 24 24" aria-hidden="true"><?= $item['icon'] ?></svg>
        <?= esc($item['label']) ?>
        <?php if (isset($counts[$key])): ?>
          <span class="sb-count"><?= (int) $counts[$key] ?></span>
        <?php endif; ?>
      </a>
    <?php endforeach; ?>
  </nav>

  <div class="sb-foot">© <?= date('Y') ?> Sistem Jurnal Magang<br>Diskominfo Wonogiri</div>
</aside>
