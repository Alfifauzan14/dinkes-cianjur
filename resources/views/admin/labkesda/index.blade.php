@extends('admin.layouts.admin')

@section('title', 'Kelola Labkesda')
@section('header_title', 'Kelola Labkesda')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/labkesda.css') }}?v={{ time() }}">
@endsection

@section('content')
<div class="berita-admin-wrapper">

    @if(session('success'))
        <div class="admin-alert admin-alert-success">
            <span class="material-icons">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="admin-card">
        <div class="card-header-actions">
            <div>
                <div style="font-size: 18px; font-weight: 800; color: #004F3B;">Kelola Layanan Labkesda</div>
                <div style="font-size: 14px; color: #6B7280; margin-top: 4px;">Kelola kategori layanan pengujian laboratorium.</div>
            </div>
            <div style="display: flex; gap: 10px;">
                <button type="button" id="btn-save-order" class="btn-admin btn-admin-primary" style="display: none; background-color: #004F3B;" onclick="saveNewOrder('labkesda')">
                    <span class="material-icons">save</span>
                    <span>Simpan Urutan</span>
                </button>
                <a href="{{ route('admin.labkesda.settings.edit') }}" class="btn-admin btn-admin-secondary">
                    <span class="material-icons">contact_support</span>
                    <span>Edit Kontak & Alamat</span>
                </a>
                <a href="{{ route('admin.labkesda.create') }}" class="btn-admin btn-admin-primary">
                    <span class="material-icons">add</span>
                    <span>Tambah Layanan Baru</span>
                </a>
            </div>
        </div>

        <div class="admin-table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 70px; text-align: center;">Icon</th>
                        <th>Judul Layanan</th>
                        <th style="width: 200px;">Badge</th>
                        <th style="width: 80px; text-align: center;">Urutan</th>
                        <th style="width: 140px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr class="order-row" data-id="{{ $category->id }}">
                            <td style="text-align: center;">
                                <div style="width: 36px; height: 36px; background-color: #E6F7F0; color: #009966; border-radius: 3px; display: inline-flex; align-items: center; justify-content: center;">
                                    <span class="material-icons" style="font-size: 20px;">{{ $category->icon_name }}</span>
                                </div>
                            </td>
                            <td>
                                <div style="font-weight: 700; color: #111827;">{{ $category->title }}</div>
                                @if($category->description)
                                    <div style="font-size: 12px; color: #6B7280; margin-top: 2px; max-width: 420px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $category->description }}</div>
                                @endif
                            </td>
                            <td>
                                @if($category->badge_text)
                                    <span style="background-color: #E6F7F0; color: #009966; padding: 4px 8px; border-radius: 3px; font-size: 12px; font-weight: 700;">{{ $category->badge_text }}</span>
                                @else
                                    <span style="color: #94A3B8; font-style: italic; font-size: 13px;">Tidak ada</span>
                                @endif
                            </td>
                            <td style="text-align: center;">
                                <div style="display: inline-flex; gap: 2px;">
                                    <button type="button" class="btn-order-move btn-move-up" onclick="moveRow(this, 'up')" title="Pindah ke atas" {{ $loop->first ? 'disabled' : '' }}>
                                        <span class="material-icons" style="font-size: 18px;">keyboard_arrow_up</span>
                                    </button>
                                    <button type="button" class="btn-order-move btn-move-down" onclick="moveRow(this, 'down')" title="Pindah ke bawah" {{ $loop->last ? 'disabled' : '' }}>
                                        <span class="material-icons" style="font-size: 18px;">keyboard_arrow_down</span>
                                    </button>
                                </div>
                            </td>
                            <td style="text-align: center;">
                                <div class="actions-cell" style="justify-content: center;">
                                    <a href="{{ route('admin.labkesda.edit', $category->id) }}" class="btn-action-edit" title="Edit">
                                        <span class="material-icons">edit</span>
                                    </a>
                                    <form action="{{ route('admin.labkesda.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan ini beserta seluruh itemnya?');" style="margin: 0; display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action-delete" title="Hapus">
                                            <span class="material-icons">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding: 40px; text-align: center; color: #94A3B8;">
                                <span class="material-icons" style="font-size: 40px; display: block; margin-bottom: 8px; color: #CBD5E1;">science</span>
                                Belum ada data layanan Labkesda. Klik <strong>"Tambah Layanan Baru"</strong> untuk memulai.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<style>
.btn-order-move {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border: 1px solid #D1D5DB;
    border-radius: 3px;
    background: #FFFFFF;
    color: #009966;
    cursor: pointer;
    padding: 0;
    transition: all 0.2s ease;
}
.btn-order-move:hover:not(:disabled) {
    background-color: #E6F7F0;
    border-color: #009966;
}
.btn-order-move:disabled {
    opacity: 0.3;
    cursor: not-allowed;
    color: #9CA3AF;
}
@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}
.spinner {
    animation: spin 1s linear infinite;
}
</style>
<script>
function moveRow(button, direction) {
    const row = button.closest('.order-row');
    if (!row) return;
    
    if (direction === 'up') {
        const prev = row.previousElementSibling;
        if (prev && prev.classList.contains('order-row')) {
            row.parentNode.insertBefore(row, prev);
        }
    } else {
        const next = row.nextElementSibling;
        if (next && next.classList.contains('order-row')) {
            row.parentNode.insertBefore(next, row);
        }
    }
    
    updateRowButtons();
    // Show the "Simpan Urutan" button
    document.getElementById('btn-save-order').style.display = 'inline-flex';
}

function updateRowButtons() {
    const rows = document.querySelectorAll('.order-row');
    rows.forEach((row, index) => {
        const upBtn = row.querySelector('.btn-move-up');
        const downBtn = row.querySelector('.btn-move-down');
        
        if (upBtn) upBtn.disabled = (index === 0);
        if (downBtn) downBtn.disabled = (index === rows.length - 1);
    });
}

function saveNewOrder(type) {
    const rows = document.querySelectorAll('.order-row');
    const ids = Array.from(rows).map(row => row.getAttribute('data-id'));
    
    const saveBtn = document.getElementById('btn-save-order');
    saveBtn.disabled = true;
    saveBtn.innerHTML = '<span class="material-icons spinner" style="font-size:16px;">sync</span><span>Menyimpan...</span>';

    fetch('{{ url("admin") }}/' + type + '/reorder', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ ids: ids })
    })
    .then(function(response) { return response.json(); })
    .then(function(data) {
        if (data.success) {
            location.reload();
        } else {
            alert('Gagal menyimpan urutan.');
            saveBtn.disabled = false;
            saveBtn.innerHTML = '<span class="material-icons">save</span><span>Simpan Urutan</span>';
        }
    })
    .catch(function(error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menyimpan urutan.');
        saveBtn.disabled = false;
        saveBtn.innerHTML = '<span class="material-icons">save</span><span>Simpan Urutan</span>';
    });
}
</script>
@endsection
