# 04 – Page Structure

## Struktur Halaman WorldInfo

Dokumen ini menjelaskan seluruh halaman yang ada di project WorldInfo, beserta fungsi dan jalur aksesnya.

---

## Halaman Publik

Halaman publik dapat diakses tanpa login.

---

### 1. Landing Page

| Atribut      | Detail                                    |
|--------------|-------------------------------------------|
| URL          | `/` atau `/landing`                       |
| View File    | `app/Views/landing/index.php`             |
| Layout       | `public_layout.php`                       |
| Controller   | `LandingController` / `CountryController` |

**Fungsi:**
- Halaman beranda yang menyambut pengunjung
- Menampilkan hero section dengan tagline WorldInfo
- Menampilkan ringkasan fitur utama
- Tombol CTA (Call to Action) menuju halaman daftar negara
- Navigasi publik (navbar horizontal)

---

### 2. Public Country List

| Atribut      | Detail                                    |
|--------------|-------------------------------------------|
| URL          | `/countries`                              |
| View File    | `app/Views/countries/index.php`           |
| Layout       | `admin_layout.php` (jika sudah login)     |
| Controller   | `CountryController@index`                 |

**Fungsi:**
- Menampilkan daftar semua negara dari REST Countries API
- Fitur pencarian nama negara
- Filter berdasarkan region (Africa, Americas, Asia, Europe, Oceania)
- Card negara berisi: bendera, nama, ibu kota, region
- Tombol "Lihat Detail" untuk setiap negara
- Tombol "Tambah Favorit" untuk setiap negara

---

### 3. Public Country Detail

| Atribut      | Detail                                          |
|--------------|-------------------------------------------------|
| URL          | `/countries/detail/{name}`                      |
| View File    | `app/Views/countries/detail.php`                |
| Layout       | `admin_layout.php`                              |
| Controller   | `CountryController@detail`                      |

**Fungsi:**
- Menampilkan detail lengkap satu negara
- Bendera besar berkualitas tinggi
- Informasi: nama resmi, ibu kota, region, subregion, populasi, bahasa, mata uang, zona waktu
- Tombol link ke Google Maps
- Tombol "Tambah ke Favorit"
- Tombol kembali ke daftar negara

---

## Halaman Admin

Halaman admin hanya dapat diakses setelah login.

---

### 4. Login

| Atribut      | Detail                                    |
|--------------|-------------------------------------------|
| URL          | `/login`                                  |
| View File    | `app/Views/auth/login.php`                |
| Layout       | Tidak menggunakan layout admin            |
| Controller   | `AuthController@login`                    |

**Fungsi:**
- Form login dengan email dan password
- Validasi input
- Redirect ke dashboard jika login berhasil
- Tampilkan pesan error jika gagal
- Halaman standalone tanpa sidebar

---

### 5. Dashboard

| Atribut      | Detail                                    |
|--------------|-------------------------------------------|
| URL          | `/dashboard`                              |
| View File    | `app/Views/dashboard/index.php`           |
| Layout       | `admin_layout.php`                        |
| Controller   | `DashboardController@index`               |

**Fungsi:**
- Card statistik: total negara dari API, total favorit, status API
- Daftar beberapa negara populer (terbanyak populasinya)
- Informasi status koneksi API (Connected / Error)
- Link cepat ke halaman-halaman utama
- Sambutan pengguna yang sudah login

---

### 6. Daftar Negara (Admin View)

| Atribut      | Detail                                    |
|--------------|-------------------------------------------|
| URL          | `/countries`                              |
| View File    | `app/Views/countries/index.php`           |
| Layout       | `admin_layout.php`                        |
| Controller   | `CountryController@index`                 |

**Fungsi:**
- Sama dengan halaman publik, namun dalam tampilan admin layout
- Ditambah tombol "Tambah ke Favorit" yang tersimpan ke database

---

### 7. Detail Negara (Admin View)

| Atribut      | Detail                                          |
|--------------|-------------------------------------------------|
| URL          | `/countries/detail/{name}`                      |
| View File    | `app/Views/countries/detail.php`                |
| Layout       | `admin_layout.php`                              |
| Controller   | `CountryController@detail`                      |

