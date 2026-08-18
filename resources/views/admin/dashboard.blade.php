@extends('admin.layouts.admin')

@section('title', 'Dashboard')
@section('header_title', 'Dashboard')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}?v={{ filemtime(public_path('css/admin/dashboard.css')) }}">
@endsection

@section('content')

{{-- ── Greeting Banner ──────────────────────────────────────────── --}}
<div class="card card-success card-outline mb-4">
    <div class="card-body" style="background: linear-gradient(135deg, #004F3B 0%, #007A52 60%, #009966 100%); border-radius: 6px; color:#fff; padding: 26px 30px; position:relative; overflow:hidden;">
        <div style="position:absolute;right:-30px;top:-40px;width:200px;height:200px;border-radius:50%;background:rgba(255,255,255,0.05);pointer-events:none;"></div>
        <div style="position:absolute;right:80px;bottom:-60px;width:160px;height:160px;border-radius:50%;background:rgba(255,255,255,0.04);pointer-events:none;"></div>
        <div class="d-flex align-items-center" style="gap:20px;position:relative;z-index:1;">
            <span class="material-icons" style="font-size:48px;opacity:.9;flex-shrink:0;">health_and_safety</span>
            <div>
                <p class="mb-1" style="font-size:22px;font-weight:700;letter-spacing:-.2px;">Selamat Datang, {{ Auth::user()->name }}!</p>
                <p class="mb-0" style="font-size:13.5px;opacity:.85;line-height:1.5;">Portal pengelolaan data dan informasi resmi Dinas Kesehatan Kabupaten Cianjur.</p>
            </div>
            <div class="ml-auto text-right d-none d-md-block" style="flex-shrink:0;">
                <span style="font-size:13px;opacity:.7;display:block;">{{ now()->locale('id')->translatedFormat('l, d F Y') }}</span>
                <span id="live-clock" style="font-size:26px;font-weight:700;letter-spacing:-1px;display:block;font-variant-numeric:tabular-nums;">{{ now()->format('H:i:s') }}</span>
            </div>
        </div>
    </div>
</div>

{{-- ── PPID Action Alert (If there are pending requests) ─────────── --}}
@if($ppidPendingCount > 0)
<div class="dashboard-alert-pending">
    <div class="dashboard-alert-content">
        <span class="material-icons">notifications_active</span>
        <div class="dashboard-alert-text">
            Perhatian: Terdapat <strong>{{ $ppidPendingCount }} Permohonan Informasi Publik (PPID)</strong> yang menunggu respon admin.
        </div>
    </div>
    <a href="{{ route('admin.ppid.permohonan.index') }}" class="btn btn-sm btn-warning font-weight-bold" style="font-size:12px;padding:5px 12px;">
        Tinjau Sekarang <i class="fas fa-arrow-right ml-1"></i>
    </a>
</div>
@endif

