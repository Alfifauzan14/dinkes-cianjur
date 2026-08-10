@extends('admin.layouts.admin')

@section('title', 'Kelola Pagoda Sehat')
@section('header_title', 'Kelola Pagoda Sehat')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" style="gap:8px; margin-bottom:16px;">
        <span class="material-icons">check_circle</span>
        <span>{{ session('success') }}</span>
        <button type="button" class="close ml-auto" data-dismiss="alert"><span>&times;</span></button>
    </div>
@endif

<div class="card card-outline card-success">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between" style="gap: 12px;">
        <span class="d-flex align-items-center" style="gap: 8px;">
            <span class="material-icons text-success">dashboard</span>
            <span class="font-weight-bold card-title-label">Kelola Pagoda Sehat</span>
        </span>
        <div class="d-flex align-items-center" style="gap: 8px;">
            <button type="button" id="btn-save-order" class="btn btn-sm btn-success" style="display: none;" onclick="saveNewOrder('pagodasehat')">
                <span class="material-icons" style="font-size:16px;">save</span> Simpan Urutan
            </button>
            <a href="{{ route('admin.pagodasehat.create') }}" class="btn btn-sm btn-success">
                <span class="material-icons" style="font-size:16px;">add</span> Tambah Kartu Baru
            </a>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width: 70px; text-align: center;">Gambar</th>
                        <th>Judul Kartu</th>
                        <th>Deskripsi</th>
                        <th>Link</th>
                        <th style="width: 80px; text-align: center;">Urutan</th>
                        <th style="width: 120px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cards as $card)
                        <tr class="order-row" data-id="{{ $card->id }}">
                            <td class="text-center align-middle">
                                <div style="width: 48px; height: 48px; background-color: #F3F4F6; border-radius: 3px; display: inline-flex; align-items: center; justify-content: center; overflow: hidden;">
                                    @if($card->image)
                                        @if(str_starts_with($card->image, 'Assets/'))
                                            <img src="{{ asset($card->image) }}" alt="{{ $card->title }}" style="width: 100%; height: 100%; object-fit: contain;">
                                        @else
                                            <img src="{{ asset('storage/' . $card->image) }}" alt="{{ $card->title }}" style="width: 100%; height: 100%; object-fit: contain;">
                                        @endif
                                    @else
                                        <span class="material-icons text-muted" style="font-size: 24px;">image</span>
                                    @endif
                                </div>
                            </td>
                            <td class="align-middle">
                                <div class="font-weight-bold text-dark">{{ $card->title }}</div>
                            </td>
                            <td class="align-middle">
                                <div class="text-muted" style="font-size: 13px; max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $card->description ?: '-' }}</div>
                            </td>
                            <td class="align-middle">
                                @if($card->url)
                                    <a href="{{ $card->url }}" target="_blank" class="text-success" style="font-size: 13px; word-break: break-all;">{{ Str::limit($card->url, 35) }}</a>
                                @else
                                    <span class="text-muted" style="font-style: italic; font-size: 13px;">-</span>
                                @endif
                            </td>
                            <td class="text-center align-middle">
                                <div class="d-inline-flex" style="gap: 2px;">
                                    <button type="button" class="btn-order-move btn-move-up" onclick="moveRow(this, 'up')" title="Pindah ke atas" {{ $loop->first ? 'disabled' : '' }}>
                                        <span class="material-icons" style="font-size: 18px;">keyboard_arrow_up</span>
                                    </button>
                                    <button type="button" class="btn-order-move btn-move-down" onclick="moveRow(this, 'down')" title="Pindah ke bawah" {{ $loop->last ? 'disabled' : '' }}>
                                        <span class="material-icons" style="font-size: 18px;">keyboard_arrow_down</span>
                                    </button>
                                </div>
                            </td>
                            <td class="text-center align-middle">
                                <div class="btn-action-group">
                                    <a href="{{ route('admin.pagodasehat.edit', $card->id) }}" class="btn-action btn-action-edit" title="Edit">
                                        <span class="material-icons">edit</span>
                                    </a>
                                    <form action="{{ route('admin.pagodasehat.destroy', $card->id) }}" method="POST" id="del-pagodasehat-{{ $card->id }}" style="margin: 0; display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn-action btn-action-delete" title="Hapus" onclick="confirmDelete('del-pagodasehat-{{ $card->id }}')">
                                            <span class="material-icons">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center" style="padding: 48px; color: #94A3B8;">
                                <span class="material-icons" style="font-size: 48px; display: block; margin-bottom: 12px; color: #CBD5E1;">dashboard</span>
                                <p style="font-size: 15px; font-weight: 600;">Belum ada kartu Pagoda Sehat.</p>
                                <p class="text-muted" style="font-size: 13px;">Klik <strong>"Tambah Kartu Baru"</strong> untuk memulai.</p>
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
    width: 30px;
    height: 30px;
    border: 1px solid #D1D5DB;
    border-radius: 6px;
    background: #FFFFFF;
    color: #009966;
    cursor: pointer;
    padding: 0;
    transition: all 0.18s ease;
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
.spinner { animation: spin 1s linear infinite; }
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
    saveBtn.innerHTML = '<span class="material-icons spinner" style="font-size:16px;">sync</span><span> Menyimpan...</span>';

    fetch('{{ url("admin") }}/' + type + '/reorder', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ ids: ids })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Gagal menyimpan urutan.');
            saveBtn.disabled = false;
            saveBtn.innerHTML = '<span class="material-icons">save</span><span> Simpan Urutan</span>';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menyimpan urutan.');
        saveBtn.disabled = false;
        saveBtn.innerHTML = '<span class="material-icons">save</span><span> Simpan Urutan</span>';
    });
}
</script>
@endsection
