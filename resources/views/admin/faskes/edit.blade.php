@extends('admin.layouts.admin')

@section('title', 'Edit Faskes')
@section('header_title', 'Edit ' . $faske->name)

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/berita.css') }}?v={{ time() }}">
@endsection

@section('content')
<div class="berita-admin-wrapper">
    <div class="admin-card">

        <form action="{{ route('admin.faskes.update', $faske->id) }}" method="POST" class="admin-form">
            @csrf
            @method('PUT')

            <!-- Nama Faskes -->
            <div class="form-group">
                <label for="name">Nama Faskes</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name', $faske->name) }}"
                    class="form-control-input"
                    placeholder="Contoh: RSUD Cianjur / Puskesmas Cianjur Kota"
                    required
                >
                @error('name')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Jenis & Kecamatan -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div class="form-group">
                    <label for="type">Jenis Faskes</label>
                    <select name="type" id="type" class="form-control-select" required>
                        @foreach($types as $t)
                            <option value="{{ $t->name }}" {{ old('type', $faske->type) == $t->name ? 'selected' : '' }}>{{ $t->name }}</option>
                        @endforeach
                    </select>
                    @error('type')
                        <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="kecamatan">Kecamatan</label>
                    <select name="kecamatan" id="kecamatan" class="form-control-select" required>
                        @foreach($kecamatans as $kec)
                            <option value="{{ $kec->name }}" {{ old('kecamatan', $faske->kecamatan) == $kec->name ? 'selected' : '' }}>{{ $kec->name }}</option>
                        @endforeach
                    </select>
                    @error('kecamatan')
                        <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Alamat -->
            <div class="form-group">
                <label for="address">Alamat Lengkap</label>
                <textarea
                    name="address"
                    id="address"
                    class="form-textarea"
                    rows="2"
                    placeholder="Contoh: Jl. Pangeran No.105, Bojongherang, Kec. Cianjur"
                    required
                >{{ old('address', $faske->address) }}</textarea>
                @error('address')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Telepon & Jam Operasional -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div class="form-group">
                    <label for="phone">No. Telepon</label>
                    <input
                        type="text"
                        name="phone"
                        id="phone"
                        value="{{ old('phone', $faske->phone) }}"
                        class="form-control-input"
                        placeholder="(0263) XXXXXXX"
                    >
                    @error('phone')
                        <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jam_operasional">Jam Operasional</label>
                    <input
                        type="text"
                        name="jam_operasional"
                        id="jam_operasional"
                        value="{{ old('jam_operasional', $faske->jam_operasional) }}"
                        class="form-control-input"
                        placeholder="Contoh: Senin - Jumat, 08.00 - 15.00"
                    >
                    @error('jam_operasional')
                        <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Latitude & Longitude -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div class="form-group">
                    <label for="lat">Latitude</label>
                    <input
                        type="number"
                        name="lat"
                        id="lat"
                        value="{{ old('lat', $faske->lat) }}"
                        class="form-control-input"
                        step="any"
                        placeholder="-6.8106523"
                        required
                    >
                    @error('lat')
                        <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="lng">Longitude</label>
                    <input
                        type="number"
                        name="lng"
                        id="lng"
                        value="{{ old('lng', $faske->lng) }}"
                        class="form-control-input"
                        step="any"
                        placeholder="107.1411331"
                        required
                    >
                    @error('lng')
                        <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Layanan & Akreditasi -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div class="form-group">
                    <label for="layanan">Layanan</label>
                    <input
                        type="text"
                        name="layanan"
                        id="layanan"
                        value="{{ old('layanan', $faske->layanan) }}"
                        class="form-control-input"
                        placeholder="Contoh: Rawat Inap, IGD, Poli Umum"
                    >
                    @error('layanan')
                        <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="akreditasi">Akreditasi</label>
                    <select name="akreditasi" id="akreditasi" class="form-control-select">
                        <option value="">-- Pilih Akreditasi --</option>
                        <option value="Paripurna" {{ old('akreditasi', $faske->akreditasi) == 'Paripurna' ? 'selected' : '' }}>Paripurna</option>
                        <option value="Madya" {{ old('akreditasi', $faske->akreditasi) == 'Madya' ? 'selected' : '' }}>Madya</option>
                        <option value="Pratama" {{ old('akreditasi', $faske->akreditasi) == 'Pratama' ? 'selected' : '' }}>Pratama</option>
                        <option value="Belum Terakreditasi" {{ old('akreditasi', $faske->akreditasi) == 'Belum Terakreditasi' ? 'selected' : '' }}>Belum Terakreditasi</option>
                    </select>
                    @error('akreditasi')
                        <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div style="display: flex; gap: 16px; margin-top: 12px;">
                <button type="submit" class="btn-admin btn-admin-primary">
                    <span class="material-icons">save</span>
                    <span>Perbarui Faskes</span>
                </button>
                <a href="{{ route('admin.faskes.index') }}" class="btn-admin btn-admin-secondary">
                    <span>Batal</span>
                </a>
            </div>

        </form>

    </div>
</div>
@endsection
