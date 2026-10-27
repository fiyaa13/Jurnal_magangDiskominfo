<?php
/**
 * Admin — Daftar Mahasiswa (atur pembimbing, reset password, hapus)
 * Variabel: $mahasiswa, $daftarMentor, $menu
 */
$tanpaPembimbing = count(array_filter($mahasiswa, static fn ($m) => empty($m['mentor_id'])));
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelola Mahasiswa — SIAMANG</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('css/siamang.css') ?>">
  <link rel="stylesheet" href="<?= base_url('css/admin.css') ?>">
</head>

<body>

  <?= view('partials/topbar', ['pageTitle' => 'Kelola Mahasiswa']) ?>

  <div class="shell">
    <?= view('partials/admin_sidebar', ['active' => 'mahasiswa', 'menu' => $menu]) ?>

    <main class="main">
      <div class="content">

        <div class="page-head">
          <div class="page-eyebrow">Admin</div>
          <h2 class="page-title">Mahasiswa Magang</h2>
          <p class="page-sub">Tentukan pembimbing tiap mahasiswa. Mentor hanya melihat dan memvalidasi jurnal mahasiswa bimbingannya.</p>
        </div>

        <?= view('partials/admin_flash') ?>

        <?php if (empty($daftarMentor)): ?>
          <div class="flash flash-error">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" /><line x1="12" y1="8" x2="12" y2="12" /><line x1="12" y1="16" x2="12.01" y2="16" /></svg>
            <span>Belum ada mentor aktif. Verifikasi akun mentor dulu di <a href="<?= base_url('admin/mentor') ?>"><b>halaman Mentor</b></a> sebelum mengatur pembimbing.</span>
          </div>
        <?php endif; ?>

        <div class="toolbar">
          <div class="search">
            <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" /><line x1="21" y1="21" x2="16.65" y2="16.65" /></svg>
            <input type="search" id="search" placeholder="Cari nama, NIM, email, atau universitas..." autocomplete="off" aria-label="Cari mahasiswa">
          </div>
          <div class="tabs">
            <button type="button" class="tab active" data-filter="all">Semua <span class="n"><?= count($mahasiswa) ?></span></button>
            <button type="button" class="tab" data-filter="tanpa">Belum ada pembimbing <span class="n<?= $tanpaPembimbing ? ' warn' : '' ?>"><?= $tanpaPembimbing ?></span></button>
          </div>
        </div>

        <div class="list-count" id="list-count"></div>

        <div class="table-wrap">
          <table class="tbl" data-list="mahasiswa">
            <thead>
              <tr>
                <th>Mahasiswa</th>
                <th>NIM</th>
                <th>Asal &amp; Bidang</th>
                <th>Jurnal</th>
                <th>Pembimbing</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($mahasiswa as $m): ?>
                <?php
                $punyaProfil = $m['nim'] !== null;
                $tanpa       = empty($m['mentor_id']);
                ?>
                <tr data-search="<?= esc(mb_strtolower(implode(' ', [$m['name'], $m['nim'], $m['email'], $m['asal_universitas'], $m['bidang_magang']])), 'attr') ?>"
                  data-tags="<?= $tanpa ? 'tanpa' : 'ada' ?>"<?= $tanpa ? ' class="need-action"' : '' ?>>
                  <td>
                    <div class="cell-main" data-text><?= esc($m['name']) ?></div>
                    <div class="cell-sub"><?= esc($m['email']) ?></div>
                  </td>
                  <td class="mono"><span data-text><?= esc($m['nim'] ?? '—') ?></span></td>
                  <td>
                    <div><?= esc($m['asal_universitas'] ?? '—') ?></div>
                    <div class="cell-sub"><?= esc($m['bidang_magang'] ?? '—') ?> · <?= esc($m['periode_magang'] ?? '—') ?></div>
                  </td>
                  <td>
                    <div class="mono"><?= (int) $m['total_jurnal'] ?></div>
                    <?php if ((int) $m['total_pending'] > 0): ?>
                      <span class="badge badge-amber"><?= (int) $m['total_pending'] ?> menunggu</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if (! $punyaProfil): ?>
                      <span class="badge badge-gray">Profil belum ada</span>
                    <?php else: ?>
                      <form class="assign" method="post" action="<?= base_url('admin/mahasiswa/pembimbing/' . (int) $m['id']) ?>">
                        <?= csrf_field() ?>
                        <select name="mentor_id" aria-label="Pembimbing <?= esc($m['name'], 'attr') ?>">
                          <option value="">— Belum ada —</option>
                          <?php foreach ($daftarMentor as $mt): ?>
                            <option value="<?= (int) $mt['id'] ?>" <?= (int) $m['mentor_id'] === (int) $mt['id'] ? 'selected' : '' ?>>
                              <?= esc($mt['name']) ?><?= ! empty($mt['bidang']) ? ' (' . esc($mt['bidang']) . ')' : '' ?>
                            </option>
                          <?php endforeach; ?>
                        </select>
                        <button type="submit" class="btn-sm btn-primary">Simpan</button>
                      </form>
                    <?php endif; ?>
                  </td>
                  <td>
                    <div class="actions">
                      <form method="post" action="<?= base_url('admin/akun/reset-password/' . (int) $m['id']) ?>"
                        data-confirm="Reset password <?= esc($m['name'], 'attr') ?>? Password lama tidak bisa dipakai lagi.">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn-sm" title="Reset password">
                          <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" /><path d="M7 11V7a5 5 0 0 1 10 0v4" /></svg> Reset
                        </button>
                      </form>
                      <form method="post" action="<?= base_url('admin/akun/hapus/' . (int) $m['id']) ?>"
                        data-confirm="Hapus akun <?= esc($m['name'], 'attr') ?> beserta <?= (int) $m['total_jurnal'] ?> jurnal dan foto buktinya? Tindakan ini tidak bisa dibatalkan.">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn-sm btn-danger" title="Hapus akun">
                          <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6" /><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" /></svg> Hapus
                        </button>
                      </form>
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

              <?php if (empty($mahasiswa)): ?>
                <tr>
                  <td colspan="6">
                    <div class="empty">
                      <svg viewBox="0 0 24 24"><path d="M22 10v6M2 10l10-5 10 5-10 5z" /><path d="M6 12v5c3 3 9 3 12 0v-5" /></svg>
                      <b>Belum ada mahasiswa</b>
                      Mahasiswa akan muncul di sini setelah mendaftar.
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