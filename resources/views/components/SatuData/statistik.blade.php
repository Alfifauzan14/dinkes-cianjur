<link rel="stylesheet" href="{{ asset('css/SatuData/statistik.css') }}?v={{ time() }}">
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<div class="satudata-wrapper">
    {{-- Banner --}}
    <header class="satudata-banner">
        <div class="satudata-banner-container">
            <h1 class="satudata-banner-title">Satu Data Kesehatan</h1>
            <p class="satudata-banner-subtitle">Portal visualisasi statistik kesehatan Kabupaten Cianjur.</p>
        </div>
    </header>

    <main class="satudata-main">
        <div class="satudata-main-container">

            {{-- Page Header --}}
            <div class="db-page-header">
                <div>
                    <h2 class="db-page-title">Dashboard Kesehatan Kab. Cianjur</h2>
                    <p class="db-page-period">Periode {{ now()->translatedFormat('F Y') }}</p>
                </div>
                @if(!empty($setting->status_badge))
                <span class="db-status-badge">
                    <span class="db-status-dot"></span>{{ $setting->status_badge }}
                </span>
                @endif
            </div>

            {{-- 2-Column Layout --}}
            <div class="db-layout">

                {{-- LEFT: Main Content --}}
                <div class="db-main">

                    {{-- 4 Stat Cards --}}
                    <div class="db-stats-grid">
                        <div class="db-stat-card db-stat-blue">
                            <div class="db-stat-label">Total Kunjungan Pasien</div>
                            <div class="db-stat-number">51.107</div>
                            <div class="db-stat-change down">▼ 6,98% dari bulan sebelumnya</div>
                        </div>

                        <div class="db-stat-card">
                            <div class="db-stat-label">No. 1 Penyakit Terbanyak</div>
                            <div class="db-stat-disease">(I10) - Essential (primary) hypertension</div>
                            <div class="db-stat-cases">3.594 Kasus</div>
                        </div>
                        <div class="db-stat-card">
                            <div class="db-stat-label">Status Kunjungan</div>
                            <div class="db-kunjungan-row">
                                <div>
                                    <div class="db-kunj-num green">47.002</div>
                                    <div class="db-kunj-label">Selesai</div>
                                </div>
                                <div>
                                    <div class="db-kunj-num red">4.105</div>
                                    <div class="db-kunj-label">Dalam berobat</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 10 Penyakit Terbanyak --}}
                    <div class="db-chart-card">
                        <h3 class="db-chart-title">10 Penyakit Terbanyak</h3>
                        <canvas id="penyakitChart" height="90"></canvas>
                    </div>



                    {{-- 10 Pekerjaan --}}
                    <div class="db-chart-card">
                        <h3 class="db-chart-title">10 Pekerjaan Pasien Terbanyak</h3>
                        <canvas id="pekerjaanChart" height="180"></canvas>
                    </div>

                </div>

                {{-- RIGHT: Sidebar --}}
                <div class="db-sidebar">



                    {{-- Satusehat --}}
                    <div class="dbs-card">
                        <div class="dbs-sublabel">Total Kunjungan Satusehat</div>
                        <div class="dbs-satusehat-num">34.989</div>
                        <div class="dbs-sublabel" style="margin-top:2px;">Kunjungan</div>
                        <hr style="margin:14px 0; border-color:#E2E8F0;">
                        <div class="dbs-sublabel">Pasien Terdaftar Satusehat</div>
                        <div class="dbs-terdaftar-row">
                            <span class="dbs-tf-green">7.416</span>
                            <span class="dbs-tf-red">3.964</span>
                        </div>
                        <div class="dbs-tf-labels">
                            <span>Terdaftar</span><span>Tidak terdaftar</span>
                        </div>
                    </div>

                    {{-- Pie Laki-laki --}}
                    <div class="dbs-card">
                        <div class="dbs-card-title-sm">Status Pasien Laki-laki</div>
                        <canvas id="pieLaki" height="180"></canvas>
                        <div class="dbs-legend">
                            <div><span class="dbs-dot" style="background:#004F3B;"></span> Umum: 344.202 pasien (47%)</div>
                            <div><span class="dbs-dot" style="background:#009966;"></span> BPJS: 385.682 pasien (53%)</div>
                            <div><span class="dbs-dot" style="background:#A7F3D0;"></span> PKG: 11 pasien (0%)</div>
                        </div>
                    </div>

                    {{-- Pie Perempuan --}}
                    <div class="dbs-card">
                        <div class="dbs-card-title-sm">Status Pasien Perempuan</div>
                        <canvas id="piePerempuan" height="180"></canvas>
                        <div class="dbs-legend">
                            <div><span class="dbs-dot" style="background:#004F3B;"></span> Umum: 258.455 pasien (48%)</div>
                            <div><span class="dbs-dot" style="background:#009966;"></span> BPJS: 281.438 pasien (52%)</div>
                            <div><span class="dbs-dot" style="background:#A7F3D0;"></span> PKG: 6 pasien (0%)</div>
                        </div>
                    </div>



                </div>
            </div>

            <div class="db-footnote">
                <span class="material-icons" style="font-size:14px;vertical-align:middle;">info</span>
                Data visualisasi bersumber dari sistem informasi Puskesmas terintegrasi. Diperbarui setiap bulan.
            </div>

        </div>
    </main>
