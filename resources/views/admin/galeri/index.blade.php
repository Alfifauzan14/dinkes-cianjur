@extends('admin.layouts.admin')
@section('title', 'Kelola Galeri')
@section('header_title', 'Kelola Galeri Kegiatan')

@section('content')
<div class="card card-outline card-success">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between" style="gap: 12px; padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
        <span class="d-flex align-items-center" style="gap: 8px;">
            <span class="material-icons text-success">photo_library</span>
            <span class="font-weight-bold card-title-label">Kelola Galeri</span>
        </span>

        <form action="{{ route('admin.galeri.index') }}" method="GET" class="d-flex align-items-center" style="gap: 8px; flex-wrap: wrap;">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Cari judul galeri..." style="width: 220px;">
            <select name="category" class="custom-select custom-select-sm" onchange="this.form.submit()" style="width: 150px;">
                <option value="">Semua Kategori</option>
                @foreach($kategoris as $kat)
                <option value="{{ $kat->nama }}" {{ request('category') == $kat->nama ? 'selected' : '' }}>{{ $kat->nama }}</option>
                @endforeach
            </select>
            <a href="{{ route('admin.kategori.index', ['type' => 'galeri']) }}" class="btn btn-sm btn-outline-success">
                <span class="material-icons" style="font-size:14px;vertical-align:middle;">tune</span> Kelola Kategori
            </a>
            @if(request('search') || request('category'))
                <a href="{{ route('admin.galeri.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
            @endif
        </form>

        <button type="button" class="btn btn-sm btn-success ml-auto" data-toggle="modal" data-target="#modalTambahGaleri" style="white-space:nowrap;">
            <span class="material-icons" style="font-size:16px;">add_photo_alternate</span> Tambah Album
        </button>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width:90px;">Thumbnail</th>
                        <th>Judul Album</th>
                        <th style="width:100px;">Foto</th>
                        <th style="width:130px;">Kategori</th>
                        <th style="width:170px;">Tanggal</th>
                        <th class="text-center" style="width:100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($galeris as $galeri)
                    <tr>
                        <td>
                            @if($galeri->thumbnail)
                                @if(file_exists(public_path('uploads/galeri/' . $galeri->thumbnail->image)))
                                    <img src="{{ asset('uploads/galeri/' . $galeri->thumbnail->image) }}" alt="{{ $galeri->title }}"
                                        style="width:70px;height:55px;object-fit:cover;border-radius:3px;border:1px solid #E5E7EB;">
                                @else
                                    <img src="{{ asset('images/' . $galeri->thumbnail->image) }}" alt="{{ $galeri->title }}"
                                        style="width:70px;height:55px;object-fit:cover;border-radius:3px;border:1px solid #E5E7EB;">
                                @endif
                            @elseif($galeri->image && file_exists(public_path('uploads/galeri/' . $galeri->image)))
                                <img src="{{ asset('uploads/galeri/' . $galeri->image) }}" alt="{{ $galeri->title }}"
                                    style="width:70px;height:55px;object-fit:cover;border-radius:3px;border:1px solid #E5E7EB;">
                            @else
                                <div style="width:70px;height:55px;background:#F3F4F6;border-radius:3px;border:1px solid #E5E7EB;display:flex;align-items:center;justify-content:center;">
                                    <span class="material-icons text-muted" style="font-size:24px;">image</span>
                                </div>
                            @endif
                        </td>
                        <td class="font-weight-bold text-dark align-middle">{{ $galeri->title }}</td>
                        <td class="align-middle">
                            <span class="badge badge-info" style="padding:4px 10px;border-radius:3px;font-size:11px;font-weight:700;">
                                {{ $galeri->photos_count }} foto
                            </span>
                        </td>
                        <td class="align-middle">
                            @php
                                $katData = $kategoris->firstWhere('nama', $galeri->category);
                                $bgColor = $katData ? $katData->warna . '20' : '#E0F2FE';
                                $textColor = $katData ? $katData->warna : '#0369A1';
                            @endphp
                            <span class="badge" style="background:{{ $bgColor }};color:{{ $textColor }};padding:4px 10px;border-radius:3px;font-size:11px;font-weight:700;">
                                {{ $galeri->category }}
                            </span>
                        </td>
                        <td class="text-secondary align-middle">{{ $galeri->created_at->format('d M Y H:i') }}</td>
                        <td class="text-center align-middle">
                            <div class="btn-action-group">
                                <button type="button"
                                    class="btn-action btn-action-edit btn-edit-galeri"
                                    title="Edit"
                                    data-id="{{ $galeri->id }}"
                                    data-title="{{ $galeri->title }}"
                                    data-category="{{ $galeri->category }}"
                                    data-toggle="modal" data-target="#modalEditGaleri">
                                    <span class="material-icons" style="font-size:16px;">edit</span>
                                </button>
                                <form action="{{ route('admin.galeri.destroy', $galeri->id) }}" method="POST" id="del-galeri-{{ $galeri->id }}" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn-action btn-action-delete" title="Hapus"
                                        onclick="confirmDelete('del-galeri-{{ $galeri->id }}')">
                                        <span class="material-icons" style="font-size:16px;">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <span class="material-icons" style="font-size:48px;display:block;margin-bottom:8px;color:#D1D5DB;">collections</span>
                            Belum ada album galeri yang diunggah.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer">{{ $galeris->links() }}</div>
