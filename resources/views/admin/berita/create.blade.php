@extends('admin.layouts.admin')
@section('title', 'Tulis Berita Baru')
@section('header_title', 'Tulis Berita Baru')

@section('content')
<div class="card card-outline card-success">
    <div class="card-header d-flex align-items-center" style="padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
        <span class="font-weight-bold text-muted" style="font-size:13px;">
            <span class="material-icons text-success" style="font-size:16px; vertical-align:middle;">create</span>
            Formulir Penulisan Berita
        </span>
        <a href="{{ route('admin.berita.index') }}" class="btn btn-sm btn-outline-secondary ml-auto">
            <span class="material-icons" style="font-size:15px; vertical-align:middle;">arrow_back</span> Kembali
        </a>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Baris Pengaturan (di atas Judul) --}}
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="category">Kategori <span class="text-danger">*</span></label>
                        <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" required>
                            <option value="" disabled selected>Pilih Kategori</option>
                            @foreach($kategoris as $kat)
                            <option value="{{ $kat->nama }}" {{ old('category') == $kat->nama ? 'selected' : '' }}>{{ $kat->nama }}</option>
                            @endforeach
                        </select>
                        <div class="mt-1">
                            <a href="{{ route('admin.kategori.index') }}" class="btn btn-sm btn-outline-success">
                                <span class="material-icons" style="font-size:14px;vertical-align:middle;">tune</span> Kelola Kategori
                            </a>
                        </div>
                        @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="status">Status Publikasi</label>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                            <option value="published" {{ old('status', 'published') == 'published' ? 'selected' : '' }}>Diterbitkan</option>
                            <option value="draft"     {{ old('status') == 'draft' ? 'selected' : '' }}>Draf (Sembunyikan)</option>
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="image">Gambar Utama</label>
                        <input type="file" name="image" id="image" accept="image/*"
                            class="form-control @error('image') is-invalid @enderror"
                            onchange="previewImage(event)">
                        <small class="text-muted">JPG, PNG, WebP. Maks: 2MB.</small>
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            {{-- Preview Gambar --}}
            <div id="preview-container" class="mb-3" style="display:none;">
                <img id="image-view" src="#" alt="Preview"
                    style="max-height:200px; object-fit:cover; border-radius:4px; border:1px solid #E5E7EB;">
                <div><small class="text-muted">Preview gambar</small></div>
            </div>

            {{-- Judul --}}
            <div class="form-group">
                <label for="title">Judul Berita <span class="text-danger">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                    class="form-control @error('title') is-invalid @enderror"
                    placeholder="Masukkan judul berita utama..." required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Isi Berita --}}
            <div class="form-group">
                <label for="content">Isi Berita Lengkap <span class="text-danger">*</span></label>
                <textarea name="content" id="content" rows="14"
                    class="form-control @error('content') is-invalid @enderror"
                    placeholder="Tulis artikel berita secara detail di sini..." required>{{ old('content') }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tombol Aksi --}}
            <div class="d-flex align-items-center" style="gap:10px; margin-top: 8px;">
                <button type="submit" class="btn btn-success px-4">
                    <span class="material-icons" style="font-size:16px; vertical-align:middle;">publish</span>
                    Terbitkan Berita
                </button>
                <a href="{{ route('admin.berita.index') }}" class="btn btn-outline-secondary">Batal</a>
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
