@extends('admin.layouts.admin')

@section('title', 'Dashboard')
@section('header_title', 'Dashboard')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}?v={{ filemtime(public_path('css/admin/dashboard.css')) }}">
@endsection

@section('content')
@php
    use App\Models\Berita;
    use App\Models\Agenda;
    use App\Models\Laporan;
    use App\Models\Regulasi;
    use App\Models\Faskes;
    use App\Models\ProgramKesehatan;
    use App\Models\Galeri;
    use App\Models\LayananTerpadu;

    $recentBerita   = Berita::latest()->take(5)->get();
    $upcomingAgenda = Agenda::where('date', '>=', now()->toDateString())->orderBy('date')->take(5)->get();
    $totalBerita    = Berita::count();
    $totalAgenda    = Agenda::count();
    $totalLaporan   = Laporan::count();
    $totalRegulasi  = Regulasi::count();
    $totalFaskes    = Faskes::count();
    $totalProgram   = ProgramKesehatan::count();
    $totalGaleri    = Galeri::count();
    $totalLayanan   = LayananTerpadu::count();
@endphp

{{-- ── Greeting Banner ──────────────────────────────────────────── --}}
<div class="card card-success card-outline mb-4">
    <div class="card-body" style="background: linear-gradient(135deg, #004F3B 0%, #007A52 60%, #009966 100%); border-radius: 6px; color:#fff; padding: 28px 32px; position:relative; overflow:hidden;">
        <div style="position:absolute;right:-30px;top:-40px;width:200px;height:200px;border-radius:50%;background:rgba(255,255,255,0.05);pointer-events:none;"></div>
        <div style="position:absolute;right:80px;bottom:-60px;width:160px;height:160px;border-radius:50%;background:rgba(255,255,255,0.04);pointer-events:none;"></div>
        <div class="d-flex align-items-center" style="gap:20px;position:relative;z-index:1;">
            <span class="material-icons" style="font-size:52px;opacity:.9;flex-shrink:0;">health_and_safety</span>
            <div>
                <p class="mb-1" style="font-size:22px;font-weight:700;letter-spacing:-.2px;">Selamat Datang, {{ Auth::user()->name }}!</p>
                <p class="mb-0" style="font-size:14px;opacity:.8;line-height:1.5;">Portal pengelolaan data dan informasi resmi Dinas Kesehatan Kabupaten Cianjur.<br>Kelola konten, statistik, laporan, dan regulasi dengan cepat dan efisien.</p>
            </div>
            <div class="ml-auto text-right d-none d-md-block" style="flex-shrink:0;">
                <span style="font-size:13px;opacity:.7;display:block;">{{ now()->locale('id')->translatedFormat('l, d F Y') }}</span>
                <span id="live-clock" style="font-size:28px;font-weight:700;letter-spacing:-1px;display:block;font-variant-numeric:tabular-nums;">{{ now()->format('H:i:s') }}</span>
            </div>
        </div>
    </div>
</div>

{{-- ── Stats Grid — Row 1 ────────────────────────────────────────── --}}
<div class="row">

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $totalBerita }}</h3>
                <p>Total Berita</p>
            </div>
            <div class="icon">
                <span class="material-icons">newspaper</span>
            </div>
            <a href="{{ route('admin.berita.index') }}" class="small-box-footer">
                Kelola <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalAgenda }}</h3>
                <p>Agenda Kegiatan</p>
            </div>
            <div class="icon">
                <span class="material-icons">event</span>
            </div>
            <a href="{{ route('admin.agenda.index') }}" class="small-box-footer">
                Kelola <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $totalLaporan }}</h3>
                <p>Laporan Kinerja</p>
            </div>
            <div class="icon">
                <span class="material-icons">description</span>
            </div>
            <a href="{{ route('admin.laporan.index') }}" class="small-box-footer">
                Kelola <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $totalRegulasi }}</h3>
                <p>Produk Regulasi</p>
            </div>
            <div class="icon">
                <span class="material-icons">gavel</span>
            </div>
            <a href="{{ route('admin.regulasi.index') }}" class="small-box-footer">
                Kelola <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

</div>

