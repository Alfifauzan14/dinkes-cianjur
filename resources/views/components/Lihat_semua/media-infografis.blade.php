{{-- Halaman Infografis --}}
<link rel="stylesheet" href="{{ asset('css/Lihat_semua/media-infografis.css') }}?v={{ time() }}">
<link rel="stylesheet" href="{{ asset('css/Lihat_semua/media-index.css') }}?v={{ time() }}">

@php
    $header = \App\Models\HeaderSetting::getByKey('media-infografis', 'Infografis', 'Visualisasi data dan informasi kesehatan Kabupaten Cianjur dalam format poster yang informatif dan mudah dipahami.');
@endphp

<div class="infografis-page-wrapper">

    <!-- Header Banner -->
    <header class="infografis-header">
        <div class="infografis-header-container">

            <h1 class="infografis-header-title">{{ $header->title }}</h1>
            <p class="infografis-header-subtitle">{{ $header->subtitle }}</p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="infografis-content">
        <div class="infografis-container">

            <!-- Gallery Grid -->
            <div class="infografis-gallery-grid">
                @forelse ($infografis as $item)
                    <div class="infografis-card" id="infografis-card-{{ $item->id }}">
                        <img
                            src="{{ asset('uploads/infografis/' . $item->image) }}"
                            alt="{{ $item->title }}"
                            class="infografis-card-image lightbox-trigger"
                            data-lightbox-alt="{{ $item->title }}"
                            loading="lazy"
                        >
                        <div class="infografis-card-overlay"></div>
                        <div class="infografis-card-zoom">
                            <span class="material-icons">zoom_in</span>
                        </div>
                        <div class="infografis-card-content">
                            <p class="infografis-card-title">{{ $item->title }}</p>
                        </div>
                    </div>
                @empty
                    <div class="infografis-empty-state">
                        <span class="material-icons infografis-empty-icon">bar_chart</span>
                        <h2 class="infografis-empty-title">Belum Ada Infografis</h2>
                        <p class="infografis-empty-desc">Konten infografis sedang dalam proses persiapan.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($infografis->hasPages())
                <div class="infografis-pagination">
                    {{ $infografis->links('vendor.pagination.media-custom') }}
                </div>
            @endif

        </div>
    </main>
</div>

@include('components.lightbox')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        initLightbox('.lightbox-trigger');
    });
</script>
