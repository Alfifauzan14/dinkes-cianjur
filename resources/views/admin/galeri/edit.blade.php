@extends('admin.layouts.admin')

@section('title', 'Edit Album Galeri')
@section('header_title', 'Edit Album Galeri')

@section('content')

<div class="card card-outline card-success">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between" style="gap: 12px;">
        <span class="d-flex align-items-center" style="gap: 8px;">
            <span class="material-icons text-success" style="font-size:20px;">collections</span>
            <span class="font-weight-bold card-title-label">Edit Album Galeri</span>
        </span>
        <a href="{{ route('admin.galeri.index') }}" class="btn btn-sm btn-outline-secondary ml-auto">
            <span class="material-icons" style="font-size:16px;">arrow_back</span> Kembali
        </a>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Judul Album / Kegiatan <span class="text-danger">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $galeri->title) }}"
                    class="form-control @error('title') is-invalid @enderror"
                    placeholder="Masukkan judul album atau nama kegiatan..." required>
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="category">Kategori <span class="text-danger">*</span></label>
                <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" style="max-width: 300px;" required>
                    @foreach($kategoris as $kat)
                    <option value="{{ $kat->nama }}" {{ old('category', $galeri->category) == $kat->nama ? 'selected' : '' }}>{{ $kat->nama }}</option>
                    @endforeach
                </select>
                @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>Foto Saat Ini</label>
                <div id="existingPhotos" class="d-flex flex-wrap" style="gap: 10px;">
                    @foreach($galeri->photos->sortBy('order') as $photo)
                        <div class="existing-photo-card" data-photo-id="{{ $photo->id }}" style="position:relative;width:120px;height:90px;border-radius:3px;overflow:hidden;border:1px solid #E5E7EB;">
                            @if(file_exists(public_path('uploads/galeri/' . $photo->image)))
                                <img src="{{ asset('uploads/galeri/' . $photo->image) }}" style="width:100%;height:100%;object-fit:cover;">
                            @else
                                <img src="{{ asset('images/' . $photo->image) }}" style="width:100%;height:100%;object-fit:cover;">
                            @endif
                            <button type="button" class="remove-existing-btn" data-photo-id="{{ $photo->id }}"
                                style="position:absolute;top:2px;right:2px;background:rgba(220,53,69,0.9);color:#fff;border:none;width:20px;height:20px;border-radius:50%;cursor:pointer;font-size:12px;display:flex;align-items:center;justify-content:center;">&times;</button>
                        </div>
                    @endforeach
                </div>
                <input type="hidden" name="remove_photos" id="remove_photos" value="">
            </div>

            <div class="form-group">
                <label>Tambah Foto Baru <span class="text-muted" style="font-weight:400;">(opsional)</span></label>
                <input type="file" name="images[]" id="images" accept="image/*" multiple
                    class="form-control @error('images') is-invalid @enderror" style="max-width: 500px;">
                <small class="form-text text-muted">Bisa pilih banyak sekaligus. Format: JPEG, PNG, WebP. Maksimal: 2MB per foto.</small>
                @error('images') <div class="invalid-feedback">{{ $message }}</div> @enderror
                @error('images.*') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group" id="newPreviewSection" style="display:none;">
                <label>Foto Baru (Preview)</label>
                <div id="newPreview" class="d-flex flex-wrap" style="gap: 10px;"></div>
            </div>

            <div class="form-group">
                <label>Pilih Thumbnail</label>
                <div id="thumbnailPreview" class="d-flex flex-wrap" style="gap: 10px;"></div>
                <input type="hidden" name="thumbnail_index" id="thumbnail_index" value="0">
                <small class="form-text text-muted">Klik pada foto untuk memilih sebagai thumbnail.</small>
            </div>

            <div class="d-flex align-items-center justify-content-end" style="gap:10px; border-top: 1px solid #F3F4F6; padding-top: 20px; margin-top: 24px;">
                <a href="{{ route('admin.galeri.index') }}" class="btn btn-outline-secondary">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">close</span> Batal
                </a>
                <button type="submit" class="btn btn-success">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">save</span> Perbarui Album
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var thumbIndex = document.getElementById('thumbnail_index');
    var removeInput = document.getElementById('remove_photos');

    // Render initial thumbnail preview
    rebuildThumbPreview();

    // Remove existing photo buttons
    document.querySelectorAll('.remove-existing-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var card = this.closest('.existing-photo-card');
            card.style.display = 'none';
            var ids = removeInput.value ? removeInput.value.split(',') : [];
            ids.push(this.dataset.photoId);
            removeInput.value = ids.join(',');
            rebuildThumbPreview();
        });
    });

    // New file preview
    var input = document.getElementById('images');
    var newSection = document.getElementById('newPreviewSection');
    var newPreview = document.getElementById('newPreview');

    input.addEventListener('change', function() {
        newPreview.innerHTML = '';
        if (this.files.length > 0) {
            newSection.style.display = 'block';
            Array.from(this.files).forEach(function(file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var card = document.createElement('div');
                    card.style.cssText = 'width:120px;height:90px;border-radius:3px;overflow:hidden;border:1px solid #E5E7EB';
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.cssText = 'width:100%;height:100%;object-fit:cover';
                    card.appendChild(img);
                    newPreview.appendChild(card);
                };
                reader.readAsDataURL(file);
            });
            rebuildThumbPreview();
        } else {
            newSection.style.display = 'none';
            rebuildThumbPreview();
        }
    });

    function rebuildThumbPreview() {
        var thumbContainer = document.getElementById('thumbnailPreview');
        thumbContainer.innerHTML = '';
        var visibleCards = document.querySelectorAll('.existing-photo-card:not([style*="display: none"])');
        var idx = 0;
        visibleCards.forEach(function(card) {
            var img = card.querySelector('img');
            if (!img) return;
            var wrapper = document.createElement('div');
            wrapper.style.cssText = 'position:relative;width:120px;height:90px;cursor:pointer;border-radius:3px;overflow:hidden;border:2px solid ' + (idx === 0 ? '#009966' : '#D1D5DB');
            wrapper.dataset.index = idx;
            wrapper.onclick = function() {
                document.querySelectorAll('#thumbnailPreview > div').forEach(function(d) { d.style.borderColor = '#D1D5DB'; });
                wrapper.style.borderColor = '#009966';
                thumbIndex.value = idx;
            };
            var thumbImg = document.createElement('img');
            thumbImg.src = img.src;
            thumbImg.style.cssText = 'width:100%;height:100%;object-fit:cover';
            var badge = document.createElement('span');
            badge.textContent = '★';
            badge.style.cssText = 'position:absolute;top:2px;right:2px;background:#009966;color:#fff;font-size:10px;padding:1px 5px;border-radius:2px;display:' + (idx === 0 ? 'block' : 'none');
            badge.className = 'thumb-badge';
            wrapper.appendChild(thumbImg);
            wrapper.appendChild(badge);
            thumbContainer.appendChild(wrapper);
            idx++;
        });
    }
});
</script>
@endsection
