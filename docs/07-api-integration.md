# 07 – API Integration

## Dokumentasi Integrasi REST Countries API

---

## Informasi API

| Atribut         | Detail                              |
|-----------------|-------------------------------------|
| Nama API        | REST Countries API                  |
| Versi           | v3.1                                |
| Base URL        | `https://restcountries.com/v3.1/`   |
| Autentikasi     | Tidak diperlukan (Public API)       |
| Format Response | JSON                                |
| Method          | GET                                 |
| Rate Limit      | Tidak ada (dalam batas wajar)       |

---

## Endpoint yang Digunakan

### 1. Ambil Semua Negara
```
GET https://restcountries.com/v3.1/all
```
- Mengembalikan array JSON berisi data semua negara (±250 negara)
- Digunakan pada halaman Daftar Negara dan Dashboard

### 2. Cari Negara Berdasarkan Nama
```
GET https://restcountries.com/v3.1/name/{name}
```
- `{name}` = nama negara (contoh: `indonesia`, `japan`)
- Mengembalikan array (bisa lebih dari 1 hasil jika nama mirip)
- Digunakan pada halaman Detail Negara

### 3. Filter Berdasarkan Region (opsional)
```
GET https://restcountries.com/v3.1/region/{region}
```
- `{region}` = Africa, Americas, Asia, Europe, Oceania
- Digunakan untuk filter negara berdasarkan region

---

## Data yang Digunakan dari Response

Dari setiap objek negara di response JSON, data yang digunakan:

| Field API             | Tipe       | Kegunaan                                  |
|-----------------------|------------|-------------------------------------------|
| `name.common`         | string     | Nama umum negara                          |
| `name.official`       | string     | Nama resmi negara                         |
| `flags.png`           | string URL | URL gambar bendera format PNG             |
| `flags.svg`           | string URL | URL gambar bendera format SVG             |
| `capital`             | array      | Array ibu kota (ambil index ke-0)         |
| `region`              | string     | Region negara (Asia, Europe, dll)         |
| `subregion`           | string     | Subregion negara                          |
| `population`          | integer    | Jumlah penduduk                           |
| `languages`           | object     | Object kode bahasa => nama bahasa         |
| `currencies`          | object     | Object kode mata uang => {name, symbol}   |
| `timezones`           | array      | Array zona waktu (UTC+07:00, dll)         |
| `maps.googleMaps`     | string URL | URL Google Maps negara                    |
| `cca2`                | string     | Kode negara 2 huruf (ID, JP, US)         |
| `cca3`                | string     | Kode negara 3 huruf (IDN, JPN, USA)      |

### Contoh Response JSON (Indonesia):
```json
{
  "name": {
    "common": "Indonesia",
    "official": "Republic of Indonesia"
  },
  "flags": {
    "png": "https://flagcdn.com/w320/id.png",
    "svg": "https://flagcdn.com/id.svg"
  },
  "capital": ["Jakarta"],
  "region": "Asia",
  "subregion": "South-Eastern Asia",
  "population": 273523615,
  "languages": {
    "ind": "Indonesian"
  },
  "currencies": {
    "IDR": {
      "name": "Indonesian rupiah",
      "symbol": "Rp"
    }
  },
  "timezones": ["UTC+07:00", "UTC+08:00", "UTC+09:00"],
  "maps": {
    "googleMaps": "https://goo.gl/maps/yyt2KMUuD7BNXf2E6"
  },
  "cca2": "ID",
  "cca3": "IDN"
}
```

---

## Implementasi dengan CURLRequest CI4

### Cara Menggunakan CURLRequest

```php
<?php
// Di dalam Controller

$client = \Config\Services::curlrequest();

$response = $client->request('GET', 'https://restcountries.com/v3.1/all', [
    'headers' => [
        'Accept' => 'application/json',
    ],
    'timeout' => 10,
    'verify'  => false,  // untuk development lokal
]);

$statusCode = $response->getStatusCode(); // 200, 404, 500, dll
$body       = $response->getBody();       // string JSON
$countries  = json_decode($body, true);   // array PHP
```

### Penanganan Error:

```php
try {
    $response   = $client->request('GET', $url);
    $countries  = json_decode($response->getBody(), true);

    if (empty($countries)) {
        // Empty state
    }
} catch (\Exception $e) {
    // Error state - tampilkan pesan error
    $error = $e->getMessage();
}
```

---

## Alur Integrasi API di WorldInfo

```
1. User membuka halaman Daftar Negara (/countries)
        │
        ▼
2. CountryController@index() dipanggil
        │
        ▼
3. Controller membaca endpoint API dari tabel api_settings
   (ambil API dengan status = 'Aktif')
        │
        ▼
4. Controller melakukan request GET ke endpoint API
   menggunakan Services::curlrequest()
        │
        ├──[Sukses]──▶ 5. Response JSON di-decode menjadi array PHP
        │                      │
        │                      ▼
        │              6. Data dikirim ke View (countries/index.php)
        │                      │
        │                      ▼
        │              7. View menampilkan data dalam bentuk card
        │
        └──[Gagal]───▶ 8. Set variabel $error = true
                               │
                               ▼
                       9. View menampilkan alert error state
```

---

## Penanganan Data di View

### Format Populasi:
```php
number_format($country['population'], 0, ',', '.')
// Output: 273.523.615
```

### Format Bahasa (dari object ke string):
```php
// $languages adalah array ['ind' => 'Indonesian', 'en' => 'English']
$langList = implode(', ', $languages);
// Output: "Indonesian, English"
```

### Format Mata Uang:
```php
// $currencies adalah ['IDR' => ['name' => 'Indonesian rupiah', 'symbol' => 'Rp']]
foreach ($currencies as $code => $info) {
    echo $info['name'] . ' (' . $code . ')';
}
// Output: "Indonesian rupiah (IDR)"
```

### Format Ibu Kota:
```php
$capital = $country['capital'][0] ?? 'Tidak diketahui';
```

---

## Penyimpanan Endpoint di Database

Endpoint API disimpan di tabel `api_settings` agar dapat diubah tanpa mengubah kode:

```
nama_api : "REST Countries API"
base_url : "https://restcountries.com/v3.1/all"
method   : "GET"
api_key  : NULL
status   : "Aktif"
```

Saat Controller mengambil data, ia akan query tabel `api_settings` terlebih dahulu:

```php
$apiSetting = $this->apiSettingModel->where('status', 'Aktif')->first();
$url = $apiSetting['base_url'];
```

---

## Status API

| Status Code | Keterangan                          | Tampilan di UI        |
|-------------|-------------------------------------|-----------------------|
| 200         | Sukses                              | Badge hijau "Connected"|
| 404         | Endpoint tidak ditemukan            | Badge merah "Error"   |
| 500         | Server error                        | Badge merah "Error"   |
| Timeout     | Koneksi timeout (>10 detik)         | Badge merah "Timeout" |
| Exception   | Gagal konek / network error         | Badge merah "Error"   |

---

*Dokumentasi ini adalah acuan teknis untuk implementasi integrasi API di WorldInfo.*
