@extends('admin.layouts.admin')

@section('title', 'Kelola Layanan Terpadu')
@section('header_title', 'Kelola Layanan Terpadu')

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
            <!-- Tombol Tambah Layanan -->
            <a href="{{ route('admin.layanan.create') }}" class="btn-admin btn-admin-primary" style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 16px; background-color: #009966; color: #fff; border-radius: 3px; font-weight: 600; text-decoration: none;">
                <span class="material-icons">add</span>
                <span>Tambah Layanan Baru</span>
            </a>
        </div>

        <!-- Tabel Data -->
        <div class="admin-table-wrapper" style="overflow-x: auto;">
            <table class="admin-table" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #F8FAFC; border-bottom: 2px solid #E2E8F0; text-align: left;">
                        <th style="padding: 12px; font-weight: 700; width: 80px; text-align: center;">Icon</th>
                        <th style="padding: 12px; font-weight: 700;">Nama Layanan</th>
                        <th style="padding: 12px; font-weight: 700; width: 180px;">Segmen Penerima</th>
                        <th style="padding: 12px; font-weight: 700; width: 250px;">Link Tautan</th>
                        <th style="padding: 12px; font-weight: 700; width: 150px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($layanans as $layanan)
                        <tr style="border-bottom: 1px solid #E2E8F0;">
                            <td style="padding: 12px; text-align: center; vertical-align: middle;">
                                <div style="width: 36px; height: 36px; background-color: #E6F7F0; color: #009966; border-radius: 3px; display: inline-flex; align-items: center; justify-content: center; font-weight: 700;">
                                    @if($layanan->icon === 'users')
                                        <span class="material-icons" style="font-size: 20px;">people</span>
                                    @elseif($layanan->icon === 'smile')
                                        <span class="material-icons" style="font-size: 20px;">sentiment_satisfied_alt</span>
                                    @elseif($layanan->icon === 'chat')
                                        <span class="material-icons" style="font-size: 20px;">chat</span>
                                    @elseif($layanan->icon === 'desktop')
                                        <span class="material-icons" style="font-size: 20px;">desktop_windows</span>
                                    @elseif($layanan->icon === 'bag')
                                        <span class="material-icons" style="font-size: 20px;">shopping_bag</span>
                                    @elseif($layanan->icon === 'globe')
                                        <span class="material-icons" style="font-size: 20px;">language</span>
                                    @elseif($layanan->icon === 'file')
                                        <span class="material-icons" style="font-size: 20px;">description</span>
                                    @else
                                        <span class="material-icons" style="font-size: 20px;">help_outline</span>
                                    @endif
                                </div>
                            </td>
                            <td style="padding: 12px; vertical-align: middle;">
                                <div style="font-weight: 700; color: #111827;">{{ $layanan->name }}</div>
                            </td>
                            <td style="padding: 12px; vertical-align: middle;">
                                @if($layanan->type === 'Warga')
                                    <span style="background-color: #DBEAFE; color: #1E40AF; padding: 4px 8px; border-radius: 3px; font-size: 12px; font-weight: 600;">
                                        Layanan Warga
                                    </span>
                                @elseif($layanan->type === 'Faskes')
                                    <span style="background-color: #FEF3C7; color: #92400E; padding: 4px 8px; border-radius: 3px; font-size: 12px; font-weight: 600;">
                                        Layanan Faskes
                                    </span>
                                @else
                                    <span style="background-color: #D1FAE5; color: #065F46; padding: 4px 8px; border-radius: 3px; font-size: 12px; font-weight: 600;">
                                        Layanan Nakes
                                    </span>
                                @endif
                            </td>
                            <td style="padding: 12px; vertical-align: middle; font-size: 13px; color: #475569;">
                                @if($layanan->link)
                                    <a href="{{ $layanan->link }}" target="_blank" style="color: #009966; text-decoration: none; word-break: break-all;">
                                        {{ Str::limit($layanan->link, 35) }}
                                    </a>
                                @else
                                    <span style="color: #94A3B8; font-style: italic;">Tidak ada tautan</span>
                                @endif
                            </td>
                            <td style="padding: 12px; text-align: center; vertical-align: middle;">
                                <div style="display: flex; gap: 8px; justify-content: center;">
                                    <a href="{{ route('admin.layanan.edit', $layanan->id) }}" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; background-color: #FEF3C7; color: #D97706; border-radius: 3px; text-decoration: none;" title="Edit">
                                        <span class="material-icons" style="font-size: 18px;">edit</span>
                                    </a>
                                    <form action="{{ route('admin.layanan.destroy', $layanan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan ini?');" style="margin: 0;">
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
                            <td colspan="5" style="padding: 24px; text-align: center; color: #94A3B8;">Belum ada data layanan terpadu.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
