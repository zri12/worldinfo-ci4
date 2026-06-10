# 10 – Development Rules

## Aturan Pengembangan WorldInfo

Dokumen ini berisi aturan wajib yang harus diikuti oleh semua anggota tim saat mengembangkan project WorldInfo.

---

## 1. Aturan Umum (General Rules)

| No | Aturan                                                                              |
|----|-------------------------------------------------------------------------------------|
| 1  | Gunakan konsep **MVC (Model-View-Controller)** CodeIgniter 4 secara konsisten       |
| 2  | **Jangan menulis query database langsung di View** (anti-pattern)                   |
| 3  | Semua proses database harus melalui **Model** (FavoriteCountryModel, dll)           |
| 4  | **Controller** hanya bertugas mengatur alur data antara Model dan View              |
| 5  | **View** hanya berisi HTML dan tampilan, tidak ada logika bisnis                    |
| 6  | Semua halaman admin wajib menggunakan **`admin_layout.php`**                        |
| 7  | Semua halaman publik wajib menggunakan **`public_layout.php`**                      |
| 8  | Gunakan **CI4 Validation** untuk semua validasi input form                          |
| 9  | Gunakan **CI4 Session** untuk autentikasi dan flash message                         |
| 10 | Jangan hardcode URL — selalu gunakan **`base_url()`** dan **`site_url()`**          |

---

## 2. Aturan Penamaan (Naming Convention)

| Kategori         | Konvensi                        | Contoh                              |
|------------------|---------------------------------|-------------------------------------|
| Controller       | PascalCase + "Controller"       | `DashboardController.php`           |
| Model            | PascalCase + "Model"            | `FavoriteCountryModel.php`          |
| View (folder)    | snake_case                      | `api_settings/`, `favorite/`        |
| View (file)      | snake_case                      | `index.php`, `create.php`           |
| Migration        | PascalCase deskriptif           | `CreateFavoriteCountriesTable.php`  |
| Seeder           | PascalCase + "Seeder"           | `ApiSettingSeeder.php`              |
| CSS Class        | kebab-case                      | `.country-card`, `.sidebar-menu`    |
| JS Function      | camelCase                       | `testApiConnection()`, `loadData()` |
| Database Column  | snake_case                      | `nama_negara`, `status_wishlist`    |

---

## 3. Aturan UI / Frontend

| No | Aturan                                                                              |
|----|-------------------------------------------------------------------------------------|
| 1  | Gunakan **Bootstrap 5** sebagai framework CSS utama                                 |
| 2  | Custom CSS hanya di `public/assets/css/style.css` dan `responsive.css`             |
| 3  | Custom JS hanya di folder `public/assets/js/`                                      |
| 4  | **Jangan** menulis CSS inline kecuali untuk nilai dinamis dari PHP                 |
| 5  | Semua komponen harus **konsisten** di seluruh halaman                               |
| 6  | Gunakan **card** untuk menampilkan data negara                                      |
| 7  | Gunakan **tabel** untuk data favorit dan API settings                               |
| 8  | Gunakan **modal Bootstrap** untuk form tambah/edit/hapus jika memungkinkan          |
| 9  | Gunakan **badge** untuk status (Aktif, Tidak Aktif, Wishlist, dll)                  |
| 10 | Gunakan **alert Bootstrap** untuk pesan sukses/error                                |
| 11 | Setiap halaman yang memuat data dari API wajib memiliki:                            |
|    | - **Loading state** (spinner)                                                       |
|    | - **Empty state** (pesan kosong)                                                    |
|    | - **Error state** (alert error)                                                     |
| 12 | Semua form input menggunakan `form-control` dengan `border-radius: 8px`             |
| 13 | Sidebar dan topbar harus identik di semua halaman admin                             |
| 14 | **Jangan** menggunakan React, Vue, Next.js, TypeScript, atau TSX                   |

---

## 4. Aturan API

