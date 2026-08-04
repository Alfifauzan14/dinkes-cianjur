@extends('admin.layouts.admin')
@section('title', 'Kelola Galeri')
@section('header_title', 'Kelola Galeri Kegiatan')

@section('content')
<div class="card card-outline card-success">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between" style="gap: 16px; padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
        {{-- Search & Filter --}}
        <form action="{{ route('admin.galeri.index') }}" method="GET" class="d-flex flex-wrap align-items-center" style="gap: 8px;">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Cari judul galeri..." style="width: 220px;">
            <select name="category" class="custom-select custom-select-sm" onchange="this.form.submit()" style="width: 150px;">
                <option value="">Semua Kategori</option>
                <option value="PROGRAM"  {{ request('category') == 'PROGRAM'  ? 'selected' : '' }}>PROGRAM</option>
                <option value="KEGIATAN" {{ request('category') == 'KEGIATAN' ? 'selected' : '' }}>KEGIATAN</option>
                <option value="NASIONAL" {{ request('category') == 'NASIONAL' ? 'selected' : '' }}>NASIONAL</option>
            </select>
            @if(request('search') || request('category'))
                <a href="{{ route('admin.galeri.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
            @endif
        </form>

        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalTambahGaleri">
            <span class="material-icons" style="font-size:16px;">add_photo_alternate</span> Tambah Foto
        </button>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width:90px;">Foto</th>
                        <th>Judul Galeri</th>
                        <th style="width:130px;">Kategori</th>
                        <th style="width:170px;">Tanggal</th>
                        <th class="text-center" style="width:100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($galeris as $galeri)
                    <tr>
                        <td>
                            @if(file_exists(public_path('uploads/galeri/' . $galeri->image)))
                                <img src="{{ asset('uploads/galeri/' . $galeri->image) }}" alt="{{ $galeri->title }}"
                                    style="width:70px;height:55px;object-fit:cover;border-radius:3px;border:1px solid #E5E7EB;">
                            @else
                                <img src="{{ asset('images/' . $galeri->image) }}" alt="{{ $galeri->title }}"
                                    style="width:70px;height:55px;object-fit:cover;border-radius:3px;border:1px solid #E5E7EB;">
                            @endif
                        </td>
                        <td class="font-weight-bold text-dark align-middle">{{ $galeri->title }}</td>
                        <td class="align-middle">
                            <span class="badge" style="background:#E0F2FE;color:#0369A1;padding:4px 10px;border-radius:3px;font-size:11px;font-weight:700;">
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
                        <td colspan="5" class="text-center py-5 text-muted">
                            <span class="material-icons" style="font-size:48px;display:block;margin-bottom:8px;color:#D1D5DB;">collections</span>
                            Belum ada foto galeri yang diunggah.
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
{{-- MODAL: TAMBAH GALERI                     --}}
{{-- ======================================== --}}
<div class="modal fade" id="modalTambahGaleri" tabindex="-1" role="dialog" aria-labelledby="modalTambahGaleriLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header" style="background:#009966;color:#fff;border-radius:0;">
                    <h5 class="modal-title" id="modalTambahGaleriLabel">
                        <span class="material-icons" style="vertical-align:middle;margin-right:6px;">add_photo_alternate</span>
                        Tambah Foto Galeri
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tambah_g_title">Judul Foto / Kegiatan <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="tambah_g_title" class="form-control" placeholder="Masukkan judul foto atau nama kegiatan..." required>
                    </div>
                    <div class="form-group">
                        <label for="tambah_g_category">Kategori <span class="text-danger">*</span></label>
                        <select name="category" id="tambah_g_category" class="form-control" required>
                            <option value="PROGRAM">PROGRAM</option>
                            <option value="KEGIATAN">KEGIATAN</option>
                            <option value="NASIONAL">NASIONAL</option>
                        </select>
                    </div>
                    <div class="form-group mb-0">
                        <label for="tambah_g_image">Pilih Gambar / Foto <span class="text-danger">*</span></label>
                        <input type="file" name="image" id="tambah_g_image" class="form-control" accept="image/*" required>
                        <small class="text-muted">Format: JPEG, PNG, WebP. Maks: 2MB.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">
                        <span class="material-icons" style="font-size:16px;vertical-align:middle;">save</span> Simpan Foto
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ======================================== --}}
{{-- MODAL: EDIT GALERI (judul + kategori)   --}}
{{-- ======================================== --}}
<div class="modal fade" id="modalEditGaleri" tabindex="-1" role="dialog" aria-labelledby="modalEditGaleriLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="POST" id="form-edit-galeri" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="modal-header" style="background:#D97706;color:#fff;border-radius:0;">
                    <h5 class="modal-title" id="modalEditGaleriLabel">
                        <span class="material-icons" style="vertical-align:middle;margin-right:6px;">edit</span>
                        Edit Galeri
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_g_title">Judul Foto / Kegiatan <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="edit_g_title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_g_category">Kategori <span class="text-danger">*</span></label>
                        <select name="category" id="edit_g_category" class="form-control" required>
                            <option value="PROGRAM">PROGRAM</option>
                            <option value="KEGIATAN">KEGIATAN</option>
                            <option value="NASIONAL">NASIONAL</option>
                        </select>
                    </div>
                    <div class="form-group mb-0">
                        <label for="edit_g_image">Ganti Gambar <span class="text-muted" style="font-weight:400;">(opsional, kosongkan jika tidak diganti)</span></label>
                        <input type="file" name="image" id="edit_g_image" class="form-control" accept="image/*">
                        <small class="text-muted">Format: JPEG, PNG, WebP. Maks: 2MB.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning text-white">
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
document.querySelectorAll('.btn-edit-galeri').forEach(function(btn) {
    btn.addEventListener('click', function() {
        var id = this.dataset.id;
        document.getElementById('edit_g_title').value    = this.dataset.title;
        document.getElementById('edit_g_category').value = this.dataset.category;
        document.getElementById('form-edit-galeri').action = '{{ url("admin/galeri") }}/' + id;
    });
});
</script>
@endsection
