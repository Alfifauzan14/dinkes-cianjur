<link rel="stylesheet" href="{{ asset('css/Lihat_semua/media-index.css') }}?v={{ time() }}">

@php
    $header = \App\Models\HeaderSetting::getByKey('media', 'Media & Dokumentasi', 'Eksplorasi konten visual Dinas Kesehatan Kabupaten Cianjur — dari galeri kegiatan di lapangan hingga infografis data kesehatan.');
    $headerGaleri = \App\Models\HeaderSetting::getByKey('media-galeri', 'Galeri Kegiatan', 'Kumpulan dokumentasi foto dari berbagai acara, program kesehatan, dan kegiatan lapangan Dinas Kesehatan Kabupaten Cianjur.');
    $headerInfografis = \App\Models\HeaderSetting::getByKey('media-infografis', 'Infografis', 'Visualisasi data dan statistik kesehatan dalam format infografis yang informatif dan mudah dipahami oleh masyarakat.');
@endphp

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
            <h1 class="mediaindex-header-title">{{ $header->title }}</h1>
            <p class="mediaindex-header-subtitle">{{ $header->subtitle }}</p>
        </div>
    </header>

    <!-- Cards Section -->
    <main class="mediaindex-main">
        <div class="mediaindex-container">
            <p class="mediaindex-section-label">Pilih Kategori Media</p>
            <div class="mediaindex-cards">

                <!-- Card: Galeri Kegiatan -->
                <a href="{{ url('/media/galeri-kegiatan') }}" class="mediaindex-card" id="card-galeri-kegiatan">
                    <div class="mediaindex-card-bg">
                        @php
                            $galeriImg = '';
                            $galeriAlt = 'Galeri Kegiatan';
                            if ($recentGaleri->count()) {
                                $first = $recentGaleri->first();
                                $thumb = $first->thumbnail;
                                if ($thumb) {
                                    $galeriImg = file_exists(public_path('uploads/galeri/' . $thumb->image))
                                        ? asset('uploads/galeri/' . $thumb->image)
                                        : asset('images/' . $thumb->image);
                                } elseif ($first->image) {
                                    $galeriImg = file_exists(public_path('uploads/galeri/' . $first->image))
                                        ? asset('uploads/galeri/' . $first->image)
                                        : asset('images/' . $first->image);
                                }
                                $galeriAlt = $first->title;
                            }
                        @endphp
                        @if($galeriImg)
                            <img src="{{ $galeriImg }}" alt="{{ $galeriAlt }}" class="mediaindex-card-bg-img">
                        @else
                            <span class="material-icons mediaindex-card-bg-icon">collections</span>
                        @endif
                        <div class="mediaindex-card-bg-overlay"></div>
                    </div>
                    <div class="mediaindex-card-body">
                        <div class="mediaindex-card-tag">Foto & Dokumentasi</div>
                        <h2 class="mediaindex-card-title">{{ $headerGaleri->title }}</h2>
                        <p class="mediaindex-card-desc">{{ $headerGaleri->subtitle }}</p>
                        <div class="mediaindex-card-cta">
                            <span>Lihat Galeri</span>
                            <span class="material-icons mediaindex-card-arrow">arrow_forward</span>
                        </div>
                    </div>
                </a>

                <!-- Card: Infografis -->
                <a href="{{ url('/media/infografis') }}" class="mediaindex-card" id="card-infografis">
                    <div class="mediaindex-card-bg">
                        @php
                            $infoImg = '';
                            $infoAlt = 'Infografis';
                            if ($recentInfografis->count()) {
                                $first = $recentInfografis->first();
                                if ($first->image) {
                                    $infoImg = file_exists(public_path('uploads/infografis/' . $first->image))
                                        ? asset('uploads/infografis/' . $first->image)
                                        : asset('images/' . $first->image);
                                }
                                $infoAlt = $first->title;
                            }
                        @endphp
                        @if($infoImg)
                            <img src="{{ $infoImg }}" alt="{{ $infoAlt }}" class="mediaindex-card-bg-img">
                        @else
                            <span class="material-icons mediaindex-card-bg-icon">bar_chart</span>
                        @endif
                        <div class="mediaindex-card-bg-overlay"></div>
                    </div>
                    <div class="mediaindex-card-body">
                        <div class="mediaindex-card-tag">Data & Statistik</div>
                        <h2 class="mediaindex-card-title">{{ $headerInfografis->title }}</h2>
                        <p class="mediaindex-card-desc">{{ $headerInfografis->subtitle }}</p>
                        <div class="mediaindex-card-cta">
                            <span>Lihat Infografis</span>
                            <span class="material-icons mediaindex-card-arrow">arrow_forward</span>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </main>
</div>
