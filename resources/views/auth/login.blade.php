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
            <div class="gate-card-top-accent"></div>
            
            <div class="step-indicator">
                <span class="step-dot"></span>
                <span>LANGKAH 1 DARI 2 &bull; KEAMANAN</span>
            </div>

            <div class="gate-header">
                <div class="gate-icon-badge">
                    <span class="material-icons">gpp_good</span>
                </div>
                <h2 class="gate-title">Verifikasi Akses</h2>
                <p class="gate-subtitle">Masukkan kredensial keamanan untuk melanjutkan</p>
            </div>
            
            <div id="gate-error-banner" class="alert-banner error"></div>

            <form id="gatekeeper-form" class="main-login-form">
                @csrf
                <div class="input-group">
                    <label for="gate-username">Username</label>
                    <div class="input-wrapper">
                        <span class="material-icons input-icon">badge</span>
                        <input type="text" id="gate-username" placeholder="Masukkan username..." required autofocus autocomplete="off">
                    </div>
                </div>

                <div class="input-group">
                    <label for="gate-password">Password</label>
                    <div class="input-wrapper">
                        <span class="material-icons input-icon">lock</span>
                        <input type="password" id="gate-password" placeholder="Masukkan password..." required autocomplete="off">
                        <span class="material-icons toggle-password" data-target="gate-password">visibility</span>
                    </div>
                </div>

                <div style="display: flex; gap: 12px; margin-top: 8px;">
                    <button type="submit" id="gate-submit-btn" class="submit-btn" style="flex: 2;">
                        <span class="btn-spinner" id="gate-spinner"></span>
                        <span class="btn-text">Buka Akses</span>
                    </button>
                    <button type="button" id="gate-cancel-btn" class="submit-btn" style="flex: 1; background: #64748B; box-shadow: none;">
                        <span>Kembali</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <div class="login-page-wrapper">
        <div class="login-split-card">
            <!-- Left Side: Full-bleed illustration -->
            <div class="login-visual-panel"></div>

            <!-- Right Side: Clean Form Panel -->
            <div class="login-form-panel">
                <div>
                    <div class="step-indicator">
                        <span class="step-dot" style="background: #004F3B;"></span>
                        <span>LANGKAH 2 DARI 2 &bull; AUTENTIKASI AKUN</span>
                    </div>

                    <div class="form-header">
                        <h2 class="form-title">Selamat Datang</h2>
                        <p class="form-subtitle">Masukkan alamat email dan password akun terdaftar Anda</p>
                    </div>

                    <div id="db-error-banner" class="alert-banner error" style="margin-bottom: 16px;"></div>

                    <form action="{{ route('login') }}" method="POST" id="db-login-form" class="main-login-form">
                        @csrf

                        <div class="input-group">
                            <label for="email">Alamat Email</label>
                            <div class="input-wrapper {{ $errors->has('email') ? 'error-border' : '' }}">
                                <span class="material-icons input-icon">email</span>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="admin@dinkes.go.id" required autofocus autocomplete="username">
                            </div>
                            @error('email')
                                <span class="field-error"><span class="material-icons" style="font-size:14px;">error</span> {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group">
                            <label for="password">Password</label>
                            <div class="input-wrapper">
                                <span class="material-icons input-icon">lock</span>
                                <input type="password" name="password" id="password" placeholder="••••••••" required autocomplete="current-password">
                                <span class="material-icons toggle-password" data-target="password">visibility</span>
                            </div>
                        </div>

                        <div class="form-options">
                            <label class="remember-me">
                                <input type="checkbox" name="remember" id="remember">
                                <span>Ingat saya di perangkat ini</span>
                            </label>
                        </div>

                        <button type="submit" id="db-submit-btn" class="submit-btn">
                            <span class="btn-spinner" id="db-spinner"></span>
                            <span class="btn-text">Masuk Sekarang</span>
                        </button>
                    </form>
                </div>

                <footer class="form-footer">
                    &copy; 2026 Dinas Kesehatan Kabupaten Cianjur. All rights reserved.
                </footer>
            </div>
        </div>
    </div>

    <!-- JavaScript Interactive Logic -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Password Visibility Toggle Logic
            document.querySelectorAll('.toggle-password').forEach(toggle => {
                toggle.addEventListener('click', () => {
                    const targetId = toggle.getAttribute('data-target');
                    const targetInput = document.getElementById(targetId);
                    if (targetInput) {
                        const isPassword = targetInput.getAttribute('type') === 'password';
                        targetInput.setAttribute('type', isPassword ? 'text' : 'password');
                        toggle.textContent = isPassword ? 'visibility_off' : 'visibility';
                    }
                });
            });

            // Gatekeeper Lapis 1 Logic
            const overlay = document.getElementById('gatekeeper-overlay');
            const gateForm = document.getElementById('gatekeeper-form');
            const gateCard = document.querySelector('.gate-card');
            const gateErrorBanner = document.getElementById('gate-error-banner');
            const gateCancelBtn = document.getElementById('gate-cancel-btn');
            const gateSubmitBtn = document.getElementById('gate-submit-btn');
            const gateSpinner = document.getElementById('gate-spinner');

            if (gateCancelBtn) {
                gateCancelBtn.addEventListener('click', () => {
                    window.location.href = "/";
                });
            }

            if (gateForm) {
                gateForm.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    
                    const username = document.getElementById('gate-username').value;
                    const password = document.getElementById('gate-password').value;
                    const token = gateForm.querySelector('input[name="_token"]').value;

                    // UI Loading State
                    gateSubmitBtn.disabled = true;
                    gateSpinner.style.display = 'inline-block';
                    gateErrorBanner.style.display = 'none';

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
                            overlay.classList.add('fade-out');
                            setTimeout(() => {
                                overlay.remove();
                                document.getElementById('email').focus();
                            }, 400);
                        } else {
                            throw new Error(result.message || "Gagal verifikasi keamanan.");
                        }
                    } catch (error) {
                        gateErrorBanner.textContent = error.message;
                        gateErrorBanner.style.display = 'block';
                        
                        gateCard.classList.add('shake');
                        setTimeout(() => {
                            gateCard.classList.remove('shake');
                        }, 500);
                    } finally {
                        gateSubmitBtn.disabled = false;
                        gateSpinner.style.display = 'none';
                    }
                });
            }

            // Database Login Lapis 2 Logic
            const dbLoginForm = document.getElementById('db-login-form');
            const dbSubmitBtn = document.getElementById('db-submit-btn');
            const dbSpinner = document.getElementById('db-spinner');
            const dbErrorBanner = document.getElementById('db-error-banner');

            if (dbLoginForm) {
                dbLoginForm.addEventListener('submit', async (e) => {
                    e.preventDefault();

                    const email = document.getElementById('email').value;
                    const password = document.getElementById('password').value;
                    const remember = document.getElementById('remember').checked;
                    const token = dbLoginForm.querySelector('input[name="_token"]').value;

                    dbSubmitBtn.disabled = true;
                    dbSpinner.style.display = 'inline-block';
                    dbErrorBanner.style.display = 'none';

                    // Clear field error borders
                    document.querySelectorAll('.input-wrapper').forEach(el => el.classList.remove('error-border'));
                    document.querySelectorAll('.field-error').forEach(el => el.remove());

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
                            window.location.href = "{{ route('admin.dashboard') }}";
                        } else {
                            throw new Error(result.message || "Kredensial database tidak cocok.");
                        }
                    } catch (error) {
                        dbErrorBanner.textContent = error.message;
                        dbErrorBanner.style.display = 'block';

                        const emailWrapper = document.getElementById('email').closest('.input-wrapper');
                        if (emailWrapper) emailWrapper.classList.add('error-border');
                    } finally {
                        dbSubmitBtn.disabled = false;
                        dbSpinner.style.display = 'none';
                    }
                });
            }
        });
    </script>
</body>
</html>
