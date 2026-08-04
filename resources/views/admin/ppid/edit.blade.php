@extends('admin.layouts.admin')
@section('title', 'Halaman PPID')
@section('header_title', 'Halaman PPID')

@section('styles')
<style>
    .overview-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 24px;
        margin-bottom: 30px;
    }
    .overview-card {
        background: #ffffff;
        border-radius: 3px;
        border: none;
        box-shadow: 0 0 35px rgba(0, 0, 0, 0.05);
        padding: 24px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .overview-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 40px rgba(0, 0, 0, 0.08);
    }
    .card-meta-icon {
        width: 44px;
        height: 44px;
        background-color: #E6F7F0;
        color: #009966;
        border-radius: 3px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
    }
    .meta-title {
        font-size: 16px;
        font-weight: 700;
        color: #004F3B;
        margin-bottom: 12px;
        border-bottom: 1px solid #E2E8F0;
        padding-bottom: 8px;
    }
    .info-label {
        font-size: 12px;
        font-weight: 700;
        color: #64748B;
        text-transform: uppercase;
        margin-top: 10px;
        margin-bottom: 2px;
    }
    .info-val {
        font-size: 14px;
        color: #1E293B;
        word-break: break-all;
    }
    .ppid-tabs-nav {
        display: flex;
        border-bottom: 2px solid #E2E8F0;
        margin-bottom: 20px;
        gap: 8px;
    }
    .tab-nav-btn {
        background: none;
        border: none;
        border-bottom: 2px solid transparent;
        padding: 10px 16px;
        font-weight: 600;
        color: #64748B;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
        outline: none !important;
        cursor: pointer;
    }
    .tab-nav-btn:hover {
        color: #009966;
    }
    .tab-nav-btn.active {
        color: #009966;
        border-bottom-color: #009966;
    }
    .tab-nav-btn .material-icons {
        font-size: 18px;
    }
    .ppid-tab-panel {
        display: none;
    }
    .ppid-tab-panel.active {
        display: block;
    }
    .accordion-grid-layout {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 16px;
        margin-bottom: 16px;
    }
    .accordion-card-field {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 3px;
        padding: 12px 14px;
        position: relative;
    }
</style>
@endsection

@section('content')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <p class="text-muted mb-0">Kelola header PPID, data statistik, daftar informasi publik (accordion), tautan terkait, dan langkah tata cara permohonan informasi.</p>
    </div>
    <button type="button" class="btn btn-success px-4" data-toggle="modal" data-target="#modal-edit-ppid" style="border-radius:3px; font-weight:700; box-shadow:0 2px 10px rgba(0, 153, 102, 0.2);">
        <i class="fas fa-edit mr-2"></i> Ubah Halaman PPID
    </button>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 3px;">
        <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- Overview Dashboard Cards -->
