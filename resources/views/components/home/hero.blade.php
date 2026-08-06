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
                    <span class="material-icons hero-close-icon">close</span>
                </div>
            </div>
        </div>

        <div class="hero-content">
            <h3 class="hero-subtitle">PORTAL RESMI DINAS KESEHATAN KABUPATEN CIANJUR</h3>
            <h1 class="hero-title">Mewujudkan Cianjur Sehat Mandiri</h1>
            
            <div class="search-container">
                <div class="search-icon-wrapper">
                    <span class="material-icons hero-search-icon">search</span>
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
                    <i class="fa-brands fa-{{ $link->platform === 'facebook' ? 'facebook-f' : $link->platform }} hero-social-icon"></i>
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

<script>
    document.querySelector('.emergency-close-badge')?.addEventListener('click', function () {
        this.closest('.emergency-bubble-wrapper').style.display = 'none';
    });

    document.querySelector('.search-button')?.addEventListener('click', function () {
        var q = document.querySelector('.search-input')?.value.trim();
        if (q) window.location.href = '{{ url("/berita") }}?search=' + encodeURIComponent(q);
    });

    document.querySelector('.search-input')?.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            var q = this.value.trim();
            if (q) window.location.href = '{{ url("/berita") }}?search=' + encodeURIComponent(q);
        }
    });
</script>
