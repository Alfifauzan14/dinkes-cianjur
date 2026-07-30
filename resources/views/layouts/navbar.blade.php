<link rel="stylesheet" href="{{ asset('css/layouts/navbar.css') }}?v={{ time() }}">

<div class="dinkes-navbar-wrapper">
    <nav class="dinkes-navbar {{ Request::is('/') ? '' : 'navbar-white' }}">
        <div class="dinkes-navbar-container">
            <div class="navbar-brand">
                <img src="{{ asset('Assets/layouts/Nav/logo_pemkab_cropped.png') }}" alt="Logo Pemerintah Kabupaten Cianjur" class="logo-pemkab">
                <img src="{{ asset('Assets/layouts/Nav/logo_dinkes_cropped.png') }}" alt="Logo Dinas Kesehatan Kabupaten Cianjur" class="logo-dinkes">
            </div>

            <ul class="navbar-menu">
                <li><a href="/" class="menu-item {{ Request::is('/') ? 'active' : '' }}">Beranda</a></li>

                <li class="dropdown">
                    <a href="#" class="menu-item {{ Request::is('profil/*') ? 'active' : '' }}">
                        Profil
                        <svg class="chevron-icon" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 1L5 5L9 1" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('profil.tentang') }}" class="dropdown-item">Tentang Dinkes</a></li>
                        <li><a href="#" class="dropdown-item">Struktur Organisasi & Pejabat</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="menu-item">
                        Program Kesehatan
                        <svg class="chevron-icon" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 1L5 5L9 1" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#" class="dropdown-item">Cianjur Bebas Stunting</a></li>
                        <li><a href="#" class="dropdown-item">Kesehatan Ibu & Anak (KIA)</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="menu-item">
                        program Terpadu
                        <svg class="chevron-icon" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 1L5 5L9 1" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#" class="dropdown-item">Untuk Warga</a></li>
                        <li><a href="#" class="dropdown-item">Untuk Faskes & Nakes</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="menu-item">
                        Fasilitas Kesehatan
                        <svg class="chevron-icon" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 1L5 5L9 1" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('faskes') }}" class="dropdown-item">Info Puskesmas & Rumah Sakit</a></li>
                        <li><a href="#" class="dropdown-item">Laboratorium Kesehatan Daerah (Labkesda)</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="menu-item">
                        Satu Data
                        <svg class="chevron-icon" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 1L5 5L9 1" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#" class="dropdown-item">Dashboard Statistik</a></li>
                        <li><a href="#" class="dropdown-item">Unduh Profil Kesehatan PDF</a></li>
                        <li><a href="#" class="dropdown-item">Regulasi & Hukum</a></li>
                    </ul>
                </li>

                <li><a href="{{ route('ppid') }}" class="menu-item {{ Request::is('ppid') ? 'active' : '' }}">PPID</a></li>
            </ul>

            <button class="mobile-toggle" aria-label="Toggle navigation">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
        </div>
    </nav>
</div>