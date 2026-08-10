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
        <div class="d-flex" style="gap: 8px;">
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
                        <th class="text-center" style="width: 120px;">Admin</th>
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
                                    <span class="badge badge-success">Admin</span>
                                @else
                                    <span class="badge badge-secondary">Staf</span>
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
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle d-inline-flex align-items-center" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="gap: 4px; border-radius: 6px;">
                                        <span class="material-icons" style="font-size: 16px;">more_vert</span> Aksi
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" style="border-radius: 6px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06); border: 1px solid #E2E8F0;">
                                        <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.users.edit', $user) }}" style="gap: 8px; padding: 8px 16px;">
                                            <span class="material-icons text-primary" style="font-size: 18px;">edit</span> Edit Pengguna
                                        </a>
                                        <button type="button" class="dropdown-item d-flex align-items-center" data-toggle="modal" data-target="#modalResetPassword{{ $user->id }}" style="gap: 8px; padding: 8px 16px; border: none; background: none; width: 100%; text-align: left;">
                                            <span class="material-icons text-info" style="font-size: 18px;">lock_reset</span> Reset Password
                                        </button>
                                        <div class="dropdown-divider"></div>
                                        @if($user->is_active)
                                            <form action="{{ route('admin.users.toggle-active', $user) }}" method="POST" id="toggle-user-{{ $user->id }}" class="d-none">
                                                @csrf @method('POST')
                                            </form>
                                            <button type="button" class="dropdown-item d-flex align-items-center text-warning" onclick="confirmAction('Nonaktifkan Pengguna?', 'Status akun {{ $user->name }} akan dinonaktifkan.', function() { document.getElementById('toggle-user-{{ $user->id }}').submit(); }, '<span class=\'material-icons\' style=\'font-size:16px;vertical-align:middle;\'>block</span> Nonaktifkan', '#ffc107', 'warning')" style="gap: 8px; padding: 8px 16px; border: none; background: none; width: 100%; text-align: left;">
                                                <span class="material-icons">block</span> Nonaktifkan Akun
                                            </button>
                                        @else
                                            <form action="{{ route('admin.users.toggle-active', $user) }}" method="POST" id="toggle-user-{{ $user->id }}" class="d-none">
                                                @csrf @method('POST')
                                            </form>
                                            <button type="button" class="dropdown-item d-flex align-items-center text-success" onclick="confirmAction('Aktifkan Pengguna?', 'Status akun {{ $user->name }} akan diaktifkan kembali.', function() { document.getElementById('toggle-user-{{ $user->id }}').submit(); }, '<span class=\'material-icons\' style=\'font-size:16px;vertical-align:middle;\'>check_circle</span> Aktifkan', '#009966', 'question')" style="gap: 8px; padding: 8px 16px; border: none; background: none; width: 100%; text-align: left;">
                                                <span class="material-icons">check_circle</span> Aktifkan Akun
                                            </button>
                                        @endif
                                        <div class="dropdown-divider"></div>
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" id="del-user-{{ $user->id }}" class="d-none">
                                            @csrf @method('DELETE')
                                        </form>
                                        <button type="button" class="dropdown-item d-flex align-items-center text-danger font-weight-bold" onclick="confirmDelete('del-user-{{ $user->id }}')" style="gap: 8px; padding: 8px 16px; border: none; background: none; width: 100%; text-align: left;">
                                            <span class="material-icons">delete</span> Hapus Pengguna
                                        </button>
                                    </div>
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
        <div class="px-4 py-3">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection