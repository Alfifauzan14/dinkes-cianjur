@extends('admin.layouts.admin')

@section('title', 'Kelola Pagoda Sehat')
@section('header_title', 'Kelola Pagoda Sehat')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/pagodasehat.css') }}?v={{ time() }}">
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
                <div style="font-size: 18px; font-weight: 800; color: #004F3B;">Kelola Pagoda Sehat</div>
                <div style="font-size: 14px; color: #6B7280; margin-top: 4px;">Kelola kartu portal akses layanan kesehatan.</div>
            </div>
            <div style="display: flex; gap: 10px;">
                <button type="button" id="btn-save-order" class="btn-admin btn-admin-primary" style="display: none; background-color: #004F3B;" onclick="saveNewOrder('pagodasehat')">
                    <span class="material-icons">save</span>
                    <span>Simpan Urutan</span>
                </button>
                <a href="{{ route('admin.pagodasehat.create') }}" class="btn-admin btn-admin-primary">
                    <span class="material-icons">add</span>
                    <span>Tambah Kartu Baru</span>
                </a>
            </div>
        </div>

        <div class="admin-table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 70px; text-align: center;">Gambar</th>
                        <th>Judul Kartu</th>
                        <th>Deskripsi</th>
                        <th>Link</th>
                        <th style="width: 80px; text-align: center;">Urutan</th>
                        <th style="width: 140px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cards as $card)
                        <tr class="order-row" data-id="{{ $card->id }}">
                            <td style="text-align: center;">
                                <div style="width: 48px; height: 48px; background-color: #F3F4F6; border-radius: 3px; display: inline-flex; align-items: center; justify-content: center; overflow: hidden;">
                                    @if($card->image)
                                        @if(str_starts_with($card->image, 'Assets/'))
                                            <img src="{{ asset($card->image) }}" alt="{{ $card->title }}" style="width: 100%; height: 100%; object-fit: contain;">
                                        @else
                                            <img src="{{ asset('storage/' . $card->image) }}" alt="{{ $card->title }}" style="width: 100%; height: 100%; object-fit: contain;">
                                        @endif
                                    @else
                                        <span class="material-icons" style="font-size: 24px; color: #CBD5E1;">image</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div style="font-weight: 700; color: #111827;">{{ $card->title }}</div>
                            </td>
                            <td>
                                <div style="font-size: 13px; color: #6B7280; max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $card->description ?: '-' }}</div>
                            </td>
                            <td>
                                @if($card->url)
                                    <span style="color: #009966; font-size: 13px; word-break: break-all;">{{ $card->url }}</span>
                                @else
                                    <span style="color: #94A3B8; font-style: italic; font-size: 13px;">-</span>
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
                                    <a href="{{ route('admin.pagodasehat.edit', $card->id) }}" class="btn-action-edit" title="Edit">
                                        <span class="material-icons">edit</span>
                                    </a>
                                    <form action="{{ route('admin.pagodasehat.destroy', $card->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kartu ini?');" style="margin: 0; display: inline;">
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
                            <td colspan="6" style="padding: 40px; text-align: center; color: #94A3B8;">
                                <span class="material-icons" style="font-size: 40px; display: block; margin-bottom: 8px; color: #CBD5E1;">dashboard</span>
                                Belum ada kartu Pagoda Sehat. Klik <strong>"Tambah Kartu Baru"</strong> untuk memulai.
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
