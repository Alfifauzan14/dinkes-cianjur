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
                    <span class="material-icons" style="font-size: 14px; font-weight: bold; color: inherit; display: block; line-height: 12px;">close</span>
                </div>
            </div>
        </div>

        <div class="hero-content">
            <h3 class="hero-subtitle">PORTAL RESMI DINAS KESEHATAN KABUPATEN CIANJUR</h3>
            <h1 class="hero-title">Mewujudkan Cianjur Sehat Mandiri</h1>
            
            <div class="search-container">
                <div class="search-icon-wrapper">
                    <span class="material-icons" style="font-size: 20px; color: #D1D1D1; display: block;">search</span>
                </div>
                <input type="text" class="search-input" placeholder="Cari Berita dan Informasi ...">
                <button class="search-button">Cari</button>
            </div>
        </div>
    </div>

    <div class="social-sidebar">
        @foreach(($socialLinks ?? collect()) as $link)
            @if($link->url)
                <a href="{{ $link->url }}" class="social-icon-link" aria-label="{{ ucfirst($link->platform) }}" target="_blank" rel="noopener">
                    <i class="fa-brands fa-{{ $link->platform === 'facebook' ? 'facebook-f' : $link->platform }}" style="font-size: 20px;"></i>
                </a>
            @endif
        @endforeach
    </div>

    <!-- Dekorasi bawah: ellipse image assets -->
    <div class="decorative-bottom-rings">
        <img src="{{ asset('Assets/home/hero/Ellipse 9.png') }}" alt="" class="dec-ellipse dec-ellipse-1">
        <img src="{{ asset('Assets/home/hero/Ellipse 10.png') }}" alt="" class="dec-ellipse dec-ellipse-2">
        <img src="{{ asset('Assets/home/hero/Ellipse 11.png') }}" alt="" class="dec-ellipse dec-ellipse-3">
    </div>

</section>
