@extends('admin.layouts.admin')
@section('title', 'Kelola Infografis')
@section('header_title', 'Kelola Infografis')

@section('content')
<div class="card card-outline card-success">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between" style="gap: 12px; padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
        <span class="d-flex align-items-center" style="gap: 8px;">
            <span class="material-icons text-success">bar_chart</span>
            <span class="font-weight-bold card-title-label">Kelola Infografis</span>
        </span>

        {{-- Search --}}
        <form action="{{ route('admin.infografis.index') }}" method="GET" class="d-flex align-items-center" style="gap: 8px; flex-wrap: wrap;">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Cari judul infografis..." style="width: 240px;">
            <button type="submit" class="btn btn-sm btn-outline-success">Cari</button>
            @if(request('search'))
                <a href="{{ route('admin.infografis.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
            @endif
        </form>

        <button type="button" class="btn btn-sm btn-success ml-auto" data-toggle="modal" data-target="#modalTambahInfografis" style="white-space:nowrap;">
            <span class="material-icons" style="font-size:16px;">add</span> Tambah Infografis
        </button>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width:90px;">Poster</th>
                        <th>Judul Infografis</th>
                        <th style="width:170px;">Tanggal Diunggah</th>
                        <th class="text-center" style="width:100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($infografis as $item)
                    <tr>
                        <td class="align-middle">
                            <img src="{{ asset('uploads/infografis/' . $item->image) }}" alt="{{ $item->title }}"
                                style="width:65px;height:85px;object-fit:contain;background:#F8FAFC;border-radius:3px;border:1px solid #E2E8F0;padding:2px;">
                        </td>
                        <td class="font-weight-bold text-dark align-middle">{{ $item->title }}</td>
                        <td class="text-secondary align-middle">{{ $item->created_at->format('d M Y H:i') }}</td>
                        <td class="text-center align-middle">
                            <div class="btn-action-group">
                                <button type="button"
                                    class="btn-action btn-action-edit btn-edit-infografis"
                                    data-id="{{ $item->id }}"
                                    data-title="{{ $item->title }}"
                                    data-image="{{ asset('uploads/infografis/' . $item->image) }}"
                                    data-toggle="modal"
                                    data-target="#modalEditInfografis"
                                    title="Edit">
                                    <span class="material-icons" style="font-size:16px;">edit</span>
                                </button>
                                <form action="{{ route('admin.infografis.destroy', $item->id) }}" method="POST" id="del-infografis-{{ $item->id }}" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn-action btn-action-delete" title="Hapus"
                                        onclick="confirmDelete('del-infografis-{{ $item->id }}')">
                                        <span class="material-icons" style="font-size:16px;">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">
                            <span class="material-icons" style="font-size:48px;display:block;margin-bottom:8px;color:#D1D5DB;">bar_chart</span>
                            Belum ada infografis yang diunggah.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer">{{ $infografis->links() }}</div>
</div>

