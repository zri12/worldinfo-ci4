<div class="admin-page">
    <header class="admin-page-header">
        <div>
            <span class="admin-eyebrow">CRUD database</span>
            <h1>Kelola negara</h1>
            <p>Tambah dan kelola negara lokal yang akan ditampilkan bersama data API.</p>
        </div>
        <a href="<?= base_url('admin/managed-countries/create') ?>" class="admin-btn admin-btn-primary"><i class="bi bi-plus-lg"></i> Tambah negara</a>
    </header>

    <section class="admin-surface admin-data-panel">
        <form class="admin-data-toolbar" method="get" action="<?= current_url() ?>">
            <div class="admin-search-box"><i class="bi bi-search"></i><input name="q" type="search" value="<?= esc($query ?? '') ?>" placeholder="Cari negara atau kode..."></div>
            <button class="admin-btn admin-btn-light" type="submit">Cari</button>
            <span class="admin-result-count"><?= count($countries ?? []) ?> item</span>
        </form>

        <?php if (empty($countries)): ?>
            <div class="admin-empty">
                <span><i class="bi bi-database-add"></i></span>
                <div><h3>Belum ada negara lokal</h3><p>Tambahkan negara pertama untuk mencoba sistem CRUD.</p></div>
                <a class="admin-btn admin-btn-primary" href="<?= base_url('admin/managed-countries/create') ?>">Tambah negara</a>
            </div>
        <?php else: ?>
            <div class="table-responsive admin-table-wrap">
                <table class="table admin-table align-middle mb-0">
                    <thead><tr><th>Negara</th><th>Kode</th><th>Region</th><th>Ibu kota</th><th>Populasi</th><th>Status</th><th></th></tr></thead>
                    <tbody>
                    <?php foreach ($countries as $country): ?>
                        <tr>
                            <td>
                                <div class="admin-country-cell">
                                    <?php if ($country['flag_url']): ?><img src="<?= esc($country['flag_url']) ?>" alt=""><?php else: ?><span><?= esc(strtoupper(substr($country['name'], 0, 2))) ?></span><?php endif ?>
                                    <div><strong><?= esc($country['name']) ?></strong><small><?= esc($country['official_name'] ?: 'Data lokal') ?></small></div>
                                </div>
                            </td>
                            <td><code><?= esc($country['code'] ?: '-') ?></code></td>
                            <td><?= esc($country['region'] ?: '-') ?></td>
                            <td><?= esc($country['capital'] ?: '-') ?></td>
                            <td><?= number_format((int) $country['population']) ?></td>
                            <td><span class="admin-status-pill"><?= $country['is_published'] ? 'Tayang' : 'Draft' ?></span></td>
                            <td>
                                <div class="admin-row-actions">
                                    <a href="<?= base_url('admin/managed-countries/edit/' . $country['id']) ?>" title="Edit"><i class="bi bi-pencil"></i></a>
                                    <form method="post" action="<?= base_url('admin/managed-countries/delete/' . $country['id']) ?>" onsubmit="return confirm('Hapus negara <?= esc($country['name'], 'js') ?>?')">
                                        <?= csrf_field() ?><button class="danger" type="submit" title="Hapus"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        <?php endif ?>
    </section>
</div>