{{-- ── Primary KPI Stats Cards ───────────────────────────────────── --}}
<div class="row mb-4">
    {{-- Berita --}}
    <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3 mb-lg-0">
        <div class="dash-stat-card">
            <div class="dash-stat-icon-box" style="background-color: #F0FDF4; color: #009966;">
                <span class="material-icons">newspaper</span>
            </div>
            <div class="dash-stat-body">
                <div class="dash-stat-label">Total Berita & Info</div>
                <div class="dash-stat-number">{{ $totalBerita }}</div>
                <a href="{{ route('admin.berita.index') }}" class="dash-stat-link" style="color: #009966;">
                    Kelola Berita <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- PPID Permohonan --}}
    <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3 mb-lg-0">
        <div class="dash-stat-card">
            <div class="dash-stat-icon-box" style="background-color: #FEF3C7; color: #D97706;">
                <span class="material-icons">assignment</span>
            </div>
            <div class="dash-stat-body">
                <div class="dash-stat-label d-flex align-items-center justify-content-between">
                    <span>Permohonan PPID</span>
                    @if($ppidPendingCount > 0)
                        <span class="badge" style="background: #FEF3C7; color: #D97706; font-size: 10.5px; padding: 2px 6px; border: 1px solid #FDE68A;">
                            ● {{ $ppidPendingCount }} Pending
                        </span>
                    @endif
                </div>
                <div class="dash-stat-number">{{ $totalPpid }}</div>
                <a href="{{ route('admin.ppid.permohonan.index') }}" class="dash-stat-link" style="color: #D97706;">
                    Kelola PPID <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- Indeks Kepuasan (IKM) --}}
    <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3 mb-lg-0">
        <div class="dash-stat-card">
            <div class="dash-stat-icon-box" style="background-color: #E0F2FE; color: #0284C7;">
                <span class="material-icons">reviews</span>
            </div>
            <div class="dash-stat-body">
                <div class="dash-stat-label">Ulasan Kepuasan (IKM)</div>
                <div class="dash-stat-number">{{ $ikmTotal }}</div>
                <a href="{{ route('admin.ikm.index') }}" class="dash-stat-link" style="color: #0284C7;">
                    Lihat Respon <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- Fasilitas Kesehatan --}}
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="dash-stat-card">
            <div class="dash-stat-icon-box" style="background-color: #F0FDFA; color: #0D9488;">
                <span class="material-icons">local_hospital</span>
            </div>
            <div class="dash-stat-body">
                <div class="dash-stat-label">Fasilitas Kesehatan</div>
                <div class="dash-stat-number">{{ $totalFaskes }}</div>
                <a href="{{ route('admin.faskes.index') }}" class="dash-stat-link" style="color: #0D9488;">
                    Kelola Faskes <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>

