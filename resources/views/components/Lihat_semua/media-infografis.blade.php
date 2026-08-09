{{-- Infografis Placeholder --}}
<link rel="stylesheet" href="{{ asset('css/Lihat_semua/media-index.css') }}?v={{ time() }}">

<div class="mediaindex-page-wrapper">
    <!-- Header Banner -->
    <header class="mediaindex-header">
        <div class="mediaindex-header-container">
            <div class="mediaindex-breadcrumb">
                <a href="{{ route('home') }}">Beranda</a>
                <span class="mediaindex-breadcrumb-sep">
                    <span class="material-icons">chevron_right</span>
                </span>
                <a href="{{ url('/media') }}">Media</a>
                <span class="mediaindex-breadcrumb-sep">
                    <span class="material-icons">chevron_right</span>
                </span>
                <span>Infografis</span>
            </div>
            <h1 class="mediaindex-header-title">Infografis</h1>
            <p class="mediaindex-header-subtitle">Visualisasi data dan statistik kesehatan Kabupaten Cianjur dalam format yang informatif dan mudah dipahami.</p>
        </div>
    </header>

    <!-- Coming Soon -->
    <main class="mediaindex-main">
        <div class="mediaindex-container">
            <div class="mediaindex-coming-soon">
                <div class="mediaindex-cs-icon-wrap">
                    <span class="material-icons mediaindex-cs-icon">bar_chart</span>
                </div>
                <h2 class="mediaindex-cs-title">Segera Hadir</h2>
                <p class="mediaindex-cs-desc">Konten infografis sedang dalam proses persiapan. Pantau terus halaman ini untuk pembaruan informasi kesehatan dalam bentuk visual yang menarik.</p>
                <a href="{{ url('/media') }}" class="mediaindex-cs-back">
                    <span class="material-icons">arrow_back</span>
                    <span>Kembali ke Media</span>
                </a>
            </div>
        </div>
    </main>
</div>
