<div class="admin-page">
    <header class="admin-page-header">
        <div><span class="admin-eyebrow">Koleksi pribadi</span><h1>Negara favorit</h1><p>Simpan ide perjalanan dan pantau negara yang ingin dikunjungi.</p></div>
        <a href="<?= base_url('favorites/create') ?>" class="admin-btn admin-btn-primary"><i class="bi bi-plus-lg"></i> Tambah negara</a>
    </header>
    <section class="admin-surface admin-data-panel">
        <div class="admin-data-toolbar">
            <div class="admin-search-box"><i class="bi bi-search"></i><input id="favSearch" type="search" placeholder="Cari nama negara..."></div>
            <select id="statusFilter" class="form-select admin-filter-select"><option value="">Semua status</option><option>Wishlist</option><option>Want to Go</option><option>Planning</option><option>Visited</option></select>
            <span class="admin-result-count"><?= count($favorites ?? []) ?> item</span>
        </div>
        <?php if (empty($favorites)): ?>
            <div id="favEmptyState" class="admin-empty">
                <span><i class="bi bi-bookmark"></i></span><div><h3>Belum ada negara tersimpan</h3><p>Mulai buat daftar tujuan perjalanan Anda.</p></div><a class="admin-btn admin-btn-primary" href="<?= base_url('favorites/create') ?>">Tambah negara</a>
            </div>
        <?php else: ?>
            <div class="table-responsive admin-table-wrap"><table class="table admin-table align-middle mb-0">
                <thead><tr><th>Negara</th><th>Region</th><th>Ibu kota</th><th>Status</th><th>Catatan</th><th>Ditambahkan</th><th></th></tr></thead>
                <tbody id="favTableBody"><?php foreach ($favorites as $favorite): ?><tr data-name="<?= esc(strtolower($favorite['nama_negara'])) ?>" data-status="<?= esc(strtolower($favorite['status_wishlist'])) ?>">
                    <td><div class="admin-country-cell"><?php if (! empty($favorite['flag'])): ?><img src="<?= esc($favorite['flag']) ?>" alt=""><?php else: ?><span><?= esc(strtoupper(substr($favorite['nama_negara'], 0, 2))) ?></span><?php endif ?><div><strong><?= esc($favorite['nama_negara']) ?></strong><small><?= esc($favorite['official_name'] ?? '') ?></small></div></div></td>
                    <td><?= esc($favorite['region'] ?? '-') ?></td><td><?= esc($favorite['capital'] ?? '-') ?></td>
                    <td><span class="admin-status-pill"><?= esc($favorite['status_wishlist']) ?></span></td>
                    <td class="admin-note"><?= esc($favorite['catatan'] ?: '-') ?></td><td><?= esc($favorite['tanggal_ditambahkan'] ?? '-') ?></td>
                    <td><div class="admin-row-actions"><a href="<?= base_url('favorites/edit/' . $favorite['id']) ?>" title="Edit"><i class="bi bi-pencil"></i></a><button data-delete-url="<?= base_url('favorites/delete/' . $favorite['id']) ?>" data-country-name="<?= esc($favorite['nama_negara']) ?>" title="Hapus"><i class="bi bi-trash"></i></button></div></td>
                </tr><?php endforeach ?></tbody>
            </table></div>
        <?php endif ?>
    </section>
</div>
