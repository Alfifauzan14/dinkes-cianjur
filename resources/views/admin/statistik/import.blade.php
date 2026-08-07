@extends('admin.layouts.admin')
@section('title', 'Import Data Stunting')
@section('header_title', 'Import Data Stunting')

@section('styles')
<style>
    .import-type-tabs {
        display: flex;
        gap: 0;
        border-bottom: 2px solid #E2E8F0;
        margin-bottom: 24px;
    }
    .import-type-tab {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 14px;
        font-weight: 600;
        color: #64748B;
        background: transparent;
        border: none;
        padding: 12px 24px;
        cursor: pointer;
        border-bottom: 3px solid transparent;
        margin-bottom: -2px;
        transition: all 0.2s ease;
        white-space: nowrap;
    }
    .import-type-tab:hover {
        color: #009966;
        background-color: rgba(0, 153, 102, 0.04);
    }
    .import-type-tab.active {
        color: #009966;
        border-bottom-color: #009966;
        font-weight: 700;
    }
    .import-panel {
        display: none;
    }
    .import-panel.active {
        display: block;
    }
    .upload-zone {
        border: 2px dashed #CBD5E1;
        border-radius: 8px;
        padding: 48px;
        text-align: center;
        background: #F8FAFC;
        margin-bottom: 24px;
        cursor: pointer;
        transition: border-color 0.2s, background-color 0.2s;
    }
    .upload-zone:hover {
        border-color: #009966;
        background-color: #F0FDF4;
    }
    .upload-zone.dragover {
        border-color: #009966;
        background-color: #F0FDF4;
    }
    .preview-table {
        font-size: 13px;
    }
    .preview-table th {
        background: #F1F5F9;
        font-weight: 700;
        color: #475569;
    }
    .preview-table td {
        vertical-align: middle;
    }
    .change-badge {
        display: inline-block;
        font-size: 11px;
        font-weight: 700;
        padding: 2px 6px;
        border-radius: 3px;
    }
    .change-down {
        background-color: #DCFCE7;
        color: #16A34A;
    }
    .change-up {
        background-color: #FEE2E2;
        color: #DC2626;
    }
</style>
@endsection

