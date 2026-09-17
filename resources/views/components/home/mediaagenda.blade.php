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
                    Lihat Semua Media
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 5L19 12L12 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>

            <!-- Media Grid -->
            <div class="media-grid">
                @if($homeGaleris->count() > 0)
                    <!-- Galeri Slider -->
                    <div class="galeri-slider" id="galeriSlider">
                        <div class="galeri-slider-track">
                            @foreach($homeGaleris as $galeri)
                                <div class="galeri-slide {{ $loop->first ? 'active' : '' }}">
                                    <a href="{{ route('media.galeri-kegiatan.show', $galeri->slug) }}" class="media-card large-card">
                                        <img src="{{ $galeri->thumbnail_url }}" alt="{{ $galeri->title }}" class="card-image" loading="lazy">
                                        <div class="card-overlay"></div>
                                        <div class="badge-container">
                                            <span class="badge badge-program">{{ $galeri->category }}</span>
                                            <span class="badge badge-date">{{ $galeri->created_at->format('d/m') }}</span>
                                        </div>
                                        <div class="card-content">
                                            <h4 class="card-title">{{ $galeri->title }}</h4>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <!-- Slider Controls -->
                        <button class="slider-btn slider-prev" aria-label="Sebelumnya">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
                        </button>
                        <button class="slider-btn slider-next" aria-label="Selanjutnya">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
                        </button>
                        <!-- Dots -->
                        <div class="slider-dots">
                            @foreach($homeGaleris as $galeri)
                                <span class="slider-dot {{ $loop->first ? 'active' : '' }}" data-index="{{ $loop->index }}"></span>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="home-media-empty">
                        <span class="material-icons home-media-empty-icon">collections</span>
                        <p class="home-media-empty-text">Belum ada dokumentasi galeri kegiatan.</p>
                    </div>
                @endif

                <!-- Infografis 2x2 Grid -->
                @if($homeInfografis->count() > 0)
                    <div class="media-subgrid">
                        @foreach($homeInfografis as $item)
                            <a href="{{ route('media.infografis') }}" class="media-card small-card infografis-card">
                                <img src="{{ asset('uploads/infografis/' . $item->image) }}" alt="{{ $item->title }}" class="card-image" loading="lazy">
                                <div class="card-overlay"></div>
                                <div class="card-content">
                                    <span class="card-category">Infografis</span>
                                    <h4 class="card-title">{{ $item->title }}</h4>
                                </div>
                            </a>
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
                        <span class="date-nav-btn disabled" aria-hidden="true">
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
                        <div class="home-agenda-empty">
                            <span class="material-icons home-media-empty-icon">event_busy</span>
                            <p class="home-media-empty-text">Belum ada agenda kegiatan mendatang.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

@include('components.lightbox')

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Galeri Slider
    const slider = document.getElementById('galeriSlider');
    if (slider) {
        const slides = slider.querySelectorAll('.galeri-slide');
        const dots = slider.querySelectorAll('.slider-dot');
        const prevBtn = slider.querySelector('.slider-prev');
        const nextBtn = slider.querySelector('.slider-next');
        let current = 0;
        let autoTimer;
        let touchStartX = 0;
        let touchEndX = 0;

        function goToSlide(index) {
            slides[current].classList.remove('active');
            dots[current].classList.remove('active');
            current = (index + slides.length) % slides.length;
            slides[current].classList.add('active');
            dots[current].classList.add('active');
        }

        function startAuto() {
            stopAuto();
            autoTimer = setInterval(() => goToSlide(current + 1), 4000);
        }

        function stopAuto() {
            clearInterval(autoTimer);
        }

        prevBtn.addEventListener('click', () => { goToSlide(current - 1); startAuto(); });
        nextBtn.addEventListener('click', () => { goToSlide(current + 1); startAuto(); });

        dots.forEach(dot => {
            dot.addEventListener('click', () => {
                goToSlide(parseInt(dot.dataset.index));
                startAuto();
            });
        });

        // Touch/Swipe support
        slider.addEventListener('touchstart', e => {
            touchStartX = e.changedTouches[0].screenX;
            stopAuto();
        }, { passive: true });

        slider.addEventListener('touchend', e => {
            touchEndX = e.changedTouches[0].screenX;
            const diff = touchStartX - touchEndX;
            if (Math.abs(diff) > 50) {
                goToSlide(diff > 0 ? current + 1 : current - 1);
            }
            startAuto();
        }, { passive: true });

        // Pause on hover
        slider.addEventListener('mouseenter', stopAuto);
        slider.addEventListener('mouseleave', startAuto);

        startAuto();
    }

    // Agenda Timeline Navigation
    const agendaSelector = document.querySelector('.agenda-date-selector');
    const agendaTimeline = document.querySelector('.agenda-timeline');
    if (!agendaSelector || !agendaTimeline) return;

    function attachAgendaNavListeners() {
        const navBtns = agendaSelector.querySelectorAll('a.date-nav-btn');
        navBtns.forEach(btn => {
            btn.removeEventListener('click', handleNavClick);
            btn.addEventListener('click', handleNavClick);
        });
    }

    function handleNavClick(e) {
        e.preventDefault();
        const href = this.getAttribute('href');
        const urlParams = new URLSearchParams(href.substring(href.indexOf('?')));
        const agendaDate = urlParams.get('agenda_date');
        if (!agendaDate) return;

        agendaTimeline.style.opacity = '0.5';
        agendaTimeline.style.pointerEvents = 'none';

        fetch(`/api/agenda-by-date?agenda_date=${agendaDate}`)
            .then(res => res.json())
            .then(data => {
                if (!data.success) return;

                agendaSelector.innerHTML = `
                    <a href="?agenda_date=${data.prevDate}" class="date-nav-btn" aria-label="Previous date">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 18l-6-6 6-6" />
                        </svg>
                    </a>
                    <span class="agenda-current-date">${data.currentDateLabel}</span>
                    <a href="?agenda_date=${data.nextDate}" class="date-nav-btn" aria-label="Next date">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 18l6-6-6-6" />
                        </svg>
                    </a>
                `;

                let timelineHtml = '<div class="timeline-line"></div>';
                if (data.agendas && data.agendas.length > 0) {
                    data.agendas.forEach(agenda => {
                        timelineHtml += `
                            <div class="timeline-item">
                                <div class="timeline-time-badge">${agenda.time_start}</div>
                                <div class="timeline-content-card">
                                    <h5 class="agenda-item-title">${agenda.title}</h5>
                                    <div class="agenda-item-meta">
                                        <span class="agenda-item-location">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                                <circle cx="12" cy="10" r="3" />
                                            </svg>
                                            ${agenda.location}
                                        </span>
                                        <span class="agenda-item-duration">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10" />
                                                <polyline points="12 6 12 12 16 14" />
                                            </svg>
                                            ${agenda.time_start} - ${agenda.time_end}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                } else {
                    timelineHtml += `
                        <div class="home-agenda-empty">
                            <span class="material-icons home-media-empty-icon">event_busy</span>
                            <p class="home-media-empty-text">Belum ada agenda kegiatan mendatang.</p>
                        </div>
                    `;
                }

                agendaTimeline.innerHTML = timelineHtml;
                agendaTimeline.style.opacity = '1';
                agendaTimeline.style.pointerEvents = 'auto';

                attachAgendaNavListeners();
            })
            .catch(err => {
                console.error('Failed to fetch agenda:', err);
                agendaTimeline.style.opacity = '1';
                agendaTimeline.style.pointerEvents = 'auto';
            });
    }

    attachAgendaNavListeners();
});
</script>
