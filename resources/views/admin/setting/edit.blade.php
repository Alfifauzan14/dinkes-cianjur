@extends('admin.layouts.admin')
@section('title', 'Pengaturan Situs')
@section('header_title')
    @if(request('section') === 'kontak')
        Pengaturan Kontak
    @elseif(request('section') === 'darurat')
        Pengaturan Layanan Darurat
    @elseif(request('section') === 'sosmed')
        Pengaturan Media Sosial
    @else
        Pengaturan Identitas Situs
    @endif
@endsection

@section('styles')
<style>
    .settings-container {
        max-width: 800px;
        margin: 0 auto;
    }
    .custom-form-card {
        background: #ffffff;
        border-radius: 4px;
        box-shadow: 0 0 35px rgba(0, 0, 0, 0.05);
        border: none;
        padding: 30px;
        margin-bottom: 24px;
    }
    .form-section-title {
        font-size: 18px;
        font-weight: 700;
        color: #004F3B;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .form-group label {
        font-size: 13px;
        font-weight: 700;
        color: #475569;
        margin-bottom: 6px;
    }
    .form-control {
        border: 1px solid #CBD5E1;
        border-radius: 3px;
        padding: 10px 14px;
        font-size: 14px;
        color: #1E293B;
        transition: all 0.2s ease;
    }
    .form-control:focus {
        border-color: #009966;
        box-shadow: 0 0 0 3px rgba(0, 153, 102, 0.15);
        outline: none;
    }
    .btn-save {
        background-color: #009966;
        color: #ffffff;
        font-weight: 700;
        font-size: 14px;
        padding: 10px 24px;
        border-radius: 3px;
        border: none;
        box-shadow: 0 2px 10px rgba(0, 153, 102, 0.15);
        transition: all 0.2s ease;
    }
    .btn-save:hover {
        background-color: #008055;
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(0, 153, 102, 0.25);
    }
    .preview-box {
        border: 1px dashed #CBD5E1;
        background: #F8FAFC;
        border-radius: 3px;
        padding: 16px;
        text-align: center;
        margin-bottom: 12px;
    }
</style>
@endsection