**Fungsi:**
- Menampilkan detail negara dalam tampilan admin
- Tombol "Tambah ke Favorit" langsung menyimpan data ke database

---

### 8. Favorit Negara – Daftar

| Atribut      | Detail                                    |
|--------------|-------------------------------------------|
| URL          | `/favorites`                              |
| View File    | `app/Views/favorites/index.php`           |
| Layout       | `admin_layout.php`                        |
| Controller   | `FavoriteController@index`                |

**Fungsi:**
- Menampilkan semua negara favorit dalam bentuk tabel
- Kolom: No, Bendera, Nama Negara, Region, Ibu Kota, Status, Catatan, Aksi
- Tombol Edit dan Hapus di setiap baris
- Filter berdasarkan status wishlist
- Search negara favorit
- Pagination jika data banyak

---

### 9. Favorit Negara – Tambah

| Atribut      | Detail                                    |
|--------------|-------------------------------------------|
| URL          | `/favorites/create`                       |
| View File    | `app/Views/favorites/create.php`          |
| Layout       | `admin_layout.php`                        |
| Controller   | `FavoriteController@create`               |

**Fungsi:**
- Form untuk menambah negara favorit secara manual
- Field: nama negara, status wishlist, catatan, tanggal ditambahkan
- Tombol Simpan dan Batal

---

### 10. Favorit Negara – Edit

| Atribut      | Detail                                    |
|--------------|-------------------------------------------|
| URL          | `/favorites/edit/{id}`                    |
| View File    | `app/Views/favorites/edit.php`            |
| Layout       | `admin_layout.php`                        |
| Controller   | `FavoriteController@edit`                 |

**Fungsi:**
- Form untuk mengedit data favorit yang sudah ada
- Pre-filled dengan data yang sudah tersimpan
- Tombol Update dan Batal

---

### 11. Pengaturan API

| Atribut      | Detail                                    |
|--------------|-------------------------------------------|
| URL          | `/api-settings`                           |
| View File    | `app/Views/api_settings/index.php`        |
| Layout       | `admin_layout.php`                        |
| Controller   | `ApiSettingController@index`              |

**Fungsi:**
- Menampilkan tabel daftar API yang tersimpan
- Form tambah API baru (nama, URL, method, API key)
- Tombol "Test API" untuk mengecek koneksi
- Tombol "Sync Data" untuk mengambil data terbaru
- Tombol Edit dan Hapus
- Badge status API (Connected/Error)
- Riwayat last sync

---

### 12. Tentang Website

| Atribut      | Detail                                    |
|--------------|-------------------------------------------|
| URL          | `/about`                                  |
| View File    | `app/Views/about/index.php`               |
| Layout       | `admin_layout.php`                        |
| Controller   | `AboutController@index`                   |

**Fungsi:**
- Informasi tentang project WorldInfo
- Daftar tech stack yang digunakan
- Informasi tim pengembang
- Link ke API yang digunakan

---

## Ringkasan Halaman

| No | Halaman             | URL                          | Akses  |
|----|---------------------|------------------------------|--------|
| 1  | Landing Page        | `/`                          | Publik |
| 2  | Daftar Negara       | `/countries`                 | Publik |
| 3  | Detail Negara       | `/countries/detail/{name}`   | Publik |
| 4  | Login               | `/login`                     | Publik |
| 5  | Dashboard           | `/dashboard`                 | Admin  |
| 6  | Favorit - Daftar    | `/favorites`                 | Admin  |
| 7  | Favorit - Tambah    | `/favorites/create`          | Admin  |
| 8  | Favorit - Edit      | `/favorites/edit/{id}`       | Admin  |
| 9  | Pengaturan API      | `/api-settings`              | Admin  |
| 10 | Tentang             | `/about`                     | Admin  |
| 11 | Logout              | `/logout`                    | Admin  |

---

*Setiap halaman wajib menggunakan layout yang sesuai dan mengikuti panduan desain WorldInfo.*
