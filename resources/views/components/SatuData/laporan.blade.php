<link rel="stylesheet" href="{{ asset('css/SatuData/laporan.css') }}?v={{ time() }}">

<div class="laporan-wrapper">
    <!-- Banner Header Top Section -->
    <header class="satudata-banner">
        <div class="satudata-banner-container">
            <h1 class="satudata-banner-title">Laporan Dinkes</h1>
            <p class="satudata-banner-subtitle">Transparansi laporan akuntabilitas kinerja, keuangan, dan informasi publik.</p>
        </div>
    </header>

    <main class="laporan-main">
        <div class="laporan-container">

            <!-- Page Subheader -->
            <div class="laporan-page-header">
                <span class="laporan-category-tag">Satu Data Kesehatan</span>
                <h2 class="laporan-title">Laporan Publik Resmi</h2>
            </div>

            <!-- Filter Tabs -->
            <div class="laporan-tabs">
                <button class="tab-btn active">Semua</button>
                <button class="tab-btn">Laporan Kinerja</button>
                <button class="tab-btn">Laporan Keuangan</button>
                <button class="tab-btn">Informasi Publik</button>
            </div>

            <!-- Laporan Grid List -->
            <div class="laporan-grid">
                @forelse($laporans as $laporan)
                    <div class="laporan-card" data-category="{{ $laporan->category }}">
                        <div class="card-body">
                            <div class="doc-icon-wrapper">
                                <svg class="doc-svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                            </div>
                            <div class="doc-info">
                                <span class="doc-category">{{ $laporan->category }}</span>
                                <h3 class="doc-title">{{ $laporan->title }}</h3>
                                <span class="doc-meta">{{ $laporan->release_date->format('d M Y') }} • PDF • {{ $laporan->file_size }}</span>
                            </div>
                        </div>
                        <div class="laporan-action-row">
                            <a href="{{ asset('storage/' . $laporan->file_path) }}" class="laporan-preview-btn" target="_blank" title="Buka di Tab Baru">
                                <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                <span>Pratinjau</span>
                            </a>
                            <a href="{{ asset('storage/' . $laporan->file_path) }}" class="laporan-download-btn" download title="Unduh Dokumen">
                                <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                <span>Unduh PDF</span>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="laporan-empty-state">
                        Belum ada dokumen laporan yang diunggah.
                    </div>
                @endforelse
            </div>


            
        </div>
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.laporan-tabs .tab-btn');
    const cards = document.querySelectorAll('.laporan-grid .laporan-card');
    const resetLink = document.getElementById('reset-filter-link');

    function filterCategory(categoryName) {
        tabs.forEach(t => {
            if (t.textContent.trim() === categoryName) {
                t.classList.add('active');
            } else {
                t.classList.remove('active');
            }
        });

        cards.forEach(card => {
            const cardCategory = card.getAttribute('data-category');
            if (categoryName === 'Semua' || cardCategory === categoryName) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            filterCategory(this.textContent.trim());
        });
    });

    if (resetLink) {
        resetLink.addEventListener('click', function(e) {
            e.preventDefault();
            filterCategory('Semua');
        });
    }
});
</script>
