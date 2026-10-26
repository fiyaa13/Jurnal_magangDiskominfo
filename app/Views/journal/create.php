<?php
/**
 * Tambah Jurnal Magang — SIAMANG
 * Variabel dari controller: $profile, $totalJurnal
 */
$profile = $profile ?? null;
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Jurnal Magang — SIAMANG</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('css/siamang.css') ?>">
  <style>
    .content svg { fill: none; stroke: currentColor; stroke-width: 2; flex-shrink: 0; }

    /* ═══ KARTU FORM ═══ */
    .form-card {
      max-width: 620px;
      margin: 0 auto;
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 16px;
      box-shadow: var(--shadow);
      overflow: hidden;
    }

    .card-header {
      background: var(--grad);
      padding: 24px 28px;
    }
    .card-header::before { width: 300px; height: 300px; top: -110px; right: -60px; }

    .card-header .page-eyebrow {
      display: flex;
      align-items: center;
      gap: 6px;
      color: var(--sky);
    }
    .card-header .page-eyebrow svg { width: 12px; height: 12px; }

    .card-header .page-title { font-size: 22px; font-weight: 700; color: #fff; letter-spacing: -0.3px; }

    .card-body { padding: 24px 28px 28px; }

    /* Catatan info */
    .info-note {
      display: flex;
      align-items: flex-start;
      gap: 10px;
      padding: 12px 14px;
      margin-bottom: 8px;
      border-radius: 10px;
      background: var(--tint);
      border: 1px solid var(--tint-b);
      color: var(--navy2);
    }
    .info-note svg { width: 16px; height: 16px; margin-top: 1px; color: var(--blue); }
    .info-note p { font-size: 13px; line-height: 1.55; }

    .alert-error {
      display: flex;
      align-items: flex-start;
      gap: 10px;
      padding: 12px 14px;
      margin-top: 10px;
      border-radius: 10px;
      background: var(--red-l);
      border: 1px solid var(--red-b);
      color: var(--red-d);
    }
    .alert-error svg { width: 16px; height: 16px; margin-top: 1px; }
    .alert-error p { font-size: 13px; font-weight: 500; line-height: 1.55; }

    /* Pemisah seksi */
    .sec-div { display: flex; align-items: center; gap: 12px; margin: 20px 0 16px; }
    .sec-div-line { flex: 1; height: 1px; background: var(--border); }
    .sec-div-label {
      font-size: 12px;
      font-weight: 600;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: var(--muted);
      white-space: nowrap;
    }

    /* ── Field ── */
    .field { margin-bottom: 18px; }

    .field label {
      display: block;
      margin-bottom: 7px;
      font-size: 13px;
      font-weight: 600;
      color: var(--navy);
    }
    .field .req { color: var(--red); margin-left: 1px; }
    .field .opt { margin-left: 4px; font-size: 12px; font-weight: 400; color: var(--sub); }

    .iw { position: relative; }

    .iw .ico {
      position: absolute;
      left: 13px;
      top: 50%;
      transform: translateY(-50%);
      display: flex;
      color: var(--muted);
      pointer-events: none;
    }
    .iw .ico svg { width: 15px; height: 15px; stroke-width: 1.8; }
    .iw-textarea .ico { top: 14px; transform: none; }

    .iw input,
    .iw textarea {
      width: 100%;
      padding: 10px 14px 10px 38px;
      border: 1.5px solid var(--border);
      border-radius: 10px;
      background: var(--tint-bg);
      font-size: 14px;
      color: var(--navy);
      outline: none;
      transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
    }

    .iw textarea {
      min-height: 120px;
      padding-top: 12px;
      padding-bottom: 12px;
      line-height: 1.65;
      resize: vertical;
      vertical-align: top;
    }

    .iw input:focus,
    .iw textarea:focus {
      border-color: var(--blue);
      background: #fff;
      box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
    }

    /* ── Upload ── */
    .upload-zone {
      position: relative;
      padding: 24px;
      border: 2px dashed var(--border);
      border-radius: 12px;
      background: var(--tint-bg);
      text-align: center;
      cursor: pointer;
      transition: border-color 0.2s, background 0.2s;
    }

    .upload-zone:hover,
    .upload-zone.drag-over { border-color: var(--blue); background: var(--tint); }

    .upload-zone input[type="file"] {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      opacity: 0;
      cursor: pointer;
    }

    .upload-ic {
      width: 48px;
      height: 48px;
      margin: 0 auto 10px;
      border-radius: 12px;
      background: var(--tint);
      color: var(--blue);
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background 0.2s;
    }
    .upload-zone:hover .upload-ic { background: var(--tint-b); }
    .upload-ic svg { width: 22px; height: 22px; stroke-width: 1.8; }

    .upload-title { font-size: 14px; font-weight: 600; margin-bottom: 4px; }
    .upload-sub { font-size: 13px; color: var(--sub); }
    .upload-sub span { color: var(--blue); font-weight: 600; }

    .upload-formats {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      margin-top: 10px;
    }

    .fmt-tag {
      padding: 3px 9px;
      border-radius: 99px;
      border: 1px solid var(--tint-b);
      background: var(--tint);
      color: var(--blue);
      font-size: 11px;
      font-weight: 600;
      letter-spacing: 0.05em;
    }

    .size-tag { font-size: 12px; color: var(--sub); }

    /* Pratinjau foto */
    #preview-wrap {
      display: none;
      position: relative;
      margin-top: 12px;
      border: 1px solid var(--border);
      border-radius: 10px;
      overflow: hidden;
    }

    #preview-img { display: block; width: 100%; max-height: 200px; object-fit: cover; }

    .preview-overlay {
      position: absolute;
      inset: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      background: rgba(0, 51, 102, 0.5);
      opacity: 0;
      cursor: pointer;
      transition: opacity 0.2s;
    }
    #preview-wrap:hover .preview-overlay { opacity: 1; }

    .preview-overlay span {
      display: flex;
      align-items: center;
      gap: 6px;
      font-size: 13px;
      font-weight: 600;
      color: #fff;
    }
    .preview-overlay svg { width: 14px; height: 14px; }

    .preview-name {
      display: flex;
      align-items: center;
      gap: 6px;
      padding: 8px 12px;
      border-top: 1px solid var(--border);
      background: var(--tint-bg);
      font-size: 12px;
      color: var(--sub);
    }
    .preview-name svg { width: 13px; height: 13px; color: var(--green); }

    /* ── Tombol ── */
    .form-actions { display: flex; gap: 10px; margin-top: 24px; }

    .btn-save,
    .btn-back {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      padding: 12px;
      border-radius: 10px;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s;
    }
    .btn-save svg, .btn-back svg { width: 16px; height: 16px; }

    .btn-save {
      border: none;
      background: var(--blue);
      color: #fff;
      box-shadow: 0 4px 14px rgba(0, 123, 255, 0.3);
    }
    .btn-save:hover {
      background: var(--navy2);
      transform: translateY(-1px);
      box-shadow: 0 6px 20px rgba(0, 123, 255, 0.4);
    }

    .btn-back {
      border: 1px solid var(--border);
      background: var(--white);
      color: var(--sub);
    }
    .btn-back:hover { border-color: var(--blue); background: var(--tint); color: var(--blue); }

    @media (max-width: 500px) {
      .form-actions { flex-direction: column; }
    }
  </style>
