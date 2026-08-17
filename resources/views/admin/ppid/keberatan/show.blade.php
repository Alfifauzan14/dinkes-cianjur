@extends('admin.layouts.admin')
@section('title', 'Detail Keberatan #' . $keberatan->id)
@section('header_title', 'Detail Keberatan')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.ppid.keberatan.index') }}" class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center" style="gap: 4px;">
        <span class="material-icons" style="font-size: 16px;">arrow_back</span> Kembali ke Daftar
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-3" style="gap:8px; border-radius: 3px;">
        <span class="material-icons">check_circle</span>
        <span>{{ session('success') }}</span>
        <button type="button" class="close ml-auto" data-dismiss="alert"><span>&times;</span></button>
    </div>
@endif

<div class="row">
    {{-- Kiri: Info Pemohon + Detail Permohonan + Keberatan --}}
    <div class="col-lg-7 col-12">
        {{-- Info Pemohon --}}
        <div class="card card-outline card-warning mb-4">
            <div class="card-header bg-white" style="padding: 16px 20px; border-bottom: 1px solid #E2E8F0;">
                <span class="d-flex align-items-center" style="gap: 8px;">
                    <span class="material-icons text-warning" style="font-size: 20px;">person</span>
                    <span class="font-weight-bold card-title-label">Identitas Pemohon</span>
                </span>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6 col-12 mb-3">
                        <label class="text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase;">Nama Lengkap</label>
                        <div class="text-dark font-weight-bold" style="font-size: 15px;">{{ $keberatan->permohonan->nama_pemohon ?? '-' }}</div>
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <label class="text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase;">Token Permohonan</label>
                        <div>
                            <span class="badge px-2 py-1 font-weight-bold" style="background-color: #FEF3C7; color: #D97706; border-radius: 3px; font-size: 13px;">
                                {{ $keberatan->token }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mb-3 mb-md-0">
                        <label class="text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase;">Email</label>
                        <div class="text-dark font-weight-bold" style="font-size: 15px;">{{ $keberatan->email }}</div>
                    </div>
                    <div class="col-md-6 col-12">
                        <label class="text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase;">Tanggal Keberatan</label>
                        <div class="text-dark font-weight-bold" style="font-size: 15px;">{{ $keberatan->created_at->format('d M Y, H:i') }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Detail Permohonan Asli --}}
        @if($keberatan->permohonan)
        <div class="card card-outline card-secondary mb-4">
            <div class="card-header bg-white d-flex align-items-center justify-content-between" style="padding: 16px 20px; border-bottom: 1px solid #E2E8F0;">
                <span class="d-flex align-items-center" style="gap: 8px;">
                    <span class="material-icons text-secondary" style="font-size: 20px;">assignment</span>
                    <span class="font-weight-bold card-title-label">Permohonan Asal</span>
                </span>
                @if($keberatan->permohonan->status === 'ditolak')
                    <span class="badge" style="background-color: #FDE8E8; color: #9B1C1C; padding: 4px 10px; border-radius: 3px; font-size: 11.5px; font-weight: 700;">Ditolak</span>
                @elseif($keberatan->permohonan->status === 'disetujui')
                    <span class="badge" style="background-color: #DEF7EC; color: #03543F; padding: 4px 10px; border-radius: 3px; font-size: 11.5px; font-weight: 700;">Disetujui</span>
                @else
                    <span class="badge" style="background-color: #FEF3C7; color: #D97706; padding: 4px 10px; border-radius: 3px; font-size: 11.5px; font-weight: 700;">Pending</span>
                @endif
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6 col-12 mb-3">
                        <label class="text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase;">Jenis Informasi</label>
                        <div>
                            <span class="badge" style="background-color: #E2E8F0; color: #475569; font-size: 12px; padding: 4px 8px; border-radius: 3px; font-weight: 700;">
                                {{ str_replace('_', ' ', ucwords($keberatan->permohonan->jenis_informasi)) }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <label class="text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase;">Aksi</label>
                        <div>
                            <a href="{{ route('admin.ppid.permohonan.show', $keberatan->permohonan->id) }}"
                               class="btn btn-sm btn-outline-secondary font-weight-bold d-inline-flex align-items-center" style="gap: 4px;">
                                <span class="material-icons" style="font-size: 15px;">open_in_new</span>
                                Lihat Permohonan Lengkap
                            </a>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase;">Rincian Diminta</label>
                        <div class="p-3 text-dark" style="font-size: 14px; line-height: 1.5; background:#F8FAFC; border: 1px solid #E2E8F0; border-radius: 3px;">
                            {{ $keberatan->permohonan->rincian_informasi }}
                        </div>
                    </div>
                    @if($keberatan->permohonan->tanggapan)
                    <div class="col-12 mb-0">
                        <label class="text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase;">Tanggapan PPID</label>
                        <div class="p-3 text-dark" style="font-size: 14px; line-height: 1.5; background:#F8FAFC; border: 1px solid #E2E8F0; border-radius: 3px;">
                            {{ $keberatan->permohonan->tanggapan }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif

        {{-- Alasan Keberatan --}}
        <div class="card card-outline card-danger mb-4">
            <div class="card-header bg-white" style="padding: 16px 20px; border-bottom: 1px solid #E2E8F0;">
                <span class="d-flex align-items-center" style="gap: 8px;">
                    <span class="material-icons text-danger" style="font-size: 20px;">report_problem</span>
                    <span class="font-weight-bold card-title-label">Alasan Keberatan</span>
                </span>
            </div>
            <div class="card-body p-4">
                <p class="mb-0 text-dark" style="font-size: 14.5px; line-height: 1.7; white-space: pre-wrap;">{{ $keberatan->alasan_keberatan }}</p>
            </div>
        </div>
    </div>

    {{-- Kanan: Form Tanggapan --}}
    <div class="col-lg-5 col-12">
        <div class="card card-outline card-success mb-4" style="position: sticky; top: 20px;">
            <div class="card-header bg-white" style="padding: 16px 20px; border-bottom: 1px solid #E2E8F0;">
                <span class="d-flex align-items-center" style="gap: 8px;">
                    <span class="material-icons text-success" style="font-size: 20px;">rate_review</span>
                    <span class="font-weight-bold card-title-label">Tanggapi Keberatan</span>
                </span>
            </div>
            <div class="card-body p-4">
                @if($errors->any())
                <div class="alert alert-danger" style="border-radius: 3px; font-size: 13px;">
                    @foreach($errors->all() as $err) <div>{{ $err }}</div> @endforeach
                </div>
                @endif

                @if($keberatan->file_tanggapan)
                <div class="mb-4">
                    <label class="text-muted font-weight-bold d-block mb-1" style="font-size: 11px; text-transform: uppercase;">Dokumen Terkirim</label>
                    <div class="p-2 border d-flex align-items-center justify-content-between" style="background:#F8FAFC; border-color:#E2E8F0; border-radius: 3px;">
                        <span class="d-flex align-items-center overflow-hidden" style="gap: 8px;">
                            <span class="material-icons text-success" style="font-size: 18px;">description</span>
                            <span class="text-truncate text-dark font-weight-bold" style="font-size: 13px; max-width: 140px;" title="{{ basename($keberatan->file_tanggapan) }}">
                                {{ basename($keberatan->file_tanggapan) }}
                            </span>
                        </span>
                        <a href="{{ asset('storage/' . $keberatan->file_tanggapan) }}" target="_blank" class="btn btn-xs btn-outline-success font-weight-bold py-1 px-2 d-inline-flex align-items-center" style="gap: 3px; font-size: 11px;">
                            <span class="material-icons" style="font-size: 12px;">visibility</span> Lihat
                        </a>
                    </div>
                </div>
                @endif

                <form action="{{ route('admin.ppid.keberatan.update-status', $keberatan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="form-group mb-3">
                        <label class="font-weight-bold" style="font-size: 13px; color: #1E293B;">Status Keberatan <span class="text-danger">*</span></label>
                        <select name="status" class="form-control custom-select" required>
                            <option value="pending" {{ $keberatan->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="ditanggapi" {{ $keberatan->status === 'ditanggapi' ? 'selected' : '' }}>Ditanggapi</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold" style="font-size: 13px; color: #1E293B;">Tanggapan Admin <span class="text-danger">*</span></label>
                        <textarea name="tanggapan_admin" rows="7"
                            class="form-control @error('tanggapan_admin') is-invalid @enderror"
                            style="font-size: 13.5px; resize: vertical;"
                            placeholder="Tulis tanggapan resmi terhadap keberatan ini..." required>{{ old('tanggapan_admin', $keberatan->tanggapan_admin) }}</textarea>
                        @error('tanggapan_admin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="file_tanggapan" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">Dokumen Pendukung / Surat Tanggapan</label>
                        <input type="file" name="file_tanggapan" id="file_tanggapan" class="form-control-file" style="font-size: 13px;">
                        <small class="text-muted d-block mt-1">Format: PDF, Word, Excel, ZIP, dll. (Maks. 20MB). File ini akan dikirimkan ke email pemohon sebagai lampiran.</small>
                    </div>

                    <div class="d-flex" style="gap: 10px;">
                        <a href="{{ route('admin.ppid.keberatan.index') }}" class="btn btn-outline-secondary" style="flex: 1; text-align: center;">
                            Batal
                        </a>
                        <button type="submit" class="btn btn-success font-weight-bold d-inline-flex align-items-center justify-content-center" style="gap: 5px; flex: 2;">
                            <span class="material-icons" style="font-size: 16px;">save</span>
                            Simpan Tanggapan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
