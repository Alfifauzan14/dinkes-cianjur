@extends('admin.layouts.admin')

@section('title', 'Edit Program Kesehatan')
@section('header_title', 'Edit Program Kesehatan')

@section('content')
<div class="berita-admin-wrapper">
    <div class="admin-card">
        
        <form action="{{ route('admin.program-kesehatan.update', $program->id) }}" method="POST" class="admin-form" style="display: flex; flex-direction: column; gap: 20px;">
            @csrf
            @method('PUT')

            <!-- Nama Program -->
            <div class="form-group" style="display: flex; flex-direction: column; gap: 8px;">
                <label for="title" style="font-weight: 700; color: #1E293B;">Nama Program Kesehatan</label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    value="{{ old('title', $program->title) }}" 
                    class="form-control-input" 
                    style="padding: 10px; border: 1px solid #CBD5E1; border-radius: 3px; font-family: inherit; font-size: 14px;"
                    placeholder="Contoh: Pencegahan Tuberkulosis (TB)"
                    required
                >
                @error('title')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Slug Custom -->
            <div class="form-group" style="display: flex; flex-direction: column; gap: 8px;">
                <label for="slug" style="font-weight: 700; color: #1E293B;">Slug URL <span style="font-weight: 400; font-size: 12px; color: #94A3B8;">(e.g. pencegahan-tb)</span></label>
                <input 
                    type="text" 
                    name="slug" 
                    id="slug" 
                    value="{{ old('slug', $program->slug) }}" 
                    class="form-control-input" 
                    style="padding: 10px; border: 1px solid #CBD5E1; border-radius: 3px; font-family: inherit; font-size: 14px;"
                    placeholder="Contoh: pencegahan-tb"
                    required
                >
                @error('slug')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Subtitle -->
            <div class="form-group" style="display: flex; flex-direction: column; gap: 8px;">
                <label for="subtitle" style="font-weight: 700; color: #1E293B;">Deskripsi Singkat (Header Subtitle)</label>
                <input 
                    type="text" 
                    name="subtitle" 
                    id="subtitle" 
                    value="{{ old('subtitle', $program->subtitle) }}" 
                    class="form-control-input" 
                    style="padding: 10px; border: 1px solid #CBD5E1; border-radius: 3px; font-family: inherit; font-size: 14px;"
                    placeholder="Deskripsi singkat yang tampil di banner halaman..."
                >
                @error('subtitle')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <!-- 3 Data Indicators Row (Optional) -->
            <div style="border: 1px solid #E2E8F0; border-radius: 3px; padding: 20px; background-color: #F8FAFC; display: flex; flex-direction: column; gap: 16px;">
                <h4 style="font-weight: 700; color: #004F3B; margin: 0; font-size: 15px;">Indikator Data Statistik Halaman (Opsional)</h4>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px;">
                    <!-- Stat 1 -->
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label for="stat_1_num" style="font-weight: 600; font-size: 13px; color: #475569;">Angka Indikator 1</label>
                        <input type="text" name="stat_1_num" id="stat_1_num" value="{{ old('stat_1_num', $program->stat_1_num) }}" style="padding: 8px 10px; border: 1px solid #CBD5E1; border-radius: 3px; font-size: 14px;" placeholder="Contoh: 12.5%">
                        <input type="text" name="stat_1_label" value="{{ old('stat_1_label', $program->stat_1_label) }}" style="padding: 8px 10px; border: 1px solid #CBD5E1; border-radius: 3px; font-size: 14px; margin-top: 6px;" placeholder="Label: Prevalensi Stunting">
                    </div>
                    <!-- Stat 2 -->
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label for="stat_2_num" style="font-weight: 600; font-size: 13px; color: #475569;">Angka Indikator 2</label>
                        <input type="text" name="stat_2_num" id="stat_2_num" value="{{ old('stat_2_num', $program->stat_2_num) }}" style="padding: 8px 10px; border: 1px solid #CBD5E1; border-radius: 3px; font-size: 14px;" placeholder="Contoh: 3,200">
                        <input type="text" name="stat_2_label" value="{{ old('stat_2_label', $program->stat_2_label) }}" style="padding: 8px 10px; border: 1px solid #CBD5E1; border-radius: 3px; font-size: 14px; margin-top: 6px;" placeholder="Label: Balita Terpantau">
                    </div>
                    <!-- Stat 3 -->
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label for="stat_3_num" style="font-weight: 600; font-size: 13px; color: #475569;">Angka Indikator 3</label>
                        <input type="text" name="stat_3_num" id="stat_3_num" value="{{ old('stat_3_num', $program->stat_3_num) }}" style="padding: 8px 10px; border: 1px solid #CBD5E1; border-radius: 3px; font-size: 14px;" placeholder="Contoh: 2,800">
                        <input type="text" name="stat_3_label" value="{{ old('stat_3_label', $program->stat_3_label) }}" style="padding: 8px 10px; border: 1px solid #CBD5E1; border-radius: 3px; font-size: 14px; margin-top: 6px;" placeholder="Label: Keluarga Penerima">
                    </div>
                </div>
            </div>

            <!-- Program Intervensi (Dynamic Repeater) -->
            <div class="form-group" style="display: flex; flex-direction: column; gap: 8px;">
                <label style="font-weight: 700; color: #1E293B; display: flex; justify-content: space-between; align-items: center;">
                    <span>Daftar Program Intervensi</span>
                    <button type="button" id="add-intervensi-btn" style="display: inline-flex; align-items: center; gap: 4px; padding: 6px 12px; background-color: #E6F7F0; color: #009966; border: 1px solid #A7F3D0; border-radius: 3px; font-weight: 600; cursor: pointer; font-size: 13px;">
                        <span class="material-icons" style="font-size: 16px;">add</span>
                        <span>Tambah Item</span>
                    </button>
                </label>
                
                <div id="intervensi-container" style="display: flex; flex-direction: column; gap: 12px; margin-top: 8px;">
                    @if($program->intervensi && count($program->intervensi) > 0)
                        @foreach($program->intervensi as $item)
                            <div class="intervensi-row" style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 3px; padding: 16px; position: relative;">
                                <button type="button" class="remove-intervensi-btn" style="position: absolute; top: 12px; right: 12px; border: none; background: none; color: #EF4444; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; padding: 4px; border-radius: 3px;" onclick="this.parentElement.remove()" title="Hapus Item">
                                    <span class="material-icons" style="font-size: 18px;">delete</span>
                                </button>
                                <div style="display: flex; flex-direction: column; gap: 10px; padding-right: 28px;">
                                    <div style="display: flex; flex-direction: column; gap: 4px;">
                                        <label style="font-size: 12px; font-weight: 600; color: #475569;">Nama Intervensi / Layanan</label>
                                        <input type="text" name="intervensi_titles[]" value="{{ $item['title'] }}" class="form-control-input" style="padding: 8px 10px; border: 1px solid #CBD5E1; border-radius: 3px; font-family: inherit; font-size: 14px;" placeholder="Contoh: Pemberian Vitamin A Tambahan" required>
                                    </div>
                                    <div style="display: flex; flex-direction: column; gap: 4px;">
                                        <label style="font-size: 12px; font-weight: 600; color: #475569;">Deskripsi Kegiatan</label>
                                        <textarea name="intervensi_descs[]" rows="2" class="form-control-input" style="padding: 8px 10px; border: 1px solid #CBD5E1; border-radius: 3px; font-family: inherit; font-size: 14px;" placeholder="Jelaskan tindakan detail program..." required>{{ $item['description'] }}</textarea>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Row Item (Default 1 Empty Row) -->
                        <div class="intervensi-row" style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 3px; padding: 16px; position: relative;">
                            <button type="button" class="remove-intervensi-btn" style="position: absolute; top: 12px; right: 12px; border: none; background: none; color: #EF4444; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; padding: 4px; border-radius: 3px;" onclick="this.parentElement.remove()" title="Hapus Item">
                                <span class="material-icons" style="font-size: 18px;">delete</span>
                            </button>
                            <div style="display: flex; flex-direction: column; gap: 10px; padding-right: 28px;">
                                <div style="display: flex; flex-direction: column; gap: 4px;">
                                    <label style="font-size: 12px; font-weight: 600; color: #475569;">Nama Intervensi / Layanan</label>
                                    <input type="text" name="intervensi_titles[]" class="form-control-input" style="padding: 8px 10px; border: 1px solid #CBD5E1; border-radius: 3px; font-family: inherit; font-size: 14px;" placeholder="Contoh: Pemberian Vitamin A Tambahan" required>
                                </div>
                                <div style="display: flex; flex-direction: column; gap: 4px;">
                                    <label style="font-size: 12px; font-weight: 600; color: #475569;">Deskripsi Kegiatan</label>
                                    <textarea name="intervensi_descs[]" rows="2" class="form-control-input" style="padding: 8px 10px; border: 1px solid #CBD5E1; border-radius: 3px; font-family: inherit; font-size: 14px;" placeholder="Jelaskan tindakan detail program..." required></textarea>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Content HTML (Edu Card) -->
            <div class="form-group" style="display: flex; flex-direction: column; gap: 8px;">
                <label for="content" style="font-weight: 700; color: #1E293B;">Artikel Edukasi / Detail Program (HTML)</label>
                <textarea 
                    name="content" 
                    id="content" 
                    rows="8" 
                    class="form-control-input" 
                    style="padding: 10px; border: 1px solid #CBD5E1; border-radius: 3px; font-family: inherit; font-size: 14px; line-height: 1.5;"
                    placeholder="Contoh HTML: <h3 class='st-content-title'>Definisi TB</h3><p class='st-content-text'>Tuberkulosis adalah...</p>"
                >{{ old('content', $program->content) }}</textarea>
                <span style="font-size: 12px; color: #94A3B8;">Gunakan tag HTML dasar seperti &lt;h3 class="st-content-title"&gt; untuk judul seksi dan &lt;p class="st-content-text"&gt; untuk teks paragraf agar visualisasi rapi.</span>
                @error('content')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Status Publikasi -->
            <div class="form-group" style="display: flex; flex-direction: column; gap: 8px;">
                <label for="status" style="font-weight: 700; color: #1E293B;">Status Publikasi</label>
                <select name="status" id="status" class="form-control-select" style="padding: 10px; border: 1px solid #CBD5E1; border-radius: 3px; font-family: inherit; font-size: 14px; background-color: #fff;" required>
                    <option value="published" {{ old('status', $program->status) == 'published' ? 'selected' : '' }}>Published (Tampil di Menu Navbar)</option>
                    <option value="draft" {{ old('status', $program->status) == 'draft' ? 'selected' : '' }}>Draft (Sembunyikan)</option>
                </select>
                @error('status')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="form-actions" style="display: flex; gap: 10px; margin-top: 10px;">
                <button type="submit" class="btn-admin btn-admin-primary" style="padding: 10px 20px; background-color: #009966; color: #fff; border: none; border-radius: 3px; font-weight: 700; cursor: pointer;">
                    Perbarui Program
                </button>
                <a href="{{ route('admin.program-kesehatan.index') }}" class="btn-admin btn-admin-secondary" style="padding: 10px 20px; background-color: #F1F5F9; color: #334155; border: 1px solid #E2E8F0; border-radius: 3px; text-decoration: none; font-weight: 600; text-align: center;">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>

