<?php
$query = $query ?? '';
$selectedRegion = $selected_region ?? '';
$totalCountries = $total_countries ?? 0;
$totalFiltered = $total_filtered ?? 0;
$currentPage = $current_page ?? 1;
$totalPages = $total_pages ?? 1;

$buildUrl = static function (array $overrides = []) use ($query, $selectedRegion): string {
    $params = array_merge([
        'q'      => $query,
        'region' => $selectedRegion,
    ], $overrides);
    $params = array_filter($params, static fn ($value): bool => $value !== '' && $value !== null);

    return current_url() . ($params === [] ? '' : '?' . http_build_query($params));
};
?>

<div class="admin-page">
    <header class="admin-page-header">
        <div>
            <span class="admin-eyebrow">Direktori negara</span>
            <h1>Jelajahi dunia</h1>
            <p>
                <?php if ($query !== '' || $selectedRegion !== ''): ?>
                    Menampilkan <?= number_format($totalFiltered) ?> dari <?= number_format($totalCountries) ?> negara.
                <?php else: ?>
                    <?= number_format($totalCountries) ?> negara tersedia dari layanan data aktif.
                <?php endif ?>
            </p>
        </div>
        <a class="admin-btn admin-btn-light" href="<?= esc($buildUrl(['refresh' => 1, 'page' => null])) ?>">
            <i class="bi bi-arrow-clockwise"></i> Perbarui data
        </a>
    </header>

    <form class="admin-country-toolbar" method="get" action="<?= esc(current_url()) ?>">
        <div class="admin-search-box">
            <i class="bi bi-search"></i>
            <input
                name="q"
                type="search"
                value="<?= esc($query) ?>"
                placeholder="Cari negara berdasarkan nama..."
                autocomplete="off"
            >
        </div>
        <?php if ($selectedRegion !== ''): ?>
            <input type="hidden" name="region" value="<?= esc($selectedRegion) ?>">
        <?php endif ?>
        <button class="admin-btn admin-btn-primary admin-search-submit" type="submit">Cari</button>
    </form>

    <nav class="admin-filter-scroll admin-region-filter" aria-label="Filter wilayah">
        <a class="<?= $selectedRegion === '' ? 'active' : '' ?>" href="<?= esc($buildUrl(['region' => null, 'page' => null])) ?>">Semua</a>
        <?php foreach ($regions ?? [] as $region): ?>
            <a
                class="<?= $selectedRegion === $region ? 'active' : '' ?>"
                href="<?= esc($buildUrl(['region' => $region, 'page' => null])) ?>"
            ><?= esc($region) ?></a>
        <?php endforeach ?>
    </nav>

    <?php if (! empty($error)): ?>
        <div class="admin-inline-error">
            <i class="bi bi-exclamation-circle"></i>
            <div><strong>Data tidak dapat dimuat</strong><span><?= esc($error) ?></span></div>
        </div>
    <?php endif ?>

    <?php if (! empty($countries)): ?>
        <div class="admin-country-grid">
            <?php foreach ($countries as $country): ?>
                <?php
                $name = $country['name']['common'] ?? 'Tanpa nama';
                $region = $country['region'] ?? '-';
                $flag = $country['flags']['svg'] ?? $country['flags']['png'] ?? '';
                ?>
                <a class="admin-country-card" href="<?= base_url('countries/detail/' . rawurlencode($name)) ?>">
                    <div class="admin-country-image">
                        <img
                            src="<?= esc($flag) ?>"
                            alt="Bendera <?= esc($name) ?>"
                            loading="lazy"
                            decoding="async"
                        >
                        <span><?= esc($region) ?></span>
                    </div>
                    <div class="admin-country-content">
                        <div>
                            <h2><?= esc($name) ?></h2>
                            <p><?= esc($country['name']['official'] ?? '') ?></p>
                        </div>
                        <dl>
                            <div><dt>Ibu kota</dt><dd><?= esc(implode(', ', $country['capital'] ?? ['-'])) ?></dd></div>
                            <div><dt>Populasi</dt><dd><?= number_format($country['population'] ?? 0) ?></dd></div>
                        </dl>
                        <span class="admin-card-link">Lihat informasi <i class="bi bi-arrow-up-right"></i></span>
                    </div>
                </a>
            <?php endforeach ?>
        </div>
    <?php elseif (empty($error)): ?>
        <div class="admin-empty admin-country-empty">
            <span><i class="bi bi-search"></i></span>
            <div>
                <h3>Negara tidak ditemukan</h3>
                <p>Coba kata kunci atau wilayah yang berbeda.</p>
            </div>
            <a class="admin-btn admin-btn-light" href="<?= esc(current_url()) ?>">Hapus filter</a>
        </div>
    <?php endif ?>

    <?php if ($totalPages > 1): ?>
        <?php
        $startPage = max(1, $currentPage - 2);
        $endPage = min($totalPages, $currentPage + 2);
        ?>
        <nav class="admin-pagination" aria-label="Navigasi halaman negara">
            <span>Halaman <?= number_format($currentPage) ?> dari <?= number_format($totalPages) ?></span>
            <div>
                <?php if ($currentPage > 1): ?>
                    <a href="<?= esc($buildUrl(['page' => $currentPage - 1])) ?>" aria-label="Halaman sebelumnya">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                <?php endif ?>

                <?php for ($page = $startPage; $page <= $endPage; $page++): ?>
                    <a
                        class="<?= $page === $currentPage ? 'active' : '' ?>"
                        href="<?= esc($buildUrl(['page' => $page])) ?>"
                    ><?= $page ?></a>
                <?php endfor ?>

                <?php if ($currentPage < $totalPages): ?>
                    <a href="<?= esc($buildUrl(['page' => $currentPage + 1])) ?>" aria-label="Halaman berikutnya">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                <?php endif ?>
            </div>
        </nav>
    <?php endif ?>
</div>
