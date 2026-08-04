@extends('admin.layouts.admin')
@section('title', 'Kelola Berita')
@section('header_title', 'Kelola Berita')

@section('content')
<div class="card card-outline card-success">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between" style="gap: 16px; padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
        {{-- Search & Filter --}}
        <form action="{{ route('admin.berita.index') }}" method="GET" class="d-flex flex-wrap align-items-center" style="gap: 8px;">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Cari judul berita..." style="width: 220px;">
            <select name="category" class="custom-select custom-select-sm" onchange="this.form.submit()" style="width: 150px;">
                <option value="">Semua Kategori</option>
                <option value="Kesehatan"  {{ request('category') == 'Kesehatan'  ? 'selected' : '' }}>Kesehatan</option>
                <option value="Kegiatan"   {{ request('category') == 'Kegiatan'   ? 'selected' : '' }}>Kegiatan</option>
                <option value="Pengumuman" {{ request('category') == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
            </select>
            @if(request('search') || request('category'))
                <a href="{{ route('admin.berita.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
            @endif
        </form>

        <a href="{{ route('admin.berita.create') }}" class="btn btn-sm btn-success">
            <span class="material-icons" style="font-size:16px;">add</span> Tulis Berita
        </a>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width:80px;">Gambar</th>
                        <th>Judul Berita</th>
                        <th style="width:130px;">Kategori</th>
                        <th style="width:110px;">Status</th>
                        <th style="width:120px;">Tanggal</th>
                        <th class="text-center" style="width:100px;">Dilihat</th>
                        <th class="text-center" style="width:100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($beritas as $berita)
                    <tr>
                        <td class="align-middle">
                            @if($berita->image)
                                <img src="{{ asset('uploads/berita/' . $berita->image) }}" alt="{{ $berita->title }}"
                                    style="width:65px;height:48px;object-fit:cover;border-radius:3px;border:1px solid #E5E7EB;">
                            @else
                                <div style="width:65px;height:48px;background:#F1F5F9;display:flex;align-items:center;justify-content:center;border-radius:3px;border:1px solid #E5E7EB;">
                                    <span class="material-icons text-muted" style="font-size:20px;">image</span>
                                </div>
                            @endif
                        </td>
                        <td class="align-middle">
                            <div class="font-weight-bold text-dark">{{ $berita->title }}</div>
                            <small class="text-muted">{{ Str::limit(strip_tags($berita->content), 75) }}</small>
                        </td>
                        <td class="align-middle">
                            @php
                                $catColors = ['Kesehatan'=>['bg'=>'#DEF7EC','color'=>'#03543F'],'Kegiatan'=>['bg'=>'#E0F2FE','color'=>'#0369A1'],'Pengumuman'=>['bg'=>'#FEF3C7','color'=>'#92400E']];
                                $cat = $catColors[$berita->category] ?? ['bg'=>'#F1F5F9','color'=>'#475569'];
                            @endphp
                            <span class="badge" style="padding:4px 10px;border-radius:3px;font-size:11px;font-weight:700;" @style(['background: ' . $cat['bg'], 'color: ' . $cat['color']])>
                                {{ $berita->category }}
                            </span>
                        </td>
                        <td class="align-middle">
                            @if($berita->status == 'published')
                                <span class="badge" style="background:#DEF7EC;color:#03543F;padding:4px 10px;border-radius:3px;">
                                    <span style="display:inline-block;width:6px;height:6px;background:#31C48D;border-radius:50%;margin-right:3px;vertical-align:middle;"></span>
                                    Diterbitkan
                                </span>
                            @else
                                <span class="badge" style="background:#F3F4F6;color:#6B7280;padding:4px 10px;border-radius:3px;">
                                    <span style="display:inline-block;width:6px;height:6px;background:#D1D5DB;border-radius:50%;margin-right:3px;vertical-align:middle;"></span>
                                    Draf
                                </span>
                            @endif
                        </td>
                        <td class="text-secondary align-middle">{{ $berita->created_at->format('d M Y') }}</td>
                        <td class="text-center align-middle">
                            <a href="{{ route('berita.show', $berita->slug) }}" target="_blank" class="text-decoration-none view-count-link" data-id="{{ $berita->id }}" title="Klik untuk lihat portal utama (menambah views)">
                                <span class="badge" style="background:#F1F5F9;color:#475569;padding:6px 10px;border-radius:3px;font-size:12px;font-weight:600;display:inline-flex;align-items:center;gap:4px;">
                                    <span class="material-icons text-muted" style="font-size:14px;vertical-align:middle;">visibility</span>
                                    <span class="views-num">{{ $berita->views }}</span>
                                </span>
                            </a>
                        </td>
                        <td class="text-center align-middle">
                            <div class="btn-action-group">
                                <a href="{{ route('admin.berita.edit', $berita->id) }}" class="btn-action btn-action-edit" title="Edit">
                                    <span class="material-icons" style="font-size:16px;">edit</span>
                                </a>
                                <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" id="del-berita-{{ $berita->id }}" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn-action btn-action-delete" title="Hapus"
                                        onclick="confirmDelete('del-berita-{{ $berita->id }}')">
                                        <span class="material-icons" style="font-size:16px;">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <span class="material-icons" style="font-size:48px;display:block;margin-bottom:8px;color:#D1D5DB;">newspaper</span>
                            Belum ada berita yang ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($beritas->hasPages())
    <div class="card-footer">{{ $beritas->links() }}</div>
    @endif
</div>
@endsection
