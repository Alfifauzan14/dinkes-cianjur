@extends('admin.layouts.admin')
@section('title', 'Kelola Regulasi')
@section('header_title', 'Kelola Regulasi & Hukum')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-3" style="gap:8px; border-radius: 3px;">
        <span class="material-icons">check_circle</span>
        <span>{{ session('success') }}</span>
        <button type="button" class="close ml-auto" data-dismiss="alert"><span>&times;</span></button>
    </div>
@endif

<div class="card card-outline card-success">
    <div class="card-header d-flex flex-wrap align-items-center" style="gap: 12px; padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
        <span class="d-flex align-items-center" style="gap: 8px;">
            <span class="material-icons text-success" style="font-size:20px;">gavel</span>
            <span class="font-weight-bold card-title-label">Kelola Regulasi &amp; Produk Hukum</span>
        </span>

        <form action="{{ route('admin.regulasi.index') }}" method="GET" class="d-flex flex-wrap align-items-center" style="gap: 8px;">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Cari regulasi, topik..." style="width: 220px;">
            <select name="category" class="custom-select custom-select-sm" onchange="this.form.submit()" style="width: 180px;">
                <option value="">Semua Kategori</option>
                @foreach($kategoris as $kat)
                    <option value="{{ $kat->nama }}" {{ request('category') == $kat->nama ? 'selected' : '' }}>{{ $kat->nama }}</option>
                @endforeach
            </select>
            @if(request('search') || request('category'))
                <a href="{{ route('admin.regulasi.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
            @endif
        </form>

        <div class="d-flex ml-auto" style="gap: 8px;">
            <button type="button" class="btn btn-sm btn-success d-flex align-items-center" style="gap: 4px;" data-toggle="modal" data-target="#modalTambahRegulasi">
                <span class="material-icons" style="font-size:16px;">add</span> Tambah Regulasi
            </button>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width:80px; padding-left: 20px;">Cover</th>
                        <th>Nomor / Judul Regulasi</th>
                        <th style="width:160px;">Kategori</th>
                        <th style="width:140px;">Topik</th>
                        <th class="text-center" style="width:80px;">Tahun</th>
                        <th class="text-center" style="width:110px;">Status</th>
                        <th class="text-center" style="width:100px; padding-right: 20px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($regulasis as $regulasi)
                    <tr>
                        <td class="align-middle" style="padding-left: 20px;">
                            @if($regulasi->cover_path)
                                <img src="{{ asset('storage/' . $regulasi->cover_path) }}" alt=""
                                    style="width:48px; height:64px; object-fit:cover; border-radius:2px; border:1px solid #CBD5E1;">
                            @else
                                <div style="width:48px; height:64px; background:#F8FAFC; display:flex; align-items:center; justify-content:center; border-radius:2px; border:1px solid #CBD5E1;">
                                    <span class="material-icons text-muted" style="font-size:20px;">description</span>
                                </div>
                            @endif
                        </td>
                        <td class="align-middle">
                            <div class="font-weight-bold text-dark">{{ $regulasi->title }}</div>
                            <small class="text-muted d-block mt-1">{{ Str::limit($regulasi->description, 80) }}</small>
                            <small class="d-inline-flex align-items-center mt-1" style="gap: 4px;">
                                <span class="material-icons text-success" style="font-size:14px;">picture_as_pdf</span>
                                <a href="{{ asset('storage/' . $regulasi->file_path) }}" target="_blank" class="text-success font-weight-bold" style="text-decoration:none;">
                                    Lihat PDF ({{ $regulasi->file_size }})
                                </a>
                            </small>
                        </td>
                        <td class="align-middle">
                            <span class="badge" style="background:#F1F5F9;color:#334155;padding:4px 10px;border-radius:3px;font-size:11px;font-weight:700;">
                                {{ $regulasi->category }}
                            </span>
                        </td>
                        <td class="align-middle">
                            <span class="badge" style="background:#E6F7F0;color:#009966;padding:4px 10px;border-radius:3px;font-size:11px;font-weight:700;">
                                {{ $regulasi->topic }}
                            </span>
                        </td>
                        <td class="text-center font-weight-bold text-secondary align-middle">{{ $regulasi->year }}</td>
                        <td class="text-center align-middle">
                            @if($regulasi->status === 'Berlaku')
                                <span class="badge" style="background:#DEF7EC;color:#03543F;padding:4px 10px;border-radius:3px;font-size:11px;font-weight:700;">
                                    Berlaku
                                </span>
                            @else
                                <span class="badge" style="background:#FDE8E8;color:#9B1C1C;padding:4px 10px;border-radius:3px;font-size:11px;font-weight:700;">
                                    Tidak Berlaku
                                </span>
                            @endif
                        </td>
                        <td class="text-center align-middle" style="padding-right: 20px;">
                            <div class="btn-action-group">
                                <button type="button"
                                    class="btn-action btn-action-edit btn-edit-regulasi"
                                    title="Edit"
                                    data-id="{{ $regulasi->id }}"
                                    data-title="{{ $regulasi->title }}"
                                    data-description="{{ $regulasi->description ?? '' }}"
                                    data-category="{{ $regulasi->category }}"
                                    data-topic="{{ $regulasi->topic }}"
                                    data-year="{{ $regulasi->year }}"
                                    data-status="{{ $regulasi->status }}"
                                    data-file_size="{{ $regulasi->file_size }}"
                                    data-file_url="{{ asset('storage/' . $regulasi->file_path) }}"
                                    data-cover_url="{{ $regulasi->cover_path ? asset('storage/' . $regulasi->cover_path) : '' }}"
                                    data-toggle="modal" data-target="#modalEditRegulasi">
                                    <span class="material-icons" style="font-size:16px;">edit</span>
                                </button>
                                <form action="{{ route('admin.regulasi.destroy', $regulasi->id) }}" method="POST" id="del-regulasi-{{ $regulasi->id }}" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn-action btn-action-delete" title="Hapus"
                                        onclick="confirmDelete('del-regulasi-{{ $regulasi->id }}')">
                                        <span class="material-icons" style="font-size:16px;">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <span class="material-icons" style="font-size:48px;display:block;margin-bottom:8px;color:#CBD5E1;">gavel</span>
                            <p class="font-weight-bold mb-1">Belum ada data regulasi.</p>
                            @if(request('search') || request('category'))
                                <small class="text-muted">Tidak ada hasil pencarian yang sesuai.</small>
                            @else
                                <small class="text-muted">Klik <strong>"Tambah Regulasi"</strong> untuk menambahkan produk hukum baru.</small>
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($regulasis->hasPages())
        <div class="card-footer bg-white p-3 border-top">
            {{ $regulasis->links() }}
        </div>
    @endif
