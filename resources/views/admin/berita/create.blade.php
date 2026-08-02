@extends('admin.layouts.admin')

@section('title', 'Tulis Berita Baru')
@section('header_title', 'Tambah Berita Baru')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/berita.css') }}?v={{ time() }}">
@endsection

@section('content')
<div class="berita-admin-wrapper">
    <div class="admin-card">
        
        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="admin-form">
            @csrf

            <!-- Judul Berita -->
            <div class="form-group">
                <label for="title">Judul Berita</label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    value="{{ old('title') }}" 
                    class="form-control-input" 
                    placeholder="Masukkan judul berita utama..."
                    required
                >
                @error('title')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Kategori Berita -->
            <div class="form-group">
                <label for="category">Kategori Berita</label>
                <select name="category" id="category" class="form-control-select" required>
                    <option value="" disabled selected>Pilih Kategori</option>
                    <option value="Kesehatan" {{ old('category') == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                    <option value="Kegiatan" {{ old('category') == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                    <option value="Pengumuman" {{ old('category') == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                </select>
                @error('category')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Konten Berita -->
            <div class="form-group">
                <label for="content">Isi Berita Lengkap</label>
                <textarea 
                    name="content" 
                    id="content" 
                    class="form-textarea" 
                    placeholder="Tulis artikel berita secara detail di sini..."
                    required
                >{{ old('content') }}</textarea>
                @error('content')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Gambar Utama -->
            <div class="form-group">
                <label for="image">Gambar Utama</label>
                <input 
                    type="file" 
                    name="image" 
                    id="image" 
                    class="form-control-input" 
                    style="padding-top: 8px;"
                    accept="image/*"
                    onchange="previewImage(event)"
                >
                <div id="preview-container" class="image-preview-wrapper" style="display: none;">
                    <img id="image-view" class="image-preview" src="#" alt="Preview Gambar">
                    <span style="font-size: 13px; color: #9CA3AF;">Preview unggahan gambar baru</span>
                </div>
                @error('image')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Status Publikasi -->
            <div class="form-group">
                <label for="status">Status Publikasi</label>
                <select name="status" id="status" class="form-control-select" required>
                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Diterbitkan (Tampil di Landing Page)</option>
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draf (Sembunyikan)</option>
                </select>
                @error('status')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tombol Aksi -->
            <div style="display: flex; gap: 16px; margin-top: 12px;">
                <button type="submit" class="btn-admin btn-admin-primary">
                    <span class="material-icons">save</span>
                    <span>Terbitkan Berita</span>
                </button>
                <a href="{{ route('admin.berita.index') }}" class="btn-admin btn-admin-secondary">
                    <span>Batal</span>
                </a>
            </div>

        </form>

    </div>
</div>
@endsection

@section('scripts')
<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('image-view');
            output.src = reader.result;
            document.getElementById('preview-container').style.display = 'flex';
        };
        if (event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }
</script>
@endsection
