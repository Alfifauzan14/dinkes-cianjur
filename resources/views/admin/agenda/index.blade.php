@extends('admin.layouts.admin')

@section('title', 'Kelola Agenda')
@section('header_title', 'Kelola Agenda Kegiatan')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/agenda.css') }}?v={{ time() }}">
@endsection

@section('content')
<div class="agenda-admin-wrapper">
    
    @if(session('success'))
        <div class="admin-alert admin-alert-success">
            <span class="material-icons">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="admin-card">
        <div class="card-header-actions">
            <!-- Form Pencarian & Filter -->
            <form action="{{ route('admin.agenda.index') }}" method="GET" class="search-filter-form">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Cari agenda atau lokasi..." 
                    value="{{ request('search') }}" 
                    class="form-control-input"
                    style="width: 260px;"
                >
                <select name="status" class="form-control-select" onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Diterbitkan</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draf</option>
                </select>
                @if(request('search') || request('status'))
                    <a href="{{ route('admin.agenda.index') }}" class="btn-admin btn-admin-secondary">Reset</a>
                @endif
            </form>

            <div style="display: flex; gap: 8px;">
                <a href="{{ route('admin.agenda.import_form') }}" class="btn-admin btn-admin-secondary">
                    <span class="material-icons">upload_file</span>
                    <span>Impor CSV</span>
                </a>
                <a href="{{ route('admin.agenda.create') }}" class="btn-admin btn-admin-primary">
                    <span class="material-icons">add</span>
                    <span>Tambah Agenda Baru</span>
                </a>
            </div>
        </div>

        <!-- Tabel Data -->
        <div class="admin-table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Nama Agenda / Kegiatan</th>
                        <th style="width: 140px;">Tanggal</th>
                        <th style="width: 130px;">Waktu</th>
                        <th style="width: 180px;">Tempat / Lokasi</th>
                        <th style="width: 120px;">Status</th>
                        <th style="width: 110px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($agendas as $agenda)
                        <tr>
                            <td>
                                <div style="font-weight: 700; color: #111827; margin-bottom: 4px;">{{ $agenda->title }}</div>
                                <div style="font-size: 12px; color: #9CA3AF;">{{ Str::limit($agenda->description, 100) }}</div>
                            </td>
                            <td style="font-weight: 600; color: #374151;">
                                {{ $agenda->date->format('d M Y') }}
                            </td>
                            <td style="font-weight: 600; color: #4B5563;">
                                {{ $agenda->time_start }} - {{ $agenda->time_end }}
                            </td>
                            <td style="color: #4B5563;">
                                <div style="display: flex; align-items: center; gap: 4px;">
                                    <span class="material-icons" style="font-size: 16px; color: #009966;">place</span>
                                    <span>{{ $agenda->location }}</span>
                                </div>
                            </td>
                            <td>
                                @if($agenda->isPending())
                                    <div class="status-badge status-pending">
                                        <span class="status-dot"></span>
                                        <span>Menunggu Hari</span>
                                    </div>
                                @else
                                    <div class="status-badge status-{{ $agenda->status }}">
                                        <span class="status-dot"></span>
                                        <span>{{ $agenda->status == 'published' ? 'Diterbitkan' : 'Draf' }}</span>
                                    </div>
                                @endif
                            </td>
                            <td style="text-align: center;">
                                <div class="actions-cell" style="justify-content: center;">
                                    <a href="{{ route('admin.agenda.edit', $agenda->id) }}" class="btn-action-edit" title="Edit">
                                        <span class="material-icons">edit</span>
                                    </a>
                                    <form action="{{ route('admin.agenda.destroy', $agenda->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus agenda ini?')">
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
                            <td colspan="6" style="text-align: center; padding: 48px; color: #9CA3AF;">
                                <span class="material-icons" style="font-size: 48px; margin-bottom: 12px;">event_busy</span>
                                <p style="font-size: 15px; font-weight: 600;">Belum ada agenda kegiatan yang terdaftar.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginasi -->
        @if($agendas->hasPages())
            <div class="pagination-wrapper">
                {{ $agendas->links() }}
            </div>
        @endif

    </div>
</div>
@endsection
