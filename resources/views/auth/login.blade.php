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

    <!-- Gerbang Lapis 1: Gatekeeper Overlay -->
    @if(!session()->get('gatekeeper_passed'))
    <div id="gatekeeper-overlay" class="gate-overlay">
        <div class="gate-card">
            <div class="gate-header">
                <span class="material-icons gate-lock-icon">security</span>
                <h2 class="gate-title">Akses Terbatas</h2>
                <p class="gate-subtitle">Masukkan kredensial gerbang untuk melanjutkan</p>
            </div>
            
            <form id="gatekeeper-form" class="gate-form">
                @csrf
                <div class="input-group">
                    <label for="gate-username">Username Gerbang</label>
                    <div class="input-wrapper">
                        <input type="text" id="gate-username" placeholder="Masukkan username..." required style="width: 100%; border: 1px solid #D1D5DB; border-radius: 6px; padding: 14px 16px; font-size: 15px; outline: none; box-sizing: border-box;">
                    </div>
                </div>

                <div class="input-group">
                    <label for="gate-password">Password Gerbang</label>
                    <div class="input-wrapper">
                        <input type="password" id="gate-password" placeholder="Masukkan password..." required style="width: 100%; border: 1px solid #D1D5DB; border-radius: 6px; padding: 14px 16px; font-size: 15px; outline: none; box-sizing: border-box;">
                    </div>
                </div>

                <div id="gate-error-msg" class="error-msg">Username atau Password Gerbang salah!</div>

                <div style="display: flex; gap: 12px; width: 100%;">
                    <button type="submit" id="gate-submit-btn" class="submit-btn" style="flex: 1;">Buka Gerbang</button>
                    <button type="button" id="gate-cancel-btn" class="submit-btn" style="flex: 1; background-color: #6B7280; box-shadow: 0 4px 12px rgba(107, 114, 128, 0.1);">Batal</button>
                </div>
            </form>
        </div>
    </div>
    @endif

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

                <form action="{{ route('login') }}" method="POST" id="db-login-form" class="main-login-form">
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

    <!-- JavaScript Double-Gatekeeper & AJAX Logic -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const overlay = document.getElementById('gatekeeper-overlay');
            const gateForm = document.getElementById('gatekeeper-form');
            const gateCard = document.querySelector('.gate-card');
            const gateErrorMsg = document.getElementById('gate-error-msg');
            const gateCancelBtn = document.getElementById('gate-cancel-btn');
            
            const dbLoginForm = document.getElementById('db-login-form');
            
            let failedAttempts = 0;

            // Handle Gatekeeper Batal (Cancel) button
            if (gateCancelBtn) {
                gateCancelBtn.addEventListener('click', () => {
                    alert("Akses Ditolak! Kembali ke Beranda.");
                    window.location.href = "/";
                });
            }

            // AJAX Lapis 1: Gatekeeper Verification
            if (gateForm) {
                gateForm.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    
                    const username = document.getElementById('gate-username').value;
                    const password = document.getElementById('gate-password').value;
                    const token = gateForm.querySelector('input[name="_token"]').value;

                    try {
                        const response = await fetch("{{ route('gatekeeper.verify') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": token,
                                "Accept": "application/json"
                            },
                            body: JSON.stringify({ username, password })
                        });

                        const result = await response.json();

                        if (response.ok && result.success) {
                            // Gerbang terbuka: sembunyikan overlay dengan animasi fade-out
                            overlay.classList.add('fade-out');
                            setTimeout(() => {
                                overlay.remove();
                            }, 400);
                        } else {
                            throw new Error(result.message || "Gagal membuka gerbang.");
                        }
                    } catch (error) {
                        failedAttempts++;
                        gateErrorMsg.textContent = error.message;
                        gateErrorMsg.style.display = 'block';
                        
                        // Shake effect
                        gateCard.classList.add('shake');
                        setTimeout(() => {
                            gateCard.classList.remove('shake');
                        }, 500);

                        // Batas percobaan salah
                        if (failedAttempts >= 3) {
                            alert("Terlalu banyak percobaan salah! Akses ditolak.");
                            window.location.href = "/";
                        }
                    }
                });
            }

            // AJAX Lapis 2: Database Login Form Submission
            if (dbLoginForm) {
                dbLoginForm.addEventListener('submit', async (e) => {
                    e.preventDefault();

                    const email = document.getElementById('email').value;
                    const password = document.getElementById('password').value;
                    const remember = document.getElementById('remember').checked;
                    const token = dbLoginForm.querySelector('input[name="_token"]').value;

                    // Bersihkan error lama
                    const existingErrors = dbLoginForm.querySelectorAll('.field-error');
                    existingErrors.forEach(el => el.remove());
                    const inputWrappers = dbLoginForm.querySelectorAll('.input-wrapper');
                    inputWrappers.forEach(el => el.classList.remove('error-border'));

                    try {
                        const response = await fetch("{{ route('login.post') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": token,
                                "Accept": "application/json"
                            },
                            body: JSON.stringify({ email, password, remember })
                        });

                        const result = await response.json();

                        if (response.ok && result.success) {
                            // Login berhasil: Arahkan ke Dashboard Admin
                            window.location.href = "{{ route('admin.dashboard') }}";
                        } else {
                            throw new Error(result.message || "Kredensial database salah!");
                        }
                    } catch (error) {
                        alert("Gagal masuk: " + error.message);
                        
                        // Tampilkan error di bawah input email
                        const emailInputGroup = document.getElementById('email').closest('.input-group');
                        const inputWrapper = emailInputGroup.querySelector('.input-wrapper');
                        inputWrapper.classList.add('error-border');

                        const errorSpan = document.createElement('span');
                        errorSpan.className = 'field-error';
                        errorSpan.textContent = error.message;
                        emailInputGroup.appendChild(errorSpan);
                    }
                });
            }
        });
    </script>

</body>
</html>