| No | Aturan                                                                              |
|----|-------------------------------------------------------------------------------------|
| 1  | Request ke API menggunakan **`Services::curlrequest()`** bawaan CI4                 |
| 2  | **Endpoint API utama disimpan di database** (tabel `api_settings`), bukan hardcode  |
| 3  | Selalu bungkus request API dalam **try-catch** untuk menangani error               |
| 4  | Jika API gagal/error, **tampilan tidak boleh rusak** — tampilkan pesan error yang jelas |
| 5  | Timeout request API: **maksimal 10 detik** (`'timeout' => 10`)                      |
| 6  | Update kolom `last_sync` di `api_settings` setiap kali sync berhasil               |
| 7  | Jangan simpan seluruh response API ke sesi — hanya simpan data yang dibutuhkan      |

---

## 5. Aturan Database

| No | Aturan                                                                              |
|----|-------------------------------------------------------------------------------------|
| 1  | Selalu gunakan **Migration** untuk membuat/mengubah struktur tabel                  |
| 2  | Selalu gunakan **Seeder** untuk mengisi data awal                                   |
| 3  | Aktifkan **timestamps** (`$useTimestamps = true`) di semua Model                    |
| 4  | Definisikan **`$allowedFields`** di setiap Model untuk keamanan mass assignment     |
| 5  | Gunakan **`password_hash()`** untuk enkripsi password user                          |
| 6  | Gunakan **`password_verify()`** untuk verifikasi password saat login                |
| 7  | Kolom JSON (languages, currencies, timezones) disimpan sebagai TEXT dengan `json_encode()` |
| 8  | Saat menampilkan, decode kolom JSON menggunakan `json_decode($value, true)`         |

---

## 6. Aturan Keamanan

| No | Aturan                                                                              |
|----|-------------------------------------------------------------------------------------|
| 1  | Aktifkan **CSRF protection** CI4 untuk semua form POST                              |
| 2  | Gunakan **`esc()`** helper CI4 untuk semua output variabel di View (XSS prevention) |
| 3  | Validasi semua input form menggunakan **CI4 Validation**                            |
| 4  | Proteksi halaman admin dengan **pengecekan session login**                           |
| 5  | Jangan tampilkan error PHP mentah di production — gunakan CI4 error handling        |
| 6  | Simpan API key di database, bukan di file `.env` yang bisa diakses publik           |

---

## 7. Aturan Version Control (Git)

| No | Aturan                                                                              |
|----|-------------------------------------------------------------------------------------|
| 1  | Buat branch fitur baru: `feature/nama-fitur`                                        |
| 2  | Pesan commit harus deskriptif: `feat: add favorite country CRUD`                    |
| 3  | Jangan commit file `.env`, `vendor/`, atau file sensitif                            |
| 4  | Selalu pull dari main sebelum mulai bekerja                                          |
| 5  | Lakukan code review sebelum merge ke branch main                                    |

---

## 8. Aturan Referensi UI TSX

| No | Aturan                                                                              |
|----|-------------------------------------------------------------------------------------|
| 1  | File TSX di `UI.zip` **HANYA** digunakan sebagai referensi desain visual            |
| 2  | **Jangan** mengkonversi atau menggunakan kode TSX secara langsung                   |
| 3  | **Jangan** menginstal React, Next.js, atau TypeScript dalam project CI4             |
| 4  | Implementasikan ulang semua tampilan menggunakan PHP View, Bootstrap 5, dan CSS custom |
| 5  | Ambil inspirasi dari: layout, warna, komponen, dan konsistensi desain dari TSX     |

---

## Checklist Pengembangan Fitur Baru

Sebelum push ke repository, pastikan:

- [ ] Controller tidak memiliki query langsung ke database
- [ ] Model memiliki `$allowedFields` yang lengkap
- [ ] View menggunakan `esc()` untuk semua output variabel
- [ ] Form memiliki validasi CI4
- [ ] Ada flash message untuk setiap aksi CRUD
- [ ] Ada loading, empty, dan error state untuk halaman yang memuat API
- [ ] Layout menggunakan `admin_layout.php` atau `public_layout.php`
- [ ] CSS tambahan hanya di file `style.css` atau `responsive.css`
- [ ] Tidak ada hardcode URL

---

*Aturan ini wajib diikuti untuk menjaga kualitas dan konsistensi kode project WorldInfo.*
