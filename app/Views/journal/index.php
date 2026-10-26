<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E-Journal Harian — SIAMANG</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
  <style>
    *,
    *::before,
    *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    :root {
      --ink: #003366;
      --navy: #003366;
      --navy2: #0056B3;
      --blue: #007BFF;
      --blue-h: #0056B3;
      --sky: #93c5fd;
      --bg: #f0f4f8;
      --white: #ffffff;
      --border: #e2eaf3;
      --text: #003366;
      --sub: #4a6fa5;
      --glass: rgba(255, 255, 255, 0.07);
      --edge: rgba(255, 255, 255, 0.11);
      --faint: rgba(255, 255, 255, 0.18);
      --green: #10b981;
      --green-l: #f0fdf4;
      --green-b: #bbf7d0;
      --amber: #f59e0b;
      --amber-l: #fffbeb;
      --amber-b: #fde68a;
      --red: #ef4444;
      --red-l: #fef2f2;
      --red-b: #fecaca;
      --radius: 14px;
      --shadow: 0 1px 3px rgba(0, 51, 102, 0.07), 0 4px 16px rgba(0, 51, 102, 0.05);
    }

    html,
    body {
      height: 100%;
      overflow: hidden;
      font-family: 'Inter', sans-serif;
      background: var(--bg);
      color: var(--text);
    }

    /* ═══ TOPBAR ═══ */
    .topbar {
      position: fixed;
      inset: 0 0 auto;
      z-index: 200;
      height: 56px;
      padding: 0 1.75rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: var(--navy);
      border-bottom: 1px solid rgba(255, 255, 255, 0.07);
    }

    .tb-l {
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .tb-logo {
      width: 32px;
      height: 32px;
      border-radius: 8px;
      background: var(--blue);
      box-shadow: 0 0 16px rgba(0, 123, 255, 0.45);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .tb-logo svg {
      width: 15px;
      height: 15px;
      stroke: white;
      fill: none;
      stroke-width: 2;
    }

    .tb-brand b {
      display: block;
      font-size: 0.78rem;
      font-weight: 800;
      color: white;
      line-height: 1;
      letter-spacing: 0.03em;
    }

    .tb-brand span {
      display: block;
      font-size: 0.59rem;
      color: var(--faint);
      margin-top: 1px;
    }

    .tb-sep {
      width: 1px;
      height: 20px;
      background: rgba(255, 255, 255, 0.1);
    }

    .tb-page {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-style: italic;
      font-size: 0.88rem;
      color: rgba(255, 255, 255, 0.45);
    }

    .tb-r {
      display: flex;
      align-items: center;
      gap: 0.6rem;
    }

    .tb-chip {
      display: flex;
      align-items: center;
      gap: 0.45rem;
      padding: 0.24rem 0.7rem 0.24rem 0.26rem;
      background: var(--glass);
      border: 1px solid var(--edge);
      border-radius: 99px;
    }

    .tb-av {
      width: 26px;
      height: 26px;
      border-radius: 50%;
      background: var(--blue);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.58rem;
      font-weight: 800;
      color: white;
    }

    .tb-av svg {
      width: 14px;
      height: 14px;
      stroke: white;
      fill: none;
      stroke-width: 2;
    }

    .tb-uname {
      font-size: 0.72rem;
      font-weight: 600;
      color: rgba(255, 255, 255, 0.82);
    }

    .btn-out {
      display: flex;
      align-items: center;
      gap: 0.32rem;
      cursor: pointer;
      padding: 0.3rem 0.75rem;
      border-radius: 7px;
      background: rgba(239, 68, 68, 0.12);
      border: 1px solid rgba(239, 68, 68, 0.22);
      font-family: 'Inter', sans-serif;
      font-size: 0.68rem;
      font-weight: 700;
      color: #fca5a5;
      transition: all 0.18s;
      text-decoration: none;
    }

    .btn-out:hover {
      background: rgba(239, 68, 68, 0.24);
      color: white;
    }

    .btn-out svg {
      width: 12px;
      height: 12px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2.5;
    }

    /* ═══ SHELL ═══ */
    .shell {
      display: flex;
      height: 100vh;
      padding-top: 56px;
    }

    /* ═══ SIDEBAR ═══ */
    .sidebar {
      width: 240px;
      flex-shrink: 0;
      background: var(--navy);
      display: flex;
      flex-direction: column;
      border-right: 1px solid rgba(255, 255, 255, 0.07);
      overflow: hidden;
      position: relative;
    }

    .sidebar::before {
      content: '';
      position: absolute;
      pointer-events: none;
      width: 400px;
      height: 400px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(0, 123, 255, 0.14) 0%, transparent 60%);
      top: -100px;
      left: -100px;
    }

    .sb-profile {
      padding: 1.6rem 1.4rem 1.4rem;
      border-bottom: 1px solid rgba(255, 255, 255, 0.07);
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      position: relative;
      z-index: 1;
      animation: fadeUp 0.5s ease both;
    }

    .sb-av {
      width: 58px;
      height: 58px;
      border-radius: 50%;
      background: linear-gradient(135deg, #0056B3, #007BFF);
      border: 2.5px solid rgba(255, 255, 255, 0.18);
      box-shadow: 0 0 0 5px rgba(0, 123, 255, 0.15);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.1rem;
      font-weight: 800;
      color: white;
      margin-bottom: 0.75rem;
    }

    .sb-av svg {
      width: 24px;
      height: 24px;
      stroke: white;
      fill: none;
      stroke-width: 2;
    }

    .sb-name {
      font-size: 0.88rem;
      font-weight: 700;
      color: white;
      margin-bottom: 3px;
    }

    .sb-nim {
      font-size: 0.62rem;
      color: rgba(255, 255, 255, 0.4);
      margin-bottom: 0.6rem;
    }

    .sb-badge {
      display: inline-block;
      padding: 0.18rem 0.7rem;
      border-radius: 99px;
      background: rgba(0, 123, 255, 0.2);
      border: 1px solid rgba(0, 123, 255, 0.35);
      font-size: 0.62rem;
      font-weight: 700;
      color: var(--sky);
      letter-spacing: 0.04em;
    }

    .sb-menu {
      flex: 1;
      padding: 1.2rem 0.9rem;
      overflow-y: auto;
      position: relative;
      z-index: 1;
    }

    .sb-menu::-webkit-scrollbar {
      display: none;
    }

    .sb-section-label {
      font-size: 0.57rem;
      font-weight: 700;
      letter-spacing: 0.14em;
      text-transform: uppercase;
      color: rgba(255, 255, 255, 0.25);
      padding: 0 0.6rem;
      margin-bottom: 0.5rem;
    }

    .sb-item {
      display: flex;
      align-items: center;
      gap: 0.7rem;
      padding: 0.65rem 0.75rem;
      border-radius: 10px;
      margin-bottom: 2px;
      text-decoration: none;
      transition: all 0.18s;
      color: rgba(255, 255, 255, 0.5);
      font-size: 0.78rem;
      font-weight: 500;
    }

    .sb-item:hover {
      background: rgba(255, 255, 255, 0.06);
      color: rgba(255, 255, 255, 0.85);
    }

    .sb-item.active {
      background: rgba(0, 123, 255, 0.22);
      border: 1px solid rgba(0, 123, 255, 0.3);
      color: white;
      font-weight: 700;
    }

    .sb-item svg {
      width: 15px;
      height: 15px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2;
      flex-shrink: 0;
    }

    .sb-count {
      margin-left: auto;
      background: var(--blue);
      color: white;
      font-size: 0.58rem;
      font-weight: 700;
      padding: 0.12rem 0.45rem;
      border-radius: 99px;
      min-width: 18px;
      text-align: center;
    }

    .sb-foot {
      padding: 1rem 1.4rem;
      border-top: 1px solid rgba(255, 255, 255, 0.06);
      position: relative;
      z-index: 1;
    }

    .sb-foot-txt {
      font-size: 0.58rem;
      color: rgba(255, 255, 255, 0.18);
      text-align: center;
      line-height: 1.6;
    }

    /* ═══ MAIN ═══ */
    .main {
      flex: 1;
      overflow-y: auto;
      background: var(--bg);
      scrollbar-width: thin;
      scrollbar-color: #cbd5e1 transparent;
    }

    .main::-webkit-scrollbar {
      width: 5px;
    }

    .main::-webkit-scrollbar-thumb {
      background: #cbd5e1;
      border-radius: 99px;
    }

    .content {
      padding: 2.5rem 3rem;
      animation: fadeUp 0.5s ease 0.1s both;
    }

    /* ── Page header ── */
    .page-header {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      gap: 20px;
      margin-bottom: 2rem;
      flex-wrap: wrap;
    }

    .page-super {
      font-size: 0.65rem;
      font-weight: 700;
      color: var(--blue);
      letter-spacing: 0.13em;
      text-transform: uppercase;
      margin-bottom: 6px;
    }

    /* H2 asli dari PHP */
    .content h2 {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 2rem;
      font-weight: 400;
      color: var(--text);
      line-height: 1.15;
      margin-bottom: 0;
    }

    .page-sub {
      font-size: 0.8rem;
      color: var(--sub);
      font-weight: 300;
      margin-top: 8px;
    }

    /* ── STAT CARDS dari PHP div[style] ── */
    .stat-cards-wrap {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 1rem;
      margin-bottom: 1.5rem;
    }

    .stat-card {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      padding: 1.1rem 1.2rem;
      display: flex;
      align-items: center;
      gap: 0.85rem;
      box-shadow: var(--shadow);
      transition: box-shadow 0.2s;
    }

    .stat-card:hover {
      box-shadow: 0 4px 16px rgba(0, 51, 102, 0.1);
    }

    .stat-ic {
      width: 40px;
      height: 40px;
      border-radius: 10px;
      flex-shrink: 0;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .stat-ic svg {
      width: 18px;
      height: 18px;
      fill: none;
      stroke-width: 2;
    }

    .stat-ic.blue {
      background: #e8f0fe;
    }

    .stat-ic.blue svg {
      stroke: var(--blue);
    }

    .stat-ic.amber {
      background: var(--amber-l);
    }

    .stat-ic.amber svg {
      stroke: var(--amber);
    }

    .stat-ic.green {
      background: var(--green-l);
    }

    .stat-ic.green svg {
      stroke: var(--green);
    }

    .stat-ic.red {
      background: var(--red-l);
    }

    .stat-ic.red svg {
      stroke: var(--red);
    }

    .stat-label {
      font-size: 0.63rem;
      font-weight: 600;
      color: var(--sub);
      letter-spacing: 0.02em;
      margin-bottom: 2px;
    }

    .stat-val {
      font-size: 1.1rem;
      font-weight: 800;
      color: var(--text);
    }

    /* tambah jurnal button */
    .btn-primary {
      display: flex;
      align-items: center;
      gap: 8px;
      background: var(--blue);
      color: #fff;
      border: none;
      border-radius: 12px;
      padding: 11px 20px;
      font-size: 0.82rem;
      font-weight: 700;
      cursor: pointer;
      font-family: 'Inter', sans-serif;
      text-decoration: none;
      box-shadow: 0 4px 14px rgba(0, 123, 255, 0.35);
      transition: transform 0.15s, background 0.2s, box-shadow 0.2s;
      white-space: nowrap;
    }

    .btn-primary:hover {
      background: var(--blue-h);
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0, 123, 255, 0.45);
    }

    .btn-primary svg {
      width: 15px;
      height: 15px;
      stroke: white;
      fill: none;
      stroke-width: 2.5;
    }

    /* sembunyikan elemen bawaan PHP yang sudah di-replace */
    .content>div[style] {
      display: none !important;
    }

    .content>hr {
      display: none;
    }

    .content>br {
      display: none;
    }

    .content>a.raw-link {
      display: none;
    }

    /* ── TABLE ── */
    .table-wrap {
      border: 1px solid var(--border);
      border-radius: var(--radius);
      background: var(--white);
      box-shadow: var(--shadow);
      overflow: hidden;
      margin-bottom: 1.5rem;
    }

    /* table bawaan PHP */
    .content>table {
      display: none;
    }

    /* tabel PHP asli disembunyikan, diganti .table-styled */

    .table-styled {
      width: 100%;
      border-collapse: collapse;
    }

    .table-styled thead tr {
      background: var(--navy);
    }

    .table-styled thead th {
      padding: 15px 20px;
      font-size: 0.68rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      color: white;
      border-right: 1px solid rgba(255, 255, 255, 0.08);
      text-align: left;
    }

    .table-styled thead th:last-child {
      border-right: none;
    }

    .table-styled tbody tr {
      border-bottom: 1px solid var(--border);
      transition: background 0.15s;
    }

    .table-styled tbody tr:nth-child(even) {
      background: rgba(219, 234, 254, 0.3);
    }

    .table-styled tbody tr:last-child {
      border-bottom: none;
    }

    .table-styled tbody tr:hover {
      background: rgba(147, 197, 253, 0.18) !important;
    }

    .table-styled tbody td {
      padding: 18px 20px;
      font-size: 0.82rem;
      border-right: 1px solid var(--border);
      vertical-align: middle;
    }

    .table-styled tbody td:last-child {
      border-right: none;
    }

    .td-date {
      font-weight: 600;
      font-variant-numeric: tabular-nums;
      white-space: nowrap;
    }

    .td-desc {
      line-height: 1.6;
    }

    .td-note {
      font-style: italic;
      color: var(--sub);
      line-height: 1.6;
    }

    /* badges */
    .badge {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      border-radius: 999px;
      padding: 5px 11px;
      font-size: 0.7rem;
      font-weight: 600;
      border: 1px solid;
      white-space: nowrap;
    }

    .badge svg {
      width: 12px;
      height: 12px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2;
    }

    .badge-pending {
      border-color: var(--amber-b);
      background: var(--amber-l);
      color: #92400e;
    }

    .badge-approved {
      border-color: var(--green-b);
      background: var(--green-l);
      color: #166534;
    }

    .badge-rejected {
      border-color: var(--red-b);
      background: var(--red-l);
      color: #dc2626;
    }

    /* action buttons */
    .action-wrap {
      display: flex;
      align-items: center;
      gap: 7px;
      flex-wrap: wrap;
    }

    .btn-edit,
    .btn-delete {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      border-radius: 9px;
      padding: 6px 12px;
      font-size: 0.71rem;
      font-weight: 600;
      cursor: pointer;
      border: 1px solid;
      transition: all 0.15s;
      font-family: 'Inter', sans-serif;
      text-decoration: none;
    }

    .btn-edit {
      border-color: #bfdbfe;
      background: #e8f0fe;
      color: var(--blue);
    }

    .btn-edit:hover {
      border-color: var(--blue);
      background: var(--blue);
      color: white;
    }

    .btn-delete {
      border-color: var(--red-b);
      background: var(--red-l);
      color: #dc2626;
    }

    .btn-delete:hover {
      border-color: #dc2626;
      background: #dc2626;
      color: white;
    }

    .btn-edit svg,
    .btn-delete svg {
      width: 12px;
      height: 12px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2;
    }

    .locked-txt {
      display: flex;
      align-items: center;
      gap: 6px;
      color: var(--sub);
      font-size: 0.74rem;
      font-weight: 500;
    }

    .locked-txt svg {
      width: 12px;
      height: 12px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2;
    }

    /* empty state */
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
      background: #e8f0fe;
      border-radius: 18px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 14px;
    }

    .empty-ic svg {
      width: 36px;
      height: 36px;
      stroke: #93c5fd;
      fill: none;
      stroke-width: 1.5;
    }

    .empty-title {
      font-size: 0.92rem;
      font-weight: 700;
    }

    .empty-sub {
      font-size: 0.78rem;
      color: var(--sub);
      margin-top: 4px;
    }

    /* bottom actions */
    .bottom-actions {
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
    }

    .btn-outline {
      display: flex;
      align-items: center;
      gap: 8px;
      border: 1.5px solid var(--border);
      background: var(--white);
      border-radius: 12px;
      padding: 11px 20px;
      font-size: 0.82rem;
      font-weight: 600;
      color: var(--sub);
      cursor: pointer;
      transition: all 0.2s;
      font-family: 'Inter', sans-serif;
      text-decoration: none;
    }

    .btn-outline:hover {
      border-color: var(--blue);
      background: #e8f0fe;
      color: var(--blue);
    }

    .btn-outline svg {
      width: 15px;
      height: 15px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2;
    }

    /* Modal overlay */
    .overlay {
      position: fixed;
      inset: 0;
      background: rgba(0, 51, 102, 0.45);
      backdrop-filter: blur(4px);
      z-index: 300;
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.2s;
    }

    .overlay.open {
      opacity: 1;
      pointer-events: all;
    }

    .modal {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 20px;
      width: 100%;
      max-width: 480px;
      box-shadow: 0 24px 64px rgba(0, 51, 102, 0.2);
      transform: translateY(12px) scale(0.97);
      transition: transform 0.25s, opacity 0.2s;
      overflow: hidden;
    }

    .overlay.open .modal {
      transform: translateY(0) scale(1);
    }

    .modal-header {
      padding: 20px 24px 16px;
      border-bottom: 1px solid var(--border);
    }

    .modal-title {
      font-size: 0.95rem;
      font-weight: 800;
      color: var(--text);
    }

    .modal-body {
      padding: 20px 24px;
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    .form-label {
      font-size: 0.72rem;
      font-weight: 700;
      color: var(--text);
      margin-bottom: 6px;
      display: block;
    }

    .form-input,
    .form-textarea {
      width: 100%;
      border: 1.5px solid var(--border);
      background: #f8fafc;
      border-radius: 10px;
      padding: 10px 14px;
      font-size: 0.82rem;
      color: var(--text);
      font-family: 'Inter', sans-serif;
      outline: none;
      transition: border-color 0.15s, background 0.15s;
    }

    .form-input:focus,
    .form-textarea:focus {
      border-color: var(--blue);
      background: white;
    }

    .form-textarea {
      resize: vertical;
      line-height: 1.6;
      min-height: 100px;
    }

    .modal-footer {
      padding: 16px 24px;
      border-top: 1px solid var(--border);
      display: flex;
      justify-content: flex-end;
      gap: 10px;
    }

    .btn-cancel {
      border: 1px solid var(--border);
      background: #f8fafc;
      color: var(--sub);
      border-radius: 10px;
      padding: 10px 20px;
      font-size: 0.78rem;
      font-weight: 600;
      cursor: pointer;
      font-family: 'Inter', sans-serif;
      transition: background 0.15s;
    }

    .btn-cancel:hover {
      background: var(--border);
    }

    .btn-save {
      background: var(--blue);
      color: white;
      border: none;
      border-radius: 10px;
      padding: 10px 24px;
      font-size: 0.78rem;
      font-weight: 700;
      cursor: pointer;
      font-family: 'Inter', sans-serif;
      box-shadow: 0 3px 10px rgba(0, 123, 255, 0.3);
      transition: background 0.15s;
    }

    .btn-save:hover {
      background: var(--blue-h);
    }

    /* Delete dialog */
    .dialog-sm {
      max-width: 360px;
    }

    .dialog-center {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      gap: 6px;
    }

    .dialog-icon {
      width: 56px;
      height: 56px;
      background: var(--red-l);
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 8px;
    }

    .dialog-icon svg {
      width: 28px;
      height: 28px;
      stroke: var(--red);
      fill: none;
      stroke-width: 2;
    }

    .dialog-title {
      font-size: 0.95rem;
      font-weight: 800;
    }

    .dialog-desc {
      font-size: 0.78rem;
      color: var(--sub);
      line-height: 1.6;
    }

    .btn-danger {
      background: #dc2626;
      color: white;
      border: none;
      border-radius: 10px;
      padding: 10px 20px;
      font-size: 0.78rem;
      font-weight: 700;
      cursor: pointer;
      font-family: 'Inter', sans-serif;
      transition: background 0.15s;
    }

    .btn-danger:hover {
      background: #b91c1c;
    }

    .dialog-footer {
      justify-content: center;
    }

    @keyframes fadeUp {
      from {
        opacity: 0;
        transform: translateY(14px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @media (max-width: 900px) {
      .sidebar {
        display: none;
      }

      .content {
        padding: 1.5rem 1.25rem;
      }

      .stat-cards-wrap {
        grid-template-columns: repeat(2, 1fr);
      }
    }
  </style>
</head>

<body>

  <!-- ═══ TOPBAR ═══ -->
  <header class="topbar">
    <div class="tb-l">
      <div class="tb-logo"><svg viewBox="0 0 24 24">
          <rect x="2" y="3" width="20" height="14" rx="2" />
          <path d="M8 21h8M12 17v4" />
        </svg></div>
      <div class="tb-brand"><b>SIAMANG</b><span>Sistem Absensi Magang</span></div>
      <div class="tb-sep"></div>
      <span class="tb-page">E-Journal Harian</span>
    </div>
    <div class="tb-r">
      <div class="tb-chip">
        <div class="tb-av">
          <svg viewBox="0 0 24 24">
            <circle cx="12" cy="8" r="4" />
            <path d="M4 20c0-4 4-6 8-6s8 2 8 6" />
          </svg>
        </div>
        <span class="tb-uname"><?= esc(session()->get('name')) ?></span>
      </div>
      <a href="<?= base_url('logout') ?>" class="btn-out">
        <svg viewBox="0 0 24 24">
          <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
          <polyline points="16 17 21 12 16 7" />
          <line x1="21" y1="12" x2="9" y2="12" />
        </svg>
        Log Out
      </a>
    </div>
  </header>

  <div class="shell">

    <!-- ═══ SIDEBAR ═══ -->
    <aside class="sidebar">
      <div class="sb-profile">
        <div class="sb-av">
          <svg viewBox="0 0 24 24">
            <circle cx="12" cy="8" r="4" />
            <path d="M4 20c0-4 4-6 8-6s8 2 8 6" />
          </svg>
        </div>
        <div class="sb-name"><?= esc(session()->get('name')) ?></div>
        <div class="sb-nim">NIM · <?= esc($profile['nim'] ?? '-') ?></div>
        <span class="sb-badge"><?= esc($profile['bidang_magang'] ?? 'Magang') ?></span>
      </div>
      <nav class="sb-menu">
        <div class="sb-section-label">Menu Utama</div>
        <a class="sb-item" href="<?= base_url('dashboard') ?>">
          <svg viewBox="0 0 24 24">
            <rect x="3" y="3" width="7" height="7" rx="1" />
            <rect x="14" y="3" width="7" height="7" rx="1" />
            <rect x="3" y="14" width="7" height="7" rx="1" />
            <rect x="14" y="14" width="7" height="7" rx="1" />
          </svg>
          Dashboard
        </a>
        <a class="sb-item active" href="<?= base_url('journal') ?>">
          <svg viewBox="0 0 24 24">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
            <polyline points="14 2 14 8 20 8" />
          </svg>
          E-Journal Harian
          <span class="sb-count" id="sb-count"><?= $totalJurnal ?? 0 ?></span>
        </a>
      </nav>
      <div class="sb-foot">
        <div class="sb-foot-txt">© 2026 SIAMANG<br>Diskominfo</div>
      </div>
    </aside>

    <!-- ═══ MAIN ═══ -->
    <main class="main">
      <div class="content">

        <!-- ============================================= -->
        <!-- KODE PHP ASLI — tidak ada yang diubah         -->
        <!-- ============================================= -->

        <!-- Page heading wrapper -->
        <div class="page-header">
          <div>
            <div class="page-super">E-Journal Magang</div>
            <h2>Jurnal Magang Saya</h2>
            <p class="page-sub">Sistem Absensi Magang — <?= date('F Y') ?></p>
          </div>
          <!-- Tambah Jurnal dari PHP (href dipertahankan) -->
          <a href="<?= base_url('journal/create') ?>" class="btn-primary">
            <svg viewBox="0 0 24 24">
              <line x1="12" y1="5" x2="12" y2="19" />
              <line x1="5" y1="12" x2="19" y2="12" />
            </svg>
            Tambah Jurnal
          </a>
        </div>

        <!-- STAT CARDS — data dari PHP tetap dipakai -->
        <div class="stat-cards-wrap">
          <div class="stat-card">
            <div class="stat-ic blue"><svg viewBox="0 0 24 24">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                <polyline points="14 2 14 8 20 8" />
              </svg></div>
            <div>
              <div class="stat-label">Total Jurnal</div>
              <div class="stat-val"><?= $totalJurnal ?? 0 ?></div>
            </div>
          </div>
          <div class="stat-card">
            <div class="stat-ic amber"><svg viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" />
                <polyline points="12 6 12 12 16 14" />
              </svg></div>
            <div>
              <div class="stat-label">Pending</div>
              <div class="stat-val"><?= $totalPending ?? 0 ?></div>
            </div>
          </div>
          <div class="stat-card">
            <div class="stat-ic green"><svg viewBox="0 0 24 24">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                <polyline points="22 4 12 14.01 9 11.01" />
              </svg></div>
            <div>
              <div class="stat-label">Disetujui</div>
              <div class="stat-val"><?= $totalApproved ?? 0 ?></div>
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
              <div class="stat-val"><?= $totalRejected ?? 0 ?></div>
            </div>
          </div>
        </div>

        <!-- elemen PHP asli (disembunyikan, sudah di-replace di atas) -->
        <div style="display:flex; gap:15px; margin-bottom:20px;">
          <div><strong>Total Jurnal</strong><br><?= $totalJurnal ?></div>
          <div><strong>Pending</strong><br><?= $totalPending ?></div>
          <div><strong>Disetujui</strong><br><?= $totalApproved ?></div>
          <div><strong>Ditolak</strong><br><?= $totalRejected ?></div>
        </div>
        <hr>
        <a href="<?= base_url('journal/create') ?>" class="raw-link">➕ Tambah Jurnal</a>
        <br><br>

        <!-- TABLE WRAPPER — menggantikan table PHP (yang tetap ada di bawah) -->
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

                    <!-- AKSI — href asli dari PHP dipertahankan -->
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

        <!-- TABLE ASLI dari PHP (disembunyikan) -->
        <table border="1" cellpadding="8" cellspacing="0" style="display:none">
          <tr>
            <th>Tanggal</th>
            <th>Deskripsi</th>
            <th>Status</th>
            <th>Catatan Mentor</th>
            <th>Aksi</th>
          </tr>
          <?php if (!empty($journals)): ?>
            <?php foreach ($journals as $j): ?>
              <tr>
                <td><?= esc($j['tanggal']) ?></td>
                <td><?= esc($j['deskripsi']) ?></td>
                <td>
                  <?php if ($j['status'] === 'approved'): ?>
                    <span style="color:green;font-weight:bold;">✔ Disetujui</span>
                  <?php elseif ($j['status'] === 'rejected'): ?>
                    <span style="color:red;font-weight:bold;">❌ Ditolak</span>
                  <?php else: ?>
                    <span style="color:orange;">⏳ Menunggu</span>
                  <?php endif ?>
                </td>
                <td><?= !empty($j['mentor_note']) ? esc($j['mentor_note']) : '-' ?></td>
                <td>
                  <?php if ($j['status'] === 'pending'): ?>
                    <a href="<?= base_url('journal/edit/' . $j['id']) ?>">✏️ Edit</a>
                    <a href="<?= base_url('journal/delete/' . $j['id']) ?>" onclick="return confirm('Yakin hapus jurnal ini?')">🗑️ Hapus</a>
                  <?php else: ?>
                    <span style="color:gray;">-</span>
                  <?php endif ?>
                </td>
              </tr>
            <?php endforeach ?>
          <?php else: ?>
            <tr>
              <td colspan="5" style="text-align:center;">Belum ada jurnal.</td>
            </tr>
          <?php endif ?>
        </table>

        <!-- Bottom actions — href asli dari PHP dipertahankan -->
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

        <!-- link bawaan PHP asli (disembunyikan) -->
        <br>
        <a href="<?= base_url('journal/download/pdf') ?>" class="raw-link">📄 Download Jurnal (PDF)</a>
        <br><br>
        <a href="<?= base_url('dashboard') ?>" class="raw-link">⬅️ Kembali ke Dashboard</a>

        <!-- ============================================= -->

      </div>
    </main>
  </div>

</body>

</html>