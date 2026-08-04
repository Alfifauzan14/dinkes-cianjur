@extends('admin.layouts.admin')
@section('title', 'Tulis Berita Baru')
@section('header_title', 'Tulis Berita Baru')

@section('content')
<div class="card card-outline card-success">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span class="font-weight-bold text-muted" style="font-size:13px;">
            <span class="material-icons text-success" style="font-size:16px;vertical-align:middle;">create</span>
            Formulir Penulisan Berita
        </span>
        <a href="{{ route('admin.berita.index') }}" class="btn btn-sm btn-outline-secondary">
            <span class="material-icons" style="font-size:15px;vertical-align:middle;">arrow_back</span> Kembali
        </a>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                {{-- Kolom Kiri: Konten --}}
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="title">Judul Berita <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}"
                            class="form-control @error('title') is-invalid @enderror"
                            placeholder="Masukkan judul berita utama..." required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content">Isi Berita Lengkap <span class="text-danger">*</span></label>
                        <textarea name="content" id="content" rows="12"
                            class="form-control @error('content') is-invalid @enderror"
                            placeholder="Tulis artikel berita secara detail di sini..." required>{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Kolom Kanan: Meta --}}
                <div class="col-md-4">
                    <div class="card" style="border:1px solid #E5E7EB;">
                        <div class="card-header" style="background:#F9FAFB;padding:10px 14px;">
                            <strong style="font-size:13px;">Pengaturan Berita</strong>
                        </div>
                        <div class="card-body" style="padding:14px;">
                            <div class="form-group">
                                <label for="category">Kategori <span class="text-danger">*</span></label>
                                <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" required>
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    <option value="Kesehatan"  {{ old('category') == 'Kesehatan'  ? 'selected' : '' }}>Kesehatan</option>
                                    <option value="Kegiatan"   {{ old('category') == 'Kegiatan'   ? 'selected' : '' }}>Kegiatan</option>
                                    <option value="Pengumuman" {{ old('category') == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                                </select>
                                @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label for="status">Status Publikasi</label>
                                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                    <option value="published" {{ old('status', 'published') == 'published' ? 'selected' : '' }}>Diterbitkan</option>
                                    <option value="draft"     {{ old('status') == 'draft' ? 'selected' : '' }}>Draf (Sembunyikan)</option>
                                </select>
                                @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group mb-0">
                                <label for="image">Gambar Utama</label>
                                <input type="file" name="image" id="image" accept="image/*"
                                    class="form-control @error('image') is-invalid @enderror"
                                    onchange="previewImage(event)">
                                <small class="text-muted">JPG, PNG, WebP. Maks: 2MB.</small>
                                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                <div id="preview-container" class="mt-2" style="display:none;">
                                    <img id="image-view" src="#" alt="Preview"
                                        style="width:100%;height:140px;object-fit:cover;border-radius:3px;border:1px solid #E5E7EB;">
                                    <small class="text-muted">Preview gambar</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column mt-3" style="gap:8px;">
                        <button type="submit" class="btn btn-success btn-block">
                            <span class="material-icons" style="font-size:16px;vertical-align:middle;">publish</span> Terbitkan Berita
                        </button>
                        <a href="{{ route('admin.berita.index') }}" class="btn btn-outline-secondary btn-block">Batal</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function() {
        document.getElementById('image-view').src = reader.result;
        document.getElementById('preview-container').style.display = 'block';
    };
    if (event.target.files[0]) reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection
