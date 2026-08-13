<link rel="stylesheet" href="{{ asset('css/Lihat_semua/berita.css') }}?v={{ time() }}">

<div class="berita-page-wrapper">
    <header class="berita-header">
        <div class="berita-header-container">
            <h1 class="berita-header-title">{{ \App\Models\Setting::get('page_berita_title', 'Rilis Berita & Informasi Terkini') }}</h1>
            <p class="berita-header-subtitle">{{ \App\Models\Setting::get('page_berita_subtitle', 'Informasi seputar kesehatan terkini and kegiatan yang dilaksanakan oleh Dinas Kesehatan Kabupaten Cianjur') }}</p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="berita-content">
        <div class="berita-container">
            <!-- Search & Filter Bar -->
            <form action="{{ route('berita') }}" method="GET" class="berita-filter-bar">
                <div class="berita-search-section">
                    <h3 class="berita-filter-label">Cari Artikel Berita</h3>
                    <div class="berita-search-box">
                        <svg class="berita-search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8" />
                            <path d="M21 21l-4.35-4.35" />
                        </svg>
                        <input type="text" name="search" class="berita-search-input" value="{{ request('search') }}" placeholder="Cari rilis berita...">
                        <button type="submit" class="berita-search-btn">Cari</button>
                    </div>
                </div>
                <div class="berita-filter-section">
                    <h3 class="berita-filter-label">Filter Kategori</h3>
                    <div class="berita-filter-wrap">
                        <input type="hidden" name="category" id="categoryValue" value="{{ request('category', 'Semua') }}">
                        <div class="berita-custom-select" id="categoryDropdown">
                            <button type="button" class="berita-custom-select-btn" aria-haspopup="listbox" aria-expanded="false">
                                <span class="berita-custom-select-label">
                                    @if(request('category') && request('category') !== 'Semua')
                                        {{ request('category') }}
                                    @else
                                        Semua Kategori
                                    @endif
                                </span>
                                <svg class="berita-custom-select-icon" viewBox="0 0 10 6"><path d="M1 1L5 5L9 1" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </button>
                            <ul class="berita-custom-select-list" role="listbox">
                                <li class="berita-custom-option {{ request('category', 'Semua') === 'Semua' ? 'selected' : '' }}" data-value="Semua" role="option">Semua Kategori</li>
                                @if(isset($kategoris))
                                    @foreach($kategoris as $kat)
                                        <li class="berita-custom-option {{ request('category') === $kat->nama ? 'selected' : '' }}" data-value="{{ $kat->nama }}" role="option">{{ $kat->nama }}</li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </form>

            @if($featuredBerita)
                <!-- Featured Section (Row 1) -->
                <div class="berita-featured-section">
                    <!-- Large Featured Card (Left) -->
                    <div class="berita-featured-left">
                        <a href="{{ route('berita.show', $featuredBerita->slug) }}" class="featured-large-card">
                            <div class="card-image-wrap">
                                @if($featuredBerita->image)
                                    <img src="{{ asset('uploads/berita/' . $featuredBerita->image) }}" alt="{{ $featuredBerita->title }}" class="featured-large-image">
                                @else
                                    <div class="featured-large-image" style="background-color: #004F3B; display: flex; align-items: center; justify-content: center; color: rgba(255,255,255,0.2);">
                                        <span class="material-icons" style="font-size: 72px;">image</span>
                                    </div>
                                @endif
                                @php 
                                    $katF = isset($kategoris) ? $kategoris->firstWhere('nama', $featuredBerita->category) : null; 
                                    $bgF = $katF ? $katF->warna : '#009966';
                                @endphp
                                <span class="berita-badge" @style(['background-color: ' . $bgF, 'color: #fff'])>{{ $featuredBerita->category ?? 'Berita' }}</span>
                            </div>
                            <div class="featured-large-content">
                                <h2 class="featured-large-title">{{ $featuredBerita->title }}</h2>
                            </div>
                        </a>
                    </div>

                    <!-- Two Small Featured Cards (Right) -->
                    <div class="berita-featured-right">
                        @foreach($recentBeritas as $recent)
                            <a href="{{ route('berita.show', $recent->slug) }}" class="featured-small-card">
                                <div class="small-card-image-wrap">
                                    @if($recent->image)
                                        <img src="{{ asset('uploads/berita/' . $recent->image) }}" alt="{{ $recent->title }}">
                                    @else
                                        <div style="background-color: #004F3B; display: flex; align-items: center; justify-content: center; color: rgba(255,255,255,0.2); width: 100%; height: 100%;">
                                            <span class="material-icons" style="font-size: 32px;">image</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="small-card-content">
                                    @php 
                                        $katB = isset($kategoris) ? $kategoris->firstWhere('nama', $recent->category) : null; 
                                        $bgB = $katB ? $katB->warna : '#009966';
                                    @endphp
                                    <span class="berita-badge" @style(['background-color: ' . $bgB, 'color: #fff', 'font-size: 10px', 'padding: 2px 8px', 'display: inline-block', 'border-radius: 4px', 'margin-bottom: 5px'])>{{ $recent->category ?? 'Berita' }}</span>
                                    <span class="small-card-date">{{ $recent->created_at->format('d M Y') }}</span>
                                    <h3 class="small-card-title">{{ $recent->title }}</h3>
                                </div>
                            </a>
                        @endforeach
                        
                        @if($recentBeritas->count() === 0)
                            <div style="display:flex; align-items:center; justify-content:center; height:100%; color:#9CA3AF; border:1px dashed #E5E7EB; border-radius:3px;">
                                <p style="font-size:14px; font-weight:600; text-align:center;">Belum ada berita pendamping rilis.</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- News Grid Section (Row 2 onwards) -->
            <div class="berita-grid-section">
                @forelse ($beritas as $berita)
                    <a href="{{ route('berita.show', $berita->slug) }}" class="berita-grid-card" style="text-decoration: none; color: inherit;">
                        <div class="grid-card-image-wrap">
                            @if($berita->image)
                                <img src="{{ asset('uploads/berita/' . $berita->image) }}" alt="{{ $berita->title }}">
                            @else
                                <div style="background-color: #004F3B; display: flex; align-items: center; justify-content: center; color: rgba(255,255,255,0.2); width: 100%; height: 100%;">
                                    <span class="material-icons" style="font-size: 48px;">image</span>
                                </div>
                            @endif
                        </div>
                        <div class="grid-card-content">
                            @php 
                                $katB = isset($kategoris) ? $kategoris->firstWhere('nama', $berita->category) : null; 
                                $bgB = $katB ? $katB->warna : '#009966';
                            @endphp
                            <span class="berita-badge" @style(['background-color: ' . $bgB, 'color: #fff', 'font-size: 11px', 'padding: 3px 10px', 'display: inline-block', 'border-radius: 4px', 'margin-bottom: 8px'])>{{ $berita->category ?? 'Berita' }}</span>
                            <span class="grid-card-date">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 6px; display: inline-block; vertical-align: middle;">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                    <line x1="16" y1="2" x2="16" y2="6" />
                                    <line x1="8" y1="2" x2="8" y2="6" />
                                    <line x1="3" y1="10" x2="21" y2="10" />
                                </svg>
                                {{ $berita->created_at->format('d M Y') }}
                            </span>
                            <h4 class="grid-card-title">{{ $berita->title }}</h4>
                        </div>
                    </a>
                @empty
                    @if(!$featuredBerita)
                        <div style="grid-column: span 3; text-align: center; padding: 64px 0; color: #9CA3AF; width: 100%;">
                            <span class="material-icons" style="font-size: 64px; margin-bottom: 12px; display: block;">newspaper</span>
                            <p style="font-size: 16px; font-weight: 600;">Belum ada berita yang ditemukan.</p>
                        </div>
                    @endif
                @endforelse
            </div>

            <!-- Pagination -->
            @if($beritas->hasPages())
                <div class="berita-pagination">
                    {{ $beritas->links('vendor.pagination.berita-custom') }}
                </div>
            @endif
        </div>
    </main>
