@extends('admin.layouts.admin')
@section('title', 'Ubah Berita')
@section('header_title', 'Edit Artikel Berita')

@section('content')
<div class="card card-outline card-success">
    <div class="card-header d-flex align-items-center" style="padding: 12px 24px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
        <span class="font-weight-bold text-muted" style="font-size:13px;">
            Mengedit: <em>{{ Str::limit($berita->title, 50) }}</em>
        </span>
        <a href="{{ route('admin.berita.index') }}" class="btn btn-sm btn-outline-secondary ml-auto">
            <span class="material-icons" style="font-size:15px; vertical-align:middle;">arrow_back</span> Kembali
        </a>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                {{-- Kolom Kiri: Konten --}}
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="title">Judul Berita <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" value="{{ old('title', $berita->title) }}"
                            class="form-control @error('title') is-invalid @enderror"
                            placeholder="Masukkan judul berita utama..." required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="content">Isi Berita Lengkap <span class="text-danger">*</span></label>
                        <textarea name="content" id="content" rows="12"
                            class="form-control @error('content') is-invalid @enderror"
                            placeholder="Tulis artikel berita secara detail..." required>{{ old('content', $berita->content) }}</textarea>
                        @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                                    <option value="Kesehatan"  {{ old('category', $berita->category) == 'Kesehatan'  ? 'selected' : '' }}>Kesehatan</option>
                                    <option value="Kegiatan"   {{ old('category', $berita->category) == 'Kegiatan'   ? 'selected' : '' }}>Kegiatan</option>
                                    <option value="Pengumuman" {{ old('category', $berita->category) == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                                </select>
                                @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label for="status">Status Publikasi</label>
                                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                    <option value="published" {{ old('status', $berita->status) == 'published' ? 'selected' : '' }}>Diterbitkan</option>
                                    <option value="draft"     {{ old('status', $berita->status) == 'draft'     ? 'selected' : '' }}>Draf (Sembunyikan)</option>
                                </select>
                                @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group mb-0">
                                <label for="image">Ganti Gambar <span class="text-muted" style="font-weight:400;">(opsional)</span></label>
                                <input type="file" name="image" id="image" accept="image/*"
                                    class="form-control @error('image') is-invalid @enderror"
                                    onchange="previewImage(event)">
                                <small class="text-muted">Kosongkan jika tidak diganti.</small>
                                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror

                                {{-- Gambar saat ini --}}
                                <div class="mt-2" id="current-image">
                                    @if($berita->image)
                                        <img src="{{ asset('uploads/berita/' . $berita->image) }}" alt="Gambar saat ini"
                                            style="width:100%;height:120px;object-fit:cover;border-radius:3px;border:1px solid #E5E7EB;">
                                        <small class="text-muted">Gambar aktif saat ini</small>
                                    @else
                                        <div style="width:100%;height:80px;background:#F9FAFB;display:flex;align-items:center;justify-content:center;border-radius:3px;border:1px dashed #D1D5DB;">
                                            <span class="material-icons text-muted" style="font-size:28px;">image</span>
                                        </div>
                                        <small class="text-muted">Belum ada gambar</small>
                                    @endif
                                </div>
                                <div id="preview-container" class="mt-2" style="display:none;">
                                    <img id="image-view" src="#" alt="Preview baru"
                                        style="width:100%;height:120px;object-fit:cover;border-radius:3px;border:1px solid #5EE9B5;">
                                    <small class="text-success font-weight-bold">Gambar baru dipilih</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column mt-3" style="gap:8px;">
                        <button type="submit" class="btn btn-success btn-block font-weight-bold">
                            <span class="material-icons" style="font-size:16px;vertical-align:middle;">save</span> Simpan Perubahan
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
        document.getElementById('current-image').style.opacity = '0.4';
    };
    if (event.target.files[0]) reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection
