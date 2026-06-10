<?php if (! empty($public)): ?>
<footer class="wi-public-footer">
    <div class="wi-container wi-footer-grid">
        <div class="wi-footer-intro">
            <a class="wi-brand" href="<?= base_url('/') ?>">
                <span class="wi-brand-mark"><i class="bi bi-globe2"></i></span>
                <span><strong>WorldInfo</strong><small>Explore The World</small></span>
            </a>
            <p>Platform informasi negara dunia yang modern. Akses data dari 250+ negara dengan interface yang intuitif.</p>
            <small>Dibuat untuk keperluan pendidikan.</small>
        </div>
        <div><h4>Navigasi</h4><a href="<?= base_url('/') ?>">Beranda</a><a href="<?= base_url('about') ?>">Tentang</a><a href="<?= base_url('login') ?>">Login Admin</a></div>
        <div><h4>Resources</h4><a href="https://restcountries.com" target="_blank">REST Countries API</a><a href="https://codeigniter.com" target="_blank">CodeIgniter 4</a><a href="mailto:info@worldinfo.test">Contact</a></div>
    </div>
    <div class="wi-container wi-footer-copy"><span>&copy; <?= date('Y') ?> WorldInfo. All rights reserved.</span></div>
</footer>
<?php else: ?>
<footer class="admin-footer wi-admin-footer">
    <span>&copy; <?= date('Y') ?> WorldInfo</span>
</footer>
<?php endif ?>
