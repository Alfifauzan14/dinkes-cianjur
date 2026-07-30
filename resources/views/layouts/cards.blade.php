<link rel="stylesheet" href="{{ asset('css/home/cards.css') }}?v={{ time() }}">

<section class="info-cards-section">
    <div class="info-cards-container">

        {{-- Card 1: Peta Sebaran Faskes --}}
        <div class="info-card">
            <div class="info-card-icon icon-green">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 12h6"></path>
                    <path d="M12 9v6"></path>
                    <path d="M3 5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5z"></path>
                    <path d="M9 22v-4h6v4"></path>
                </svg>
            </div>
            <h3 class="info-card-title">Peta Sebaran Faskes</h3>
            <p class="info-card-desc">Temukan lokasi puskesmas & faskes terdekat di Kabupaten Cianjur</p>
        </div>

        {{-- Card 2: Layanan Darurat 119 --}}
        <div class="info-card">
            <div class="info-card-icon icon-red">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                </svg>
            </div>
            <h3 class="info-card-title">Layanan Darurat 119</h3>
            <p class="info-card-desc">Hubungi cepat layanan darurat PSC 119 terdekat di Cianjur selatan</p>
        </div>

        {{-- Card 3: Akses Satu Data --}}
        <div class="info-card">
            <div class="info-card-icon icon-blue">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                    <polyline points="10 9 9 9 8 9"></polyline>
                </svg>
            </div>
            <h3 class="info-card-title">Akses Satu Data</h3>
            <p class="info-card-desc">Unduh profil kesehatan daerah, regulasi & investigasi mendalam</p>
        </div>

    </div>
</section>
