@extends('admin.layouts.admin')
@section('title', 'Kelola Layanan Terpadu')
@section('header_title', 'Kelola Layanan Terpadu')

@section('content')
<div class="card card-outline card-success">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between" style="gap: 12px;">
        <span class="d-flex align-items-center" style="gap: 8px;">
            <span class="material-icons text-success">widgets</span>
            <span class="font-weight-bold card-title-label">Kelola Layanan Terpadu</span>
        </span>
        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalTambahLayanan">
            <span class="material-icons" style="font-size:16px;">add</span> Tambah Layanan
        </button>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width: 70px; text-align: center;">Icon</th>
                        <th>Nama Layanan</th>
                        <th style="width: 160px; text-align: center;">Segmen Penerima</th>
                        <th style="width: 240px;">Link Tautan</th>
                        <th style="width: 100px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($layanans as $layanan)
                    <tr>
                        <td style="text-align: center;">
                            <div style="width:38px;height:38px;background:#E6F7F0;color:#009966;border-radius:3px;display:inline-flex;align-items:center;justify-content:center;">
                                @php
                                    $iconMap = ['users'=>'people','smile'=>'sentiment_satisfied_alt','chat'=>'chat','desktop'=>'desktop_windows','bag'=>'shopping_bag','globe'=>'language','file'=>'description'];
                                @endphp
                                <span class="material-icons" style="font-size:20px;">{{ $iconMap[$layanan->icon] ?? 'help_outline' }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="font-weight-bold text-dark">{{ $layanan->name }}</div>
                        </td>
                        <td class="text-center align-middle">
                            @if($layanan->type === 'Warga')
                                <span class="badge" style="background:#DBEAFE;color:#1E40AF;padding:4px 10px;border-radius:3px;font-size:12px;font-weight:700;">Layanan Warga</span>
                            @elseif($layanan->type === 'Faskes')
                                <span class="badge" style="background:#EDE9FE;color:#5B21B6;padding:4px 10px;border-radius:3px;font-size:12px;font-weight:700;">Layanan Faskes</span>
                            @else
                                <span class="badge" style="background:#D1FAE5;color:#065F46;padding:4px 10px;border-radius:3px;font-size:12px;font-weight:700;">Layanan Nakes</span>
                            @endif
                        </td>
                        <td class="align-middle">
                            @if($layanan->link)
                                <a href="{{ $layanan->link }}" target="_blank" style="color:#009966;font-size:13px;text-decoration:none;word-break:break-all;background:#F8FAFC;padding:2px 6px;border-radius:3px;border:1px solid #E2E8F0;">
                                    {{ Str::limit($layanan->link, 38) }}
                                </a>
                            @else
                                <span class="text-muted" style="font-size:13px;font-style:italic;">Tidak ada tautan</span>
                            @endif
                        </td>
                        <td class="text-center align-middle">
                            <div class="btn-action-group">
                                <button type="button"
                                    class="btn-action btn-action-edit btn-edit-layanan"
                                    title="Edit"
                                    data-id="{{ $layanan->id }}"
                                    data-name="{{ $layanan->name }}"
                                    data-type="{{ $layanan->type }}"
                                    data-icon="{{ $layanan->icon }}"
                                    data-link="{{ $layanan->link ?? '' }}"
                                    data-toggle="modal" data-target="#modalEditLayanan">
                                    <span class="material-icons">edit</span>
                                </button>
                                <form action="{{ route('admin.layanan.destroy', $layanan->id) }}" method="POST" id="del-layanan-{{ $layanan->id }}" style="margin: 0; display: inline;">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn-action btn-action-delete" title="Hapus"
                                        onclick="confirmDelete('del-layanan-{{ $layanan->id }}')">
                                        <span class="material-icons">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center" style="padding: 48px; color: #94A3B8;">
                            <span class="material-icons" style="font-size: 48px; display: block; margin-bottom: 12px; color: #CBD5E1;">widgets</span>
                            <p style="font-size: 15px; font-weight: 600;">Belum ada data layanan terpadu.</p>
                            <p class="text-muted" style="font-size: 13px;">Klik <strong>"Tambah Layanan"</strong> untuk memulai.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL: TAMBAH LAYANAN --}}
