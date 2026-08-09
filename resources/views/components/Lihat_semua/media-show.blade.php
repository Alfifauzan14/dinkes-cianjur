<link rel="stylesheet" href="{{ asset('css/Lihat_semua/media-index.css') }}?v={{ time() }}">

<div class="mediaindex-page-wrapper">
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
                <a href="{{ route('media.galeri-kegiatan') }}">Galeri Kegiatan</a>
                <span class="mediaindex-breadcrumb-sep">
                    <span class="material-icons">chevron_right</span>
                </span>
                <span>{{ $galeri->title }}</span>
            </div>
            <h1 class="mediaindex-header-title" style="font-size: 36px;">{{ $galeri->title }}</h1>
            <div class="mediaindex-header-meta">
                <span class="mediaindex-header-badge">{{ $galeri->category }}</span>
                <span class="mediaindex-header-count">
                    <span class="material-icons" style="font-size:18px;vertical-align:middle;">photo_library</span>
                    {{ $galeri->photos->count() }} Foto
                </span>
                <span class="mediaindex-header-date">
                    <span class="material-icons" style="font-size:18px;vertical-align:middle;">calendar_today</span>
                    {{ $galeri->created_at->format('d M Y') }}
                </span>
            </div>
        </div>
    </header>

    <main class="mediaindex-main">
        <div class="mediaindex-container">
            <div class="show-album-grid">
                @foreach($galeri->photos as $index => $photo)
                    <div class="show-album-card lightbox-trigger" data-lightbox-src="{{ $photo->image_url }}" data-lightbox-alt="{{ $galeri->title }} - Foto {{ $index + 1 }}">
                        @if(file_exists(public_path('uploads/galeri/' . $photo->image)))
                            <img src="{{ asset('uploads/galeri/' . $photo->image) }}" alt="{{ $galeri->title }} - Foto {{ $index + 1 }}" class="show-album-img" loading="lazy">
                        @else
                            <img src="{{ asset('images/' . $photo->image) }}" alt="{{ $galeri->title }} - Foto {{ $index + 1 }}" class="show-album-img" loading="lazy">
                        @endif
                        <div class="show-album-overlay">
                            <span class="material-icons show-album-zoom">zoom_in</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="show-album-back">
                <a href="{{ route('media.galeri-kegiatan') }}" class="show-album-back-link">
                    <span class="material-icons">arrow_back</span>
                    <span>Kembali ke Galeri Kegiatan</span>
                </a>
            </div>
        </div>
    </main>
</div>

@include('components.lightbox')

<script>
document.addEventListener('DOMContentLoaded', function() {
    initLightbox('.lightbox-trigger');
});
</script>
