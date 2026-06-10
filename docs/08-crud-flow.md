# 08 – CRUD Flow

## Alur CRUD Favorit Negara

Dokumen ini menjelaskan alur lengkap operasi Create, Read, Update, dan Delete untuk fitur Favorit Negara di WorldInfo.

---

## Gambaran Umum

Fitur CRUD Favorit Negara memungkinkan pengguna untuk menyimpan, melihat, mengedit, dan menghapus negara favorit/wishlist mereka. Data favorit disimpan di tabel `favorite_countries` dalam database MySQL.

---

## 1. CREATE – Tambah Favorit

### Skenario A: Dari Halaman Daftar Negara (Auto-Fill)

```
User melihat daftar negara (card view)
        │
        ▼
User klik tombol "♥ Tambah Favorit" di card negara
        │
        ▼
JavaScript menangkap data negara dari atribut data-* card:
  - data-nama, data-official, data-flag, data-region,
  - data-subregion, data-capital, data-population,
  - data-languages, data-currencies, data-timezones, data-maps
        │
        ▼
Modal "Tambah ke Favorit" muncul dengan data sudah ter-isi otomatis
  - Field yang tampil: status_wishlist (dropdown), catatan (textarea)
  - Field tersembunyi: semua data negara dari API
        │
        ▼
User memilih status wishlist dan mengisi catatan (opsional)
        │
        ▼
User klik tombol "Simpan"
        │
        ▼
Form POST ke /favorites/store
        │
        ▼
FavoriteController@store()
  - Validasi input
  - Simpan ke tabel favorite_countries via FavoriteCountryModel
        │
        ├──[Sukses]──▶ Redirect ke /favorites dengan flash success
        └──[Gagal] ──▶ Redirect kembali dengan flash error
```

### Skenario B: Dari Form Manual (/favorites/create)

```
User klik "Tambah Favorit" di sidebar atau halaman favorit
        │
        ▼
Navigasi ke /favorites/create (FavoriteController@create)
        │
        ▼
Tampilkan form tambah favorit dengan semua field
        │
        ▼
User mengisi form dan klik "Simpan"
        │
        ▼
POST ke /favorites/store (FavoriteController@store)
        │
        ▼
Proses sama seperti Skenario A (validasi & simpan)
```

### Validasi Form:
| Field               | Aturan Validasi                          |
|---------------------|------------------------------------------|
| nama_negara         | required, max_length[100]                |
| status_wishlist     | required, in_list[Wishlist,Want to Go,Visited,Planning] |
| catatan             | permit_empty, max_length[1000]           |
| tanggal_ditambahkan | required, valid_date                     |

---

## 2. READ – Lihat Daftar Favorit

```
User klik menu "Favorit" di sidebar
        │
        ▼
Navigasi ke /favorites (FavoriteController@index)
        │
        ▼
Controller query tabel favorite_countries:
  - $favorites = $this->favoriteModel->findAll()
  - Jika ada search: WHERE nama_negara LIKE '%query%'
  - Jika ada filter: WHERE status_wishlist = 'Wishlist'
        │
        ▼
Data dikirim ke View (favorites/index.php)
        │
        ▼
View menampilkan tabel dengan kolom:
  No | Bendera | Nama Negara | Region | Ibu Kota | Status | Catatan | Aksi
        │
        ├──[Data ada]  ──▶ Tampilkan tabel data favorit
        ├──[Data kosong]─▶ Tampilkan empty state
        └──[Search]   ──▶ Filter data sesuai query pencarian
```

---

## 3. UPDATE – Edit Favorit

```
User klik tombol "Edit" (icon pensil warna orange) di baris tabel
        │
        ▼
Navigasi ke /favorites/edit/{id} (FavoriteController@edit)
        │
        ▼
Controller query data: $favorite = $this->favoriteModel->find($id)
  - Jika tidak ditemukan: redirect ke /favorites dengan error 404
        │
        ▼
View menampilkan form edit yang sudah ter-isi (pre-filled):
  - status_wishlist (dropdown)
  - catatan (textarea)
  - tanggal_ditambahkan (date input)
        │
        ▼
User mengubah data yang ingin diperbarui
        │
        ▼
User klik tombol "Update"
        │
        ▼
POST ke /favorites/update/{id} (FavoriteController@update)
        │
        ▼
Controller:
  - Validasi input
  - Update record: $this->favoriteModel->update($id, $data)
        │
        ├──[Sukses]──▶ Redirect ke /favorites dengan flash success
        └──[Gagal] ──▶ Redirect kembali dengan error validasi
```

---

## 4. DELETE – Hapus Favorit

```
User klik tombol "Hapus" (icon trash warna merah) di baris tabel
        │
        ▼
JavaScript menampilkan modal konfirmasi:
  "Apakah Anda yakin ingin menghapus [nama negara] dari favorit?"
  [Batal] [Ya, Hapus]
        │
        ├──[Batal]──▶ Modal ditutup, tidak ada aksi
        │
        └──[Ya, Hapus]──▶ Navigasi ke /favorites/delete/{id}
                                   │
                                   ▼
                          FavoriteController@delete($id)
                                   │
                                   ▼
                          $this->favoriteModel->delete($id)
                                   │
                                   ▼
                          Redirect ke /favorites dengan flash success
```

---

## Struktur URL CRUD

| Operasi | Method | URL                        | Controller Method         |
|---------|--------|----------------------------|---------------------------|
| List    | GET    | `/favorites`               | `FavoriteController@index` |
| Form Add| GET    | `/favorites/create`        | `FavoriteController@create`|
| Store   | POST   | `/favorites/store`         | `FavoriteController@store` |
| Form Edit| GET   | `/favorites/edit/{id}`     | `FavoriteController@edit`  |
| Update  | POST   | `/favorites/update/{id}`   | `FavoriteController@update`|
| Delete  | GET    | `/favorites/delete/{id}`   | `FavoriteController@delete`|

---

## Flash Messages

Semua operasi CRUD menggunakan CodeIgniter 4 session flash data:

```php
// Set flash message
session()->setFlashdata('success', 'Negara berhasil ditambahkan ke favorit!');
session()->setFlashdata('error', 'Terjadi kesalahan. Silakan coba lagi.');

// Tampilkan di view (partials/alert.php)
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>
```

---

## CRUD Pengaturan API (Ringkasan)

| Operasi     | URL                           | Keterangan                          |
|-------------|-------------------------------|-------------------------------------|
| List        | `/api-settings`               | Tampilkan semua API setting         |
| Store       | `/api-settings/store`         | Simpan API setting baru             |
| Update      | `/api-settings/update/{id}`   | Perbarui API setting                |
| Delete      | `/api-settings/delete/{id}`   | Hapus API setting                   |
| Test API    | `/api-settings/test`          | Test koneksi ke endpoint API        |
| Sync        | `/api-settings/sync`          | Ambil data terbaru dari API         |

---

*Alur CRUD ini wajib diikuti untuk menjaga konsistensi implementasi di seluruh halaman WorldInfo.*
