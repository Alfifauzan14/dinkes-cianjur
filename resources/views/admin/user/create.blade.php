@extends('admin.layouts.admin')

@section('title', 'Tambah Pengguna')
@section('header_title', 'Tambah Pengguna')

@section('content')
<div class="card card-outline card-success">
    <div class="card-header d-flex align-items-center justify-content-between" style="padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
        <span class="font-weight-bold card-title-label">Tambah Pengguna Baru</span>
        <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-secondary">
            <span class="material-icons" style="font-size:16px;">arrow_back</span> Kembali
        </a>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required maxlength="255">
                @error('name')
                    <div class="text-danger mt-1" style="font-size:13px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required maxlength="255">
                @error('email')
                    <div class="text-danger mt-1" style="font-size:13px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required minlength="6">
                @error('password')
                    <div class="text-danger mt-1" style="font-size:13px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required minlength="6">
            </div>

            <div class="form-group">
                <label class="d-flex align-items-center" style="gap:8px;">
                    <input type="checkbox" name="is_admin" value="1" {{ old('is_admin') ? 'checked' : '' }}>
                    <span>Admin</span>
                </label>
            </div>

            <div class="d-flex align-items-center justify-content-end" style="gap:10px; border-top: 1px solid #F3F4F6; padding-top: 20px; margin-top: 24px;">
                <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-secondary">Batal</a>
                <button type="submit" class="btn btn-sm btn-success">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection