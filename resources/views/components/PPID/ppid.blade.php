<link rel="stylesheet" href="{{ asset('css/PPID/ppid.css') }}?v={{ time() }}">

<div class="ppid-page-wrapper">
    <!-- Header Section -->
    <header class="ppid-header">
        <div class="ppid-header-container">
            <h1 class="ppid-header-title">PPID Dinas Kesehatan Kabupaten Cianjur</h1>
            <p class="ppid-header-subtitle">Pusat layanan informasi publik, permohonan dokumen resmi, serta transparansi kinerja Dinas Kesehatan.</p>
        </div>
    </header>

    <!-- Stats Cards Section -->
    <section class="ppid-stats-section">
        <div class="ppid-stats-container">
            <!-- Stat Card 1 -->
            <div class="ppid-stat-card">
                <h3 class="ppid-stat-number">9.757</h3>
                <p class="ppid-stat-desc">Jumlah Dokumen (berkala, serta merta &amp; setiap saat) yang tersedia pada database PPID Kabupaten Cianjur.</p>
            </div>
            <!-- Stat Card 2 -->
            <div class="ppid-stat-card">
                <h3 class="ppid-stat-number">8.089.450</h3>
                <p class="ppid-stat-desc">Jumlah Dokumen (berkala, serta merta &amp; setiap saat) sudah di-lihat publik dari database PPID Kabupaten Cianjur.</p>
            </div>
            <!-- Stat Card 3 -->
            <div class="ppid-stat-card">
                <h3 class="ppid-stat-number">8.118.414</h3>
                <p class="ppid-stat-desc">Jumlah Dokumen (berkala, serta merta &amp; setiap saat) sudah di-download publik dari database PPID Kabupaten Cianjur.</p>
            </div>
        </div>
    </section>

    <!-- Main Content Section -->
    <main class="ppid-content">
        <div class="ppid-main-container">
            <!-- Accordion Wrapper Card -->
            <div class="ppid-card-wrapper">
                <h2 class="ppid-section-title">Layanan Informasi Publik</h2>

                <!-- Tampilkan form pencarian langsung tanpa pembungkus accordion -->
                <div class="filter-box-card">
                    <h4 class="filter-title">Informasi Publik</h4>
                    <p class="filter-desc">Silahkan cari Informasi Publik melalui form di bawah ini:</p>
                    
                    <form class="filter-form" onsubmit="event.preventDefault();">
                        <!-- Search input wrapper -->
                        <div class="search-input-wrap">
                            <span class="material-icons search-icon">search</span>
                            <input type="text" class="search-input-field" placeholder="Cari Informasi....">
                        </div>

                        <!-- Category select dropdown -->
                        <div class="category-select-wrap">
                            <select class="category-select-field">
                                <option value="semua">Semua Kategori</option>
                                <option value="berkala">Informasi Berkala</option>
                                <option value="serta-merta">Informasi Serta Merta</option>
                                <option value="setiap-saat">Informasi Setiap Saat</option>
                            </select>
                        </div>

                        <!-- Button -->
                        <button type="submit" class="filter-submit-btn">Lihat Data</button>
                    </form>
                </div>

                <!-- Bagian Accordion di bawah filter form -->
                <div class="accordion-container" style="margin-top: 32px;">
                    <!-- Item 1: Info Kepuasan Masyarakat -->
                    <div class="accordion-item">
                        <button class="accordion-header" aria-expanded="false">
                            <span class="header-text">Info Kepuasan Masyarakat</span>
                            <span class="material-icons chevron-icon">expand_more</span>
                        </button>
                        <div class="accordion-content">
                            <div class="accordion-content-inner">
                                <p class="placeholder-text">Informasi mengenai Indeks Kepuasan Masyarakat (IKM) terhadap layanan Dinas Kesehatan Kabupaten Cianjur disajikan secara berkala untuk menjaga transparansi dan perbaikan berkelanjutan.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Item 2: Permohonan Informasi -->
                    <div class="accordion-item">
                        <button class="accordion-header" aria-expanded="false">
                            <span class="header-text">Permohonan Informasi</span>
                            <span class="material-icons chevron-icon">expand_more</span>
                        </button>
                        <div class="accordion-content">
                            <div class="accordion-content-inner">
                                <p class="placeholder-text">Alur permohonan informasi publik secara online and offline. Anda dapat mengunduh formulir pengajuan informasi resmi di sini.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Item 3: Tracking Permohonan Informasi -->
                    <div class="accordion-item">
                        <button class="accordion-header" aria-expanded="false">
                            <span class="header-text">Tracking Permohonan Informasi</span>
                            <span class="material-icons chevron-icon">expand_more</span>
                        </button>
                        <div class="accordion-content">
                            <div class="accordion-content-inner">
                                <p class="placeholder-text">Masukkan nomor registrasi permohonan Anda untuk melacak status respon dan tindak lanjut dari petugas PPID Dinas Kesehatan.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Item 4: Standar dan Pelaporan -->
                    <div class="accordion-item">
                        <button class="accordion-header" aria-expanded="false">
                            <span class="header-text">Standar dan Pelaporan</span>
                            <span class="material-icons chevron-icon">expand_more</span>
                        </button>
                        <div class="accordion-content">
                            <div class="accordion-content-inner">
                                <p class="placeholder-text">Laporan berkala PPID pembantu, maklumat pelayanan informasi publik, dan standar operasional prosedur (SOP) pengelolaan informasi di lingkungan Dinas Kesehatan.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Item 5: Regulasi PPID Pembantu -->
                    <div class="accordion-item">
                        <button class="accordion-header" aria-expanded="false">
                            <span class="header-text">Regulasi PPID Pembantu</span>
                            <span class="material-icons chevron-icon">expand_more</span>
                        </button>
                        <div class="accordion-content">
                            <div class="accordion-content-inner">
                                <p class="placeholder-text">Kumpulan undang-undang, peraturan pemerintah, peraturan menteri, serta keputusan bupati terkait keterbukaan informasi publik (KIP).</p>
                            </div>
                        </div>
                    </div>

                    <!-- Item 6: Tracking Pengaduan Masyarakat -->
                    <div class="accordion-item">
                        <button class="accordion-header" aria-expanded="false">
                            <span class="header-text">Tracking Pengaduan Masyarakat</span>
                            <span class="material-icons chevron-icon">expand_more</span>
                        </button>
                        <div class="accordion-content">
                            <div class="accordion-content-inner">
                                <p class="placeholder-text">Lacak status laporan pengaduan masyarakat yang diajukan secara resmi ke Dinas Kesehatan Kabupaten Cianjur.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section Informasi Tautan (di bawah ppid card) -->
            <div class="tautan-section">
                <span class="tautan-badge-title">Informasi Tautan</span>
                <h2 class="tautan-title">Pelayanan Publik Kabupaten Cianjur</h2>
                <p class="tautan-subtitle">Berikut adalah daftar alamat website pelayanan publik pemerintah kabupaten cianjur.</p>
                
                <div class="tautan-grid">
                    <!-- Card 1 -->
                    <a href="#" class="tautan-card">
                        <div class="tautan-icon-wrap">
                            <img src="{{ asset('Assets/ppdi/Rectangle 95.png') }}" alt="BPJS Kesehatan">
                        </div>
                        <span class="tautan-card-text">BPJS Kesehatan</span>
                    </a>
                    <!-- Card 2 -->
                    <a href="#" class="tautan-card">
                        <div class="tautan-icon-wrap">
                            <img src="{{ asset('Assets/ppdi/Rectangle 100.png') }}" alt="Pelayanan Pendaftaran Penduduk">
                        </div>
                        <span class="tautan-card-text">Pelayanan Pendaftaran Penduduk</span>
                    </a>
                    <!-- Card 3 -->
                    <a href="#" class="tautan-card">
                        <div class="tautan-icon-wrap">
                            <img src="{{ asset('Assets/ppdi/Rectangle 99.png') }}" alt="Pelayanan Perizinan">
                        </div>
                        <span class="tautan-card-text">Pelayanan Perizinan</span>
                    </a>
                    <!-- Card 4 -->
                    <a href="#" class="tautan-card">
                        <div class="tautan-icon-wrap">
                            <img src="{{ asset('Assets/ppdi/Rectangle 98.png') }}" alt="Pelayanan Perizinan Trayek">
                        </div>
                        <span class="tautan-card-text">Pelayanan Perizinan Trayek</span>
                    </a>
                    <!-- Card 5 -->
                    <a href="#" class="tautan-card">
                        <div class="tautan-icon-wrap">
                            <img src="{{ asset('Assets/ppdi/Rectangle 97.png') }}" alt="Pelayanan Kearsipan dan Perpustakaan">
                        </div>
                        <span class="tautan-card-text">Pelayanan Kearsipan dan Perpustakaan</span>
                    </a>
                </div>
            </div>
        </div>
    </main>

<!-- Tata Cara Permohonan Section (full-width, di luar container) -->
<section class="tata-cara-outer">
    <div class="tata-cara-section">
        <!-- Left Side: Circle Doctor Image -->
        <div class="tata-cara-image-wrapper">
            <img src="{{ asset('Assets/ppdi/doctor_landscape_illustration_1785205715145.png') }}" alt="Ilustrasi Tata Cara Permohonan" class="tata-cara-image">
        </div>

        <!-- Right Side: Content -->
        <div class="tata-cara-content-box">
            <span class="tata-cara-badge">4 langkah mudah pengajuan informasi online</span>
            <h2 class="tata-cara-heading">Tata Cara Permohonan</h2>

            <div class="tata-cara-grid">
                <!-- Card 1 -->
                <div class="tata-cara-card">
                    <h3 class="tata-cara-card-title">1. Persiapan</h3>
                    <p class="tata-cara-card-text">Silahkan lakukan persiapan terlebih dahulu sebelum melakukan permohonan informasi tentang apa yang anda butuhkan.</p>
                </div>
                <!-- Card 2 -->
                <div class="tata-cara-card">
                    <h3 class="tata-cara-card-title">2. Buat Akun Pemohon</h3>
                    <p class="tata-cara-card-text">Silahkan <a href="#" class="inline-green-link">buat akun</a> pemohon terlebih dahulu. Jika sudah mempunyai akun, silahkan login melalui menu Layanan Informasi &gt; <a href="#" class="inline-blue-link">E-PPID Online</a>.</p>
                </div>
                <!-- Card 3 -->
                <div class="tata-cara-card">
                    <h3 class="tata-cara-card-title">3. Buat Tiket</h3>
                    <p class="tata-cara-card-text">Silahkan buat tiket dan pilih permohonan informasi. Isi formulir dan upload formulir yang sudah anda isi sebelumnya.</p>
                </div>
                <!-- Card 4 -->
                <div class="tata-cara-card">
                    <h3 class="tata-cara-card-title">4. Selesai</h3>
                    <p class="tata-cara-card-text">Permohonan anda berhasil dibuat. Anda akan mendapatkan nomor ID Tiket. Permohonan akan diproses 10 hari kerja + 7 hari kerja.</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="tata-cara-actions">
                <a href="#" class="action-btn-green">1. Mendaftar Akun Pemohon</a>
                <a href="#" class="action-btn-outline">2. Login E-PPID Online</a>
            </div>
        </div>
    </div>
