@extends('admin.layouts.admin')

@section('title', 'Impor Agenda')
@section('header_title', 'Impor Agenda via CSV')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/agenda.css') }}?v={{ time() }}">
@endsection

@section('content')
<div class="agenda-admin-wrapper">
    
    @if($errors->any())
        <div class="admin-alert admin-alert-danger" style="background-color: #FEF2F2; color: #991B1B; border: 1px solid #FCA5A5; padding: 16px; border-radius: 3px; margin-bottom: 20px;">
            <div style="display: flex; align-items: flex-start; gap: 8px;">
                <span class="material-icons" style="color: #EF4444; font-size: 20px;">error</span>
                <div>
                    <h5 style="margin: 0 0 6px 0; font-weight: 700;">Terdapat kesalahan pada berkas CSV:</h5>
                    <ul style="margin: 0; padding-left: 20px; font-size: 13px; line-height: 1.6;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <div class="admin-card" style="margin-bottom: 24px;">
        <h3 style="margin-top: 0; margin-bottom: 12px; color: #004F3B; font-weight: 800; font-size: 18px;">Panduan Format Berkas CSV</h3>
        <p style="font-size: 14px; color: #4B5563; line-height: 1.6; margin-bottom: 16px;">
            Untuk memastikan data agenda berhasil diimpor, silakan buat berkas Excel/Spreadsheet Anda terlebih dahulu, kemudian simpan dengan format <strong>CSV (Comma Delimited)</strong>. Kolom pada berkas CSV harus memiliki header seperti berikut:
        </p>

        <div style="overflow-x: auto; margin-bottom: 20px; border: 1px solid #E5E7EB; border-radius: 3px;">
            <table style="width: 100%; border-collapse: collapse; font-size: 13px; text-align: left;">
                <thead>
                    <tr style="background-color: #F9FAFB; border-bottom: 1px solid #E5E7EB;">
                        <th style="padding: 10px; font-weight: 700; color: #374151;">Nama Kolom (Header)</th>
                        <th style="padding: 10px; font-weight: 700; color: #374151;">Format / Contoh</th>
                        <th style="padding: 10px; font-weight: 700; color: #374151;">Status</th>
                        <th style="padding: 10px; font-weight: 700; color: #374151;">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border-bottom: 1px solid #E5E7EB;">
                        <td style="padding: 10px; font-family: monospace; font-weight: 700; color: #004F3B;">title</td>
                        <td style="padding: 10px;">Rapat Evaluasi Program Gizi</td>
                        <td style="padding: 10px; color: #EF4444; font-weight: 700;">Wajib</td>
                        <td style="padding: 10px; color: #4B5563;">Nama agenda/kegiatan.</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #E5E7EB;">
                        <td style="padding: 10px; font-family: monospace; font-weight: 700; color: #004F3B;">date</td>
                        <td style="padding: 10px;">2026-08-10 (YYYY-MM-DD)</td>
                        <td style="padding: 10px; color: #EF4444; font-weight: 700;">Wajib</td>
                        <td style="padding: 10px; color: #4B5563;">Tanggal acara dilaksanakan.</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #E5E7EB;">
                        <td style="padding: 10px; font-family: monospace; font-weight: 700; color: #004F3B;">time_start</td>
                        <td style="padding: 10px;">09:00</td>
                        <td style="padding: 10px; color: #EF4444; font-weight: 700;">Wajib</td>
                        <td style="padding: 10px; color: #4B5563;">Waktu dimulainya acara.</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #E5E7EB;">
                        <td style="padding: 10px; font-family: monospace; font-weight: 700; color: #004F3B;">time_end</td>
                        <td style="padding: 10px;">12:00 / Selesai</td>
                        <td style="padding: 10px; color: #EF4444; font-weight: 700;">Wajib</td>
                        <td style="padding: 10px; color: #4B5563;">Waktu selesainya acara.</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #E5E7EB;">
                        <td style="padding: 10px; font-family: monospace; font-weight: 700; color: #004F3B;">location</td>
                        <td style="padding: 10px;">Aula Dinas Kesehatan</td>
                        <td style="padding: 10px; color: #EF4444; font-weight: 700;">Wajib</td>
                        <td style="padding: 10px; color: #4B5563;">Tempat/lokasi acara diadakan.</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #E5E7EB;">
                        <td style="padding: 10px; font-family: monospace; font-weight: 700; color: #004F3B;">description</td>
                        <td style="padding: 10px;">Membahas laporan bulanan stunting...</td>
                        <td style="padding: 10px; color: #9CA3AF;">Opsional</td>
                        <td style="padding: 10px; color: #4B5563;">Penjelasan ringkas detail agenda.</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; font-family: monospace; font-weight: 700; color: #004F3B;">status</td>
                        <td style="padding: 10px;">published / draft</td>
                        <td style="padding: 10px; color: #9CA3AF;">Opsional</td>
                        <td style="padding: 10px; color: #4B5563;">Default ke <code>published</code> jika dikosongkan.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <blockquote style="margin: 0; padding: 12px 16px; background-color: #FFFBEB; border-left: 4px solid #F59E0B; border-radius: 3px; font-size: 13px; color: #78350F; line-height: 1.5;">
            <strong>Tips:</strong> Sistem secara otomatis mendeteksi pemisah kolom koma (<code>,</code>) maupun titik-koma (<code>;</code>) sehingga Anda tidak perlu khawatir dengan perbedaan format regional Excel Anda. Kolom header juga dapat ditulis menggunakan istilah bahasa Indonesia (Judul, Tanggal, Lokasi, dll).
        </blockquote>
    </div>

    <div class="admin-card">
        <form action="{{ route('admin.agenda.import') }}" method="POST" enctype="multipart/form-data" class="admin-form">
            @csrf

            <div class="form-group" style="margin-bottom: 24px;">
                <label for="csv_file" style="font-weight: 700; display: block; margin-bottom: 8px;">Pilih Berkas CSV</label>
                <input 
                    type="file" 
                    name="csv_file" 
                    id="csv_file" 
                    accept=".csv"
                    class="form-control-input" 
                    style="padding: 8px 12px; border: 1px solid #D1D5DB; border-radius: 3px; width: 100%; max-width: 450px;" 
                    required
                >
                <small style="display: block; color: #6B7280; margin-top: 6px; font-size: 12px;">Maksimal ukuran berkas: 2MB (.csv)</small>
                @error('csv_file')
                    <span class="field-error" style="color: #EF4444; font-size: 13px; display: block; margin-top: 4px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions" style="display: flex; gap: 12px; border-top: 1px solid #F3F4F6; padding-top: 20px;">
                <a href="{{ route('admin.agenda.index') }}" class="btn-admin btn-admin-secondary">
                    <span>Batal</span>
                </a>
                <button type="submit" class="btn-admin btn-admin-primary">
                    <span class="material-icons">upload_file</span>
                    <span>Impor Data Agenda</span>
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
