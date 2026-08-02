@extends('admin.layouts.admin')

@section('title', 'Tambah Foto Galeri')
@section('header_title', 'Tambah Foto Galeri Baru')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/galeri.css') }}?v={{ time() }}">
@endsection

@section('content')
<div class="agenda-admin-wrapper">
    <div class="admin-card">
        
        <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data" class="admin-form">
            @csrf

            <!-- Judul Galeri -->
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="title" style="font-weight: 700; display: block; margin-bottom: 8px;">Judul Foto / Kegiatan</label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    value="{{ old('title') }}" 
                    class="form-control-input" 
                    style="width: 100%;"
                    placeholder="Masukkan judul foto atau nama kegiatan..."
                    required
                >
                @error('title')
                    <span class="field-error" style="color: #EF4444; font-size: 13px; display: block; margin-top: 4px;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Kategori -->
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="category" style="font-weight: 700; display: block; margin-bottom: 8px;">Kategori</label>
                <select name="category" id="category" class="form-control-select" style="width: 100%; max-width: 300px;" required>
                    <option value="PROGRAM" {{ old('category') == 'PROGRAM' ? 'selected' : '' }}>PROGRAM</option>
                    <option value="KEGIATAN" {{ old('category') == 'KEGIATAN' ? 'selected' : '' }}>KEGIATAN</option>
                    <option value="NASIONAL" {{ old('category') == 'NASIONAL' ? 'selected' : '' }}>NASIONAL</option>
                </select>
                @error('category')
                    <span class="field-error" style="color: #EF4444; font-size: 13px; display: block; margin-top: 4px;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Unggah Gambar -->
            <div class="form-group" style="margin-bottom: 24px;">
                <label for="image" style="font-weight: 700; display: block; margin-bottom: 8px;">Pilih Gambar / Foto</label>
                <input 
                    type="file" 
                    name="image" 
                    id="image" 
                    accept="image/*"
                    class="form-control-input" 
                    style="padding: 8px 12px; border: 1px solid #D1D5DB; border-radius: 3px; width: 100%; max-width: 450px;" 
                    required
                >
                <small style="display: block; color: #6B7280; margin-top: 6px; font-size: 12px;">Format yang didukung: JPEG, PNG, JPG, WebP. Maksimal: 2MB.</small>
                @error('image')
                    <span class="field-error" style="color: #EF4444; font-size: 13px; display: block; margin-top: 4px;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Aksi Form -->
            <div class="form-actions" style="display: flex; gap: 12px; border-top: 1px solid #F3F4F6; padding-top: 20px; margin-top: 24px;">
                <a href="{{ route('admin.galeri.index') }}" class="btn-admin btn-admin-secondary">
                    <span>Batal</span>
                </a>
                <button type="submit" class="btn-admin btn-admin-primary">
                    <span class="material-icons">save</span>
                    <span>Simpan Foto</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
