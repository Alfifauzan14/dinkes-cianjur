@extends('admin.layouts.admin')
@section('title', 'Header Halaman')
@section('header_title', 'Kelola Header Halaman')

@section('content')
<div class="row">
    <div class="col-12">


        <div class="card card-outline card-success">

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th style="width: 80px; padding-left: 24px;">No</th>
                                <th style="width: 200px;">Nama Halaman</th>
                                <th style="width: 150px;">Page Key</th>
                                <th>Judul Header (Title)</th>
                                <th>Sub-Judul (Subtitle)</th>
                                <th class="text-center" style="width: 100px; padding-right: 24px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($headers as $header)
                            <tr>
                                <td style="padding-left: 24px; vertical-align: middle;">{{ $loop->iteration }}</td>
                                <td class="font-weight-bold text-dark" style="vertical-align: middle;">{{ $header->page_name }}</td>
                                <td style="vertical-align: middle;"><code style="background:#F3F4F6; padding: 2px 6px; border-radius: 4px;">{{ $header->page_key }}</code></td>
                                <td class="text-dark font-weight-bold" style="vertical-align: middle;">{{ $header->title }}</td>
                                <td class="text-muted" style="vertical-align: middle; max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {{ $header->subtitle ?: '-' }}
                                </td>
                                <td class="text-center" style="padding-right: 24px; vertical-align: middle;">
                                    <button class="btn btn-sm btn-edit-outline btn-edit-header" 
                                            data-id="{{ $header->id }}" 
                                            data-name="{{ $header->page_name }}" 
                                            data-title="{{ $header->title }}" 
                                            data-subtitle="{{ $header->subtitle }}" 
                                            data-toggle="modal" data-target="#modalEditHeader"
                                            style="border-radius: 4px; padding: 4px 8px;">
                                        <span class="material-icons" style="font-size: 15px; vertical-align: middle;">edit</span> Edit
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <span class="material-icons" style="font-size:48px;display:block;margin-bottom:12px;color:#D1D5DB;">view_carousel</span>
                                    Belum ada header terdaftar.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT -->
<div class="modal fade" id="modalEditHeader" tabindex="-1" role="dialog" aria-labelledby="modalEditHeaderLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="" method="POST" id="form-edit-header">
                @csrf
                @method('PUT')
                <div class="modal-header" style="background:#004F3B; color:#fff; border-radius:0;">
                    <h5 class="modal-title" id="modalEditHeaderLabel">Edit Header: <span id="header-page-name"></span></h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_title">Judul Header (Title) <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="edit_title" class="form-control" required placeholder="Contoh: Profil Dinas Kesehatan">
                    </div>
                    <div class="form-group">
                        <label for="edit_subtitle">Sub-Judul Header (Subtitle)</label>
                        <textarea name="subtitle" id="edit_subtitle" class="form-control" rows="3" placeholder="Contoh: Mengenal lebih dekat Dinas Kesehatan..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success-dark">Perbarui Header</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.btn-edit-header');
        editButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const title = this.getAttribute('data-title');
                const subtitle = this.getAttribute('data-subtitle');
                
                document.getElementById('header-page-name').innerText = name;
                document.getElementById('edit_title').value = title;
                document.getElementById('edit_subtitle').value = subtitle;
                document.getElementById('form-edit-header').action = `/admin/headers/${id}`;
            });
        });
    });
</script>
@endsection