</head>

<body>

  <?= view('partials/topbar', ['pageTitle' => 'Tambah Jurnal']) ?>

  <div class="shell">

    <?= view('partials/sidebar', [
      'active'  => 'journal',
      'profile' => $profile,
      'counts'  => ['journal' => $totalJurnal ?? null],
    ]) ?>

    <main class="main">
      <div class="content">
        <div class="form-card">

          <div class="card-header glow">
            <div class="page-eyebrow">
              <svg viewBox="0 0 24 24">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                <polyline points="14 2 14 8 20 8" />
              </svg>
              E-Journal Magang
            </div>
            <h2 class="page-title">Tambah Jurnal Magang</h2>
          </div>

          <div class="card-body">

            <div class="info-note">
              <svg viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" />
                <line x1="12" y1="8" x2="12" y2="12" />
                <line x1="12" y1="16" x2="12.01" y2="16" />
              </svg>
              <p>Jurnal yang sudah dikirim akan menunggu persetujuan mentor. Pastikan deskripsi kegiatan sudah lengkap sebelum menyimpan.</p>
            </div>

            <?php if (session()->getFlashdata('error')): ?>
              <div class="alert-error" role="alert">
                <svg viewBox="0 0 24 24">
                  <circle cx="12" cy="12" r="10" />
                  <line x1="15" y1="9" x2="9" y2="15" />
                  <line x1="9" y1="9" x2="15" y2="15" />
                </svg>
                <p><?= esc(session()->getFlashdata('error')) ?></p>
              </div>
            <?php endif; ?>

            <form action="<?= site_url('journal/store') ?>" method="post" enctype="multipart/form-data">
              <?= csrf_field() ?>

              <div class="sec-div">
                <div class="sec-div-line"></div>
                <span class="sec-div-label">Data Jurnal</span>
                <div class="sec-div-line"></div>
              </div>

              <div class="field">
                <label for="tanggal">Tanggal <span class="req">*</span></label>
                <div class="iw">
                  <div class="ico"><svg viewBox="0 0 24 24">
                      <rect x="3" y="4" width="18" height="18" rx="2" />
                      <line x1="16" y1="2" x2="16" y2="6" />
                      <line x1="8" y1="2" x2="8" y2="6" />
                      <line x1="3" y1="10" x2="21" y2="10" />
                    </svg></div>
                  <input type="date" id="tanggal" name="tanggal" value="<?= esc(old('tanggal'), 'attr') ?>" required>
                </div>
              </div>

              <div class="field">
                <label for="deskripsi">Deskripsi Kegiatan <span class="req">*</span></label>
                <div class="iw iw-textarea">
                  <div class="ico"><svg viewBox="0 0 24 24">
                      <line x1="17" y1="10" x2="3" y2="10" />
                      <line x1="21" y1="6" x2="3" y2="6" />
                      <line x1="21" y1="14" x2="3" y2="14" />
                      <line x1="17" y1="18" x2="3" y2="18" />
                    </svg></div>
                  <textarea id="deskripsi" name="deskripsi" rows="5" placeholder="Tuliskan kegiatan yang kamu lakukan hari ini secara detail..." required><?= esc(old('deskripsi')) ?></textarea>
                </div>
              </div>

              <div class="sec-div">
                <div class="sec-div-line"></div>
                <span class="sec-div-label">Bukti Kegiatan</span>
                <div class="sec-div-line"></div>
              </div>

              <div class="field">
                <label for="file-input">Upload Foto Bukti <span class="opt">(opsional)</span></label>
                <div class="upload-zone" id="upload-zone">
                  <input type="file" name="bukti" id="file-input"
                    accept="image/jpeg,image/jpg,image/png"
                    onchange="previewImage(this)">
                  <div class="upload-ic">
                    <svg viewBox="0 0 24 24">
                      <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                      <polyline points="17 8 12 3 7 8" />
                      <line x1="12" y1="3" x2="12" y2="15" />
                    </svg>
                  </div>
                  <div class="upload-title">Klik atau drag foto ke sini</div>
                  <div class="upload-sub">Format yang didukung: <span>JPG, JPEG, PNG</span></div>
                  <div class="upload-formats">
                    <span class="fmt-tag">JPG</span>
                    <span class="fmt-tag">JPEG</span>
                    <span class="fmt-tag">PNG</span>
                    <span class="size-tag">· Maks. 2MB</span>
                  </div>
                </div>

                <div id="preview-wrap">
                  <img id="preview-img" src="" alt="Pratinjau foto bukti">
                  <div class="preview-overlay" onclick="clearFile()">
                    <span>
                      <svg viewBox="0 0 24 24">
                        <polyline points="3 6 5 6 21 6" />
                        <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                      </svg>
                      Hapus foto
                    </span>
                  </div>
                  <div class="preview-name">
                    <svg viewBox="0 0 24 24">
                      <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                      <polyline points="22 4 12 14.01 9 11.01" />
                    </svg>
                    <span id="preview-filename">—</span>
                  </div>
                </div>
              </div>

              <div class="form-actions">
                <button type="submit" class="btn-save">
                  <svg viewBox="0 0 24 24">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                    <polyline points="17 21 17 13 7 13 7 21" />
                    <polyline points="7 3 7 8 15 8" />
                  </svg>
                  Simpan Jurnal
                </button>
                <a href="<?= site_url('journal') ?>" class="btn-back">
                  <svg viewBox="0 0 24 24">
                    <line x1="19" y1="12" x2="5" y2="12" />
                    <polyline points="12 19 5 12 12 5" />
                  </svg>
                  Kembali
                </a>
              </div>

            </form>
          </div>
        </div>
      </div>
    </main>
  </div>

  <script>
    const fileInput = document.getElementById('file-input');
    const zone = document.getElementById('upload-zone');

    // Pratinjau foto saat dipilih
    function previewImage(input) {
      const file = input.files[0];
      if (!file) return;

      const allowed = ['image/jpeg', 'image/jpg', 'image/png'];
      if (!allowed.includes(file.type)) {
        alert('Format file tidak didukung. Gunakan JPG, JPEG, atau PNG.');
        clearFile();
        return;
      }

      if (file.size > 2 * 1024 * 1024) {
        alert('Ukuran file terlalu besar. Maksimal 2MB.');
        clearFile();
        return;
      }

      const reader = new FileReader();
      reader.onload = function (e) {
        document.getElementById('preview-img').src = e.target.result;
        document.getElementById('preview-filename').textContent =
          file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)';
        document.getElementById('preview-wrap').style.display = 'block';
      };
      reader.readAsDataURL(file);
    }

    function clearFile() {
      fileInput.value = '';
      document.getElementById('preview-wrap').style.display = 'none';
      document.getElementById('preview-img').src = '';
    }

    // Drag & drop
    zone.addEventListener('dragover', e => {
      e.preventDefault();
      zone.classList.add('drag-over');
    });
    zone.addEventListener('dragleave', () => zone.classList.remove('drag-over'));
    zone.addEventListener('drop', e => {
      e.preventDefault();
      zone.classList.remove('drag-over');
      if (e.dataTransfer.files.length) {
        fileInput.files = e.dataTransfer.files;
        previewImage(fileInput);
      }
    });
  </script>
</body>

</html>
