@extends('admin.layouts.admin')

@section('title', 'Edit Regulasi')
@section('header_title', 'Edit Regulasi & Produk Hukum')

@section('content')
<div class="card card-outline card-success">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between" style="gap: 12px; padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
        <span class="d-flex align-items-center" style="gap: 8px;">
            <span class="material-icons text-success" style="font-size:20px;">gavel</span>
            <span class="font-weight-bold card-title-label">Edit Regulasi</span>
        </span>
        <a href="{{ route('admin.regulasi.index') }}" class="btn btn-sm btn-outline-secondary d-flex align-items-center" style="gap: 4px;">
            <span class="material-icons" style="font-size:16px;">arrow_back</span> Kembali
        </a>
    </div>

    <div class="card-body p-4">
        <form action="{{ route('admin.regulasi.update', $regulasi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title" class="font-weight-bold" style="font-size: 13.5px; color: #1E293B;">
                    Nomor / Judul Regulasi <span class="text-danger">*</span>
                </label>
                <input type="text" name="title" id="title" value="{{ old('title', $regulasi->title) }}"
                    class="form-control @error('title') is-invalid @enderror"
                    placeholder="Contoh: Perbup No. 42 Tahun 2024 Tentang ..." required>
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="category" class="font-weight-bold" style="font-size: 13.5px; color: #1E293B;">
                            Kategori Regulasi <span class="text-danger">*</span>
                        </label>
                        <select name="category" id="category" class="form-control custom-select @error('category') is-invalid @enderror" required>
                            <option value="" disabled>Pilih Kategori</option>
                            @foreach($kategoris as $kat)
                                <option value="{{ $kat->nama }}" {{ old('category', $regulasi->category) == $kat->nama ? 'selected' : '' }}>{{ $kat->nama }}</option>
                            @endforeach
                        </select>
                        @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="topic" class="font-weight-bold" style="font-size: 13.5px; color: #1E293B;">
                            Topik / Tag Cover <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="topic" id="topic" value="{{ old('topic', $regulasi->topic) }}"
                            class="form-control @error('topic') is-invalid @enderror"
                            placeholder="Contoh: PERBUP STUNTING, GERMAS, KIA" required>
                        @error('topic') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="year" class="font-weight-bold" style="font-size: 13.5px; color: #1E293B;">
                            Tahun <span class="text-danger">*</span>
                        </label>
                        <input type="number" name="year" id="year" value="{{ old('year', $regulasi->year) }}"
                            class="form-control @error('year') is-invalid @enderror" min="2000" max="{{ date('Y') + 5 }}" required>
                        @error('year') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="status" class="font-weight-bold" style="font-size: 13.5px; color: #1E293B;">
                            Status Hukum <span class="text-danger">*</span>
                        </label>
                        <select name="status" id="status" class="form-control custom-select @error('status') is-invalid @enderror" required>
                            <option value="Berlaku" {{ old('status', $regulasi->status) == 'Berlaku' ? 'selected' : '' }}>Berlaku</option>
                            <option value="Tidak Berlaku" {{ old('status', $regulasi->status) == 'Tidak Berlaku' ? 'selected' : '' }}>Tidak Berlaku</option>
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="description" class="font-weight-bold" style="font-size: 13.5px; color: #1E293B;">
                    Deskripsi Singkat <span class="text-danger">*</span>
                </label>
                <textarea name="description" id="description" rows="4"
                    class="form-control @error('description') is-invalid @enderror"
                    placeholder="Masukkan ringkasan singkat isi regulasi..." required>{{ old('description', $regulasi->description) }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="file_cover" class="font-weight-bold" style="font-size: 13.5px; color: #1E293B;">
                            Cover Dokumen
                        </label>
                        <input type="file" name="file_cover" id="file_cover" accept="image/*"
                            class="form-control-file @error('file_cover') is-invalid @enderror">
                        @if($regulasi->cover_path)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $regulasi->cover_path) }}" alt="Cover" style="width: 70px; height: 95px; object-fit: cover; border-radius: 2px; border: 1px solid #CBD5E1;">
                            </div>
                        @endif
                        <small class="form-text text-muted">Format file: .jpg, .png, .webp | Maks: 2 MB. Biarkan kosong jika tidak ingin mengganti cover.</small>
                        @error('file_cover') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="file_document" class="font-weight-bold" style="font-size: 13.5px; color: #1E293B;">
                            Dokumen Regulasi (PDF)
                        </label>
                        <input type="file" name="file_document" id="file_document" accept=".pdf"
                            class="form-control-file @error('file_document') is-invalid @enderror">
                        @if($regulasi->file_path)
                            <div class="mt-2 p-3" style="background:#F8FAFC; border:1px solid #E2E8F0; border-radius:3px; display:inline-flex; align-items:center; gap:8px;">
                                <span class="material-icons text-success" style="font-size: 20px;">picture_as_pdf</span>
                                <span class="text-dark font-weight-bold" style="font-size: 13px;">File saat ini:</span>
                                <a href="{{ asset('storage/' . $regulasi->file_path) }}" target="_blank" style="color: #009966; font-weight: 700; text-decoration: none; font-size: 13px;">
                                    Lihat Dokumen ({{ $regulasi->file_size }})
                                </a>
                            </div>
                        @endif
                        <small class="form-text text-muted">Format file: .pdf | Ukuran maksimum: 10 MB. Biarkan kosong jika tidak ingin mengganti file.</small>
                        @error('file_document') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-end" style="gap:10px; margin-top: 24px;">
                <a href="{{ route('admin.regulasi.index') }}" class="btn btn-outline-secondary">Batal</a>
                <button type="submit" class="btn btn-success font-weight-bold">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">save</span> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
