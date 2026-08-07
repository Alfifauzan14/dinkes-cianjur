@extends('admin.layouts.admin')
@section('title', 'Kelola Program Kesehatan')
@section('header_title', 'Kelola Program Kesehatan')

@section('content')
<div class="card card-outline card-success">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between" style="gap: 12px; padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
        <span class="d-flex align-items-center" style="gap: 8px;">
            <span class="material-icons text-success">health_and_safety</span>
            <span class="font-weight-bold" style="color: #1E293B;">Kelola Program Kesehatan</span>
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
                        <th>Nama Program</th>
                        <th style="width:230px;">Slug / URL</th>
                        <th class="text-center" style="width:120px;">Jml. Intervensi</th>
                        <th class="text-center" style="width:110px;">Status</th>
                        <th class="text-center" style="width:100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($programs as $program)
                    <tr>
                        <td class="align-middle">
                            <div class="font-weight-bold text-dark">{{ $program->title }}</div>
                            <small class="text-muted">{{ Str::limit($program->subtitle, 70) }}</small>
                        </td>
                        <td class="align-middle" style="font-size:13px;">
                            <a href="{{ route('program.show', $program->slug) }}" target="_blank" class="text-success" style="text-decoration:none;font-family:monospace;">
                                /program/{{ $program->slug }}
                            </a>
                        </td>
                        <td class="text-center font-weight-bold text-secondary align-middle">
                            {{ is_array($program->intervensi) ? count($program->intervensi) : 0 }}
                        </td>
                        <td class="text-center align-middle">
                            @if($program->status === 'published')
                                <span class="badge" style="background:#DEF7EC;color:#03543F;padding:4px 10px;border-radius:3px;font-size:11px;font-weight:700;">Published</span>
                            @else
                                <span class="badge" style="background:#F1F5F9;color:#475569;padding:4px 10px;border-radius:3px;font-size:11px;font-weight:700;">Draft</span>
                            @endif
                        </td>
                        <td class="text-center align-middle">
                            <div class="btn-action-group">
                                <a href="{{ route('admin.program-kesehatan.edit', $program->id) }}" class="btn-action btn-action-edit" title="Edit">
                                    <span class="material-icons" style="font-size:16px;">edit</span>
                                </a>
                                <form action="{{ route('admin.program-kesehatan.destroy', $program->id) }}" method="POST" id="del-program-{{ $program->id }}" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn-action btn-action-delete" title="Hapus"
                                        onclick="confirmDelete('del-program-{{ $program->id }}')">
                                        <span class="material-icons" style="font-size:16px;">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <span class="material-icons" style="font-size:48px;display:block;margin-bottom:8px;color:#D1D5DB;">health_and_safety</span>
                            Belum ada program kesehatan terdaftar.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($programs->hasPages())
    <div class="card-footer">{{ $programs->links() }}</div>
    @endif
</div>
@endsection
