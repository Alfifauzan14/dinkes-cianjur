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
                        <li><a href="{{ route('profil.tentang') }}#struktur-organisasi" class="dropdown-item">Struktur Organisasi & Pejabat</a></li>
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
                        <li><a href="{{ route('stunting') }}" class="dropdown-item">Cianjur Bebas Stunting</a></li>
                        <li><a href="{{ route('kia') }}" class="dropdown-item">Kesehatan Ibu & Anak (KIA)</a></li>
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
                        <li><a href="{{ url('/layanan-terpadu') }}" class="dropdown-item">Layanan Terpadu</a></li>
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
                        <li><a href="{{ url('/labkesda') }}" class="dropdown-item">Laboratorium Kesehatan Daerah (Labkesda)</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="menu-item {{ Request::is('satu-data*') ? 'active' : '' }}">
                        Satu Data
                        <svg class="chevron-icon" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 1L5 5L9 1" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('satudata.statistik') }}" class="dropdown-item">Dashboard Statistik</a></li>
                        <li><a href="{{ route('satudata.laporan') }}" class="dropdown-item">Unduh Profil Kesehatan PDF</a></li>
                        <li><a href="{{ route('satudata.regulasi') }}" class="dropdown-item">Regulasi & Hukum</a></li>
                    </ul>
                </li>

                <li><a href="{{ route('ppid') }}" class="menu-item {{ Request::is('ppid') ? 'active' : '' }}">PPID</a></li>
            </ul>

            <button class="mobile-toggle" aria-label="Toggle navigation">
                <span class="material-icons">menu</span>
            </button>
        </div>
    </nav>
</div>