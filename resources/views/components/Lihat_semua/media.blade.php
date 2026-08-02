<link rel="stylesheet" href="{{ asset('css/Lihat_semua/media.css') }}?v={{ time() }}">

<div class="media-page-wrapper">
    <!-- Header Banner -->
    <header class="media-header">
        <div class="media-header-container">
            <h1 class="media-header-title">Galeri Kegiatan</h1>
            <p class="media-header-subtitle">Kumpulan dokumentasi foto dan video dari berbagai acara dan kegiatan Dinas Kesehatan Kota Cianjur</p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="media-content">
        <div class="media-container">
            <!-- Search & Filter Bar -->
            <div class="media-filter-bar">
                <div class="media-search-section">
                    <h3 class="media-filter-label">Cari Album Kegiatan</h3>
                    <div class="media-search-box">
                        <svg class="media-search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8" />
                            <path d="M21 21l-4.35-4.35" />
                        </svg>
                        <input type="text" class="media-search-input" placeholder="Cari Judul Berita...">
                        <button class="media-search-btn">Cari</button>
                    </div>
                </div>
                <div class="media-filter-section">
                    <h3 class="media-filter-label">Filter Kategori</h3>
                    <div class="media-filter-dropdown">
                        <select class="media-select">
                            <option>Semua Wilayah</option>
                            <option>Kota Cianjur</option>
                            <option>Cianjur Selatan</option>
                            <option>Cianjur Utara</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Gallery Grid -->
            <div class="media-gallery-grid">
                @forelse ($galeris as $galeri)
                    <div class="media-card">
                        @if(file_exists(public_path('uploads/galeri/' . $galeri->image)))
                            <img src="{{ asset('uploads/galeri/' . $galeri->image) }}" alt="{{ $galeri->title }}" class="media-card-image" loading="lazy">
                        @else
                            <img src="{{ asset('images/' . $galeri->image) }}" alt="{{ $galeri->title }}" class="media-card-image" loading="lazy">
                        @endif
                        <div class="media-card-overlay"></div>
                        <span class="media-card-badge">{{ $galeri->category }}</span>
                        <div class="media-card-content">
                            <h4 class="media-card-title">{{ $galeri->title }}</h4>
                        </div>
                    </div>
                @empty
                    <div style="grid-column: span 3; text-align: center; padding: 48px; color: #9CA3AF; background: #F9FAFB; border-radius: 6px; width: 100%;">
                        <span class="material-icons" style="font-size: 48px; margin-bottom: 8px;">collections</span>
                        <p style="font-weight: 600;">Belum ada dokumentasi galeri kegiatan.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($galeris->hasPages())
                <div class="media-pagination">
                    {{-- Previous Page Link --}}
                    @if ($galeris->onFirstPage())
                        <span class="media-page-btn disabled" style="opacity: 0.5; cursor: not-allowed; display: inline-flex; align-items: center; justify-content: center;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16">
                                <path d="M15 18l-6-6 6-6" />
                            </svg>
                        </span>
                    @else
                        <a href="{{ $galeris->previousPageUrl() }}" class="media-page-btn" aria-label="Previous" style="text-decoration: none; color: inherit; display: inline-flex; align-items: center; justify-content: center;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16">
                                <path d="M15 18l-6-6 6-6" />
                            </svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($galeris->getUrlRange(1, $galeris->lastPage()) as $page => $url)
                        @if ($page == $galeris->currentPage())
                            <span class="media-page-btn active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="media-page-btn" style="text-decoration: none; color: inherit;">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($galeris->hasMorePages())
                        <a href="{{ $galeris->nextPageUrl() }}" class="media-page-btn" aria-label="Next" style="text-decoration: none; color: inherit; display: inline-flex; align-items: center; justify-content: center;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16">
                                <path d="M9 18l6-6-6-6" />
                            </svg>
                        </a>
                    @else
                        <span class="media-page-btn disabled" style="opacity: 0.5; cursor: not-allowed; display: inline-flex; align-items: center; justify-content: center;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16">
                                <path d="M9 18l6-6-6-6" />
                            </svg>
                        </span>
                    @endif
                </div>
            @endif
        </div>
    </main>
</div>
