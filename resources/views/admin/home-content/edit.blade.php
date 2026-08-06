@extends('admin.layouts.admin')

@section('title', 'Edit Info Card')
@section('header_title', 'Edit Info Card')

@section('content')


<div class="card card-outline card-success">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span class="font-weight-bold text-muted" style="font-size:13px;">
            <span class="material-icons text-warning" style="font-size:16px;vertical-align:middle;">edit</span>
            Formulir Edit Info Card
        </span>
        <a href="{{ route('admin.home-content.index') }}" class="btn btn-sm btn-outline-secondary">
            <span class="material-icons" style="font-size:15px;vertical-align:middle;">arrow_back</span> Kembali
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
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    @foreach($icons as $iconName)
                        <label class="icon-option" style="cursor: pointer; border: 2px solid #E5E7EB; border-radius: 6px; padding: 10px; display: inline-flex; flex-direction: column; align-items: center; gap: 6px; width: 90px; background: #FFFFFF;">
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
                @error('icon_name') <div class="text-danger" style="font-size:13px;">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex align-items-center justify-content-end" style="gap:10px;">
                <a href="{{ route('admin.home-content.index') }}" class="btn btn-outline-secondary">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">close</span> Batal
                </a>
                <button type="submit" class="btn btn-success-dark">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">save</span> Perbarui
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<style>
    .icon-option.selected,
    .icon-option:has(.icon-radio:checked) {
        border-color: #009966 !important;
        background: #E6F7F0 !important;
    }
</style>
<script>
document.querySelectorAll('.icon-option').forEach(function(option) {
    option.addEventListener('click', function() {
        document.querySelectorAll('.icon-option').forEach(function(opt) {
            opt.classList.remove('selected');
            opt.style.borderColor = '#E5E7EB';
            opt.style.background = '#FFFFFF';
        });
        this.classList.add('selected');
        this.style.borderColor = '#009966';
        this.style.background = '#E6F7F0';
        var radio = this.querySelector('.icon-radio');
        radio.checked = true;
    });
});
</script>
@endsection