{{-- ── Stats Grid — Row 2 ────────────────────────────────────────── --}}
<div class="row">

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="small-box" style="background-color:#0D9488;color:#fff;">
            <div class="inner">
                <h3>{{ $totalFaskes }}</h3>
                <p>Fasilitas Kesehatan</p>
            </div>
            <div class="icon">
                <span class="material-icons">local_hospital</span>
            </div>
            <a href="{{ route('admin.faskes.index') }}" class="small-box-footer" style="background:rgba(0,0,0,.1);color:#fff;">
                Kelola <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="small-box" style="background-color:#7C3AED;color:#fff;">
            <div class="inner">
                <h3>{{ $totalProgram }}</h3>
                <p>Program Kesehatan</p>
            </div>
            <div class="icon">
                <span class="material-icons">health_and_safety</span>
            </div>
            <a href="{{ route('admin.program-kesehatan.index') }}" class="small-box-footer" style="background:rgba(0,0,0,.1);color:#fff;">
                Kelola <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="small-box" style="background-color:#E11D48;color:#fff;">
            <div class="inner">
                <h3>{{ $totalGaleri }}</h3>
                <p>Media Galeri</p>
            </div>
            <div class="icon">
                <span class="material-icons">collections</span>
            </div>
            <a href="{{ route('admin.galeri.index') }}" class="small-box-footer" style="background:rgba(0,0,0,.1);color:#fff;">
                Kelola <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="small-box" style="background-color:#4338CA;color:#fff;">
            <div class="inner">
                <h3>{{ $totalLayanan }}</h3>
                <p>Layanan Terpadu</p>
            </div>
            <div class="icon">
                <span class="material-icons">widgets</span>
            </div>
            <a href="{{ route('admin.layanan.index') }}" class="small-box-footer" style="background:rgba(0,0,0,.1);color:#fff;">
                Kelola <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

</div>

{{-- ── Quick Actions ─────────────────────────────────────────────── --}}
<h5 class="mb-3" style="font-weight:700;color:#1E293B;font-size:13px;text-transform:uppercase;letter-spacing:.8px;">
    <span class="material-icons" style="font-size:16px;color:#009966;vertical-align:middle;">bolt</span>
    Aksi Cepat
</h5>
<div class="row">

    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <a href="{{ route('admin.berita.create') }}" class="quick-action-card">
            <div class="quick-action-body">
                <div class="quick-action-title">Tambah Berita</div>
                <div class="quick-action-desc">Publikasikan berita &amp; pengumuman baru</div>
            </div>
            <div class="quick-action-icon bg-success"><span class="material-icons">add_circle</span></div>
        </a>
    </div>

    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <a href="{{ route('admin.agenda.create') }}" class="quick-action-card">
            <div class="quick-action-body">
                <div class="quick-action-title">Tambah Agenda</div>
                <div class="quick-action-desc">Buat agenda kegiatan dinas baru</div>
            </div>
            <div class="quick-action-icon bg-info"><span class="material-icons">event_available</span></div>
        </a>
    </div>

    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <a href="{{ route('admin.laporan.create') }}" class="quick-action-card">
            <div class="quick-action-body">
                <div class="quick-action-title">Upload Laporan</div>
                <div class="quick-action-desc">Tambah laporan kinerja atau keuangan</div>
            </div>
            <div class="quick-action-icon bg-warning"><span class="material-icons">upload_file</span></div>
        </a>
    </div>

    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <a href="{{ route('admin.satudata.statistik.edit') }}" class="quick-action-card">
            <div class="quick-action-body">
                <div class="quick-action-title">Edit Statistik</div>
                <div class="quick-action-desc">Perbarui data &amp; indikator kesehatan</div>
            </div>
            <div class="quick-action-icon" style="background-color:#0D9488;"><span class="material-icons">bar_chart</span></div>
        </a>
    </div>

    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <a href="{{ route('admin.faskes.create') }}" class="quick-action-card">
            <div class="quick-action-body">
                <div class="quick-action-title">Tambah Faskes</div>
                <div class="quick-action-desc">Daftarkan fasilitas kesehatan baru</div>
            </div>
            <div class="quick-action-icon" style="background-color:#0D9488;"><span class="material-icons">add_location</span></div>
        </a>
    </div>

    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <a href="{{ route('admin.settingfooter.edit') }}" class="quick-action-card">
            <div class="quick-action-body">
                <div class="quick-action-title">Settings</div>
                <div class="quick-action-desc">Pengaturan identitas &amp; kontak situs</div>
            </div>
            <div class="quick-action-icon" style="background-color:#4338CA;"><span class="material-icons">settings</span></div>
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
    <div class="col-lg-6 col-12">
        <div class="card card-success card-outline h-100">
            <div class="card-header d-flex align-items-center" style="padding:14px 20px;">
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
    <div class="col-lg-6 col-12">
        <div class="card card-info card-outline h-100">
            <div class="card-header d-flex align-items-center" style="padding:14px 20px;">
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
</script>
@endsection
