# 01 – Project Overview

## Nama Project

**WorldInfo** – Website Informasi Negara Dunia

---

## Deskripsi Project

WorldInfo adalah sebuah website informasi negara dunia yang menampilkan data lengkap mengenai negara-negara di seluruh penjuru dunia. Data negara diambil secara real-time dari **REST Countries Public API** dan disajikan dalam tampilan modern, responsif, dan mudah digunakan.

WorldInfo juga dilengkapi fitur **CRUD (Create, Read, Update, Delete)** untuk mengelola daftar negara favorit/wishlist pribadi pengguna, serta fitur pengaturan API yang memungkinkan pengguna mengelola endpoint API yang digunakan.

---

## Tujuan Pembuatan Project

1. Menampilkan informasi negara-negara di dunia secara lengkap dan terstruktur.
2. Menyediakan fitur pencarian dan filter negara berdasarkan region.
3. Menyediakan fitur CRUD untuk menyimpan dan mengelola daftar negara favorit/wishlist.
4. Menyediakan halaman pengaturan API agar pengguna dapat mengelola dan mengkonfigurasi endpoint API.
5. Menerapkan konsep MVC (Model-View-Controller) menggunakan framework CodeIgniter 4.
6. Mengembangkan kemampuan integrasi REST API dalam project PHP modern.

---

## API yang Digunakan

| Nama API              | URL                              | Keterangan                                 |
|-----------------------|----------------------------------|--------------------------------------------|
| REST Countries API    | https://restcountries.com/v3.1/  | API publik gratis, tidak butuh API key     |

### Endpoint Utama:
- **Semua Negara:** `https://restcountries.com/v3.1/all`
- **Detail Negara:** `https://restcountries.com/v3.1/name/{name}`

---

## Fitur Utama

| No | Fitur                       | Keterangan                                                  |
|----|-----------------------------|-------------------------------------------------------------|
| 1  | Dashboard                   | Ringkasan statistik total negara, favorit, dan status API   |
| 2  | Daftar Negara               | Menampilkan semua negara dari API dalam bentuk card         |
| 3  | Detail Negara               | Informasi lengkap: bendera, ibu kota, populasi, bahasa, dll |
| 4  | Favorit / Wishlist CRUD     | Tambah, lihat, edit, dan hapus negara favorit               |
| 5  | Pengaturan API              | Kelola endpoint API, test koneksi, sync data                |
| 6  | Autentikasi Admin           | Login sederhana untuk mengakses fitur admin                 |
| 7  | Landing Page                | Halaman publik beranda WorldInfo                            |
| 8  | Halaman Tentang             | Informasi tentang website WorldInfo                         |

---

## Referensi UI

Project ini memiliki file referensi UI dalam format **TSX (TypeScript + React)** yang tersimpan dalam file `UI.zip`.

> ⚠️ **Penting:** File TSX **hanya digunakan sebagai referensi tampilan, layout, warna, komponen, dan konsistensi desain.** File TSX **TIDAK** digunakan secara langsung dalam project ini.

### Apa yang Diambil dari Referensi UI TSX:
- Struktur layout halaman (sidebar, topbar, content area, footer)
- Skema warna (navy blue, cyan, off-white)
- Komponen kartu negara
- Komponen tabel favorit
- Komponen form pengaturan API
- Desain dashboard dengan card statistik
- Gaya badge, alert, dan button

### Implementasi Final:
Semua tampilan diimplementasikan ulang menggunakan:
- **PHP** (CodeIgniter 4 View)
- **HTML5**
- **Bootstrap 5**
- **CSS Custom**
- **JavaScript**

---

## Tech Stack Singkat

- **Backend:** CodeIgniter 4 (PHP 8+)
- **Frontend:** HTML, CSS, JavaScript, Bootstrap 5
- **Database:** MySQL/MariaDB
- **API:** REST Countries API
- **Server:** XAMPP / Laragon

---

*Dibuat oleh: Tim WorldInfo | Teknik Web – Semester 6*
