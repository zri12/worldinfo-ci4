<?php
$query = $query ?? '';
$selectedRegion = $selected_region ?? '';
$currentPage = $current_page ?? 1;
$totalPages = $total_pages ?? 1;
$buildUrl = static function (array $overrides = []) use ($query, $selectedRegion): string {
    $params = array_merge(['q' => $query, 'region' => $selectedRegion], $overrides);
    $params = array_filter($params, static fn ($value): bool => $value !== '' && $value !== null);

    return current_url() . ($params ? '?' . http_build_query($params) : '');
};
?>
<div class="public-countries-page wi-container">
    <section class="public-countries-hero">
        <span><i class="bi bi-globe-americas"></i> Direktori dunia</span>
        <h1>Temukan negara<br><em>dari seluruh dunia</em></h1>
        <p>Jelajahi profil, populasi, ibu kota, wilayah, dan informasi penting setiap negara.</p>
    </section>

    <section class="public-country-tools">
        <form method="get" action="<?= esc(current_url()) ?>">
            <div><i class="bi bi-search"></i><input name="q" type="search" value="<?= esc($query) ?>" placeholder="Cari nama negara..."></div>
            <?php if ($selectedRegion !== ''): ?><input type="hidden" name="region" value="<?= esc($selectedRegion) ?>"><?php endif ?>
            <button type="submit">Cari</button>
        </form>
        <nav>
            <a class="<?= $selectedRegion === '' ? 'active' : '' ?>" href="<?= esc($buildUrl(['region' => null, 'page' => null])) ?>">Semua</a>
            <?php foreach ($regions ?? [] as $region): ?>
                <a class="<?= $selectedRegion === $region ? 'active' : '' ?>" href="<?= esc($buildUrl(['region' => $region, 'page' => null])) ?>"><?= esc($region) ?></a>
            <?php endforeach ?>
        </nav>
    </section>

    <?php if (! empty($error)): ?>
        <div class="public-country-empty"><i class="bi bi-cloud-slash"></i><h2>Data belum tersedia</h2><p><?= esc($error) ?></p></div>
    <?php elseif (! empty($countries)): ?>
        <div class="public-country-results">
            <p>Menampilkan <?= number_format($total_filtered ?? 0) ?> negara</p>
            <div class="public-country-grid">
                <?php foreach ($countries as $country): ?>
                    <?php $name = $country['name']['common'] ?? 'Tanpa nama'; ?>
                    <a href="<?= base_url('countries/detail/' . rawurlencode($name)) ?>">
                        <div class="public-country-flag">
                            <img src="<?= esc($country['flags']['svg'] ?? $country['flags']['png'] ?? '') ?>" alt="Bendera <?= esc($name) ?>" loading="lazy" decoding="async">
                            <span><?= esc($country['region'] ?? '-') ?></span>
                        </div>
                        <div class="public-country-copy">
                            <h2><?= esc($name) ?></h2>
                            <p><?= esc($country['name']['official'] ?? '') ?></p>
                            <dl>
                                <div><dt>Ibu kota</dt><dd><?= esc(implode(', ', $country['capital'] ?? ['-'])) ?></dd></div>
                                <div><dt>Populasi</dt><dd><?= number_format($country['population'] ?? 0) ?></dd></div>
                            </dl>
                            <strong>Lihat detail <i class="bi bi-arrow-up-right"></i></strong>
                        </div>
                    </a>
                <?php endforeach ?>
            </div>
        </div>
    <?php else: ?>
        <div class="public-country-empty"><i class="bi bi-search"></i><h2>Negara tidak ditemukan</h2><p>Coba kata kunci atau wilayah lain.</p></div>
    <?php endif ?>

    <?php if ($totalPages > 1): ?>
        <nav class="public-country-pagination">
            <span>Halaman <?= $currentPage ?> dari <?= $totalPages ?></span>
            <div>
                <?php if ($currentPage > 1): ?><a href="<?= esc($buildUrl(['page' => $currentPage - 1])) ?>"><i class="bi bi-chevron-left"></i></a><?php endif ?>
                <?php for ($page = max(1, $currentPage - 2); $page <= min($totalPages, $currentPage + 2); $page++): ?>
                    <a class="<?= $page === $currentPage ? 'active' : '' ?>" href="<?= esc($buildUrl(['page' => $page])) ?>"><?= $page ?></a>
                <?php endfor ?>
                <?php if ($currentPage < $totalPages): ?><a href="<?= esc($buildUrl(['page' => $currentPage + 1])) ?>"><i class="bi bi-chevron-right"></i></a><?php endif ?>
            </div>
        </nav>
    <?php endif ?>
</div>
