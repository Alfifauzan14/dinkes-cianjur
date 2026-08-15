<link rel="stylesheet" href="{{ asset('css/SatuData/statistik.css') }}?v={{ time() }}">
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

@php
    // ── Walagri: Kunjungan Pasien ─────────────────────────────────
    $visits       = $walagri['visits']['data'] ?? [];
    $totalVisits  = $visits['total_visits']['count'] ?? null;
    $visitTrend   = $visits['total_visits']['difference'] ?? null;
    $visitDir     = $visits['total_visits']['trend'] ?? 'same';
    $served       = $visits['patient_served_status']['served'] ?? null;
    $unserved     = $visits['patient_served_status']['unserved'] ?? null;

    // ── Walagri: 10 Penyakit Terbanyak ───────────────────────────
    $diseasesData  = $walagri['diseases']['data'] ?? [];
    $diseaseLabels = $diseasesData['categories'] ?? [];
    $diseaseCols   = $diseasesData['columns'] ?? [];
    // Gabung male+female per penyakit
    $diseaseMale   = collect($diseaseCols)->firstWhere(0, 'male') ?? [];
    $diseaseFemale = collect($diseaseCols)->firstWhere(0, 'female') ?? [];
    $diseaseMaleVals   = array_slice($diseaseMale, 1);
    $diseaseFemaleVals = array_slice($diseaseFemale, 1);
    // Penyakit #1
    $topDiseaseName = $diseaseLabels[0] ?? null;
    $topDiseaseCountMale   = $diseaseMaleVals[0] ?? 0;
    $topDiseaseCountFemale = $diseaseFemaleVals[0] ?? 0;
    $topDiseaseTotal = $topDiseaseCountMale + $topDiseaseCountFemale;

    $topDiseaseIcd  = null;
    $topDiseaseDesc = $topDiseaseName;
    if ($topDiseaseName && str_contains($topDiseaseName, ' - ')) {
        $parts = explode(' - ', $topDiseaseName, 2);
        $topDiseaseIcd  = trim($parts[0]);
        $topDiseaseDesc = trim($parts[1]);
    }

    // ── Walagri: Status Pasien ────────────────────────────────────
    $maleStatusRaw   = $walagri['statusMale']['data']['male'] ?? [];
    $femaleStatusRaw = $walagri['statusFemale']['data']['female'] ?? [];

    $pieColors    = ['#004F3B', '#009966', '#34D399', '#A7F3D0', '#94A3B8', '#CBD5E1'];

    $maleStatus = collect($maleStatusRaw)->values()->map(function ($item, $index) use ($pieColors) {
        $item['color'] = $pieColors[$index] ?? '#64748B';
        return $item;
    })->toArray();

    $femaleStatus = collect($femaleStatusRaw)->values()->map(function ($item, $index) use ($pieColors) {
        $item['color'] = $pieColors[$index] ?? '#64748B';
        return $item;
    })->toArray();

    // ── Walagri: Pekerjaan ────────────────────────────────────────
    $profData   = $walagri['professions']['data'] ?? [];
    $profLabels = $profData['labels'] ?? [];
    $profValues = $profData['values'] ?? [];

    // ── Pie chart data (PHP arrays, dipakai di @json()) ───────────
    $maleLabels   = collect($maleStatus)->pluck('label')->toArray();
    $maleVals     = collect($maleStatus)->map(fn($i) => collect($i['data'])->sum(fn($d) => $d[1] ?? 0))->toArray();
    $femaleLabels = collect($femaleStatus)->pluck('label')->toArray();
    $femaleVals   = collect($femaleStatus)->map(fn($i) => collect($i['data'])->sum(fn($d) => $d[1] ?? 0))->toArray();
    $maleColors   = collect($maleStatus)->pluck('color')->filter()->values()->toArray();
    $femaleColors = collect($femaleStatus)->pluck('color')->filter()->values()->toArray();
