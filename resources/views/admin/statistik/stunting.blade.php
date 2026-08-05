@extends('admin.layouts.admin')
@section('title', 'Tren Stunting')
@section('header_title', 'Tren Stunting')

@section('styles')
<style>
    .custom-form-card {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: var(--card-shadow);
        border: none;
        padding: 20px 24px;
        margin-bottom: 24px;
    }
    .form-section-title {
        font-size: 16px;
        font-weight: 700;
        color: #004F3B;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
        border-bottom: 1px solid var(--border-subtle);
        padding-bottom: 10px;
    }
    .dynamic-row-item {
        background: #F8FAFC;
        border: 1px solid var(--border-subtle);
        border-radius: 6px;
        padding: 8px 12px;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
        position: relative;
    }
    .dynamic-row-item .form-group {
        margin-bottom: 0 !important;
    }
    .dynamic-row-item label {
        margin-bottom: 1px !important;
        font-size: 10.5px !important;
    }
    .dynamic-row-item .form-control-sm {
        height: 26px;
        padding: 1px 6px;
        font-size: 12px;
    }
    .dynamic-row-item .text-catatan {
        height: 26px;
    }
    .dynamic-row-item .radio-wrap {
        padding-top: 0 !important;
    }
    .dynamic-row-item .btn-outline-danger {
        padding: 1px 5px;
    }
    .year-filter-tabs {
        display: flex;
        gap: 0;
        border-bottom: 2px solid #E2E8F0;
        margin-bottom: 16px;
    }
    .year-filter-tab {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13px;
        font-weight: 600;
        color: #64748B;
        background: transparent;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-bottom: 3px solid transparent;
        margin-bottom: -2px;
        transition: all 0.2s ease;
        white-space: nowrap;
    }
    .year-filter-tab:hover {
        color: #009966;
        background-color: rgba(0, 153, 102, 0.04);
    }
    .year-filter-tab.active {
        color: #009966;
        border-bottom-color: #009966;
        font-weight: 700;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-12">

        <div class="custom-form-card">
            <form action="{{ route('admin.satudata.statistik.update') }}" method="POST" id="statistik-form">
                @csrf
                @method('PUT')
                <input type="hidden" name="section" value="stunting">

                <div class="form-section-title">
                    <span class="material-icons text-success">show_chart</span>
                    <span>Pengaturan Grafik Tren Stunting</span>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stunting_title">Judul Grafik Stunting <span class="text-danger">*</span></label>
                            <input type="text" name="stunting_title" id="stunting_title" value="{{ old('stunting_title', $setting->stunting_title) }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stunting_subtitle">Subjudul Grafik Stunting <span class="text-danger">*</span></label>
                            <input type="text" name="stunting_subtitle" id="stunting_subtitle" value="{{ old('stunting_subtitle', $setting->stunting_subtitle) }}" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stunting_trend_badge">Badge Keterangan Tren <span class="text-danger">*</span></label>
                            <input type="text" name="stunting_trend_badge" id="stunting_trend_badge" value="{{ old('stunting_trend_badge', $setting->stunting_trend_badge) }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stunting_footer_note">Catatan Kaki Grafik <span class="text-danger">*</span></label>
                            <input type="text" name="stunting_footer_note" id="stunting_footer_note" value="{{ old('stunting_footer_note', $setting->stunting_footer_note) }}" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-between mt-4 mb-3 pb-2" style="border-bottom: 1px solid var(--border-subtle);">
                    <div class="form-section-title mb-0" style="border-bottom: none; padding-bottom: 0;">
                        <span class="material-icons text-success">calendar_today</span>
                        <span>Data Batang Grafik Tahunan</span>
                    </div>
                    <button type="button" class="btn btn-outline-success btn-sm" onclick="addStuntingRow()">
                        <span class="material-icons" style="font-size:16px; vertical-align:middle; margin-right:4px;">add</span> Tambah Data Tahun
                    </button>
                </div>

                @php
                    $years = $stuntingRecords->pluck('year')->sort()->values();
                    $minY = $years->first();
                    $maxY = $years->last();
                @endphp
                <div class="year-filter-tabs">
                    <button type="button" class="year-filter-tab active" data-range="all" onclick="filterYearRows('all', this)">Semua ({{ $minY }}–{{ $maxY }})</button>
                    <button type="button" class="year-filter-tab" data-range="3" onclick="filterYearRows('3', this)">3 Tahun Terakhir</button>
                    <button type="button" class="year-filter-tab" data-range="5" onclick="filterYearRows('5', this)">5 Tahun Terakhir</button>
                </div>

                <div id="stunting-records-container">
                    @foreach($stuntingRecords as $index => $record)
                        <div class="dynamic-row-item" data-year="{{ $record->year }}" style="flex-direction: column; align-items: stretch;">
                            <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                                <div class="form-group mb-0" style="flex: 1; min-width: 100px;">
                                    <label style="font-size:10.5px; font-weight:700; color:#475569;">Tahun <span class="text-danger">*</span></label>
                                    <input type="number" name="stunting_years[]" value="{{ $record->year }}" class="form-control form-control-sm" required onchange="updateRadioValue(this); this.closest('.dynamic-row-item').dataset.year = this.value;">
                                </div>
                                <div class="form-group mb-0" style="flex: 1; min-width: 100px;">
                                    <label style="font-size:10.5px; font-weight:700; color:#475569;">Persentase (%) <span class="text-danger">*</span></label>
                                    <input type="number" step="0.1" name="stunting_rates[]" value="{{ $record->rate }}" class="form-control form-control-sm" required>
                                </div>
                                <div class="mb-0 radio-wrap" style="min-width: 90px;">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="hl-year-{{ $record->year }}" name="highlighted_year" value="{{ $record->year }}" {{ $record->is_highlighted ? 'checked' : '' }} class="custom-control-input">
                                        <label class="custom-control-label font-weight-normal text-secondary" style="font-size: 11.5px; cursor:pointer;" for="hl-year-{{ $record->year }}">Highlight</label>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeRow(this)">
                                    <span class="material-icons" style="font-size:14px;vertical-align:middle;">delete</span>
                                </button>
                            </div>
                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(130px, 1fr)); gap: 6px; margin-top: 6px; padding-top: 6px; border-top: 1px dashed var(--border-subtle);">
                                <div class="form-group mb-0">
                                    <label style="font-size:10.5px; font-weight:700; color:#475569; margin-bottom:1px;">Total Balita</label>
                                    <input type="number" name="stunting_total_balita[]" value="{{ $record->total_balita ?? '' }}" class="form-control form-control-sm" placeholder="Contoh: 44100">
                                </div>
                                <div class="form-group mb-0">
                                    <label style="font-size:10.5px; font-weight:700; color:#475569; margin-bottom:1px;">Jml Stunting</label>
                                    <input type="number" name="stunting_balita_stunt[]" value="{{ $record->balita_stunting ?? '' }}" class="form-control form-control-sm" placeholder="4451">
                                </div>
                                <div class="form-group mb-0">
                                    <label style="font-size:10.5px; font-weight:700; color:#475569; margin-bottom:1px;">Wil. Terendah</label>
                                    <input type="text" name="stunting_wil_terendah[]" value="{{ $record->wilayah_terendah ?? '' }}" class="form-control form-control-sm" placeholder="Pacet">
                                </div>
                                <div class="form-group mb-0">
                                    <label style="font-size:10.5px; font-weight:700; color:#475569; margin-bottom:1px;">Wil. Tertinggi</label>
                                    <input type="text" name="stunting_wil_tertinggi[]" value="{{ $record->wilayah_tertinggi ?? '' }}" class="form-control form-control-sm" placeholder="Naringgul">
                                </div>
                                <div class="form-group mb-0" style="grid-column: 1 / -1;">
                                    <label style="font-size:10.5px; font-weight:700; color:#475569; margin-bottom:1px;">Catatan</label>
                                    <input type="text" name="stunting_catatan[]" value="{{ $record->catatan ?? '' }}" class="form-control form-control-sm text-catatan" placeholder="Catatan tambahan...">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="border-top pt-4 mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success px-4" id="statistik-save-btn">
                        <span class="material-icons" style="font-size: 16px; vertical-align: middle; margin-right: 4px;">save</span> Simpan Tren Stunting
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function filterYearRows(range, btn) {
        document.querySelectorAll('.year-filter-tab').forEach(t => t.classList.remove('active'));
        btn.classList.add('active');

        const rows = document.querySelectorAll('#stunting-records-container .dynamic-row-item');
        const allYears = Array.from(rows).map(r => parseInt(r.dataset.year)).filter(y => !isNaN(y));
        const maxYear = Math.max(...allYears);
        let minShow = range === 'all' ? Math.min(...allYears) : maxYear - parseInt(range) + 1;

        rows.forEach(row => {
            const year = parseInt(row.dataset.year);
            row.style.display = (isNaN(year) || year >= minShow) ? '' : 'none';
        });
    }

    function addStuntingRow() {
        const container = document.getElementById('stunting-records-container');
        const count = container.children.length;

        const row = document.createElement('div');
        row.className = 'dynamic-row-item';
        row.style.flexDirection = 'column';
        row.style.alignItems = 'stretch';
        row.dataset.year = '';
        row.innerHTML = `
            <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                <div class="form-group mb-0" style="flex: 1; min-width: 100px;">
                    <label style="font-size:10.5px; font-weight:700; color:#475569;">Tahun</label>
                    <input type="number" name="stunting_years[]" class="form-control form-control-sm" required onchange="updateRadioValue(this); this.closest('.dynamic-row-item').dataset.year = this.value;">
                </div>
                <div class="form-group mb-0" style="flex: 1; min-width: 100px;">
                    <label style="font-size:10.5px; font-weight:700; color:#475569;">Persentase (%)</label>
                    <input type="number" step="0.1" name="stunting_rates[]" class="form-control form-control-sm" required>
                </div>
                <div class="mb-0 radio-wrap" style="min-width: 90px;">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="hl-year-new-\${count}" name="highlighted_year" value="" class="custom-control-input">
                        <label class="custom-control-label font-weight-normal text-secondary" style="font-size: 11.5px; cursor:pointer;" for="hl-year-new-\${count}">Highlight</label>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeRow(this)">
                    <span class="material-icons" style="font-size:14px;vertical-align:middle;">delete</span>
                </button>
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(130px, 1fr)); gap: 6px; margin-top: 6px; padding-top: 6px; border-top: 1px dashed var(--border-subtle);">
                <div class="form-group mb-0">
                    <label style="font-size:10.5px; font-weight:700; color:#475569; margin-bottom:1px;">Total Balita</label>
                    <input type="number" name="stunting_total_balita[]" class="form-control form-control-sm" placeholder="44100">
                </div>
                <div class="form-group mb-0">
                    <label style="font-size:10.5px; font-weight:700; color:#475569; margin-bottom:1px;">Jml Stunting</label>
                    <input type="number" name="stunting_balita_stunt[]" class="form-control form-control-sm" placeholder="4451">
                </div>
                <div class="form-group mb-0">
                    <label style="font-size:10.5px; font-weight:700; color:#475569; margin-bottom:1px;">Wil. Terendah</label>
                    <input type="text" name="stunting_wil_terendah[]" class="form-control form-control-sm" placeholder="Pacet">
                </div>
                <div class="form-group mb-0">
                    <label style="font-size:10.5px; font-weight:700; color:#475569; margin-bottom:1px;">Wil. Tertinggi</label>
                    <input type="text" name="stunting_wil_tertinggi[]" class="form-control form-control-sm" placeholder="Naringgul">
                </div>
                <div class="form-group mb-0" style="grid-column: 1 / -1;">
                    <label style="font-size:10.5px; font-weight:700; color:#475569; margin-bottom:1px;">Catatan</label>
                    <input type="text" name="stunting_catatan[]" class="form-control form-control-sm text-catatan" placeholder="Catatan tambahan...">
                </div>
            </div>
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

    function removeRow(btn) {
        btn.closest('.dynamic-row-item').remove();
    }

    document.addEventListener('DOMContentLoaded', function() {
        const yearsInputs = document.querySelectorAll('input[name="stunting_years[]"]');
        yearsInputs.forEach(input => {
            input.addEventListener('input', function() { updateRadioValue(this); });
            input.addEventListener('change', function() { updateRadioValue(this); });
        });
    });

    document.getElementById('statistik-form').addEventListener('submit', function() {
        const btn = document.getElementById('statistik-save-btn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-sync-alt fa-spin mr-1"></i> Menyimpan...';
    });
</script>
@endsection
