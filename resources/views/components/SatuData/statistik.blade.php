<link rel="stylesheet" href="{{ asset('css/SatuData/statistik.css') }}?v={{ time() }}">

<div class="satudata-wrapper">
    <!-- Banner Header Top Section -->
    <header class="satudata-banner">
        <div class="satudata-banner-container">
            <h1 class="satudata-banner-title">Satu Data Kesehatan Kabupaten Cianjur</h1>
            <p class="satudata-banner-subtitle">
                Pusat data terpadu indikator kinerja kesehatan, angka kecukupan faskes/nakes, publikasi profil tahunan, dan produk hukum daerah.
            </p>
        </div>
    </header>

    <!-- Main Content Section -->
    <main class="satudata-main">
        <div class="satudata-main-container">
            
            <!-- Dashboard Subheader -->
            <div class="satudata-header">
                <div class="satudata-header-left">
                    <span class="satudata-category-tag">Satu Data Kesehatan</span>
                    <h2 class="satudata-section-title">Dashboard Indikator Utama</h2>
                </div>
                <div class="satudata-status-badge">
                    <span class="status-dot"></span>
                    <span class="status-text">Data Riil Semester I 2026</span>
                </div>
            </div>

            <!-- 4 Stat Cards Row -->
            <div class="stat-cards-grid">
                
                <!-- Card 1: Puskesmas -->
                <div class="stat-card">
                    <div class="stat-card-header">
                        <span class="stat-card-label">PUSKESMAS</span>
                        <span class="stat-card-badge badge-active">100% Aktif!</span>
                    </div>
                    <div class="stat-card-number">47</div>
                    <div class="stat-card-caption caption-accent">
                        <svg class="caption-icon" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        <span>Seluruhnya Terakreditasi Paripurna</span>
                    </div>
                </div>

                <!-- Card 2: Rumah Sakit Rujukan -->
                <div class="stat-card">
                    <div class="stat-card-header">
                        <span class="stat-card-label">RUMAH SAKIT RUJUKAN</span>
                        <span class="stat-card-badge badge-muted">Mitra BPJS</span>
                    </div>
                    <div class="stat-card-number">8</div>
                    <div class="stat-card-caption">
                        <span>4 RSUD Pemda + 4 RS Swasta</span>
                    </div>
                </div>

                <!-- Card 3: SDM Kesehatan -->
                <div class="stat-card">
                    <div class="stat-card-header">
                        <span class="stat-card-label">SDM KESEHATAN</span>
                        <span class="stat-card-badge badge-muted">Tersertifikasi</span>
                    </div>
                    <div class="stat-card-number">3,820</div>
                    <div class="stat-card-caption">
                        <span>Dokter, Perawat, Bidan, & Apoteker</span>
                    </div>
                </div>

                <!-- Card 4: Cakupan Imunisasi -->
                <div class="stat-card">
                    <div class="stat-card-header">
                        <span class="stat-card-label">CAKUPAN IMUNISASI</span>
                        <span class="stat-card-badge badge-muted">+3.2% YoY</span>
                    </div>
                    <div class="stat-card-number">94.8%</div>
                    <div class="stat-card-caption">
                        <span>Target Nasional 2026: 95.0%</span>
                    </div>
                </div>

            </div>

            <!-- Chart Card: Tren Penurunan Prevalensi Stunting -->
            <div class="chart-card">
                <div class="chart-header">
                    <div class="chart-header-left">
                        <h3 class="chart-title">Tren Penurunan Prevalensi Stunting</h3>
                        <p class="chart-subtitle">Target Daerah Cianjur 2026: &lt;10%</p>
                    </div>
                    <div class="chart-header-right">
                        <span class="trend-badge">Tren Positif</span>
                    </div>
                </div>

                <!-- Bar Chart Canvas Container -->
                <div class="stunting-chart-container">
                    <div class="chart-bars-wrapper">
                        
                        <!-- Bar 2018 -->
                        <div class="chart-bar-item">
                            <span class="bar-val">4.2%</span>
                            <div class="bar-track">
                                <div class="bar-fill" style="height: 23%;"></div>
                            </div>
                            <span class="bar-year">2018</span>
                        </div>

                        <!-- Bar 2019 -->
                        <div class="chart-bar-item">
                            <span class="bar-val">16.2%</span>
                            <div class="bar-track">
                                <div class="bar-fill" style="height: 89%;"></div>
                            </div>
                            <span class="bar-year">2019</span>
                        </div>

                        <!-- Bar 2020 -->
                        <div class="chart-bar-item">
                            <span class="bar-val">4.8%</span>
                            <div class="bar-track">
                                <div class="bar-fill" style="height: 26%;"></div>
                            </div>
                            <span class="bar-year">2020</span>
                        </div>

                        <!-- Bar 2021 -->
                        <div class="chart-bar-item">
                            <span class="bar-val">18.2%</span>
                            <div class="bar-track">
                                <div class="bar-fill" style="height: 100%;"></div>
                            </div>
                            <span class="bar-year">2021</span>
                        </div>

                        <!-- Bar 2022 -->
                        <div class="chart-bar-item">
                            <span class="bar-val">9.8%</span>
                            <div class="bar-track">
                                <div class="bar-fill" style="height: 54%;"></div>
                            </div>
                            <span class="bar-year">2022</span>
                        </div>

                        <!-- Bar 2023 -->
                        <div class="chart-bar-item">
                            <span class="bar-val">14.7%</span>
                            <div class="bar-track">
                                <div class="bar-fill" style="height: 80%;"></div>
                            </div>
                            <span class="bar-year">2023</span>
                        </div>

                        <!-- Bar 2024 -->
                        <div class="chart-bar-item">
                            <span class="bar-val">18.2%</span>
                            <div class="bar-track">
                                <div class="bar-fill" style="height: 100%;"></div>
                            </div>
                            <span class="bar-year">2024</span>
                        </div>

                        <!-- Bar 2025 -->
                        <div class="chart-bar-item">
                            <span class="bar-val">14.7%</span>
                            <div class="bar-track">
                                <div class="bar-fill" style="height: 80%;"></div>
                            </div>
                            <span class="bar-year">2025</span>
                        </div>

                        <!-- Bar 2026 (Saat Ini) - Active Highlighted -->
                        <div class="chart-bar-item bar-highlighted">
                            <span class="bar-val font-bold">9.8%</span>
                            <div class="bar-track">
                                <div class="bar-fill bar-fill-active" style="height: 54%;"></div>
                            </div>
                            <span class="bar-year bar-year-active">2026 (Saat Ini)</span>
                        </div>

                    </div>
                </div>

                <!-- Footer Note -->
                <div class="chart-footer-note">
                    Penurunan sebesar <strong>-8.4%</strong> dalam 2 tahun melalui Program Pendampingan Keluarga Terpadu.
                </div>
            </div>

            <!-- Two Side-by-Side Progress Cards -->
            <div class="progress-cards-grid">
                
                <!-- Card A: Distribusi Profesi Nakes -->
                <div class="progress-card">
                    <div class="progress-card-header">
                        <div class="progress-card-title-area">
                            <h3 class="progress-card-title">Distribusi Profesi Nakes (3,820)</h3>
                            <p class="progress-card-subtitle">Terdaftar pada Portal E-SIP Dinkes</p>
                        </div>
                        <span class="progress-badge">Aktif SIP</span>
                    </div>
                    
                    <div class="progress-list">
                        <!-- Item 1 -->
                        <div class="progress-item">
                            <div class="progress-item-labels">
                                <span class="progress-item-name">Perawat Kesehatan</span>
                                <span class="progress-item-value">1,604 (42%)</span>
                            </div>
                            <div class="progress-track-wrapper">
                                <div class="progress-bar-fill" style="width: 42%;"></div>
                            </div>
                        </div>

                        <!-- Item 2 -->
                        <div class="progress-item">
                            <div class="progress-item-labels">
                                <span class="progress-item-name">Bidan Desa & Puskesmas</span>
                                <span class="progress-item-value">1,184 (31%)</span>
                            </div>
                            <div class="progress-track-wrapper">
                                <div class="progress-bar-fill" style="width: 31%;"></div>
                            </div>
                        </div>

                        <!-- Item 3 -->
                        <div class="progress-item">
                            <div class="progress-item-labels">
                                <span class="progress-item-name">Dokter Umum & Spesialis</span>
                                <span class="progress-item-value">573 (15%)</span>
                            </div>
                            <div class="progress-track-wrapper">
                                <div class="progress-bar-fill" style="width: 15%;"></div>
                            </div>
                        </div>

                        <!-- Item 4 -->
                        <div class="progress-item">
                            <div class="progress-item-labels">
                                <span class="progress-item-name">Apoteker & Tenaga Kefarmasian</span>
                                <span class="progress-item-value">459 (12%)</span>
                            </div>
                            <div class="progress-track-wrapper">
                                <div class="progress-bar-fill" style="width: 12%;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card B: Sebaran Puskesmas per Zonasi -->
                <div class="progress-card">
                    <div class="progress-card-header">
                        <div class="progress-card-title-area">
                            <h3 class="progress-card-title">Sebaran Puskesmas per Zonasi</h3>
                            <p class="progress-card-subtitle">47 Unit Wilayah Kerja Kabupaten</p>
                        </div>
                        <span class="progress-badge">Aktif SIP</span>
                    </div>

                    <div class="progress-list">
                        <!-- Item 1 -->
                        <div class="progress-item">
                            <div class="progress-item-labels">
                                <span class="progress-item-name">Zonasi Selatan</span>
                                <span class="progress-item-value">17 Puskesmas (36%)</span>
                            </div>
                            <div class="progress-track-wrapper">
                                <div class="progress-bar-fill" style="width: 36%;"></div>
                            </div>
                        </div>

                        <!-- Item 2 -->
                        <div class="progress-item">
                            <div class="progress-item-labels">
                                <span class="progress-item-name">Zonasi utara</span>
                                <span class="progress-item-value">16 Puskesmas (34%)</span>
                            </div>
                            <div class="progress-track-wrapper">
                                <div class="progress-bar-fill" style="width: 34%;"></div>
                            </div>
                        </div>

                        <!-- Item 3 -->
                        <div class="progress-item">
                            <div class="progress-item-labels">
                                <span class="progress-item-name">Zonasi Tengah</span>
                                <span class="progress-item-value">14 Puskesmas (30%)</span>
                            </div>
                            <div class="progress-track-wrapper">
                                <div class="progress-bar-fill" style="width: 30%;"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </main>
</div>
