<link rel="stylesheet" href="{{ asset('css/SatuData/statistik.css') }}?v={{ time() }}">

<div class="satudata-wrapper">
    <!-- Banner Header Top Section -->
    <header class="satudata-banner">
        <div class="satudata-banner-container">
            <h1 class="satudata-banner-title">Satu Data Kesehatan</h1>
            <p class="satudata-banner-subtitle">
                Portal visualisasi statistik stunting, ketersediaan tenaga medis, dan sebaran faskes.
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
                        <div class="stat-card-body-wrap">
                            <div class="stat-card-number">{{ $card['num'] }}</div>
                            <div class="stat-card-icon-wrapper">
                                <span class="material-icons">{{ $cardIcons[$idx] ?? 'indicator' }}</span>
                            </div>
                        </div>
                        <div class="stat-card-caption caption-accent">
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
                        <div class="chart-flex-container">
                             <!-- Y-Axis Static Labels (Left) -->
                            @php
                                $maxRateValue = $stuntingRecords->max('balita_stunting') ?: 1;
                                $yMax = ceil($maxRateValue / 5000) * 5000;
                                if ($yMax < 5000) {
                                    $yMax = 5000;
                                }
                            @endphp
                            <div class="chart-y-axis-labels">
                                <div class="chart-y-axis-labels-item"><span>{{ number_format($yMax) }}</span></div>
                                <div class="chart-y-axis-labels-item"><span>{{ number_format($yMax * 0.75) }}</span></div>
                                <div class="chart-y-axis-labels-item"><span>{{ number_format($yMax * 0.5) }}</span></div>
                                <div class="chart-y-axis-labels-item"><span>{{ number_format($yMax * 0.25) }}</span></div>
                                <div class="chart-y-axis-labels-item"><span>0</span></div>
                            </div>
                            
                            <!-- Scrollable Chart Area (Right) -->
                            <div class="stunting-chart-container">
                                <!-- Y-Axis Grid Lines -->
                                <div class="chart-y-axis-grid">
                                    <div class="grid-line"></div>
                                    <div class="grid-line"></div>
                                    <div class="grid-line"></div>
                                    <div class="grid-line"></div>
                                    <div class="grid-line grid-line-solid"></div>
                                </div>

                                <div class="chart-bars-wrapper" id="chart-bars-wrapper">
                                    @foreach($stuntingRecords as $index => $record)
                                        @php
                                            $heightPercent = $yMax > 0 ? ($record->balita_stunting / $yMax) * 100 : 0;
                                            $prevRecord = $index > 0 ? $stuntingRecords[$index - 1] : null;
                                            $prevStuntingStr = $prevRecord ? $prevRecord->balita_stunting : '';
                                        @endphp
                                        <div class="chart-bar-item {{ $record->is_highlighted ? 'bar-highlighted' : '' }}"
                                             role="button"
                                             tabindex="0"
                                             aria-label="Detail stunting tahun {{ $record->year }}"
                                             data-year="{{ $record->year }}"
                                             data-stunting="{{ $record->balita_stunting ?? '' }}"
                                             data-prev="{{ $prevStuntingStr }}"
                                             onclick="updateStuntingDetail(this)"
                                             onkeydown="if(event.key==='Enter')updateStuntingDetail(this)">
                                            <span class="bar-val {{ $record->is_highlighted ? 'font-bold' : '' }}">{{ number_format($record->balita_stunting) }}</span>
                                            <div class="bar-track">
                                                <div class="bar-fill {{ $record->is_highlighted ? 'bar-fill-active' : '' }}" @style(['height: ' . $heightPercent . '%'])></div>
                                            </div>
                                            <span class="bar-year {{ $record->is_highlighted ? 'bar-year-active' : '' }}">
                                                {{ $record->year }}
                                                @if($record->is_highlighted)
                                                    <span class="bar-year-tag-current">(Saat Ini)</span>
                                                @endif
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        
                        <!-- Click-to-Detail Hint -->
                        <div class="chart-click-hint">
                            <span class="material-icons">touch_app</span>
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

                            <div class="detail-stats-grid">
                                <div class="detail-stat-item">
                                    <span class="detail-stat-label">Jumlah Bayi Stunting</span>
                                    <span id="detail-stunting" class="detail-stat-val detail-stat-val-danger">—</span>
                                </div>
                            </div>
                            
                            <div class="detail-list" style="margin-top: 4px;">
                                <div class="detail-list-row" style="flex-direction: column; align-items: flex-start; gap: 4px; border: none;">
                                    <span class="detail-list-label">Perbandingan Tren</span>
                                    <span id="detail-diff" class="detail-list-val" style="font-size: 13px;">—</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Footer Note -->
                <!-- <div class="chart-footer-note">
                    {!! $setting->stunting_footer_note !!}
                </div>
            </div> -->

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
                const stunting = el.dataset.stunting;
                const prev     = el.dataset.prev;

                const detailCard = document.getElementById('stunting-detail-card');
                detailCard.style.opacity = '0.5';

                setTimeout(() => {
                    document.getElementById('detail-year').textContent = year;
                    document.getElementById('detail-stunting').textContent = stunting ? Number(stunting).toLocaleString('id-ID') + ' Balita' : '—';
                    
                    const diffEl = document.getElementById('detail-diff');
                    
                    if (stunting && prev) {
                        const currentVal = Number(stunting);
                        const prevVal = Number(prev);
                        const diff = currentVal - prevVal;
                        const percent = ((Math.abs(diff) / prevVal) * 100).toFixed(1);
                        
                        if (diff < 0) {
                            diffEl.innerHTML = `<span style="color: #00BC7D; font-weight: 700;">&#9660; Turun ${percent}%</span> dari tahun sebelumnya.`;
                        } else if (diff > 0) {
                            diffEl.innerHTML = `<span style="color: #EF4444; font-weight: 700;">&#9650; Naik ${percent}%</span> dari tahun sebelumnya.`;
                        } else {
                            diffEl.innerHTML = `<span style="color: #64748B; font-weight: 700;">Stabil</span> dari tahun sebelumnya.`;
                        }
                    } else if (stunting && !prev) {
                        diffEl.innerHTML = `<span style="color: #64748B;">Data historis tidak tersedia.</span>`;
                    } else {
                        diffEl.innerHTML = '—';
                    }
                    
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

            <!-- Progress cards deleted -->

        </div>
    </main>
</div>
