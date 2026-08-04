@extends('admin.layouts.admin')
@section('title', 'Pengaturan Situs')
@section('header_title', 'Pengaturan Situs')

@section('styles')
<style>
    .overview-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 24px;
        margin-bottom: 30px;
    }
    .overview-card {
        background: #ffffff;
        border-radius: 3px;
        border: none;
        box-shadow: 0 0 35px rgba(0, 0, 0, 0.05);
        padding: 24px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .overview-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 40px rgba(0, 0, 0, 0.08);
    }
    .card-meta-icon {
        width: 44px;
        height: 44px;
        background-color: #E6F7F0;
        color: #009966;
        border-radius: 3px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
    }
    .meta-title {
        font-size: 16px;
        font-weight: 700;
        color: #004F3B;
        margin-bottom: 12px;
        border-bottom: 1px solid #E2E8F0;
        padding-bottom: 8px;
    }
    .info-label {
        font-size: 12px;
        font-weight: 700;
        color: #64748B;
        text-transform: uppercase;
        margin-top: 10px;
        margin-bottom: 2px;
    }
    .info-val {
        font-size: 14px;
        color: #1E293B;
        word-break: break-all;
    }
    .social-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #F1F5F9;
        border-radius: 3px;
        padding: 6px 12px;
        font-size: 12px;
        color: #475569;
        margin-right: 6px;
        margin-bottom: 6px;
    }
    .settings-tabs-nav {
        display: flex;
        border-bottom: 2px solid #E2E8F0;
        margin-bottom: 20px;
        gap: 8px;
    }
    .tab-nav-btn {
        background: none;
        border: none;
        border-bottom: 2px solid transparent;
        padding: 10px 16px;
        font-weight: 600;
        color: #64748B;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
        outline: none !important;
        cursor: pointer;
    }
    .tab-nav-btn:hover {
        color: #009966;
    }
    .tab-nav-btn.active {
        color: #009966;
        border-bottom-color: #009966;
    }
    .tab-nav-btn .material-icons {
        font-size: 18px;
    }
    .settings-tab-panel {
        display: none;
    }
    .settings-tab-panel.active {
        display: block;
    }
</style>
@endsection

@section('content')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <p class="text-muted mb-0">Kelola identitas, kontak, dan tautan media sosial dinamis untuk website resmi.</p>
    </div>
    <button type="button" class="btn btn-success px-4" data-toggle="modal" data-target="#modal-edit-settings" style="border-radius:3px; font-weight:700; box-shadow:0 2px 10px rgba(0, 153, 102, 0.2);">
        <i class="fas fa-edit mr-2"></i> Ubah Konfigurasi Situs
    </button>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 3px;">
        <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- Overview Dashboard Cards -->
