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

        <div class="card card-outline card-success">
            <div class="card-header d-flex flex-wrap align-items-center justify-content-between" style="gap: 12px; padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
                <span class="d-flex align-items-center" style="gap: 8px;">
                    <span class="material-icons text-success" style="font-size:20px;">place</span>
                    <span class="font-weight-bold card-title-label">Kelola Data Kecamatan</span>
                </span>

                <form action="{{ route('admin.kecamatan.index') }}" method="GET" class="d-flex flex-wrap align-items-center" style="gap: 8px;">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Cari kecamatan..." style="width: 220px;">
                    <button type="submit" class="btn btn-sm btn-success d-flex align-items-center">
                        <span class="material-icons" style="font-size: 16px;">search</span>
                    </button>
                    @if(request('search'))
                        <a href="{{ route('admin.kecamatan.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
                    @endif
                </form>

                <button class="btn btn-sm btn-success ml-auto" data-toggle="modal" data-target="#modalTambahKecamatan">
                    <span class="material-icons" style="font-size:16px;">add</span> Tambah Kecamatan
                </button>
            </div>
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
                                    <div class="btn-action-group">
                                        <button class="btn-action btn-action-edit btn-edit-kecamatan"
                                                data-id="{{ $kec->id }}"
                                                data-name="{{ $kec->name }}"
                                                data-toggle="modal" data-target="#modalEditKecamatan"
                                                title="Edit">
                                            <span class="material-icons">edit</span>
                                        </button>
                                        <form action="{{ route('admin.kecamatan.destroy', $kec->id) }}" method="POST" class="d-inline" id="del-kec-{{ $kec->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn-action btn-action-delete"
                                                    onclick="confirmDelete('del-kec-{{ $kec->id }}')"
                                                    title="Hapus">
                                                <span class="material-icons">delete</span>
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
