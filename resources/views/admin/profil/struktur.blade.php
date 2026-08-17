@extends('admin.layouts.admin')
@section('title', 'Struktur Organisasi')
@section('header_title', 'Struktur Organisasi')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-outline card-success">
            <div class="card-header d-flex align-items-center justify-content-between" style="padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
                <span class="d-flex align-items-center" style="gap: 8px;">
                    <span class="material-icons text-success" style="font-size: 20px;">account_tree</span>
                    <span class="font-weight-bold card-title-label">Struktur Organisasi</span>
                </span>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data" id="profile-form">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="section" value="struktur">

                    <div class="form-group mb-3">
                        <label class="font-weight-bold mb-2" style="font-size: 13px; color: #1E293B; display: block;">Struktur Organisasi Saat Ini</label>
                        <div class="mb-3 text-center" style="background: #F8FAFC; border: 1px dashed #CBD5E1; border-radius: 3px; padding: 24px;">
                            @if($profile->struktur_organisasi_image && file_exists(public_path('uploads/profile/' . $profile->struktur_organisasi_image)))
                                @if(Str::endsWith($profile->struktur_organisasi_image, '.pdf'))
                                    <div class="py-3">
                                        <span class="material-icons text-danger" style="font-size:56px;">picture_as_pdf</span>
                                        <div class="small font-weight-bold text-muted mt-2">{{ $profile->struktur_organisasi_image }}</div>
                                        <a href="{{ asset('uploads/profile/' . $profile->struktur_organisasi_image) }}" target="_blank" class="btn btn-outline-danger btn-sm mt-3" style="border-radius: 3px;">
                                            <span class="material-icons" style="font-size: 14px; vertical-align: middle;">open_in_new</span> Lihat PDF
                                        </a>
                                    </div>
                                @else
                                    <img src="{{ asset('uploads/profile/' . $profile->struktur_organisasi_image) }}" alt="Struktur Organisasi" style="max-height: 280px; max-width: 100%; object-fit: contain; border-radius: 3px;" id="struktur-preview-modal">
                                @endif
                            @else
                                <div class="py-4 text-muted">
                                    <span class="material-icons" style="font-size:56px; color:#CBD5E1;">image_not_supported</span>
                                    <div class="small mt-2">Belum ada berkas struktur organisasi ditambahkan</div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <label for="struktur_organisasi_image" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">Unggah Berkas Struktur Baru</label>
                        <div class="custom-file" style="font-size: 13px;">
                            <input type="file" name="struktur_organisasi_image" id="struktur_organisasi_image" accept="image/*,.pdf" class="custom-file-input" onchange="previewStrukturFile(this)">
                            <label class="custom-file-label" for="struktur_organisasi_image" style="border-radius: 3px;">Pilih gambar atau berkas PDF...</label>
                        </div>
                        <small class="text-muted d-block mt-2">Format yang didukung: JPEG, PNG, JPG, WebP, PDF. Ukuran maksimal: 5MB.</small>
                        @error('struktur_organisasi_image') <span class="text-danger small mt-1 d-block">{{ $message }}</span> @enderror
                    </div>

                    <div class="border-top pt-4 mt-4 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success font-weight-bold px-4" id="profile-save-btn">
                            <span class="material-icons" style="font-size: 16px; vertical-align: middle; margin-right: 4px;">save</span> Simpan Struktur
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
    function previewStrukturFile(input) {
        if (input.files && input.files[0]) {
            const fileName = input.files[0].name;
            input.nextElementSibling.innerText = fileName;
        }
    }

    document.getElementById('profile-form').addEventListener('submit', function() {
        const btn = document.getElementById('profile-save-btn');
        btn.disabled = true;
        btn.innerHTML = '<span class="material-icons" style="font-size: 16px; vertical-align: middle;">sync</span> Menyimpan...';
    });
</script>
@endsection
