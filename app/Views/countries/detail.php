<div class="wi-page wi-detail-page">
    <div class="d-flex justify-content-between align-items-center">
        <a class="wi-refresh" href="<?= base_url('countries') ?>"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>
    <?php if (! empty($error) || empty($country)): ?>
        <div class="wi-empty"><i class="bi bi-globe"></i><h3>Negara Tidak Ditemukan</h3><p><?= esc($error ?? 'Data negara tidak tersedia.') ?></p></div>
    <?php else:
        $name = $country['name']['common'] ?? '-';
        $official = $country['name']['official'] ?? '-';
        $region = $country['region'] ?? '-';
        $languages = array_values($country['languages'] ?? []);
        $currencies = $country['currencies'] ?? [];
    ?>
        <section class="wi-detail-banner" style="--flag:url('<?= esc($country['flags']['svg'] ?? $country['flags']['png'] ?? '') ?>')">
            <div><h1><?= esc($name) ?></h1><span class="wi-region <?= strtolower($region) ?>"><?= esc($region) ?></span></div>
        </section>
        <div class="wi-detail-grid">
            <aside>
                <div class="wi-detail-flag"><img src="<?= esc($country['flags']['svg'] ?? $country['flags']['png'] ?? '') ?>" alt="Bendera <?= esc($name) ?>"></div>
                <div class="wi-mini-grid">
                    <article><i class="bi bi-geo-alt"></i><small>Ibu Kota</small><strong><?= esc(implode(', ', $country['capital'] ?? ['-'])) ?></strong></article>
                    <article><i class="bi bi-people"></i><small>Populasi</small><strong><?= number_format($country['population'] ?? 0) ?></strong></article>
                    <article><i class="bi bi-globe"></i><small>Region</small><strong><?= esc($region) ?></strong></article>
                    <article><i class="bi bi-hash"></i><small>Kode</small><strong><?= esc($country['cca3'] ?? '-') ?></strong></article>
                </div>
                <a class="wi-map-button" target="_blank" href="<?= esc($country['maps']['googleMaps'] ?? '#') ?>"><i class="bi bi-box-arrow-up-right"></i> Lihat di Google Maps</a>
            </aside>
            <section class="wi-detail-info">
                <article><h2><?= esc($name) ?></h2><p><?= esc($official) ?></p><small>Sub-region: <?= esc($country['subregion'] ?? '-') ?></small><?php if (! empty($country['description'])): ?><p class="mt-3"><?= esc($country['description']) ?></p><?php endif ?></article>
                <article><h3><i class="bi bi-translate"></i> Bahasa</h3><div class="wi-tags"><?php foreach ($languages as $language): ?><span><?= esc($language) ?></span><?php endforeach ?></div></article>
                <article><h3><i class="bi bi-currency-dollar"></i> Mata Uang</h3><div class="wi-tags accent"><?php foreach ($currencies as $currency): ?><span><?= esc(($currency['name'] ?? '') . ' (' . ($currency['symbol'] ?? '-') . ')') ?></span><?php endforeach ?></div></article>
                <article><h3><i class="bi bi-clock"></i> Zona Waktu</h3><div class="wi-tags"><?php foreach ($country['timezones'] ?? [] as $timezone): ?><span><?= esc($timezone) ?></span><?php endforeach ?></div></article>
            </section>
        </div>
    <?php endif ?>
</div>