</div>

<script>
(function () {
    function initCustomSelect(dropdownId, hiddenInputId) {
        const wrap = document.getElementById(dropdownId);
        if (!wrap) return;
        const btn = wrap.querySelector('.berita-custom-select-btn');
        const list = wrap.querySelector('.berita-custom-select-list');
        const label = wrap.querySelector('.berita-custom-select-label');
        const hidden = document.getElementById(hiddenInputId);
        const form = wrap.closest('form');

        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            const isOpen = wrap.classList.contains('open');
            document.querySelectorAll('.berita-custom-select').forEach(function (d) {
                d.classList.remove('open');
                d.querySelector('.berita-custom-select-btn').setAttribute('aria-expanded', 'false');
            });
            if (!isOpen) {
                wrap.classList.add('open');
                btn.setAttribute('aria-expanded', 'true');
            }
        });

        list.querySelectorAll('.berita-custom-option').forEach(function (opt) {
            opt.addEventListener('click', function () {
                var val = opt.dataset.value;
                hidden.value = val;
                label.textContent = opt.textContent.trim();
                list.querySelectorAll('.berita-custom-option').forEach(function (o) { o.classList.remove('selected'); });
                opt.classList.add('selected');
                wrap.classList.remove('open');
                btn.setAttribute('aria-expanded', 'false');
                form.submit();
            });
        });
    }

    initCustomSelect('categoryDropdown', 'categoryValue');

    document.addEventListener('click', function () {
        document.querySelectorAll('.berita-custom-select').forEach(function (d) {
            d.classList.remove('open');
            d.querySelector('.berita-custom-select-btn').setAttribute('aria-expanded', 'false');
        });
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.berita-custom-select').forEach(function (d) {
                d.classList.remove('open');
                d.querySelector('.berita-custom-select-btn').setAttribute('aria-expanded', 'false');
            });
        }
    });
})();
</script>
