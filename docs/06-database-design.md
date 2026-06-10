# 06 – Database Design

## Rancangan Database WorldInfo

Database WorldInfo menggunakan **MySQL/MariaDB** dengan nama database `worldinfo_db`.

---

## Daftar Tabel

| No | Nama Tabel           | Fungsi                                          |
|----|----------------------|-------------------------------------------------|
| 1  | `api_settings`       | Menyimpan konfigurasi endpoint API              |
| 2  | `favorite_countries` | Menyimpan data negara favorit / wishlist        |
| 3  | `users`              | Menyimpan data pengguna admin                   |

---

## 1. Tabel `api_settings`

**Fungsi:** Menyimpan konfigurasi API yang digunakan untuk mengambil data negara. Dengan menyimpan endpoint di database, administrator dapat mengubah URL API tanpa harus mengubah kode program.

### Struktur Kolom:

| Kolom        | Tipe Data        | Constraint        | Keterangan                                   |
|--------------|------------------|-------------------|----------------------------------------------|
| id           | INT              | PK, AUTO_INCREMENT| ID unik API setting                          |
| nama_api     | VARCHAR(100)     | NOT NULL          | Nama / label API (e.g., "REST Countries API")|
| base_url     | TEXT             | NOT NULL          | URL endpoint API utama                        |
| method       | VARCHAR(10)      | NOT NULL          | HTTP method: GET, POST                        |
| api_key      | TEXT             | NULL              | API key jika diperlukan (NULL jika tidak ada)|
| status       | ENUM             | NOT NULL          | Nilai: 'Aktif', 'Tidak Aktif'                |
| last_sync    | DATETIME         | NULL              | Waktu terakhir data berhasil disinkronkan    |
| created_at   | DATETIME         | NULL              | Waktu record dibuat (auto CI4)               |
| updated_at   | DATETIME         | NULL              | Waktu record terakhir diubah (auto CI4)      |