{{-- ── Analytics & Permohonan PPID Section ──────────────────────── --}}
<div class="row mb-4">
    {{-- Status PPID Chart & IKM --}}
    <div class="col-lg-5 col-12 mb-3">
        <div class="card card-outline card-success h-100">
            <div class="card-header d-flex align-items-center" style="padding:14px 18px;">
                <h3 class="card-title mb-0 d-flex align-items-center" style="gap:8px;font-size:14px;font-weight:700;">
                    <span class="material-icons" style="font-size:18px;color:#009966;">donut_large</span>
                    Status Permohonan PPID
                </h3>
            </div>
            <div class="card-body">
                <div style="position:relative; height:180px;" class="d-flex justify-content-center align-items-center">
                    <canvas id="ppidStatusChart" 
                        data-pending="{{ $ppidPendingCount }}"
                        data-approved="{{ $ppidApprovedCount }}"
                        data-rejected="{{ $ppidRejectedCount }}"
                        data-total="{{ $totalPpid }}"></canvas>
                </div>

                <hr style="margin: 16px 0; border-top: 1px solid #F1F5F9;">

                {{-- IKM Rating Breakdown --}}
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span style="font-size:12px;font-weight:700;text-transform:uppercase;color:#64748B;letter-spacing:.5px;">Kepuasan Masyarakat (IKM)</span>
                    <span class="badge badge-info" style="font-size:11px;">Total: {{ $ikmTotal }}</span>
                </div>

                @php
                    $ikmRatings = [
                        ['label' => 'Sangat Puas', 'count' => $ikmSangatPuas, 'class' => 'sangat-puas'],
                        ['label' => 'Puas', 'count' => $ikmPuas, 'class' => 'puas'],
                        ['label' => 'Cukup', 'count' => $ikmCukup, 'class' => 'cukup'],
                        ['label' => 'Kurang', 'count' => $ikmKurang, 'class' => 'kurang', 'mb' => 'mb-0'],
                    ];
                @endphp

                @foreach($ikmRatings as $item)
                    @php
                        $pct = $ikmTotal > 0 ? round(($item['count'] / $ikmTotal) * 100) : 0;
                    @endphp
                    <div class="ikm-rating-item {{ $item['mb'] ?? '' }}">
                        <div class="ikm-rating-header">
                            <span>{{ $item['label'] }}</span>
                            <span>{{ $item['count'] }} ({{ $pct }}%)</span>
                        </div>
                        <div class="ikm-rating-progress">
                            <div class="ikm-rating-fill {{ $item['class'] }}" data-pct="{{ $pct }}"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Permohonan PPID Terbaru --}}
    <div class="col-lg-7 col-12 mb-3">
        <div class="card card-outline card-warning h-100">
            <div class="card-header d-flex align-items-center" style="padding:14px 18px;">
                <h3 class="card-title mb-0 d-flex align-items-center" style="gap:8px;font-size:14px;font-weight:700;">
                    <span class="material-icons" style="font-size:18px;color:#D97706;">assignment_late</span>
                    Permohonan Informasi Terbaru
                </h3>
                <div class="card-tools ml-auto">
                    <a href="{{ route('admin.ppid.permohonan.index') }}" class="btn btn-sm btn-outline-warning" style="font-size:12px;padding:4px 10px;">
                        Semua PPID <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            <div class="card-body p-0 table-responsive">
                <table class="table dashboard-table mb-0">
                    <thead>
                        <tr>
                            <th>Pemohon</th>
                            <th>Rincian Informasi</th>
                            <th>Status</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestPermohonans as $p)
                        <tr>
                            <td>
                                <div class="font-weight-bold text-dark">{{ $p->nama_pemohon ?? $p->nama }}</div>
                                <div class="text-muted" style="font-size:11.5px;">{{ $p->created_at->format('d M Y') }}</div>
                            </td>
                            <td>
                                <div class="text-truncate" style="max-width: 220px;" title="{{ $p->rincian_informasi }}">
                                    {{ $p->rincian_informasi }}
                                </div>
                                <div class="text-muted" style="font-size:11px;">Tujuan: {{ $p->tujuan_penggunaan ?? '-' }}</div>
                            </td>
                            <td>
                                @if($p->status === 'pending')
                                    <span class="badge badge-warning" style="font-size:11px;padding:4px 8px;">Pending</span>
                                @elseif($p->status === 'disetujui')
                                    <span class="badge badge-success" style="font-size:11px;padding:4px 8px;">Disetujui</span>
                                @else
                                    <span class="badge badge-danger" style="font-size:11px;padding:4px 8px;">Ditolak</span>
                                @endif
                            </td>
                            <td class="text-right">
                                <a href="{{ route('admin.ppid.permohonan.show', $p->id) }}" class="btn btn-xs btn-outline-secondary" title="Detail">
                                    <span class="material-icons" style="font-size:14px;vertical-align:middle;">visibility</span>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                <span class="material-icons" style="font-size:32px;color:#CBD5E1;display:block;margin-bottom:6px;">check_circle</span>
                                Belum ada permohonan informasi.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- ── Quick Actions Grid (9 Diverse Actions) ─────────────────────── --}}
<h5 class="mb-3" style="font-weight:700;color:#1E293B;font-size:13px;text-transform:uppercase;letter-spacing:.8px;">
    <span class="material-icons" style="font-size:16px;color:#009966;vertical-align:middle;">bolt</span>
    Aksi Cepat
