# PRD: Halaman Fasilitas Kesehatan (Puskesmas & Rumah Sakit)

## 1. Overview
Halaman ini menampilkan peta dan daftar fasilitas kesehatan (Puskesmas & Rumah Sakit) di Kabupaten Cianjur. Diakses melalui menu navigasi **Faskes** pada navbar. Halaman ini fokus pada pencarian, filter, dan informasi kontak fasilitas kesehatan.

---

## 2. Struktur & Desain Halaman

### A. Header Halaman (Banner atas, di bawah Navbar)
- **Background**: `#065F46` (Dark Green) — konsisten dengan halaman profil
- **Judul**: Ukuran font `48px`, font-weight `800` (ExtraBold), warna `#FFFFFF`
- **Deskripsi singkat**: Ukuran font `16px`, warna `rgba(255,255,255,0.8)`, line-height `1.6`
- **Padding**: `60px 40px`

### B. Judul Section Utama
- **Judul**: "Peta & Daftar Puskesmas & Rumah Sakit"
  - Ukuran font: `32px`
  - Font-weight: `800` (ExtraBold)
  - Warna: `#1a1a1a`
- **Subjudul**: "Penilaian Anda sangat berharga untuk meningkatkan mutu pelayanan kesehatan di Kabupaten Cianjur."
  - Ukuran font: `14px`
  - Warna: `#6b7280` (abu-abu)

### C. Section Pencarian & Filter
- **Search Input**:
  - Placeholder: "Cari nama Puskesmas..."
  - Background: `#FFFFFF`
  - Border: `1px solid #e5e7eb`
  - Border-radius: `3px`
  - Tinggi: `44px`
- **Tombol Cari**:
  - Background: `#009966` (Brand Green)
  - Teks: `#FFFFFF`, font-weight `600`
  - Border-radius: `3px`
  - Padding: `10px 24px`
- **Dropdown Filter** (2 buah):
  - "Semua Wilayah..." dan "Semua Layanan..."
  - Background: `#FFFFFF`
  - Border: `1px solid #e5e7eb`
  - Border-radius: `3px`
  - Tinggi: `44px`
  - Icon chevron: SVG arrow down

### D. Konten Utama (2 Kolom)
Layout: `CSS Grid` atau `Flexbox` — 2 kolom

#### Kolom Kiri: Peta (Google Maps)
- **Lebar**: `50%` dari container
- **Tinggi**: `500px`
- **Border-radius**: `8px`
- **Overflow**: `hidden`
- **Integrasi**: Google Maps iframe atau JavaScript API
- **Marker**: Pin merah untuk lokasi puskesmas/rumah sakit

#### Kolom Kanan: Daftar Fasilitas (Card List)
- **Lebar**: `50%` dari container
- **Overflow-y**: `auto` (scrollable)
- **Gap antar card**: `16px`

### E. Card Fasilitas Kesehatan
- **Background**: `#FFFFFF`
- **Border**: `1px solid #e5e7eb`
- **Border-radius**: `8px`
- **Padding**: `20px`
- **Shadow**: `0 2px 8px rgba(0,0,0,0.06)`

**Isi Card:**
1. **Nama Fasilitas**:
   - Ukuran font: `18px`
   - Font-weight: `700` (Bold)
   - Warna: `#1a1a1a`

2. **Badge/Tag** (horizontal, gap `8px`):
   - Badge hijau: Background `#d1fae5`, teks `#065f46`, border-radius `3px`, padding `4px 10px`, font-size `12px`, font-weight `600`
     - Contoh: "Rawat Inap"
   - Badge biru: Background `#dbeafe`, teks `#1e40af`, border-radius `3px`, padding `4px 10px`, font-size `12px`, font-weight `600`
     - Contoh: "Akreditasi Paripurna"

3. **Alamat**:
   - Icon: SVG map pin (kiri)
   - Ukuran font: `13px`
   - Warna: `#6b7280`

4. **Telepon**:
   - Icon: SVG phone (kiri)
   - Ukuran font: `13px`
   - Warna: `#6b7280`

