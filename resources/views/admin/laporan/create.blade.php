@extends('admin.layouts.admin')

@section('title', 'Tambah Laporan Baru')
@section('header_title', 'Tambah Laporan Baru')

@section('content')
<div class="berita-admin-wrapper">
    <div class="admin-card">
        
        <form action="{{ route('admin.laporan.store') }}" method="POST" enctype="multipart/form-data" class="admin-form" style="display: flex; flex-direction: column; gap: 20px;">
            @csrf

            <!-- Judul Laporan -->
            <div class="form-group" style="display: flex; flex-direction: column; gap: 8px;">
                <label for="title" style="font-weight: 700; color: #1E293B;">Judul Laporan</label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    value="{{ old('title') }}" 
                    class="form-control-input" 
                    style="padding: 10px; border: 1px solid #CBD5E1; border-radius: 3px; font-family: inherit; font-size: 14px;"
                    placeholder="Masukkan judul laporan..."
                    required
                >
                @error('title')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Kategori Laporan -->
            <div class="form-group" style="display: flex; flex-direction: column; gap: 8px;">
                <label for="category" style="font-weight: 700; color: #1E293B;">Kategori Laporan</label>
                <select name="category" id="category" class="form-control-select" style="padding: 10px; border: 1px solid #CBD5E1; border-radius: 3px; font-family: inherit; font-size: 14px; background-color: #fff;" required>
                    <option value="" disabled selected>Pilih Kategori</option>
                    <option value="Laporan Kinerja" {{ old('category') == 'Laporan Kinerja' ? 'selected' : '' }}>Laporan Kinerja</option>
                    <option value="Laporan Keuangan" {{ old('category') == 'Laporan Keuangan' ? 'selected' : '' }}>Laporan Keuangan</option>
                    <option value="Informasi Publik" {{ old('category') == 'Informasi Publik' ? 'selected' : '' }}>Informasi Publik</option>
                </select>
                @error('category')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tanggal Rilis -->
            <div class="form-group" style="display: flex; flex-direction: column; gap: 8px;">
                <label for="release_date" style="font-weight: 700; color: #1E293B;">Tanggal Rilis</label>
                <input 
                    type="date" 
                    name="release_date" 
                    id="release_date" 
                    value="{{ old('release_date', date('Y-m-d')) }}" 
                    class="form-control-input" 
                    style="padding: 10px; border: 1px solid #CBD5E1; border-radius: 3px; font-family: inherit; font-size: 14px;"
                    required
                >
                @error('release_date')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Upload File PDF -->
            <div class="form-group" style="display: flex; flex-direction: column; gap: 8px;">
                <label for="file_document" style="font-weight: 700; color: #1E293B;">Dokumen Laporan (PDF)</label>
                <input 
                    type="file" 
                    name="file_document" 
                    id="file_document" 
                    accept=".pdf"
                    class="form-control-input" 
                    style="padding: 10px; border: 1px solid #CBD5E1; border-radius: 3px; font-family: inherit; font-size: 14px; background-color: #F8FAFC;"
                    required
                >
                <small style="color: #64748B;">Format file: .pdf | Ukuran maksimum: 10 MB</small>
                @error('file_document')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="form-actions" style="display: flex; gap: 10px; margin-top: 10px;">
                <button type="submit" class="btn-admin btn-admin-primary" style="padding: 10px 20px; background-color: #009966; color: #fff; border: none; border-radius: 3px; font-weight: 700; cursor: pointer;">
                    Simpan Laporan
                </button>
                <a href="{{ route('admin.laporan.index') }}" class="btn-admin btn-admin-secondary" style="padding: 10px 20px; background-color: #F1F5F9; color: #334155; border: 1px solid #E2E8F0; border-radius: 3px; text-decoration: none; font-weight: 600; text-align: center;">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>
@endsection
