@extends('admin.layouts.admin')

@section('title', 'Kelola Faskes')
@section('header_title', 'Kelola Fasilitas Kesehatan')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/berita.css') }}?v={{ time() }}">
    <style>
        .faskes-type-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }
        .faskes-type-rs {
            background-color: #FEE2E2;
            color: #DC2626;
        }
        .faskes-type-pk {
            background-color: #D1FAE5;
            color: #059669;
        }
        .faskes-akreditasi-badge {
            display: inline-flex;
            align-items: center;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
            background-color: #DBEAFE;
            color: #1D4ED8;
        }
        .faskes-coord {
            font-size: 11px;
            color: #6B7280;
            font-family: monospace;
        }
    </style>
@endsection

@section('content')
<div class="berita-admin-wrapper">

    @if(session('success'))
        <div class="admin-alert admin-alert-success">
            <span class="material-icons">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="admin-alert admin-alert-danger" style="background:#FEE2E2; color:#B91C1C; padding:12px 16px; border-radius:6px; margin-bottom:16px; display:flex; align-items:center; gap:8px;">
            <span class="material-icons">error</span>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <div class="admin-card">
        <div class="card-header-actions d-flex align-items-center" style="gap: 16px; flex-wrap: wrap;">
            <form action="{{ route('admin.faskes.index') }}" method="GET" class="search-filter-form d-flex align-items-center" style="gap: 8px; flex-wrap: wrap;">
                <input
                    type="text"
                    name="search"
                    placeholder="Cari nama faskes..."
                    value="{{ request('search') }}"
                    class="form-control-input"
                    style="width: 180px; padding: 6px 12px; border: 1px solid #D1D5DB; border-radius: 4px;"
                >
                <select name="kecamatan" class="form-control-select" onchange="this.form.submit()" style="padding: 6px 12px; border: 1px solid #D1D5DB; border-radius: 4px;">
                    <option value="Semua">Semua Kecamatan</option>
                    @foreach($kecamatans as $kec)
                        <option value="{{ $kec->name }}" {{ request('kecamatan') == $kec->name ? 'selected' : '' }}>{{ $kec->name }}</option>
                    @endforeach
                </select>
                <select name="type" class="form-control-select" onchange="this.form.submit()" style="padding: 6px 12px; border: 1px solid #D1D5DB; border-radius: 4px;">
                    <option value="Semua">Semua Jenis</option>
                    @foreach($types as $t)
                        <option value="{{ $t->name }}" {{ request('type') == $t->name ? 'selected' : '' }}>{{ $t->name }}</option>
                    @endforeach
                </select>
                @if(request('search') || request('kecamatan', 'Semua') !== 'Semua' || request('type', 'Semua') !== 'Semua')
                    <a href="{{ route('admin.faskes.index') }}" class="btn-admin btn-admin-secondary">Reset</a>
                @endif
            </form>

            <div class="d-flex align-items-center ml-auto" style="gap: 8px; flex-wrap: wrap;">
                <!-- Import CSV -->
                <form action="{{ route('admin.faskes.import') }}" method="POST" enctype="multipart/form-data" class="d-inline-block m-0">
                    @csrf
                    <label class="btn-admin btn-admin-secondary mb-0" style="cursor: pointer; padding: 6px 12px; white-space: nowrap;">
                        <span class="material-icons" style="font-size:16px; vertical-align:middle;">upload_file</span>
                        <span>Impor CSV</span>
                        <input type="file" name="csv_file" accept=".csv,.txt" style="display: none;" onchange="this.form.submit()">
                    </label>
                </form>

                <!-- Export CSV -->
                <a href="{{ route('admin.faskes.export') }}" class="btn-admin btn-admin-secondary" style="padding: 6px 12px; white-space: nowrap;">
                    <span class="material-icons" style="font-size:16px; vertical-align:middle;">download</span>
                    <span>Ekspor CSV</span>
                </a>

                <a href="{{ route('admin.faskes.create') }}" class="btn-admin btn-admin-primary" style="padding: 6px 12px; white-space: nowrap;">
                    <span class="material-icons" style="font-size:16px; vertical-align:middle;">add</span>
                    <span>Tambah Faskes</span>
                </a>
            </div>
        </div>


        <div class="admin-table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 50px; text-align: center;">No</th>
                        <th style="width: 110px;">Jenis</th>
                        <th>Nama Faskes</th>
                        <th style="width: 130px;">Kecamatan</th>
                        <th style="width: 140px;">Telepon</th>
                        <th style="width: 110px;">Akreditasi</th>
                        <th style="width: 110px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($faskes as $item)
                        <tr>
                            <td style="text-align: center;">{{ ($faskes->currentPage() - 1) * $faskes->perPage() + $loop->iteration }}</td>
                            <td>
                                @if($item->type === 'Rumah Sakit')
                                    <span class="faskes-type-badge faskes-type-rs">
                                        <span class="material-icons" style="font-size: 14px;">local_hospital</span>
                                        RS
                                    </span>
                                @else
                                    <span class="faskes-type-badge faskes-type-pk">
                                        <span class="material-icons" style="font-size: 14px;">medical_services</span>
                                        Puskesmas
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div style="font-weight: 700; color: #111827; margin-bottom: 2px;">{{ $item->name }}</div>
                                <div style="font-size: 12px; color: #6B7280; max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $item->address }}</div>
                                @if($item->layanan)
                                    <div style="font-size: 11px; color: #9CA3AF; margin-top: 2px;">Layanan: {{ $item->layanan }}</div>
                                @endif
                            </td>
                            <td>{{ $item->kecamatan }}</td>
                            <td>{{ $item->phone ?? '-' }}</td>
                            <td>
                                @if($item->akreditasi)
                                    <span class="faskes-akreditasi-badge">{{ $item->akreditasi }}</span>
                                @else
                                    <span style="color: #9CA3AF; font-size: 12px;">-</span>
                                @endif
                            </td>
                            <td style="text-align: center;">
                                <div class="actions-cell" style="justify-content: center;">
                                    <a href="{{ route('admin.faskes.edit', $item->id) }}" class="btn-action-edit" title="Edit">
                                        <span class="material-icons">edit</span>
                                    </a>
                                    <form action="{{ route('admin.faskes.destroy', $item->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus {{ $item->name }}?')">
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
                                <span class="material-icons" style="font-size: 48px; margin-bottom: 12px;">location_off</span>
                                <p style="font-size: 15px; font-weight: 600;">Belum ada faskes yang ditemukan.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($faskes->hasPages())
            <div class="pagination-wrapper">
                {{ $faskes->links() }}
            </div>
        @endif

    </div>
</div>
@endsection
