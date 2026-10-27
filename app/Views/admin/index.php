<?php
/**
 * Admin — Ringkasan
 * Variabel: $stats, $mentorMenunggu, $menu
 */
$s      = $stats;
$jurnal = $s['jurnal'];
$total  = max(1, $s['jurnal_total']);
$persen = static fn (int $n) => round($n / $total * 100, 1);
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin — SIAMANG</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('css/siamang.css') ?>">
  <link rel="stylesheet" href="<?= base_url('css/admin.css') ?>">
</head>

<body>

  <?= view('partials/topbar', ['pageTitle' => 'Admin']) ?>

  <div class="shell">
    <?= view('partials/admin_sidebar', ['active' => 'ringkasan', 'menu' => $menu]) ?>

    <main class="main">
      <div class="content">

        <div class="page-head">
          <div class="page-eyebrow">Admin</div>
          <h2 class="page-title">Ringkasan Sistem</h2>
          <p class="page-sub">Pantau akun, pembimbing, dan jurnal seluruh peserta magang.</p>
        </div>

        <?= view('partials/admin_flash') ?>

        <!-- Statistik akun -->
        <div class="stat-row">
          <a class="stat-card" href="<?= base_url('admin/mahasiswa') ?>">
            <div class="stat-ic"><svg viewBox="0 0 24 24"><path d="M22 10v6M2 10l10-5 10 5-10 5z" /><path d="M6 12v5c3 3 9 3 12 0v-5" /></svg></div>
            <div>
              <div class="stat-label">Mahasiswa</div>
              <div class="stat-val"><?= $s['mahasiswa'] ?></div>
            </div>
          </a>
          <a class="stat-card" href="<?= base_url('admin/mentor') ?>">
            <div class="stat-ic green"><svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" /><circle cx="9" cy="7" r="4" /><path d="M23 21v-2a4 4 0 0 0-3-3.87" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /></svg></div>
            <div>
              <div class="stat-label">Mentor Aktif</div>
              <div class="stat-val"><?= $s['mentor_aktif'] ?></div>
            </div>
          </a>
          <a class="stat-card<?= $s['mentor_menunggu'] > 0 ? ' warn' : '' ?>" href="<?= base_url('admin/mentor') ?>">
            <div class="stat-ic amber"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" /><polyline points="12 6 12 12 16 14" /></svg></div>
            <div>
              <div class="stat-label">Mentor Menunggu Verifikasi</div>
              <div class="stat-val"><?= $s['mentor_menunggu'] ?></div>
            </div>
          </a>
          <a class="stat-card<?= $s['tanpa_pembimbing'] > 0 ? ' warn' : '' ?>" href="<?= base_url('admin/mahasiswa') ?>">
            <div class="stat-ic red"><svg viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" /><circle cx="8.5" cy="7" r="4" /><line x1="18" y1="8" x2="23" y2="13" /><line x1="23" y1="8" x2="18" y2="13" /></svg></div>
            <div>
              <div class="stat-label">Belum Ada Pembimbing</div>
              <div class="stat-val"><?= $s['tanpa_pembimbing'] ?></div>
            </div>
          </a>
        </div>

        <div class="grid-2">

          <!-- Mentor menunggu verifikasi -->
          <div class="card card-pad">
            <div class="section-label">
              <span class="icon-box"><svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" /></svg></span>
              Mentor Menunggu Verifikasi
            </div>

            <?php if (empty($mentorMenunggu)): ?>
              <div class="empty">
                <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" /><polyline points="22 4 12 14.01 9 11.01" /></svg>
                <b>Tidak ada pendaftaran baru</b>
                Semua akun mentor sudah diverifikasi.
              </div>
            <?php else: ?>
              <div class="pending-list">
                <?php foreach (array_slice($mentorMenunggu, 0, 5) as $m): ?>
                  <div class="pending-item">
                    <div class="info">
                      <div class="cell-main"><?= esc($m['name']) ?></div>
                      <div class="cell-sub">
                        NIP <?= esc($m['nip'] ?? '—') ?> · <?= esc($m['jabatan'] ?? '—') ?> · <?= esc($m['bidang'] ?? '—') ?><br>
                        <?= esc($m['email']) ?>
                      </div>
                    </div>
                    <div class="actions">
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
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
              <?php if (count($mentorMenunggu) > 5): ?>
                <a class="link-more" href="<?= base_url('admin/mentor') ?>">
                  Lihat <?= count($mentorMenunggu) - 5 ?> lainnya
                  <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12" /><polyline points="12 5 19 12 12 19" /></svg>
                </a>
              <?php endif; ?>
            <?php endif; ?>
          </div>

          <!-- Rekap jurnal -->
          <div class="card card-pad">
            <div class="section-label">
              <span class="icon-box"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" /><polyline points="14 2 14 8 20 8" /></svg></span>
              Jurnal Seluruh Peserta
            </div>
            <div class="stat-val"><?= $s['jurnal_total'] ?> <span class="cell-sub" style="display:inline">jurnal diajukan</span></div>
            <div class="jurnal-bar" role="img" aria-label="Komposisi status jurnal">
              <span class="jb-approved" style="width:<?= $persen($jurnal['approved']) ?>%"></span>
              <span class="jb-pending" style="width:<?= $persen($jurnal['pending']) ?>%"></span>
              <span class="jb-rejected" style="width:<?= $persen($jurnal['rejected']) ?>%"></span>
            </div>
            <div class="jurnal-legend">
              <span><i class="jb-approved"></i>Disetujui <b><?= $jurnal['approved'] ?></b></span>
              <span><i class="jb-pending"></i>Menunggu <b><?= $jurnal['pending'] ?></b></span>
              <span><i class="jb-rejected"></i>Ditolak <b><?= $jurnal['rejected'] ?></b></span>
            </div>

            <?php if ($s['tanpa_pembimbing'] > 0): ?>
              <div class="flash flash-error" style="margin:18px 0 0">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" /><line x1="12" y1="8" x2="12" y2="12" /><line x1="12" y1="16" x2="12.01" y2="16" /></svg>
                <span>
                  <?= $s['tanpa_pembimbing'] ?> mahasiswa belum punya pembimbing, jadi jurnalnya belum bisa divalidasi mentor.
                  <a href="<?= base_url('admin/mahasiswa') ?>"><b>Atur pembimbing</b></a>
                </span>
              </div>
            <?php endif; ?>
          </div>

        </div>

      </div>
    </main>
  </div>

  <script src="<?= base_url('js/admin.js') ?>"></script>
</body>

</html>