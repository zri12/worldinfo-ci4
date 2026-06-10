# 09 – CI4 Folder Structure

## Struktur Folder CodeIgniter 4 – WorldInfo

Dokumen ini menjelaskan fungsi setiap folder dan file dalam struktur project WorldInfo berbasis CodeIgniter 4.

---

## Gambaran Umum Struktur

```
worldinfo/
├── app/                    ← Kode aplikasi utama
│   ├── Controllers/        ← Logika alur request-response
│   ├── Models/             ← Logika akses database
│   ├── Views/              ← Template HTML halaman
│   │   ├── layouts/        ← Layout master halaman
│   │   └── partials/       ← Komponen reusable (sidebar, topbar, dll)
│   ├── Database/
│   │   ├── Migrations/     ← Definisi struktur tabel database
│   │   └── Seeds/          ← Data awal / dummy database
│   └── Config/
│       └── Routes.php      ← Konfigurasi URL routing
│
├── public/                 ← File yang dapat diakses publik
│   └── assets/
│       ├── css/            ← File CSS custom
│       ├── js/             ← File JavaScript custom
│       └── img/            ← Gambar statis
│
├── docs/                   ← Dokumentasi project
├── writable/               ← Cache, log, session (auto CI4)
└── README.md
```

---

## Penjelasan Setiap Folder

---

### `app/Controllers/`

**Fungsi:** Menangani request dari user, memproses data, dan mengirim response ke View.

Controller adalah jembatan antara Model (data) dan View (tampilan). Di CI4, semua Controller extends `BaseController`.

| File                         | Fungsi                                               |
|------------------------------|------------------------------------------------------|
| `DashboardController.php`    | Halaman dashboard utama admin                        |
| `CountryController.php`      | Daftar negara dan detail negara dari API             |
| `FavoriteController.php`     | CRUD data negara favorit                             |
| `ApiSettingController.php`   | CRUD dan manajemen konfigurasi API                   |
| `AboutController.php`        | Halaman tentang website                              |
| `AuthController.php`         | Login, logout, dan autentikasi                       |

**Aturan:**
- Controller hanya mengatur alur data, TIDAK menulis query langsung
- Semua query database dilakukan melalui Model
- Controller hanya memanggil method Model dan meneruskan data ke View

---

### `app/Models/`

**Fungsi:** Mengelola semua interaksi dengan database menggunakan Query Builder CI4.

Di CI4, semua Model extends `Model` bawaan CI4 yang memiliki fitur:
- `find()`, `findAll()`, `where()`, `insert()`, `update()`, `delete()`
- Otomatis mengelola `created_at` dan `updated_at`
- Whitelist field via `$allowedFields`

| File                       | Tabel yang Dikelola      | Fungsi                            |
|----------------------------|--------------------------|-----------------------------------|
| `FavoriteCountryModel.php` | `favorite_countries`     | CRUD negara favorit               |
| `ApiSettingModel.php`      | `api_settings`           | CRUD konfigurasi API              |
| `UserModel.php`            | `users`                  | Manajemen data pengguna           |

---

### `app/Views/`

**Fungsi:** Template HTML yang dirender oleh Controller untuk ditampilkan kepada pengguna.

View hanya berisi HTML, PHP echo/print, dan logic tampilan minimal. Tidak boleh ada query database di View.

#### `app/Views/layouts/`

File layout master yang menjadi kerangka dasar semua halaman:

| File                 | Fungsi                                               |
|----------------------|------------------------------------------------------|
| `admin_layout.php`   | Layout untuk semua halaman admin (sidebar + topbar)  |
| `public_layout.php`  | Layout untuk landing page dan halaman publik         |

Layout dipanggil dari View halaman menggunakan `view()` helper CI4 atau dengan include PHP.

#### `app/Views/partials/`

Komponen HTML yang reusable dan dapat di-include ke layout atau view manapun:

