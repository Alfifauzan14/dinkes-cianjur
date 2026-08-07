@extends('admin.layouts.admin')
@section('title', 'Kelola Program Kesehatan')
@section('header_title', 'Kelola Program Kesehatan')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/labkesda.css') }}?v={{ time() }}">
    <style>
        .badge-draft { background:#F1F5F9; color:#475569; padding:4px 10px; border-radius:3px; font-size:12px; font-weight:700; }
        .badge-published { background:#E6F7F0; color:#009966; padding:4px 10px; border-radius:3px; font-size:12px; font-weight:700; }
    </style>
@endsection

@section('content')
<div class="berita-admin-wrapper">
    <div class="admin-card">
        <div class="card-header-actions">
            <div>
                <div style="font-size: 18px; font-weight: 800; color: #004F3B;">Kelola Program Kesehatan</div>
                <div style="font-size: 14px; color: #6B7280; margin-top: 4px;">Kelola informasi program kesehatan, panduan, serta intervensi yang terkait.</div>
            </div>
            <div style="display: flex; gap: 10px;">
                <a href="{{ route('admin.program-kesehatan.create') }}" class="btn-admin btn-admin-primary">
                    <span class="material-icons" style="font-size:18px;">add</span>
                    <span>Tambah Program</span>
                </a>
            </div>
        </div>

        <div class="admin-table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 50px; text-align: center;">#</th>
                        <th style="text-align: center;">Nama Program</th>
                        <th style="text-align: center;">Slug / URL</th>
                        <th style="width: 140px; text-align: center;">Jml. Intervensi</th>
                        <th style="width: 110px; text-align: center;">Status</th>
                        <th style="width: 100px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($programs as $program)
                    <tr>
                        <td style="text-align: center; color: #94A3B8; font-size: 13px;">{{ $loop->iteration }}</td>
                        <td style="text-align: center;">
                            <div style="font-weight: 700; color: #111827;">{{ $program->title }}</div>
                            <div style="font-size: 12px; color: #6B7280; margin-top: 2px; max-width: 300px; margin-left: auto; margin-right: auto; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $program->subtitle }}</div>
                        </td>
                        <td style="text-align: center;">
                            <a href="{{ route('program.show', $program->slug) }}" target="_blank" style="color: #009966; text-decoration: none; font-family: monospace; font-size: 13px; background: #F8FAFC; padding: 2px 6px; border-radius: 3px; border: 1px solid #E2E8F0;">
                                /program/{{ $program->slug }}
                            </a>
                        </td>
                        <td style="text-align: center; font-weight: 700; color: #475569;">
                            {{ is_array($program->intervensi) ? count($program->intervensi) : 0 }}
                        </td>
                        <td style="text-align: center;">
                            @if($program->status === 'published')
                                <span class="badge-published">Published</span>
                            @else
                                <span class="badge-draft">Draft</span>
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <div class="actions-cell" style="justify-content: center;">
                                <a href="{{ route('admin.program-kesehatan.edit', $program->id) }}" class="btn-action-edit" title="Edit">
                                    <span class="material-icons">edit</span>
                                </a>
                                <form action="{{ route('admin.program-kesehatan.destroy', $program->id) }}" method="POST" id="del-program-{{ $program->id }}" style="margin: 0; display: inline;">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn-action-delete" title="Hapus"
                                        onclick="confirmDelete('del-program-{{ $program->id }}')">
                                        <span class="material-icons">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="padding: 40px; text-align: center; color: #94A3B8;">
                            <span class="material-icons" style="font-size: 40px; display: block; margin-bottom: 8px; color: #CBD5E1;">health_and_safety</span>
                            Belum ada program kesehatan terdaftar. Klik <strong>"Tambah Program"</strong> untuk memulai.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($programs->hasPages())
        <div style="padding: 16px; border-top: 1px solid #E5E7EB;">
            {{ $programs->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
