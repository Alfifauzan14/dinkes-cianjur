@extends('admin.layouts.admin')
@section('title', 'Layanan PPID — Keberatan')
@section('header_title', 'Keberatan PPID')

@section('content')
<div class="container-fluid">

    {{-- Stats --}}
    <div class="row mb-4">
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-white border-0 shadow-sm" style="border-radius: 8px; padding: 15px;">
                <span class="info-box-icon elevation-1" style="background-color: #E0F2FE; color: #0369A1; border-radius: 6px; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                    <span class="material-icons">all_inbox</span>
                </span>
                <div class="info-box-content ml-3" style="padding: 0;">
                    <span class="info-box-text text-muted" style="font-size: 13px; font-weight: 500;">Total Keberatan</span>
                    <span class="info-box-number text-dark font-weight-bold h4 mb-0">{{ $stats['total'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-white border-0 shadow-sm" style="border-radius: 8px; padding: 15px;">
                <span class="info-box-icon elevation-1" style="background-color: #FEF3C7; color: #D97706; border-radius: 6px; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                    <span class="material-icons">pending_actions</span>
                </span>
                <div class="info-box-content ml-3" style="padding: 0;">
                    <span class="info-box-text text-muted" style="font-size: 13px; font-weight: 500;">Belum Ditanggapi</span>
                    <span class="info-box-number text-dark font-weight-bold h4 mb-0">{{ $stats['pending'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-white border-0 shadow-sm" style="border-radius: 8px; padding: 15px;">
                <span class="info-box-icon elevation-1" style="background-color: #D1FAE5; color: #047857; border-radius: 6px; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                    <span class="material-icons">check_circle</span>
                </span>
                <div class="info-box-content ml-3" style="padding: 0;">
                    <span class="info-box-text text-muted" style="font-size: 13px; font-weight: 500;">Sudah Ditanggapi</span>
                    <span class="info-box-number text-dark font-weight-bold h4 mb-0">{{ $stats['ditanggapi'] }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel --}}
    <div class="card card-outline card-warning shadow-sm" style="border-radius: 8px; border-top: 3px solid #D97706;">
        <div class="card-header bg-white d-flex flex-wrap align-items-center justify-content-between" style="gap: 15px; padding: 18px 20px; border-bottom: 1px solid #E2E8F0;">
            <span class="d-flex align-items-center" style="gap: 8px;">
                <span class="material-icons" style="color:#D97706; font-size: 24px;">report_problem</span>
                <span class="font-weight-bold text-dark" style="font-size: 16px;">Daftar Pengajuan Keberatan</span>
            </span>

            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <a href="{{ route('admin.ppid.keberatan.index') }}" class="btn btn-sm btn-outline-secondary {{ is_null($status) ? 'active' : '' }}" style="padding: 6px 14px;">Semua</a>
                <a href="{{ route('admin.ppid.keberatan.index', ['status' => 'pending']) }}" class="btn btn-sm btn-outline-warning {{ $status === 'pending' ? 'active' : '' }}" style="padding: 6px 14px;">Pending</a>
                <a href="{{ route('admin.ppid.keberatan.index', ['status' => 'ditanggapi']) }}" class="btn btn-sm btn-outline-success {{ $status === 'ditanggapi' ? 'active' : '' }}" style="padding: 6px 14px;">Ditanggapi</a>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 align-middle">
                    <thead style="background-color: #F8FAFC; color: #475569; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">
                        <tr>
                            <th class="pl-4 py-3" style="width: 220px;">Pemohon / Token</th>
                            <th class="py-3">Alasan Keberatan</th>
                            <th class="py-3" style="width: 160px;">Status Permohonan</th>
                            <th class="py-3" style="width: 150px;">Tanggal Masuk</th>
                            <th class="py-3 text-center" style="width: 140px;">Status Keberatan</th>
                            <th class="pr-4 py-3 text-center" style="width: 80px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 14px; color: #334155;">
                        @forelse($keberatans as $kb)
                        <tr>
                            <td class="pl-4 py-3 align-middle">
                                <div class="font-weight-bold text-dark" style="font-size: 15px;">{{ $kb->permohonan->nama_pemohon ?? '-' }}</div>
                                <div class="text-muted" style="font-size: 12px;">
                                    Token: <span class="text-warning font-weight-bold">{{ $kb->token }}</span>
                                </div>
                                <div class="text-muted" style="font-size: 12px;">{{ $kb->email }}</div>
                            </td>
                            <td class="py-3 align-middle">
                                <div style="max-width: 380px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {{ $kb->alasan_keberatan }}
                                </div>
                            </td>
                            <td class="py-3 align-middle">
                                @php $pStatus = $kb->permohonan->status ?? 'pending'; @endphp
                                @if($pStatus === 'pending')
                                    <span class="badge px-2 py-1 font-weight-bold" style="background-color: #FFFBEB; color: #D97706; border: 1px solid #FCD34D; border-radius: 4px; font-size: 11px;">Pending</span>
                                @elseif($pStatus === 'disetujui')
                                    <span class="badge px-2 py-1 font-weight-bold" style="background-color: #ECFDF5; color: #047857; border: 1px solid #6EE7B7; border-radius: 4px; font-size: 11px;">Disetujui</span>
                                @else
                                    <span class="badge px-2 py-1 font-weight-bold" style="background-color: #FEF2F2; color: #B91C1C; border: 1px solid #FCA5A5; border-radius: 4px; font-size: 11px;">Ditolak</span>
                                @endif
                            </td>
                            <td class="py-3 align-middle text-secondary">
                                {{ $kb->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="py-3 align-middle text-center">
                                @if($kb->status === 'pending')
                                    <span class="badge px-3 py-2 font-weight-bold" style="background-color: #FFFBEB; color: #D97706; border: 1px solid #FCD34D; border-radius: 4px; font-size: 12px;">Pending</span>
                                @else
                                    <span class="badge px-3 py-2 font-weight-bold" style="background-color: #ECFDF5; color: #047857; border: 1px solid #6EE7B7; border-radius: 4px; font-size: 12px;">Ditanggapi</span>
                                @endif
                            </td>
                            <td class="pr-4 py-3 align-middle text-center">
                                <a href="{{ route('admin.ppid.keberatan.show', $kb->id) }}"
                                   class="btn btn-sm btn-outline-warning d-inline-flex align-items-center justify-content-center"
                                   style="width: 34px; height: 34px; border-radius: 4px; padding: 0;" title="Detail Keberatan">
                                    <span class="material-icons" style="font-size: 18px;">visibility</span>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <span class="material-icons" style="font-size: 56px; display: block; margin-bottom: 12px; color: #CBD5E1;">report_off</span>
                                <div class="h6 font-weight-bold mb-1">Belum Ada Keberatan</div>
                                <p class="mb-0" style="font-size: 13px;">Tidak ada pengajuan keberatan dengan filter ini.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($keberatans->hasPages())
            <div class="card-footer bg-white border-top py-3 px-4 d-flex justify-content-between align-items-center">
                <div class="text-muted" style="font-size: 13px;">
                    Menampilkan {{ $keberatans->firstItem() }} - {{ $keberatans->lastItem() }} dari {{ $keberatans->total() }} data
                </div>
                <div>{{ $keberatans->links() }}</div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
