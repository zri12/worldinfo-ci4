<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="WorldInfo - Explore The World">
    <title><?= esc($title ?? 'WorldInfo') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/responsive.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/reference-ui.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/public-pages.css') ?>">
</head>
<body class="public-body">
    <header class="wi-public-header">
        <div class="wi-container wi-public-nav">
            <a class="wi-brand" href="<?= base_url('/') ?>">
                <span class="wi-brand-mark"><i class="bi bi-globe2"></i></span>
                <span><strong>WorldInfo</strong><small>Explore The World</small></span>
            </a>
            <nav class="wi-nav-links">
                <a class="<?= uri_string() === '' ? 'active' : '' ?>" href="<?= base_url('/') ?>">Beranda</a>
                <a class="<?= str_starts_with(uri_string(), 'countries') ? 'active' : '' ?>" href="<?= base_url('countries') ?>">Negara</a>
                <a class="<?= uri_string() === 'about' ? 'active' : '' ?>" href="<?= base_url('about') ?>">Tentang</a>
            </nav>
            <?php if (session()->get('is_logged_in')): ?>
                <a class="wi-login-pill" href="<?= base_url('dashboard') ?>">Panel Admin</a>
            <?php else: ?>
                <a class="wi-login-pill" href="<?= base_url('login') ?>">Masuk</a>
            <?php endif ?>
        </div>
    </header>
    <main class="wi-public-main">
        <?= view('partials/alert') ?>
        <?= $content ?? '' ?>
    </main>
    <?= view('partials/footer', ['public' => true]) ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/js/app.js') ?>"></script>
</body>
</html>
