@extends('admin.layouts.admin')

@section('title', 'Impor Agenda')
@section('header_title', 'Impor Agenda via CSV')

@section('content')
@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 6px; margin-bottom: 20px;">
        <h5 class="alert-heading font-weight-bold"><i class="fas fa-exclamation-circle mr-1"></i> Terdapat kesalahan pada berkas CSV:</h5>
        <ul style="margin-bottom: 0; padding-left: 20px; font-size: 13px; line-height: 1.6;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="card card-outline card-success">
    <div class="card-header" style="padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
        <span class="font-weight-bold text-dark" style="font-size: 18px;">Panduan Format Berkas CSV</span>
    </div>
    <div class="card-body">
        <p style="font-size: 14px; color: #4B5563; line-height: 1.6; margin-bottom: 16px;">
            Untuk memastikan data agenda berhasil diimpor, silakan buat berkas Excel/Spreadsheet Anda terlebih dahulu, kemudian simpan dengan format <strong>CSV (Comma Delimited)</strong>. Kolom pada berkas CSV harus memiliki header seperti berikut:
        </p>

        <div class="table-responsive mb-4">
            <table class="table table-bordered table-sm">
                <thead class="thead-light">
                    <tr>
                        <th style="font-weight: 700; color: #374151;">Nama Kolom (Header)</th>
                        <th style="font-weight: 700; color: #374151;">Format / Contoh</th>
                        <th style="font-weight: 700; color: #374151;">Status</th>
                        <th style="font-weight: 700; color: #374151;">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="font-family: monospace; font-weight: 700; color: #004F3B;">title</td>
                        <td>Rapat Evaluasi Program Gizi</td>
                        <td class="text-danger font-weight-bold">Wajib</td>
                        <td class="text-secondary">Nama agenda/kegiatan.</td>
                    </tr>
                    <tr>
                        <td style="font-family: monospace; font-weight: 700; color: #004F3B;">date</td>
                        <td>2026-08-10 (YYYY-MM-DD)</td>
                        <td class="text-danger font-weight-bold">Wajib</td>
                        <td class="text-secondary">Tanggal acara dilaksanakan.</td>
                    </tr>
                    <tr>
                        <td style="font-family: monospace; font-weight: 700; color: #004F3B;">time_start</td>
                        <td>09:00</td>
                        <td class="text-danger font-weight-bold">Wajib</td>
                        <td class="text-secondary">Waktu dimulainya acara.</td>
                    </tr>
                    <tr>
                        <td style="font-family: monospace; font-weight: 700; color: #004F3B;">time_end</td>
                        <td>12:00 / Selesai</td>
                        <td class="text-danger font-weight-bold">Wajib</td>
                        <td class="text-secondary">Waktu selesainya acara.</td>
                    </tr>
                    <tr>
                        <td style="font-family: monospace; font-weight: 700; color: #004F3B;">location</td>
                        <td>Aula Dinas Kesehatan</td>
                        <td class="text-danger font-weight-bold">Wajib</td>
                        <td class="text-secondary">Tempat/lokasi acara diadakan.</td>
                    </tr>
                    <tr>
                        <td style="font-family: monospace; font-weight: 700; color: #004F3B;">description</td>
                        <td>Membahas laporan bulanan stunting...</td>
                        <td class="text-muted">Opsional</td>
                        <td class="text-secondary">Penjelasan ringkas detail agenda.</td>
                    </tr>
                    <tr>
                        <td style="font-family: monospace; font-weight: 700; color: #004F3B;">status</td>
                        <td>published / draft</td>
                        <td class="text-muted">Opsional</td>
                        <td class="text-secondary">Default ke <code>published</code> jika dikosongkan.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <blockquote style="margin: 0; padding: 12px 16px; background-color: #EFF6FF; border-left: 4px solid #3B82F6; border-radius: 3px; font-size: 13px; color: #1E3A8A; line-height: 1.5;">
            <strong>Tips:</strong> Sistem secara otomatis mendeteksi pemisah kolom koma (<code>,</code>) maupun titik-koma (<code>;</code>) sehingga Anda tidak perlu khawatir dengan perbedaan format regional Excel Anda. Kolom header juga dapat ditulis menggunakan istilah bahasa Indonesia (Judul, Tanggal, Lokasi, dll).
        </blockquote>
    </div>
</div>

<div class="card card-outline card-success">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span class="font-weight-bold text-muted" style="font-size:13px;">
            <span class="material-icons text-success" style="font-size:16px;vertical-align:middle;">upload_file</span>
            Unggah Berkas CSV
        </span>
        <a href="{{ route('admin.agenda.index') }}" class="btn btn-sm btn-outline-secondary">
            <span class="material-icons" style="font-size:15px;vertical-align:middle;">arrow_back</span> Kembali
        </a>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.agenda.import') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group" style="margin-bottom: 24px;">
                <label for="csv_file">Pilih Berkas CSV <span class="text-danger">*</span></label>
                <input type="file" name="csv_file" id="csv_file" accept=".csv"
                    class="form-control @error('csv_file') is-invalid @enderror" style="max-width: 450px;" required>
                <small class="form-text text-muted">Maksimal ukuran berkas: 2MB (.csv)</small>
                @error('csv_file') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex align-items-center justify-content-end" style="gap:10px; border-top: 1px solid #F3F4F6; padding-top: 20px;">
                <a href="{{ route('admin.agenda.index') }}" class="btn btn-outline-secondary">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">close</span> Batal
                </a>
                <button type="submit" class="btn btn-success">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">upload_file</span> Impor Data Agenda
                </button>
            </div>
        </form>
    </div>
</div>
@endsection