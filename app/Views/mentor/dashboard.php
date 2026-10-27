<?php
/**
 * Dashboard Mentor — SIAMANG
 * Variabel dari controller: $mentorProfile, $mahasiswa, $stats
 */
helper('user');
$displayName   = current_user_display()['name'];
$mentorProfile = $mentorProfile ?? null;
$mahasiswa     = $mahasiswa ?? [];
$stats         = ($stats ?? []) + ['pending' => 0, 'total' => 0, 'approved' => 0, 'rejected' => 0, 'mhs_pending' => 0];

$namaBulan = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
$tglPendek = static function (?string $tgl) use ($namaBulan): string {
    $ts = $tgl ? strtotime($tgl) : false;
    return $ts ? date('j', $ts) . ' ' . $namaBulan[(int) date('n', $ts)] . ' ' . date('Y', $ts) : '';
};
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Mentor — SIAMANG</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('css/siamang.css') ?>">
  <style>
    .content svg { fill: none; stroke: currentColor; stroke-width: 2; flex-shrink: 0; }

    .card {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 16px;
      box-shadow: var(--shadow);
    }

    .section-label {
      font-family: var(--font-head);
      font-size: 17px;
      font-weight: 700;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .icon-box {
      width: 32px;
      height: 32px;
      flex-shrink: 0;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: var(--tint);
      color: var(--blue);
    }
    .icon-box svg { width: 18px; height: 18px; }

    /* ── Pemberitahuan jurnal menunggu ── */
    .alert-pending {
      display: flex;
      align-items: center;
      gap: 16px;
      margin-bottom: 24px;
      padding: 18px 22px;
      border-radius: 14px;
      background: var(--amber-l);
      border: 1px solid var(--amber-b);
    }

    .alert-pending .al-ic {
      width: 44px;
      height: 44px;
      flex-shrink: 0;
      border-radius: 12px;
      background: var(--amber);
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .alert-pending .al-ic svg { width: 22px; height: 22px; }

    .al-text { flex: 1; font-size: 14px; color: #92400e; line-height: 1.5; }
    .al-text b { font-family: var(--font-head); font-size: 15px; color: #78350f; display: block; }

    .btn-amber {
      padding: 10px 16px;
      border: none;
      border-radius: 10px;
      background: #b45309;
      color: #fff;
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
      white-space: nowrap;
      transition: background 0.2s;
    }
    .btn-amber:hover { background: #92400e; }

    .alert-clear {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 24px;
      padding: 14px 18px;
      border-radius: 12px;
      background: var(--green-l);
      border: 1px solid var(--green-b);
      color: #166534;
      font-size: 14px;
      font-weight: 500;
    }
    .alert-clear svg { width: 18px; height: 18px; color: var(--green); }

    /* ── Statistik ── */
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
    }
    .stat-card.highlight { border-color: var(--amber-b); background: linear-gradient(135deg, #fff 60%, var(--amber-l)); }

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
    .stat-val small { font-family: var(--font-body); font-size: 12px; font-weight: 500; color: var(--sub); }

    /* ── Daftar mahasiswa ── */
    .mhs-card { padding: 24px 28px; margin-bottom: 24px; }

    .mhs-head {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      margin-bottom: 18px;
      flex-wrap: wrap;
    }
    .mhs-head .count { font-size: 13px; color: var(--sub); }

    .toolbar { display: flex; gap: 12px; margin-bottom: 16px; flex-wrap: wrap; }

    .search {
      position: relative;
      flex: 1;
      min-width: 240px;
    }
    .search > svg {
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      width: 16px;
      height: 16px;
      color: var(--muted);
      pointer-events: none;
    }
    .search input {
      width: 100%;
      padding: 11px 40px 11px 40px;
      border: 1.5px solid var(--border);
      border-radius: 10px;
      background: var(--tint-bg);
      font-size: 14px;
      color: var(--navy);
      outline: none;
      transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
    }
    .search input::placeholder { color: var(--muted); }
    .search input:focus { border-color: var(--blue); background: #fff; box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1); }
    .search input::-webkit-search-cancel-button { display: none; }

    .search-clear {
      position: absolute;
      right: 8px;
      top: 50%;
      transform: translateY(-50%);
      width: 26px;
      height: 26px;
      border: none;
      border-radius: 6px;
      background: transparent;
      color: var(--muted);
      cursor: pointer;
      display: none;
      align-items: center;
      justify-content: center;
    }
    .search-clear:hover { background: var(--tint); color: var(--blue); }
    .search-clear svg { width: 14px; height: 14px; }
    .search.has-value .search-clear { display: flex; }

    .tabs {
      display: inline-flex;
      padding: 4px;
      border-radius: 10px;
      background: var(--tint-bg);
      border: 1px solid var(--border);
    }
    .tab {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 7px 14px;
      border: none;
      border-radius: 7px;
      background: transparent;
      color: var(--sub);
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.15s;
    }
    .tab.active { background: #fff; color: var(--navy); box-shadow: var(--shadow); }
    .tab .n {
      min-width: 20px;
      padding: 1px 6px;
      border-radius: 99px;
      background: var(--amber);
      color: #fff;
      font-size: 11px;
      text-align: center;
    }

    .mhs-list { display: flex; flex-direction: column; gap: 10px; }

    .mhs-item {
      display: flex;
      align-items: center;
      gap: 14px;
      padding: 14px 18px;
      border-radius: 12px;
      background: var(--tint-bg);
      border: 1px solid var(--tint);
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    .mhs-item:hover { border-color: var(--blue); box-shadow: 0 2px 12px rgba(0, 123, 255, 0.08); }
    .mhs-item.has-pending { border-left: 3px solid var(--amber); }
    .mhs-item[hidden] { display: none; }

    .mhs-av {
      width: 44px;
      height: 44px;
      flex-shrink: 0;
      border-radius: 12px;
      background: linear-gradient(135deg, var(--blue), var(--navy2));
      color: #fff;
      font-family: var(--font-head);
      font-size: 15px;
      font-weight: 700;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .mhs-info { flex: 1; min-width: 0; }
    .mhs-name { font-size: 15px; font-weight: 600; }
    .mhs-nim { font-size: 13px; color: var(--sub); margin-top: 1px; }

    .mhs-meta {
      display: flex;
      align-items: center;
      gap: 8px;
      flex-wrap: wrap;
      margin-top: 6px;
      font-size: 12px;
      color: var(--sub);
    }

    .chip {
      display: inline-flex;
      align-items: center;
      gap: 4px;
      padding: 2px 9px;
      border-radius: 99px;
      border: 1px solid;
      font-size: 12px;
      font-weight: 600;
    }
    .chip-amber { background: var(--amber-l); border-color: var(--amber-b); color: #92400e; }
    .chip-green { background: var(--green-l); border-color: var(--green-b); color: #166534; }

    .btn-lihat {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 9px 16px;
      border-radius: 9px;
      background: var(--blue);
      color: #fff;
      font-size: 13px;
      font-weight: 600;
      white-space: nowrap;
      transition: all 0.2s;
    }
    .btn-lihat:hover { background: var(--navy2); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(0, 123, 255, 0.25); }
    .btn-lihat svg { width: 15px; height: 15px; }
    .btn-lihat.review { background: #b45309; }
    .btn-lihat.review:hover { background: #92400e; box-shadow: 0 4px 12px rgba(180, 83, 9, 0.25); }

    mark { background: #fde68a; color: inherit; border-radius: 3px; padding: 0 1px; }

    .empty {
      text-align: center;
      padding: 40px 20px;
      color: var(--muted);
      font-size: 14px;
    }
    .empty svg { width: 44px; height: 44px; stroke-width: 1.5; color: #c0d4e8; margin-bottom: 10px; }
    .empty b { display: block; color: var(--navy); font-size: 15px; margin-bottom: 4px; }

    /* ── Biodata mentor ── */
    .bio-card { padding: 24px 28px; margin: 20px 0 24px; }
    .bio-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 12px;
      margin-top: 16px;
    }
    .bio-item {
      padding: 12px 16px;
      border-radius: 10px;
      background: var(--tint-bg);
      border: 1px solid var(--tint);
    }
    .bio-label {
      font-size: 12px;
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 0.06em;
      color: var(--muted);
      margin-bottom: 3px;
    }
    .bio-val { font-size: 14px; font-weight: 600; }

    @media (max-width: 900px) {
      .stat-row, .bio-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 600px) {
      .alert-pending { flex-direction: column; align-items: flex-start; }
      .mhs-card, .bio-card { padding: 20px 16px; }
      .mhs-item { flex-wrap: wrap; }
      .btn-lihat { width: 100%; justify-content: center; }
      .tabs { width: 100%; }
      .tab { flex: 1; justify-content: center; }
    }
  </style>
</head>

<body>

  <?= view('partials/topbar', ['pageTitle' => 'Dashboard Mentor']) ?>

  <div class="shell">
    <main class="main">
      <div class="content">

        <div class="page-eyebrow">Dashboard Mentor</div>
        <h2 class="page-title">Halo, <?= esc($displayName) ?></h2>
        <p class="page-sub">Pantau dan setujui jurnal kegiatan mahasiswa magang.</p>

        <!-- Biodata mentor -->
        <div class="card bio-card">
          <div class="section-label">
            <span class="icon-box"><svg viewBox="0 0 24 24">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                <circle cx="12" cy="7" r="4" />
              </svg></span>
            Biodata Mentor
          </div>
          <div class="bio-grid">
            <div class="bio-item">
              <div class="bio-label">Nama Lengkap</div>
              <div class="bio-val"><?= esc($displayName) ?></div>
            </div>
            <div class="bio-item">
              <div class="bio-label">NIP</div>
              <div class="bio-val"><?= esc($mentorProfile['nip'] ?? '-') ?></div>
            </div>
            <div class="bio-item">
              <div class="bio-label">Jabatan</div>
              <div class="bio-val"><?= esc($mentorProfile['jabatan'] ?? '-') ?></div>
            </div>
            <div class="bio-item">
              <div class="bio-label">Bidang</div>
              <div class="bio-val"><?= esc($mentorProfile['bidang'] ?? '-') ?></div>
            </div>
          </div>
        </div>

        <!-- Pemberitahuan jurnal yang menunggu -->
        <?php if ($stats['pending'] > 0): ?>
          <div class="alert-pending">
            <div class="al-ic">
              <svg viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" />
                <polyline points="12 6 12 12 16 14" />
              </svg>
            </div>
            <div class="al-text">
              <b><?= $stats['pending'] ?> jurnal butuh persetujuan kamu</b>
              Diajukan oleh <?= $stats['mhs_pending'] ?> mahasiswa dan masih berstatus menunggu.
            </div>
            <button type="button" class="btn-amber" data-show-pending>Tampilkan mahasiswanya</button>
          </div>
        <?php else: ?>
          <div class="alert-clear">
            <svg viewBox="0 0 24 24">
              <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
              <polyline points="22 4 12 14.01 9 11.01" />
            </svg>
            Semua jurnal sudah ditinjau. Tidak ada yang menunggu persetujuan.
          </div>
        <?php endif; ?>

        <!-- Statistik -->
        <div class="stat-row">
          <div class="stat-card<?= $stats['pending'] > 0 ? ' highlight' : '' ?>">
            <div class="stat-ic amber"><svg viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" />
                <polyline points="12 6 12 12 16 14" />
              </svg></div>
            <div>
              <div class="stat-label">Menunggu Persetujuan</div>
              <div class="stat-val"><?= $stats['pending'] ?> <small>jurnal</small></div>
            </div>
          </div>
          <div class="stat-card">
            <div class="stat-ic"><svg viewBox="0 0 24 24">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                <polyline points="14 2 14 8 20 8" />
              </svg></div>
            <div>
              <div class="stat-label">Total Diajukan</div>
              <div class="stat-val"><?= $stats['total'] ?> <small>jurnal</small></div>
            </div>
          </div>
          <div class="stat-card">
            <div class="stat-ic green"><svg viewBox="0 0 24 24">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                <polyline points="22 4 12 14.01 9 11.01" />
              </svg></div>
            <div>
              <div class="stat-label">Disetujui</div>
              <div class="stat-val"><?= $stats['approved'] ?> <small>jurnal</small></div>
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
              <div class="stat-val"><?= $stats['rejected'] ?> <small>jurnal</small></div>
            </div>
          </div>
        </div>

        <!-- Daftar mahasiswa -->
        <div class="card mhs-card" id="daftar-mahasiswa">
          <div class="mhs-head">
            <div class="section-label">
              <span class="icon-box"><svg viewBox="0 0 24 24">
                  <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                  <circle cx="9" cy="7" r="4" />
                  <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                  <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                </svg></span>
              Mahasiswa Bimbingan
            </div>
            <span class="count" id="mhs-count"><?= count($mahasiswa) ?> mahasiswa</span>
          </div>

          <?php if (empty($mahasiswa)): ?>
            <div class="empty">
              <svg viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <line x1="19" y1="8" x2="19" y2="14" />
                <line x1="22" y1="11" x2="16" y2="11" />
              </svg>
              <b>Belum ada mahasiswa bimbingan</b>
              Admin akan menentukan mahasiswa yang kamu bimbing. Setelah itu mereka muncul di sini.
            </div>
          <?php else: ?>

            <div class="toolbar">
              <div class="search" id="search-wrap">
                <svg viewBox="0 0 24 24">
                  <circle cx="11" cy="11" r="8" />
                  <line x1="21" y1="21" x2="16.65" y2="16.65" />
                </svg>
                <input type="search" id="search" placeholder="Cari nama atau NIM mahasiswa..." autocomplete="off" aria-label="Cari nama atau NIM mahasiswa">
                <button type="button" class="search-clear" id="search-clear" aria-label="Hapus pencarian">
                  <svg viewBox="0 0 24 24">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                  </svg>
                </button>
              </div>
              <div class="tabs" role="tablist">
                <button type="button" class="tab active" data-filter="all">Semua</button>
                <button type="button" class="tab" data-filter="pending">
                  Perlu persetujuan <span class="n"><?= $stats['mhs_pending'] ?></span>
                </button>
              </div>
            </div>

            <ul class="mhs-list" id="mhs-list">
              <?php foreach ($mahasiswa as $mhs): ?>
                <?php
                $pending  = (int) ($mhs['total_pending'] ?? 0);
                $nama     = $mhs['name'] ?? '-';
                $nim      = $mhs['nim'] ?? '';
                ?>
                <li class="mhs-item<?= $pending > 0 ? ' has-pending' : '' ?>"
                  data-search="<?= esc(mb_strtolower($nama . ' ' . $nim), 'attr') ?>"
                  data-pending="<?= $pending ?>">
                  <div class="mhs-av"><?= esc(name_initials($nama)) ?></div>
                  <div class="mhs-info">
                    <div class="mhs-name" data-text><?= esc($nama) ?></div>
                    <div class="mhs-nim">NIM <span data-text><?= esc($nim !== '' ? $nim : '—') ?></span></div>
                    <div class="mhs-meta">
                      <span><?= (int) ($mhs['total_jurnal'] ?? 0) ?> jurnal</span>
                      <?php if ($pending > 0): ?>
                        <span class="chip chip-amber"><?= $pending ?> menunggu</span>
                        <?php if (! empty($mhs['pending_terakhir'])): ?>
                          <span>terbaru <?= $tglPendek($mhs['pending_terakhir']) ?></span>
                        <?php endif; ?>
                      <?php elseif ((int) ($mhs['total_jurnal'] ?? 0) > 0): ?>
                        <span class="chip chip-green">Semua sudah ditinjau</span>
                      <?php endif; ?>
                    </div>
                  </div>
                  <a href="<?= base_url('mentor/journal?user_id=' . (int) $mhs['id']) ?>" class="btn-lihat<?= $pending > 0 ? ' review' : '' ?>">
                    <svg viewBox="0 0 24 24">
                      <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                      <circle cx="12" cy="12" r="3" />
                    </svg>
                    <?= $pending > 0 ? 'Tinjau Jurnal' : 'Lihat Jurnal' ?>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>

            <div class="empty" id="no-result" hidden>
              <svg viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="8" />
                <line x1="21" y1="21" x2="16.65" y2="16.65" />
              </svg>
              <b>Tidak ada yang cocok</b>
              <span id="no-result-text">Coba kata kunci lain.</span>
            </div>

          <?php endif; ?>
        </div>

      </div>
    </main>
  </div>

  <script>
    (function () {
      const list = document.getElementById('mhs-list');
      if (!list) return;

      const items     = [...list.querySelectorAll('.mhs-item')];
      const input     = document.getElementById('search');
      const wrap      = document.getElementById('search-wrap');
      const clearBtn  = document.getElementById('search-clear');
      const tabs      = [...document.querySelectorAll('.tab')];
      const countEl   = document.getElementById('mhs-count');
      const noResult  = document.getElementById('no-result');
      const noResText = document.getElementById('no-result-text');
      let filter = 'all';

      // Simpan teks asli untuk penyorotan kata kunci
      items.forEach(li => li.querySelectorAll('[data-text]').forEach(el => el.dataset.raw = el.textContent));

      const escapeHtml = s => s.replace(/[&<>"']/g, c => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));

      function highlight(el, q) {
        const raw = el.dataset.raw;
        if (!q) { el.textContent = raw; return; }
        const i = raw.toLowerCase().indexOf(q);
        el.innerHTML = i < 0 ? escapeHtml(raw)
          : escapeHtml(raw.slice(0, i)) + '<mark>' + escapeHtml(raw.slice(i, i + q.length)) + '</mark>' + escapeHtml(raw.slice(i + q.length));
      }

      function apply() {
        const q = input.value.trim().toLowerCase();
        wrap.classList.toggle('has-value', input.value !== '');
        let shown = 0;

        items.forEach(li => {
          const okText    = !q || li.dataset.search.includes(q);
          const okPending = filter === 'all' || Number(li.dataset.pending) > 0;
          const visible   = okText && okPending;
          li.hidden = !visible;
          if (visible) shown++;
          li.querySelectorAll('[data-text]').forEach(el => highlight(el, visible ? q : ''));
        });

        countEl.textContent = (q || filter !== 'all')
          ? shown + ' dari ' + items.length + ' mahasiswa'
          : items.length + ' mahasiswa';

        noResult.hidden = shown > 0;
        if (shown === 0) {
          noResText.textContent = (filter === 'pending' && !q)
            ? 'Tidak ada mahasiswa dengan jurnal yang menunggu persetujuan.'
            : 'Tidak ada mahasiswa dengan nama atau NIM "' + input.value.trim() + '".';
        }
      }

      function setFilter(f) {
        filter = f;
        tabs.forEach(t => t.classList.toggle('active', t.dataset.filter === f));
        apply();
      }

      input.addEventListener('input', apply);
      input.addEventListener('keydown', e => { if (e.key === 'Escape') { input.value = ''; apply(); } });
      clearBtn.addEventListener('click', () => { input.value = ''; apply(); input.focus(); });
      tabs.forEach(t => t.addEventListener('click', () => setFilter(t.dataset.filter)));

      const showPending = document.querySelector('[data-show-pending]');
      if (showPending) {
        showPending.addEventListener('click', () => {
          setFilter('pending');
          document.getElementById('daftar-mahasiswa').scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
      }
    })();
  </script>

</body>

</html>