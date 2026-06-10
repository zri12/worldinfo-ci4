<?php
$features = [
    ['bi-database', 'blue', '250+ Negara', 'Data lengkap dari seluruh penjuru dunia dalam satu platform'],
    ['bi-lightning-charge', 'violet', 'Real-time Data', 'Update langsung dari REST Countries API yang terpercaya'],
    ['bi-shield-check', 'green', 'Akurat & Valid', 'Sumber data resmi terverifikasi dari seluruh negara'],
    ['bi-heart', 'rose', 'Save Favorites', 'Kelola daftar negara favorit dengan fitur CRUD lengkap'],
];
$countries = [
    ['Indonesia', 'Jakarta', 'Asia', '273,5 jt', 'https://flagcdn.com/id.svg'],
    ['Japan', 'Tokyo', 'Asia', '126,5 jt', 'https://flagcdn.com/jp.svg'],
    ['United States', 'Washington, D.C.', 'Americas', '329,5 jt', 'https://flagcdn.com/us.svg'],
    ['Germany', 'Berlin', 'Europe', '83,8 jt', 'https://flagcdn.com/de.svg'],
    ['Brazil', 'Brasilia', 'Americas', '212,6 jt', 'https://flagcdn.com/br.svg'],
    ['Australia', 'Canberra', 'Oceania', '25,5 jt', 'https://flagcdn.com/au.svg'],
    ['France', 'Paris', 'Europe', '65,3 jt', 'https://flagcdn.com/fr.svg'],
    ['South Korea', 'Seoul', 'Asia', '51,3 jt', 'https://flagcdn.com/kr.svg'],
];
?>
<section class="wi-hero">
    <div class="wi-orb wi-orb-one"></div><div class="wi-orb wi-orb-two"></div><div class="wi-grid-bg"></div>
    <div class="wi-container wi-hero-inner">
        <div class="wi-eyebrow"><i class="bi bi-globe2"></i> Explore 250+ Countries Worldwide <i class="bi bi-stars"></i></div>
        <h1>Jelajahi <span>Dunia</span><br><em>Dalam Satu</em><br><b>Platform</b></h1>
        <p>Akses informasi lengkap tentang negara-negara di seluruh dunia. Data real-time, visualisasi modern, dan fitur favorit terbaik.</p>
        <div class="wi-hero-actions">
            <a class="wi-primary-pill" href="<?= base_url('countries') ?>"><i class="bi bi-globe-americas"></i> Mulai Jelajahi <i class="bi bi-arrow-right"></i></a>
            <a class="wi-ghost-pill" href="<?= base_url('about') ?>">Tentang WorldInfo</a>
        </div>
        <div class="wi-hero-stats">
            <div><i class="bi bi-globe2"></i><span><strong>250+</strong><small>Negara</small></span></div>
            <div><i class="bi bi-geo-alt"></i><span><strong>6</strong><small>Region</small></span></div>
            <div><i class="bi bi-graph-up-arrow"></i><span><strong>15+</strong><small>Data Points</small></span></div>
            <div><i class="bi bi-translate"></i><span><strong>7000+</strong><small>Bahasa</small></span></div>
        </div>
        <a class="wi-scroll-cue" href="#features"><small>Scroll untuk menjelajah</small><i class="bi bi-chevron-down"></i></a>
    </div>
</section>
<section class="wi-section" id="features">
    <div class="wi-container">
        <div class="wi-section-heading">
            <span><i class="bi bi-stars"></i> Fitur Unggulan</span>
            <h2>Semua yang Anda<br>butuhkan ada di sini</h2>
            <p>Platform terlengkap untuk mengakses data negara-negara di seluruh dunia dengan fitur modern dan intuitif.</p>
        </div>
        <div class="wi-feature-grid">
            <?php foreach ($features as [$icon, $color, $name, $desc]): ?>
                <article class="wi-feature-card"><div class="wi-gradient-icon <?= $color ?>"><i class="bi <?= $icon ?>"></i></div><h3><?= $name ?></h3><p><?= $desc ?></p></article>
            <?php endforeach ?>
        </div>
    </div>
</section>
<section class="wi-section wi-soft-section">
    <div class="wi-container">
        <div class="wi-country-heading"><div><span class="wi-section-kicker"><i class="bi bi-globe2"></i> Negara dari Seluruh Dunia</span><h2>Temukan Negara<br>Impian Anda</h2></div></div>
        <div class="wi-country-grid">
            <?php foreach ($countries as [$name, $capital, $region, $population, $flag]): ?>
                <a class="wi-country-card" href="<?= base_url('countries/detail/' . rawurlencode($name)) ?>">
                    <div class="wi-country-flag"><img src="<?= $flag ?>" alt="<?= esc($name) ?>"></div>
                    <div class="wi-country-body"><h3><?= esc($name) ?></h3><p><i class="bi bi-geo-alt"></i> <?= esc($capital) ?></p><div><span class="wi-region <?= strtolower($region) ?>"><?= $region ?></span><small><?= $population ?> jiwa</small></div></div>
                </a>
            <?php endforeach ?>
        </div>
        <div class="text-center mt-5"><a class="wi-outline-pill" href="<?= base_url('countries') ?>">Lihat Semua Negara <i class="bi bi-arrow-right"></i></a></div>
    </div>
</section>
<section class="wi-cta"><div class="wi-container"><div class="wi-cta-card"><span>Mulai Petualangan Anda</span><h2>Dunia menunggu untuk<br>Anda jelajahi</h2><p>Temukan informasi, simpan negara favorit, dan rencanakan perjalanan impian Anda.</p><div><a class="wi-primary-pill" href="<?= base_url('login') ?>">Mulai Sekarang - Gratis</a><a class="wi-ghost-pill" href="<?= base_url('about') ?>">Pelajari Lebih Lanjut</a></div></div></div></section>
