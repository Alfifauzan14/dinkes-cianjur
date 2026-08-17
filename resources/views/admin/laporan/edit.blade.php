@extends('admin.layouts.admin')

@section('title', 'Edit Laporan')
@section('header_title', 'Edit Laporan Kinerja')

@section('content')
<div class="card card-outline card-success">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between" style="gap: 12px; padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
        <span class="d-flex align-items-center" style="gap: 8px;">
            <span class="material-icons text-success" style="font-size:20px;">description</span>
            <span class="font-weight-bold card-title-label">Edit Laporan Kinerja</span>
        </span>
        <a href="{{ route('admin.laporan.index') }}" class="btn btn-sm btn-outline-secondary d-flex align-items-center" style="gap: 4px;">
            <span class="material-icons" style="font-size:16px;">arrow_back</span> Kembali
        </a>
    </div>

    <div class="card-body p-4">
        <form action="{{ route('admin.laporan.update', $laporan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title" class="font-weight-bold" style="font-size: 13.5px; color: #1E293B;">
                    Judul Laporan <span class="text-danger">*</span>
                </label>
                <input type="text" name="title" id="title" value="{{ old('title', $laporan->title) }}"
                    class="form-control @error('title') is-invalid @enderror"
                    placeholder="Masukkan judul laporan..." required>
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="category" class="font-weight-bold" style="font-size: 13.5px; color: #1E293B;">
                            Kategori Laporan <span class="text-danger">*</span>
                        </label>
                        <select name="category" id="category" class="form-control custom-select @error('category') is-invalid @enderror" required>
                            <option value="" disabled>Pilih Kategori</option>
                            @foreach($kategoris as $kat)
                                <option value="{{ $kat->nama }}" {{ old('category', $laporan->category) == $kat->nama ? 'selected' : '' }}>{{ $kat->nama }}</option>
                            @endforeach
                        </select>
                        @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="release_date" class="font-weight-bold" style="font-size: 13.5px; color: #1E293B;">
                            Tanggal Rilis <span class="text-danger">*</span>
                        </label>
                        <input type="date" name="release_date" id="release_date" value="{{ old('release_date', $laporan->release_date->format('Y-m-d')) }}"
                            class="form-control @error('release_date') is-invalid @enderror" required>
                        @error('release_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="file_document" class="font-weight-bold" style="font-size: 13.5px; color: #1E293B;">
                    Dokumen Laporan (PDF)
                </label>
                <input type="file" name="file_document" id="file_document" accept=".pdf"
                    class="form-control-file @error('file_document') is-invalid @enderror">
                @if($laporan->file_path)
                    <div class="mt-2 p-3" style="background:#F8FAFC; border:1px solid #E2E8F0; border-radius:3px; display:inline-flex; align-items:center; gap:8px;">
                        <span class="material-icons text-success" style="font-size: 20px;">picture_as_pdf</span>
                        <span class="text-dark font-weight-bold" style="font-size: 13px;">File saat ini:</span>
                        <a href="{{ asset('storage/' . $laporan->file_path) }}" target="_blank" style="color: #009966; font-weight: 700; text-decoration: none; font-size: 13px;">
                            Lihat Dokumen ({{ $laporan->file_size }})
                        </a>
                    </div>
                @endif
                <small class="form-text text-muted">Format berkas: .pdf | Ukuran maksimum: 10 MB. Biarkan kosong jika tidak ingin mengganti file.</small>
                @error('file_document') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex align-items-center justify-content-end" style="gap:10px; margin-top: 24px;">
                <a href="{{ route('admin.laporan.index') }}" class="btn btn-outline-secondary">Batal</a>
                <button type="submit" class="btn btn-success font-weight-bold">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">save</span> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
