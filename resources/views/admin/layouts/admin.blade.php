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
        /* =============================================
           GLOBAL FONT
        ============================================= */
        body, .main-sidebar, .content-wrapper, .main-header, .main-footer {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* =============================================
           SIDEBAR — DARK FOREST + MINT ACCENT
        ============================================= */
        .main-sidebar {
            background-color: #0D3B2E !important;
        }

        /* Brand header */
        .brand-link {
            background-color: #063020 !important;
            color: #FFFFFF !important;
            border-bottom: 1px solid rgba(94, 233, 181, 0.15) !important;
            padding: 12px 16px !important;
        }
        .brand-link:hover {
            background-color: #042318 !important;
        }
        .brand-text {
            color: #FFFFFF !important;
            font-weight: 700 !important;
            font-size: 15px !important;
            letter-spacing: 0.3px;
        }

        /* User panel in sidebar */
        .main-sidebar .user-panel {
            border-bottom: 1px solid rgba(94, 233, 181, 0.12) !important;
        }
        .main-sidebar .user-panel .info a {
            color: #C8F5E5 !important;
            font-size: 13px;
            font-weight: 600;
        }

        /* Sidebar nav section headers */
        .nav-sidebar .nav-header {
            color: rgba(94, 233, 181, 0.55) !important;
            font-size: 10px !important;
            font-weight: 700 !important;
            letter-spacing: 1.2px !important;
            padding: 14px 16px 4px !important;
        }

        /* Nav items */
        .nav-sidebar .nav-item .nav-link {
            color: rgba(255, 255, 255, 0.75) !important;
            border-radius: 0 !important;
            padding: 9px 16px !important;
            transition: all 0.2s ease !important;
        }
        .nav-sidebar .nav-item .nav-link:hover {
            background-color: rgba(94, 233, 181, 0.10) !important;
            color: #5EE9B5 !important;
        }
        .nav-sidebar .nav-item .nav-link:hover .nav-icon {
            color: #5EE9B5 !important;
        }

        /* Active state — mint green accent */
        .nav-sidebar .nav-item .nav-link.active {
            background-color: rgba(94, 233, 181, 0.14) !important;
            color: #5EE9B5 !important;
            border-left: 3px solid #5EE9B5 !important;
            font-weight: 600 !important;
            box-shadow: none !important;
        }
        .nav-sidebar .nav-item .nav-link.active .nav-icon {
            color: #5EE9B5 !important;
        }

        /* Nav icons */
        .nav-sidebar .nav-icon {
            font-size: 18px !important;
            vertical-align: middle !important;
            margin-right: 8px !important;
            color: rgba(255, 255, 255, 0.5) !important;
            transition: color 0.2s ease !important;
        }

        /* Logout button style */
        .nav-logout-btn {
            display: flex !important;
            align-items: center !important;
            gap: 8px !important;
            width: 100% !important;
            padding: 9px 16px !important;
            background: transparent !important;
            border: none !important;
            color: rgba(255, 120, 120, 0.85) !important;
            text-align: left !important;
            cursor: pointer !important;
            transition: all 0.2s ease !important;
            font-family: inherit !important;
            font-size: 14px !important;
        }
        .nav-logout-btn:hover {
            background-color: rgba(220, 53, 69, 0.15) !important;
            color: #FF7070 !important;
        }
        .nav-logout-btn .material-icons {
            font-size: 18px !important;
            vertical-align: middle !important;
        }

        /* =============================================
           TOP NAR & CONTENT
        ============================================= */
        .main-header {
            border-bottom: 1px solid #E2E8F0;
        }

        .content-header h1 {
            color: #004F3B;
            font-weight: 700;
            font-size: 22px;
        }

        /* =============================================
           BRAND COLORS (Buttons, alerts, text)
        ============================================= */
        .btn-success, .bg-success {
            background-color: #009966 !important;
            border-color: #009966 !important;
        }
        .btn-success:hover {
            background-color: #007A52 !important;
            border-color: #007A52 !important;
        }
        .text-success { color: #009966 !important; }
        .card-success.card-outline {
            border-top: 3px solid #009966 !important;
        }

        /* =============================================
           CARD RADIUS DESIGN SYSTEM
           Outer: 1px | Inner (body, btn, form): 3px
        ============================================= */
        .card {
            border-radius: 1px !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06) !important;
        }
        .card .card-body,
        .btn,
        .form-control,
        .badge,
        .input-group-text,
        .modal-content {
            border-radius: 3px !important;
        }
        .modal-header, .modal-footer {
            border-radius: 0 !important;
        }

        /* =============================================
           FORM IMPROVEMENTS
        ============================================= */
        .form-control {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            font-size: 14px !important;
            border-color: #CBD5E1 !important;
            padding: 8px 12px !important;
            transition: border-color 0.2s ease, box-shadow 0.2s ease !important;
        }
        .form-control:focus {
            border-color: #009966 !important;
            box-shadow: 0 0 0 3px rgba(0, 153, 102, 0.12) !important;
        }
        label {
            font-weight: 600 !important;
            font-size: 13px !important;
            color: #374151 !important;
            margin-bottom: 4px !important;
        }

        /* =============================================
           SWAL2 CUSTOM THEME (brand colors)
        ============================================= */
        .swal2-confirm {
            border-radius: 3px !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            font-weight: 600 !important;
        }
        .swal2-cancel {
            border-radius: 3px !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }
        .swal2-popup {
            border-radius: 1px !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }
        .swal2-title {
            font-size: 18px !important;
            font-weight: 700 !important;
        }

        /* =============================================
           TABLE & CARD IMPROVEMENTS
           ============================================= */
        .card-header {
            padding: 16px 20px !important;
            background-color: #FFFFFF !important;
            border-bottom: 1px solid #E2E8F0 !important;
        }
        .table thead th {
            font-size: 11px !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.8px !important;
            color: #475569 !important;
            border-bottom: 2px solid #E2E8F0 !important;
            background-color: #F8FAFC !important;
            padding: 12px 16px !important;
        }
        .table td {
            vertical-align: middle !important;
            font-size: 14px !important;
            padding: 14px 16px !important;
            border-bottom: 1px solid #F1F5F9 !important;
        }
        .table-responsive {
            border: none !important;
        }

        /* =============================================
           FORM & INPUTS (Prevent clipping in select sm)
           ============================================= */
        .form-control-sm, .custom-select-sm, select.form-control-sm {
            height: 36px !important;
            padding: 6px 12px !important;
            font-size: 13px !important;
            border-radius: 3px !important;
            border-color: #CBD5E1 !important;
        }
        select.form-control-sm, .custom-select-sm {
            padding-right: 28px !important; /* spacing for arrow */
        }
        .btn-sm {
            height: 36px !important;
            padding: 6px 16px !important;
            font-size: 13px !important;
            font-weight: 600 !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 6px !important;
            border-radius: 3px !important;
        }

        /* =============================================
           PREMIUM TABLE ACTIONS (Clean & Spacious)
           ============================================= */
        .btn-action-group {
            display: inline-flex !important;
            align-items: center !important;
            gap: 8px !important;
        }
        .btn-action {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 32px !important;
            height: 32px !important;
            border-radius: 4px !important;
            border: 1px solid transparent !important;
            transition: all 0.2s ease !important;
            cursor: pointer !important;
            text-decoration: none !important;
            padding: 0 !important;
        }
        .btn-action-edit {
            color: #D97706 !important;
            background-color: #FEF3C7 !important;
            border-color: #FDE68A !important;
        }
        .btn-action-edit:hover {
            color: #92400E !important;
            background-color: #FDE68A !important;
            border-color: #FCD34D !important;
        }
        .btn-action-delete {
            color: #DC2626 !important;
            background-color: #FEE2E2 !important;
            border-color: #FCA5A5 !important;
        }
        .btn-action-delete:hover {
            color: #991B1B !important;
            background-color: #FCA5A5 !important;
            border-color: #F87171 !important;
        }
        .btn-action-view {
            color: #0284C7 !important;
            background-color: #E0F2FE !important;
            border-color: #BAE6FD !important;
        }
        .btn-action-view:hover {
            color: #0369A1 !important;
            background-color: #BAE6FD !important;
            border-color: #7DD3FC !important;
        }
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
            <img src="{{ asset('Assets/layouts/Nav/logo_dinkes_cropped.png') }}" alt="Logo Dinkes" class="brand-image img-circle elevation-3" style="opacity: .9">
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
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                    {{-- DASHBOARD --}}
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <span class="material-icons nav-icon">dashboard</span>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    {{-- KONTEN PUBLIK --}}
                    <li class="nav-header">KONTEN PUBLIK</li>

                    <li class="nav-item">
                        <a href="{{ route('admin.berita.index') }}" class="nav-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
                            <span class="material-icons nav-icon">newspaper</span>
                            <p>Kelola Berita</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.agenda.index') }}" class="nav-link {{ request()->routeIs('admin.agenda.*') ? 'active' : '' }}">
                            <span class="material-icons nav-icon">event</span>
                            <p>Kelola Agenda</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.galeri.index') }}" class="nav-link {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">
                            <span class="material-icons nav-icon">collections</span>
                            <p>Kelola Galeri</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.ppid.edit') }}" class="nav-link {{ request()->routeIs('admin.ppid.*') ? 'active' : '' }}">
                            <span class="material-icons nav-icon">description</span>
                            <p>Kelola PPID</p>
                        </a>
                    </li>

                    {{-- PROGRAM & LAYANAN --}}
                    <li class="nav-header">PROGRAM &amp; LAYANAN</li>

                    <li class="nav-item">
                        <a href="{{ route('admin.program-kesehatan.index') }}" class="nav-link {{ request()->routeIs('admin.program-kesehatan.*') ? 'active' : '' }}">
                            <span class="material-icons nav-icon">health_and_safety</span>
                            <p>Program Kesehatan</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.layanan.index') }}" class="nav-link {{ request()->routeIs('admin.layanan.*') ? 'active' : '' }}">
                            <span class="material-icons nav-icon">widgets</span>
                            <p>Layanan Terpadu</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.labkesda.index') }}" class="nav-link {{ request()->routeIs('admin.labkesda.*') ? 'active' : '' }}">
                            <span class="material-icons nav-icon">science</span>
                            <p>Kelola Labkesda</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.pagodasehat.index') }}" class="nav-link {{ request()->routeIs('admin.pagodasehat.*') ? 'active' : '' }}">
                            <span class="material-icons nav-icon">medical_services</span>
                            <p>Kelola Pagoda Sehat</p>
                        </a>
                    </li>

                    {{-- SATU DATA & DOKUMEN --}}
                    <li class="nav-header">SATU DATA &amp; DOKUMEN</li>

                    <li class="nav-item">
                        <a href="{{ route('admin.profil.edit') }}" class="nav-link {{ request()->routeIs('admin.profil.*') ? 'active' : '' }}">
                            <span class="material-icons nav-icon">business</span>
                            <p>Profil Dinkes</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.satudata.statistik.edit') }}" class="nav-link {{ request()->routeIs('admin.satudata.statistik.edit') ? 'active' : '' }}">
                            <span class="material-icons nav-icon">bar_chart</span>
                            <p>Indikator Statistik</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.satudata.statistik.import') }}" class="nav-link {{ request()->routeIs('admin.satudata.statistik.import') ? 'active' : '' }}">
                            <span class="material-icons nav-icon">upload_file</span>
                            <p>Import CSV Stunting</p>
                        </a>
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
                            <p>Regulasi &amp; Hukum</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.setting.edit') }}" class="nav-link {{ request()->routeIs('admin.setting.*') ? 'active' : '' }}">
                            <span class="material-icons nav-icon">settings</span>
                            <p>Pengaturan Situs</p>
                        </a>
                    </li>

                    {{-- LOGOUT --}}
                    <li class="nav-item mt-2" style="border-top: 1px solid rgba(94, 233, 181, 0.1); padding-top: 8px;">
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
            <div class="container-fluid">
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
