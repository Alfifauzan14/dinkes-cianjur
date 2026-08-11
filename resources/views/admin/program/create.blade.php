@extends('admin.layouts.admin')
@section('title', 'Tambah Program Kesehatan')
@section('header_title', 'Tambah Program Kesehatan')

@section('styles')
<style>
    /* Menghilangkan warna biru default dari Bootstrap untuk Tab */
    .card-outline-tabs .nav-link {
        color: #475569;
        font-weight: 500;
    }
    .card-outline-tabs .nav-link:hover {
        color: #009966;
    }
    .card-outline-tabs .nav-link.active {
        color: #004F3B !important;
        font-weight: 700;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <form id="formProgram" action="{{ route('admin.program-kesehatan.store') }}" method="POST">
            @csrf
            
            <div class="card card-success card-outline card-outline-tabs shadow-sm">
                <div class="card-header p-0 border-bottom-0">
                    <div class="d-flex justify-content-between align-items-center px-4 pt-3 pb-2">
                        <span class="d-flex align-items-center" style="gap: 8px;">
                            <span class="material-icons text-success">health_and_safety</span>
                            <span class="font-weight-bold card-title-label">Formulir Tambah Program Kesehatan</span>
                        </span>
                        <a href="{{ route('admin.program-kesehatan.index') }}" class="btn btn-outline-secondary" style="padding: 6px 16px; font-weight: 500; border: 1px solid #CBD5E1 !important; border-radius: 4px; color: #475569;">
                            <span class="material-icons" style="font-size: 16px; vertical-align: middle; margin-right: 4px;">arrow_back</span> Kembali
                        </a>
                    </div>
                    <ul class="nav nav-tabs px-4" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#pane-dasar" role="tab">
                                <span class="material-icons" style="font-size: 16px; vertical-align: text-bottom; margin-right: 4px;">info</span>
                                Informasi Dasar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#pane-intervensi" role="tab">
                                <span class="material-icons" style="font-size: 16px; vertical-align: text-bottom; margin-right: 4px;">list_alt</span>
                                Intervensi & Kegiatan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#pane-indikator" role="tab">
                                <span class="material-icons" style="font-size: 16px; vertical-align: text-bottom; margin-right: 4px;">bar_chart</span>
                                Indikator Statistik
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#pane-edukasi" role="tab">
                                <span class="material-icons" style="font-size: 16px; vertical-align: text-bottom; margin-right: 4px;">article</span>
                                Artikel Edukasi
                            </a>
                        </li>
                    </ul>
                </div>
                
                <div class="card-body px-4 py-4">
                    <div class="tab-content" id="program-tabs-content">
                        
                        {{-- === SECTION 1: Informasi Dasar === --}}
                        <div class="tab-pane fade show active" id="pane-dasar" role="tabpanel">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="title">Nama Program <span class="text-danger">*</span></label>
                                        <input type="text" name="title" id="title"
                                            value="{{ old('title') }}"
                                            class="form-control @error('title') is-invalid @enderror"
                                            placeholder="Contoh: Pencegahan Tuberkulosis (TB)"
                                            oninput="autoSlug(this.value)"
                                            required>
                                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="kategori">Kategori <span class="text-danger">*</span></label>
                                        <select name="kategori" id="kategori" class="form-control @error('kategori') is-invalid @enderror" required>
                                            <option value="">-- Pilih Kategori --</option>
                                            @foreach($kategoris as $kat)
                                            <option value="{{ $kat->nama }}" {{ old('kategori') == $kat->nama ? 'selected' : '' }}>
                                                {{ $kat->nama }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="subtitle">Deskripsi Singkat (Banner Halaman)</label>
                                <input type="text" name="subtitle" id="subtitle"
                                    value="{{ old('subtitle') }}"
                                    class="form-control"
                                    placeholder="Deskripsi singkat yang tampil di header halaman program"
                                    maxlength="200">
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-0">
                                        <label for="slug">Slug URL <small class="text-muted">(Otomatis dari judul)</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light text-muted" style="border-right: none;">/program/</span>
                                            </div>
                                            <input type="text" name="slug" id="slug"
                                                value="{{ old('slug') }}"
                                                class="form-control @error('slug') is-invalid @enderror"
                                                placeholder="pencegahan-tb" required>
                                        </div>
                                        @error('slug') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-0">
                                        <label for="status">Status Publikasi <span class="text-danger">*</span></label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option value="published" {{ old('status', 'published') === 'published' ? 'selected' : '' }}>Published</option>
                                            <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-0">
                                        <label for="icon">Ikon Program <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light text-success" style="border-right: none;">
                                                    <span class="material-icons" id="iconPreviewIcon" style="font-size: 18px;">health_and_safety</span>
                                                </span>
                                            </div>
                                            <input type="text" name="icon" id="icon"
                                                value="{{ old('icon', 'health_and_safety') }}"
                                                class="form-control"
                                                placeholder="health_and_safety"
                                                oninput="updateIconPreview(this.value)" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- === SECTION 2: Intervensi === --}}
                        <div class="tab-pane fade" id="pane-intervensi" role="tabpanel">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div>
                                    <h6 class="font-weight-bold mb-1" style="font-size: 15px;">Daftar Intervensi Program</h6>
                                    <p class="text-muted mb-0" style="font-size: 13px;">Tambahkan kegiatan atau intervensi utama dalam program ini.</p>
                                </div>
                                <button type="button" id="addIntervensiBtn" class="btn btn-sm btn-success">
                                    <span class="material-icons" style="font-size:14px; vertical-align:middle;">add</span> Tambah Kegiatan
                                </button>
                            </div>
                            
                            <div id="intervensiContainer">
                                <div class="card bg-light border mb-3 intervensi-item" id="intervensi-0">
                                    <div class="card-body p-3">
                                        <button type="button" class="close text-danger" onclick="removeIntervensi(this)" title="Hapus" style="position: absolute; right: 15px; top: 15px; z-index: 10; cursor: pointer;">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label style="font-weight: 600; font-size: 13px;">Nama Kegiatan <span class="text-danger">*</span></label>
                                                    <input type="text" name="intervensi_titles[]" class="form-control"
                                                        placeholder="Contoh: Pemberian Vitamin A" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label style="font-weight: 600; font-size: 13px;">Ikon Kegiatan</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-white text-success" style="border-right: none;">
                                                                <span class="material-icons" id="iprev-0" style="font-size: 16px;">check_circle</span>
                                                            </span>
                                                        </div>
                                                        <input type="text" name="intervensi_icons[]" class="form-control"
                                                            value="check_circle"
                                                            placeholder="check_circle"
                                                            oninput="updateIntervensiIcon(this, 'iprev-0')">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-0">
                                            <label style="font-weight: 600; font-size: 13px;">Deskripsi Kegiatan <span class="text-danger">*</span></label>
                                            <textarea name="intervensi_descs[]" rows="2" class="form-control"
                                                placeholder="Jelaskan detail kegiatan..." required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- === SECTION 3: Indikator Statistik === --}}
                        <div class="tab-pane fade" id="pane-indikator" role="tabpanel">
                            <div class="mb-4">
                                <h6 class="font-weight-bold mb-1" style="font-size: 15px;">Indikator Statistik</h6>
                                <p class="text-muted mb-0" style="font-size: 13px;">Angka statistik ini akan ditampilkan secara menonjol di halaman program (Opsional).</p>
                            </div>
                            
                            <div class="row">
                                @foreach([1,2,3] as $n)
                                <div class="col-md-4">
                                    <div class="card bg-light border mb-3 mb-md-0">
                                        <div class="card-header text-center font-weight-bold">
                                            Indikator Utama {{ $n }}
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="text-center mb-4">
                                                <h3 class="font-weight-bold mb-1" id="stat-num-preview-{{ $n }}" style="color: var(--brand-green); font-size: 28px;">–</h3>
                                                <span class="text-muted" id="stat-lbl-preview-{{ $n }}" style="font-size: 13px;">Label {{ $n }}</span>
                                            </div>
                                            <div class="form-group">
                                                <label style="font-size:12px; font-weight:600;">Angka / Persentase</label>
                                                <input type="text" name="stat_{{ $n }}_num" value="{{ old('stat_'.$n.'_num') }}"
                                                    class="form-control form-control-sm"
                                                    placeholder="Contoh: 12.5%"
                                                    oninput="document.getElementById('stat-num-preview-{{ $n }}').textContent = this.value || '–'">
                                            </div>
                                            <div class="form-group mb-0">
                                                <label style="font-size:12px; font-weight:600;">Keterangan Label</label>
                                                <input type="text" name="stat_{{ $n }}_label" value="{{ old('stat_'.$n.'_label') }}"
                                                    class="form-control form-control-sm"
                                                    placeholder="Contoh: Prevalensi Stunting"
                                                    oninput="document.getElementById('stat-lbl-preview-{{ $n }}').textContent = this.value || 'Label {{ $n }}'">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- === SECTION 4: Artikel Edukasi === --}}
                        <div class="tab-pane fade" id="pane-edukasi" role="tabpanel">
                            <div class="mb-4">
                                <h6 class="font-weight-bold mb-1" style="font-size: 15px;">Detail Artikel Edukasi / Konten Program</h6>
                                <p class="text-muted mb-0" style="font-size: 13px;">Tuliskan deskripsi atau artikel lengkap mengenai program kesehatan ini (cukup tuliskan teks/paragraf biasa, tidak perlu kode HTML).</p>
                            </div>
                            
                            <div class="form-group">
                                <textarea name="content" id="content" rows="14"
                                    class="form-control @error('content') is-invalid @enderror"
                                    placeholder="Tuliskan artikel atau deskripsi program di sini..."
                                    style="font-size: 14px; line-height: 1.6;">{{ old('content') }}</textarea>
                                @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer bg-white p-3" style="justify-content: flex-end !important;">
                    <button type="submit" class="btn px-4" style="font-weight: 600; background-color: #004F3B; color: #fff; border: none; border-radius: 4px;">
                        <span class="material-icons" style="font-size: 16px; vertical-align: middle; margin-right: 4px;">save</span> 
                        Simpan Program
                    </button>
                </div>
            </div>
            
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Auto slug generator
function autoSlug(val) {
    const slug = val.toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '')
        .trim().replace(/\s+/g, '-');
    document.getElementById('slug').value = slug;
}

