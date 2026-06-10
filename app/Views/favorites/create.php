<div class="admin-page admin-form-page">
    <header class="admin-page-header">
        <div><a class="admin-back" href="<?= base_url('favorites') ?>"><i class="bi bi-arrow-left"></i> Kembali ke favorit</a><h1>Tambah negara favorit</h1><p>Catat negara yang ingin dikunjungi atau sudah pernah Anda datangi.</p></div>
    </header>
    <form class="admin-form-layout" action="<?= base_url('favorites/store') ?>" method="post">
        <?= csrf_field() ?>
        <section class="admin-surface admin-form-card">
            <div class="admin-card-heading"><span>01</span><div><h2>Informasi negara</h2><p>Isi informasi dasar negara yang akan disimpan.</p></div></div>
            <div class="admin-form-grid">
                <div class="admin-field"><label>Nama negara <b>*</b></label><input name="nama_negara" class="form-control" placeholder="Contoh: Indonesia" required></div>
                <div class="admin-field"><label>Nama resmi</label><input name="official_name" class="form-control" placeholder="Republic of Indonesia"></div>
                <div class="admin-field"><label>Region</label><input name="region" class="form-control" placeholder="Asia"></div>
                <div class="admin-field"><label>Ibu kota</label><input name="capital" class="form-control" placeholder="Jakarta"></div>
            </div>
        </section>
        <section class="admin-surface admin-form-card">
            <div class="admin-card-heading"><span>02</span><div><h2>Rencana perjalanan</h2><p>Tentukan status dan tambahkan catatan pribadi.</p></div></div>
            <div class="admin-form-grid">
                <div class="admin-field"><label>Status <b>*</b></label><select name="status_wishlist" class="form-select" required><option>Wishlist</option><option>Want to Go</option><option>Planning</option><option>Visited</option></select></div>
                <div class="admin-field full"><label>Catatan</label><textarea name="catatan" class="form-control" rows="5" placeholder="Tuliskan alasan, rencana, atau hal menarik tentang negara ini..."></textarea></div>
            </div>
        </section>
        <div class="admin-form-footer"><a class="admin-btn admin-btn-light" href="<?= base_url('favorites') ?>">Batal</a><button class="admin-btn admin-btn-primary" type="submit"><i class="bi bi-check2"></i> Simpan favorit</button></div>
    </form>
</div>