<div class="overview-grid">
    <!-- Card 1: Identitas -->
    <div class="overview-card">
        <div class="card-meta-icon"><span class="material-icons">web</span></div>
        <div class="meta-title">Identitas Situs</div>
        
        <div class="info-label">Logo Instansi</div>
        <div class="mb-3">
            @if($setting->site_logo)
                <img src="{{ asset('uploads/settings/' . $setting->site_logo) }}" alt="Logo Situs" style="max-height: 48px; max-width: 100%; object-fit: contain; background: #fff; padding: 4px; border: 1px solid #E2E8F0; border-radius: 3px;">
            @else
                <img src="{{ asset('images/logo.png') }}" alt="Logo Default" style="max-height: 48px; max-width: 100%; object-fit: contain; background: #fff; padding: 4px; border: 1px solid #E2E8F0; border-radius: 3px;">
            @endif
        </div>

        <div class="info-label">Nama Instansi / Situs</div>
        <div class="info-val" style="font-weight: 700;">{{ $setting->site_name }}</div>

        <div class="info-label">Slogan / Tagline</div>
        <div class="info-val" style="font-style: italic;">"{{ $setting->site_tagline }}"</div>
    </div>

    <!-- Card 2: Kontak -->
    <div class="overview-card">
        <div class="card-meta-icon"><span class="material-icons">contact_phone</span></div>
        <div class="meta-title">Informasi Kontak</div>

        <div class="info-label">Email Hubung</div>
        <div class="info-val">{{ $setting->email }}</div>

        <div class="info-label">Nomor Telepon</div>
        <div class="info-val">{{ $setting->phone }}</div>

        <div class="info-label">Alamat Kantor</div>
        <div class="info-val">{{ $setting->address }}</div>
    </div>

    <!-- Card 3: Layanan Darurat -->
    <div class="overview-card">
        <div class="card-meta-icon"><span class="material-icons">emergency</span></div>
        <div class="meta-title">Layanan Darurat</div>

        <div class="info-label">Nomor Emergency Call</div>
        <div class="info-val" style="font-size: 20px; font-weight: 800; color: #DC2626;">{{ $setting->emergency_call }}</div>

        <div class="info-label">Nama / Judul Layanan</div>
        <div class="info-val">{{ $setting->emergency_title }}</div>
    </div>

    <!-- Card 4: Media Sosial -->
    <div class="overview-card">
        <div class="card-meta-icon"><span class="material-icons">share</span></div>
        <div class="meta-title">Media Sosial</div>

        <div class="info-label">Tautan Terhubung</div>
        <div class="mt-2">
            @if($setting->social_facebook)
                <a href="{{ $setting->social_facebook }}" target="_blank" class="social-badge"><i class="fab fa-facebook-f" style="color:#1877F2;"></i> Facebook</a>
            @endif
            @if($setting->social_instagram)
                <a href="{{ $setting->social_instagram }}" target="_blank" class="social-badge"><i class="fab fa-instagram" style="color:#E1306C;"></i> Instagram</a>
            @endif
            @if($setting->social_twitter)
                <a href="{{ $setting->social_twitter }}" target="_blank" class="social-badge"><i class="fab fa-x-twitter"></i> X (Twitter)</a>
            @endif
            @if($setting->social_youtube)
                <a href="{{ $setting->social_youtube }}" target="_blank" class="social-badge"><i class="fab fa-youtube" style="color:#FF0000;"></i> YouTube</a>
            @endif
            @if($setting->social_tiktok)
                <a href="{{ $setting->social_tiktok }}" target="_blank" class="social-badge"><i class="fab fa-tiktok"></i> TikTok</a>
            @endif
            @if(!$setting->social_facebook && !$setting->social_instagram && !$setting->social_twitter && !$setting->social_youtube && !$setting->social_tiktok)
                <span class="text-muted small italic">Tidak ada tautan terdaftar</span>
            @endif
        </div>
    </div>
</div>

