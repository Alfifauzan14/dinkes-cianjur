@extends('admin.layouts.admin')
@section('title', 'Layanan PPID — Data Permohonan')
@section('header_title', 'Layanan PPID')

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

{{-- Ringkasan Statistik --}}
<div class="row mb-4">
    <div class="col-md-3 col-sm-6 col-12 mb-3 mb-md-0">
        <div class="stat-card-clean">
            <div class="stat-icon-box" style="background: #E0F2FE; color: #0284C7;">
                <span class="material-icons" style="font-size: 24px;">inventory_2</span>
            </div>
            <div>
                <div class="text-muted" style="font-size: 12.5px; font-weight: 500; margin-bottom: 2px;">Total Permohonan</div>
                <div class="font-weight-bold text-dark" style="font-size: 22px; line-height: 1.1;">{{ $stats['total'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12 mb-3 mb-md-0">
        <div class="stat-card-clean">
            <div class="stat-icon-box" style="background: #FEF3C7; color: #D97706;">
                <span class="material-icons" style="font-size: 24px;">assignment</span>
            </div>
            <div>
                <div class="text-muted" style="font-size: 12.5px; font-weight: 500; margin-bottom: 2px;">Menunggu Review</div>
                <div class="font-weight-bold text-dark" style="font-size: 22px; line-height: 1.1;">{{ $stats['pending'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12 mb-3 mb-md-0">
        <div class="stat-card-clean">
            <div class="stat-icon-box" style="background: #D1FAE5; color: #059669;">
                <span class="material-icons" style="font-size: 24px;">check_circle</span>
            </div>
            <div>
                <div class="text-muted" style="font-size: 12.5px; font-weight: 500; margin-bottom: 2px;">Disetujui</div>
                <div class="font-weight-bold text-dark" style="font-size: 22px; line-height: 1.1;">{{ $stats['disetujui'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="stat-card-clean">
            <div class="stat-icon-box" style="background: #FEE2E2; color: #DC2626;">
                <span class="material-icons" style="font-size: 24px;">cancel</span>
            </div>
            <div>
                <div class="text-muted" style="font-size: 12.5px; font-weight: 500; margin-bottom: 2px;">Ditolak</div>
                <div class="font-weight-bold text-dark" style="font-size: 22px; line-height: 1.1;">{{ $stats['ditolak'] }}</div>
            </div>
        </div>
    </div>
</div>

{{-- Filter & Daftar Permohonan --}}
<div class="card card-outline card-success">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between" style="gap: 12px; padding: 14px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
        <span class="d-flex align-items-center" style="gap: 8px;">
            <span class="material-icons text-success" style="font-size: 20px;">assignment</span>
            <span class="font-weight-bold card-title-label">Daftar Permohonan Informasi Publik</span>
        </span>

        {{-- Filter Status --}}
        <div class="custom-segmented-filter">
            <a href="{{ route('admin.ppid.permohonan.index') }}" class="seg-item {{ is_null($status) ? 'active' : '' }}">
                Semua
            </a>
            <a href="{{ route('admin.ppid.permohonan.index', ['status' => 'pending']) }}" class="seg-item {{ $status === 'pending' ? 'active' : '' }}">
                Pending
            </a>
            <a href="{{ route('admin.ppid.permohonan.index', ['status' => 'disetujui']) }}" class="seg-item {{ $status === 'disetujui' ? 'active' : '' }}">
                Disetujui
            </a>
            <a href="{{ route('admin.ppid.permohonan.index', ['status' => 'ditolak']) }}" class="seg-item {{ $status === 'ditolak' ? 'active' : '' }}">
                Ditolak
            </a>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead>
                    <tr>
                        <th style="width: 250px; padding-left: 20px;">Pemohon / NIK</th>
                        <th style="width: 180px;">Kontak</th>
                        <th>Informasi yang Diminta</th>
                        <th style="width: 150px;">Tanggal Masuk</th>
                        <th class="text-center" style="width: 130px;">Status</th>
                        <th class="text-center" style="width: 90px; padding-right: 20px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($permohonans as $perm)
                    <tr>
                        <td class="align-middle" style="padding-left: 20px;">
                            <div class="font-weight-bold text-dark">{{ $perm->nama_pemohon }}</div>
                            <div class="text-muted" style="font-size: 12px; margin-top: 2px;">
                                Token: <span class="text-success font-weight-bold">{{ $perm->token }}</span> | NIK: {{ $perm->nik }}
                            </div>
                            <span class="badge" style="background:#F1F5F9; color:#475569; padding:3px 8px; border-radius:3px; font-size:11px; margin-top: 4px; display:inline-block;">
                                {{ $perm->pekerjaan }}
                            </span>
                        </td>
                        <td class="align-middle">
                            <div class="d-flex align-items-center text-dark" style="font-size: 13px;">
                                <span class="material-icons text-secondary mr-1" style="font-size: 14px;">phone</span>
                                <span>{{ $perm->no_hp }}</span>
                            </div>
                            @if($perm->email)
                            <div class="d-flex align-items-center text-muted mt-1" style="font-size: 12.5px;">
                                <span class="material-icons text-secondary mr-1" style="font-size: 14px;">email</span>
                                <span>{{ $perm->email }}</span>
                            </div>
                            @else
                            <div class="text-muted mt-1" style="font-size: 12px; font-style: italic;">Tidak ada email</div>
                            @endif
                        </td>
                        <td class="align-middle">
                            <div class="mb-1">
                                <span class="badge" style="background-color: #E2E8F0; color: #475569; font-size: 11px; font-weight: 700; border-radius: 3px; padding: 3px 8px;">
                                    {{ str_replace('_', ' ', ucwords($perm->jenis_informasi)) }}
                                </span>
                            </div>
                            <div class="text-dark" style="font-size: 13.5px; max-width: 320px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                {{ $perm->rincian_informasi }}
                            </div>
                        </td>
                        <td class="text-secondary align-middle" style="font-size: 13px;">
                            {{ $perm->created_at->format('d M Y, H:i') }}
                        </td>
                        <td class="text-center align-middle">
                            @if($perm->status === 'pending')
                                <span class="badge" style="background-color: #FEF3C7; color: #D97706; padding: 4px 10px; border-radius: 3px; font-size: 11.5px; font-weight: 700;">
                                    Pending
                                </span>
                            @elseif($perm->status === 'disetujui')
                                <span class="badge" style="background-color: #DEF7EC; color: #03543F; padding: 4px 10px; border-radius: 3px; font-size: 11.5px; font-weight: 700;">
                                    Disetujui
                                </span>
                            @else
                                <span class="badge" style="background-color: #FDE8E8; color: #9B1C1C; padding: 4px 10px; border-radius: 3px; font-size: 11.5px; font-weight: 700;">
                                    Ditolak
                                </span>
                            @endif
                        </td>
                        <td class="text-center align-middle" style="padding-right: 20px;">
                            <div class="btn-action-group">
                                <a href="{{ route('admin.ppid.permohonan.show', $perm->id) }}" class="btn-action btn-action-edit" title="Detail Permohonan">
                                    <span class="material-icons" style="font-size: 16px;">visibility</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <span class="material-icons" style="font-size: 48px; display: block; margin-bottom: 8px; color: #CBD5E1;">assignment_late</span>
                            <p class="font-weight-bold mb-1">Belum Ada Permohonan</p>
                            <small class="text-muted">Tidak ada permohonan informasi publik yang masuk dengan filter status ini.</small>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($permohonans->hasPages())
    <div class="card-footer bg-white border-top p-3 d-flex flex-wrap justify-content-between align-items-center" style="gap: 10px;">
        <div class="text-muted" style="font-size: 13px;">
            Menampilkan {{ $permohonans->firstItem() }} - {{ $permohonans->lastItem() }} dari {{ $permohonans->total() }} data
        </div>
        <div>
            {{ $permohonans->links() }}
        </div>
    </div>
    @endif
</div>
@endsection
