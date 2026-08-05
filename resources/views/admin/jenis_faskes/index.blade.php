@extends('admin.layouts.admin')
@section('title', 'Jenis Faskes')
@section('header_title', 'Kelola Jenis Faskes')

@section('content')
<div class="row">
    <div class="col-12">


        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <p class="mb-0 text-muted" style="font-size:13px;">Kelola daftar kategori atau jenis fasilitas kesehatan yang terdaftar.</p>
            </div>
            <button class="btn btn-success" data-toggle="modal" data-target="#modalTambahType">
                <span class="material-icons" style="font-size:17px; vertical-align:middle; margin-right:4px;">add</span> Tambah Jenis Faskes
            </button>
        </div>

        <div class="card" style="box-shadow: var(--card-shadow); border-radius: 8px; border: none;">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th style="width: 80px; padding-left: 24px;">No</th>
                                <th>Nama Jenis Fasilitas Kesehatan</th>
                                <th class="text-center" style="width: 150px; padding-right: 24px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($types as $idx => $type)
                            <tr>
                                <td style="padding-left: 24px; vertical-align: middle;">{{ $idx + 1 }}</td>
                                <td class="font-weight-bold text-dark" style="vertical-align: middle;">{{ $type->name }}</td>
                                <td class="text-center" style="padding-right: 24px; vertical-align: middle;">
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary btn-edit-type" 
                                                data-id="{{ $type->id }}" 
                                                data-name="{{ $type->name }}" 
                                                data-toggle="modal" data-target="#modalEditType"
                                                style="border-radius: 4px; padding: 4px 8px; margin-right: 4px;">
                                            <span class="material-icons" style="font-size: 15px; vertical-align: middle;">edit</span>
                                        </button>
                                        <form action="{{ route('admin.jenis-faskes.destroy', $type->id) }}" method="POST" class="d-inline" id="del-type-{{ $type->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-outline-danger" 
                                                    onclick="if(confirm('Apakah Anda yakin ingin menghapus jenis faskes ini?')) document.getElementById('del-type-{{ $type->id }}').submit();"
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
                                    <span class="material-icons" style="font-size:48px;display:block;margin-bottom:12px;color:#D1D5DB;">local_hospital</span>
                                    Belum ada jenis faskes terdaftar.
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
<div class="modal fade" id="modalTambahType" tabindex="-1" role="dialog" aria-labelledby="modalTambahTypeLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.jenis-faskes.store') }}" method="POST">
                @csrf
                <div class="modal-header" style="background:#009966; color:#fff; border-radius:0;">
                    <h5 class="modal-title" id="modalTambahTypeLabel">Tambah Jenis Faskes</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Jenis Faskes <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Contoh: Klinik Pratama, Apotek, dll." required>
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
<div class="modal fade" id="modalEditType" tabindex="-1" role="dialog" aria-labelledby="modalEditTypeLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="POST" id="form-edit-type">
                @csrf
                @method('PUT')
                <div class="modal-header" style="background:#004F3B; color:#fff; border-radius:0;">
                    <h5 class="modal-title" id="modalEditTypeLabel">Edit Jenis Faskes</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_name">Nama Jenis Faskes <span class="text-danger">*</span></label>
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
        const editButtons = document.querySelectorAll('.btn-edit-type');
        editButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                
                document.getElementById('edit_name').value = name;
                document.getElementById('form-edit-type').action = `/admin/jenis-faskes/${id}`;
            });
        });
    });
</script>
@endsection
