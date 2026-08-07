@extends('admin.layouts.admin')

@section('title', 'Tambah Laporan Baru')
@section('header_title', 'Tambah Laporan Baru')

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
        <form action="{{ route('admin.laporan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Judul Laporan <span class="text-danger">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                    class="form-control @error('title') is-invalid @enderror"
                    placeholder="Masukkan judul laporan..." required>
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="category">Kategori Laporan <span class="text-danger">*</span></label>
                        <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" style="max-width: 350px;" required>
                            <option value="" disabled selected>Pilih Kategori</option>
                            @foreach($kategoris as $kat)
                            <option value="{{ $kat->nama }}" {{ old('category') == $kat->nama ? 'selected' : '' }}>{{ $kat->nama }}</option>
                            @endforeach
                        </select>
                @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="release_date">Tanggal Rilis <span class="text-danger">*</span></label>
                <input type="date" name="release_date" id="release_date" value="{{ old('release_date', date('Y-m-d')) }}"
                    class="form-control @error('release_date') is-invalid @enderror" required>
                @error('release_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="file_document">Dokumen Laporan (PDF) <span class="text-danger">*</span></label>
                <input type="file" name="file_document" id="file_document" accept=".pdf"
                    class="form-control @error('file_document') is-invalid @enderror" required>
                <small class="form-text text-muted">Format file: .pdf | Ukuran maksimum: 10 MB</small>
                @error('file_document') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex align-items-center justify-content-end" style="gap:10px;">
                <a href="{{ route('admin.laporan.index') }}" class="btn btn-outline-secondary">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">close</span> Batal
                </a>
                <button type="submit" class="btn btn-success">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">save</span> Simpan Laporan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
