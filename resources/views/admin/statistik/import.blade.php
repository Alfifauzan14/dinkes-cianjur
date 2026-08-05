@extends('admin.layouts.admin')
@section('title', 'Import Data Stunting (CSV)')
@section('header_title', 'Import Data Stunting via CSV')

@section('content')
<div class="card card-outline card-success mb-4">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between" style="gap:12px;">
        <div>
            <h2 class="h6 font-weight-bold text-success mb-1">Import Massal Data Stunting</h2>
            <p class="text-muted mb-0" style="font-size:12px;">Unggah file CSV untuk memperbarui data grafik stunting secara massal. Data tahun yang sama akan di-overwrite.</p>
        </div>
        <div class="d-flex" style="gap:8px;">
            <a href="{{ route('admin.satudata.statistik.template') }}" class="btn btn-sm btn-outline-success">
                <span class="material-icons" style="font-size:16px;vertical-align:middle;">download</span> Download Template CSV
            </a>
            <a href="{{ route('admin.satudata.statistik.edit') }}" class="btn btn-sm btn-outline-secondary">
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

        {{-- Format CSV Info --}}
        <div class="card mb-4" style="border:1px solid #E5E7EB;">
            <div class="card-header" style="background:#F9FAFB;padding:10px 14px;">
                <strong style="font-size:13px;color:#374151;">Format CSV yang Diterima</strong>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0" style="font-size:13px;">
                        <thead>
                            <tr style="background:#F1F5F9;">
                                <th>Kolom</th>
                                <th>Tipe</th>
                                <th>Wajib?</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="font-weight-bold text-success" style="font-family:monospace;">year</td>
                                <td>Integer</td>
                                <td><span class="text-danger font-weight-bold">Wajib</span></td>
                                <td>Tahun pengukuran, contoh: 2026</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-success" style="font-family:monospace;">total_balita</td>
                                <td>Integer</td>
                                <td><span class="text-danger font-weight-bold">Wajib</span></td>
                                <td>Jumlah total balita yang diukur</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-success" style="font-family:monospace;">balita_stunting</td>
                                <td>Integer</td>
                                <td><span class="text-danger font-weight-bold">Wajib</span></td>
                                <td>Jumlah balita yang terdeteksi stunting</td>
                            </tr>
                            <tr>
                                <td class="text-muted" style="font-family:monospace;">wilayah_terendah</td>
                                <td>String</td>
                                <td><span class="text-muted">Opsional</span></td>
                                <td>Kecamatan dengan angka stunting terendah</td>
                            </tr>
                            <tr>
                                <td class="text-muted" style="font-family:monospace;">wilayah_tertinggi</td>
                                <td>String</td>
                                <td><span class="text-muted">Opsional</span></td>
                                <td>Kecamatan dengan angka stunting tertinggi</td>
                            </tr>
                            <tr>
                                <td class="text-muted" style="font-family:monospace;">catatan</td>
                                <td>String</td>
                                <td><span class="text-muted">Opsional</span></td>
                                <td>Catatan atau keterangan khusus untuk tahun ini</td>
                            </tr>
                            <tr>
                                <td class="text-muted" style="font-family:monospace;">is_highlighted</td>
                                <td>Boolean</td>
                                <td><span class="text-muted">Opsional</span></td>
                                <td>Isi <code>true</code> untuk tahun yang ingin di-highlight di grafik</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="p-3" style="background:#ECFDF5;border-top:1px solid #E5E7EB;font-size:12px;color:#047857;">
                    💡 <strong>Catatan:</strong> Kolom <code>rate</code> (%) tidak perlu diisi — dihitung otomatis dari <code>balita_stunting / total_balita × 100</code>
                </div>
            </div>
        </div>

        {{-- Upload Form --}}
        <form action="{{ route('admin.satudata.statistik.import.post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="border: 2px dashed #CBD5E1; border-radius: 3px; padding: 36px; text-align: center; background: #F8FAFC; margin-bottom: 24px; cursor: pointer; transition: border-color 0.2s;"
                 onclick="document.getElementById('csv_file').click()"
                 ondragover="event.preventDefault(); this.style.borderColor='#009966';"
                 ondragleave="this.style.borderColor='#CBD5E1';"
                 ondrop="event.preventDefault(); this.style.borderColor='#CBD5E1'; document.getElementById('csv_file').files = event.dataTransfer.files; updateLabel();">
                <span class="material-icons" style="font-size: 48px; color: #94A3B8; display: block; margin-bottom: 12px;">upload_file</span>
                <p id="file-label" style="color: #334155; font-weight: 600; font-size: 15px; margin: 0 0 6px 0;">Klik atau seret file CSV ke sini</p>
                <p class="text-muted mb-0" style="font-size: 13px;">Format: .csv | Maks: 2 MB</p>
                <input type="file" id="csv_file" name="csv_file" accept=".csv,.txt" style="display: none;" onchange="updateLabel()">
            </div>
            @error('csv_file')
                <div class="text-danger mb-3" style="font-size:13px;">{{ $message }}</div>
            @enderror

            <div class="d-flex justify-content-end" style="gap:8px;">
                <a href="{{ route('admin.satudata.statistik.edit') }}" class="btn btn-outline-secondary">Batal</a>
                <button type="submit" class="btn btn-success">
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
            <table class="table table-hover mb-0" style="font-size: 13px;">
                <thead>
                    <tr>
                        <th>Tahun</th>
                        <th class="text-right">Rate (%)</th>
                        <th class="text-right">Total Balita</th>
                        <th class="text-right">Balita Stunting</th>
                        <th>Wil. Terendah</th>
                        <th>Wil. Tertinggi</th>
                        <th class="text-center">Highlight</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stuntingRecords as $rec)
                    <tr class="{{ $rec->is_highlighted ? 'table-success' : '' }}">
                        <td class="font-weight-bold">
                            {{ $rec->year }}
                            @if($rec->is_highlighted)
                                <span class="badge badge-success ml-1">AKTIF</span>
                            @endif
                        </td>
                        <td class="text-right font-weight-bold text-success">{{ $rec->rate }}%</td>
                        <td class="text-right text-secondary">{{ $rec->total_balita ? number_format($rec->total_balita) : '—' }}</td>
                        <td class="text-right text-danger font-weight-bold">{{ $rec->balita_stunting ? number_format($rec->balita_stunting) : '—' }}</td>
                        <td class="text-secondary">{{ $rec->wilayah_terendah ?? '—' }}</td>
                        <td class="text-secondary">{{ $rec->wilayah_tertinggi ?? '—' }}</td>
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
function updateLabel() {
    const input = document.getElementById('csv_file');
    const label = document.getElementById('file-label');
    if (input.files.length > 0) {
        label.textContent = '📄 ' + input.files[0].name;
        label.style.color = '#009966';
    }
}
</script>
@endsection
