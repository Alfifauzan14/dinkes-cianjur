{{-- ============================================================
     ADMIN NAVBAR PARTIAL
     Included by: resources/views/admin/layouts/admin.blade.php
     ============================================================ --}}
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    {{-- Left: Sidebar toggle + Portal link --}}
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('home') }}" target="_blank" class="nav-link text-success font-weight-bold">
                <span class="material-icons" style="font-size: 16px; vertical-align: middle;">open_in_new</span>
                Lihat Portal Utama
            </a>
        </li>
    </ul>

    {{-- Right: User dropdown --}}
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle d-flex align-items-center gap-2" data-toggle="dropdown">
                <span class="material-icons" style="font-size: 24px; color: #009966;">account_circle</span>
                <span class="d-none d-md-inline font-weight-bold text-dark">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="border-radius: 3px;">
                <li class="user-header bg-success text-white" style="background-color: #004F3B !important;">
                    <span class="material-icons" style="font-size: 54px;">account_circle</span>
                    <p>
                        {{ Auth::user()->name }}
                        <small>Administrator Dinkes Cianjur</small>
                    </p>
                </li>
                <li class="user-footer d-flex justify-content-center">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-flat">
                            <i class="fas fa-sign-out-alt mr-1"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>