@endphp

<div class="satudata-wrapper" id="statistik-data"
     data-disease-labels="{{ json_encode($diseaseLabels) }}"
     data-disease-male-vals="{{ json_encode($diseaseMaleVals) }}"
     data-disease-female-vals="{{ json_encode($diseaseFemaleVals) }}"
     data-prof-labels="{{ json_encode($profLabels) }}"
     data-prof-values="{{ json_encode($profValues) }}"
     data-male-labels="{{ json_encode($maleLabels) }}"
     data-male-vals="{{ json_encode($maleVals) }}"
     data-male-colors="{{ json_encode($maleColors ?: $pieColors) }}"
     data-female-labels="{{ json_encode($femaleLabels) }}"
     data-female-vals="{{ json_encode($femaleVals) }}"
     data-female-colors="{{ json_encode($femaleColors ?: $pieColors) }}">
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
                    <p class="db-page-period">Periode: {{ \Carbon\Carbon::parse($startDate)->translatedFormat('F Y') }}</p>
                </div>
                {{-- Filter Bulan --}}
                <form method="GET" action="{{ route('satudata.statistik') }}" class="db-month-filter">
                    <label for="bulan" class="db-filter-label">Filter Bulan</label>
                    <input type="month" id="bulan" name="bulan"
                           value="{{ $selectedMonth->format('Y-m') }}"
                           max="{{ now()->format('Y-m') }}"
                           min="2024-01"
                           class="db-month-input">
                    <button type="submit" class="db-filter-btn">Tampilkan</button>
                </form>
            </div>

            {{-- 2-Column Layout --}}
            <div class="db-layout">

                {{-- LEFT: Main Content --}}
                <div class="db-main">

                    {{-- 4 Stat Cards --}}
                    <div class="db-stats-grid">
                        <div class="db-stat-card db-stat-blue">
                            <div class="db-stat-header">
                                <div class="db-stat-label">Total Kunjungan Pasien</div>
                                <span class="material-icons db-stat-icon" style="color: rgba(255, 255, 255, 0.7);">groups</span>
                            </div>
                            <div class="db-stat-number">{{ $totalVisits !== null ? number_format($totalVisits, 0, ',', '.') : '-' }}</div>
                            @if($visitTrend !== null)
                            <div class="db-stat-change {{ $visitDir === 'up' ? 'up' : 'down' }}">
                                {{ $visitDir === 'up' ? '▲' : '▼' }} {{ abs($visitTrend) }}% dari periode sebelumnya
                            </div>
                            @endif
                        </div>

                        <div class="db-stat-card">
                            <div class="db-stat-header">
                                <div class="db-stat-label">No. 1 Penyakit Terbanyak</div>
                                <span class="material-icons db-stat-icon">medical_services</span>
                            </div>
                            <div class="db-disease-container">
                                @if($topDiseaseIcd)
                                    <span class="db-icd-badge">{{ $topDiseaseIcd }}</span>
                                @endif
                                <span class="db-disease-desc" title="{{ $topDiseaseDesc ?? '-' }}">{{ $topDiseaseDesc ?? '-' }}</span>
                            </div>
                            <div class="db-stat-cases-badge">
                                <span class="db-stat-cases-count">{{ $topDiseaseTotal > 0 ? number_format($topDiseaseTotal, 0, ',', '.') : '-' }}</span>
                                <span class="db-stat-cases-label">Kasus</span>
                            </div>
                        </div>

                        <div class="db-stat-card">
                            <div class="db-stat-header">
                                <div class="db-stat-label">Status Kunjungan</div>
                                <span class="material-icons db-stat-icon">analytics</span>
                            </div>
                            <div class="db-kunjungan-grid">
                                <div class="db-kunj-col">
                                    <div class="db-kunj-val green">{{ $served !== null ? number_format($served, 0, ',', '.') : '-' }}</div>
                                    <div class="db-kunj-info">
                                        <span class="db-kunj-indicator green"></span>
                                        <span class="db-kunj-txt">Selesai</span>
                                    </div>
                                </div>
                                <div class="db-kunj-divider"></div>
                                <div class="db-kunj-col">
                                    <div class="db-kunj-val red">{{ $unserved !== null ? number_format($unserved, 0, ',', '.') : '-' }}</div>
                                    <div class="db-kunj-info">
                                        <span class="db-kunj-indicator red"></span>
                                        <span class="db-kunj-txt">Dalam berobat</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 10 Penyakit Terbanyak --}}
                    <div class="db-chart-card penyakit-card">
                        <div class="penyakit-header">
                            <h3 class="db-chart-title">10 Penyakit Terbanyak</h3>
                            <div class="penyakit-legend">
                                <div class="penyakit-legend-item">
                                    <span class="penyakit-legend-dot" style="background:#009966;"></span>
                                    <span>Laki-laki</span>
                                </div>
                                <div class="penyakit-legend-item">
                                    <span class="penyakit-legend-dot" style="background:#6EE7B7;"></span>
                                    <span>Perempuan</span>
                                </div>
                            </div>
                        </div>
                        <div class="penyakit-chart-wrap">
                            <canvas id="penyakitChart"></canvas>
                        </div>
                    </div>

                    {{-- 10 Pekerjaan --}}
                    <div class="db-chart-card">
                        <h3 class="db-chart-title">10 Pekerjaan Pasien Terbanyak</h3>
                        <canvas id="pekerjaanChart" height="180"></canvas>
                    </div>

                </div>

                {{-- RIGHT: Sidebar --}}
                <div class="db-sidebar">

                    {{-- Status Pasien Laki-laki --}}
                    <div class="dbs-card">
                        <div class="dbs-card-title-sm">Status Pasien Laki-laki</div>
                        <canvas id="pieLaki" height="180"></canvas>
                        <div class="dbs-legend">
                            @foreach($maleStatus as $item)
                            <div>
                                <span class="dbs-dot" {!! 'style="background:' . ($item['color'] ?? '#009966') . '"' !!}></span>
                                {{ $item['label'] }}: {{ number_format(collect($item['data'])->sum(fn($d) => $d[1] ?? 0), 0, ',', '.') }} pasien
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Status Pasien Perempuan --}}
                    <div class="dbs-card">
                        <div class="dbs-card-title-sm">Status Pasien Perempuan</div>
                        <canvas id="piePerempuan" height="180"></canvas>
                        <div class="dbs-legend">
                            @foreach($femaleStatus as $item)
                            <div>
                                <span class="dbs-dot" {!! 'style="background:' . ($item['color'] ?? '#009966') . '"' !!}></span>
                                {{ $item['label'] }}: {{ number_format(collect($item['data'])->sum(fn($d) => $d[1] ?? 0), 0, ',', '.') }} pasien
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>

            <div class="db-footnote">
                <span class="material-icons" style="font-size:14px;vertical-align:middle;">info</span>
                Data bersumber dari sistem Walagri terintegrasi. Diperbarui otomatis setiap jam. Periode: {{ \Carbon\Carbon::parse($startDate)->translatedFormat('d F Y') }} – {{ \Carbon\Carbon::parse($endDate)->translatedFormat('d F Y') }}
            </div>

        </div>
    </main>
