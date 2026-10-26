<?php
/**
 * E-Journal Harian (daftar jurnal) — SIAMANG
 * Variabel dari controller: $profile, $journals, $totalJurnal, $totalPending, $totalApproved, $totalRejected
 */
$profile       = $profile ?? null;
$journals      = $journals ?? [];
$totalJurnal   = $totalJurnal ?? 0;
$totalPending  = $totalPending ?? 0;
$totalApproved = $totalApproved ?? 0;
$totalRejected = $totalRejected ?? 0;
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E-Journal Harian — SIAMANG</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('css/siamang.css') ?>">
  <style>
    .content svg { fill: none; stroke: currentColor; stroke-width: 2; flex-shrink: 0; }

    /* ── Judul halaman ── */
    .page-header {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      gap: 20px;
      margin-bottom: 24px;
      flex-wrap: wrap;
    }

    .btn-primary {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 11px 20px;
      border-radius: 10px;
      background: var(--blue);
      color: #fff;
      font-size: 14px;
      font-weight: 600;
      white-space: nowrap;
      box-shadow: 0 4px 14px rgba(0, 123, 255, 0.3);
      transition: transform 0.15s, background 0.2s, box-shadow 0.2s;
    }
    .btn-primary:hover {
      background: var(--navy2);
      transform: translateY(-1px);
      box-shadow: 0 6px 20px rgba(0, 123, 255, 0.4);
    }
    .btn-primary svg { width: 16px; height: 16px; stroke-width: 2.5; }

    /* ── Kartu statistik (sama dengan kartu info dashboard) ── */
    .stat-row {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 14px;
      margin-bottom: 24px;
    }

    .stat-card {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 12px;
      box-shadow: var(--shadow);
      padding: 18px 20px;
      display: flex;
      align-items: center;
      gap: 14px;
      transition: box-shadow 0.2s;
    }
    .stat-card:hover { box-shadow: var(--shadow-h); }

    .stat-ic {
      width: 42px;
      height: 42px;
      flex-shrink: 0;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: var(--tint);
      color: var(--blue);
    }
    .stat-ic svg { width: 18px; height: 18px; }
    .stat-ic.amber { background: var(--amber-l); color: var(--amber); }
    .stat-ic.green { background: var(--green-l); color: var(--green); }
    .stat-ic.red   { background: var(--red-l);   color: var(--red); }

    .stat-label {
      font-size: 12px;
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 0.06em;
      color: var(--muted);
      margin-bottom: 3px;
    }

    .stat-val { font-family: var(--font-head); font-size: 16px; font-weight: 700; }

    /* ── Tabel ── */
    .table-wrap {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 12px;
      box-shadow: var(--shadow);
      overflow: hidden;
      margin-bottom: 24px;
    }

    .table-styled { width: 100%; border-collapse: collapse; }

    .table-styled thead tr { background: var(--grad); }

    .table-styled th {
      padding: 14px 20px;
      font-size: 12px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      color: #fff;
      text-align: left;
      border-right: 1px solid rgba(255, 255, 255, 0.08);
    }

    .table-styled td {
      padding: 18px 20px;
      font-size: 14px;
      vertical-align: middle;
      border-right: 1px solid var(--border);
    }

    .table-styled th:last-child,
    .table-styled td:last-child { border-right: none; }

    .table-styled tbody tr { border-bottom: 1px solid var(--border); transition: background 0.15s; }
    .table-styled tbody tr:last-child { border-bottom: none; }
    .table-styled tbody tr:nth-child(even) { background: var(--tint-bg); }
    .table-styled tbody tr:hover { background: var(--tint); }

    .td-date { font-weight: 600; font-variant-numeric: tabular-nums; white-space: nowrap; }
    .td-desc { line-height: 1.6; }
    .td-note { font-style: italic; color: var(--sub); line-height: 1.6; }

    /* Badge status */
    .badge {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      padding: 5px 11px;
      border-radius: 99px;
      border: 1px solid;
      font-size: 12px;
      font-weight: 600;
      white-space: nowrap;
    }
    .badge svg { width: 12px; height: 12px; }
    .badge-pending  { border-color: var(--amber-b); background: var(--amber-l); color: #92400e; }
    .badge-approved { border-color: var(--green-b); background: var(--green-l); color: #166534; }
    .badge-rejected { border-color: var(--red-b);   background: var(--red-l);   color: var(--red-d); }

    /* Tombol aksi */
    .action-wrap { display: flex; align-items: center; gap: 7px; flex-wrap: wrap; }

    .btn-edit,
    .btn-delete {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      padding: 6px 12px;
      border-radius: 8px;
      border: 1px solid;
      font-size: 12px;
      font-weight: 600;
      transition: all 0.15s;
    }
    .btn-edit svg, .btn-delete svg { width: 12px; height: 12px; }

    .btn-edit { border-color: var(--tint-b); background: var(--tint); color: var(--blue); }
    .btn-edit:hover { border-color: var(--blue); background: var(--blue); color: #fff; }

    .btn-delete { border-color: var(--red-b); background: var(--red-l); color: var(--red-d); }
    .btn-delete:hover { border-color: var(--red-d); background: var(--red-d); color: #fff; }

    .locked-txt {
      display: flex;
      align-items: center;
      gap: 6px;
      font-size: 13px;
      font-weight: 500;
      color: var(--sub);
    }
    .locked-txt svg { width: 12px; height: 12px; }

    /* Tabel kosong */
    .empty-state {
      padding: 72px 20px;
      text-align: center;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .empty-ic {
      width: 72px;
      height: 72px;
      border-radius: 18px;
      background: var(--tint);
      color: var(--sky);
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 14px;
    }
    .empty-ic svg { width: 36px; height: 36px; stroke-width: 1.5; }

    .empty-title { font-family: var(--font-head); font-size: 16px; font-weight: 700; }
    .empty-sub { font-size: 13px; color: var(--sub); margin-top: 4px; }

    /* Tombol bawah */
    .bottom-actions { display: flex; flex-wrap: wrap; gap: 12px; }

    .btn-outline {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 11px 20px;
      border-radius: 10px;
      border: 1px solid var(--border);
      background: var(--white);
      box-shadow: var(--shadow);
      font-size: 14px;
      font-weight: 600;
      color: var(--sub);
      transition: all 0.2s;
    }
    .btn-outline:hover { border-color: var(--blue); background: var(--tint); color: var(--blue); }
    .btn-outline svg { width: 16px; height: 16px; }

    @media (max-width: 900px) {
      .stat-row { grid-template-columns: repeat(2, 1fr); }
    }
  </style>
</head>

<body>

  <?= view('partials/topbar', ['pageTitle' => 'E-Journal Harian']) ?>

  <div class="shell">

    <?= view('partials/sidebar', [
      'active'  => 'journal',
      'profile' => $profile,
      'counts'  => ['journal' => $totalJurnal],
    ]) ?>

    <main class="main">
      <div class="content">

        <div class="page-header">
          <div>
            <div class="page-eyebrow">E-Journal Magang</div>
            <h2 class="page-title">Jurnal Magang Saya</h2>
            <p class="page-sub">Catatan kegiatan magang harian kamu</p>
          </div>
          <a href="<?= base_url('journal/create') ?>" class="btn-primary">
            <svg viewBox="0 0 24 24">
              <line x1="12" y1="5" x2="12" y2="19" />
              <line x1="5" y1="12" x2="19" y2="12" />
            </svg>
            Tambah Jurnal
          </a>
        </div>

        <!-- Statistik -->
        <div class="stat-row">
          <div class="stat-card">
            <div class="stat-ic"><svg viewBox="0 0 24 24">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                <polyline points="14 2 14 8 20 8" />
              </svg></div>
            <div>
              <div class="stat-label">Total Jurnal</div>
              <div class="stat-val"><?= esc($totalJurnal) ?></div>
            </div>
          </div>
          <div class="stat-card">
            <div class="stat-ic amber"><svg viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" />
                <polyline points="12 6 12 12 16 14" />
              </svg></div>
            <div>
              <div class="stat-label">Pending</div>
              <div class="stat-val"><?= esc($totalPending) ?></div>
            </div>
          </div>
          <div class="stat-card">
            <div class="stat-ic green"><svg viewBox="0 0 24 24">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                <polyline points="22 4 12 14.01 9 11.01" />
              </svg></div>
            <div>
              <div class="stat-label">Disetujui</div>
              <div class="stat-val"><?= esc($totalApproved) ?></div>
            </div>
          </div>
          <div class="stat-card">
            <div class="stat-ic red"><svg viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" />
                <line x1="15" y1="9" x2="9" y2="15" />
                <line x1="9" y1="9" x2="15" y2="15" />
              </svg></div>
            <div>
              <div class="stat-label">Ditolak</div>
              <div class="stat-val"><?= esc($totalRejected) ?></div>
            </div>
          </div>
        </div>

        <!-- Tabel jurnal -->
        <div class="table-wrap">
          <table class="table-styled">
            <thead>
              <tr>
                <th style="width:130px">Tanggal</th>
                <th>Deskripsi Kegiatan</th>
                <th style="width:140px">Status</th>
                <th style="width:160px">Catatan Mentor</th>
                <th style="width:180px">Aksi</th>
              </tr>
            </thead>
            <tbody>

              <?php if (!empty($journals)): ?>
                <?php foreach ($journals as $j): ?>
                  <tr>
                    <td class="td-date"><?= esc($j['tanggal']) ?></td>
                    <td class="td-desc"><?= esc($j['deskripsi']) ?></td>

                    <td>
                      <?php if ($j['status'] === 'approved'): ?>
                        <span class="badge badge-approved">
                          <svg viewBox="0 0 24 24">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                            <polyline points="22 4 12 14.01 9 11.01" />
                          </svg>
                          Disetujui
                        </span>
                      <?php elseif ($j['status'] === 'rejected'): ?>
                        <span class="badge badge-rejected">
                          <svg viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="15" y1="9" x2="9" y2="15" />
                            <line x1="9" y1="9" x2="15" y2="15" />
                          </svg>
                          Ditolak
                        </span>
                      <?php else: ?>
                        <span class="badge badge-pending">
                          <svg viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" />
                            <polyline points="12 6 12 12 16 14" />
                          </svg>
                          Menunggu
                        </span>
                      <?php endif ?>
                    </td>

                    <td class="td-note">
                      <?= !empty($j['mentor_note']) ? esc($j['mentor_note']) : '—' ?>
                    </td>

                    <td>
                      <?php if ($j['status'] === 'pending'): ?>
                        <div class="action-wrap">
                          <a href="<?= base_url('journal/edit/' . $j['id']) ?>" class="btn-edit">
                            <svg viewBox="0 0 24 24">
                              <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                              <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                            </svg>
                            Edit
                          </a>
                          <a href="<?= base_url('journal/delete/' . $j['id']) ?>"
                            class="btn-delete"
                            onclick="return confirm('Yakin hapus jurnal ini?')">
                            <svg viewBox="0 0 24 24">
                              <polyline points="3 6 5 6 21 6" />
                              <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                              <path d="M10 11v6" />
                              <path d="M14 11v6" />
                            </svg>
                            Hapus
                          </a>
                        </div>
                      <?php else: ?>
                        <div class="locked-txt">
                          <svg viewBox="0 0 24 24">
                            <rect x="3" y="11" width="18" height="11" rx="2" />
                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                          </svg>
                          <?= $j['status'] === 'approved' ? 'Sudah disetujui' : 'Sudah ditolak' ?>
                        </div>
                      <?php endif ?>
                    </td>
                  </tr>
                <?php endforeach ?>
              <?php else: ?>
                <tr>
                  <td colspan="5" style="padding:0; border:none;">
                    <div class="empty-state">
                      <div class="empty-ic">
                        <svg viewBox="0 0 24 24">
                          <path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2" />
                          <rect x="9" y="3" width="6" height="4" rx="2" />
                          <line x1="9" y1="12" x2="15" y2="12" />
                          <line x1="9" y1="16" x2="12" y2="16" />
                        </svg>
                      </div>
                      <p class="empty-title">Belum ada jurnal</p>
                      <p class="empty-sub">Klik "Tambah Jurnal" untuk menulis kegiatan hari ini</p>
                    </div>
                  </td>
                </tr>
              <?php endif ?>

            </tbody>
          </table>
        </div>

        <div class="bottom-actions">
          <a href="<?= base_url('journal/download/pdf') ?>" class="btn-outline">
            <svg viewBox="0 0 24 24">
              <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
              <polyline points="7 10 12 15 17 10" />
              <line x1="12" y1="15" x2="12" y2="3" />
            </svg>
            Download Jurnal (PDF)
          </a>
          <a href="<?= base_url('dashboard') ?>" class="btn-outline">
            <svg viewBox="0 0 24 24">
              <line x1="19" y1="12" x2="5" y2="12" />
              <polyline points="12 19 5 12 12 5" />
            </svg>
            Kembali ke Dashboard
          </a>
        </div>

      </div>
    </main>
  </div>

</body>

</html>