@section('content')
<div class="card card-outline card-success mb-4">
    <div class="card-header d-flex align-items-center" style="padding:12px 16px;text-align:left !important;">
        <div style="text-align:left !important;">
            <h2 class="h6 font-weight-bold text-success mb-0" style="text-align:left !important;">Import Data Stunting</h2>
            <p class="text-muted mb-0" style="font-size:12px;text-align:left !important;">Unggah file CSV untuk memperbarui data grafik stunting.</p>
        </div>
        <div class="d-flex ms-auto" style="gap:8px;margin-left:auto !important;">
            <a href="{{ route('admin.satudata.statistik.template') }}" class="btn btn-sm btn-outline-success">
                <span class="material-icons" style="font-size:16px;vertical-align:middle;">download</span> Download Template
            </a>
            <a href="{{ route('admin.satudata.statistik.edit', ['section' => 'stunting']) }}" class="btn btn-sm btn-outline-secondary">
                <span class="material-icons" style="font-size:16px;vertical-align:middle;">arrow_back</span> Kembali
            </a>
        </div>
    </div>

    <div class="card-body">
        @if(session('import_errors'))
            <div class="alert alert-warning">
                <div class="font-weight-bold mb-1">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">warning</span>
                    Beberapa baris dilewati:
                </div>
                <ul class="mb-0 pl-3" style="font-size: 13px;">
                    @foreach(session('import_errors') as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="import-type-tabs">
            <button type="button" class="import-type-tab active" onclick="switchTab('government', this)">
                <span class="material-icons" style="font-size:16px;vertical-align:middle;margin-right:4px;">account_balance</span>
                Data Pemerintah
            </button>
            <button type="button" class="import-type-tab" onclick="switchTab('template', this)">
                <span class="material-icons" style="font-size:16px;vertical-align:middle;margin-right:4px;">description</span>
                Template Manual
            </button>
        </div>

        <form action="{{ route('admin.satudata.statistik.import.post') }}" method="POST" enctype="multipart/form-data" id="import-form">
            @csrf

            {{-- Panel: Data Pemerintah --}}
            <div id="panel-government" class="import-panel active">
                <div class="card mb-4" style="border:1px solid #E5E7EB;">
                    <div class="card-header" style="background:#F9FAFB;padding:10px 14px;">
                        <strong style="font-size:13px;color:#374151;">Format CSV Data Pemerintah</strong>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table mb-0" style="font-size:13px;">
                                <thead>
                                    <tr style="background:#F1F5F9;">
                                        <th>Kolom</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="font-weight-bold text-success" style="font-family:monospace;">kode_kabupaten_kota</td>
                                        <td>Filter otomatis: <code>3203</code> (Cianjur saja)</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold text-success" style="font-family:monospace;">jumlah_balita_stunting</td>
                                        <td>Jumlah balita stunting tahun tersebut</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold text-success" style="font-family:monospace;">tahun</td>
                                        <td>Tahun pengukuran</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="p-3" style="background:#ECFDF5;border-top:1px solid #E5E7EB;font-size:12px;color:#047857;">
                            <strong>Catatan:</strong> Data dari seluruh kabupaten/kota akan difilter. Hanya data Cianjur (kode 3203) yang diimport. Kolom lain (<code>id</code>, <code>kode_provinsi</code>, <code>nama_provinsi</code>, <code>nama_kabupaten_kota</code>, <code>satuan</code>) diabaikan.
                        </div>
                    </div>
                </div>

                <input type="hidden" name="import_type" value="government">
            </div>

            {{-- Panel: Template Manual --}}
            <div id="panel-template" class="import-panel">
                <div class="card mb-4" style="border:1px solid #E5E7EB;">
                    <div class="card-header" style="background:#F9FAFB;padding:10px 14px;">
                        <strong style="font-size:13px;color:#374151;">Format CSV Template Manual</strong>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table mb-0" style="font-size:13px;">
                                <thead>
                                    <tr style="background:#F1F5F9;">
                                        <th>Kolom</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="font-weight-bold text-success" style="font-family:monospace;">jumlah_balita_stunting</td>
                                        <td>Jumlah balita stunting tahun tersebut</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold text-success" style="font-family:monospace;">tahun</td>
                                        <td>Tahun pengukuran</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="p-3" style="background:#ECFDF5;border-top:1px solid #E5E7EB;font-size:12px;color:#047857;">
                            <strong>Catatan:</strong> Data otomatis untuk Kabupaten Cianjur. Rate (%) dihitung otomatis year-over-year.
                        </div>
                    </div>
                </div>

                <input type="hidden" name="import_type" value="template">
            </div>

            {{-- Upload Zone (shared) --}}
            <div class="upload-zone" id="upload-zone"
                 onclick="document.getElementById('csv_file').click()"
                 ondragover="event.preventDefault(); this.classList.add('dragover')"
                 ondragleave="this.classList.remove('dragover')"
                 ondrop="event.preventDefault(); this.classList.remove('dragover'); document.getElementById('csv_file').files = event.dataTransfer.files; updateLabel();">
                <span class="material-icons" style="font-size: 56px; color: #94A3B8; display: block; margin-bottom: 16px;">upload_file</span>
                <p id="file-label" style="color: #334155; font-weight: 600; font-size: 16px; margin: 0 0 8px 0;">Klik atau seret file CSV ke sini</p>
                <p class="text-muted mb-0" style="font-size: 13px;">Format: .csv | Maks: 4 MB</p>
                <input type="file" id="csv_file" name="csv_file" accept=".csv,.txt" style="display: none;" onchange="updateLabel()">
            </div>
            @error('csv_file')
                <div class="text-danger mb-3" style="font-size:13px;">{{ $message }}</div>
            @enderror

            <div class="d-flex justify-content-end" style="gap:8px;">
                <a href="{{ route('admin.satudata.statistik.edit', ['section' => 'stunting']) }}" class="btn btn-outline-secondary">Batal</a>
                <button type="submit" class="btn btn-success" id="import-btn">
                    <span class="material-icons" style="font-size: 16px; vertical-align:middle;">upload</span> Upload &amp; Proses
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Current Data Preview --}}
@if($stuntingRecords->count() > 0)
<div class="card card-outline card-success">
    <div class="card-header">
        <h3 class="h6 font-weight-bold text-success mb-0 d-flex align-items-center gap-2">
            <span class="material-icons">table_view</span>
            Data Stunting Saat Ini ({{ $stuntingRecords->count() }} tahun)
        </h3>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 preview-table">
                <thead>
                    <tr>
                        <th>Tahun</th>
                        <th class="text-right">Balita Stunting</th>
                        <th class="text-right">Change %</th>
                        <th class="text-center">Highlight</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stuntingRecords as $idx => $rec)
                        @php
                            $prevRec = $stuntingRecords->where('year', '<', $rec->year)->last();
                            $change = $prevRec ? \App\Models\StuntingRecord::calculateRate($rec->balita_stunting, $prevRec->balita_stunting) : null;
                        @endphp
                        <tr class="{{ $rec->is_highlighted ? 'table-success' : '' }}">
                            <td class="font-weight-bold">
                                {{ $rec->year }}
                                @if($rec->is_highlighted)
                                    <span class="badge badge-success ml-1">AKTIF</span>
                                @endif
                            </td>
                            <td class="text-right font-weight-bold">{{ number_format($rec->balita_stunting) }}</td>
                            <td class="text-right">
                                @if($change !== null)
                                    <span class="change-badge {{ $change < 0 ? 'change-down' : ($change > 0 ? 'change-up' : '') }}">
                                        {{ $change > 0 ? '+' : '' }}{{ $change }}%
                                    </span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td class="text-center align-middle">
                                @if($rec->is_highlighted)
                                    <span class="material-icons text-success" style="font-size: 18px;">check_circle</span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@endsection

@section('scripts')
<script>
    function switchTab(type, btn) {
        document.querySelectorAll('.import-type-tab').forEach(t => t.classList.remove('active'));
        btn.classList.add('active');

        document.querySelectorAll('.import-panel').forEach(p => p.classList.remove('active'));
        document.getElementById('panel-' + type).classList.add('active');

        document.querySelector('input[name="import_type"]').value = type;
    }

    function updateLabel() {
        const input = document.getElementById('csv_file');
        const label = document.getElementById('file-label');
        if (input.files.length > 0) {
            label.textContent = input.files[0].name;
            label.style.color = '#009966';
        }
    }

    document.getElementById('import-form').addEventListener('submit', function() {
        const btn = document.getElementById('import-btn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-sync-alt fa-spin mr-1"></i> Memproses...';
    });
</script>
@endsection
