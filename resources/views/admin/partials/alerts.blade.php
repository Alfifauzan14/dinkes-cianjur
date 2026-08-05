{{-- ============================================================
     ADMIN ALERTS PARTIAL
     Standar alert AdminLTE. Dipakai oleh halaman admin agar
     tampilan pesan sukses/error konsisten di seluruh panel.
     ============================================================ --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 6px; margin-bottom: 20px;">
        <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 6px; margin-bottom: 20px;">
        <i class="fas fa-exclamation-triangle mr-1"></i> {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
