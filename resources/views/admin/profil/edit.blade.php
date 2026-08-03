@extends('admin.layouts.admin')

@section('title', 'Edit Profil Instansi')
@section('header_title', 'Edit Profil & Sambutan Pimpinan')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/profil.css') }}?v={{ time() }}">
@endsection

@section('content')
<div class="agenda-admin-wrapper">
    
    @if(session('success'))
        <div class="admin-alert admin-alert-success" style="background-color: #ECFDF5; color: #047857; border: 1px solid #A7F3D0; padding: 12px; border-radius: 3px; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
            <span class="material-icons">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if ($errors->any())
        <div class="admin-alert admin-alert-danger" style="background-color: #FEF2F2; color: #B91C1C; border: 1px solid #FECACA; padding: 12px; border-radius: 3px; margin-bottom: 20px;">
            <div style="font-weight: 700; margin-bottom: 4px; display: flex; align-items: center; gap: 8px;">
                <span class="material-icons">error</span>
                <span>Terdapat kesalahan penginputan:</span>
            </div>
            <ul style="list-style: inside; margin-left: 24px; font-size: 14px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="admin-card">
        <!-- Navigation Tabs -->
        <div class="profile-tabs-nav">
            <button type="button" class="tab-nav-btn active" data-target="tab-sambutan">
                <span class="material-icons">campaign</span>
                <span>Sambutan Pimpinan</span>
            </button>
            <button type="button" class="tab-nav-btn" data-target="tab-visi-misi">
                <span class="material-icons">flag</span>
                <span>Visi, Misi & Statistik</span>
            </button>
            <button type="button" class="tab-nav-btn" data-target="tab-sejarah">
                <span class="material-icons">history_edu</span>
                <span>Sejarah & Latar Belakang</span>
            </button>
            <button type="button" class="tab-nav-btn" data-target="tab-struktur">
                <span class="material-icons">account_tree</span>
                <span>Struktur Organisasi</span>
            </button>
        </div>

        <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data" class="admin-form">
            @csrf
            @method('PUT')

            <!-- PANEL 1: SAMBUTAN PIMPINAN -->
            <div id="tab-sambutan" class="profile-tab-panel active">
                <div class="form-row-2col">
                    <div class="form-group">
                        <label for="kepala_dinas_name" style="font-weight: 700; display: block; margin-bottom: 8px;">Nama Kepala Dinas</label>
                        <input 
                            type="text" 
                            name="kepala_dinas_name" 
                            id="kepala_dinas_name" 
                            value="{{ old('kepala_dinas_name', $profile->kepala_dinas_name) }}" 
                            class="form-control-input" 
                            style="width: 100%;"
                            required
                        >
                    </div>
                    <div class="form-group">
                        <label for="kepala_dinas_role" style="font-weight: 700; display: block; margin-bottom: 8px;">Jabatan / Peran</label>
                        <input 
                            type="text" 
                            name="kepala_dinas_role" 
                            id="kepala_dinas_role" 
                            value="{{ old('kepala_dinas_role', $profile->kepala_dinas_role) }}" 
                            class="form-control-input" 
                            style="width: 100%;"
                            required
                        >
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="sambutan_title" style="font-weight: 700; display: block; margin-bottom: 8px;">Judul Sambutan Utama</label>
                    <input 
                        type="text" 
                        name="sambutan_title" 
                        id="sambutan_title" 
                        value="{{ old('sambutan_title', $profile->sambutan_title) }}" 
                        class="form-control-input" 
                        style="width: 100%;"
                        required
                    >
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="sambutan_quote" style="font-weight: 700; display: block; margin-bottom: 8px;">Kutipan Quote Sambutan (Baris Tebal)</label>
                    <textarea name="sambutan_quote" id="sambutan_quote" class="form-textarea" required>{{ old('sambutan_quote', $profile->sambutan_quote) }}</textarea>
                </div>

                <div class="form-row-2col">
                    <div class="form-group">
                        <label for="sambutan_desc_1" style="font-weight: 700; display: block; margin-bottom: 8px;">Paragraf Deskripsi 1</label>
                        <textarea name="sambutan_desc_1" id="sambutan_desc_1" class="form-textarea" style="min-height: 140px;" required>{{ old('sambutan_desc_1', $profile->sambutan_desc_1) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="sambutan_desc_2" style="font-weight: 700; display: block; margin-bottom: 8px;">Paragraf Deskripsi 2</label>
                        <textarea name="sambutan_desc_2" id="sambutan_desc_2" class="form-textarea" style="min-height: 140px;" required>{{ old('sambutan_desc_2', $profile->sambutan_desc_2) }}</textarea>
                    </div>
                </div>

                <!-- Foto Kepala Dinas -->
                <div class="form-group" style="margin-bottom: 20px; border-top: 1px solid #E5E7EB; padding-top: 20px;">
                    <label style="font-weight: 700; display: block; margin-bottom: 8px;">Foto Pimpinan Saat Ini</label>
                    <div class="image-preview-wrapper" style="margin-bottom: 12px;">
                        @if($profile->kepala_dinas_image && file_exists(public_path('uploads/profile/' . $profile->kepala_dinas_image)))
                            <img src="{{ asset('uploads/profile/' . $profile->kepala_dinas_image) }}" alt="Kepala Dinas">
                        @else
                            <img src="{{ asset('images/' . ($profile->kepala_dinas_image ?: 'Group 83.png')) }}" alt="Kepala Dinas">
                        @endif
                    </div>

                    <label for="kepala_dinas_image" style="font-weight: 700; display: block; margin-bottom: 8px;">Unggah Foto Pimpinan Baru (Opsional)</label>
                    <input 
                        type="file" 
                        name="kepala_dinas_image" 
                        id="kepala_dinas_image" 
                        accept="image/*"
                        class="form-control-input" 
                        style="padding: 8px 12px; border: 1px solid #D1D5DB; border-radius: 3px; width: 100%; max-width: 450px;" 
                    >
                    <small style="display: block; color: #6B7280; margin-top: 6px; font-size: 12px;">Format yang didukung: JPEG, PNG, JPG, WebP. Maksimal: 2MB.</small>
                </div>
            </div>

            <!-- PANEL 2: VISI, MISI & STATISTIK -->
            <div id="tab-visi-misi" class="profile-tab-panel">
                <div class="form-row-2col">
                    <div class="form-group">
                        <label for="visi_title" style="font-weight: 700; display: block; margin-bottom: 8px;">Teks Visi Utama</label>
                        <textarea name="visi_title" id="visi_title" class="form-textarea" style="min-height: 80px;" required>{{ old('visi_title', $profile->visi_title) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="visi_desc" style="font-weight: 700; display: block; margin-bottom: 8px;">Deskripsi Penjelasan Visi</label>
                        <textarea name="visi_desc" id="visi_desc" class="form-textarea" style="min-height: 80px;" required>{{ old('visi_desc', $profile->visi_desc) }}</textarea>
                    </div>
                </div>

                <div class="form-row-2col" style="border-bottom: 1px solid #E5E7EB; padding-bottom: 20px; margin-bottom: 20px;">
                    <div class="form-group">
                        <label for="stat_1_text" style="font-weight: 700; display: block; margin-bottom: 8px;">Statistik 1 (Kiri)</label>
                        <input 
                            type="text" 
                            name="stat_1_text" 
                            id="stat_1_text" 
                            value="{{ old('stat_1_text', $profile->stat_1_text) }}" 
                            class="form-control-input" 
                            style="width: 100%;"
                            required
                        >
                    </div>
                    <div class="form-group">
                        <label for="stat_2_text" style="font-weight: 700; display: block; margin-bottom: 8px;">Statistik 2 (Kanan)</label>
                        <input 
                            type="text" 
                            name="stat_2_text" 
                            id="stat_2_text" 
                            value="{{ old('stat_2_text', $profile->stat_2_text) }}" 
                            class="form-control-input" 
                            style="width: 100%;"
                            required
                        >
                    </div>
                </div>

                <h3 style="font-size: 16px; color: #004F3B; font-weight: 700; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                    <span class="material-icons">list_alt</span>
                    <span>Daftar Misi Instansi</span>
                </h3>

                <div id="misi-container" class="misi-grid-layout">
                    @foreach (old('misi', $profile->misi ?? []) as $index => $item)
                        <div class="misi-card-field" data-index="{{ $index }}">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                <span class="misi-card-number">Misi Poin</span>
                                <button type="button" class="btn-remove-misi" style="background: none; border: none; color: #EF4444; cursor: pointer; display: flex; align-items: center; gap: 4px;" onclick="removeMisiField(this)">
                                    <span class="material-icons" style="font-size: 16px;">delete</span>
                                    <span style="font-size: 12px; font-weight: 600;">Hapus</span>
                                </button>
                            </div>
                            <div class="form-group" style="margin-bottom: 10px;">
                                <label style="font-size: 12px; font-weight: 600; color: #4B5563; display: block; margin-bottom: 4px;">Judul Misi</label>
                                <input 
                                    type="text" 
                                    name="misi[{{ $index }}][title]" 
                                    value="{{ $item['title'] ?? '' }}" 
                                    class="form-control-input" 
                                    style="width: 100%;"
                                    required
                                >
                            </div>
                            <div class="form-group">
                                <label style="font-size: 12px; font-weight: 600; color: #4B5563; display: block; margin-bottom: 4px;">Deskripsi Misi</label>
                                <textarea name="misi[{{ $index }}][desc]" class="form-textarea" style="min-height: 60px; font-size: 13px;" required>{{ $item['desc'] ?? '' }}</textarea>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="btn-add-misi" class="btn-admin btn-admin-secondary" style="margin-top: 12px; display: inline-flex; align-items: center; gap: 8px;">
                    <span class="material-icons">add</span>
                    <span>Tambah Poin Misi</span>
                </button>
            </div>

            <!-- PANEL 3: SEJARAH & LATAR BELAKANG -->
            <div id="tab-sejarah" class="profile-tab-panel">
                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="sejarah_title" style="font-weight: 700; display: block; margin-bottom: 8px;">Judul Latar Belakang</label>
                    <input 
                        type="text" 
                        name="sejarah_title" 
                        id="sejarah_title" 
                        value="{{ old('sejarah_title', $profile->sejarah_title) }}" 
                        class="form-control-input" 
                        style="width: 100%;"
                        required
                    >
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="sejarah_text_1" style="font-weight: 700; display: block; margin-bottom: 8px;">Paragraf Sejarah 1</label>
                    <textarea name="sejarah_text_1" id="sejarah_text_1" class="form-textarea" style="min-height: 150px;" required>{{ old('sejarah_text_1', $profile->sejarah_text_1) }}</textarea>
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="sejarah_text_2" style="font-weight: 700; display: block; margin-bottom: 8px;">Paragraf Sejarah 2</label>
                    <textarea name="sejarah_text_2" id="sejarah_text_2" class="form-textarea" style="min-height: 150px;" required>{{ old('sejarah_text_2', $profile->sejarah_text_2) }}</textarea>
                </div>

                <!-- Gambar Sejarah / Latar Belakang -->
                <div class="form-group" style="margin-bottom: 20px; border-top: 1px solid #E5E7EB; padding-top: 20px;">
                    <label style="font-weight: 700; display: block; margin-bottom: 8px;">Logo / Gambar Sejarah Saat Ini</label>
                    <div class="image-preview-wrapper" style="margin-bottom: 12px; max-width: 150px;">
                        @if($profile->sejarah_image && file_exists(public_path('uploads/profile/' . $profile->sejarah_image)))
                            <img src="{{ asset('uploads/profile/' . $profile->sejarah_image) }}" alt="Logo Sejarah" style="max-width: 100%; object-fit: contain;">
                        @else
                            <img src="{{ asset('Assets/layouts/Nav/logo_dinkes_cropped.png') }}" alt="Logo Sejarah" style="max-width: 100%; object-fit: contain;">
                        @endif
                    </div>

                    <label for="sejarah_image" style="font-weight: 700; display: block; margin-bottom: 8px;">Unggah Logo / Gambar Sejarah Baru (Opsional)</label>
                    <input 
                        type="file" 
                        name="sejarah_image" 
                        id="sejarah_image" 
                        accept="image/*"
                        class="form-control-input" 
                        style="padding: 8px 12px; border: 1px solid #D1D5DB; border-radius: 3px; width: 100%; max-width: 450px;" 
                    >
                    <small style="display: block; color: #6B7280; margin-top: 6px; font-size: 12px;">Format yang didukung: JPEG, PNG, JPG, WebP, SVG. Maksimal: 2MB.</small>
                </div>
            </div>

            <!-- PANEL 4: STRUKTUR ORGANISASI -->
            <div id="tab-struktur" class="profile-tab-panel">
                <div class="form-group" style="margin-bottom: 20px;">
                    <label style="font-weight: 700; display: block; margin-bottom: 8px;">Struktur Organisasi Saat Ini</label>
                    <div class="image-preview-wrapper" style="margin-bottom: 12px; max-width: 100%; background: #F9FAFB; border: 1px solid #E5E7EB; border-radius: 3px; padding: 20px; text-align: center;">
                        @if($profile->struktur_organisasi_image && file_exists(public_path('uploads/profile/' . $profile->struktur_organisasi_image)))
                            <img src="{{ asset('uploads/profile/' . $profile->struktur_organisasi_image) }}" alt="Struktur Organisasi" style="max-width: 100%; max-height: 500px; object-fit: contain;">
                        @else
                            <div style="padding: 40px 20px; color: #9CA3AF;">
                                <span class="material-icons" style="font-size: 48px; display: block; margin-bottom: 12px;">account_tree</span>
                                <p style="margin: 0; font-size: 14px; font-weight: 600;">Belum ada gambar struktur organisasi</p>
                                <p style="margin: 8px 0 0 0; font-size: 12px;">Unggah gambar atau PDF struktur organisasi di bawah ini.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 20px; border-top: 1px solid #E5E7EB; padding-top: 20px;">
                    <label for="struktur_organisasi_image" style="font-weight: 700; display: block; margin-bottom: 8px;">Unggah Struktur Organisasi Baru (Opsional)</label>
                    <input 
                        type="file" 
                        name="struktur_organisasi_image" 
                        id="struktur_organisasi_image" 
                        accept="image/*,.pdf"
                        class="form-control-input" 
                        style="padding: 8px 12px; border: 1px solid #D1D5DB; border-radius: 3px; width: 100%; max-width: 450px;" 
                    >
                    <small style="display: block; color: #6B7280; margin-top: 6px; font-size: 12px;">Format yang didukung: JPEG, PNG, JPG, WebP, PDF. Maksimal: 5MB.</small>
                    @if($profile->struktur_organisasi_image)
                        <div style="margin-top: 12px; padding: 10px; background: #F0FDF4; border: 1px solid #A7F3D0; border-radius: 3px; display: flex; align-items: center; gap: 8px;">
                            <span class="material-icons" style="color: #059669; font-size: 18px;">check_circle</span>
                            <span style="font-size: 13px; color: #047857;">File saat ini: {{ $profile->struktur_organisasi_image }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- BUTTON ACTIONS -->
            <div class="form-actions" style="display: flex; gap: 12px; border-top: 1px solid #F3F4F6; padding-top: 20px; margin-top: 24px;">
                <button type="submit" class="btn-admin btn-admin-primary">
                    <span class="material-icons">save</span>
                    <span>Simpan Perubahan</span>
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
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                    <span class="misi-card-number">Misi Poin Baru</span>
                    <button type="button" class="btn-remove-misi" style="background: none; border: none; color: #EF4444; cursor: pointer; display: flex; align-items: center; gap: 4px;" onclick="removeMisiField(this)">
                        <span class="material-icons" style="font-size: 16px;">delete</span>
                        <span style="font-size: 12px; font-weight: 600;">Hapus</span>
                    </button>
                </div>
                <div class="form-group" style="margin-bottom: 10px;">
                    <label style="font-size: 12px; font-weight: 600; color: #4B5563; display: block; margin-bottom: 4px;">Judul Misi</label>
                    <input 
                        type="text" 
                        name="misi[${index}][title]" 
                        class="form-control-input" 
                        style="width: 100%;"
                        placeholder="Contoh: 1. Pemerataan Pelayanan"
                        required
                    >
                </div>
                <div class="form-group">
                    <label style="font-size: 12px; font-weight: 600; color: #4B5563; display: block; margin-bottom: 4px;">Deskripsi Misi</label>
                    <textarea name="misi[${index}][desc]" class="form-textarea" style="min-height: 60px; font-size: 13px;" placeholder="Tulis deskripsi misi..." required></textarea>
                </div>
            `;
            container.appendChild(newField);
        });
    });

    // Remove Misi Field logic
    function removeMisiField(button) {
        if (confirm('Apakah Anda yakin ingin menghapus poin misi ini?')) {
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
            });
        }
    }
</script>
@endsection
