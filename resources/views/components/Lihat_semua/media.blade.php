<link rel="stylesheet" href="{{ asset('css/Lihat_semua/media.css') }}?v={{ time() }}">

<div class="media-page-wrapper">
    @php
        $headerSetting = \App\Models\HeaderSetting::getByKey('media', 'Galeri Foto', 'Dokumentasi visual rangkaian kegiatan, kampanye kesehatan, dan pelayanan publik di lapangan.');
    @endphp
    <!-- Header Banner -->
    <header class="media-header">
        <div class="media-header-container">
            <h1 class="media-header-title">{{ \App\Models\Setting::get('page_media_title', 'Galeri Kegiatan') }}</h1>
            <p class="media-header-subtitle">{{ \App\Models\Setting::get('page_media_subtitle', 'Kumpulan dokumentasi foto dan video dari berbagai acara dan kegiatan Dinas Kesehatan Kota Cianjur') }}</p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="media-content">
        <div class="media-container">
            <!-- Search & Filter Bar -->
            <form action="{{ url('/media') }}" method="GET" class="media-filter-bar">
                <div class="media-search-section">
                    <h3 class="media-filter-label">Cari Album Kegiatan</h3>
                    <div class="media-search-box">
                        <svg class="media-search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8" />
                            <path d="M21 21l-4.35-4.35" />
                        </svg>
                        <input type="text" name="search" class="media-search-input" value="{{ request('search') }}" placeholder="Cari Judul Galeri...">
                        <button type="submit" class="media-search-btn">Cari</button>
                    </div>
                </div>
                <div class="media-filter-section">
                    <h3 class="media-filter-label">Filter Kategori</h3>
                    <div class="media-filter-dropdown">
                        <select name="category" class="media-select" onchange="this.form.submit()">
                            <option value="Semua" {{ request('category', 'Semua') == 'Semua' ? 'selected' : '' }}>Semua Kategori</option>
                            <option value="PROGRAM" {{ request('category') == 'PROGRAM' ? 'selected' : '' }}>PROGRAM</option>
                            <option value="KEGIATAN" {{ request('category') == 'KEGIATAN' ? 'selected' : '' }}>KEGIATAN</option>
                            <option value="NASIONAL" {{ request('category') == 'NASIONAL' ? 'selected' : '' }}>NASIONAL</option>
                        </select>
                    </div>
                </div>
            </form>

            <!-- Gallery Grid -->
            <div class="media-gallery-grid">
                @forelse ($galeris as $galeri)
                    <div class="media-card">
                        @if(file_exists(public_path('uploads/galeri/' . $galeri->image)))
                            <img src="{{ asset('uploads/galeri/' . $galeri->image) }}" alt="{{ $galeri->title }}" class="media-card-image lightbox-trigger" loading="lazy">
                        @else
                            <img src="{{ asset('images/' . $galeri->image) }}" alt="{{ $galeri->title }}" class="media-card-image lightbox-trigger" loading="lazy">
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
                    {{ $galeris->links('vendor.pagination.media-custom') }}
                </div>
            @endif
        </div>
    </main>
</div>

@include('components.lightbox')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        initLightbox('.lightbox-trigger');
    });
</script>
