<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'WorldInfo') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/responsive.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/reference-ui.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin-modern.css') ?>">
</head>
<body>
<div class="wrapper wi-admin-shell" id="app-wrapper">
    <?= view('partials/sidebar', ['active_menu' => $active_menu ?? '']) ?>
    <div class="main-content wi-admin-main" id="main-content">
        <?= view('partials/topbar', ['title' => $title ?? 'WorldInfo', 'active_menu' => $active_menu ?? '']) ?>
        <main class="page-content wi-admin-content">
            <?= view('partials/alert') ?>
            <?= $content ?? '' ?>
        </main>
        <?= view('partials/footer') ?>
    </div>
</div>
<script>window.BASE_URL = <?= json_encode(rtrim(base_url(), '/')) ?>;</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/js/app.js') ?>"></script>
<script src="<?= base_url('assets/js/favorites.js') ?>"></script>
<script src="<?= base_url('assets/js/api-settings.js') ?>"></script>
</body>
</html>
