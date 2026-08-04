@extends('admin.layouts.admin')
@section('title', 'Edit Program Kesehatan')
@section('header_title', 'Edit Program Kesehatan')

@section('styles')
@include('admin.program._form_styles')
@endsection

@section('content')
<div class="form-page-container">
    {{-- Action Bar --}}
    <div class="page-actions-bar">
        <a href="{{ route('admin.program-kesehatan.index') }}" class="btn btn-outline-secondary">
            <span class="material-icons" style="font-size:16px;">arrow_back</span> Kembali
        </a>
        <div class="d-flex align-items-center" style="gap: 10px;">
            <span style="font-size:13px;color:var(--text-secondary);">
                <span class="material-icons" style="font-size:14px;vertical-align:middle;">edit</span>
                {{ Str::limit($program->title, 40) }}
            </span>
            <button type="submit" form="formProgram" class="btn btn-success">
                <span class="material-icons" style="font-size:16px;">save</span> Simpan Perubahan
            </button>
        </div>
    </div>

    <form id="formProgram" action="{{ route('admin.program-kesehatan.update', $program->id) }}" method="POST">
        @csrf @method('PUT')

        {{-- === SECTION 1: Informasi Dasar === --}}
        <div class="form-section-card">
            <div class="form-section-header">
                <div class="section-icon"><span class="material-icons" style="font-size:18px;">info</span></div>
                <div>
                    <h3>Informasi Dasar</h3>
                    <p>Nama, kategori, subtitle dan status publikasi</p>
                </div>
            </div>
            <div class="form-section-body">
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
                            <label>Status Publikasi</label>
                            <div class="status-toggle">
                                <label>
                                    <input type="radio" name="status" value="published" {{ old('status', $program->status) === 'published' ? 'checked' : '' }}>
                                    <div class="status-option">
                                        <span class="material-icons" style="font-size:15px;">visibility</span> Published
                                    </div>
                                </label>
                                <label>
                                    <input type="radio" name="status" value="draft" {{ old('status', $program->status) === 'draft' ? 'checked' : '' }}>
                                    <div class="status-option">
                                        <span class="material-icons" style="font-size:15px;">edit_note</span> Draft
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- === SECTION 2: Ikon Program === --}}
        <div class="form-section-card">
            <div class="form-section-header">
                <div class="section-icon"><span class="material-icons" style="font-size:18px;">palette</span></div>
                <div>
                    <h3>Ikon Program</h3>
                    <p>Ikon Material Icons yang mewakili program ini</p>
                </div>
            </div>
            <div class="form-section-body">
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
        <div class="form-section-card">
            <div class="form-section-header">
                <div class="section-icon"><span class="material-icons" style="font-size:18px;">list_alt</span></div>
                <div>
                    <h3>Daftar Program Intervensi</h3>
                    <p>Kegiatan atau intervensi utama dalam program ini</p>
                </div>
                <div class="ml-auto">
                    <button type="button" id="addIntervensiBtn" class="btn btn-outline-success btn-sm">
                        <span class="material-icons" style="font-size:14px;">add</span> Tambah
                    </button>
                </div>
            </div>
            <div class="form-section-body">
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
        <div class="form-section-card">
            <div class="form-section-header">
                <div class="section-icon"><span class="material-icons" style="font-size:18px;">bar_chart</span></div>
                <div>
                    <h3>Indikator Statistik Halaman <span style="font-size:11px;font-weight:400;color:var(--text-secondary);">(opsional)</span></h3>
                    <p>Angka indikator yang ditampilkan di halaman program</p>
                </div>
            </div>
            <div class="form-section-body">
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
        <div class="form-section-card">
            <div class="form-section-header">
                <div class="section-icon"><span class="material-icons" style="font-size:18px;">article</span></div>
                <div>
                    <h3>Artikel Edukasi / Detail Program <span style="font-size:11px;font-weight:400;color:var(--text-secondary);">(opsional)</span></h3>
                    <p>Konten HTML yang tampil sebagai artikel di halaman program</p>
                </div>
            </div>
            <div class="form-section-body">
                @php $contentVal = old('content', $program->content ?? ''); @endphp
                <textarea name="content" id="content" rows="10"
                    class="form-control content-textarea @error('content') is-invalid @enderror"
                    placeholder="Ketik konten HTML di sini..."
                    oninput="document.getElementById('content-count').textContent = this.value.length">{{ $contentVal }}</textarea>
                @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                <div class="char-counter"><span id="content-count">{{ strlen($contentVal) }}</span> karakter</div>
                <div class="mt-3">
                    <p style="font-size:12px;font-weight:600;color:var(--text-secondary);margin-bottom:8px;">
                        <span class="material-icons" style="font-size:14px;vertical-align:middle;">code</span>
                        Tag HTML yang tersedia:
                    </p>
                    <div class="html-hint">
                        @foreach([
                            ["<h3 class='st-content-title'>Judul</h3>", 'Sub Judul'],
                            ["<p class='st-content-text'>Paragraf</p>", 'Paragraf'],
                            ["<ul class='st-content-list'>\n  <li>Item</li>\n</ul>", 'List'],
                            ["<strong>teks tebal</strong>", 'Bold'],
                            ["<br>", 'Baris Baru'],
                        ] as $tag)
                        <button type="button" class="html-tag-chip" onclick="insertTag('content', {{ json_encode($tag[0]) }})">
                            {{ $tag[1] }}
                        </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Bottom submit bar --}}
        <div class="page-actions-bar">
            <a href="{{ route('admin.program-kesehatan.index') }}" class="btn btn-outline-secondary">Batal</a>
            <button type="submit" class="btn btn-success">
                <span class="material-icons" style="font-size:16px;">save</span> Simpan Perubahan
            </button>
        </div>
    </form>
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
function insertTag(id, tag) {
    const ta = document.getElementById(id);
    const s = ta.selectionStart, e = ta.selectionEnd;
    ta.value = ta.value.substring(0,s) + tag + ta.value.substring(e);
    ta.selectionStart = ta.selectionEnd = s + tag.length;
    ta.focus();
    document.getElementById('content-count').textContent = ta.value.length;
}
</script>
@endsection
