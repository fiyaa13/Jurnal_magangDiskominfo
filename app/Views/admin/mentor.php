<?php
/**
 * Admin — Daftar Mentor (verifikasi, reset password, hapus/tolak)
 * Variabel: $mentor, $menu
 */
$menunggu = count(array_filter($mentor, static fn ($m) => (int) $m['is_verified'] === 0));
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelola Mentor — SIAMANG</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('css/siamang.css') ?>">
  <link rel="stylesheet" href="<?= base_url('css/admin.css') ?>">
</head>

<body>

  <?= view('partials/topbar', ['pageTitle' => 'Kelola Mentor']) ?>

  <div class="shell">
    <?= view('partials/admin_sidebar', ['active' => 'mentor', 'menu' => $menu]) ?>

    <main class="main">
      <div class="content">

        <div class="page-head">
          <div class="page-eyebrow">Admin</div>
          <h2 class="page-title">Mentor / Pembimbing Lapangan</h2>
          <p class="page-sub">Mentor yang baru mendaftar baru bisa login setelah kamu setujui.</p>
        </div>

        <?= view('partials/admin_flash') ?>

        <div class="toolbar">
          <div class="search">
            <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" /><line x1="21" y1="21" x2="16.65" y2="16.65" /></svg>
            <input type="search" id="search" placeholder="Cari nama, NIP, email, atau bidang..." autocomplete="off" aria-label="Cari mentor">
          </div>
          <div class="tabs">
            <button type="button" class="tab<?= $menunggu ? '' : ' active' ?>" data-filter="all">Semua <span class="n"><?= count($mentor) ?></span></button>
            <button type="button" class="tab<?= $menunggu ? ' active' : '' ?>" data-filter="menunggu">Menunggu verifikasi <span class="n<?= $menunggu ? ' warn' : '' ?>"><?= $menunggu ?></span></button>
          </div>
        </div>

        <div class="list-count" id="list-count"></div>

        <div class="table-wrap">
          <table class="tbl" data-list="mentor">
            <thead>
              <tr>
                <th>Mentor</th>
                <th>NIP</th>
                <th>Jabatan &amp; Bidang</th>
                <th>Bimbingan</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($mentor as $m): ?>
                <?php $aktif = (int) $m['is_verified'] === 1; ?>
                <tr data-search="<?= esc(mb_strtolower(implode(' ', [$m['name'], $m['nip'], $m['email'], $m['jabatan'], $m['bidang']])), 'attr') ?>"
                  data-tags="<?= $aktif ? 'aktif' : 'menunggu' ?>"<?= $aktif ? '' : ' class="need-action"' ?>>
                  <td>
                    <div class="cell-main" data-text><?= esc($m['name']) ?></div>
                    <div class="cell-sub"><?= esc($m['email']) ?></div>
                  </td>
                  <td class="mono"><span data-text><?= esc($m['nip'] ?? '—') ?></span></td>
                  <td>
                    <div><?= esc($m['jabatan'] ?? '—') ?></div>
                    <div class="cell-sub"><?= esc($m['bidang'] ?? '—') ?></div>
                  </td>
                  <td class="mono"><?= (int) $m['jumlah_bimbingan'] ?> mahasiswa</td>
                  <td>
                    <?php if ($aktif): ?>
                      <span class="badge badge-green">Aktif</span>
                    <?php else: ?>
                      <span class="badge badge-amber">Menunggu verifikasi</span>
                      <div class="cell-sub">Daftar <?= esc(date('d/m/Y', strtotime((string) $m['created_at']))) ?></div>
                    <?php endif; ?>
                  </td>
                  <td>
                    <div class="actions">
                      <?php if (! $aktif): ?>
                        <form method="post" action="<?= base_url('admin/mentor/verifikasi/' . (int) $m['id']) ?>">
                          <?= csrf_field() ?>
                          <button type="submit" class="btn-sm btn-success">
                            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12" /></svg> Setujui
                          </button>
                        </form>
                        <form method="post" action="<?= base_url('admin/akun/hapus/' . (int) $m['id']) ?>"
                          data-confirm="Tolak dan hapus pendaftaran mentor <?= esc($m['name'], 'attr') ?>?">
                          <?= csrf_field() ?>
                          <button type="submit" class="btn-sm btn-danger">
                            <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" /></svg> Tolak
                          </button>
                        </form>
                      <?php else: ?>
                        <form method="post" action="<?= base_url('admin/akun/reset-password/' . (int) $m['id']) ?>"
                          data-confirm="Reset password <?= esc($m['name'], 'attr') ?>? Password lama tidak bisa dipakai lagi.">
                          <?= csrf_field() ?>
                          <button type="submit" class="btn-sm" title="Reset password">
                            <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" /><path d="M7 11V7a5 5 0 0 1 10 0v4" /></svg> Reset
                          </button>
                        </form>
                        <form method="post" action="<?= base_url('admin/akun/hapus/' . (int) $m['id']) ?>"
                          data-confirm="Hapus akun mentor <?= esc($m['name'], 'attr') ?>?<?= (int) $m['jumlah_bimbingan'] > 0 ? ' ' . (int) $m['jumlah_bimbingan'] . ' mahasiswa bimbingannya akan menjadi tanpa pembimbing.' : '' ?>">
                          <?= csrf_field() ?>
                          <button type="submit" class="btn-sm btn-danger" title="Hapus akun">
                            <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6" /><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" /></svg> Hapus
                          </button>
                        </form>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>

              <tr id="no-result" hidden>
                <td colspan="6">
                  <div class="empty">
                    <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" /><line x1="21" y1="21" x2="16.65" y2="16.65" /></svg>
                    <b>Tidak ada yang cocok</b>
                    Coba kata kunci atau tab lain.
                  </div>
                </td>
              </tr>

              <?php if (empty($mentor)): ?>
                <tr>
                  <td colspan="6">
                    <div class="empty">
                      <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" /><circle cx="9" cy="7" r="4" /></svg>
                      <b>Belum ada mentor</b>
                      Mentor akan muncul di sini setelah mendaftar.
                    </div>
                  </td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>

      </div>
    </main>
  </div>

  <script src="<?= base_url('js/admin.js') ?>"></script>
</body>

</html>