// Icon preview
function updateIconPreview(val) {
    const icon = val.trim() || 'health_and_safety';
    document.getElementById('iconPreviewIcon').textContent = icon;
}

// Intervensi icon preview
function updateIntervensiIcon(input, previewId) {
    const val = input.value.trim() || 'check_circle';
    const box = document.getElementById(previewId);
    if (box) box.textContent = val;
}

// Remove intervensi row
function removeIntervensi(btn) {
    const item = btn.closest('.intervensi-item');
    if (document.querySelectorAll('.intervensi-item').length > 1) {
        item.remove();
    } else {
        Swal.fire({ icon: 'info', title: 'Perhatian', text: 'Minimal harus ada satu kegiatan intervensi.', confirmButtonColor: '#009966' });
    }
}

// Add intervensi row
let intervensiCount = 1;
document.getElementById('addIntervensiBtn').addEventListener('click', function() {
    const idx = intervensiCount++;
    const prevId = 'iprev-' + idx;
    const html = `
    <div class="card bg-light border mb-3 intervensi-item" id="intervensi-${idx}">
        <div class="card-body p-3">
            <button type="button" class="close text-danger" onclick="removeIntervensi(this)" title="Hapus" style="position: absolute; right: 15px; top: 15px; z-index: 10; cursor: pointer;">
                <span aria-hidden="true">&times;</span>
            </button>
            
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label style="font-weight: 600; font-size: 13px;">Nama Kegiatan <span class="text-danger">*</span></label>
                        <input type="text" name="intervensi_titles[]" class="form-control"
                            placeholder="Contoh: Pemberian Vitamin A" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label style="font-weight: 600; font-size: 13px;">Ikon Kegiatan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white text-success" style="border-right: none;">
                                    <span class="material-icons" id="${prevId}" style="font-size: 16px;">check_circle</span>
                                </span>
                            </div>
                            <input type="text" name="intervensi_icons[]" class="form-control"
                                value="check_circle"
                                placeholder="check_circle"
                                oninput="updateIntervensiIcon(this, '${prevId}')">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group mb-0">
                <label style="font-weight: 600; font-size: 13px;">Deskripsi Kegiatan <span class="text-danger">*</span></label>
                <textarea name="intervensi_descs[]" rows="2" class="form-control"
                    placeholder="Jelaskan detail kegiatan..." required></textarea>
            </div>
        </div>
    </div>`;
    document.getElementById('intervensiContainer').insertAdjacentHTML('beforeend', html);
});

// Insert HTML tag into textarea
function insertTag(id, tag) {
    const ta = document.getElementById(id);
    const start = ta.selectionStart;
    const end = ta.selectionEnd;
    const before = ta.value.substring(0, start);
    const after = ta.value.substring(end);
    ta.value = before + tag + after;
    ta.selectionStart = ta.selectionEnd = start + tag.length;
    ta.focus();
}
</script>
@endsection