</div>

<script>
Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
Chart.defaults.font.size   = 11;

// Retrieve data from data attributes
const datasetEl = document.getElementById('statistik-data');
const penyakitRaw    = JSON.parse(datasetEl.dataset.diseaseLabels);
const penyakitMale   = JSON.parse(datasetEl.dataset.diseaseMaleVals);
const penyakitFemale = JSON.parse(datasetEl.dataset.diseaseFemaleVals);
const penyakitLabels = penyakitRaw.map(l => l.split(' - ')[0].trim());
const penyakitFull   = penyakitRaw;

// ── 1. Penyakit Terbanyak (vertical, label = kode ICD, tooltip = nama lengkap) ──
(function() {
    const ctx = document.getElementById('penyakitChart').getContext('2d');
    const gradGreen = ctx.createLinearGradient(0, 0, 0, 260);
    gradGreen.addColorStop(0, '#009966');
    gradGreen.addColorStop(1, '#004F3B');
    const gradMint = ctx.createLinearGradient(0, 0, 0, 260);
    gradMint.addColorStop(0, '#6EE7B7');
    gradMint.addColorStop(1, '#A7F3D0');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: penyakitLabels,
            datasets: [
                { label: 'Laki-laki',  data: penyakitMale,   backgroundColor: gradGreen, borderRadius: 3, borderSkipped: false, barPercentage: 0.65 },
                { label: 'Perempuan',  data: penyakitFemale, backgroundColor: gradMint,  borderRadius: 3, borderSkipped: false, barPercentage: 0.65 },
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#0F172A',
                    titleColor: '#A7F3D0',
                    bodyColor: '#E2E8F0',
                    padding: 10,
                    cornerRadius: 3,
                    callbacks: {
                        title: items => penyakitFull[items[0].dataIndex] ?? items[0].label,
                        label: ctx => ' ' + ctx.dataset.label + ': ' + ctx.parsed.y.toLocaleString('id-ID') + ' kasus'
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#F1F5F9' },
                    ticks: { color: '#64748B', font: { size: 10 } }
                },
                x: {
                    grid: { display: false },
                    ticks: {
                        color: '#334155',
                        font: { size: 11, weight: '600' },
                        maxRotation: 0
                    }
                }
            }
        }
    });
})();

