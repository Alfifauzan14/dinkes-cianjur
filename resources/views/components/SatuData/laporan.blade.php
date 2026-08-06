<link rel="stylesheet" href="{{ asset('css/SatuData/laporan.css') }}?v={{ time() }}">

<div class="laporan-wrapper">
    @php
        $headerSetting = \App\Models\HeaderSetting::getByKey('laporan', 'Laporan Dinkes', 'Transparansi laporan akuntabilitas kinerja, keuangan, dan informasi publik.');
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

    <main class="laporan-main">
        <div class="laporan-container">
            
            <!-- Page Title -->
            <h1 class="laporan-title">Laporan Publik Resmi</h1>

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
                        <div class="card-left">
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
                                <span class="doc-category" style="text-transform: uppercase;">{{ $laporan->category }}</span>
                                <h3 class="doc-title">{{ $laporan->title }}</h3>
                                <span class="doc-meta">{{ $laporan->release_date->format('d M Y') }} • PDF • {{ $laporan->file_size }}</span>
                            </div>
                        </div>
                        <div class="card-right">
                            <a href="{{ route('satudata.laporan.download', $laporan->id) }}" class="download-btn" title="Unduh Dokumen" target="_blank">
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #64748B; background: #fff; border: 1px solid #E2E8F0; border-radius: 3px;">
                        Belum ada dokumen laporan yang diunggah.
                    </div>
                @endforelse
            </div>

            <!-- Footer Action Link Button -->
            <div class="laporan-footer-action">
                <a href="#" class="view-all-btn" id="reset-filter-link">
                    <span>Tampilkan Semua Dokumen</span>
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
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
