@extends('admin.layouts.admin')

@section('title', 'Kelola Berita')
@section('header_title', 'Kelola Berita')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/berita.css') }}?v={{ time() }}">
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
            <!-- Form Pencarian & Filter -->
            <form action="{{ route('admin.berita.index') }}" method="GET" class="search-filter-form">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Cari judul berita..." 
                    value="{{ request('search') }}" 
                    class="form-control-input"
                    style="width: 260px;"
                >
                <select name="category" class="form-control-select" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    <option value="Kesehatan" {{ request('category') == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                    <option value="Kegiatan" {{ request('category') == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                    <option value="Pengumuman" {{ request('category') == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                </select>
                @if(request('search') || request('category'))
                    <a href="{{ route('admin.berita.index') }}" class="btn-admin btn-admin-secondary">Reset</a>
                @endif
            </form>

            <!-- Tombol Tambah Berita -->
            <a href="{{ route('admin.berita.create') }}" class="btn-admin btn-admin-primary">
                <span class="material-icons">add</span>
                <span>Tambah Berita Baru</span>
            </a>
        </div>

        <!-- Tabel Data -->
        <div class="admin-table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">Gambar</th>
                        <th>Judul Berita</th>
                        <th style="width: 140px;">Kategori</th>
                        <th style="width: 120px;">Status</th>
                        <th style="width: 130px;">Tanggal</th>
                        <th style="width: 90px; text-align: center;">Dilihat</th>
                        <th style="width: 110px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($beritas as $berita)
                        <tr>
                            <td>
                                @if($berita->image)
                                    <img src="{{ asset('uploads/berita/' . $berita->image) }}" alt="" class="news-thumbnail">
                                @else
                                    <div class="news-thumbnail" style="display: flex; align-items: center; justify-content: center; background-color: #E5E7EB; color: #9CA3AF;">
                                        <span class="material-icons" style="font-size: 20px;">image</span>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div style="font-weight: 700; color: #111827; margin-bottom: 4px;">{{ $berita->title }}</div>
                                <div style="font-size: 12px; color: #9CA3AF;">{{ Str::limit(strip_tags($berita->content), 80) }}</div>
                            </td>
                            <td>
                                <span class="news-badge news-badge-{{ strtolower($berita->category) }}">
                                    {{ $berita->category }}
                                </span>
                            </td>
                            <td>
                                <div class="status-badge status-{{ $berita->status }}">
                                    <span class="status-dot"></span>
                                    <span>{{ $berita->status == 'published' ? 'Diterbitkan' : 'Draf' }}</span>
                                </div>
                            </td>
                            <td>
                                {{ $berita->created_at->format('d M Y') }}
                            </td>
                            <td style="text-align: center; font-weight: 600;">
                                {{ $berita->views }}
                            </td>
                            <td style="text-align: center;">
                                <div class="actions-cell" style="justify-content: center;">
                                    <a href="{{ route('admin.berita.edit', $berita->id) }}" class="btn-action-edit" title="Edit">
                                        <span class="material-icons">edit</span>
                                    </a>
                                    <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
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
                            <td colspan="7" style="text-align: center; padding: 48px; color: #9CA3AF;">
                                <span class="material-icons" style="font-size: 48px; margin-bottom: 12px;">description</span>
                                <p style="font-size: 15px; font-weight: 600;">Belum ada berita yang ditemukan.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginasi -->
        @if($beritas->hasPages())
            <div class="pagination-wrapper">
                {{ $beritas->links() }}
            </div>
        @endif

    </div>
</div>
@endsection
