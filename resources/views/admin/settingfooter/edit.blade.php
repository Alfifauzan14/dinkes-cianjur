@extends('admin.layouts.admin')
@section('title', 'Pengaturan Footer')
@section('header_title', 'Pengaturan Footer')

@section('styles')
<style>
    .preview-box {
        border: 1px dashed #CBD5E1;
        background: #F8FAFC;
        border-radius: 6px;
        padding: 16px;
        text-align: center;
        margin-bottom: 12px;
    }
    .footer-section-title {
        font-size: 15px;
        font-weight: 700;
        color: #004F3B;
        margin: 24px 0 16px;
        padding-bottom: 10px;
        border-bottom: 1px solid #E2E8F0;
        display: flex;
        align-items: center;
        gap: 8px;
    }
</style>
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card card-outline card-success">
            <div class="card-header d-flex align-items-center" style="padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
                <span class="material-icons text-success">settings</span>
                <span>Pengaturan Footer Website</span>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.settingfooter.update') }}" method="POST" enctype="multipart/form-data" id="setting-form">
                    @csrf
                    @method('PUT')

                    {{-- Identitas --}}
                    <div class="footer-section-title">
                        <span class="material-icons text-success">web</span>
                        Identitas Situs
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="site_name">Nama Instansi / Website <span class="text-danger">*</span></label>
                                <input type="text" name="site_name" id="site_name" value="{{ old('site_name', $setting->site_name) }}" class="form-control @error('site_name') is-invalid @enderror" required>
                                @error('site_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="site_tagline">Slogan / Tagline Instansi <span class="text-danger">*</span></label>
                                <input type="text" name="site_tagline" id="site_tagline" value="{{ old('site_tagline', $setting->site_tagline) }}" class="form-control @error('site_tagline') is-invalid @enderror" required>
                                @error('site_tagline') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Logo Situs Resmi</label>
                                <div class="preview-box">
                                    @if($setting->site_logo)
                                        <img src="{{ asset('uploads/settings/' . $setting->site_logo) }}" alt="Logo" style="max-height: 100px; max-width: 100%; object-fit: contain;" id="logo-preview-img">
                                    @else
                                        <img src="{{ asset('images/logo.png') }}" alt="Logo Default" style="max-height: 100px; max-width: 100%; object-fit: contain;" id="logo-preview-img">
                                    @endif
                                </div>
                                <div class="custom-file" style="font-size: 13px;">
                                    <input type="file" name="site_logo" id="site_logo" class="custom-file-input" onchange="previewLogoFile(this)">
                                    <label class="custom-file-label" for="site_logo">Pilih File...</label>
                                </div>
                                @error('site_logo') <span class="text-danger small mt-1 d-block">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Kontak --}}
                    <div class="footer-section-title">
                        <span class="material-icons text-success">contact_phone</span>
                        Informasi Kontak
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Email Hubung <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" value="{{ old('email', $setting->email) }}" class="form-control @error('email') is-invalid @enderror" required>
                                @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone">Nomor Telepon <span class="text-danger">*</span></label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone', $setting->phone) }}" class="form-control @error('phone') is-invalid @enderror" required>
                                @error('phone') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="address">Alamat Lengkap Kantor <span class="text-danger">*</span></label>
                                <input type="text" name="address" id="address" value="{{ old('address', $setting->address) }}" class="form-control @error('address') is-invalid @enderror" required>
                                @error('address') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Darurat --}}
                    <div class="footer-section-title">
                        <span class="material-icons text-danger">emergency</span>
                        Layanan Gawat Darurat
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="emergency_call">Nomor Emergency Call <span class="text-danger">*</span></label>
                                <input type="text" name="emergency_call" id="emergency_call" value="{{ old('emergency_call', $setting->emergency_call) }}" class="form-control @error('emergency_call') is-invalid @enderror" required>
                                @error('emergency_call') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="emergency_title">Judul / Nama Layanan Darurat <span class="text-danger">*</span></label>
                                <input type="text" name="emergency_title" id="emergency_title" value="{{ old('emergency_title', $setting->emergency_title) }}" class="form-control @error('emergency_title') is-invalid @enderror" required>
                                @error('emergency_title') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Sosmed --}}
                    <div class="footer-section-title">
                        <span class="material-icons text-success">share</span>
                        Tautan Media Sosial
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="social_facebook"><i class="fab fa-facebook mr-1" style="color: #1877F2;"></i> Facebook</label>
                                <input type="url" name="social_facebook" id="social_facebook" value="{{ old('social_facebook', $setting->social_facebook) }}" class="form-control @error('social_facebook') is-invalid @enderror" placeholder="https://facebook.com/username">
                                @error('social_facebook') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="social_instagram"><i class="fab fa-instagram mr-1" style="color: #E1306C;"></i> Instagram</label>
                                <input type="url" name="social_instagram" id="social_instagram" value="{{ old('social_instagram', $setting->social_instagram) }}" class="form-control @error('social_instagram') is-invalid @enderror" placeholder="https://instagram.com/username">
                                @error('social_instagram') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="social_twitter"><i class="fab fa-twitter mr-1" style="color: #1DA1F2;"></i> X (Twitter)</label>
                                <input type="url" name="social_twitter" id="social_twitter" value="{{ old('social_twitter', $setting->social_twitter) }}" class="form-control @error('social_twitter') is-invalid @enderror" placeholder="https://x.com/username">
                                @error('social_twitter') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="social_youtube"><i class="fab fa-youtube mr-1" style="color: #FF0000;"></i> YouTube</label>
                                <input type="url" name="social_youtube" id="social_youtube" value="{{ old('social_youtube', $setting->social_youtube) }}" class="form-control @error('social_youtube') is-invalid @enderror" placeholder="https://youtube.com/channel/id">
                                @error('social_youtube') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="social_tiktok"><i class="fab fa-tiktok mr-1" style="color: #010101;"></i> TikTok</label>
                                <input type="url" name="social_tiktok" id="social_tiktok" value="{{ old('social_tiktok', $setting->social_tiktok) }}" class="form-control @error('social_tiktok') is-invalid @enderror" placeholder="https://tiktok.com/@username">
                                @error('social_tiktok') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="border-top pt-4 mt-4 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success-dark px-4" id="btn-save-setting">
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
        btn.innerHTML = '<i class="fas fa-sync-alt fa-spin mr-1"></i> Menyimpan...';
    });
</script>
@endsection