</div>

{{-- MODAL: TAMBAH REGULASI --}}
<div class="modal fade" id="modalTambahRegulasi" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 3px; border: 1px solid #CBD5E1;">
            <form action="{{ route('admin.regulasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header" style="background:#F8FAFC; border-bottom: 1px solid #E2E8F0; padding: 14px 20px;">
                    <h5 class="modal-title font-weight-bold d-flex align-items-center" style="font-size:15px; color:#1E293B; gap:8px;">
                        <span class="material-icons text-success" style="font-size:20px;">post_add</span>
                        Tambah Regulasi Baru
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body p-4">
                    <div class="form-group">
                        <label for="tambah_r_title" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">
                            Judul / Nomor Regulasi <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="title" id="tambah_r_title" class="form-control" placeholder="Contoh: Peraturan Bupati No. 42 Tahun 2024 Tentang ..." required>
                    </div>
                    <div class="form-group">
                        <label for="tambah_r_description" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">
                            Deskripsi Singkat <span class="text-danger">*</span>
                        </label>
                        <textarea name="description" id="tambah_r_description" class="form-control" rows="2" placeholder="Ringkasan isi regulasi..." required>{{ old('description') }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="tambah_r_category" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">
                                    Kategori <span class="text-danger">*</span>
                                </label>
                                <select name="category" id="tambah_r_category" class="form-control custom-select" required>
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    @foreach($kategoris as $kat)
                                        <option value="{{ $kat->nama }}">{{ $kat->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="tambah_r_topic" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">
                                    Topik <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="topic" id="tambah_r_topic" class="form-control" placeholder="Contoh: Stunting, KIA, SOP" required>
                            </div>
                        </div>
                        <div class="col-md-2 col-6">
                            <div class="form-group">
                                <label for="tambah_r_year" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">
                                    Tahun <span class="text-danger">*</span>
                                </label>
                                <input type="number" name="year" id="tambah_r_year" class="form-control" value="{{ date('Y') }}" min="2000" max="{{ date('Y') + 5 }}" required>
                            </div>
                        </div>
                        <div class="col-md-2 col-6">
                            <div class="form-group">
                                <label for="tambah_r_status" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">
                                    Status <span class="text-danger">*</span>
                                </label>
                                <select name="status" id="tambah_r_status" class="form-control custom-select" required>
                                    <option value="Berlaku">Berlaku</option>
                                    <option value="Tidak Berlaku">Tidak Berlaku</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 col-12">
                            <div class="form-group mb-0">
                                <label for="tambah_r_file" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">
                                    File Dokumen PDF <span class="text-danger">*</span>
                                </label>
                                <input type="file" name="file_document" id="tambah_r_file" class="form-control-file" accept=".pdf" required>
                                <small class="text-muted d-block mt-1">Format: PDF | Maks: 10 MB. Ukuran file akan otomatis dihitung.</small>
                            </div>
                        </div>
                        <div class="col-md-5 col-12">
                            <div class="form-group mb-0">
                                <label for="tambah_r_cover" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">
                                    Cover / Thumbnail
                                </label>
                                <input type="file" name="file_cover" id="tambah_r_cover" class="form-control-file" accept="image/*">
                                <small class="text-muted d-block mt-1">Format: JPG, PNG, WebP | Maks: 2 MB.</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="background:#F8FAFC; border-top: 1px solid #E2E8F0; padding: 12px 20px;">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success font-weight-bold">
                        <span class="material-icons" style="font-size:16px; vertical-align:middle;">save</span> Simpan Regulasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL: EDIT REGULASI --}}
<div class="modal fade" id="modalEditRegulasi" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 3px; border: 1px solid #CBD5E1;">
            <form action="" method="POST" id="form-edit-regulasi" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="modal-header" style="background:#F8FAFC; border-bottom: 1px solid #E2E8F0; padding: 14px 20px;">
                    <h5 class="modal-title font-weight-bold d-flex align-items-center" style="font-size:15px; color:#1E293B; gap:8px;">
                        <span class="material-icons text-success" style="font-size:20px;">edit_document</span>
                        Edit Regulasi
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body p-4">
                    <div class="form-group">
                        <label for="edit_r_title" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">
                            Judul / Nomor Regulasi <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="title" id="edit_r_title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_r_description" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">
                            Deskripsi Singkat <span class="text-danger">*</span>
                        </label>
                        <textarea name="description" id="edit_r_description" class="form-control" rows="2" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="edit_r_category" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">
                                    Kategori <span class="text-danger">*</span>
                                </label>
                                <select name="category" id="edit_r_category" class="form-control custom-select" required>
                                    @foreach($kategoris as $kat)
                                        <option value="{{ $kat->nama }}">{{ $kat->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="edit_r_topic" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">
                                    Topik <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="topic" id="edit_r_topic" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-2 col-6">
                            <div class="form-group">
                                <label for="edit_r_year" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">
                                    Tahun <span class="text-danger">*</span>
                                </label>
                                <input type="number" name="year" id="edit_r_year" class="form-control" min="2000" max="{{ date('Y') + 5 }}" required>
                            </div>
                        </div>
                        <div class="col-md-2 col-6">
                            <div class="form-group">
                                <label for="edit_r_status" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">
                                    Status <span class="text-danger">*</span>
                                </label>
                                <select name="status" id="edit_r_status" class="form-control custom-select" required>
                                    <option value="Berlaku">Berlaku</option>
                                    <option value="Tidak Berlaku">Tidak Berlaku</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 col-12">
                            <div class="form-group mb-0">
                                <label for="edit_r_file" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">
                                    Dokumen PDF
                                </label>
                                <input type="file" name="file_document" id="edit_r_file" class="form-control-file" accept=".pdf">
                                <div id="edit_r_file_current" class="mt-2 text-secondary" style="font-size: 13px;"></div>
                                <small class="text-muted d-block mt-1">Biarkan kosong jika tidak ingin mengganti file PDF.</small>
                            </div>
                        </div>
                        <div class="col-md-5 col-12">
                            <div class="form-group mb-0">
                                <label for="edit_r_cover" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">
                                    Cover / Thumbnail
                                </label>
                                <input type="file" name="file_cover" id="edit_r_cover" class="form-control-file" accept="image/*">
                                <div id="edit_r_cover_current" class="mt-2"></div>
                                <small class="text-muted d-block mt-1">Biarkan kosong jika tidak ingin mengganti cover.</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="background:#F8FAFC; border-top: 1px solid #E2E8F0; padding: 12px 20px;">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success font-weight-bold">
                        <span class="material-icons" style="font-size:16px; vertical-align:middle;">save</span> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.querySelectorAll('.btn-edit-regulasi').forEach(function(btn) {
    btn.addEventListener('click', function() {
        var id = this.dataset.id;
        document.getElementById('edit_r_title').value       = this.dataset.title;
        document.getElementById('edit_r_description').value = this.dataset.description;
        document.getElementById('edit_r_category').value    = this.dataset.category;
        document.getElementById('edit_r_topic').value       = this.dataset.topic;
        document.getElementById('edit_r_year').value        = this.dataset.year;
        document.getElementById('edit_r_status').value      = this.dataset.status;

        var fileUrl = this.dataset.file_url;
        var fileSize = this.dataset.file_size;
        var currentFileBox = document.getElementById('edit_r_file_current');
        if (fileUrl) {
            currentFileBox.innerHTML = '<span class="material-icons text-success" style="font-size:16px;vertical-align:middle;">picture_as_pdf</span> File saat ini: <a href="' + fileUrl + '" target="_blank" class="text-success font-weight-bold" style="text-decoration:none;">Lihat PDF (' + fileSize + ')</a>';
        } else {
            currentFileBox.innerHTML = '';
        }

        var coverUrl = this.dataset.cover_url;
        var currentCoverBox = document.getElementById('edit_r_cover_current');
        if (coverUrl) {
            currentCoverBox.innerHTML = '<img src="' + coverUrl + '" alt="Cover" style="width:48px;height:64px;object-fit:cover;border-radius:2px;border:1px solid #CBD5E1;">';
        } else {
            currentCoverBox.innerHTML = '';
        }

        document.getElementById('form-edit-regulasi').action = '{{ route('admin.regulasi.update', ['regulasi' => '__ID__']) }}'.replace('__ID__', id);
    });
});
</script>
@endsection
