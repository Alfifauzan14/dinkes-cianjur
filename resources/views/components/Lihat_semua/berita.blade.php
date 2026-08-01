<link rel="stylesheet" href="{{ asset('css/Lihat_semua/berita.css') }}?v={{ time() }}">

<div class="berita-page-wrapper">
    <!-- Header Banner -->
    <header class="berita-header">
        <div class="berita-header-container">
            <h1 class="berita-header-title">Rilis Berita & Informasi Terkini</h1>
            <p class="berita-header-subtitle">Informasi seputar kesehatan terkini dan kegiatan yang dilaksanakan oleh Dinas Kesehatan Kabupaten Cianjur</p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="berita-content">
        <div class="berita-container">
            <!-- Search & Filter Bar -->
            <div class="berita-filter-bar">
                <div class="berita-search-section">
                    <h3 class="berita-filter-label">Cari Album Kegiatan</h3>
                    <div class="berita-search-box">
                        <svg class="berita-search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8" />
                            <path d="M21 21l-4.35-4.35" />
                        </svg>
                        <input type="text" class="berita-search-input" placeholder="Cari nama Puskesmas...">
                        <button class="berita-search-btn">Cari</button>
                    </div>
                </div>
                <div class="berita-filter-section">
                    <h3 class="berita-filter-label">Filter Kategori</h3>
                    <div class="berita-filter-dropdown">
                        <select class="berita-select">
                            <option>Semua Wilayah...</option>
                            <option>Kota Cianjur</option>
                            <option>Cianjur Selatan</option>
                            <option>Cianjur Utara</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Featured Section (Row 1) -->
            <div class="berita-featured-section">
                <!-- Large Featured Card (Left) -->
                <div class="berita-featured-left">
                    <a href="#" class="featured-large-card">
                        <div class="card-image-wrap">
                            <img src="{{ asset('images/dumy1.png') }}" alt="Featured News Image" class="featured-large-image">
                            <span class="berita-badge">15 Juli 2026</span>
                        </div>
                        <div class="featured-large-content">
                            <h2 class="featured-large-title">Gerakan Aktifkan Posyandu dalam kegiatan Rembug Warga</h2>
                        </div>
                    </a>
                </div>

                <!-- Two Small Featured Cards (Right) -->
                <div class="berita-featured-right">
                    <a href="#" class="featured-small-card">
                        <div class="small-card-image-wrap">
                            <img src="{{ asset('images/dumy1.png') }}" alt="News Image">
                        </div>
                        <div class="small-card-content">
                            <span class="small-card-date">15 Juli 2026</span>
                            <h3 class="small-card-title">Gerakan Aktifkan Posyandu dalam kegiatan Rembug Warga</h3>
                        </div>
                    </a>

                    <a href="#" class="featured-small-card">
                        <div class="small-card-image-wrap">
                            <img src="{{ asset('images/dumy1.png') }}" alt="News Image">
                        </div>
                        <div class="small-card-content">
                            <span class="small-card-date">15 Juli 2026</span>
                            <h3 class="small-card-title">Gerakan Aktifkan Posyandu dalam kegiatan Rembug Warga</h3>
                        </div>
                    </a>
                </div>
            </div>

            <!-- News Grid Section (Row 2 onwards) -->
            <div class="berita-grid-section">
                @for ($i = 0; $i < 9; $i++)
                <div class="berita-grid-card">
                    <div class="grid-card-image-wrap">
                        <img src="{{ asset('images/dumy2.png') }}" alt="News Image">
                    </div>
                    <div class="grid-card-content">
                        <span class="grid-card-date">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 6px; display: inline-block; vertical-align: middle;">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                <line x1="16" y1="2" x2="16" y2="6" />
                                <line x1="8" y1="2" x2="8" y2="6" />
                                <line x1="3" y1="10" x2="21" y2="10" />
                            </svg>
                            24 Juni 2024
                        </span>
                        <h4 class="grid-card-title">Workshop Penguatan performance improvement plan (PIP)</h4>
                    </div>
                </div>
                @endfor
            </div>

            <!-- Pagination -->
            <div class="berita-pagination">
                <button class="berita-page-btn" aria-label="Previous">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 18l-6-6 6-6" />
                    </svg>
                </button>
                <button class="berita-page-btn active">1</button>
                <button class="berita-page-btn">2</button>
                <button class="berita-page-btn">3</button>
                <span class="berita-page-dots">...</span>
                <button class="berita-page-btn">12</button>
                <button class="berita-page-btn" aria-label="Next">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 18l6-6-6-6" />
                    </svg>
                </button>
            </div>
        </div>
    </main>
</div>
