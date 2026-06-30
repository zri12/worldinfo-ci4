# WorldInfo CI4

Project ini dibuat untuk tugas besar mata kuliah Teknik Web. Aplikasi ini berisi informasi negara-negara di dunia dengan data dari REST Countries API, lalu ditampilkan memakai CodeIgniter 4.

Saya membuat aplikasi ini supaya user bisa melihat daftar negara, detail negara, dan admin bisa mengelola beberapa data pendukung lewat dashboard.

## Fitur

- Halaman daftar negara dari API
- Detail negara seperti bendera, ibu kota, populasi, bahasa, mata uang, timezone, dan link Google Maps
- Login admin sederhana
- Dashboard admin
- CRUD data negara yang dikelola di database
- Pengaturan API untuk menyimpan endpoint yang digunakan aplikasi

## Teknologi yang Dipakai

- CodeIgniter 4
- PHP
- MySQL / MariaDB
- Bootstrap
- REST Countries API
- XAMPP
- Git dan GitHub

## Kebutuhan

Sebelum menjalankan project, pastikan sudah tersedia:

- PHP minimal 8.1
- Composer
- MySQL atau MariaDB
- XAMPP atau Laragon

## Cara Menjalankan

1. Clone repository:

```bash
git clone https://github.com/zri12/worldinfo-ci4.git
cd worldinfo-ci4
```

2. Install dependency:

```bash
composer install
```

3. Buat file `.env` dari file `env`:

```bash
copy env .env
```

Kalau memakai Git Bash atau terminal Linux:

```bash
cp env .env
```

4. Ubah konfigurasi database di file `.env`:

```env
CI_ENVIRONMENT = development

database.default.hostname = localhost
database.default.database = worldinfo_db
database.default.username = root
database.default.password = ''
database.default.DBDriver = MySQLi
database.default.port = 3306
```

5. Buat database baru di phpMyAdmin dengan nama:

```sql
CREATE DATABASE worldinfo_db;
```

6. Jalankan migration:

```bash
php spark migrate
```

7. Jalankan seeder:

```bash
php spark db:seed UserSeeder
php spark db:seed ApiSettingSeeder
```

8. Jalankan aplikasi:

```bash
php spark serve
```

Setelah itu buka:

```text
http://localhost:8080
```

Jika memakai XAMPP tanpa `php spark serve`, project bisa diletakkan di folder `htdocs`, lalu dibuka melalui:

```text
http://localhost/nama-folder-project/public
```

## Akun Admin

Akun admin default akan tersedia setelah menjalankan `UserSeeder`.

```text
Email    : admin@worldinfo.test
Password : admin123
Role     : admin
```

## API

Data negara diambil dari REST Countries API.

```text
https://restcountries.com/v3.1/
```

Contoh endpoint:

```text
https://restcountries.com/v3.1/all
https://restcountries.com/v3.1/name/indonesia
```

## Struktur Singkat Project

```text
app/
  Controllers/       berisi controller aplikasi
  Models/            berisi model untuk database
  Views/             berisi tampilan halaman
  Database/
    Migrations/      struktur tabel
    Seeds/           data awal aplikasi

public/
  assets/            file css, js, dan gambar

writable/            folder bawaan CodeIgniter untuk cache/log
```

## Catatan

Project ini masih dibuat untuk kebutuhan tugas, jadi beberapa bagian masih sederhana. Fokus utama project adalah penerapan CodeIgniter 4, penggunaan database, proses CRUD, login admin, dan pengambilan data dari API.
