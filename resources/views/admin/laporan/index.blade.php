@extends('admin.layouts.admin')
@section('title', 'Kelola Laporan')
@section('header_title', 'Kelola Laporan Kinerja')

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
            <span class="material-icons text-success" style="font-size:20px;">description</span>
            <span class="font-weight-bold card-title-label">Kelola Laporan Kinerja</span>
        </span>

        <form action="{{ route('admin.laporan.index') }}" method="GET" class="d-flex flex-wrap align-items-center" style="gap: 8px;">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Cari laporan..." style="width: 220px;">
            <select name="category" class="custom-select custom-select-sm" onchange="this.form.submit()" style="width: 180px;">
                <option value="">Semua Kategori</option>
                @foreach($kategoris as $kat)
                    <option value="{{ $kat->nama }}" {{ request('category') == $kat->nama ? 'selected' : '' }}>{{ $kat->nama }}</option>
                @endforeach
            </select>
            @if(request('search') || request('category'))
                <a href="{{ route('admin.laporan.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
            @endif
        </form>

        <div class="d-flex ml-auto" style="gap: 8px;">
            <button type="button" class="btn btn-sm btn-success d-flex align-items-center" style="gap: 4px;" data-toggle="modal" data-target="#modalTambahLaporan">
                <span class="material-icons" style="font-size:16px;">add</span> Tambah Laporan
            </button>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="padding-left: 20px;">Judul Laporan</th>
                        <th style="width:180px;">Kategori</th>
                        <th style="width:150px;">Tanggal Rilis</th>
                        <th style="width:120px;">Ukuran File</th>
                        <th class="text-center" style="width:100px; padding-right: 20px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporans as $laporan)
                    <tr>
                        <td class="align-middle" style="padding-left: 20px;">
                            <div class="font-weight-bold text-dark">{{ $laporan->title }}</div>
                            <small class="d-inline-flex align-items-center" style="gap: 4px; margin-top: 2px;">
                                <span class="material-icons text-success" style="font-size:14px;">picture_as_pdf</span>
                                <a href="{{ asset('storage/' . $laporan->file_path) }}" target="_blank" class="text-success font-weight-bold" style="text-decoration:none;">Lihat Dokumen</a>
                            </small>
                        </td>
                        <td class="align-middle">
                            <span class="badge" style="background:#E0F2FE;color:#0369A1;padding:4px 10px;border-radius:3px;font-size:11px;font-weight:700;">
                                {{ $laporan->category }}
                            </span>
                        </td>
                        <td class="text-secondary align-middle" style="font-size: 13.5px;">{{ $laporan->release_date->format('d M Y') }}</td>
                        <td class="text-secondary font-weight-bold align-middle" style="font-size: 13.5px;">{{ $laporan->file_size }}</td>
                        <td class="text-center align-middle" style="padding-right: 20px;">
                            <div class="btn-action-group">
                                <button type="button"
                                    class="btn-action btn-action-edit btn-edit-laporan"
                                    title="Edit"
                                    data-id="{{ $laporan->id }}"
                                    data-title="{{ $laporan->title }}"
                                    data-category="{{ $laporan->category }}"
                                    data-release_date="{{ $laporan->release_date->format('Y-m-d') }}"
                                    data-file_size="{{ $laporan->file_size }}"
                                    data-file_url="{{ asset('storage/' . $laporan->file_path) }}"
                                    data-toggle="modal" data-target="#modalEditLaporan">
                                    <span class="material-icons" style="font-size:16px;">edit</span>
                                </button>
                                <form action="{{ route('admin.laporan.destroy', $laporan->id) }}" method="POST" id="del-laporan-{{ $laporan->id }}" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn-action btn-action-delete" title="Hapus"
                                        onclick="confirmDelete('del-laporan-{{ $laporan->id }}')">
                                        <span class="material-icons" style="font-size:16px;">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <span class="material-icons" style="font-size:48px;display:block;margin-bottom:8px;color:#CBD5E1;">description</span>
                            <p class="font-weight-bold mb-1">Belum ada data laporan kinerja.</p>
                            @if(request('search') || request('category'))
                                <small class="text-muted">Tidak ada hasil pencarian yang sesuai.</small>
                            @else
                                <small class="text-muted">Klik <strong>"Tambah Laporan"</strong> untuk mengunggah dokumen baru.</small>
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($laporans->hasPages())
        <div class="card-footer bg-white p-3 border-top">
            {{ $laporans->links() }}
        </div>
    @endif
</div>