<div class="modal fade" id="modalTambahLayanan" tabindex="-1" role="dialog" aria-labelledby="modalTambahLayananLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.layanan.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLayananLabel">
                        <span class="material-icons" style="vertical-align:middle;margin-right:6px;">add_circle</span>
                        Tambah Layanan Baru
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tambah_l_name">Nama Pelayanan <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="tambah_l_name" class="form-control" placeholder="Masukkan nama pelayanan kesehatan..." required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tambah_l_type">Segmen Penerima <span class="text-danger">*</span></label>
                                <select name="type" id="tambah_l_type" class="form-control" required>
                                    <option value="" disabled selected>Pilih Segmen</option>
                                    <option value="Warga">Layanan Untuk Warga</option>
                                    <option value="Faskes">Layanan Untuk Faskes</option>
                                    <option value="Nakes">Layanan Untuk Nakes</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tambah_l_icon">Visual Icon <span class="text-danger">*</span></label>
                                <select name="icon" id="tambah_l_icon" class="form-control" required>
                                    <option value="users">Orang (people)</option>
                                    <option value="smile">Senyum (smile)</option>
                                    <option value="chat">Obrolan (chat)</option>
                                    <option value="desktop">Komputer (desktop)</option>
                                    <option value="bag">Tas (bag)</option>
                                    <option value="globe">Globe (globe)</option>
                                    <option value="file">Dokumen (file)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <label for="tambah_l_link">Link Tautan <span class="text-muted" style="font-weight:400;">(opsional)</span></label>
                        <input type="url" name="link" id="tambah_l_link" class="form-control" placeholder="https://layanan.cianjurkab.go.id">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">
                        <span class="material-icons" style="font-size:16px;vertical-align:middle;">save</span> Simpan Layanan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL: EDIT LAYANAN --}}
<div class="modal fade" id="modalEditLayanan" tabindex="-1" role="dialog" aria-labelledby="modalEditLayananLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="POST" id="form-edit-layanan">
                @csrf @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLayananLabel">
                        <span class="material-icons" style="vertical-align:middle;margin-right:6px;">edit</span>
                        Edit Layanan
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_l_name">Nama Pelayanan <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="edit_l_name" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_l_type">Segmen Penerima <span class="text-danger">*</span></label>
                                <select name="type" id="edit_l_type" class="form-control" required>
                                    <option value="Warga">Layanan Untuk Warga</option>
                                    <option value="Faskes">Layanan Untuk Faskes</option>
                                    <option value="Nakes">Layanan Untuk Nakes</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_l_icon">Visual Icon <span class="text-danger">*</span></label>
                                <select name="icon" id="edit_l_icon" class="form-control" required>
                                    <option value="users">Orang (people)</option>
                                    <option value="smile">Senyum (smile)</option>
                                    <option value="chat">Obrolan (chat)</option>
                                    <option value="desktop">Komputer (desktop)</option>
                                    <option value="bag">Tas (bag)</option>
                                    <option value="globe">Globe (globe)</option>
                                    <option value="file">Dokumen (file)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <label for="edit_l_link">Link Tautan <span class="text-muted" style="font-weight:400;">(opsional)</span></label>
                        <input type="url" name="link" id="edit_l_link" class="form-control" placeholder="https://layanan.cianjurkab.go.id">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">
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
document.querySelectorAll('.btn-edit-layanan').forEach(function(btn) {
    btn.addEventListener('click', function() {
        var id = this.dataset.id;
        document.getElementById('edit_l_name').value = this.dataset.name;
        document.getElementById('edit_l_type').value = this.dataset.type;
        document.getElementById('edit_l_icon').value = this.dataset.icon;
        document.getElementById('edit_l_link').value = this.dataset.link;
        document.getElementById('form-edit-layanan').action = '{{ url("admin/layanan") }}/' + id;
    });
});
</script>
@endsection
