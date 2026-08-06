@extends('admin.layouts.admin')

@section('title', 'Ubah Agenda')
@section('header_title', 'Ubah Agenda Kegiatan')

@section('content')


<div class="card card-outline card-success">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span class="font-weight-bold text-muted" style="font-size:13px;">
            <span class="material-icons text-warning" style="font-size:16px;vertical-align:middle;">event</span>
            Formulir Edit Agenda
        </span>
        <a href="{{ route('admin.agenda.index') }}" class="btn btn-sm btn-outline-secondary">
            <span class="material-icons" style="font-size:15px;vertical-align:middle;">arrow_back</span> Kembali
        </a>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.agenda.update', $agenda->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Nama Kegiatan / Agenda <span class="text-danger">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $agenda->title) }}"
                    class="form-control @error('title') is-invalid @enderror"
                    placeholder="Masukkan nama acara/kegiatan..." required>
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="date">Tanggal Kegiatan <span class="text-danger">*</span></label>
                        <input type="date" name="date" id="date" value="{{ old('date', $agenda->date->format('Y-m-d')) }}"
                            class="form-control @error('date') is-invalid @enderror" required>
                        @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="location">Tempat / Lokasi <span class="text-danger">*</span></label>
                        <input type="text" name="location" id="location" value="{{ old('location', $agenda->location) }}"
                            class="form-control @error('location') is-invalid @enderror"
                            placeholder="Misal: Aula Dinkes, Posyandu Mawar..." required>
                        @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="time_start">Waktu Mulai <span class="text-danger">*</span></label>
                        <input type="text" name="time_start" id="time_start" value="{{ old('time_start', $agenda->time_start) }}"
                            class="form-control @error('time_start') is-invalid @enderror"
                            placeholder="Format: 08:00 atau 08.00" required>
                        @error('time_start') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="time_end">Waktu Selesai <span class="text-danger">*</span></label>
                        <input type="text" name="time_end" id="time_end" value="{{ old('time_end', $agenda->time_end) }}"
                            class="form-control @error('time_end') is-invalid @enderror"
                            placeholder="Format: 10:00 atau Selesai" required>
                        @error('time_end') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="description">Deskripsi Acara / Keterangan</label>
                <textarea name="description" id="description" rows="4"
                    class="form-control @error('description') is-invalid @enderror"
                    placeholder="Masukkan rincian singkat agenda atau materi rapat...">{{ old('description', $agenda->description) }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="status">Status <span class="text-danger">*</span></label>
                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                    <option value="published" {{ old('status', $agenda->status) == 'published' ? 'selected' : '' }}>Diterbitkan (Tampil di Publik)</option>
                    <option value="draft" {{ old('status', $agenda->status) == 'draft' ? 'selected' : '' }}>Draf (Sembunyikan)</option>
                </select>
                @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex align-items-center justify-content-end" style="gap:10px;">
                <a href="{{ route('admin.agenda.index') }}" class="btn btn-outline-secondary">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">close</span> Batal
                </a>
                <button type="submit" class="btn btn-success-dark">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">save</span> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
