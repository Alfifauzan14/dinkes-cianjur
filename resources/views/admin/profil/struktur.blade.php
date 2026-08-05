@extends('admin.layouts.admin')
@section('title', 'Struktur Organisasi')
@section('header_title', 'Struktur Organisasi')

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
                <input type="hidden" name="section" value="struktur">

                <div class="form-section-title">
                    <span class="material-icons text-success">account_tree</span>
                    <span>Struktur Organisasi</span>
                </div>

                <div class="form-group">
                    <label style="font-weight: 700; display: block; margin-bottom: 12px;">Struktur Organisasi Saat Ini</label>
                    <div class="mb-4 text-center" style="background: #F9FAFB; border: 1px dashed #CBD5E1; border-radius: 8px; padding: 24px;">
                        @if($profile->struktur_organisasi_image && file_exists(public_path('uploads/profile/' . $profile->struktur_organisasi_image)))
                            @if(Str::endsWith($profile->struktur_organisasi_image, '.pdf'))
                                <div class="py-4">
                                    <span class="material-icons text-danger" style="font-size:64px;">picture_as_pdf</span>
                                    <div class="small font-weight-bold text-muted mt-2">{{ $profile->struktur_organisasi_image }}</div>
                                    <a href="{{ asset('uploads/profile/' . $profile->struktur_organisasi_image) }}" target="_blank" class="btn btn-outline-danger btn-sm mt-3">
                                        <span class="material-icons" style="font-size: 14px; vertical-align: middle;">open_in_new</span> Lihat PDF
                                    </a>
                                </div>
                            @else
                                <img src="{{ asset('uploads/profile/' . $profile->struktur_organisasi_image) }}" alt="Struktur Organisasi" style="max-height: 300px; max-width: 100%; object-fit: contain; box-shadow: 0 4px 10px rgba(0,0,0,0.1); border-radius: 4px;" id="struktur-preview-modal">
                            @endif
                        @else
                            <div class="py-4 text-muted">
                                <span class="material-icons" style="font-size:64px; color:#D1D5DB;">image_not_supported</span>
                                <div class="small mt-2">Belum ada berkas struktur organisasi ditambahkan</div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group mb-0">
                    <label for="struktur_organisasi_image">Unggah Berkas Struktur Baru</label>
                    <div class="custom-file" style="font-size: 13px;">
                        <input type="file" name="struktur_organisasi_image" id="struktur_organisasi_image" accept="image/*,.pdf" class="custom-file-input" onchange="previewStrukturFile(this)">
                        <label class="custom-file-label" for="struktur_organisasi_image">Pilih gambar atau berkas PDF...</label>
                    </div>
                    <small class="text-muted d-block mt-2">Format: JPEG, PNG, JPG, WebP, PDF. Maksimal: 5MB.</small>
                    @error('struktur_organisasi_image') <span class="text-danger small mt-1 d-block">{{ $message }}</span> @enderror
                </div>

                <div class="border-top pt-4 mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success px-4" id="profile-save-btn">
                        <span class="material-icons" style="font-size: 16px; vertical-align: middle; margin-right: 4px;">save</span> Simpan Struktur
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function previewStrukturFile(input) {
        if (input.files && input.files[0]) {
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
