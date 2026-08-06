@extends('admin.layouts.admin')
@section('title', 'Edit Program Kesehatan')
@section('header_title', 'Edit Program Kesehatan')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/program.css') }}?v={{ time() }}">
@endsection

@section('content')
<div class="card card-outline card-success">
    <div class="card-header d-flex align-items-center justify-content-between" style="padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
        <span class="font-weight-bold text-muted" style="font-size:13px;">
            <span class="material-icons text-success" style="font-size:16px;vertical-align:middle;">health_and_safety</span>
            {{ Str::limit($program->title, 40) }}
        </span>
        <a href="{{ route('admin.program-kesehatan.index') }}" class="btn btn-sm btn-outline-secondary">
            <span class="material-icons" style="font-size:15px;vertical-align:middle;">arrow_back</span> Kembali
        </a>
    </div>

    <div class="card-body">
        <form id="formProgram" action="{{ route('admin.program-kesehatan.update', $program->id) }}" method="POST">
            @csrf @method('PUT')

            {{-- === SECTION 1: Informasi Dasar === --}}
            <div class="program-section">
                <div class="program-section-title">
                    <div class="section-icon"><span class="material-icons" style="font-size:18px;">info</span></div>
                    <div>
                        <h4>Informasi Dasar</h4>
                        <p>Nama, kategori, subtitle dan status publikasi</p>
                    </div>
                </div>
                <div class="program-section-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="title">Nama Program Kesehatan <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title"
                                    value="{{ old('title', $program->title) }}"
                                    class="form-control @error('title') is-invalid @enderror"
                                    placeholder="Contoh: Pencegahan Tuberkulosis (TB)"
                                    required>
                                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select name="kategori" id="kategori" class="form-control">
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($kategoris as $kat)
                                    <option value="{{ $kat->nama }}" {{ old('kategori', $program->kategori) == $kat->nama ? 'selected' : '' }}>
                                        {{ $kat->nama }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="subtitle">Deskripsi Singkat (Banner Halaman)</label>
                        <input type="text" name="subtitle" id="subtitle"
                            value="{{ old('subtitle', $program->subtitle) }}"
                            class="form-control"
                            placeholder="Deskripsi singkat yang tampil di header halaman program"
                            maxlength="200"
                            oninput="document.getElementById('subtitle-count').textContent = this.value.length">
                        <div class="char-counter"><span id="subtitle-count">{{ strlen($program->subtitle ?? '') }}</span>/200 karakter</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label for="slug">Slug URL</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="font-size:12px;">/program/</span>
                                    </div>
                                    <input type="text" name="slug" id="slug"
                                        value="{{ old('slug', $program->slug) }}"
                                        class="form-control @error('slug') is-invalid @enderror">
                                </div>
                                @error('slug') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label for="status">Status Publikasi</label>
                                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                    <option value="published" {{ old('status', $program->status) === 'published' ? 'selected' : '' }}>Diterbitkan</option>
                                    <option value="draft" {{ old('status', $program->status) === 'draft' ? 'selected' : '' }}>Draf (Sembunyikan)</option>
                                </select>
                                @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- === SECTION 2: Ikon Program === --}}
            <div class="program-section">
                <div class="program-section-title">
                    <div class="section-icon"><span class="material-icons" style="font-size:18px;">palette</span></div>
                    <div>
                        <h4>Ikon Program</h4>
                        <p>Ikon Material Icons yang mewakili program ini</p>
                    </div>
                </div>
                <div class="program-section-body">
                    <div class="form-group mb-0">
                        <label for="icon">Nama Ikon Material Icons</label>
                        @php $currentIcon = old('icon', $program->icon ?? 'health_and_safety'); @endphp
                        <div class="icon-picker-wrapper">
                            <div class="icon-preview-box" id="iconPreviewBox">
                                <span class="material-icons" id="iconPreviewIcon">{{ $currentIcon }}</span>
                            </div>
                            <div style="flex:1;">
                                <input type="text" name="icon" id="icon"
                                    value="{{ $currentIcon }}"
                                    class="form-control"
                                    placeholder="health_and_safety"
                                    oninput="updateIconPreview(this.value)">
                                <div class="d-flex flex-wrap mt-2" style="gap:6px;">
                                    @foreach(['health_and_safety','medical_services','vaccines','science','favorite','local_hospital','psychology','child_care','pregnant_woman','elderly','nutrition','air','water_drop','coronavirus','sanitizer'] as $ic)
                                    <button type="button" class="html-tag-chip" onclick="setIcon('{{ $ic }}')" title="{{ $ic }}">
                                        <span class="material-icons" style="font-size:14px;vertical-align:middle;">{{ $ic }}</span>
                                        <span style="font-size:10px;display:block;margin-top:2px;">{{ $ic }}</span>
                                    </button>
                                    @endforeach
                                </div>
                                <small class="text-muted d-block mt-2">
                                    Ketik nama ikon dari
                                    <a href="https://fonts.google.com/icons" target="_blank" class="text-success">Material Icons</a>
                                    atau klik shortcut di atas.
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- === SECTION 3: Daftar Intervensi === --}}
            <div class="program-section">
                <div class="program-section-title">
                    <div class="section-icon"><span class="material-icons" style="font-size:18px;">list_alt</span></div>
                    <div>
                        <h4>Daftar Program Intervensi</h4>
                        <p>Kegiatan atau intervensi utama dalam program ini</p>
                    </div>
                    <div class="ml-auto">
                        <button type="button" id="addIntervensiBtn" class="btn btn-outline-success btn-sm">
                            <span class="material-icons" style="font-size:14px;">add</span> Tambah
                        </button>
                    </div>
                </div>
                <div class="program-section-body">
                    <div id="intervensiContainer">
                        @forelse((array)$program->intervensi as $i => $item)
                        <div class="intervensi-item" id="intervensi-{{ $i }}">
                            <button type="button" class="remove-btn" onclick="removeIntervensi(this)" title="Hapus">
                                <span class="material-icons" style="font-size:15px;">close</span>
                            </button>
                            @php $itemIcon = $item['icon'] ?? 'check_circle'; @endphp
                            <div class="row align-items-center mb-3">
                                <div class="col-auto">
                                    <div class="intervensi-icon-preview" id="iprev-{{ $i }}">
                                        <span class="material-icons">{{ $itemIcon }}</span>
                                    </div>
                                </div>
                                <div class="col">
                                    <label style="font-size:11.5px;margin-bottom:4px;">Nama Intervensi / Kegiatan <span class="text-danger">*</span></label>
                                    <input type="text" name="intervensi_titles[]" class="form-control"
                                        value="{{ $item['title'] ?? '' }}" required>
                                </div>
                                <div class="col-auto" style="width: 160px;">
                                    <label style="font-size:11.5px;margin-bottom:4px;">Ikon Intervensi</label>
                                    <input type="text" name="intervensi_icons[]" class="form-control"
                                        value="{{ $itemIcon }}"
                                        placeholder="check_circle"
                                        oninput="updateIntervensiIcon(this, 'iprev-{{ $i }}')">
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <label style="font-size:11.5px;margin-bottom:4px;">Deskripsi Kegiatan <span class="text-danger">*</span></label>
                                <textarea name="intervensi_descs[]" rows="2" class="form-control" required>{{ $item['description'] ?? '' }}</textarea>
                            </div>
                        </div>
                        @empty
                        <div class="intervensi-item" id="intervensi-0">
                            <button type="button" class="remove-btn" onclick="removeIntervensi(this)" title="Hapus">
                                <span class="material-icons" style="font-size:15px;">close</span>
                            </button>
                            <div class="row align-items-center mb-3">
                                <div class="col-auto">
                                    <div class="intervensi-icon-preview" id="iprev-0">
                                        <span class="material-icons">check_circle</span>
                                    </div>
                                </div>
                                <div class="col">
                                    <label style="font-size:11.5px;margin-bottom:4px;">Nama Intervensi / Kegiatan <span class="text-danger">*</span></label>
                                    <input type="text" name="intervensi_titles[]" class="form-control" placeholder="Contoh: Pemberian Vitamin A" required>
                                </div>
                                <div class="col-auto" style="width: 160px;">
                                    <label style="font-size:11.5px;margin-bottom:4px;">Ikon Intervensi</label>
                                    <input type="text" name="intervensi_icons[]" class="form-control" value="check_circle"
                                        oninput="updateIntervensiIcon(this, 'iprev-0')">
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <label style="font-size:11.5px;margin-bottom:4px;">Deskripsi Kegiatan <span class="text-danger">*</span></label>
                                <textarea name="intervensi_descs[]" rows="2" class="form-control" placeholder="Jelaskan tindakan..." required></textarea>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- === SECTION 4: Indikator Statistik === --}}
            <div class="program-section">
                <div class="program-section-title">
                    <div class="section-icon"><span class="material-icons" style="font-size:18px;">bar_chart</span></div>
                    <div>
                        <h4>Indikator Statistik Halaman <span style="font-size:11px;font-weight:400;color:var(--text-secondary);">(opsional)</span></h4>
                        <p>Angka indikator yang ditampilkan di halaman program</p>
                    </div>
                </div>
                <div class="program-section-body">
                    <div class="row">
                        @foreach([1,2,3] as $n)
                        @php
                            $numKey = 'stat_'.$n.'_num';
                            $lblKey = 'stat_'.$n.'_label';
                        @endphp
                        <div class="col-md-4">
                            <div class="stat-card-mini">
                                <span class="stat-num-preview" id="stat-num-preview-{{ $n }}">{{ old($numKey, $program->$numKey) ?: '–' }}</span>
                                <span class="stat-label-preview" id="stat-lbl-preview-{{ $n }}">{{ old($lblKey, $program->$lblKey) ?: 'Indikator '.$n }}</span>
                            </div>
                            <div class="mt-3">
                                <div class="form-group">
                                    <label style="font-size:12px;">Angka / Nilai</label>
                                    <input type="text" name="{{ $numKey }}" value="{{ old($numKey, $program->$numKey) }}"
                                        class="form-control form-control-sm"
                                        placeholder="Contoh: 12.5%"
                                        oninput="document.getElementById('stat-num-preview-{{ $n }}').textContent = this.value || '–'">
                                </div>
                                <div class="form-group mb-0">
                                    <label style="font-size:12px;">Label Keterangan</label>
                                    <input type="text" name="{{ $lblKey }}" value="{{ old($lblKey, $program->$lblKey) }}"
                                        class="form-control form-control-sm"
                                        placeholder="Contoh: Prevalensi Stunting"
                                        oninput="document.getElementById('stat-lbl-preview-{{ $n }}').textContent = this.value || 'Indikator {{ $n }}'">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- === SECTION 5: Artikel Edukasi / Detail === --}}
            <div class="program-section">
                <div class="program-section-title">
                    <div class="section-icon"><span class="material-icons" style="font-size:18px;">article</span></div>
                    <div>
                        <h4>Artikel Edukasi / Detail Program <span style="font-size:11px;font-weight:400;color:var(--text-secondary);">(opsional)</span></h4>
                        <p>Konten artikel yang ditampilkan di halaman program</p>
                    </div>
                </div>
                <div class="program-section-body">
                    @php $contentVal = old('content', $program->content ?? ''); @endphp
                    <textarea name="content" id="content" rows="10"
                        class="form-control @error('content') is-invalid @enderror"
                        placeholder="Tulis artikel / detail program di sini (teks biasa).">{{ $contentVal }}</textarea>
                    @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            {{-- Form actions --}}
            <div class="d-flex align-items-center justify-content-end" style="gap:10px;">
                <a href="{{ route('admin.program-kesehatan.index') }}" class="btn btn-outline-secondary">
                    <span class="material-icons" style="font-size:16px;">close</span> Batal
                </a>
                <button type="submit" class="btn btn-success-dark">
                    <span class="material-icons" style="font-size:16px;">save</span> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
