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
                    <span class="status-text">{{ $setting->status_badge }}</span>
                </div>
            </div>

            <!-- 4 Stat Cards Row -->
            <div class="stat-cards-grid">
                
                <!-- Card 1: Puskesmas -->
                <div class="stat-card">
                    <div class="stat-card-header">
                        <span class="stat-card-label">PUSKESMAS</span>
                        <span class="stat-card-badge badge-active">{{ $setting->stat_1_badge }}</span>
                    </div>
                    <div class="stat-card-number">{{ $setting->stat_1_num }}</div>
                    <div class="stat-card-caption caption-accent">
                        <svg class="caption-icon" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        <span>{{ $setting->stat_1_caption }}</span>
                    </div>
                </div>

                <!-- Card 2: Rumah Sakit Rujukan -->
                <div class="stat-card">
                    <div class="stat-card-header">
                        <span class="stat-card-label">RUMAH SAKIT RUJUKAN</span>
                        <span class="stat-card-badge badge-muted">{{ $setting->stat_2_badge }}</span>
                    </div>
                    <div class="stat-card-number">{{ $setting->stat_2_num }}</div>
                    <div class="stat-card-caption">
                        <span>{{ $setting->stat_2_caption }}</span>
                    </div>
                </div>

                <!-- Card 3: SDM Kesehatan -->
                <div class="stat-card">
                    <div class="stat-card-header">
                        <span class="stat-card-label">SDM KESEHATAN</span>
                        <span class="stat-card-badge badge-muted">{{ $setting->stat_3_badge }}</span>
                    </div>
                    <div class="stat-card-number">{{ $setting->stat_3_num }}</div>
                    <div class="stat-card-caption">
                        <span>{{ $setting->stat_3_caption }}</span>
                    </div>
                </div>

                <!-- Card 4: Cakupan Imunisasi -->
                <div class="stat-card">
                    <div class="stat-card-header">
                        <span class="stat-card-label">CAKUPAN IMUNISASI</span>
                        <span class="stat-card-badge badge-muted">{{ $setting->stat_4_badge }}</span>
                    </div>
                    <div class="stat-card-number">{{ $setting->stat_4_num }}</div>
                    <div class="stat-card-caption">
                        <span>{{ $setting->stat_4_caption }}</span>
                    </div>
                </div>

            </div>

            <!-- Chart Card: Tren Penurunan Prevalensi Stunting -->
            <div class="chart-card">
                <div class="chart-header">
                    <div class="chart-header-left">
                        <h3 class="chart-title">{{ $setting->stunting_title }}</h3>
                        <p class="chart-subtitle">{{ $setting->stunting_subtitle }}</p>
                    </div>
                    <div class="chart-header-right">
                        <span class="trend-badge">{{ $setting->stunting_trend_badge }}</span>
                    </div>
                </div>

                <!-- Bar Chart Canvas Container -->
                <div class="stunting-chart-container">
                    <!-- Y-Axis Grid Lines -->
                    <div class="chart-y-axis-grid">
                        <div class="grid-line"><span class="grid-line-label">20%</span></div>
                        <div class="grid-line"><span class="grid-line-label">15%</span></div>
                        <div class="grid-line"><span class="grid-line-label">10%</span></div>
                        <div class="grid-line"><span class="grid-line-label">5%</span></div>
                        <div class="grid-line" style="border-top-style: solid; border-top-color: #CBD5E1;"><span class="grid-line-label">0%</span></div>
                    </div>

                    <div class="chart-bars-wrapper">
                        @foreach($stuntingRecords as $record)
                            @php
                                $heightPercent = $maxRate > 0 ? ($record->rate / $maxRate) * 100 : 0;
                            @endphp
                            <div class="chart-bar-item {{ $record->is_highlighted ? 'bar-highlighted' : '' }}"
                                 role="button"
                                 tabindex="0"
                                 aria-label="Detail stunting tahun {{ $record->year }}"
                                 data-year="{{ $record->year }}"
                                 data-rate="{{ $record->rate }}"
                                 data-total="{{ $record->total_balita ?? '' }}"
                                 data-stunting="{{ $record->balita_stunting ?? '' }}"
                                 data-terendah="{{ $record->wilayah_terendah ?? '' }}"
                                 data-tertinggi="{{ $record->wilayah_tertinggi ?? '' }}"
                                 data-catatan="{{ $record->catatan ?? '' }}"
                                 onclick="openStuntingModal(this)"
                                 onkeydown="if(event.key==='Enter')openStuntingModal(this)">
                                <span class="bar-val {{ $record->is_highlighted ? 'font-bold' : '' }}">{{ $record->rate }}%</span>
                                <div class="bar-track">
                                    <div class="bar-fill {{ $record->is_highlighted ? 'bar-fill-active' : '' }}" style="height: {{ $heightPercent }};"></div>
                                </div>
                                <span class="bar-year {{ $record->is_highlighted ? 'bar-year-active' : '' }}">
                                    {{ $record->year }}
                                    @if($record->is_highlighted)
                                        <span class="bar-year-tag" style="display: block; font-size: 11px; font-weight: 500;">(Saat Ini)</span>
                                    @endif
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Footer Note -->
                <div class="chart-footer-note">
                    {!! $setting->stunting_footer_note !!}
                </div>

                <!-- Click-to-Detail Hint -->
                <div class="chart-click-hint">
                    <span class="material-icons" style="font-size: 14px; vertical-align: middle;">touch_app</span>
                    Klik batang grafik untuk melihat detail data
                </div>
            </div>

            <!-- ── Stunting Detail Modal ─────────────────────────────────────── -->
            <div id="stunting-modal-backdrop" class="stunting-modal-backdrop" onclick="closeStuntingModal()" aria-hidden="true"></div>
            <div id="stunting-modal" class="stunting-modal" role="dialog" aria-modal="true" aria-labelledby="modal-title">
                <div class="stunting-modal-header">
                    <div>
                        <span class="stunting-modal-year-badge" id="modal-year-badge">2026</span>
                        <h3 class="stunting-modal-title" id="modal-title">Data Prevalensi Stunting</h3>
                    </div>
                    <button class="stunting-modal-close" onclick="closeStuntingModal()" aria-label="Tutup modal">
                        <span class="material-icons">close</span>
                    </button>
                </div>

                <div class="stunting-modal-body">
                    <!-- Rate Highlight -->
                    <div class="modal-rate-card">
                        <span class="modal-rate-label">Prevalensi Stunting</span>
                        <span class="modal-rate-value" id="modal-rate">—</span>
                    </div>

                    <!-- Detail Grid -->
                    <div class="modal-detail-grid">
                        <div class="modal-detail-item" id="modal-total-wrap">
                            <span class="modal-detail-icon material-icons">people</span>
                            <div>
                                <span class="modal-detail-label">Total Balita Diukur</span>
                                <span class="modal-detail-value" id="modal-total">—</span>
                            </div>
                        </div>
                        <div class="modal-detail-item" id="modal-stunting-wrap">
                            <span class="modal-detail-icon material-icons" style="color: #DC2626;">child_care</span>
                            <div>
                                <span class="modal-detail-label">Balita Stunting</span>
                                <span class="modal-detail-value" id="modal-stunting" style="color: #DC2626;">—</span>
                            </div>
                        </div>
                        <div class="modal-detail-item" id="modal-terendah-wrap">
                            <span class="modal-detail-icon material-icons" style="color: #009966;">trending_down</span>
                            <div>
                                <span class="modal-detail-label">Wilayah Terendah</span>
                                <span class="modal-detail-value" id="modal-terendah" style="color: #009966;">—</span>
                            </div>
                        </div>
                        <div class="modal-detail-item" id="modal-tertinggi-wrap">
                            <span class="modal-detail-icon material-icons" style="color: #D97706;">trending_up</span>
                            <div>
                                <span class="modal-detail-label">Wilayah Tertinggi</span>
                                <span class="modal-detail-value" id="modal-tertinggi" style="color: #D97706;">—</span>
                            </div>
                        </div>
                    </div>

                    <!-- Catatan -->
                    <div class="modal-catatan" id="modal-catatan-wrap">
                        <span class="material-icons" style="font-size: 16px; vertical-align: middle; color: #64748B;">info</span>
                        <span id="modal-catatan">—</span>
                    </div>
                </div>
            </div>

            <script>
            function openStuntingModal(el) {
                const year     = el.dataset.year;
                const rate     = el.dataset.rate;
                const total    = el.dataset.total;
                const stunting = el.dataset.stunting;
                const terendah = el.dataset.terendah;
                const tertinggi= el.dataset.tertinggi;
                const catatan  = el.dataset.catatan;

                document.getElementById('modal-year-badge').textContent = year;
                document.getElementById('modal-title').textContent      = 'Data Prevalensi Stunting ' + year;
                document.getElementById('modal-rate').textContent       = rate + '%';

                const setItem = (wrapId, valId, val, fallback) => {
                    const wrap = document.getElementById(wrapId);
                    const valEl = document.getElementById(valId);
                    if (val) {
                        valEl.textContent = val;
                        wrap.style.display = '';
                    } else {
                        wrap.style.display = fallback ? '' : 'none';
                        valEl.textContent = '—';
                    }
                };

                setItem('modal-total-wrap',    'modal-total',    total    ? Number(total).toLocaleString('id-ID') : '', false);
                setItem('modal-stunting-wrap', 'modal-stunting', stunting ? Number(stunting).toLocaleString('id-ID') + ' anak' : '', false);
                setItem('modal-terendah-wrap', 'modal-terendah', terendah, false);
                setItem('modal-tertinggi-wrap','modal-tertinggi',tertinggi, false);

                const catatanWrap = document.getElementById('modal-catatan-wrap');
                document.getElementById('modal-catatan').textContent = catatan || '—';
                catatanWrap.style.display = catatan ? '' : 'none';

                document.getElementById('stunting-modal').classList.add('active');
                document.getElementById('stunting-modal-backdrop').classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function closeStuntingModal() {
                document.getElementById('stunting-modal').classList.remove('active');
                document.getElementById('stunting-modal-backdrop').classList.remove('active');
                document.body.style.overflow = '';
            }

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') closeStuntingModal();
            });
            </script>

            <!-- Two Side-by-Side Progress Cards -->
            <div class="progress-cards-grid">
                
                <!-- Card A: Distribusi Profesi Nakes -->
                <div class="progress-card">
                    <div class="progress-card-header">
                        <div class="progress-card-title-area">
                            <h3 class="progress-card-title">Distribusi Profesi Nakes ({{ $setting->stat_3_num }})</h3>
                            <p class="progress-card-subtitle">Terdaftar pada Portal E-SIP Dinkes</p>
                        </div>
                        <span class="progress-badge">Aktif SIP</span>
                    </div>
                    
                    <div class="progress-list">
                        @if($setting->nakes_data)
                            @foreach($setting->nakes_data as $nakes)
                                <div class="progress-item">
                                    <div class="progress-item-labels">
                                        <span class="progress-item-name">{{ $nakes['name'] }}</span>
                                        <span class="progress-item-value">{{ $nakes['value'] }}</span>
                                    </div>
                                    <div class="progress-track-wrapper">
                                        <div class="progress-bar-fill" style="width: {{ $nakes['width'] }}%;"></div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- Card B: Sebaran Puskesmas per Zonasi -->
                <div class="progress-card">
                    <div class="progress-card-header">
                        <div class="progress-card-title-area">
                            <h3 class="progress-card-title">Sebaran Puskesmas per Zonasi</h3>
                            <p class="progress-card-subtitle">{{ $setting->stat_1_num }} Unit Wilayah Kerja Kabupaten</p>
                        </div>
                        <span class="progress-badge">Aktif SIP</span>
                    </div>

                    <div class="progress-list">
                        @if($setting->sebaran_data)
                            @foreach($setting->sebaran_data as $sebaran)
                                <div class="progress-item">
                                    <div class="progress-item-labels">
                                        <span class="progress-item-name">{{ $sebaran['name'] }}</span>
                                        <span class="progress-item-value">{{ $sebaran['value'] }}</span>
                                    </div>
                                    <div class="progress-track-wrapper">
                                        <div class="progress-bar-fill" style="width: {{ $sebaran['width'] }}%;"></div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </main>
</div>