{{-- MODAL: TAMBAH LAPORAN --}}
<div class="modal fade" id="modalTambahLaporan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 3px; border: 1px solid #CBD5E1;">
            <form action="{{ route('admin.laporan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header" style="background:#F8FAFC; border-bottom: 1px solid #E2E8F0; padding: 14px 20px;">
                    <h5 class="modal-title font-weight-bold d-flex align-items-center" style="font-size:15px; color:#1E293B; gap:8px;">
                        <span class="material-icons text-success" style="font-size:20px;">note_add</span>
                        Tambah Laporan Kinerja Baru
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body p-4">
                    <div class="form-group">
                        <label for="tambah_lap_title" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">
                            Judul Laporan <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="title" id="tambah_lap_title" class="form-control" placeholder="Contoh: Laporan Kinerja Instansi Pemerintah (LKjIP) Tahun 2025" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="tambah_lap_category" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">
                                    Kategori Laporan <span class="text-danger">*</span>
                                </label>
                                <select name="category" id="tambah_lap_category" class="form-control custom-select" required>
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    @foreach($kategoris as $kat)
                                        <option value="{{ $kat->nama }}">{{ $kat->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="tambah_lap_release_date" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">
                                    Tanggal Rilis <span class="text-danger">*</span>
                                </label>
                                <input type="date" name="release_date" id="tambah_lap_release_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <label for="tambah_lap_file" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">
                            File Dokumen Laporan (PDF) <span class="text-danger">*</span>
                        </label>
                        <input type="file" name="file_document" id="tambah_lap_file" class="form-control-file" accept=".pdf" required>
                        <small class="text-muted d-block mt-1">Format berkas: .pdf | Ukuran maksimum: 10 MB. Ukuran file akan dihitung otomatis oleh sistem.</small>
                    </div>
                </div>
                <div class="modal-footer" style="background:#F8FAFC; border-top: 1px solid #E2E8F0; padding: 12px 20px;">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success font-weight-bold">
                        <span class="material-icons" style="font-size:16px; vertical-align:middle;">save</span> Simpan Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL: EDIT LAPORAN --}}
<div class="modal fade" id="modalEditLaporan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 3px; border: 1px solid #CBD5E1;">
            <form action="" method="POST" id="form-edit-laporan" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="modal-header" style="background:#F8FAFC; border-bottom: 1px solid #E2E8F0; padding: 14px 20px;">
                    <h5 class="modal-title font-weight-bold d-flex align-items-center" style="font-size:15px; color:#1E293B; gap:8px;">
                        <span class="material-icons text-success" style="font-size:20px;">edit_note</span>
                        Edit Laporan Kinerja
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body p-4">
                    <div class="form-group">
                        <label for="edit_lap_title" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">
                            Judul Laporan <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="title" id="edit_lap_title" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="edit_lap_category" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">
                                    Kategori Laporan <span class="text-danger">*</span>
                                </label>
                                <select name="category" id="edit_lap_category" class="form-control custom-select" required>
                                    @foreach($kategoris as $kat)
                                        <option value="{{ $kat->nama }}">{{ $kat->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="edit_lap_release_date" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">
                                    Tanggal Rilis <span class="text-danger">*</span>
                                </label>
                                <input type="date" name="release_date" id="edit_lap_release_date" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <label for="edit_lap_file" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">
                            File Dokumen Laporan (PDF)
                        </label>
                        <input type="file" name="file_document" id="edit_lap_file" class="form-control-file" accept=".pdf">
                        <div id="edit_lap_file_current" class="mt-2 text-secondary" style="font-size: 13px;"></div>
                        <small class="text-muted d-block mt-1">Format: .pdf | Maks: 10 MB. Biarkan kosong jika tidak ingin mengganti file.</small>
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
document.querySelectorAll('.btn-edit-laporan').forEach(function(btn) {
    btn.addEventListener('click', function() {
        var id = this.dataset.id;
        document.getElementById('edit_lap_title').value        = this.dataset.title;
        document.getElementById('edit_lap_category').value     = this.dataset.category;
        document.getElementById('edit_lap_release_date').value = this.dataset.release_date;
        
        var fileUrl = this.dataset.file_url;
        var fileSize = this.dataset.file_size;
        var currentBox = document.getElementById('edit_lap_file_current');
        if (fileUrl) {
            currentBox.innerHTML = '<span class="material-icons text-success" style="font-size:16px;vertical-align:middle;">attach_file</span> File saat ini: <a href="' + fileUrl + '" target="_blank" class="text-success font-weight-bold" style="text-decoration:none;">Lihat Dokumen (' + fileSize + ')</a>';
        } else {
            currentBox.innerHTML = '';
        }

        document.getElementById('form-edit-laporan').action = '{{ route('admin.laporan.update', ['laporan' => '__ID__']) }}'.replace('__ID__', id);
    });
});
</script>
@endsection
