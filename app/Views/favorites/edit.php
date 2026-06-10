<div class="admin-page admin-form-page">
    <header class="admin-page-header">
        <div><a class="admin-back" href="<?= base_url('favorites') ?>"><i class="bi bi-arrow-left"></i> Kembali ke favorit</a><h1>Edit <?= esc($favorite['nama_negara']) ?></h1><p>Perbarui progres perjalanan dan catatan untuk negara ini.</p></div>
    </header>
    <form class="admin-form-layout" action="<?= base_url('favorites/update/' . $favorite['id']) ?>" method="post">
        <?= csrf_field() ?>
        <section class="admin-surface admin-form-card">
            <div class="admin-card-heading"><span><i class="bi bi-flag"></i></span><div><h2><?= esc($favorite['nama_negara']) ?></h2><p><?= esc($favorite['region'] ?? 'Region tidak tersedia') ?><?= ! empty($favorite['capital']) ? ' · ' . esc($favorite['capital']) : '' ?></p></div></div>
            <div class="admin-form-grid">
                <div class="admin-field"><label>Status perjalanan <b>*</b></label><select name="status_wishlist" class="form-select" required><?php foreach (['Wishlist', 'Want to Go', 'Planning', 'Visited'] as $status): ?><option value="<?= $status ?>" <?= $favorite['status_wishlist'] === $status ? 'selected' : '' ?>><?= $status ?></option><?php endforeach ?></select></div>
                <div class="admin-field"><label>Tanggal ditambahkan</label><input name="tanggal_ditambahkan" type="date" class="form-control" value="<?= esc($favorite['tanggal_ditambahkan'] ?? '') ?>"></div>
                <div class="admin-field full"><label>Catatan pribadi</label><textarea name="catatan" class="form-control" rows="6" placeholder="Tambahkan catatan perjalanan..."><?= esc($favorite['catatan'] ?? '') ?></textarea></div>
            </div>
        </section>
        <div class="admin-form-footer"><a class="admin-btn admin-btn-light" href="<?= base_url('favorites') ?>">Batal</a><button class="admin-btn admin-btn-primary" type="submit"><i class="bi bi-check2"></i> Simpan perubahan</button></div>
    </form>
</div>
