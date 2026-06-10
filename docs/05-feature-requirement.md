# 05 – Feature Requirement

## Kebutuhan Fitur WorldInfo

Dokumen ini menjelaskan kebutuhan fitur secara detail untuk setiap halaman di project WorldInfo.

---

## 1. Dashboard

**Tujuan:** Memberikan ringkasan cepat tentang kondisi sistem dan data WorldInfo.

### Fitur Wajib:
| No | Fitur                          | Keterangan                                                    |
|----|--------------------------------|---------------------------------------------------------------|
| 1  | Card Total Negara              | Menampilkan jumlah negara yang berhasil diambil dari API      |
| 2  | Card Total Favorit             | Menampilkan jumlah negara yang tersimpan di tabel favorit     |
| 3  | Card Status API                | Menampilkan status koneksi API (Connected / Error)            |
| 4  | Card Total Region              | Menampilkan jumlah region yang tersedia                       |
| 5  | Daftar Negara Populer          | Menampilkan 6 negara dengan populasi terbesar                 |
| 6  | Link Cepat                     | Shortcut menuju halaman Negara, Favorit, dan API Settings     |

---

## 2. Daftar Negara

**Tujuan:** Menampilkan semua negara dari REST Countries API dalam format yang mudah dijelajahi.

### Fitur Wajib:
| No | Fitur                          | Keterangan                                                    |
|----|--------------------------------|---------------------------------------------------------------|
| 1  | Tampilkan semua negara         | Ambil data dari REST Countries API endpoint `/all`            |
| 2  | Search negara                  | Pencarian real-time berdasarkan nama negara                   |
| 3  | Filter region                  | Filter berdasarkan: Africa, Americas, Asia, Europe, Oceania   |
| 4  | Card negara                    | Tampilkan: bendera, nama, ibu kota, region, populasi          |
| 5  | Tombol Lihat Detail            | Navigasi ke halaman detail negara                             |
| 6  | Tombol Tambah Favorit          | Menyimpan negara ke tabel favorit                             |
| 7  | Loading state                  | Spinner loading saat data sedang diambil dari API             |
| 8  | Empty state                    | Pesan "tidak ada data" jika hasil pencarian kosong            |
| 9  | Error state                    | Alert error jika API gagal diakses                            |
| 10 | Pagination / Load More         | Memuat data dalam batch agar halaman tidak terlalu panjang    |

---

## 3. Detail Negara

**Tujuan:** Menampilkan informasi lengkap satu negara yang dipilih pengguna.

### Fitur Wajib:
| No | Fitur                          | Keterangan                                                    |
|----|--------------------------------|---------------------------------------------------------------|
| 1  | Bendera negara                 | Gambar bendera besar dari API (`flags.png`)                   |
| 2  | Nama umum                      | `name.common`                                                 |
| 3  | Nama resmi                     | `name.official`                                               |
| 4  | Ibu kota                       | `capital[0]`                                                  |
| 5  | Region                         | `region`                                                      |
| 6  | Subregion                      | `subregion`                                                   |
| 7  | Populasi                       | `population` (format: 1.000.000)                              |
| 8  | Bahasa                         | `languages` (semua bahasa)                                    |
| 9  | Mata uang                      | `currencies` (nama + kode)                                    |
| 10 | Zona waktu                     | `timezones` (semua timezone)                                  |
| 11 | Link Google Maps               | `maps.googleMaps` (buka di tab baru)                          |
| 12 | Tombol Tambah Favorit          | Simpan negara ini ke tabel favorit                            |
| 13 | Tombol Kembali                 | Kembali ke halaman daftar negara                              |

---

## 4. Favorit Negara (CRUD)

**Tujuan:** Mengelola daftar negara favorit / wishlist pengguna.

### 4.1 Create (Tambah Favorit)
| No | Fitur                          | Keterangan                                                    |
|----|--------------------------------|---------------------------------------------------------------|
| 1  | Form tambah favorit            | Modal atau halaman tersendiri                                 |
| 2  | Auto-fill dari data API        | Saat tombol "Tambah Favorit" diklik dari card negara          |
| 3  | Field status wishlist          | Pilihan: Wishlist, Want to Go, Visited, Planning              |
| 4  | Field catatan                  | Textarea opsional untuk catatan pribadi                       |
| 5  | Field tanggal ditambahkan      | Date picker, default hari ini                                 |
| 6  | Validasi form                  | Semua field wajib divalidasi sebelum disimpan                 |
| 7  | Flash message sukses           | "Negara berhasil ditambahkan ke favorit"                      |

