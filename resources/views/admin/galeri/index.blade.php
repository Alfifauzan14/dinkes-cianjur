@extends('admin.layouts.admin')

@section('title', 'Kelola Galeri')
@section('header_title', 'Kelola Galeri Kegiatan')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/galeri.css') }}?v={{ time() }}">
@endsection

@section('content')
<div class="agenda-admin-wrapper">
    
    @if(session('success'))
        <div class="admin-alert admin-alert-success" style="background-color: #ECFDF5; color: #047857; border: 1px solid #A7F3D0; padding: 12px; border-radius: 3px; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
            <span class="material-icons">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="admin-card">
        <div class="card-header-actions">
            <!-- Form Pencarian & Filter -->
            <form action="{{ route('admin.galeri.index') }}" method="GET" class="search-filter-form">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Cari judul galeri..." 
                    value="{{ request('search') }}" 
                    class="form-control-input"
                    style="width: 260px;"
                >
                <select name="category" class="form-control-select" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    <option value="PROGRAM" {{ request('category') == 'PROGRAM' ? 'selected' : '' }}>PROGRAM</option>
                    <option value="KEGIATAN" {{ request('category') == 'KEGIATAN' ? 'selected' : '' }}>KEGIATAN</option>
                    <option value="NASIONAL" {{ request('category') == 'NASIONAL' ? 'selected' : '' }}>NASIONAL</option>
                </select>
                @if(request('search') || request('category'))
                    <a href="{{ route('admin.galeri.index') }}" class="btn-admin btn-admin-secondary">Reset</a>
                @endif
            </form>

            <!-- Tombol Tambah Galeri -->
            <a href="{{ route('admin.galeri.create') }}" class="btn-admin btn-admin-primary">
                <span class="material-icons">add</span>
                <span>Tambah Foto Baru</span>
            </a>
        </div>

        <!-- Tabel Data -->
        <div class="admin-table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 100px;">Foto</th>
                        <th>Judul Galeri</th>
                        <th style="width: 150px;">Kategori</th>
                        <th style="width: 180px;">Tanggal Dibuat</th>
                        <th style="width: 110px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($galeris as $galeri)
                        <tr>
                            <td>
                                @if(file_exists(public_path('uploads/galeri/' . $galeri->image)))
                                    <img src="{{ asset('uploads/galeri/' . $galeri->image) }}" alt="" class="gallery-thumbnail">
                                @else
                                    <img src="{{ asset('images/' . $galeri->image) }}" alt="" class="gallery-thumbnail">
                                @endif
                            </td>
                            <td style="font-weight: 700; color: #111827;">
                                {{ $galeri->title }}
                            </td>
                            <td style="font-weight: 600; color: #374151;">
                                <span class="badge" style="background-color: #E0F2FE; color: #0369A1; padding: 4px 8px; border-radius: 3px; font-size: 11px;">
                                    {{ $galeri->category }}
                                </span>
                            </td>
                            <td style="color: #4B5563;">
                                {{ $galeri->created_at->format('d M Y H:i') }}
                            </td>
                            <td style="text-align: center;">
                                <div class="actions-cell" style="justify-content: center; display: flex; gap: 8px;">
                                    <a href="{{ route('admin.galeri.edit', $galeri->id) }}" class="btn-action-edit" title="Edit" style="color: #009966;">
                                        <span class="material-icons">edit</span>
                                    </a>
                                    <form action="{{ route('admin.galeri.destroy', $galeri->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto galeri ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action-delete" title="Hapus" style="color: #EF4444; background: none; border: none; cursor: pointer;">
                                            <span class="material-icons">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 48px; color: #9CA3AF;">
                                <span class="material-icons" style="font-size: 48px; margin-bottom: 8px;">collections</span>
                                <p style="font-weight: 600;">Belum ada foto galeri kegiatan yang diunggah.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginasi -->
        <div style="margin-top: 24px;">
            {{ $galeris->links() }}
        </div>
    </div>
</div>
@endsection
