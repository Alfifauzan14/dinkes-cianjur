@extends('admin.layouts.admin')
@section('title', 'Statistik PPID')
@section('header_title', 'Statistik PPID')

@section('content')


<div class="row">
    <div class="col-12">
        <div class="card card-outline card-success">
            <div class="card-header d-flex align-items-center" style="padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
                <span class="material-icons text-success">view_quilt</span>
                <span>Header Halaman PPID</span>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.ppid.update') }}" method="POST" id="ppid-form">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="section" value="statistik">

                <div style="font-size:15px;font-weight:700;color:#004F3B;margin:24px 0 16px;display:flex;align-items:center;gap:8px;border-bottom:1px solid #E2E8F0;padding-bottom:10px;">
                    <span class="material-icons text-success">bar_chart</span>
                    <span>Data 3 Kartu Statistik PPID</span>
                </div>

                <div class="row">
                    @foreach([1, 2, 3] as $i)
                        <div class="col-md-4 mb-3">
                            <div class="card p-3" style="background: #F8FAFC; border: 1px solid var(--border-subtle); border-radius: 8px;">
                                <span class="badge badge-success mb-3 align-self-start" style="padding: 4px 10px; font-weight: 700; border-radius: 4px;">KARTU STATISTIK {{ $i }}</span>
                                <div class="form-group">
                                    <label style="font-size: 11.5px; font-weight: 700; color: #475569;">Angka / Jumlah <span class="text-muted" style="font-weight:400;">(otomatis)</span></label>
                                    <input type="text" class="form-control form-control-sm" value="{{ $i === 1 ? number_format(\App\Services\PpidStatService::summary()['count'], 0, ',', '.') : ($i === 2 ? number_format(\App\Services\PpidStatService::summary()['views'], 0, ',', '.') : number_format(\App\Services\PpidStatService::summary()['downloads'], 0, ',', '.')) }}" disabled>
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
                    <button type="submit" class="btn btn-success-dark px-4" id="ppid-save-btn">
                        <span class="material-icons" style="font-size: 16px; vertical-align: middle; margin-right: 4px;">save</span> Simpan Header &amp; Statistik
                    </button>
                </div>
            </form>
            </div>
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
