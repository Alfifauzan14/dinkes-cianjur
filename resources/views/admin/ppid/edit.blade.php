@extends('admin.layouts.admin')

@section('title', 'Edit PPID')
@section('header_title', 'Edit PPID')

@section('styles')
<style>
/* ===== PPID EDIT PAGE STYLES ===== */
.ppid-edit-page { display: flex; flex-direction: column; gap: 28px; }

/* ---- Section Card ---- */
.setting-section {
    background: #fff;
    border: 1px solid #e8edf3;
    border-radius: 12px;
    overflow: hidden;
}

.setting-section-header {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 18px 24px;
    border-bottom: 1px solid #e8edf3;
    background: #f8fafc;
}

.section-icon {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #e8f5e9;
    flex-shrink: 0;
}
.section-icon .material-icons { font-size: 18px; color: #009966; }

.setting-section-header h3 { font-size: 15px; font-weight: 700; color: #1e293b; margin: 0; }
.setting-section-header p  { font-size: 12px; color: #94a3b8; margin: 2px 0 0; }

.setting-section-body { padding: 24px; }

/* ---- Form Grid ---- */
.form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
.form-grid.single { grid-template-columns: 1fr; }

.form-group { display: flex; flex-direction: column; gap: 6px; }
.form-group.full { grid-column: 1 / -1; }

.form-group label {
    font-size: 13px;
    font-weight: 600;
    color: #475569;
    display: flex;
    align-items: center;
    gap: 6px;
}
.label-badge {
    font-size: 10px;
    font-weight: 600;
    background: #fef3c7;
    color: #92400e;
    padding: 2px 6px;
    border-radius: 4px;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 10px 14px;
    border: 1.5px solid #e2e8f0;
    border-radius: 8px;
    font-size: 13.5px;
    color: #1e293b;
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: #fff;
    transition: border-color .2s, box-shadow .2s;
    box-sizing: border-box;
}
.form-group input:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #009966;
    box-shadow: 0 0 0 3px rgba(0,153,102,.12);
}
.form-group textarea { resize: vertical; min-height: 80px; }

/* ---- Stat Row / Accordion Row ---- */
.stat-row, .accordion-row {
    background: #f8fafc;
    border: 1px solid #e8edf3;
    border-radius: 10px;
    padding: 16px;
    display: flex;
    flex-direction: column;
    gap: 12px;
}
.row-title {
    font-size: 12px;
    font-weight: 700;
    color: #009966;
    text-transform: uppercase;
    letter-spacing: .5px;
}

/* ---- Tautan Row ---- */
.tautan-row {
    background: #f8fafc;
    border: 1px solid #e8edf3;
    border-radius: 10px;
    padding: 16px;
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.tautan-pair {
    display: grid;
    grid-template-columns: 1fr 1.5fr;
    gap: 12px;
    align-items: end;
}

/* ---- Section Divider ---- */
.section-divider { border: none; border-top: 1px dashed #e2e8f0; margin: 20px 0; }

/* ---- Alert Success ---- */
.alert-success {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 20px;
    background: #d1fae5;
    border: 1px solid #a7f3d0;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
    color: #065f46;
}
.alert-success .material-icons { font-size: 20px; color: #059669; }

/* ---- Preview Banner ---- */
.ppid-preview-banner {
    background: linear-gradient(135deg, #004F3B 0%, #009966 100%);
    border-radius: 12px;
    padding: 28px 32px;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}
.ppid-preview-banner .banner-text h2 {
    font-size: 22px;
    font-weight: 800;
    margin: 0 0 6px;
}
.ppid-preview-banner .banner-text p {
    font-size: 13px;
    opacity: .8;
    margin: 0;
    max-width: 480px;
}
.banner-actions { display: flex; gap: 10px; flex-shrink: 0; }

.btn-preview {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 10px 20px;
    background: rgba(255,255,255,.15);
    border: 1.5px solid rgba(255,255,255,.4);
    border-radius: 8px;
    color: #fff;
    font-size: 13px;
    font-weight: 600;
    font-family: 'Plus Jakarta Sans', sans-serif;
    cursor: pointer;
    text-decoration: none;
    transition: background .2s;
}
.btn-preview:hover { background: rgba(255,255,255,.25); }
.btn-preview .material-icons { font-size: 16px; }

/* ---- Save Button ---- */
.form-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 12px;
    padding: 20px 24px;
    border-top: 1px solid #e8edf3;
    background: #f8fafc;
}
.btn-save {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 11px 28px;
    background: linear-gradient(135deg, #009966, #00c853);
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 700;
    font-family: 'Plus Jakarta Sans', sans-serif;
    cursor: pointer;
    transition: all .2s ease;
    box-shadow: 0 2px 8px rgba(0,153,102,.3);
}
.btn-save:hover { transform: translateY(-1px); box-shadow: 0 4px 14px rgba(0,153,102,.4); }
.btn-save .material-icons { font-size: 18px; }

/* Sections list */
.sections-list { display: flex; flex-direction: column; gap: 12px; }
</style>
@endsection

@section('content')
<div class="ppid-edit-page">

    {{-- Alert --}}
    @if(session('success'))
    <div class="alert-success">
        <span class="material-icons">check_circle</span>
        {{ session('success') }}
    </div>
    @endif

    {{-- Preview Banner --}}
    <div class="ppid-preview-banner">
        <div class="banner-text">
            <h2>Edit Konten Halaman PPID</h2>
            <p>Kelola seluruh teks, statistik, tautan, dan panduan permohonan yang tampil di halaman PPID publik.</p>
        </div>
        <div class="banner-actions">
            <a href="{{ route('ppid') }}" target="_blank" class="btn-preview">
                <span class="material-icons">open_in_new</span>
                Lihat Halaman Publik
            </a>
        </div>
    </div>

    <form action="{{ route('admin.ppid.update') }}" method="POST" id="ppid-form">
        @csrf
        @method('PUT')

        {{-- ===== SECTION 1: Header Halaman ===== --}}
        <div class="setting-section">
            <div class="setting-section-header">
                <div class="section-icon"><span class="material-icons">title</span></div>
                <div>
                    <h3>Header Halaman PPID</h3>
                    <p>Judul dan sub-judul yang tampil di banner atas halaman PPID</p>
                </div>
            </div>
            <div class="setting-section-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="page_title">
                            Judul Halaman
                            <span class="label-badge">Wajib</span>
                        </label>
                        <input type="text" id="page_title" name="page_title"
                            value="{{ old('page_title', $ppid->page_title) }}"
                            placeholder="PPID Dinas Kesehatan Kabupaten Cianjur" required>
                    </div>
                    <div class="form-group">
                        <label for="page_subtitle">Sub-judul / Deskripsi Singkat</label>
                        <input type="text" id="page_subtitle" name="page_subtitle"
                            value="{{ old('page_subtitle', $ppid->page_subtitle) }}"
                            placeholder="Pusat layanan informasi publik...">
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== SECTION 2: Statistik ===== --}}
        <div class="setting-section">
            <div class="setting-section-header">
                <div class="section-icon"><span class="material-icons">bar_chart</span></div>
                <div>
                    <h3>Kartu Statistik</h3>
                    <p>3 kartu angka statistik yang tampil di bawah banner header</p>
                </div>
            </div>
            <div class="setting-section-body">
                <div class="sections-list">
                    @foreach([1,2,3] as $i)
                    <div class="stat-row">
                        <span class="row-title">Statistik {{ $i }}</span>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="stat_{{ $i }}_number">Angka / Nilai</label>
                                <input type="text" id="stat_{{ $i }}_number" name="stat_{{ $i }}_number"
                                    value="{{ old('stat_'.$i.'_number', $ppid->{'stat_'.$i.'_number'}) }}"
                                    placeholder="Contoh: 9.757">
                            </div>
                            <div class="form-group">
                                <label for="stat_{{ $i }}_desc">Deskripsi Kartu</label>
                                <textarea id="stat_{{ $i }}_desc" name="stat_{{ $i }}_desc" rows="2"
                                    placeholder="Deskripsi singkat statistik ini...">{{ old('stat_'.$i.'_desc', $ppid->{'stat_'.$i.'_desc'}) }}</textarea>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ===== SECTION 3: Accordion Layanan Informasi ===== --}}
        <div class="setting-section">
            <div class="setting-section-header">
                <div class="section-icon"><span class="material-icons">format_list_bulleted</span></div>
                <div>
                    <h3>Accordion — Layanan Informasi Publik</h3>
                    <p>6 item accordion pada bagian "Layanan Informasi Publik"</p>
                </div>
            </div>
            <div class="setting-section-body">
                <div class="sections-list">
                    @foreach(range(1,6) as $i)
                    <div class="accordion-row">
                        <span class="row-title">Item Accordion {{ $i }}</span>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="accordion_{{ $i }}_title">Judul Item</label>
                                <input type="text" id="accordion_{{ $i }}_title" name="accordion_{{ $i }}_title"
                                    value="{{ old('accordion_'.$i.'_title', $ppid->{'accordion_'.$i.'_title'}) }}"
                                    placeholder="Judul accordion {{ $i }}">
                            </div>
                            <div class="form-group">
                                <label for="accordion_{{ $i }}_content">Isi / Deskripsi</label>
                                <textarea id="accordion_{{ $i }}_content" name="accordion_{{ $i }}_content" rows="3"
                                    placeholder="Isi konten accordion {{ $i }}...">{{ old('accordion_'.$i.'_content', $ppid->{'accordion_'.$i.'_content'}) }}</textarea>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ===== SECTION 4: Informasi Tautan ===== --}}
        <div class="setting-section">
            <div class="setting-section-header">
                <div class="section-icon"><span class="material-icons">link</span></div>
                <div>
                    <h3>Seksi Informasi Tautan</h3>
                    <p>Judul seksi dan 5 kartu tautan layanan publik Kabupaten Cianjur</p>
                </div>
            </div>
            <div class="setting-section-body">
                {{-- Sub-header seksi --}}
                <div class="form-grid" style="margin-bottom: 20px;">
                    <div class="form-group">
                        <label for="tautan_badge">Badge / Label Seksi</label>
                        <input type="text" id="tautan_badge" name="tautan_badge"
                            value="{{ old('tautan_badge', $ppid->tautan_badge) }}"
                            placeholder="Informasi Tautan">
                    </div>
                    <div class="form-group">
                        <label for="tautan_title">Judul Seksi</label>
                        <input type="text" id="tautan_title" name="tautan_title"
                            value="{{ old('tautan_title', $ppid->tautan_title) }}"
                            placeholder="Pelayanan Publik Kabupaten Cianjur">
                    </div>
                    <div class="form-group full">
                        <label for="tautan_subtitle">Sub-judul Seksi</label>
                        <input type="text" id="tautan_subtitle" name="tautan_subtitle"
                            value="{{ old('tautan_subtitle', $ppid->tautan_subtitle) }}"
                            placeholder="Deskripsi singkat seksi tautan...">
                    </div>
                </div>

                <hr class="section-divider">

                <div class="sections-list">
                    @foreach(range(1,5) as $i)
                    <div class="tautan-row">
                        <span class="row-title">Tautan {{ $i }}</span>
                        <div class="tautan-pair">
                            <div class="form-group">
                                <label for="tautan_{{ $i }}_label">Label / Nama</label>
                                <input type="text" id="tautan_{{ $i }}_label" name="tautan_{{ $i }}_label"
                                    value="{{ old('tautan_'.$i.'_label', $ppid->{'tautan_'.$i.'_label'}) }}"
                                    placeholder="Nama layanan">
                            </div>
                            <div class="form-group">
                                <label for="tautan_{{ $i }}_url">URL Tujuan</label>
                                <input type="text" id="tautan_{{ $i }}_url" name="tautan_{{ $i }}_url"
                                    value="{{ old('tautan_'.$i.'_url', $ppid->{'tautan_'.$i.'_url'}) }}"
                                    placeholder="https://... atau #">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ===== SECTION 5: Tata Cara Permohonan ===== --}}
        <div class="setting-section">
            <div class="setting-section-header">
                <div class="section-icon"><span class="material-icons">checklist</span></div>
                <div>
                    <h3>Seksi Tata Cara Permohonan</h3>
                    <p>4 langkah panduan permohonan informasi dan tombol aksi</p>
                </div>
            </div>
            <div class="setting-section-body">
                {{-- Badge & Heading --}}
                <div class="form-grid" style="margin-bottom: 20px;">
                    <div class="form-group">
                        <label for="tata_cara_badge">Badge Seksi</label>
                        <input type="text" id="tata_cara_badge" name="tata_cara_badge"
                            value="{{ old('tata_cara_badge', $ppid->tata_cara_badge) }}"
                            placeholder="4 langkah mudah pengajuan informasi online">
                    </div>
                    <div class="form-group">
                        <label for="tata_cara_heading">Judul Seksi</label>
                        <input type="text" id="tata_cara_heading" name="tata_cara_heading"
                            value="{{ old('tata_cara_heading', $ppid->tata_cara_heading) }}"
                            placeholder="Tata Cara Permohonan">
                    </div>
                </div>

                {{-- 4 Steps --}}
                <div class="sections-list" style="margin-bottom: 20px;">
                    @foreach(range(1,4) as $i)
                    <div class="accordion-row">
                        <span class="row-title">Langkah {{ $i }}</span>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="tata_cara_card_{{ $i }}_title">Judul Langkah</label>
                                <input type="text" id="tata_cara_card_{{ $i }}_title" name="tata_cara_card_{{ $i }}_title"
                                    value="{{ old('tata_cara_card_'.$i.'_title', $ppid->{'tata_cara_card_'.$i.'_title'}) }}"
                                    placeholder="{{ $i }}. Langkah {{ $i }}">
                            </div>
                            <div class="form-group">
                                <label for="tata_cara_card_{{ $i }}_text">Deskripsi</label>
                                <textarea id="tata_cara_card_{{ $i }}_text" name="tata_cara_card_{{ $i }}_text" rows="2"
                                    placeholder="Deskripsi langkah {{ $i }}...">{{ old('tata_cara_card_'.$i.'_text', $ppid->{'tata_cara_card_'.$i.'_text'}) }}</textarea>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <hr class="section-divider">

                {{-- Action Buttons --}}
                <div style="margin-top: 4px;">
                    <p style="font-size:13px; font-weight:700; color:#475569; margin:0 0 12px;">Tombol Aksi</p>
                    <div class="form-grid">
                        <div class="accordion-row">
                            <span class="row-title">Tombol Daftar Akun</span>
                            <div class="form-group">
                                <label for="btn_daftar_label">Label Tombol</label>
                                <input type="text" id="btn_daftar_label" name="btn_daftar_label"
                                    value="{{ old('btn_daftar_label', $ppid->btn_daftar_label) }}"
                                    placeholder="1. Mendaftar Akun Pemohon">
                            </div>
                            <div class="form-group">
                                <label for="btn_daftar_url">URL Tombol</label>
                                <input type="text" id="btn_daftar_url" name="btn_daftar_url"
                                    value="{{ old('btn_daftar_url', $ppid->btn_daftar_url) }}"
                                    placeholder="https://... atau #">
                            </div>
                        </div>
                        <div class="accordion-row">
                            <span class="row-title">Tombol Login E-PPID</span>
                            <div class="form-group">
                                <label for="btn_login_label">Label Tombol</label>
                                <input type="text" id="btn_login_label" name="btn_login_label"
                                    value="{{ old('btn_login_label', $ppid->btn_login_label) }}"
                                    placeholder="2. Login E-PPID Online">
                            </div>
                            <div class="form-group">
                                <label for="btn_login_url">URL Tombol</label>
                                <input type="text" id="btn_login_url" name="btn_login_url"
                                    value="{{ old('btn_login_url', $ppid->btn_login_url) }}"
                                    placeholder="https://... atau #">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== SAVE BUTTON ===== --}}
        <div class="setting-section">
            <div class="form-actions">
                <span style="font-size:13px; color:#94a3b8;">Perubahan akan langsung tampil di halaman PPID publik.</span>
                <button type="submit" class="btn-save" id="ppid-save-btn">
                    <span class="material-icons">save</span>
                    Simpan Perubahan
                </button>
            </div>
        </div>

    </form>
</div>
@endsection

@section('scripts')
<script>
document.getElementById('ppid-form').addEventListener('submit', function () {
    const btn = document.getElementById('ppid-save-btn');
    btn.disabled = true;
    btn.innerHTML = '<span class="material-icons" style="animation:spin 1s linear infinite">refresh</span> Menyimpan...';
});
</script>
<style>
@keyframes spin { to { transform: rotate(360deg); } }
</style>
@endsection
