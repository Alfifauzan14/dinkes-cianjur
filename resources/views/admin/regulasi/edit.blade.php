@extends('admin.layouts.admin')

@section('title', 'Edit Regulasi')
@section('header_title', 'Edit Regulasi')

@section('content')


<div class="card card-outline card-success">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span class="font-weight-bold text-muted" style="font-size:13px;">
            <span class="material-icons text-warning" style="font-size:16px;vertical-align:middle;">gavel</span>
            Formulir Edit Regulasi
        </span>
        <a href="{{ route('admin.regulasi.index') }}" class="btn btn-sm btn-outline-secondary">
            <span class="material-icons" style="font-size:15px;vertical-align:middle;">arrow_back</span> Kembali
        </a>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.regulasi.update', $regulasi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Nomor / Judul Regulasi <span class="text-danger">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $regulasi->title) }}"
                    class="form-control @error('title') is-invalid @enderror"
                    placeholder="Contoh: Perbup No. 42 Tahun 2024" required>
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="category">Kategori Regulasi <span class="text-danger">*</span></label>
                        <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" required>
                            <option value="" disabled>Pilih Kategori</option>
                            <option value="PERATURAN BUPATI" {{ old('category', $regulasi->category) == 'PERATURAN BUPATI' ? 'selected' : '' }}>PERATURAN BUPATI</option>
                            <option value="KEPUTUSAN BUPATI" {{ old('category', $regulasi->category) == 'KEPUTUSAN BUPATI' ? 'selected' : '' }}>KEPUTUSAN BUPATI</option>
                            <option value="UNDANG-UNDANG" {{ old('category', $regulasi->category) == 'UNDANG-UNDANG' ? 'selected' : '' }}>UNDANG-UNDANG</option>
                            <option value="PERATURAN MENTERI" {{ old('category', $regulasi->category) == 'PERATURAN MENTERI' ? 'selected' : '' }}>PERATURAN MENTERI</option>
                        </select>
                        @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="topic">Topik / Tag Cover <span class="text-danger">*</span></label>
                        <input type="text" name="topic" id="topic" value="{{ old('topic', $regulasi->topic) }}"
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
                        <input type="number" name="year" id="year" value="{{ old('year', $regulasi->year) }}"
                            class="form-control @error('year') is-invalid @enderror" required>
                        @error('year') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status">Status Hukum <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                            <option value="Berlaku" {{ old('status', $regulasi->status) == 'Berlaku' ? 'selected' : '' }}>Berlaku</option>
                            <option value="Tidak Berlaku" {{ old('status', $regulasi->status) == 'Tidak Berlaku' ? 'selected' : '' }}>Tidak Berlaku</option>
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="description">Deskripsi Singkat <span class="text-danger">*</span></label>
                <textarea name="description" id="description" rows="4"
                    class="form-control @error('description') is-invalid @enderror"
                    placeholder="Masukkan ringkasan singkat isi regulasi..." required>{{ old('description', $regulasi->description) }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="file_cover">Cover Dokumen <small class="text-muted font-weight-normal">(Biarkan kosong jika tidak ingin mengganti)</small></label>
                        <input type="file" name="file_cover" id="file_cover" accept="image/*"
                            class="form-control @error('file_cover') is-invalid @enderror">
                        @if($regulasi->cover_path)
                            <div class="mt-1">
                                <img src="{{ asset('storage/' . $regulasi->cover_path) }}" alt="" style="width: 80px; height: 110px; object-fit: cover; border-radius: 2px; border: 1px solid #CBD5E1;">
                            </div>
                        @endif
                        <small class="form-text text-muted">Format file: .jpg, .png, .jpeg | Maks: 2 MB</small>
                        @error('file_cover') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="file_document">Dokumen Regulasi (PDF) <small class="text-muted font-weight-normal">(Biarkan kosong jika tidak ingin mengganti)</small></label>
                        <input type="file" name="file_document" id="file_document" accept=".pdf"
                            class="form-control @error('file_document') is-invalid @enderror">
                        @if($regulasi->file_path)
                            <div class="mt-1 text-secondary" style="font-size: 13px; display: flex; align-items: center; gap: 4px;">
                                <span class="material-icons" style="font-size: 16px; color: #009966;">file_present</span>
                                <span>File saat ini: </span>
                                <a href="{{ asset('storage/' . $regulasi->file_path) }}" target="_blank" style="color: #009966; font-weight: 600; text-decoration: none;">
                                    Unduh File ({{ $regulasi->file_size }})
                                </a>
                            </div>
                        @endif
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
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">save</span> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