</h5>
<div class="row mb-4">
    {{-- 1. Tambah Berita --}}
    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <a href="{{ route('admin.berita.create') }}" class="quick-action-card">
            <div class="quick-action-icon" style="background-color:#009966;"><span class="material-icons">add_circle</span></div>
            <div class="quick-action-body">
                <div class="quick-action-title">Tambah Berita</div>
                <div class="quick-action-desc">Publikasikan berita &amp; pengumuman baru</div>
            </div>
        </a>
    </div>

    {{-- 2. Tambah Agenda --}}
    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <a href="{{ route('admin.agenda.create') }}" class="quick-action-card">
            <div class="quick-action-icon" style="background-color:#0284C7;"><span class="material-icons">event_available</span></div>
            <div class="quick-action-body">
                <div class="quick-action-title">Tambah Agenda</div>
                <div class="quick-action-desc">Jadwalkan kegiatan dinas baru</div>
            </div>
        </a>
    </div>

    {{-- 3. Upload Laporan --}}
    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <a href="{{ route('admin.laporan.create') }}" class="quick-action-card">
            <div class="quick-action-icon" style="background-color:#D97706;"><span class="material-icons">upload_file</span></div>
            <div class="quick-action-body">
                <div class="quick-action-title">Upload Laporan</div>
                <div class="quick-action-desc">Tambah dokumen LAKIP &amp; kinerja</div>
            </div>
        </a>
    </div>

    {{-- 4. Tambah Regulasi --}}
    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <a href="{{ route('admin.regulasi.create') }}" class="quick-action-card">
            <div class="quick-action-icon" style="background-color:#E11D48;"><span class="material-icons">gavel</span></div>
            <div class="quick-action-body">
                <div class="quick-action-title">Tambah Regulasi</div>
                <div class="quick-action-desc">Unggah SK, Perbup, &amp; regulasi</div>
            </div>
        </a>
    </div>

    {{-- 5. Upload Galeri --}}
    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <a href="{{ route('admin.galeri.create') }}" class="quick-action-card">
            <div class="quick-action-icon" style="background-color:#7C3AED;"><span class="material-icons">add_photo_alternate</span></div>
            <div class="quick-action-body">
                <div class="quick-action-title">Upload Galeri</div>
                <div class="quick-action-desc">Tambah dokumentasi foto kegiatan</div>
            </div>
        </a>
    </div>

    {{-- 6. Tambah Faskes --}}
    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <a href="{{ route('admin.faskes.create') }}" class="quick-action-card">
            <div class="quick-action-icon" style="background-color:#0D9488;"><span class="material-icons">add_location_alt</span></div>
            <div class="quick-action-body">
                <div class="quick-action-title">Tambah Faskes</div>
                <div class="quick-action-desc">Daftarkan faskes / puskesmas baru</div>
            </div>
        </a>
    </div>

    {{-- 7. Kelola Layanan --}}
    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <a href="{{ route('admin.layanan.index') }}" class="quick-action-card">
            <div class="quick-action-icon" style="background-color:#4F46E5;"><span class="material-icons">medical_information</span></div>
            <div class="quick-action-body">
                <div class="quick-action-title">Kelola Layanan</div>
                <div class="quick-action-desc">Atur informasi layanan terpadu</div>
            </div>
        </a>
    </div>

    {{-- 8. Profil Instansi --}}
    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <a href="{{ route('admin.profil.edit') }}" class="quick-action-card">
            <div class="quick-action-icon" style="background-color:#059669;"><span class="material-icons">business</span></div>
            <div class="quick-action-body">
                <div class="quick-action-title">Profil Instansi</div>
                <div class="quick-action-desc">Ubah sambutan, visi &amp; misi dinas</div>
            </div>
        </a>
    </div>

    {{-- 9. Footer & Kontak --}}
    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <a href="{{ route('admin.settingfooter.edit') }}" class="quick-action-card">
            <div class="quick-action-icon" style="background-color:#475569;"><span class="material-icons">tune</span></div>
            <div class="quick-action-body">
                <div class="quick-action-title">Footer &amp; Kontak</div>
                <div class="quick-action-desc">Pengaturan kontak &amp; medsos dinas</div>
            </div>
        </a>
    </div>
</div>

{{-- ── Recent Content & Upcoming Agenda ────────────────────────── --}}
<h5 class="mb-3" style="font-weight:700;color:#1E293B;font-size:13px;text-transform:uppercase;letter-spacing:.8px;">
    <span class="material-icons" style="font-size:16px;color:#009966;vertical-align:middle;">update</span>
    Aktivitas Terkini