function updateIconPreview(val) {
    document.getElementById('iconPreviewIcon').textContent = val.trim() || 'health_and_safety';
}
function setIcon(name) {
    document.getElementById('icon').value = name;
    updateIconPreview(name);
}
function updateIntervensiIcon(input, previewId) {
    const box = document.getElementById(previewId);
    if (box) box.querySelector('.material-icons').textContent = input.value.trim() || 'check_circle';
}
function removeIntervensi(btn) {
    const item = btn.closest('.intervensi-item');
    if (document.querySelectorAll('.intervensi-item').length > 1) {
        item.remove();
    }
}
let intervensiCount = {{ count((array)$program->intervensi) ?: 1 }};
document.getElementById('addIntervensiBtn').addEventListener('click', function() {
    const idx = intervensiCount++;
    const prevId = 'iprev-' + idx;
    document.getElementById('intervensiContainer').insertAdjacentHTML('beforeend', `
    <div class="intervensi-item" id="intervensi-${idx}">
        <button type="button" class="remove-btn" onclick="removeIntervensi(this)">
            <span class="material-icons" style="font-size:15px;">close</span>
        </button>
        <div class="row align-items-center mb-3">
            <div class="col-auto">
                <div class="intervensi-icon-preview" id="${prevId}">
                    <span class="material-icons">check_circle</span>
                </div>
            </div>
            <div class="col">
                <label style="font-size:11.5px;margin-bottom:4px;">Nama Intervensi <span class="text-danger">*</span></label>
                <input type="text" name="intervensi_titles[]" class="form-control" required>
            </div>
            <div class="col-auto" style="width:160px;">
                <label style="font-size:11.5px;margin-bottom:4px;">Ikon</label>
                <input type="text" name="intervensi_icons[]" class="form-control" value="check_circle"
                    oninput="updateIntervensiIcon(this, '${prevId}')">
            </div>
        </div>
        <div class="form-group mb-0">
            <label style="font-size:11.5px;margin-bottom:4px;">Deskripsi <span class="text-danger">*</span></label>
            <textarea name="intervensi_descs[]" rows="2" class="form-control" required></textarea>
        </div>
    </div>`);
});
</script>
@endsection
