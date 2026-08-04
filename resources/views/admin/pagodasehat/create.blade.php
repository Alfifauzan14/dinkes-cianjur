@extends('admin.layouts.admin')

@section('title', 'Tambah Kartu Pagoda Sehat')
@section('header_title', 'Tambah Kartu Pagoda Sehat')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/pagodasehat.css') }}?v={{ time() }}">
@endsection

@section('content')
<div class="berita-admin-wrapper">
    <div class="admin-card">
        <form action="{{ route('admin.pagodasehat.store') }}" method="POST" enctype="multipart/form-data" class="admin-form">
            @csrf

            <div class="form-group">
                <label for="title">Judul Kartu</label>
                <input
                    type="text"
                    name="title"
                    id="title"
                    value="{{ old('title') }}"
                    class="form-control-input"
                    placeholder="Contoh: Dinas Kesehatan"
                    required
                >
                @error('title')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea
                    name="description"
                    id="description"
                    class="form-textarea"
                    placeholder="Contoh: Visi misi, struktur organisasi, dan kontak resmi Dinas Kesehatan Cianjur."
                >{{ old('description') }}</textarea>
                @error('description')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Gambar Kartu</label>
                <input
                    type="file"
                    name="image"
                    id="image"
                    accept="image/png,image/jpeg,image/svg+xml"
                    class="form-control-input"
                    style="padding: 8px;"
                    required
                >
                <span style="font-size: 12px; color: #94A3B8; margin-top: 4px;">Format: PNG, JPG, SVG. Maks 2MB.</span>
                @error('image')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="url">Link Tujuan <span style="font-weight: 400; font-size: 12px; color: #94A3B8;">(Opsional)</span></label>
                <input
                    type="url"
                    name="url"
                    id="url"
                    value="{{ old('url') }}"
                    class="form-control-input"
                    placeholder="Contoh: /profil"
                >
                @error('url')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions" style="display: flex; gap: 10px; margin-top: 10px;">
                <button type="submit" class="btn-admin btn-admin-primary">
                    <span class="material-icons">save</span>
                    Simpan Kartu
                </button>
                <a href="{{ route('admin.pagodasehat.index') }}" class="btn-admin btn-admin-secondary">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
