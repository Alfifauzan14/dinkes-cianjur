@extends('admin.layouts.admin')

@section('title', 'Tambah Layanan Baru')
@section('header_title', 'Tambah Layanan Baru')

@section('content')
@include('admin.partials.alerts')

<div class="card card-outline card-success">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span class="font-weight-bold text-muted" style="font-size:13px;">
            <span class="material-icons text-success" style="font-size:16px;vertical-align:middle;">medical_services</span>
            Formulir Layanan Baru
        </span>
        <a href="{{ route('admin.layanan.index') }}" class="btn btn-sm btn-outline-secondary">
            <span class="material-icons" style="font-size:15px;vertical-align:middle;">arrow_back</span> Kembali
        </a>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.layanan.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nama Pelayanan <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="form-control @error('name') is-invalid @enderror"
                    placeholder="Masukkan nama pelayanan kesehatan..." required>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="type">Segmen Penerima <span class="text-danger">*</span></label>
                <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" style="max-width: 350px;" required>
                    <option value="" disabled selected>Pilih Segmen</option>
                    <option value="Warga" {{ old('type') == 'Warga' ? 'selected' : '' }}>Layanan Untuk Warga</option>
                    <option value="Faskes" {{ old('type') == 'Faskes' ? 'selected' : '' }}>Layanan Untuk Faskes</option>
                    <option value="Nakes" {{ old('type') == 'Nakes' ? 'selected' : '' }}>Layanan Untuk Nakes</option>
                </select>
                @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>Visual Icon <span class="text-danger">*</span></label>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)); gap: 12px; margin-top: 4px;">
                    @foreach($icons as $icon)
                        <label class="text-center" style="border: 1px solid #E2E8F0; border-radius: 3px; padding: 12px; display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 8px; cursor: pointer; background-color: #F8FAFC;">
                            <input type="radio" name="icon" value="{{ $icon }}" {{ old('icon') == $icon ? 'checked' : '' }} required style="margin: 0;">
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
                <label for="link">Link Tautan Eksternal <small class="text-muted font-weight-normal">(Opsional, e.g. https://...)</small></label>
                <input type="url" name="link" id="link" value="{{ old('link') }}"
                    class="form-control @error('link') is-invalid @enderror"
                    placeholder="Contoh: https://layanan.cianjurkab.go.id">
                @error('link') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex align-items-center justify-content-end" style="gap:10px;">
                <a href="{{ route('admin.layanan.index') }}" class="btn btn-outline-secondary">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">close</span> Batal
                </a>
                <button type="submit" class="btn btn-success">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">save</span> Simpan Layanan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection