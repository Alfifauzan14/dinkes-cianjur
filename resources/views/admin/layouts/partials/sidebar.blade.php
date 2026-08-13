{{-- ============================================================
     ADMIN SIDEBAR PARTIAL
     Included by: resources/views/admin/layouts/admin.blade.php
     ============================================================ --}}
<aside class="main-sidebar elevation-4">
    {{-- Brand Logo --}}
    <a href="{{ route('admin.dashboard') }}" class="brand-link d-flex justify-content-center align-items-center" style="padding: 12px 0;">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Dinkes"
             style="opacity: .95; max-height: 55px; width: auto;">
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

                {{-- ── KONTEN WEBSITE ──────────────────────────────── --}}
                <li class="nav-header">KONTEN WEBSITE</li>

                <li class="nav-item">
                    <a href="{{ route('admin.berita.index') }}"
                       class="nav-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
                        <span class="material-icons nav-icon">newspaper</span>
                        <p>Berita &amp; Info</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.agenda.index') }}"
                       class="nav-link {{ request()->routeIs('admin.agenda.*') ? 'active' : '' }}">
                        <span class="material-icons nav-icon">event</span>
                        <p>Agenda Kegiatan</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.galeri.index') }}"
                       class="nav-link {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">
                        <span class="material-icons nav-icon">collections</span>
                        <p>Galeri Media</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.infografis.index') }}"
                       class="nav-link {{ request()->routeIs('admin.infografis.*') ? 'active' : '' }}">
                        <span class="material-icons nav-icon">bar_chart</span>
                        <p>Infografis Kesehatan</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.home-content.index') }}"
                       class="nav-link {{ request()->routeIs('admin.home-content.*') ? 'active' : '' }}">
                        <span class="material-icons nav-icon">info</span>
                        <p>Konten Halaman Utama</p>
                    </a>
                </li>

                {{-- ── LAYANAN KESEHATAN ───────────────────────────── --}}
                <li class="nav-header">LAYANAN KESEHATAN</li>

                @php
                    $stuntingProg = \App\Models\ProgramKesehatan::where('slug', 'cianjur-bebas-stunting')->first();
                    $kiaProg = \App\Models\ProgramKesehatan::where('slug', 'kesehatan-ibu-anak')->first();
                @endphp
                <li class="nav-item has-treeview {{ request()->routeIs('admin.program-kesehatan.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('admin.program-kesehatan.*') ? 'active' : '' }}">
                        <span class="material-icons nav-icon">health_and_safety</span>
                        <p>
                            Program Kesehatan
                            <i class="right fas fa-angle-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" @style(['display: block' => request()->routeIs('admin.program-kesehatan.*'), 'display: none' => !request()->routeIs('admin.program-kesehatan.*')])>
                        @if($stuntingProg)
                        <li class="nav-item">
                            <a href="{{ route('admin.program-kesehatan.edit', $stuntingProg->id) }}"
                               class="nav-link {{ request()->is('admin/program-kesehatan/' . $stuntingProg->id . '/edit') ? 'active' : '' }}">
                                 <span class="material-icons nav-icon">child_care</span>
                                 <p>Cianjur Bebas Stunting</p>
                            </a>
                        </li>
                        @endif
                        @if($kiaProg)
                        <li class="nav-item">
                            <a href="{{ route('admin.program-kesehatan.edit', $kiaProg->id) }}"
                               class="nav-link {{ request()->is('admin/program-kesehatan/' . $kiaProg->id . '/edit') ? 'active' : '' }}">
                                 <span class="material-icons nav-icon">pregnant_woman</span>
                                 <p>Kesehatan Ibu &amp; Anak (KIA)</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.layanan.index') }}"
                       class="nav-link {{ request()->routeIs('admin.layanan.*') ? 'active' : '' }}">
                        <span class="material-icons nav-icon">widgets</span>
                        <p>Layanan Terpadu</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.labkesda.index') }}"
                       class="nav-link {{ request()->routeIs('admin.labkesda.*') ? 'active' : '' }}">
                        <span class="material-icons nav-icon">science</span>
                        <p>UPTD Labkesda</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.ikm.index') }}"
                       class="nav-link {{ request()->routeIs('admin.ikm.*') ? 'active' : '' }}">
                        <span class="material-icons nav-icon">reviews</span>
                        <p>Indeks Kepuasan (IKM)</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.pagodasehat.index') }}"
                       class="nav-link {{ request()->routeIs('admin.pagodasehat.*') ? 'active' : '' }}">
                        <span class="material-icons nav-icon">medical_services</span>
                        <p>Zonasi Pagoda Sehat</p>
                    </a>
                </li>

                {{-- Kelola Faskes dropdown --}}
                @php $faskesActive = request()->routeIs('admin.faskes.*') || request()->routeIs('admin.jenis-faskes.*') || request()->routeIs('admin.kecamatan.*'); @endphp
                <li class="nav-item has-treeview {{ $faskesActive ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $faskesActive ? 'active' : '' }}">
                        <span class="material-icons nav-icon">location_city</span>
                        <p>Informasi Faskes <i class="right fas fa-angle-right"></i></p>
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

                {{-- ── DATA & REGULASI SATU DATA ───────────────────── --}}
                <li class="nav-header">DATA &amp; REGULASI SATU DATA</li>

                {{-- Data & Statistik --}}
                <li class="nav-item">
                    <a href="{{ route('admin.satudata.statistik.edit') }}"
                       class="nav-link {{ request()->routeIs('admin.satudata.statistik.*') ? 'active' : '' }}">
                        <span class="material-icons nav-icon">bar_chart</span>
                        <p>Statistik Satu Data</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.laporan.index') }}"
                       class="nav-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                        <span class="material-icons nav-icon">description</span>
                        <p>Laporan Kinerja (LAKIP)</p>
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
                        <p>Kelola Akun Pengguna</p>
                    </a>
                </li>
                @endif

                {{-- ── PENGATURAN INSTANSI ─────────────────────────── --}}
                <li class="nav-header">PENGATURAN INSTANSI</li>

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

                {{-- Layanan PPID --}}
                @php $ppidActive = request()->routeIs('admin.ppid.permohonan.*') || request()->routeIs('admin.ppid.keberatan.*'); @endphp
                <li class="nav-item has-treeview {{ $ppidActive ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $ppidActive ? 'active' : '' }}">
                        <span class="material-icons nav-icon">help_outline</span>
                        <p>Layanan PPID <i class="right fas fa-angle-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview pl-3" @style(['display: block' => $ppidActive, 'display: none' => !$ppidActive])>
                        <li class="nav-item">
                            <a href="{{ route('admin.ppid.permohonan.index') }}"
                               class="nav-link {{ request()->routeIs('admin.ppid.permohonan.*') ? 'active' : '' }}">
                                <span class="material-icons nav-icon">assignment</span>
                                <p>Permohonan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.ppid.keberatan.index') }}"
                               class="nav-link {{ request()->routeIs('admin.ppid.keberatan.*') ? 'active' : '' }}">
                                <span class="material-icons nav-icon">report_problem</span>
                                <p>Keberatan</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Pengaturan Footer --}}
                <li class="nav-item">
                    <a href="{{ route('admin.settingfooter.edit') }}"
                       class="nav-link {{ request()->routeIs('admin.settingfooter.*') ? 'active' : '' }}">
                        <span class="material-icons nav-icon">settings</span>
                        <p>Pengaturan Footer</p>
                    </a>
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
