@extends('admin.layouts.admin')
@section('title', 'Kelola Kategori')
@section('header_title', 'Kelola Kategori')

@section('styles')
<style>
    .type-tab {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 10px 18px;
        border-radius: 3px 3px 0 0;
        font-size: 13px;
        font-weight: 600;
        color: #64748B;
        border: 1px solid transparent;
        background: transparent;
        cursor: pointer;
        transition: all 0.18s;
        text-decoration: none;
    }
    .type-tab.active {
        color: #004F3B;
        border-color: #E2E8F0;
        border-bottom-color: #FFFFFF;
        background: #FFFFFF;
        margin-bottom: -1px;
        font-weight: 700;
    }
    .type-tab:hover:not(.active) {
        color: #009966;
        background: #F8FAFC;
    }
    .color-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        display: inline-block;
        flex-shrink: 0;
    }
    .badge-preview {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        border-radius: 3px;
        font-size: 12px;
        font-weight: 700;
    }
</style>
@endsection

@section('content')
<div class="card card-outline card-success">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between" style="gap: 12px; padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
        <span class="d-flex align-items-center" style="gap: 8px;">
            <span class="material-icons text-success" style="font-size: 20px;">category</span>
            <span class="font-weight-bold card-title-label">Kelola Kategori Konten</span>
        </span>
        <button class="btn btn-sm btn-success font-weight-bold d-flex align-items-center" style="gap: 4px;" data-toggle="modal" data-target="#modalTambahKategori">
            <span class="material-icons" style="font-size: 16px;">add</span> Tambah Kategori
        </button>
    </div>

    <div class="card-body p-0">
        {{-- Type tabs --}}
        @php $activeType = request('type', 'berita'); @endphp
        <div style="border-bottom: 1px solid #E2E8F0; padding: 12px 20px 0; background: #F8FAFC; margin-bottom: 0;">
            <div class="d-flex align-items-end" style="gap: 4px;">
                @foreach($types as $key => $label)
                <a href="{{ route('admin.kategori.index', ['type' => $key]) }}"
                   class="type-tab {{ $activeType === $key ? 'active' : '' }}">
                    @if($key === 'berita') <span class="material-icons" style="font-size:16px;">newspaper</span>
                    @elseif($key === 'program') <span class="material-icons" style="font-size:16px;">health_and_safety</span>
                    @elseif($key === 'regulasi') <span class="material-icons" style="font-size:16px;">gavel</span>
                    @elseif($key === 'galeri') <span class="material-icons" style="font-size:16px;">photo_library</span>
                    @else <span class="material-icons" style="font-size:16px;">description</span>
                    @endif
                    <span>{{ $label }}</span>
                    <span style="background: #E2E8F0; color: #475569; padding: 2px 8px; border-radius: 3px; font-size: 11px; font-weight: 700;">
                        {{ ($kategoris[$key] ?? collect())->count() }}
                    </span>
                </a>
                @endforeach
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 60px; padding-left: 20px;">No</th>
                        <th>Nama Kategori</th>
                        <th style="width: 180px;">Warna Badge</th>
                        <th style="width: 220px;">Preview Badge</th>
                        <th class="text-center" style="width: 100px; padding-right: 20px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(($kategoris[$activeType] ?? collect()) as $i => $kat)
                    <tr>
                        <td class="text-center text-muted align-middle" style="padding-left: 20px;">{{ $i + 1 }}</td>
                        <td class="align-middle font-weight-bold text-dark">{{ $kat->nama }}</td>
                        <td class="align-middle">
                            <div class="d-flex align-items-center" style="gap: 8px;">
                                <span class="color-dot" @style(['background-color: ' . $kat->warna])></span>
                                <code style="font-size: 12px; color: #475569; font-weight: 600;">{{ $kat->warna }}</code>
                            </div>
                        </td>
                        <td class="align-middle">
                            <span class="badge-preview" @style([
                                'background-color: ' . $kat->warna . '20',
                                'color: ' . $kat->warna
                            ])>
                                <span class="color-dot" @style(['background-color: ' . $kat->warna])></span>
                                {{ $kat->nama }}
                            </span>
                        </td>
                        <td class="text-center align-middle" style="padding-right: 20px;">
                            <div class="btn-action-group">
                                <button class="btn-action btn-action-edit"
                                    title="Edit Kategori"
                                    data-id="{{ $kat->id }}"
                                    data-nama="{{ $kat->nama }}"
                                    data-type="{{ $kat->type }}"
                                    data-warna="{{ $kat->warna }}"
                                    onclick="openEditModal(this.dataset.id, this.dataset.nama, this.dataset.type, this.dataset.warna)"
                                >
                                    <span class="material-icons" style="font-size: 15px;">edit</span>
                                </button>
                                <form action="{{ route('admin.kategori.destroy', $kat->id) }}" method="POST" id="del-kat-{{ $kat->id }}" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn-action btn-action-delete" title="Hapus Kategori"
                                        onclick="confirmDelete('del-kat-{{ $kat->id }}')">
                                        <span class="material-icons" style="font-size: 15px;">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <span class="material-icons" style="font-size: 48px; color: #CBD5E1; display: block; margin-bottom: 8px;">folder_open</span>
                            <p class="font-weight-bold mb-1">Belum Ada Kategori</p>
                            <small class="text-muted">Belum ada kategori yang dibuat untuk tipe konten ini.</small>
                            <div class="mt-3">
                                <button class="btn btn-success btn-sm font-weight-bold" data-toggle="modal" data-target="#modalTambahKategori">
                                    <span class="material-icons" style="font-size: 14px; vertical-align: middle;">add</span> Tambah Kategori
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="modalTambahKategori" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 480px;">
        <div class="modal-content" style="border-radius: 3px; border: 1px solid #E2E8F0;">
            <form action="{{ route('admin.kategori.store') }}" method="POST">
                @csrf
                <div class="modal-header" style="background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0; padding: 16px 20px;">
                    <h5 class="modal-title font-weight-bold d-flex align-items-center" style="font-size: 15px; color: #004F3B; gap: 6px; margin: 0;">
                        <span class="material-icons text-success" style="font-size: 20px;">add_circle</span>
                        <span>Tambah Kategori Baru</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body p-4">
                    <div class="form-group mb-3">
                        <label for="add_nama" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" name="nama" id="add_nama" class="form-control" placeholder="Contoh: Gizi & Stunting" required style="border-radius: 3px;">
                    </div>
                    <div class="form-group mb-3">
                        <label for="add_type" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">Jenis Konten <span class="text-danger">*</span></label>
                        <select name="type" id="add_type" class="form-control" required style="border-radius: 3px;">
                            @foreach($types as $key => $label)
                            <option value="{{ $key }}" {{ $activeType === $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-0">
                        <label for="add_warna" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">Warna Badge <span class="text-danger">*</span></label>
                        <div class="d-flex align-items-center" style="gap: 12px;">
                            <input type="color" name="warna" id="add_warna" value="#009966"
                                class="form-control" style="width: 56px; height: 40px; padding: 2px; cursor: pointer; border-radius: 3px;"
                                onchange="updateAddPreview(this.value)">
                            <div id="add-preview" class="badge-preview" style="background: #00996620; color: #009966;">
                                <span>Pratinjau Badge</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light" style="padding: 12px 20px; border-top: 1px solid #E2E8F0;">
                    <button type="button" class="btn btn-outline-secondary font-weight-bold" data-dismiss="modal" style="border-radius: 3px;">Batal</button>
                    <button type="submit" class="btn btn-success font-weight-bold" style="border-radius: 3px;">
                        <span class="material-icons" style="font-size: 16px; vertical-align: middle;">save</span> Simpan Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Edit --}}
