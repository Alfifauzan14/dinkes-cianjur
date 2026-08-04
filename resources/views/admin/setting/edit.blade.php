@extends('admin.layouts.admin')

@section('title', 'Pengaturan Situs')
@section('header_title', 'Pengaturan Situs')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/berita.css') }}?v={{ time() }}">
@endsection

@section('content')
<div class="berita-admin-wrapper">

    @if(session('success'))
        <div class="admin-alert admin-alert-success">
            <span class="material-icons">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="admin-card">
        <form action="{{ route('admin.setting.update') }}" method="POST" class="admin-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Fitur ini akan segera tersedia</label>
                <p style="color: #6B7280; font-size: 14px;">Halaman pengaturan situs sedang dalam pengembangan.</p>
            </div>

            <div style="display: flex; gap: 16px; margin-top: 12px;">
                <button type="submit" class="btn-admin btn-admin-primary">
                    <span class="material-icons">save</span>
                    <span>Simpan</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
