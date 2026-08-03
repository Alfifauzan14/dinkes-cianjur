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
                            <div class="chart-bar-item {{ $record->is_highlighted ? 'bar-highlighted' : '' }}">
                                <span class="bar-val {{ $record->is_highlighted ? 'font-bold' : '' }}">{{ $record->rate }}%</span>
                                <div class="bar-track">
                                    <div class="bar-fill {{ $record->is_highlighted ? 'bar-fill-active' : '' }}" style="height: {{ $heightPercent }}%;"></div>
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
            </div>

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