</div>

<script>
Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
Chart.defaults.font.size   = 11;

// ── 1. Penyakit Terbanyak ────────────────────────────────────────
new Chart(document.getElementById('penyakitChart'), {
    type: 'bar',
    data: {
        labels: ['I10\nHipertensi','J00\nISPA','K30\nDispepsia','M79\nNyeri','J06\nRinitis','E11\nDiabetes','L23\nDermatitis','K29\nGastritis','A09\nDiare','J18\nPneumonia'],
        datasets: [{ data:[3594,2901,2756,2100,1843,1650,1420,1310,1201,980], backgroundColor:'#009966', borderRadius:3, barPercentage:0.6 }]
    },
    options:{ responsive:true, plugins:{legend:{display:false}},
        scales:{ y:{beginAtZero:true,grid:{color:'#F1F5F9'},ticks:{color:'#64748B'}},
                 x:{grid:{display:false},ticks:{color:'#64748B',maxRotation:0}} } }
});


// ── 4. Pekerjaan Terbanyak (Horizontal) ────────────────────────
const pkjLabels = ['IBU RUMAH TANGGA','BELUM/TIDAK BEKERJA','PELAJAR/MAHASISWA','LAIN-LAIN','WIRASWASTA','MENGURUS RUMAH TANGGA','KARYAWAN SWASTA','BURUH HARIAN LEPAS','PETANI/PEKEBUN','BELUM BEKERJA'];
const pkjData   = [262595,219766,165909,127809,69007,63163,55427,47850,20008,19354];
new Chart(document.getElementById('pekerjaanChart'), {
    type: 'bar',
    data:{ labels:pkjLabels, datasets:[{ data:pkjData, backgroundColor:'#009966', borderRadius:3, barPercentage:0.5 }] },
    options:{ indexAxis:'y', responsive:true, plugins:{legend:{display:false}},
        scales:{ x:{beginAtZero:true,grid:{color:'#F1F5F9'},ticks:{color:'#64748B'}},
                 y:{grid:{display:false},ticks:{color:'#475569',font:{size:10}}} } }
});

// ── 5 & 6. Pie Charts ──────────────────────────────────────────
const pieOpts = {
    responsive:true,
    plugins:{
        legend:{display:false},
        tooltip:{ callbacks:{ label: ctx => ' '+ctx.label+': '+ctx.parsed.toFixed(0)+'%' }}
    }
};
const pieColors = ['#004F3B','#009966','#A7F3D0','#E6F7F0'];

new Chart(document.getElementById('pieLaki'),{
    type:'doughnut',
    data:{ labels:['Umum','BPJS','PKG','Lainnya'], datasets:[{ data:[47,53,0,0], backgroundColor:pieColors, borderWidth:0 }] },
    options: pieOpts
});
new Chart(document.getElementById('piePerempuan'),{
    type:'doughnut',
    data:{ labels:['Umum','BPJS','PKG','Lainnya'], datasets:[{ data:[48,52,0,0], backgroundColor:pieColors, borderWidth:0 }] },
    options: pieOpts
});
</script>
