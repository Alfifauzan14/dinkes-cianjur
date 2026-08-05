@extends('admin.layouts.admin')
@section('title', 'Informasi Kontak')
@section('header_title', 'Informasi Kontak')

@section('styles')
<style>
    .custom-form-card {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: var(--card-shadow);
        border: none;
        padding: 30px;
        margin-bottom: 24px;
    }
    .form-section-title {
        font-size: 16px;
        font-weight: 700;
        color: #004F3B;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
        border-bottom: 1px solid var(--border-subtle);
        padding-bottom: 10px;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-12">

        <div class="custom-form-card">
            <form action="{{ route('admin.settingfooter.update') }}" method="POST" id="setting-form">
                @csrf
                @method('PUT')
                <input type="hidden" name="section" value="kontak">

                <div class="form-section-title">
                    <span class="material-icons text-success">contact_phone</span>
                    <span>Informasi Kontak Instansi</span>
                </div>

                <div class="form-group">
                    <label for="email">Email Hubung <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="email" value="{{ old('email', $setting->email) }}" class="form-control @error('email') is-invalid @enderror" required>
                    @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="phone">Nomor Telepon <span class="text-danger">*</span></label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $setting->phone) }}" class="form-control @error('phone') is-invalid @enderror" required>
                    @error('phone') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="address">Alamat Lengkap Kantor <span class="text-danger">*</span></label>
                    <input type="text" name="address" id="address" value="{{ old('address', $setting->address) }}" class="form-control @error('address') is-invalid @enderror" required>
                    @error('address') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="border-top pt-4 mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success px-4" id="btn-save-setting">
                        <span class="material-icons" style="font-size: 16px; vertical-align: middle; margin-right: 4px;">save</span> Simpan Kontak
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('setting-form').addEventListener('submit', function() {
        const btn = document.getElementById('btn-save-setting');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-sync-alt fa-spin mr-1"></i> Menyimpan...';
    });
</script>
@endsection