</section>
</div>

<!-- Accordion Interactive JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const accordionHeaders = document.querySelectorAll('.accordion-header');

        accordionHeaders.forEach(header => {
            header.addEventListener('click', () => {
                const item = header.parentElement;
                const content = header.nextElementSibling;
                const isExpanded = header.getAttribute('aria-expanded') === 'true';

                // Close all other items
                document.querySelectorAll('.accordion-item').forEach(otherItem => {
                    if (otherItem !== item) {
                        otherItem.classList.remove('active');
                        const otherContent = otherItem.querySelector('.accordion-content');
                        otherContent.style.maxHeight = null;
                        otherItem.querySelector('.accordion-header').setAttribute('aria-expanded', 'false');
                    }
                });

                // Toggle current item
                if (isExpanded) {
                    item.classList.remove('active');
                    content.style.maxHeight = null;
                    header.setAttribute('aria-expanded', 'false');
                } else {
                    item.classList.add('active');
                    // Set max-height to scrollHeight to animate expanding
                    content.style.maxHeight = content.scrollHeight + 'px';
                    header.setAttribute('aria-expanded', 'true');
                }
            });
        });

        // Initialize scroll height for active item on resize
        window.addEventListener('resize', () => {
            const activeItem = document.querySelector('.accordion-item.active');
            if (activeItem) {
                const content = activeItem.querySelector('.accordion-content');
                // Don't set max-height for item 1 if it's open by default
                if (content.style.maxHeight && content.style.maxHeight !== 'none') {
                    content.style.maxHeight = content.scrollHeight + 'px';
                }
            }
        });
    });
</script>
