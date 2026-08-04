@extends('admin.layouts.admin')
@section('title', 'Kelola Laporan')
@section('header_title', 'Kelola Laporan Kinerja')

@section('content')
<div class="card card-outline card-success">
    <div class="card-header d-flex align-items-center justify-content-end" style="padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalTambahLaporan">
            <span class="material-icons" style="font-size:16px;">add</span> Tambah Laporan
        </button>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Judul Laporan</th>
                        <th style="width:180px;">Kategori</th>
                        <th style="width:140px;">Tanggal Rilis</th>
                        <th style="width:110px;">Ukuran File</th>
                        <th class="text-center" style="width:100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporans as $laporan)
                    <tr>
                        <td>
                            <div class="font-weight-bold text-dark">{{ $laporan->title }}</div>
                            <small>
                                <span class="material-icons text-success" style="font-size:13px;vertical-align:middle;">attachment</span>
                                <a href="{{ asset('storage/' . $laporan->file_path) }}" target="_blank" class="text-success" style="text-decoration:none;">Unduh File</a>
                            </small>
                        </td>
                        <td class="align-middle">
                            <span class="badge" style="background:#E0F2FE;color:#0369A1;padding:4px 10px;border-radius:3px;font-size:11px;font-weight:700;">
                                {{ $laporan->category }}
                            </span>
                        </td>
                        <td class="text-secondary align-middle">{{ $laporan->release_date->format('d M Y') }}</td>
                        <td class="text-secondary font-weight-bold align-middle">{{ $laporan->file_size }}</td>
                        <td class="text-center align-middle">
                            <div class="btn-action-group">
                                <button type="button"
                                    class="btn-action btn-action-edit btn-edit-laporan"
                                    title="Edit"
                                    data-id="{{ $laporan->id }}"
                                    data-title="{{ $laporan->title }}"
                                    data-category="{{ $laporan->category }}"
                                    data-release_date="{{ $laporan->release_date->format('Y-m-d') }}"
                                    data-file_size="{{ $laporan->file_size }}"
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
                            <span class="material-icons" style="font-size:48px;display:block;margin-bottom:8px;color:#D1D5DB;">description</span>
                            Belum ada data laporan kinerja.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- ======================================== --}}
{{-- MODAL: TAMBAH LAPORAN                    --}}
{{-- ======================================== --}}
<div class="modal fade" id="modalTambahLaporan" tabindex="-1" role="dialog" aria-labelledby="modalTambahLaporanLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.laporan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header" style="background:#009966;color:#fff;border-radius:0;">
                    <h5 class="modal-title" id="modalTambahLaporanLabel">
                        <span class="material-icons" style="vertical-align:middle;margin-right:6px;">note_add</span>
                        Tambah Laporan Baru
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tambah_lap_title">Judul Laporan <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="tambah_lap_title" class="form-control" placeholder="Masukkan judul laporan..." required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tambah_lap_category">Kategori Laporan <span class="text-danger">*</span></label>
                                <select name="category" id="tambah_lap_category" class="form-control" required>
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    <option value="Laporan Kinerja">Laporan Kinerja</option>
                                    <option value="Laporan Keuangan">Laporan Keuangan</option>
                                    <option value="Informasi Publik">Informasi Publik</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tambah_lap_release_date">Tanggal Rilis <span class="text-danger">*</span></label>
                                <input type="date" name="release_date" id="tambah_lap_release_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="tambah_lap_file">File Laporan (PDF) <span class="text-danger">*</span></label>
                                <input type="file" name="file" id="tambah_lap_file" class="form-control" accept=".pdf,.doc,.docx" required>
                                <small class="text-muted">Format: PDF, DOC, DOCX. Maks: 10MB.</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tambah_lap_file_size">Ukuran File <span class="text-muted" style="font-weight:400;">(info)</span></label>
                                <input type="text" name="file_size" id="tambah_lap_file_size" class="form-control" placeholder="Contoh: 2.5 MB">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">
                        <span class="material-icons" style="font-size:16px;vertical-align:middle;">upload</span> Simpan Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ======================================== --}}
{{-- MODAL: EDIT LAPORAN                      --}}
{{-- ======================================== --}}
<div class="modal fade" id="modalEditLaporan" tabindex="-1" role="dialog" aria-labelledby="modalEditLaporanLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="" method="POST" id="form-edit-laporan" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="modal-header" style="background:#D97706;color:#fff;border-radius:0;">
                    <h5 class="modal-title" id="modalEditLaporanLabel">
                        <span class="material-icons" style="vertical-align:middle;margin-right:6px;">edit_note</span>
                        Edit Laporan
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_lap_title">Judul Laporan <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="edit_lap_title" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_lap_category">Kategori Laporan <span class="text-danger">*</span></label>
                                <select name="category" id="edit_lap_category" class="form-control" required>
                                    <option value="Laporan Kinerja">Laporan Kinerja</option>
                                    <option value="Laporan Keuangan">Laporan Keuangan</option>
                                    <option value="Informasi Publik">Informasi Publik</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_lap_release_date">Tanggal Rilis <span class="text-danger">*</span></label>
                                <input type="date" name="release_date" id="edit_lap_release_date" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="edit_lap_file">Ganti File <span class="text-muted" style="font-weight:400;">(opsional, kosongkan jika tidak diganti)</span></label>
                                <input type="file" name="file" id="edit_lap_file" class="form-control" accept=".pdf,.doc,.docx">
                                <small class="text-muted">Format: PDF, DOC, DOCX. Maks: 10MB.</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="edit_lap_file_size">Ukuran File</label>
                                <input type="text" name="file_size" id="edit_lap_file_size" class="form-control" placeholder="Contoh: 2.5 MB">
                            </div>
                        </div>
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
document.querySelectorAll('.btn-edit-laporan').forEach(function(btn) {
    btn.addEventListener('click', function() {
        var id = this.dataset.id;
        document.getElementById('edit_lap_title').value        = this.dataset.title;
        document.getElementById('edit_lap_category').value     = this.dataset.category;
        document.getElementById('edit_lap_release_date').value = this.dataset.release_date;
        document.getElementById('edit_lap_file_size').value    = this.dataset.file_size;
        document.getElementById('form-edit-laporan').action = '{{ url("admin/laporan") }}/' + id;
    });
});
</script>
@endsection
