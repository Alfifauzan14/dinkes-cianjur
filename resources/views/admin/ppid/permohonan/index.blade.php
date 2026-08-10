@extends('admin.layouts.admin')
@section('title', 'Layanan PPID — Data Permohonan')
@section('header_title', 'Layanan PPID')

@section('content')
<div class="container-fluid">
    {{-- Email Pengirim --}}
    <div class="card card-outline card-success shadow-sm mb-4" style="border-radius: 8px; border-top: 3px solid #009966;">
        <div class="card-header bg-white d-flex align-items-center justify-content-start" style="padding: 14px 20px; border-bottom: 1px solid #E2E8F0;">
            <span class="material-icons text-success mr-2" style="font-size: 22px;">email</span>
            <span class="font-weight-bold text-dark" style="font-size: 15px;">Email Pengirim Tanggapan PPID</span>
        </div>
        <div class="card-body" style="padding: 16px 20px;">
            <p class="text-muted mb-3" style="font-size: 13px;">Email ini digunakan sebagai pengirim saat mengirimkan tanggapan dan dokumen ke pemohon informasi publik.</p>
            <form action="{{ route('admin.ppid.permohonan.update-email') }}" method="POST" class="d-flex align-items-center" style="gap: 10px;">
                @csrf
                @method('PUT')
                <input type="email" name="email_ppid" value="{{ old('email_ppid', $ppidSetting->email_ppid) }}" class="form-control @error('email_ppid') is-invalid @enderror" placeholder="contoh: ppid@dinkes.cianjurkab.go.id" style="border-radius: 4px; max-width: 400px; font-size: 14px;" required>
                @error('email_ppid')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-success btn-sm d-inline-flex align-items-center" style="gap: 5px; padding: 8px 16px; border-radius: 4px; font-weight: 600;">
                    <span class="material-icons" style="font-size: 16px;">save</span> Simpan
                </button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 6px; border-left: 4px solid #047857; background-color: #ECFDF5; color: #047857;">
            <span class="d-flex align-items-center">
                <span class="material-icons mr-2">check_circle</span>
                {{ session('success') }}
            </span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- Ringkasan Statistik --}}
    <div class="row mb-4">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-white border-0 shadow-sm" style="border-radius: 8px; padding: 15px;">
                <span class="info-box-icon elevation-1" style="background-color: #E0F2FE; color: #0369A1; border-radius: 6px; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                    <span class="material-icons">all_inbox</span>
                </span>
                <div class="info-box-content ml-3" style="padding: 0;">
                    <span class="info-box-text text-muted" style="font-size: 13px; font-weight: 500;">Total Permohonan</span>
                    <span class="info-box-number text-dark font-weight-bold h4 mb-0">{{ $stats['total'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-white border-0 shadow-sm" style="border-radius: 8px; padding: 15px;">
                <span class="info-box-icon elevation-1" style="background-color: #FEF3C7; color: #D97706; border-radius: 6px; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                    <span class="material-icons">pending_actions</span>
                </span>
                <div class="info-box-content ml-3" style="padding: 0;">
                    <span class="info-box-text text-muted" style="font-size: 13px; font-weight: 500;">Menunggu Review</span>
                    <span class="info-box-number text-dark font-weight-bold h4 mb-0">{{ $stats['pending'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-white border-0 shadow-sm" style="border-radius: 8px; padding: 15px;">
                <span class="info-box-icon elevation-1" style="background-color: #D1FAE5; color: #047857; border-radius: 6px; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                    <span class="material-icons">check_circle</span>
                </span>
                <div class="info-box-content ml-3" style="padding: 0;">
                    <span class="info-box-text text-muted" style="font-size: 13px; font-weight: 500;">Disetujui</span>
                    <span class="info-box-number text-dark font-weight-bold h4 mb-0">{{ $stats['disetujui'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-white border-0 shadow-sm" style="border-radius: 8px; padding: 15px;">
                <span class="info-box-icon elevation-1" style="background-color: #FEE2E2; color: #B91C1C; border-radius: 6px; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                    <span class="material-icons">cancel</span>
                </span>
                <div class="info-box-content ml-3" style="padding: 0;">
                    <span class="info-box-text text-muted" style="font-size: 13px; font-weight: 500;">Ditolak</span>
                    <span class="info-box-number text-dark font-weight-bold h4 mb-0">{{ $stats['ditolak'] }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter & Daftar Permohonan --}}
    <div class="card card-outline card-success shadow-sm" style="border-radius: 8px; border-top: 3px solid #009966;">
        <div class="card-header bg-white d-flex flex-wrap align-items-center justify-content-between" style="gap: 15px; padding: 18px 20px; border-bottom: 1px solid #E2E8F0;">
            <span class="d-flex align-items-center" style="gap: 8px;">
                <span class="material-icons text-success" style="font-size: 24px;">assignment</span>
                <span class="font-weight-bold text-dark" style="font-size: 16px;">Daftar Permohonan Informasi Publik</span>
            </span>

            {{-- Filter Status --}}
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <a href="{{ route('admin.ppid.permohonan.index') }}" class="btn btn-sm btn-outline-secondary {{ is_null($status) ? 'active' : '' }}" style="padding: 6px 14px;">
                    Semua
                </a>
                <a href="{{ route('admin.ppid.permohonan.index', ['status' => 'pending']) }}" class="btn btn-sm btn-outline-warning {{ $status === 'pending' ? 'active' : '' }}" style="padding: 6px 14px;">
                    Pending
                </a>
                <a href="{{ route('admin.ppid.permohonan.index', ['status' => 'disetujui']) }}" class="btn btn-sm btn-outline-success {{ $status === 'disetujui' ? 'active' : '' }}" style="padding: 6px 14px;">
                    Disetujui
                </a>
                <a href="{{ route('admin.ppid.permohonan.index', ['status' => 'ditolak']) }}" class="btn btn-sm btn-outline-danger {{ $status === 'ditolak' ? 'active' : '' }}" style="padding: 6px 14px;">
                    Ditolak
                </a>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 align-middle">
                    <thead style="background-color: #F8FAFC; color: #475569; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">
                        <tr>
                            <th class="pl-4 py-3" style="width: 250px;">Pemohon / NIK</th>
                            <th class="py-3" style="width: 180px;">Kontak</th>
                            <th class="py-3">Informasi yang Diminta</th>
                            <th class="py-3" style="width: 150px;">Tanggal Masuk</th>
                            <th class="py-3 text-center" style="width: 130px;">Status</th>
                            <th class="pr-4 py-3 text-center" style="width: 100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 14px; color: #334155;">
                        @forelse($permohonans as $perm)
                        <tr style="transition: all 0.2s ease;">
                            <td class="pl-4 py-3 align-middle">
                                <div class="font-weight-bold text-dark" style="font-size: 15px;">{{ $perm->nama_pemohon }}</div>
                                <div class="text-muted" style="font-size: 12px;">Token: <span class="text-success font-weight-bold">{{ $perm->token }}</span> | NIK: {{ $perm->nik }}</div>
                                <span class="badge badge-light border text-muted px-2 py-1 mt-1" style="font-size: 11px;">{{ $perm->pekerjaan }}</span>
                            </td>
                            <td class="py-3 align-middle">
                                <div class="d-flex align-items-center mb-1 text-dark">
                                    <span class="material-icons text-secondary mr-1" style="font-size: 15px;">phone</span>
                                    <span>{{ $perm->no_hp }}</span>
                                </div>
                                @if($perm->email)
                                <div class="d-flex align-items-center text-muted" style="font-size: 13px;">
                                    <span class="material-icons text-secondary mr-1" style="font-size: 15px;">email</span>
                                    <span>{{ $perm->email }}</span>
                                </div>
                                @else
                                <span class="text-muted" style="font-size: 12px; font-style: italic;">Tidak ada email</span>
                                @endif
                            </td>
                            <td class="py-3 align-middle">
                                <div class="mb-1">
                                    <span class="badge" style="background-color: #E2E8F0; color: #475569; font-size: 11px; font-weight: 600;">
                                        {{ str_replace('_', ' ', ucwords($perm->jenis_informasi)) }}
                                    </span>
                                </div>
                                <div class="text-dark font-weight-500" style="max-width: 350px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {{ $perm->rincian_informasi }}
                                </div>
                            </td>
                            <td class="py-3 align-middle text-secondary">
                                {{ $perm->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="py-3 align-middle text-center">
                                @if($perm->status === 'pending')
                                    <span class="badge px-3 py-2 font-weight-bold" style="background-color: #FFFBEB; color: #D97706; border: 1px solid #FCD34D; border-radius: 4px; font-size: 12px;">
                                        Pending
                                    </span>
                                @elseif($perm->status === 'disetujui')
                                    <span class="badge px-3 py-2 font-weight-bold" style="background-color: #ECFDF5; color: #047857; border: 1px solid #6EE7B7; border-radius: 4px; font-size: 12px;">
                                        Disetujui
                                    </span>
                                @else
                                    <span class="badge px-3 py-2 font-weight-bold" style="background-color: #FEF2F2; color: #B91C1C; border: 1px solid #FCA5A5; border-radius: 4px; font-size: 12px;">
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                            <td class="pr-4 py-3 align-middle text-center">
                                <a href="{{ route('admin.ppid.permohonan.show', $perm->id) }}" class="btn btn-sm btn-outline-success d-inline-flex align-items-center justify-content-center" style="width: 34px; height: 34px; border-radius: 4px; padding: 0;" title="Detail Permohonan">
                                    <span class="material-icons" style="font-size: 18px;">visibility</span>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <span class="material-icons" style="font-size: 56px; display: block; margin-bottom: 12px; color: #CBD5E1;">assignment_late</span>
                                <div class="h6 font-weight-bold mb-1">Belum Ada Permohonan</div>
                                <p class="mb-0" style="font-size: 13px;">Tidak ada permohonan informasi publik yang masuk dengan status ini.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($permohonans->hasPages())
            <div class="card-footer bg-white border-top py-3 px-4 d-flex justify-content-between align-items-center">
                <div class="text-muted" style="font-size: 13px;">
                    Menampilkan {{ $permohonans->firstItem() }} - {{ $permohonans->lastItem() }} dari {{ $permohonans->total() }} data
                </div>
                <div>
                    {{ $permohonans->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
