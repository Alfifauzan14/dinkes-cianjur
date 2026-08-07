<link rel="stylesheet" href="{{ asset('css/Stunting/stunting.css') }}?v={{ time() }}">

@php
    $latestRecord = \App\Models\StuntingRecord::orderBy('year', 'desc')->first();
    $prevRecord = $latestRecord ? \App\Models\StuntingRecord::where('year', '<', $latestRecord->year)->orderBy('year', 'desc')->first() : null;
    $latestChange = ($latestRecord && $prevRecord) ? $latestRecord->balita_stunting - $prevRecord->balita_stunting : null;
    $totalYears = \App\Models\StuntingRecord::count();
@endphp

<div class="st-page-wrapper">
    <header class="st-header">
        <div class="st-header-container">
            <h1 class="st-header-title">{{ \App\Models\Setting::get('page_stunting_title', 'Cianjur Bebas Stunting') }}</h1>
            <p class="st-header-subtitle">{{ \App\Models\Setting::get('page_stunting_subtitle', 'Program komprehensif untuk mencegah dan menurunkan angka stunting di Kabupaten Cianjur melalui intervensi gizi dan edukasi.') }}</p>
        </div>
    </header>

    <main class="st-content">
        <div class="st-container">

            <div class="st-category-section">
                <div class="st-title-section">
                    <h2 class="st-main-title">Data Stunting Terkini</h2>
                    <p class="st-main-subtitle">Jumlah balita stunting di Kabupaten Cianjur berdasarkan data terbaru.</p>
                </div>
                <div class="st-info-grid">
                    <div class="st-info-card">
                        <p class="st-info-number">{{ $latestRecord ? number_format($latestRecord->balita_stunting) : '—' }}</p>
                        <p class="st-info-label">Balita Stunting ({{ $latestRecord ? $latestRecord->year : '—' }})</p>
                    </div>
                    <div class="st-info-card">
                        @if($latestChange !== null)
                            <p class="st-info-number" style="color: {{ $latestChange < 0 ? '#16A34A' : '#DC2626' }}">
                                {{ $latestChange > 0 ? '+' : '' }}{{ number_format($latestChange) }} bayi
                            </p>
                        @else
                            <p class="st-info-number">—</p>
                        @endif
                        <p class="st-info-label">Perubahan vs Tahun Sebelumnya</p>
                    </div>
                    <div class="st-info-card">
                        <p class="st-info-number">{{ $totalYears }}</p>
                        <p class="st-info-label">Tahun Data</p>
                    </div>
                </div>
            </div>

            <div class="st-category-section">
                <div class="st-title-section">
                    <h2 class="st-main-title">Program Intervensi</h2>
                </div>
                <div class="st-program-grid">
                    <div class="st-program-item">
                        <h3 class="st-program-number">1. Pemberian Makanan Tambahan (PMT) untuk Balita</h3>
                        <p class="st-program-desc">Menyediakan makanan bergizi tinggi untuk balita stunting dan gizi buruk guna memenuhi kebutuhan nutrisi harian mereka.</p>
                    </div>
                    <div class="st-program-item">
                        <h3 class="st-program-number">2. Edukasi Gizi dan Pola Asuh untuk Orang Tua</h3>
                        <p class="st-program-desc">Memberikan pendampingan dan edukasi kepada orang tua tentang pola asuh yang baik, gizi seimbang, dan stimulasi tumbuh kembang anak.</p>
                    </div>
                    <div class="st-program-item">
                        <h3 class="st-program-number">3. Pemantauan Tumbuh Kembang Balita</h3>
                        <p class="st-program-desc">Melakukan pengukuran rutin tinggi badan, berat badan, dan lingkar kepala balita untuk deteksi dini stunting di Posyandu.</p>
                    </div>
                    <div class="st-program-item">
                        <h3 class="st-program-number">4. Perbaikan Sanitasi dan Akses Air Bersih</h3>
                        <p class="st-program-desc">Meningkatkan akses keluarga terhadap air bersih dan sanitasi layak untuk mencegah penyakit infeksi yang mempengaruhi pertumbuhan anak.</p>
                    </div>
                    <div class="st-program-item">
                        <h3 class="st-program-number">5. Suplementasi Gizi untuk Ibu Hamil</h3>
                        <p class="st-program-desc">Pemberian tablet tambah darah dan suplemen gizi untuk ibu hamil guna mencegah anemia dan memastikan janin tumbuh optimal.</p>
                    </div>
                    <div class="st-program-item">
                        <h3 class="st-program-number">6. Pemberdayaan Kader Posyandu</h3>
                        <p class="st-program-desc">Melatih dan memberdayakan kader kesehatan untuk melakukan deteksi dini, pencatatan, dan pelaporan kasus stunting di tingkat desa.</p>
                    </div>
                </div>
            </div>

            <div class="st-content-card">
                <h3 class="st-content-title">Apa itu Stunting?</h3>
                <p class="st-content-text">Stunting adalah kondisi gagal tumbuh pada anak balita (bayi di bawah lima tahun) akibat kekurangan gizi kronis sehingga anak terlalu pendek untuk usianya. Kekurangan gizi terjadi sejak bayi dalam kandungan hingga awal kehidupan anak (1000 Hari Pertama Kehidupan).</p>
                <h3 class="st-content-title">Penyebab Stunting</h3>
                <ul class="st-content-list">
                    <li>Kurangnya asupan gizi pada ibu selama kehamilan.</li>
                    <li>Kebutuhan gizi anak tidak tercukupi.</li>
                    <li>Kurangnya pengetahuan ibu mengenai kesehatan dan gizi.</li>
                    <li>Terbatasnya layanan kesehatan termasuk layanan kehamilan dan nifas.</li>
                    <li>Kurangnya akses makanan bergizi dan air bersih.</li>
                </ul>
                <h3 class="st-content-title">Dampak Stunting</h3>
                <p class="st-content-text">Stunting tidak hanya menyebabkan tubuh anak pendek, tetapi juga menghambat perkembangan otak, menurunkan kemampuan belajar, dan meningkatkan risiko penyakit kronis di masa dewasa.</p>
            </div>
        </div>
    </main>
</div>
