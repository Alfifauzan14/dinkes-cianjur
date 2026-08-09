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
                <span>Media</span>
            </div>
            <h1 class="mediaindex-header-title">Media & Dokumentasi</h1>
            <p class="mediaindex-header-subtitle">Eksplorasi konten visual Dinas Kesehatan Kabupaten Cianjur — dari galeri kegiatan di lapangan hingga infografis data kesehatan.</p>
        </div>
    </header>

    <!-- Cards Section -->
    <main class="mediaindex-main">
        <div class="mediaindex-container">
            <p class="mediaindex-section-label">Pilih Kategori Media</p>
            <div class="mediaindex-cards">

                <!-- Card: Galeri Kegiatan -->
                <a href="{{ url('/media/galeri-kegiatan') }}" class="mediaindex-card" id="card-galeri-kegiatan">
                    <div class="mediaindex-card-bg mediaindex-card-bg--galeri">
                        <div class="mediaindex-card-icon-wrap">
                            <span class="material-icons mediaindex-card-icon">collections</span>
                        </div>
                        <div class="mediaindex-card-shine"></div>
                    </div>
                    <div class="mediaindex-card-body">
                        <div class="mediaindex-card-tag">Foto & Dokumentasi</div>
                        <h2 class="mediaindex-card-title">Galeri Kegiatan</h2>
                        <p class="mediaindex-card-desc">Kumpulan dokumentasi foto dari berbagai acara, program kesehatan, dan kegiatan lapangan Dinas Kesehatan Kabupaten Cianjur.</p>
                        <div class="mediaindex-card-cta">
                            <span>Lihat Galeri</span>
                            <span class="material-icons mediaindex-card-arrow">arrow_forward</span>
                        </div>
                    </div>
                </a>

                <!-- Card: Infografis -->
                <a href="{{ url('/media/infografis') }}" class="mediaindex-card mediaindex-card--coming" id="card-infografis">
                    <div class="mediaindex-card-bg mediaindex-card-bg--infografis">
                        <div class="mediaindex-card-icon-wrap">
                            <span class="material-icons mediaindex-card-icon">bar_chart</span>
                        </div>
                        <div class="mediaindex-card-shine"></div>
                    </div>
                    <div class="mediaindex-card-body">
                        <div class="mediaindex-card-tag mediaindex-card-tag--soon">Segera Hadir</div>
                        <h2 class="mediaindex-card-title">Infografis</h2>
                        <p class="mediaindex-card-desc">Visualisasi data dan statistik kesehatan dalam format infografis yang informatif dan mudah dipahami oleh masyarakat.</p>
                        <div class="mediaindex-card-cta mediaindex-card-cta--muted">
                            <span>Lihat Infografis</span>
                            <span class="material-icons mediaindex-card-arrow">arrow_forward</span>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </main>
</div>
