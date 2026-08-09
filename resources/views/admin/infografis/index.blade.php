@extends('admin.layouts.admin')
@section('title', 'Kelola Infografis')
@section('header_title', 'Kelola Infografis')

@section('content')
<div class="card card-outline card-success">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between" style="gap: 12px; padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
        <span class="d-flex align-items-center" style="gap: 8px;">
            <span class="material-icons text-success">bar_chart</span>
            <span class="font-weight-bold card-title-label">Kelola Infografis</span>
        </span>

        {{-- Search --}}
        <form action="{{ route('admin.infografis.index') }}" method="GET" class="d-flex align-items-center" style="gap: 8px; flex-wrap: wrap;">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Cari judul infografis..." style="width: 240px;">
            <button type="submit" class="btn btn-sm btn-outline-success">Cari</button>
            @if(request('search'))
                <a href="{{ route('admin.infografis.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
            @endif
        </form>

        <a href="{{ route('admin.infografis.create') }}" class="btn btn-sm btn-success ml-auto" style="white-space:nowrap;">
            <span class="material-icons" style="font-size:16px;">add</span> Tambah Infografis
        </a>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width:100px;">Poster</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th style="width:170px;">Tanggal</th>
                        <th class="text-center" style="width:100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($infografis as $item)
                    <tr>
                        <td>
                            <img src="{{ asset('uploads/infografis/' . $item->image) }}" alt="{{ $item->title }}"
                                style="width:65px;height:90px;object-fit:cover;border-radius:3px;border:1px solid #E5E7EB;">
                        </td>
                        <td class="font-weight-bold text-dark align-middle">{{ $item->title }}</td>
                        <td class="align-middle text-secondary" style="max-width:260px;">
                            {{ $item->description ? Str::limit($item->description, 80) : '—' }}
                        </td>
                        <td class="text-secondary align-middle">{{ $item->created_at->format('d M Y H:i') }}</td>
                        <td class="text-center align-middle">
                            <div class="btn-action-group">
                                <a href="{{ route('admin.infografis.edit', $item->id) }}"
                                    class="btn-action btn-action-edit" title="Edit">
                                    <span class="material-icons" style="font-size:16px;">edit</span>
                                </a>
                                <form action="{{ route('admin.infografis.destroy', $item->id) }}" method="POST" id="del-infografis-{{ $item->id }}" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn-action btn-action-delete" title="Hapus"
                                        onclick="confirmDelete('del-infografis-{{ $item->id }}')">
                                        <span class="material-icons" style="font-size:16px;">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <span class="material-icons" style="font-size:48px;display:block;margin-bottom:8px;color:#D1D5DB;">bar_chart</span>
                            Belum ada infografis yang diunggah.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer">{{ $infografis->links() }}</div>
</div>
@endsection
