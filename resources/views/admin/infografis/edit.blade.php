@extends('admin.layouts.admin')
@section('title', 'Edit Infografis')
@section('header_title', 'Edit Infografis')

@section('content')
<div class="card card-outline card-success">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between" style="gap: 12px;">
        <span class="d-flex align-items-center" style="gap: 8px;">
            <span class="material-icons text-success" style="font-size:20px;">insert_chart</span>
            <span class="font-weight-bold card-title-label">Edit Infografis: <em class="text-muted font-weight-normal">{{ Str::limit($infografis->title, 40) }}</em></span>
        </span>
        <a href="{{ route('admin.infografis.index') }}" class="btn btn-sm btn-outline-secondary ml-auto">
            <span class="material-icons" style="font-size:16px;">arrow_back</span> Kembali
        </a>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.infografis.update', $infografis->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Judul Infografis <span class="text-danger">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $infografis->title) }}"
                    class="form-control @error('title') is-invalid @enderror"
                    placeholder="Masukkan judul infografis..." required>
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="description">Deskripsi <span class="text-muted" style="font-weight:400;">(opsional)</span></label>
                <textarea name="description" id="description" rows="3"
                    class="form-control @error('description') is-invalid @enderror"
                    placeholder="Deskripsi singkat infografis...">{{ old('description', $infografis->description) }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>Poster Saat Ini</label>
                <div>
                    <img src="{{ asset('uploads/infografis/' . $infografis->image) }}" alt="{{ $infografis->title }}"
                        style="max-width:180px;max-height:260px;object-fit:contain;border-radius:3px;border:1px solid #E5E7EB;">
                </div>
            </div>

            <div class="form-group">
                <label for="image">Ganti Poster <span class="text-muted" style="font-weight:400;">(opsional, kosongkan jika tidak diganti)</span></label>
                <input type="file" name="image" id="image" accept="image/*"
                    class="form-control @error('image') is-invalid @enderror" style="max-width: 450px;"
                    onchange="previewImage(this)">
                <small class="form-text text-muted">Format: JPEG, PNG, JPG, WebP. Maksimal: 5MB.</small>
                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                <div id="imagePreview" style="margin-top:12px;display:none;">
                    <img id="previewImg" src="" alt="Preview" style="max-width:180px;max-height:260px;object-fit:contain;border-radius:3px;border:1px solid #E5E7EB;">
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-end" style="gap:10px; border-top: 1px solid #F3F4F6; padding-top: 20px; margin-top: 24px;">
                <a href="{{ route('admin.infografis.index') }}" class="btn btn-outline-secondary">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">close</span> Batal
                </a>
                <button type="submit" class="btn btn-success">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">save</span> Perbarui Infografis
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
