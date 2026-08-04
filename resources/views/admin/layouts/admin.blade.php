<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard Admin') - Dinas Kesehatan Kabupaten Cianjur</title>

    {{-- Google Fonts: Plus Jakarta Sans --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Google Material Icons --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    {{-- Local FontAwesome Free Offline Asset --}}
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/fontawesome-free/css/all.min.css') }}">

    {{-- SweetAlert2 (offline) --}}
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/sweetalert2/sweetalert2.min.css') }}">

    {{-- Local AdminLTE 3 CSS --}}
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/adminlte.min.css') }}">

    <style>
        /* ==============================================
           CSS VARIABLES
        ============================================== */
        :root {
            --sidebar-bg: #1A3D35;
            --sidebar-brand: #122E28;
            --sidebar-accent: #4DD4A4;
            --sidebar-accent-dim: rgba(77, 212, 164, 0.15);
            --sidebar-text: rgba(255,255,255,0.72);
            --sidebar-text-muted: rgba(255,255,255,0.38);
            --card-bg: #ffffff;
            --card-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 4px 20px rgba(0,0,0,0.04);
            --border-subtle: #E8EEF3;
            --content-bg: #F4F7FA;
            --brand-green: #009966;
            --brand-green-dark: #007A52;
            --text-primary: #1E293B;
            --text-secondary: #64748B;
            --input-focus-ring: 0 0 0 3px rgba(0,153,102,0.14);
        }
        /* =============================================
           GLOBAL FONT
        ============================================= */
        /* ==============================================
           GLOBAL FONT & BASE
        ============================================== */
        body, .main-sidebar, .content-wrapper, .main-header, .main-footer,
        .modal-content, input, select, textarea, button {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }

        body.hold-transition.sidebar-mini {
            background-color: var(--content-bg) !important;
        }

        /* ==============================================
           SIDEBAR — DEEP FOREST
        ============================================== */
        .main-sidebar {
            background-color: var(--sidebar-bg) !important;
            box-shadow: 2px 0 8px rgba(0,0,0,0.12) !important;
        }

        /* Brand header */
        .brand-link {
            background-color: var(--sidebar-brand) !important;
            color: #FFFFFF !important;
            border-bottom: 1px solid rgba(77,212,164,0.12) !important;
            padding: 14px 18px !important;
        }
        .brand-link:hover { background-color: #0d2620 !important; }
        .brand-text {
            color: #FFFFFF !important;
            font-weight: 700 !important;
            font-size: 15px !important;
            letter-spacing: 0.2px;
        }

        /* User panel */
        .main-sidebar .user-panel {
            border-bottom: 1px solid rgba(77,212,164,0.10) !important;
            padding: 12px 16px 14px !important;
            margin: 0 !important;
        }
        .main-sidebar .user-panel .info a {
            color: rgba(255,255,255,0.70) !important;
            font-size: 13px;
            font-weight: 500;
        }

        /* Nav section headers */
        .nav-sidebar .nav-header {
            color: var(--sidebar-text-muted) !important;
            font-size: 9.5px !important;
            font-weight: 700 !important;
            letter-spacing: 1.4px !important;
            padding: 18px 18px 5px !important;
            text-transform: uppercase !important;
        }

        /* Nav items */
        .nav-sidebar .nav-item .nav-link {
            color: var(--sidebar-text) !important;
            border-radius: 0 !important;
            padding: 10px 18px !important;
            font-size: 13.5px !important;
            font-weight: 500 !important;
            transition: all 0.18s ease !important;
            display: flex !important;
            align-items: center !important;
        }
        .nav-sidebar .nav-item .nav-link p {
            font-size: 13.5px !important;
            font-weight: 500 !important;
            margin: 0 !important;
            line-height: 1.3 !important;
        }
        .nav-sidebar .nav-item .nav-link:hover {
            background-color: rgba(255,255,255,0.07) !important;
            color: #FFFFFF !important;
        }
        .nav-sidebar .nav-item .nav-link:hover .nav-icon { color: var(--sidebar-accent) !important; }

        /* Active state */
        .nav-sidebar .nav-item .nav-link.active {
            background-color: var(--sidebar-accent-dim) !important;
            color: var(--sidebar-accent) !important;
            border-left: 3px solid var(--sidebar-accent) !important;
            font-weight: 600 !important;
            box-shadow: none !important;
        }
        .nav-sidebar .nav-item .nav-link.active .nav-icon { color: var(--sidebar-accent) !important; }

        /* Treeview sub-items */
        .nav-treeview > .nav-item > .nav-link {
            padding: 8px 18px 8px 40px !important;
            font-size: 12.5px !important;
            color: rgba(255,255,255,0.55) !important;
        }
        .nav-treeview > .nav-item > .nav-link:hover {
            background-color: rgba(255,255,255,0.06) !important;
            color: rgba(255,255,255,0.85) !important;
        }
        .nav-treeview > .nav-item > .nav-link.active {
            color: var(--sidebar-accent) !important;
            background-color: var(--sidebar-accent-dim) !important;
            border-left: 3px solid var(--sidebar-accent) !important;
        }

        /* Treeview expand arrow */
        .nav-sidebar .nav-item > .nav-link > .right.fa-angle-left {
            font-size: 12px !important;
            opacity: 0.5;
            transition: transform 0.2s ease, opacity 0.2s ease !important;
        }
        .nav-sidebar .nav-item.menu-open > .nav-link > .right.fa-angle-left {
            transform: rotate(-90deg) !important;
            opacity: 0.9 !important;
        }

        /* Nav icons */
        .nav-sidebar .nav-icon {
            font-size: 17px !important;
            vertical-align: middle !important;
            margin-right: 10px !important;
            color: rgba(255, 255, 255, 0.42) !important;
            transition: color 0.2s ease !important;
        }

        /* Logout button */
        .nav-logout-btn {
            display: flex !important;
            align-items: center !important;
            gap: 9px !important;
            width: 100% !important;
            padding: 10px 18px !important;
            background: transparent !important;
            border: none !important;
            color: rgba(255, 110, 110, 0.75) !important;
            text-align: left !important;
            cursor: pointer !important;
            transition: all 0.18s ease !important;
            font-family: inherit !important;
            font-size: 13.5px !important;
            font-weight: 500 !important;
        }
        .nav-logout-btn:hover {
            background-color: rgba(220, 53, 69, 0.12) !important;
            color: #FF8080 !important;
        }
        .nav-logout-btn .material-icons { font-size: 17px !important; vertical-align: middle !important; }

        /* ==============================================
           TOP NAV & HEADER
        ============================================== */
        .main-header {
            border-bottom: 1px solid var(--border-subtle) !important;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05) !important;
            background-color: #ffffff !important;
        }
        .content-header { padding: 18px 24px 0 !important; }
        .content-header h1 {
            color: var(--text-primary);
            font-weight: 700;
            font-size: 21px;
        }
        .breadcrumb {
            background: transparent !important;
            font-size: 12.5px !important;
            color: var(--text-secondary) !important;
            padding: 0 !important;
        }
        .breadcrumb-item.active { color: var(--text-secondary) !important; }
        .breadcrumb-item a { color: var(--brand-green) !important; }

        /* ==============================================
           CONTENT WRAPPER & BACKGROUND
        ============================================== */
        .content-wrapper {
            background-color: var(--content-bg) !important;
        }
        section.content {
            padding: 20px 24px 80px !important;
        }

        /* ==============================================
           FOOTER
        ============================================== */
        .main-footer {
            background-color: #ffffff !important;
            border-top: 1px solid var(--border-subtle) !important;
            padding: 14px 24px !important;
            font-size: 12.5px !important;
            color: var(--text-secondary) !important;
        }

        /* ==============================================
           BRAND COLORS
        ============================================== */
        .btn-success, .bg-success {
            background-color: var(--brand-green) !important;
            border-color: var(--brand-green) !important;
        }
        .btn-success:hover {
            background-color: var(--brand-green-dark) !important;
            border-color: var(--brand-green-dark) !important;
        }
        .text-success { color: var(--brand-green) !important; }
        .card-success.card-outline { border-top: 3px solid var(--brand-green) !important; }

        /* ==============================================
           CARD — Clean White with Soft Shadow
        ============================================== */
        .card, .admin-card {
            background-color: var(--card-bg) !important;
            border: none !important;
            border-radius: 8px !important;
            box-shadow: var(--card-shadow) !important;
            margin-bottom: 24px !important;
        }
        .card .card-body { border-radius: 8px !important; padding: 24px !important; }
        .card-header {
            padding: 18px 24px !important;
            background-color: #ffffff !important;
            border-bottom: 1px solid var(--border-subtle) !important;
            border-radius: 8px 8px 0 0 !important;
        }
        .card-header .card-title {
            font-size: 15px !important;
            font-weight: 700 !important;
            color: var(--text-primary) !important;
            margin: 0 !important;
        }
        .info-box, .small-box {
            box-shadow: var(--card-shadow) !important;
            border: none !important;
            border-radius: 8px !important;
        }
        .modal-content {
            box-shadow: 0 8px 40px rgba(0,0,0,0.14) !important;
            border: none !important;
            border-radius: 8px !important;
        }
        .modal-header, .modal-footer { border-radius: 0 !important; }

        /* ==============================================
           FORM — Premium Controls
        ============================================== */
        .form-control, .custom-select {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            font-size: 14px !important;
            color: var(--text-primary) !important;
            border: 1px solid #D1DCE8 !important;
            border-radius: 6px !important;
            padding: 10px 14px !important;
            height: auto !important;
            background-color: #ffffff !important;
            transition: border-color 0.18s ease, box-shadow 0.18s ease !important;
        }
        .form-control:focus, .custom-select:focus {
            border-color: var(--brand-green) !important;
            box-shadow: var(--input-focus-ring) !important;
            outline: none !important;
        }
        .form-control::placeholder { color: #A0AEC0 !important; font-size: 13.5px !important; }
        textarea.form-control { min-height: 100px; resize: vertical; }

        label {
            font-weight: 600 !important;
            font-size: 13px !important;
            color: #374151 !important;
            margin-bottom: 6px !important;
            display: block !important;
        }
        .form-group { margin-bottom: 20px !important; }

        /* Custom file input */
        .custom-file-label {
            border: 1px solid #D1DCE8 !important;
            border-radius: 6px !important;
            font-size: 13.5px !important;
            color: #A0AEC0 !important;
            padding: 10px 14px !important;
            height: auto !important;
        }
        .custom-file-label::after {
            background-color: #F1F5F9 !important;
            color: #374151 !important;
            font-weight: 600 !important;
            border-left: 1px solid #D1DCE8 !important;
            border-radius: 0 6px 6px 0 !important;
            height: 100% !important;
            padding: 10px 14px !important;
        }

        /* Buttons */
        .btn {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            font-weight: 600 !important;
            border-radius: 6px !important;
            font-size: 13.5px !important;
            padding: 9px 20px !important;
            transition: all 0.18s ease !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 6px !important;
        }
        .btn:hover { transform: translateY(-1px); }
        .btn:active { transform: translateY(0); }
        .btn-sm {
            padding: 6px 14px !important;
            font-size: 12.5px !important;
        }
        .badge { border-radius: 4px !important; font-size: 11px !important; font-weight: 600 !important; }
        .input-group-text {
            border: 1px solid #D1DCE8 !important;
            border-radius: 6px !important;
            background-color: #F8FAFC !important;
            color: var(--text-secondary) !important;
            font-size: 13.5px !important;
        }

        /* ==============================================
           TABLE — Clean & Legible
        ============================================== */
        .table thead th {
            font-size: 11px !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.7px !important;
            color: var(--text-secondary) !important;
            border-bottom: 1px solid var(--border-subtle) !important;
            border-top: none !important;
            background-color: #F8FAFC !important;
            padding: 13px 16px !important;
        }
        .table td {
            vertical-align: middle !important;
            font-size: 13.5px !important;
            color: var(--text-primary) !important;
            padding: 14px 16px !important;
            border-bottom: 1px solid #F0F4F8 !important;
        }
        .table-responsive { border: none !important; }
        .table > tbody > tr:last-child > td { border-bottom: none !important; }

        /* Form control sm */
        .form-control-sm, .custom-select-sm, select.form-control-sm {
            height: 37px !important;
            padding: 7px 12px !important;
            font-size: 13px !important;
            border-radius: 6px !important;
            border-color: #D1DCE8 !important;
        }

        /* ==============================================
           ACTION BUTTONS
        ============================================== */
        .btn-action-group {
            display: inline-flex !important;
            align-items: center !important;
            gap: 6px !important;
        }
        .btn-action {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 32px !important;
            height: 32px !important;
            border-radius: 6px !important;
            border: 1px solid transparent !important;
            transition: all 0.18s ease !important;
            cursor: pointer !important;
            text-decoration: none !important;
            padding: 0 !important;
        }
        .btn-action:hover { transform: translateY(-1px); }
        .btn-action-edit { color: #D97706 !important; background-color: #FEF3C7 !important; border-color: #FDE68A !important; }
        .btn-action-edit:hover { background-color: #FDE68A !important; border-color: #FCD34D !important; color: #92400E !important; }
        .btn-action-delete { color: #DC2626 !important; background-color: #FEE2E2 !important; border-color: #FCA5A5 !important; }
        .btn-action-delete:hover { background-color: #FCA5A5 !important; border-color: #F87171 !important; color: #991B1B !important; }
        .btn-action-view { color: #0284C7 !important; background-color: #E0F2FE !important; border-color: #BAE6FD !important; }
        .btn-action-view:hover { background-color: #BAE6FD !important; border-color: #7DD3FC !important; color: #0369A1 !important; }

        /* ==============================================
           SWAL2
        ============================================== */
        .swal2-confirm, .swal2-cancel { border-radius: 6px !important; font-family: 'Plus Jakarta Sans', sans-serif !important; font-weight: 600 !important; }
        .swal2-popup { border-radius: 10px !important; font-family: 'Plus Jakarta Sans', sans-serif !important; }
        .swal2-title { font-size: 18px !important; font-weight: 700 !important; }
    </style>

    @yield('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Top Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('home') }}" target="_blank" class="nav-link text-success font-weight-bold">
                    <span class="material-icons" style="font-size: 16px; vertical-align: middle;">open_in_new</span> Lihat Portal Utama
                </a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle d-flex align-items-center gap-2" data-toggle="dropdown">
                    <span class="material-icons" style="font-size: 24px; color: #009966;">account_circle</span>
                    <span class="d-none d-md-inline font-weight-bold text-dark">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="border-radius: 3px;">
                    <!-- User image -->
                    <li class="user-header bg-success text-white" style="background-color: #004F3B !important;">
                        <span class="material-icons" style="font-size: 54px;">account_circle</span>
                        <p>
                            {{ Auth::user()->name }}
                            <small>Administrator Dinkes Cianjur</small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <a href="{{ route('admin.profil.edit') }}" class="btn btn-default btn-flat">Edit Profil</a>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline float-right">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-flat">Logout</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('admin.dashboard') }}" class="brand-link">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Dinkes" class="brand-image elevation-3" style="opacity: .9; background: #fff; padding: 2px; border-radius: 3px;">
            <span class="brand-text">Dinkes Cianjur</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                <div class="image">
                    <span class="material-icons" style="font-size: 32px; color: #5EE9B5;">account_circle</span>
                </div>
                <div class="info">
                    <a href="{{ route('admin.dashboard') }}" class="d-block">{{ Auth::user()->name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">

                    {{-- DASHBOARD --}}
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <span class="material-icons nav-icon">dashboard</span>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    {{-- KELOLA KONTEN --}}
                    <li class="nav-header">KONTEN</li>

                    <li class="nav-item">
                        <a href="{{ route('admin.berita.index') }}" class="nav-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
                            <span class="material-icons nav-icon">newspaper</span>
                            <p>Berita</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.agenda.index') }}" class="nav-link {{ request()->routeIs('admin.agenda.*') ? 'active' : '' }}">
                            <span class="material-icons nav-icon">event</span>
                            <p>Agenda</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.galeri.index') }}" class="nav-link {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">
                            <span class="material-icons nav-icon">collections</span>
                            <p>Galeri</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.home-content.index') }}" class="nav-link {{ request()->routeIs('admin.home-content.*') ? 'active' : '' }}">
                            <span class="material-icons nav-icon">info</span>
                            <p>Konten Beranda</p>
                        </a>
                    </li>

                    {{-- LAYANAN & PROGRAM --}}
                    <li class="nav-header">LAYANAN</li>

                    <li class="nav-item">
                        <a href="{{ route('admin.program-kesehatan.index') }}" class="nav-link {{ request()->routeIs('admin.program-kesehatan.*') ? 'active' : '' }}">
                            <span class="material-icons nav-icon">health_and_safety</span>
                            <p>Program Kesehatan</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.layanan.index') }}" class="nav-link {{ request()->routeIs('admin.layanan.*') ? 'active' : '' }}">
                            <span class="material-icons nav-icon">widgets</span>
                            <p>Layanan</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.labkesda.index') }}" class="nav-link {{ request()->routeIs('admin.labkesda.*') ? 'active' : '' }}">
                            <span class="material-icons nav-icon">science</span>
                            <p>Labkesda</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.pagodasehat.index') }}" class="nav-link {{ request()->routeIs('admin.pagodasehat.*') ? 'active' : '' }}">
                            <span class="material-icons nav-icon">medical_services</span>
                            <p>Pagoda Sehat</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.faskes.index') }}" class="nav-link {{ request()->routeIs('admin.faskes.*') ? 'active' : '' }}">
                            <span class="material-icons nav-icon">location_city</span>
                            <p>Faskes</p>
                        </a>
                    </li>

                    {{-- SATU DATA & REGULASI --}}
                    <li class="nav-header">DATA & REGULASI</li>

                    {{-- SATU DATA dropdown --}}
                    <li class="nav-item has-treeview {{ (request()->routeIs('admin.satudata.statistik.*') || request()->routeIs('admin.satudata.statistik.import')) ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ (request()->routeIs('admin.satudata.statistik.*') || request()->routeIs('admin.satudata.statistik.import')) ? 'active' : '' }}">
                            <span class="material-icons nav-icon">bar_chart</span>
                            <p>
                                Data & Statistik
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview pl-3">
                            <li class="nav-item">
                                <a href="{{ route('admin.satudata.statistik.edit', ['section' => 'indikator']) }}" class="nav-link {{ request()->routeIs('admin.satudata.statistik.*') && request('section', 'indikator') === 'indikator' ? 'active' : '' }}">
                                    <span class="material-icons nav-icon" style="font-size: 16px;">show_chart</span>
                                    <p>Indikator Utama</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.satudata.statistik.edit', ['section' => 'stunting']) }}" class="nav-link {{ request()->routeIs('admin.satudata.statistik.*') && request('section') === 'stunting' ? 'active' : '' }}">
                                    <span class="material-icons nav-icon" style="font-size: 16px;">trending_down</span>
                                    <p>Tren Stunting</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.satudata.statistik.edit', ['section' => 'nakes']) }}" class="nav-link {{ request()->routeIs('admin.satudata.statistik.*') && request('section') === 'nakes' ? 'active' : '' }}">
                                    <span class="material-icons nav-icon" style="font-size: 16px;">people</span>
                                    <p>Distribusi Nakes</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.satudata.statistik.edit', ['section' => 'sebaran']) }}" class="nav-link {{ request()->routeIs('admin.satudata.statistik.*') && request('section') === 'sebaran' ? 'active' : '' }}">
                                    <span class="material-icons nav-icon" style="font-size: 16px;">explore</span>
                                    <p>Sebaran Puskesmas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.satudata.statistik.import') }}" class="nav-link {{ request()->routeIs('admin.satudata.statistik.import') ? 'active' : '' }}">
                                    <span class="material-icons nav-icon" style="font-size: 16px;">upload_file</span>
                                    <p>Unggah CSV Stunting</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.laporan.index') }}" class="nav-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                            <span class="material-icons nav-icon">description</span>
                            <p>Laporan Kinerja</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.regulasi.index') }}" class="nav-link {{ request()->routeIs('admin.regulasi.*') ? 'active' : '' }}">
                            <span class="material-icons nav-icon">gavel</span>
                            <p>Regulasi &amp; Kebijakan</p>
                        </a>
                    </li>

                    {{-- PENGATURAN HALAMAN --}}
                    <li class="nav-header">PENGATURAN</li>

                    <li class="nav-item">
                        <a href="{{ route('admin.kategori.index') }}" class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
                            <span class="material-icons nav-icon">category</span>
                            <p>Kelola Kategori</p>
                        </a>
                    </li>

                    {{-- PROFIL INSTANSI dropdown --}}
                    <li class="nav-item has-treeview {{ request()->routeIs('admin.profil.*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->routeIs('admin.profil.*') ? 'active' : '' }}">
                            <span class="material-icons nav-icon">business</span>
                            <p>
                                Profil Instansi
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview pl-3">
                            <li class="nav-item">
                                <a href="{{ route('admin.profil.edit', ['section' => 'sambutan']) }}" class="nav-link {{ request()->routeIs('admin.profil.*') && request('section', 'sambutan') === 'sambutan' ? 'active' : '' }}">
                                    <span class="material-icons nav-icon" style="font-size: 16px;">campaign</span>
                                    <p>Sambutan Pimpinan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.profil.edit', ['section' => 'visimisi']) }}" class="nav-link {{ request()->routeIs('admin.profil.*') && request('section') === 'visimisi' ? 'active' : '' }}">
                                    <span class="material-icons nav-icon" style="font-size: 16px;">flag</span>
                                    <p>Visi &amp; Misi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.profil.edit', ['section' => 'sejarah']) }}" class="nav-link {{ request()->routeIs('admin.profil.*') && request('section') === 'sejarah' ? 'active' : '' }}">
                                    <span class="material-icons nav-icon" style="font-size: 16px;">history_edu</span>
                                    <p>Sejarah Instansi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.profil.edit', ['section' => 'struktur']) }}" class="nav-link {{ request()->routeIs('admin.profil.*') && request('section') === 'struktur' ? 'active' : '' }}">
                                    <span class="material-icons nav-icon" style="font-size: 16px;">account_tree</span>
                                    <p>Struktur Organisasi</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- LAYANAN PPID dropdown --}}
                    <li class="nav-item has-treeview {{ request()->routeIs('admin.ppid.*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->routeIs('admin.ppid.*') ? 'active' : '' }}">
                            <span class="material-icons nav-icon">help_outline</span>
                            <p>
                                Layanan PPID
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview pl-3">
                            <li class="nav-item">
                                <a href="{{ route('admin.ppid.edit', ['section' => 'informasi']) }}" class="nav-link {{ request()->routeIs('admin.ppid.*') && request('section', 'informasi') === 'informasi' ? 'active' : '' }}">
                                    <span class="material-icons nav-icon" style="font-size: 16px;">toc</span>
                                    <p>Informasi Publik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.ppid.edit', ['section' => 'statistik']) }}" class="nav-link {{ request()->routeIs('admin.ppid.*') && request('section') === 'statistik' ? 'active' : '' }}">
                                    <span class="material-icons nav-icon" style="font-size: 16px;">view_quilt</span>
                                    <p>Statistik PPID</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.ppid.edit', ['section' => 'tautan']) }}" class="nav-link {{ request()->routeIs('admin.ppid.*') && request('section') === 'tautan' ? 'active' : '' }}">
                                    <span class="material-icons nav-icon" style="font-size: 16px;">link</span>
                                    <p>Tautan Publik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.ppid.edit', ['section' => 'tatacara']) }}" class="nav-link {{ request()->routeIs('admin.ppid.*') && request('section') === 'tatacara' ? 'active' : '' }}">
                                    <span class="material-icons nav-icon" style="font-size: 16px;">playlist_add_check</span>
                                    <p>Tata Cara &amp; Aksi</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- PENGATURAN SITUS dropdown --}}
                    <li class="nav-item has-treeview {{ request()->routeIs('admin.setting.*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->routeIs('admin.setting.*') ? 'active' : '' }}">
                            <span class="material-icons nav-icon">settings</span>
                            <p>
                                Pengaturan Umum
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview pl-3">
                            <li class="nav-item">
                                <a href="{{ route('admin.setting.edit', ['section' => 'identitas']) }}" class="nav-link {{ request()->routeIs('admin.setting.*') && request('section', 'identitas') === 'identitas' ? 'active' : '' }}">
                                    <span class="material-icons nav-icon" style="font-size: 16px;">web</span>
                                    <p>Identitas Situs</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.setting.edit', ['section' => 'kontak']) }}" class="nav-link {{ request()->routeIs('admin.setting.*') && request('section') === 'kontak' ? 'active' : '' }}">
                                    <span class="material-icons nav-icon" style="font-size: 16px;">contact_phone</span>
                                    <p>Informasi Kontak</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.setting.edit', ['section' => 'darurat']) }}" class="nav-link {{ request()->routeIs('admin.setting.*') && request('section') === 'darurat' ? 'active' : '' }}">
                                    <span class="material-icons nav-icon" style="font-size: 16px;">emergency</span>
                                    <p>Layanan Darurat</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.setting.edit', ['section' => 'sosmed']) }}" class="nav-link {{ request()->routeIs('admin.setting.*') && request('section') === 'sosmed' ? 'active' : '' }}">
                                    <span class="material-icons nav-icon" style="font-size: 16px;">share</span>
                                    <p>Media Sosial</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- LOGOUT --}}
                    <li class="nav-item mt-1" style="border-top: 1px solid rgba(77,212,164,0.12); padding-top: 6px;">
                        <form action="{{ route('logout') }}" method="POST" id="form-logout-sidebar">
                            @csrf
                            <button type="button" class="nav-logout-btn" onclick="confirmLogout()">
                                <span class="material-icons" style="font-size: 18px;">logout</span>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('header_title', 'Dashboard')</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-success">Admin</a></li>
                            <li class="breadcrumb-item active">@yield('header_title', 'Dashboard')</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid" style="padding-bottom: 48px;">
                @yield('content')
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer text-sm">
        <strong>Copyright &copy; 2026 <a href="{{ route('home') }}" class="text-success">Dinas Kesehatan Kabupaten Cianjur</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0.0
        </div>
    </footer>
</div>
<!-- ./wrapper -->

<!-- Local AdminLTE & Vendor Scripts -->
<script src="{{ asset('vendor/adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/js/adminlte.min.js') }}"></script>

{{-- SweetAlert2 (offline) --}}
<script src="{{ asset('vendor/adminlte/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>

{{-- Element to pass session alert data safely to JS without triggering IDE decorator parser warnings --}}
<div id="session-alert-data"
     style="display: none;"
     data-success="{{ session('success') }}"
     data-error="{{ session('error') }}"
     data-errors="{{ $errors->any() ? json_encode($errors->all()) : '' }}">
</div>

<script>
    // =============================================
    // GLOBAL HELPER: SweetAlert2 Confirm Delete
    // Usage: onclick="confirmDelete('form-delete-id')"
    // =============================================
    window.confirmDelete = function(formId) {
        Swal.fire({
            title: 'Hapus Data?',
            text: 'Data yang dihapus tidak dapat dikembalikan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<span class="material-icons" style="font-size:16px;vertical-align:middle;">delete</span> Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
    };

    // =============================================
    // GLOBAL HELPER: SweetAlert2 Toast Notification
    // Usage: showToast('success', 'Berhasil disimpan!')
    //        showToast('error', 'Terjadi kesalahan')
    // =============================================
    window.showToast = function(icon, title) {
        Swal.fire({
            icon: icon,
            title: title,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });
    };

    // =============================================
    // GLOBAL HELPER: Logout with SweetAlert2
    // =============================================
    window.confirmLogout = function() {
        Swal.fire({
            title: 'Keluar dari sistem?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-logout-sidebar').submit();
            }
        });
    };

    // =============================================
    // AUTO SHOW SESSION TOAST (success/error)
    // =============================================
    const sessionAlertEl = document.getElementById('session-alert-data');
    if (sessionAlertEl) {
        const successMessage = sessionAlertEl.dataset.success;
        const errorMessage = sessionAlertEl.dataset.error;
        const errorsJson = sessionAlertEl.dataset.errors;

        document.addEventListener('DOMContentLoaded', function() {
            if (successMessage) {
                showToast('success', successMessage);
            }
            if (errorMessage) {
                showToast('error', errorMessage);
            }
            if (errorsJson) {
                try {
                    const errors = JSON.parse(errorsJson);
                    if (errors && errors.length > 0) {
                        let errorHtml = '<ul class="text-left pl-3" style="font-size:14px; list-style-type:disc;">';
                        errors.forEach(function(error) {
                            const safeError = error
                                .replace(/&/g, "&amp;")
                                .replace(/</g, "&lt;")
                                .replace(/>/g, "&gt;")
                                .replace(/"/g, "&quot;")
                                .replace(/'/g, "&#039;");
                            errorHtml += '<li>' + safeError + '</li>';
                        });
                        errorHtml += '</ul>';
                        Swal.fire({
                            title: 'Periksa Kembali Form Anda',
                            html: errorHtml,
                            icon: 'error',
                            confirmButtonColor: '#dc3545',
                            confirmButtonText: 'Tutup'
                        });
                    }
                } catch (e) {
                    console.error('Failed to parse validation errors:', e);
                }
            }
        });
    }

    // =============================================
    // VIEW COUNT AUTO-INCREMENT HANDLER
    // =============================================
    $(document).ready(function() {
        $('.view-count-link').on('click', function() {
            let span = $(this).find('.views-num');
            if (span.length) {
                let currentViews = parseInt(span.text()) || 0;
                span.text(currentViews + 1);
            }
        });
    });
</script>

@yield('scripts')
</body>
</html>
