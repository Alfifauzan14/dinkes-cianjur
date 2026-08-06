<link rel="stylesheet" href="{{ asset('css/SatuData/statistik.css') }}?v={{ time() }}">

<div class="satudata-wrapper">
    @php
        $headerSetting = \App\Models\HeaderSetting::getByKey('statistik', 'Satu Data Kesehatan', 'Portal visualisasi statistik stunting, ketersediaan tenaga medis, dan sebaran faskes.');
    @endphp
    <!-- Banner Header Top Section -->
    <header class="satudata-banner">
        <div class="satudata-banner-container">
            <h1 class="satudata-banner-title">{{ $headerSetting->title }}</h1>
            <p class="satudata-banner-subtitle">
                {{ $headerSetting->subtitle }}
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
                @php
                    $cardIcons = ['local_hospital', 'corporate_fare', 'people', 'vaccines', 'medical_services', 'healing', 'monitor_health', 'biotech'];
                @endphp
                @foreach($setting->indikator_data ?? [] as $idx => $card)
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <span class="stat-card-label">{{ $card['name'] }}</span>
                        </div>
                        <div class="stat-card-body-wrap" style="display: flex; justify-content: space-between; align-items: center; margin-top: 12px;">
                            <div class="stat-card-number" style="margin: 0;">{{ $card['num'] }}</div>
                            <div class="stat-card-icon-wrapper" style="color: #009966; background-color: #E6F7F0; width: 44px; height: 44px; border-radius: 3px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <span class="material-icons" style="font-size: 22px;">{{ $cardIcons[$idx] ?? 'indicator' }}</span>
                            </div>
                        </div>
                        <div class="stat-card-caption caption-accent" style="margin-top: 8px;">
                            <svg class="caption-icon" viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            <span>{{ $card['caption'] }}</span>
                        </div>
                    </div>
                @endforeach
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

                <!-- Year Range Filter Tabs -->
                @php
                    $allYears = $stuntingRecords->pluck('year')->sort()->values();
                    $minYear = $allYears->first();
                    $maxYear = $allYears->last();
                    $activeFilter = request('range', 'all');
                @endphp
                <div class="chart-filter-tabs" style="display: flex; gap: 0; border-bottom: 2px solid #E2E8F0; margin-bottom: 20px;">
                    <button type="button" class="chart-filter-tab {{ $activeFilter === 'all' ? 'active' : '' }}" data-range="all" onclick="filterByRange('all', this)">
                        Semua ({{ $minYear }}–{{ $maxYear }})
                    </button>
                    <button type="button" class="chart-filter-tab {{ $activeFilter === '3' ? 'active' : '' }}" data-range="3" onclick="filterByRange('3', this)">
                        3 Tahun Terakhir
                    </button>
                    <button type="button" class="chart-filter-tab {{ $activeFilter === '5' ? 'active' : '' }}" data-range="5" onclick="filterByRange('5', this)">
                        5 Tahun Terakhir
                    </button>
                </div>

                <!-- Split Dashboard Grid Layout -->
                <div class="stunting-dashboard-grid">
                    <!-- Left Column: Visual Chart -->
                    <div class="stunting-chart-column">
                        <div class="chart-flex-container" style="display: flex; position: relative; align-items: flex-start; gap: 12px; margin-top: 12px;">
                             <!-- Y-Axis Static Labels (Left) -->
                            @php
                                $maxRateValue = $stuntingRecords->max('rate') ?: 1;
                                $yMax = ceil($maxRateValue / 5) * 5;
                                if ($yMax < 10) {
                                    $yMax = 10;
                                }
                            @endphp
                            <div class="chart-y-axis-labels" style="display: flex; flex-direction: column; justify-content: space-between; height: 220px; margin-top: 10px; width: 32px; font-size: 11px; color: #94A3B8; font-weight: 700; text-align: right; flex-shrink: 0; position: relative; z-index: 10; font-family: 'Plus Jakarta Sans', sans-serif;">
                                <div style="height: 0; display: flex; align-items: center; justify-content: flex-end; overflow: visible;"><span>{{ $yMax }}%</span></div>
                                <div style="height: 0; display: flex; align-items: center; justify-content: flex-end; overflow: visible;"><span>{{ $yMax * 0.75 }}%</span></div>
                                <div style="height: 0; display: flex; align-items: center; justify-content: flex-end; overflow: visible;"><span>{{ $yMax * 0.5 }}%</span></div>
                                <div style="height: 0; display: flex; align-items: center; justify-content: flex-end; overflow: visible;"><span>{{ $yMax * 0.25 }}%</span></div>
                                <div style="height: 0; display: flex; align-items: center; justify-content: flex-end; overflow: visible;"><span>0%</span></div>
                            </div>
                            
                            <!-- Scrollable Chart Area (Right) -->
                            <div class="stunting-chart-container" style="flex-grow: 1; overflow-x: auto; position: relative; padding-left: 0; margin-top: 0;">
                                <!-- Y-Axis Grid Lines -->
                                <div class="chart-y-axis-grid" style="position: absolute; top: 10px; left: 0; right: 0; height: 220px; display: flex; flex-direction: column; justify-content: space-between; pointer-events: none; z-index: 1;">
                                    <div class="grid-line" style="width: 100%; border-top: 1px dashed #E2E8F0; position: relative;"></div>
                                    <div class="grid-line" style="width: 100%; border-top: 1px dashed #E2E8F0; position: relative;"></div>
                                    <div class="grid-line" style="width: 100%; border-top: 1px dashed #E2E8F0; position: relative;"></div>
                                    <div class="grid-line" style="width: 100%; border-top: 1px dashed #E2E8F0; position: relative;"></div>
                                    <div class="grid-line" style="width: 100%; border-top: 1px solid #CBD5E1; position: relative;"></div>
                                </div>

                                <div class="chart-bars-wrapper" id="chart-bars-wrapper" style="position: relative; z-index: 2; height: 260px; border-bottom: 1px solid #E2E8F0; padding-bottom: 14px; margin-bottom: 0;">
                                    @foreach($stuntingRecords as $record)
                                        @php
                                            $heightPercent = $yMax > 0 ? ($record->rate / $yMax) * 100 : 0;
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
                                             onclick="updateStuntingDetail(this)"
                                             onkeydown="if(event.key==='Enter')updateStuntingDetail(this)">
                                            <span class="bar-val {{ $record->is_highlighted ? 'font-bold' : '' }}">{{ $record->rate }}%</span>
                                            <div class="bar-track">
                                                <div class="bar-fill {{ $record->is_highlighted ? 'bar-fill-active' : '' }}" @style(['height: ' . $heightPercent . '%'])></div>
                                            </div>
                                            <span class="bar-year {{ $record->is_highlighted ? 'bar-year-active' : '' }}">
                                                {{ $record->year }}
                                                @if($record->is_highlighted)
                                                    <span class="bar-year-tag" style="display: block; font-size: 10px; font-weight: 700;">(Saat Ini)</span>
                                                @endif
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        
                        <!-- Click-to-Detail Hint -->
                        <div class="chart-click-hint" style="margin-top: 16px; font-size: 13px; color: #64748B; display: flex; align-items: center; gap: 6px; padding-left: 44px;">
                            <span class="material-icons" style="font-size: 16px; color: #009966;">touch_app</span>
                            <span>Arahkan kursor atau klik batang grafik untuk melihat rincian data tahunan di panel samping.</span>
                        </div>
                    </div>

                    <!-- Right Column: Interactive Details Panel -->
                    <div class="stunting-detail-column">
                        <div id="stunting-detail-card" class="stunting-detail-card">
                            <div class="detail-card-header">
                                <h4 class="detail-card-title">Rincian Indikator Stunting</h4>
                                <span id="detail-year" class="detail-year-badge">2026</span>
                            </div>

                            <div class="detail-rate-box">
                                <span class="detail-rate-label">PREVALENSI STUNTING</span>
                                <span id="detail-rate" class="detail-rate-val">9.8%</span>
                            </div>

                            <div class="detail-stats-grid">
                                <div class="detail-stat-item">
                                    <span class="detail-stat-label">Total Balita Diukur</span>
                                    <span id="detail-total" class="detail-stat-val">—</span>
                                </div>
                                <div class="detail-stat-item">
                                    <span class="detail-stat-label">Kondisi Stunting</span>
                                    <span id="detail-stunting" class="detail-stat-val" style="color: #DC2626;">—</span>
                                </div>
                            </div>

                            <div class="detail-list">
                                <div class="detail-list-row">
                                    <span class="detail-list-label">Prevalensi Terendah</span>
                                    <span id="detail-terendah" class="detail-list-val">—</span>
                                </div>
                                <div class="detail-list-row">
                                    <span class="detail-list-label">Prevalensi Tertinggi</span>
                                    <span id="detail-tertinggi" class="detail-list-val">—</span>
                                </div>
                            </div>

                            <div class="detail-note-box">
                                <div style="display: flex; gap: 6px; align-items: flex-start;">
                                    <span class="material-icons" style="font-size: 16px; color: #009966; margin-top: 2px;">info</span>
                                    <span id="detail-catatan">—</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Note -->
                <div class="chart-footer-note" style="margin-top: 24px; padding-top: 16px; border-top: 1px solid #F1F5F9;">
                    {!! $setting->stunting_footer_note !!}
                </div>
            </div>

            <script>
            function filterByRange(range, btn) {
                // Update active tab
                document.querySelectorAll('.chart-filter-tab').forEach(t => t.classList.remove('active'));
                btn.classList.add('active');

                const bars = document.querySelectorAll('.chart-bar-item');
                const allYears = Array.from(bars).map(b => parseInt(b.dataset.year));
                const maxYear = Math.max(...allYears);
                let minShow;

                if (range === 'all') {
                    minShow = Math.min(...allYears);
                } else {
                    minShow = maxYear - parseInt(range) + 1;
                }

                bars.forEach(bar => {
                    const year = parseInt(bar.dataset.year);
                    bar.style.display = year >= minShow ? '' : 'none';
                });

                // Re-select first visible bar
                const firstVisible = document.querySelector('.chart-bar-item:not([style*="display: none"])');
                if (firstVisible) {
                    updateStuntingDetail(firstVisible);
                }
            }

            function updateStuntingDetail(el) {
                document.querySelectorAll('.chart-bar-item').forEach(b => {
                    b.classList.remove('bar-active-selected');
                });
                
                el.classList.add('bar-active-selected');

                const year     = el.dataset.year;
                const rate     = el.dataset.rate;
                const total    = el.dataset.total;
                const stunting = el.dataset.stunting;
                const terendah = el.dataset.terendah;
                const tertinggi= el.dataset.tertinggi;
                const catatan  = el.dataset.catatan;

                const detailCard = document.getElementById('stunting-detail-card');
                detailCard.style.opacity = '0.5';

                setTimeout(() => {
                    document.getElementById('detail-year').textContent = year;
                    document.getElementById('detail-rate').textContent = rate + '%';
                    
                    document.getElementById('detail-total').textContent = total ? Number(total).toLocaleString('id-ID') : '—';
                    document.getElementById('detail-stunting').textContent = stunting ? Number(stunting).toLocaleString('id-ID') + ' Balita' : '—';
                    document.getElementById('detail-terendah').textContent = terendah || '—';
                    document.getElementById('detail-tertinggi').textContent = tertinggi || '—';
                    document.getElementById('detail-catatan').textContent = catatan || 'Tidak ada catatan tambahan untuk tahun ini.';
                    
                    detailCard.style.opacity = '1';
                }, 120);
            }

            document.addEventListener('DOMContentLoaded', () => {
                const highlightedBar = document.querySelector('.chart-bar-item.bar-highlighted');
                if (highlightedBar) {
                    updateStuntingDetail(highlightedBar);
                } else {
                    const firstBar = document.querySelector('.chart-bar-item');
                    if (firstBar) {
                        updateStuntingDetail(firstBar);
                    }
                }
            });
            </script>

            <!-- Two Side-by-Side Progress Cards -->
            <div class="progress-cards-grid">
                
                <!-- Card A: Distribusi Profesi Nakes -->
                <div class="progress-card">
                    <div class="progress-card-header">
                        <div class="progress-card-title-area">
                            @php
                                $nakesTotal = 0;
                                foreach ($setting->nakes_data ?? [] as $n) {
                                    $cleaned = preg_replace('/[^0-9]/', '', strtok($n['value'] ?? '0', ' '));
                                    $nakesTotal += (int) $cleaned;
                                }
                            @endphp
                            <h3 class="progress-card-title">Distribusi Profesi Nakes ({{ number_format($nakesTotal, 0, ',', '.') }})</h3>
                            <p class="progress-card-subtitle">Terdaftar pada Portal E-SIP Dinkes</p>
                        </div>
                        <span class="progress-badge">Aktif SIP</span>
                    </div>
                    
                    <div class="progress-list">
                        @if($setting->nakes_data)
                            @foreach($setting->nakes_data as $nakes)
                                @php
                                    $nWidth = $nakesTotal > 0
                                        ? round(((int) ($nakes['value'] ?? 0) / $nakesTotal) * 100)
                                        : 0;
                                @endphp
                                <div class="progress-item">
                                    <div class="progress-item-labels">
                                        <span class="progress-item-name">{{ $nakes['name'] }}</span>
                                        <span class="progress-item-value">{{ number_format((int) ($nakes['value'] ?? 0), 0, ',', '.') }}</span>
                                    </div>
                                    <div class="progress-track-wrapper">
                                        <div class="progress-bar-fill" @style(['width: ' . $nWidth . '%'])></div>
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
                            @php
                                $sebaranTotal = 0;
                                foreach ($setting->sebaran_data ?? [] as $s) {
                                    $sebaranTotal += (int) ($s['value'] ?? 0);
                                }
                            @endphp
                            <h3 class="progress-card-title">Sebaran Puskesmas per Zonasi</h3>
                            <p class="progress-card-subtitle">{{ number_format($sebaranTotal, 0, ',', '.') }} Unit Wilayah Kerja Kabupaten</p>
                        </div>
                        <span class="progress-badge">Aktif SIP</span>
                    </div>

                    <div class="progress-list">
                        @if($setting->sebaran_data)
                            @foreach($setting->sebaran_data as $sebaran)
                                @php
                                    $sWidth = $sebaranTotal > 0
                                        ? round(((int) ($sebaran['value'] ?? 0) / $sebaranTotal) * 100)
                                        : 0;
                                @endphp
                                <div class="progress-item">
                                    <div class="progress-item-labels">
                                        <span class="progress-item-name">{{ $sebaran['name'] }}</span>
                                        <span class="progress-item-value">{{ number_format((int) ($sebaran['value'] ?? 0), 0, ',', '.') }} Puskesmas</span>
                                    </div>
                                    <div class="progress-track-wrapper">
                                        <div class="progress-bar-fill" @style(['width: ' . $sWidth . '%'])></div>
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
