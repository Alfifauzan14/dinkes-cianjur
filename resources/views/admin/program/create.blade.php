@extends('admin.layouts.admin')
@section('title', 'Tambah Program Kesehatan Baru')
@section('header_title', 'Tambah Program Kesehatan Baru')

@section('content')
<div class="card card-outline card-success">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span class="font-weight-bold text-muted" style="font-size:13px;">
            <span class="material-icons text-success" style="font-size:16px;vertical-align:middle;">add_circle</span>
            Formulir Program Kesehatan Baru
        </span>
        <a href="{{ route('admin.program-kesehatan.index') }}" class="btn btn-sm btn-outline-secondary">
            <span class="material-icons" style="font-size:15px;vertical-align:middle;">arrow_back</span> Kembali
        </a>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.program-kesehatan.store') }}" method="POST">
            @csrf

            <div class="row">
                {{-- Kolom Kiri: Utama --}}
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="title">Nama Program Kesehatan <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}"
                            class="form-control @error('title') is-invalid @enderror"
                            placeholder="Contoh: Pencegahan Tuberkulosis (TB)" required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="subtitle">Deskripsi Singkat (Header Subtitle)</label>
                        <input type="text" name="subtitle" id="subtitle" value="{{ old('subtitle') }}"
                            class="form-control @error('subtitle') is-invalid @enderror"
                            placeholder="Deskripsi singkat yang tampil di banner halaman...">
                        @error('subtitle') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Program Intervensi Repeater --}}
                    <div class="card mb-4" style="border:1px solid #E5E7EB;">
                        <div class="card-header d-flex align-items-center justify-content-between" style="background:#F9FAFB;padding:10px 14px;">
                            <strong style="font-size:13px;color:#374151;">Daftar Program Intervensi</strong>
                            <button type="button" id="add-intervensi-btn" class="btn btn-xs btn-outline-success">
                                <span class="material-icons" style="font-size:14px;vertical-align:middle;">add</span> Tambah Item
                            </button>
                        </div>
                        <div class="card-body p-3" id="intervensi-container">
                            <!-- Row Item (Default 1 Empty Row) -->
                            <div class="intervensi-row p-3 mb-2" style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:3px;position:relative;">
                                <button type="button" class="btn btn-sm btn-outline-danger" style="position:absolute;top:10px;right:10px;" onclick="this.parentElement.remove()" title="Hapus Item">
                                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">delete</span>
                                </button>
                                <div style="padding-right:32px;">
                                    <div class="form-group">
                                        <label style="font-size:12px;font-weight:600;">Nama Intervensi / Layanan</label>
                                        <input type="text" name="intervensi_titles[]" class="form-control form-control-sm" placeholder="Contoh: Pemberian Vitamin A Tambahan" required>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label style="font-size:12px;font-weight:600;">Deskripsi Kegiatan</label>
                                        <textarea name="intervensi_descs[]" rows="2" class="form-control form-control-sm" placeholder="Jelaskan tindakan detail program..." required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="content">Artikel Edukasi / Detail Program (HTML)</label>
                        <textarea name="content" id="content" rows="8"
                            class="form-control @error('content') is-invalid @enderror"
                            placeholder="Contoh: <h3 class='st-content-title'>Definisi TB</h3><p class='st-content-text'>Tuberkulosis adalah...</p>">{{ old('content') }}</textarea>
                        <small class="text-muted">Gunakan class <code>st-content-title</code> untuk sub-judul &amp; <code>st-content-text</code> untuk teks paragraf.</small>
                        @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Kolom Kanan: Meta & Stats --}}
                <div class="col-md-4">
                    <div class="card mb-3" style="border:1px solid #E5E7EB;">
                        <div class="card-header" style="background:#F9FAFB;padding:10px 14px;">
                            <strong style="font-size:13px;">Pengaturan Halaman</strong>
                        </div>
                        <div class="card-body" style="padding:14px;">
                            <div class="form-group">
                                <label for="slug">Slug URL <small class="text-muted">(opsional)</small></label>
                                <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                                    class="form-control @error('slug') is-invalid @enderror"
                                    placeholder="Contoh: pencegahan-tb">
                                @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group mb-0">
                                <label for="status">Status Publikasi</label>
                                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                    <option value="published" {{ old('status', 'published') == 'published' ? 'selected' : '' }}>Published (Tampil di Nav)</option>
                                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft (Sembunyikan)</option>
                                </select>
                                @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Indicators Card --}}
                    <div class="card mb-3" style="border:1px solid #E5E7EB;">
                        <div class="card-header" style="background:#F9FAFB;padding:10px 14px;">
                            <strong style="font-size:13px;">Data Statistik Halaman <small class="text-muted">(opsional)</small></strong>
                        </div>
                        <div class="card-body" style="padding:14px;">
                            {{-- Stat 1 --}}
                            <div style="border-bottom:1px solid #E5E7EB;padding-bottom:12px;margin-bottom:12px;">
                                <label>Indikator 1</label>
                                <input type="text" name="stat_1_num" value="{{ old('stat_1_num') }}" class="form-control form-control-sm mb-1" placeholder="Angka, e.g. 12.5%">
                                <input type="text" name="stat_1_label" value="{{ old('stat_1_label') }}" class="form-control form-control-sm" placeholder="Label, e.g. Prevalensi Stunting">
                            </div>
                            {{-- Stat 2 --}}
                            <div style="border-bottom:1px solid #E5E7EB;padding-bottom:12px;margin-bottom:12px;">
                                <label>Indikator 2</label>
                                <input type="text" name="stat_2_num" value="{{ old('stat_2_num') }}" class="form-control form-control-sm mb-1" placeholder="Angka, e.g. 3,200">
                                <input type="text" name="stat_2_label" value="{{ old('stat_2_label') }}" class="form-control form-control-sm" placeholder="Label, e.g. Balita Terpantau">
                            </div>
                            {{-- Stat 3 --}}
                            <div class="mb-0">
                                <label>Indikator 3</label>
                                <input type="text" name="stat_3_num" value="{{ old('stat_3_num') }}" class="form-control form-control-sm mb-1" placeholder="Angka, e.g. 2,800">
                                <input type="text" name="stat_3_label" value="{{ old('stat_3_label') }}" class="form-control form-control-sm" placeholder="Label, e.g. Penerima PMT">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column" style="gap:8px;">
                        <button type="submit" class="btn btn-success btn-block">
                            <span class="material-icons" style="font-size:16px;vertical-align:middle;">save</span> Simpan Program
                        </button>
                        <a href="{{ route('admin.program-kesehatan.index') }}" class="btn btn-outline-secondary btn-block">Batal</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.getElementById('add-intervensi-btn').addEventListener('click', function() {
    const container = document.getElementById('intervensi-container');
    const newRow = document.createElement('div');
    newRow.className = 'intervensi-row p-3 mb-2';
    newRow.style.cssText = 'background:#F8FAFC;border:1px solid #E2E8F0;border-radius:3px;position:relative;';
    newRow.innerHTML = `
        <button type="button" class="btn btn-sm btn-outline-danger" style="position:absolute;top:10px;right:10px;" onclick="this.parentElement.remove()" title="Hapus Item">
            <span class="material-icons" style="font-size:16px;vertical-align:middle;">delete</span>
        </button>
        <div style="padding-right:32px;">
            <div class="form-group">
                <label style="font-size:12px;font-weight:600;">Nama Intervensi / Layanan</label>
                <input type="text" name="intervensi_titles[]" class="form-control form-control-sm" placeholder="Contoh: Pemberian Vitamin A Tambahan" required>
            </div>
            <div class="form-group mb-0">
                <label style="font-size:12px;font-weight:600;">Deskripsi Kegiatan</label>
                <textarea name="intervensi_descs[]" rows="2" class="form-control form-control-sm" placeholder="Jelaskan tindakan detail program..." required></textarea>
            </div>
        </div>
    `;
    container.appendChild(newRow);
});
</script>
@endsection
