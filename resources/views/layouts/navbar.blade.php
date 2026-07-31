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
                        <span class="material-icons chevron-icon">expand_more</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('profil.tentang') }}" class="dropdown-item">Tentang Dinkes</a></li>
                        <li><a href="#" class="dropdown-item">Struktur Organisasi & Pejabat</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="menu-item">
                        Program Kesehatan
                        <span class="material-icons chevron-icon">expand_more</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#" class="dropdown-item">Cianjur Bebas Stunting</a></li>
                        <li><a href="#" class="dropdown-item">Kesehatan Ibu & Anak (KIA)</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="menu-item">
                        program Terpadu
                        <span class="material-icons chevron-icon">expand_more</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#" class="dropdown-item">Untuk Warga</a></li>
                        <li><a href="#" class="dropdown-item">Untuk Faskes & Nakes</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="menu-item">
                        Fasilitas Kesehatan
                        <span class="material-icons chevron-icon">expand_more</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#" class="dropdown-item">Peta & Daftar Puskesmas</a></li>
                        <li><a href="#" class="dropdown-item">Rumah Sakit Rujukan</a></li>
                        <li><a href="#" class="dropdown-item">Laboratorium Kesehatan Daerah (Labkesda)</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="menu-item {{ Request::is('satu-data*') ? 'active' : '' }}">
                        Satu Data
                        <span class="material-icons chevron-icon">expand_more</span>
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
