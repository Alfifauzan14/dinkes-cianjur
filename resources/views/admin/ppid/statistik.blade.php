@extends('admin.layouts.admin')
@section('title', 'Header & Statistik PPID')
@section('header_title', 'Header & Statistik PPID')

@section('styles')
<style>
    .form-section-title {
        font-size: 15px;
        font-weight: 700;
        color: #004F3B;
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        gap: 8px;
        border-bottom: 1px solid #E2E8F0;
        padding-bottom: 10px;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-outline card-success">
            <div class="card-header" style="padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
                <span class="d-flex align-items-center" style="gap: 8px;">
                    <span class="material-icons text-success" style="font-size: 20px;">view_quilt</span>
                    <span class="font-weight-bold card-title-label">Header &amp; Statistik PPID</span>
                </span>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.ppid.update') }}" method="POST" id="ppid-form">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="section" value="statistik">

                    <div class="form-section-title">
                        <span class="material-icons text-success" style="font-size: 20px;">web</span>
                        <span>Header Halaman PPID</span>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group mb-3">
                                <label for="page_title" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">Judul Halaman PPID <span class="text-danger">*</span></label>
                                <input type="text" name="page_title" id="page_title" 
                                    value="{{ old('page_title', $ppid->page_title) }}" 
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group mb-3">
                                <label for="page_subtitle" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">Subjudul Halaman PPID <span class="text-danger">*</span></label>
                                <input type="text" name="page_subtitle" id="page_subtitle" 
                                    value="{{ old('page_subtitle', $ppid->page_subtitle) }}" 
                                    class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mt-4 mb-3 pb-2" style="border-bottom: 1px solid #E2E8F0;">
                        <div class="form-section-title mb-0" style="border-bottom: none; padding-bottom: 0;">
                            <span class="material-icons text-success" style="font-size: 20px;">bar_chart</span>
                            <span>Data Kartu Statistik PPID</span>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-success font-weight-bold d-flex align-items-center" style="gap: 4px;" onclick="addStatCard()">
                            <span class="material-icons" style="font-size:16px;">add</span> Tambah Kartu
                        </button>
                    </div>

                    <div id="stat-cards-container" class="row">
                        @php
                            $statData = [];
                            for ($i = 1; $i <= 10; $i++) {
                                $num = $ppid->{"stat_{$i}_number"} ?? '';
                                $desc = $ppid->{"stat_{$i}_desc"} ?? '';
                                if ($num !== '' || $desc !== '') {
                                    $statData[] = ['number' => $num, 'desc' => $desc];
                                }
                            }
                        @endphp
                        @forelse($statData as $idx => $item)
                            <div class="col-md-4 col-12 mb-3 stat-card-item">
                                <div class="card p-3" style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 3px; position:relative;">
                                    <button type="button" class="btn btn-sm text-danger position-absolute" style="top:8px; right:8px; padding:0;" onclick="removeStatCard(this)" title="Hapus Kartu">
                                        <span class="material-icons" style="font-size:18px;">delete</span>
                                    </button>
                                    <span class="badge badge-success mb-3 align-self-start stat-badge-num" style="padding: 4px 10px; font-weight: 700; border-radius: 3px;">KARTU {{ $idx + 1 }}</span>
                                    <div class="form-group mb-2">
                                        <label class="font-weight-bold" style="font-size: 12px; color: #1E293B;">Angka / Jumlah</label>
                                        <input type="text" name="stat_numbers[]" value="{{ $item['number'] }}" class="form-control" inputmode="numeric">
                                    </div>
                                    <div class="form-group mb-0">
                                        <label class="font-weight-bold" style="font-size: 12px; color: #1E293B;">Keterangan</label>
                                        <input type="text" name="stat_descs[]" value="{{ $item['desc'] }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5 text-muted" id="empty-state-stat">
                                <span class="material-icons" style="font-size:48px; color:#CBD5E1; display:block; margin-bottom:8px;">bar_chart</span>
                                <p class="font-weight-bold mb-1">Belum Ada Kartu Statistik</p>
                                <small class="text-muted">Silakan klik "Tambah Kartu" untuk menambahkan data statistik.</small>
                            </div>
                        @endforelse
                    </div>

                    <div class="border-top pt-4 mt-4 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success font-weight-bold px-4" id="ppid-save-btn">
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
    const statContainer = document.getElementById('stat-cards-container');
    let statIndex = statContainer ? statContainer.querySelectorAll('.stat-card-item').length : 0;

    function addStatCard() {
        const empty = document.getElementById('empty-state-stat');
        if (empty) empty.remove();

        const container = document.getElementById('stat-cards-container');
        statIndex++;
        const col = document.createElement('div');
        col.className = 'col-md-4 col-12 mb-3 stat-card-item';
        col.innerHTML = `
            <div class="card p-3" style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 3px; position:relative;">
                <button type="button" class="btn btn-sm text-danger position-absolute" style="top:8px; right:8px; padding:0;" onclick="removeStatCard(this)" title="Hapus Kartu">
                    <span class="material-icons" style="font-size:18px;">delete</span>
                </button>
                <span class="badge badge-success mb-3 align-self-start stat-badge-num" style="padding: 4px 10px; font-weight: 700; border-radius: 3px;">KARTU ${statIndex}</span>
                <div class="form-group mb-2">
                    <label class="font-weight-bold" style="font-size: 12px; color: #1E293B;">Angka / Jumlah</label>
                    <input type="text" name="stat_numbers[]" class="form-control" inputmode="numeric">
                </div>
                <div class="form-group mb-0">
                    <label class="font-weight-bold" style="font-size: 12px; color: #1E293B;">Keterangan</label>
                    <input type="text" name="stat_descs[]" class="form-control">
                </div>
            </div>
        `;
        container.appendChild(col);
        renumberStatCards();
    }

    function removeStatCard(btn) {
        btn.closest('.stat-card-item').remove();
        renumberStatCards();
        const container = document.getElementById('stat-cards-container');
        if (container.querySelectorAll('.stat-card-item').length === 0) {
            container.innerHTML = `
                <div class="col-12 text-center py-5 text-muted" id="empty-state-stat">
                    <span class="material-icons" style="font-size:48px; color:#CBD5E1; display:block; margin-bottom:8px;">bar_chart</span>
                    <p class="font-weight-bold mb-1">Belum Ada Kartu Statistik</p>
                    <small class="text-muted">Silakan klik "Tambah Kartu" untuk menambahkan data statistik.</small>
                </div>
            `;
        }
    }

    function renumberStatCards() {
        const cards = document.querySelectorAll('#stat-cards-container .stat-card-item');
        cards.forEach((card, i) => {
            const badge = card.querySelector('.stat-badge-num');
            if (badge) badge.textContent = 'KARTU ' + (i + 1);
        });
        statIndex = cards.length;
    }

    document.getElementById('ppid-form').addEventListener('submit', function() {
        const btn = document.getElementById('ppid-save-btn');
        btn.disabled = true;
        btn.innerHTML = '<span class="material-icons" style="font-size: 16px; vertical-align: middle;">sync</span> Menyimpan...';
    });
</script>
@endsection
