<link rel="stylesheet" href="{{ asset('css/home/berita.css') }}?v={{ time() }}">

<section class="berita-section">
    <div class="berita-inner">
    <div class="berita-header">
        <p class="berita-category">Kabar Sehat</p>
        <div class="berita-header-main">
            <h2 class="berita-title">Kabar Sehat Cianjur</h2>
            <a href="#" class="berita-more-link">
                Lihat Semua Berita
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 5L19 12L12 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
    </div>

    <div class="berita-container">
        <!-- Row 1: Landscape Cards -->
        <div class="berita-row-landscape">
            <!-- Card 1 -->
            <a href="#" class="berita-card landscape">
                <img src="{{ asset('images/dumy1.png') }}" alt="Gerakan Aktifkan Posyandu" class="berita-card-image" loading="lazy">
                <div class="berita-card-overlay"></div>
                <div class="berita-card-content">
                    <span class="berita-card-date">15 Juli 2026</span>
                    <h3 class="berita-card-title">Gerakan Aktifkan Posyandu dalam kegiatan Rembug Warga</h3>
                </div>
            </a>

            <!-- Card 2 -->
            <a href="#" class="berita-card landscape">
                <img src="{{ asset('images/dumy1.png') }}" alt="Prosedur menghubungi Ambulans PSC 119" class="berita-card-image" loading="lazy">
                <div class="berita-card-overlay"></div>
                <div class="berita-card-content">
                    <span class="berita-card-date">15 Juli 2026</span>
                    <h3 class="berita-card-title">Prosedur menghubungi Ambulans PSC 119 di Wilayah Kabupaten Cianjur</h3>
                </div>
            </a>
        </div>

        <!-- Row 2: Square Cards -->
        <div class="berita-row-square">
            <!-- Card 3 -->
            <a href="#" class="berita-card square">
                <img src="{{ asset('images/dumy2.png') }}" alt="Komitmen layanan kesehatan" class="berita-card-image" loading="lazy">
                <div class="berita-card-overlay"></div>
                <div class="berita-card-content">
                    <span class="berita-card-date">15 Juli 2026</span>
                    <h3 class="berita-card-title">Cianjur berkomitmen dalam menghadirkan layanan Kesehatan</h3>
                </div>
            </a>

            <!-- Card 4 -->
            <a href="#" class="berita-card square">
                <img src="{{ asset('images/dumy2.png') }}" alt="Puncak Acara HKN" class="berita-card-image" loading="lazy">
                <div class="berita-card-overlay"></div>
                <div class="berita-card-content">
                    <span class="berita-card-date">15 Juli 2026</span>
                    <h3 class="berita-card-title">Dinkes Cianjur Puncak Acara HKN dan Rembug Warga</h3>
                </div>
            </a>

            <!-- Card 5 -->
            <a href="#" class="berita-card square">
                <img src="{{ asset('images/dumy2.png') }}" alt="Gerakan AKSI BERGIZI NASIONAL" class="berita-card-image" loading="lazy">
                <div class="berita-card-overlay"></div>
                <div class="berita-card-content">
                    <span class="berita-card-date">15 Juli 2026</span>
                    <h3 class="berita-card-title">Gerakan AKSI BERGIZI NASIONAL di SMKN 1 Cianjur</h3>
                </div>
            </a>

            <!-- Card 6 -->
            <a href="#" class="berita-card square">
                <img src="{{ asset('images/dumy2.png') }}" alt="Peringatan Hari Kesehatan Jiwa" class="berita-card-image" loading="lazy">
                <div class="berita-card-overlay"></div>
                <div class="berita-card-content">
                    <span class="berita-card-date">15 Juli 2026</span>
                    <h3 class="berita-card-title">Peringatan Hari Kesehatan Jiwa Sedunia 2025</h3>
                </div>
            </a>
        </div>
    </div>
    </div>
</section>
