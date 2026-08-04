@extends('admin.layouts.admin')
@section('title', 'Ubah Dashboard Statistik')
@section('header_title', 'Ubah Dashboard Statistik')

@section('styles')
<style>
    .profile-tabs-nav {
        display: flex;
        border-bottom: 2px solid #E2E8F0;
        margin-bottom: 24px;
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
<div class="card card-outline card-success">
    <div class="card-body">
        
        <!-- Tab Navigation -->
        <div class="profile-tabs-nav">
            <button type="button" class="tab-nav-btn active" onclick="switchTab(event, 'tab-indicators')">
                <span class="material-icons">bar_chart</span>
                <span>Indikator &amp; Status</span>
            </button>
            <button type="button" class="tab-nav-btn" onclick="switchTab(event, 'tab-stunting')">
                <span class="material-icons">show_chart</span>
                <span>Grafik Tren Stunting</span>
            </button>
            <button type="button" class="tab-nav-btn" onclick="switchTab(event, 'tab-lists')">
                <span class="material-icons">list_alt</span>
                <span>Distribusi Nakes &amp; Zonasi</span>
            </button>
        </div>

        <form action="{{ route('admin.satudata.statistik.update') }}" method="POST">
            @csrf
            @method('PUT')

            <!-- ==================== TAB 1: INDICATORS & STATUS ==================== -->
            <div id="tab-indicators" class="profile-tab-panel active">
                <div class="form-group">
                    <label for="status_badge">Label Status Data (Keterangan Pojok Kanan Atas)</label>
                    <input type="text" name="status_badge" id="status_badge" value="{{ old('status_badge', $setting->status_badge) }}" class="form-control" required>
                    <small class="text-muted">Contoh: <strong>Data Riil Semester I 2026</strong></small>
                </div>

                <div class="border-top pt-3 mt-4 mb-3">
                    <h3 class="h6 font-weight-bold text-success">Data 4 Kartu Indikator Utama</h3>
                </div>

                <div class="row">
                    <!-- Card 1 -->
                    <div class="col-md-6 mb-3">
                        <div class="card p-3 mb-0" style="background:#F8FAFC; border:1px solid #E2E8F0;">
                            <span class="badge badge-success mb-2 align-self-start">KARTU 1: PUSKESMAS</span>
                            <div class="form-group">
                                <label>Angka/Nilai Utama</label>
                                <input type="text" name="stat_1_num" value="{{ old('stat_1_num', $setting->stat_1_num) }}" class="form-control form-control-sm" required>
                            </div>
                            <div class="form-group">
                                <label>Label Badge Atas</label>
                                <input type="text" name="stat_1_badge" value="{{ old('stat_1_badge', $setting->stat_1_badge) }}" class="form-control form-control-sm" required>
                            </div>
                            <div class="form-group mb-0">
                                <label>Keterangan Bawah (Caption)</label>
                                <input type="text" name="stat_1_caption" value="{{ old('stat_1_caption', $setting->stat_1_caption) }}" class="form-control form-control-sm" required>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-md-6 mb-3">
                        <div class="card p-3 mb-0" style="background:#F8FAFC; border:1px solid #E2E8F0;">
                            <span class="badge badge-success mb-2 align-self-start">KARTU 2: RUMAH SAKIT RUJUKAN</span>
                            <div class="form-group">
                                <label>Angka/Nilai Utama</label>
                                <input type="text" name="stat_2_num" value="{{ old('stat_2_num', $setting->stat_2_num) }}" class="form-control form-control-sm" required>
                            </div>
                            <div class="form-group">
                                <label>Label Badge Atas</label>
                                <input type="text" name="stat_2_badge" value="{{ old('stat_2_badge', $setting->stat_2_badge) }}" class="form-control form-control-sm" required>
                            </div>
                            <div class="form-group mb-0">
                                <label>Keterangan Bawah (Caption)</label>
                                <input type="text" name="stat_2_caption" value="{{ old('stat_2_caption', $setting->stat_2_caption) }}" class="form-control form-control-sm" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Card 3 -->
                    <div class="col-md-6 mb-3">
                        <div class="card p-3 mb-0" style="background:#F8FAFC; border:1px solid #E2E8F0;">
                            <span class="badge badge-success mb-2 align-self-start">KARTU 3: SDM KESEHATAN</span>
                            <div class="form-group">
                                <label>Angka/Nilai Utama</label>
                                <input type="text" name="stat_3_num" value="{{ old('stat_3_num', $setting->stat_3_num) }}" class="form-control form-control-sm" required>
                            </div>
                            <div class="form-group">
                                <label>Label Badge Atas</label>
                                <input type="text" name="stat_3_badge" value="{{ old('stat_3_badge', $setting->stat_3_badge) }}" class="form-control form-control-sm" required>
                            </div>
                            <div class="form-group mb-0">
                                <label>Keterangan Bawah (Caption)</label>
                                <input type="text" name="stat_3_caption" value="{{ old('stat_3_caption', $setting->stat_3_caption) }}" class="form-control form-control-sm" required>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="col-md-6 mb-3">
                        <div class="card p-3 mb-0" style="background:#F8FAFC; border:1px solid #E2E8F0;">
                            <span class="badge badge-success mb-2 align-self-start">KARTU 4: CAKUPAN IMUNISASI</span>
                            <div class="form-group">
                                <label>Angka/Nilai Utama</label>
                                <input type="text" name="stat_4_num" value="{{ old('stat_4_num', $setting->stat_4_num) }}" class="form-control form-control-sm" required>
                            </div>
                            <div class="form-group">
                                <label>Label Badge Atas</label>
                                <input type="text" name="stat_4_badge" value="{{ old('stat_4_badge', $setting->stat_4_badge) }}" class="form-control form-control-sm" required>
                            </div>
                            <div class="form-group mb-0">
                                <label>Keterangan Bawah (Caption)</label>
                                <input type="text" name="stat_4_caption" value="{{ old('stat_4_caption', $setting->stat_4_caption) }}" class="form-control form-control-sm" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== TAB 2: STUNTING TREND GRAPH ==================== -->
            <div id="tab-stunting" class="profile-tab-panel">
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
                            <label for="stunting_footer_note">Catatan Kaki Grafik (Bisa HTML/Bold)</label>
                            <input type="text" name="stunting_footer_note" id="stunting_footer_note" value="{{ old('stunting_footer_note', $setting->stunting_footer_note) }}" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="border-top pt-3 mt-4 mb-3">
                    <h3 class="h6 font-weight-bold text-success">Data Batang Grafik Tahunan</h3>
                    <small class="text-muted d-block mb-3">Tambahkan prevalensi stunting per tahun. Pilih tahun aktif untuk di-highlight di grafik.</small>
                </div>

                <div id="stunting-records-container">
                    @foreach($stuntingRecords as $record)
                        <div class="dynamic-row-item">
                            <div class="form-group mb-0" style="flex: 1; min-width: 120px;">
                                <label style="font-size:11px; color:#475569;">Tahun</label>
                                <input type="number" name="stunting_years[]" value="{{ $record->year }}" class="form-control form-control-sm" placeholder="Tahun" required onchange="updateRadioValue(this)">
                            </div>
                            <div class="form-group mb-0" style="flex: 1; min-width: 120px;">
                                <label style="font-size:11px; color:#475569;">Persentase (%)</label>
                                <input type="number" step="0.1" name="stunting_rates[]" value="{{ $record->rate }}" class="form-control form-control-sm" placeholder="e.g. 14.7" required>
                            </div>
                            <div class="mb-0 pt-3" style="min-width: 100px;">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="hl-year-{{ $record->year }}" name="highlighted_year" value="{{ $record->year }}" {{ $record->is_highlighted ? 'checked' : '' }} class="custom-control-input">
                                    <label class="custom-control-label font-weight-normal text-secondary" style="font-size: 13px; cursor:pointer;" for="hl-year-{{ $record->year }}">Highlight</label>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-danger mt-3" onclick="removeRow(this)">
                                <span class="material-icons" style="font-size:16px;vertical-align:middle;">delete</span>
                            </button>
                        </div>
                    @endforeach
                </div>

                <button type="button" class="btn btn-sm btn-outline-success mt-3" onclick="addStuntingRow()">
                    <span class="material-icons" style="font-size:14px;vertical-align:middle;">add</span> Tambah Data Tahun
                </button>
            </div>

            <!-- ==================== TAB 3: NAKES & ZONASI ==================== -->
            <div id="tab-lists" class="profile-tab-panel">
                
                <!-- Nakes Profesi List -->
                <div class="mb-4">
                    <h3 class="h6 font-weight-bold text-success mb-1">1. Distribusi Profesi Nakes</h3>
                    <small class="text-muted d-block mb-3">Mendaftarkan profesi nakes beserta label nilai dan lebar persentase bar visualnya.</small>
                    
                    <div id="nakes-rows-container">
                        @if($setting->nakes_data)
                            @foreach($setting->nakes_data as $nakes)
                                <div class="dynamic-row-item">
                                    <div class="form-group mb-0" style="flex: 2; min-width: 200px;">
                                        <label style="font-size:11px; color:#475569;">Nama Profesi</label>
                                        <input type="text" name="nakes_names[]" value="{{ $nakes['name'] }}" class="form-control form-control-sm" placeholder="e.g. Perawat Kesehatan" required>
                                    </div>
                                    <div class="form-group mb-0" style="flex: 2; min-width: 150px;">
                                        <label style="font-size:11px; color:#475569;">Label Nilai</label>
                                        <input type="text" name="nakes_values[]" value="{{ $nakes['value'] }}" class="form-control form-control-sm" placeholder="e.g. 1,604 (42%)" required>
                                    </div>
                                    <div class="form-group mb-0" style="flex: 1; min-width: 100px;">
                                        <label style="font-size:11px; color:#475569;">Lebar Bar (%)</label>
                                        <input type="number" min="0" max="100" name="nakes_widths[]" value="{{ $nakes['width'] }}" class="form-control form-control-sm" placeholder="0-100" required>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-danger mt-3" onclick="removeRow(this)">
                                        <span class="material-icons" style="font-size:16px;vertical-align:middle;">delete</span>
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
                <div class="border-top pt-4 mt-4">
                    <h3 class="h6 font-weight-bold text-success mb-1">2. Sebaran Puskesmas per Zonasi</h3>
                    <small class="text-muted d-block mb-3">Mendaftarkan sebaran zonasi geografis puskesmas, angka unit, dan lebar persentase bar visualnya.</small>
                    
                    <div id="sebaran-rows-container">
                        @if($setting->sebaran_data)
                            @foreach($setting->sebaran_data as $sebaran)
                                <div class="dynamic-row-item">
                                    <div class="form-group mb-0" style="flex: 2; min-width: 200px;">
                                        <label style="font-size:11px; color:#475569;">Nama Zonasi</label>
                                        <input type="text" name="sebaran_names[]" value="{{ $sebaran['name'] }}" class="form-control form-control-sm" placeholder="e.g. Zonasi Selatan" required>
                                    </div>
                                    <div class="form-group mb-0" style="flex: 2; min-width: 150px;">
                                        <label style="font-size:11px; color:#475569;">Label Nilai</label>
                                        <input type="text" name="sebaran_values[]" value="{{ $sebaran['value'] }}" class="form-control form-control-sm" placeholder="e.g. 17 Puskesmas (36%)" required>
                                    </div>
                                    <div class="form-group mb-0" style="flex: 1; min-width: 100px;">
                                        <label style="font-size:11px; color:#475569;">Lebar Bar (%)</label>
                                        <input type="number" min="0" max="100" name="sebaran_widths[]" value="{{ $sebaran['width'] }}" class="form-control form-control-sm" placeholder="0-100" required>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-danger mt-3" onclick="removeRow(this)">
                                        <span class="material-icons" style="font-size:16px;vertical-align:middle;">delete</span>
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

            <!-- Submit Button Footer -->
            <div class="border-top pt-3 mt-4 d-flex justify-content-end">
                <button type="submit" class="btn btn-success" style="padding: 10px 24px;">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">save</span> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Tab switching logic
    function switchTab(evt, tabId) {
        // Hide all panels
        const panels = document.querySelectorAll('.profile-tab-panel');
        panels.forEach(panel => panel.classList.remove('active'));

        // Deactivate all buttons
        const buttons = document.querySelectorAll('.tab-nav-btn');
        buttons.forEach(btn => btn.classList.remove('active'));

        // Show active panel and button
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

    // Dynamic row addition templates
    function addStuntingRow() {
        const container = document.getElementById('stunting-records-container');
        const count = container.children.length;
        const defaultYear = new Date().getFullYear();

        const row = document.createElement('div');
        row.className = 'dynamic-row-item';
        row.innerHTML = `
            <div class="form-group mb-0" style="flex: 1; min-width: 120px;">
                <label style="font-size:11px; color:#475569;">Tahun</label>
                <input type="number" name="stunting_years[]" class="form-control form-control-sm" placeholder="Tahun" required onchange="updateRadioValue(this)">
            </div>
            <div class="form-group mb-0" style="flex: 1; min-width: 120px;">
                <label style="font-size:11px; color:#475569;">Persentase (%)</label>
                <input type="number" step="0.1" name="stunting_rates[]" class="form-control form-control-sm" placeholder="e.g. 14.7" required>
            </div>
            <div class="mb-0 pt-3" style="min-width: 100px;">
                <div class="custom-control custom-radio">
                    <input type="radio" id="hl-year-new-\${count}" name="highlighted_year" value="" class="custom-control-input">
                    <label class="custom-control-label font-weight-normal text-secondary" style="font-size: 13px; cursor:pointer;" for="hl-year-new-\${count}">Highlight</label>
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-outline-danger mt-3" onclick="removeRow(this)">
                <span class="material-icons" style="font-size:16px;vertical-align:middle;">delete</span>
            </button>
        `;
        container.appendChild(row);
    }

    // Update Radio Button value when Year changes
    function updateRadioValue(input) {
        const row = input.closest('.dynamic-row-item');
        const radio = row.querySelector('input[type="radio"]');
        if (radio) {
            radio.value = input.value;
            // Also update the 'for' attribute and 'id' so click works correctly
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
            <div class="form-group mb-0" style="flex: 2; min-width: 200px;">
                <label style="font-size:11px; color:#475569;">Nama Profesi</label>
                <input type="text" name="nakes_names[]" class="form-control form-control-sm" placeholder="e.g. Perawat Kesehatan" required>
            </div>
            <div class="form-group mb-0" style="flex: 2; min-width: 150px;">
                <label style="font-size:11px; color:#475569;">Label Nilai</label>
                <input type="text" name="nakes_values[]" class="form-control form-control-sm" placeholder="e.g. 1,604 (42%)" required>
            </div>
            <div class="form-group mb-0" style="flex: 1; min-width: 100px;">
                <label style="font-size:11px; color:#475569;">Lebar Bar (%)</label>
                <input type="number" min="0" max="100" name="nakes_widths[]" class="form-control form-control-sm" placeholder="0-100" required>
            </div>
            <button type="button" class="btn btn-sm btn-outline-danger mt-3" onclick="removeRow(this)">
                <span class="material-icons" style="font-size:16px;vertical-align:middle;">delete</span>
            </button>
        `;
        container.appendChild(row);
    }

    function addSebaranRow() {
        const container = document.getElementById('sebaran-rows-container');
        const row = document.createElement('div');
        row.className = 'dynamic-row-item';
        row.innerHTML = `
            <div class="form-group mb-0" style="flex: 2; min-width: 200px;">
                <label style="font-size:11px; color:#475569;">Nama Zonasi</label>
                <input type="text" name="sebaran_names[]" class="form-control form-control-sm" placeholder="e.g. Zonasi Selatan" required>
            </div>
            <div class="form-group mb-0" style="flex: 2; min-width: 150px;">
                <label style="font-size:11px; color:#475569;">Label Nilai</label>
                <input type="text" name="sebaran_values[]" class="form-control form-control-sm" placeholder="e.g. 17 Puskesmas (36%)" required>
            </div>
            <div class="form-group mb-0" style="flex: 1; min-width: 100px;">
                <label style="font-size:11px; color:#475569;">Lebar Bar (%)</label>
                <input type="number" min="0" max="100" name="sebaran_widths[]" class="form-control form-control-sm" placeholder="0-100" required>
            </div>
            <button type="button" class="btn btn-sm btn-outline-danger mt-3" onclick="removeRow(this)">
                <span class="material-icons" style="font-size:16px;vertical-align:middle;">delete</span>
            </button>
        `;
        container.appendChild(row);
    }

    // Attach listeners on dynamic stunting year fields so their radio buttons align values
    document.addEventListener('DOMContentLoaded', function() {
        const yearsInputs = document.querySelectorAll('input[name="stunting_years[]"]');
        yearsInputs.forEach(input => {
            input.addEventListener('input', function() {
                updateRadioValue(this);
            });
            input.addEventListener('change', function() {
                updateRadioValue(this);
            });
        });
    });
</script>
@endsection
