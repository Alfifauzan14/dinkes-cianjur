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
                @if(!empty($setting->status_badge))
                    <div class="satudata-status-badge" style="border-radius: 3px !important; background: #E6F7F0; color: #009966; border: 1.5px solid #009966; padding: 4px 12px; display: inline-flex; align-items: center; gap: 6px;">
                        <span class="status-dot" style="width: 8px; height: 8px; border-radius: 50%; background-color: #009966; display: inline-block;"></span>
                        <span class="status-text" style="font-size: 12px; font-weight: 700; color: #009966;">{{ $setting->status_badge }}</span>
                    </div>
                @endif
            </div>

            <!-- 4 Stat Cards Row -->
            <div class="stat-cards-grid">
                <!-- Card 1: Puskesmas -->
                <div class="stat-card">
                    <div class="stat-card-header">
                        <span class="stat-card-label">PUSKESMAS</span>
                    </div>
                    <div class="stat-card-body-wrap">
                        <div class="stat-card-number">{{ $puskesmasCount ?? 0 }}</div>
                        <div class="stat-card-icon-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                <line x1="12" y1="8" x2="12" y2="16"/>
                                <line x1="8" y1="12" x2="16" y2="12"/>
                            </svg>
                        </div>
                    </div>
                    <div class="stat-card-caption caption-accent">
                        <svg class="caption-icon" viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        <span>Tersebar di seluruh wilayah Cianjur</span>
                    </div>
                </div>

                <!-- Card 2: Rumah Sakit -->
                <div class="stat-card">
                    <div class="stat-card-header">
                        <span class="stat-card-label">RUMAH SAKIT</span>
                    </div>
                    <div class="stat-card-body-wrap">
                        <div class="stat-card-number">{{ $rsCount ?? 0 }}</div>
                        <div class="stat-card-icon-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 21V9a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v12"/>
                                <path d="M2 21h20"/>
                                <path d="M10 12h4"/>
                                <path d="M12 10v4"/>
                            </svg>
                        </div>
                    </div>
                    <div class="stat-card-caption caption-accent">
                        <svg class="caption-icon" viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        <span>Fasilitas rujukan kesehatan utama</span>
                    </div>
                </div>

                <!-- Card 3: Wilayah Binaan -->
                <div class="stat-card">
                    <div class="stat-card-header">
                        <span class="stat-card-label">WILAYAH BINAAN</span>
                    </div>
                    <div class="stat-card-body-wrap">
                        <div class="stat-card-number">{{ $kecamatanCount ?? 0 }}</div>
                        <div class="stat-card-icon-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/>
                                <polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"/>
                            </svg>
                        </div>
                    </div>
                    <div class="stat-card-caption caption-accent">
                        <svg class="caption-icon" viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        <span>Kecamatan di Kabupaten Cianjur</span>
                    </div>
                </div>

                <!-- Card 4: Layanan Publik -->
                <div class="stat-card">
                    <div class="stat-card-header">
                        <span class="stat-card-label">LAYANAN PUBLIK</span>
                    </div>
                    <div class="stat-card-body-wrap">
                        <div class="stat-card-number">{{ $layananCount ?? 0 }}</div>
                        <div class="stat-card-icon-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                <polyline points="14 2 14 8 20 8"/>
                                <line x1="16" y1="13" x2="8" y2="13"/>
                                <line x1="16" y1="17" x2="8" y2="17"/>
                            </svg>
                        </div>
                    </div>
                    <div class="stat-card-caption caption-accent">
                        <svg class="caption-icon" viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        <span>Jenis layanan terpadu Dinas Kesehatan</span>
                    </div>
                </div>
            </div>

            <!-- Chart Card: Sebaran Fasilitas Pelayanan Kesehatan -->
            <div class="chart-card" style="border-radius: 1px !important;">
                <div class="chart-header">
                    <div class="chart-header-left">
                        <h3 class="chart-title" style="color: #004F3B;">{{ $setting->stunting_title }}</h3>
                        <p class="chart-subtitle" style="color: #64748B;">{{ $setting->stunting_subtitle }}</p>
                    </div>
                    <div class="chart-header-right">
                        <span class="trend-badge" style="border-radius: 3px !important; background: #E6F7F0; color: #009966; border: 1.5px solid #009966;">Update Otomatis</span>
                    </div>
                </div>

                <!-- Split Dashboard Grid Layout -->
                <div class="stunting-dashboard-grid">
                    <!-- Left Column: Visual Chart -->
                    <div class="stunting-chart-column">
                        <div class="chart-flex-container">
                             <!-- Y-Axis Static Labels (Left) -->
                             @php
                                 $yMax = $maxFaskesCount;
                             @endphp
                             <div class="chart-y-axis-labels">
                                 <div class="chart-y-axis-labels-item"><span>{{ $yMax }} Unit</span></div>
                                 <div class="chart-y-axis-labels-item"><span>{{ ceil($yMax * 0.8) }}</span></div>
                                 <div class="chart-y-axis-labels-item"><span>{{ ceil($yMax * 0.6) }}</span></div>
                                 <div class="chart-y-axis-labels-item"><span>{{ ceil($yMax * 0.4) }}</span></div>
                                 <div class="chart-y-axis-labels-item"><span>{{ ceil($yMax * 0.2) }}</span></div>
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
                                     <div class="grid-line"></div>
                                     <div class="grid-line grid-line-solid"></div>
                                 </div>

                                 <div class="chart-bars-wrapper" id="chart-bars-wrapper">
                                     @foreach($faskesDistribution as $index => $record)
                                         @php
                                             $heightPercent = $maxFaskesCount > 0 ? ($record->total / $maxFaskesCount) * 100 : 0;
                                         @endphp
                                         <div class="chart-bar-item {{ $index === 0 ? 'bar-highlighted' : '' }}"
                                              role="button"
                                              tabindex="0"
                                              aria-label="Detail faskes kecamatan {{ $record->kecamatan }}"
                                              data-kecamatan="{{ $record->kecamatan }}"
                                              data-total="{{ $record->total }}"
                                              data-puskesmas="{{ $record->puskesmas }}"
                                              data-rs="{{ $record->rs }}"
                                              data-list="{{ $record->list ?: 'Belum ada faskes ditambahkan.' }}"
                                              onclick="updateFaskesDetail(this)"
                                              onkeydown="if(event.key==='Enter')updateFaskesDetail(this)">
                                             <span class="bar-val {{ $index === 0 ? 'font-bold' : '' }}" style="border-radius: 3px !important;">{{ $record->total }}</span>
                                             <div class="bar-track" style="border-radius: 3px 3px 0 0 !important;">
                                                 <div class="bar-fill {{ $index === 0 ? 'bar-fill-active' : '' }}" @style(['height: ' . $heightPercent . '%']) style="border-radius: 3px 3px 0 0 !important;"></div>
                                             </div>
                                             <span class="bar-year {{ $index === 0 ? 'bar-year-active' : '' }}" style="font-size: 11.5px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 80px;" title="{{ $record->kecamatan }}">
                                                 {{ $record->kecamatan }}
                                             </span>
                                         </div>
                                     @endforeach
                                 </div>
                             </div>
                        </div>
                        
                        <!-- Click-to-Detail Hint -->
                        <div class="chart-click-hint">
                            <span class="material-icons">touch_app</span>
                            <span>Arahkan kursor atau klik batang kecamatan untuk melihat daftar faskes di panel samping.</span>
                        </div>
                    </div>

                    <!-- Right Column: Interactive Details Panel -->
                    <div class="stunting-detail-column">
                        <div id="stunting-detail-card" class="stunting-detail-card" style="border-radius: 1px !important;">
                            <div class="detail-card-header">
                                <h4 class="detail-card-title" id="detail-kecamatan">Kecamatan</h4>
                                <span id="detail-total" class="detail-year-badge" style="border-radius: 3px !important;">—</span>
                            </div>

                            <div class="detail-stats-grid">
                                <div class="detail-stat-item" style="border-radius: 3px !important;">
                                    <span class="detail-stat-label">Puskesmas</span>
                                    <span id="detail-puskesmas" class="detail-stat-val" style="color: #004F3B;">—</span>
                                </div>
                                <div class="detail-stat-item" style="border-radius: 3px !important;">
                                    <span class="detail-stat-label">Rumah Sakit</span>
                                    <span id="detail-rs" class="detail-stat-val" style="color: #009966;">—</span>
                                </div>
                            </div>
                            
                            <div class="detail-list" style="margin-top: 4px; border: 1px solid #E2E8F0; border-radius: 3px !important; padding: 12px; max-height: 200px; overflow-y: auto; background: #FFFFFF; display: flex; flex-direction: column; gap: 8px;">
                                <span class="detail-stat-label" style="margin-bottom: 0;">Daftar Fasilitas Kesehatan:</span>
                                <div id="detail-faskes-list" style="font-size: 13px; color: #475569; line-height: 1.5;">
                                    —
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <script>
            function updateFaskesDetail(el) {
                document.querySelectorAll('.chart-bar-item').forEach(b => {
                    b.classList.remove('bar-active-selected');
                });
                
                el.classList.add('bar-active-selected');

                const kecamatan = el.dataset.kecamatan;
                const total     = el.dataset.total;
                const puskesmas = el.dataset.puskesmas;
                const rs        = el.dataset.rs;
                const list      = el.dataset.list;

                const detailCard = document.getElementById('stunting-detail-card');
                detailCard.style.opacity = '0.5';

                setTimeout(() => {
                    document.getElementById('detail-kecamatan').textContent = kecamatan;
                    document.getElementById('detail-total').textContent = total + ' Faskes';
                    document.getElementById('detail-puskesmas').textContent = puskesmas + ' Unit';
                    document.getElementById('detail-rs').textContent = rs + ' Unit';
                    
                    const listContainer = document.getElementById('detail-faskes-list');
                    listContainer.innerHTML = '';
                    
                    if (list && list !== 'Belum ada faskes ditambahkan.') {
                        const items = list.split(', ');
                        const ul = document.createElement('ul');
                        ul.style.margin = '0';
                        ul.style.paddingLeft = '16px';
                        ul.style.fontSize = '13px';
                        ul.style.color = '#475569';
                        ul.style.lineHeight = '1.6';
                        items.forEach(item => {
                            const li = document.createElement('li');
                            li.textContent = item;
                            ul.appendChild(li);
                        });
                        listContainer.appendChild(ul);
                    } else {
                        listContainer.textContent = 'Tidak ada faskes di kecamatan ini.';
                    }
                    
                    detailCard.style.opacity = '1';
                }, 120);
            }

            document.addEventListener('DOMContentLoaded', () => {
                const firstBar = document.querySelector('.chart-bar-item');
                if (firstBar) {
                    updateFaskesDetail(firstBar);
                }
            });
            </script>

            <!-- Progress cards deleted -->

        </div>
    </main>
</div>