<div class="overview-grid">
    <!-- Card 1: Header & Statistik -->
    <div class="overview-card">
        <div class="card-meta-icon"><span class="material-icons">view_quilt</span></div>
        <div class="meta-title">Header &amp; Statistik</div>
        
        <div class="info-label">Judul Halaman PPID</div>
        <div class="info-val" style="font-weight: 700;">{{ $ppid->page_title }}</div>

        <div class="info-label">Subjudul Halaman</div>
        <div class="info-val text-muted small">{{ $ppid->page_subtitle }}</div>

        <div class="row mt-2">
            <div class="col-4">
                <div class="info-label" style="font-size: 10px;">Stat 1</div>
                <div class="info-val" style="font-weight:700; color:#009966;">{{ $ppid->stat_1_number }}</div>
            </div>
            <div class="col-4">
                <div class="info-label" style="font-size: 10px;">Stat 2</div>
                <div class="info-val" style="font-weight:700; color:#009966;">{{ $ppid->stat_2_number }}</div>
            </div>
            <div class="col-4">
                <div class="info-label" style="font-size: 10px;">Stat 3</div>
                <div class="info-val" style="font-weight:700; color:#009966;">{{ $ppid->stat_3_number }}</div>
            </div>
        </div>
    </div>

    <!-- Card 2: Accordion Items -->
    <div class="overview-card">
        <div class="card-meta-icon"><span class="material-icons">toc</span></div>
        <div class="meta-title">Informasi Publik (Accordion)</div>

        <div class="info-label">Jumlah Informasi</div>
        @php
            $items = $ppid->accordion_items;
            if (empty($items)) {
                $items = [];
                foreach(range(1, 6) as $i) {
                    if ($ppid->{'accordion_'.$i.'_title'}) {
                        $items[] = ['title' => $ppid->{'accordion_'.$i.'_title'}, 'category' => 'berkala'];
                    }
                }
            }
        @endphp
        <div class="info-val" style="font-weight: 700;">{{ count($items) }} Item Informasi Publik</div>

        <div class="info-label">Klasifikasi Kategori</div>
        <div class="mt-1">
            <span class="badge badge-info" style="font-size: 11px;">Berkala: {{ count(array_filter($items, fn($x) => ($x['category'] ?? 'berkala') === 'berkala')) }}</span>
            <span class="badge badge-warning" style="font-size: 11px;">Serta Merta: {{ count(array_filter($items, fn($x) => ($x['category'] ?? '') === 'serta-merta')) }}</span>
            <span class="badge badge-success" style="font-size: 11px;">Setiap Saat: {{ count(array_filter($items, fn($x) => ($x['category'] ?? '') === 'setiap-saat')) }}</span>
        </div>
    </div>

    <!-- Card 3: Tautan Publik -->
    <div class="overview-card">
        <div class="card-meta-icon"><span class="material-icons">link</span></div>
        <div class="meta-title">Tautan Publik</div>

        <div class="info-label">Judul Blok Tautan</div>
        <div class="info-val" style="font-weight: 600;">{{ $ppid->tautan_title }}</div>

        <div class="info-label">Badge</div>
        <div class="info-val"><span class="badge badge-secondary">{{ $ppid->tautan_badge ?: 'Tidak Ada' }}</span></div>

        <div class="info-label">Tautan Terdaftar</div>
        <div class="text-muted small">
            @php $hasTautan = false; @endphp
            @foreach(range(1, 5) as $i)
                @if($ppid->{'tautan_'.$i.'_label'})
                    @php $hasTautan = true; @endphp
                    <div>• <a href="{{ $ppid->{'tautan_'.$i.'_url'} }}" target="_blank">{{ $ppid->{'tautan_'.$i.'_label'} }}</a></div>
                @endif
            @endforeach
            @if(!$hasTautan)
                <span class="italic text-muted">Belum ada tautan ditambahkan</span>
            @endif
        </div>
    </div>

    <!-- Card 4: Tata Cara Permohonan -->
    <div class="overview-card">
        <div class="card-meta-icon"><span class="material-icons">playlist_add_check</span></div>
        <div class="meta-title">Tata Cara &amp; Aksi</div>

        <div class="info-label">Heading Tata Cara</div>
        <div class="info-val" style="font-weight: 600;">{{ $ppid->tata_cara_heading }}</div>

        <div class="info-label">Badge Tata Cara</div>
        <div class="info-val"><span class="badge badge-success">{{ $ppid->tata_cara_badge }}</span></div>

        <div class="row mt-2">
            <div class="col-6">
                <div class="info-label">Tombol Daftar</div>
                <div class="info-val text-truncate small" style="font-weight: 600;">{{ $ppid->btn_daftar_label }}</div>
            </div>
            <div class="col-6">
                <div class="info-label">Tombol Login</div>
                <div class="info-val text-truncate small" style="font-weight: 600;">{{ $ppid->btn_login_label }}</div>
            </div>
        </div>
    </div>
</div>

