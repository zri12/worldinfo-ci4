# 03 – UI Design Guideline

## Panduan Desain WorldInfo

Dokumen ini berisi panduan desain yang wajib diikuti agar seluruh tampilan halaman di WorldInfo konsisten, modern, dan profesional.

---

## Gaya Desain Utama

| Aspek             | Deskripsi                                                  |
|-------------------|------------------------------------------------------------|
| Gaya              | Modern Dashboard, Clean, Professional                      |
| Layout            | Card-based layout, sidebar + content area                  |
| Sudut             | Rounded corners (border-radius 8–16px)                     |
| Bayangan          | Soft shadow (`box-shadow: 0 2px 12px rgba(0,0,0,0.08)`)   |
| Responsive        | Mobile-first, breakpoint Bootstrap 5                       |
| Tipografi         | Inter / Poppins / Nunito (Google Fonts)                    |
| Spacing           | Konsisten menggunakan utility Bootstrap (p-3, p-4, gap-3)  |

---

## Palet Warna

### Warna Utama (Primary Palette)

| Nama              | Hex        | Kegunaan                                          |
|-------------------|------------|---------------------------------------------------|
| Navy Blue         | `#1e3a5f`  | Warna utama sidebar, header, button primary       |
| Cyan / Sky Blue   | `#00b4d8`  | Aksen, badge, highlight, link aktif               |
| Deep Blue         | `#0077b6`  | Hover button, gradient                            |

### Warna Background

| Nama              | Hex        | Kegunaan                                          |
|-------------------|------------|---------------------------------------------------|
| Off White         | `#f0f4f8`  | Background halaman utama                          |
| White             | `#ffffff`  | Background card, form, modal                      |
| Light Gray        | `#e8edf2`  | Border, divider, tabel header                     |

### Warna Teks

| Nama              | Hex        | Kegunaan                                          |
|-------------------|------------|---------------------------------------------------|
| Dark Gray         | `#2d3748`  | Teks utama / body                                 |
| Medium Gray       | `#718096`  | Teks sub / placeholder / label                    |
| Light Text        | `#a0aec0`  | Teks disabled / hint                              |

### Warna Status

| Nama              | Hex        | Kegunaan                                          |
|-------------------|------------|---------------------------------------------------|
| Success Green     | `#38a169`  | Status aktif, pesan sukses, badge hijau           |
| Warning Orange    | `#dd6b20`  | Status perhatian, button edit, badge orange       |
| Danger Red        | `#e53e3e`  | Status error, button hapus, alert error           |
| Info Blue         | `#3182ce`  | Info umum, badge info                             |

---

## Aturan Layout

### Sidebar
- Lebar: **260px** (desktop), **0px** (mobile, bisa toggle)
- Background: **Navy Blue** (`#1e3a5f`)
- Teks menu: **white/light gray**
- Menu aktif: **background lebih terang** + **left border Cyan**
- Logo/Brand di bagian atas sidebar
- Icon menu menggunakan Bootstrap Icons / Font Awesome

### Topbar
- Tinggi: **64px**
- Background: **white**
- Shadow ringan di bagian bawah
- Berisi: hamburger menu (mobile), judul halaman, user info, notifikasi
- Sticky di bagian atas

### Content Area
- Padding: `24px` kiri-kanan, `20px` atas-bawah
- Background: **Off White** (`#f0f4f8`)
- Mengisi sisa lebar layar setelah sidebar

### Footer
- Tinggi: **auto**
- Background: **white**
- Border top: `1px solid #e8edf2`
- Teks kecil, centered, warna medium gray

---

## Komponen UI

### Card
```css
border-radius: 12px;
box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
background: #ffffff;
border: none;
padding: 20px;
```

- Card statistik dashboard menggunakan ikon besar + angka besar
- Card negara menggunakan bendera + nama + badge region

### Button

| Jenis           | Class Bootstrap         | Keterangan              |
|-----------------|-------------------------|-------------------------|
| Primary         | `btn-primary`           | Aksi utama, simpan      |
| Edit / Update   | `btn-warning`           | Aksi edit, perbarui     |
| Delete / Hapus  | `btn-danger`            | Aksi hapus              |
| Cancel / Batal  | `btn-secondary`         | Batal, kembali          |
| Info / Detail   | `btn-info` / `btn-outline-primary` | Lihat detail |
| Success         | `btn-success`           | Konfirmasi, selesai     |

Semua button menggunakan `border-radius: 8px` dan ukuran konsisten.

### Table

- Header tabel: background `#eaf4fb` (soft blue-gray), teks `#1e3a5f`, font-weight 600
- Row hover: background `#f5f9fc`
- Border: ringan, `border-color: #e8edf2`
- Padding cell: `12px 16px`
- Responsive: dibungkus `div.table-responsive`

### Badge

| Status          | Class                   | Keterangan              |
|-----------------|-------------------------|-------------------------|
| Aktif           | `badge bg-success`      | API aktif, status aktif |
| Tidak Aktif     | `badge bg-danger`       | API mati, tidak aktif   |
| Wishlist        | `badge bg-primary`      | Status wishlist         |
| Visited         | `badge bg-info`         | Sudah dikunjungi        |
| Want to Go      | `badge bg-warning`      | Ingin dikunjungi        |

### Alert

- Selalu menggunakan `alert-dismissible fade show`
- Success: `alert-success`
- Error: `alert-danger`
- Warning: `alert-warning`
- Info: `alert-info`
- Ditempatkan di bagian atas content area

### Form

- Label: `form-label fw-semibold text-dark`
- Input: `form-control` dengan `border-radius: 8px`
- Select: `form-select`
- Textarea: `form-control` minimal 3 baris
- Validasi: merah untuk error, hijau untuk valid

### Modal

- Gunakan modal Bootstrap 5 untuk form tambah, edit, dan konfirmasi hapus
- Header modal: background navy blue, teks putih
- Footer modal: button Cancel (secondary) dan Simpan (primary)
- Modal confirmasi hapus: tombol Hapus warna merah

---

## Aturan Konsistensi

1. **Semua halaman admin wajib menggunakan `admin_layout.php`**
2. **Semua halaman publik wajib menggunakan `public_layout.php`**
3. Sidebar dan topbar harus identik di seluruh halaman admin
4. Warna button harus konsisten (lihat tabel button di atas)
5. Badge status harus menggunakan warna yang sama di semua halaman
6. Alert pesan sukses/error harus menggunakan format yang sama
7. Semua form input harus konsisten (border-radius, padding, label)
8. Card wajib menggunakan rounded corner dan soft shadow
9. Tabel wajib menggunakan header soft blue
10. Halaman yang memuat data dari API harus memiliki loading state, empty state, dan error state

---

## Loading / Empty / Error State

### Loading State
```html
<div class="text-center py-5">
  <div class="spinner-border text-primary" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
  <p class="mt-3 text-muted">Memuat data...</p>
</div>
```

### Empty State
```html
<div class="text-center py-5">
  <i class="bi bi-inbox fs-1 text-muted"></i>
  <h5 class="mt-3 text-muted">Tidak ada data ditemukan</h5>
  <p class="text-muted">Belum ada data yang tersedia saat ini.</p>
</div>
```

### Error State
```html
<div class="alert alert-danger" role="alert">
  <i class="bi bi-exclamation-triangle-fill me-2"></i>
  Terjadi kesalahan saat mengambil data. Silakan coba lagi.
</div>
```

---

*Seluruh anggota tim wajib mengikuti panduan desain ini untuk menjaga konsistensi visual WorldInfo.*
