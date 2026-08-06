@extends('admin.layouts.admin')
@section('title', 'Kelola Kategori')
@section('header_title', 'Kelola Kategori')

@section('styles')
<style>
    .type-tab {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: 6px 6px 0 0;
        font-size: 13px;
        font-weight: 600;
        color: var(--text-secondary);
        border: 1px solid transparent;
        background: transparent;
        cursor: pointer;
        transition: all 0.18s;
        text-decoration: none;
    }
    .type-tab.active {
        color: var(--brand-green);
        border-color: var(--border-subtle);
        border-bottom-color: #ffffff;
        background: #ffffff;
        margin-bottom: -1px;
    }
    .type-tab:hover:not(.active) {
        color: var(--text-primary);
        background: rgba(0,0,0,0.03);
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
        gap: 5px;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 11.5px;
        font-weight: 600;
    }
</style>
@endsection

@section('content')
{{-- Header row --}}
<div class="card-header-actions mb-4 d-flex align-items-center justify-content-between">
    <div>
        <div style="font-size: 18px; font-weight: 800; color: #004F3B;">Kelola Kategori</div>
        <div style="font-size: 14px; color: #6B7280; margin-top: 4px;">Kelola kategori untuk Berita, Program Kesehatan, Regulasi, dan Laporan.</div>
    </div>
    <button class="btn btn-success" data-toggle="modal" data-target="#modalTambahKategori">
        <span class="material-icons" style="font-size:17px;">add</span> Tambah Kategori
    </button>
</div>

{{-- Type tabs --}}
@php $activeType = request('type', 'berita'); @endphp
<div style="border-bottom: 1px solid var(--border-subtle); margin-bottom: 0;">
    <div class="d-flex align-items-end" style="gap: 4px;">
        @foreach($types as $key => $label)
        <a href="{{ route('admin.kategori.index', ['type' => $key]) }}"
           class="type-tab {{ $activeType === $key ? 'active' : '' }}">
            @if($key === 'berita') <span class="material-icons" style="font-size:15px;">newspaper</span>
            @elseif($key === 'program') <span class="material-icons" style="font-size:15px;">health_and_safety</span>
            @elseif($key === 'regulasi') <span class="material-icons" style="font-size:15px;">gavel</span>
            @else <span class="material-icons" style="font-size:15px;">description</span>
            @endif
            {{ $label }}
            <span style="background:var(--border-subtle);color:var(--text-secondary);padding:2px 7px;border-radius:12px;font-size:11px;">
                {{ ($kategoris[$key] ?? collect())->count() }}
            </span>
        </a>
        @endforeach
    </div>
</div>

