@extends('admin.layouts.admin')
@section('title', 'Detail Keberatan #' . $keberatan->id)
@section('header_title', 'Detail Keberatan')

@section('content')
<div class="container-fluid">

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" style="gap: 10px; border-radius: 6px;">
        <span class="material-icons" style="font-size: 20px;">check_circle</span>
        {{ session('success') }}
        <button type="button" class="close ml-auto" data-dismiss="alert"><span>&times;</span></button>
    </div>
    @endif

    <div class="row">
        {{-- Kiri: Info Pemohon + Detail Permohonan + Keberatan --}}
        <div class="col-lg-7">

            {{-- Info Pemohon --}}
            <div class="card shadow-sm mb-4" style="border-radius: 8px; border-top: 3px solid #D97706;">
                <div class="card-header bg-white" style="border-radius: 8px 8px 0 0; padding: 16px 20px;">
                    <span class="d-flex align-items-center" style="gap: 8px;">
                        <span class="material-icons" style="color: #D97706; font-size: 20px;">person</span>
                        <span class="font-weight-bold text-dark">Identitas Pemohon</span>
                    </span>
                </div>
                <div class="card-body" style="padding: 20px;">
                    <dl class="row mb-0" style="row-gap: 10px;">
                        <dt class="col-sm-4 text-muted" style="font-size: 13px; font-weight: 600;">Nama Lengkap</dt>
                        <dd class="col-sm-8 mb-0 font-weight-bold">{{ $keberatan->permohonan->nama_pemohon ?? '-' }}</dd>

                        <dt class="col-sm-4 text-muted" style="font-size: 13px; font-weight: 600;">Token Permohonan</dt>
                        <dd class="col-sm-8 mb-0">
                            <span class="badge px-2 py-1 font-weight-bold" style="background-color: #FEF3C7; color: #D97706; border: 1px solid #FCD34D; font-size: 13px;">
                                {{ $keberatan->token }}
                            </span>
                        </dd>

                        <dt class="col-sm-4 text-muted" style="font-size: 13px; font-weight: 600;">Email</dt>
                        <dd class="col-sm-8 mb-0">{{ $keberatan->email }}</dd>

                        <dt class="col-sm-4 text-muted" style="font-size: 13px; font-weight: 600;">Tanggal Keberatan</dt>
                        <dd class="col-sm-8 mb-0">{{ $keberatan->created_at->format('d M Y, H:i') }}</dd>
                    </dl>
                </div>
            </div>

            {{-- Detail Permohonan Asli --}}
            @if($keberatan->permohonan)
            <div class="card shadow-sm mb-4" style="border-radius: 8px; border-top: 3px solid #64748B;">
                <div class="card-header bg-white" style="padding: 16px 20px;">
                    <span class="d-flex align-items-center" style="gap: 8px;">
                        <span class="material-icons" style="color: #64748B; font-size: 20px;">assignment</span>
                        <span class="font-weight-bold text-dark">Permohonan Asal</span>
                        @if($keberatan->permohonan->status === 'ditolak')
                            <span class="badge ml-2" style="background-color: #FEF2F2; color: #B91C1C; border: 1px solid #FCA5A5; font-size: 11px;">Ditolak</span>
                        @elseif($keberatan->permohonan->status === 'disetujui')
                            <span class="badge ml-2" style="background-color: #ECFDF5; color: #047857; border: 1px solid #6EE7B7; font-size: 11px;">Disetujui</span>
                        @else
                            <span class="badge ml-2" style="background-color: #FFFBEB; color: #D97706; border: 1px solid #FCD34D; font-size: 11px;">Pending</span>
                        @endif
                    </span>
                </div>
                <div class="card-body" style="padding: 20px;">
                    <dl class="row mb-0" style="row-gap: 10px;">
                        <dt class="col-sm-4 text-muted" style="font-size: 13px; font-weight: 600;">Jenis Informasi</dt>
                        <dd class="col-sm-8 mb-0">{{ str_replace('_', ' ', ucwords($keberatan->permohonan->jenis_informasi)) }}</dd>

                        <dt class="col-sm-4 text-muted" style="font-size: 13px; font-weight: 600;">Rincian Diminta</dt>
                        <dd class="col-sm-8 mb-0">{{ $keberatan->permohonan->rincian_informasi }}</dd>

                        @if($keberatan->permohonan->tanggapan)
                        <dt class="col-sm-4 text-muted" style="font-size: 13px; font-weight: 600;">Tanggapan PPID</dt>
                        <dd class="col-sm-8 mb-0">{{ $keberatan->permohonan->tanggapan }}</dd>
                        @endif
                    </dl>
                    <div class="mt-3">
                        <a href="{{ route('admin.ppid.permohonan.show', $keberatan->permohonan->id) }}"
                           class="btn btn-sm btn-outline-secondary" style="border-radius: 4px; font-size: 13px;">
                            <span class="material-icons" style="font-size: 15px; vertical-align: middle;">open_in_new</span>
                            Lihat Permohonan Lengkap
                        </a>
                    </div>
                </div>
            </div>
            @endif

            {{-- Alasan Keberatan --}}
            <div class="card shadow-sm mb-4" style="border-radius: 8px; border-top: 3px solid #EF4444;">
                <div class="card-header bg-white" style="padding: 16px 20px;">
                    <span class="d-flex align-items-center" style="gap: 8px;">
                        <span class="material-icons" style="color: #EF4444; font-size: 20px;">report_problem</span>
                        <span class="font-weight-bold text-dark">Alasan Keberatan</span>
                    </span>
                </div>
                <div class="card-body" style="padding: 20px;">
                    <p class="mb-0" style="font-size: 15px; line-height: 1.7; white-space: pre-wrap; color: #334155;">{{ $keberatan->alasan_keberatan }}</p>
                </div>
            </div>

        </div>

        {{-- Kanan: Form Tanggapan --}}
        <div class="col-lg-5">
            <div class="card shadow-sm" style="border-radius: 8px; border-top: 3px solid #009966; position: sticky; top: 20px;">
                <div class="card-header bg-white" style="padding: 16px 20px;">
                    <span class="d-flex align-items-center" style="gap: 8px;">
                        <span class="material-icons" style="color: #009966; font-size: 20px;">rate_review</span>
                        <span class="font-weight-bold text-dark">Tanggapi Keberatan</span>
                    </span>
                </div>
                <div class="card-body" style="padding: 20px;">
                    @if($errors->any())
                    <div class="alert alert-danger" style="border-radius: 6px; font-size: 13px;">
                        @foreach($errors->all() as $err) <div>{{ $err }}</div> @endforeach
                    </div>
                    @endif

                    <form action="{{ route('admin.ppid.keberatan.update-status', $keberatan->id) }}" method="POST">
                        @csrf @method('PUT')

                        <div class="form-group">
                            <label class="font-weight-bold text-dark" style="font-size: 13px;">Status Keberatan</label>
                            <select name="status" class="form-control" style="border-radius: 4px; font-size: 14px; border-color: #E2E8F0;">
                                <option value="pending" {{ $keberatan->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="ditanggapi" {{ $keberatan->status === 'ditanggapi' ? 'selected' : '' }}>Ditanggapi</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold text-dark" style="font-size: 13px;">Tanggapan Admin</label>
                            <textarea name="tanggapan_admin" rows="8"
                                class="form-control @error('tanggapan_admin') is-invalid @enderror"
                                style="border-radius: 4px; font-size: 14px; border-color: #E2E8F0; resize: vertical;"
                                placeholder="Tulis tanggapan resmi terhadap keberatan ini...">{{ old('tanggapan_admin', $keberatan->tanggapan_admin) }}</textarea>
                            @error('tanggapan_admin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-flex" style="gap: 10px;">
                            <a href="{{ route('admin.ppid.keberatan.index') }}"
                               class="btn btn-outline-secondary" style="border-radius: 4px; font-size: 14px; flex: 1; text-align: center;">
                                &larr; Kembali
                            </a>
                            <button type="submit" class="btn btn-success" style="border-radius: 4px; font-size: 14px; flex: 2; background-color: #009966; border-color: #009966;">
                                <span class="material-icons" style="font-size: 16px; vertical-align: middle;">save</span>
                                Simpan Tanggapan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
