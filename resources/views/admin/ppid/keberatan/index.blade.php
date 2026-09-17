@extends('admin.layouts.admin')
@section('title', 'Layanan PPID — Keberatan')
@section('header_title', 'Keberatan PPID')

@section('styles')
<style>
    .stat-card-clean {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        padding: 16px 20px;
        display: flex;
        align-items: center;
        gap: 14px;
        height: 100%;
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }
    .stat-card-clean:hover {
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.07);
    }
    .stat-icon-box {
        width: 48px;
        height: 48px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .custom-segmented-filter {
        border: 1px solid #CBD5E1;
        border-radius: 6px;
        background: #FFFFFF;
        overflow: hidden;
        display: inline-flex;
        align-items: stretch;
    }
    .custom-segmented-filter .seg-item {
        padding: 7px 18px;
        font-size: 13px;
        font-weight: 600;
        color: #475569;
        text-decoration: none;
        transition: all 0.15s ease-in-out;
        border-right: 1px solid #CBD5E1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #FFFFFF;
    }
    .custom-segmented-filter .seg-item:last-child {
        border-right: none;
    }
    .custom-segmented-filter .seg-item:hover {
        background: #F8FAFC;
        color: #009966;
    }
    .custom-segmented-filter .seg-item.active {
        background: #009966;
        color: #FFFFFF;
    }
</style>
@endsection

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-3" style="gap:8px; border-radius: 3px;">
        <span class="material-icons">check_circle</span>
        <span>{{ session('success') }}</span>
        <button type="button" class="close ml-auto" data-dismiss="alert"><span>&times;</span></button>
    </div>
@endif

{{-- Stats --}}
<div class="row mb-4">
    <div class="col-md-4 col-sm-6 col-12 mb-3 mb-md-0">
        <div class="stat-card-clean">
            <div class="stat-icon-box" style="background: #E0F2FE; color: #0284C7;">
                <span class="material-icons" style="font-size: 24px;">inventory_2</span>
            </div>
            <div>
                <div class="text-muted" style="font-size: 12.5px; font-weight: 500; margin-bottom: 2px;">Total Keberatan</div>
                <div class="font-weight-bold text-dark" style="font-size: 22px; line-height: 1.1;">{{ $stats['total'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6 col-12 mb-3 mb-md-0">
        <div class="stat-card-clean">
            <div class="stat-icon-box" style="background: #FEF3C7; color: #D97706;">
                <span class="material-icons" style="font-size: 24px;">pending_actions</span>
            </div>
            <div>
                <div class="text-muted" style="font-size: 12.5px; font-weight: 500; margin-bottom: 2px;">Belum Ditanggapi</div>
                <div class="font-weight-bold text-dark" style="font-size: 22px; line-height: 1.1;">{{ $stats['pending'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6 col-12">
        <div class="stat-card-clean">
            <div class="stat-icon-box" style="background: #D1FAE5; color: #059669;">
                <span class="material-icons" style="font-size: 24px;">check_circle</span>
            </div>
            <div>
                <div class="text-muted" style="font-size: 12.5px; font-weight: 500; margin-bottom: 2px;">Sudah Ditanggapi</div>
                <div class="font-weight-bold text-dark" style="font-size: 22px; line-height: 1.1;">{{ $stats['ditanggapi'] }}</div>
            </div>
        </div>
    </div>
</div>

{{-- Tabel --}}
<div class="card card-outline card-warning">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between" style="gap: 12px; padding: 14px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
        <span class="d-flex align-items-center" style="gap: 8px;">
            <span class="material-icons text-warning" style="font-size: 20px;">report_problem</span>
            <span class="font-weight-bold card-title-label">Daftar Pengajuan Keberatan</span>
        </span>

        <div class="custom-segmented-filter">
            <a href="{{ route('admin.ppid.keberatan.index') }}" class="seg-item {{ is_null($status) ? 'active' : '' }}">Semua</a>
            <a href="{{ route('admin.ppid.keberatan.index', ['status' => 'pending']) }}" class="seg-item {{ $status === 'pending' ? 'active' : '' }}">Pending</a>
            <a href="{{ route('admin.ppid.keberatan.index', ['status' => 'ditanggapi']) }}" class="seg-item {{ $status === 'ditanggapi' ? 'active' : '' }}">Ditanggapi</a>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead>
                    <tr>
                        <th style="width: 220px; padding-left: 20px;">Pemohon / Token</th>
                        <th>Alasan Keberatan</th>
                        <th style="width: 160px;">Status Permohonan</th>
                        <th style="width: 150px;">Tanggal Masuk</th>
                        <th class="text-center" style="width: 140px;">Status Keberatan</th>
                        <th class="text-center" style="width: 90px; padding-right: 20px;">Aksi</th>
                    </tr>
                </thead>
                <tbody style="font-size: 14px; color: #334155;">
                    @forelse($keberatans as $kb)
                    <tr>
                        <td class="align-middle" style="padding-left: 20px;">
                            <div class="font-weight-bold text-dark">{{ $kb->permohonan->nama_pemohon ?? '-' }}</div>
                            <div class="text-muted" style="font-size: 12px; margin-top: 2px;">
                                Token: <span class="text-warning font-weight-bold">{{ $kb->token }}</span>
                            </div>
                            <div class="text-muted" style="font-size: 12px;">{{ $kb->email }}</div>
                        </td>
                        <td class="align-middle">
                            <div class="text-dark" style="font-size: 13.5px; max-width: 360px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                {{ $kb->alasan_keberatan }}
                            </div>
                        </td>
                        <td class="align-middle">
                            @php $pStatus = $kb->permohonan->status ?? 'pending'; @endphp
                            @if($pStatus === 'pending')
                                <span class="badge" style="background-color: #FEF3C7; color: #D97706; padding: 4px 10px; border-radius: 3px; font-size: 11.5px; font-weight: 700;">Pending</span>
                            @elseif($pStatus === 'disetujui')
                                <span class="badge" style="background-color: #DEF7EC; color: #03543F; padding: 4px 10px; border-radius: 3px; font-size: 11.5px; font-weight: 700;">Disetujui</span>
                            @else
                                <span class="badge" style="background-color: #FDE8E8; color: #9B1C1C; padding: 4px 10px; border-radius: 3px; font-size: 11.5px; font-weight: 700;">Ditolak</span>
                            @endif
                        </td>
                        <td class="text-secondary align-middle" style="font-size: 13px;">
                            {{ $kb->created_at->format('d M Y, H:i') }}
                        </td>
                        <td class="text-center align-middle">
                            @if($kb->status === 'pending')
                                <span class="badge" style="background-color: #FEF3C7; color: #D97706; padding: 4px 10px; border-radius: 3px; font-size: 11.5px; font-weight: 700;">Pending</span>
                            @else
                                <span class="badge" style="background-color: #DEF7EC; color: #03543F; padding: 4px 10px; border-radius: 3px; font-size: 11.5px; font-weight: 700;">Ditanggapi</span>
                            @endif
                        </td>
                        <td class="text-center align-middle" style="padding-right: 20px;">
                            <div class="btn-action-group">
                                <a href="{{ route('admin.ppid.keberatan.show', $kb->id) }}" class="btn-action btn-action-edit" title="Detail Keberatan">
                                    <span class="material-icons" style="font-size: 16px;">visibility</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <span class="material-icons" style="font-size: 48px; display: block; margin-bottom: 8px; color: #CBD5E1;">report_off</span>
                            <p class="font-weight-bold mb-1">Belum Ada Keberatan</p>
                            <small class="text-muted">Tidak ada pengajuan keberatan dengan filter ini.</small>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($keberatans->hasPages())
    <div class="card-footer bg-white border-top p-3 d-flex flex-wrap justify-content-between align-items-center" style="gap: 10px;">
        <div class="text-muted" style="font-size: 13px;">
            Menampilkan {{ $keberatans->firstItem() }} - {{ $keberatans->lastItem() }} dari {{ $keberatans->total() }} data
        </div>
        <div>{{ $keberatans->links() }}</div>
    </div>
    @endif
</div>
@endsection
