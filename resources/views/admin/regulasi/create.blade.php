@extends('admin.layouts.admin')

@section('title', 'Tambah Regulasi Baru')
@section('header_title', 'Tambah Regulasi Baru')

@section('content')
<div class="berita-admin-wrapper">
    <div class="admin-card">
        
        <form action="{{ route('admin.regulasi.store') }}" method="POST" enctype="multipart/form-data" class="admin-form" style="display: flex; flex-direction: column; gap: 20px;">
            @csrf

            <!-- Judul / Nomor Regulasi -->
            <div class="form-group" style="display: flex; flex-direction: column; gap: 8px;">
                <label for="title" style="font-weight: 700; color: #1E293B;">Nomor / Judul Regulasi</label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    value="{{ old('title') }}" 
                    class="form-control-input" 
                    style="padding: 10px; border: 1px solid #CBD5E1; border-radius: 3px; font-family: inherit; font-size: 14px;"
                    placeholder="Contoh: Perbup No. 42 Tahun 2024"
                    required
                >
                @error('title')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <!-- Kategori Produk Hukum -->
                <div class="form-group" style="display: flex; flex-direction: column; gap: 8px;">
                    <label for="category" style="font-weight: 700; color: #1E293B;">Kategori Regulasi</label>
                    <select name="category" id="category" class="form-control-select" style="padding: 10px; border: 1px solid #CBD5E1; border-radius: 3px; font-family: inherit; font-size: 14px; background-color: #fff;" required>
                        <option value="" disabled selected>Pilih Kategori</option>
                        <option value="PERATURAN BUPATI" {{ old('category') == 'PERATURAN BUPATI' ? 'selected' : '' }}>PERATURAN BUPATI</option>
                        <option value="KEPUTUSAN BUPATI" {{ old('category') == 'KEPUTUSAN BUPATI' ? 'selected' : '' }}>KEPUTUSAN BUPATI</option>
                        <option value="UNDANG-UNDANG" {{ old('category') == 'UNDANG-UNDANG' ? 'selected' : '' }}>UNDANG-UNDANG</option>
                        <option value="PERATURAN MENTERI" {{ old('category') == 'PERATURAN MENTERI' ? 'selected' : '' }}>PERATURAN MENTERI</option>
                    </select>
                    @error('category')
                        <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Topik / Tag Cover -->
                <div class="form-group" style="display: flex; flex-direction: column; gap: 8px;">
                    <label for="topic" style="font-weight: 700; color: #1E293B;">Topik / Tag Cover</label>
                    <input 
                        type="text" 
                        name="topic" 
                        id="topic" 
                        value="{{ old('topic') }}" 
                        class="form-control-input" 
                        style="padding: 10px; border: 1px solid #CBD5E1; border-radius: 3px; font-family: inherit; font-size: 14px;"
                        placeholder="Contoh: PERBUP STUNTING, GERMAS, KIA"
                        required
                    >
                    @error('topic')
                        <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <!-- Tahun -->
                <div class="form-group" style="display: flex; flex-direction: column; gap: 8px;">
                    <label for="year" style="font-weight: 700; color: #1E293B;">Tahun</label>
                    <input 
                        type="number" 
                        name="year" 
                        id="year" 
                        value="{{ old('year', date('Y')) }}" 
                        class="form-control-input" 
                        style="padding: 10px; border: 1px solid #CBD5E1; border-radius: 3px; font-family: inherit; font-size: 14px;"
                        required
                    >
                    @error('year')
                        <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Status Hukum -->
                <div class="form-group" style="display: flex; flex-direction: column; gap: 8px;">
                    <label for="status" style="font-weight: 700; color: #1E293B;">Status Hukum</label>
                    <select name="status" id="status" class="form-control-select" style="padding: 10px; border: 1px solid #CBD5E1; border-radius: 3px; font-family: inherit; font-size: 14px; background-color: #fff;" required>
                        <option value="Berlaku" {{ old('status') == 'Berlaku' ? 'selected' : '' }}>Berlaku</option>
                        <option value="Tidak Berlaku" {{ old('status') == 'Tidak Berlaku' ? 'selected' : '' }}>Tidak Berlaku</option>
                    </select>
                    @error('status')
                        <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Deskripsi Singkat -->
            <div class="form-group" style="display: flex; flex-direction: column; gap: 8px;">
                <label for="description" style="font-weight: 700; color: #1E293B;">Deskripsi Singkat</label>
                <textarea 
                    name="description" 
                    id="description" 
                    class="form-textarea" 
                    style="padding: 10px; border: 1px solid #CBD5E1; border-radius: 3px; font-family: inherit; font-size: 14px; min-height: 100px; resize: vertical;"
                    placeholder="Masukkan ringkasan singkat isi regulasi..."
                    required
                >{{ old('description') }}</textarea>
                @error('description')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <!-- Upload Cover Image -->
                <div class="form-group" style="display: flex; flex-direction: column; gap: 8px;">
                    <label for="file_cover" style="font-weight: 700; color: #1E293B;">Cover Dokumen <span style="font-weight: 400; font-size: 12px; color: #94A3B8;">(Gambar Cover, Opsional)</span></label>
                    <input 
                        type="file" 
                        name="file_cover" 
                        id="file_cover" 
                        accept="image/*"
                        class="form-control-input" 
                        style="padding: 10px; border: 1px solid #CBD5E1; border-radius: 3px; font-family: inherit; font-size: 14px; background-color: #F8FAFC;"
                    >
                    <small style="color: #64748B;">Format file: .jpg, .png, .jpeg | Maks: 2 MB</small>
                    @error('file_cover')
                        <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Upload File PDF -->
                <div class="form-group" style="display: flex; flex-direction: column; gap: 8px;">
                    <label for="file_document" style="font-weight: 700; color: #1E293B;">Dokumen Regulasi (PDF)</label>
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
            </div>

            <!-- Form Actions -->
            <div class="form-actions" style="display: flex; gap: 10px; margin-top: 10px;">
                <button type="submit" class="btn-admin btn-admin-primary" style="padding: 10px 20px; background-color: #009966; color: #fff; border: none; border-radius: 3px; font-weight: 700; cursor: pointer;">
                    Simpan Regulasi
                </button>
                <a href="{{ route('admin.regulasi.index') }}" class="btn-admin btn-admin-secondary" style="padding: 10px 20px; background-color: #F1F5F9; color: #334155; border: 1px solid #E2E8F0; border-radius: 3px; text-decoration: none; font-weight: 600; text-align: center;">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>
@endsection
