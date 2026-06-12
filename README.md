# WorldinfoCI

**Website Informasi Negara Dunia berbasis CodeIgniter 4**

---

## Deskripsi Project

WorldInfo adalah website informasi negara dunia yang menampilkan data lengkap mengenai negara-negara di seluruh dunia secara real-time. Data negara diambil dari **REST Countries Public API** dan disajikan dalam tampilan modern, responsif, dan mudah digunakan.

WorldInfo dilengkapi fitur CRUD untuk mengelola daftar negara favorit/wishlist, serta fitur pengaturan API yang memungkinkan pengguna mengelola endpoint API yang digunakan.

---

## Tech Stack

| Kategori        | Teknologi              |
|-----------------|------------------------|
| Backend         | CodeIgniter 4, PHP 8+  |
| Frontend        | Bootstrap 5, CSS, JS   |
| Database        | MySQL / MariaDB        |
| API             | REST Countries API     |
| HTTP Client     | CURLRequest (CI4)      |
| Local Server    | XAMPP / Laragon        |
| DB Management   | phpMyAdmin             |
| Version Control | Git / GitHub           |

---

## Fitur Utama

- 🌍 **Daftar Negara** – Tampilkan semua negara dari REST Countries API dengan search dan filter region
- 🔎 **Detail Negara** – Informasi lengkap: bendera, ibu kota, populasi, bahasa, mata uang, timezone, Google Maps
- ❤️ **Favorit / Wishlist** – CRUD daftar negara favorit dengan status dan catatan pribadi
- ⚙️ **Pengaturan API** – Kelola endpoint API, test koneksi, dan sinkronisasi data
- 📊 **Dashboard** – Ringkasan statistik total negara, favorit, dan status API
- 🔐 **Autentikasi** – Login admin sederhana untuk mengakses fitur admin

---

## Cara Instalasi

### Prasyarat
- PHP 8.1+
- Composer
- MySQL / MariaDB
- XAMPP / Laragon
- Git

### Langkah Instalasi

**1. Clone repository:**
```bash
git clone https://github.com/username/worldinfo.git
cd worldinfo
```

**2. Install dependensi CodeIgniter 4:**
```bash
composer install
```

**3. Copy file environment:**
```bash
cp env .env
```

**4. Edit file `.env`:**
```env
CI_ENVIRONMENT = development

database.default.hostname = localhost
database.default.database = worldinfo_db
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
database.default.port     = 3306
```

**5. Buat database:**
Buka phpMyAdmin dan buat database baru:
```sql
CREATE DATABASE worldinfo_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

---

## Cara Setup Database

**1. Jalankan Migration:**
```bash
php spark migrate
```

**2. Jalankan Seeder:**
```bash
php spark db:seed ApiSettingSeeder
php spark db:seed UserSeeder
```

Atau jalankan semua seeder sekaligus:
```bash
php spark db:seed DatabaseSeeder
```

---

## Cara Menjalankan Project

**1. Via XAMPP:**
- Tempatkan folder project di `C:/xampp/htdocs/worldinfo`
- Akses via browser: `http://localhost/worldinfo/public`

**2. Via PHP Built-in Server:**
```bash
php spark serve
```
Akses via browser: `http://localhost:8080`

**3. Via Laragon:**
- Tempatkan folder di `C:/laragon/www/worldinfo`
- Akses via: `http://worldinfo.test`

---

## Akun Default

Setelah menjalankan seeder, akun admin default tersedia:

| Field    | Value                   |
|----------|-------------------------|
| Email    | admin@worldinfo.test    |
| Password | admin123                |
| Role     | admin                   |

> ⚠️ **Ganti password admin setelah instalasi pertama!**

---

## API yang Digunakan

| Nama API           | URL                               | Keterangan           |
|--------------------|-----------------------------------|----------------------|
| REST Countries API | https://restcountries.com/v3.1/   | Public API, gratis   |

Endpoint utama:
- **Semua Negara:** `https://restcountries.com/v3.1/all`
- **Detail Negara:** `https://restcountries.com/v3.1/name/{name}`

---

## Struktur Folder

```
worldinfo/
├── app/
│   ├── Controllers/        ← Logika request-response
│   ├── Models/             ← Akses database
│   ├── Views/              ← Template HTML
│   │   ├── layouts/        ← Layout master
│   │   ├── partials/       ← Komponen reusable
│   │   ├── dashboard/
│   │   ├── countries/
│   │   ├── favorites/
│   │   ├── api_settings/
│   │   ├── about/
│   │   ├── auth/
│   │   └── landing/
│   ├── Database/
│   │   ├── Migrations/     ← Definisi tabel
│   │   └── Seeds/          ← Data awal
│   └── Config/
│       └── Routes.php
│
├── public/
│   └── assets/
│       ├── css/            ← Stylesheet custom
│       ├── js/             ← JavaScript custom
│       └── img/            ← Gambar statis
│
├── docs/                   ← Dokumentasi project
└── README.md
```

---

## Perintah Spark yang Berguna

```bash
# Jalankan server development
php spark serve

# Buat controller baru
php spark make:controller NamaController

# Buat model baru
php spark make:model NamaModel

# Buat migration baru
php spark make:migration CreateNamaTabel

# Jalankan migration
php spark migrate

# Rollback migration
php spark migrate:rollback

# Jalankan seeder
php spark db:seed NamaSeeder

# Cek route yang terdaftar
php spark routes
```

---

## Dokumentasi Lengkap

Lihat folder `docs/` untuk dokumentasi lengkap:

| File                          | Isi                               |
|-------------------------------|-----------------------------------|
| `01-project-overview.md`      | Gambaran umum project             |
| `02-tech-stack.md`            | Teknologi yang digunakan          |
| `03-ui-design-guideline.md`   | Panduan desain UI                 |
| `04-page-structure.md`        | Struktur halaman                  |
| `05-feature-requirement.md`   | Kebutuhan fitur                   |
| `06-database-design.md`       | Rancangan database                |
| `07-api-integration.md`       | Dokumentasi integrasi API         |
| `08-crud-flow.md`             | Alur CRUD                         |
| `09-ci4-folder-structure.md`  | Penjelasan struktur folder CI4    |
| `10-development-rules.md`     | Aturan pengembangan               |
| `11-reference-ui-mapping.md`  | Mapping referensi UI TSX ke CI4   |

---

## Kontribusi

1. Fork repository ini
2. Buat branch fitur: `git checkout -b feature/nama-fitur`
3. Commit perubahan: `git commit -m "feat: add feature description"`
4. Push ke branch: `git push origin feature/nama-fitur`
5. Buat Pull Request

---

## Lisensi

Project ini dibuat untuk keperluan **Tugas Besar Mata Kuliah Teknik Web – Semester 6**.

---

*WorldInfo – Jelajahi Dunia Tanpa Batas* 🌍
