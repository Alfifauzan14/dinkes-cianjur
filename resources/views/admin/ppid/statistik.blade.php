@extends('admin.layouts.admin')
@section('title', 'Header & Statistik PPID')
@section('header_title', 'Header & Statistik PPID')

@section('styles')
<style>
    .custom-form-card {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: var(--card-shadow);
        border: none;
        padding: 30px;
        margin-bottom: 24px;
    }
    .form-section-title {
        font-size: 16px;
        font-weight: 700;
        color: #004F3B;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
        border-bottom: 1px solid var(--border-subtle);
        padding-bottom: 10px;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 6px; margin-bottom: 20px;">
                <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="custom-form-card">
            <form action="{{ route('admin.ppid.update') }}" method="POST" id="ppid-form">
                @csrf
                @method('PUT')
                <input type="hidden" name="section" value="statistik">

                <div class="form-section-title">
                    <span class="material-icons text-success">view_quilt</span>
                    <span>Header Halaman PPID</span>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="page_title">Judul Halaman PPID <span class="text-danger">*</span></label>
                            <input type="text" name="page_title" id="page_title" 
                                value="{{ old('page_title', $ppid->page_title) }}" 
                                class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="page_subtitle">Subjudul Halaman PPID <span class="text-danger">*</span></label>
                            <input type="text" name="page_subtitle" id="page_subtitle" 
                                value="{{ old('page_subtitle', $ppid->page_subtitle) }}" 
                                class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="form-section-title mt-4">
                    <span class="material-icons text-success">bar_chart</span>
                    <span>Data 3 Kartu Statistik PPID</span>
                </div>

                <div class="row">
                    @foreach([1, 2, 3] as $i)
                        <div class="col-md-4 mb-3">
                            <div class="card p-3" style="background: #F8FAFC; border: 1px solid var(--border-subtle); border-radius: 8px;">
                                <span class="badge badge-success mb-3 align-self-start" style="padding: 4px 10px; font-weight: 700; border-radius: 4px;">KARTU STATISTIK {{ $i }}</span>
                                <div class="form-group">
                                    <label style="font-size: 11.5px; font-weight: 700; color: #475569;">Angka / Jumlah</label>
                                    <input type="text" name="stat_{{ $i }}_number" value="{{ old('stat_'.$i.'_number', $ppid->{'stat_'.$i.'_number'}) }}" class="form-control form-control-sm">
                                </div>
                                <div class="form-group mb-0">
                                    <label style="font-size: 11.5px; font-weight: 700; color: #475569;">Keterangan</label>
                                    <input type="text" name="stat_{{ $i }}_desc" value="{{ old('stat_'.$i.'_desc', $ppid->{'stat_'.$i.'_desc'}) }}" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="border-top pt-4 mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success px-4" id="ppid-save-btn">
                        <span class="material-icons" style="font-size: 16px; vertical-align: middle; margin-right: 4px;">save</span> Simpan Header &amp; Statistik
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('ppid-form').addEventListener('submit', function() {
        const btn = document.getElementById('ppid-save-btn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-sync-alt fa-spin mr-1"></i> Menyimpan...';
    });
</script>
@endsection
