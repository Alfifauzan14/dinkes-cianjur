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

    <!-- Gerbang Lapis 1: Gatekeeper Overlay via SweetAlert2 -->
    @if(!session()->get('gatekeeper_passed'))
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/sweetalert2/sweetalert2.min.css') }}">
    <style>
        .gate-swal-popup {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            border-radius: 3px !important;
            padding: 32px 28px !important;
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1) !important;
            border: 1px solid rgba(226, 232, 240, 0.9) !important;
        }
        .gate-swal-confirm-btn {
            background-color: #009966 !important;
            border-radius: 3px !important;
            font-weight: 700 !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            padding: 12px 24px !important;
            font-size: 14px !important;
            box-shadow: 0 4px 14px rgba(0, 153, 102, 0.25) !important;
        }
        .gate-swal-confirm-btn:hover {
            background-color: #007A52 !important;
        }
        .gate-swal-cancel-btn {
            background-color: #64748B !important;
            border-radius: 3px !important;
            font-weight: 700 !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            padding: 12px 24px !important;
            font-size: 14px !important;
        }
        .gate-swal-actions {
            gap: 12px !important;
            margin-top: 24px !important;
            width: 100% !important;
            justify-content: center !important;
        }
        .gate-swal-popup .step-indicator {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #F0FDF4;
            border: 1px solid #BBF7D0;
            padding: 6px 14px 6px 10px;
            border-radius: 9999px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.05em;
            color: #016639;
            width: fit-content;
            box-shadow: 0 1px 3px rgba(0, 79, 59, 0.06);
        }
        .gate-swal-popup .step-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #009966;
            box-shadow: 0 0 0 2px rgba(0, 153, 102, 0.2);
            animation: pulse-dot 2s infinite ease-in-out;
        }
        .gate-swal-popup .swal-gatekeeper-content .input-wrapper {
            margin-top: 6px;
        }
        .gate-swal-popup .swal-gatekeeper-content .input-wrapper input {
            padding: 13px 44px 13px 44px !important;
            height: auto !important;
        }
        .blur-content {
            filter: blur(8px);
            pointer-events: none;
            transition: filter 0.3s ease;
        }
    </style>
    @endif

    <div class="login-page-wrapper {{ !session()->get('gatekeeper_passed') ? 'blur-content' : '' }}">
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
    @if(!session()->get('gatekeeper_passed'))
    <script src="{{ asset('vendor/adminlte/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: 'Verifikasi Akses',
                html: `
                    <div class="swal-gatekeeper-content">
                        <div class="step-indicator" style="margin: 0 auto 16px auto; display: inline-flex;">
                            <span class="step-dot"></span>
                            <span>LANGKAH 1 DARI 2 &bull; KEAMANAN</span>
                        </div>
                        <p style="color: #64748B; font-size: 13.5px; font-weight: 500; margin-bottom: 20px; text-align: center; line-height: 1.5;">
                            Masukkan kredensial keamanan untuk melanjutkan
                        </p>
                        
                        <div class="input-group" style="text-align: left; margin-bottom: 16px;">
                            <label for="gate-username" style="font-size: 13px; font-weight: 700; color: #1E293B;">Username</label>
                            <div class="input-wrapper">
                                <span class="material-icons input-icon">badge</span>
                                <input type="text" id="gate-username" placeholder="Masukkan username..." required autocomplete="off">
                            </div>
                        </div>

                        <div class="input-group" style="text-align: left; margin-bottom: 8px;">
                            <label for="gate-password" style="font-size: 13px; font-weight: 700; color: #1E293B;">Password</label>
                            <div class="input-wrapper">
                                <span class="material-icons input-icon">lock</span>
                                <input type="password" id="gate-password" placeholder="Masukkan password..." required autocomplete="new-password">
                                <span class="material-icons toggle-password" data-target="gate-password">visibility</span>
                            </div>
                        </div>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Buka Akses',
                cancelButtonText: 'Kembali',
                confirmButtonColor: '#009966',
                cancelButtonColor: '#64748B',
                allowOutsideClick: false,
                allowEscapeKey: false,
                customClass: {
                    popup: 'gate-swal-popup',
                    actions: 'gate-swal-actions',
                    confirmButton: 'gate-swal-confirm-btn',
                    cancelButton: 'gate-swal-cancel-btn'
                },
                didOpen: () => {
                    // Password visibility toggle
                    const toggle = Swal.getPopup().querySelector('.toggle-password');
                    if (toggle) {
                        toggle.addEventListener('click', () => {
                            const targetInput = Swal.getPopup().querySelector('#gate-password');
                            if (targetInput) {
                                const isPassword = targetInput.getAttribute('type') === 'password';
                                targetInput.setAttribute('type', isPassword ? 'text' : 'password');
                                toggle.textContent = isPassword ? 'visibility_off' : 'visibility';
                            }
                        });
                    }
                    // Autofocus
                    const usernameInput = Swal.getPopup().querySelector('#gate-username');
                    if (usernameInput) usernameInput.focus();
                },
                preConfirm: async () => {
                    const username = Swal.getPopup().querySelector('#gate-username').value;
                    const password = Swal.getPopup().querySelector('#gate-password').value;

                    if (!username || !password) {
                        Swal.showValidationMessage('Username dan password harus diisi');
                        return false;
                    }

                    try {
                        const response = await fetch("{{ route('gatekeeper.verify') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                "Accept": "application/json"
                            },
                            body: JSON.stringify({ username, password })
                        });

                        const result = await response.json();

                        if (!response.ok || !result.success) {
                            throw new Error(result.message || 'Gagal verifikasi keamanan.');
                        }

                        return true;
                    } catch (error) {
                        Swal.showValidationMessage(error.message);
                        return false;
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                } else {
                    window.location.href = "/";
                }
            });
        });
    </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Password Visibility Toggle Logic
            document.querySelectorAll('#db-login-form .toggle-password').forEach(toggle => {
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
