@extends('admin.layouts.admin')
@section('title', 'Kelola Regulasi')
@section('header_title', 'Kelola Regulasi & Hukum')

@section('content')
<div class="card card-outline card-success">
    <div class="card-header d-flex align-items-center justify-content-end" style="padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalTambahRegulasi">
            <span class="material-icons" style="font-size:16px;">add</span> Tambah Regulasi
        </button>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width:80px;">Cover</th>
                        <th>Nomor / Judul Regulasi</th>
                        <th style="width:160px;">Kategori</th>
                        <th style="width:130px;">Topik</th>
                        <th class="text-center" style="width:70px;">Tahun</th>
                        <th class="text-center" style="width:110px;">Status</th>
                        <th class="text-center" style="width:100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($regulasis as $regulasi)
                    <tr>
                        <td class="align-middle">
                            @if($regulasi->cover_path)
                                <img src="{{ asset('storage/' . $regulasi->cover_path) }}" alt=""
                                    style="width:50px;height:65px;object-fit:cover;border-radius:2px;border:1px solid #CBD5E1;">
                            @else
                                <div style="width:50px;height:65px;background:#F1F5F9;display:flex;align-items:center;justify-content:center;border-radius:2px;border:1px solid #CBD5E1;">
                                    <span class="material-icons text-muted" style="font-size:20px;">description</span>
                                </div>
                            @endif
                        </td>
                        <td class="align-middle">
                            <div class="font-weight-bold text-dark">{{ $regulasi->title }}</div>
                            <small class="text-muted">{{ Str::limit($regulasi->description, 80) }}</small>
                            <br>
                            <small>
                                <span class="material-icons text-success" style="font-size:13px;vertical-align:middle;">description</span>
                                <a href="{{ asset('storage/' . $regulasi->file_path) }}" target="_blank" class="text-success" style="text-decoration:none;">
                                    Unduh PDF ({{ $regulasi->file_size }})
                                </a>
                            </small>
                        </td>
                        <td class="align-middle">
                            <span class="badge" style="background:#F1F5F9;color:#475569;padding:4px 10px;border-radius:3px;font-size:11px;font-weight:700;">
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
                                <span class="badge" style="background:#DEF7EC;color:#03543F;padding:4px 10px;border-radius:10px;font-size:11px;font-weight:600;">
                                    <span style="display:inline-block;width:6px;height:6px;background:#31C48D;border-radius:50%;margin-right:4px;vertical-align:middle;"></span>
                                    Berlaku
                                </span>
                            @else
                                <span class="badge" style="background:#FDE8E8;color:#9B1C1C;padding:4px 10px;border-radius:10px;font-size:11px;font-weight:600;">
                                    <span style="display:inline-block;width:6px;height:6px;background:#F05252;border-radius:50%;margin-right:4px;vertical-align:middle;"></span>
                                    Tidak Berlaku
                                </span>
                            @endif
                        </td>
                        <td class="text-center align-middle">
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
                            <span class="material-icons" style="font-size:48px;display:block;margin-bottom:8px;color:#D1D5DB;">gavel</span>
                            Belum ada data regulasi.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- ======================================== --}}
{{-- MODAL: TAMBAH REGULASI                   --}}
{{-- ======================================== --}}
<div class="modal fade" id="modalTambahRegulasi" tabindex="-1" role="dialog" aria-labelledby="modalTambahRegulasiLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.regulasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header" style="background:#009966;color:#fff;border-radius:0;">
                    <h5 class="modal-title" id="modalTambahRegulasiLabel">
                        <span class="material-icons" style="vertical-align:middle;margin-right:6px;">post_add</span>
                        Tambah Regulasi Baru
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tambah_r_title">Judul / Nomor Regulasi <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="tambah_r_title" class="form-control" placeholder="Peraturan Bupati No. ... Tentang ..." required>
                    </div>
                    <div class="form-group">
                        <label for="tambah_r_description">Deskripsi Singkat <span class="text-muted" style="font-weight:400;">(opsional)</span></label>
                        <textarea name="description" id="tambah_r_description" class="form-control" rows="2" placeholder="Ringkasan isi regulasi..."></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tambah_r_category">Kategori <span class="text-danger">*</span></label>
                                <select name="category" id="tambah_r_category" class="form-control" required>
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    <option value="Peraturan Bupati">Peraturan Bupati</option>
                                    <option value="Keputusan Bupati">Keputusan Bupati</option>
                                    <option value="Peraturan Menteri">Peraturan Menteri</option>
                                    <option value="Undang-Undang">Undang-Undang</option>
                                    <option value="Peraturan Daerah">Peraturan Daerah</option>
                                    <option value="Surat Edaran">Surat Edaran</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tambah_r_topic">Topik <span class="text-danger">*</span></label>
                                <input type="text" name="topic" id="tambah_r_topic" class="form-control" placeholder="Contoh: Stunting, KIA..." required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="tambah_r_year">Tahun <span class="text-danger">*</span></label>
                                <input type="number" name="year" id="tambah_r_year" class="form-control" value="{{ date('Y') }}" min="2000" max="{{ date('Y') + 5 }}" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="tambah_r_status">Status <span class="text-danger">*</span></label>
                                <select name="status" id="tambah_r_status" class="form-control" required>
                                    <option value="Berlaku">Berlaku</option>
                                    <option value="Tidak Berlaku">Tidak Berlaku</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="tambah_r_file">File PDF Regulasi <span class="text-danger">*</span></label>
                                <input type="file" name="file" id="tambah_r_file" class="form-control" accept=".pdf" required>
                                <small class="text-muted">Format: PDF. Maks: 10MB.</small>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="tambah_r_cover">Cover / Thumbnail <span class="text-muted" style="font-weight:400;">(opsional)</span></label>
                                <input type="file" name="cover" id="tambah_r_cover" class="form-control" accept="image/*">
                                <small class="text-muted">Format: JPG, PNG. Maks: 2MB.</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">
                        <span class="material-icons" style="font-size:16px;vertical-align:middle;">upload</span> Simpan Regulasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ======================================== --}}
{{-- MODAL: EDIT REGULASI                     --}}
{{-- ======================================== --}}
<div class="modal fade" id="modalEditRegulasi" tabindex="-1" role="dialog" aria-labelledby="modalEditRegulasiLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="" method="POST" id="form-edit-regulasi" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="modal-header" style="background:#D97706;color:#fff;border-radius:0;">
                    <h5 class="modal-title" id="modalEditRegulasiLabel">
                        <span class="material-icons" style="vertical-align:middle;margin-right:6px;">edit_document</span>
                        Edit Regulasi
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_r_title">Judul / Nomor Regulasi <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="edit_r_title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_r_description">Deskripsi Singkat <span class="text-muted" style="font-weight:400;">(opsional)</span></label>
                        <textarea name="description" id="edit_r_description" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="edit_r_category">Kategori <span class="text-danger">*</span></label>
                                <select name="category" id="edit_r_category" class="form-control" required>
                                    <option value="Peraturan Bupati">Peraturan Bupati</option>
                                    <option value="Keputusan Bupati">Keputusan Bupati</option>
                                    <option value="Peraturan Menteri">Peraturan Menteri</option>
                                    <option value="Undang-Undang">Undang-Undang</option>
                                    <option value="Peraturan Daerah">Peraturan Daerah</option>
                                    <option value="Surat Edaran">Surat Edaran</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="edit_r_topic">Topik <span class="text-danger">*</span></label>
                                <input type="text" name="topic" id="edit_r_topic" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="edit_r_year">Tahun <span class="text-danger">*</span></label>
                                <input type="number" name="year" id="edit_r_year" class="form-control" min="2000" max="{{ date('Y') + 5 }}" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="edit_r_status">Status <span class="text-danger">*</span></label>
                                <select name="status" id="edit_r_status" class="form-control" required>
                                    <option value="Berlaku">Berlaku</option>
                                    <option value="Tidak Berlaku">Tidak Berlaku</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="edit_r_file">Ganti File PDF <span class="text-muted" style="font-weight:400;">(opsional)</span></label>
                                <input type="file" name="file" id="edit_r_file" class="form-control" accept=".pdf">
                                <small class="text-muted">Kosongkan jika tidak ingin mengganti file.</small>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="edit_r_cover">Ganti Cover <span class="text-muted" style="font-weight:400;">(opsional)</span></label>
                                <input type="file" name="cover" id="edit_r_cover" class="form-control" accept="image/*">
                                <small class="text-muted">Kosongkan jika tidak ingin mengganti.</small>
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
document.querySelectorAll('.btn-edit-regulasi').forEach(function(btn) {
    btn.addEventListener('click', function() {
        var id = this.dataset.id;
        document.getElementById('edit_r_title').value       = this.dataset.title;
        document.getElementById('edit_r_description').value = this.dataset.description;
        document.getElementById('edit_r_category').value    = this.dataset.category;
        document.getElementById('edit_r_topic').value       = this.dataset.topic;
        document.getElementById('edit_r_year').value        = this.dataset.year;
        document.getElementById('edit_r_status').value      = this.dataset.status;
        document.getElementById('form-edit-regulasi').action = '{{ url("admin/regulasi") }}/' + id;
    });
});
</script>
@endsection
