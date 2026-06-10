# 02 – Tech Stack

## Daftar Teknologi yang Digunakan

---

### 1. CodeIgniter 4 (CI4)

- **Versi:** 4.x (terbaru)
- **Fungsi:** Framework utama backend PHP
- **Alasan dipilih:**
  - Framework MVC yang ringan dan cepat
  - Dokumentasi lengkap dan komunitas aktif
  - Built-in fitur seperti routing, ORM (Query Builder), validation, session, dan CURLRequest
  - Cocok untuk project skala menengah seperti WorldInfo
  - Mudah dipahami dan dikembangkan oleh tim kecil

---

### 2. PHP 8+

- **Versi:** PHP 8.1 atau lebih baru
- **Fungsi:** Bahasa pemrograman server-side utama
- **Alasan dipilih:**
  - Standar wajib untuk CodeIgniter 4
  - PHP 8 membawa banyak fitur modern (named arguments, enums, match expression, dll)
  - Dukungan luas dari XAMPP/Laragon
  - Familier untuk pengembang backend PHP

---

### 3. Bootstrap 5

- **Versi:** 5.3.x
- **Fungsi:** Framework CSS/UI untuk membangun tampilan responsif
- **Alasan dipilih:**
  - Komponen UI yang lengkap dan siap pakai (grid, card, modal, table, badge, dll)
  - Responsive by default
  - Tidak memerlukan jQuery (Bootstrap 5 sudah pure JS)
  - Kompatibel dengan custom CSS tambahan

---

### 4. CSS Custom

- **File:** `public/assets/css/style.css`, `public/assets/css/responsive.css`
- **Fungsi:** Styling khusus yang tidak tersedia di Bootstrap default
- **Alasan dipilih:**
  - Memberikan identitas visual unik untuk WorldInfo
  - Menyesuaikan warna, tipografi, dan komponen dengan panduan desain
  - Menghindari tampilan yang terlalu "default Bootstrap"

---

### 5. JavaScript (Vanilla JS)

- **File:** `public/assets/js/app.js`, `api-settings.js`, `favorites.js`
- **Fungsi:** Interaksi dinamis di sisi client (AJAX, modal, alert, dll)
- **Alasan dipilih:**
  - Tidak membutuhkan framework JS tambahan
  - Ringan dan cepat
  - Mendukung AJAX untuk fitur test API dan sync data

---

### 6. MySQL / MariaDB

- **Versi:** MySQL 8+ / MariaDB 10.6+
- **Fungsi:** Database relasional untuk menyimpan data favorit, API settings, dan user
- **Alasan dipilih:**
  - Standar database yang paling banyak digunakan dengan PHP
  - Didukung penuh oleh XAMPP dan Laragon
  - Mudah dikelola menggunakan phpMyAdmin
  - CodeIgniter 4 memiliki Query Builder yang sangat baik untuk MySQL

---

### 7. REST Countries API

- **URL:** https://restcountries.com/v3.1/
- **Fungsi:** Sumber data utama informasi negara dunia
- **Alasan dipilih:**
  - API publik gratis, tidak perlu API key
  - Data lengkap: nama, bendera, ibu kota, populasi, bahasa, mata uang, timezone, dan link Google Maps
  - Response format JSON yang mudah di-parse
  - Stabil dan aktif digunakan oleh banyak developer

---

### 8. CURLRequest (CodeIgniter 4 Built-in)

- **Namespace:** `CodeIgniter\HTTP\CURLRequest`
- **Fungsi:** Melakukan HTTP request ke REST Countries API dari backend PHP
- **Alasan dipilih:**
  - Sudah built-in di CodeIgniter 4, tidak perlu library tambahan
  - Mendukung GET, POST, PUT, DELETE, dan header custom
  - Terintegrasi dengan Service CI4 (`Services::curlrequest()`)

---

### 9. XAMPP / Laragon

- **Fungsi:** Local development server (Apache + PHP + MySQL)
- **Alasan dipilih:**
  - Mudah diinstal dan dikonfigurasi
  - Menyediakan Apache web server, PHP, dan MySQL dalam satu paket
  - phpMyAdmin tersedia langsung untuk manajemen database

---

### 10. phpMyAdmin

- **Fungsi:** Tool GUI untuk manajemen database MySQL secara visual
- **Alasan dipilih:**
  - Sudah termasuk dalam XAMPP/Laragon
  - Memudahkan create, manage, dan inspect tabel database
  - Mendukung import/export SQL

---

### 11. Git / GitHub

- **Fungsi:** Version control dan kolaborasi tim
- **Alasan dipilih:**
  - Standar industri untuk version control
  - Memudahkan kolaborasi antar anggota tim
  - Menyediakan backup kode secara cloud
  - Mendukung branching untuk pengembangan fitur secara paralel

---

## Ringkasan Tech Stack

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

*Dokumen ini adalah panduan teknis untuk pengembangan project WorldInfo.*
