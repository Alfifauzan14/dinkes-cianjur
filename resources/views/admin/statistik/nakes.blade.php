@extends('admin.layouts.admin')
@section('title', 'Distribusi Nakes')
@section('header_title', 'Distribusi Nakes')

@section('styles')
<style>
    .dynamic-row-item {
        background: #F8FAFC;
        border: 1px solid var(--border-subtle);
        border-radius: 8px;
        padding: 16px 20px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
        position: relative;
    }
</style>
@endsection

@section('content')


<div class="row">
    <div class="col-12">
        <div class="card card-outline card-success">
            <div class="card-header d-flex align-items-center justify-content-between" style="padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
                <span class="d-flex align-items-center" style="gap: 8px;">
                    <span class="material-icons text-success">people</span>
                    <span class="font-weight-bold card-title-label">Distribusi Profesi Tenaga Kesehatan (Nakes)</span>
                </span>
                <button type="button" class="btn btn-outline-success btn-sm ml-auto" onclick="addNakesRow()">
                    <span class="material-icons" style="font-size:16px; vertical-align:middle; margin-right:4px;">add</span> Tambah Profesi
                </button>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.satudata.statistik.update') }}" method="POST" id="statistik-form">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="section" value="nakes">

                <div id="nakes-rows-container">
                    @forelse($setting->nakes_data ?? [] as $nakes)
                        <div class="dynamic-row-item">
                            <div class="form-group mb-0" style="flex: 2; min-width: 150px;">
                                <label style="font-size:11.5px; font-weight:700; color:#475569;">Nama Profesi <span class="text-danger">*</span></label>
                                <input type="text" name="nakes_names[]" value="{{ $nakes['name'] }}" class="form-control form-control-sm" required>
                            </div>
                            <div class="form-group mb-0" style="flex: 2; min-width: 120px;">
                                <label style="font-size:11.5px; font-weight:700; color:#475569;">Label Nilai <span class="text-danger">*</span></label>
                                <input type="text" name="nakes_values[]" value="{{ $nakes['value'] }}" class="form-control form-control-sm" required>
                            </div>
                            <div class="form-group mb-0" style="flex: 1; min-width: 80px;">
                                <label style="font-size:11.5px; font-weight:700; color:#475569;">Lebar Bar (%) <span class="text-danger">*</span></label>
                                <input type="number" min="0" max="100" name="nakes_widths[]" value="{{ $nakes['width'] }}" class="form-control form-control-sm" required>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-danger mt-3" onclick="removeRow(this)">
                                <span class="material-icons" style="font-size:16px;vertical-align:middle;">delete</span>
                            </button>
                        </div>
                    @empty
                        <div class="text-center py-5 text-muted" id="empty-state-nakes">
                            <span class="material-icons" style="font-size:48px; color:#D1D5DB; display:block; margin-bottom:12px;">people</span>
                            <p>Belum ada data nakes ditambahkan. Silakan klik tombol "Tambah Profesi".</p>
                        </div>
                    @endforelse
                </div>

                <div class="border-top pt-4 mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success-dark px-4" id="statistik-save-btn">
                        <span class="material-icons" style="font-size: 16px; vertical-align: middle; margin-right: 4px;">save</span> Simpan Distribusi Nakes
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
    function addNakesRow() {
        const empty = document.getElementById('empty-state-nakes');
        if (empty) empty.remove();
        
        const container = document.getElementById('nakes-rows-container');
        const row = document.createElement('div');
        row.className = 'dynamic-row-item';
        row.innerHTML = `
            <div class="form-group mb-0" style="flex: 2; min-width: 150px;">
                <label style="font-size:11.5px; font-weight:700; color:#475569;">Nama Profesi</label>
                <input type="text" name="nakes_names[]" class="form-control form-control-sm" required>
            </div>
            <div class="form-group mb-0" style="flex: 2; min-width: 120px;">
                <label style="font-size:11.5px; font-weight:700; color:#475569;">Label Nilai</label>
                <input type="text" name="nakes_values[]" class="form-control form-control-sm" required>
            </div>
            <div class="form-group mb-0" style="flex: 1; min-width: 80px;">
                <label style="font-size:11.5px; font-weight:700; color:#475569;">Lebar Bar (%)</label>
                <input type="number" min="0" max="100" name="nakes_widths[]" class="form-control form-control-sm" required>
            </div>
            <button type="button" class="btn btn-sm btn-outline-danger mt-3" onclick="removeRow(this)">
                <span class="material-icons" style="font-size:16px;vertical-align:middle;">delete</span>
            </button>
        `;
        container.appendChild(row);
    }

    function removeRow(btn) {
        btn.closest('.dynamic-row-item').remove();
    }

    document.getElementById('statistik-form').addEventListener('submit', function() {
        const btn = document.getElementById('statistik-save-btn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-sync-alt fa-spin mr-1"></i> Menyimpan...';
    });
</script>
@endsection
