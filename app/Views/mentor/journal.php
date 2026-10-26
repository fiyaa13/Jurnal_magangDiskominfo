<?php
/**
 * Validasi Jurnal Mahasiswa (mentor) — SIAMANG
 * Variabel dari controller: $journals (tiap baris: id, nama_mahasiswa, tanggal, deskripsi, bukti, status, mentor_note)
 */
$journals = $journals ?? [];

// Jurnal yang menunggu ditampilkan paling atas (urutan lain tetap)
usort($journals, static fn ($a, $b) => ($b['status'] === 'pending') <=> ($a['status'] === 'pending'));

$jumlah = ['all' => count($journals), 'pending' => 0, 'approved' => 0, 'rejected' => 0];
foreach ($journals as $j) {
    if (isset($jumlah[$j['status']])) {
        $jumlah[$j['status']]++;
    }
}

// Jika semua jurnal milik satu mahasiswa, namanya jadi judul halaman
$namaMahasiswa = array_values(array_unique(array_column($journals, 'nama_mahasiswa')));
$satuMahasiswa = count($namaMahasiswa) === 1 ? $namaMahasiswa[0] : null;

$namaHari  = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
$namaBulan = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

$statusInfo = [
    'pending'  => ['Menunggu', 'badge-pending'],
    'approved' => ['Disetujui', 'badge-approved'],
    'rejected' => ['Ditolak', 'badge-rejected'],
];
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Validasi Jurnal — SIAMANG</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('css/siamang.css') ?>">
  <style>
    .content svg { fill: none; stroke: currentColor; stroke-width: 2; flex-shrink: 0; }

    /* ── Judul ── */
    .page-header {
      display: flex;
      align-items: flex-end;
      justify-content: space-between;
      gap: 16px;
      flex-wrap: wrap;
      margin-bottom: 24px;
    }

    .btn-outline {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 10px 18px;
      border-radius: 10px;
      border: 1px solid var(--border);
      background: var(--white);
      box-shadow: var(--shadow);
      color: var(--sub);
      font-size: 14px;
      font-weight: 600;
      transition: all 0.2s;
    }
    .btn-outline:hover { border-color: var(--blue); background: var(--tint); color: var(--blue); }
    .btn-outline svg { width: 16px; height: 16px; }

    /* ── Tab filter ── */
    .tabs {
      display: inline-flex;
      flex-wrap: wrap;
      gap: 4px;
      padding: 4px;
      margin-bottom: 16px;
      border-radius: 10px;
      background: var(--white);
      border: 1px solid var(--border);
      box-shadow: var(--shadow);
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
    }
    .tab.active { background: var(--tint); color: var(--navy); }
    .tab .n {
      min-width: 20px;
      padding: 1px 6px;
      border-radius: 99px;
      background: var(--border);
      color: var(--sub);
      font-size: 11px;
      text-align: center;
    }
    .tab[data-filter="pending"] .n { background: var(--amber); color: #fff; }

    /* ── Kartu jurnal ── */
    .j-list { display: flex; flex-direction: column; gap: 14px; }

    .j-card {
      display: grid;
      grid-template-columns: 96px 1fr 300px;
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 14px;
      box-shadow: var(--shadow);
      overflow: hidden;
    }
    .j-card[hidden] { display: none; }
    .j-card.is-pending { border-left: 4px solid var(--amber); }

    .j-date {
      padding: 18px 12px;
      text-align: center;
      background: var(--tint-bg);
      border-right: 1px solid var(--border);
    }
    .j-date .hari { font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; color: var(--muted); }
    .j-date .tgl { font-family: var(--font-head); font-size: 28px; font-weight: 800; line-height: 1.1; margin: 2px 0; }
    .j-date .bln { font-size: 13px; color: var(--sub); }

    .j-body { padding: 18px 20px; min-width: 0; }
    .j-name { font-size: 12px; font-weight: 600; color: var(--blue); margin-bottom: 4px; }
    .j-desc { font-size: 14px; line-height: 1.65; white-space: pre-line; }

    .j-bukti { margin-top: 14px; }
    .j-label {
      font-size: 12px;
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 0.06em;
      color: var(--muted);
      margin-bottom: 6px;
    }

    .thumb {
      position: relative;
      display: block;
      width: 160px;
      height: 110px;
      padding: 0;
      border: 1px solid var(--border);
      border-radius: 10px;
      overflow: hidden;
      background: var(--tint-bg);
      cursor: zoom-in;
    }
    .thumb img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 0.25s; }
    .thumb:hover img { transform: scale(1.05); }
    .thumb .zoom {
      position: absolute;
      right: 6px;
      bottom: 6px;
      display: flex;
      align-items: center;
      gap: 4px;
      padding: 3px 8px;
      border-radius: 6px;
      background: rgba(0, 51, 102, 0.75);
      color: #fff;
      font-size: 11px;
      font-weight: 600;
    }
    .thumb .zoom svg { width: 12px; height: 12px; }

    .no-bukti {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 13px;
      color: var(--muted);
      font-style: italic;
    }
    .no-bukti svg { width: 14px; height: 14px; }

    /* ── Kolom aksi ── */
    .j-side {
      padding: 18px 20px;
      border-left: 1px solid var(--border);
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .badge {
      align-self: flex-start;
      display: inline-flex;
      align-items: center;
      gap: 5px;
      padding: 4px 11px;
      border-radius: 99px;
      border: 1px solid;
      font-size: 12px;
      font-weight: 600;
    }
    .badge-pending  { background: var(--amber-l); border-color: var(--amber-b); color: #92400e; }
    .badge-approved { background: var(--green-l); border-color: var(--green-b); color: #166534; }
    .badge-rejected { background: var(--red-l);   border-color: var(--red-b);   color: var(--red-d); }

    .note-box {
      padding: 10px 12px;
      border-radius: 10px;
      background: var(--tint-bg);
      border: 1px solid var(--border);
      font-size: 13px;
      line-height: 1.55;
      white-space: pre-line;
    }
    .note-box.kosong { color: var(--muted); font-style: italic; }

    .act textarea {
      width: 100%;
      min-height: 72px;
      padding: 10px 12px;
      border: 1.5px solid var(--border);
      border-radius: 10px;
      background: var(--tint-bg);
      font-size: 13px;
      color: var(--navy);
      line-height: 1.5;
      resize: vertical;
      outline: none;
      transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
    }
    .act textarea::placeholder { color: var(--muted); }
    .act textarea:focus { border-color: var(--blue); background: #fff; box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1); }
    .act textarea.invalid { border-color: var(--red); background: var(--red-l); }

    .act .hint { font-size: 12px; color: var(--red-d); margin-top: 4px; min-height: 0; }
    .act .hint:empty { display: none; }

    .act-btns { display: flex; gap: 8px; margin-top: 10px; }

    .btn-approve,
    .btn-reject {
      flex: 1;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      padding: 9px 12px;
      border-radius: 9px;
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s;
    }
    .btn-approve svg, .btn-reject svg { width: 14px; height: 14px; stroke-width: 2.5; }

    .btn-approve { border: none; background: var(--blue); color: #fff; }
    .btn-approve:hover { background: var(--navy2); box-shadow: 0 4px 12px rgba(0, 123, 255, 0.25); }

    .btn-reject { border: 1px solid var(--red-b); background: #fff; color: var(--red-d); }
    .btn-reject:hover { background: var(--red-l); border-color: var(--red); }

    /* ── Kosong ── */
    .empty {
      padding: 56px 20px;
      text-align: center;
      color: var(--muted);
      font-size: 14px;
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 14px;
    }
    .empty svg { width: 44px; height: 44px; stroke-width: 1.5; color: #c0d4e8; margin-bottom: 10px; }
    .empty b { display: block; color: var(--navy); font-size: 15px; margin-bottom: 4px; }

    /* ── Tampilan foto besar ── */
    .lightbox {
      max-width: min(92vw, 1000px);
      max-height: 92vh;
      padding: 0;
      border: none;
      border-radius: 14px;
      background: #0b1b30;
      overflow: hidden;
      margin: auto;
    }
    .lightbox::backdrop { background: rgba(0, 20, 45, 0.75); backdrop-filter: blur(3px); }
    .lightbox img { display: block; max-width: min(92vw, 1000px); max-height: calc(92vh - 52px); margin: 0 auto; object-fit: contain; }

    .lb-bar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      padding: 10px 14px;
      color: #fff;
      font-size: 13px;
    }
    .lb-bar a { color: var(--sky); font-weight: 600; margin-left: auto; }
    .lb-close {
      width: 30px;
      height: 30px;
      border: none;
      border-radius: 8px;
      background: rgba(255, 255, 255, 0.12);
      color: #fff;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .lb-close:hover { background: rgba(255, 255, 255, 0.22); }
    .lb-close svg { width: 16px; height: 16px; fill: none; stroke: currentColor; stroke-width: 2; }

    @media (max-width: 900px) {
      .j-card { grid-template-columns: 80px 1fr; }
      .j-side { grid-column: 1 / -1; border-left: none; border-top: 1px solid var(--border); }
    }

    @media (max-width: 560px) {
      .thumb { width: 100%; height: 180px; }
    }
  </style>
</head>

<body>

  <?= view('partials/topbar', ['pageTitle' => 'Validasi Jurnal']) ?>

  <div class="shell">
    <main class="main">
      <div class="content">

        <div class="page-header">
          <div>
            <div class="page-eyebrow">Validasi Jurnal</div>
            <h2 class="page-title"><?= $satuMahasiswa ? esc($satuMahasiswa) : 'Jurnal Mahasiswa' ?></h2>
            <p class="page-sub">
              <?= $jumlah['all'] ?> jurnal ·
              <?= $jumlah['pending'] > 0 ? $jumlah['pending'] . ' menunggu persetujuan' : 'semua sudah ditinjau' ?>
            </p>
          </div>
          <a href="<?= base_url('dashboard') ?>" class="btn-outline">
            <svg viewBox="0 0 24 24">
              <line x1="19" y1="12" x2="5" y2="12" />
              <polyline points="12 19 5 12 12 5" />
            </svg>
            Kembali ke Dashboard
          </a>
        </div>

        <?php if (empty($journals)): ?>
          <div class="empty">
            <svg viewBox="0 0 24 24">
              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
              <polyline points="14 2 14 8 20 8" />
            </svg>
            <b>Belum ada jurnal</b>
            Mahasiswa ini belum mengisi jurnal kegiatan.
          </div>
        <?php else: ?>

          <div class="tabs" role="tablist">
            <button type="button" class="tab<?= $jumlah['pending'] > 0 ? ' active' : '' ?>" data-filter="pending">Menunggu <span class="n"><?= $jumlah['pending'] ?></span></button>
            <button type="button" class="tab<?= $jumlah['pending'] > 0 ? '' : ' active' ?>" data-filter="all">Semua <span class="n"><?= $jumlah['all'] ?></span></button>
            <button type="button" class="tab" data-filter="approved">Disetujui <span class="n"><?= $jumlah['approved'] ?></span></button>
            <button type="button" class="tab" data-filter="rejected">Ditolak <span class="n"><?= $jumlah['rejected'] ?></span></button>
          </div>

          <div class="j-list" id="j-list">
            <?php foreach ($journals as $j): ?>
              <?php
              $ts     = strtotime($j['tanggal']);
              $status = $statusInfo[$j['status']] ?? [ucfirst($j['status']), 'badge-pending'];
              $urlFoto = ! empty($j['bukti']) ? base_url('journal/bukti/' . (int) $j['id']) : null;
              ?>
              <article class="j-card<?= $j['status'] === 'pending' ? ' is-pending' : '' ?>" data-status="<?= esc($j['status'], 'attr') ?>">

                <div class="j-date">
                  <div class="hari"><?= $ts ? $namaHari[(int) date('w', $ts)] : '' ?></div>
                  <div class="tgl"><?= $ts ? date('j', $ts) : '–' ?></div>
                  <div class="bln"><?= $ts ? $namaBulan[(int) date('n', $ts)] . ' ' . date('Y', $ts) : esc($j['tanggal']) ?></div>
                </div>

                <div class="j-body">
                  <?php if (! $satuMahasiswa): ?>
                    <div class="j-name"><?= esc($j['nama_mahasiswa']) ?></div>
                  <?php endif; ?>
                  <div class="j-desc"><?= esc($j['deskripsi']) ?></div>

                  <div class="j-bukti">
                    <div class="j-label">Foto Bukti</div>
                    <?php if ($urlFoto): ?>
                      <button type="button" class="thumb"
                        data-foto="<?= esc($urlFoto, 'attr') ?>"
                        data-caption="<?= esc(($j['nama_mahasiswa'] ?? '') . ' · ' . ($ts ? $namaHari[(int) date('w', $ts)] . ', ' . date('j', $ts) . ' ' . $namaBulan[(int) date('n', $ts)] . ' ' . date('Y', $ts) : $j['tanggal']), 'attr') ?>"
                        aria-label="Perbesar foto bukti">
                        <img src="<?= esc($urlFoto, 'attr') ?>" alt="Foto bukti kegiatan" loading="lazy">
                        <span class="zoom">
                          <svg viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="8" />
                            <line x1="21" y1="21" x2="16.65" y2="16.65" />
                            <line x1="11" y1="8" x2="11" y2="14" />
                            <line x1="8" y1="11" x2="14" y2="11" />
                          </svg>
                          Perbesar
                        </span>
                      </button>
                    <?php else: ?>
                      <span class="no-bukti">
                        <svg viewBox="0 0 24 24">
                          <rect x="3" y="3" width="18" height="18" rx="2" />
                          <circle cx="8.5" cy="8.5" r="1.5" />
                          <polyline points="21 15 16 10 5 21" />
                        </svg>
                        Tidak ada foto bukti
                      </span>
                    <?php endif; ?>
                  </div>
                </div>

                <div class="j-side">
                  <span class="badge <?= $status[1] ?>"><?= $status[0] ?></span>

                  <?php if ($j['status'] === 'pending'): ?>
                    <form class="act" method="post" action="<?= base_url('mentor/journal/approve/' . (int) $j['id']) ?>">
                      <?= csrf_field() ?>
                      <label class="j-label" for="note-<?= (int) $j['id'] ?>">Catatan Mentor</label>
                      <textarea id="note-<?= (int) $j['id'] ?>" name="mentor_note" placeholder="Opsional saat menyetujui, wajib saat menolak..."></textarea>
                      <div class="hint"></div>
                      <div class="act-btns">
                        <button type="submit" class="btn-approve">
                          <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12" /></svg>
                          Setujui
                        </button>
                        <button type="submit" class="btn-reject" data-reject
                          formaction="<?= base_url('mentor/journal/reject/' . (int) $j['id']) ?>">
                          <svg viewBox="0 0 24 24">
                            <line x1="18" y1="6" x2="6" y2="18" />
                            <line x1="6" y1="6" x2="18" y2="18" />
                          </svg>
                          Tolak
                        </button>
                      </div>
                    </form>
                  <?php else: ?>
                    <div>
                      <div class="j-label">Catatan Mentor</div>
                      <?php if (! empty($j['mentor_note'])): ?>
                        <div class="note-box"><?= esc($j['mentor_note']) ?></div>
                      <?php else: ?>
                        <div class="note-box kosong">Tanpa catatan</div>
                      <?php endif; ?>
                    </div>
                  <?php endif; ?>
                </div>

              </article>
            <?php endforeach; ?>
          </div>

          <div class="empty" id="no-result" hidden>
            <svg viewBox="0 0 24 24">
              <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
              <polyline points="22 4 12 14.01 9 11.01" />
            </svg>
            <b id="no-result-title">Tidak ada jurnal</b>
            <span id="no-result-text"></span>
          </div>

        <?php endif; ?>

      </div>
    </main>
  </div>

  <!-- Tampilan foto besar -->
  <dialog class="lightbox" id="lightbox" aria-label="Foto bukti">
    <img id="lb-img" src="" alt="Foto bukti kegiatan">
    <div class="lb-bar">
      <span id="lb-caption"></span>
      <a id="lb-open" href="#" target="_blank" rel="noopener">Buka ukuran asli</a>
      <button type="button" class="lb-close" id="lb-close" aria-label="Tutup">
        <svg viewBox="0 0 24 24">
          <line x1="18" y1="6" x2="6" y2="18" />
          <line x1="6" y1="6" x2="18" y2="18" />
        </svg>
      </button>
    </div>
  </dialog>

  <script>
    (function () {
      // ── Filter status ──
      const cards = [...document.querySelectorAll('.j-card')];
      const tabs  = [...document.querySelectorAll('.tab')];
      const noRes = document.getElementById('no-result');
      const pesan = {
        pending:  ['Tidak ada yang menunggu', 'Semua jurnal mahasiswa ini sudah kamu tinjau.'],
        approved: ['Belum ada yang disetujui', ''],
        rejected: ['Tidak ada yang ditolak', ''],
      };

      function setFilter(f) {
        let shown = 0;
        cards.forEach(c => {
          const v = f === 'all' || c.dataset.status === f;
          c.hidden = !v;
          if (v) shown++;
        });
        tabs.forEach(t => t.classList.toggle('active', t.dataset.filter === f));
        if (noRes) {
          noRes.hidden = shown > 0;
          const [judul, teks] = pesan[f] || ['Tidak ada jurnal', ''];
          document.getElementById('no-result-title').textContent = judul;
          document.getElementById('no-result-text').textContent = teks;
        }
      }

      tabs.forEach(t => t.addEventListener('click', () => setFilter(t.dataset.filter)));
      const awal = tabs.find(t => t.classList.contains('active'));
      if (awal) setFilter(awal.dataset.filter);

      // ── Menolak wajib disertai alasan ──
      document.querySelectorAll('[data-reject]').forEach(btn => {
        btn.addEventListener('click', e => {
          const form = btn.closest('form');
          const note = form.querySelector('textarea');
          const hint = form.querySelector('.hint');
          if (note.value.trim() === '') {
            e.preventDefault();
            note.classList.add('invalid');
            hint.textContent = 'Tuliskan alasan penolakan agar mahasiswa tahu apa yang perlu diperbaiki.';
            note.focus();
          }
        });
      });
      document.querySelectorAll('.act textarea').forEach(t => t.addEventListener('input', () => {
        t.classList.remove('invalid');
        t.closest('form').querySelector('.hint').textContent = '';
      }));

      // ── Tampilan foto besar ──
      const lb = document.getElementById('lightbox');
      const lbImg = document.getElementById('lb-img');
      document.querySelectorAll('.thumb').forEach(btn => btn.addEventListener('click', () => {
        lbImg.src = btn.dataset.foto;
        document.getElementById('lb-caption').textContent = btn.dataset.caption;
        document.getElementById('lb-open').href = btn.dataset.foto;
        lb.showModal();
      }));
      document.getElementById('lb-close').addEventListener('click', () => lb.close());
      lb.addEventListener('click', e => { if (e.target === lb) lb.close(); });
    })();
  </script>

</body>

</html>
