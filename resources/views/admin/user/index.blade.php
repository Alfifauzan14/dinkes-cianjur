@extends('admin.layouts.admin')

@section('title', 'Manajemen Pengguna')
@section('header_title', 'Manajemen Pengguna')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-3" style="gap:8px; border-radius: 3px;">
        <span class="material-icons">check_circle</span>
        <span>{{ session('success') }}</span>
        <button type="button" class="close ml-auto" data-dismiss="alert"><span>&times;</span></button>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mb-3" style="gap:8px; border-radius: 3px;">
        <span class="material-icons">error</span>
        <span>{{ session('error') }}</span>
        <button type="button" class="close ml-auto" data-dismiss="alert"><span>&times;</span></button>
    </div>
@endif

<div class="card card-outline card-success">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between" style="gap: 12px; padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
        <span class="d-flex align-items-center" style="gap: 8px;">
            <span class="material-icons text-success" style="font-size: 20px;">people</span>
            <span class="font-weight-bold card-title-label">Daftar Pengguna Sistem</span>
        </span>
        <div class="d-flex flex-wrap align-items-center ml-auto" style="gap: 8px;">
            <form action="{{ route('admin.users.index') }}" method="GET" class="d-flex align-items-center" style="margin: 0; gap: 6px;">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama atau email..." value="{{ request('search') }}" style="width: 220px; border-radius: 3px;">
                <button type="submit" class="btn btn-sm btn-success font-weight-bold d-flex align-items-center" style="gap: 4px; border-radius: 3px;">
                    <span class="material-icons" style="font-size: 16px;">search</span> Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-secondary" style="border-radius: 3px;">Reset</a>
                @endif
            </form>
            <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-success font-weight-bold d-flex align-items-center" style="gap: 4px; border-radius: 3px;">
                <span class="material-icons" style="font-size: 16px;">add</span> Tambah Pengguna
            </a>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 60px; padding-left: 20px;">No</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th class="text-center" style="width: 120px;">Peran (Role)</th>
                        <th class="text-center" style="width: 120px;">Status</th>
                        <th class="text-center" style="width: 180px; padding-right: 20px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $idx => $user)
                    <tr>
                        <td class="text-center align-middle text-muted" style="padding-left: 20px;">{{ $users->firstItem() + $idx }}</td>
                        <td class="align-middle font-weight-bold text-dark">{{ $user->name }}</td>
                        <td class="align-middle text-secondary" style="font-size: 13.5px;">{{ $user->email }}</td>
                        <td class="text-center align-middle">
                            @if($user->is_admin)
                                <span class="badge" style="background-color: #004F3B; color: #FFFFFF; padding: 4px 10px; border-radius: 3px; font-size: 11.5px; font-weight: 700;">Admin</span>
                            @else
                                <span class="badge" style="background-color: #64748B; color: #FFFFFF; padding: 4px 10px; border-radius: 3px; font-size: 11.5px; font-weight: 700;">Staf</span>
                            @endif
                        </td>
                        <td class="text-center align-middle">
                            @if($user->is_active)
                                <span class="badge" style="background-color: #DEF7EC; color: #03543F; padding: 4px 10px; border-radius: 3px; font-size: 11.5px; font-weight: 700;">Aktif</span>
                            @else
                                <span class="badge" style="background-color: #FDE8E8; color: #9B1C1C; padding: 4px 10px; border-radius: 3px; font-size: 11.5px; font-weight: 700;">Nonaktif</span>
                            @endif
                        </td>
                        <td class="text-center align-middle" style="white-space: nowrap; padding-right: 20px;">
                            <div class="btn-action-group" style="justify-content: center;">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn-action btn-action-edit" title="Edit Pengguna">
                                    <span class="material-icons" style="font-size: 15px;">edit</span>
                                </a>
                                <button type="button" class="btn-action btn-action-view" title="Reset Password" data-toggle="modal" data-target="#modalResetPassword{{ $user->id }}">
                                    <span class="material-icons" style="font-size: 15px;">lock_reset</span>
                                </button>
                                @if($user->is_active)
                                <form action="{{ route('admin.users.toggle-active', $user) }}" method="POST" id="toggle-user-{{ $user->id }}" class="d-none">
                                    @csrf @method('POST')
                                </form>
                                <button type="button" class="btn-action btn-action-warning" title="Nonaktifkan Akun" onclick="confirmAction('Nonaktifkan Pengguna?', 'Status akun {{ $user->name }} akan dinonaktifkan.', function() { document.getElementById('toggle-user-{{ $user->id }}').submit(); }, '<span class=\'material-icons\' style=\'font-size:16px;vertical-align:middle;\'>block</span> Nonaktifkan', '#ffc107', 'warning')">
                                    <span class="material-icons" style="font-size: 15px;">block</span>
                                </button>
                                @else
                                <form action="{{ route('admin.users.toggle-active', $user) }}" method="POST" id="toggle-user-{{ $user->id }}" class="d-none">
                                    @csrf @method('POST')
                                </form>
                                <button type="button" class="btn-action btn-action-success" title="Aktifkan Akun" onclick="confirmAction('Aktifkan Pengguna?', 'Status akun {{ $user->name }} akan diaktifkan kembali.', function() { document.getElementById('toggle-user-{{ $user->id }}').submit(); }, '<span class=\'material-icons\' style=\'font-size:16px;vertical-align:middle;\'>check_circle</span> Aktifkan', '#009966', 'question')">
                                    <span class="material-icons" style="font-size: 15px;">check_circle</span>
                                </button>
                                @endif
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" id="del-user-{{ $user->id }}" class="d-none">
                                    @csrf @method('DELETE')
                                </form>
                                <button type="button" class="btn-action btn-action-delete" title="Hapus Pengguna" onclick="confirmDelete('del-user-{{ $user->id }}')">
                                    <span class="material-icons" style="font-size: 15px;">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- Modal Reset Password --}}
                    <div class="modal fade" id="modalResetPassword{{ $user->id }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 440px;">
                            <div class="modal-content" style="border-radius: 3px; border: 1px solid #E2E8F0;">
                                <div class="modal-header" style="background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0; padding: 16px 20px;">
                                    <h5 class="modal-title font-weight-bold d-flex align-items-center" style="font-size: 15px; color: #004F3B; gap: 6px; margin: 0;">
                                        <span class="material-icons text-success" style="font-size: 20px;">lock_reset</span>
                                        <span>Reset Password — {{ $user->name }}</span>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                </div>
                                <form action="{{ route('admin.users.reset-password', $user) }}" method="POST">
                                    @csrf
                                    <div class="modal-body p-4">
                                        <div class="form-group mb-3">
                                            <label class="font-weight-bold" style="font-size: 13px; color: #1E293B;">Password Baru <span class="text-danger">*</span></label>
                                            <input type="password" name="password" class="form-control" required minlength="6" placeholder="Minimal 6 karakter" style="border-radius: 3px;">
                                        </div>
                                        <div class="form-group mb-0">
                                            <label class="font-weight-bold" style="font-size: 13px; color: #1E293B;">Konfirmasi Password <span class="text-danger">*</span></label>
                                            <input type="password" name="password_confirmation" class="form-control" required minlength="6" placeholder="Ulangi password baru" style="border-radius: 3px;">
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-light" style="padding: 12px 20px; border-top: 1px solid #E2E8F0;">
                                        <button type="button" class="btn btn-outline-secondary font-weight-bold" data-dismiss="modal" style="border-radius: 3px;">Batal</button>
                                        <button type="submit" class="btn btn-success font-weight-bold" style="border-radius: 3px;">
                                            <span class="material-icons" style="font-size: 16px; vertical-align: middle;">save</span> Simpan Password
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <span class="material-icons" style="font-size: 48px; color: #CBD5E1; display: block; margin-bottom: 8px;">people_outline</span>
                            <p class="font-weight-bold mb-1">Belum Ada Pengguna</p>
                            <small class="text-muted">Tidak ditemukan data pengguna yang sesuai.</small>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
            <div class="card-footer bg-white border-top p-3 d-flex flex-wrap justify-content-between align-items-center" style="gap: 10px;">
                <div class="text-muted" style="font-size: 13px;">
                    Menampilkan {{ $users->firstItem() }} - {{ $users->lastItem() }} dari {{ $users->total() }} pengguna
                </div>
                <div>
                    {{ $users->withQueryString()->links() }}
                </div>
            </div>
        @endif
    </div>
