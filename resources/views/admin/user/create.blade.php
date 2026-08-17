@extends('admin.layouts.admin')

@section('title', 'Tambah Pengguna')
@section('header_title', 'Tambah Pengguna')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-outline card-success">
            <div class="card-header d-flex align-items-center justify-content-between" style="padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
                <span class="d-flex align-items-center" style="gap: 8px;">
                    <span class="material-icons text-success" style="font-size: 20px;">person_add</span>
                    <span class="font-weight-bold card-title-label">Tambah Pengguna Baru</span>
                </span>
                <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-secondary font-weight-bold d-flex align-items-center" style="gap: 4px; border-radius: 3px;">
                    <span class="material-icons" style="font-size: 16px;">arrow_back</span> Kembali
                </a>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group mb-3">
                                <label for="name" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required maxlength="255" placeholder="Masukkan nama lengkap..." style="border-radius: 3px;">
                                @error('name')
                                    <div class="text-danger mt-1" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group mb-3">
                                <label for="email" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">Alamat Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required maxlength="255" placeholder="nama@dinkes.cianjurkab.go.id" style="border-radius: 3px;">
                                @error('email')
                                    <div class="text-danger mt-1" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group mb-3">
                                <label for="password" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" id="password" class="form-control" required minlength="6" placeholder="Minimal 6 karakter" style="border-radius: 3px;">
                                @error('password')
                                    <div class="text-danger mt-1" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group mb-3">
                                <label for="password_confirmation" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">Konfirmasi Password <span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required minlength="6" placeholder="Ulangi password..." style="border-radius: 3px;">
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-0 mt-2">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="is_admin" name="is_admin" value="1" {{ old('is_admin') ? 'checked' : '' }}>
                            <label class="custom-control-label font-weight-bold" for="is_admin" style="font-size: 13px; color: #1E293B; cursor: pointer;">
                                Berikan Hak Akses Administrator (Admin Penuh)
                            </label>
                        </div>
                    </div>

                    <div class="border-top pt-4 mt-4 d-flex justify-content-end" style="gap: 8px;">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary font-weight-bold px-3" style="border-radius: 3px;">Batal</a>
                        <button type="submit" class="btn btn-success font-weight-bold px-4" style="border-radius: 3px;">
                            <span class="material-icons" style="font-size: 16px; vertical-align: middle; margin-right: 4px;">save</span> Simpan Pengguna
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection