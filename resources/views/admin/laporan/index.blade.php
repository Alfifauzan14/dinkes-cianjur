@extends('admin.layouts.admin')

@section('title', 'Kelola Laporan')
@section('header_title', 'Kelola Laporan')

@section('content')
<div class="berita-admin-wrapper">
    
    @if(session('success'))
        <div class="admin-alert admin-alert-success">
            <span class="material-icons">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="admin-card">
        <div class="card-header-actions" style="display: flex; justify-content: flex-end; margin-bottom: 20px;">
            <!-- Tombol Tambah Laporan -->
            <a href="{{ route('admin.laporan.create') }}" class="btn-admin btn-admin-primary" style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 16px; background-color: #009966; color: #fff; border-radius: 3px; font-weight: 600; text-decoration: none;">
                <span class="material-icons">add</span>
                <span>Tambah Laporan Baru</span>
            </a>
        </div>

        <!-- Tabel Data -->
        <div class="admin-table-wrapper" style="overflow-x: auto;">
            <table class="admin-table" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #F8FAFC; border-bottom: 2px solid #E2E8F0; text-align: left;">
                        <th style="padding: 12px; font-weight: 700;">Judul Laporan</th>
                        <th style="padding: 12px; font-weight: 700; width: 200px;">Kategori</th>
                        <th style="padding: 12px; font-weight: 700; width: 150px;">Tanggal Rilis</th>
                        <th style="padding: 12px; font-weight: 700; width: 120px;">Ukuran File</th>
                        <th style="padding: 12px; font-weight: 700; width: 150px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporans as $laporan)
                        <tr style="border-bottom: 1px solid #E2E8F0;">
                            <td style="padding: 12px;">
                                <div style="font-weight: 700; color: #111827; margin-bottom: 4px;">{{ $laporan->title }}</div>
                                <div style="font-size: 12px; color: #64748B;">
                                    <span class="material-icons" style="font-size: 14px; vertical-align: middle;">attachment</span>
                                    <a href="{{ asset('storage/' . $laporan->file_path) }}" target="_blank" style="color: #009966; text-decoration: none;">Unduh File</a>
                                </div>
                            </td>
                            <td style="padding: 12px;">
                                <span style="background-color: #E0F2FE; color: #0369A1; padding: 4px 8px; border-radius: 3px; font-size: 12px; font-weight: 600;">
                                    {{ $laporan->category }}
                                </span>
                            </td>
                            <td style="padding: 12px; color: #475569;">
                                {{ $laporan->release_date->format('d M Y') }}
                            </td>
                            <td style="padding: 12px; color: #475569; font-weight: 600;">
                                {{ $laporan->file_size }}
                            </td>
                            <td style="padding: 12px; text-align: center;">
                                <div style="display: flex; gap: 8px; justify-content: center;">
                                    <a href="{{ route('admin.laporan.edit', $laporan->id) }}" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; background-color: #FEF3C7; color: #D97706; border-radius: 3px; text-decoration: none;" title="Edit">
                                        <span class="material-icons" style="font-size: 18px;">edit</span>
                                    </a>
                                    <form action="{{ route('admin.laporan.destroy', $laporan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');" style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; background-color: #FEE2E2; color: #DC2626; border: none; border-radius: 3px; cursor: pointer;" title="Hapus">
                                            <span class="material-icons" style="font-size: 18px;">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding: 24px; text-align: center; color: #94A3B8;">Belum ada data laporan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
