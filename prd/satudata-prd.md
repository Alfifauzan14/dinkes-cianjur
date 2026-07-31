# Product Requirements Document (PRD) - Satu Data Kesehatan
## Portal Resmi Dinas Kesehatan Kabupaten Cianjur

Dokumen ini mendefinisikan spesifikasi desain, komponen, visual tokens, dan struktur antarmuka untuk fitur/halaman **Satu Data Kesehatan Kabupaten Cianjur** berdasarkan referensi mockup desain.

---

## 1. Visual Tokens (Spesifikasi Tampilan)

| Elemen Desain | Spesifikasi Visual | Implementasi CSS | Keterangan |
| :--- | :--- | :--- | :--- |
| **Font Family** | `Plus Jakarta Sans` | `font-family: 'Plus Jakarta Sans', sans-serif;` | Font seragam seluruh portal |
| **Banner Header BG** | Hijau Pekat (`#064E3B` / `#065F46`) | `background: linear-gradient(135deg, #064E3B 0%, #004D34 100%);` | Latar header banner atas |
| **Banner Title** | `32px - 36px`, Bold (`700`/`800`) | `font-size: 32px; font-weight: 800; color: #FFFFFF;` | "Satu Data Kesehatan Kabupaten Cianjur" |
| **Banner Subtitle** | `14px - 16px`, Regular (`400`) | `color: rgba(255, 255, 255, 0.8);` | Penjelasan pusat data terpadu |
| **Category Label** | `14px`, Bold (`700`) | `color: #00BC7D; font-weight: 700;` | "Satu Data Kesehatan" |
| **Section Title** | `32px`, Extra Bold (`800`) | `font-size: 32px; font-weight: 800; color: #111827;` | "Dashboard Indikator Utama" |
| **Status Indicator** | `14px`, SemiBold (`600`) | `color: #00BC7D;` | "● Data Riil Semester I 2026" |
| **Card Background** | Putih (`#FFFFFF`) | `background: #FFFFFF; border-radius: 12px;` | Shadow lembut `0 4px 20px rgba(0,0,0,0.04)` |
| **Primary Accent Color** | Hijau Dinkes (`#00BC7D`) | `color: #00BC7D; fill: #00BC7D;` | Warna aksen utama |

---

## 2. Komponen & Detail UI

### A. Header Banner (Atas)
- **Background**: Hijau Pekat `#064E3B` dengan padding yang luas (`40px 48px`).
- **Judul**: "Satu Data Kesehatan Kabupaten Cianjur"
- **Sub-judul**: "Pusat data terpadu indikator kinerja kesehatan, angka kecukupan faskes/nakes, publikasi profil tahunan, dan produk hukum daerah."

### B. Header Dashboard (Sub-Header)
- **Kategori**: Teks "Satu Data Kesehatan" warna hijau `#00BC7D`.
- **Judul Utama**: "Dashboard Indikator Utama" (32px Bold).
- **Status Tag**: "● Data Riil Semester I 2026" di pojok kanan atas.

### C. 4 Kartu Statistik (Stat Cards Row)
Grid 4 kolom responsif (`grid-template-columns: repeat(4, 1fr)`):

1. **Kartu 1 - PUSKESMAS**
   - Header: `PUSKESMAS` (Teks abu-abu miring/small)
   - Badge: `100% Aktif` (Pill abu-abu/terang)
   - Angka Utama: `47` (Font besar 36px/40px Bold)
   - Sub-caption: `✔ Seluruhnya Terakreditasi Paripurna` (Aksen centang hijau)

2. **Kartu 2 - RUMAH SAKIT RUJUKAN**
   - Header: `RUMAH SAKIT RUUKAN`
   - Badge: `Mitra BPJS`
   - Angka Utama: `8`
   - Sub-caption: `4 RSUD Pemda + 4 RS Swasta`

3. **Kartu 3 - SDM KESEHATAN**
   - Header: `SDM KESEHATAN`
   - Badge: `Tersertifikasi`
   - Angka Utama: `3,820`
   - Sub-caption: `Dokter, Perawat, Bidan, & Apoteker`

