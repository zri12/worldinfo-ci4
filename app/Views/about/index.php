<div class="wi-about-page wi-container">

    <section class="wi-about-hero">
        <div class="wi-brand-mark"><i class="bi bi-globe2"></i></div>
        <h1>WorldInfo</h1>
        <p>Platform informasi negara dunia yang modern, lengkap, dan mudah digunakan untuk keperluan edukasi dan riset.</p>
    </section>

    <section class="wi-about-grid wi-group-info">
        <article>
            <span class="wi-gradient-icon blue"><i class="bi bi-mortarboard"></i></span>
            <h3>Program Studi</h3>
            <p>Informatika Unjani</p>
        </article>
        <article>
            <span class="wi-gradient-icon violet"><i class="bi bi-people"></i></span>
            <h3>Kelas</h3>
            <p>DSE-B</p>
        </article>
        <article>
            <span class="wi-gradient-icon rose"><i class="bi bi-book"></i></span>
            <h3>Mata Kuliah</h3>
            <p>Teknologi Web</p>
        </article>
    </section>

    <section class="wi-about-card">
        <h2>Tentang WorldInfo</h2>
        <p>WorldInfo menyediakan data lengkap tentang negara-negara di seluruh dunia. Platform ini memudahkan mahasiswa, pelajar, dan siapa saja untuk mempelajari informasi geografis serta demografis.</p>
        <p>Data ditampilkan secara real-time dari REST Countries Public API, meliputi bendera, nama resmi, ibu kota, region, populasi, bahasa, mata uang, dan zona waktu.</p>
    </section>

    <h2 class="wi-about-title">Anggota Kelompok</h2>
    <section class="wi-members-grid">
        <article class="wi-member-card">
            <div class="wi-member-photo-wrap">
                <img src="<?= base_url('assets/img/members/fazri.jpeg') ?>" alt="Fazri Lukman Nurrohman" class="wi-member-photo">
            </div>
            <div class="wi-member-info">
                <h3>Fazri Lukman Nurrohman</h3>
                <span>Anggota</span>
            </div>
        </article>
        <article class="wi-member-card">
            <div class="wi-member-photo-wrap">
                <img src="<?= base_url('assets/img/members/azfa.png') ?>" alt="Azfa Shalsabilla" class="wi-member-photo">
            </div>
            <div class="wi-member-info">
                <h3>Azfa Shalsabilla</h3>
                <span>Anggota</span>
            </div>
        </article>
        <article class="wi-member-card">
            <div class="wi-member-photo-wrap">
                <img src="<?= base_url('assets/img/members/nabila.png') ?>" alt="Siti Nabila" class="wi-member-photo">
            </div>
            <div class="wi-member-info">
                <h3>Siti Nabila</h3>
                <span>Anggota</span>
            </div>
        </article>
        <article class="wi-member-card">
            <div class="wi-member-photo-wrap">
                <img src="<?= base_url('assets/img/members/rifqi.png') ?>" alt="Rifqi Fauzi Anwar" class="wi-member-photo">
            </div>
            <div class="wi-member-info">
                <h3>Rifqi Fauzi Anwar</h3>
                <span>Anggota</span>
            </div>
        </article>
    </section>

    <h2 class="wi-about-title">Fitur Website</h2>
    <section class="wi-about-grid">
        <article>
            <span class="wi-gradient-icon blue"><i class="bi bi-globe2"></i></span>
            <h3>Data Lengkap</h3>
            <p>Informasi detail dari 250+ negara.</p>
        </article>
        <article>
            <span class="wi-gradient-icon violet"><i class="bi bi-code-slash"></i></span>
            <h3>REST API</h3>
            <p>Data terpercaya dan selalu diperbarui.</p>
        </article>
        <article>
            <span class="wi-gradient-icon rose"><i class="bi bi-layers"></i></span>
            <h3>CRUD Favorit</h3>
            <p>Kelola wishlist perjalanan Anda.</p>
        </article>
        <article>
            <span class="wi-gradient-icon green"><i class="bi bi-check-circle"></i></span>
            <h3>Modern UI</h3>
            <p>Responsive dan nyaman di semua perangkat.</p>
        </article>
    </section>

    <section class="wi-api-about">
        <span class="wi-gradient-icon blue"><i class="bi bi-code-slash"></i></span>
        <div>
            <h3>REST Countries API</h3>
            <p>Endpoint utama: <code>https://restcountries.com/v3.1/all</code></p>
        </div>
        <span class="wi-region africa">Free - No Auth</span>
    </section>

</div>

<style>
.wi-about-page {
    max-width: none;
    padding-left: 0;
    padding-right: 0;
}

.wi-group-info {
    grid-template-columns: repeat(3, 1fr) !important;
    margin-bottom: 1.5rem;
}

.wi-members-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1rem;
    margin-bottom: 2rem;
}

.wi-member-card {
    background: var(--wi-surface, #fff);
    border: 1px solid var(--wi-border, #e5e7eb);
    border-radius: 12px;
    overflow: hidden;
    text-align: center;
    transition: transform 0.2s, box-shadow 0.2s;
}

.wi-member-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.08);
}

.wi-member-photo-wrap {
    width: 100%;
    aspect-ratio: 1 / 1;
    overflow: hidden;
}

.wi-member-photo {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center top;
    display: block;
}

.wi-member-info {
    padding: 0.75rem 0.5rem;
}

.wi-member-info h3 {
    font-size: 13px;
    font-weight: 600;
    color: var(--wi-text, #111827);
    margin: 0 0 3px;
}

.wi-member-info span {
    font-size: 11px;
    color: var(--wi-text-muted, #6b7280);
}

@media (max-width: 640px) {
    .wi-members-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    .wi-group-info {
        grid-template-columns: 1fr !important;
    }
}
</style>