@extends('admin.layouts.admin')

@section('title', 'Import Data Stunting (CSV)')
@section('header_title', 'Import Data Stunting via CSV')

@section('content')
<div class="berita-admin-wrapper">
    <div class="admin-card">

        {{-- Alerts --}}
        @if(session('success'))
            <div style="background-color: #DEF7EC; color: #03543F; padding: 14px; border-radius: 3px; margin-bottom: 20px; font-weight: 600; display: flex; align-items: center; gap: 8px;">
                <span class="material-icons">check_circle</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('import_errors'))
            <div style="background-color: #FEF3C7; color: #92400E; padding: 14px; border-radius: 3px; margin-bottom: 20px;">
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px; font-weight: 700;">
                    <span class="material-icons">warning</span>
                    <span>Beberapa baris dilewati:</span>
                </div>
                <ul style="margin-left: 28px; font-size: 13px;">
                    @foreach(session('import_errors') as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($errors->any())
            <div style="background-color: #FDE8E8; color: #9B1C1C; padding: 14px; border-radius: 3px; margin-bottom: 20px; font-weight: 600;">
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                    <span class="material-icons">error</span>
                    <span>Terdapat kesalahan:</span>
                </div>
                <ul style="margin-left: 28px; font-size: 14px; font-weight: 500;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Action Bar --}}
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px; flex-wrap: wrap; gap: 12px;">
            <div>
                <h2 style="font-size: 20px; font-weight: 700; color: #004F3B; margin: 0 0 4px 0;">Import Massal Data Stunting</h2>
                <p style="color: #64748B; font-size: 14px; margin: 0;">Unggah file CSV untuk memperbarui data grafik stunting secara massal. Data tahun yang sama akan <strong>di-overwrite</strong>.</p>
            </div>
            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                <a href="{{ route('admin.satudata.statistik.template') }}"
                   style="display: inline-flex; align-items: center; gap: 6px; padding: 10px 18px; background: #F0FDF4; color: #009966; border: 1.5px solid #009966; border-radius: 3px; font-weight: 700; font-size: 14px; text-decoration: none;">
                    <span class="material-icons" style="font-size: 18px;">download</span>
                    Download Template CSV
                </a>
                <a href="{{ route('admin.satudata.statistik.edit') }}"
                   style="display: inline-flex; align-items: center; gap: 6px; padding: 10px 18px; background: #F1F5F9; color: #334155; border: 1px solid #E2E8F0; border-radius: 3px; font-weight: 600; font-size: 14px; text-decoration: none;">
                    <span class="material-icons" style="font-size: 18px;">arrow_back</span>
                    Kembali ke Edit
                </a>
            </div>
        </div>

        {{-- Format CSV Info --}}
        <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 3px; padding: 20px; margin-bottom: 28px;">
            <h3 style="font-size: 15px; font-weight: 700; color: #0F172A; margin: 0 0 12px 0; display: flex; align-items: center; gap: 6px;">
                <span class="material-icons" style="font-size: 18px; color: #009966;">info</span>
                Format CSV yang Diterima
            </h3>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; font-size: 13px;">
                    <thead>
                        <tr style="background: #E2E8F0;">
                            <th style="padding: 8px 12px; text-align: left; font-weight: 700; color: #334155; border: 1px solid #CBD5E1;">Kolom</th>
                            <th style="padding: 8px 12px; text-align: left; font-weight: 700; color: #334155; border: 1px solid #CBD5E1;">Tipe</th>
                            <th style="padding: 8px 12px; text-align: left; font-weight: 700; color: #334155; border: 1px solid #CBD5E1;">Wajib?</th>
                            <th style="padding: 8px 12px; text-align: left; font-weight: 700; color: #334155; border: 1px solid #CBD5E1;">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding: 8px 12px; border: 1px solid #E2E8F0; font-family: monospace; color: #009966; font-weight: 600;">year</td>
                            <td style="padding: 8px 12px; border: 1px solid #E2E8F0;">Integer</td>
                            <td style="padding: 8px 12px; border: 1px solid #E2E8F0;"><span style="color: #DC2626; font-weight: 700;">Wajib</span></td>
                            <td style="padding: 8px 12px; border: 1px solid #E2E8F0;">Tahun pengukuran, contoh: 2026</td>
                        </tr>
                        <tr style="background: #F8FAFC;">
                            <td style="padding: 8px 12px; border: 1px solid #E2E8F0; font-family: monospace; color: #009966; font-weight: 600;">total_balita</td>
                            <td style="padding: 8px 12px; border: 1px solid #E2E8F0;">Integer</td>
                            <td style="padding: 8px 12px; border: 1px solid #E2E8F0;"><span style="color: #DC2626; font-weight: 700;">Wajib</span></td>
                            <td style="padding: 8px 12px; border: 1px solid #E2E8F0;">Jumlah total balita yang diukur</td>
                        </tr>
                        <tr>
                            <td style="padding: 8px 12px; border: 1px solid #E2E8F0; font-family: monospace; color: #009966; font-weight: 600;">balita_stunting</td>
                            <td style="padding: 8px 12px; border: 1px solid #E2E8F0;">Integer</td>
                            <td style="padding: 8px 12px; border: 1px solid #E2E8F0;"><span style="color: #DC2626; font-weight: 700;">Wajib</span></td>
                            <td style="padding: 8px 12px; border: 1px solid #E2E8F0;">Jumlah balita yang terdeteksi stunting</td>
                        </tr>
                        <tr style="background: #F8FAFC;">
                            <td style="padding: 8px 12px; border: 1px solid #E2E8F0; font-family: monospace; color: #64748B;">wilayah_terendah</td>
                            <td style="padding: 8px 12px; border: 1px solid #E2E8F0;">String</td>
                            <td style="padding: 8px 12px; border: 1px solid #E2E8F0; color: #64748B;">Opsional</td>
                            <td style="padding: 8px 12px; border: 1px solid #E2E8F0;">Kecamatan dengan angka stunting terendah</td>
                        </tr>
                        <tr>
                            <td style="padding: 8px 12px; border: 1px solid #E2E8F0; font-family: monospace; color: #64748B;">wilayah_tertinggi</td>
                            <td style="padding: 8px 12px; border: 1px solid #E2E8F0;">String</td>
                            <td style="padding: 8px 12px; border: 1px solid #E2E8F0; color: #64748B;">Opsional</td>
                            <td style="padding: 8px 12px; border: 1px solid #E2E8F0;">Kecamatan dengan angka stunting tertinggi</td>
                        </tr>
                        <tr style="background: #F8FAFC;">
                            <td style="padding: 8px 12px; border: 1px solid #E2E8F0; font-family: monospace; color: #64748B;">catatan</td>
                            <td style="padding: 8px 12px; border: 1px solid #E2E8F0;">String</td>
                            <td style="padding: 8px 12px; border: 1px solid #E2E8F0; color: #64748B;">Opsional</td>
                            <td style="padding: 8px 12px; border: 1px solid #E2E8F0;">Catatan atau keterangan khusus untuk tahun ini</td>
                        </tr>
                        <tr>
                            <td style="padding: 8px 12px; border: 1px solid #E2E8F0; font-family: monospace; color: #64748B;">is_highlighted</td>
                            <td style="padding: 8px 12px; border: 1px solid #E2E8F0;">Boolean</td>
                            <td style="padding: 8px 12px; border: 1px solid #E2E8F0; color: #64748B;">Opsional</td>
                            <td style="padding: 8px 12px; border: 1px solid #E2E8F0;">Isi <code>true</code> untuk tahun yang ingin di-highlight di grafik</td>
                        </tr>
                        <tr style="background: #ECFDF5;">
                            <td colspan="4" style="padding: 8px 12px; border: 1px solid #E2E8F0; font-size: 12px; color: #047857;">
                                💡 <strong>Catatan:</strong> Kolom <code>rate</code> (%) <strong>tidak perlu diisi</strong> — dihitung otomatis dari <code>balita_stunting / total_balita × 100</code>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
                <p style="color: #94A3B8; font-size: 13px; margin: 0;">Format: .csv | Maks: 2 MB</p>
                <input type="file" id="csv_file" name="csv_file" accept=".csv,.txt" style="display: none;" onchange="updateLabel()">
            </div>
            @error('csv_file')
                <p style="color: #DC2626; font-size: 13px; margin-bottom: 12px;">{{ $message }}</p>
            @enderror

            <div style="display: flex; gap: 12px; justify-content: flex-end;">
                <a href="{{ route('admin.satudata.statistik.edit') }}"
                   style="padding: 10px 22px; background: #F1F5F9; color: #334155; border: 1px solid #E2E8F0; border-radius: 3px; font-weight: 600; font-size: 14px; text-decoration: none;">
                    Batal
                </a>
                <button type="submit"
                        style="display: inline-flex; align-items: center; gap: 6px; padding: 10px 22px; background: #004F3B; color: #fff; border: none; border-radius: 3px; font-weight: 700; font-size: 14px; cursor: pointer;">
                    <span class="material-icons" style="font-size: 18px;">upload</span>
                    Upload & Proses
                </button>
            </div>
        </form>

    </div>

    {{-- Current Data Preview --}}
    @if($stuntingRecords->count() > 0)
    <div class="admin-card" style="margin-top: 24px;">
        <h3 style="font-size: 16px; font-weight: 700; color: #004F3B; margin: 0 0 16px 0; display: flex; align-items: center; gap: 6px;">
            <span class="material-icons" style="font-size: 18px;">table_view</span>
            Data Stunting Saat Ini ({{ $stuntingRecords->count() }} tahun)
        </h3>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; font-size: 13px;">
                <thead>
                    <tr style="background: #F1F5F9;">
                        <th style="padding: 10px 14px; text-align: left; font-weight: 700; color: #334155; border-bottom: 2px solid #E2E8F0;">Tahun</th>
                        <th style="padding: 10px 14px; text-align: right; font-weight: 700; color: #334155; border-bottom: 2px solid #E2E8F0;">Rate (%)</th>
                        <th style="padding: 10px 14px; text-align: right; font-weight: 700; color: #334155; border-bottom: 2px solid #E2E8F0;">Total Balita</th>
                        <th style="padding: 10px 14px; text-align: right; font-weight: 700; color: #334155; border-bottom: 2px solid #E2E8F0;">Balita Stunting</th>
                        <th style="padding: 10px 14px; text-align: left; font-weight: 700; color: #334155; border-bottom: 2px solid #E2E8F0;">Wil. Terendah</th>
                        <th style="padding: 10px 14px; text-align: left; font-weight: 700; color: #334155; border-bottom: 2px solid #E2E8F0;">Wil. Tertinggi</th>
                        <th style="padding: 10px 14px; text-align: center; font-weight: 700; color: #334155; border-bottom: 2px solid #E2E8F0;">Highlight</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stuntingRecords as $rec)
                    <tr style="{{ $rec->is_highlighted ? 'background: #ECFDF5;' : '' }}">
                        <td style="padding: 10px 14px; border-bottom: 1px solid #F1F5F9; font-weight: 700; color: {{ $rec->is_highlighted ? '#004F3B' : '#0F172A' }};">
                            {{ $rec->year }}
                            @if($rec->is_highlighted)
                                <span style="font-size: 10px; background: #009966; color: #fff; padding: 2px 6px; border-radius: 3px; margin-left: 4px; font-weight: 600;">AKTIF</span>
                            @endif
                        </td>
                        <td style="padding: 10px 14px; border-bottom: 1px solid #F1F5F9; text-align: right; font-weight: 700; color: #009966;">{{ $rec->rate }}%</td>
                        <td style="padding: 10px 14px; border-bottom: 1px solid #F1F5F9; text-align: right; color: #475569;">{{ $rec->total_balita ? number_format($rec->total_balita) : '—' }}</td>
                        <td style="padding: 10px 14px; border-bottom: 1px solid #F1F5F9; text-align: right; color: #DC2626; font-weight: 600;">{{ $rec->balita_stunting ? number_format($rec->balita_stunting) : '—' }}</td>
                        <td style="padding: 10px 14px; border-bottom: 1px solid #F1F5F9; color: #475569;">{{ $rec->wilayah_terendah ?? '—' }}</td>
                        <td style="padding: 10px 14px; border-bottom: 1px solid #F1F5F9; color: #475569;">{{ $rec->wilayah_tertinggi ?? '—' }}</td>
                        <td style="padding: 10px 14px; border-bottom: 1px solid #F1F5F9; text-align: center;">
                            @if($rec->is_highlighted)
                                <span class="material-icons" style="color: #009966; font-size: 18px;">check_circle</span>
                            @else
                                <span style="color: #CBD5E1;">—</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>

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
