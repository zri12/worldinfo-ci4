<?php
$items = [
    ['dashboard', 'dashboard', 'bi-house-door', 'Dashboard', 'Ringkasan data'],
    ['admin/countries', 'countries', 'bi-globe-americas', 'Daftar Negara', '250+ negara'],
    ['admin/managed-countries', 'managed_countries', 'bi-pencil-square', 'Kelola Negara', 'CRUD database'],
    ['favorites', 'favorites', 'bi-heart', 'Favorit Negara', 'Koleksi Anda'],
    ['api-settings/countries', 'api_countries', 'bi-database', 'API Negara', 'REST Countries'],
];
?>
<aside class="sidebar wi-sidebar" id="sidebar">
    <div class="wi-sidebar-glow wi-sidebar-glow-a"></div>
    <div class="wi-sidebar-glow wi-sidebar-glow-b"></div>
    <a href="<?= base_url('dashboard') ?>" class="wi-sidebar-brand" title="WorldInfo Dashboard">
        <span class="wi-brand-mark"><i class="bi bi-globe2"></i></span>
        <span class="wi-brand-copy"><strong>WorldInfo</strong><small>Admin Panel</small></span>
    </a>
    <div class="wi-sidebar-rule"></div>
    <p class="wi-sidebar-label">Menu Utama</p>
    <nav class="wi-sidebar-nav">
        <?php foreach ($items as [$path, $key, $icon, $label, $desc]): ?>
            <a href="<?= base_url($path) ?>" class="<?= ($active_menu ?? '') === $key ? 'active' : '' ?>" title="<?= esc($label) ?>">
                <span class="wi-menu-icon"><i class="bi <?= $icon ?>"></i></span>
                <span class="wi-menu-copy"><strong><?= $label ?></strong><small><?= $desc ?></small></span>
            </a>
        <?php endforeach ?>
    </nav>
    <div class="wi-sidebar-bottom">
        <div class="wi-api-chip" title="API Connected - REST Countries v3.1">
            <span class="wi-api-status"><i></i><b>API Connected</b></span>
            <i class="bi bi-wifi wi-api-wifi"></i>
            <small>REST Countries v3.1</small>
        </div>
        <a href="<?= base_url('logout') ?>" class="wi-logout" title="Keluar">
            <span class="wi-menu-icon"><i class="bi bi-box-arrow-right"></i></span>
            <span class="wi-menu-copy"><strong>Keluar</strong><small>Akhiri sesi admin</small></span>
        </a>
    </div>
</aside>
