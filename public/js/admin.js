/* SIAMANG — interaksi halaman admin: pencarian, tab filter, konfirmasi, salin password */
(function () {
  // ── Pencarian + tab pada tabel ──
  const table = document.querySelector('[data-list]');
  if (table) {
    const rows      = [...table.querySelectorAll('tbody tr[data-search]')];
    const input     = document.getElementById('search');
    const tabs      = [...document.querySelectorAll('.tab[data-filter]')];
    const countEl   = document.getElementById('list-count');
    const emptyRow  = document.getElementById('no-result');
    const unit      = table.dataset.list;
    let filter      = (tabs.find(t => t.classList.contains('active')) || {}).dataset?.filter || 'all';

    rows.forEach(tr => tr.querySelectorAll('[data-text]').forEach(el => (el.dataset.raw = el.textContent)));

    const escapeHtml = s => s.replace(/[&<>"']/g, c => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));

    function highlight(el, q) {
      const raw = el.dataset.raw;
      const i = q ? raw.toLowerCase().indexOf(q) : -1;
      el.innerHTML = i < 0 ? escapeHtml(raw)
        : escapeHtml(raw.slice(0, i)) + '<mark>' + escapeHtml(raw.slice(i, i + q.length)) + '</mark>' + escapeHtml(raw.slice(i + q.length));
    }

    function apply() {
      const q = input ? input.value.trim().toLowerCase() : '';
      let shown = 0;
      rows.forEach(tr => {
        const okText = !q || tr.dataset.search.includes(q);
        const okTab  = filter === 'all' || (tr.dataset.tags || '').split(' ').includes(filter);
        tr.hidden = !(okText && okTab);
        if (!tr.hidden) shown++;
        tr.querySelectorAll('[data-text]').forEach(el => highlight(el, tr.hidden ? '' : q));
      });
      if (countEl) countEl.textContent = (q || filter !== 'all') ? `${shown} dari ${rows.length} ${unit}` : `${rows.length} ${unit}`;
      if (emptyRow) emptyRow.hidden = shown > 0 || rows.length === 0;
    }

    if (input) {
      input.addEventListener('input', apply);
      input.addEventListener('keydown', e => { if (e.key === 'Escape') { input.value = ''; apply(); } });
    }
    tabs.forEach(t => t.addEventListener('click', () => {
      filter = t.dataset.filter;
      tabs.forEach(x => x.classList.toggle('active', x === t));
      apply();
    }));
    apply();
  }

  // ── Konfirmasi sebelum aksi penting ──
  document.querySelectorAll('form[data-confirm]').forEach(f => {
    f.addEventListener('submit', e => { if (!confirm(f.dataset.confirm)) e.preventDefault(); });
  });

  // ── Tandai pilihan pembimbing yang kosong ──
  document.querySelectorAll('.assign select').forEach(s => {
    const mark = () => s.classList.toggle('empty', s.value === '');
    s.addEventListener('change', mark);
    mark();
  });

  // ── Salin password sementara ──
  document.querySelectorAll('[data-copy]').forEach(btn => btn.addEventListener('click', () => {
    navigator.clipboard?.writeText(btn.dataset.copy).then(() => {
      const old = btn.textContent;
      btn.textContent = 'Tersalin';
      setTimeout(() => (btn.textContent = old), 1500);
    });
  }));
})();