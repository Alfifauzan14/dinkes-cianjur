@extends('admin.layouts.admin')
@section('title', 'Tambah Layanan Baru')
@section('header_title', 'Tambah Layanan Baru')

@section('content')
<div class="card card-outline card-success">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between" style="gap: 12px; padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
        <span class="d-flex align-items-center" style="gap: 8px;">
            <span class="material-icons text-success" style="font-size:20px;">add_circle</span>
            <span class="font-weight-bold card-title-label">Tambah Layanan Baru</span>
        </span>
        <a href="{{ route('admin.layanan.index') }}" class="btn btn-sm btn-outline-secondary ml-auto">
            <span class="material-icons" style="font-size:16px;">arrow_back</span> Kembali
        </a>
    </div>

    <div class="card-body" style="padding: 24px;">
        <form action="{{ route('admin.layanan.store') }}" method="POST">
            @csrf

            <div class="row">
                {{-- Kolom Kiri: Informasi Utama Layanan --}}
                <div class="col-lg-8 col-12">
                    <div class="form-group">
                        <label for="name" class="font-weight-bold" style="font-size: 13.5px; color: #1E293B;">
                            Nama Pelayanan <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Contoh: Pendaftaran Peserta PBPU dan BP Pemda Program JKN" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="type" class="font-weight-bold" style="font-size: 13.5px; color: #1E293B;">
                            Segmen Penerima <span class="text-danger">*</span>
                        </label>
                        <select name="type" id="type" class="custom-select @error('type') is-invalid @enderror" required>
                            <option value="" disabled selected>Pilih Segmen Penerima Layanan</option>
                            <option value="Warga" {{ old('type') == 'Warga' ? 'selected' : '' }}>Layanan Untuk Warga (Masyarakat)</option>
                            <option value="Faskes" {{ old('type') == 'Faskes' ? 'selected' : '' }}>Layanan Untuk Faskes (Puskesmas / RS / Klinik)</option>
                            <option value="Nakes" {{ old('type') == 'Nakes' ? 'selected' : '' }}>Layanan Untuk Nakes (Dokter / Bidan / Perawat)</option>
                        </select>
                        @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold d-block" style="font-size: 13.5px; color: #1E293B;">
                            Visual Icon <span class="text-danger">*</span>
                        </label>
                        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(105px, 1fr)); gap: 10px; margin-top: 6px;">
                            @foreach($icons as $icon)
                                <label class="text-center icon-radio-label" style="border: 1px solid #CBD5E1; border-radius: 3px; padding: 10px 8px; display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 6px; cursor: pointer; background-color: #F8FAFC; transition: all 0.2s ease;">
                                    <input type="radio" name="icon" value="{{ $icon }}" {{ old('icon', 'users') == $icon ? 'checked' : '' }} required style="display:none;" onchange="updateIconSelection()">
                                    <div class="icon-radio-circle" style="color: #009966; display: inline-flex; align-items: center; justify-content: center; width: 34px; height: 34px; background-color: #E6F7F0; border-radius: 3px;">
                                        @if($icon === 'users')
                                            <span class="material-icons" style="font-size: 20px;">people</span>
                                        @elseif($icon === 'smile')
                                            <span class="material-icons" style="font-size: 20px;">sentiment_satisfied_alt</span>
                                        @elseif($icon === 'chat')
                                            <span class="material-icons" style="font-size: 20px;">chat</span>
                                        @elseif($icon === 'desktop')
                                            <span class="material-icons" style="font-size: 20px;">desktop_windows</span>
                                        @elseif($icon === 'bag')
                                            <span class="material-icons" style="font-size: 20px;">shopping_bag</span>
                                        @elseif($icon === 'globe')
                                            <span class="material-icons" style="font-size: 20px;">language</span>
                                        @elseif($icon === 'file')
                                            <span class="material-icons" style="font-size: 20px;">description</span>
                                        @endif
                                    </div>
                                    <span style="font-size: 11px; font-weight: 700; color: #475569; text-transform: uppercase;">{{ $icon }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('icon') <div class="text-danger mt-1" style="font-size: 12px;">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="description" class="font-weight-bold" style="font-size: 13.5px; color: #1E293B;">
                            Deskripsi Layanan <span class="text-muted font-weight-normal">(opsional)</span>
                        </label>
                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Jelaskan gambaran umum tentang pelayanan kesehatan ini...">{{ old('description') }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="requirements" class="font-weight-bold" style="font-size: 13.5px; color: #1E293B;">
                            Persyaratan Dokumen <span class="text-muted font-weight-normal">(opsional)</span>
                        </label>
                        <textarea name="requirements" id="requirements" class="form-control @error('requirements') is-invalid @enderror" rows="4" placeholder="Contoh:&#10;1. KTP Cianjur asli dan fotokopi&#10;2. Kartu Keluarga (KK)&#10;3. Surat rujukan puskesmas">{{ old('requirements') }}</textarea>
                        <small class="form-text text-muted">Tulis tiap poin persyaratan terpisah dengan baris baru (Enter).</small>
                        @error('requirements') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="procedures" class="font-weight-bold" style="font-size: 13.5px; color: #1E293B;">
                            Alur & Prosedur Pengajuan <span class="text-muted font-weight-normal">(opsional)</span>
                        </label>
                        <textarea name="procedures" id="procedures" class="form-control @error('procedures') is-invalid @enderror" rows="4" placeholder="Contoh:&#10;1. Pemohon mengajukan permohonan ke loket&#10;2. Petugas melakukan verifikasi berkas&#10;3. Penerbitan surat rekomendasi">{{ old('procedures') }}</textarea>
                        <small class="form-text text-muted">Tulis tiap poin alur terpisah dengan baris baru (Enter).</small>
                        @error('procedures') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Kolom Kanan: Detail Teknis & Helpdesk --}}
                <div class="col-lg-4 col-12">
                    <div class="card" style="border: 1px solid #E2E8F0; border-radius: 3px; box-shadow: none;">
                        <div class="card-header" style="background:#F8FAFC; padding: 12px 16px; border-bottom: 1px solid #E2E8F0;">
                            <strong style="font-size: 13.5px; color: #1E293B;">Parameter & Helpdesk</strong>
                        </div>
                        <div class="card-body" style="padding: 16px;">
                            <div class="form-group">
                                <label for="processing_time" class="font-weight-bold" style="font-size: 12.5px; color: #334155;">
                                    Estimasi Waktu Proses
                                </label>
                                <input type="text" name="processing_time" id="processing_time" value="{{ old('processing_time') }}"
                                    class="form-control form-control-sm @error('processing_time') is-invalid @enderror"
                                    placeholder="Contoh: 1 - 3 Hari Kerja">
                                @error('processing_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label for="tariff" class="font-weight-bold" style="font-size: 12.5px; color: #334155;">
                                    Biaya / Tarif Layanan
                                </label>
                                <input type="text" name="tariff" id="tariff" value="{{ old('tariff', 'Gratis (Rp 0)') }}"
                                    class="form-control form-control-sm @error('tariff') is-invalid @enderror"
                                    placeholder="Contoh: Gratis (Rp 0)">
                                @error('tariff') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <hr style="border-color: #E2E8F0; margin: 16px 0;">

                            <div class="form-group">
                                <label for="helpdesk_email" class="font-weight-bold" style="font-size: 12.5px; color: #334155;">
                                    Email Helpdesk
                                </label>
                                <input type="email" name="helpdesk_email" id="helpdesk_email" value="{{ old('helpdesk_email') }}"
                                    class="form-control form-control-sm @error('helpdesk_email') is-invalid @enderror"
                                    placeholder="layanan@dinkes.cianjurkab.go.id">
                                @error('helpdesk_email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group mb-0">
                                <label for="helpdesk_phone" class="font-weight-bold" style="font-size: 12.5px; color: #334155;">
                                    Telepon / WA Helpdesk
                                </label>
                                <input type="text" name="helpdesk_phone" id="helpdesk_phone" value="{{ old('helpdesk_phone') }}"
                                    class="form-control form-control-sm @error('helpdesk_phone') is-invalid @enderror"
                                    placeholder="(0263) 261173">
                                @error('helpdesk_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column mt-3" style="gap: 8px;">
                        <button type="submit" class="btn btn-success btn-block font-weight-bold" style="padding: 9px; font-size: 14px;">
                            <span class="material-icons" style="font-size:18px;vertical-align:middle;">save</span>
                            Simpan Layanan Baru
                        </button>
                        <a href="{{ route('admin.layanan.index') }}" class="btn btn-outline-secondary btn-block">Batal</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function updateIconSelection() {
        document.querySelectorAll('.icon-radio-label').forEach(label => {
            const input = label.querySelector('input[type="radio"]');
            if (input.checked) {
                label.style.borderColor = '#009966';
                label.style.backgroundColor = '#E6F7F0';
                label.style.boxShadow = '0 0 0 2px rgba(0,153,102,0.2)';
            } else {
                label.style.borderColor = '#CBD5E1';
                label.style.backgroundColor = '#F8FAFC';
                label.style.boxShadow = 'none';
            }
        });
    }
    document.addEventListener('DOMContentLoaded', updateIconSelection);
</script>
@endsection
