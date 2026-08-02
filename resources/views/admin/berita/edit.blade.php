@extends('layouts.admin')

@section('title', 'Ubah Berita')
@section('header_title', 'Ubah Artikel Berita')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/berita.css') }}?v={{ time() }}">
@endsection

@section('content')
<div class="berita-admin-wrapper">
    <div class="admin-card">
        
        <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data" class="admin-form">
            @csrf
            @method('PUT')

            <!-- Judul Berita -->
            <div class="form-group">
                <label for="title">Judul Berita</label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    value="{{ old('title', $berita->title) }}" 
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
                    <option value="" disabled>Pilih Kategori</option>
                    <option value="Kesehatan" {{ old('category', $berita->category) == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                    <option value="Kegiatan" {{ old('category', $berita->category) == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                    <option value="Pengumuman" {{ old('category', $berita->category) == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
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
                >{{ old('content', $berita->content) }}</textarea>
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
                
                <!-- Gambar Saat Ini -->
                <div class="image-preview-wrapper" id="old-image-container">
                    @if($berita->image)
                        <img class="image-preview" src="{{ asset('uploads/berita/' . $berita->image) }}" alt="Gambar Saat Ini">
                        <span style="font-size: 13px; color: #9CA3AF;">Gambar aktif saat ini</span>
                    @else
                        <div class="image-preview" style="display: flex; align-items: center; justify-content: center; background-color: #F9FAFB; color: #9CA3AF;">
                            <span class="material-icons" style="font-size: 24px;">image</span>
                        </div>
                        <span style="font-size: 13px; color: #9CA3AF;">Belum ada gambar yang diunggah</span>
                    @endif
                </div>

                <!-- Preview Gambar Baru -->
                <div id="preview-container" class="image-preview-wrapper" style="display: none;">
                    <img id="image-view" class="image-preview" src="#" alt="Preview Gambar Baru">
                    <span style="font-size: 13px; color: #9CA3AF;">Preview gambar baru yang dipilih</span>
                </div>
                
                @error('image')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Status Publikasi -->
            <div class="form-group">
                <label for="status">Status Publikasi</label>
                <select name="status" id="status" class="form-control-select" required>
                    <option value="published" {{ old('status', $berita->status) == 'published' ? 'selected' : '' }}>Diterbitkan (Tampil di Landing Page)</option>
                    <option value="draft" {{ old('status', $berita->status) == 'draft' ? 'selected' : '' }}>Draf (Sembunyikan)</option>
                </select>
                @error('status')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tombol Aksi -->
            <div style="display: flex; gap: 16px; margin-top: 12px;">
                <button type="submit" class="btn-admin btn-admin-primary">
                    <span class="material-icons">save</span>
                    <span>Simpan Perubahan</span>
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
            
            // Sembunyikan container gambar lama agar tidak membingungkan
            const oldContainer = document.getElementById('old-image-container');
            if (oldContainer) {
                oldContainer.style.opacity = '0.5';
            }
        };
        if (event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }
</script>
@endsection
