@extends('admin.layouts.admin')
@section('title', 'Distribusi Nakes')
@section('header_title', 'Distribusi Nakes')

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
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 6px; margin-bottom: 20px;">
                <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="custom-form-card">
            <form action="{{ route('admin.satudata.statistik.update') }}" method="POST" id="statistik-form">
                @csrf
                @method('PUT')
                <input type="hidden" name="section" value="nakes">

                <div class="d-flex align-items-center justify-content-between mb-4 pb-2" style="border-bottom: 1px solid var(--border-subtle);">
                    <div class="form-section-title mb-0" style="border-bottom: none; padding-bottom: 0;">
                        <span class="material-icons text-success">people</span>
                        <span>Distribusi Profesi Tenaga Kesehatan (Nakes)</span>
                    </div>
                    <button type="button" class="btn btn-outline-success btn-sm" onclick="addNakesRow()">
                        <span class="material-icons" style="font-size:16px; vertical-align:middle; margin-right:4px;">add</span> Tambah Profesi
                    </button>
                </div>

                <div class="form-text text-muted mb-3" style="font-size: 12px;">
                    <i class="fas fa-info-circle"></i> Lebar bar dihitung otomatis berdasarkan proporsi angka dari seluruh profesi.
                </div>

                <div id="nakes-rows-container">
                    @forelse($setting->nakes_data ?? [] as $nakes)
                        <div class="dynamic-row-item">
                            <div class="form-group mb-0" style="flex: 2; min-width: 150px;">
                                <label style="font-size:11.5px; font-weight:700; color:#475569;">Nama Profesi <span class="text-danger">*</span></label>
                                <input type="text" name="nakes_names[]" value="{{ $nakes['name'] }}" class="form-control form-control-sm" required>
                            </div>
                            <div class="form-group mb-0" style="flex: 2; min-width: 120px;">
                                <label style="font-size:11.5px; font-weight:700; color:#475569;">Jumlah (Angka) <span class="text-danger">*</span></label>
                                <input type="number" min="0" name="nakes_values[]" value="{{ $nakes['value'] }}" class="form-control form-control-sm nakes-value-input" required oninput="recalcNakesWidth()">
                            </div>
                            <div class="form-group mb-0" style="flex: 1; min-width: 80px;">
                                <label style="font-size:11.5px; font-weight:700; color:#475569;">Lebar (%)</label>
                                <input type="number" min="0" max="100" name="nakes_widths[]" value="{{ $nakes['width'] }}" class="form-control form-control-sm nakes-width-display" readonly style="background:#E2E8F0;">
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-danger mt-3" onclick="removeNakesRow(this)">
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
                    <button type="submit" class="btn btn-success px-4" id="statistik-save-btn">
                        <span class="material-icons" style="font-size: 16px; vertical-align: middle; margin-right: 4px;">save</span> Simpan Distribusi Nakes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function recalcNakesWidth() {
        const inputs = document.querySelectorAll('.nakes-value-input');
        let total = 0;
        inputs.forEach(inp => { total += parseInt(inp.value) || 0; });
        inputs.forEach(inp => {
            const row = inp.closest('.dynamic-row-item');
            const widthDisplay = row.querySelector('.nakes-width-display');
            const val = parseInt(inp.value) || 0;
            widthDisplay.value = total > 0 ? Math.round((val / total) * 100) : '';
        });
    }

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
                <label style="font-size:11.5px; font-weight:700; color:#475569;">Jumlah (Angka)</label>
                <input type="number" min="0" name="nakes_values[]" class="form-control form-control-sm nakes-value-input" required oninput="recalcNakesWidth()">
            </div>
            <div class="form-group mb-0" style="flex: 1; min-width: 80px;">
                <label style="font-size:11.5px; font-weight:700; color:#475569;">Lebar (%)</label>
                <input type="number" min="0" max="100" name="nakes_widths[]" class="form-control form-control-sm nakes-width-display" readonly style="background:#E2E8F0;">
            </div>
            <button type="button" class="btn btn-sm btn-outline-danger mt-3" onclick="removeNakesRow(this)">
                <span class="material-icons" style="font-size:16px;vertical-align:middle;">delete</span>
            </button>
        `;
        container.appendChild(row);
        recalcNakesWidth();
    }

    function removeNakesRow(btn) {
        btn.closest('.dynamic-row-item').remove();
        recalcNakesWidth();
        const container = document.getElementById('nakes-rows-container');
        if (container.children.length === 0) {
            container.innerHTML = `
                <div class="text-center py-5 text-muted" id="empty-state-nakes">
                    <span class="material-icons" style="font-size:48px; color:#D1D5DB; display:block; margin-bottom:12px;">people</span>
                    <p>Belum ada data nakes ditambahkan. Silakan klik tombol "Tambah Profesi".</p>
                </div>
            `;
        }
    }

    document.getElementById('statistik-form').addEventListener('submit', function() {
        const btn = document.getElementById('statistik-save-btn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-sync-alt fa-spin mr-1"></i> Menyimpan...';
    });
</script>
@endsection
