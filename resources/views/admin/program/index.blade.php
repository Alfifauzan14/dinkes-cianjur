@extends('admin.layouts.admin')

@section('title', 'Kelola Program Kesehatan')
@section('header_title', 'Kelola Program Kesehatan')

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
            <!-- Tombol Tambah Program -->
            <a href="{{ route('admin.program-kesehatan.create') }}" class="btn-admin btn-admin-primary" style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 16px; background-color: #009966; color: #fff; border-radius: 3px; font-weight: 600; text-decoration: none;">
                <span class="material-icons">add</span>
                <span>Tambah Program Baru</span>
            </a>
        </div>

        <!-- Tabel Data -->
        <div class="admin-table-wrapper" style="overflow-x: auto;">
            <table class="admin-table" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #F8FAFC; border-bottom: 2px solid #E2E8F0; text-align: left;">
                        <th style="padding: 12px; font-weight: 700;">Nama Program</th>
                        <th style="padding: 12px; font-weight: 700; width: 250px;">Slug / URL</th>
                        <th style="padding: 12px; font-weight: 700; width: 140px; text-align: center;">Jumlah Intervensi</th>
                        <th style="padding: 12px; font-weight: 700; width: 120px; text-align: center;">Status</th>
                        <th style="padding: 12px; font-weight: 700; width: 150px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($programs as $program)
                        <tr style="border-bottom: 1px solid #E2E8F0;">
                            <td style="padding: 12px; vertical-align: middle;">
                                <div style="font-weight: 700; color: #111827;">{{ $program->title }}</div>
                                <div style="font-size: 13px; color: #64748B; margin-top: 4px;">{{ Str::limit($program->subtitle, 70) }}</div>
                            </td>
                            <td style="padding: 12px; vertical-align: middle; font-size: 13px; color: #475569;">
                                <a href="{{ route('program.show', $program->slug) }}" target="_blank" style="color: #009966; text-decoration: none; font-family: monospace;">
                                    /program/{{ $program->slug }}
                                </a>
                            </td>
                            <td style="padding: 12px; text-align: center; vertical-align: middle; font-weight: 600;">
                                {{ is_array($program->intervensi) ? count($program->intervensi) : 0 }}
                            </td>
                            <td style="padding: 12px; text-align: center; vertical-align: middle;">
                                @if($program->status === 'published')
                                    <span style="background-color: #D1FAE5; color: #065F46; padding: 4px 8px; border-radius: 3px; font-size: 12px; font-weight: 600; text-transform: uppercase;">
                                        Published
                                    </span>
                                @else
                                    <span style="background-color: #F1F5F9; color: #475569; padding: 4px 8px; border-radius: 3px; font-size: 12px; font-weight: 600; text-transform: uppercase; border: 1px solid #E2E8F0;">
                                        Draft
                                    </span>
                                @endif
                            </td>
                            <td style="padding: 12px; text-align: center; vertical-align: middle;">
                                <div style="display: flex; gap: 8px; justify-content: center;">
                                    <a href="{{ route('admin.program-kesehatan.edit', $program->id) }}" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; background-color: #FEF3C7; color: #D97706; border-radius: 3px; text-decoration: none;" title="Edit">
                                        <span class="material-icons" style="font-size: 18px;">edit</span>
                                    </a>
                                    <form action="{{ route('admin.program-kesehatan.destroy', $program->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus program ini?');" style="margin: 0;">
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
                            <td colspan="5" style="padding: 24px; text-align: center; color: #94A3B8;">Belum ada program kesehatan terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($programs->hasPages())
            <div style="margin-top: 20px;">
                {{ $programs->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
