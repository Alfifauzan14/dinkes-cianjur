@extends('admin.layouts.admin')
@section('title', 'Informasi Publik (Accordion)')
@section('header_title', 'Informasi Publik (Accordion)')

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
    .accordion-grid-layout {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }
    .accordion-card-field {
        background: #F8FAFC;
        border: 1px solid var(--border-subtle);
        border-radius: 8px;
        padding: 20px;
        position: relative;
        transition: all 0.18s;
    }
    .accordion-card-field:focus-within {
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
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 6px; margin-bottom: 20px;">
                <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="custom-form-card">
            <form action="{{ route('admin.ppid.update') }}" method="POST" id="ppid-form">
                @csrf
                @method('PUT')
                <input type="hidden" name="section" value="informasi">

                <div class="d-flex align-items-center justify-content-between mb-4 pb-2" style="border-bottom: 1px solid var(--border-subtle);">
                    <div class="form-section-title mb-0" style="border-bottom: none; padding-bottom: 0;">
                        <span class="material-icons text-success">toc</span>
                        <span>Daftar Informasi Publik (Accordion)</span>
                    </div>
                    <button type="button" id="btn-add-accordion" class="btn btn-outline-success btn-sm">
                        <span class="material-icons" style="font-size:16px; vertical-align:middle; margin-right:4px;">add</span> Tambah Baris Baru
                    </button>
                </div>

                <div id="accordion-container" class="accordion-grid-layout">
                    @forelse (old('accordion_items', $ppid->accordion_items ?? []) as $index => $item)
                        <div class="accordion-card-field" data-index="{{ $index }}">
                            <button type="button" class="remove-btn-absolute" onclick="removeAccordionField(this)" title="Hapus Item">
                                <span class="material-icons" style="font-size:16px;">delete</span>
                            </button>
                            <span class="badge badge-success mb-3">Item {{ $index + 1 }}</span>
                            
                            <div class="form-group">
                                <label style="font-size: 12px; font-weight: 700; color: #475569; display: block; margin-bottom: 6px;">Klasifikasi Informasi <span class="text-danger">*</span></label>
                                <select name="accordion_items[{{ $index }}][category]" class="form-control" required>
                                    <option value="berkala" {{ ($item['category'] ?? '') === 'berkala' ? 'selected' : '' }}>Informasi Berkala</option>
                                    <option value="serta-merta" {{ ($item['category'] ?? '') === 'serta-merta' ? 'selected' : '' }}>Informasi Serta Merta</option>
                                    <option value="setiap-saat" {{ ($item['category'] ?? '') === 'setiap-saat' ? 'selected' : '' }}>Informasi Setiap Saat</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label style="font-size: 12px; font-weight: 700; color: #475569; display: block; margin-bottom: 6px;">Judul Informasi <span class="text-danger">*</span></label>
                                <input type="text" name="accordion_items[{{ $index }}][title]" 
                                    value="{{ $item['title'] ?? '' }}" class="form-control" placeholder="Contoh: Rencana Strategis Dinkes" required>
                            </div>
                            <div class="form-group mb-0">
                                <label style="font-size: 12px; font-weight: 700; color: #475569; display: block; margin-bottom: 6px;">Detail Isi / Deskripsi <span class="text-danger">*</span></label>
                                <textarea name="accordion_items[{{ $index }}][content]" rows="3" class="form-control" placeholder="Isi deskripsi lengkap..." required>{{ $item['content'] ?? '' }}</textarea>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5" id="empty-state-info">
                            <span class="material-icons" style="font-size:48px; color:#D1D5DB; display:block; margin-bottom:12px;">toc</span>
                            <p class="text-muted">Belum ada item informasi publik ditambahkan. Silakan klik tombol "Tambah Baris Baru".</p>
                        </div>
                    @endforelse
                </div>

                <div class="border-top pt-4 mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success px-4" id="ppid-save-btn">
                        <span class="material-icons" style="font-size: 16px; vertical-align: middle; margin-right: 4px;">save</span> Simpan Informasi Publik
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const container = document.getElementById('accordion-container');
    const btnAdd = document.getElementById('btn-add-accordion');
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
                <button type="button" class="remove-btn-absolute" onclick="removeAccordionField(this)" title="Hapus Item">
                    <span class="material-icons" style="font-size:16px;">delete</span>
                </button>
                <span class="badge badge-success mb-3">Item Baru</span>
                <div class="form-group">
                    <label style="font-size: 12px; font-weight: 700; color: #475569; display: block; margin-bottom: 6px;">Klasifikasi Informasi <span class="text-danger">*</span></label>
                    <select name="accordion_items[\${index}][category]" class="form-control" required>
                        <option value="berkala">Informasi Berkala</option>
                        <option value="serta-merta">Informasi Serta Merta</option>
                        <option value="setiap-saat">Informasi Setiap Saat</option>
                    </select>
                </div>
                <div class="form-group">
                    <label style="font-size: 12px; font-weight: 700; color: #475569; display: block; margin-bottom: 6px;">Judul Informasi <span class="text-danger">*</span></label>
                    <input type="text" name="accordion_items[\${index}][title]" class="form-control" placeholder="Judul..." required>
                </div>
                <div class="form-group mb-0">
                    <label style="font-size: 12px; font-weight: 700; color: #475569; display: block; margin-bottom: 6px;">Detail Isi / Deskripsi <span class="text-danger">*</span></label>
                    <textarea name="accordion_items[\${index}][content]" rows="3" class="form-control" placeholder="Isi deskripsi..." required></textarea>
                </div>
            `;
            container.appendChild(newField);
        });
    }

    function removeAccordionField(button) {
        Swal.fire({
            title: 'Hapus Informasi ini?',
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
                    const select = child.querySelector('select');
                    if (select) select.name = `accordion_items[\${idx}][category]`;
                    
                    const titleInput = child.querySelector('input');
                    if (titleInput) titleInput.name = `accordion_items[\${idx}][title]`;
                    
                    const descTextarea = child.querySelector('textarea');
                    if (descTextarea) descTextarea.name = `accordion_items[\${idx}][content]`;
                    
                    const badge = child.querySelector('.badge');
                    if (badge && !badge.innerText.includes('Baru')) {
                        badge.innerText = `Item \${idx + 1}`;
                    }
                });
            }
        });
    }

    // Submit loading state
    document.getElementById('ppid-form').addEventListener('submit', function() {
        const btn = document.getElementById('ppid-save-btn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-sync-alt fa-spin mr-1"></i> Menyimpan...';
    });
</script>
@endsection
