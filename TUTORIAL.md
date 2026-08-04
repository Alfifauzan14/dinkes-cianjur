# Tutorial Clone, Checkout & Merge Branch `berita`

## 1. Clone Repository

```bash
git clone https://github.com/Alfifauzan14/dinkes-cianjur.git
cd dinkes-cianjur
```

## 2. Install Dependencies

```bash
composer install
npm install
```

## 3. Setup Environment

```bash
copy .env.example .env
php artisan key:generate
```

## 4. Checkout Branch `berita`

```bash
git checkout berita
```

## 5. Build Assets

```bash
npm run build
```

## 6. Jalankan Server

```bash
composer dev
```

Buka `http://localhost:8000` untuk lihat halaman utama.

Buka `http://localhost:8000/media` untuk lihat halaman Galeri Kegiatan.

---

## Tutorial Merge ke Branch Kamu

### 1. Pastikan di Branch Kamu

```bash
git checkout nama-branch-kamu
```

### 2. Fetch Semua Branch dari Remote

```bash
git fetch origin
```

### 3. Merge Branch `berita`

```bash
git merge origin/berita
```

### 4. Kalau Ada Konflik

```bash
# Edit file yang konflik, lalu:
git add .
git commit -m "Merge branch origin/berita"
```

### 5. Push ke Remote

```bash
git push origin nama-branch-kamu
```

---

## Halaman yang Tersedia

| Route | Deskripsi |
|-------|-----------|
| `/` | Homepage (Hero, Info Cards, Sambutan, Layanan, Berita, Media & Agenda) |
| `/berita` | Halaman Berita |
| `/media` | Galeri Kegiatan |
| `/agenda` | Agenda Kegiatan |
| `/profil/tentang-dinkes` | Profil Dinkes |
| `/ppid` | PPID |
