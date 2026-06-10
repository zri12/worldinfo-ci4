# 11 – Reference UI Mapping

## Mapping Referensi UI TSX ke Implementasi CI4

Dokumen ini menjelaskan pemetaan antara file referensi UI (TSX/React) yang ada di `UI.zip` dengan implementasi final menggunakan CodeIgniter 4.

---

## Catatan Penting

> ⚠️ **File TSX HANYA sebagai referensi tampilan.**
> - Jangan menggunakan kode TSX secara langsung di project CI4
> - Jangan menginstal React, Next.js, atau TypeScript
> - Implementasikan ulang semua tampilan dengan PHP View, Bootstrap 5, dan CSS Custom
> - Ambil inspirasi dari: **layout, warna, struktur komponen, dan konsistensi desain**

---

## Mapping Halaman

| File Referensi TSX        | Implementasi CI4                              | Keterangan                              |
|---------------------------|-----------------------------------------------|-----------------------------------------|
| `Dashboard.tsx`           | `app/Views/dashboard/index.php`               | Dashboard admin                         |
| `Countries.tsx`           | `app/Views/countries/index.php`               | Daftar negara dengan search & filter    |
| `CountryDetail.tsx`       | `app/Views/countries/detail.php`              | Detail lengkap satu negara              |
| `Favorites.tsx`           | `app/Views/favorites/index.php`               | Tabel daftar favorit + CRUD             |
| `FavoriteCreate.tsx`      | `app/Views/favorites/create.php`              | Form tambah favorit manual              |
| `FavoriteEdit.tsx`        | `app/Views/favorites/edit.php`                | Form edit data favorit                  |
| `ApiSettings.tsx`         | `app/Views/api_settings/index.php`            | Manajemen konfigurasi API               |
| `About.tsx`               | `app/Views/about/index.php`                   | Halaman tentang website                 |
| `Landing.tsx`             | `app/Views/landing/index.php`                 | Landing page publik                     |
| `Login.tsx`               | `app/Views/auth/login.php`                    | Halaman login admin                     |

---

## Mapping Layout & Komponen

| Komponen TSX              | Implementasi CI4                              | Keterangan                              |
|---------------------------|-----------------------------------------------|-----------------------------------------|
| `AdminLayout.tsx`         | `app/Views/layouts/admin_layout.php`          | Layout master halaman admin             |
| `PublicLayout.tsx`        | `app/Views/layouts/public_layout.php`         | Layout master halaman publik            |
| `Sidebar.tsx`             | `app/Views/partials/sidebar.php`              | Sidebar navigasi kiri                   |
| `Topbar.tsx`              | `app/Views/partials/topbar.php`               | Header atas admin                       |
| `Footer.tsx`              | `app/Views/partials/footer.php`               | Footer halaman                          |
| `Alert.tsx`               | `app/Views/partials/alert.php`                | Komponen flash message alert            |
| `CountryCard.tsx`         | Inline di `countries/index.php`               | Card tampilan negara                    |
| `StatCard.tsx`            | Inline di `dashboard/index.php`               | Card statistik dashboard                |
| `Modal.tsx`               | Modal Bootstrap 5 inline di view              | Modal form dan konfirmasi               |
| `Badge.tsx`               | Badge Bootstrap 5 inline di view              | Badge status negara                     |
| `LoadingSpinner.tsx`      | Inline di view (Bootstrap spinner)            | Indikator loading                       |
| `EmptyState.tsx`          | Inline di view (HTML custom)                  | Tampilan data kosong                    |
| `ErrorState.tsx`          | Inline di view (alert Bootstrap)              | Tampilan error                          |

---

## Mapping Komponen Teknis

| Konsep di TSX/React           | Padanan di CI4 / PHP                        |
|-------------------------------|---------------------------------------------|
| `useState()`                  | Variabel PHP / JavaScript biasa             |
| `useEffect()` (API fetch)     | `Services::curlrequest()` di Controller     |
| `props` (data passing)        | `$data[]` array yang dikirim dari Controller ke View |
| `map()` (render list)         | `foreach` loop di PHP View                  |
| `axios.get()` / `fetch()`     | `Services::curlrequest()` di Controller     |
| React Router (`useNavigate`)  | CI4 Routing + `redirect()` helper           |
| Context / Redux (global state)| CI4 Session                                 |
| `className="..."` (JSX)       | `class="..."` (HTML standar)                |
| `{variable}` (JSX expression) | `<?= esc($variable) ?>` (PHP echo)          |
| Component file (`.tsx`)       | PHP View file (`.php`) + `include()`        |
| `import` / `export`           | `<?= $this->include('partials/sidebar') ?>` |

---

## Yang Diambil dari Referensi TSX

### Layout & Struktur
- ✅ Posisi dan lebar sidebar (260px)
- ✅ Tinggi dan konten topbar (64px)
- ✅ Struktur grid card di dashboard
- ✅ Layout dua kolom untuk detail negara
- ✅ Posisi dan isi footer

### Warna & Tema
- ✅ Navy Blue sebagai warna utama sidebar
- ✅ Cyan/Sky Blue sebagai warna aksen
- ✅ Off-White sebagai background content area
- ✅ Warna badge status (success, warning, danger)

### Komponen UI
- ✅ Card negara (bendera + info + tombol)
- ✅ Card statistik dashboard (ikon + angka + label)
- ✅ Tabel favorit (kolom dan styling)
- ✅ Form pengaturan API
- ✅ Modal konfirmasi hapus
- ✅ Navbar sidebar dengan icon

### Interaksi
- ✅ Hover effect pada card dan menu sidebar
- ✅ Collapse sidebar pada mobile
- ✅ Search filter real-time

---

## Yang TIDAK Diambil dari Referensi TSX

- ❌ Kode JSX / TSX secara langsung
- ❌ Logika state management React (useState, useContext, dll)
- ❌ Dependensi npm / package.json React
- ❌ TypeScript type definitions
- ❌ React hooks (useEffect, useMemo, dll)
- ❌ Component-based architecture React

---

## Panduan Implementasi dari Referensi

### Langkah Membaca Referensi TSX:

1. **Buka file `.tsx`** dari `UI.zip`
2. **Identifikasi struktur HTML** dari JSX (abaikan syntax JSX, ambil struktur tag-nya)
3. **Identifikasi class CSS** yang digunakan (sebagian besar sudah Bootstrap/Tailwind)
4. **Konversi ke Bootstrap 5** jika menggunakan Tailwind
5. **Implementasikan di PHP View** dengan syntax PHP echo/foreach/if
6. **Terapkan warna dan spacing** sesuai panduan di `03-ui-design-guideline.md`

### Contoh Konversi:

**TSX (Referensi):**
```tsx
<div className="country-card">
  <img src={country.flags.png} alt={country.name.common} />
  <h5>{country.name.common}</h5>
  <span className="badge badge-region">{country.region}</span>
</div>
```

**PHP View (Implementasi CI4):**
```php
<div class="country-card">
  <img src="<?= esc($country['flags']['png']) ?>" 
       alt="<?= esc($country['name']['common']) ?>">
  <h5><?= esc($country['name']['common']) ?></h5>
  <span class="badge bg-primary"><?= esc($country['region']) ?></span>
</div>
```

---

*Dokumen ini adalah panduan untuk memastikan implementasi CI4 konsisten secara visual dengan referensi UI TSX.*
