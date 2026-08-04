@extends('admin.layouts.admin')
@section('title', 'Edit Profil Instansi')
@section('header_title', 'Edit Profil & Sambutan Pimpinan')

@section('styles')
<style>
    .profile-tabs-nav {
        display: flex;
        border-bottom: 2px solid #E2E8F0;
        margin-bottom: 24px;
        gap: 8px;
    }
    .tab-nav-btn {
        background: none;
        border: none;
        border-bottom: 2px solid transparent;
        padding: 10px 16px;
        font-weight: 600;
        color: #64748B;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
        outline: none !important;
        cursor: pointer;
    }
    .tab-nav-btn:hover {
        color: #009966;
    }
    .tab-nav-btn.active {
        color: #009966;
        border-bottom-color: #009966;
    }
    .tab-nav-btn .material-icons {
        font-size: 18px;
    }
    .profile-tab-panel {
        display: none;
    }
    .profile-tab-panel.active {
        display: block;
    }
    .misi-grid-layout {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 16px;
        margin-bottom: 16px;
    }
    .misi-card-field {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 3px;
        padding: 16px;
        position: relative;
    }
</style>
@endsection

@section('content')
<div class="card card-outline card-success">
    <div class="card-body">
        
        <!-- Navigation Tabs -->
        <div class="profile-tabs-nav">
            <button type="button" class="tab-nav-btn active" data-target="tab-sambutan">
                <span class="material-icons">campaign</span>
                <span>Sambutan Pimpinan</span>
            </button>
            <button type="button" class="tab-nav-btn" data-target="tab-visi-misi">
                <span class="material-icons">flag</span>
                <span>Visi, Misi &amp; Statistik</span>
            </button>
            <button type="button" class="tab-nav-btn" data-target="tab-sejarah">
                <span class="material-icons">history_edu</span>
                <span>Sejarah &amp; Latar Belakang</span>
            </button>
        </div>

        <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- PANEL 1: SAMBUTAN PIMPINAN -->
            <div id="tab-sambutan" class="profile-tab-panel active">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kepala_dinas_name">Nama Kepala Dinas <span class="text-danger">*</span></label>
                            <input type="text" name="kepala_dinas_name" id="kepala_dinas_name" 
                                value="{{ old('kepala_dinas_name', $profile->kepala_dinas_name) }}" 
                                class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kepala_dinas_role">Jabatan / Peran <span class="text-danger">*</span></label>
                            <input type="text" name="kepala_dinas_role" id="kepala_dinas_role" 
                                value="{{ old('kepala_dinas_role', $profile->kepala_dinas_role) }}" 
                                class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="sambutan_title">Judul Sambutan Utama <span class="text-danger">*</span></label>
                    <input type="text" name="sambutan_title" id="sambutan_title" 
                        value="{{ old('sambutan_title', $profile->sambutan_title) }}" 
                        class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="sambutan_quote">Kutipan Quote Sambutan (Baris Tebal) <span class="text-danger">*</span></label>
                    <textarea name="sambutan_quote" id="sambutan_quote" rows="3" class="form-control" required>{{ old('sambutan_quote', $profile->sambutan_quote) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sambutan_desc_1">Paragraf Deskripsi 1 <span class="text-danger">*</span></label>
                            <textarea name="sambutan_desc_1" id="sambutan_desc_1" rows="5" class="form-control" required>{{ old('sambutan_desc_1', $profile->sambutan_desc_1) }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sambutan_desc_2">Paragraf Deskripsi 2 <span class="text-danger">*</span></label>
                            <textarea name="sambutan_desc_2" id="sambutan_desc_2" rows="5" class="form-control" required>{{ old('sambutan_desc_2', $profile->sambutan_desc_2) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Foto Kepala Dinas -->
                <div class="form-group border-top pt-3 mt-3">
                    <label>Foto Pimpinan Saat Ini</label>
                    <div class="mb-3" style="max-width: 180px;">
                        @if($profile->kepala_dinas_image && file_exists(public_path('uploads/profile/' . $profile->kepala_dinas_image)))
                            <img src="{{ asset('uploads/profile/' . $profile->kepala_dinas_image) }}" alt="Kepala Dinas" 
                                style="width: 100%; height: 220px; object-fit: cover; border-radius: 3px; border: 1px solid #CBD5E1;">
                        @else
                            <img src="{{ asset('images/' . ($profile->kepala_dinas_image ?: 'Group 83.png')) }}" alt="Kepala Dinas" 
                                style="width: 100%; height: 220px; object-fit: cover; border-radius: 3px; border: 1px solid #CBD5E1;">
                        @endif
                    </div>

                    <label for="kepala_dinas_image">Unggah Foto Pimpinan Baru <small class="text-muted">(opsional)</small></label>
                    <input type="file" name="kepala_dinas_image" id="kepala_dinas_image" accept="image/*" class="form-control" style="padding-top: 5px; max-width: 450px;">
                    <small class="text-muted d-block mt-1">Format: JPEG, PNG, WebP. Maksimal: 2MB.</small>
                </div>
            </div>

            <!-- PANEL 2: VISI, MISI & STATISTIK -->
            <div id="tab-visi-misi" class="profile-tab-panel">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="visi_title">Teks Visi Utama <span class="text-danger">*</span></label>
                            <textarea name="visi_title" id="visi_title" rows="3" class="form-control" required>{{ old('visi_title', $profile->visi_title) }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="visi_desc">Deskripsi Penjelasan Visi <span class="text-danger">*</span></label>
                            <textarea name="visi_desc" id="visi_desc" rows="3" class="form-control" required>{{ old('visi_desc', $profile->visi_desc) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row border-bottom pb-3 mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stat_1_text">Statistik 1 (Kiri) <span class="text-danger">*</span></label>
                            <input type="text" name="stat_1_text" id="stat_1_text" 
                                value="{{ old('stat_1_text', $profile->stat_1_text) }}" 
                                class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stat_2_text">Statistik 2 (Kanan) <span class="text-danger">*</span></label>
                            <input type="text" name="stat_2_text" id="stat_2_text" 
                                value="{{ old('stat_2_text', $profile->stat_2_text) }}" 
                                class="form-control" required>
                        </div>
                    </div>
                </div>

                <h3 class="h6 font-weight-bold text-success mb-3 d-flex align-items-center gap-2">
                    <span class="material-icons">list_alt</span>
                    <span>Daftar Misi Instansi</span>
                </h3>

                <div id="misi-container" class="misi-grid-layout">
                    @foreach (old('misi', $profile->misi ?? []) as $index => $item)
                        <div class="misi-card-field" data-index="{{ $index }}">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="badge badge-success">Misi Poin {{ $index + 1 }}</span>
                                <button type="button" class="btn btn-xs btn-outline-danger" onclick="removeMisiField(this)">
                                    <span class="material-icons" style="font-size:12px;vertical-align:middle;">delete</span> Hapus
                                </button>
                            </div>
                            <div class="form-group">
                                <label style="font-size:12px;font-weight:600;color:#475569;">Judul Misi</label>
                                <input type="text" name="misi[{{ $index }}][title]" 
                                    value="{{ $item['title'] ?? '' }}" class="form-control form-control-sm" required>
                            </div>
                            <div class="form-group mb-0">
                                <label style="font-size:12px;font-weight:600;color:#475569;">Deskripsi Misi</label>
                                <textarea name="misi[{{ $index }}][desc]" rows="2" class="form-control form-control-sm" required>{{ $item['desc'] ?? '' }}</textarea>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="btn-add-misi" class="btn btn-sm btn-outline-success">
                    <span class="material-icons" style="font-size:14px;vertical-align:middle;">add</span> Tambah Poin Misi
                </button>
            </div>

            <!-- PANEL 3: SEJARAH & LATAR BELAKANG -->
            <div id="tab-sejarah" class="profile-tab-panel">
                <div class="form-group">
                    <label for="sejarah_title">Judul Latar Belakang <span class="text-danger">*</span></label>
                    <input type="text" name="sejarah_title" id="sejarah_title" 
                        value="{{ old('sejarah_title', $profile->sejarah_title) }}" 
                        class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="sejarah_text_1">Paragraf Sejarah 1 <span class="text-danger">*</span></label>
                    <textarea name="sejarah_text_1" id="sejarah_text_1" rows="5" class="form-control" required>{{ old('sejarah_text_1', $profile->sejarah_text_1) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="sejarah_text_2">Paragraf Sejarah 2 <span class="text-danger">*</span></label>
                    <textarea name="sejarah_text_2" id="sejarah_text_2" rows="5" class="form-control" required>{{ old('sejarah_text_2', $profile->sejarah_text_2) }}</textarea>
                </div>

                <!-- Gambar Sejarah / Latar Belakang -->
                <div class="form-group border-top pt-3 mt-3">
                    <label>Logo / Gambar Sejarah Saat Ini</label>
                    <div class="mb-3" style="max-width: 120px; background:#F8FAFC; border:1px solid #CBD5E1; border-radius:3px; padding:6px;">
                        @if($profile->sejarah_image && file_exists(public_path('uploads/profile/' . $profile->sejarah_image)))
                            <img src="{{ asset('uploads/profile/' . $profile->sejarah_image) }}" alt="Logo Sejarah" style="width: 100%; height: auto; object-fit: contain;">
                        @else
                            <img src="{{ asset('Assets/layouts/Nav/logo_dinkes_cropped.png') }}" alt="Logo Sejarah" style="width: 100%; height: auto; object-fit: contain;">
                        @endif
                    </div>

                    <label for="sejarah_image">Unggah Logo / Gambar Sejarah Baru <small class="text-muted">(opsional)</small></label>
                    <input type="file" name="sejarah_image" id="sejarah_image" accept="image/*" class="form-control" style="padding-top: 5px; max-width: 450px;">
                    <small class="text-muted d-block mt-1">Format: JPEG, PNG, WebP, SVG. Maksimal: 2MB.</small>
                </div>
            </div>

            <!-- BUTTON ACTIONS -->
            <div class="border-top pt-3 mt-4 d-flex justify-content-end">
                <button type="submit" class="btn btn-success" style="padding: 10px 24px;">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">save</span> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Tab switching logic
    const tabs = document.querySelectorAll('.tab-nav-btn');
    const panels = document.querySelectorAll('.profile-tab-panel');

    tabs.forEach(tab => {
        tab.addEventListener('click', function (e) {
            e.preventDefault();
            const target = this.dataset.target;

            tabs.forEach(t => t.classList.remove('active'));
            panels.forEach(p => p.classList.remove('active'));

            this.classList.add('active');
            document.getElementById(target).classList.add('active');
        });
    });

    // Dynamic Misi Fields Addition logic
    const container = document.getElementById('misi-container');
    const btnAdd = document.getElementById('btn-add-misi');

    btnAdd.addEventListener('click', function () {
        const index = container.children.length;
        const newField = document.createElement('div');
        newField.className = 'misi-card-field';
        newField.dataset.index = index;
        newField.innerHTML = `
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="badge badge-success">Misi Poin Baru</span>
                <button type="button" class="btn btn-xs btn-outline-danger" onclick="removeMisiField(this)">
                    <span class="material-icons" style="font-size:12px;vertical-align:middle;">delete</span> Hapus
                </button>
            </div>
            <div class="form-group">
                <label style="font-size: 12px; font-weight: 600; color: #4B5563; display: block; margin-bottom: 4px;">Judul Misi</label>
                <input type="text" name="misi[${index}][title]" class="form-control form-control-sm" placeholder="Contoh: 1. Pemerataan Pelayanan" required>
            </div>
            <div class="form-group mb-0">
                <label style="font-size: 12px; font-weight: 600; color: #4B5563; display: block; margin-bottom: 4px;">Deskripsi Misi</label>
                <textarea name="misi[${index}][desc]" rows="2" class="form-control form-control-sm" placeholder="Tulis deskripsi misi..." required></textarea>
            </div>
        `;
        container.appendChild(newField);
    });
});

// Remove Misi Field logic
function removeMisiField(button) {
    Swal.fire({
        title: 'Hapus Misi ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            const card = button.closest('.misi-card-field');
            card.remove();

            // Re-index all names inside container
            const container = document.getElementById('misi-container');
            Array.from(container.children).forEach((child, idx) => {
                const titleInput = child.querySelector('input');
                if (titleInput) {
                    titleInput.name = `misi[${idx}][title]`;
                }
                const descTextarea = child.querySelector('textarea');
                if (descTextarea) {
                    descTextarea.name = `misi[${idx}][desc]`;
                }
                const badge = child.querySelector('.badge');
                if (badge && !badge.innerText.includes('Baru')) {
                    badge.innerText = `Misi Poin ${idx + 1}`;
                }
            });
        }
    });
}
</script>
@endsection
