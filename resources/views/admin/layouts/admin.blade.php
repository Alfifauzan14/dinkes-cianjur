<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard Admin') - Dinas Kesehatan Kabupaten Cianjur</title>
    {{-- Google Fonts: Plus Jakarta Sans --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    {{-- Material Icons --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    {{-- Custom Stylesheet --}}
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}?v={{ time() }}">
    @yield('styles')
</head>
<body>

    <div class="dashboard-wrapper">
        <!-- Sidebar -->
        <aside class="dashboard-sidebar">
            <div class="sidebar-brand">
                <img src="{{ asset('Assets/layouts/Nav/logo_dinkes_cropped.png') }}" alt="Logo Dinkes Cianjur" class="brand-logo">
                <span class="brand-name">Portal Admin</span>
            </div>

            <nav class="sidebar-menu">
                <a href="{{ route('admin.dashboard') }}" class="menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="material-icons menu-icon">dashboard</span>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.berita.index') }}" class="menu-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
                    <span class="material-icons menu-icon">newspaper</span>
                    <span>Kelola Berita</span>
                </a>
                <a href="{{ route('admin.agenda.index') }}" class="menu-link {{ request()->routeIs('admin.agenda.*') ? 'active' : '' }}">
                    <span class="material-icons menu-icon">event</span>
                    <span>Kelola Agenda</span>
                </a>
                <a href="{{ route('admin.galeri.index') }}" class="menu-link {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">
                    <span class="material-icons menu-icon">collections</span>
                    <span>Kelola Galeri</span>
                </a>
                <a href="#" class="menu-link">
                    <span class="material-icons menu-icon">medical_services</span>
                    <span>Edit Layanan</span>
                </a>
                <a href="#" class="menu-link">
                    <span class="material-icons menu-icon">description</span>
                    <span>Edit PPID</span>
                </a>
                <a href="{{ route('admin.profil.edit') }}" class="menu-link {{ request()->routeIs('admin.profil.*') ? 'active' : '' }}">
                    <span class="material-icons menu-icon">account_circle</span>
                    <span>Edit Profil</span>
                </a>
                <a href="{{ route('admin.satudata.statistik.edit') }}" class="menu-link {{ request()->routeIs('admin.satudata.statistik.edit') ? 'active' : '' }}">
                    <span class="material-icons menu-icon">bar_chart</span>
                    <span>Edit Statistik</span>
                </a>
                <a href="{{ route('admin.satudata.statistik.import') }}" class="menu-link {{ request()->routeIs('admin.satudata.statistik.import') ? 'active' : '' }}">
                    <span class="material-icons menu-icon">upload_file</span>
                    <span>Import Stunting CSV</span>
                </a>
                <a href="{{ route('admin.laporan.index') }}" class="menu-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                    <span class="material-icons menu-icon">folder</span>
                    <span>Kelola Laporan</span>
                </a>
                <a href="{{ route('admin.regulasi.index') }}" class="menu-link {{ request()->routeIs('admin.regulasi.*') ? 'active' : '' }}">
                    <span class="material-icons menu-icon">gavel</span>
                    <span>Kelola Regulasi</span>
                </a>
                
                <!-- Logout Form -->
                <form action="{{ route('logout') }}" method="POST" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <span class="material-icons menu-icon">logout</span>
                        <span>Logout</span>
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <div class="dashboard-main">
            <!-- Header -->
            <header class="dashboard-header">
                <h1 class="header-title">@yield('header_title', 'Dashboard')</h1>
                <div class="header-user">
                    <span class="material-icons user-avatar">account_circle</span>
                    <div class="user-info">
                        <span class="user-name">{{ Auth::user()->name }}</span>
                        <span class="user-role">Administrator</span>
                    </div>
                </div>
            </header>

            <!-- Content Body -->
            <main class="dashboard-content">
                @yield('content')
            </main>
        </div>
    </div>

    @yield('scripts')
</body>
</html>
