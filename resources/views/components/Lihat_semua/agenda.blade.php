<link rel="stylesheet" href="{{ asset('css/Lihat_semua/agenda.css') }}?v={{ time() }}">

<div class="agenda-page-wrapper">
    <!-- Header Banner -->
    <header class="agenda-header">
        <div class="agenda-header-container">
            <h1 class="agenda-header-title">Agenda Kesehatan</h1>
            <p class="agenda-header-subtitle">Kumpulan Agenda dan Acara yang dijadwalkan di Dinas Kesehatan Kabupaten Cianjur</p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="agenda-content">
        <div class="agenda-container">
            <!-- Left Column: Calendar Card -->
            <div class="calendar-card">
                <div class="calendar-header">
                    <button class="calendar-nav-btn" aria-label="Previous Month">
                        <svg viewBox="0 0 24 24">
                            <path d="M15 19l-7-7 7-7" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <h3 class="calendar-month-title">Juli 2026</h3>
                    <button class="calendar-nav-btn" aria-label="Next Month">
                        <svg viewBox="0 0 24 24">
                            <path d="M9 5l7 7-7 7" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>

                <div class="calendar-body">
                    <!-- Weekdays -->
                    <div class="calendar-weekdays">
                        <span class="sunday">Minggu</span>
                        <span>Senin</span>
                        <span>Selasa</span>
                        <span>Rabu</span>
                        <span>Kamis</span>
                        <span>Jumat</span>
                        <span>Sabtu</span>
                    </div>

                    <!-- Days Grid -->
                    <div class="calendar-days-grid">
                        <!-- Row 1: June 28 - July 4 -->
                        <div class="calendar-day-cell other-month">
                            <span class="calendar-day-number">28</span>
                        </div>
                        <div class="calendar-day-cell other-month">
                            <span class="calendar-day-number">29</span>
                        </div>
                        <div class="calendar-day-cell other-month">
                            <span class="calendar-day-number">30</span>
                        </div>
                        <div class="calendar-day-cell has-event">
                            <span class="calendar-day-number">1</span>
                        </div>
                        <div class="calendar-day-cell has-event">
                            <span class="calendar-day-number">2</span>
                        </div>
                        <div class="calendar-day-cell has-event">
                            <span class="calendar-day-number">3</span>
                        </div>
                        <div class="calendar-day-cell">
                            <span class="calendar-day-number">4</span>
                        </div>

                        <!-- Row 2: July 5 - 11 -->
                        <div class="calendar-day-cell sunday">
                            <span class="calendar-day-number">5</span>
                        </div>
                        <div class="calendar-day-cell has-event">
                            <span class="calendar-day-number">6</span>
                        </div>
                        <div class="calendar-day-cell has-event">
                            <span class="calendar-day-number">7</span>
                        </div>
                        <div class="calendar-day-cell has-event">
                            <span class="calendar-day-number">8</span>
                        </div>
                        <div class="calendar-day-cell">
                            <span class="calendar-day-number">9</span>
                        </div>
                        <div class="calendar-day-cell has-event">
                            <span class="calendar-day-number">10</span>
                        </div>
                        <div class="calendar-day-cell">
                            <span class="calendar-day-number">11</span>
                        </div>

                        <!-- Row 3: July 12 - 18 -->
                        <div class="calendar-day-cell sunday">
                            <span class="calendar-day-number">12</span>
                        </div>
                        <div class="calendar-day-cell">
                            <span class="calendar-day-number">13</span>
                        </div>
                        <div class="calendar-day-cell">
                            <span class="calendar-day-number">14</span>
                        </div>
                        <div class="calendar-day-cell has-event">
                            <span class="calendar-day-number">15</span>
                        </div>
                        <div class="calendar-day-cell">
                            <span class="calendar-day-number">16</span>
                        </div>
                        <div class="calendar-day-cell has-event">
                            <span class="calendar-day-number">17</span>
                        </div>
                        <div class="calendar-day-cell">
                            <span class="calendar-day-number">18</span>
                        </div>

                        <!-- Row 4: July 19 - 25 -->
                        <div class="calendar-day-cell sunday">
                            <span class="calendar-day-number">19</span>
                        </div>
                        <div class="calendar-day-cell has-event">
                            <span class="calendar-day-number">20</span>
                        </div>
                        <div class="calendar-day-cell">
                            <span class="calendar-day-number">21</span>
                        </div>
                        <div class="calendar-day-cell active">
                            <span class="calendar-day-number">22</span>
                        </div>
                        <div class="calendar-day-cell">
                            <span class="calendar-day-number">23</span>
                        </div>
                        <div class="calendar-day-cell">
                            <span class="calendar-day-number">24</span>
                        </div>
                        <div class="calendar-day-cell">
                            <span class="calendar-day-number">25</span>
                        </div>

                        <!-- Row 5: July 26 - Aug 1 -->
                        <div class="calendar-day-cell sunday">
                            <span class="calendar-day-number">26</span>
                        </div>
                        <div class="calendar-day-cell">
                            <span class="calendar-day-number">27</span>
                        </div>
                        <div class="calendar-day-cell">
                            <span class="calendar-day-number">28</span>
                        </div>
                        <div class="calendar-day-cell">
                            <span class="calendar-day-number">29</span>
                        </div>
                        <div class="calendar-day-cell">
                            <span class="calendar-day-number">30</span>
                        </div>
                        <div class="calendar-day-cell">
                            <span class="calendar-day-number">31</span>
                        </div>
                        <div class="calendar-day-cell other-month">
                            <span class="calendar-day-number">1</span>
                        </div>
                    </div>
                </div>

                <div class="calendar-legend">
                    <span class="legend-dot"></span>
                    <span>Ada agenda</span>
                </div>
            </div>

            <!-- Right Column: Timeline & Events List -->
            <div class="timeline-column">
                <div class="timeline-section-header">
                    <h2 class="timeline-section-title">Jumat, 22 Juli 2026</h2>
                    <p class="timeline-section-subtitle">Daftar kegiatan pada tanggal yang dipilih</p>
                </div>

                <div class="agenda-timeline-wrapper">
                    <div class="timeline-line"></div>

                    <!-- Event Item 1 -->
                    <div class="timeline-item">
                        <div class="timeline-time-badge">07.30</div>
                        <div class="timeline-content-card">
                            <div class="card-left">
                                <h5 class="agenda-item-title">Apel Pagi &amp; Evaluasi Kinerja Mingguan</h5>
                                <div class="agenda-item-location">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                    <span>Kantor Dinkes</span>
                                </div>
                            </div>
                            <div class="card-right">
                                <div class="agenda-item-duration">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <polyline points="12 6 12 12 16 14" />
                                    </svg>
                                    <span>07.30 - 09.00</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Event Item 2 -->
                    <div class="timeline-item">
                        <div class="timeline-time-badge">09.00</div>
                        <div class="timeline-content-card">
                            <div class="card-left">
                                <h5 class="agenda-item-title">Rapat Koordinasi Program Kesehatan</h5>
                                <div class="agenda-item-location">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                    <span>Ruang Rapat Dinkes</span>
                                </div>
                            </div>
                            <div class="card-right">
                                <div class="agenda-item-duration">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <polyline points="12 6 12 12 16 14" />
                                    </svg>
                                    <span>09.00 - 11.00</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Event Item 3 -->
                    <div class="timeline-item">
                        <div class="timeline-time-badge">11.00</div>
                        <div class="timeline-content-card">
                            <div class="card-left">
                                <h5 class="agenda-item-title">Sosialisasi Kesehatan Masyarakat</h5>
                                <div class="agenda-item-location">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                    <span>Aula Dinkes</span>
                                </div>
                            </div>
                            <div class="card-right">
                                <div class="agenda-item-duration">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <polyline points="12 6 12 12 16 14" />
                                    </svg>
                                    <span>11.00 - 12.00</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Event Item 4 -->
                    <div class="timeline-item">
                        <div class="timeline-time-badge">13.00</div>
                        <div class="timeline-content-card">
                            <div class="card-left">
                                <h5 class="agenda-item-title">Penyusunan Laporan Kegiatan</h5>
                                <div class="agenda-item-location">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                    <span>Puskesmas</span>
                                </div>
                            </div>
                            <div class="card-right">
                                <div class="agenda-item-duration">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <polyline points="12 6 12 12 16 14" />
                                    </svg>
                                    <span>13.00 - 15.00</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Event Item 5 -->
                    <div class="timeline-item">
                        <div class="timeline-time-badge">15.00</div>
                        <div class="timeline-content-card">
                            <div class="card-left">
                                <h5 class="agenda-item-title">Apel Pagi &amp; Evaluasi Kinerja Mingguan</h5>
                                <div class="agenda-item-location">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                    <span>Kantor Dinkes</span>
                                </div>
                            </div>
                            <div class="card-right">
                                <div class="agenda-item-duration">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <polyline points="12 6 12 12 16 14" />
                                    </svg>
                                    <span>15.00 - 16.00</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Event Item 6 -->
                    <div class="timeline-item">
                        <div class="timeline-time-badge">16.00</div>
                        <div class="timeline-content-card">
                            <div class="card-left">
                                <h5 class="agenda-item-title">Diskusi &amp; Perencanaan Program</h5>
                                <div class="agenda-item-location">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                    <span>Ruang Rapat Dinkes</span>
                                </div>
                            </div>
                            <div class="card-right">
                                <div class="agenda-item-duration">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <polyline points="12 6 12 12 16 14" />
                                    </svg>
                                    <span>16.00 - 17.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
