@extends('admin.layouts.admin')

@section('title', 'Edit Kontak & Alamat Labkesda')
@section('header_title', 'Edit Kontak & Alamat Labkesda')

@section('styles')
<style>
    .settings-preview {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 8px;
        padding: 20px;
        height: 100%;
    }
    .settings-preview-title {
        font-size: 13px;
        font-weight: 700;
        color: #6B7280;
        text-transform: uppercase;
        margin-bottom: 16px;
    }
    .settings-preview-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 16px;
    }
    .settings-preview-item:last-child {
        margin-bottom: 0;
    }
    .settings-preview-item .material-icons {
        color: #009966;
        font-size: 20px;
    }
</style>
@endsection

@section('content')


<div class="card card-outline card-success">
    <div class="card-header d-flex align-items-center justify-content-between" style="padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
        <span class="font-weight-bold text-muted" style="font-size:13px;">
            <span class="material-icons text-success" style="font-size:16px;vertical-align:middle;">contact_support</span>
            Informasi Labkesda
        </span>
        <a href="{{ route('admin.labkesda.index') }}" class="btn btn-sm btn-outline-secondary">
            <span class="material-icons" style="font-size:15px;vertical-align:middle;">arrow_back</span> Kembali
        </a>
    </div>

    <div class="card-body">
        <p class="text-secondary" style="font-size:13px; margin-top:0;">Atur alamat, jam operasional, dan kontak yang ditampilkan di halaman publik.</p>

        <div class="row">
            <div class="col-lg-8">
                <form action="{{ route('admin.labkesda.settings.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="alamat">Alamat Lokasi</label>
                        <input type="text" name="alamat" id="alamat" value="{{ old('alamat', $settings->alamat) }}"
                            class="form-control @error('alamat') is-invalid @enderror"
                            placeholder="Contoh: Jl. Pasir Gede Raya No. 12, Cianjur">
                        @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="jam_operasional">Jam Operasional</label>
                        <input type="text" name="jam_operasional" id="jam_operasional" value="{{ old('jam_operasional', $settings->jam_operasional) }}"
                            class="form-control @error('jam_operasional') is-invalid @enderror"
                            placeholder="Contoh: Senin - Jumat, 07.30 - 15.30 WIB">
                        @error('jam_operasional') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="kontak">Kontak (Telp / WA)</label>
                        <input type="text" name="kontak" id="kontak" value="{{ old('kontak', $settings->kontak) }}"
                            class="form-control @error('kontak') is-invalid @enderror"
                            placeholder="Contoh: (0263) 2638891 / 0812-3456-7891">
                        @error('kontak') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex align-items-center justify-content-end" style="gap:10px;">
                        <button type="submit" class="btn btn-success-dark">
                            <span class="material-icons" style="font-size:16px;vertical-align:middle;">save</span> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            <div class="col-lg-4">
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
</div>
@endsection