<div class="modal fade" id="modalEditKategori" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 480px;">
        <div class="modal-content" style="border-radius: 3px; border: 1px solid #E2E8F0;">
            <form id="formEditKategori" method="POST">
                @csrf @method('PUT')
                <div class="modal-header" style="background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0; padding: 16px 20px;">
                    <h5 class="modal-title font-weight-bold d-flex align-items-center" style="font-size: 15px; color: #004F3B; gap: 6px; margin: 0;">
                        <span class="material-icons text-success" style="font-size: 20px;">edit</span>
                        <span>Edit Kategori</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body p-4">
                    <div class="form-group mb-3">
                        <label for="edit_nama" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" name="nama" id="edit_nama" class="form-control" required style="border-radius: 3px;">
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit_type" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">Jenis Konten <span class="text-danger">*</span></label>
                        <select name="type" id="edit_type" class="form-control" required style="border-radius: 3px;">
                            @foreach($types as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-0">
                        <label for="edit_warna" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">Warna Badge <span class="text-danger">*</span></label>
                        <div class="d-flex align-items-center" style="gap: 12px;">
                            <input type="color" name="warna" id="edit_warna" value="#009966"
                                class="form-control" style="width: 56px; height: 40px; padding: 2px; cursor: pointer; border-radius: 3px;"
                                onchange="updateEditPreview(this.value)">
                            <div id="edit-preview" class="badge-preview" style="background: #00996620; color: #009966;">
                                <span>Pratinjau Badge</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light" style="padding: 12px 20px; border-top: 1px solid #E2E8F0;">
                    <button type="button" class="btn btn-outline-secondary font-weight-bold" data-dismiss="modal" style="border-radius: 3px;">Batal</button>
                    <button type="submit" class="btn btn-success font-weight-bold" style="border-radius: 3px;">
                        <span class="material-icons" style="font-size: 16px; vertical-align: middle;">save</span> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function openEditModal(id, nama, type, warna) {
    document.getElementById('formEditKategori').action = '/admin/kategori/' + id;
    document.getElementById('edit_nama').value = nama;
    document.getElementById('edit_type').value = type;
    document.getElementById('edit_warna').value = warna;
    updateEditPreview(warna);
    $('#modalEditKategori').modal('show');
}

function updateAddPreview(hex) {
    const el = document.getElementById('add-preview');
    el.style.background = hex + '20';
    el.style.color = hex;
}

function updateEditPreview(hex) {
    const el = document.getElementById('edit-preview');
    el.style.background = hex + '20';
    el.style.color = hex;
}

// Init add preview
const addWarna = document.getElementById('add_warna');
if (addWarna) {
    addWarna.dispatchEvent(new Event('change'));
}
</script>
@endsection
