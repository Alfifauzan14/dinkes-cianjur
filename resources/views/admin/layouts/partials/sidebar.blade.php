{{-- ============================================================
     ADMIN SIDEBAR PARTIAL
     Included by: resources/views/admin/layouts/admin.blade.php
     ============================================================ --}}
<aside class="main-sidebar elevation-4">
    {{-- Brand Logo --}}
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Dinkes"
             class="brand-image elevation-3"
             style="opacity:.9; background:#fff; padding:2px; border-radius:3px;">
        <span class="brand-text">Dinkes Cianjur</span>
    </a>

    <div class="sidebar">
        {{-- User Panel --}}
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <span class="material-icons" style="font-size:32px; color:#5EE9B5;">account_circle</span>
            </div>
            <div class="info">
                <a href="{{ route('admin.dashboard') }}" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        {{-- Sidebar Menu --}}
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview" role="menu" data-accordion="true">

                {{-- ── DASHBOARD ──────────────────────────────────── --}}
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                       class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <span class="material-icons nav-icon">dashboard</span>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- ── KONTEN ──────────────────────────────────────── --}}
                <li class="nav-header">KONTEN</li>

                <li class="nav-item">
                    <a href="{{ route('admin.berita.index') }}"
                       class="nav-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
                        <span class="material-icons nav-icon">newspaper</span>
                        <p>Berita</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.agenda.index') }}"
                       class="nav-link {{ request()->routeIs('admin.agenda.*') ? 'active' : '' }}">
                        <span class="material-icons nav-icon">event</span>
                        <p>Agenda</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.galeri.index') }}"
                       class="nav-link {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">
                        <span class="material-icons nav-icon">collections</span>
                        <p>Galeri</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.home-content.index') }}"
                       class="nav-link {{ request()->routeIs('admin.home-content.*') ? 'active' : '' }}">
                        <span class="material-icons nav-icon">info</span>
                        <p>Konten Beranda</p>
                    </a>
                </li>

                {{-- ── LAYANAN ─────────────────────────────────────── --}}
                <li class="nav-header">LAYANAN</li>

                <li class="nav-item">
                    <a href="{{ route('admin.program-kesehatan.index') }}"
                       class="nav-link {{ request()->routeIs('admin.program-kesehatan.*') ? 'active' : '' }}">
                        <span class="material-icons nav-icon">health_and_safety</span>
                        <p>Program Kesehatan</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.layanan.index') }}"
                       class="nav-link {{ request()->routeIs('admin.layanan.*') ? 'active' : '' }}">
                        <span class="material-icons nav-icon">widgets</span>
                        <p>Layanan</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.labkesda.index') }}"
                       class="nav-link {{ request()->routeIs('admin.labkesda.*') ? 'active' : '' }}">
                        <span class="material-icons nav-icon">science</span>
                        <p>Labkesda</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.ikm.index') }}"
                       class="nav-link {{ request()->routeIs('admin.ikm.*') ? 'active' : '' }}">
                        <span class="material-icons nav-icon">reviews</span>
                        <p>Indeks Kepuasan</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.pagodasehat.index') }}"
                       class="nav-link {{ request()->routeIs('admin.pagodasehat.*') ? 'active' : '' }}">
                        <span class="material-icons nav-icon">medical_services</span>
                        <p>Pagoda Sehat</p>
                    </a>
                </li>

                {{-- Kelola Faskes dropdown --}}
                @php $faskesActive = request()->routeIs('admin.faskes.*') || request()->routeIs('admin.jenis-faskes.*') || request()->routeIs('admin.kecamatan.*'); @endphp
                <li class="nav-item has-treeview {{ $faskesActive ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $faskesActive ? 'active' : '' }}">
                        <span class="material-icons nav-icon">location_city</span>
                        <p>Kelola Faskes <i class="right fas fa-angle-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview pl-3">
                        <li class="nav-item">
                            <a href="{{ route('admin.faskes.index') }}"
                               class="nav-link {{ request()->routeIs('admin.faskes.*') ? 'active' : '' }}">
                                <span class="material-icons nav-icon">local_hospital</span>
                                <p>Daftar Faskes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.jenis-faskes.index') }}"
                               class="nav-link {{ request()->routeIs('admin.jenis-faskes.*') ? 'active' : '' }}">
                                <span class="material-icons nav-icon">category</span>
                                <p>Jenis Faskes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.kecamatan.index') }}"
                               class="nav-link {{ request()->routeIs('admin.kecamatan.*') ? 'active' : '' }}">
                                <span class="material-icons nav-icon">explore</span>
                                <p>Kecamatan</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- ── DATA & REGULASI ─────────────────────────────── --}}
                <li class="nav-header">DATA & REGULASI</li>

                {{-- Data & Statistik dropdown --}}
                <li class="nav-item has-treeview {{ request()->routeIs('admin.satudata.statistik.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('admin.satudata.statistik.*') ? 'active' : '' }}">
                        <span class="material-icons nav-icon">bar_chart</span>
                        <p>Data & Statistik <i class="right fas fa-angle-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview pl-3">
                        <li class="nav-item">
                            <a href="{{ route('admin.satudata.statistik.edit', ['section' => 'indikator']) }}"
                               class="nav-link {{ request()->routeIs('admin.satudata.statistik.*') && request('section', 'indikator') === 'indikator' ? 'active' : '' }}">
                                <span class="material-icons nav-icon">show_chart</span>
                                <p>Indikator Utama</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.satudata.statistik.edit', ['section' => 'stunting']) }}"
                               class="nav-link {{ request()->routeIs('admin.satudata.statistik.*') && request('section') === 'stunting' ? 'active' : '' }}">
                                <span class="material-icons nav-icon">trending_down</span>
                                <p>Tren Stunting</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.satudata.statistik.edit', ['section' => 'nakes']) }}"
                               class="nav-link {{ request()->routeIs('admin.satudata.statistik.*') && request('section') === 'nakes' ? 'active' : '' }}">
                                <span class="material-icons nav-icon">people</span>
                                <p>Distribusi Nakes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.satudata.statistik.edit', ['section' => 'sebaran']) }}"
                               class="nav-link {{ request()->routeIs('admin.satudata.statistik.*') && request('section') === 'sebaran' ? 'active' : '' }}">
                                <span class="material-icons nav-icon">explore</span>
                                <p>Sebaran Puskesmas</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.laporan.index') }}"
                       class="nav-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                        <span class="material-icons nav-icon">description</span>
                        <p>Laporan Kinerja</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.regulasi.index') }}"
                       class="nav-link {{ request()->routeIs('admin.regulasi.*') ? 'active' : '' }}">
                        <span class="material-icons nav-icon">gavel</span>
                        <p>Regulasi &amp; Kebijakan</p>
                    </a>
                </li>

                {{-- ── MANAJEMEN PENGGUNA ────────────────────────── --}}
                @if(Auth::user()->is_admin)
                <li class="nav-header">PENGATURAN AKUN</li>

                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}"
                       class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                        <span class="material-icons nav-icon">people</span>
                        <p>Manajemen Pengguna</p>
                    </a>
                </li>
                @endif

                {{-- ── PENGATURAN ───────────────────────────────────── --}}
                <li class="nav-header">PENGATURAN</li>

                <li class="nav-item">
                    <a href="{{ route('admin.kategori.index') }}"
                       class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
                        <span class="material-icons nav-icon">category</span>
                        <p>Kelola Kategori</p>
                    </a>
                </li>

                {{-- Profil Instansi dropdown --}}
                <li class="nav-item has-treeview {{ request()->routeIs('admin.profil.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('admin.profil.*') ? 'active' : '' }}">
                        <span class="material-icons nav-icon">business</span>
                        <p>Profil Instansi <i class="right fas fa-angle-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview pl-3">
                        <li class="nav-item">
                            <a href="{{ route('admin.profil.edit', ['section' => 'sambutan']) }}"
                               class="nav-link {{ request()->routeIs('admin.profil.*') && request('section', 'sambutan') === 'sambutan' ? 'active' : '' }}">
                                <span class="material-icons nav-icon">campaign</span>
                                <p>Sambutan Pimpinan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.profil.edit', ['section' => 'visimisi']) }}"
                               class="nav-link {{ request()->routeIs('admin.profil.*') && request('section') === 'visimisi' ? 'active' : '' }}">
                                <span class="material-icons nav-icon">flag</span>
                                <p>Visi &amp; Misi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.profil.edit', ['section' => 'sejarah']) }}"
                               class="nav-link {{ request()->routeIs('admin.profil.*') && request('section') === 'sejarah' ? 'active' : '' }}">
                                <span class="material-icons nav-icon">history_edu</span>
                                <p>Sejarah Instansi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.profil.edit', ['section' => 'struktur']) }}"
                               class="nav-link {{ request()->routeIs('admin.profil.*') && request('section') === 'struktur' ? 'active' : '' }}">
                                <span class="material-icons nav-icon">account_tree</span>
                                <p>Struktur Organisasi</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Layanan PPID dropdown --}}
                <li class="nav-item has-treeview {{ request()->routeIs('admin.ppid.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('admin.ppid.*') ? 'active' : '' }}">
                        <span class="material-icons nav-icon">help_outline</span>
                        <p>Layanan PPID <i class="right fas fa-angle-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview pl-3">
                        <li class="nav-item">
                            <a href="{{ route('admin.ppid.edit', ['section' => 'informasi']) }}"
                               class="nav-link {{ request()->routeIs('admin.ppid.*') && request('section', 'informasi') === 'informasi' ? 'active' : '' }}">
                                <span class="material-icons nav-icon">toc</span>
                                <p>Informasi Publik</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.ppid.edit', ['section' => 'statistik']) }}"
                               class="nav-link {{ request()->routeIs('admin.ppid.*') && request('section') === 'statistik' ? 'active' : '' }}">
                                <span class="material-icons nav-icon">view_quilt</span>
                                <p>Statistik PPID</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.ppid.edit', ['section' => 'tautan']) }}"
                               class="nav-link {{ request()->routeIs('admin.ppid.*') && request('section') === 'tautan' ? 'active' : '' }}">
                                <span class="material-icons nav-icon">link</span>
                                <p>Tautan Publik</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.ppid.edit', ['section' => 'tatacara']) }}"
                               class="nav-link {{ request()->routeIs('admin.ppid.*') && request('section') === 'tatacara' ? 'active' : '' }}">
                                <span class="material-icons nav-icon">playlist_add_check</span>
                                <p>Tata Cara &amp; Aksi</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Settings dropdown --}}
                @php $settingsActive = request()->routeIs('admin.settingfooter.*') || request()->routeIs('admin.headers.*'); @endphp
                <li class="nav-item has-treeview {{ $settingsActive ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $settingsActive ? 'active' : '' }}">
                        <span class="material-icons nav-icon">settings</span>
                        <p>Settings <i class="right fas fa-angle-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview pl-3">
                        <li class="nav-item">
                            <a href="{{ route('admin.settingfooter.edit', ['section' => 'identitas']) }}"
                               class="nav-link {{ request()->routeIs('admin.settingfooter.*') && request('section', 'identitas') === 'identitas' ? 'active' : '' }}">
                                <span class="material-icons nav-icon">web</span>
                                <p>Identitas Situs</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.settingfooter.edit', ['section' => 'kontak']) }}"
                               class="nav-link {{ request()->routeIs('admin.settingfooter.*') && request('section') === 'kontak' ? 'active' : '' }}">
                                <span class="material-icons nav-icon">contact_phone</span>
                                <p>Informasi Kontak</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.settingfooter.edit', ['section' => 'darurat']) }}"
                               class="nav-link {{ request()->routeIs('admin.settingfooter.*') && request('section') === 'darurat' ? 'active' : '' }}">
                                <span class="material-icons nav-icon">emergency</span>
                                <p>Layanan Darurat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.settingfooter.edit', ['section' => 'sosmed']) }}"
                               class="nav-link {{ request()->routeIs('admin.settingfooter.*') && request('section') === 'sosmed' ? 'active' : '' }}">
                                <span class="material-icons nav-icon">share</span>
                                <p>Media Sosial</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.headers.index') }}"
                               class="nav-link {{ request()->routeIs('admin.headers.*') ? 'active' : '' }}">
                                <span class="material-icons nav-icon">view_carousel</span>
                                <p>Header Halaman</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- ── LOGOUT ───────────────────────────────────────── --}}
                <li class="nav-item mt-1" style="border-top: 1px solid rgba(77,212,164,0.12); padding-top: 6px;">
                    <form action="{{ route('logout') }}" method="POST" id="form-logout-sidebar">
                        @csrf
                        <button type="button" class="nav-logout-btn" onclick="confirmLogout()">
                            <span class="material-icons" style="font-size:18px;">logout</span>
                            <span>Logout</span>
                        </button>
                    </form>
                </li>

            </ul>
        </nav>
    </div>
</aside>