{{-- ======================================== --}}
{{-- MODAL: TAMBAH INFOGRAFIS                 --}}
{{-- ======================================== --}}
<div class="modal fade" id="modalTambahInfografis" tabindex="-1" role="dialog" aria-labelledby="modalTambahInfografisLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.infografis.store') }}" method="POST" enctype="multipart/form-data" id="form-tambah-infografis">
                @csrf
                <div class="modal-header" style="background:#004F3B;color:#fff;border-radius:0;">
                    <h5 class="modal-title" id="modalTambahInfografisLabel">
                        <span class="material-icons" style="vertical-align:middle;margin-right:6px;">add_photo_alternate</span>
                        Tambah Infografis Baru
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tambah_title">Judul Infografis <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="tambah_title" class="form-control" placeholder="Masukkan judul infografis..." required>
                    </div>
                    <div class="form-group mb-0">
                        <label for="tambah_image">Upload Poster / Infografis <span class="text-danger">*</span></label>
                        <input type="file" name="image" id="tambah_image" class="form-control" accept="image/*" required>
                        <small class="text-muted">Format: JPEG, PNG, WebP. Maks: 5MB.</small>
                        <div id="tambah_imagePreview" style="margin-top:12px;display:none;text-align:center;background:#F8FAFC;padding:10px;border-radius:3px;border:1px solid #E2E8F0;">
                            <img id="tambah_previewImg" src="" alt="Preview Poster" style="max-height:220px;max-width:100%;object-fit:contain;border-radius:2px;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">
                        <span class="material-icons" style="font-size:16px;vertical-align:middle;">save</span> Simpan Infografis
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ======================================== --}}
{{-- MODAL: EDIT INFOGRAFIS                   --}}
{{-- ======================================== --}}
<div class="modal fade" id="modalEditInfografis" tabindex="-1" role="dialog" aria-labelledby="modalEditInfografisLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form action="" method="POST" id="form-edit-infografis" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header" style="background:#007A52;color:#fff;border-radius:0;">
                    <h5 class="modal-title" id="modalEditInfografisLabel">
                        <span class="material-icons" style="vertical-align:middle;margin-right:6px;">edit</span>
                        Edit Infografis
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_title">Judul Infografis <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="edit_title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Poster Saat Ini</label>
                        <div style="background:#F8FAFC;padding:10px;border-radius:3px;border:1px solid #E2E8F0;text-align:center;">
                            <img id="edit_currentImage" src="" alt="Poster Saat Ini" style="max-height:200px;max-width:100%;object-fit:contain;border-radius:2px;">
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <label for="edit_image">Ganti Poster <span class="text-muted" style="font-weight:400;">(opsional, kosongkan jika tidak diganti)</span></label>
                        <input type="file" name="image" id="edit_image" class="form-control" accept="image/*">
                        <small class="text-muted">Format: JPEG, PNG, WebP. Maks: 5MB.</small>
                        <div id="edit_imagePreview" style="margin-top:12px;display:none;text-align:center;background:#F8FAFC;padding:10px;border-radius:3px;border:1px solid #E2E8F0;">
                            <p class="text-muted mb-1" style="font-size:12px;font-weight:600;">Preview Poster Baru:</p>
                            <img id="edit_previewImg" src="" alt="Preview Poster Baru" style="max-height:200px;max-width:100%;object-fit:contain;border-radius:2px;">
                        </div>
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
    // === TAMBAH: Live preview upload poster ===
    const tambahImageInput = document.getElementById('tambah_image');
    const tambahPreviewDiv = document.getElementById('tambah_imagePreview');
    const tambahPreviewImg = document.getElementById('tambah_previewImg');

    if (tambahImageInput) {
        tambahImageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    tambahPreviewImg.src = e.target.result;
                    tambahPreviewDiv.style.display = 'block';
                };
                reader.readAsDataURL(this.files[0]);
            } else {
                tambahPreviewDiv.style.display = 'none';
            }
        });
    }

    // === EDIT: Populate data into edit modal ===
    const editButtons = document.querySelectorAll('.btn-edit-infografis');
    const editForm = document.getElementById('form-edit-infografis');
    const editTitle = document.getElementById('edit_title');
    const editCurrentImage = document.getElementById('edit_currentImage');
    const editImageInput = document.getElementById('edit_image');
    const editPreviewDiv = document.getElementById('edit_imagePreview');
    const editPreviewImg = document.getElementById('edit_previewImg');

    editButtons.forEach(function(btn) {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const title = this.dataset.title;
            const image = this.dataset.image;

            editForm.action = '{{ url("admin/infografis") }}/' + id;
            editTitle.value = title;
            editCurrentImage.src = image;

            // Reset upload ganti poster preview
            if (editImageInput) editImageInput.value = '';
            if (editPreviewDiv) editPreviewDiv.style.display = 'none';
        });
    });

    if (editImageInput) {
        editImageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    editPreviewImg.src = e.target.result;
                    editPreviewDiv.style.display = 'block';
                };
                reader.readAsDataURL(this.files[0]);
            } else {
                editPreviewDiv.style.display = 'none';
            }
        });
    }
});
</script>
@endsection
