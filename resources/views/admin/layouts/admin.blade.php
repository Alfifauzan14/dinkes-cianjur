<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard Admin') - Dinas Kesehatan Kabupaten Cianjur</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Icons --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/fontawesome-free/css/all.min.css') }}">

    {{-- SweetAlert2 CSS --}}
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/sweetalert2/sweetalert2.min.css') }}">

    {{-- AdminLTE CSS --}}
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/adminlte.min.css') }}">

    {{-- Admin Layout Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/admin/admin-layout.css') }}?v={{ filemtime(public_path('css/admin/admin-layout.css')) }}">

    @yield('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    {{-- Top Navbar --}}
    @include('admin.layouts.partials.navbar')

    {{-- Sidebar --}}
    @include('admin.layouts.partials.sidebar')

    {{-- Content Wrapper --}}
    <div class="content-wrapper">
        {{-- Page Header --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('header_title', 'Dashboard')</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}" class="text-success">Admin</a>
                            </li>
                            <li class="breadcrumb-item active">@yield('header_title', 'Dashboard')</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <section class="content">
            <div class="container-fluid" style="padding-bottom: 48px;">
                @yield('content')
            </div>
        </section>
    </div>
    {{-- /.content-wrapper --}}

    {{-- Admin Footer --}}
    <footer class="main-footer text-sm">
        <strong>Copyright &copy; {{ date('Y') }}
            <a href="{{ route('home') }}" class="text-success">Dinas Kesehatan Kabupaten Cianjur</a>.
        </strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0.0
        </div>
    </footer>

</div>
{{-- /.wrapper --}}

{{-- Scripts --}}
@include('admin.layouts.partials.scripts')

@yield('scripts')
</body>
</html>
