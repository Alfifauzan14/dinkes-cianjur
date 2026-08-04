@extends('admin.layouts.admin')
@section('title', 'Identitas Situs')
@section('header_title', 'Identitas Situs')

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
    .preview-box {
        border: 1px dashed #CBD5E1;
        background: #F8FAFC;
        border-radius: 6px;
        padding: 16px;
        text-align: center;
        margin-bottom: 12px;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 6px; margin-bottom: 20px;">
                <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="custom-form-card">
            <form action="{{ route('admin.setting.update') }}" method="POST" enctype="multipart/form-data" id="setting-form">
                @csrf
                @method('PUT')
                <input type="hidden" name="section" value="identitas">

                <div class="form-section-title">
                    <span class="material-icons text-success">web</span>
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

                <div class="border-top pt-4 mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success px-4" id="btn-save-setting">
                        <span class="material-icons" style="font-size: 16px; vertical-align: middle; margin-right: 4px;">save</span> Simpan Identitas
                    </button>
                </div>
            </form>
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
            }
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
