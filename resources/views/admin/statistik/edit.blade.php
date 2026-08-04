@extends('admin.layouts.admin')
@section('title', 'Statistik Kesehatan')
@section('header_title', 'Statistik Kesehatan')

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
    .profile-tabs-nav {
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
    .profile-tab-panel {
        display: none;
    }
    .profile-tab-panel.active {
        display: block;
    }
    .dynamic-row-item {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 3px;
        padding: 12px 16px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
    }
</style>
@endsection

@section('content')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <p class="text-muted mb-0">Kelola indikator statistik kesehatan utama, tren stunting tahunan, sebaran puskesmas, dan sebaran profesi tenaga kesehatan.</p>
    </div>
    <button type="button" class="btn btn-success px-4" data-toggle="modal" data-target="#modal-edit-statistik" style="border-radius:3px; font-weight:700; box-shadow:0 2px 10px rgba(0, 153, 102, 0.2);">
        <i class="fas fa-edit mr-2"></i> Ubah Data Statistik
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
    <!-- Card 1: Indikator & Status -->
    <div class="overview-card">
        <div class="card-meta-icon"><span class="material-icons">bar_chart</span></div>
        <div class="meta-title">Indikator &amp; Status</div>
        
        <div class="info-label">Status Badge</div>
        <div class="info-val"><span class="badge badge-success">{{ $setting->status_badge }}</span></div>

        <div class="row mt-2">
            <div class="col-6 mb-2">
                <div class="info-label" style="font-size:10px;">Puskesmas</div>
                <div class="info-val" style="font-weight: 700; color:#009966;">{{ $setting->stat_1_num }}</div>
                <div class="text-muted small" style="font-size: 10px;">{{ $setting->stat_1_caption }}</div>
            </div>
            <div class="col-6 mb-2">
                <div class="info-label" style="font-size:10px;">RS Rujukan</div>
                <div class="info-val" style="font-weight: 700; color:#009966;">{{ $setting->stat_2_num }}</div>
                <div class="text-muted small" style="font-size: 10px;">{{ $setting->stat_2_caption }}</div>
            </div>
            <div class="col-6">
                <div class="info-label" style="font-size:10px;">SDM Kesehatan</div>
                <div class="info-val" style="font-weight: 700; color:#009966;">{{ $setting->stat_3_num }}</div>
                <div class="text-muted small" style="font-size: 10px;">{{ $setting->stat_3_caption }}</div>
            </div>
            <div class="col-6">
                <div class="info-label" style="font-size:10px;">Cakupan Imunisasi</div>
                <div class="info-val" style="font-weight: 700; color:#009966;">{{ $setting->stat_4_num }}</div>
                <div class="text-muted small" style="font-size: 10px;">{{ $setting->stat_4_caption }}</div>
            </div>
        </div>
    </div>

    <!-- Card 2: Grafik Tren Stunting -->
    <div class="overview-card">
        <div class="card-meta-icon"><span class="material-icons">show_chart</span></div>
        <div class="meta-title">Grafik Tren Stunting</div>

        <div class="info-label">Judul Grafik</div>
        <div class="info-val" style="font-weight: 600;">{{ $setting->stunting_title }}</div>

        <div class="info-label">Daftar Prevalensi</div>
        <div class="text-muted small">
            @foreach($stuntingRecords as $record)
                <div>• Tahun <strong>{{ $record->year }}</strong>: {{ $record->rate }}% 
                    @if($record->is_highlighted) <span class="badge badge-warning py-0" style="font-size: 9px;">Highlighted</span> @endif
                </div>
            @endforeach
        </div>
    </div>

    <!-- Card 3: Distribusi Nakes -->
    <div class="overview-card">
        <div class="card-meta-icon"><span class="material-icons">people</span></div>
        <div class="meta-title">Distribusi Profesi Nakes</div>

        <div class="info-label">Daftar Profesi</div>
        <div class="text-muted small">
            @if($setting->nakes_data)
                @foreach($setting->nakes_data as $nakes)
                    <div>• <strong>{{ $nakes['name'] }}</strong>: {{ $nakes['value'] }}</div>
                @endforeach
            @else
                <span class="italic text-muted">Belum ada data profesi</span>
            @endif
        </div>
    </div>

    <!-- Card 4: Sebaran Puskesmas -->
    <div class="overview-card">
        <div class="card-meta-icon"><span class="material-icons">explore</span></div>
        <div class="meta-title">Sebaran Zonasi Puskesmas</div>

        <div class="info-label">Daftar Sebaran</div>
        <div class="text-muted small">
            @if($setting->sebaran_data)
                @foreach($setting->sebaran_data as $sebaran)
                    <div>• <strong>{{ $sebaran['name'] }}</strong>: {{ $sebaran['value'] }}</div>
                @endforeach
            @else
                <span class="italic text-muted">Belum ada data sebaran</span>
            @endif
        </div>
    </div>
</div>

<!-- POPUP MODAL EDIT FORM -->
<div class="modal fade" id="modal-edit-statistik" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 3px;">
            <div class="modal-header bg-success text-white py-3" style="border-top-left-radius: 3px; border-top-right-radius: 3px;">
                <h5 class="modal-title font-weight-bold" id="modalLabel"><i class="fas fa-edit mr-2"></i> Ubah Data Statistik</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="{{ route('admin.satudata.statistik.update') }}" method="POST" id="statistik-form">
                @csrf
                @method('PUT')

                <div class="modal-body px-4 pt-4">
                    <!-- Tab Navigation -->
                    <div class="profile-tabs-nav">
                        <button type="button" class="tab-nav-btn active" onclick="switchTab(event, 'tab-modal-indicators')">
                            <span class="material-icons">bar_chart</span>
                            <span>Indikator &amp; Status</span>
                        </button>
                        <button type="button" class="tab-nav-btn" onclick="switchTab(event, 'tab-modal-stunting')">
                            <span class="material-icons">show_chart</span>
                            <span>Grafik Stunting</span>
                        </button>
                        <button type="button" class="tab-nav-btn" onclick="switchTab(event, 'tab-modal-lists')">
                            <span class="material-icons">list_alt</span>
                            <span>Nakes &amp; Zonasi</span>
                        </button>
                    </div>

                    <!-- Tab 1: Indikator & Status -->
                    <div id="tab-modal-indicators" class="profile-tab-panel active">
                        <div class="form-group">
                            <label for="status_badge">Label Status Data (Keterangan Pojok Kanan Atas)</label>
                            <input type="text" name="status_badge" id="status_badge" value="{{ old('status_badge', $setting->status_badge) }}" class="form-control" required>
                        </div>

                        <h3 class="h6 font-weight-bold text-success mb-2 mt-3">Data 4 Kartu Indikator Utama</h3>
                        <div class="row">
                            <!-- Card 1 -->
                            <div class="col-md-6 mb-2">
                                <div class="card p-3 mb-0" style="background:#F8FAFC; border:1px solid #E2E8F0;">
                                    <span class="badge badge-success mb-2 align-self-start">KARTU 1: PUSKESMAS</span>
                                    <div class="form-group mb-1">
                                        <label style="font-size:11px;">Angka/Nilai Utama</label>
                                        <input type="text" name="stat_1_num" value="{{ old('stat_1_num', $setting->stat_1_num) }}" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label style="font-size:11px;">Label Badge Atas</label>
                                        <input type="text" name="stat_1_badge" value="{{ old('stat_1_badge', $setting->stat_1_badge) }}" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label style="font-size:11px;">Keterangan Bawah</label>
                                        <input type="text" name="stat_1_caption" value="{{ old('stat_1_caption', $setting->stat_1_caption) }}" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                            </div>
                            <!-- Card 2 -->
                            <div class="col-md-6 mb-2">
                                <div class="card p-3 mb-0" style="background:#F8FAFC; border:1px solid #E2E8F0;">
                                    <span class="badge badge-success mb-2 align-self-start">KARTU 2: RUMAH SAKIT RUJUKAN</span>
                                    <div class="form-group mb-1">
                                        <label style="font-size:11px;">Angka/Nilai Utama</label>
                                        <input type="text" name="stat_2_num" value="{{ old('stat_2_num', $setting->stat_2_num) }}" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label style="font-size:11px;">Label Badge Atas</label>
                                        <input type="text" name="stat_2_badge" value="{{ old('stat_2_badge', $setting->stat_2_badge) }}" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label style="font-size:11px;">Keterangan Bawah</label>
                                        <input type="text" name="stat_2_caption" value="{{ old('stat_2_caption', $setting->stat_2_caption) }}" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                            </div>
                            <!-- Card 3 -->
                            <div class="col-md-6 mb-2">
                                <div class="card p-3 mb-0" style="background:#F8FAFC; border:1px solid #E2E8F0;">
                                    <span class="badge badge-success mb-2 align-self-start">KARTU 3: SDM KESEHATAN</span>
                                    <div class="form-group mb-1">
                                        <label style="font-size:11px;">Angka/Nilai Utama</label>
                                        <input type="text" name="stat_3_num" value="{{ old('stat_3_num', $setting->stat_3_num) }}" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label style="font-size:11px;">Label Badge Atas</label>
                                        <input type="text" name="stat_3_badge" value="{{ old('stat_3_badge', $setting->stat_3_badge) }}" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label style="font-size:11px;">Keterangan Bawah</label>
                                        <input type="text" name="stat_3_caption" value="{{ old('stat_3_caption', $setting->stat_3_caption) }}" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                            </div>
                            <!-- Card 4 -->
                            <div class="col-md-6 mb-2">
                                <div class="card p-3 mb-0" style="background:#F8FAFC; border:1px solid #E2E8F0;">
                                    <span class="badge badge-success mb-2 align-self-start">KARTU 4: CAKUPAN IMUNISASI</span>
                                    <div class="form-group mb-1">
                                        <label style="font-size:11px;">Angka/Nilai Utama</label>
                                        <input type="text" name="stat_4_num" value="{{ old('stat_4_num', $setting->stat_4_num) }}" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label style="font-size:11px;">Label Badge Atas</label>
                                        <input type="text" name="stat_4_badge" value="{{ old('stat_4_badge', $setting->stat_4_badge) }}" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label style="font-size:11px;">Keterangan Bawah</label>
                                        <input type="text" name="stat_4_caption" value="{{ old('stat_4_caption', $setting->stat_4_caption) }}" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 2: Grafik Stunting -->
                    <div id="tab-modal-stunting" class="profile-tab-panel">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stunting_title">Judul Grafik Stunting</label>
                                    <input type="text" name="stunting_title" id="stunting_title" value="{{ old('stunting_title', $setting->stunting_title) }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stunting_subtitle">Subjudul Grafik Stunting</label>
                                    <input type="text" name="stunting_subtitle" id="stunting_subtitle" value="{{ old('stunting_subtitle', $setting->stunting_subtitle) }}" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stunting_trend_badge">Badge Keterangan Tren</label>
                                    <input type="text" name="stunting_trend_badge" id="stunting_trend_badge" value="{{ old('stunting_trend_badge', $setting->stunting_trend_badge) }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stunting_footer_note">Catatan Kaki Grafik</label>
                                    <input type="text" name="stunting_footer_note" id="stunting_footer_note" value="{{ old('stunting_footer_note', $setting->stunting_footer_note) }}" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <h3 class="h6 font-weight-bold text-success mb-2 mt-2">Data Batang Grafik Tahunan</h3>
                        <div id="stunting-records-container" style="max-height: 240px; overflow-y: auto; padding-right: 8px;">
                            @foreach($stuntingRecords as $record)
                                <div class="dynamic-row-item">
                                    <div class="form-group mb-0" style="flex: 1; min-width: 100px;">
                                        <label style="font-size:11px; color:#475569;">Tahun</label>
                                        <input type="number" name="stunting_years[]" value="{{ $record->year }}" class="form-control form-control-sm" required onchange="updateRadioValue(this)">
                                    </div>
                                    <div class="form-group mb-0" style="flex: 1; min-width: 100px;">
                                        <label style="font-size:11px; color:#475569;">Persentase (%)</label>
                                        <input type="number" step="0.1" name="stunting_rates[]" value="{{ $record->rate }}" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="mb-0 pt-3" style="min-width: 90px;">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="hl-year-{{ $record->year }}" name="highlighted_year" value="{{ $record->year }}" {{ $record->is_highlighted ? 'checked' : '' }} class="custom-control-input">
                                            <label class="custom-control-label font-weight-normal text-secondary" style="font-size: 12px; cursor:pointer;" for="hl-year-{{ $record->year }}">Highlight</label>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-danger mt-3" onclick="removeRow(this)">
                                        <span class="material-icons" style="font-size:14px;vertical-align:middle;">delete</span>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-success mt-2" onclick="addStuntingRow()">
                            <span class="material-icons" style="font-size:14px;vertical-align:middle;">add</span> Tambah Data Tahun
                        </button>
                    </div>

                    <!-- Tab 3: Nakes & Zonasi -->
                    <div id="tab-modal-lists" class="profile-tab-panel">
                        <!-- Nakes Profesi List -->
                        <div class="mb-3">
                            <h3 class="h6 font-weight-bold text-success mb-1">1. Distribusi Profesi Nakes</h3>
                            <div id="nakes-rows-container" style="max-height: 180px; overflow-y: auto; padding-right: 8px;">
                                @if($setting->nakes_data)
                                    @foreach($setting->nakes_data as $nakesIdx => $nakes)
                                        <div class="dynamic-row-item">
                                            <div class="form-group mb-0" style="flex: 2; min-width: 150px;">
                                                <label style="font-size:11px; color:#475569;">Nama Profesi</label>
                                                <input type="text" name="nakes_names[]" value="{{ $nakes['name'] }}" class="form-control form-control-sm" required>
                                            </div>
                                            <div class="form-group mb-0" style="flex: 2; min-width: 120px;">
                                                <label style="font-size:11px; color:#475569;">Label Nilai</label>
                                                <input type="text" name="nakes_values[]" value="{{ $nakes['value'] }}" class="form-control form-control-sm" required>
                                            </div>
                                            <div class="form-group mb-0" style="flex: 1; min-width: 80px;">
                                                <label style="font-size:11px; color:#475569;">Lebar Bar (%)</label>
                                                <input type="number" min="0" max="100" name="nakes_widths[]" value="{{ $nakes['width'] }}" class="form-control form-control-sm" required>
                                            </div>
                                            <button type="button" class="btn btn-sm btn-outline-danger mt-3" onclick="removeRow(this)">
                                                <span class="material-icons" style="font-size:14px;vertical-align:middle;">delete</span>
                                            </button>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-success mt-2" onclick="addNakesRow()">
                                <span class="material-icons" style="font-size:14px;vertical-align:middle;">add</span> Tambah Profesi Nakes
                            </button>
                        </div>

                        <!-- Sebaran Zonasi List -->
                        <div class="border-top pt-3 mt-3">
                            <h3 class="h6 font-weight-bold text-success mb-1">2. Sebaran Puskesmas per Zonasi</h3>
                            <div id="sebaran-rows-container" style="max-height: 180px; overflow-y: auto; padding-right: 8px;">
                                @if($setting->sebaran_data)
                                    @foreach($setting->sebaran_data as $sebaran)
                                        <div class="dynamic-row-item">
                                            <div class="form-group mb-0" style="flex: 2; min-width: 150px;">
                                                <label style="font-size:11px; color:#475569;">Nama Zonasi</label>
                                                <input type="text" name="sebaran_names[]" value="{{ $sebaran['name'] }}" class="form-control form-control-sm" required>
                                            </div>
                                            <div class="form-group mb-0" style="flex: 2; min-width: 120px;">
                                                <label style="font-size:11px; color:#475569;">Label Nilai</label>
                                                <input type="text" name="sebaran_values[]" value="{{ $sebaran['value'] }}" class="form-control form-control-sm" required>
                                            </div>
                                            <div class="form-group mb-0" style="flex: 1; min-width: 80px;">
                                                <label style="font-size:11px; color:#475569;">Lebar Bar (%)</label>
                                                <input type="number" min="0" max="100" name="sebaran_widths[]" value="{{ $sebaran['width'] }}" class="form-control form-control-sm" required>
                                            </div>
                                            <button type="button" class="btn btn-sm btn-outline-danger mt-3" onclick="removeRow(this)">
                                                <span class="material-icons" style="font-size:14px;vertical-align:middle;">delete</span>
                                            </button>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-success mt-2" onclick="addSebaranRow()">
                                <span class="material-icons" style="font-size:14px;vertical-align:middle;">add</span> Tambah Zonasi Puskesmas
                            </button>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light" style="border-bottom-left-radius: 3px; border-bottom-right-radius: 3px;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius:3px;">Batal</button>
                    <button type="submit" class="btn btn-success px-4" id="statistik-save-btn" style="border-radius:3px; font-weight:700;">
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
    // Tab switching logic
    function switchTab(evt, tabId) {
        evt.preventDefault();
        const panels = document.querySelectorAll('.profile-tab-panel');
        panels.forEach(panel => panel.classList.remove('active'));

        const buttons = document.querySelectorAll('.tab-nav-btn');
        buttons.forEach(btn => btn.classList.remove('active'));

        document.getElementById(tabId).classList.add('active');
        evt.currentTarget.classList.add('active');
    }

    // Remove row generic function with SweetAlert2
    function removeRow(button) {
        Swal.fire({
            title: 'Hapus baris data ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if(result.isConfirmed) {
                const row = button.closest('.dynamic-row-item');
                row.remove();
            }
        });
    }

    // Dynamic row templates
    function addStuntingRow() {
        const container = document.getElementById('stunting-records-container');
        const count = container.children.length;

        const row = document.createElement('div');
        row.className = 'dynamic-row-item';
        row.innerHTML = `
            <div class="form-group mb-0" style="flex: 1; min-width: 100px;">
                <label style="font-size:11px; color:#475569;">Tahun</label>
                <input type="number" name="stunting_years[]" class="form-control form-control-sm" required onchange="updateRadioValue(this)">
            </div>
            <div class="form-group mb-0" style="flex: 1; min-width: 100px;">
                <label style="font-size:11px; color:#475569;">Persentase (%)</label>
                <input type="number" step="0.1" name="stunting_rates[]" class="form-control form-control-sm" required>
            </div>
            <div class="mb-0 pt-3" style="min-width: 90px;">
                <div class="custom-control custom-radio">
                    <input type="radio" id="hl-year-new-${count}" name="highlighted_year" value="" class="custom-control-input">
                    <label class="custom-control-label font-weight-normal text-secondary" style="font-size: 12px; cursor:pointer;" for="hl-year-new-${count}">Highlight</label>
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-outline-danger mt-3" onclick="removeRow(this)">
                <span class="material-icons" style="font-size:14px;vertical-align:middle;">delete</span>
            </button>
        `;
        container.appendChild(row);
    }

    function updateRadioValue(input) {
        const row = input.closest('.dynamic-row-item');
        const radio = row.querySelector('input[type="radio"]');
        if (radio) {
            radio.value = input.value;
            const radioId = 'hl-year-' + input.value;
            radio.id = radioId;
            const label = row.querySelector('.custom-control-label');
            if (label) {
                label.setAttribute('for', radioId);
            }
        }
    }

    function addNakesRow() {
        const container = document.getElementById('nakes-rows-container');
        const row = document.createElement('div');
        row.className = 'dynamic-row-item';
        row.innerHTML = `
            <div class="form-group mb-0" style="flex: 2; min-width: 150px;">
                <label style="font-size:11px; color:#475569;">Nama Profesi</label>
                <input type="text" name="nakes_names[]" class="form-control form-control-sm" required>
            </div>
            <div class="form-group mb-0" style="flex: 2; min-width: 120px;">
                <label style="font-size:11px; color:#475569;">Label Nilai</label>
                <input type="text" name="nakes_values[]" class="form-control form-control-sm" required>
            </div>
            <div class="form-group mb-0" style="flex: 1; min-width: 80px;">
                <label style="font-size:11px; color:#475569;">Lebar Bar (%)</label>
                <input type="number" min="0" max="100" name="nakes_widths[]" class="form-control form-control-sm" required>
            </div>
            <button type="button" class="btn btn-sm btn-outline-danger mt-3" onclick="removeRow(this)">
                <span class="material-icons" style="font-size:14px;vertical-align:middle;">delete</span>
            </button>
        `;
        container.appendChild(row);
    }

    function addSebaranRow() {
        const container = document.getElementById('sebaran-rows-container');
        const row = document.createElement('div');
        row.className = 'dynamic-row-item';
        row.innerHTML = `
            <div class="form-group mb-0" style="flex: 2; min-width: 150px;">
                <label style="font-size:11px; color:#475569;">Nama Zonasi</label>
                <input type="text" name="sebaran_names[]" class="form-control form-control-sm" required>
            </div>
            <div class="form-group mb-0" style="flex: 2; min-width: 120px;">
                <label style="font-size:11px; color:#475569;">Label Nilai</label>
                <input type="text" name="sebaran_values[]" class="form-control form-control-sm" required>
            </div>
            <div class="form-group mb-0" style="flex: 1; min-width: 80px;">
                <label style="font-size:11px; color:#475569;">Lebar Bar (%)</label>
                <input type="number" min="0" max="100" name="sebaran_widths[]" class="form-control form-control-sm" required>
            </div>
            <button type="button" class="btn btn-sm btn-outline-danger mt-3" onclick="removeRow(this)">
                <span class="material-icons" style="font-size:14px;vertical-align:middle;">delete</span>
            </button>
        `;
        container.appendChild(row);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const yearsInputs = document.querySelectorAll('input[name="stunting_years[]"]');
        yearsInputs.forEach(input => {
            input.addEventListener('input', function() { updateRadioValue(this); });
            input.addEventListener('change', function() { updateRadioValue(this); });
        });
    });

    // Submit loading state
    document.getElementById('statistik-form').addEventListener('submit', function() {
        const btn = document.getElementById('statistik-save-btn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-sync-alt fa-spin mr-1"></i> Menyimpan...';
    });
</script>
@endsection