</div>

<!-- SECTION 2: Kredensial Gerbang Akses (Lapis 1) -->
<div class="card card-outline card-success mt-4">
    <div class="card-header d-flex align-items-center" style="padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
        <span class="d-flex align-items-center" style="gap: 8px;">
            <span class="material-icons text-success" style="font-size: 20px;">security</span>
            <span class="font-weight-bold card-title-label">Kredensial Gerbang Akses (Lapis 1)</span>
        </span>
    </div>

    <div class="card-body p-4">
        <form action="{{ route('admin.users.update-gatekeeper') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group mb-3">
                        <label for="gatekeeper_username" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">Username Gerbang <span class="text-danger">*</span></label>
                        <input type="text" name="gatekeeper_username" id="gatekeeper_username" value="{{ old('gatekeeper_username', $gatekeeperUsername) }}" class="form-control" placeholder="Masukkan username baru..." required style="border-radius: 3px;">
                        <small class="form-text text-muted">Username untuk melewati overlay pembatas masuk (Gerbang Lapis 1) sebelum halaman login.</small>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group mb-3">
                        <label for="gatekeeper_password" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">Password Gerbang <span class="text-danger">*</span></label>
                        <input type="text" name="gatekeeper_password" id="gatekeeper_password" value="{{ old('gatekeeper_password', $gatekeeperPassword) }}" class="form-control" placeholder="Masukkan password baru..." required style="border-radius: 3px;">
                        <small class="form-text text-muted">Password untuk melewati overlay pembatas masuk (Gerbang Lapis 1) sebelum halaman login.</small>
                    </div>
                </div>
            </div>
            
            <div class="border-top pt-4 mt-3 d-flex justify-content-end">
                <button type="submit" class="btn btn-success font-weight-bold px-4" style="border-radius: 3px;">
                    <span class="material-icons" style="font-size: 16px; vertical-align: middle; margin-right: 4px;">save</span> Simpan Kredensial
                </button>
            </div>
        </form>
    </div>
</div>
@endsection