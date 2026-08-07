<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Akses Ditolak — Dinkes Cianjur</title>
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/admin-layout.css') }}?v={{ filemtime(public_path('css/admin/admin-layout.css')) }}">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #F1F5F9; }
        .access-denied { min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .access-denied .card { border-radius: 8px; box-shadow: 0 4px 24px rgba(0,0,0,0.08); }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="access-denied">
    <div class="card card-outline card-success" style="max-width:420px; width:100%;">
        <div class="card-header d-flex align-items-center justify-content-between" style="padding:16px 20px; background:#FFF; border-bottom:1px solid #E2E8F0;">
            <span class="font-weight-bold" style="color:#1E293B;">Akses Ditolak</span>
        </div>
        <div class="card-body text-center py-5">
            <span class="material-icons" style="font-size:64px; color:#DC2626;">shield</span>
            <h4 class="mt-3 mb-2" style="color:#1E293B;">Anda Tidak Memiliki Akses</h4>
            <p class="text-muted mb-4" style="font-size:14px;">Halaman ini khusus untuk admin. Jika Anda bukan admin, silakan hubungi administrator.</p>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-success">
                <span class="material-icons" style="font-size:16px;">home</span> Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>
</body>
</html>