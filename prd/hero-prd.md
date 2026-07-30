# Product Requirements Document (PRD) - Hero Section
## Portal Resmi Dinas Kesehatan Kabupaten Cianjur

Dokumen ini mendefinisikan spesifikasi desain dan komponen untuk **Hero Section** portal Dinas Kesehatan Kabupaten Cianjur sesuai dengan referensi Figma.

---

## 1. Visual Tokens (Spesifikasi Tampilan)

| Elemen Desain | Properti & Nilai Spesifikasi Figma | Implementasi CSS | Keterangan |
| :--- | :--- | :--- | :--- |
| **Background Image** | `@[public/Assets/Hero section.png]` | `background-image: url('/Assets/Hero section.png');` | Gambar latar belakang gedung dinas |
| **Background Overlay** | Putih (`#FFFFFF`) dengan Opacity `35%` | `background: rgba(255, 255, 255, 0.35);` | Overlay di atas background image untuk keterbacaan teks |
| **Font Family** | `Plus Jakarta Sans` | `font-family: 'Plus Jakarta Sans', sans-serif;` | Font seragam untuk seluruh teks hero |
| **Top Subtitle** | `36px` | `font-size: 36px; font-weight: 700; text-shadow: 3px 3px 11px rgba(0, 0, 0, 0.4);` | Teks "PORTAL RESMI DINAS KESEHATAN KABUPATEN CIANJUR" (Putih, Bold, Bayangan Tebal) |
| **Main Headline** | `64px` | `font-size: 64px; font-weight: 800; text-shadow: 3px 3px 11px rgba(0, 0, 0, 0.4);` | Teks utama "Mewujudkan Cianjur Sehat Mandiri" (Putih, Extra Bold, Bayangan Tebal) |
| **Warna Putih Default**| `#FFFFFF` | `color: #FFFFFF;` | Semua teks berbayang/kontras menggunakan putih murni |

---

## 2. Komponen & Detail UI

### A. Kotak Pencarian (Search Bar)
- **Background Input**: `#fafafa`
- **Teks Input / Placeholder**:
  - Ukuran: `16px`
  - Warna: `#D1D1D1`
- **Warna Tombol Cari (Button)**: `#00BC7D` (Hijau Terang)
- **Shadow (Kotak Pencarian)**: Blur `15px` (`box-shadow: 0 10px 15px rgba(0, 0, 0, 0.05);` atau `box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);`)

### B. Balon Kontak Darurat (Emergency Bubble - Kiri)
- **Teks "Kontak darurat"**: Ukuran `14px`, warna `#332C2B` (Bold/Medium, font-style: normal, tanpa wrap / 1 baris)
- **Angka "119"**: Ukuran `48px`, warna `#332C2B` (Extra Bold, font-style: normal)
- **Format Teks**: Terbagi menjadi 2 baris (Baris 1: "Kontak darurat", Baris 2: "119")
- **Kemiringan Konten (Rotation)**: Konten teks di dalam bubble diputar secara visual sebesar kurang lebih -8 derajat (`transform: rotate(-8deg);`) untuk aksen dinamis miring (bukan menggunakan font style italic).
- **Posisi Vertikal**: Diatur agak naik ke atas menggunakan margin negatif/offset.
- **Visual Bubble**: Bulatan putih bersih dengan border/aksen merah (`#EF4444`) melingkar.

### C. Efek Dekorasi Lingkaran (Bottom Waves / Rings)
- **Warna**: Putih `#FFFFFF` dengan Opacity `20%` (`rgba(255, 255, 255, 0.20)`)
- **Desain**: 3 cincin lingkaran konsentris bertumpuk di bagian bawah hero.

### D. Sidebar Media Sosial (Kanan)
- **Posisi**: Terletak di sisi kanan luar hero (menempel ke pinggir kanan, tidak mengambang bebas di tengah container).
- **Warna Icon**: `#332C2B` (100% Opacity)
- **Daftar Icon**: Instagram, TikTok, Facebook, YouTube.

### E. Aturan Sudut Bulat (Rounded Corners Rule)
- **Prinsip Hubungan Bersarang (Nested Border Radius)**:
  - Container Luar (Form / Card Utama): Tingkat kelengkungan lebih tajam (misal `border-radius: 100px` atau outer radius lebih besar).
  - Elemen Dalam (Button / Inner Card): Mengikuti proporsi geometris agar terlihat konsentris (menggunakan rasio kelengkungan yang seimbang, e.g. `inner_radius = outer_radius - padding`).


---

## 3. Struktur Layout & HTML

Layout disusun menggunakan Flexbox/Grid dengan posisi relatif terhadap Navbar:

```html
<section class="hero-section">
  <div class="hero-overlay"></div>

  <div class="hero-container">
    <div class="emergency-bubble">
      <span class="emergency-label">Kontak darurat</span>
      <span class="emergency-number">119</span>
    </div>

    <div class="hero-content">
      <h3 class="hero-subtitle">PORTAL RESMI DINAS KESEHATAN KABUPATEN CIANJUR</h3>
      <h1 class="hero-title">Mewujudkan Cianjur Sehat Mandiri</h1>
      
      <div class="search-container">
        <span class="search-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#D1D1D1" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
          </svg>
        </span>
        <input type="text" class="search-input" placeholder="Cari Berita dan Informasi ...">
        <button class="search-button">Cari</button>
      </div>
    </div>

    <div class="social-sidebar">
      <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
      <a href="#" class="social-icon"><i class="fab fa-tiktok"></i></a>
      <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
      <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
    </div>
  </div>

  <div class="decorative-rings">
    <svg class="ring-svg" ...></svg>
  </div>
</section>
```
