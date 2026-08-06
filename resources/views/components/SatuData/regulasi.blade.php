<link rel="stylesheet" href="{{ asset('css/SatuData/regulasi.css') }}?v={{ time() }}">

<div class="regulasi-wrapper">
    @php
        $headerSetting = \App\Models\HeaderSetting::getByKey('regulasi', 'Regulasi & Produk Hukum', 'Himpunan peraturan bupati dan keputusan kepala dinas kesehatan.');
    @endphp
    <!-- Banner Header Top Section -->
    <header class="satudata-banner">
        <div class="satudata-banner-container">
            <h1 class="satudata-banner-title">{{ $headerSetting->title }}</h1>
            <p class="satudata-banner-subtitle">{{ $headerSetting->subtitle }}</p>
        </div>
    </header>

    <main class="regulasi-main">
        <div class="regulasi-container">
            
            <!-- Page Header Area -->
            <div class="regulasi-header">
                <div class="regulasi-header-left">
                    <span class="regulasi-category-tag">Dokumen Hukum Resmi</span>
                    <h1 class="regulasi-title">Regulasi & Produk Hukum Kesehatan</h1>
                </div>
                <div class="regulasi-header-right">
                    <span class="regulasi-header-subtitle">Landasan hukum & aturan dinas resmi</span>
                </div>
            </div>

            <!-- Live Search & Filter Bar -->
            <div class="regulasi-filter-bar">
                <div class="regulasi-search-wrapper">
                    <span class="material-icons regulasi-search-icon">search</span>
                    <input type="text" id="regulasiSearchInput" class="regulasi-search-input" placeholder="Cari nomor, judul, atau kata kunci...">
                </div>
                <div class="regulasi-topic-pills">
                    <button type="button" class="topic-pill-btn active" data-topic="all">Semua Topik</button>
                    <button type="button" class="topic-pill-btn" data-topic="STUNTING">Stunting</button>
                    <button type="button" class="topic-pill-btn" data-topic="KIA">KIA</button>
                    <button type="button" class="topic-pill-btn" data-topic="GERMAS">Germas</button>
                    <button type="button" class="topic-pill-btn" data-topic="FASKES">Faskes</button>
                </div>
            </div>

            <!-- Regulasi Grid List -->
            <div class="regulasi-grid">
                @forelse($regulasis as $regulasi)
                    <!-- Card -->
                    <div class="regulasi-card" data-topic="{{ strtoupper($regulasi->topic) }}">
                        <div class="regulasi-card-cover">
                            @if($regulasi->cover_path)
                                <img src="{{ asset('storage/' . $regulasi->cover_path) }}" alt="Cover {{ $regulasi->title }}" class="cover-img">
                            @else
                                <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #004F3B 0%, #009966 100%); display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 20px; text-align: center; color: #FFFFFF; font-weight: 700;">
                                    <span class="material-icons" style="font-size: 40px; margin-bottom: 8px;">gavel</span>
                                    <span style="font-size: 13px; text-transform: uppercase; letter-spacing: 0.05em;">{{ $regulasi->category }}</span>
                                </div>
                            @endif
                            <span class="cover-tag">{{ $regulasi->topic }}</span>
                        </div>
                        <div class="regulasi-card-content">
                            <div class="meta-row">
                            <span class="meta-category">{{ $regulasi->category }}</span>
                                <span class="meta-year">{{ $regulasi->year }}</span>
                            </div>
                            <h3 class="regulasi-card-title">{{ $regulasi->title }}</h3>
                            <p class="regulasi-card-desc">
                                {{ $regulasi->description }}
                            </p>
                            
                            <div class="info-row">
                                <div class="info-file">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                    <span>PDF • {{ $regulasi->file_size }}</span>
                                </div>
                                <div class="info-status">
                                    @if($regulasi->status === 'Berlaku')
                                        <span class="status-dot" style="background-color: #00BC7D;"></span>
                                        <span>Status: Berlaku</span>
                                    @else
                                        <span class="status-dot" style="background-color: #EF4444;"></span>
                                        <span>Status: Tidak Berlaku</span>
                                    @endif
                                </div>
                            </div>

                            <div class="action-row">
                                <a href="{{ asset('storage/' . $regulasi->file_path) }}" class="action-btn download-btn" target="_blank">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="7 10 12 15 17 10"></polyline>
                                        <line x1="12" y1="15" x2="12" y2="3"></line>
                                    </svg>
                                    <span>Unduh PDF</span>
                                </a>
                                <a href="{{ asset('storage/' . $regulasi->file_path) }}" class="action-btn preview-btn" target="_blank">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                    <span>Pratinjau</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #64748B; background: #fff; border: 1px solid #E2E8F0; border-radius: 3px;">
                        Belum ada dokumen regulasi atau hukum yang diunggah.
                    </div>
                @endforelse
            </div>

            <!-- Pagination Section -->
            @if($regulasis->hasPages())
                <div class="regulasi-pagination">
                    {{-- Previous Page Link --}}
                    @if($regulasis->onFirstPage())
                        <span class="page-link icon-link disabled" style="opacity: 0.5; pointer-events: none;">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="15 18 9 12 15 6"></polyline>
                            </svg>
                        </span>
                    @else
                        <a href="{{ $regulasis->previousPageUrl() }}" class="page-link icon-link" title="Halaman Sebelumnya">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="15 18 9 12 15 6"></polyline>
                            </svg>
                        </a>
                    @endif

                    {{-- Page Numbers --}}
                    @foreach($regulasis->getUrlRange(1, $regulasis->lastPage()) as $page => $url)
                        @if($page == $regulasis->currentPage())
                            <span class="page-link active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if($regulasis->hasMorePages())
                        <a href="{{ $regulasis->nextPageUrl() }}" class="page-link icon-link" title="Halaman Selanjutnya">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </a>
                    @else
                        <span class="page-link icon-link disabled" style="opacity: 0.5; pointer-events: none;">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </span>
                    @endif
                </div>
            @endif

        </div>
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('regulasiSearchInput');
    const topicBtns = document.querySelectorAll('.topic-pill-btn');
    const regulasiCards = document.querySelectorAll('.regulasi-card');

    let activeTopic = 'all';

    function filterRegulasi() {
        const query = searchInput ? searchInput.value.toLowerCase().trim() : '';

        regulasiCards.forEach(card => {
            const topic = card.getAttribute('data-topic') || '';
            const text = card.textContent.toLowerCase();

            const matchesTopic = (activeTopic === 'all') || (topic.includes(activeTopic));
            const matchesQuery = query === '' || text.includes(query);

            if (matchesTopic && matchesQuery) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }

    if (searchInput) {
        searchInput.addEventListener('input', filterRegulasi);
    }

    topicBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            topicBtns.forEach(b => {
                b.classList.remove('active');
                b.style.background = '#F9FAFB';
                b.style.color = '#374151';
                b.style.borderColor = '#E5E7EB';
            });

            this.classList.add('active');
            this.style.background = '#009966';
            this.style.color = '#FFFFFF';
            this.style.borderColor = '#009966';

            activeTopic = this.getAttribute('data-topic');
            filterRegulasi();
        });
    });
});
</script>