| File           | Fungsi                                                    |
|----------------|-----------------------------------------------------------|
| `sidebar.php`  | Navigasi sidebar kiri admin (menu link, logo, user info)  |
| `topbar.php`   | Header atas admin (judul halaman, hamburger, user profile)|
| `footer.php`   | Footer halaman (copyright, versi)                         |
| `alert.php`    | Komponen alert flash message (success, error, warning)    |

#### Folder Halaman:

| Folder            | View Files                       | Halaman                        |
|-------------------|----------------------------------|--------------------------------|
| `dashboard/`      | `index.php`                      | Dashboard admin                |
| `countries/`      | `index.php`, `detail.php`        | Daftar & detail negara         |
| `favorites/`      | `index.php`, `create.php`, `edit.php` | CRUD favorit negara      |
| `api_settings/`   | `index.php`                      | Pengaturan API                 |
| `about/`          | `index.php`                      | Tentang website                |
| `auth/`           | `login.php`                      | Halaman login                  |
| `landing/`        | `index.php`                      | Landing page publik            |

---

### `app/Database/Migrations/`

**Fungsi:** File PHP yang mendefinisikan struktur tabel database secara programatik.

Migration memungkinkan tim berbagi struktur database tanpa perlu import file SQL secara manual.

**Cara menjalankan migration:**
```bash
php spark migrate
```

| File                              | Tabel yang Dibuat        |
|-----------------------------------|--------------------------|
| `CreateApiSettingsTable.php`      | `api_settings`           |
| `CreateFavoriteCountriesTable.php`| `favorite_countries`     |
| `CreateUsersTable.php`            | `users`                  |

**Urutan migration:** CI4 menjalankan migration berdasarkan nama file (timestamp prefix). Pastikan tabel yang tidak saling bergantung bisa dibuat dalam urutan apapun.

---

### `app/Database/Seeds/`

**Fungsi:** File PHP untuk mengisi data awal ke database setelah migration.

**Cara menjalankan seeder:**
```bash
php spark db:seed ApiSettingSeeder
php spark db:seed UserSeeder
```

| File                  | Data yang Diisi                          |
|-----------------------|------------------------------------------|
| `ApiSettingSeeder.php`| 1 record API default (REST Countries)    |
| `UserSeeder.php`      | 1 user admin default                     |

---

### `app/Config/Routes.php`

**Fungsi:** Mendefinisikan semua URL routing aplikasi.

CI4 menggunakan file `app/Config/Routes.php` untuk memetakan URL ke Controller dan method yang sesuai.

```php
$routes->get('/', 'CountryController::landing');
$routes->get('/dashboard', 'DashboardController::index');
$routes->get('/favorites', 'FavoriteController::index');
// dst...
```

---

### `public/assets/`

**Fungsi:** File statis yang dapat diakses langsung oleh browser.

Folder `public/` adalah document root web server. Semua file di dalamnya dapat diakses via URL.

| Sub-folder  | Isi                                      |
|-------------|------------------------------------------|
| `css/`      | `style.css`, `responsive.css`            |
| `js/`       | `app.js`, `api-settings.js`, `favorites.js` |
| `img/`      | Gambar statis seperti logo, placeholder  |

**Cara memanggil asset di View:**
```php
<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
<script src="<?= base_url('assets/js/app.js') ?>"></script>
```

---

### `writable/`

**Fungsi:** Folder yang dapat ditulis oleh web server (auto dikelola CI4).

| Sub-folder  | Isi                            |
|-------------|--------------------------------|
| `cache/`    | File cache CI4                 |
| `logs/`     | Log error aplikasi             |
| `session/`  | Data session pengguna          |
| `uploads/`  | File upload (jika ada)         |

> ⚠️ Pastikan folder `writable/` memiliki permission write yang benar (chmod 755 atau 777 di Linux).

---

### `docs/`

**Fungsi:** Folder dokumentasi project.

Berisi semua file markdown yang menjelaskan arsitektur, aturan, dan panduan pengembangan WorldInfo.

---

*Pahami struktur folder ini dengan baik sebelum mulai mengembangkan fitur baru di WorldInfo.*
