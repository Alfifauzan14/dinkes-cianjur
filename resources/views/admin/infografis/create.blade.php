@extends('admin.layouts.admin')
@section('title', 'Tambah Infografis')
@section('header_title', 'Tambah Infografis Baru')

@section('content')
<div class="card card-outline card-success">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span class="font-weight-bold text-muted" style="font-size:13px;">
            <span class="material-icons text-success" style="font-size:16px;vertical-align:middle;">bar_chart</span>
            Formulir Infografis Baru
        </span>
        <a href="{{ route('admin.infografis.index') }}" class="btn btn-sm btn-outline-secondary">
            <span class="material-icons" style="font-size:15px;vertical-align:middle;">arrow_back</span> Kembali
        </a>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.infografis.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Judul Infografis <span class="text-danger">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                    class="form-control @error('title') is-invalid @enderror"
                    placeholder="Masukkan judul infografis..." required>
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="description">Deskripsi <span class="text-muted" style="font-weight:400;">(opsional)</span></label>
                <textarea name="description" id="description" rows="3"
                    class="form-control @error('description') is-invalid @enderror"
                    placeholder="Deskripsi singkat infografis...">{{ old('description') }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="image">Upload Poster / Infografis <span class="text-danger">*</span></label>
                <input type="file" name="image" id="image" accept="image/*"
                    class="form-control @error('image') is-invalid @enderror" style="max-width: 450px;" required
                    onchange="previewImage(this)">
                <small class="form-text text-muted">Format: JPEG, PNG, JPG, WebP. Maksimal: 5MB.</small>
                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                <div id="imagePreview" style="margin-top:12px;display:none;">
                    <img id="previewImg" src="" alt="Preview" style="max-width:200px;max-height:280px;object-fit:contain;border-radius:3px;border:1px solid #E5E7EB;">
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-end" style="gap:10px; border-top: 1px solid #F3F4F6; padding-top: 20px; margin-top: 24px;">
                <a href="{{ route('admin.infografis.index') }}" class="btn btn-outline-secondary">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">close</span> Batal
                </a>
                <button type="submit" class="btn btn-success">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">save</span> Simpan Infografis
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const img = document.getElementById('previewImg');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            img.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
