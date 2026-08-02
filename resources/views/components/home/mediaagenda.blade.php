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
                @php
                    $firstGaleri = $homeGaleris->first();
                    $subGaleris = $homeGaleris->skip(1);
                @endphp

                @if($firstGaleri)
                    <!-- Large Card -->
                    <div class="media-card large-card">
                        @if(file_exists(public_path('uploads/galeri/' . $firstGaleri->image)))
                            <img src="{{ asset('uploads/galeri/' . $firstGaleri->image) }}" alt="{{ $firstGaleri->title }}" class="card-image" loading="lazy">
                        @else
                            <img src="{{ asset('images/' . $firstGaleri->image) }}" alt="{{ $firstGaleri->title }}" class="card-image" loading="lazy">
                        @endif
                        <div class="card-overlay"></div>
                        <div class="badge-container">
                            <span class="badge badge-program">{{ $firstGaleri->category }}</span>
                            <span class="badge badge-date">{{ $firstGaleri->created_at->format('d/m') }}</span>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">{{ $firstGaleri->title }}</h4>
                        </div>
                    </div>
                @else
                    <div style="grid-column: span 2; text-align: center; padding: 48px; color: #9CA3AF; background: #F3F4F6; display: flex; flex-direction: column; align-items: center; justify-content: center; width: 100%; border-radius: 12px; height: 350px;">
                        <span class="material-icons" style="font-size: 48px; margin-bottom: 8px;">collections</span>
                        <p style="font-weight: 600;">Belum ada dokumentasi galeri kegiatan.</p>
                    </div>
                @endif

                <!-- 2x2 Grid -->
                @if($subGaleris->count() > 0)
                    <div class="media-subgrid">
                        @foreach($subGaleris as $galeri)
                            <!-- Card -->
                            <div class="media-card small-card">
                                @if(file_exists(public_path('uploads/galeri/' . $galeri->image)))
                                    <img src="{{ asset('uploads/galeri/' . $galeri->image) }}" alt="{{ $galeri->title }}" class="card-image" loading="lazy">
                                @else
                                    <img src="{{ asset('images/' . $galeri->image) }}" alt="{{ $galeri->title }}" class="card-image" loading="lazy">
                                @endif
                                <div class="card-overlay"></div>
                                <div class="badge-container">
                                    <span class="badge badge-program">{{ $galeri->category }}</span>
                                </div>
                                <div class="card-content">
                                    <span class="card-category">{{ $galeri->category }}</span>
                                    <h4 class="card-title">{{ $galeri->title }}</h4>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
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
                    <a href="?agenda_date={{ $prevDate }}" class="date-nav-btn" aria-label="Previous date">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 18l-6-6 6-6" />
                        </svg>
                    </a>
                    <span class="agenda-current-date">{{ $currentDateLabel }}</span>
                    @if($canNavigateNext)
                        <a href="?agenda_date={{ $nextDate }}" class="date-nav-btn" aria-label="Next date">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 18l6-6-6-6" />
                            </svg>
                        </a>
                    @else
                        <span class="date-nav-btn disabled" aria-hidden="true" style="opacity: 0.3; cursor: not-allowed;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 18l6-6-6-6" />
                            </svg>
                        </span>
                    @endif
                </div>

                <!-- Timeline List -->
                <div class="agenda-timeline">
                    <!-- Line decoration -->
                    <div class="timeline-line"></div>

                    @forelse($homeAgendas as $agenda)
                        <!-- Item -->
                        <div class="timeline-item">
                            <div class="timeline-time-badge">{{ $agenda->time_start }}</div>
                            <div class="timeline-content-card">
                                <h5 class="agenda-item-title">{{ $agenda->title }}</h5>
                                <div class="agenda-item-meta">
                                    <span class="agenda-item-location">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                            <circle cx="12" cy="10" r="3" />
                                        </svg>
                                        {{ $agenda->location }}
                                    </span>
                                    <span class="agenda-item-duration">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10" />
                                            <polyline points="12 6 12 12 16 14" />
                                        </svg>
                                        {{ $agenda->time_start }} - {{ $agenda->time_end }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div style="text-align: center; padding: 48px; color: #9CA3AF; width: 100%;">
                            <span class="material-icons" style="font-size: 48px; margin-bottom: 8px;">event_busy</span>
                            <p style="font-weight: 600;">Belum ada agenda kegiatan mendatang.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