### 4.2 Read (Lihat Favorit)
| No | Fitur                          | Keterangan                                                    |
|----|--------------------------------|---------------------------------------------------------------|
| 1  | Tabel data favorit             | Tampilkan semua data dari tabel `favorite_countries`          |
| 2  | Kolom tabel                    | No, Bendera, Nama, Region, Ibu Kota, Status, Catatan, Aksi   |
| 3  | Search favorit                 | Pencarian berdasarkan nama negara                             |
| 4  | Filter status                  | Filter berdasarkan status wishlist                            |
| 5  | Empty state                    | Pesan jika belum ada favorit                                  |

### 4.3 Update (Edit Favorit)
| No | Fitur                          | Keterangan                                                    |
|----|--------------------------------|---------------------------------------------------------------|
| 1  | Form edit favorit              | Pre-filled dengan data yang sudah ada                         |
| 2  | Edit status wishlist           | Dapat mengubah status                                         |
| 3  | Edit catatan                   | Dapat mengubah catatan pribadi                                |
| 4  | Validasi form                  | Sama seperti form tambah                                      |
| 5  | Flash message sukses           | "Data favorit berhasil diperbarui"                            |

### 4.4 Delete (Hapus Favorit)
| No | Fitur                          | Keterangan                                                    |
|----|--------------------------------|---------------------------------------------------------------|
| 1  | Tombol Hapus                   | Tombol merah di setiap baris tabel                            |
| 2  | Modal konfirmasi               | Pop-up konfirmasi sebelum menghapus                           |
| 3  | Hapus data dari database       | Menghapus record dari tabel `favorite_countries`              |
| 4  | Flash message sukses           | "Negara berhasil dihapus dari favorit"                        |

---

## 5. Pengaturan API

**Tujuan:** Mengelola endpoint API yang digunakan untuk mengambil data negara.

### Fitur Wajib:
| No | Fitur                          | Keterangan                                                    |
|----|--------------------------------|---------------------------------------------------------------|
| 1  | Tabel daftar API               | Menampilkan semua API yang tersimpan di database              |
| 2  | Form tambah API                | Nama API, URL, method, API key (opsional)                     |
| 3  | Tombol Test API                | Cek koneksi ke endpoint API, tampilkan status                 |
| 4  | Tombol Sync / Ambil Data       | Trigger pengambilan data terbaru dari API                     |
| 5  | Tombol Edit API                | Edit nama, URL, method, dan key API                           |
| 6  | Tombol Hapus API               | Hapus konfigurasi API dari database                           |
| 7  | Badge status API               | Connected (hijau) / Error (merah)                             |
| 8  | Riwayat last sync              | Tampilkan kapan terakhir kali data disinkronkan               |
| 9  | Response preview               | Tampilkan sebagian response saat test API                     |

---

## 6. Autentikasi Admin

**Tujuan:** Membatasi akses halaman admin hanya untuk pengguna yang sudah login.

### Fitur Wajib:
| No | Fitur                          | Keterangan                                                    |
|----|--------------------------------|---------------------------------------------------------------|
| 1  | Form login                     | Email + password                                              |
| 2  | Validasi login                 | Cek email dan password di database                            |
| 3  | Session pengguna               | Simpan data user di session setelah login berhasil            |
| 4  | Redirect setelah login         | Redirect ke dashboard                                         |
| 5  | Logout                         | Hapus session dan redirect ke login                           |
| 6  | Proteksi halaman admin         | Cek session sebelum akses halaman admin                       |
| 7  | Pesan error login              | "Email atau password salah"                                   |

---

## 7. Landing Page

**Tujuan:** Halaman beranda publik WorldInfo yang menarik dan informatif.

### Fitur Wajib:
| No | Fitur                          | Keterangan                                                    |
|----|--------------------------------|---------------------------------------------------------------|
| 1  | Hero section                   | Judul, deskripsi, dan tombol CTA                              |
| 2  | Fitur highlights               | Daftar fitur utama WorldInfo dalam card                       |
| 3  | Statistik                      | Total negara, region, dll                                     |
| 4  | Navigasi publik                | Navbar dengan link ke halaman relevan                         |

---

*Dokumen ini adalah acuan bagi pengembang saat mengimplementasikan setiap fitur WorldInfo.*
