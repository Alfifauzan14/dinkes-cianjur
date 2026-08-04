@extends('admin.layouts.admin')

@section('title', 'Edit Info Card')
@section('header_title', 'Edit Info Card')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/pagodasehat.css') }}?v={{ time() }}">
@endsection

@section('content')
<div class="berita-admin-wrapper">
    <div class="admin-card">
        <form action="{{ route('admin.home-content.update', $card->id) }}" method="POST" class="admin-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Judul</label>
                <input
                    type="text"
                    name="title"
                    id="title"
                    value="{{ old('title', $card->title) }}"
                    class="form-control-input"
                    placeholder="Contoh: Peta Sebaran Faskes"
                    required
                >
                @error('title')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea
                    name="description"
                    id="description"
                    class="form-textarea"
                    rows="4"
                    placeholder="Contoh: Temukan lokasi puskesmas & faskes terdekat di Kabupaten Cianjur."
                >{{ old('description', $card->description) }}</textarea>
                @error('description')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Pilih Ikon</label>
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    @foreach($icons as $iconName)
                        <label class="icon-option {{ old('icon_name', $card->icon_name) === $iconName ? 'selected' : '' }}" style="cursor: pointer; border: 2px solid {{ old('icon_name', $card->icon_name) === $iconName ? '#009966' : '#E5E7EB' }}; border-radius: 6px; padding: 10px; display: inline-flex; flex-direction: column; align-items: center; gap: 6px; width: 90px; background: {{ old('icon_name', $card->icon_name) === $iconName ? '#E6F7F0' : '#FFFFFF' }};">
                            <input
                                type="radio"
                                name="icon_name"
                                value="{{ $iconName }}"
                                class="icon-radio"
                                style="position: absolute; opacity: 0; pointer-events: none;"
                                {{ old('icon_name', $card->icon_name) === $iconName ? 'checked' : '' }}
                            >
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#009966" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                @include('admin.home-content.icon', ['icon' => $iconName])
                            </svg>
                            <span style="font-size: 12px; color: #374151; text-transform: capitalize;">{{ $iconName }}</span>
                        </label>
                    @endforeach
                </div>
                @error('icon_name')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions" style="display: flex; gap: 10px; margin-top: 10px;">
                <button type="submit" class="btn-admin btn-admin-primary">
                    <span class="material-icons">save</span>
                    Perbarui
                </button>
                <a href="{{ route('admin.home-content.index') }}" class="btn-admin btn-admin-secondary">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.querySelectorAll('.icon-option').forEach(function(option) {
    option.addEventListener('click', function() {
        document.querySelectorAll('.icon-option').forEach(function(opt) {
            opt.style.borderColor = '#E5E7EB';
            opt.style.background = '#FFFFFF';
        });
        this.style.borderColor = '#009966';
        this.style.background = '#E6F7F0';
        var radio = this.querySelector('.icon-radio');
        radio.checked = true;
    });
});
</script>
@endsection
