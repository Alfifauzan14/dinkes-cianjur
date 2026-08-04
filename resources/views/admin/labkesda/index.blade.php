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
                <div style="font-size: 18px; font-weight: 800; color: #004F3B;">Daftar Layanan Labkesda</div>
                <div style="font-size: 13px; color: #6B7280; margin-top: 4px;">Kelola kategori layanan pengujian laboratorium.</div>
            </div>
            <div style="display: flex; gap: 10px;">
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
                        <th style="width: 80px; text-align: center;">No. Urut</th>
                        <th style="width: 140px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
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
                                <input type="number" 
                                    class="order-input" 
                                    value="{{ $category->order_index }}" 
                                    data-id="{{ $category->id }}"
                                    min="1"
                                    style="width: 60px; text-align: center; font-weight: 700; color: #004F3B; border: 1px solid #E5E7EB; border-radius: 3px; padding: 4px 8px; font-size: 14px;">
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('.order-input');
    
    inputs.forEach(input => {
        let originalValue = input.value;
        
        input.addEventListener('focus', function() {
            originalValue = this.value;
        });
        
        input.addEventListener('blur', function() {
            const newValue = this.value;
            const id = this.dataset.id;
            
            if (newValue !== originalValue && newValue !== '') {
                fetch(`{{ url('admin/labkesda') }}/${id}/order`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ order_index: parseInt(newValue) })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        this.value = originalValue;
                        alert('Gagal memperbarui urutan: ' + (data.message || 'Terjadi kesalahan'));
                    }
                })
                .catch(error => {
                    this.value = originalValue;
                    console.error('Error:', error);
                });
            } else if (newValue === '') {
                this.value = originalValue;
            }
        });
        
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                this.blur();
            }
        });
    });
});
</script>
@endsection
