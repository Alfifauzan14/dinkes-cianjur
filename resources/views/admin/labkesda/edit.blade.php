@extends('admin.layouts.admin')

@section('title', 'Edit Layanan Labkesda')
@section('header_title', 'Edit Layanan Labkesda')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/labkesda.css') }}?v={{ time() }}">
@endsection

@section('content')
<div class="berita-admin-wrapper">
    <div class="admin-card">
        <form action="{{ route('admin.labkesda.update', $labkesda->id) }}" method="POST" class="admin-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Judul Layanan</label>
                <input
                    type="text"
                    name="title"
                    id="title"
                    value="{{ old('title', $labkesda->title) }}"
                    class="form-control-input"
                    placeholder="Contoh: Laboratorium Klinik Medik"
                    required
                >
                @error('title')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Deskripsi Layanan</label>
                <textarea
                    name="description"
                    id="description"
                    class="form-textarea"
                    placeholder="Contoh: Pemeriksaan sampel klinis darah, urin, dan mikrobiologi (DAHU/Indikator)."
                >{{ old('description', $labkesda->description) }}</textarea>
                @error('description')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="badge_text">Teks Badge <span style="font-weight: 400; font-size: 12px; color: #94A3B8;">(Opsional)</span></label>
                <input
                    type="text"
                    name="badge_text"
                    id="badge_text"
                    value="{{ old('badge_text', $labkesda->badge_text) }}"
                    class="form-control-input"
                    placeholder="Contoh: Hasil 1-3 Hari"
                >
                @error('badge_text')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <hr class="form-section-divider">

            <div class="form-group">
                <label>Pilih Icon Layanan</label>
                <div class="icon-picker-grid">
                    @foreach($icons as $icon)
                        <label class="icon-picker-item {{ old('icon_name', $labkesda->icon_name) == $icon ? 'selected' : '' }}">
                            <input type="radio" name="icon_name" value="{{ $icon }}" {{ old('icon_name', $labkesda->icon_name) == $icon ? 'checked' : '' }} required>
                            <div class="icon-circle">
                                <span class="material-icons">{{ $icon }}</span>
                            </div>
                            <span class="icon-label">{{ ucwords(str_replace('_', ' ', $icon)) }}</span>
                        </label>
                    @endforeach
                </div>
                @error('icon_name')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <hr class="form-section-divider">

            <div class="form-group">
                <label>Daftar Item / Fitur Layanan</label>
                <div class="repeater-group" id="items-container">
                    @forelse($labkesda->items as $item)
                        <div class="repeater-row">
                            <input type="text" name="items[]" class="form-control-input" value="{{ $item->item_name }}" placeholder="Masukkan item layanan...">
                            <button type="button" class="btn-remove-row remove-item" title="Hapus item">
                                <span class="material-icons">close</span>
                            </button>
                        </div>
                    @empty
                        <div class="repeater-row">
                            <input type="text" name="items[]" class="form-control-input" placeholder="Contoh: Uji Fungsi Hati dan Fungsi Ginjal">
                            <button type="button" class="btn-remove-row remove-item" title="Hapus item">
                                <span class="material-icons">close</span>
                            </button>
                        </div>
                    @endforelse
                </div>
                <div>
                    <button type="button" id="add-item" class="btn-add-row">
                        <span class="material-icons">add</span>
                        <span>Tambah Item</span>
                    </button>
                </div>
            </div>

            <hr class="form-section-divider">

            <div class="form-group">
                <label for="button_text">Teks Tombol <span style="font-weight: 400; font-size: 12px; color: #94A3B8;">(Opsional)</span></label>
                <input
                    type="text"
                    name="button_text"
                    id="button_text"
                    value="{{ old('button_text', $labkesda->button_text) }}"
                    class="form-control-input"
                    placeholder="Contoh: Lihat Tarif & Pemeriksaan Test"
                >
                @error('button_text')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="button_url">Link Tombol <span style="font-weight: 400; font-size: 12px; color: #94A3B8;">(Opsional)</span></label>
                <input
                    type="url"
                    name="button_url"
                    id="button_url"
                    value="{{ old('button_url', $labkesda->button_url) }}"
                    class="form-control-input"
                    placeholder="Contoh: https://labkesda.cianjurkab.go.id"
                >
                @error('button_url')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions" style="display: flex; gap: 10px; margin-top: 10px;">
                <button type="submit" class="btn-admin btn-admin-primary">
                    <span class="material-icons">save</span>
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.labkesda.index') }}" class="btn-admin btn-admin-secondary">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('add-item').addEventListener('click', function () {
        const container = document.getElementById('items-container');
        const row = document.createElement('div');
        row.className = 'repeater-row';
        row.innerHTML = '<input type="text" name="items[]" class="form-control-input" placeholder="Contoh: Uji Fungsi Hati dan Fungsi Ginjal">'
            + '<button type="button" class="btn-remove-row remove-item" title="Hapus item"><span class="material-icons">close</span></button>';
        container.appendChild(row);
        row.querySelector('.form-control-input').focus();
    });

    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.remove-item');
        if (btn) {
            const row = btn.closest('.repeater-row');
            const container = document.getElementById('items-container');
            if (container.querySelectorAll('.repeater-row').length > 1) {
                row.remove();
            } else {
                row.querySelector('.form-control-input').value = '';
            }
        }
    });

    document.querySelectorAll('.icon-picker-item input[type="radio"]').forEach(function (radio) {
        radio.addEventListener('change', function () {
            document.querySelectorAll('.icon-picker-item').forEach(function (item) {
                item.classList.remove('selected');
            });
            this.closest('.icon-picker-item').classList.add('selected');
        });
    });
</script>
@endsection
