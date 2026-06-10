<?php
$connected = ($api_status ?? '') === 'Connected';
$userName = session()->get('user_name') ?? 'Administrator';
?>
<div class="admin-page">
    <header class="admin-page-header dashboard-heading">
        <div>
            <span class="admin-eyebrow"><?= date('l, d F Y') ?></span>
            <h1>Selamat datang, <?= esc($userName) ?></h1>
            <p>Pantau data negara, koleksi favorit, dan koneksi layanan dari satu tempat.</p>
        </div>
        <a class="admin-btn admin-btn-primary" href="<?= base_url('admin/countries') ?>">
            <i class="bi bi-globe-americas"></i> Jelajahi negara
        </a>
    </header>

    <section class="admin-metrics">
        <article class="admin-metric">
            <span class="admin-metric-icon blue"><i class="bi bi-globe2"></i></span>
            <div><small>Negara tersedia</small><strong><?= number_format($total_countries ?? 0) ?></strong><p>Data dari layanan aktif</p></div>
        </article>
        <article class="admin-metric">
            <span class="admin-metric-icon amber"><i class="bi bi-map"></i></span>
            <div><small>Wilayah dunia</small><strong>6</strong><p>Region yang dapat difilter</p></div>
        </article>
        <article class="admin-metric">
            <span class="admin-metric-icon rose"><i class="bi bi-heart"></i></span>
            <div><small>Koleksi favorit</small><strong><?= number_format($total_favorites ?? 0) ?></strong><p>Negara dalam wishlist</p></div>
        </article>
        <article class="admin-metric">
            <span class="admin-metric-icon <?= $connected ? 'green' : 'red' ?>"><i class="bi <?= $connected ? 'bi-check2' : 'bi-exclamation-lg' ?>"></i></span>
            <div><small>Koneksi API</small><strong class="metric-status"><?= $connected ? 'Terhubung' : 'Bermasalah' ?></strong><p><?= esc($api_setting['nama_api'] ?? 'Belum dikonfigurasi') ?></p></div>
        </article>
    </section>

    <div class="admin-dashboard-grid">
        <section class="admin-surface recent-panel">
            <div class="admin-section-head">
                <div><h2>Favorit terbaru</h2><p>Negara yang terakhir masuk ke koleksi Anda.</p></div>
                <a href="<?= base_url('favorites') ?>">Kelola favorit <i class="bi bi-arrow-right"></i></a>
            </div>
            <?php if (empty($recent_favorites)): ?>
                <div class="admin-empty compact">
                    <span><i class="bi bi-heart"></i></span>
                    <div><h3>Koleksi masih kosong</h3><p>Tambahkan negara yang ingin Anda kunjungi.</p></div>
                    <a class="admin-btn admin-btn-light" href="<?= base_url('favorites/create') ?>">Tambah favorit</a>
                </div>
            <?php else: ?>
                <div class="admin-recent-list">
                    <?php foreach ($recent_favorites as $favorite): ?>
                        <div class="admin-recent-row">
                            <span class="admin-country-initial"><?= esc(strtoupper(substr($favorite['nama_negara'], 0, 2))) ?></span>
                            <div><strong><?= esc($favorite['nama_negara']) ?></strong><small><?= esc($favorite['region'] ?? 'Region tidak tersedia') ?></small></div>
                            <span class="admin-status-pill"><?= esc($favorite['status_wishlist']) ?></span>
                        </div>
                    <?php endforeach ?>
                </div>
            <?php endif ?>
        </section>

        <aside class="admin-surface admin-shortcuts">
            <div class="admin-section-head"><div><h2>Pintasan</h2><p>Akses pekerjaan yang paling sering digunakan.</p></div></div>
            <a href="<?= base_url('admin/countries') ?>"><span><i class="bi bi-search"></i></span><div><strong>Cari negara</strong><small>Telusuri data seluruh dunia</small></div><i class="bi bi-chevron-right"></i></a>
            <a href="<?= base_url('admin/managed-countries') ?>"><span><i class="bi bi-pencil-square"></i></span><div><strong>Kelola negara</strong><small>Tambah, edit, dan hapus data lokal</small></div><i class="bi bi-chevron-right"></i></a>
            <a href="<?= base_url('favorites/create') ?>"><span><i class="bi bi-plus-lg"></i></span><div><strong>Tambah favorit</strong><small>Buat entri wishlist baru</small></div><i class="bi bi-chevron-right"></i></a>
            <a href="<?= base_url('api-settings/countries') ?>"><span><i class="bi bi-database"></i></span><div><strong>API negara</strong><small>Kelola REST Countries</small></div><i class="bi bi-chevron-right"></i></a>
        </aside>
    </div>
</div>