{{-- Table card --}}
<div class="card" style="border-radius: 0 8px 8px 8px !important;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th style="width: 40px;">#</th>
                        <th>Nama Kategori</th>
                        <th>Warna Badge</th>
                        <th>Preview Badge</th>
                        <th class="text-center" style="width: 100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(($kategoris[$activeType] ?? collect()) as $i => $kat)
                    <tr>
                        <td class="text-muted" style="font-size:13px;">{{ $i + 1 }}</td>
                        <td>
                            <span style="font-weight:600;color:var(--text-primary);">{{ $kat->nama }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2" style="gap: 8px;">
                                <span class="color-dot" style="background: {{ $kat->warna }};"></span>
                                <code style="font-size:12px;color:var(--text-secondary);">{{ $kat->warna }}</code>
                            </div>
                        </td>
                        <td>
                            <span class="badge-preview" style="background: {{ $kat->warna }}20; color: {{ $kat->warna }};">
                                <span class="color-dot" style="background: {{ $kat->warna }};"></span>
                                {{ $kat->nama }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="btn-action-group">
                                <button class="btn-action btn-action-edit"
                                    title="Edit"
                                    onclick="openEditModal({{ $kat->id }}, '{{ addslashes($kat->nama) }}', '{{ $kat->type }}', '{{ $kat->warna }}')"
                                >
                                    <span class="material-icons" style="font-size:15px;">edit</span>
                                </button>
                                <form action="{{ route('admin.kategori.destroy', $kat->id) }}" method="POST" id="del-kat-{{ $kat->id }}" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn-action btn-action-delete" title="Hapus"
                                        onclick="confirmDelete('del-kat-{{ $kat->id }}')">
                                        <span class="material-icons" style="font-size:15px;">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <span class="material-icons" style="font-size:40px;color:#D1D5DB;display:block;margin-bottom:8px;">folder_open</span>
                            <span style="color:var(--text-secondary);font-size:13.5px;">Belum ada kategori untuk tipe ini.</span>
                            <div class="mt-3">
                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalTambahKategori">
                                    <span class="material-icons" style="font-size:14px;">add</span> Tambah Sekarang
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
        <div class="modal-content">
            <form action="{{ route('admin.kategori.store') }}" method="POST">
                @csrf
                <div class="modal-header" style="background: var(--sidebar-bg); color: #fff; padding: 16px 24px; border-radius: 8px 8px 0 0;">
                    <h5 class="modal-title" style="font-size:15px;font-weight:700;color:#fff;margin:0;">
                        <span class="material-icons" style="font-size:18px;vertical-align:middle;margin-right:6px;">add_circle</span>
                        Tambah Kategori Baru
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" style="color:#fff;opacity:0.7;">
                        <span class="material-icons">close</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 24px;">
                    <div class="form-group">
                        <label for="add_nama">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" name="nama" id="add_nama" class="form-control" placeholder="Contoh: Gizi & Stunting" required>
                    </div>
                    <div class="form-group">
                        <label for="add_type">Jenis Konten <span class="text-danger">*</span></label>
                        <select name="type" id="add_type" class="form-control" required>
                            @foreach($types as $key => $label)
                            <option value="{{ $key }}" {{ $activeType === $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-0">
                        <label for="add_warna">Warna Badge <span class="text-danger">*</span></label>
                        <div class="d-flex align-items-center" style="gap: 12px;">
                            <input type="color" name="warna" id="add_warna" value="#009966"
                                class="form-control" style="width:56px;height:42px;padding:2px;cursor:pointer;"
                                onchange="updateAddPreview(this.value)">
                            <div id="add-preview" class="badge-preview" style="background: #009966; color: #fff;">
                                <span>Pratinjau</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding: 16px 24px;">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">
                        <span class="material-icons" style="font-size:16px;">save</span> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Edit --}}
<div class="modal fade" id="modalEditKategori" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 480px;">
        <div class="modal-content">
            <form id="formEditKategori" method="POST">
                @csrf @method('PUT')
                <div class="modal-header" style="background: var(--sidebar-bg); color: #fff; padding: 16px 24px; border-radius: 8px 8px 0 0;">
                    <h5 class="modal-title" style="font-size:15px;font-weight:700;color:#fff;margin:0;">
                        <span class="material-icons" style="font-size:18px;vertical-align:middle;margin-right:6px;">edit</span>
                        Edit Kategori
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" style="color:#fff;opacity:0.7;">
                        <span class="material-icons">close</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 24px;">
                    <div class="form-group">
                        <label for="edit_nama">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" name="nama" id="edit_nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_type">Jenis Konten <span class="text-danger">*</span></label>
                        <select name="type" id="edit_type" class="form-control" required>
                            @foreach($types as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-0">
                        <label for="edit_warna">Warna Badge <span class="text-danger">*</span></label>
                        <div class="d-flex align-items-center" style="gap: 12px;">
                            <input type="color" name="warna" id="edit_warna" value="#009966"
                                class="form-control" style="width:56px;height:42px;padding:2px;cursor:pointer;"
                                onchange="updateEditPreview(this.value)">
                            <div id="edit-preview" class="badge-preview" style="background: #009966; color: #fff;">
                                <span>Pratinjau</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding: 16px 24px;">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">
                        <span class="material-icons" style="font-size:16px;">save</span> Simpan Perubahan
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
document.getElementById('add_warna').dispatchEvent(new Event('change'));
</script>
@endsection
