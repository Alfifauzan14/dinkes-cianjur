<link rel="stylesheet" href="{{ asset('css/home/mediaagenda.css') }}?v={{ time() }}">

<section class="mediaagenda-section">
    <div class="mediaagenda-inner">
    <!-- Header -->
    <div class="mediaagenda-header">
        <h2 class="mediaagenda-title">Media &amp; Agenda</h2>
    </div>

    <!-- Main Container -->
    <div class="mediaagenda-container">
        <!-- Left Column: Media -->
        <div class="media-column">
            <div class="column-header">
                <a href="{{ route('media') }}" class="view-all-link">
                    Lihat Semua Galeri
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 5L19 12L12 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>

            <!-- Media Grid -->
            <div class="media-grid">
                <!-- Large Card -->
                <div class="media-card large-card">
                    <img src="{{ asset('images/dumy1.png') }}" alt="Penguatan Sinergi" class="card-image" loading="lazy">
                    <div class="card-overlay"></div>
                    <div class="badge-container">
                        <span class="badge badge-program">PROGRAM</span>
                        <span class="badge badge-date">23/06</span>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">PENGUATAN SINERGI DINAS KESEHATAN CIANJUR BERSAMA KLINIK UTAMA ROTINSULU DALAM MENINGKATKAN AKSES DAN MUTU PELAYANAN KESEHATAN</h4>
                    </div>
                </div>

                <!-- 2x2 Grid -->
                <div class="media-subgrid">
                    <!-- Card 2 -->
                    <div class="media-card small-card">
                        <img src="{{ asset('images/dumy1.png') }}" alt="PSC 119" class="card-image" loading="lazy">
                        <div class="card-overlay"></div>
                        <div class="badge-container">
                            <span class="badge badge-program">PROGRAM</span>
                        </div>
                        <div class="card-content">
                            <span class="card-category">NASIONAL</span>
                            <h4 class="card-title">layanan PSC 119</h4>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="media-card small-card">
                        <img src="{{ asset('images/dumy2.png') }}" alt="Hari Keluarga Nasional" class="card-image" loading="lazy">
                        <div class="card-overlay"></div>
                        <div class="badge-container">
                            <span class="badge badge-program">PROGRAM</span>
                        </div>
                        <div class="card-content">
                            <span class="card-category">NASIONAL</span>
                            <h4 class="card-title">Hari Keluarga Nasional</h4>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="media-card small-card">
                        <img src="{{ asset('images/dumy2.png') }}" alt="Lomba Inovasi Daerah" class="card-image" loading="lazy">
                        <div class="card-overlay"></div>
                        <div class="badge-container">
                            <span class="badge badge-program">PROGRAM</span>
                        </div>
                        <div class="card-content">
                            <span class="card-category">NASIONAL</span>
                            <h4 class="card-title">Lomba Inovasi Daerah</h4>
                        </div>
                    </div>

                    <!-- Card 5 -->
                    <div class="media-card small-card">
                        <img src="{{ asset('images/dumy2.png') }}" alt="Universal Health" class="card-image" loading="lazy">
                        <div class="card-overlay"></div>
                        <div class="badge-container">
                            <span class="badge badge-program">PROGRAM</span>
                        </div>
                        <div class="card-content">
                            <span class="card-category">NASIONAL</span>
                            <h4 class="card-title">Universal Health</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Agenda -->
        <div class="agenda-column">
            <div class="column-header">
                <a href="{{ route('agenda') }}" class="view-all-link">
                    Lihat Semua Agenda
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 5L19 12L12 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>

            <!-- Agenda Card / Calendar List -->
            <div class="agenda-box">
                <!-- Date Selector / Navigation -->
                <div class="agenda-date-selector">
                    <button class="date-nav-btn" aria-label="Previous date">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 18l-6-6 6-6" />
                        </svg>
                    </button>
                    <span class="agenda-current-date">08 JULI 2026</span>
                    <button class="date-nav-btn" aria-label="Next date">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 18l6-6-6-6" />
                        </svg>
                    </button>
                </div>

                <!-- Timeline List -->
                <div class="agenda-timeline">
                    <!-- Line decoration -->
                    <div class="timeline-line"></div>

                    <!-- Item 1 -->
                    <div class="timeline-item">
                        <div class="timeline-time-badge">07.30</div>
                        <div class="timeline-content-card">
                            <h5 class="agenda-item-title">Apel Pagi &amp; Evaluasi Kinerja Mingguan</h5>
                            <div class="agenda-item-meta">
                                <span class="agenda-item-location">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                    Kantor Dinkes
                                </span>
                                <span class="agenda-item-duration">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <polyline points="12 6 12 12 16 14" />
                                    </svg>
                                    07.30 - 09.00
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="timeline-item">
                        <div class="timeline-time-badge">09.00</div>
                        <div class="timeline-content-card">
                            <h5 class="agenda-item-title">Rapat Koordinasi Program Kesehatan</h5>
                            <div class="agenda-item-meta">
                                <span class="agenda-item-location">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                    Ruang Rapat Dinkes
                                </span>
                                <span class="agenda-item-duration">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <polyline points="12 6 12 12 16 14" />
                                    </svg>
                                    09.00 - 11.00
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="timeline-item">
                        <div class="timeline-time-badge">11.00</div>
                        <div class="timeline-content-card">
                            <h5 class="agenda-item-title">Sosialisasi Kesehatan Masyarakat</h5>
                            <div class="agenda-item-meta">
                                <span class="agenda-item-location">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                    Aula Dinkes
                                </span>
                                <span class="agenda-item-duration">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <polyline points="12 6 12 12 16 14" />
                                    </svg>
                                    11.00 - 12.00
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Item 4 -->
                    <div class="timeline-item">
                        <div class="timeline-time-badge">13.00</div>
                        <div class="timeline-content-card">
                            <h5 class="agenda-item-title">Penyusunan Laporan Kegiatan</h5>
                            <div class="agenda-item-meta">
                                <span class="agenda-item-location">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                    Puskesmas
                                </span>
                                <span class="agenda-item-duration">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <polyline points="12 6 12 12 16 14" />
                                    </svg>
                                    13.00 - 15.00
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Item 5 -->
                    <div class="timeline-item">
                        <div class="timeline-time-badge">15.00</div>
                        <div class="timeline-content-card">
                            <h5 class="agenda-item-title">Apel Pagi &amp; Evaluasi Kinerja Mingguan</h5>
                            <div class="agenda-item-meta">
                                <span class="agenda-item-location">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                    Kantor Dinkes
                                </span>
                                <span class="agenda-item-duration">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <polyline points="12 6 12 12 16 14" />
                                    </svg>
                                    15.00 - 16.00
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Item 6 -->
                    <div class="timeline-item">
                        <div class="timeline-time-badge">16.00</div>
                        <div class="timeline-content-card">
                            <h5 class="agenda-item-title">Diskusi &amp; Perencanaan Program</h5>
                            <div class="agenda-item-meta">
                                <span class="agenda-item-location">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                    Ruang Rapat Dinkes
                                </span>
                                <span class="agenda-item-duration">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <polyline points="12 6 12 12 16 14" />
                                    </svg>
                                    16.00 - 17.00
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
