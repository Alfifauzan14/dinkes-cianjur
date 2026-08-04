<link rel="stylesheet" href="{{ asset('css/layouts/navbar.css') }}?v={{ time() }}">

<div class="dinkes-navbar-wrapper">
    <nav class="dinkes-navbar {{ Request::is('/') ? '' : 'navbar-white' }}">
        <div class="dinkes-navbar-container">
            <div class="navbar-brand">
                <img src="{{ asset('Assets/layouts/Nav/logo_pemkab_cropped.png') }}" alt="Logo Pemerintah Kabupaten Cianjur" class="logo-pemkab">
                <img src="{{ isset($site_settings) && $site_settings->site_logo ? asset('uploads/settings/' . $site_settings->site_logo) : asset('Assets/layouts/Nav/logo_dinkes_cropped.png') }}" alt="Logo Dinas Kesehatan Kabupaten Cianjur" class="logo-dinkes">
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
                        <li><a href="{{ route('profil.tentang') }}" class="dropdown-item" style="display: flex; align-items: center; gap: 8px;"><span class="material-icons" style="font-size: 18px; color: #009966;">info</span><span>Tentang Dinkes</span></a></li>
                        <li><a href="{{ route('profil.visi-misi') }}" class="dropdown-item" style="display: flex; align-items: center; gap: 8px;"><span class="material-icons" style="font-size: 18px; color: #009966;">flag</span><span>Visi & Misi</span></a></li>
                        <li><a href="{{ route('profil.struktur-organisasi') }}" class="dropdown-item" style="display: flex; align-items: center; gap: 8px;"><span class="material-icons" style="font-size: 18px; color: #009966;">account_tree</span><span>Struktur Organisasi & Pejabat</span></a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="menu-item {{ Request::is('program/*') ? 'active' : '' }}">
                        Program Kesehatan
                        <svg class="chevron-icon" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 1L5 5L9 1" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                    <ul class="dropdown-menu">
                        @foreach(\App\Models\ProgramKesehatan::where('status', 'published')->get() as $prog)
                            <li><a href="{{ route('program.show', $prog->slug) }}" class="dropdown-item" style="display: flex; align-items: center; gap: 8px;"><span class="material-icons" style="font-size: 18px; color: #009966;">health_and_safety</span><span>{{ $prog->title }}</span></a></li>
                        @endforeach
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="menu-item">
                        Program Terpadu
                        <svg class="chevron-icon" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 1L5 5L9 1" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/layanan-terpadu') }}" class="dropdown-item" style="display: flex; align-items: center; gap: 8px;"><span class="material-icons" style="font-size: 18px; color: #009966;">widgets</span><span>Layanan Terpadu</span></a></li>
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
                        <li><a href="{{ route('faskes') }}" class="dropdown-item" style="display: flex; align-items: center; gap: 8px;"><span class="material-icons" style="font-size: 18px; color: #009966;">local_hospital</span><span>Info Puskesmas & Rumah Sakit</span></a></li>
                        <li><a href="{{ url('/labkesda') }}" class="dropdown-item" style="display: flex; align-items: center; gap: 8px;"><span class="material-icons" style="font-size: 18px; color: #009966;">biotech</span><span>Laboratorium Kesehatan Daerah (Labkesda)</span></a></li>
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
                        <li><a href="{{ route('satudata.statistik') }}" class="dropdown-item" style="display: flex; align-items: center; gap: 8px;"><span class="material-icons" style="font-size: 18px; color: #009966;">bar_chart</span><span>Dashboard Statistik</span></a></li>
                        <li><a href="{{ route('satudata.laporan') }}" class="dropdown-item" style="display: flex; align-items: center; gap: 8px;"><span class="material-icons" style="font-size: 18px; color: #009966;">description</span><span>Unduh Profil Kesehatan PDF</span></a></li>
                        <li><a href="{{ route('satudata.regulasi') }}" class="dropdown-item" style="display: flex; align-items: center; gap: 8px;"><span class="material-icons" style="font-size: 18px; color: #009966;">gavel</span><span>Regulasi & Hukum</span></a></li>
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