<!-- POPUP MODAL EDIT FORM -->
<div class="modal fade" id="modal-edit-settings" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 3px;">
            <div class="modal-header bg-success text-white py-3" style="border-top-left-radius: 3px; border-top-right-radius: 3px;">
                <h5 class="modal-title font-weight-bold" id="modalLabel"><i class="fas fa-edit mr-2"></i> Ubah Pengaturan Situs</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="{{ route('admin.setting.update') }}" method="POST" enctype="multipart/form-data" id="settings-form">
                @csrf
                @method('PUT')

                <div class="modal-body px-4 pt-4">
                    <!-- Tab Navigation -->
                    <div class="settings-tabs-nav">
                        <button type="button" class="tab-nav-btn active" data-target="tab-modal-identity">
                            <span class="material-icons">web</span>
                            <span>Identitas</span>
                        </button>
                        <button type="button" class="tab-nav-btn" data-target="tab-modal-contact">
                            <span class="material-icons">contact_phone</span>
                            <span>Kontak</span>
                        </button>
                        <button type="button" class="tab-nav-btn" data-target="tab-modal-emergency">
                            <span class="material-icons">emergency</span>
                            <span>Layanan Darurat</span>
                        </button>
                        <button type="button" class="tab-nav-btn" data-target="tab-modal-social">
                            <span class="material-icons">share</span>
                            <span>Media Sosial</span>
                        </button>
                    </div>

                    <!-- Tab 1: Identitas -->
                    <div id="tab-modal-identity" class="settings-tab-panel active">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="site_name">Nama Situs / Instansi <span class="text-danger">*</span></label>
                                    <input type="text" name="site_name" id="site_name" 
                                        value="{{ old('site_name', $setting->site_name) }}" 
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="site_tagline">Slogan / Tagline <span class="text-danger">*</span></label>
                                    <input type="text" name="site_tagline" id="site_tagline" 
                                        value="{{ old('site_tagline', $setting->site_tagline) }}" 
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Logo Situs Resmi</label>
                                    <div class="mb-2 text-center" style="border: 1px dashed #CBD5E1; background: #F8FAFC; border-radius: 3px; padding: 12px;">
                                        @if($setting->site_logo)
                                            <img src="{{ asset('uploads/settings/' . $setting->site_logo) }}" alt="Logo" style="max-height: 80px; max-width: 100%; object-fit: contain; background: #fff; padding: 4px; border: 1px solid #E2E8F0;" id="logo-preview-modal">
                                        @else
                                            <img src="{{ asset('images/logo.png') }}" alt="Logo Default" style="max-height: 80px; max-width: 100%; object-fit: contain; background: #fff; padding: 4px; border: 1px solid #E2E8F0;" id="logo-preview-modal">
                                        @endif
                                    </div>
                                    <div class="custom-file" style="font-size: 13px;">
                                        <input type="file" name="site_logo" id="site_logo" class="custom-file-input" onchange="previewImageModal(this)">
                                        <label class="custom-file-label" for="site_logo">Pilih File...</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 2: Kontak -->
                    <div id="tab-modal-contact" class="settings-tab-panel">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email Hubung <span class="text-danger">*</span></label>
                                    <input type="email" name="email" id="email" 
                                        value="{{ old('email', $setting->email) }}" 
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Nomor Telepon <span class="text-danger">*</span></label>
                                    <input type="text" name="phone" id="phone" 
                                        value="{{ old('phone', $setting->phone) }}" 
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address">Alamat Lengkap Kantor <span class="text-danger">*</span></label>
                                    <input type="text" name="address" id="address" 
                                        value="{{ old('address', $setting->address) }}" 
                                        class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 3: Emergency -->
                    <div id="tab-modal-emergency" class="settings-tab-panel">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="emergency_call">Nomor Darurat PSC <span class="text-danger">*</span></label>
                                    <input type="text" name="emergency_call" id="emergency_call" 
                                        value="{{ old('emergency_call', $setting->emergency_call) }}" 
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="emergency_title">Judul Layanan Darurat <span class="text-danger">*</span></label>
                                    <input type="text" name="emergency_title" id="emergency_title" 
                                        value="{{ old('emergency_title', $setting->emergency_title) }}" 
                                        class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 4: Socials -->
                    <div id="tab-modal-social" class="settings-tab-panel">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="social_facebook"><i class="fab fa-facebook mr-1" style="color: #1877F2;"></i> Link Facebook</label>
                                    <input type="url" name="social_facebook" id="social_facebook" 
                                        value="{{ old('social_facebook', $setting->social_facebook) }}" 
                                        class="form-control" placeholder="https://facebook.com/username">
                                </div>
                                <div class="form-group">
                                    <label for="social_instagram"><i class="fab fa-instagram mr-1" style="color: #E1306C;"></i> Link Instagram</label>
                                    <input type="url" name="social_instagram" id="social_instagram" 
                                        value="{{ old('social_instagram', $setting->social_instagram) }}" 
                                        class="form-control" placeholder="https://instagram.com/username">
                                </div>
                                <div class="form-group">
                                    <label for="social_twitter"><i class="fab fa-twitter mr-1" style="color: #1DA1F2;"></i> Link X (Twitter)</label>
                                    <input type="url" name="social_twitter" id="social_twitter" 
                                        value="{{ old('social_twitter', $setting->social_twitter) }}" 
                                        class="form-control" placeholder="https://x.com/username">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="social_youtube"><i class="fab fa-youtube mr-1" style="color: #FF0000;"></i> Link YouTube</label>
                                    <input type="url" name="social_youtube" id="social_youtube" 
                                        value="{{ old('social_youtube', $setting->social_youtube) }}" 
                                        class="form-control" placeholder="https://youtube.com/channel/id">
                                </div>
                                <div class="form-group">
                                    <label for="social_tiktok"><i class="fab fa-tiktok mr-1" style="color: #010101;"></i> Link TikTok</label>
                                    <input type="url" name="social_tiktok" id="social_tiktok" 
                                        value="{{ old('social_tiktok', $setting->social_tiktok) }}" 
                                        class="form-control" placeholder="https://tiktok.com/@username">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light" style="border-bottom-left-radius: 3px; border-bottom-right-radius: 3px;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius:3px;">Batal</button>
                    <button type="submit" class="btn btn-success px-4" id="settings-save-btn" style="border-radius:3px; font-weight:700;">
                        <i class="fas fa-save mr-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Tab switching logic for modal
    document.querySelectorAll('.tab-nav-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.tab-nav-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.settings-tab-panel').forEach(p => p.classList.remove('active'));
            
            this.classList.add('active');
            
            const targetId = this.getAttribute('data-target');
            document.getElementById(targetId).classList.add('active');
        });
    });

    // Image preview helper
    function previewImageModal(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('logo-preview-modal').setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            
            const fileName = input.files[0].name;
            input.nextElementSibling.innerText = fileName;
        }
    }

    // Submit loading state
    document.getElementById('settings-form').addEventListener('submit', function() {
        const btn = document.getElementById('settings-save-btn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-sync-alt fa-spin mr-1"></i> Menyimpan...';
    });
</script>
@endsection