</div>

{{-- ======================================== --}}
{{-- MODAL: TAMBAH ALBUM GALERI              --}}
{{-- ======================================== --}}
<div class="modal fade" id="modalTambahGaleri" tabindex="-1" role="dialog" aria-labelledby="modalTambahGaleriLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data" id="form-tambah-galeri">
                @csrf
                <div class="modal-header" style="background:#009966;color:#fff;border-radius:0;">
                    <h5 class="modal-title" id="modalTambahGaleriLabel">
                        <span class="material-icons" style="vertical-align:middle;margin-right:6px;">add_photo_alternate</span>
                        Tambah Album Galeri
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tambah_g_title">Judul Album / Kegiatan <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="tambah_g_title" class="form-control" placeholder="Masukkan judul album atau nama kegiatan..." required>
                    </div>
                    <div class="form-group">
                        <label for="tambah_g_category">Kategori <span class="text-danger">*</span></label>
                        <select name="category" id="tambah_g_category" class="form-control" required>
                            @foreach($kategoris as $kat)
                            <option value="{{ $kat->nama }}">{{ $kat->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tambah_g_images">Pilih Foto <span class="text-danger">*</span></label>
                        <input type="file" name="images[]" id="tambah_g_images" class="form-control" accept="image/*" multiple required>
                        <small class="text-muted">Bisa pilih banyak sekaligus (Ctrl+Click). Format: JPEG, PNG, WebP. Maks: 2MB per foto.</small>
                    </div>
                    <div class="form-group mb-0" id="tambah ThumbnailSection" style="display:none;">
                        <label>Pilih Thumbnail <span class="text-danger">*</span></label>
                        <div id="tambah_thumbnailPreview" class="d-flex flex-wrap gap-2"></div>
                        <input type="hidden" name="thumbnail_index" id="tambah_thumbnail_index" value="0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">
                        <span class="material-icons" style="font-size:16px;vertical-align:middle;">save</span> Simpan Album
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ======================================== --}}
{{-- MODAL: EDIT ALBUM GALERI                --}}
{{-- ======================================== --}}
<div class="modal fade" id="modalEditGaleri" tabindex="-1" role="dialog" aria-labelledby="modalEditGaleriLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="" method="POST" id="form-edit-galeri" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="modal-header" style="background:#007A52;color:#fff;border-radius:0;">
                    <h5 class="modal-title" id="modalEditGaleriLabel">
                        <span class="material-icons" style="vertical-align:middle;margin-right:6px;">edit</span>
                        Edit Album Galeri
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_g_title">Judul Album / Kegiatan <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="edit_g_title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_g_category">Kategori <span class="text-danger">*</span></label>
                        <select name="category" id="edit_g_category" class="form-control" required>
                            @foreach($kategoris as $kat)
                            <option value="{{ $kat->nama }}">{{ $kat->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Foto Saat Ini</label>
                        <div id="edit_existingPhotos" class="d-flex flex-wrap gap-2"></div>
                    </div>
                    <div class="form-group">
                        <label>Tambah Foto Baru <span class="text-muted" style="font-weight:400;">(opsional)</span></label>
                        <input type="file" name="images[]" id="edit_g_images" class="form-control" accept="image/*" multiple>
                        <small class="text-muted">Bisa pilih banyak sekaligus. Format: JPEG, PNG, WebP. Maks: 2MB per foto.</small>
                    </div>
                    <div class="form-group" id="edit_newPreviewSection" style="display:none;">
                        <label>Foto Baru (Preview)</label>
                        <div id="edit_newPreview" class="d-flex flex-wrap gap-2"></div>
                    </div>
                    <div class="form-group mb-0">
                        <label>Pilih Thumbnail</label>
                        <div id="edit_thumbnailPreview" class="d-flex flex-wrap gap-2"></div>
                        <input type="hidden" name="thumbnail_index" id="edit_thumbnail_index" value="0">
                        <input type="hidden" name="remove_photos" id="edit_remove_photos" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success-dark">
                        <span class="material-icons" style="font-size:16px;vertical-align:middle;">save</span> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // === TAMBAH: Thumbnail preview on file select ===
    const tambahInput = document.getElementById('tambah_g_images');
    const tambahThumbSection = document.getElementById('tambah ThumbnailSection');
    const tambahThumbPreview = document.getElementById('tambah_thumbnailPreview');
    const tambahThumbIndex = document.getElementById('tambah_thumbnail_index');

    tambahInput.addEventListener('change', function() {
        tambahThumbPreview.innerHTML = '';
        if (this.files.length > 0) {
            tambahThumbSection.style.display = 'block';
            tambahThumbIndex.value = 0;
            Array.from(this.files).forEach(function(file, i) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const wrapper = document.createElement('div');
                    wrapper.style.cssText = 'position:relative;width:100px;height:80px;cursor:pointer;border-radius:3px;overflow:hidden;border:2px solid ' + (i === 0 ? '#009966' : '#D1D5DB');
                    wrapper.dataset.index = i;
                    wrapper.onclick = function() {
                        document.querySelectorAll('#tambah_thumbnailPreview div').forEach(function(d) { d.style.borderColor = '#D1D5DB'; });
                        wrapper.style.borderColor = '#009966';
                        tambahThumbIndex.value = i;
                    };
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.cssText = 'width:100%;height:100%;object-fit:cover';
                    const badge = document.createElement('span');
                    badge.textContent = '★';
                    badge.style.cssText = 'position:absolute;top:2px;right:2px;background:#009966;color:#fff;font-size:10px;padding:1px 5px;border-radius:2px;display:' + (i === 0 ? 'block' : 'none');
                    badge.className = 'thumb-badge';
                    wrapper.appendChild(img);
                    wrapper.appendChild(badge);
                    tambahThumbPreview.appendChild(wrapper);
                };
                reader.readAsDataURL(file);
            });
        } else {
            tambahThumbSection.style.display = 'none';
        }
    });

    // === EDIT: Load existing photos ===
    document.querySelectorAll('.btn-edit-galeri').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var id = this.dataset.id;
            document.getElementById('edit_g_title').value = this.dataset.title;
            document.getElementById('edit_g_category').value = this.dataset.category;
            document.getElementById('form-edit-galeri').action = '{{ url("admin/galeri") }}/' + id;
            document.getElementById('edit_remove_photos').value = '';

            // Fetch photos via AJAX
            fetch('{{ url("admin/galeri") }}/' + id + '/photos')
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    renderEditPhotos(data.photos, data.thumbnail_id);
                });
        });
    });

    function renderEditPhotos(photos, thumbnailId) {
        var existingContainer = document.getElementById('edit_existingPhotos');
        var thumbContainer = document.getElementById('edit_thumbnailPreview');
        existingContainer.innerHTML = '';
        thumbContainer.innerHTML = '';

        photos.forEach(function(photo, i) {
            var imgSrc = photo.image_url;

            // Existing photo card
            var card = document.createElement('div');
            card.style.cssText = 'position:relative;width:100px;height:80px;border-radius:3px;overflow:hidden;border:1px solid #E5E7EB';
            card.id = 'existing-photo-' + photo.id;
            var img = document.createElement('img');
            img.src = imgSrc;
            img.style.cssText = 'width:100%;height:100%;object-fit:cover';
            var removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.innerHTML = '&times;';
            removeBtn.style.cssText = 'position:absolute;top:2px;right:2px;background:rgba(220,53,69,0.9);color:#fff;border:none;width:20px;height:20px;border-radius:50%;cursor:pointer;font-size:12px;display:flex;align-items:center;justify-content:center';
            removeBtn.onclick = function() {
                card.style.display = 'none';
                var removeInput = document.getElementById('edit_remove_photos');
                var ids = removeInput.value ? removeInput.value.split(',') : [];
                ids.push(photo.id);
                removeInput.value = ids.join(',');
                rebuildThumbPreview();
            };
            card.appendChild(img);
            card.appendChild(removeBtn);
            existingContainer.appendChild(card);

            // Thumbnail option
            var thumbWrapper = document.createElement('div');
            thumbWrapper.style.cssText = 'position:relative;width:100px;height:80px;cursor:pointer;border-radius:3px;overflow:hidden;border:2px solid ' + (photo.id === thumbnailId ? '#009966' : '#D1D5DB');
            thumbWrapper.dataset.photoId = photo.id;
            thumbWrapper.dataset.index = i;
            thumbWrapper.onclick = function() {
                document.querySelectorAll('#edit_thumbnailPreview div').forEach(function(d) { d.style.borderColor = '#D1D5DB'; });
                thumbWrapper.style.borderColor = '#009966';
                document.getElementById('edit_thumbnail_index').value = i;
            };
            var thumbImg = document.createElement('img');
            thumbImg.src = imgSrc;
            thumbImg.style.cssText = 'width:100%;height:100%;object-fit:cover';
            thumbWrapper.appendChild(thumbImg);
            thumbContainer.appendChild(thumbWrapper);
        });
    }

    function rebuildThumbPreview() {
        var thumbContainer = document.getElementById('edit_thumbnailPreview');
        var visibleCards = document.querySelectorAll('#edit_existingPhotos div[id^="existing-photo-"]:not([style*="display: none"])');
        thumbContainer.innerHTML = '';
        visibleCards.forEach(function(card, i) {
            var img = card.querySelector('img');
            if (!img) return;
            var wrapper = document.createElement('div');
            wrapper.style.cssText = 'position:relative;width:100px;height:80px;cursor:pointer;border-radius:3px;overflow:hidden;border:2px solid ' + (i === 0 ? '#009966' : '#D1D5DB');
            wrapper.dataset.index = i;
            wrapper.onclick = function() {
                document.querySelectorAll('#edit_thumbnailPreview div').forEach(function(d) { d.style.borderColor = '#D1D5DB'; });
                wrapper.style.borderColor = '#009966';
                document.getElementById('edit_thumbnail_index').value = i;
            };
            var thumbImg = document.createElement('img');
            thumbImg.src = img.src;
            thumbImg.style.cssText = 'width:100%;height:100%;object-fit:cover';
            wrapper.appendChild(thumbImg);
            thumbContainer.appendChild(wrapper);
        });
    }

    // === EDIT: New file preview ===
    var editInput = document.getElementById('edit_g_images');
    var editNewSection = document.getElementById('edit_newPreviewSection');
    var editNewPreview = document.getElementById('edit_newPreview');

    editInput.addEventListener('change', function() {
        editNewPreview.innerHTML = '';
        if (this.files.length > 0) {
            editNewSection.style.display = 'block';
            Array.from(this.files).forEach(function(file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var card = document.createElement('div');
                    card.style.cssText = 'width:100px;height:80px;border-radius:3px;overflow:hidden;border:1px solid #E5E7EB';
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.cssText = 'width:100%;height:100%;object-fit:cover';
                    card.appendChild(img);
                    editNewPreview.appendChild(card);
                };
                reader.readAsDataURL(file);
            });
        } else {
            editNewSection.style.display = 'none';
        }
    });
});
</script>
@endsection
