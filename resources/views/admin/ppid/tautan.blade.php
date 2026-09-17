@extends('admin.layouts.admin')
@section('title', 'Tautan PPID')
@section('header_title', 'Tautan PPID')

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
                    <span class="material-icons text-success" style="font-size: 20px;">link</span>
                    <span class="font-weight-bold card-title-label">Pengaturan Seksi Tautan PPID</span>
                </span>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.ppid.update') }}" method="POST" id="ppid-form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="section" value="tautan">

                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="form-group mb-3">
                                <label for="tautan_badge" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">Badge Tautan</label>
                                <input type="text" name="tautan_badge" id="tautan_badge" value="{{ old('tautan_badge', $ppid->tautan_badge) }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-8 col-12">
                            <div class="form-group mb-3">
                                <label for="tautan_title" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">Judul Seksi Tautan</label>
                                <input type="text" name="tautan_title" id="tautan_title" value="{{ old('tautan_title', $ppid->tautan_title) }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="tautan_subtitle" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">Subjudul Seksi Tautan</label>
                                <input type="text" name="tautan_subtitle" id="tautan_subtitle" value="{{ old('tautan_subtitle', $ppid->tautan_subtitle) }}" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mb-3 pb-2 mt-4" style="border-bottom: 1px solid #E2E8F0;">
                        <div class="form-section-title mb-0" style="border-bottom: none; padding-bottom: 0;">
                            <span class="material-icons text-success" style="font-size: 20px;">list</span>
                            <span>Daftar Tautan Publik</span>
                        </div>
                        <button type="button" id="btn-add-tautan" class="btn btn-sm btn-outline-success font-weight-bold d-flex align-items-center" style="gap: 4px;">
                            <span class="material-icons" style="font-size:16px;">add</span> Tambah Baris Baru
                        </button>
                    </div>

                    <div id="tautan-container" class="accordion-grid-layout border-bottom pb-4 mb-4">
                        @forelse (old('tautan_items', $ppid->tautan_items ?? []) as $index => $item)
                            <div class="accordion-card-field" data-index="{{ $index }}">
                                <button type="button" class="remove-btn-absolute" onclick="removeTautanField(this)" title="Hapus Item">
                                    <span class="material-icons" style="font-size:16px;">delete</span>
                                </button>
                                <span class="badge badge-success mb-3" style="border-radius: 3px; font-weight: 700;">Tautan {{ $loop->iteration }}</span>
                                
                                <div class="form-group mb-2">
                                    <label class="font-weight-bold" style="font-size: 12px; color: #1E293B;">Label Tombol <span class="text-danger">*</span></label>
                                    <input type="text" name="tautan_items[{{ $index }}][label]" value="{{ $item['label'] ?? '' }}" class="form-control" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="font-weight-bold" style="font-size: 12px; color: #1E293B;">Alamat URL Link</label>
                                    <input type="text" name="tautan_items[{{ $index }}][url]" value="{{ $item['url'] ?? '' }}" class="form-control">
                                </div>
                                <div class="form-group mb-0">
                                    <label class="font-weight-bold" style="font-size: 12px; color: #1E293B;">Upload Ikon/Gambar</label>
                                    @if(!empty($item['image']))
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $item['image']) }}" class="preview-image" style="max-height: 48px; border-radius: 3px;">
                                        </div>
                                        <input type="hidden" name="tautan_items[{{ $index }}][existing_image]" value="{{ $item['image'] }}">
                                    @endif
                                    <input type="file" name="tautan_items[{{ $index }}][image_upload]" class="form-control-file" accept="image/*">
                                    <small class="text-muted d-block mt-1">Biarkan kosong jika tidak ingin mengganti gambar.</small>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5" id="empty-state-info">
                                <span class="material-icons" style="font-size:48px; color:#CBD5E1; display:block; margin-bottom:8px;">link</span>
                                <p class="font-weight-bold mb-1">Belum Ada Tautan</p>
                                <small class="text-muted">Belum ada item tautan ditambahkan. Silakan klik tombol "Tambah Baris Baru".</small>
                            </div>
                        @endforelse
                    </div>

                    <div class="border-top pt-4 mt-4 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success font-weight-bold px-4" id="ppid-save-btn">
                            <span class="material-icons" style="font-size: 16px; vertical-align: middle; margin-right: 4px;">save</span> Simpan Tautan
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
    const container = document.getElementById('tautan-container');
    const btnAdd = document.getElementById('btn-add-tautan');
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
                <button type="button" class="remove-btn-absolute" onclick="removeTautanField(this)" title="Hapus Item">
                    <span class="material-icons" style="font-size:16px;">delete</span>
                </button>
                <span class="badge badge-success mb-3" style="border-radius: 3px; font-weight: 700;">Tautan Baru</span>
                
                <div class="form-group mb-2">
                    <label class="font-weight-bold" style="font-size: 12px; color: #1E293B;">Label Tombol <span class="text-danger">*</span></label>
                    <input type="text" name="tautan_items[${index}][label]" class="form-control" placeholder="Label..." required>
                </div>
                <div class="form-group mb-2">
                    <label class="font-weight-bold" style="font-size: 12px; color: #1E293B;">Alamat URL Link</label>
                    <input type="text" name="tautan_items[${index}][url]" class="form-control" placeholder="https://...">
                </div>
                <div class="form-group mb-0">
                    <label class="font-weight-bold" style="font-size: 12px; color: #1E293B;">Upload Ikon/Gambar</label>
                    <input type="file" name="tautan_items[${index}][image_upload]" class="form-control-file" accept="image/*">
                    <small class="text-muted d-block mt-1">Biarkan kosong jika tidak ingin mengunggah gambar.</small>
                </div>
            `;
            container.appendChild(newField);
        });
    }

    function removeTautanField(button) {
        Swal.fire({
            title: 'Hapus Tautan ini?',
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
                    const labelInput = child.querySelector('input[name$="[label]"]');
                    if (labelInput) labelInput.name = `tautan_items[${idx}][label]`;
                    
                    const urlInput = child.querySelector('input[name$="[url]"]');
                    if (urlInput) urlInput.name = `tautan_items[${idx}][url]`;
                    
                    const imageInput = child.querySelector('input[type="file"]');
                    if (imageInput) imageInput.name = `tautan_items[${idx}][image_upload]`;

                    const existingImageInput = child.querySelector('input[name$="[existing_image]"]');
                    if (existingImageInput) existingImageInput.name = `tautan_items[${idx}][existing_image]`;
                    
                    const badge = child.querySelector('.badge');
                    if (badge && !badge.innerText.includes('Baru')) {
                        badge.innerText = `Tautan ${idx + 1}`;
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
