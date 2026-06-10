<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Login WorldInfo') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/reference-ui.css') ?>">
</head>
<body>
<main class="wi-login-page">
    <section class="wi-login-brand">
        <div class="wi-orb wi-orb-one"></div><div class="wi-orb wi-orb-two"></div>
        <div class="wi-login-brand-inner">
            <div class="wi-login-logo"><i class="bi bi-globe2"></i></div>
            <h1>WorldInfo</h1>
            <p>Platform informasi negara dunia terlengkap. Jelajahi 250+ negara dengan data real-time.</p>
            <div class="wi-login-stats"><div><strong>250+</strong><small>Negara</small></div><div><strong>6</strong><small>Region</small></div><div><strong>7000+</strong><small>Bahasa</small></div><div><strong>15+</strong><small>Data Points</small></div></div>
        </div>
    </section>
    <section class="wi-login-form-wrap">
        <div class="wi-login-form">
            <div class="wi-mobile-logo"><span class="wi-brand-mark"><i class="bi bi-globe2"></i></span><strong>WorldInfo</strong></div>
            <h2>Selamat Datang</h2><p>Masuk ke dashboard admin WorldInfo</p>
            <?= view('partials/alert') ?>
            <form action="<?= base_url('login/process') ?>" method="post">
                <?= csrf_field() ?>
                <label>Email</label><div class="wi-input-icon"><i class="bi bi-person"></i><input name="email" type="email" value="<?= esc(old('email') ?? 'admin@worldinfo.test') ?>" placeholder="Masukkan email" required></div>
                <label>Password</label><div class="wi-input-icon"><i class="bi bi-lock"></i><input id="loginPassword" name="password" type="password" placeholder="Masukkan password" required><button type="button" onclick="const p=document.getElementById('loginPassword');p.type=p.type==='password'?'text':'password'"><i class="bi bi-eye"></i></button></div>
                <button class="wi-login-submit" type="submit"><i class="bi bi-stars"></i> Masuk ke Dashboard <i class="bi bi-arrow-right"></i></button>
            </form>
            <div class="wi-demo-note"><strong>Demo:</strong> admin@worldinfo.test / admin123</div>
            <a class="wi-back-link" href="<?= base_url('/') ?>"><i class="bi bi-arrow-left"></i> Kembali ke Beranda</a>
        </div>
    </section>
</main>
</body>
</html>
