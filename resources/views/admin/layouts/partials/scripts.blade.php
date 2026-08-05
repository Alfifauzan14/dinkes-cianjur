{{-- ============================================================
     ADMIN SCRIPTS PARTIAL
     Included by: resources/views/admin/layouts/admin.blade.php
     ============================================================ --}}

{{-- Local AdminLTE & Vendor Scripts --}}
<script src="{{ asset('vendor/adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/js/adminlte.min.js') }}"></script>

{{-- SweetAlert2 (offline) --}}
<script src="{{ asset('vendor/adminlte/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>

{{-- Pass session data safely to JS --}}
<div id="session-alert-data"
     style="display: none;"
     data-success="{{ session('success') }}"
     data-error="{{ session('error') }}"
     data-errors="{{ $errors->any() ? json_encode($errors->all()) : '' }}">
</div>

<script>
    // ── SweetAlert2: Confirm Delete ─────────────────────────────────
    window.confirmDelete = function(formId) {
        Swal.fire({
            title: 'Hapus Data?',
            text: 'Data yang dihapus tidak dapat dikembalikan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            focusCancel: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
    };

    // ── SweetAlert2: Toast Notification ────────────────────────────
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

    // ── SweetAlert2: Logout Confirm ─────────────────────────────────
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

    // ── Auto Show Session Toast ─────────────────────────────────────
    const sessionAlertEl = document.getElementById('session-alert-data');
    if (sessionAlertEl) {
        const successMessage = sessionAlertEl.dataset.success;
        const errorMessage   = sessionAlertEl.dataset.error;
        const errorsJson     = sessionAlertEl.dataset.errors;

        document.addEventListener('DOMContentLoaded', function() {
            if (successMessage) showToast('success', successMessage);
            if (errorMessage)   showToast('error', errorMessage);
            if (errorsJson) {
                try {
                    const errors = JSON.parse(errorsJson);
                    if (errors && errors.length > 0) {
                        let html = '<ul class="text-left pl-3" style="font-size:14px;list-style-type:disc;">';
                        errors.forEach(function(e) {
                            const safe = e.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;').replace(/'/g,'&#039;');
                            html += '<li>' + safe + '</li>';
                        });
                        html += '</ul>';
                        Swal.fire({ title: 'Periksa Kembali Form Anda', html, icon: 'error', confirmButtonColor: '#dc3545', confirmButtonText: 'Tutup' });
                    }
                } catch (err) { console.error('Failed to parse validation errors:', err); }
            }
        });
    }

    // ── View Count Auto-increment ───────────────────────────────────
    $(document).ready(function() {
        $('.view-count-link').on('click', function() {
            let span = $(this).find('.views-num');
            if (span.length) span.text((parseInt(span.text()) || 0) + 1);
        });
    });
</script>
