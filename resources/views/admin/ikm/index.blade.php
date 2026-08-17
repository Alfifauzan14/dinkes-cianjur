@extends('admin.layouts.admin')

@section('title', 'Data Indeks Kepuasan Masyarakat')
@section('header_title', 'Data Indeks Kepuasan Masyarakat (IKM)')

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
</style>
@endsection

@section('content')
{{-- Stat Badges Row --}}
<div class="row mb-4">
    <div class="col-lg-3 col-6 mb-3 mb-lg-0">
        <div class="stat-card-clean">
            <div class="stat-icon-box" style="background: #D1FAE5; color: #059669;">
                <span class="material-icons" style="font-size: 26px;">sentiment_very_satisfied</span>
            </div>
            <div>
                <div class="text-muted" style="font-size: 12.5px; font-weight: 500; margin-bottom: 2px;">Sangat Puas</div>
                <div class="font-weight-bold text-dark" style="font-size: 22px; line-height: 1.1;">{{ $stats['sangat_puas'] }}</div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-6 mb-3 mb-lg-0">
        <div class="stat-card-clean">
            <div class="stat-icon-box" style="background: #DBEAFE; color: #1D4ED8;">
                <span class="material-icons" style="font-size: 26px;">sentiment_satisfied</span>
            </div>
            <div>
                <div class="text-muted" style="font-size: 12.5px; font-weight: 500; margin-bottom: 2px;">Puas</div>
                <div class="font-weight-bold text-dark" style="font-size: 22px; line-height: 1.1;">{{ $stats['puas'] }}</div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-6 mb-3 mb-lg-0">
        <div class="stat-card-clean">
            <div class="stat-icon-box" style="background: #FEF3C7; color: #D97706;">
                <span class="material-icons" style="font-size: 26px;">sentiment_neutral</span>
            </div>
            <div>
                <div class="text-muted" style="font-size: 12.5px; font-weight: 500; margin-bottom: 2px;">Cukup</div>
                <div class="font-weight-bold text-dark" style="font-size: 22px; line-height: 1.1;">{{ $stats['cukup'] }}</div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-6">
        <div class="stat-card-clean">
            <div class="stat-icon-box" style="background: #FEE2E2; color: #DC2626;">
                <span class="material-icons" style="font-size: 26px;">sentiment_dissatisfied</span>
            </div>
            <div>
                <div class="text-muted" style="font-size: 12.5px; font-weight: 500; margin-bottom: 2px;">Kurang</div>
                <div class="font-weight-bold text-dark" style="font-size: 22px; line-height: 1.1;">{{ $stats['kurang'] }}</div>
            </div>
        </div>
    </div>
</div>

{{-- Table Data Card --}}
<div class="card card-outline card-success w-100">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between" style="gap: 12px; padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
        <span class="d-flex align-items-center" style="gap: 8px;">
            <span class="material-icons text-success" style="font-size:20px;">rate_review</span>
            <span class="font-weight-bold card-title-label">Daftar Masukan &amp; Ulasan IKM</span>
        </span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 w-100">
                <thead>
                    <tr>
                        <th style="width: 60px; text-align: center; padding-left: 20px;">No</th>
                        <th style="width: 160px;">Tanggal</th>
                        <th style="width: 180px;">Nama Responden</th>
                        <th style="width: 160px;">WhatsApp</th>
                        <th style="width: 140px; text-align: center;">Penilaian</th>
                        <th style="padding-right: 20px;">Masukan / Keluhan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ratings as $item)
                    <tr>
                        <td class="text-center align-middle text-muted" style="padding-left: 20px;">{{ $loop->iteration }}</td>
                        <td class="align-middle text-secondary" style="font-size: 13px;">{{ $item->created_at->format('d M Y, H:i') }}</td>
                        <td class="align-middle font-weight-bold text-dark">{{ $item->name ?: 'Anonim' }}</td>
                        <td class="align-middle" style="font-size: 13px;">
                            @if($item->whatsapp)
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->whatsapp) }}" target="_blank" class="text-success d-inline-flex align-items-center" style="gap: 4px;">
                                    <i class="fab fa-whatsapp"></i> {{ $item->whatsapp }}
                                </a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-center align-middle">
                            @if($item->rating == 'sangat_puas')
                                <span class="badge" style="background:#D1FAE5;color:#065F46;padding:4px 10px;border-radius:3px;font-size:11px;font-weight:700;">
                                    <span class="material-icons" style="font-size:13px;vertical-align:middle;margin-right:2px;">sentiment_very_satisfied</span> Sangat Puas
                                </span>
                            @elseif($item->rating == 'puas')
                                <span class="badge" style="background:#DBEAFE;color:#1E40AF;padding:4px 10px;border-radius:3px;font-size:11px;font-weight:700;">
                                    <span class="material-icons" style="font-size:13px;vertical-align:middle;margin-right:2px;">sentiment_satisfied</span> Puas
                                </span>
                            @elseif($item->rating == 'cukup')
                                <span class="badge" style="background:#FEF3C7;color:#92400E;padding:4px 10px;border-radius:3px;font-size:11px;font-weight:700;">
                                    <span class="material-icons" style="font-size:13px;vertical-align:middle;margin-right:2px;">sentiment_neutral</span> Cukup
                                </span>
                            @else
                                <span class="badge" style="background:#FEE2E2;color:#991B1B;padding:4px 10px;border-radius:3px;font-size:11px;font-weight:700;">
                                    <span class="material-icons" style="font-size:13px;vertical-align:middle;margin-right:2px;">sentiment_dissatisfied</span> Kurang
                                </span>
                            @endif
                        </td>
                        <td class="align-middle text-dark" style="font-size: 13.5px; padding-right: 20px;">{{ $item->description ?: '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <span class="material-icons" style="font-size: 48px; display: block; margin-bottom: 8px; color: #CBD5E1;">rate_review</span>
                            <p class="font-weight-bold mb-1">Belum ada data ulasan IKM yang masuk.</p>
                            <small class="text-muted">Masukan kepuasan dari pengunjung website akan ditampilkan di sini.</small>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
