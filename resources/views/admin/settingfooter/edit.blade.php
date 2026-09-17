@extends('admin.layouts.admin')
@section('title', 'Pengaturan Footer')
@section('header_title', 'Pengaturan Footer')

@section('styles')
<style>
    .preview-box {
        border: 1px dashed #CBD5E1;
        background: #F8FAFC;
        border-radius: 3px;
        padding: 16px;
        text-align: center;
        margin-bottom: 12px;
    }
    .footer-section-title {
        font-size: 15px;
        font-weight: 700;
        color: #004F3B;
        margin: 20px 0 16px;
        padding-bottom: 10px;
        border-bottom: 1px solid #E2E8F0;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .footer-section-title:first-of-type {
        margin-top: 0;
    }
</style>
@endsection

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-3" style="gap:8px; border-radius: 3px;">
        <span class="material-icons">check_circle</span>
        <span>{{ session('success') }}</span>
        <button type="button" class="close ml-auto" data-dismiss="alert"><span>&times;</span></button>
    </div>
@endif

<div class="row">
    <div class="col-12">
        <div class="card card-outline card-success">
            <div class="card-header d-flex align-items-center justify-content-between" style="padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
                <span class="d-flex align-items-center" style="gap: 8px;">
                    <span class="material-icons text-success" style="font-size: 20px;">tune</span>
                    <span class="font-weight-bold card-title-label">Pengaturan Footer Website</span>
                </span>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('admin.settingfooter.update') }}" method="POST" enctype="multipart/form-data" id="setting-form">
                    @csrf
                    @method('PUT')

                    {{-- Identitas --}}
                    <div class="footer-section-title">
                        <span class="material-icons text-success" style="font-size: 20px;">web</span>
                        <span>Identitas Situs</span>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-12">
                            <div class="form-group mb-3">
                                <label for="site_tagline" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">Slogan / Tagline Instansi <span class="text-danger">*</span></label>
                                <input type="text" name="site_tagline" id="site_tagline" value="{{ old('site_tagline', $setting->site_tagline) }}" class="form-control @error('site_tagline') is-invalid @enderror" required style="border-radius: 3px;">
                                @error('site_tagline') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group mb-3">
                                <label class="font-weight-bold" style="font-size: 13px; color: #1E293B;">Logo Situs Resmi</label>
                                <div class="preview-box">
                                    @if($setting->site_logo)
                                        <img src="{{ asset('uploads/settings/' . $setting->site_logo) }}" alt="Logo" style="max-height: 90px; max-width: 100%; object-fit: contain;" id="logo-preview-img">
                                    @else
                                        <img src="{{ asset('images/logo.png') }}" alt="Logo Default" style="max-height: 90px; max-width: 100%; object-fit: contain;" id="logo-preview-img">
                                    @endif
                                </div>
                                <div class="custom-file" style="font-size: 13px;">
                                    <input type="file" name="site_logo" id="site_logo" class="custom-file-input" onchange="previewLogoFile(this)">
                                    <label class="custom-file-label" for="site_logo" style="border-radius: 3px;">Pilih File Logo...</label>
                                </div>
                                @error('site_logo') <span class="text-danger small mt-1 d-block">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Kontak --}}
                    <div class="footer-section-title">
                        <span class="material-icons text-success" style="font-size: 20px;">contact_phone</span>
                        <span>Informasi Kontak</span>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="form-group mb-3">
                                <label for="email" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">Email Resmi <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" value="{{ old('email', $setting->email) }}" class="form-control @error('email') is-invalid @enderror" required style="border-radius: 3px;">
                                @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group mb-3">
                                <label for="phone" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">Nomor Telepon Kantor <span class="text-danger">*</span></label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone', $setting->phone) }}" class="form-control @error('phone') is-invalid @enderror" required style="border-radius: 3px;">
                                @error('phone') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group mb-3">
                                <label for="address" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">Alamat Lengkap Kantor <span class="text-danger">*</span></label>
                                <input type="text" name="address" id="address" value="{{ old('address', $setting->address) }}" class="form-control @error('address') is-invalid @enderror" required style="border-radius: 3px;">
                                @error('address') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Darurat --}}
                    <div class="footer-section-title">
                        <span class="material-icons text-danger" style="font-size: 20px;">emergency</span>
                        <span>Layanan Gawat Darurat</span>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group mb-3">
                                <label for="emergency_call" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">Nomor Emergency Call <span class="text-danger">*</span></label>
                                <input type="text" name="emergency_call" id="emergency_call" value="{{ old('emergency_call', $setting->emergency_call) }}" class="form-control @error('emergency_call') is-invalid @enderror" required style="border-radius: 3px;">
                                @error('emergency_call') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group mb-3">
                                <label for="emergency_title" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">Judul / Nama Layanan Darurat <span class="text-danger">*</span></label>
                                <input type="text" name="emergency_title" id="emergency_title" value="{{ old('emergency_title', $setting->emergency_title) }}" class="form-control @error('emergency_title') is-invalid @enderror" required style="border-radius: 3px;">
                                @error('emergency_title') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Sosmed --}}
                    <div class="footer-section-title">
                        <span class="material-icons text-success" style="font-size: 20px;">share</span>
                        <span>Tautan Media Sosial</span>
                    </div>
                    <div class="alert alert-info d-flex align-items-center mb-0" style="gap: 10px; border-radius: 3px; font-size: 13px;">
                        <span class="material-icons text-info" style="font-size: 20px;">info</span>
                        <span>
                            Link media sosial dikelola terpusat di halaman
                            <a href="{{ route('admin.home-content.index') }}" class="font-weight-bold text-info" style="text-decoration: underline;">Konten Halaman Utama</a>.
                            Perubahan di sana otomatis disinkronkan ke beranda dan footer.
                        </span>
                    </div>

                    <div class="border-top pt-4 mt-4 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success font-weight-bold px-4" id="btn-save-setting" style="border-radius: 3px;">
                            <span class="material-icons" style="font-size: 16px; vertical-align: middle; margin-right: 4px;">save</span> Simpan Semua Pengaturan Footer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function previewLogoFile(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('logo-preview-img').setAttribute('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);

            const fileName = input.files[0].name;
            input.nextElementSibling.innerText = fileName;
        }
    }

    document.getElementById('setting-form').addEventListener('submit', function() {
        const btn = document.getElementById('btn-save-setting');
        btn.disabled = true;
        btn.innerHTML = '<span class="material-icons" style="font-size: 16px; vertical-align: middle;">sync</span> Menyimpan...';
    });
</script>
@endsection