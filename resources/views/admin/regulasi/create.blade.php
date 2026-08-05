@extends('admin.layouts.admin')

@section('title', 'Tambah Regulasi Baru')
@section('header_title', 'Tambah Regulasi Baru')

@section('content')
@include('admin.partials.alerts')

<div class="card card-outline card-success">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span class="font-weight-bold text-muted" style="font-size:13px;">
            <span class="material-icons text-success" style="font-size:16px;vertical-align:middle;">gavel</span>
            Formulir Regulasi Baru
        </span>
        <a href="{{ route('admin.regulasi.index') }}" class="btn btn-sm btn-outline-secondary">
            <span class="material-icons" style="font-size:15px;vertical-align:middle;">arrow_back</span> Kembali
        </a>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.regulasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Nomor / Judul Regulasi <span class="text-danger">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                    class="form-control @error('title') is-invalid @enderror"
                    placeholder="Contoh: Perbup No. 42 Tahun 2024" required>
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="category">Kategori Regulasi <span class="text-danger">*</span></label>
                        <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" required>
                            <option value="" disabled selected>Pilih Kategori</option>
                            <option value="PERATURAN BUPATI" {{ old('category') == 'PERATURAN BUPATI' ? 'selected' : '' }}>PERATURAN BUPATI</option>
                            <option value="KEPUTUSAN BUPATI" {{ old('category') == 'KEPUTUSAN BUPATI' ? 'selected' : '' }}>KEPUTUSAN BUPATI</option>
                            <option value="UNDANG-UNDANG" {{ old('category') == 'UNDANG-UNDANG' ? 'selected' : '' }}>UNDANG-UNDANG</option>
                            <option value="PERATURAN MENTERI" {{ old('category') == 'PERATURAN MENTERI' ? 'selected' : '' }}>PERATURAN MENTERI</option>
                        </select>
                        @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="topic">Topik / Tag Cover <span class="text-danger">*</span></label>
                        <input type="text" name="topic" id="topic" value="{{ old('topic') }}"
                            class="form-control @error('topic') is-invalid @enderror"
                            placeholder="Contoh: PERBUP STUNTING, GERMAS, KIA" required>
                        @error('topic') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="year">Tahun <span class="text-danger">*</span></label>
                        <input type="number" name="year" id="year" value="{{ old('year', date('Y')) }}"
                            class="form-control @error('year') is-invalid @enderror" required>
                        @error('year') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status">Status Hukum <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                            <option value="Berlaku" {{ old('status') == 'Berlaku' ? 'selected' : '' }}>Berlaku</option>
                            <option value="Tidak Berlaku" {{ old('status') == 'Tidak Berlaku' ? 'selected' : '' }}>Tidak Berlaku</option>
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="description">Deskripsi Singkat <span class="text-danger">*</span></label>
                <textarea name="description" id="description" rows="4"
                    class="form-control @error('description') is-invalid @enderror"
                    placeholder="Masukkan ringkasan singkat isi regulasi..." required>{{ old('description') }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="file_cover">Cover Dokumen <small class="text-muted font-weight-normal">(Gambar Cover, Opsional)</small></label>
                        <input type="file" name="file_cover" id="file_cover" accept="image/*"
                            class="form-control @error('file_cover') is-invalid @enderror">
                        <small class="form-text text-muted">Format file: .jpg, .png, .jpeg | Maks: 2 MB</small>
                        @error('file_cover') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="file_document">Dokumen Regulasi (PDF) <span class="text-danger">*</span></label>
                        <input type="file" name="file_document" id="file_document" accept=".pdf"
                            class="form-control @error('file_document') is-invalid @enderror" required>
                        <small class="form-text text-muted">Format file: .pdf | Ukuran maksimum: 10 MB</small>
                        @error('file_document') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-end" style="gap:10px;">
                <a href="{{ route('admin.regulasi.index') }}" class="btn btn-outline-secondary">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">close</span> Batal
                </a>
                <button type="submit" class="btn btn-success">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">save</span> Simpan Regulasi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection