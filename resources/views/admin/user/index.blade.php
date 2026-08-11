@extends('admin.layouts.admin')

@section('title', 'Manajemen Pengguna')
@section('header_title', 'Manajemen Pengguna')

@section('content')
<div class="card card-outline card-success">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between" style="gap: 12px; padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
        <span class="d-flex align-items-center" style="gap: 8px;">
            <span class="material-icons text-success">people</span>
            <span class="font-weight-bold card-title-label">Daftar Pengguna</span>
        </span>
        <div class="d-flex flex-wrap align-items-center" style="gap: 12px;">
            <form action="{{ route('admin.users.index') }}" method="GET" class="d-flex align-items-center" style="margin: 0; gap: 8px;">
                <div class="input-group" style="width: 240px;">
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama atau email..." value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-sm btn-success d-flex align-items-center" style="border: none;">
                            <span class="material-icons" style="font-size: 18px;">search</span>
                        </button>
                    </div>
                </div>
                @if(request('search'))
                    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-secondary d-flex align-items-center" title="Bersihkan Pencarian" style="height: 31px;">
                        <span class="material-icons" style="font-size: 18px;">clear</span>
                    </a>
                @endif
            </form>
            <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-success">
                <span class="material-icons" style="font-size:16px;">add</span> Tambah Pengguna
            </a>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 70px;">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th class="text-center" style="width: 120px;">role</th>
                        <th class="text-center" style="width: 120px;">Status</th>
                        <th class="text-center" style="width: 180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $idx => $user)
                    <tr>
                        <td class="text-center align-middle">{{ $users->firstItem() + $idx }}</td>
                        <td class="align-middle">{{ $user->name }}</td>
                        <td class="align-middle">{{ $user->email }}</td>
                        <td class="text-center align-middle">
                            @if($user->is_admin)
                            <span class="badge" style="background-color:#004F3B; color:#fff;">Admin</span>
                            @else
                            <span class="badge" style="background-color:#64748B; color:#fff;">Staf</span>
                            @endif
                        </td>
                        <td class="text-center align-middle">
                            @if($user->is_active)
                            <span class="badge badge-success">Aktif</span>
                            @else
                            <span class="badge badge-danger">Nonaktif</span>
                            @endif
                        </td>
                        <td class="text-center align-middle" style="white-space:nowrap;">
                            <div class="btn-action-group" style="justify-content: center;">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn-action btn-action-edit" title="Edit Pengguna">
                                    <span class="material-icons">edit</span>
                                </a>
                                <button type="button" class="btn-action btn-action-view" title="Reset Password" data-toggle="modal" data-target="#modalResetPassword{{ $user->id }}">
                                    <span class="material-icons">lock_reset</span>
                                </button>
                                @if($user->is_active)
                                <form action="{{ route('admin.users.toggle-active', $user) }}" method="POST" id="toggle-user-{{ $user->id }}" class="d-none">
                                    @csrf @method('POST')
                                </form>
                                <button type="button" class="btn-action btn-action-warning" title="Nonaktifkan Akun" onclick="confirmAction('Nonaktifkan Pengguna?', 'Status akun {{ $user->name }} akan dinonaktifkan.', function() { document.getElementById('toggle-user-{{ $user->id }}').submit(); }, '<span class=\'material-icons\' style=\'font-size:16px;vertical-align:middle;\'>block</span> Nonaktifkan', '#ffc107', 'warning')">
                                    <span class="material-icons">block</span>
                                </button>
                                @else
                                <form action="{{ route('admin.users.toggle-active', $user) }}" method="POST" id="toggle-user-{{ $user->id }}" class="d-none">
                                    @csrf @method('POST')
                                </form>
                                <button type="button" class="btn-action btn-action-success" title="Aktifkan Akun" onclick="confirmAction('Aktifkan Pengguna?', 'Status akun {{ $user->name }} akan diaktifkan kembali.', function() { document.getElementById('toggle-user-{{ $user->id }}').submit(); }, '<span class=\'material-icons\' style=\'font-size:16px;vertical-align:middle;\'>check_circle</span> Aktifkan', '#009966', 'question')">
                                    <span class="material-icons">check_circle</span>
                                </button>
                                @endif
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" id="del-user-{{ $user->id }}" class="d-none">
                                    @csrf @method('DELETE')
                                </form>
                                <button type="button" class="btn-action btn-action-delete" title="Hapus Pengguna" onclick="confirmDelete('del-user-{{ $user->id }}')">
                                    <span class="material-icons">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- Modal Reset Password --}}
                    <div class="modal fade" id="modalResetPassword{{ $user->id }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Reset Password — {{ $user->name }}</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <form action="{{ route('admin.users.reset-password', $user) }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Password Baru</label>
                                            <input type="password" name="password" class="form-control" required minlength="6" placeholder="Minimal 6 karakter">
                                        </div>
                                        <div class="form-group">
                                            <label>Konfirmasi Password</label>
                                            <input type="password" name="password_confirmation" class="form-control" required minlength="6" placeholder="Ulangi password">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-sm btn-success">Simpan Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Belum ada pengguna.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
            <div class="card-footer clearfix bg-white border-top p-3">
                <div class="float-right" style="margin: 0;">
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
            <span class="material-icons text-success">security</span>
            <span class="font-weight-bold card-title-label">Kredensial Gerbang Akses (Lapis 1)</span>
        </span>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.users.update-gatekeeper') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="gatekeeper_username">Username Gerbang <span class="text-danger">*</span></label>
                        <input type="text" name="gatekeeper_username" id="gatekeeper_username" value="{{ old('gatekeeper_username', $gatekeeperUsername) }}" class="form-control" placeholder="Masukkan username baru..." required>
                        <small class="form-text text-muted">Username untuk melewati overlay pembatas masuk (Gerbang Lapis 1) sebelum halaman login.</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="gatekeeper_password">Password Gerbang <span class="text-danger">*</span></label>
                        <input type="text" name="gatekeeper_password" id="gatekeeper_password" value="{{ old('gatekeeper_password', $gatekeeperPassword) }}" class="form-control" placeholder="Masukkan password baru..." required>
                        <small class="form-text text-muted">Password untuk melewati overlay pembatas masuk (Gerbang Lapis 1) sebelum halaman login.</small>
                    </div>
                </div>
            </div>
            
            <div class="border-top pt-3 mt-3 d-flex justify-content-end">
                <button type="submit" class="btn btn-success px-4">
                    <span class="material-icons" style="font-size: 16px; vertical-align: middle; margin-right: 4px;">save</span> Simpan Kredensial
                </button>
            </div>
        </form>
    </div>
</div>
@endsection