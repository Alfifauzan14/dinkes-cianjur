@extends('admin.layouts.admin')

@section('title', 'Kelola Faskes')
@section('header_title', 'Kelola Fasilitas Kesehatan')

@section('styles')
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
    </style>
@endsection

@section('content')


<div class="card card-outline card-success">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between" style="gap: 12px; padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
        <span class="d-flex align-items-center" style="gap: 8px;">
            <span class="material-icons text-success">local_hospital</span>
            <span class="font-weight-bold" style="color: #1E293B;">Kelola Faskes</span>
        </span>

        {{-- Search & Filter --}}
        <form action="{{ route('admin.faskes.index') }}" method="GET" class="d-flex flex-wrap align-items-center" style="gap: 8px;">
            <input type="text" name="search" placeholder="Cari nama faskes..." value="{{ request('search') }}" class="form-control form-control-sm" style="width: 180px;">
            <select name="kecamatan" class="custom-select custom-select-sm" onchange="this.form.submit()" style="width: 150px;">
                <option value="Semua">Semua Kecamatan</option>
                @foreach($kecamatans as $kec)
                    <option value="{{ $kec->name }}" {{ request('kecamatan') == $kec->name ? 'selected' : '' }}>{{ $kec->name }}</option>
                @endforeach
            </select>
            <select name="type" class="custom-select custom-select-sm" onchange="this.form.submit()" style="width: 130px;">
                <option value="Semua">Semua Jenis</option>
                @foreach($types as $t)
                    <option value="{{ $t->name }}" {{ request('type') == $t->name ? 'selected' : '' }}>{{ $t->name }}</option>
                @endforeach
            </select>
            @if(request('search') || request('kecamatan', 'Semua') !== 'Semua' || request('type', 'Semua') !== 'Semua')
                <a href="{{ route('admin.faskes.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
            @endif
        </form>

        <div class="d-flex flex-wrap align-items-center ml-auto" style="gap: 8px;">
            {{-- Import CSV --}}
            <form action="{{ route('admin.faskes.import') }}" method="POST" enctype="multipart/form-data" class="d-inline-block m-0">
                @csrf
                <label class="btn btn-sm btn-outline-secondary mb-0" style="cursor: pointer;">
                    <span class="material-icons" style="font-size:16px; vertical-align:middle;">upload_file</span> Impor CSV
                    <input type="file" name="csv_file" accept=".csv,.txt" style="display: none;" onchange="this.form.submit()">
                </label>
            </form>

            {{-- Export CSV --}}
            <a href="{{ route('admin.faskes.export') }}" class="btn btn-sm btn-outline-secondary">
                <span class="material-icons" style="font-size:16px; vertical-align:middle;">download</span> Ekspor CSV
            </a>

            <a href="{{ route('admin.faskes.create') }}" class="btn btn-sm btn-success">
                <span class="material-icons" style="font-size:16px; vertical-align:middle;">add</span> Tambah Faskes
            </a>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">No</th>
                        <th style="width: 110px;">Jenis</th>
                        <th>Nama Faskes</th>
                        <th style="width: 130px;">Kecamatan</th>
                        <th style="width: 140px;">Telepon</th>
                        <th style="width: 110px;">Akreditasi</th>
                        <th class="text-center" style="width: 100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($faskes as $item)
                        <tr>
                            <td class="text-center align-middle">{{ ($faskes->currentPage() - 1) * $faskes->perPage() + $loop->iteration }}</td>
                            <td class="align-middle">
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
                            <td class="align-middle">
                                <div class="font-weight-bold text-dark" style="margin-bottom: 2px;">{{ $item->name }}</div>
                                <div class="text-secondary" style="font-size: 12px; max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $item->address }}</div>
                                @if($item->layanan)
                                    <div class="text-muted" style="font-size: 11px; margin-top: 2px;">Layanan: {{ $item->layanan }}</div>
                                @endif
                            </td>
                            <td class="align-middle">{{ $item->kecamatan }}</td>
                            <td class="align-middle">{{ $item->phone ?? '-' }}</td>
                            <td class="align-middle">
                                @if($item->akreditasi)
                                    <span class="faskes-akreditasi-badge">{{ $item->akreditasi }}</span>
                                @else
                                    <span class="text-secondary" style="font-size: 12px;">-</span>
                                @endif
                            </td>
                            <td class="text-center align-middle">
                                <div class="btn-action-group">
                                    <a href="{{ route('admin.faskes.edit', $item->id) }}" class="btn-action btn-action-edit" title="Edit">
                                        <span class="material-icons" style="font-size:16px;">edit</span>
                                    </a>
                                    <form action="{{ route('admin.faskes.destroy', $item->id) }}" method="POST" id="del-faskes-{{ $item->id }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn-action btn-action-delete" title="Hapus" onclick="confirmDelete('del-faskes-{{ $item->id }}')">
                                            <span class="material-icons" style="font-size:16px;">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <span class="material-icons" style="font-size: 48px; display:block; margin-bottom: 8px; color: #D1D5DB;">location_off</span>
                                Belum ada faskes yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($faskes->hasPages())
        <div class="card-footer">{{ $faskes->links() }}</div>
    @endif
</div>
@endsection
