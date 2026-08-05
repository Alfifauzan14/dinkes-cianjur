<link rel="stylesheet" href="{{ asset('css/Lihat_semua/agenda.css') }}?v={{ time() }}">

<div class="agenda-page-wrapper">
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
                    <a href="?month={{ $prevMonthVal }}&year={{ $prevYearVal }}" class="calendar-nav-btn" aria-label="Previous Month" style="text-decoration: none;">
                        <svg viewBox="0 0 24 24">
                            <path d="M15 19l-7-7 7-7" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <h3 class="calendar-month-title">{{ $monthName }} {{ $year }}</h3>
                    <a href="?month={{ $nextMonthVal }}&year={{ $nextYearVal }}" class="calendar-nav-btn" aria-label="Next Month" style="text-decoration: none;">
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
                                   class="calendar-day-cell {{ $isTodayClass }} {{ $hasEventClass }} {{ $isSelectedClass }}" 
                                   style="text-decoration: none;">
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
                                    <div class="agenda-item-location" style="margin-top: 4px;">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: inline-block; vertical-align: middle; margin-right: 4px;">
                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                            <circle cx="12" cy="10" r="3" />
                                        </svg>
                                        <span>{{ $agenda->location }}</span>
                                    </div>
                                    @if($agenda->description)
                                        <p style="font-size: 13px; color: #6B7280; margin-top: 6px; line-height: 1.4;">{{ $agenda->description }}</p>
                                    @endif
                                </div>
                                <div class="card-right">
                                    <div class="agenda-item-duration">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: inline-block; vertical-align: middle; margin-right: 4px;">
                                            <circle cx="12" cy="12" r="10" />
                                            <polyline points="12 6 12 12 16 14" />
                                        </svg>
                                        <span>{{ $agenda->time_start }} - {{ $agenda->time_end }}</span>
                                    </div>
                                    <div style="font-size: 11px; color: #9CA3AF; font-weight: 500; margin-top: 6px; text-align: right;">
                                        {{ $agenda->date->format('d M Y') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div style="text-align: center; padding: 48px; color: #9CA3AF; width: 100%;">
                            <span class="material-icons" style="font-size: 48px; margin-bottom: 8px; display: block;">event_busy</span>
                            <p style="font-weight: 600;">Tidak ada agenda kegiatan pada periode/hari ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </main>
</div>
