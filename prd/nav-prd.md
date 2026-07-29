# Product Requirements Document (PRD) - Navigation Bar Only
## Portal Resmi Dinas Kesehatan Kabupaten Cianjur

Dokumen ini mendefinisikan spesifikasi lengkap dan draf implementasi untuk **Navigation Bar (Navbar)** portal Dinas Kesehatan Kabupaten Cianjur sesuai dengan parameter desain Figma.

---

## 1. Visual Tokens (Spesifikasi Tampilan)

| Properti Desain | Nilai Spesifikasi Figma | Implementasi CSS | Keterangan |
| :--- | :--- | :--- | :--- |
| **Height (Tinggi)** | `103px` | `height: 103px;` | Tinggi navbar sesuai Figma layout |
| **Background Fill** | `#FFFFFF` with `3%` Opacity | `background: rgba(255, 255, 255, 0.03);` | Transparansi dasar 3% putih |
| **Stroke / Border** | `#FFFFFF` with `16%` Opacity | `border-bottom: 0.91px solid rgba(255, 255, 255, 0.16);` | Garis pembatas bawah (Inside border, tebal 0.91px) |
| **Background Blur** | `40.8px` (Radius) | `backdrop-filter: blur(40.8px);` | Efek glassmorphism tebal agar menyatu dengan latar belakang |
| **Font Family** | `Plus Jakarta Sans` | `font-family: 'Plus Jakarta Sans', sans-serif;` | Digunakan untuk seluruh teks navbar |
| **Font Size** | `18px` | `font-size: 18px;` | Ukuran teks link navigasi |
| **Font Weight** | **Bold** | `font-weight: 700;` | Ketebalan huruf menu |
| **Text Color** | `#332C2B` (100% Opacity) | `color: #332C2B;` | Warna teks menu utama (Charcoal hangat) |
| **Hover Color** | `#009966` (Brand Green) | `color: #009966;` | Aksen warna hijau hutan saat di-hover/aktif |

---

## 2. Aset Logo & Media

Semua aset gambar untuk navbar terletak di folder:
`public/Assets/Nav/`

1. **Logo Pemerintah Kabupaten Cianjur (Cropped PNG)**:
   - File: [logo_pemkab_cropped.png](file:///c:/xampp/htdocs/laravel/Projek-PKL-Studio-Madtive/Dinkes/public/Assets/Nav/logo_pemkab_cropped.png)
   - Karakteristik: Bagian kiri logo gabungan beresolusi tinggi (399x167px).
2. **Logo Dinas Kesehatan Cianjur (Cropped PNG)**:
   - File: [logo_dinkes_cropped.png](file:///c:/xampp/htdocs/laravel/Projek-PKL-Studio-Madtive/Dinkes/public/Assets/Nav/logo_dinkes_cropped.png)
   - Karakteristik: Bagian kanan logo gabungan beresolusi tinggi (426x167px).

---

## 3. Struktur Layout & HTML

Navbar disusun menggunakan layout flexbox responsif, dilengkapi tombol CTA mengambang di pojok kanan bawah:

```html
<nav class="dinkes-navbar">
  <div class="dinkes-navbar-container">
    <div class="navbar-brand">
      <img src="/Assets/Nav/logo_pemkab_cropped.png" alt="Logo Pemerintah Kabupaten Cianjur" class="logo-pemkab">
      <img src="/Assets/Nav/logo_dinkes_cropped.png" alt="Logo Dinas Kesehatan Kabupaten Cianjur" class="logo-dinkes">
    </div>

    <ul class="navbar-menu">
      <li><a href="#" class="menu-item active">Beranda</a></li>
      <li class="dropdown">
        <a href="#" class="menu-item">Profil</a>
        <ul class="dropdown-menu">
          <li><a href="#">Tentang Dinkes</a></li>
          <li><a href="#">Struktur Organisasi & Pejabat</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="menu-item">Program Kesehatan</a>
        <ul class="dropdown-menu">
          <li><a href="#">Cianjur Bebas Stunting</a></li>
          <li><a href="#">Kesehatan Ibu & Anak (KIA)</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="menu-item">program Terpadu</a>
        <ul class="dropdown-menu">
          <li><a href="#">Untuk Warga</a></li>
          <li><a href="#">Untuk Faskes & Nakes</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="menu-item">Fasilitas Kesehatan</a>
        <ul class="dropdown-menu">
          <li><a href="#">Peta & Daftar Puskesmas</a></li>
          <li><a href="#">Rumah Sakit Rujukan</a></li>
          <li><a href="#">Laboratorium Kesehatan Daerah (Labkesda)</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="menu-item">Satu Data</a>
        <ul class="dropdown-menu">
          <li><a href="#">Dashboard Statistik</a></li>
          <li><a href="#">Unduh Profil Kesehatan PDF</a></li>
          <li><a href="#">Regulasi & Hukum</a></li>
        </ul>
      </li>
      <li><a href="#" class="menu-item">PPID</a></li>
    </ul>
  </div>
</nav>

<!-- Tombol CTA Mengambang (Floating Emergency Button) -->
<a href="tel:119" class="emergency-floating-btn">
  <span>📞 Gawat Darurat: PSC 119</span>
</a>
```

---

## 4. Spesifikasi Responsif & Interaktivitas

- **Dropdown Menu**: Ketika menu bertipe dropdown di-hover, modal dropdown kecil dengan rounded corners `16px` dan border tipis `1px` akan muncul secara otomatis menggunakan efek transisi murni CSS.
- **Floating CTA**: Tombol gawat darurat diletakkan di sudut kanan bawah dengan status `fixed`, warna latar belakang merah cerah (`#EF4444`), dan efek bayangan lembut agar terlihat melayang di atas konten lain.
- **Transisi**: Efek hover pada teks menu menggunakan transisi smooth `transition: all 0.3s ease`.
- **Responsive Layout**: Pada layar mobile/tablet (lebar <= 1024px), tinggi navbar disesuaikan menjadi `80px` dan menu akan disembunyikan untuk hamburger menu.