@section('content')
<div class="settings-container">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 3px;">
            <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="custom-form-card">
        <form action="{{ route('admin.setting.update') }}" method="POST" enctype="multipart/form-data" id="setting-main-form">
            @csrf
            @method('PUT')

            {{-- Pass section value as hidden input to return back to same page section --}}
            <input type="hidden" name="section" value="{{ request('section', 'identitas') }}">

            @if(request('section') === 'kontak')
                <!-- SECTION: KONTAK -->
                <div class="form-section-title">
                    <span class="material-icons">contact_phone</span>
                    <span>Informasi Kontak</span>
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

            @elseif(request('section') === 'darurat')
                <!-- SECTION: LAYANAN DARURAT -->
                <div class="form-section-title">
                    <span class="material-icons">emergency</span>
                    <span>Layanan Gawat Darurat (PSC 119)</span>
                </div>
                <div class="form-group">
                    <label for="emergency_call">Nomor Emergency Call <span class="text-danger">*</span></label>
                    <input type="text" name="emergency_call" id="emergency_call" value="{{ old('emergency_call', $setting->emergency_call) }}" class="form-control @error('emergency_call') is-invalid @enderror" required>
                    @error('emergency_call') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="emergency_title">Judul / Nama Layanan Darurat <span class="text-danger">*</span></label>
                    <input type="text" name="emergency_title" id="emergency_title" value="{{ old('emergency_title', $setting->emergency_title) }}" class="form-control @error('emergency_title') is-invalid @enderror" required>
                    @error('emergency_title') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

            @elseif(request('section') === 'sosmed')
                <!-- SECTION: SOSMED -->
                <div class="form-section-title">
                    <span class="material-icons">share</span>
                    <span>Tautan Media Sosial Resmi</span>
                </div>
                <div class="form-group">
                    <label for="social_facebook"><i class="fab fa-facebook mr-1" style="color: #1877F2;"></i> Link Facebook</label>
                    <input type="url" name="social_facebook" id="social_facebook" value="{{ old('social_facebook', $setting->social_facebook) }}" class="form-control @error('social_facebook') is-invalid @enderror" placeholder="https://facebook.com/username">
                    @error('social_facebook') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="social_instagram"><i class="fab fa-instagram mr-1" style="color: #E1306C;"></i> Link Instagram</label>
                    <input type="url" name="social_instagram" id="social_instagram" value="{{ old('social_instagram', $setting->social_instagram) }}" class="form-control @error('social_instagram') is-invalid @enderror" placeholder="https://instagram.com/username">
                    @error('social_instagram') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="social_twitter"><i class="fab fa-twitter mr-1" style="color: #1DA1F2;"></i> Link X (Twitter)</label>
                    <input type="url" name="social_twitter" id="social_twitter" value="{{ old('social_twitter', $setting->social_twitter) }}" class="form-control @error('social_twitter') is-invalid @enderror" placeholder="https://x.com/username">
                    @error('social_twitter') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="social_youtube"><i class="fab fa-youtube mr-1" style="color: #FF0000;"></i> Link YouTube</label>
                    <input type="url" name="social_youtube" id="social_youtube" value="{{ old('social_youtube', $setting->social_youtube) }}" class="form-control @error('social_youtube') is-invalid @enderror" placeholder="https://youtube.com/channel/id">
                    @error('social_youtube') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="social_tiktok"><i class="fab fa-tiktok mr-1" style="color: #010101;"></i> Link TikTok</label>
                    <input type="url" name="social_tiktok" id="social_tiktok" value="{{ old('social_tiktok', $setting->social_tiktok) }}" class="form-control @error('social_tiktok') is-invalid @enderror" placeholder="https://tiktok.com/@username">
                    @error('social_tiktok') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

            @else
                <!-- SECTION: IDENTITAS (DEFAULT) -->
                <div class="form-section-title">
                    <span class="material-icons">web</span>
                    <span>Identitas Utama Website</span>
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
                                    <img src="{{ asset('uploads/settings/' . $setting->site_logo) }}" alt="Logo" style="max-height: 80px; max-width: 100%; object-fit: contain;" id="logo-preview-img">
                                @else
                                    <img src="{{ asset('images/logo.png') }}" alt="Logo Default" style="max-height: 80px; max-width: 100%; object-fit: contain;" id="logo-preview-img">
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
            @endif

            {{-- Hidden fields to prevent validation failures on partial sections --}}
            @if(request('section') !== 'identitas' && request('section') !== '')
                <input type="hidden" name="site_name" value="{{ $setting->site_name }}">
                <input type="hidden" name="site_tagline" value="{{ $setting->site_tagline }}">
            @endif
            @if(request('section') !== 'kontak')
                <input type="hidden" name="email" value="{{ $setting->email }}">
                <input type="hidden" name="phone" value="{{ $setting->phone }}">
                <input type="hidden" name="address" value="{{ $setting->address }}">
            @endif
            @if(request('section') !== 'darurat')
                <input type="hidden" name="emergency_call" value="{{ $setting->emergency_call }}">
                <input type="hidden" name="emergency_title" value="{{ $setting->emergency_title }}">
            @endif

            <div class="border-top pt-4 mt-4 d-flex justify-content-end">
                <button type="submit" class="btn-save" id="btn-save-setting">
                    <span class="material-icons" style="font-size: 16px; vertical-align: middle; margin-right: 4px;">save</span> Simpan Pengaturan
                </button>
            </div>
        </form>
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
            }
            reader.readAsDataURL(input.files[0]);
            
            const fileName = input.files[0].name;
            input.nextElementSibling.innerText = fileName;
        }
    }

    document.getElementById('setting-main-form').addEventListener('submit', function() {
        const btn = document.getElementById('btn-save-setting');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-sync-alt fa-spin mr-1"></i> Menyimpan...';
    });
</script>
@endsection
