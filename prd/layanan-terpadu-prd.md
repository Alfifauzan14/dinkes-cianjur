# Product Requirements Document (PRD): CRUD Layanan Terpadu

Halaman **Layanan Terpadu** pada portal resmi Dinas Kesehatan Kabupaten Cianjur akan diubah menjadi dinamis. Data layanan yang sebelumnya dideklarasikan secara statis di HTML akan dipindahkan ke database, dan Admin akan diberikan akses back-office untuk mengelola (menambah, mengubah, menghapus) layanan terpadu secara langsung.

---

## 1. Spesifikasi Fitur Layanan Terpadu (Public UI)

### A. Tampilan Publik (`/layanan-terpadu`)
- **Fungsi Utama**: Menampilkan daftar jenis pelayanan kesehatan dinas berdasarkan segmen penerima manfaat.
- **Kategori Segmen**:
  - `Layanan Untuk Warga`
  - `Layanan Untuk Faskes`
  - `Layanan Untuk Nakes`
- **Atribut Tiap Item Layanan**:
  - Nama Layanan (Contoh: "Pendaftaran Peserta Penduduk PBPU dan BP Pemda Program JKN")
  - Tipe/Segmen Penerima (Warga / Faskes / Nakes)
  - Icon Visual (Menggunakan kumpulan standard SVG paths yang dinamis atau Material Icons)
  - Link Pendaftaran/Tautan Eksternal (Opsional, jika diklik mengarah ke halaman formulir/sistem terkait)

---

## 2. Spesifikasi Back-Office (CRUD Admin)

Admin yang terautentikasi dapat mengakses fitur pengelolaan ini melalui menu **Kelola Layanan** di dashboard admin.

### A. CRUD Layanan (`/admin/layanan-terpadu`)
- **Daftar Layanan**: Tabel berisi daftar layanan, kategori segmen (Warga, Faskes, Nakes), kode icon, link eksternal, dan aksi (Edit / Hapus).
- **Form Tambah/Edit**:
  - Input Nama Layanan (String, required, max 255)
  - Select Tipe/Segmen (Warga, Faskes, Nakes, required)
  - Select / Input Icon (Disediakan preset icon pilihan seperti `people`, `medical_services`, `apartment`, `assignment`, dll. yang me-render path SVG / Material Icons yang sesuai)
  - Input Link Eksternal (URL, optional, max 255)
