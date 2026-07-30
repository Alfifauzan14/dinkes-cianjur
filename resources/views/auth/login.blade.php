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
                <div class="visual-header">
                    <h1 class="visual-title">Portal Admin<br>Dinas Kesehatan</h1>
                    <p class="visual-desc">Sistem pendataan terpadu untuk pelayanan kesehatan masyarakat yang lebih baik.</p>
                </div>

                <div class="visual-quote">
                    "Kesehatan masyarakat adalah prioritas utama kita."
                </div>

                <!-- 5-Layer Waves decoration -->
                <div class="waves-decor">
                    <!-- Layer 1 (Opacity 20%) -->
                    <svg class="wave-svg wave-1" viewBox="0 0 1440 320" preserveAspectRatio="none">
                        <path fill="#ffffff" fill-opacity="0.2" d="M0,128L48,144C96,160,192,192,288,186.7C384,181,480,139,576,149.3C672,160,768,224,864,224C960,224,1056,160,1152,144C1248,128,1344,160,1392,176L1440,192L1440,320L0,320Z"></path>
                    </svg>
                    <!-- Layer 2 (Opacity 20%) -->
                    <svg class="wave-svg wave-2" viewBox="0 0 1440 320" preserveAspectRatio="none">
                        <path fill="#ffffff" fill-opacity="0.2" d="M0,192L48,181.3C96,171,192,149,288,160C384,171,480,213,576,229.3C672,245,768,235,864,213C960,192,1056,160,1152,165.3C1248,171,1344,213,1392,234.7L1440,256L1440,320L0,320Z"></path>
                    </svg>
                    <!-- Layer 3 (Opacity 20%) -->
                    <svg class="wave-svg wave-3" viewBox="0 0 1440 320" preserveAspectRatio="none">
                        <path fill="#ffffff" fill-opacity="0.2" d="M0,96L48,112C96,128,192,160,288,186.7C384,213,480,235,576,218.7C672,203,768,149,864,138.7C960,128,1056,160,1152,181.3C1248,203,1344,213,1392,218.7L1440,224L1440,320L0,320Z"></path>
                    </svg>
                    <!-- Layer 4 (Opacity 20%) -->
                    <svg class="wave-svg wave-4" viewBox="0 0 1440 320" preserveAspectRatio="none">
                        <path fill="#ffffff" fill-opacity="0.2" d="M0,224L48,208C96,192,192,160,288,165.3C384,171,480,213,576,229.3C672,245,768,235,864,208C960,181,1056,128,1152,138.7C1248,149,1344,224,1392,261.3L1440,298.7L1440,320L0,320Z"></path>
                    </svg>
                    <!-- Layer 5 (Opacity 20%) -->
                    <svg class="wave-svg wave-5" viewBox="0 0 1440 320" preserveAspectRatio="none">
                        <path fill="#ffffff" fill-opacity="0.2" d="M0,64L48,90.7C96,117,192,171,288,181.3C384,192,480,160,576,144C672,128,768,128,864,149.3C960,171,1056,213,1152,224C1248,235,1344,213,1392,202.7L1440,192L1440,320L0,320Z"></path>
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
