@extends('admin.layouts.admin')

@section('title', 'Edit Kontak & Alamat Labkesda')
@section('header_title', 'Edit Kontak & Alamat Labkesda')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/labkesda.css') }}?v={{ time() }}">
@endsection

@section('content')
<div class="card card-outline card-success">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between" style="gap: 12px; padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
        <span class="d-flex align-items-center" style="gap: 8px;">
            <span class="material-icons text-success" style="font-size:20px;">contact_support</span>
            <span class="font-weight-bold card-title-label">Kelola Informasi Labkesda</span>
        </span>
        <a href="{{ route('admin.labkesda.index') }}" class="btn btn-sm btn-outline-secondary ml-auto">
            <span class="material-icons" style="font-size:16px;">arrow_back</span> Kembali
        </a>
    </div>

    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success d-flex align-items-center" style="gap:8px; margin-bottom:16px;">
                <span class="material-icons">check_circle</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="row">
            <div class="col-md-7">
            <form action="{{ route('admin.labkesda.settings.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="alamat">Alamat Lokasi</label>
                    <input
                        type="text"
                        name="alamat"
                        id="alamat"
                        value="{{ old('alamat', $settings->alamat) }}"
                        class="form-control"
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
                        class="form-control"
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
                        class="form-control"
                        placeholder="Contoh: (0263) 2638891 / 0812-3456-7891"
                    >
                    @error('kontak')
                        <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex justify-content-end" style="margin-top: 12px;">
                    <button type="submit" class="btn btn-success">
                        <span class="material-icons" style="font-size:16px;vertical-align:middle;">save</span> Simpan Perubahan
                    </button>
                </div>
            </form>
            </div>

            <div class="col-md-5">
                <div class="card bg-light border">
                    <div class="card-header" style="background:#F9FAFB;">
                        <h6 class="font-weight-bold mb-0" style="font-size:13px; color:#374151;">Preview Tampilan Publik</h6>
                    </div>
                    <div class="card-body" style="display:flex;flex-direction:column;gap:16px;">
                        <div class="d-flex align-items-start" style="gap:10px;">
                            <span class="material-icons text-success">location_on</span>
                            <div>
                                <div style="font-size: 11px; font-weight: 700; color: #6B7280; text-transform: uppercase;">Alamat</div>
                                <div style="margin-top: 2px; font-size:13px;">{{ $settings->alamat ?: 'Belum diisi' }}</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-start" style="gap:10px;">
                            <span class="material-icons text-success">schedule</span>
                            <div>
                                <div style="font-size: 11px; font-weight: 700; color: #6B7280; text-transform: uppercase;">Jam Operasional</div>
                                <div style="margin-top: 2px; font-size:13px;">{{ $settings->jam_operasional ?: 'Belum diisi' }}</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-start" style="gap:10px;">
                            <span class="material-icons text-success">phone</span>
                            <div>
                                <div style="font-size: 11px; font-weight: 700; color: #6B7280; text-transform: uppercase;">Kontak</div>
                                <div style="margin-top: 2px; font-size:13px;">{{ $settings->kontak ?: 'Belum diisi' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