// ── 2. Pekerjaan Terbanyak (Horizontal) ──────────────────────────
(function() {
    const ctx = document.getElementById('pekerjaanChart').getContext('2d');
    const gradGreenHoriz = ctx.createLinearGradient(0, 0, 400, 0); // Horizontal gradient direction
    gradGreenHoriz.addColorStop(0, '#004F3B');
    gradGreenHoriz.addColorStop(1, '#009966');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: JSON.parse(datasetEl.dataset.profLabels),
            datasets: [{ data: JSON.parse(datasetEl.dataset.profValues), backgroundColor: gradGreenHoriz, borderRadius: 3, borderSkipped: false, barPercentage: 0.5 }]
        },
        options: {
            indexAxis: 'y', responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                x: { beginAtZero: true, grid: { color: '#F1F5F9' }, ticks: { color: '#64748B' } },
                y: { grid: { display: false }, ticks: { color: '#475569', font: { size: 10 } } }
            }
        }
    });
})();

// ── 3 & 4. Pie Charts ─────────────────────────────────────────────
const pieOpts = {
    responsive: true,
    plugins: {
        legend: { display: false },
        tooltip: { callbacks: { label: ctx => ' ' + ctx.label + ': ' + ctx.parsed.toLocaleString('id-ID') + ' pasien' } }
    }
};

new Chart(document.getElementById('pieLaki'), {
    type: 'doughnut',
    data: {
        labels: JSON.parse(datasetEl.dataset.maleLabels),
        datasets: [{ data: JSON.parse(datasetEl.dataset.maleVals), backgroundColor: JSON.parse(datasetEl.dataset.maleColors), borderWidth: 0 }]
    },
    options: pieOpts
});

new Chart(document.getElementById('piePerempuan'), {
    type: 'doughnut',
    data: {
        labels: JSON.parse(datasetEl.dataset.femaleLabels),
        datasets: [{ data: JSON.parse(datasetEl.dataset.femaleVals), backgroundColor: JSON.parse(datasetEl.dataset.femaleColors), borderWidth: 0 }]
    },
    options: pieOpts
});
</script>

