<link rel="stylesheet" href="{{ asset('css/home/cards.css') }}?v={{ time() }}">

<section class="info-cards-section">
    <div class="info-cards-container">

        {{-- Card 1: Peta Sebaran Faskes --}}
        <div class="info-card">
            <div class="info-card-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#009966" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                    <circle cx="12" cy="10" r="3"></circle>
                </svg>
            </div>
            <h3 class="info-card-title">Peta Sebaran Faskes</h3>
            <p class="info-card-desc">Temukan lokasi puskesmas & faskes terdekat di Kabupaten Cianjur.</p>
        </div>

        {{-- Card 2: Layanan Darurat 119 --}}
        <div class="info-card">
            <div class="info-card-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#009966" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                </svg>
            </div>
            <h3 class="info-card-title">Layanan Darurat 119</h3>
            <p class="info-card-desc">Respon cepat tanggap darurat PSC 119 terintegrasi 24 jam penuh.</p>
        </div>

        {{-- Card 3: Akses Satu Data --}}
        <div class="info-card">
            <div class="info-card-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#009966" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                    <polyline points="10 9 9 9 8 9"></polyline>
                </svg>
            </div>
            <h3 class="info-card-title">Akses Satu Data</h3>
            <p class="info-card-desc">Unduh profil kesehatan daerah, regulasi, & transparansi informasi.</p>
        </div>

    </div>
</section>
