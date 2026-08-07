@extends('admin.layouts.admin')
@section('title', 'Tren Stunting')
@section('header_title', 'Tren Stunting')

@section('styles')
<style>
    .dynamic-row-item {
        background: #F8FAFC;
        border: 1px solid var(--border-subtle);
        border-radius: 8px;
        padding: 16px 20px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
        position: relative;
    }
</style>
@endsection

@section('content')


<div class="row">
    <div class="col-12">
        <div class="card card-outline card-success">
            <div class="card-header d-flex align-items-center" style="padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
                <span class="material-icons text-success">show_chart</span>
                <span>Pengaturan Grafik Tren Stunting</span>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.satudata.statistik.update') }}" method="POST" id="statistik-form">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="section" value="stunting">

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

                <div class="d-flex align-items-center justify-content-between mt-4 mb-3 pb-2" style="border-bottom: 1px solid var(--border-subtle);">
                    <div style="font-size:15px;font-weight:700;color:#004F3B;margin:24px 0 16px;display:flex;align-items:center;gap:8px;border-bottom:1px solid #E2E8F0;padding-bottom:10px;">
                        <span class="material-icons text-success">calendar_today</span>
                        <span>Data Batang Grafik Tahunan</span>
                    </div>
                    <div class="d-flex" style="gap: 8px;">
                        <a href="{{ route('admin.satudata.statistik.import') }}" class="btn btn-outline-info btn-sm">
                            <span class="material-icons" style="font-size:16px; vertical-align:middle; margin-right:4px;">upload</span> Import CSV
                        </a>
                        <button type="button" class="btn btn-outline-success btn-sm" onclick="addStuntingRow()">
                            <span class="material-icons" style="font-size:16px; vertical-align:middle; margin-right:4px;">add</span> Tambah Data Tahun
                        </button>
                    </div>
                </div>

                <div id="stunting-records-container">
                    @foreach($stuntingRecords as $index => $record)
                        <div class="dynamic-row-item">
                            <div class="form-group mb-0" style="flex: 1; min-width: 120px;">
                                <label style="font-size:11.5px; font-weight:700; color:#475569;">Tahun <span class="text-danger">*</span></label>
                                <input type="number" name="stunting_years[]" value="{{ $record->year }}" class="form-control form-control-sm" required onchange="updateRadioValue(this)">
                            </div>
                            <div class="form-group mb-0" style="flex: 1; min-width: 120px;">
                                <label style="font-size:11.5px; font-weight:700; color:#475569;">Jml Bayi Stunting <span class="text-danger">*</span></label>
                                <input type="number" name="stunting_balita_stunt[]" value="{{ $record->balita_stunting ?? '' }}" class="form-control form-control-sm" placeholder="4451" required>
                            </div>
                            <div class="mb-0 pt-3" style="min-width: 90px;">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="hl-year-{{ $record->year }}" name="highlighted_year" value="{{ $record->year }}" {{ $record->is_highlighted ? 'checked' : '' }} class="custom-control-input">
                                    <label class="custom-control-label font-weight-normal text-secondary" style="font-size: 12.5px; cursor:pointer;" for="hl-year-{{ $record->year }}">Highlight</label>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-danger mt-3" onclick="removeRow(this)">
                                <span class="material-icons" style="font-size:16px;vertical-align:middle;">delete</span>
                            </button>
                        </div>
                    @endforeach
                </div>

                <div class="border-top pt-4 mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success-dark px-4" id="statistik-save-btn">
                        <span class="material-icons" style="font-size: 16px; vertical-align: middle; margin-right: 4px;">save</span> Simpan Tren Stunting
                    </button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function addStuntingRow() {
        const container = document.getElementById('stunting-records-container');
        const count = container.children.length;

        const row = document.createElement('div');
        row.className = 'dynamic-row-item';
        row.innerHTML = `
            <div class="form-group mb-0" style="flex: 1; min-width: 120px;">
                <label style="font-size:11.5px; font-weight:700; color:#475569;">Tahun</label>
                <input type="number" name="stunting_years[]" class="form-control form-control-sm" required onchange="updateRadioValue(this)">
            </div>
            <div class="form-group mb-0" style="flex: 1; min-width: 120px;">
                <label style="font-size:11.5px; font-weight:700; color:#475569;">Jml Bayi Stunting</label>
                <input type="number" name="stunting_balita_stunt[]" class="form-control form-control-sm" placeholder="4451" required>
            </div>
            <div class="mb-0 pt-3" style="min-width: 90px;">
                <div class="custom-control custom-radio">
                    <input type="radio" id="hl-year-new-${count}" name="highlighted_year" value="" class="custom-control-input">
                    <label class="custom-control-label font-weight-normal text-secondary" style="font-size: 12.5px; cursor:pointer;" for="hl-year-new-${count}">Highlight</label>
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-outline-danger mt-3" onclick="removeRow(this)">
                <span class="material-icons" style="font-size:16px;vertical-align:middle;">delete</span>
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
