<link rel="stylesheet" href="{{ asset('css/Lihat_semua/media.css') }}?v={{ time() }}">
<link rel="stylesheet" href="{{ asset('css/Lihat_semua/media-index.css') }}?v={{ time() }}">

@php
    $header = \App\Models\HeaderSetting::getByKey('media-galeri', 'Galeri Kegiatan', 'Kumpulan dokumentasi foto dan video dari berbagai acara dan kegiatan Dinas Kesehatan Kabupaten Cianjur.');
@endphp

<div class="media-page-wrapper">
    <header class="media-header">
        <div class="media-header-container">

            <h1 class="media-header-title">{{ $header->title }}</h1>
            <p class="media-header-subtitle">{{ $header->subtitle }}</p>
        </div>
    </header>

    <main class="media-content">
        <div class="media-container">
            <form action="{{ route('media.galeri-kegiatan') }}" method="GET" class="media-filter-bar" id="mediaFilterForm">
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
                        <input type="hidden" name="category" id="categoryValue" value="{{ request('category', 'Semua') }}">
                        <div class="media-custom-select" id="categoryDropdown">
                            <button type="button" class="media-custom-select-btn" aria-haspopup="listbox" aria-expanded="false">
                                <span class="media-custom-select-label">
                                    @if(request('category') && request('category') !== 'Semua')
                                        {{ request('category') }}
                                    @else
                                        Semua Kategori
                                    @endif
                                </span>
                                <svg class="media-custom-select-icon" viewBox="0 0 10 6"><path d="M1 1L5 5L9 1" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </button>
                            <ul class="media-custom-select-list" role="listbox">
                                <li class="media-custom-option {{ request('category', 'Semua') === 'Semua' ? 'selected' : '' }}" data-value="Semua" role="option">Semua Kategori</li>
                                <li class="media-custom-option {{ request('category') === 'PROGRAM' ? 'selected' : '' }}" data-value="PROGRAM" role="option">PROGRAM</li>
                                <li class="media-custom-option {{ request('category') === 'KEGIATAN' ? 'selected' : '' }}" data-value="KEGIATAN" role="option">KEGIATAN</li>
                                <li class="media-custom-option {{ request('category') === 'NASIONAL' ? 'selected' : '' }}" data-value="NASIONAL" role="option">NASIONAL</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </form>

            <div class="media-gallery-grid">
                @forelse ($galeris as $galeri)
                    <a href="{{ route('media.galeri-kegiatan.show', $galeri->slug) }}" class="media-card">
                        @if($galeri->thumbnail)
                            @if(file_exists(public_path('uploads/galeri/' . $galeri->thumbnail->image)))
                                <img src="{{ asset('uploads/galeri/' . $galeri->thumbnail->image) }}" alt="{{ $galeri->title }}" class="media-card-image" loading="lazy">
                            @else
                                <img src="{{ asset('images/' . $galeri->thumbnail->image) }}" alt="{{ $galeri->title }}" class="media-card-image" loading="lazy">
                            @endif
                        @elseif($galeri->image)
                            @if(file_exists(public_path('uploads/galeri/' . $galeri->image)))
                                <img src="{{ asset('uploads/galeri/' . $galeri->image) }}" alt="{{ $galeri->title }}" class="media-card-image" loading="lazy">
                            @else
                                <img src="{{ asset('images/' . $galeri->image) }}" alt="{{ $galeri->title }}" class="media-card-image" loading="lazy">
                            @endif
                        @else
                            <div class="media-card-image" style="background:#F3F4F6;display:flex;align-items:center;justify-content:center;">
                                <span class="material-icons" style="font-size:48px;color:#D1D5DB;">collections</span>
                            </div>
                        @endif
                        <div class="media-card-overlay"></div>
                        <span class="media-card-badge">{{ $galeri->category }}</span>
                        <div class="media-card-content">
                            <h4 class="media-card-title">{{ $galeri->title }}</h4>
                            <span class="media-card-count">{{ $galeri->photos_count }} foto</span>
                        </div>
                    </a>
                @empty
                    <div class="media-empty-state">
                        <span class="material-icons media-empty-icon">collections</span>
                        <p class="media-empty-text">Belum ada dokumentasi galeri kegiatan.</p>
                    </div>
                @endforelse
            </div>

            @if ($galeris->hasPages())
                <div class="media-pagination">
                    {{ $galeris->links('vendor.pagination.media-custom') }}
                </div>
            @endif
        </div>
    </main>
</div>

<script>
(function () {
    var wrap   = document.getElementById('categoryDropdown');
    if (!wrap) return;
    var btn    = wrap.querySelector('.media-custom-select-btn');
    var list   = wrap.querySelector('.media-custom-select-list');
    var label  = wrap.querySelector('.media-custom-select-label');
    var hidden = document.getElementById('categoryValue');
    var form   = document.getElementById('mediaFilterForm');

    btn.addEventListener('click', function (e) {
        e.stopPropagation();
        var isOpen = wrap.classList.contains('open');
        document.querySelectorAll('.media-custom-select').forEach(function (d) {
            d.classList.remove('open');
            d.querySelector('.media-custom-select-btn').setAttribute('aria-expanded', 'false');
        });
        if (!isOpen) {
            wrap.classList.add('open');
            btn.setAttribute('aria-expanded', 'true');
        }
    });

    list.querySelectorAll('.media-custom-option').forEach(function (opt) {
        opt.addEventListener('click', function () {
            hidden.value = opt.dataset.value;
            label.textContent = opt.textContent.trim();
            list.querySelectorAll('.media-custom-option').forEach(function (o) { o.classList.remove('selected'); });
            opt.classList.add('selected');
            wrap.classList.remove('open');
            btn.setAttribute('aria-expanded', 'false');
            form.submit();
        });
    });

    document.addEventListener('click', function () {
        document.querySelectorAll('.media-custom-select').forEach(function (d) {
            d.classList.remove('open');
            d.querySelector('.media-custom-select-btn').setAttribute('aria-expanded', 'false');
        });
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.media-custom-select').forEach(function (d) {
                d.classList.remove('open');
                d.querySelector('.media-custom-select-btn').setAttribute('aria-expanded', 'false');
            });
        }
    });
})();
</script>
