@extends('admin.layouts.admin')

@section('title', 'Edit Laporan')
@section('header_title', 'Edit Laporan')

@section('content')
<div class="berita-admin-wrapper">
    <div class="admin-card">
        
        <form action="{{ route('admin.laporan.update', $laporan->id) }}" method="POST" enctype="multipart/form-data" class="admin-form" style="display: flex; flex-direction: column; gap: 20px;">
            @csrf
            @method('PUT')

            <!-- Judul Laporan -->
            <div class="form-group" style="display: flex; flex-direction: column; gap: 8px;">
                <label for="title" style="font-weight: 700; color: #1E293B;">Judul Laporan</label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    value="{{ old('title', $laporan->title) }}" 
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
                    <option value="" disabled>Pilih Kategori</option>
                    <option value="Laporan Kinerja" {{ old('category', $laporan->category) == 'Laporan Kinerja' ? 'selected' : '' }}>Laporan Kinerja</option>
                    <option value="Laporan Keuangan" {{ old('category', $laporan->category) == 'Laporan Keuangan' ? 'selected' : '' }}>Laporan Keuangan</option>
                    <option value="Informasi Publik" {{ old('category', $laporan->category) == 'Informasi Publik' ? 'selected' : '' }}>Informasi Publik</option>
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
                    value="{{ old('release_date', $laporan->release_date->format('Y-m-d')) }}" 
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
                <label for="file_document" style="font-weight: 700; color: #1E293B;">Dokumen Laporan (PDF) <span style="font-weight: 400; font-size: 12px; color: #94A3B8;">(Biarkan kosong jika tidak ingin mengganti)</span></label>
                <input 
                    type="file" 
                    name="file_document" 
                    id="file_document" 
                    accept=".pdf"
                    class="form-control-input" 
                    style="padding: 10px; border: 1px solid #CBD5E1; border-radius: 3px; font-family: inherit; font-size: 14px; background-color: #F8FAFC;"
                >
                @if($laporan->file_path)
                    <div style="font-size: 13px; color: #475569; display: flex; align-items: center; gap: 4px;">
                        <span class="material-icons" style="font-size: 16px; color: #009966;">file_present</span>
                        <span>File saat ini: </span>
                        <a href="{{ asset('storage/' . $laporan->file_path) }}" target="_blank" style="color: #009966; font-weight: 600; text-decoration: none;">
                            Unduh File ({{ $laporan->file_size }})
                        </a>
                    </div>
                @endif
                <small style="color: #64748B;">Format file: .pdf | Ukuran maksimum: 10 MB</small>
                @error('file_document')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="form-actions" style="display: flex; gap: 10px; margin-top: 10px;">
                <button type="submit" class="btn-admin btn-admin-primary" style="padding: 10px 20px; background-color: #009966; color: #fff; border: none; border-radius: 3px; font-weight: 700; cursor: pointer;">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.laporan.index') }}" class="btn-admin btn-admin-secondary" style="padding: 10px 20px; background-color: #F1F5F9; color: #334155; border: 1px solid #E2E8F0; border-radius: 3px; text-decoration: none; font-weight: 600; text-align: center;">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>
@endsection
