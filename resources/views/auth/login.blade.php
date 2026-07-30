<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal Admin - Dinas Kesehatan Kabupaten Cianjur</title>
    {{-- Google Fonts: Plus Jakarta Sans --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    {{-- Material Icons --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    {{-- Custom Stylesheet --}}
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}?v={{ time() }}">
</head>
<body>

    <div class="login-page-wrapper">
        <!-- Panel Kiri: Tagline & Ombak 5 Layer -->
        <div class="login-left-panel">
            <div class="wave-layer wave-layer-1"></div>
            <div class="wave-layer wave-layer-2"></div>
            <div class="wave-layer wave-layer-3"></div>
            <div class="wave-layer wave-layer-4"></div>
            <div class="wave-layer wave-layer-5"></div>
            
            <div class="left-panel-content">
                <span class="left-dinkes">Dinas Kesehatan</span>
                <h1 class="left-title">Portal Admin</h1>
                <p class="left-desc">Sistem pendataan terpadu untuk pelayanan kesehatan masyarakat yang lebih baik.</p>
                <div class="left-quote">
                    <span class="material-icons quote-icon">format_quote</span>
                    <p class="quote-text">"Kesehatan masyarakat adalah prioritas utama kita."</p>
                </div>
            </div>
        </div>

        <!-- Panel Kanan: Form Login -->
        <div class="login-right-panel">
            <div class="login-card">
                <div class="login-header">
                    <img src="{{ asset('Assets/layouts/Nav/logo_dinkes_cropped.png') }}" alt="Logo Dinkes Cianjur" class="login-logo">
                    <h2 class="login-title">Sign In Admin</h2>
                    <p class="login-subtitle">Masuk menggunakan akun database resmi Anda</p>
                </div>

                <form action="{{ route('login') }}" method="POST" class="login-form">
                    @csrf

                    <div class="input-group">
                        <label for="email">Alamat Email</label>
                        <div class="input-wrapper {{ $errors->has('email') ? 'error-border' : '' }}">
                            <span class="material-icons input-icon">email</span>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="admin@dinkes.mail" required autofocus>
                        </div>
                        @error('email')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="password">Password Akun</label>
                        <div class="input-wrapper {{ $errors->has('email') ? 'error-border' : '' }}">
                            <span class="material-icons input-icon">vpn_key</span>
                            <input type="password" name="password" id="password" placeholder="••••••••" required>
                        </div>
                    </div>

                    <button type="submit" class="submit-btn">Masuk Portal</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
