@extends('admin.layouts.admin')
@section('title', 'Tata Cara & Aksi PPID')
@section('header_title', 'Tata Cara & Aksi PPID')

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
    .accordion-grid-layout {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }
    .accordion-card-field {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 3px;
        padding: 20px;
        position: relative;
        transition: all 0.18s;
    }
    .accordion-card-field:focus-within {
        border-color: #009966;
        background: #ffffff;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
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
        border-radius: 3px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.15s;
    }
    .remove-btn-absolute:hover {
        background: #FCA5A5;
    }
    .preview-image {
        max-width: 100%;
        height: auto;
        border-radius: 3px;
        margin-bottom: 8px;
        border: 1px solid #CBD5E1;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-outline card-success">
            <div class="card-header" style="padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
                <span class="d-flex align-items-center" style="gap: 8px;">
                    <span class="material-icons text-success" style="font-size: 20px;">playlist_add_check</span>
                    <span class="font-weight-bold card-title-label">Tata Cara Permohonan Informasi</span>
                </span>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.ppid.update') }}" method="POST" id="ppid-form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="section" value="tatacara">

                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group mb-3">
                                <label for="tata_cara_badge" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">Badge Tata Cara</label>
                                <input type="text" name="tata_cara_badge" id="tata_cara_badge" value="{{ old('tata_cara_badge', $ppid->tata_cara_badge) }}" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="tata_cara_heading" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">Heading Tata Cara</label>
                                <input type="text" name="tata_cara_heading" id="tata_cara_heading" value="{{ old('tata_cara_heading', $ppid->tata_cara_heading) }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group mb-3">
                                <label for="tata_cara_image_upload" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">Ilustrasi Gambar Tata Cara</label>
                                @if(!empty($ppid->tata_cara_image))
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $ppid->tata_cara_image) }}" class="preview-image" style="max-height: 90px; border-radius: 3px;">
                                    </div>
                                @endif
                                <input type="file" name="tata_cara_image_upload" id="tata_cara_image_upload" class="form-control-file" accept="image/*">
                                <small class="text-muted d-block mt-1">Biarkan kosong jika tidak ingin mengubah ilustrasi gambar saat ini.</small>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mb-3 pb-2 mt-4" style="border-bottom: 1px solid #E2E8F0;">
                        <div class="form-section-title mb-0" style="border-bottom: none; padding-bottom: 0;">
                            <span class="material-icons text-success" style="font-size: 20px;">check_circle_outline</span>
                            <span>Daftar Langkah Tata Cara</span>
                        </div>
                        <button type="button" id="btn-add-tatacara" class="btn btn-sm btn-outline-success font-weight-bold d-flex align-items-center" style="gap: 4px;">
                            <span class="material-icons" style="font-size:16px;">add</span> Tambah Langkah Baru
                        </button>
                    </div>

                    <div id="tatacara-container" class="accordion-grid-layout border-bottom pb-4 mb-4">
                        @forelse (old('tata_cara_items', $ppid->tata_cara_items ?? []) as $index => $item)
                            <div class="accordion-card-field" data-index="{{ $index }}">
                                <button type="button" class="remove-btn-absolute" onclick="removeTatacaraField(this)" title="Hapus Item">
                                    <span class="material-icons" style="font-size:16px;">delete</span>
                                </button>
                                <span class="badge badge-success mb-3" style="border-radius: 3px; font-weight: 700;">LANGKAH {{ $loop->iteration }}</span>
                                
                                <div class="form-group mb-2">
                                    <label class="font-weight-bold" style="font-size:12px; color:#1E293B;">Judul Langkah <span class="text-danger">*</span></label>
                                    <input type="text" name="tata_cara_items[{{ $index }}][title]" value="{{ $item['title'] ?? '' }}" class="form-control" required>
                                </div>
                                <div class="form-group mb-0">
                                    <label class="font-weight-bold" style="font-size:12px; color:#1E293B;">Penjelasan Deskripsi <span class="text-danger">*</span></label>
                                    <textarea name="tata_cara_items[{{ $index }}][text]" rows="2" class="form-control" required>{{ $item['text'] ?? '' }}</textarea>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5" id="empty-state-info">
                                <span class="material-icons" style="font-size:48px; color:#CBD5E1; display:block; margin-bottom:8px;">playlist_add_check</span>
                                <p class="font-weight-bold mb-1">Belum Ada Langkah</p>
                                <small class="text-muted">Belum ada langkah tata cara ditambahkan. Silakan klik tombol "Tambah Langkah Baru".</small>
                            </div>
                        @endforelse
                    </div>

                    <div class="form-section-title">
                        <span class="material-icons text-success" style="font-size: 20px;">touch_app</span>
                        <span>Tautan Tombol Aksi di Bawah</span>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-12 mb-3">
                            <div class="card p-3" style="background:#F8FAFC; border:1px solid #E2E8F0; border-radius:3px;">
                                <span class="badge mb-3 align-self-start" style="background:#E0F2FE; color:#0369A1; padding: 4px 10px; font-weight: 700; border-radius: 3px;">TOMBOL DAFTAR PPID</span>
                                <div class="form-group mb-2">
                                    <label class="font-weight-bold" style="font-size:12px; color:#1E293B;">Label Tombol</label>
                                    <input type="text" name="btn_daftar_label" value="{{ old('btn_daftar_label', $ppid->btn_daftar_label) }}" class="form-control">
                                </div>
                                <div class="form-group mb-0">
                                    <label class="font-weight-bold" style="font-size:12px; color:#1E293B;">URL Redirect</label>
                                    <input type="text" name="btn_daftar_url" value="{{ old('btn_daftar_url', $ppid->btn_daftar_url) }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <div class="card p-3" style="background:#F8FAFC; border:1px solid #E2E8F0; border-radius:3px;">
                                <span class="badge mb-3 align-self-start" style="background:#E0F2FE; color:#0369A1; padding: 4px 10px; font-weight: 700; border-radius: 3px;">TOMBOL LOGIN PPID</span>
                                <div class="form-group mb-2">
                                    <label class="font-weight-bold" style="font-size:12px; color:#1E293B;">Label Tombol</label>
                                    <input type="text" name="btn_login_label" value="{{ old('btn_login_label', $ppid->btn_login_label) }}" class="form-control">
                                </div>
                                <div class="form-group mb-0">
                                    <label class="font-weight-bold" style="font-size:12px; color:#1E293B;">URL Redirect</label>
                                    <input type="text" name="btn_login_url" value="{{ old('btn_login_url', $ppid->btn_login_url) }}" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border-top pt-4 mt-4 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success font-weight-bold px-4" id="ppid-save-btn">
                            <span class="material-icons" style="font-size: 16px; vertical-align: middle; margin-right: 4px;">save</span> Simpan Tata Cara &amp; Aksi
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
    const container = document.getElementById('tatacara-container');
    const btnAdd = document.getElementById('btn-add-tatacara');
    const emptyState = document.getElementById('empty-state-info');

    if (btnAdd) {
        btnAdd.addEventListener('click', function () {
            if (emptyState) {
                emptyState.remove();
            }
            const index = container.querySelectorAll('.accordion-card-field').length;
            const newField = document.createElement('div');
            newField.className = 'accordion-card-field';
            newField.dataset.index = index;
            newField.innerHTML = `
                <button type="button" class="remove-btn-absolute" onclick="removeTatacaraField(this)" title="Hapus Item">
                    <span class="material-icons" style="font-size:16px;">delete</span>
                </button>
                <span class="badge badge-success mb-3" style="border-radius: 3px; font-weight: 700;">LANGKAH BARU</span>
                
                <div class="form-group mb-2">
                    <label class="font-weight-bold" style="font-size:12px; color:#1E293B;">Judul Langkah <span class="text-danger">*</span></label>
                    <input type="text" name="tata_cara_items[${index}][title]" class="form-control" placeholder="Judul..." required>
                </div>
                <div class="form-group mb-0">
                    <label class="font-weight-bold" style="font-size:12px; color:#1E293B;">Penjelasan Deskripsi <span class="text-danger">*</span></label>
                    <textarea name="tata_cara_items[${index}][text]" rows="2" class="form-control" placeholder="Isi penjelasan..." required></textarea>
                </div>
            `;
            container.appendChild(newField);
        });
    }

    function removeTatacaraField(button) {
        Swal.fire({
            title: 'Hapus Langkah ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                const card = button.closest('.accordion-card-field');
                card.remove();

                // Re-index inputs
                Array.from(container.querySelectorAll('.accordion-card-field')).forEach((child, idx) => {
                    const titleInput = child.querySelector('input[name$="[title]"]');
                    if (titleInput) titleInput.name = `tata_cara_items[${idx}][title]`;
                    
                    const textInput = child.querySelector('textarea');
                    if (textInput) textInput.name = `tata_cara_items[${idx}][text]`;
                    
                    const badge = child.querySelector('.badge');
                    if (badge && !badge.innerText.includes('BARU')) {
                        badge.innerText = `LANGKAH ${idx + 1}`;
                    }
                });
            }
        });
    }

    document.getElementById('ppid-form').addEventListener('submit', function() {
        const btn = document.getElementById('ppid-save-btn');
        btn.disabled = true;
        btn.innerHTML = '<span class="material-icons" style="font-size: 16px; vertical-align: middle;">sync</span> Menyimpan...';
    });
</script>
@endsection
