@extends('admin.layouts.admin')
@section('title', 'Ubah Berita')
@section('header_title', 'Edit Artikel Berita')

@section('content')
<div class="card card-outline card-success">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between" style="gap: 12px;">
        <span class="d-flex align-items-center" style="gap: 8px;">
            <span class="material-icons text-success" style="font-size:20px;">edit_note</span>
            <span class="font-weight-bold card-title-label">Edit Artikel Berita: <em class="text-muted font-weight-normal">{{ Str::limit($berita->title, 45) }}</em></span>
        </span>
        <a href="{{ route('admin.berita.index') }}" class="btn btn-sm btn-outline-secondary ml-auto">
            <span class="material-icons" style="font-size:16px;">arrow_back</span> Kembali
        </a>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                {{-- Kolom Kiri: Konten --}}
                <div class="col-lg-8 col-12">
                    <div class="form-group">
                        <label for="title">Judul Berita <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" value="{{ old('title', $berita->title) }}"
                            class="form-control @error('title') is-invalid @enderror"
                            placeholder="Masukkan judul berita utama..." required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="content">Isi Berita Lengkap <span class="text-danger">*</span></label>
                        <textarea name="content" id="content" rows="14"
                            class="form-control @error('content') is-invalid @enderror"
                            placeholder="Tulis artikel berita secara detail..." required>{{ old('content', $berita->content) }}</textarea>
                        @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Kolom Kanan: Meta --}}
                <div class="col-lg-4 col-12">
                    <div class="card" style="border: 1px solid #E2E8F0; border-radius: 8px;">
                        <div class="card-header" style="background:#F8FAFC; padding: 12px 16px; border-bottom: 1px solid #E2E8F0;">
                            <strong style="font-size: 13.5px; color: #1E293B;">Pengaturan Berita</strong>
                        </div>
                        <div class="card-body" style="padding: 16px;">
                            <div class="form-group">
                                <label for="category">Kategori <span class="text-danger">*</span></label>
                                <select name="category" id="category" class="custom-select @error('category') is-invalid @enderror" required>
                                    @foreach($kategoris as $kat)
                                        <option value="{{ $kat->nama }}" {{ old('category', $berita->category) == $kat->nama ? 'selected' : '' }}>{{ $kat->nama }}</option>
                                    @endforeach
                                </select>
                                <div class="mt-2">
                                    <a href="{{ route('admin.kategori.index') }}" class="btn btn-sm btn-outline-success">
                                        <span class="material-icons" style="font-size:14px;">tune</span> Kelola Kategori
                                    </a>
                                </div>
                                @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label for="status">Status Publikasi</label>
                                <select name="status" id="status" class="custom-select @error('status') is-invalid @enderror" required>
                                    <option value="published" {{ old('status', $berita->status) == 'published' ? 'selected' : '' }}>Diterbitkan</option>
                                    <option value="draft"     {{ old('status', $berita->status) == 'draft'     ? 'selected' : '' }}>Draf (Sembunyikan)</option>
                                </select>
                                @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group mb-0">
                                <label for="image">Ganti Gambar <span class="text-muted" style="font-weight:400;">(opsional)</span></label>
                                <input type="file" name="image" id="image" accept="image/*"
                                    class="form-control-file @error('image') is-invalid @enderror"
                                    onchange="previewImage(event)">
                                <small class="text-muted d-block mt-1">Kosongkan jika tidak ingin mengubah gambar.</small>
                                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror

                                {{-- Gambar saat ini --}}
                                <div class="mt-3" id="current-image">
                                    @if($berita->image)
                                        <img src="{{ asset('uploads/berita/' . $berita->image) }}" alt="Gambar saat ini"
                                            style="width:100%; height:130px; object-fit:cover; border-radius:4px; border:1px solid #CBD5E1;">
                                        <small class="text-muted d-block mt-1">Gambar aktif saat ini</small>
                                    @else
                                        <div style="width:100%; height:80px; background:#F8FAFC; display:flex; align-items:center; justify-content:center; border-radius:4px; border:1px dashed #CBD5E1;">
                                            <span class="material-icons text-muted" style="font-size:28px;">image</span>
                                        </div>
                                        <small class="text-muted d-block mt-1">Belum ada gambar</small>
                                    @endif
                                </div>
                                <div id="preview-container" class="mt-3" style="display:none;">
                                    <img id="image-view" src="#" alt="Preview baru"
                                        style="width:100%; height:130px; object-fit:cover; border-radius:4px; border:1px solid #009966;">
                                    <small class="text-success font-weight-bold d-block mt-1">Gambar baru dipilih</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column mt-3" style="gap: 8px;">
                        <button type="submit" class="btn btn-success btn-block font-weight-bold">
                            <span class="material-icons" style="font-size:16px;">save</span> Simpan Perubahan
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
