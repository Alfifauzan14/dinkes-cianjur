@extends('admin.layouts.admin')
@section('title', 'Sejarah Instansi')
@section('header_title', 'Sejarah Instansi')

@section('content')


<div class="row">
    <div class="col-12">
        <div class="card card-outline card-success">
            <div class="card-header d-flex align-items-center justify-content-between" style="padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
                <span class="d-flex align-items-center" style="gap: 8px;">
                    <span class="material-icons text-success">history_edu</span>
                    <span class="font-weight-bold card-title-label">Sejarah &amp; Latar Belakang Instansi</span>
                </span>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data" id="profile-form">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="section" value="sejarah">

                <div class="form-group">
                    <label for="sejarah_title">Judul Latar Belakang <span class="text-danger">*</span></label>
                    <input type="text" name="sejarah_title" id="sejarah_title" 
                        value="{{ old('sejarah_title', $profile->sejarah_title) }}" 
                        class="form-control @error('sejarah_title') is-invalid @enderror" required>
                    @error('sejarah_title') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="sejarah_text_1">Paragraf Sejarah 1 <span class="text-danger">*</span></label>
                    <textarea name="sejarah_text_1" id="sejarah_text_1" rows="5" class="form-control @error('sejarah_text_1') is-invalid @enderror" required>{{ old('sejarah_text_1', $profile->sejarah_text_1) }}</textarea>
                    @error('sejarah_text_1') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="sejarah_text_2">Paragraf Sejarah 2 <span class="text-danger">*</span></label>
                    <textarea name="sejarah_text_2" id="sejarah_text_2" rows="5" class="form-control @error('sejarah_text_2') is-invalid @enderror" required>{{ old('sejarah_text_2', $profile->sejarah_text_2) }}</textarea>
                    @error('sejarah_text_2') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="form-group mb-0">
                    <label>Logo / Gambar Sejarah</label>
                    <div class="d-flex align-items-center" style="gap: 16px;">
                        <div style="width: 100px; height: 75px; flex-shrink: 0; border: 1px solid #CBD5E1; border-radius: 6px; overflow: hidden; background: #F8FAFC; display: flex; align-items: center; justify-content: center; padding: 6px;">
                            @if($profile->sejarah_image && file_exists(public_path('uploads/profile/' . $profile->sejarah_image)))
                                <img src="{{ asset('uploads/profile/' . $profile->sejarah_image) }}" alt="Logo Sejarah" style="max-height: 100%; max-width: 100%; object-fit: contain;" id="sejarah-preview-modal">
                            @else
                                <img src="{{ asset('images/logo.png') }}" alt="Logo Default" style="max-height: 100%; max-width: 100%; object-fit: contain;" id="sejarah-preview-modal">
                            @endif
                        </div>
                        <div class="custom-file" style="font-size: 13px; flex: 1;">
                            <input type="file" name="sejarah_image" id="sejarah_image" accept="image/*" class="custom-file-input" onchange="previewSejarahPhoto(this)">
                            <label class="custom-file-label" for="sejarah_image">Unggah logo sejarah baru...</label>
                        </div>
                    </div>
                    @error('sejarah_image') <span class="text-danger small mt-1 d-block">{{ $message }}</span> @enderror
                </div>

                <div class="border-top pt-4 mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success-dark px-4" id="profile-save-btn">
                        <span class="material-icons" style="font-size: 16px; vertical-align: middle; margin-right: 4px;">save</span> Simpan Sejarah
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
    function previewSejarahPhoto(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('sejarah-preview-modal').setAttribute('src', e.target.result);
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
