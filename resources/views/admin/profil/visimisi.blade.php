@extends('admin.layouts.admin')
@section('title', 'Visi & Misi Instansi')
@section('header_title', 'Visi & Misi Instansi')

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
    .misi-grid-layout {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }
    .misi-card-field {
        background: #F8FAFC;
        border: 1px solid var(--border-subtle);
        border-radius: 8px;
        padding: 20px;
        position: relative;
        transition: all 0.18s;
    }
    .misi-card-field:focus-within {
        border-color: #009966;
        background: #ffffff;
        box-shadow: var(--card-shadow);
    }
    .remove-btn-absolute {
        position: absolute;
        top: 15px;
        right: 15px;
        border: none;
        background: #FEE2E2;
        color: #DC2626;
        width: 28px;
        height: 28px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.15s;
    }
    .remove-btn-absolute:hover {
        background: #FCA5A5;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-12">

        <div class="custom-form-card">
            <form action="{{ route('admin.profil.update') }}" method="POST" id="profile-form">
                @csrf
                @method('PUT')
                <input type="hidden" name="section" value="visimisi">

                <div class="form-section-title">
                    <span class="material-icons text-success">flag</span>
                    <span>Visi Utama Instansi</span>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="visi_title">Teks Visi Utama <span class="text-danger">*</span></label>
                            <textarea name="visi_title" id="visi_title" rows="2" class="form-control @error('visi_title') is-invalid @enderror" required>{{ old('visi_title', $profile->visi_title) }}</textarea>
                            @error('visi_title') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="visi_desc">Deskripsi Penjelasan Visi <span class="text-danger">*</span></label>
                            <textarea name="visi_desc" id="visi_desc" rows="2" class="form-control @error('visi_desc') is-invalid @enderror" required>{{ old('visi_desc', $profile->visi_desc) }}</textarea>
                            @error('visi_desc') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stat_1_text">Statistik 1 (Kiri) <span class="text-danger">*</span></label>
                            <input type="text" name="stat_1_text" id="stat_1_text" 
                                value="{{ old('stat_1_text', $profile->stat_1_text) }}" 
                                class="form-control @error('stat_1_text') is-invalid @enderror" required>
                            @error('stat_1_text') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stat_2_text">Statistik 2 (Kanan) <span class="text-danger">*</span></label>
                            <input type="text" name="stat_2_text" id="stat_2_text" 
                                value="{{ old('stat_2_text', $profile->stat_2_text) }}" 
                                class="form-control @error('stat_2_text') is-invalid @enderror" required>
                            @error('stat_2_text') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-between mt-4 mb-3 pb-2" style="border-bottom: 1px solid var(--border-subtle);">
                    <div class="form-section-title mb-0" style="border-bottom: none; padding-bottom: 0;">
                        <span class="material-icons text-success">list_alt</span>
                        <span>Daftar Misi Instansi</span>
                    </div>
                    <button type="button" id="btn-add-misi" class="btn btn-outline-success btn-sm">
                        <span class="material-icons" style="font-size:16px; vertical-align:middle; margin-right:4px;">add</span> Tambah Poin Misi
                    </button>
                </div>

                <div id="misi-container" class="misi-grid-layout">
                    @foreach (old('misi', $profile->misi ?? []) as $index => $item)
                        <div class="misi-card-field" data-index="{{ $index }}">
                            <button type="button" class="remove-btn-absolute" onclick="removeMisiField(this)" title="Hapus Item">
                                <span class="material-icons" style="font-size:16px;">delete</span>
                            </button>
                            <span class="badge badge-success mb-3">Misi Poin {{ $index + 1 }}</span>
                            <div class="form-group">
                                <label style="font-size:11.5px; font-weight:700; color:#475569; margin-bottom:6px;">Judul Misi <span class="text-danger">*</span></label>
                                <input type="text" name="misi[{{ $index }}][title]" 
                                    value="{{ $item['title'] ?? '' }}" class="form-control" required>
                            </div>
                            <div class="form-group mb-0">
                                <label style="font-size:11.5px; font-weight:700; color:#475569; margin-bottom:6px;">Deskripsi Misi <span class="text-danger">*</span></label>
                                <textarea name="misi[{{ $index }}][desc]" rows="2" class="form-control" required>{{ $item['desc'] ?? '' }}</textarea>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="border-top pt-4 mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success px-4" id="profile-save-btn">
                        <span class="material-icons" style="font-size: 16px; vertical-align: middle; margin-right: 4px;">save</span> Simpan Visi &amp; Misi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const container = document.getElementById('misi-container');
    const btnAdd = document.getElementById('btn-add-misi');

    if (btnAdd) {
        btnAdd.addEventListener('click', function () {
            const index = container.querySelectorAll('.misi-card-field').length;
            const newField = document.createElement('div');
            newField.className = 'misi-card-field';
            newField.dataset.index = index;
            newField.innerHTML = `
                <button type="button" class="remove-btn-absolute" onclick="removeMisiField(this)" title="Hapus Item">
                    <span class="material-icons" style="font-size:16px;">delete</span>
                </button>
                <span class="badge badge-success mb-3">Misi Poin Baru</span>
                <div class="form-group">
                    <label style="font-size: 11.5px; font-weight: 700; color: #475569; display: block; margin-bottom: 6px;">Judul Misi <span class="text-danger">*</span></label>
                    <input type="text" name="misi[\${index}][title]" class="form-control" placeholder="Contoh: Pemerataan Pelayanan" required>
                </div>
                <div class="form-group mb-0">
                    <label style="font-size: 11.5px; font-weight: 700; color: #475569; display: block; margin-bottom: 6px;">Deskripsi Misi <span class="text-danger">*</span></label>
                    <textarea name="misi[\${index}][desc]" rows="2" class="form-control" placeholder="Deskripsi..." required></textarea>
                </div>
            `;
            container.appendChild(newField);
        });
    }

    function removeMisiField(button) {
        confirmAction('Hapus Misi ini?', 'Misi yang dihapus tidak dapat dikembalikan.', function() {
            const card = button.closest('.misi-card-field');
            card.remove();

            // Re-index inputs
            Array.from(container.querySelectorAll('.misi-card-field')).forEach((child, idx) => {
                const titleInput = child.querySelector('input');
                if (titleInput) titleInput.name = `misi[\${idx}][title]`;
                
                const descTextarea = child.querySelector('textarea');
                if (descTextarea) descTextarea.name = `misi[\${idx}][desc]`;
                
                const badge = child.querySelector('.badge');
                if (badge && !badge.innerText.includes('Baru')) {
                    badge.innerText = `Misi Poin \${idx + 1}`;
                }
            });
        });
    }

    document.getElementById('profile-form').addEventListener('submit', function() {
        const btn = document.getElementById('profile-save-btn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-sync-alt fa-spin mr-1"></i> Menyimpan...';
    });
</script>
@endsection