4. **Kartu 4 - CAKUPAN IMUNISASI**
   - Header: `CAKUPAN IMUNISASI`
   - Badge: `+3.2% YoY`
   - Angka Utama: `94.8%`
   - Sub-caption: `Target Nasional 2026: 95.0%`

### D. Grafik Tren Stunting (Chart Container)
- **Container Card**: Card putih besar dengan shadow lembut & border radius 16px.
- **Judul Chart**: "Tren Penurunan Prevalensi Stunting"
- **Sub-judul**: "Target Daerah Cianjur 2026: < 10%"
- **Badge Status**: "Tren Positif" (Border hijau, teks hijau).
- **Bar Chart**:
  - Rentang Tahun: 2018 s/d 2026 (Saat Ini).
  - Data Kunci:
    - 2018: 4.2%
    - 2019: 16.2%
    - 2020: 4.8%
    - 2021: 18.2%
    - 2022: 9.8%
    - 2023: 14.7%
    - 2024: 18.2%
    - 2025: 14.7%
    - 2026 (Saat Ini): **9.8%** (Bar berwarna hijau penuh / ter-highlight).
  - Tampilan Bar: Gradient hijau lembut `#00BC7D` dengan angka presentase di atas tiap batang.
- **Footer Text Chart**: "Penurunan sebesar ~8.4% dalam 2 tahun melalui Program Pendampingan Keluarga Terpadu."

---

## 3. Struktur Layout & HTML

```html
<section class="satudata-section">
  <!-- Banner Header -->
  <div class="satudata-banner">
    <div class="banner-container">
      <h1 class="banner-title">Satu Data Kesehatan Kabupaten Cianjur</h1>
      <p class="banner-subtitle">Pusat data terpadu indikator kinerja kesehatan, angka kecukupan faskes/nakes, publikasi profil tahunan, dan produk hukum daerah.</p>
    </div>
  </div>

  <!-- Main Content Body -->
  <div class="satudata-container">
    <div class="satudata-header">
      <div class="header-titles">
        <span class="category-tag">Satu Data Kesehatan</span>
        <h2 class="section-title">Dashboard Indikator Utama</h2>
      </div>
      <div class="status-tag">
        <span class="status-dot"></span> Data Riil Semester I 2026
      </div>
    </div>

    <!-- Stat Cards Grid -->
    <div class="stat-cards-grid">
      <!-- Card 1 -->
      <div class="stat-card">
        <div class="card-top">
          <span class="card-label">PUSKESMAS</span>
          <span class="card-badge">100% Aktif!</span>
        </div>
        <div class="card-value">47</div>
        <div class="card-footer accent">
          <svg class="check-icon" ...></svg> Seluruhnya Terakreditasi Paripurna
        </div>
      </div>
      <!-- Card 2, 3, 4 ... -->
    </div>

    <!-- Chart Section -->
    <div class="chart-card">
      <div class="chart-header">
        <div>
          <h3 class="chart-title">Tren Penurunan Prevalensi Stunting</h3>
          <p class="chart-subtitle">Target Daerah Cianjur 2026: &lt;10%</p>
        </div>
        <span class="badge-positive">Tren Positif</span>
      </div>

      <div class="bars-container">
        <!-- Bars 2018 - 2026 -->
      </div>

      <div class="chart-footer-note">
        Penurunan sebesar <strong>~8.4%</strong> dalam 2 tahun melalui Program Pendampingan Keluarga Terpadu.
      </div>
    </div>
  </div>
</section>
```

---

## 4. Rencana File & Implementasi

1. **PRD File**: `prd/satudata-prd.md`
2. **View Component**: `resources/views/components/SatuData/satudata.blade.php` atau `resources/views/satudata.blade.php`
3. **Stylesheet**: `public/css/SatuData/satudata.css`
4. **Route**: Route Laravel di `routes/web.php` (misal `/satu-data` atau dimasukkan ke landing page utama).

