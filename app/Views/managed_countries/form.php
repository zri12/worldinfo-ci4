<?php $editing = ! empty($country); ?>
<div class="admin-page admin-form-page">
    <header class="admin-page-header">
        <div>
            <a class="admin-back" href="<?= base_url('admin/managed-countries') ?>"><i class="bi bi-arrow-left"></i> Kembali ke kelola negara</a>
            <h1><?= $editing ? 'Edit negara' : 'Tambah negara' ?></h1>
            <p><?= $editing ? 'Perbarui informasi negara lokal.' : 'Masukkan informasi negara yang ingin ditambahkan.' ?></p>
        </div>
    </header>

    <form class="admin-form-layout" action="<?= esc($action) ?>" method="post">
        <?= csrf_field() ?>
        <section class="admin-surface admin-form-card">
            <div class="admin-card-heading"><span>01</span><div><h2>Identitas negara</h2><p>Nama, kode, bendera, dan lokasi utama.</p></div></div>
            <div class="admin-form-grid">
                <div class="admin-field"><label>Nama negara <b>*</b></label><input name="name" class="form-control" value="<?= old('name', $country['name'] ?? '') ?>" required></div>
                <div class="admin-field"><label>Nama resmi</label><input name="official_name" class="form-control" value="<?= old('official_name', $country['official_name'] ?? '') ?>"></div>
                <div class="admin-field"><label>Kode negara</label><input name="code" class="form-control text-uppercase" maxlength="3" value="<?= old('code', $country['code'] ?? '') ?>" placeholder="IDN"></div>
                <div class="admin-field"><label>URL bendera</label><input name="flag_url" type="url" class="form-control" value="<?= old('flag_url', $country['flag_url'] ?? '') ?>" placeholder="https://flagcdn.com/id.svg"></div>
                <div class="admin-field"><label>Region</label><input name="region" class="form-control" value="<?= old('region', $country['region'] ?? '') ?>" placeholder="Asia"></div>
                <div class="admin-field"><label>Subregion</label><input name="subregion" class="form-control" value="<?= old('subregion', $country['subregion'] ?? '') ?>" placeholder="South-Eastern Asia"></div>
                <div class="admin-field"><label>Ibu kota</label><input name="capital" class="form-control" value="<?= old('capital', $country['capital'] ?? '') ?>"></div>
                <div class="admin-field"><label>Populasi</label><input name="population" type="number" min="0" class="form-control" value="<?= old('population', $country['population'] ?? 0) ?>"></div>
            </div>
        </section>

        <section class="admin-surface admin-form-card">
            <div class="admin-card-heading"><span>02</span><div><h2>Informasi tambahan</h2><p>Pisahkan beberapa nilai dengan tanda koma.</p></div></div>
            <div class="admin-form-grid">
                <div class="admin-field"><label>Bahasa</label><input name="languages" class="form-control" value="<?= old('languages', $country['languages'] ?? '') ?>" placeholder="Indonesia, English"></div>
                <div class="admin-field"><label>Mata uang</label><input name="currencies" class="form-control" value="<?= old('currencies', $country['currencies'] ?? '') ?>" placeholder="Indonesian rupiah"></div>
                <div class="admin-field"><label>Zona waktu</label><input name="timezones" class="form-control" value="<?= old('timezones', $country['timezones'] ?? '') ?>" placeholder="UTC+07:00, UTC+08:00"></div>
                <div class="admin-field"><label>Google Maps</label><input name="maps_url" type="url" class="form-control" value="<?= old('maps_url', $country['maps_url'] ?? '') ?>"></div>
                <div class="admin-field full"><label>Deskripsi</label><textarea name="description" class="form-control" rows="5"><?= old('description', $country['description'] ?? '') ?></textarea></div>
                <div class="admin-field"><label>Status publikasi</label><select name="is_published" class="form-select"><option value="1" <?= (string) old('is_published', $country['is_published'] ?? 1) === '1' ? 'selected' : '' ?>>Tayang</option><option value="0" <?= (string) old('is_published', $country['is_published'] ?? 1) === '0' ? 'selected' : '' ?>>Draft</option></select></div>
            </div>
        </section>

        <div class="admin-form-footer">
            <a class="admin-btn admin-btn-light" href="<?= base_url('admin/managed-countries') ?>">Batal</a>
            <button class="admin-btn admin-btn-primary" type="submit"><i class="bi bi-check2"></i> <?= $editing ? 'Simpan perubahan' : 'Tambah negara' ?></button>
        </div>
    </form>
</div>