<script>
document.getElementById('add-intervensi-btn').addEventListener('click', function() {
    const container = document.getElementById('intervensi-container');
    const newRow = document.createElement('div');
    newRow.className = 'intervensi-row';
    newRow.style.cssText = 'background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 3px; padding: 16px; position: relative;';
    newRow.innerHTML = `
        <button type="button" class="remove-intervensi-btn" style="position: absolute; top: 12px; right: 12px; border: none; background: none; color: #EF4444; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; padding: 4px; border-radius: 3px;" onclick="this.parentElement.remove()" title="Hapus Item">
            <span class="material-icons" style="font-size: 18px;">delete</span>
        </button>
        <div style="display: flex; flex-direction: column; gap: 10px; padding-right: 28px;">
            <div style="display: flex; flex-direction: column; gap: 4px;">
                <label style="font-size: 12px; font-weight: 600; color: #475569;">Nama Intervensi / Layanan</label>
                <input type="text" name="intervensi_titles[]" class="form-control-input" style="padding: 8px 10px; border: 1px solid #CBD5E1; border-radius: 3px; font-family: inherit; font-size: 14px;" placeholder="Contoh: Pemberian Vitamin A Tambahan" required>
            </div>
            <div style="display: flex; flex-direction: column; gap: 4px;">
                <label style="font-size: 12px; font-weight: 600; color: #475569;">Deskripsi Kegiatan</label>
                <textarea name="intervensi_descs[]" rows="2" class="form-control-input" style="padding: 8px 10px; border: 1px solid #CBD5E1; border-radius: 3px; font-family: inherit; font-size: 14px;" placeholder="Jelaskan tindakan detail program..." required></textarea>
            </div>
        </div>
    `;
    container.appendChild(newRow);
});
</script>
@endsection
