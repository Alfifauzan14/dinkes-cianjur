@extends('admin.layouts.admin')

@section('title', 'Manajemen Pengguna')
@section('header_title', 'Manajemen Pengguna')

@section('content')
<div class="card card-outline card-success">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between" style="gap: 12px; padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
        <span class="d-flex align-items-center" style="gap: 8px;">
            <span class="material-icons text-success">people</span>
            <span class="font-weight-bold" style="color: #1E293B;">Daftar Pengguna</span>
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
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-action-edit" title="Edit">
                                    <span class="material-icons" style="font-size:16px;">edit</span>
                                </a>
                                <button type="button" class="btn btn-sm btn-action-edit" title="Reset Password" data-toggle="modal" data-target="#modalResetPassword{{ $user->id }}">
                                    <span class="material-icons" style="font-size:16px;">lock_reset</span>
                                </button>
                                @if($user->is_active)
                                    <form action="{{ route('admin.users.toggle-active', $user) }}" method="POST" class="d-inline">
                                        @csrf @method('POST')
                                        <button type="submit" class="btn btn-sm btn-warning" title="Nonaktifkan" onclick="return confirm('Nonaktifkan {{ $user->name }}?')">
                                            <span class="material-icons" style="font-size:16px;">block</span>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.users.toggle-active', $user) }}" method="POST" class="d-inline">
                                        @csrf @method('POST')
                                        <button type="submit" class="btn btn-sm btn-success" title="Aktifkan" onclick="return confirm('Aktifkan {{ $user->name }}?')">
                                            <span class="material-icons" style="font-size:16px;">check_circle</span>
                                        </button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pengguna {{ $user->name }}? Tindakan ini tidak dapat dibatalkan.')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-action-delete" title="Hapus">
                                        <span class="material-icons" style="font-size:16px;">delete</span>
                                    </button>
                                </form>
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