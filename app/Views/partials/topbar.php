<?php
$pageInfo = [
    'dashboard' => ['Dashboard', 'Statistik dan ringkasan data negara'],
    'countries' => ['Daftar Negara', 'Jelajahi data negara dari seluruh dunia'],
    'managed_countries' => ['Kelola Negara', 'Tambah, edit, dan hapus negara lokal'],
    'favorites' => ['Favorit Negara', 'Kelola daftar negara favorit Anda'],
    'api_countries' => ['API Negara', 'Konfigurasi sumber data negara'],
    'about' => ['Tentang WorldInfo', 'Informasi platform dan teknologi'],
];
[$heading, $subtitle] = $pageInfo[$active_menu ?? ''] ?? ['WorldInfo', 'Country Information Platform'];
?>
<header class="topbar wi-topbar" id="topbar">
    <div class="wi-topbar-left">
        <button class="wi-icon-button sidebar-toggle" id="sidebarToggle" type="button" aria-label="Tutup sidebar" aria-expanded="true" title="Tutup sidebar">
            <i class="bi bi-list"></i>
        </button>
        <div><strong><?= esc($heading) ?></strong><small><?= esc($subtitle) ?></small></div>
    </div>
    <div class="wi-topbar-actions">
        <span class="admin-date d-none d-md-inline"><?= date('d M Y') ?></span>
        <div class="dropdown">
            <button class="wi-user-button" data-bs-toggle="dropdown" type="button">
                <span class="wi-user-avatar"><?= esc(strtoupper(substr(session()->get('user_name') ?? 'A', 0, 1))) ?></span>
                <span class="admin-user-copy"><strong><?= esc(session()->get('user_name') ?? 'Admin') ?></strong><small>Administrator</small></span>
                <i class="bi bi-chevron-down admin-user-chevron"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                <li><span class="dropdown-item-text"><strong><?= esc(session()->get('user_name') ?? 'Admin') ?></strong><small class="d-block text-muted">Administrator</small></span></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="<?= base_url('logout') ?>"><i class="bi bi-box-arrow-right me-2"></i>Keluar</a></li>
            </ul>
        </div>
    </div>
</header>
