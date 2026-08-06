@extends('admin.layouts.admin')

@section('title', 'Edit Laporan')
@section('header_title', 'Edit Laporan')

@section('content')


<div class="card card-outline card-success">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span class="font-weight-bold text-muted" style="font-size:13px;">
            <span class="material-icons text-success" style="font-size:16px;vertical-align:middle;">description</span>
            Formulir Laporan Baru
        </span>
        <a href="{{ route('admin.laporan.index') }}" class="btn btn-sm btn-outline-secondary">
            <span class="material-icons" style="font-size:15px;vertical-align:middle;">arrow_back</span> Kembali
        </a>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.laporan.update', $laporan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Judul Laporan <span class="text-danger">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $laporan->title) }}"
                    class="form-control @error('title') is-invalid @enderror"
                    placeholder="Masukkan judul laporan..." required>
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="category">Kategori Laporan <span class="text-danger">*</span></label>
                <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" style="max-width: 350px;" required>
                    <option value="" disabled>Pilih Kategori</option>
                    <option value="Laporan Kinerja" {{ old('category', $laporan->category) == 'Laporan Kinerja' ? 'selected' : '' }}>Laporan Kinerja</option>
                    <option value="Laporan Keuangan" {{ old('category', $laporan->category) == 'Laporan Keuangan' ? 'selected' : '' }}>Laporan Keuangan</option>
                    <option value="Informasi Publik" {{ old('category', $laporan->category) == 'Informasi Publik' ? 'selected' : '' }}>Informasi Publik</option>
                </select>
                @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="release_date">Tanggal Rilis <span class="text-danger">*</span></label>
                <input type="date" name="release_date" id="release_date" value="{{ old('release_date', $laporan->release_date->format('Y-m-d')) }}"
                    class="form-control @error('release_date') is-invalid @enderror" required>
                @error('release_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="file_document">Dokumen Laporan (PDF) <small class="text-muted font-weight-normal">(Biarkan kosong jika tidak ingin mengganti)</small></label>
                <input type="file" name="file_document" id="file_document" accept=".pdf"
                    class="form-control @error('file_document') is-invalid @enderror">
                @if($laporan->file_path)
                    <div class="mt-1 text-secondary" style="font-size: 13px; display: flex; align-items: center; gap: 4px;">
                        <span class="material-icons" style="font-size: 16px; color: #009966;">file_present</span>
                        <span>File saat ini: </span>
                        <a href="{{ asset('storage/' . $laporan->file_path) }}" target="_blank" style="color: #009966; font-weight: 600; text-decoration: none;">
                            Unduh File ({{ $laporan->file_size }})
                        </a>
                    </div>
                @endif
                <small class="form-text text-muted">Format file: .pdf | Ukuran maksimum: 10 MB</small>
                @error('file_document') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex align-items-center justify-content-end" style="gap:10px;">
                <a href="{{ route('admin.laporan.index') }}" class="btn btn-outline-secondary">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">close</span> Batal
                </a>
                <button type="submit" class="btn btn-success-dark">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">save</span> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
