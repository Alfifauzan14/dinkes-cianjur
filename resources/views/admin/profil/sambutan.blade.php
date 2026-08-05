@extends('admin.layouts.admin')
@section('title', 'Sambutan Pimpinan')
@section('header_title', 'Sambutan Pimpinan')

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
            <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data" id="profile-form">
                @csrf
                @method('PUT')
                <input type="hidden" name="section" value="sambutan">

                <div class="form-section-title">
                    <span class="material-icons text-success">campaign</span>
                    <span>Sambutan Pimpinan</span>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kepala_dinas_name">Nama Kepala Dinas <span class="text-danger">*</span></label>
                            <input type="text" name="kepala_dinas_name" id="kepala_dinas_name" 
                                value="{{ old('kepala_dinas_name', $profile->kepala_dinas_name) }}" 
                                class="form-control @error('kepala_dinas_name') is-invalid @enderror" required>
                            @error('kepala_dinas_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kepala_dinas_role">Jabatan / Peran <span class="text-danger">*</span></label>
                            <input type="text" name="kepala_dinas_role" id="kepala_dinas_role" 
                                value="{{ old('kepala_dinas_role', $profile->kepala_dinas_role) }}" 
                                class="form-control @error('kepala_dinas_role') is-invalid @enderror" required>
                            @error('kepala_dinas_role') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="sambutan_title">Judul Sambutan Utama <span class="text-danger">*</span></label>
                    <input type="text" name="sambutan_title" id="sambutan_title" 
                        value="{{ old('sambutan_title', $profile->sambutan_title) }}" 
                        class="form-control @error('sambutan_title') is-invalid @enderror" required>
                    @error('sambutan_title') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="sambutan_quote">Kutipan Quote Sambutan (Baris Tebal) <span class="text-danger">*</span></label>
                    <textarea name="sambutan_quote" id="sambutan_quote" rows="2" class="form-control @error('sambutan_quote') is-invalid @enderror" required>{{ old('sambutan_quote', $profile->sambutan_quote) }}</textarea>
                    @error('sambutan_quote') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sambutan_desc_1">Paragraf Deskripsi 1 <span class="text-danger">*</span></label>
                            <textarea name="sambutan_desc_1" id="sambutan_desc_1" rows="4" class="form-control @error('sambutan_desc_1') is-invalid @enderror" required>{{ old('sambutan_desc_1', $profile->sambutan_desc_1) }}</textarea>
                            @error('sambutan_desc_1') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sambutan_desc_2">Paragraf Deskripsi 2 <span class="text-danger">*</span></label>
                            <textarea name="sambutan_desc_2" id="sambutan_desc_2" rows="4" class="form-control @error('sambutan_desc_2') is-invalid @enderror" required>{{ old('sambutan_desc_2', $profile->sambutan_desc_2) }}</textarea>
                            @error('sambutan_desc_2') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group mb-0">
                    <label>Foto Kepala Dinas</label>
                    <div class="d-flex align-items-center" style="gap: 16px;">
                        <div style="width: 75px; height: 100px; flex-shrink: 0; border: 1px solid #CBD5E1; border-radius: 6px; overflow: hidden; background: #F8FAFC; text-align: center;">
                            @if($profile->kepala_dinas_image && file_exists(public_path('uploads/profile/' . $profile->kepala_dinas_image)))
                                <img src="{{ asset('uploads/profile/' . $profile->kepala_dinas_image) }}" alt="Pimpinan" style="width: 100%; height: 100%; object-fit: cover;" id="kepala-preview-modal">
                            @else
                                <img src="{{ asset('images/Group 83.png') }}" alt="Pimpinan" style="width: 100%; height: 100%; object-fit: cover;" id="kepala-preview-modal">
                            @endif
                        </div>
                        <div class="custom-file" style="font-size: 13px; flex: 1;">
                            <input type="file" name="kepala_dinas_image" id="kepala_dinas_image" accept="image/*" class="custom-file-input" onchange="previewKepalaPhoto(this)">
                            <label class="custom-file-label" for="kepala_dinas_image">Unggah foto pimpinan baru...</label>
                        </div>
                    </div>
                    @error('kepala_dinas_image') <span class="text-danger small mt-1 d-block">{{ $message }}</span> @enderror
                </div>

                <div class="border-top pt-4 mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success px-4" id="profile-save-btn">
                        <span class="material-icons" style="font-size: 16px; vertical-align: middle; margin-right: 4px;">save</span> Simpan Sambutan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function previewKepalaPhoto(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('kepala-preview-modal').setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            
            const fileName = input.files[0].name;
            input.nextElementSibling.innerText = fileName;
        }
    }

    document.getElementById('profile-form').addEventListener('submit', function() {
        const btn = document.getElementById('profile-save-btn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-sync-alt fa-spin mr-1"></i> Menyimpan...';
    });
</script>
@endsection
