@extends('admin.layouts.admin')

@section('title', 'Edit Kontak & Alamat Labkesda')
@section('header_title', 'Edit Kontak & Alamat Labkesda')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/labkesda.css') }}?v={{ time() }}">
@endsection

@section('content')
<div class="berita-admin-wrapper">
    <div class="admin-card">
        <div class="card-header-actions">
            <div>
                <div style="font-size: 18px; font-weight: 800; color: #004F3B;">Kelola Informasi Labkesda</div>
                <div style="font-size: 14px; color: #6B7280; margin-top: 4px;">Atur alamat, jam operasional, dan kontak yang ditampilkan di halaman publik.</div>
            </div>
            <a href="{{ route('admin.labkesda.index') }}" class="btn-admin btn-admin-secondary">
                <span class="material-icons">arrow_back</span>
                <span>Kembali</span>
            </a>
        </div>

        @if(session('success'))
            <div class="admin-alert admin-alert-success">
                <span class="material-icons">check_circle</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
            <form action="{{ route('admin.labkesda.settings.update') }}" method="POST" class="admin-form">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="alamat">Alamat Lokasi</label>
                    <input
                        type="text"
                        name="alamat"
                        id="alamat"
                        value="{{ old('alamat', $settings->alamat) }}"
                        class="form-control-input"
                        placeholder="Contoh: Jl. Pasir Gede Raya No. 12, Cianjur"
                    >
                    @error('alamat')
                        <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jam_operasional">Jam Operasional</label>
                    <input
                        type="text"
                        name="jam_operasional"
                        id="jam_operasional"
                        value="{{ old('jam_operasional', $settings->jam_operasional) }}"
                        class="form-control-input"
                        placeholder="Contoh: Senin - Jumat, 07.30 - 15.30 WIB"
                    >
                    @error('jam_operasional')
                        <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="kontak">Kontak (Telp / WA)</label>
                    <input
                        type="text"
                        name="kontak"
                        id="kontak"
                        value="{{ old('kontak', $settings->kontak) }}"
                        class="form-control-input"
                        placeholder="Contoh: (0263) 2638891 / 0812-3456-7891"
                    >
                    @error('kontak')
                        <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions" style="display: flex; gap: 10px; margin-top: 10px;">
                    <button type="submit" class="btn-admin btn-admin-primary">
                        <span class="material-icons">save</span>
                        Simpan Perubahan
                    </button>
                </div>
            </form>

            <div class="settings-preview">
                <div class="settings-preview-title">Preview Tampilan Publik</div>
                <div class="settings-preview-item">
                    <span class="material-icons">location_on</span>
                    <div>
                        <div style="font-size: 11px; font-weight: 700; color: #6B7280; text-transform: uppercase;">Alamat</div>
                        <div style="margin-top: 2px;">{{ $settings->alamat ?: 'Belum diisi' }}</div>
                    </div>
                </div>
                <div class="settings-preview-item">
                    <span class="material-icons">schedule</span>
                    <div>
                        <div style="font-size: 11px; font-weight: 700; color: #6B7280; text-transform: uppercase;">Jam Operasional</div>
                        <div style="margin-top: 2px;">{{ $settings->jam_operasional ?: 'Belum diisi' }}</div>
                    </div>
                </div>
                <div class="settings-preview-item">
                    <span class="material-icons">phone</span>
                    <div>
                        <div style="font-size: 11px; font-weight: 700; color: #6B7280; text-transform: uppercase;">Kontak</div>
                        <div style="margin-top: 2px;">{{ $settings->kontak ?: 'Belum diisi' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
