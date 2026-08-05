@extends('admin.layouts.admin')
@section('title', 'Indikator Utama')
@section('header_title', 'Indikator Utama')

@section('content')
@include('admin.partials.alerts')

<div class="row">
    <div class="col-12">
        <div class="card card-outline card-success">
            <div class="card-header d-flex align-items-center" style="padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
                <span class="material-icons text-success">bar_chart</span>
                <span>Status &amp; Indikator Utama Kesehatan</span>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.satudata.statistik.update') }}" method="POST" id="statistik-form">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="section" value="indikator">

                <div class="form-group">
                    <label for="status_badge">Label Status Data (Keterangan Pojok Kanan Atas)</label>
                    <input type="text" name="status_badge" id="status_badge" value="{{ old('status_badge', $setting->status_badge) }}" class="form-control @error('status_badge') is-invalid @enderror" required>
                    @error('status_badge') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div style="font-size:15px;font-weight:700;color:#004F3B;margin:24px 0 16px;display:flex;align-items:center;gap:8px;border-bottom:1px solid #E2E8F0;padding-bottom:10px;">
                    <span class="material-icons text-success">widgets</span>
                    <span>Data 4 Kartu Indikator Utama</span>
                </div>

                <div class="row">
                    <!-- Card 1 -->
                    <div class="col-md-6 mb-3">
                        <div class="card p-3" style="background:#F8FAFC; border:1px solid var(--border-subtle); border-radius: 8px;">
                            <span class="badge badge-success mb-3 align-self-start" style="padding: 4px 10px; font-weight: 700; border-radius: 4px;">KARTU 1: PUSKESMAS</span>
                            <div class="form-group mb-2">
                                <label style="font-size:11.5px; font-weight:700; color:#475569;">Angka/Nilai Utama</label>
                                <input type="text" name="stat_1_num" value="{{ old('stat_1_num', $setting->stat_1_num) }}" class="form-control form-control-sm" required>
                            </div>
                            <div class="form-group mb-2">
                                <label style="font-size:11.5px; font-weight:700; color:#475569;">Label Badge Atas</label>
                                <input type="text" name="stat_1_badge" value="{{ old('stat_1_badge', $setting->stat_1_badge) }}" class="form-control form-control-sm" required>
                            </div>
                            <div class="form-group mb-0">
                                <label style="font-size:11.5px; font-weight:700; color:#475569;">Keterangan Bawah</label>
                                <input type="text" name="stat_1_caption" value="{{ old('stat_1_caption', $setting->stat_1_caption) }}" class="form-control form-control-sm" required>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card 2 -->
                    <div class="col-md-6 mb-3">
                        <div class="card p-3" style="background:#F8FAFC; border:1px solid var(--border-subtle); border-radius: 8px;">
                            <span class="badge badge-success mb-3 align-self-start" style="padding: 4px 10px; font-weight: 700; border-radius: 4px;">KARTU 2: RUMAH SAKIT RUJUKAN</span>
                            <div class="form-group mb-2">
                                <label style="font-size:11.5px; font-weight:700; color:#475569;">Angka/Nilai Utama</label>
                                <input type="text" name="stat_2_num" value="{{ old('stat_2_num', $setting->stat_2_num) }}" class="form-control form-control-sm" required>
                            </div>
                            <div class="form-group mb-2">
                                <label style="font-size:11.5px; font-weight:700; color:#475569;">Label Badge Atas</label>
                                <input type="text" name="stat_2_badge" value="{{ old('stat_2_badge', $setting->stat_2_badge) }}" class="form-control form-control-sm" required>
                            </div>
                            <div class="form-group mb-0">
                                <label style="font-size:11.5px; font-weight:700; color:#475569;">Keterangan Bawah</label>
                                <input type="text" name="stat_2_caption" value="{{ old('stat_2_caption', $setting->stat_2_caption) }}" class="form-control form-control-sm" required>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="col-md-6 mb-3">
                        <div class="card p-3" style="background:#F8FAFC; border:1px solid var(--border-subtle); border-radius: 8px;">
                            <span class="badge badge-success mb-3 align-self-start" style="padding: 4px 10px; font-weight: 700; border-radius: 4px;">KARTU 3: SDM KESEHATAN</span>
                            <div class="form-group mb-2">
                                <label style="font-size:11.5px; font-weight:700; color:#475569;">Angka/Nilai Utama</label>
                                <input type="text" name="stat_3_num" value="{{ old('stat_3_num', $setting->stat_3_num) }}" class="form-control form-control-sm" required>
                            </div>
                            <div class="form-group mb-2">
                                <label style="font-size:11.5px; font-weight:700; color:#475569;">Label Badge Atas</label>
                                <input type="text" name="stat_3_badge" value="{{ old('stat_3_badge', $setting->stat_3_badge) }}" class="form-control form-control-sm" required>
                            </div>
                            <div class="form-group mb-0">
                                <label style="font-size:11.5px; font-weight:700; color:#475569;">Keterangan Bawah</label>
                                <input type="text" name="stat_3_caption" value="{{ old('stat_3_caption', $setting->stat_3_caption) }}" class="form-control form-control-sm" required>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="col-md-6 mb-3">
                        <div class="card p-3" style="background:#F8FAFC; border:1px solid var(--border-subtle); border-radius: 8px;">
                            <span class="badge badge-success mb-3 align-self-start" style="padding: 4px 10px; font-weight: 700; border-radius: 4px;">KARTU 4: CAKUPAN IMUNISASI</span>
                            <div class="form-group mb-2">
                                <label style="font-size:11.5px; font-weight:700; color:#475569;">Angka/Nilai Utama</label>
                                <input type="text" name="stat_4_num" value="{{ old('stat_4_num', $setting->stat_4_num) }}" class="form-control form-control-sm" required>
                            </div>
                            <div class="form-group mb-2">
                                <label style="font-size:11.5px; font-weight:700; color:#475569;">Label Badge Atas</label>
                                <input type="text" name="stat_4_badge" value="{{ old('stat_4_badge', $setting->stat_4_badge) }}" class="form-control form-control-sm" required>
                            </div>
                            <div class="form-group mb-0">
                                <label style="font-size:11.5px; font-weight:700; color:#475569;">Keterangan Bawah</label>
                                <input type="text" name="stat_4_caption" value="{{ old('stat_4_caption', $setting->stat_4_caption) }}" class="form-control form-control-sm" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-top pt-4 mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success px-4" id="statistik-save-btn">
                        <span class="material-icons" style="font-size: 16px; vertical-align: middle; margin-right: 4px;">save</span> Simpan Indikator
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
    document.getElementById('statistik-form').addEventListener('submit', function() {
        const btn = document.getElementById('statistik-save-btn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-sync-alt fa-spin mr-1"></i> Menyimpan...';
    });
</script>
@endsection