5. **Jam Operasional**:
   - Icon: SVG clock (kiri)
   - Ukuran font: `13px`
   - Warna: `#6b7280`
   - Contoh: "Senin - Sabtu, 07.30 - 14.00 (Gawat Darurat 24 jam)"

6. **Tombol Aksi** (2 tombol, horizontal):
   - **"Lihat di Peta"**:
     - Border: `1px solid #009966`
     - Teks: `#009966`
     - Background: `transparent`
     - Border-radius: `3px`
     - Font-size: `14px`, font-weight: `600`
     - Padding: `8px 16px`
   - **"Hubungi WA"**:
     - Border: `1px solid #d1d5db`
     - Teks: `#374151`
     - Background: `transparent`
     - Border-radius: `3px`
     - Font-size: `14px`, font-weight: `600`
     - Padding: `8px 16px`

---

## 3. Responsive Design

### Desktop (> 1024px)
- 2 kolom: Peta (kiri) + Daftar (kanan)

### Tablet (768px - 1024px)
- 2 kolom, peta lebih kecil

### Mobile (< 768px)
- 1 kolom: Peta di atas, daftar di bawah
- Search & filter stacked vertically
- Card full width

---

## 4. Asset & File yang Dibutuhkan

### File baru:
| File | Lokasi | Keterangan |
|------|--------|------------|
| `faskes.blade.php` | `resources/views/` | Halaman utama |
| `faskes.blade.php` | `resources/views/components/home/` | Component section |
| `faskes.css` | `public/css/home/` | Styling |

### Asset gambar:
| Gambar | Keterangan |
|--------|------------|
| `maps-placeholder.png` | Placeholder peta (jika belum integrasi Google Maps) |

---

## 5. Route

```php
Route::get('/faskes', function () {
    return view('faskes');
})->name('faskes');
```

---

## 6. Integrasi Google Maps (Opsional / Future)

- Menggunakan Google Maps JavaScript API
- Marker untuk setiap puskesmas/rumah sakit
- Klik marker menampilkan info window dengan data fasilitas
- Default: iframe embed peta Kabupaten Cianjur

---

## 7. Pertanyaan Klarifikasi / Diskusi (Open Questions)

1. **Sumber Data Fasilitas**:
   * Apakah data puskesmas & rumah sakit diambil dari database (API), atau hardcoded/dummy untuk sementara? sementara dummy

2. **Integrasi Peta**:
   * Apakah peta harus menggunakan Google Maps API (interaktif dengan marker), atau cukup iframe embed statis? dummy dulu

3. **Filter Wilayah**:
   * Apakah filter "Semua Wilayah" berdasarkan kecamatan, atau berdasarkan zona (utara/selatan/timur/barat)? mencakup semua wilayah cianjur sekarang dummy dulu

4. **Filter Layanan**:
   * Apakah filter "Semua Layanan" berdasarkan jenis layanan (rawat inap, IGD, laboratorium, dll)?ya

5. **Detail Fasilitas**:
   * Apakah ada halaman detail tersendiri ketika klik nama fasilitas, atau cukup tampilkan info di card? iya
  

6. **Integrasi WhatsApp**:
   * Nomor WA diambil dari mana? Apakah nomor tetap atau dinamis per fasilitas? dummy dulu

---

## 8. Data Dummy (untuk development)

```php
$fasilitas = [
    [
        'nama' => 'Rumah Sakit Sayang',
        'jenis' => 'Rumah Sakit',
        'badge' => ['Rawat Inap', 'Akreditasi Paripurna'],
        'alamat' => 'Jl. Suroso No.1 Kec. Cianjur, Kabupaten Cianjur',
        'telepon' => '(0263) 26318',
        'jam' => 'Senin - Sabtu, 07.30 - 14.00 (Gawat Darurat 24 jam)',
        'lat' => -6.8133,
        'lng' => 107.1414,
    ],
    // ... tambah data lain
];
```
