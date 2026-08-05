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

                <div class="d-flex align-items-center justify-content-between mt-4 mb-3 pb-2" style="border-bottom: 1px solid var(--border-subtle);">
                    <div class="form-section-title mb-0" style="border-bottom: none; padding-bottom: 0;">
                        <span class="material-icons text-success">bar_chart</span>
                        <span>Data Kartu Statistik PPID</span>
                    </div>
                    <button type="button" class="btn btn-outline-success btn-sm" onclick="addStatCard()">
                        <span class="material-icons" style="font-size:16px; vertical-align:middle; margin-right:4px;">add</span> Tambah Kartu
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
                        <div class="col-md-4 mb-3 stat-card-item">
                            <div class="card p-3" style="background: #F8FAFC; border: 1px solid var(--border-subtle); border-radius: 8px; position:relative;">
                                <button type="button" class="btn btn-sm text-danger position-absolute" style="top:8px; right:8px; padding:0;" onclick="removeStatCard(this)" title="Hapus Kartu">
                                    <span class="material-icons" style="font-size:18px;">delete</span>
                                </button>
                                <span class="badge badge-success mb-3 align-self-start stat-badge-num" style="padding: 4px 10px; font-weight: 700; border-radius: 4px;">KARTU {{ $idx + 1 }}</span>
                                <div class="form-group">
                                    <label style="font-size: 11.5px; font-weight: 700; color: #475569;">Angka / Jumlah</label>
                                    <input type="text" name="stat_numbers[]" value="{{ $item['number'] }}" class="form-control form-control-sm" inputmode="numeric">
                                </div>
                                <div class="form-group mb-0">
                                    <label style="font-size: 11.5px; font-weight: 700; color: #475569;">Keterangan</label>
                                    <input type="text" name="stat_descs[]" value="{{ $item['desc'] }}" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-4 text-muted" id="empty-state-stat">
                            <span class="material-icons" style="font-size:48px; color:#D1D5DB; display:block; margin-bottom:12px;">bar_chart</span>
                            <p>Belum ada kartu statistik. Silakan klik "Tambah Kartu".</p>
                        </div>
                    @endforelse
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
    let statIndex = {{ count($statData) }};

    function addStatCard() {
        const empty = document.getElementById('empty-state-stat');
        if (empty) empty.remove();

        const container = document.getElementById('stat-cards-container');
        statIndex++;
        const col = document.createElement('div');
        col.className = 'col-md-4 mb-3 stat-card-item';
        col.innerHTML = `
            <div class="card p-3" style="background: #F8FAFC; border: 1px solid var(--border-subtle); border-radius: 8px; position:relative;">
                <button type="button" class="btn btn-sm text-danger position-absolute" style="top:8px; right:8px; padding:0;" onclick="removeStatCard(this)" title="Hapus Kartu">
                    <span class="material-icons" style="font-size:18px;">delete</span>
                </button>
                <span class="badge badge-success mb-3 align-self-start stat-badge-num" style="padding: 4px 10px; font-weight: 700; border-radius: 4px;">KARTU ${statIndex}</span>
                <div class="form-group">
                    <label style="font-size: 11.5px; font-weight: 700; color: #475569;">Angka / Jumlah</label>
                    <input type="text" name="stat_numbers[]" class="form-control form-control-sm" inputmode="numeric">
                </div>
                <div class="form-group mb-0">
                    <label style="font-size: 11.5px; font-weight: 700; color: #475569;">Keterangan</label>
                    <input type="text" name="stat_descs[]" class="form-control form-control-sm">
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
                <div class="col-12 text-center py-4 text-muted" id="empty-state-stat">
                    <span class="material-icons" style="font-size:48px; color:#D1D5DB; display:block; margin-bottom:12px;">bar_chart</span>
                    <p>Belum ada kartu statistik. Silakan klik "Tambah Kartu".</p>
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
        btn.innerHTML = '<i class="fas fa-sync-alt fa-spin mr-1"></i> Menyimpan...';
    });
</script>
@endsection
