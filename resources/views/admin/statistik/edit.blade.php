@extends('admin.layouts.admin')

@section('title', 'Ubah Dashboard Statistik')
@section('header_title', 'Ubah Dashboard Statistik')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/statistik.css') }}?v={{ time() }}">
@endsection

@section('content')
<div class="berita-admin-wrapper">
    <div class="admin-card">
        
        <!-- Alerts -->
        @if(session('success'))
            <div class="alert-success" style="background-color: #DEF7EC; color: #03543F; padding: 14px; border-radius: 3px; margin-bottom: 20px; font-weight: 600; display: flex; align-items: center; gap: 8px;">
                <span class="material-icons">check_circle</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="alert-danger" style="background-color: #FDE8E8; color: #9B1C1C; padding: 14px; border-radius: 3px; margin-bottom: 20px; font-weight: 600;">
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                    <span class="material-icons">error</span>
                    <span>Terdapat beberapa kesalahan penginputan:</span>
                </div>
                <ul style="margin-left: 28px; font-size: 14px; font-weight: 500;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Tab Navigation -->
        <div class="profile-tabs-nav">
            <button type="button" class="tab-nav-btn active" onclick="switchTab(event, 'tab-indicators')">
                <span class="material-icons" style="font-size: 18px;">bar_chart</span>
                <span>Indikator & Status</span>
            </button>
            <button type="button" class="tab-nav-btn" onclick="switchTab(event, 'tab-stunting')">
                <span class="material-icons" style="font-size: 18px;">show_chart</span>
                <span>Grafik Tren Stunting</span>
            </button>
            <button type="button" class="tab-nav-btn" onclick="switchTab(event, 'tab-lists')">
                <span class="material-icons" style="font-size: 18px;">list_alt</span>
                <span>Distribusi Nakes & Zonasi</span>
            </button>
        </div>

        <form action="{{ route('admin.satudata.statistik.update') }}" method="POST" class="admin-form">
            @csrf
            @method('PUT')

            <!-- ==================== TAB 1: INDICATORS & STATUS ==================== -->
            <div id="tab-indicators" class="profile-tab-panel active">
                
                <!-- Status Badge -->
                <div class="form-group" style="margin-bottom: 24px;">
                    <label for="status_badge">Label Status Data (Keterangan Pojok Kanan Atas)</label>
                    <input type="text" name="status_badge" id="status_badge" value="{{ old('status_badge', $setting->status_badge) }}" class="form-control-input" required>
                    <small style="color: #6B7280; font-size: 12px; display: block; margin-top: 4px;">Contoh: <strong>Data Riil Semester I 2026</strong></small>
                </div>

                <div style="border-top: 1px solid #E5E7EB; margin: 24px 0 16px; padding-top: 16px;">
                    <h3 style="color: #004F3B; font-size: 18px; font-weight: 700; margin-bottom: 12px;">Data 4 Kartu Indikator Utama</h3>
                </div>

                <div class="form-row-2col">
                    <!-- Card 1: Puskesmas -->
                    <div class="misi-card-field">
                        <span class="misi-card-number">KARTU 1: PUSKESMAS</span>
                        <div class="form-group" style="margin-bottom: 12px;">
                            <label>Angka/Nilai Utama</label>
                            <input type="text" name="stat_1_num" value="{{ old('stat_1_num', $setting->stat_1_num) }}" class="form-control-input" required>
                        </div>
                        <div class="form-group" style="margin-bottom: 12px;">
                            <label>Label Badge Atas</label>
                            <input type="text" name="stat_1_badge" value="{{ old('stat_1_badge', $setting->stat_1_badge) }}" class="form-control-input" required>
                        </div>
                        <div class="form-group">
                            <label>Keterangan Bawah (Caption)</label>
                            <input type="text" name="stat_1_caption" value="{{ old('stat_1_caption', $setting->stat_1_caption) }}" class="form-control-input" required>
                        </div>
                    </div>

                    <!-- Card 2: RS Rujukan -->
                    <div class="misi-card-field">
                        <span class="misi-card-number">KARTU 2: RUMAH SAKIT RUJUKAN</span>
                        <div class="form-group" style="margin-bottom: 12px;">
                            <label>Angka/Nilai Utama</label>
                            <input type="text" name="stat_2_num" value="{{ old('stat_2_num', $setting->stat_2_num) }}" class="form-control-input" required>
                        </div>
                        <div class="form-group" style="margin-bottom: 12px;">
                            <label>Label Badge Atas</label>
                            <input type="text" name="stat_2_badge" value="{{ old('stat_2_badge', $setting->stat_2_badge) }}" class="form-control-input" required>
                        </div>
                        <div class="form-group">
                            <label>Keterangan Bawah (Caption)</label>
                            <input type="text" name="stat_2_caption" value="{{ old('stat_2_caption', $setting->stat_2_caption) }}" class="form-control-input" required>
                        </div>
                    </div>
                </div>

                <div class="form-row-2col" style="margin-top: 16px;">
                    <!-- Card 3: SDM Kesehatan -->
                    <div class="misi-card-field">
                        <span class="misi-card-number">KARTU 3: SDM KESEHATAN</span>
                        <div class="form-group" style="margin-bottom: 12px;">
                            <label>Angka/Nilai Utama</label>
                            <input type="text" name="stat_3_num" value="{{ old('stat_3_num', $setting->stat_3_num) }}" class="form-control-input" required>
                        </div>
                        <div class="form-group" style="margin-bottom: 12px;">
                            <label>Label Badge Atas</label>
                            <input type="text" name="stat_3_badge" value="{{ old('stat_3_badge', $setting->stat_3_badge) }}" class="form-control-input" required>
                        </div>
                        <div class="form-group">
                            <label>Keterangan Bawah (Caption)</label>
                            <input type="text" name="stat_3_caption" value="{{ old('stat_3_caption', $setting->stat_3_caption) }}" class="form-control-input" required>
                        </div>
                    </div>

                    <!-- Card 4: Imunisasi -->
                    <div class="misi-card-field">
                        <span class="misi-card-number">KARTU 4: CAKUPAN IMUNISASI</span>
                        <div class="form-group" style="margin-bottom: 12px;">
                            <label>Angka/Nilai Utama</label>
                            <input type="text" name="stat_4_num" value="{{ old('stat_4_num', $setting->stat_4_num) }}" class="form-control-input" required>
                        </div>
                        <div class="form-group" style="margin-bottom: 12px;">
                            <label>Label Badge Atas</label>
                            <input type="text" name="stat_4_badge" value="{{ old('stat_4_badge', $setting->stat_4_badge) }}" class="form-control-input" required>
                        </div>
                        <div class="form-group">
                            <label>Keterangan Bawah (Caption)</label>
                            <input type="text" name="stat_4_caption" value="{{ old('stat_4_caption', $setting->stat_4_caption) }}" class="form-control-input" required>
                        </div>
                    </div>
                </div>

            </div>

            <!-- ==================== TAB 2: STUNTING TREND GRAPH ==================== -->
            <div id="tab-stunting" class="profile-tab-panel">
                
                <div class="form-row-2col">
                    <div class="form-group">
                        <label for="stunting_title">Judul Grafik Stunting</label>
                        <input type="text" name="stunting_title" id="stunting_title" value="{{ old('stunting_title', $setting->stunting_title) }}" class="form-control-input" required>
                    </div>
                    <div class="form-group">
                        <label for="stunting_subtitle">Subjudul Grafik Stunting</label>
                        <input type="text" name="stunting_subtitle" id="stunting_subtitle" value="{{ old('stunting_subtitle', $setting->stunting_subtitle) }}" class="form-control-input" required>
                    </div>
                </div>

                <div class="form-row-2col">
                    <div class="form-group">
                        <label for="stunting_trend_badge">Badge Keterangan Tren</label>
                        <input type="text" name="stunting_trend_badge" id="stunting_trend_badge" value="{{ old('stunting_trend_badge', $setting->stunting_trend_badge) }}" class="form-control-input" required>
                    </div>
                    <div class="form-group">
                        <label for="stunting_footer_note">Catatan Kaki Grafik (Bisa HTML/Bold)</label>
                        <input type="text" name="stunting_footer_note" id="stunting_footer_note" value="{{ old('stunting_footer_note', $setting->stunting_footer_note) }}" class="form-control-input" required>
                    </div>
                </div>

                <div style="border-top: 1px solid #E5E7EB; margin: 24px 0 16px; padding-top: 16px;">
                    <h3 style="color: #004F3B; font-size: 18px; font-weight: 700; margin-bottom: 4px;">Data Batang Grafik Tahunan</h3>
                    <p style="color: #6B7280; font-size: 13px; margin-bottom: 12px;">Tambahkan nilai prevalensi untuk masing-masing tahun. Pilih satu tahun untuk di-highlight aktif di grafik.</p>
                </div>

                <div id="stunting-records-container" class="dynamic-list-wrapper">
                    @foreach($stuntingRecords as $record)
                        <div class="dynamic-row-item">
                            <div class="form-group" style="flex: 1; margin: 0;">
                                <label style="font-size: 12px; margin-bottom: 4px;">Tahun</label>
                                <input type="number" name="stunting_years[]" value="{{ $record->year }}" class="form-control-input" placeholder="Tahun" required>
                            </div>
                            <div class="form-group" style="flex: 1; margin: 0;">
                                <label style="font-size: 12px; margin-bottom: 4px;">Persentase (%)</label>
                                <input type="number" step="0.1" name="stunting_rates[]" value="{{ $record->rate }}" class="form-control-input" placeholder="Contoh: 14.7" required>
                            </div>
                            <div style="flex-shrink: 0; padding-top: 18px;">
                                <label class="highlight-radio-label">
                                    <input type="radio" name="highlighted_year" value="{{ $record->year }}" {{ $record->is_highlighted ? 'checked' : '' }}>
                                    <span>Highlight</span>
                                </label>
                            </div>
                            <div style="flex-shrink: 0; padding-top: 18px;">
                                <button type="button" class="btn-remove-row" onclick="removeRow(this)">
                                    <span class="material-icons">delete</span>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button type="button" class="btn-add-row" onclick="addStuntingRow()" style="margin-top: 12px;">
                    <span class="material-icons">add</span>
                    <span>Tambah Data Tahun</span>
                </button>

            </div>

            <!-- ==================== TAB 3: NAKES & ZONASI ==================== -->
            <div id="tab-lists" class="profile-tab-panel">
                
                <!-- Nakes Profesi List -->
                <div>
                    <h3 style="color: #004F3B; font-size: 18px; font-weight: 700; margin-bottom: 4px;">1. Distribusi Profesi Nakes</h3>
                    <p style="color: #6B7280; font-size: 13px; margin-bottom: 12px;">Mendaftarkan baris profesi nakes beserta label nilai dan lebar persentase bar-nya.</p>
                </div>

                <div id="nakes-rows-container" class="dynamic-list-wrapper">
                    @if($setting->nakes_data)
                        @foreach($setting->nakes_data as $nakes)
                            <div class="dynamic-row-item">
                                <div class="form-group" style="flex: 2; margin: 0;">
                                    <label style="font-size: 12px; margin-bottom: 4px;">Nama Profesi</label>
                                    <input type="text" name="nakes_names[]" value="{{ $nakes['name'] }}" class="form-control-input" placeholder="Contoh: Perawat Kesehatan" required>
                                </div>
                                <div class="form-group" style="flex: 2; margin: 0;">
                                    <label style="font-size: 12px; margin-bottom: 4px;">Label Nilai</label>
                                    <input type="text" name="nakes_values[]" value="{{ $nakes['value'] }}" class="form-control-input" placeholder="Contoh: 1,604 (42%)" required>
                                </div>
                                <div class="form-group" style="flex: 1; margin: 0;">
                                    <label style="font-size: 12px; margin-bottom: 4px;">Lebar Bar (%)</label>
                                    <input type="number" min="0" max="100" name="nakes_widths[]" value="{{ $nakes['width'] }}" class="form-control-input" placeholder="Contoh: 42" required>
                                </div>
                                <div style="flex-shrink: 0; padding-top: 18px;">
                                    <button type="button" class="btn-remove-row" onclick="removeRow(this)">
                                        <span class="material-icons">delete</span>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <button type="button" class="btn-add-row" onclick="addNakesRow()" style="margin-bottom: 32px;">
                    <span class="material-icons">add</span>
                    <span>Tambah Profesi Nakes</span>
                </button>

                <!-- Sebaran Zonasi List -->
                <div style="border-top: 1px solid #E5E7EB; margin-top: 24px; padding-top: 24px;">
                    <h3 style="color: #004F3B; font-size: 18px; font-weight: 700; margin-bottom: 4px;">2. Sebaran Puskesmas per Zonasi</h3>
                    <p style="color: #6B7280; font-size: 13px; margin-bottom: 12px;">Mendaftarkan sebaran zonasi geografis puskesmas, angka unit, dan lebar persentase bar-nya.</p>
                </div>

                <div id="sebaran-rows-container" class="dynamic-list-wrapper">
                    @if($setting->sebaran_data)
                        @foreach($setting->sebaran_data as $sebaran)
                            <div class="dynamic-row-item">
                                <div class="form-group" style="flex: 2; margin: 0;">
                                    <label style="font-size: 12px; margin-bottom: 4px;">Nama Zonasi</label>
                                    <input type="text" name="sebaran_names[]" value="{{ $sebaran['name'] }}" class="form-control-input" placeholder="Contoh: Zonasi Selatan" required>
                                </div>
                                <div class="form-group" style="flex: 2; margin: 0;">
                                    <label style="font-size: 12px; margin-bottom: 4px;">Label Nilai</label>
                                    <input type="text" name="sebaran_values[]" value="{{ $sebaran['value'] }}" class="form-control-input" placeholder="Contoh: 17 Puskesmas (36%)" required>
                                </div>
                                <div class="form-group" style="flex: 1; margin: 0;">
                                    <label style="font-size: 12px; margin-bottom: 4px;">Lebar Bar (%)</label>
                                    <input type="number" min="0" max="100" name="sebaran_widths[]" value="{{ $sebaran['width'] }}" class="form-control-input" placeholder="Contoh: 36" required>
                                </div>
                                <div style="flex-shrink: 0; padding-top: 18px;">
                                    <button type="button" class="btn-remove-row" onclick="removeRow(this)">
                                        <span class="material-icons">delete</span>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <button type="button" class="btn-add-row" onclick="addSebaranRow()">
                    <span class="material-icons">add</span>
                    <span>Tambah Zonasi Puskesmas</span>
                </button>

            </div>

            <!-- Submit Button Footer -->
            <div style="border-top: 1px solid #E5E7EB; margin-top: 32px; padding-top: 20px; display: flex; justify-content: flex-end;">
                <button type="submit" class="btn-primary" style="background-color: #004F3B; color: #FFFFFF; font-weight: 700; padding: 12px 28px; display: inline-flex; align-items: center; gap: 8px; border-radius: 3px; border: none; cursor: pointer; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#003d2e'" onmouseout="this.style.backgroundColor='#004F3B'">
                    <span class="material-icons">save</span>
                    <span>Simpan Perubahan</span>
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

    // Remove row generic function
    function removeRow(button) {
        if(confirm('Apakah Anda yakin ingin menghapus baris data ini?')) {
            const row = button.closest('.dynamic-row-item');
            row.remove();
        }
    }

    // Dynamic row addition templates
    function addStuntingRow() {
        const container = document.getElementById('stunting-records-container');
        const count = container.children.length;
        const defaultYear = new Date().getFullYear();

        const row = document.createElement('div');
        row.className = 'dynamic-row-item';
        row.innerHTML = `
            <div class="form-group" style="flex: 1; margin: 0;">
                <label style="font-size: 12px; margin-bottom: 4px;">Tahun</label>
                <input type="number" name="stunting_years[]" class="form-control-input" placeholder="Tahun" required onchange="updateRadioValue(this)">
            </div>
            <div class="form-group" style="flex: 1; margin: 0;">
                <label style="font-size: 12px; margin-bottom: 4px;">Persentase (%)</label>
                <input type="number" step="0.1" name="stunting_rates[]" class="form-control-input" placeholder="Contoh: 14.7" required>
            </div>
            <div style="flex-shrink: 0; padding-top: 18px;">
                <label class="highlight-radio-label">
                    <input type="radio" name="highlighted_year" value="">
                    <span>Highlight</span>
                </label>
            </div>
            <div style="flex-shrink: 0; padding-top: 18px;">
                <button type="button" class="btn-remove-row" onclick="removeRow(this)">
                    <span class="material-icons">delete</span>
                </button>
            </div>
        `;
        container.appendChild(row);
    }

    // Update Radio Button value when Year changes
    function updateRadioValue(input) {
        const row = input.closest('.dynamic-row-item');
        const radio = row.querySelector('input[type="radio"]');
        if (radio) {
            radio.value = input.value;
        }
    }

    function addNakesRow() {
        const container = document.getElementById('nakes-rows-container');
        const row = document.createElement('div');
        row.className = 'dynamic-row-item';
        row.innerHTML = `
            <div class="form-group" style="flex: 2; margin: 0;">
                <label style="font-size: 12px; margin-bottom: 4px;">Nama Profesi</label>
                <input type="text" name="nakes_names[]" class="form-control-input" placeholder="Contoh: Perawat Kesehatan" required>
            </div>
            <div class="form-group" style="flex: 2; margin: 0;">
                <label style="font-size: 12px; margin-bottom: 4px;">Label Nilai</label>
                <input type="text" name="nakes_values[]" class="form-control-input" placeholder="Contoh: 1,604 (42%)" required>
            </div>
            <div class="form-group" style="flex: 1; margin: 0;">
                <label style="font-size: 12px; margin-bottom: 4px;">Lebar Bar (%)</label>
                <input type="number" min="0" max="100" name="nakes_widths[]" class="form-control-input" placeholder="Contoh: 42" required>
            </div>
            <div style="flex-shrink: 0; padding-top: 18px;">
                <button type="button" class="btn-remove-row" onclick="removeRow(this)">
                    <span class="material-icons">delete</span>
                </button>
            </div>
        `;
        container.appendChild(row);
    }

    function addSebaranRow() {
        const container = document.getElementById('sebaran-rows-container');
        const row = document.createElement('div');
        row.className = 'dynamic-row-item';
        row.innerHTML = `
            <div class="form-group" style="flex: 2; margin: 0;">
                <label style="font-size: 12px; margin-bottom: 4px;">Nama Zonasi</label>
                <input type="text" name="sebaran_names[]" class="form-control-input" placeholder="Contoh: Zonasi Selatan" required>
            </div>
            <div class="form-group" style="flex: 2; margin: 0;">
                <label style="font-size: 12px; margin-bottom: 4px;">Label Nilai</label>
                <input type="text" name="sebaran_values[]" class="form-control-input" placeholder="Contoh: 17 Puskesmas (36%)" required>
            </div>
            <div class="form-group" style="flex: 1; margin: 0;">
                <label style="font-size: 12px; margin-bottom: 4px;">Lebar Bar (%)</label>
                <input type="number" min="0" max="100" name="sebaran_widths[]" class="form-control-input" placeholder="Contoh: 36" required>
            </div>
            <div style="flex-shrink: 0; padding-top: 18px;">
                <button type="button" class="btn-remove-row" onclick="removeRow(this)">
                    <span class="material-icons">delete</span>
                </button>
            </div>
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
