# Product Requirements Document (PRD): Laporan & Regulasi (Satu Data Kesehatan)

Halaman **Unduh Laporan** dan **Regulasi & Hukum** di bawah portal Satu Data Kesehatan akan dibuat dinamis. Admin dapat mengunggah dokumen baru, memilih kategori, dan mengelola data langsung dari dashboard admin. Halaman publik akan menampilkan dan menyaring dokumen tersebut secara dinamis.

---

## 1. Spesifikasi Fitur Laporan (Reports)

### A. Tampilan Publik (`/satu-data/laporan`)
- **Fungsi Utama**: Menampilkan daftar dokumen laporan resmi yang dapat diunduh oleh publik.
- **Kategori / Tab Filter**:
  - `Semua` (Menampilkan seluruh dokumen)
  - `Laporan Kinerja`
  - `Laporan Keuangan`
  - `Informasi Publik`
- **Atribut Dokumen**:
  - Judul Dokumen (Contoh: "Laporan Daftar Paket Pengadaan dan Pelelangan LPSE")
  - Kategori (Sesuai tab filter di atas, atau sub-kategori kustom)
  - Tanggal Rilis/Terbit (Format: "14 Okt 2026")
  - Tipe File (Selalu PDF)
  - Ukuran File (Dihitung otomatis atau diisi manual, contoh: "1.8MB")
  - Link Unduh (Mengarah ke path file asli di storage)

---

## 2. Spesifikasi Fitur Regulasi & Hukum (Regulations)

### A. Tampilan Publik (`/satu-data/regulasi`)
- **Fungsi Utama**: Menampilkan produk hukum daerah (Perbup, Kepbup, SK) terkait sektor kesehatan Kabupaten Cianjur dengan cover visual.
- **Atribut Regulasi**:
  - Cover Image (Opsional, cover default jika tidak diunggah)
  - Kategori Produk Hukum (Contoh: "PERATURAN BUPATI", "KEPUTUSAN BUPATI")
  - Kategori Topik (Contoh: "PERBUP STUNTING", "KIA", "GERMAS")
  - Judul / Nomor Regulasi (Contoh: "Perbup No. 42 Tahun 2024")
  - Tahun Terbit (Contoh: "2024")
  - Deskripsi Singkat (Ringkasan isi aturan)
  - Tipe & Ukuran File (Contoh: "PDF • 2.4 MB")
  - Status Hukum (Pill badge: `Berlaku` (Hijau) / `Tidak Berlaku` (Merah))
  - Link Unduh & Link Pratinjau (Membuka PDF di tab baru)

---

## 3. Fitur Dashboard Admin (Back-Office)

Admin yang terautentikasi dapat mengelola data Laporan dan Regulasi melalui menu tersendiri di Dashboard Admin.

### A. CRUD Laporan (`/admin/satu-data/laporan`)
- **Daftar Laporan**: Tabel berisi judul, kategori, tanggal rilis, ukuran file, dan aksi (Edit / Hapus).
- **Form Tambah/Edit**:
  - Input Judul (String, required)
  - Select Kategori (Laporan Kinerja, Laporan Keuangan, Informasi Publik, dll.)
  - Input File Document (PDF, required untuk baru, max 10MB)
  - Input Tanggal Rilis (Date, default today)

### B. CRUD Regulasi (`/admin/satu-data/regulasi`)
- **Daftar Regulasi**: Tabel berisi judul/nomor, kategori, tahun, status, dan aksi (Edit / Hapus).
- **Form Tambah/Edit**:
  - Input Judul/Nomor (Contoh: "Perbup No. 42 Tahun 2024", required)
  - Select Kategori Hukum (PERATURAN BUPATI, KEPUTUSAN BUPATI, dll., required)
  - Input Tag Cover (Contoh: "PERBUP STUNTING", "KIA", dll.)
  - Input Deskripsi Ringkas (Textarea, required)
  - Input Tahun (Integer, required)
  - Input File Cover Image (Image: JPG/PNG, optional)
  - Input File Document (PDF, required untuk baru, max 10MB)
  - Select Status (Berlaku / Tidak Berlaku)
