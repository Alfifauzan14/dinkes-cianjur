@extends('admin.layouts.admin')

@section('title', 'Edit Info Card')
@section('header_title', 'Edit Info Card')

@section('content')


<div class="card card-outline card-success">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between" style="gap: 12px;">
        <span class="d-flex align-items-center" style="gap: 8px;">
            <span class="material-icons text-success" style="font-size:20px;">home</span>
            <span class="font-weight-bold card-title-label">Formulir Edit Info Card</span>
        </span>
        <a href="{{ route('admin.home-content.index') }}" class="btn btn-sm btn-outline-secondary ml-auto">
            <span class="material-icons" style="font-size:16px;">arrow_back</span> Kembali
        </a>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.home-content.update', $card->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Judul <span class="text-danger">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $card->title) }}"
                    class="form-control @error('title') is-invalid @enderror"
                    placeholder="Contoh: Peta Sebaran Faskes" required>
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea name="description" id="description" rows="4"
                    class="form-control @error('description') is-invalid @enderror"
                    placeholder="Contoh: Temukan lokasi puskesmas & faskes terdekat di Kabupaten Cianjur.">{{ old('description', $card->description) }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>Pilih Ikon</label>
                <div class="icon-picker-container">
                    @foreach($icons as $iconName)
                        <label class="icon-option {{ old('icon_name', $card->icon_name) === $iconName ? 'selected' : '' }}">
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
                            <span class="icon-label-text">{{ $iconName }}</span>
                        </label>
                    @endforeach
                </div>
                @error('icon_name') <div class="text-danger" style="font-size:13px;">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex align-items-center justify-content-end" style="gap:10px;">
                <a href="{{ route('admin.home-content.index') }}" class="btn btn-outline-secondary">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">close</span> Batal
                </a>
                <button type="submit" class="btn btn-success">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">save</span> Perbarui
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<style>
    .icon-picker-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
        gap: 12px;
        max-height: 260px;
        overflow-y: auto;
        padding: 12px;
        border: 1px solid #E2E8F0;
        border-radius: 8px;
        background: #F8FAFC;
    }
    .icon-option {
        cursor: pointer;
        border: 2px solid #E2E8F0;
        border-radius: 8px;
        padding: 12px 8px;
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 6px !important;
        background: #FFFFFF;
        text-align: center;
        min-height: 76px;
        transition: all 0.15s ease-in-out;
        position: relative;
        margin-bottom: 0 !important;
    }
    .icon-option:hover {
        border-color: #009966;
        background: #F0FDF4;
    }
    .icon-option.selected,
    .icon-option:has(.icon-radio:checked) {
        border-color: #009966 !important;
        background-color: #E6F7F0 !important;
        box-shadow: 0 0 0 2px rgba(0, 153, 102, 0.15) !important;
    }
    .icon-option.selected .icon-label-text,
    .icon-option:has(.icon-radio:checked) .icon-label-text {
        color: #004F3B !important;
        font-weight: 700 !important;
    }
    .icon-label-text {
        font-size: 11.5px;
        font-weight: 600;
        color: #475569;
        text-transform: capitalize;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 100%;
        line-height: 1.2;
    }
</style>
<script>
document.querySelectorAll('.icon-option').forEach(function(option) {
    option.addEventListener('click', function() {
        document.querySelectorAll('.icon-option').forEach(function(opt) {
            opt.classList.remove('selected');
        });
        this.classList.add('selected');
        var radio = this.querySelector('.icon-radio');
        if (radio) radio.checked = true;
    });
});
</script>
@endsection
