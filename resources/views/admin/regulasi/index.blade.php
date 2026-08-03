@extends('admin.layouts.admin')

@section('title', 'Kelola Regulasi')
@section('header_title', 'Kelola Regulasi')

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
            <!-- Tombol Tambah Regulasi -->
            <a href="{{ route('admin.regulasi.create') }}" class="btn-admin btn-admin-primary" style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 16px; background-color: #009966; color: #fff; border-radius: 3px; font-weight: 600; text-decoration: none;">
                <span class="material-icons">add</span>
                <span>Tambah Regulasi Baru</span>
            </a>
        </div>

        <!-- Tabel Data -->
        <div class="admin-table-wrapper" style="overflow-x: auto;">
            <table class="admin-table" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #F8FAFC; border-bottom: 2px solid #E2E8F0; text-align: left;">
                        <th style="padding: 12px; font-weight: 700; width: 100px;">Cover</th>
                        <th style="padding: 12px; font-weight: 700;">Nomor / Judul Regulasi</th>
                        <th style="padding: 12px; font-weight: 700; width: 180px;">Kategori</th>
                        <th style="padding: 12px; font-weight: 700; width: 150px;">Topik</th>
                        <th style="padding: 12px; font-weight: 700; width: 80px; text-align: center;">Tahun</th>
                        <th style="padding: 12px; font-weight: 700; width: 120px; text-align: center;">Status</th>
                        <th style="padding: 12px; font-weight: 700; width: 150px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($regulasis as $regulasi)
                        <tr style="border-bottom: 1px solid #E2E8F0;">
                            <td style="padding: 12px; vertical-align: middle;">
                                @if($regulasi->cover_path)
                                    <img src="{{ asset('storage/' . $regulasi->cover_path) }}" alt="" style="width: 60px; height: 80px; object-fit: cover; border-radius: 2px; border: 1px solid #CBD5E1;">
                                @else
                                    <div style="width: 60px; height: 80px; background-color: #E2E8F0; color: #94A3B8; display: flex; align-items: center; justify-content: center; border-radius: 2px; border: 1px solid #CBD5E1; font-size: 11px; font-weight: 700; text-align: center; padding: 4px;">
                                        NO COVER
                                    </div>
                                @endif
                            </td>
                            <td style="padding: 12px; vertical-align: middle;">
                                <div style="font-weight: 700; color: #111827; margin-bottom: 4px;">{{ $regulasi->title }}</div>
                                <div style="font-size: 12px; color: #64748B; margin-bottom: 4px;">{{ Str::limit($regulasi->description, 100) }}</div>
                                <div style="font-size: 12px; color: #64748B; display: flex; align-items: center; gap: 4px;">
                                    <span class="material-icons" style="font-size: 14px; vertical-align: middle;">description</span>
                                    <a href="{{ asset('storage/' . $regulasi->file_path) }}" target="_blank" style="color: #009966; text-decoration: none; font-weight: 600;">Unduh PDF ({{ $regulasi->file_size }})</a>
                                </div>
                            </td>
                            <td style="padding: 12px; vertical-align: middle;">
                                <span style="background-color: #F1F5F9; color: #475569; padding: 4px 8px; border-radius: 3px; font-size: 11px; font-weight: 700;">
                                    {{ $regulasi->category }}
                                </span>
                            </td>
                            <td style="padding: 12px; vertical-align: middle;">
                                <span style="background-color: #E6F7F0; color: #009966; padding: 4px 8px; border-radius: 3px; font-size: 11px; font-weight: 700;">
                                    {{ $regulasi->topic }}
                                </span>
                            </td>
                            <td style="padding: 12px; vertical-align: middle; text-align: center; color: #475569; font-weight: 600;">
                                {{ $regulasi->year }}
                            </td>
                            <td style="padding: 12px; vertical-align: middle; text-align: center;">
                                @if($regulasi->status === 'Berlaku')
                                    <span style="background-color: #DEF7EC; color: #03543F; padding: 4px 8px; border-radius: 10px; font-size: 12px; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                                        <span style="width: 6px; height: 6px; background-color: #31C48D; border-radius: 50%;"></span>
                                        Berlaku
                                    </span>
                                @else
                                    <span style="background-color: #FDE8E8; color: #9B1C1C; padding: 4px 8px; border-radius: 10px; font-size: 12px; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                                        <span style="width: 6px; height: 6px; background-color: #F05252; border-radius: 50%;"></span>
                                        Tidak Berlaku
                                    </span>
                                @endif
                            </td>
                            <td style="padding: 12px; vertical-align: middle; text-align: center;">
                                <div style="display: flex; gap: 8px; justify-content: center;">
                                    <a href="{{ route('admin.regulasi.edit', $regulasi->id) }}" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; background-color: #FEF3C7; color: #D97706; border-radius: 3px; text-decoration: none;" title="Edit">
                                        <span class="material-icons" style="font-size: 18px;">edit</span>
                                    </a>
                                    <form action="{{ route('admin.regulasi.destroy', $regulasi->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus regulasi ini?');" style="margin: 0;">
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
                            <td colspan="7" style="padding: 24px; text-align: center; color: #94A3B8;">Belum ada data regulasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