</h5>
<div class="row">
    {{-- Recent Berita --}}
    <div class="col-lg-6 col-12 mb-3">
        <div class="card card-success card-outline h-100">
            <div class="card-header d-flex align-items-center" style="padding:14px 18px;">
                <h3 class="card-title mb-0 d-flex align-items-center" style="gap:8px;font-size:14px;font-weight:700;">
                    <span class="material-icons" style="font-size:18px;color:#009966;">newspaper</span>
                    Berita Terbaru
                </h3>
                <div class="card-tools ml-auto">
                    <a href="{{ route('admin.berita.index') }}" class="btn btn-sm btn-outline-success" style="font-size:12px;padding:4px 10px;">
                        Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                @forelse($recentBerita as $b)
                    <div class="activity-row">
                        <span class="material-icons activity-icon" style="color:#009966;">article</span>
                        <div class="activity-content">
                            <div class="activity-title">{{ $b->title }}</div>
                            <div class="activity-sub">{{ $b->created_at->diffForHumans() }}</div>
                        </div>
                        <span class="badge {{ $b->status === 'published' ? 'badge-success' : 'badge-secondary' }} ml-2">
                            {{ $b->status === 'published' ? 'Publik' : 'Draft' }}
                        </span>
                    </div>
                @empty
                    <div class="activity-empty">
                        <span class="material-icons" style="font-size:36px;color:#CBD5E1;">newspaper</span>
                        <p>Belum ada berita</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Upcoming Agenda --}}
    <div class="col-lg-6 col-12 mb-3">
        <div class="card card-info card-outline h-100">
            <div class="card-header d-flex align-items-center" style="padding:14px 18px;">
                <h3 class="card-title mb-0 d-flex align-items-center" style="gap:8px;font-size:14px;font-weight:700;">
                    <span class="material-icons" style="font-size:18px;color:#17a2b8;">event</span>
                    Agenda Mendatang
                </h3>
                <div class="card-tools ml-auto">
                    <a href="{{ route('admin.agenda.index') }}" class="btn btn-sm btn-outline-info" style="font-size:12px;padding:4px 10px;">
                        Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                @forelse($upcomingAgenda as $a)
                    <div class="activity-row">
                        <span class="material-icons activity-icon" style="color:#17a2b8;">calendar_month</span>
                        <div class="activity-content">
                            <div class="activity-title">{{ $a->title }}</div>
                            <div class="activity-sub">
                                <span class="material-icons" style="font-size:11px;vertical-align:middle;">place</span>
                                {{ $a->location ?? 'Tidak ada lokasi' }}
                            </div>
                        </div>
                        <span class="badge badge-info ml-2">{{ \Carbon\Carbon::parse($a->date)->format('d M') }}</span>
                    </div>
                @empty
                    <div class="activity-empty">
                        <span class="material-icons" style="font-size:36px;color:#CBD5E1;">event_busy</span>
                        <p>Tidak ada agenda mendatang</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Live clock
function updateClock() {
    const el = document.getElementById('live-clock');
    if (!el) return;
    const now = new Date();
    const h = String(now.getHours()).padStart(2, '0');
    const m = String(now.getMinutes()).padStart(2, '0');
    const s = String(now.getSeconds()).padStart(2, '0');
    el.textContent = h + ':' + m + ':' + s;
}
setInterval(updateClock, 1000);
updateClock();

// PPID Status Donut Chart & IKM Progress
document.addEventListener('DOMContentLoaded', function () {
    // IKM Progress Bar Widths
    document.querySelectorAll('.ikm-rating-fill[data-pct]').forEach(function (el) {
        el.style.width = el.getAttribute('data-pct') + '%';
    });

    const ctx = document.getElementById('ppidStatusChart');
    if (!ctx) return;

    const pending = parseInt(ctx.dataset.pending, 10) || 0;
    const approved = parseInt(ctx.dataset.approved, 10) || 0;
    const rejected = parseInt(ctx.dataset.rejected, 10) || 0;
    const total = parseInt(ctx.dataset.total, 10) || 0;

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'Disetujui', 'Ditolak'],
            datasets: [{
                data: total === 0 ? [1, 0, 0] : [pending, approved, rejected],
                backgroundColor: total === 0 ? ['#E2E8F0', '#E2E8F0', '#E2E8F0'] : ['#F59E0B', '#009966', '#EF4444'],
                borderWidth: 2,
                borderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 12,
                        font: { size: 12, family: "'Plus Jakarta Sans', sans-serif" }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            if (total === 0) return 'Belum ada data';
                            return context.label + ': ' + context.raw + ' permohonan';
                        }
                    }
                }
            },
            cutout: '70%'
        }
    });
});
</script>
@endsection
