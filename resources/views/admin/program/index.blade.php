@extends('admin.layouts.admin')
@section('title', 'Kelola Program Kesehatan')
@section('header_title', 'Kelola Program Kesehatan')

@section('styles')
<style>
    .badge-draft { background:#F1F5F9; color:#475569; padding:4px 10px; border-radius:3px; font-size:12px; font-weight:700; display:inline-block; }
    .badge-published { background:#E6F7F0; color:#009966; padding:4px 10px; border-radius:3px; font-size:12px; font-weight:700; display:inline-block; }
</style>
@endsection

@section('content')
<div class="card card-outline card-success">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between" style="gap: 12px;">
        <span class="d-flex align-items-center" style="gap: 8px;">
            <span class="material-icons text-success">health_and_safety</span>
            <span class="font-weight-bold card-title-label">Kelola Program Kesehatan</span>
        </span>
        <a href="{{ route('admin.program-kesehatan.create') }}" class="btn btn-sm btn-success">
            <span class="material-icons" style="font-size:16px;">add</span> Tambah Program
        </a>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width: 50px; text-align: center;">#</th>
                        <th>Nama Program</th>
                        <th>Slug / URL</th>
                        <th style="width: 130px; text-align: center;">Jml. Intervensi</th>
                        <th style="width: 110px; text-align: center;">Status</th>
                        <th style="width: 100px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($programs as $program)
                    <tr>
                        <td class="text-center align-middle text-muted" style="font-size: 13px;">{{ $loop->iteration }}</td>
                        <td class="align-middle">
                            <div class="font-weight-bold text-dark">{{ $program->title }}</div>
                            <div class="text-muted" style="font-size: 12px; margin-top: 2px; max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $program->subtitle }}</div>
                        </td>
                        <td class="align-middle">
                            <a href="{{ route('program.show', $program->slug) }}" target="_blank" class="text-success" style="text-decoration: none; font-family: monospace; font-size: 13px; background: #F8FAFC; padding: 2px 6px; border-radius: 3px; border: 1px solid #E2E8F0;">
                                /program/{{ $program->slug }}
                            </a>
                        </td>
                        <td class="text-center align-middle font-weight-bold text-secondary">
                            {{ is_array($program->intervensi) ? count($program->intervensi) : 0 }}
                        </td>
                        <td class="text-center align-middle">
                            @if($program->status === 'published')
                                <span class="badge-published">Published</span>
                            @else
                                <span class="badge-draft">Draft</span>
                            @endif
                        </td>
                        <td class="text-center align-middle">
                            <div class="btn-action-group">
                                <a href="{{ route('admin.program-kesehatan.edit', $program->id) }}" class="btn-action btn-action-edit" title="Edit">
                                    <span class="material-icons">edit</span>
                                </a>
                                <form action="{{ route('admin.program-kesehatan.destroy', $program->id) }}" method="POST" id="del-program-{{ $program->id }}" style="margin: 0; display: inline;">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn-action btn-action-delete" title="Hapus"
                                        onclick="confirmDelete('del-program-{{ $program->id }}')">
                                        <span class="material-icons">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center" style="padding: 48px; color: #94A3B8;">
                            <span class="material-icons" style="font-size: 48px; display: block; margin-bottom: 12px; color: #CBD5E1;">health_and_safety</span>
                            <p style="font-size: 15px; font-weight: 600;">Belum ada program kesehatan terdaftar.</p>
                            <p class="text-muted" style="font-size: 13px;">Klik <strong>"Tambah Program"</strong> untuk memulai.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($programs->hasPages())
        <div class="pagination-wrapper">
            {{ $programs->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
