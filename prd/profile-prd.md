# PRD: Halaman Profil Dinas Kesehatan Kabupaten Cianjur

## 1. Overview
Halaman ini menampilkan profil lengkap Dinas Kesehatan Kabupaten Cianjur, yang diakses melalui menu navigasi **Profil** (misal: `/profil` atau include view dinamis). Halaman ini berfokus pada penyampaian informasi kelembagaan, visi, misi, dan struktur.

---

## 2. Struktur & Desain Halaman

### A. Header Halaman (Banner atas, di bawah Navbar)
- **Background**: `#065F46` (Dark Green)
- **Judul**: Ukuran font `48px`, tebal (ExtraBold/Bold), warna putih/kontras.
- **Deskripsi singkat**: Ukuran font `16px`, warna putih transparan/kontras ringan.

### B. Bagian Konten Utama (Visi, Misi, & Informasi Lain)
- **Heading Utama Visi & Misi**:
  - Warna: `#009966`
- **Elemen di bawah Visi (Misi / Judul Misi)**:
  - Warna: `#004F3B`
  - Ukuran: `48px`
- **Teks Deskripsi / List Misi / Informasi Lainnya**:
  - Ukuran font: `16px`
- **Border Radius**:
  - Elemen umum: `1px`
  - Card / Button di dalam halaman: `3px`

---

## 3. Pertanyaan Klarifikasi / Diskusi (Open Questions)

1. **Maksud Warna & Ukuran Visi-Misi**:
   * Apakah teks heading **"Visi dan Misi"** berwarna `#009966`?
   * Apakah yang dimaksud dengan *"di bawah visi itu 004F3B dan ukuran nya 48"* adalah sub-heading **"Misi"**? Atau teks slogan visi utama?

2. **Struktur Konten Profil**:
   * Selain Visi & Misi, apakah perlu ditambahkan sub-section seperti **Tugas Pokok & Fungsi (Tupoksi)**, **Struktur Organisasi**, atau **Sejarah Singkat**?

3. **Format Rute / Integrasi**:
   * Apakah profil ini akan dibuat sebagai halaman baru (misal `/profil` dengan file `profil.blade.php`), atau di-render dinamis di `welcome.blade.php` ketika menu navbar diklik?
