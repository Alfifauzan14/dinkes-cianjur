@extends('admin.layouts.admin')

@section('title', 'Edit Layanan')
@section('header_title', 'Edit Layanan')

@section('content')


<div class="card card-outline card-success">
    <div class="card-header d-flex align-items-center justify-content-between" style="padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
        <span class="font-weight-bold text-muted" style="font-size:13px;">
            <span class="material-icons text-success" style="font-size:16px;vertical-align:middle;">medical_services</span>
            Formulir Edit Layanan
        </span>
        <a href="{{ route('admin.layanan.index') }}" class="btn btn-sm btn-outline-secondary">
            <span class="material-icons" style="font-size:15px;vertical-align:middle;">arrow_back</span> Kembali
        </a>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.layanan.update', $layanan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nama Pelayanan <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name', $layanan->name) }}"
                    class="form-control @error('name') is-invalid @enderror"
                    placeholder="Masukkan nama pelayanan kesehatan..." required>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="type">Segmen Penerima <span class="text-danger">*</span></label>
                <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" style="max-width: 350px;" required>
                    <option value="" disabled>Pilih Segmen</option>
                    <option value="Warga" {{ old('type', $layanan->type) == 'Warga' ? 'selected' : '' }}>Layanan Untuk Warga</option>
                    <option value="Faskes" {{ old('type', $layanan->type) == 'Faskes' ? 'selected' : '' }}>Layanan Untuk Faskes</option>
                    <option value="Nakes" {{ old('type', $layanan->type) == 'Nakes' ? 'selected' : '' }}>Layanan Untuk Nakes</option>
                </select>
                @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>Visual Icon <span class="text-danger">*</span></label>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)); gap: 12px; margin-top: 4px;">
                    @foreach($icons as $icon)
                        <label class="text-center" style="border: 1px solid #E2E8F0; border-radius: 3px; padding: 12px; display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 8px; cursor: pointer; background-color: #F8FAFC;">
                            <input type="radio" name="icon" value="{{ $icon }}" {{ old('icon', $layanan->icon) == $icon ? 'checked' : '' }} required style="margin: 0;">
                            <div style="color: #009966; display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; background-color: #E6F7F0; border-radius: 50%;">
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
                            <span style="font-size: 12px; font-weight: 600; color: #475569; text-transform: uppercase;">{{ $icon }}</span>
                        </label>
                    @endforeach
                </div>
                @error('icon') <div class="text-danger" style="font-size: 13px;">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="description">Deskripsi / Informasi Layanan <span class="text-muted" style="font-weight:400;">(opsional)</span></label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="6" placeholder="Jelaskan detail, prosedur, atau persyaratan pelayanan...">{{ old('description', $layanan->description) }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="requirements">Persyaratan Dokumen <span class="text-muted" style="font-weight:400;">(opsional)</span></label>
                <textarea name="requirements" id="requirements" class="form-control @error('requirements') is-invalid @enderror" rows="5" placeholder="Tuliskan persyaratan dokumen, pisahkan dengan baris baru (Enter)...">{{ old('requirements', $layanan->requirements) }}</textarea>
                <small class="form-text text-muted">Pisahkan setiap poin persyaratan dengan baris baru (Enter).</small>
                @error('requirements') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="procedures">Alur & Prosedur Pengajuan <span class="text-muted" style="font-weight:400;">(opsional)</span></label>
                <textarea name="procedures" id="procedures" class="form-control @error('procedures') is-invalid @enderror" rows="5" placeholder="Tuliskan alur & prosedur pengajuan, pisahkan dengan baris baru (Enter)...">{{ old('procedures', $layanan->procedures) }}</textarea>
                <small class="form-text text-muted">Pisahkan setiap poin alur dengan baris baru (Enter).</small>
                @error('procedures') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="processing_time">Estimasi Waktu Proses <span class="text-muted" style="font-weight:400;">(opsional)</span></label>
                        <input type="text" name="processing_time" id="processing_time" value="{{ old('processing_time', $layanan->processing_time) }}"
                            class="form-control @error('processing_time') is-invalid @enderror"
                            placeholder="Contoh: 3 - 5 Hari Kerja">
                        @error('processing_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tariff">Biaya / Tarif Layanan <span class="text-muted" style="font-weight:400;">(opsional)</span></label>
                        <input type="text" name="tariff" id="tariff" value="{{ old('tariff', $layanan->tariff) }}"
                            class="form-control @error('tariff') is-invalid @enderror"
                            placeholder="Contoh: Gratis (Rp 0)">
                        @error('tariff') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="helpdesk_email">Email Bantuan / Helpdesk <span class="text-muted" style="font-weight:400;">(opsional)</span></label>
                        <input type="email" name="helpdesk_email" id="helpdesk_email" value="{{ old('helpdesk_email', $layanan->helpdesk_email) }}"
                            class="form-control @error('helpdesk_email') is-invalid @enderror"
                            placeholder="Contoh: layanan@dinkes.cianjurkab.go.id">
                        @error('helpdesk_email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="helpdesk_phone">Telepon Bantuan / Helpdesk <span class="text-muted" style="font-weight:400;">(opsional)</span></label>
                        <input type="text" name="helpdesk_phone" id="helpdesk_phone" value="{{ old('helpdesk_phone', $layanan->helpdesk_phone) }}"
                            class="form-control @error('helpdesk_phone') is-invalid @enderror"
                            placeholder="Contoh: (0263) 261173 (Jam Kerja)">
                        @error('helpdesk_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-end" style="gap:10px;">
                <a href="{{ route('admin.layanan.index') }}" class="btn btn-outline-secondary">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">close</span> Batal
                </a>
                <button type="submit" class="btn btn-success">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">save</span> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
