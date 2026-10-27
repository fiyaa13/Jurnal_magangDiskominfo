<?php
/**
 * Partial: sidebar admin
 *
 * Pemakaian:
 *   <?= view('partials/admin_sidebar', ['active' => 'mahasiswa', 'menu' => $menu]) ?>
 *
 * $menu: ['mentor' => jumlah mentor menunggu, 'mahasiswa' => jumlah tanpa pembimbing]
 */
helper('user');
$user   = current_user_display();
$active = $active ?? '';
$menu   = $menu ?? [];

$items = [
    'ringkasan' => [
        'label' => 'Ringkasan',
        'url'   => base_url('admin'),
        'icon'  => '<rect x="3" y="3" width="7" height="7" rx="1" /><rect x="14" y="3" width="7" height="7" rx="1" /><rect x="3" y="14" width="7" height="7" rx="1" /><rect x="14" y="14" width="7" height="7" rx="1" />',
    ],
    'mahasiswa' => [
        'label' => 'Mahasiswa',
        'url'   => base_url('admin/mahasiswa'),
        'icon'  => '<path d="M22 10v6M2 10l10-5 10 5-10 5z" /><path d="M6 12v5c3 3 9 3 12 0v-5" />',
    ],
    'mentor' => [
        'label' => 'Mentor',
        'url'   => base_url('admin/mentor'),
        'icon'  => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" /><circle cx="9" cy="7" r="4" /><path d="M23 21v-2a4 4 0 0 0-3-3.87" /><path d="M16 3.13a4 4 0 0 1 0 7.75" />',
    ],
];
?>
<aside class="sidebar glow">
  <div class="sb-profile">
    <div class="sb-av"><?= esc($user['initials']) ?></div>
    <div class="sb-name"><?= esc($user['name']) ?></div>
    <div class="sb-nim">Pengelola sistem</div>
    <span class="sb-badge">Administrator</span>
  </div>

  <nav class="sb-menu">
    <div class="sb-section-label">Menu Admin</div>
    <?php foreach ($items as $key => $item): ?>
      <?php $isActive = $key === $active; ?>
      <a class="sb-item<?= $isActive ? ' active' : '' ?>" href="<?= esc($item['url'], 'attr') ?>"<?= $isActive ? ' aria-current="page"' : '' ?>>
        <svg viewBox="0 0 24 24" aria-hidden="true"><?= $item['icon'] ?></svg>
        <?= esc($item['label']) ?>
        <?php if (! empty($menu[$key])): ?>
          <span class="sb-count sb-count-warn" title="Perlu tindakan"><?= (int) $menu[$key] ?></span>
        <?php endif; ?>
      </a>
    <?php endforeach; ?>
  </nav>

  <div class="sb-foot">© <?= date('Y') ?> Sistem Jurnal Magang<br>Diskominfo Wonogiri</div>
</aside>