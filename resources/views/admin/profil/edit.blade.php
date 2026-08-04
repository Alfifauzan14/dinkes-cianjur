@extends('admin.layouts.admin')
@section('title', 'Halaman Profil Dinkes')
@section('header_title', 'Halaman Profil Dinkes')

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
    .profile-tabs-nav {
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
    .profile-tab-panel {
        display: none;
    }
    .profile-tab-panel.active {
        display: block;
    }
    .misi-grid-layout {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 12px;
        margin-bottom: 16px;
    }
    .misi-card-field {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 3px;
        padding: 12px 14px;
        position: relative;
    }
</style>
@endsection

@section('content')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <p class="text-muted mb-0">Kelola sambutan pimpinan, visi & misi instansi, sejarah instansi, dan struktur organisasi dinkes.</p>
    </div>
    <button type="button" class="btn btn-success px-4" data-toggle="modal" data-target="#modal-edit-profile" style="border-radius:3px; font-weight:700; box-shadow:0 2px 10px rgba(0, 153, 102, 0.2);">
        <i class="fas fa-edit mr-2"></i> Ubah Halaman Profil
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
    <!-- Card 1: Sambutan Pimpinan -->
    <div class="overview-card">
        <div class="card-meta-icon"><span class="material-icons">campaign</span></div>
        <div class="meta-title">Sambutan Pimpinan</div>
        
        <div class="d-flex gap-3 align-items-start mb-3">
            <div style="flex-shrink: 0;">
                @if($profile->kepala_dinas_image && file_exists(public_path('uploads/profile/' . $profile->kepala_dinas_image)))
                    <img src="{{ asset('uploads/profile/' . $profile->kepala_dinas_image) }}" alt="Kepala Dinas" style="width: 70px; height: 90px; object-fit: cover; border-radius: 3px; border: 1px solid #E2E8F0;">
                @else
                    <img src="{{ asset('images/Group 83.png') }}" alt="Default" style="width: 70px; height: 90px; object-fit: cover; border-radius: 3px; border: 1px solid #E2E8F0;">
                @endif
            </div>
            <div>
                <div class="info-label" style="margin-top: 0;">Nama Kepala Dinas</div>
                <div class="info-val" style="font-weight: 700;">{{ $profile->kepala_dinas_name }}</div>
                
                <div class="info-label">Jabatan</div>
                <div class="info-val">{{ $profile->kepala_dinas_role }}</div>
            </div>
        </div>

        <div class="info-label">Judul Sambutan</div>
        <div class="info-val" style="font-weight: 600;">{{ $profile->sambutan_title }}</div>

        <div class="info-label">Quote Sambutan</div>
        <div class="info-val text-muted small" style="line-height: 1.4;">"{{ Str::limit($profile->sambutan_quote, 140) }}"</div>
    </div>

    <!-- Card 2: Visi & Misi -->
    <div class="overview-card">
        <div class="card-meta-icon"><span class="material-icons">flag</span></div>
        <div class="meta-title">Visi, Misi &amp; Statistik</div>

        <div class="info-label">Visi Instansi</div>
        <div class="info-val" style="font-weight: 600;">{{ $profile->visi_title }}</div>

        <div class="info-label">Jumlah Misi</div>
        <div class="info-val">{{ count($profile->misi ?? []) }} Misi Terdaftar</div>

        <div class="row mt-2">
            <div class="col-6">
                <div class="info-label">Statistik 1</div>
                <div class="info-val" style="font-weight: 700; color: #009966;">{{ $profile->stat_1_text }}</div>
            </div>
            <div class="col-6">
                <div class="info-label">Statistik 2</div>
                <div class="info-val" style="font-weight: 700; color: #009966;">{{ $profile->stat_2_text }}</div>
            </div>
        </div>
    </div>

    <!-- Card 3: Sejarah -->
    <div class="overview-card">
        <div class="card-meta-icon"><span class="material-icons">history_edu</span></div>
        <div class="meta-title">Sejarah &amp; Latar Belakang</div>

        <div class="info-label">Judul Latar Belakang</div>
        <div class="info-val" style="font-weight: 600;">{{ $profile->sejarah_title }}</div>

        <div class="info-label">Logo Sejarah</div>
        <div class="mb-2">
            @if($profile->sejarah_image && file_exists(public_path('uploads/profile/' . $profile->sejarah_image)))
                <img src="{{ asset('uploads/profile/' . $profile->sejarah_image) }}" alt="Logo Sejarah" style="max-height: 40px; object-fit: contain; padding: 2px; border: 1px solid #E2E8F0; background: #fff; border-radius: 3px;">
            @else
                <span class="text-muted small italic">Menggunakan logo default</span>
            @endif
        </div>

        <div class="info-label">Paragraf 1 Preview</div>
        <div class="info-val text-muted small">{{ Str::limit($profile->sejarah_text_1, 120) }}</div>
    </div>

    <!-- Card 4: Struktur Organisasi -->
    <div class="overview-card">
        <div class="card-meta-icon"><span class="material-icons">account_tree</span></div>
        <div class="meta-title">Struktur Organisasi</div>

        <div class="info-label">Berkas Struktur Organisasi</div>
        <div class="mt-2 text-center" style="background:#F8FAFC; border:1px solid #E2E8F0; border-radius:3px; padding:12px;">
            @if($profile->struktur_organisasi_image && file_exists(public_path('uploads/profile/' . $profile->struktur_organisasi_image)))
                @if(Str::endsWith($profile->struktur_organisasi_image, '.pdf'))
                    <span class="material-icons text-danger" style="font-size:32px;">picture_as_pdf</span>
                    <div class="small text-muted mt-1">{{ Str::limit($profile->struktur_organisasi_image, 25) }}</div>
                @else
                    <img src="{{ asset('uploads/profile/' . $profile->struktur_organisasi_image) }}" alt="Struktur" style="max-height: 60px; max-width: 100%; object-fit: contain;">
                @endif
            @else
                <span class="material-icons text-muted" style="font-size:32px;">image_not_supported</span>
                <div class="small text-muted mt-1">Belum ada berkas</div>
            @endif
        </div>
    </div>
</div>

<!-- POPUP MODAL EDIT FORM -->
<div class="modal fade" id="modal-edit-profile" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 3px;">
            <div class="modal-header bg-success text-white py-3" style="border-top-left-radius: 3px; border-top-right-radius: 3px;">
                <h5 class="modal-title font-weight-bold" id="modalLabel"><i class="fas fa-edit mr-2"></i> Ubah Halaman Profil</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data" id="profile-form">
                @csrf
                @method('PUT')

                <div class="modal-body px-4 pt-4">
                    <!-- Tab Navigation -->
                    <div class="profile-tabs-nav">
                        <button type="button" class="tab-nav-btn active" data-target="tab-modal-sambutan">
                            <span class="material-icons">campaign</span>
                            <span>Sambutan</span>
                        </button>
                        <button type="button" class="tab-nav-btn" data-target="tab-modal-visi-misi">
                            <span class="material-icons">flag</span>
                            <span>Visi &amp; Misi</span>
                        </button>
                        <button type="button" class="tab-nav-btn" data-target="tab-modal-sejarah">
                            <span class="material-icons">history_edu</span>
                            <span>Sejarah</span>
                        </button>
                        <button type="button" class="tab-nav-btn" data-target="tab-modal-struktur">
                            <span class="material-icons">account_tree</span>
                            <span>Struktur</span>
                        </button>
                    </div>

                    <!-- Tab 1: Sambutan -->
                    <div id="tab-modal-sambutan" class="profile-tab-panel active">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kepala_dinas_name">Nama Kepala Dinas <span class="text-danger">*</span></label>
                                    <input type="text" name="kepala_dinas_name" id="kepala_dinas_name" 
                                        value="{{ old('kepala_dinas_name', $profile->kepala_dinas_name) }}" 
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kepala_dinas_role">Jabatan / Peran <span class="text-danger">*</span></label>
                                    <input type="text" name="kepala_dinas_role" id="kepala_dinas_role" 
                                        value="{{ old('kepala_dinas_role', $profile->kepala_dinas_role) }}" 
                                        class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sambutan_title">Judul Sambutan Utama <span class="text-danger">*</span></label>
                            <input type="text" name="sambutan_title" id="sambutan_title" 
                                value="{{ old('sambutan_title', $profile->sambutan_title) }}" 
                                class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="sambutan_quote">Kutipan Quote Sambutan (Baris Tebal) <span class="text-danger">*</span></label>
                            <textarea name="sambutan_quote" id="sambutan_quote" rows="2" class="form-control" required>{{ old('sambutan_quote', $profile->sambutan_quote) }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sambutan_desc_1">Paragraf Deskripsi 1 <span class="text-danger">*</span></label>
                                    <textarea name="sambutan_desc_1" id="sambutan_desc_1" rows="4" class="form-control" required>{{ old('sambutan_desc_1', $profile->sambutan_desc_1) }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sambutan_desc_2">Paragraf Deskripsi 2 <span class="text-danger">*</span></label>
                                    <textarea name="sambutan_desc_2" id="sambutan_desc_2" rows="4" class="form-control" required>{{ old('sambutan_desc_2', $profile->sambutan_desc_2) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Foto Kepala Dinas</label>
                            <div class="d-flex align-items-center gap-3">
                                <div style="width: 60px; height: 80px; flex-shrink: 0; border: 1px solid #CBD5E1; border-radius: 3px; overflow: hidden; background: #F8FAFC; text-align: center;">
                                    @if($profile->kepala_dinas_image && file_exists(public_path('uploads/profile/' . $profile->kepala_dinas_image)))
                                        <img src="{{ asset('uploads/profile/' . $profile->kepala_dinas_image) }}" alt="Pimpinan" style="width: 100%; height: 100%; object-fit: cover;" id="kepala-preview-modal">
                                    @else
                                        <img src="{{ asset('images/Group 83.png') }}" alt="Pimpinan" style="width: 100%; height: 100%; object-fit: cover;" id="kepala-preview-modal">
                                    @endif
                                </div>
                                <div class="custom-file" style="font-size: 13px;">
                                    <input type="file" name="kepala_dinas_image" id="kepala_dinas_image" accept="image/*" class="custom-file-input" onchange="previewKepalaPhoto(this)">
                                    <label class="custom-file-label" for="kepala_dinas_image">Unggah foto pimpinan baru...</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 2: Visi & Misi -->
                    <div id="tab-modal-visi-misi" class="profile-tab-panel">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="visi_title">Teks Visi Utama <span class="text-danger">*</span></label>
                                    <textarea name="visi_title" id="visi_title" rows="2" class="form-control" required>{{ old('visi_title', $profile->visi_title) }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="visi_desc">Deskripsi Penjelasan Visi <span class="text-danger">*</span></label>
                                    <textarea name="visi_desc" id="visi_desc" rows="2" class="form-control" required>{{ old('visi_desc', $profile->visi_desc) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stat_1_text">Statistik 1 (Kiri) <span class="text-danger">*</span></label>
                                    <input type="text" name="stat_1_text" id="stat_1_text" 
                                        value="{{ old('stat_1_text', $profile->stat_1_text) }}" 
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stat_2_text">Statistik 2 (Kanan) <span class="text-danger">*</span></label>
                                    <input type="text" name="stat_2_text" id="stat_2_text" 
                                        value="{{ old('stat_2_text', $profile->stat_2_text) }}" 
                                        class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <h3 class="h6 font-weight-bold text-success mb-2 mt-2">Daftar Misi Instansi</h3>
                        <div id="misi-container" class="misi-grid-layout">
                            @foreach (old('misi', $profile->misi ?? []) as $index => $item)
                                <div class="misi-card-field" data-index="{{ $index }}">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="badge badge-success">Misi Poin {{ $index + 1 }}</span>
                                        <button type="button" class="btn btn-xs btn-outline-danger" onclick="removeMisiField(this)">
                                            <span class="material-icons" style="font-size:12px;vertical-align:middle;">delete</span> Hapus
                                        </button>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label style="font-size:11px;font-weight:600;color:#475569;margin-bottom:2px;">Judul Misi</label>
                                        <input type="text" name="misi[{{ $index }}][title]" 
                                            value="{{ $item['title'] ?? '' }}" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label style="font-size:11px;font-weight:600;color:#475569;margin-bottom:2px;">Deskripsi Misi</label>
                                        <textarea name="misi[{{ $index }}][desc]" rows="2" class="form-control form-control-sm" required>{{ $item['desc'] ?? '' }}</textarea>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" id="btn-add-misi" class="btn btn-sm btn-outline-success">
                            <span class="material-icons" style="font-size:14px;vertical-align:middle;">add</span> Tambah Poin Misi
                        </button>
                    </div>

                    <!-- Tab 3: Sejarah -->
                    <div id="tab-modal-sejarah" class="profile-tab-panel">
                        <div class="form-group">
                            <label for="sejarah_title">Judul Latar Belakang <span class="text-danger">*</span></label>
                            <input type="text" name="sejarah_title" id="sejarah_title" 
                                value="{{ old('sejarah_title', $profile->sejarah_title) }}" 
                                class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="sejarah_text_1">Paragraf Sejarah 1 <span class="text-danger">*</span></label>
                            <textarea name="sejarah_text_1" id="sejarah_text_1" rows="4" class="form-control" required>{{ old('sejarah_text_1', $profile->sejarah_text_1) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="sejarah_text_2">Paragraf Sejarah 2 <span class="text-danger">*</span></label>
                            <textarea name="sejarah_text_2" id="sejarah_text_2" rows="4" class="form-control" required>{{ old('sejarah_text_2', $profile->sejarah_text_2) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Logo / Gambar Sejarah</label>
                            <div class="d-flex align-items-center gap-3">
                                <div style="width: 80px; height: 60px; flex-shrink: 0; border: 1px solid #CBD5E1; border-radius: 3px; overflow: hidden; background: #F8FAFC; display: flex; align-items: center; justify-content: center; padding: 4px;">
                                    @if($profile->sejarah_image && file_exists(public_path('uploads/profile/' . $profile->sejarah_image)))
                                        <img src="{{ asset('uploads/profile/' . $profile->sejarah_image) }}" alt="Logo Sejarah" style="max-height: 100%; max-width: 100%; object-fit: contain;" id="sejarah-preview-modal">
                                    @else
                                        <img src="{{ asset('Assets/layouts/Nav/logo_dinkes_cropped.png') }}" alt="Logo Default" style="max-height: 100%; max-width: 100%; object-fit: contain;" id="sejarah-preview-modal">
                                    @endif
                                </div>
                                <div class="custom-file" style="font-size: 13px;">
                                    <input type="file" name="sejarah_image" id="sejarah_image" accept="image/*" class="custom-file-input" onchange="previewSejarahPhoto(this)">
                                    <label class="custom-file-label" for="sejarah_image">Unggah logo sejarah baru...</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 4: Struktur -->
                    <div id="tab-modal-struktur" class="profile-tab-panel">
                        <div class="form-group">
                            <label style="font-weight: 700; display: block; margin-bottom: 8px;">Struktur Organisasi Saat Ini</label>
                            <div class="mb-3 text-center" style="background: #F9FAFB; border: 1px dashed #CBD5E1; border-radius: 3px; padding: 16px;">
                                @if($profile->struktur_organisasi_image && file_exists(public_path('uploads/profile/' . $profile->struktur_organisasi_image)))
                                    @if(Str::endsWith($profile->struktur_organisasi_image, '.pdf'))
                                        <div class="py-3">
                                            <span class="material-icons text-danger" style="font-size:48px;">picture_as_pdf</span>
                                            <div class="small text-muted mt-2">{{ $profile->struktur_organisasi_image }}</div>
                                        </div>
                                    @else
                                        <img src="{{ asset('uploads/profile/' . $profile->struktur_organisasi_image) }}" alt="Struktur" style="max-height: 150px; max-width: 100%; object-fit: contain;" id="struktur-preview-modal">
                                    @endif
                                @else
                                    <div class="py-3 text-muted">
                                        <span class="material-icons" style="font-size:48px;">image_not_supported</span>
                                        <div class="small mt-2">Belum ada berkas struktur</div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="struktur_organisasi_image">Unggah Berkas Struktur Baru (Opsional)</label>
                            <div class="custom-file" style="font-size: 13px;">
                                <input type="file" name="struktur_organisasi_image" id="struktur_organisasi_image" accept="image/*,.pdf" class="custom-file-input" onchange="previewStrukturFile(this)">
                                <label class="custom-file-label" for="struktur_organisasi_image">Pilih gambar atau berkas PDF...</label>
                            </div>
                            <small class="text-muted d-block mt-1">Format: JPEG, PNG, JPG, WebP, PDF. Maksimal: 5MB.</small>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light" style="border-bottom-left-radius: 3px; border-bottom-right-radius: 3px;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius:3px;">Batal</button>
                    <button type="submit" class="btn btn-success px-4" id="profile-save-btn" style="border-radius:3px; font-weight:700;">
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
            document.querySelectorAll('.profile-tab-panel').forEach(p => p.classList.remove('active'));
            
            this.classList.add('active');
            
            const targetId = this.getAttribute('data-target');
            document.getElementById(targetId).classList.add('active');
        });
    });

    // File input label helper
    function updateFileLabel(input) {
        if (input.files && input.files[0]) {
            const fileName = input.files[0].name;
            input.nextElementSibling.innerText = fileName;
        }
    }

    // Photo preview helpers
    function previewKepalaPhoto(input) {
        updateFileLabel(input);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('kepala-preview-modal').setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewSejarahPhoto(input) {
        updateFileLabel(input);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('sejarah-preview-modal').setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewStrukturFile(input) {
        updateFileLabel(input);
    }

    // Dynamic Misi list modifiers
    const container = document.getElementById('misi-container');
    const btnAdd = document.getElementById('btn-add-misi');

    if (btnAdd) {
        btnAdd.addEventListener('click', function () {
            const index = container.children.length;
            const newField = document.createElement('div');
            newField.className = 'misi-card-field';
            newField.dataset.index = index;
            newField.innerHTML = `
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="badge badge-success">Misi Poin Baru</span>
                    <button type="button" class="btn btn-xs btn-outline-danger" onclick="removeMisiField(this)">
                        <span class="material-icons" style="font-size:12px;vertical-align:middle;">delete</span> Hapus
                    </button>
                </div>
                <div class="form-group mb-1">
                    <label style="font-size: 11px; font-weight: 600; color: #4B5563; display: block; margin-bottom: 2px;">Judul Misi</label>
                    <input type="text" name="misi[${index}][title]" class="form-control form-control-sm" placeholder="Contoh: Pemerataan Pelayanan" required>
                </div>
                <div class="form-group mb-0">
                    <label style="font-size: 11px; font-weight: 600; color: #4B5563; display: block; margin-bottom: 2px;">Deskripsi Misi</label>
                    <textarea name="misi[${index}][desc]" rows="2" class="form-control form-control-sm" placeholder="Deskripsi..." required></textarea>
                </div>
            `;
            container.appendChild(newField);
        });
    }

    function removeMisiField(button) {
        Swal.fire({
            title: 'Hapus Misi ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                const card = button.closest('.misi-card-field');
                card.remove();

                // Re-index inputs
                Array.from(container.children).forEach((child, idx) => {
                    const titleInput = child.querySelector('input');
                    if (titleInput) titleInput.name = `misi[${idx}][title]`;
                    
                    const descTextarea = child.querySelector('textarea');
                    if (descTextarea) descTextarea.name = `misi[${idx}][desc]`;
                    
                    const badge = child.querySelector('.badge');
                    if (badge && !badge.innerText.includes('Baru')) {
                        badge.innerText = `Misi Poin ${idx + 1}`;
                    }
                });
            }
        });
    }

    // Submit loading state
    document.getElementById('profile-form').addEventListener('submit', function() {
        const btn = document.getElementById('profile-save-btn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-sync-alt fa-spin mr-1"></i> Menyimpan...';
    });
</script>
@endsection
