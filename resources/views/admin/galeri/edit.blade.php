@extends('admin.layouts.admin')

@section('title', 'Edit Foto Galeri')
@section('header_title', 'Edit Foto Galeri')

@section('content')


<div class="card card-outline card-success">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span class="font-weight-bold text-muted" style="font-size:13px;">
            <span class="material-icons text-warning" style="font-size:16px;vertical-align:middle;">edit</span>
            Formulir Edit Foto Galeri
        </span>
        <a href="{{ route('admin.galeri.index') }}" class="btn btn-sm btn-outline-secondary">
            <span class="material-icons" style="font-size:15px;vertical-align:middle;">arrow_back</span> Kembali
        </a>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Judul Foto / Kegiatan <span class="text-danger">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $galeri->title) }}"
                    class="form-control @error('title') is-invalid @enderror"
                    placeholder="Masukkan judul foto atau nama kegiatan..." required>
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="category">Kategori <span class="text-danger">*</span></label>
                <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" style="max-width: 300px;" required>
                    <option value="PROGRAM" {{ old('category', $galeri->category) == 'PROGRAM' ? 'selected' : '' }}>PROGRAM</option>
                    <option value="KEGIATAN" {{ old('category', $galeri->category) == 'KEGIATAN' ? 'selected' : '' }}>KEGIATAN</option>
                    <option value="NASIONAL" {{ old('category', $galeri->category) == 'NASIONAL' ? 'selected' : '' }}>NASIONAL</option>
                </select>
                @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>Gambar Saat Ini</label>
                <div>
                    @if(file_exists(public_path('uploads/galeri/' . $galeri->image)))
                        <img src="{{ asset('uploads/galeri/' . $galeri->image) }}" alt="Preview" style="max-width: 260px; border-radius: 6px; border: 1px solid #E5E7EB;">
                    @else
                        <img src="{{ asset('images/' . $galeri->image) }}" alt="Preview" style="max-width: 260px; border-radius: 6px; border: 1px solid #E5E7EB;">
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="image">Pilih Gambar Baru (Opsional)</label>
                <input type="file" name="image" id="image" accept="image/*"
                    class="form-control @error('image') is-invalid @enderror" style="max-width: 450px;">
                <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah gambar. Maksimal: 2MB.</small>
                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex align-items-center justify-content-end" style="gap:10px; border-top: 1px solid #F3F4F6; padding-top: 20px; margin-top: 24px;">
                <a href="{{ route('admin.galeri.index') }}" class="btn btn-outline-secondary">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">close</span> Batal
                </a>
                <button type="submit" class="btn btn-success-dark">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">save</span> Perbarui Foto
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
