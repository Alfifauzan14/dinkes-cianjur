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
    {{-- Custom Stylesheet --}}
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}?v={{ time() }}">
</head>
<body>

    <div class="login-page-wrapper">
        <div class="login-split-card">
            <!-- Left Side: Green Info Panel with Waves -->
            <div class="login-visual-panel">

                <!-- Dekorasi CSS-only: dot grid + orb blur -->
                <div class="vp-orb vp-orb-1"></div>
                <div class="vp-orb vp-orb-2"></div>
                <div class="vp-dot-grid"></div>

                <div class="visual-header">
                    <div class="vp-eyebrow">Dinas Kesehatan Kabupaten Cianjur</div>
                    <h1 class="visual-title">Satu Portal,<br>Satu Layanan.</h1>
                    <p class="visual-desc">Platform manajemen kesehatan terpadu yang menghubungkan data, pelayanan, dan masyarakat dalam satu sistem yang andal.</p>
                </div>

                <div class="visual-quote">
                    "Kesehatan bukan sekadar program — ia adalah janji kami kepada masyarakat."
                </div>

                <!-- 5-Layer Wave decoration -->
                <div class="waves-decor">
                    <!-- Layer 1: Ombak pendek, puncak di kiri -->
                    <svg class="wave-svg wave-1" viewBox="0 0 1440 200" preserveAspectRatio="none">
                        <path fill="#ffffff" fill-opacity="0.2" d="M0,80 C180,20 360,160 540,80 C720,0 900,140 1080,80 C1260,20 1350,60 1440,80 L1440,200 L0,200 Z"></path>
                    </svg>
                    <!-- Layer 2: Ombak fase berbeda, puncak di tengah -->
                    <svg class="wave-svg wave-2" viewBox="0 0 1440 200" preserveAspectRatio="none">
                        <path fill="#ffffff" fill-opacity="0.2" d="M0,100 C120,160 300,20 480,100 C660,180 840,20 1020,100 C1200,180 1320,140 1440,120 L1440,200 L0,200 Z"></path>
                    </svg>
                    <!-- Layer 3: Ombak lebih lebar & dalam -->
                    <svg class="wave-svg wave-3" viewBox="0 0 1440 200" preserveAspectRatio="none">
                        <path fill="#ffffff" fill-opacity="0.2" d="M0,60 C240,160 480,0 720,80 C960,160 1200,40 1440,100 L1440,200 L0,200 Z"></path>
                    </svg>
                    <!-- Layer 4: Ombak pelan & panjang -->
                    <svg class="wave-svg wave-4" viewBox="0 0 1440 200" preserveAspectRatio="none">
                        <path fill="#ffffff" fill-opacity="0.2" d="M0,120 C160,60 320,160 480,120 C640,80 800,160 960,100 C1120,40 1280,120 1440,80 L1440,200 L0,200 Z"></path>
                    </svg>
                    <!-- Layer 5: Ombak sangat halus -->
                    <svg class="wave-svg wave-5" viewBox="0 0 1440 200" preserveAspectRatio="none">
                        <path fill="#ffffff" fill-opacity="0.2" d="M0,140 C200,80 400,160 600,130 C800,100 1000,160 1200,130 C1300,115 1380,120 1440,110 L1440,200 L0,200 Z"></path>
                    </svg>
                </div>
            </div>

            <!-- Right Side: Clean Form Panel -->
            <div class="login-form-panel">
                <div class="form-header">
                    <h2 class="form-title">Selamat Datang</h2>
                    <p class="form-subtitle">Masukkan kredensial akun database Anda</p>
                </div>

                <form action="{{ route('login') }}" method="POST" class="main-login-form">
                    @csrf

                    <div class="input-group">
                        <label for="email">Alamat Email</label>
                        <div class="input-wrapper {{ $errors->has('email') ? 'error-border' : '' }}">
                            <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="admin@dinkes.go.id" required autofocus>
                        </div>
                        @error('email')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="password">Password</label>
                        <div class="input-wrapper">
                            <input type="password" name="password" id="password" placeholder="••••••••" required>
                        </div>
                    </div>

                    <div class="form-options">
                        <label class="remember-me">
                            <input type="checkbox" name="remember" id="remember">
                            <span>Ingat saya</span>
                        </label>
                        <a href="#" class="forgot-password">Lupa password?</a>
                    </div>

                    <button type="submit" class="submit-btn">Masuk Sekarang</button>
                </form>

                <footer class="form-footer">
                    &copy; 2026 Dinas Kesehatan. All rights reserved.
                </footer>
            </div>
        </div>
    </div>

</body>
</html>
