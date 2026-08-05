@extends('admin.layouts.admin')
@section('title', 'Kelola Layanan Terpadu')
@section('header_title', 'Kelola Layanan Terpadu')

@section('content')
<div class="card card-outline card-success">
    <div class="card-header d-flex align-items-center justify-content-end" style="padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalTambahLayanan">
            <span class="material-icons" style="font-size:16px;">add</span> Tambah Layanan
        </button>
    </div>

    {{-- Tabs Filter Segmen --}}
    <div class="px-4 pt-3 pb-0 bg-white" style="border-bottom: 1px solid #E2E8F0;">
        <ul class="nav nav-tabs border-0" id="layanan-type-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link {{ request('type', '') === '' ? 'active font-weight-bold text-success' : 'text-secondary' }}" style="border-bottom: 3px solid {{ request('type', '') === '' ? '#009966' : 'transparent' }}; border-radius: 0; padding-bottom: 12px;" href="{{ route('admin.layanan.index') }}">
                    Semua
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request('type') === 'Warga' ? 'active font-weight-bold text-success' : 'text-secondary' }}" style="border-bottom: 3px solid {{ request('type') === 'Warga' ? '#009966' : 'transparent' }}; border-radius: 0; padding-bottom: 12px;" href="{{ route('admin.layanan.index', array_merge(request()->except('page'), ['type' => 'Warga'])) }}">
                    Warga
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request('type') === 'Faskes' ? 'active font-weight-bold text-success' : 'text-secondary' }}" style="border-bottom: 3px solid {{ request('type') === 'Faskes' ? '#009966' : 'transparent' }}; border-radius: 0; padding-bottom: 12px;" href="{{ route('admin.layanan.index', array_merge(request()->except('page'), ['type' => 'Faskes'])) }}">
                    Faskes
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request('type') === 'Nakes' ? 'active font-weight-bold text-success' : 'text-secondary' }}" style="border-bottom: 3px solid {{ request('type') === 'Nakes' ? '#009966' : 'transparent' }}; border-radius: 0; padding-bottom: 12px;" href="{{ route('admin.layanan.index', array_merge(request()->except('page'), ['type' => 'Nakes'])) }}">
                    Nakes
                </a>
            </li>
        </ul>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="text-center" style="width:70px;">Icon</th>
                        <th>Nama Layanan</th>
                        <th style="width:160px;">Segmen Penerima</th>
                        <th style="width:240px;">Link Tautan</th>
                        <th class="text-center" style="width:100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($layanans as $layanan)
                    <tr>
                        <td class="text-center align-middle">
                            <div style="width:38px;height:38px;background:#E6F7F0;color:#009966;border-radius:3px;display:inline-flex;align-items:center;justify-content:center;">
                                @php
                                    $iconMap = ['users'=>'people','smile'=>'sentiment_satisfied_alt','chat'=>'chat','desktop'=>'desktop_windows','bag'=>'shopping_bag','globe'=>'language','file'=>'description'];
                                @endphp
                                <span class="material-icons" style="font-size:20px;">{{ $iconMap[$layanan->icon] ?? 'help_outline' }}</span>
                            </div>
                        </td>
                        <td class="font-weight-bold text-dark align-middle">{{ $layanan->name }}</td>
                        <td class="align-middle">
                            @if($layanan->type === 'Warga')
                                <span class="badge" style="background:#DBEAFE;color:#1E40AF;padding:4px 10px;border-radius:3px;">Layanan Warga</span>
                            @elseif($layanan->type === 'Faskes')
                                <span class="badge" style="background:#FEF3C7;color:#92400E;padding:4px 10px;border-radius:3px;">Layanan Faskes</span>
                            @else
                                <span class="badge" style="background:#D1FAE5;color:#065F46;padding:4px 10px;border-radius:3px;">Layanan Nakes</span>
                            @endif
                        </td>
                        <td class="align-middle" style="font-size:13px;color:#475569;">
                            @if($layanan->link)
                                <a href="{{ $layanan->link }}" target="_blank" class="text-success" style="word-break:break-all;text-decoration:none;">{{ Str::limit($layanan->link, 38) }}</a>
                            @else
                                <span class="text-muted font-italic">Tidak ada tautan</span>
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
                                    <span class="material-icons" style="font-size:16px;">edit</span>
                                </button>
                                <form action="{{ route('admin.layanan.destroy', $layanan->id) }}" method="POST" id="del-layanan-{{ $layanan->id }}" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn-action btn-action-delete" title="Hapus"
                                        onclick="confirmDelete('del-layanan-{{ $layanan->id }}')">
                                        <span class="material-icons" style="font-size:16px;">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <span class="material-icons" style="font-size:48px;display:block;margin-bottom:8px;color:#D1D5DB;">widgets</span>
                            Belum ada data layanan terpadu.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- ======================================== --}}
{{-- MODAL: TAMBAH LAYANAN                    --}}
{{-- ======================================== --}}
<div class="modal fade" id="modalTambahLayanan" tabindex="-1" role="dialog" aria-labelledby="modalTambahLayananLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.layanan.store') }}" method="POST">
                @csrf
                <div class="modal-header" style="background:#009966;color:#fff;border-radius:0;">
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

{{-- ======================================== --}}
{{-- MODAL: EDIT LAYANAN                      --}}
{{-- ======================================== --}}
<div class="modal fade" id="modalEditLayanan" tabindex="-1" role="dialog" aria-labelledby="modalEditLayananLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="POST" id="form-edit-layanan">
                @csrf @method('PUT')
                <div class="modal-header" style="background:#D97706;color:#fff;border-radius:0;">
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
document.querySelectorAll('.btn-edit-layanan').forEach(function(btn) {
    btn.addEventListener('click', function() {
        var id = this.dataset.id;
        document.getElementById('edit_l_name').value = this.dataset.name;
        document.getElementById('edit_l_type').value = this.dataset.type;
        document.getElementById('edit_l_icon').value = this.dataset.icon;
        document.getElementById('edit_l_link').value = this.dataset.link;
        document.getElementById('form-edit-layanan').action = '{{ route('admin.layanan.update', ['layanan_terpadu' => '__ID__']) }}'.replace('__ID__', id);
    });
});
</script>
@endsection
