@extends('admin.layouts.admin')
@section('title', 'Kecamatan')
@section('header_title', 'Kelola Kecamatan')

@section('content')
<div class="row">
    <div class="col-12">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 6px;">
                <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card-header-actions mb-4 d-flex align-items-center justify-content-between">
            <div>
                <div style="font-size: 18px; font-weight: 800; color: #004F3B;">Kelola Kecamatan</div>
                <div style="font-size: 14px; color: #6B7280; margin-top: 4px;">Kelola daftar wilayah kecamatan di lingkungan Kabupaten Cianjur.</div>
            </div>
            <button class="btn btn-success" data-toggle="modal" data-target="#modalTambahKecamatan">
                <span class="material-icons" style="font-size:17px; vertical-align:middle; margin-right:4px;">add</span> Tambah Kecamatan
            </button>
        </div>

        <div class="card" style="box-shadow: var(--card-shadow); border-radius: 8px; border: none;">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th style="width: 80px; padding-left: 24px;">No</th>
                                <th>Nama Kecamatan</th>
                                <th class="text-center" style="width: 150px; padding-right: 24px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kecamatans as $idx => $kec)
                            <tr>
                                <td style="padding-left: 24px; vertical-align: middle;">{{ $idx + 1 }}</td>
                                <td class="font-weight-bold text-dark" style="vertical-align: middle;">{{ $kec->name }}</td>
                                <td class="text-center" style="padding-right: 24px; vertical-align: middle;">
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary btn-edit-kecamatan" 
                                                data-id="{{ $kec->id }}" 
                                                data-name="{{ $kec->name }}" 
                                                data-toggle="modal" data-target="#modalEditKecamatan"
                                                style="border-radius: 4px; padding: 4px 8px; margin-right: 4px;">
                                            <span class="material-icons" style="font-size: 15px; vertical-align: middle;">edit</span>
                                        </button>
                                        <form action="{{ route('admin.kecamatan.destroy', $kec->id) }}" method="POST" class="d-inline" id="del-kec-{{ $kec->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-outline-danger" 
                                                    onclick="if(confirm('Apakah Anda yakin ingin menghapus kecamatan ini?')) document.getElementById('del-kec-{{ $kec->id }}').submit();"
                                                    style="border-radius: 4px; padding: 4px 8px;">
                                                <span class="material-icons" style="font-size: 15px; vertical-align: middle;">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-5 text-muted">
                                    <span class="material-icons" style="font-size:48px;display:block;margin-bottom:12px;color:#D1D5DB;">explore</span>
                                    Belum ada kecamatan terdaftar.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH -->
<div class="modal fade" id="modalTambahKecamatan" tabindex="-1" role="dialog" aria-labelledby="modalTambahKecamatanLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.kecamatan.store') }}" method="POST">
                @csrf
                <div class="modal-header" style="background:#009966; color:#fff; border-radius:0;">
                    <h5 class="modal-title" id="modalTambahKecamatanLabel">Tambah Kecamatan</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Kecamatan <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Contoh: Cianjur, Cipanas, dll." required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDIT -->
<div class="modal fade" id="modalEditKecamatan" tabindex="-1" role="dialog" aria-labelledby="modalEditKecamatanLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="POST" id="form-edit-kecamatan">
                @csrf
                @method('PUT')
                <div class="modal-header" style="background:#004F3B; color:#fff; border-radius:0;">
                    <h5 class="modal-title" id="modalEditKecamatanLabel">Edit Kecamatan</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_name">Nama Kecamatan <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="edit_name" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.btn-edit-kecamatan');
        editButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                
                document.getElementById('edit_name').value = name;
                document.getElementById('form-edit-kecamatan').action = `/admin/kecamatan/${id}`;
            });
        });
    });
</script>
@endsection
