@extends('admin.layouts.admin')

@section('title', 'Edit Layanan Labkesda')
@section('header_title', 'Edit Layanan Labkesda')

@section('styles')
<style>
    .icon-picker-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
        gap: 12px;
        max-height: 260px;
        overflow-y: auto;
        padding: 12px;
        border: 1px solid #E2E8F0;
        border-radius: 8px;
        background: #F8FAFC;
    }
    .icon-picker-item {
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 6px !important;
        padding: 12px 8px;
        border: 2px solid #E2E8F0;
        border-radius: 8px;
        cursor: pointer;
        background: #FFFFFF;
        text-align: center;
        min-height: 80px;
        transition: all 0.15s ease-in-out;
        margin-bottom: 0 !important;
    }
    .icon-picker-item:hover {
        border-color: #009966;
        background: #F0FDF4;
    }
    .icon-picker-item.selected,
    .icon-picker-item:has(input:checked) {
        border-color: #009966 !important;
        background-color: #E6F7F0 !important;
        box-shadow: 0 0 0 2px rgba(0, 153, 102, 0.15) !important;
    }
    .icon-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #E6F7F0;
        color: #009966;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .icon-label {
        font-size: 11px;
        font-weight: 600;
        color: #475569;
    }
    .repeater-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    .repeater-row {
        display: flex;
        gap: 8px;
        align-items: center;
    }
    .btn-remove-row {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border: 1px solid #E2E8F0;
        border-radius: 4px;
        background: #FFFFFF;
        color: #DC2626;
        cursor: pointer;
        flex-shrink: 0;
    }
    .btn-remove-row:hover {
        background-color: #FEE2E2;
        border-color: #FCA5A5;
    }
    .btn-add-row {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        margin-top: 10px;
        padding: 6px 12px;
        border: 1px dashed #009966;
        border-radius: 4px;
        background: #FFFFFF;
        color: #009966;
        font-weight: 600;
        font-size: 13px;
        cursor: pointer;
    }
    .btn-add-row:hover {
        background-color: #E6F7F0;
    }
</style>
@endsection

@section('content')


<div class="card card-outline card-success">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span class="d-flex align-items-center" style="gap: 8px;">
            <span class="material-icons text-success">science</span>
            <span class="font-weight-bold card-title-label">Edit Layanan Labkesda</span>
        </span>
        <a href="{{ route('admin.labkesda.index') }}" class="btn btn-sm btn-outline-secondary">
            <span class="material-icons" style="font-size:15px;vertical-align:middle;">arrow_back</span> Kembali
        </a>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.labkesda.update', $labkesda->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Judul Layanan <span class="text-danger">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $labkesda->title) }}"
                    class="form-control @error('title') is-invalid @enderror"
                    placeholder="Contoh: Laboratorium Klinik Medik" required>
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="description">Deskripsi Layanan</label>
                <textarea name="description" id="description" rows="3"
                    class="form-control @error('description') is-invalid @enderror"
                    placeholder="Contoh: Pemeriksaan sampel klinis darah, urin, dan mikrobiologi (DAHU/Indikator).">{{ old('description', $labkesda->description) }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="badge_text">Teks Badge <small class="text-muted font-weight-normal">(Opsional)</small></label>
                <input type="text" name="badge_text" id="badge_text" value="{{ old('badge_text', $labkesda->badge_text) }}"
                    class="form-control @error('badge_text') is-invalid @enderror"
                    placeholder="Contoh: Hasil 1-3 Hari">
                @error('badge_text') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <hr class="my-4">

            <div class="form-group">
                <label>Pilih Icon Layanan</label>
                <div class="icon-picker-grid">
                    @foreach($icons as $icon)
                        <label class="icon-picker-item">
                            <input type="radio" name="icon_name" value="{{ $icon }}" {{ old('icon_name', $labkesda->icon_name) == $icon ? 'checked' : '' }} required style="display:none;">
                            <div class="icon-circle">
                                <span class="material-icons">{{ $icon }}</span>
                            </div>
                            <span class="icon-label">{{ ucwords(str_replace('_', ' ', $icon)) }}</span>
                        </label>
                    @endforeach
                </div>
                @error('icon_name') <div class="text-danger" style="font-size:13px;">{{ $message }}</div> @enderror
            </div>

            <hr class="my-4">

            <div class="form-group">
                <label>Daftar Item / Fitur Layanan</label>
                <div class="repeater-group" id="items-container">
                    @forelse($labkesda->items as $item)
                        <div class="repeater-row">
                            <input type="text" name="items[]" class="form-control" value="{{ $item->item_name }}" placeholder="Masukkan item layanan...">
                            <button type="button" class="btn-remove-row remove-item" title="Hapus item">
                                <span class="material-icons" style="font-size:18px;">close</span>
                            </button>
                        </div>
                    @empty
                        <div class="repeater-row">
                            <input type="text" name="items[]" class="form-control" placeholder="Contoh: Uji Fungsi Hati dan Fungsi Ginjal">
                            <button type="button" class="btn-remove-row remove-item" title="Hapus item">
                                <span class="material-icons" style="font-size:18px;">close</span>
                            </button>
                        </div>
                    @endforelse
                </div>
                <div>
                    <button type="button" id="add-item" class="btn-add-row">
                        <span class="material-icons" style="font-size:16px;">add</span>
                        <span>Tambah Item</span>
                    </button>
                </div>
            </div>

            <hr class="my-4">

            <div class="form-group">
                <label for="button_text">Teks Tombol <small class="text-muted font-weight-normal">(Opsional)</small></label>
                <input type="text" name="button_text" id="button_text" value="{{ old('button_text', $labkesda->button_text) }}"
                    class="form-control @error('button_text') is-invalid @enderror"
                    placeholder="Contoh: Lihat Tarif & Pemeriksaan Test">
                @error('button_text') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="button_url">Link Tombol <small class="text-muted font-weight-normal">(Opsional)</small></label>
                <input type="url" name="button_url" id="button_url" value="{{ old('button_url', $labkesda->button_url) }}"
                    class="form-control @error('button_url') is-invalid @enderror"
                    placeholder="Contoh: https://labkesda.cianjurkab.go.id">
                @error('button_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex align-items-center justify-content-end" style="gap:10px;">
                <a href="{{ route('admin.labkesda.index') }}" class="btn btn-outline-secondary">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">close</span> Batal
                </a>
                <button type="submit" class="btn btn-success-dark">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">save</span> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('add-item').addEventListener('click', function () {
        const container = document.getElementById('items-container');
        const row = document.createElement('div');
        row.className = 'repeater-row';
        row.innerHTML = '<input type="text" name="items[]" class="form-control" placeholder="Contoh: Uji Fungsi Hati dan Fungsi Ginjal">'
            + '<button type="button" class="btn-remove-row remove-item" title="Hapus item"><span class="material-icons" style="font-size:18px;">close</span></button>';
        container.appendChild(row);
        row.querySelector('.form-control').focus();
    });

    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.remove-item');
        if (btn) {
            const row = btn.closest('.repeater-row');
            const container = document.getElementById('items-container');
            if (container.querySelectorAll('.repeater-row').length > 1) {
                row.remove();
            } else {
                row.querySelector('.form-control').value = '';
            }
        }
    });
</script>
@endsection
