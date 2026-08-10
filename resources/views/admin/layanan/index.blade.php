@extends('admin.layouts.admin')
@section('title', 'Kelola Layanan Terpadu')
@section('header_title', 'Kelola Layanan Terpadu')

@section('content')
<div class="card card-outline card-success">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between" style="gap: 12px;">
        <span class="d-flex align-items-center" style="gap: 8px;">
            <span class="material-icons text-success">widgets</span>
            <span class="font-weight-bold card-title-label">Kelola Layanan Terpadu</span>
        </span>
    </div>

    <div class="card-body p-0">
        <!-- Toolbar Filters -->
        <div class="p-3 d-flex flex-wrap align-items-center justify-content-between" style="gap: 16px; border-bottom: 1px solid #E2E8F0; background-color: #F8FAFC;">
            <form action="{{ route('admin.layanan.index') }}" method="GET" class="d-flex flex-wrap align-items-center" style="gap: 12px; flex: 1;">
                <!-- Search Input -->
                <div class="input-group" style="max-width: 320px; min-width: 250px;">
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari layanan..." value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-sm btn-success d-flex align-items-center" type="submit">
                            <span class="material-icons" style="font-size: 18px;">search</span>
                        </button>
                    </div>
                </div>

                <!-- Category Filter dropdown -->
                <select name="type" class="form-control form-control-sm" style="max-width: 200px; min-width: 150px;" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    <option value="Warga" {{ request('type') === 'Warga' ? 'selected' : '' }}>Layanan Warga</option>
                    <option value="Faskes" {{ request('type') === 'Faskes' ? 'selected' : '' }}>Layanan Faskes</option>
                    <option value="Nakes" {{ request('type') === 'Nakes' ? 'selected' : '' }}>Layanan Nakes</option>
                </select>

                @if(request('search') || request('type'))
                    <a href="{{ route('admin.layanan.index') }}" class="btn btn-sm btn-outline-secondary d-flex align-items-center" style="gap: 4px;">
                        <span class="material-icons" style="font-size: 16px;">clear</span> Reset
                    </a>
                @endif
            </form>

            <!-- Tambah Layanan Button (Aligned with Search & Filter) -->
            <a href="{{ route('admin.layanan.create') }}" class="btn btn-sm btn-success d-flex align-items-center" style="gap: 4px;">
                <span class="material-icons" style="font-size: 16px;">add</span> Tambah Layanan
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width: 70px; text-align: center;">Icon</th>
                        <th>Nama Layanan</th>
                        <th style="width: 160px; text-align: center;">Segmen Penerima</th>
                        <th style="width: 100px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($layanans as $layanan)
                    <tr>
                        <td style="text-align: center;">
                            <div style="width:38px;height:38px;background:#E6F7F0;color:#009966;border-radius:3px;display:inline-flex;align-items:center;justify-content:center;">
                                @php
                                    $iconMap = ['users'=>'people','smile'=>'sentiment_satisfied_alt','chat'=>'chat','desktop'=>'desktop_windows','bag'=>'shopping_bag','globe'=>'language','file'=>'description'];
                                @endphp
                                <span class="material-icons" style="font-size:20px;">{{ $iconMap[$layanan->icon] ?? 'help_outline' }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="font-weight-bold text-dark">{{ $layanan->name }}</div>
                        </td>
                        <td class="text-center align-middle">
                            @if($layanan->type === 'Warga')
                                <span class="badge" style="background:#DBEAFE;color:#1E40AF;padding:4px 10px;border-radius:3px;font-size:12px;font-weight:700;">Layanan Warga</span>
                            @elseif($layanan->type === 'Faskes')
                                <span class="badge" style="background:#EDE9FE;color:#5B21B6;padding:4px 10px;border-radius:3px;font-size:12px;font-weight:700;">Layanan Faskes</span>
                            @else
                                <span class="badge" style="background:#D1FAE5;color:#065F46;padding:4px 10px;border-radius:3px;font-size:12px;font-weight:700;">Layanan Nakes</span>
                            @endif
                        </td>

                        <td class="text-center align-middle">
                            <div class="btn-action-group">
                                <a href="{{ route('admin.layanan.edit', $layanan->id) }}" class="btn-action btn-action-edit" title="Edit">
                                    <span class="material-icons">edit</span>
                                </a>
                                <form action="{{ route('admin.layanan.destroy', $layanan->id) }}" method="POST" id="del-layanan-{{ $layanan->id }}" style="margin: 0; display: inline;">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn-action btn-action-delete" title="Hapus"
                                        onclick="confirmDelete('del-layanan-{{ $layanan->id }}')">
                                        <span class="material-icons">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center" style="padding: 48px; color: #94A3B8;">
                            <span class="material-icons" style="font-size: 48px; display: block; margin-bottom: 12px; color: #CBD5E1;">widgets</span>
                            <p style="font-size: 15px; font-weight: 600;">Belum ada data layanan terpadu.</p>
                            @if(request('search') || request('type'))
                                <p class="text-muted" style="font-size: 13px;">Tidak ada hasil pencarian yang sesuai.</p>
                            @else
                                <p class="text-muted" style="font-size: 13px;">Klik <strong>"Tambah Layanan"</strong> untuk memulai.</p>
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination Links -->
        @if($layanans->hasPages())
            <div class="card-footer clearfix bg-white border-top p-3">
                <div class="float-right" style="margin: 0;">
                    {{ $layanans->links() }}
                </div>
            </div>
        @endif
    </div>
</div>

@endsection
<<<<<<< HEAD
=======

>>>>>>> fb64eb7397dcfbbeb57f1e50b66e61df95954003
