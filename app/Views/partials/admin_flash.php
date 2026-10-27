<?php
/** Partial: pesan berhasil/gagal dan password sementara di halaman admin */
$sukses   = session()->getFlashdata('success');
$gagal    = session()->getFlashdata('error');
$pwBaru   = session()->getFlashdata('password_baru');
?>
<?php if ($sukses): ?>
  <div class="flash flash-success" role="status">
    <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" /><polyline points="22 4 12 14.01 9 11.01" /></svg>
    <span><?= esc($sukses) ?></span>
  </div>
<?php endif; ?>

<?php if ($gagal): ?>
  <div class="flash flash-error" role="alert">
    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" /><line x1="12" y1="8" x2="12" y2="12" /><line x1="12" y1="16" x2="12.01" y2="16" /></svg>
    <span><?= esc($gagal) ?></span>
  </div>
<?php endif; ?>

<?php if (is_array($pwBaru)): ?>
  <div class="flash flash-info" role="status">
    <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" /><path d="M7 11V7a5 5 0 0 1 10 0v4" /></svg>
    <div class="pw-box">
      <b>Password <?= esc($pwBaru['nama']) ?> sudah direset</b>
      Login: <?= esc($pwBaru['email']) ?><br>
      <span class="pw-code">
        <?= esc($pwBaru['password']) ?>
        <button type="button" class="btn-sm" data-copy="<?= esc($pwBaru['password'], 'attr') ?>">Salin</button>
      </span>
      <small>Password ini hanya ditampilkan sekali. Sampaikan langsung ke yang bersangkutan.</small>
    </div>
  </div>
<?php endif; ?>