<link rel="stylesheet" href="{{ asset('css/home/hero.css') }}?v={{ time() }}">

<section class="hero-section">
    <div class="hero-overlay"></div>

    <div class="hero-container">
        <div class="emergency-bubble-wrapper">
        <div class="emergency-bubble">
                <div class="emergency-bubble-content">
                    <span class="emergency-label">Kontak darurat</span>
                    <span class="emergency-number">119</span>
                </div>
                <div class="emergency-close-badge">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L11 11M1 11L11 1" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="hero-content">
            <h3 class="hero-subtitle">PORTAL RESMI DINAS KESEHATAN KABUPATEN CIANJUR</h3>
            <h1 class="hero-title">Mewujudkan Cianjur Sehat Mandiri</h1>
            
            <div class="search-container">
                <div class="search-icon-wrapper">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#D1D1D1" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </div>
                <input type="text" class="search-input" placeholder="Cari Berita dan Informasi ...">
                <button class="search-button">Cari</button>
            </div>
        </div>
    </div>

    <div class="social-sidebar">
        <a href="#" class="social-icon-link">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
            </svg>
        </a>
        <a href="#" class="social-icon-link">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"/>
            </svg>
        </a>
        <a href="#" class="social-icon-link">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
            </svg>
        </a>
        <a href="#" class="social-icon-link">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 0 0-1.95 1.96A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33 2.78 2.78 0 0 0 1.95 1.96C5.12 19.5 12 19.5 12 19.5s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.96 29 29 0 0 0 .46-5.33 29 29 0 0 0-.46-5.33z"/>
                <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"/>
            </svg>
        </a>
    </div>

    <!-- Dekorasi bawah: ellipse image assets -->
    <div class="decorative-bottom-rings">
        <img src="{{ asset('Assets/home/hero/Ellipse 9.png') }}" alt="" class="dec-ellipse dec-ellipse-1">
        <img src="{{ asset('Assets/home/hero/Ellipse 10.png') }}" alt="" class="dec-ellipse dec-ellipse-2">
        <img src="{{ asset('Assets/home/hero/Ellipse 11.png') }}" alt="" class="dec-ellipse dec-ellipse-3">
    </div>

</section>
