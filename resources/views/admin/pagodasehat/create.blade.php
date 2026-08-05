@extends('admin.layouts.admin')

@section('title', 'Tambah Kartu Pagoda Sehat')
@section('header_title', 'Tambah Kartu Pagoda Sehat')

@section('content')
@include('admin.partials.alerts')

<div class="card card-outline card-success">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span class="font-weight-bold text-muted" style="font-size:13px;">
            <span class="material-icons text-success" style="font-size:16px;vertical-align:middle;">dashboard</span>
            Formulir Kartu Pagoda Sehat Baru
        </span>
        <a href="{{ route('admin.pagodasehat.index') }}" class="btn btn-sm btn-outline-secondary">
            <span class="material-icons" style="font-size:15px;vertical-align:middle;">arrow_back</span> Kembali
        </a>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.pagodasehat.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Judul Kartu <span class="text-danger">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                    class="form-control @error('title') is-invalid @enderror"
                    placeholder="Contoh: Dinas Kesehatan" required>
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea name="description" id="description" rows="3"
                    class="form-control @error('description') is-invalid @enderror"
                    placeholder="Contoh: Visi misi, struktur organisasi, dan kontak resmi Dinas Kesehatan Cianjur.">{{ old('description') }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="image">Gambar Kartu <span class="text-danger">*</span></label>
                <input type="file" name="image" id="image" accept="image/png,image/jpeg,image/svg+xml"
                    class="form-control @error('image') is-invalid @enderror" required>
                <small class="form-text text-muted">Format: PNG, JPG, SVG. Maks 2MB.</small>
                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="url">Link Tujuan <small class="text-muted font-weight-normal">(Opsional)</small></label>
                <input type="url" name="url" id="url" value="{{ old('url') }}"
                    class="form-control @error('url') is-invalid @enderror"
                    placeholder="Contoh: /profil">
                @error('url') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex align-items-center justify-content-end" style="gap:10px;">
                <a href="{{ route('admin.pagodasehat.index') }}" class="btn btn-outline-secondary">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">close</span> Batal
                </a>
                <button type="submit" class="btn btn-success">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">save</span> Simpan Kartu
                </button>
            </div>
        </form>
    </div>
</div>
@endsection