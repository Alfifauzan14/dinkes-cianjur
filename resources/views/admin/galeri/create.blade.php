@extends('admin.layouts.admin')

@section('title', 'Tambah Album Galeri')
@section('header_title', 'Tambah Album Galeri Baru')

@section('content')

<div class="card card-outline card-success">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between" style="gap: 12px;">
        <span class="d-flex align-items-center" style="gap: 8px;">
            <span class="material-icons text-success" style="font-size:20px;">add_photo_alternate</span>
            <span class="font-weight-bold card-title-label">Formulir Tambah Album Galeri</span>
        </span>
        <a href="{{ route('admin.galeri.index') }}" class="btn btn-sm btn-outline-secondary ml-auto">
            <span class="material-icons" style="font-size:16px;">arrow_back</span> Kembali
        </a>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Judul Album / Kegiatan <span class="text-danger">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                    class="form-control @error('title') is-invalid @enderror"
                    placeholder="Masukkan judul album atau nama kegiatan..." required>
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="category">Kategori <span class="text-danger">*</span></label>
                <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" style="max-width: 300px;" required>
                    @foreach($kategoris as $kat)
                    <option value="{{ $kat->nama }}" {{ old('category') == $kat->nama ? 'selected' : '' }}>{{ $kat->nama }}</option>
                    @endforeach
                </select>
                @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="images">Pilih Foto <span class="text-danger">*</span></label>
                <input type="file" name="images[]" id="images" accept="image/*" multiple
                    class="form-control @error('images') is-invalid @enderror" style="max-width: 500px;" required>
                <small class="form-text text-muted">Bisa pilih banyak sekaligus (Ctrl+Click atau Shift+Click). Format: JPEG, PNG, JPG, WebP. Maksimal: 2MB per foto.</small>
                @error('images') <div class="invalid-feedback">{{ $message }}</div> @enderror
                @error('images.*') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group" id="thumbnailSection" style="display:none;">
                <label>Pilih Thumbnail <span class="text-danger">*</span></label>
                <div id="thumbnailPreview" class="d-flex flex-wrap" style="gap: 10px;"></div>
                <input type="hidden" name="thumbnail_index" id="thumbnail_index" value="0">
                <small class="form-text text-muted">Klik pada foto untuk memilih sebagai thumbnail.</small>
            </div>

            <div class="d-flex align-items-center justify-content-end" style="gap:10px; border-top: 1px solid #F3F4F6; padding-top: 20px; margin-top: 24px;">
                <a href="{{ route('admin.galeri.index') }}" class="btn btn-outline-secondary">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">close</span> Batal
                </a>
                <button type="submit" class="btn btn-success">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">save</span> Simpan Album
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var input = document.getElementById('images');
    var thumbSection = document.getElementById('thumbnailSection');
    var thumbPreview = document.getElementById('thumbnailPreview');
    var thumbIndex = document.getElementById('thumbnail_index');

    input.addEventListener('change', function() {
        thumbPreview.innerHTML = '';
        if (this.files.length > 0) {
            thumbSection.style.display = 'block';
            thumbIndex.value = 0;
            Array.from(this.files).forEach(function(file, i) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var wrapper = document.createElement('div');
                    wrapper.style.cssText = 'position:relative;width:120px;height:90px;cursor:pointer;border-radius:3px;overflow:hidden;border:2px solid ' + (i === 0 ? '#009966' : '#D1D5DB');
                    wrapper.dataset.index = i;
                    wrapper.onclick = function() {
                        document.querySelectorAll('#thumbnailPreview div').forEach(function(d) { d.style.borderColor = '#D1D5DB'; });
                        wrapper.style.borderColor = '#009966';
                        thumbIndex.value = i;
                    };
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.cssText = 'width:100%;height:100%;object-fit:cover';
                    var badge = document.createElement('span');
                    badge.textContent = '★ Thumbnail';
                    badge.style.cssText = 'position:absolute;bottom:2px;left:2px;background:#009966;color:#fff;font-size:9px;padding:2px 6px;border-radius:2px;font-weight:700;display:' + (i === 0 ? 'block' : 'none');
                    badge.className = 'thumb-badge';
                    wrapper.appendChild(img);
                    wrapper.appendChild(badge);
                    thumbPreview.appendChild(wrapper);
                };
                reader.readAsDataURL(file);
            });
        } else {
            thumbSection.style.display = 'none';
        }
    });
});
</script>
@endsection