<!-- POPUP MODAL EDIT FORM -->
<div class="modal fade" id="modal-edit-ppid" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 3px;">
            <div class="modal-header bg-success text-white py-3" style="border-top-left-radius: 3px; border-top-right-radius: 3px;">
                <h5 class="modal-title font-weight-bold" id="modalLabel"><i class="fas fa-edit mr-2"></i> Ubah Layanan PPID</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="{{ route('admin.ppid.update') }}" method="POST" id="ppid-form">
                @csrf
                @method('PUT')

                <div class="modal-body px-4 pt-4">
                    <!-- Tab Navigation -->
                    <div class="ppid-tabs-nav">
                        <button type="button" class="tab-nav-btn active" data-target="tab-modal-header-stats">
                            <span class="material-icons">view_quilt</span>
                            <span>Header &amp; Stat</span>
                        </button>
                        <button type="button" class="tab-nav-btn" data-target="tab-modal-accordion">
                            <span class="material-icons">toc</span>
                            <span>Accordion</span>
                        </button>
                        <button type="button" class="tab-nav-btn" data-target="tab-modal-tautan">
                            <span class="material-icons">link</span>
                            <span>Tautan</span>
                        </button>
                        <button type="button" class="tab-nav-btn" data-target="tab-modal-tata-cara">
                            <span class="material-icons">playlist_add_check</span>
                            <span>Tata Cara &amp; Aksi</span>
                        </button>
                    </div>

                    <!-- Tab 1: Header & Stats -->
                    <div id="tab-modal-header-stats" class="ppid-tab-panel active">
                        <h4 class="h6 font-weight-bold text-success mb-2"><i class="fas fa-heading mr-1"></i> Header Halaman PPID</h4>
                        <div class="row border-bottom pb-3 mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="page_title">Judul Halaman PPID <span class="text-danger">*</span></label>
                                    <input type="text" name="page_title" id="page_title" 
                                        value="{{ old('page_title', $ppid->page_title) }}" 
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="page_subtitle">Subjudul Halaman PPID <span class="text-danger">*</span></label>
                                    <input type="text" name="page_subtitle" id="page_subtitle" 
                                        value="{{ old('page_subtitle', $ppid->page_subtitle) }}" 
                                        class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <h4 class="h6 font-weight-bold text-success mb-2"><i class="fas fa-chart-bar mr-1"></i> Data 3 Kartu Statistik PPID</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card p-3" style="background: #F8FAFC; border: 1px solid #E2E8F0;">
                                    <span class="badge badge-success mb-2 align-self-start">KARTU STATISTIK 1</span>
                                    <div class="form-group">
                                        <label>Angka / Jumlah</label>
                                        <input type="text" name="stat_1_number" value="{{ old('stat_1_number', $ppid->stat_1_number) }}" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group mb-0">
                                        <label>Keterangan</label>
                                        <input type="text" name="stat_1_desc" value="{{ old('stat_1_desc', $ppid->stat_1_desc) }}" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card p-3" style="background: #F8FAFC; border: 1px solid #E2E8F0;">
                                    <span class="badge badge-success mb-2 align-self-start">KARTU STATISTIK 2</span>
                                    <div class="form-group">
                                        <label>Angka / Jumlah</label>
                                        <input type="text" name="stat_2_number" value="{{ old('stat_2_number', $ppid->stat_2_number) }}" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group mb-0">
                                        <label>Keterangan</label>
                                        <input type="text" name="stat_2_desc" value="{{ old('stat_2_desc', $ppid->stat_2_desc) }}" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card p-3" style="background: #F8FAFC; border: 1px solid #E2E8F0;">
                                    <span class="badge badge-success mb-2 align-self-start">KARTU STATISTIK 3</span>
                                    <div class="form-group">
                                        <label>Angka / Jumlah</label>
                                        <input type="text" name="stat_3_number" value="{{ old('stat_3_number', $ppid->stat_3_number) }}" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group mb-0">
                                        <label>Keterangan</label>
                                        <input type="text" name="stat_3_desc" value="{{ old('stat_3_desc', $ppid->stat_3_desc) }}" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 2: Accordion -->
                    <div id="tab-modal-accordion" class="ppid-tab-panel">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h4 class="h6 font-weight-bold text-success mb-0"><i class="fas fa-list-ul mr-1"></i> Item Informasi Publik (Accordion)</h4>
                            <button type="button" id="btn-add-accordion" class="btn btn-xs btn-outline-success">
                                <span class="material-icons" style="font-size:12px;vertical-align:middle;">add</span> Tambah Baris
                            </button>
                        </div>
                        
                        <div id="accordion-container" class="accordion-grid-layout">
                            @foreach (old('accordion_items', $ppid->accordion_items ?? []) as $index => $item)
                                <div class="accordion-card-field" data-index="{{ $index }}">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="badge badge-success">Item {{ $index + 1 }}</span>
                                        <button type="button" class="btn btn-xs btn-outline-danger" onclick="removeAccordionField(this)">
                                            <span class="material-icons" style="font-size:12px;vertical-align:middle;">delete</span> Hapus
                                        </button>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label style="font-size: 11px; font-weight: 600; color: #4B5563; display: block; margin-bottom: 2px;">Klasifikasi Informasi</label>
                                        <select name="accordion_items[{{ $index }}][category]" class="form-control form-control-sm" required>
                                            <option value="berkala" {{ ($item['category'] ?? '') === 'berkala' ? 'selected' : '' }}>Informasi Berkala</option>
                                            <option value="serta-merta" {{ ($item['category'] ?? '') === 'serta-merta' ? 'selected' : '' }}>Informasi Serta Merta</option>
                                            <option value="setiap-saat" {{ ($item['category'] ?? '') === 'setiap-saat' ? 'selected' : '' }}>Informasi Setiap Saat</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label style="font-size: 11px; font-weight: 600; color: #4B5563; display: block; margin-bottom: 2px;">Judul Informasi</label>
                                        <input type="text" name="accordion_items[{{ $index }}][title]" 
                                            value="{{ $item['title'] ?? '' }}" class="form-control form-control-sm" placeholder="Contoh: Rencana Strategis Dinkes" required>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label style="font-size: 11px; font-weight: 600; color: #4B5563; display: block; margin-bottom: 2px;">Detail Isi / Deskripsi</label>
                                        <textarea name="accordion_items[{{ $index }}][content]" rows="3" class="form-control form-control-sm" placeholder="Isi deskripsi..." required>{{ $item['content'] ?? '' }}</textarea>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Tab 3: Tautan -->
                    <div id="tab-modal-tautan" class="ppid-tab-panel">
                        <h4 class="h6 font-weight-bold text-success mb-2"><i class="fas fa-link mr-1"></i> Kepala Seksi Tautan PPID</h4>
                        <div class="row border-bottom pb-3 mb-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tautan_badge">Badge Tautan</label>
                                    <input type="text" name="tautan_badge" id="tautan_badge" value="{{ old('tautan_badge', $ppid->tautan_badge) }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="tautan_title">Judul Seksi Tautan</label>
                                    <input type="text" name="tautan_title" id="tautan_title" value="{{ old('tautan_title', $ppid->tautan_title) }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tautan_subtitle">Subjudul Seksi Tautan</label>
                                    <input type="text" name="tautan_subtitle" id="tautan_subtitle" value="{{ old('tautan_subtitle', $ppid->tautan_subtitle) }}" class="form-control">
                                </div>
                            </div>
                        </div>

                        <h4 class="h6 font-weight-bold text-success mb-2"><i class="fas fa-list mr-1"></i> Daftar 5 Tautan Publik</h4>
                        <div class="row">
                            @foreach(range(1, 5) as $i)
                                <div class="col-md-6 mb-2">
                                    <div class="card p-3 mb-0" style="background:#F8FAFC; border:1px solid #E2E8F0;">
                                        <span class="badge badge-success mb-2 align-self-start">TAUTAN {{ $i }}</span>
                                        <div class="form-group mb-2">
                                            <label style="font-size:11px;">Label Tombol</label>
                                            <input type="text" name="tautan_{{ $i }}_label" value="{{ old('tautan_'.$i.'_label', $ppid->{'tautan_'.$i.'_label'}) }}" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group mb-0">
                                            <label style="font-size:11px;">Alamat URL Link</label>
                                            <input type="text" name="tautan_{{ $i }}_url" value="{{ old('tautan_'.$i.'_url', $ppid->{'tautan_'.$i.'_url'}) }}" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Tab 4: Tata Cara -->
                    <div id="tab-modal-tata-cara" class="ppid-tab-panel">
                        <div class="row border-bottom pb-3 mb-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tata_cara_badge">Badge Tata Cara</label>
                                    <input type="text" name="tata_cara_badge" id="tata_cara_badge" value="{{ old('tata_cara_badge', $ppid->tata_cara_badge) }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="tata_cara_heading">Heading Tata Cara</label>
                                    <input type="text" name="tata_cara_heading" id="tata_cara_heading" value="{{ old('tata_cara_heading', $ppid->tata_cara_heading) }}" class="form-control">
                                </div>
                            </div>
                        </div>

                        <h4 class="h6 font-weight-bold text-success mb-2"><i class="fas fa-check-double mr-1"></i> Data 4 Langkah Tata Cara</h4>
                        <div class="row border-bottom pb-3 mb-3">
                            @foreach(range(1, 4) as $i)
                                <div class="col-md-6 mb-2">
                                    <div class="card p-3 mb-0" style="background:#F8FAFC; border:1px solid #E2E8F0;">
                                        <span class="badge badge-success mb-2 align-self-start">LANGKAH {{ $i }}</span>
                                        <div class="form-group mb-2">
                                            <label style="font-size:11px;">Judul Langkah</label>
                                            <input type="text" name="tata_cara_card_{{ $i }}_title" value="{{ old('tata_cara_card_'.$i.'_title', $ppid->{'tata_cara_card_'.$i.'_title'}) }}" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group mb-0">
                                            <label style="font-size:11px;">Penjelasan Deskripsi</label>
                                            <textarea name="tata_cara_card_{{ $i }}_text" rows="2" class="form-control form-control-sm">{{ old('tata_cara_card_'.$i.'_text', $ppid->{'tata_cara_card_'.$i.'_text'}) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <h4 class="h6 font-weight-bold text-success mb-2"><i class="fas fa-mouse-pointer mr-1"></i> Tautan Tombol Aksi di Bawah</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card p-3 mb-0" style="background:#F8FAFC; border:1px solid #E2E8F0;">
                                    <span class="badge badge-info mb-2 align-self-start">TOMBOL DAFTAR PPID</span>
                                    <div class="form-group mb-2">
                                        <label style="font-size:11px;">Label Tombol</label>
                                        <input type="text" name="btn_daftar_label" value="{{ old('btn_daftar_label', $ppid->btn_daftar_label) }}" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group mb-0">
                                        <label style="font-size:11px;">URL Redirect</label>
                                        <input type="text" name="btn_daftar_url" value="{{ old('btn_daftar_url', $ppid->btn_daftar_url) }}" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card p-3 mb-0" style="background:#F8FAFC; border:1px solid #E2E8F0;">
                                    <span class="badge badge-info mb-2 align-self-start">TOMBOL LOGIN PPID</span>
                                    <div class="form-group mb-2">
                                        <label style="font-size:11px;">Label Tombol</label>
                                        <input type="text" name="btn_login_label" value="{{ old('btn_login_label', $ppid->btn_login_label) }}" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group mb-0">
                                        <label style="font-size:11px;">URL Redirect</label>
                                        <input type="text" name="btn_login_url" value="{{ old('btn_login_url', $ppid->btn_login_url) }}" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light" style="border-bottom-left-radius: 3px; border-bottom-right-radius: 3px;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius:3px;">Batal</button>
                    <button type="submit" class="btn btn-success px-4" id="ppid-save-btn" style="border-radius:3px; font-weight:700;">
                        <i class="fas fa-save mr-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Tab switching logic for modal
    document.querySelectorAll('.tab-nav-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.tab-nav-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.ppid-tab-panel').forEach(p => p.classList.remove('active'));
            
            this.classList.add('active');
            
            const targetId = this.getAttribute('data-target');
            document.getElementById(targetId).classList.add('active');
        });
    });

    // Dynamic Accordion row modifiers inside modal
    const container = document.getElementById('accordion-container');
    const btnAdd = document.getElementById('btn-add-accordion');

    if (btnAdd) {
        btnAdd.addEventListener('click', function () {
            const index = container.children.length;
            const newField = document.createElement('div');
            newField.className = 'accordion-card-field';
            newField.dataset.index = index;
            newField.innerHTML = `
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="badge badge-success">Item Baru</span>
                    <button type="button" class="btn btn-xs btn-outline-danger" onclick="removeAccordionField(this)">
                        <span class="material-icons" style="font-size:12px;vertical-align:middle;">delete</span> Hapus
                    </button>
                </div>
                <div class="form-group mb-2">
                    <label style="font-size: 11px; font-weight: 600; color: #4B5563; display: block; margin-bottom: 2px;">Klasifikasi Informasi</label>
                    <select name="accordion_items[${index}][category]" class="form-control form-control-sm" required>
                        <option value="berkala">Informasi Berkala</option>
                        <option value="serta-merta">Informasi Serta Merta</option>
                        <option value="setiap-saat">Informasi Setiap Saat</option>
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label style="font-size: 11px; font-weight: 600; color: #4B5563; display: block; margin-bottom: 2px;">Judul Informasi</label>
                    <input type="text" name="accordion_items[${index}][title]" class="form-control form-control-sm" placeholder="Judul..." required>
                </div>
                <div class="form-group mb-0">
                    <label style="font-size: 11px; font-weight: 600; color: #4B5563; display: block; margin-bottom: 2px;">Detail Isi / Deskripsi</label>
                    <textarea name="accordion_items[${index}][content]" rows="3" class="form-control form-control-sm" placeholder="Isi deskripsi..." required></textarea>
                </div>
            `;
            container.appendChild(newField);
        });
    }

    function removeAccordionField(button) {
        Swal.fire({
            title: 'Hapus Informasi ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                const card = button.closest('.accordion-card-field');
                card.remove();

                // Re-index inputs
                Array.from(container.children).forEach((child, idx) => {
                    const select = child.querySelector('select');
                    if (select) select.name = `accordion_items[${idx}][category]`;
                    
                    const titleInput = child.querySelector('input');
                    if (titleInput) titleInput.name = `accordion_items[${idx}][title]`;
                    
                    const descTextarea = child.querySelector('textarea');
                    if (descTextarea) descTextarea.name = `accordion_items[${idx}][content]`;
                    
                    const badge = child.querySelector('.badge');
                    if (badge && !badge.innerText.includes('Baru')) {
                        badge.innerText = `Item ${idx + 1}`;
                    }
                });
            }
        });
    }

    // Submit loading state
    document.getElementById('ppid-form').addEventListener('submit', function() {
        const btn = document.getElementById('ppid-save-btn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-sync-alt fa-spin mr-1"></i> Menyimpan...';
    });
</script>
@endsection