### SQL Create Table:
```sql
CREATE TABLE `api_settings` (
  `id`          INT NOT NULL AUTO_INCREMENT,
  `nama_api`    VARCHAR(100) NOT NULL,
  `base_url`    TEXT NOT NULL,
  `method`      VARCHAR(10) NOT NULL DEFAULT 'GET',
  `api_key`     TEXT NULL,
  `status`      ENUM('Aktif', 'Tidak Aktif') NOT NULL DEFAULT 'Aktif',
  `last_sync`   DATETIME NULL,
  `created_at`  DATETIME NULL,
  `updated_at`  DATETIME NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

---

## 2. Tabel `favorite_countries`

**Fungsi:** Menyimpan daftar negara yang ditandai sebagai favorit atau wishlist oleh pengguna. Data negara disalin dari response API ke database lokal agar dapat diakses meskipun API sedang tidak tersedia.

### Struktur Kolom:

| Kolom               | Tipe Data      | Constraint        | Keterangan                                        |
|---------------------|----------------|-------------------|---------------------------------------------------|
| id                  | INT            | PK, AUTO_INCREMENT| ID unik favorit                                   |
| nama_negara         | VARCHAR(100)   | NOT NULL          | Nama umum negara (`name.common`)                  |
| official_name       | VARCHAR(150)   | NULL              | Nama resmi negara (`name.official`)               |
| flag                | TEXT           | NULL              | URL gambar bendera (`flags.png`)                  |
| region              | VARCHAR(100)   | NULL              | Region negara (e.g., Asia, Europe)                |
| subregion           | VARCHAR(100)   | NULL              | Subregion (e.g., South-Eastern Asia)              |
| capital             | VARCHAR(100)   | NULL              | Ibu kota negara                                   |
| population          | BIGINT         | NULL              | Jumlah penduduk                                   |
| languages           | TEXT           | NULL              | Bahasa (disimpan dalam format JSON string)        |
| currencies          | TEXT           | NULL              | Mata uang (disimpan dalam format JSON string)     |
| timezones           | TEXT           | NULL              | Zona waktu (disimpan dalam format JSON string)    |
| maps_url            | TEXT           | NULL              | URL Google Maps negara                            |
| status_wishlist     | VARCHAR(50)    | NOT NULL          | Status: Wishlist, Want to Go, Visited, Planning   |
| catatan             | TEXT           | NULL              | Catatan pribadi pengguna                          |
| tanggal_ditambahkan | DATE           | NULL              | Tanggal negara ditambahkan ke favorit             |
| created_at          | DATETIME       | NULL              | Waktu record dibuat (auto CI4)                    |
| updated_at          | DATETIME       | NULL              | Waktu record terakhir diubah (auto CI4)           |

### SQL Create Table:
```sql
CREATE TABLE `favorite_countries` (
  `id`                  INT NOT NULL AUTO_INCREMENT,
  `nama_negara`         VARCHAR(100) NOT NULL,
  `official_name`       VARCHAR(150) NULL,
  `flag`                TEXT NULL,
  `region`              VARCHAR(100) NULL,
  `subregion`           VARCHAR(100) NULL,
  `capital`             VARCHAR(100) NULL,
  `population`          BIGINT NULL,
  `languages`           TEXT NULL,
  `currencies`          TEXT NULL,
  `timezones`           TEXT NULL,
  `maps_url`            TEXT NULL,
  `status_wishlist`     VARCHAR(50) NOT NULL DEFAULT 'Wishlist',
  `catatan`             TEXT NULL,
  `tanggal_ditambahkan` DATE NULL,
  `created_at`          DATETIME NULL,
  `updated_at`          DATETIME NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

---

## 3. Tabel `users`

**Fungsi:** Menyimpan data pengguna yang dapat mengakses halaman admin WorldInfo. Pada saat ini hanya mendukung satu role yaitu 'admin'.

### Struktur Kolom:

| Kolom      | Tipe Data    | Constraint        | Keterangan                                |
|------------|--------------|-------------------|-------------------------------------------|
| id         | INT          | PK, AUTO_INCREMENT| ID unik pengguna                          |
| name       | VARCHAR(100) | NOT NULL          | Nama lengkap pengguna                     |
| email      | VARCHAR(100) | NOT NULL, UNIQUE  | Alamat email untuk login                  |
| password   | VARCHAR(255) | NOT NULL          | Password yang sudah di-hash (password_hash) |
| role       | VARCHAR(50)  | NOT NULL          | Role pengguna: 'admin'                    |
| created_at | DATETIME     | NULL              | Waktu akun dibuat (auto CI4)              |
| updated_at | DATETIME     | NULL              | Waktu akun terakhir diubah (auto CI4)     |

### SQL Create Table:
```sql
CREATE TABLE `users` (
  `id`         INT NOT NULL AUTO_INCREMENT,
  `name`       VARCHAR(100) NOT NULL,
  `email`      VARCHAR(100) NOT NULL,
  `password`   VARCHAR(255) NOT NULL,
  `role`       VARCHAR(50) NOT NULL DEFAULT 'admin',
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

---

## Relasi Antar Tabel

Pada versi ini, ketiga tabel tidak memiliki foreign key langsung antar satu sama lain. Namun secara logis:

- Tabel `favorite_countries` merekam aksi yang dilakukan oleh pengguna (`users`)
- Tabel `api_settings` menyediakan endpoint yang digunakan untuk mengisi data `favorite_countries`

---

## Catatan Penting

1. **Kolom `languages`, `currencies`, `timezones`** disimpan sebagai **TEXT/JSON string** karena bersifat array dari API. Saat ditampilkan, decode menggunakan `json_decode()` di PHP.
2. **Password** wajib di-hash menggunakan `password_hash($password, PASSWORD_DEFAULT)` sebelum disimpan.
3. **Kolom `last_sync`** di tabel `api_settings` diperbarui setiap kali request API berhasil dilakukan.
4. Gunakan **Migrations CI4** untuk membuat tabel secara programatik.
5. Gunakan **Seeders CI4** untuk mengisi data awal (default admin, default API setting).

---

*Rancangan database ini adalah acuan utama untuk pembuatan Migration dan Model di CodeIgniter 4.*
