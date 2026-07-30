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

    <!-- Lapis 1: Gatekeeper Modal -->
    <div id="gatekeeper-overlay" class="gate-overlay {{ $errors->any() || old('email') ? 'hidden' : '' }}">
        <div class="gate-card">
            <div class="gate-header">
                <span class="material-icons gate-lock-icon">security</span>
                <h2 class="gate-title">Akses Terbatas</h2>
                <p class="gate-subtitle">Masukkan kredensial gerbang untuk melanjutkan</p>
            </div>
            
            <div class="gate-form">
                <div class="input-group">
                    <label for="gate-username">Username Gerbang</label>
                    <div class="input-wrapper">
                        <span class="material-icons input-icon">person</span>
                        <input type="text" id="gate-username" placeholder="Masukkan username...">
                    </div>
                </div>

                <div class="input-group">
                    <label for="gate-password">Password Gerbang</label>
                    <div class="input-wrapper">
                        <span class="material-icons input-icon">lock</span>
                        <input type="password" id="gate-password" placeholder="Masukkan password...">
                    </div>
                </div>

                <div id="gate-error-msg" class="error-msg">Username atau Password Gerbang salah!</div>

                <button type="button" id="gate-submit-btn" class="submit-btn">Buka Gerbang</button>
            </div>
        </div>
    </div>

    <!-- Lapis 2: Main Database Login Form -->
    <div id="login-container" class="login-container {{ $errors->any() || old('email') ? 'visible' : '' }}">
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

    <!-- JavaScript logic -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const overlay = document.getElementById('gatekeeper-overlay');
            const loginContainer = document.getElementById('login-container');
            const submitBtn = document.getElementById('gate-submit-btn');
            const userField = document.getElementById('gate-username');
            const passField = document.getElementById('gate-password');
            const errorMsg = document.getElementById('gate-error-msg');
            const gateCard = document.querySelector('.gate-card');

            let attempts = 0;

            const verifyGate = () => {
                const username = userField.value;
                const password = passField.value;

                // Kredensial gerbang Lapis 1
                if (username === 'admin' && password === 'dinkes2026') {
                    // Berhasil, sembunyikan modal dengan transisi
                    overlay.classList.add('fade-out');
                    setTimeout(() => {
                        overlay.style.display = 'none';
                        loginContainer.classList.add('visible');
                    }, 400);
                } else {
                    // Salah, beri efek shake & tampilkan error
                    attempts++;
                    errorMsg.style.display = 'block';
                    gateCard.classList.add('shake');
                    
                    // Reset input
                    userField.value = '';
                    passField.value = '';
                    
                    setTimeout(() => {
                        gateCard.classList.remove('shake');
                    }, 500);

                    // Redirect ke home jika salah 3x
                    if (attempts >= 3) {
                        alert('Terlalu banyak percobaan salah. Mengalihkan ke Beranda...');
                        window.location.href = '/';
                    }
                }
            };

            // Event Listeners
            submitBtn.addEventListener('click', verifyGate);

            // Press enter to submit
            const handleEnter = (e) => {
                if (e.key === 'Enter') {
                    verifyGate();
                }
            };
            userField.addEventListener('keydown', handleEnter);
            passField.addEventListener('keydown', handleEnter);
        });
    </script>
</body>
</html>
