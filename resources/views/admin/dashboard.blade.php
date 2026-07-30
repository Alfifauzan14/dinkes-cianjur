<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin - Dinas Kesehatan Kabupaten Cianjur</title>
    {{-- Google Fonts: Plus Jakarta Sans --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    {{-- Material Icons --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    {{-- Custom Stylesheet --}}
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}?v={{ time() }}">
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
                <a href="{{ route('admin.dashboard') }}" class="menu-link active">
                    <span class="material-icons menu-icon">dashboard</span>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="menu-link">
                    <span class="material-icons menu-icon">medical_services</span>
                    <span>Edit Layanan</span>
                </a>
                <a href="#" class="menu-link">
                    <span class="material-icons menu-icon">description</span>
                    <span>Edit PPID</span>
                </a>
                <a href="#" class="menu-link">
                    <span class="material-icons menu-icon">account_circle</span>
                    <span>Edit Profil</span>
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
                <h1 class="header-title">Dashboard</h1>
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
                <div class="welcome-banner">
                    <h2 class="welcome-title">Selamat Datang, {{ Auth::user()->name }}!</h2>
                    <p class="welcome-desc">Di portal ini, Anda dapat mengelola semua komponen landing page, layanan kesehatan, data PPID, dan informasi profil Dinas Kesehatan Kabupaten Cianjur.</p>
                </div>

                <!-- Stats Grid (cohesive style with stats before) -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon-wrapper">
                            <span class="material-icons stat-icon">medical_services</span>
                        </div>
                        <div class="stat-data">
                            <span class="stat-number">16</span>
                            <span class="stat-label">Total Layanan Terpadu</span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon-wrapper">
                            <span class="material-icons stat-icon">folder_open</span>
                        </div>
                        <div class="stat-data">
                            <span class="stat-number">38</span>
                            <span class="stat-label">Dokumen PPID Publik</span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon-wrapper">
                            <span class="material-icons stat-icon">people</span>
                        </div>
                        <div class="stat-data">
                            <span class="stat-number">142</span>
                            <span class="stat-label">Permohonan Informasi</span>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

</body>
</html>
