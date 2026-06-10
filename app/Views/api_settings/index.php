<?php
$current = null;
foreach ($api_settings ?? [] as $setting) {
    if (($setting['status'] ?? '') === 'Aktif') {
        $current = $setting;
        break;
    }
}
$current ??= $api_settings[0] ?? null;
$formAction = $current
    ? base_url('api-settings/update/' . $current['id'])
    : base_url('api-settings/store');
?>
<div class="admin-page">
    <header class="admin-page-header">
        <div>
            <span class="admin-eyebrow">Integrasi data dunia</span>
            <h1>API Negara</h1>
            <p>Kelola endpoint REST Countries untuk informasi negara.</p>
        </div>
        <span class="admin-connection <?= $current && $current['status'] === 'Aktif' ? 'online' : 'offline' ?>">
            <i></i><?= $current && $current['status'] === 'Aktif' ? 'Layanan aktif' : 'Belum aktif' ?>
        </span>
    </header>

    <div class="admin-api-layout">
        <section class="admin-surface admin-api-form">
            <div class="admin-section-head">
                <div><h2><?= $current ? 'Edit koneksi aktif' : 'Tambah koneksi' ?></h2><p>Uji endpoint sebelum menyimpan.</p></div>
            </div>
            <form action="<?= $formAction ?>" method="post">
                <?= csrf_field() ?>
                <div class="admin-field">
                    <label>Nama layanan <b>*</b></label>
                    <input name="nama_api" class="form-control" value="<?= esc($current['nama_api'] ?? '') ?>" placeholder="Contoh: REST Countries API" required>
                </div>
                <div class="admin-field">
                    <label>Endpoint JSON <b>*</b></label>
                    <input id="newApiUrl" name="base_url" type="url" class="form-control" value="<?= esc($current['base_url'] ?? '') ?>" placeholder="https://restcountries.com/v3.1/all" required>
                </div>
                <div class="admin-form-grid compact">
                    <div class="admin-field">
                        <label>Method</label>
                        <input class="form-control" value="GET" readonly><input type="hidden" name="method" value="GET">
                    </div>
                    <div class="admin-field">
                        <label>Status</label>
                        <select name="status" class="form-select">
                            <option value="Aktif" <?= ($current['status'] ?? 'Aktif') === 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                            <option value="Tidak Aktif" <?= ($current['status'] ?? '') === 'Tidak Aktif' ? 'selected' : '' ?>>Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="admin-form-grid">
                    <div class="admin-field"><label>Nama header API key <span>opsional</span></label><input id="newAuthHeader" name="auth_header" class="form-control" value="<?= esc($current['auth_header'] ?? '') ?>"></div>
                    <div class="admin-field"><label>API key <span>opsional</span></label><input id="newApiKey" name="api_key" type="password" class="form-control" placeholder="<?= ! empty($current['api_key']) ? 'Isi ulang hanya jika ingin mengganti' : 'Masukkan token API' ?>"></div>
                </div>
                <p class="admin-form-note">REST Countries tidak membutuhkan API key. Endpoint harus merespons array JSON negara.</p>
                <div id="apiResult_form"></div>
                <div class="admin-form-footer inline">
                    <button type="button" class="admin-btn admin-btn-light" onclick="testApiConnection(document.getElementById('newApiUrl').value, 'form')"><i class="bi bi-activity"></i> Uji koneksi</button>
                    <button class="admin-btn admin-btn-primary" type="submit"><?= $current ? 'Simpan perubahan' : 'Simpan koneksi' ?></button>
                </div>
            </form>
        </section>

        <aside class="admin-surface admin-api-summary">
            <div class="admin-section-head"><div><h2>Status layanan</h2><p>Konfigurasi yang digunakan aplikasi.</p></div></div>
            <div class="admin-api-current">
                <span class="admin-metric-icon <?= $current ? 'green' : '' ?>"><i class="bi bi-globe2"></i></span>
                <div><small>Data Negara</small><strong><?= esc($current['nama_api'] ?? 'Belum tersedia') ?></strong></div>
            </div>
            <dl>
                <div><dt>Status</dt><dd><?= esc($current['status'] ?? '-') ?></dd></div>
                <div><dt>Terakhir sinkron</dt><dd><?= ! empty($current['last_sync']) ? date('d M Y, H:i', strtotime($current['last_sync'])) : 'Belum pernah' ?></dd></div>
                <div><dt>Endpoint</dt><dd class="endpoint-value"><?= esc($current['base_url'] ?? '-') ?></dd></div>
            </dl>
            <?php if ($current): ?>
                <form action="<?= base_url('api-settings/sync') ?>" method="post" class="mt-3">
                    <?= csrf_field() ?><input type="hidden" name="id" value="<?= $current['id'] ?>">
                    <button class="admin-btn admin-btn-light w-100" type="submit"><i class="bi bi-arrow-repeat"></i> Sinkronkan sekarang</button>
                </form>
            <?php endif ?>
        </aside>
    </div>
</div>
