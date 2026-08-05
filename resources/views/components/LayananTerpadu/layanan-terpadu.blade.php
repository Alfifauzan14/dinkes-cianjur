<link rel="stylesheet" href="{{ asset('css/LayananTerpadu/layanan-terpadu.css') }}?v={{ time() }}">

<div class="lt-page-wrapper">
    <!-- Header Section -->
    <header class="lt-header">
        <div class="lt-header-container">
            <h1 class="lt-header-title">{{ \App\Models\Setting::get('page_layanan_title', 'Layanan Terpadu Kesehatan Kabupaten Cianjur') }}</h1>
            <p class="lt-header-subtitle">{{ \App\Models\Setting::get('page_layanan_subtitle', 'Pusat pelayanan perizinan, rekomendasi medis, dan sertifikasi kesehatan secara cepat, transparan, dan terintegrasi.') }}</p>
        </div>
    </header>

    <!-- Main Content Section -->
    <main class="lt-content">
        <div class="lt-container">

            <!-- Layanan Untuk Warga -->
            <div class="lt-category-section">
                <div class="lt-title-section">
                    <h2 class="lt-main-title">Layanan Untuk Warga</h2>
                </div>

                <div class="lt-services-grid">
                    <div class="lt-service-item">
                        <span class="lt-service-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </span>
                        <span class="lt-service-text">Pendaftaran Peserta Penduduk PBPU dan BP Pemda Program JKN</span>
                    </div>
                    <div class="lt-service-item">
                        <span class="lt-service-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>
                        </span>
                        <span class="lt-service-text">Penyelenggaraan Jaminan Kesehatan Di Luar Skema JKN</span>
                    </div>
                    <div class="lt-service-item">
                        <span class="lt-service-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        </span>
                        <span class="lt-service-text">Pengelolaan Pengaduan Masyarakat</span>
                    </div>
                    <div class="lt-service-item">
                        <span class="lt-service-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        </span>
                        <span class="lt-service-text">Pengelolaan Informasi Publik</span>
                    </div>
                </div>
            </div>

            <!-- Layanan Untuk Faskes -->
            <div class="lt-category-section">
                <div class="lt-title-section">
                    <h2 class="lt-main-title">Layanan Untuk Faskes</h2>
                </div>

                <div class="lt-services-grid">
                    <div class="lt-service-item">
                        <span class="lt-service-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                        </span>
                        <span class="lt-service-text">Rekomendasi Penutupan Klinik</span>
                    </div>
                    <div class="lt-service-item">
                        <span class="lt-service-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                        </span>
                        <span class="lt-service-text">Rekomendasi Izin Operasional Klinik</span>
                    </div>
                    <div class="lt-service-item">
                        <span class="lt-service-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                        </span>
                        <span class="lt-service-text">Rekomendasi Perizinan Apotek</span>
                    </div>
                    <div class="lt-service-item">
                        <span class="lt-service-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                        </span>
                        <span class="lt-service-text">Rekomendasi Penutupan Apotek</span>
                    </div>
                    <div class="lt-service-item">
                        <span class="lt-service-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                        </span>
                        <span class="lt-service-text">Rekomendasi Penutupan Toko Obat</span>
                    </div>
                    <div class="lt-service-item">
                        <span class="lt-service-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                        </span>
                        <span class="lt-service-text">Rekomendasi Perizinan Toko Obat</span>
                    </div>
                    <div class="lt-service-item">
                        <span class="lt-service-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                        </span>
                        <span class="lt-service-text">Rekomendasi Penutupan Instalasi Farmasi Klinik</span>
                    </div>
                    <div class="lt-service-item">
                        <span class="lt-service-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                        </span>
                        <span class="lt-service-text">Konsultasi Perizinan Berusaha Optikal</span>
                    </div>
                    <div class="lt-service-item">
                        <span class="lt-service-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                        </span>
                        <span class="lt-service-text">Konsultasi Perizinan Berusaha Toko Alat Kesehatan</span>
                    </div>
                    <div class="lt-service-item">
                        <span class="lt-service-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                        </span>
                        <span class="lt-service-text">Konsultasi Perizinan Berusaha Perusahaan Rumah Tangga Alkes PKRT Tertentu</span>
                    </div>
                    <div class="lt-service-item">
                        <span class="lt-service-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                        </span>
                        <span class="lt-service-text">Konsultasi Sertifikat Pemenuhan Komitmen Produksi Pangan Olahan Industri Rumah Tangga SPP-IRT</span>
                    </div>
                    <div class="lt-service-item">
                        <span class="lt-service-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                        </span>
                        <span class="lt-service-text">Penerbitan Persetujuan Teknis Izin Aktivitas Rumah Sakit</span>
                    </div>
                    <div class="lt-service-item">
                        <span class="lt-service-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                        </span>
                        <span class="lt-service-text">Sertifikat Laik Sehat Akomodasi</span>
                    </div>
                    <div class="lt-service-item">
                        <span class="lt-service-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        </span>
                        <span class="lt-service-text">Notifikasi Pemenuhan Komitmen Ijin Penyelenggaraan Pengendalian Vektor Dan Binatang Pembawa Penyakit</span>
                    </div>
                    <div class="lt-service-item">
                        <span class="lt-service-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                        </span>
                        <span class="lt-service-text">Rekomendasi Sertifikat Laik Higiene Sanitasi Jasaboga/Catering/Rumah Makan/Restoran, Depot Air Minum</span>
                    </div>
                    <div class="lt-service-item">
                        <span class="lt-service-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                        </span>
                        <span class="lt-service-text">Penerbitan Izin Penelitian/Magang/PKL</span>
                    </div>
                </div>
            </div>

            <!-- Layanan Untuk Nakes -->
            <div class="lt-category-section">
                <div class="lt-title-section">
                    <h2 class="lt-main-title">Layanan Untuk Nakes</h2>
                </div>

                <div class="lt-services-grid">
                    <div class="lt-service-item">
                        <span class="lt-service-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                        </span>
                        <span class="lt-service-text">Penerbitan Sertifikat Penyuluhan Keamanan Pangan PKP</span>
                    </div>
                    <div class="lt-service-item">
                        <span class="lt-service-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </span>
                        <span class="lt-service-text">Rekomendasi Perizinan Tenaga Medis</span>
                    </div>
                    <div class="lt-service-item">
                        <span class="lt-service-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </span>
                        <span class="lt-service-text">Rekomendasi Perizinan Tenaga Kesehatan</span>
                    </div>
                    <div class="lt-service-item">
                        <span class="lt-service-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                        </span>
                        <span class="lt-service-text">Rekomendasi Perizinan Surat Terdaftar Penyehat Tradisional</span>
                    </div>
                </div>
            </div>

            <!-- Logos Section -->
            <div class="lt-logos-section">
                <div class="lt-logos-grid">
                    <div class="lt-logo-item">
                        <div class="lt-logo-placeholder">
                            <img src="{{ asset('Assets/layanan terpadu/Image-24.png') }}" alt="Kemenkes RI">
                        </div>
                    </div>
                    <div class="lt-logo-item">
                        <div class="lt-logo-placeholder">
                            <img src="{{ asset('Assets/layanan terpadu/Image-25.png') }}" alt="BPJS">
                        </div>
                    </div>
                    <div class="lt-logo-item">
                        <div class="lt-logo-placeholder">
                            <img src="{{ asset('Assets/layanan terpadu/Image-26.png') }}" alt="Pemkab Cianjur">
                        </div>
                    </div>
                    <div class="lt-logo-item">
                        <div class="lt-logo-placeholder">
                            <img src="{{ asset('Assets/layanan terpadu/Image-27.png') }}" alt="Dinkes">
                        </div>
                    </div>
                    <div class="lt-logo-item">
                        <div class="lt-logo-placeholder">
                            <img src="{{ asset('Assets/layanan terpadu/Image-28.png') }}" alt="Logo">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>
