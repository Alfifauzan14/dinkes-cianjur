@extends('admin.layouts.admin')
@section('title', 'Indikator Utama')
@section('header_title', 'Indikator Utama')

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
    .indikator-card-item {
        background: #F8FAFC;
        border: 1px solid var(--border-subtle);
        border-radius: 8px;
        padding: 16px 20px;
        margin-bottom: 12px;
        position: relative;
    }
    .indikator-card-item .badge-num {
        position: absolute;
        top: 12px;
        right: 12px;
        background: #009966;
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 4px;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-12">

        <div class="custom-form-card">
            <form action="{{ route('admin.satudata.statistik.update') }}" method="POST" id="statistik-form">
                @csrf
                @method('PUT')
                <input type="hidden" name="section" value="indikator">

                <div class="form-section-title">
                    <span class="material-icons text-success">bar_chart</span>
                    <span>Status &amp; Indikator Utama Kesehatan</span>
                </div>

                <div class="form-group">
                    <label for="status_badge">Label Status Data (Keterangan Pojok Kanan Atas)</label>
                    <input type="text" name="status_badge" id="status_badge" value="{{ old('status_badge', $setting->status_badge) }}" class="form-control @error('status_badge') is-invalid @enderror" required>
                    @error('status_badge') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="d-flex align-items-center justify-content-between mt-4 mb-3 pb-2" style="border-bottom: 1px solid var(--border-subtle);">
                    <div class="form-section-title mb-0" style="border-bottom: none; padding-bottom: 0;">
                        <span class="material-icons text-success">widgets</span>
                        <span>Data Kartu Indikator Utama</span>
                    </div>
                    <button type="button" class="btn btn-outline-success btn-sm" onclick="addIndikatorCard()">
                        <span class="material-icons" style="font-size:16px; vertical-align:middle; margin-right:4px;">add</span> Tambah Kartu
                    </button>
                </div>

                <div id="indikator-cards-container">
                    @forelse($setting->indikator_data ?? [] as $idx => $item)
                        <div class="indikator-card-item">
                            <span class="badge-num">KARTU {{ $idx + 1 }}</span>
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label style="font-size:11.5px; font-weight:700; color:#475569;">Nama Kartu <span class="text-danger">*</span></label>
                                    <input type="text" name="indikator_names[]" value="{{ $item['name'] }}" class="form-control form-control-sm" required>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label style="font-size:11.5px; font-weight:700; color:#475569;">Angka/Nilai Utama <span class="text-danger">*</span></label>
                                    <input type="number" name="indikator_nums[]" value="{{ $item['num'] }}" class="form-control form-control-sm" required inputmode="numeric">
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label style="font-size:11.5px; font-weight:700; color:#475569;">Keterangan Bawah <span class="text-danger">*</span></label>
                                    <input type="text" name="indikator_captions[]" value="{{ $item['caption'] }}" class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-danger mt-2" onclick="removeIndikatorCard(this)">
                                <span class="material-icons" style="font-size:16px;vertical-align:middle;">delete</span> Hapus
                            </button>
                        </div>
                    @empty
                        <div class="text-center py-4 text-muted" id="empty-state-indikator">
                            <span class="material-icons" style="font-size:48px; color:#D1D5DB; display:block; margin-bottom:12px;">widgets</span>
                            <p>Belum ada kartu indikator. Silakan klik "Tambah Kartu".</p>
                        </div>
                    @endforelse
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
@endsection

@section('scripts')
<script>
    let indikatorIndex = {{ count($setting->indikator_data ?? []) }};

    function addIndikatorCard() {
        const empty = document.getElementById('empty-state-indikator');
        if (empty) empty.remove();

        const container = document.getElementById('indikator-cards-container');
        indikatorIndex++;
        const row = document.createElement('div');
        row.className = 'indikator-card-item';
        row.innerHTML = `
            <span class="badge-num">KARTU ${indikatorIndex}</span>
            <div class="row">
                <div class="col-md-4 mb-2">
                    <label style="font-size:11.5px; font-weight:700; color:#475569;">Nama Kartu</label>
                    <input type="text" name="indikator_names[]" class="form-control form-control-sm" required>
                </div>
                <div class="col-md-4 mb-2">
                    <label style="font-size:11.5px; font-weight:700; color:#475569;">Angka/Nilai Utama</label>
                    <input type="number" name="indikator_nums[]" class="form-control form-control-sm" required inputmode="numeric">
                </div>
                <div class="col-md-4 mb-2">
                    <label style="font-size:11.5px; font-weight:700; color:#475569;">Keterangan Bawah</label>
                    <input type="text" name="indikator_captions[]" class="form-control form-control-sm" required>
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-outline-danger mt-2" onclick="removeIndikatorCard(this)">
                <span class="material-icons" style="font-size:16px;vertical-align:middle;">delete</span> Hapus
            </button>
        `;
        container.appendChild(row);
        renumberCards();
    }

    function removeIndikatorCard(btn) {
        btn.closest('.indikator-card-item').remove();
        renumberCards();
        const container = document.getElementById('indikator-cards-container');
        if (container.children.length === 0) {
            container.innerHTML = `
                <div class="text-center py-4 text-muted" id="empty-state-indikator">
                    <span class="material-icons" style="font-size:48px; color:#D1D5DB; display:block; margin-bottom:12px;">widgets</span>
                    <p>Belum ada kartu indikator. Silakan klik "Tambah Kartu".</p>
                </div>
            `;
        }
    }

    function renumberCards() {
        const cards = document.querySelectorAll('#indikator-cards-container .indikator-card-item');
        cards.forEach((card, i) => {
            const badge = card.querySelector('.badge-num');
            if (badge) badge.textContent = 'KARTU ' + (i + 1);
        });
        indikatorIndex = cards.length;
    }

    document.getElementById('statistik-form').addEventListener('submit', function() {
        const btn = document.getElementById('statistik-save-btn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-sync-alt fa-spin mr-1"></i> Menyimpan...';
    });
</script>
@endsection
