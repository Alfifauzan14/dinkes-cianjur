<link rel="stylesheet" href="{{ asset('css/SatuData/regulasi.css') }}?v={{ time() }}">

<div class="regulasi-wrapper">
    @php
        $headerSetting = \App\Models\HeaderSetting::getByKey('regulasi', 'Regulasi & Produk Hukum', 'Himpunan peraturan bupati dan keputusan kepala dinas kesehatan.');
    @endphp
    <!-- Banner Header Top Section -->
    <header class="satudata-banner" style="background: linear-gradient(135deg, #004F3B 0%, #003326 100%); padding: 60px 24px; text-align: left; color: #FFFFFF;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 16px;">
            <h1 style="font-size: 32px; font-weight: 800; margin: 0 0 8px 0; color: #FFFFFF;">{{ $headerSetting->title }}</h1>
            <p style="font-size: 15px; color: rgba(255, 255, 255, 0.85); margin: 0; max-width: 800px;">
                {{ $headerSetting->subtitle }}
            </p>
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
            <div class="regulasi-filter-bar" style="margin-bottom: 24px; display: flex; flex-wrap: wrap; gap: 16px; align-items: center; justify-content: space-between; background: #FFFFFF; padding: 16px 20px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.04);">
                <div style="position: relative; flex: 1; min-width: 260px;">
                    <span class="material-icons" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #6B7280; font-size: 20px;">search</span>
                    <input type="text" id="regulasiSearchInput" placeholder="Cari nomor, judul, atau kata kunci..." style="width: 100%; padding: 10px 14px 10px 40px; border: 1px solid #E5E7EB; border-radius: 8px; font-size: 14px; outline: none; box-sizing: border-box; transition: border-color 0.2s;" onfocus="this.style.borderColor='#009966'" onblur="this.style.borderColor='#E5E7EB'">
                </div>
                <div class="regulasi-topic-pills" style="display: flex; gap: 8px; flex-wrap: wrap;">
                    <button type="button" class="topic-pill-btn active" data-topic="all" style="padding: 8px 16px; border-radius: 9999px; border: 1px solid #009966; background: #009966; color: #FFFFFF; font-size: 13px; font-weight: 600; cursor: pointer;">
                        Semua Topik
                    </button>
                    <button type="button" class="topic-pill-btn" data-topic="STUNTING" style="padding: 8px 16px; border-radius: 9999px; border: 1px solid #E5E7EB; background: #F9FAFB; color: #374151; font-size: 13px; font-weight: 600; cursor: pointer;">
                        Stunting
                    </button>
                    <button type="button" class="topic-pill-btn" data-topic="KIA" style="padding: 8px 16px; border-radius: 9999px; border: 1px solid #E5E7EB; background: #F9FAFB; color: #374151; font-size: 13px; font-weight: 600; cursor: pointer;">
                        KIA
                    </button>
                    <button type="button" class="topic-pill-btn" data-topic="GERMAS" style="padding: 8px 16px; border-radius: 9999px; border: 1px solid #E5E7EB; background: #F9FAFB; color: #374151; font-size: 13px; font-weight: 600; cursor: pointer;">
                        Germas
                    </button>
                    <button type="button" class="topic-pill-btn" data-topic="FASKES" style="padding: 8px 16px; border-radius: 9999px; border: 1px solid #E5E7EB; background: #F9FAFB; color: #374151; font-size: 13px; font-weight: 600; cursor: pointer;">
                        Faskes
                    </button>
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
                                <div class="cover-img-fallback" style="width: 100%; height: 100%; background: linear-gradient(135deg, #004F3B 0%, #009966 100%); display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 20px; text-align: center; color: #FFFFFF; font-weight: 700;">
                                    <span class="material-icons" style="font-size: 40px; margin-bottom: 8px;">gavel</span>
                                    <span style="font-size: 14px; text-transform: uppercase; letter-spacing: 0.05em;">{{ $regulasi->category }}</span>
                                </div>
                            @endif
                            <span class="cover-tag" style="text-transform: uppercase;">{{ $regulasi->topic }}</span>
                        </div>
                        <div class="regulasi-card-content">
                            <div class="meta-row">
                                <span class="meta-category" style="text-transform: uppercase;">{{ $regulasi->category }}</span>
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
                                <a href="{{ route('satudata.regulasi.download', $regulasi->id) }}" class="action-btn download-btn" target="_blank">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="7 10 12 15 17 10"></polyline>
                                        <line x1="12" y1="15" x2="12" y2="3"></line>
                                    </svg>
                                    <span>Unduh PDF</span>
                                </a>
                                <a href="{{ route('satudata.regulasi.view', $regulasi->id) }}" class="action-btn preview-btn" target="_blank">
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

