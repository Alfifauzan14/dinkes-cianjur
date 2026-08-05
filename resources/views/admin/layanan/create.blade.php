@extends('admin.layouts.admin')

@section('title', 'Tambah Layanan Baru')
@section('header_title', 'Tambah Layanan Baru')

@section('content')
<div class="berita-admin-wrapper">
    <div class="admin-card">
        
        <form action="{{ route('admin.layanan.store') }}" method="POST" class="admin-form" style="display: flex; flex-direction: column; gap: 20px;">
            @csrf

            <!-- Nama Layanan -->
            <div class="form-group" style="display: flex; flex-direction: column; gap: 8px;">
                <label for="name" style="font-weight: 700; color: #1E293B;">Nama Pelayanan</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    value="{{ old('name') }}" 
                    class="form-control-input" 
                    style="padding: 10px; border: 1px solid #CBD5E1; border-radius: 3px; font-family: inherit; font-size: 14px;"
                    placeholder="Masukkan nama pelayanan kesehatan..."
                    required
                >
                @error('name')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Segmen / Kategori Penerima -->
            <div class="form-group" style="display: flex; flex-direction: column; gap: 8px;">
                <label for="type" style="font-weight: 700; color: #1E293B;">Segmen Penerima</label>
                <select name="type" id="type" class="form-control-select" style="padding: 10px; border: 1px solid #CBD5E1; border-radius: 3px; font-family: inherit; font-size: 14px; background-color: #fff;" required>
                    <option value="" disabled selected>Pilih Segmen</option>
                    <option value="Warga" {{ old('type') == 'Warga' ? 'selected' : '' }}>Layanan Untuk Warga</option>
                    <option value="Faskes" {{ old('type') == 'Faskes' ? 'selected' : '' }}>Layanan Untuk Faskes</option>
                    <option value="Nakes" {{ old('type') == 'Nakes' ? 'selected' : '' }}>Layanan Untuk Nakes</option>
                </select>
                @error('type')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Pilihan Icon -->
            <div class="form-group" style="display: flex; flex-direction: column; gap: 8px;">
                <label style="font-weight: 700; color: #1E293B;">Visual Icon</label>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)); gap: 12px; margin-top: 4px;">
                    @foreach($icons as $icon)
                        <label style="border: 1px solid #E2E8F0; border-radius: 3px; padding: 12px; display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 8px; cursor: pointer; background-color: #F8FAFC;">
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
                @error('icon')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tautan / Link Eksternal -->
            <div class="form-group" style="display: flex; flex-direction: column; gap: 8px;">
                <label for="link" style="font-weight: 700; color: #1E293B;">Link Tautan Eksternal <span style="font-weight: 400; font-size: 12px; color: #94A3B8;">(Opsional, e.g. https://...)</span></label>
                <input 
                    type="url" 
                    name="link" 
                    id="link" 
                    value="{{ old('link') }}" 
                    class="form-control-input" 
                    style="padding: 10px; border: 1px solid #CBD5E1; border-radius: 3px; font-family: inherit; font-size: 14px;"
                    placeholder="Contoh: https://layanan.cianjurkab.go.id"
                >
                @error('link')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="form-actions" style="display: flex; gap: 10px; margin-top: 10px;">
                <button type="submit" class="btn-admin btn-admin-primary" style="padding: 10px 20px; background-color: #009966; color: #fff; border: none; border-radius: 3px; font-weight: 700; cursor: pointer;">
                    Simpan Layanan
                </button>
                <a href="{{ route('admin.layanan.index') }}" class="btn-admin btn-admin-secondary" style="padding: 10px 20px; background-color: #F1F5F9; color: #334155; border: 1px solid #E2E8F0; border-radius: 3px; text-decoration: none; font-weight: 600; text-align: center;">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>
@endsection
