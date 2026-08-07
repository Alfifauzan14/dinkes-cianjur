<link rel="stylesheet" href="{{ asset('css/Lihat_semua/agenda.css') }}?v={{ time() }}">

<div class="agenda-page-wrapper">
    @php
        $headerSetting = \App\Models\HeaderSetting::getByKey('agenda', 'Agenda Kegiatan', 'Jadwal program, rapat, sosialisasi, dan aktivitas penting Dinas Kesehatan.');
    @endphp
    <!-- Header Banner -->
    <header class="agenda-header">
        <div class="agenda-header-container">
            <h1 class="agenda-header-title">{{ \App\Models\Setting::get('page_agenda_title', 'Agenda Kesehatan') }}</h1>
            <p class="agenda-header-subtitle">{{ \App\Models\Setting::get('page_agenda_subtitle', 'Kumpulan Agenda dan Acara yang dijadwalkan di Dinas Kesehatan Kabupaten Cianjur') }}</p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="agenda-content">
        <div class="agenda-container">
            <!-- Left Column: Calendar Card -->
            <div class="calendar-card">
                @php
                    $prevMonthVal = $month == 1 ? 12 : $month - 1;
                    $prevYearVal = $month == 1 ? $year - 1 : $year;
                    $nextMonthVal = $month == 12 ? 1 : $month + 1;
                    $nextYearVal = $month == 12 ? $year + 1 : $year;
                @endphp
                <div class="calendar-header">
                    <a href="?month={{ $prevMonthVal }}&year={{ $prevYearVal }}" class="calendar-nav-btn agenda-nav-link" aria-label="Previous Month">
                        <svg viewBox="0 0 24 24">
                            <path d="M15 19l-7-7 7-7" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <h3 class="calendar-month-title">{{ $monthName }} {{ $year }}</h3>
                    <a href="?month={{ $nextMonthVal }}&year={{ $nextYearVal }}" class="calendar-nav-btn agenda-nav-link" aria-label="Next Month">
                        <svg viewBox="0 0 24 24">
                            <path d="M9 5l7 7-7 7" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
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
                        @foreach($days as $day)
                            @php
                                $isTodayClass = $day['is_today'] ? 'today' : '';
                                $isCurrentMonthClass = $day['is_current_month'] ? '' : 'other-month';
                                $hasEventClass = $day['has_events'] ? 'has-event' : '';
                                $isSelectedClass = ($day['date_string'] === $selectedDateString) ? 'active' : '';
                            @endphp

                            @if($day['is_current_month'])
                                <a href="?month={{ $month }}&year={{ $year }}&date={{ $day['date_string'] }}" 
                                   class="calendar-day-cell {{ $isTodayClass }} {{ $hasEventClass }} {{ $isSelectedClass }} agenda-nav-link">
                                    <span class="calendar-day-number">{{ $day['day'] }}</span>
                                </a>
                            @else
                                <div class="calendar-day-cell other-month">
                                    <span class="calendar-day-number">{{ $day['day'] }}</span>
                                </div>
                            @endif
                        @endforeach
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
                    <h2 class="timeline-section-title">{{ $timelineTitle }}</h2>
                    <p class="timeline-section-subtitle">Daftar kegiatan pada tanggal yang dipilih</p>
                </div>

                <div class="agenda-timeline-wrapper">
                    <div class="timeline-line"></div>

                    @forelse($timelineAgendas as $agenda)
                        <!-- Event Item -->
                        <div class="timeline-item">
                            <div class="timeline-time-badge">{{ $agenda->time_start }}</div>
                            <div class="timeline-content-card">
                                <div class="card-left">
                                    <h5 class="agenda-item-title">{{ $agenda->title }}</h5>
                                    <div class="agenda-item-location agenda-location-wrap">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="agenda-icon">
                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                            <circle cx="12" cy="10" r="3" />
                                        </svg>
                                        <span>{{ $agenda->location }}</span>
                                    </div>
                                    @if($agenda->description)
                                        <p class="agenda-desc-text">{{ $agenda->description }}</p>
                                    @endif
                                </div>
                                <div class="card-right">
                                    <div class="agenda-item-duration">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="agenda-icon">
                                            <circle cx="12" cy="12" r="10" />
                                            <polyline points="12 6 12 12 16 14" />
                                        </svg>
                                        <span>{{ $agenda->time_start }} - {{ $agenda->time_end }}</span>
                                    </div>
                                    <div class="agenda-meta-time">
                                        {{ $agenda->date->format('d M Y') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="agenda-empty-state">
                            <span class="material-icons agenda-empty-icon">event_busy</span>
                            <p class="agenda-empty-text">Tidak ada agenda kegiatan pada periode/hari ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </main>
</div>
