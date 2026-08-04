@extends('admin.layouts.admin')

@section('title', 'Dashboard')
@section('header_title', 'Dashboard Utama')

@section('content')
<!-- Welcome Jumbotron / Card -->
<div class="card card-success card-outline mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center gap-3">
            <span class="material-icons text-success" style="font-size: 48px; margin-right: 16px;">health_and_safety</span>
            <div>
                <h3 class="font-weight-bold text-dark mb-1">Selamat Datang, {{ Auth::user()->name }}!</h3>
                <p class="text-muted mb-0">Portal Pengelolaan Data & Informasi Resmi Dinas Kesehatan Kabupaten Cianjur. Kelola berita, agenda, galeri, statistik stunting, laporan, dan regulasi dengan cepat.</p>
            </div>
        </div>
    </div>
</div>

<!-- AdminLTE Small Boxes Grid -->
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- Small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ \App\Models\Berita::count() }}</h3>
                <p>Berita Dipublikasikan</p>
            </div>
            <div class="icon">
                <i class="fas fa-newspaper"></i>
            </div>
            <a href="{{ route('admin.berita.index') }}" class="small-box-footer">Kelola Berita <i class="fas fa-arrow-circle-right ml-1"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <!-- Small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ \App\Models\Agenda::count() }}</h3>
                <p>Agenda Kegiatan</p>
            </div>
            <div class="icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <a href="{{ route('admin.agenda.index') }}" class="small-box-footer">Kelola Agenda <i class="fas fa-arrow-circle-right ml-1"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <!-- Small box -->
        <div class="small-box bg-warning">
            <div class="inner text-white">
                <h3 class="text-white">{{ \App\Models\Laporan::count() }}</h3>
                <p class="text-white">Laporan Kinerja & Keuangan</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-alt"></i>
            </div>
            <a href="{{ route('admin.laporan.index') }}" class="small-box-footer style='color: #FFF !important;'">Kelola Laporan <i class="fas fa-arrow-circle-right ml-1"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <!-- Small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ \App\Models\Regulasi::count() }}</h3>
                <p>Produk Hukum Regulasi</p>
            </div>
            <div class="icon">
                <i class="fas fa-gavel"></i>
            </div>
            <a href="{{ route('admin.regulasi.index') }}" class="small-box-footer">Kelola Regulasi <i class="fas fa-arrow-circle-right ml-1"></i></a>
        </div>
    </div>
</div>

<!-- Quick Action Menu Cards -->
<div class="row mt-2">
    <div class="col-md-6">
        <div class="card card-outline card-success">
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bold">
                    <span class="material-icons text-success align-middle mr-1" style="font-size: 20px;">bar_chart</span>
                    Satu Data Kesehatan
                </h3>
            </div>
            <div class="card-body pt-0">
                <p class="text-muted">Kelola data indikator utama kecukupan puskesmas, SDM kesehatan, dan data stunting Kabupaten Cianjur.</p>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="{{ route('admin.satudata.statistik.edit') }}" class="btn btn-success btn-sm mr-2">
                        <i class="fas fa-edit mr-1"></i> Edit Statistik
                    </a>
                    <a href="{{ route('admin.satudata.statistik.import') }}" class="btn btn-outline-success btn-sm">
                        <i class="fas fa-file-csv mr-1"></i> Import CSV Stunting
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card card-outline card-success">
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bold">
                    <span class="material-icons text-success align-middle mr-1" style="font-size: 20px;">widgets</span>
                    Layanan & Program Terpadu
                </h3>
            </div>
            <div class="card-body pt-0">
                <p class="text-muted">Kelola daftar layanan perizinan terpadu (Warga, Faskes, Nakes) dan halaman program khusus kesehatan.</p>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="{{ route('admin.layanan.index') }}" class="btn btn-success btn-sm mr-2">
                        <i class="fas fa-list mr-1"></i> Kelola Layanan
                    </a>
                    <a href="{{ route('admin.program-kesehatan.index') }}" class="btn btn-outline-success btn-sm">
                        <i class="fas fa-hand-holding-medical mr-1"></i> Kelola Program
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
