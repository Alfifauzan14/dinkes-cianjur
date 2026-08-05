@extends('admin.layouts.admin')

@section('title', 'Tambah Faskes')
@section('header_title', 'Tambah Fasilitas Kesehatan Baru')

@section('content')
@include('admin.partials.alerts')

<div class="card card-outline card-success">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span class="font-weight-bold text-muted" style="font-size:13px;">
            <span class="material-icons text-success" style="font-size:16px;vertical-align:middle;">local_hospital</span>
            Formulir Faskes Baru
        </span>
        <a href="{{ route('admin.faskes.index') }}" class="btn btn-sm btn-outline-secondary">
            <span class="material-icons" style="font-size:15px;vertical-align:middle;">arrow_back</span> Kembali
        </a>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.faskes.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nama Faskes <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="form-control @error('name') is-invalid @enderror"
                    placeholder="Contoh: RSUD Cianjur / Puskesmas Cianjur Kota" required>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="type">Jenis Faskes <span class="text-danger">*</span></label>
                        <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" required>
                            <option value="" disabled selected>Pilih Jenis</option>
                            @foreach($types as $t)
                                <option value="{{ $t->name }}" {{ old('type') == $t->name ? 'selected' : '' }}>{{ $t->name }}</option>
                            @endforeach
                        </select>
                        @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kecamatan">Kecamatan <span class="text-danger">*</span></label>
                        <select name="kecamatan" id="kecamatan" class="form-control @error('kecamatan') is-invalid @enderror" required>
                            <option value="" disabled selected>Pilih Kecamatan</option>
                            @foreach($kecamatans as $kec)
                                <option value="{{ $kec->name }}" {{ old('kecamatan') == $kec->name ? 'selected' : '' }}>{{ $kec->name }}</option>
                            @endforeach
                        </select>
                        @error('kecamatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="address">Alamat Lengkap <span class="text-danger">*</span></label>
                <textarea name="address" id="address" rows="2"
                    class="form-control @error('address') is-invalid @enderror"
                    placeholder="Contoh: Jl. Pangeran No.105, Bojongherang, Kec. Cianjur" required>{{ old('address') }}</textarea>
                @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone">No. Telepon</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                            class="form-control @error('phone') is-invalid @enderror" placeholder="(0263) XXXXXXX">
                        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="jam_operasional">Jam Operasional</label>
                        <input type="text" name="jam_operasional" id="jam_operasional" value="{{ old('jam_operasional') }}"
                            class="form-control @error('jam_operasional') is-invalid @enderror"
                            placeholder="Contoh: Senin - Jumat, 08.00 - 15.00">
                        @error('jam_operasional') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lat">Latitude <span class="text-danger">*</span></label>
                        <input type="number" step="any" name="lat" id="lat" value="{{ old('lat') }}"
                            class="form-control @error('lat') is-invalid @enderror" placeholder="-6.8106523" required>
                        @error('lat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lng">Longitude <span class="text-danger">*</span></label>
                        <input type="number" step="any" name="lng" id="lng" value="{{ old('lng') }}"
                            class="form-control @error('lng') is-invalid @enderror" placeholder="107.1411331" required>
                        @error('lng') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="layanan">Layanan</label>
                        <input type="text" name="layanan" id="layanan" value="{{ old('layanan') }}"
                            class="form-control @error('layanan') is-invalid @enderror"
                            placeholder="Contoh: Rawat Inap, IGD, Poli Umum">
                        @error('layanan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="akreditasi">Akreditasi</label>
                        <select name="akreditasi" id="akreditasi" class="form-control @error('akreditasi') is-invalid @enderror">
                            <option value="">-- Pilih Akreditasi --</option>
                            <option value="Paripurna" {{ old('akreditasi') == 'Paripurna' ? 'selected' : '' }}>Paripurna</option>
                            <option value="Madya" {{ old('akreditasi') == 'Madya' ? 'selected' : '' }}>Madya</option>
                            <option value="Pratama" {{ old('akreditasi') == 'Pratama' ? 'selected' : '' }}>Pratama</option>
                            <option value="Belum Terakreditasi" {{ old('akreditasi') == 'Belum Terakreditasi' ? 'selected' : '' }}>Belum Terakreditasi</option>
                        </select>
                        @error('akreditasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-end" style="gap:10px;">
                <a href="{{ route('admin.faskes.index') }}" class="btn btn-outline-secondary">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">close</span> Batal
                </a>
                <button type="submit" class="btn btn-success">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">save</span> Simpan Faskes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection