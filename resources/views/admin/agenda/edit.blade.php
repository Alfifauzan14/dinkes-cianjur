@extends('admin.layouts.admin')

@section('title', 'Ubah Agenda')
@section('header_title', 'Ubah Agenda Kegiatan')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/agenda.css') }}?v={{ time() }}">
@endsection

@section('content')
<div class="agenda-admin-wrapper">
    <div class="admin-card">
        
        <form action="{{ route('admin.agenda.update', $agenda->id) }}" method="POST" class="admin-form">
            @csrf
            @method('PUT')

            <!-- Nama Agenda -->
            <div class="form-group">
                <label for="title">Nama Kegiatan / Agenda</label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    value="{{ old('title', $agenda->title) }}" 
                    class="form-control-input" 
                    placeholder="Masukkan nama acara/kegiatan..."
                    required
                >
                @error('title')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group-row">
                <!-- Tanggal Kegiatan -->
                <div class="form-group">
                    <label for="date">Tanggal Kegiatan</label>
                    <input 
                        type="date" 
                        name="date" 
                        id="date" 
                        value="{{ old('date', $agenda->date->format('Y-m-d')) }}" 
                        class="form-control-input" 
                        required
                    >
                    @error('date')
                        <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Lokasi Kegiatan -->
                <div class="form-group">
                    <label for="location">Tempat / Lokasi</label>
                    <input 
                        type="text" 
                        name="location" 
                        id="location" 
                        value="{{ old('location', $agenda->location) }}" 
                        class="form-control-input" 
                        placeholder="Misal: Aula Dinkes, Posyandu Mawar..."
                        required
                    >
                    @error('location')
                        <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group-row">
                <!-- Waktu Mulai -->
                <div class="form-group">
                    <label for="time_start">Waktu Mulai</label>
                    <input 
                        type="text" 
                        name="time_start" 
                        id="time_start" 
                        value="{{ old('time_start', $agenda->time_start) }}" 
                        class="form-control-input" 
                        placeholder="Format: 08:00 atau 08.00"
                        required
                    >
                    @error('time_start')
                        <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Waktu Selesai -->
                <div class="form-group">
                    <label for="time_end">Waktu Selesai</label>
                    <input 
                        type="text" 
                        name="time_end" 
                        id="time_end" 
                        value="{{ old('time_end', $agenda->time_end) }}" 
                        class="form-control-input" 
                        placeholder="Format: 10:00 atau Selesai"
                        required
                    >
                    @error('time_end')
                        <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="form-group">
                <label for="description">Deskripsi Acara / Keterangan</label>
                <textarea 
                    name="description" 
                    id="description" 
                    class="form-textarea" 
                    placeholder="Masukkan rincian singkat agenda atau materi rapat..."
                >{{ old('description', $agenda->description) }}</textarea>
                @error('description')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Status Publikasi -->
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control-select" required>
                    <option value="published" {{ old('status', $agenda->status) == 'published' ? 'selected' : '' }}>Diterbitkan (Tampil di Publik)</option>
                    <option value="draft" {{ old('status', $agenda->status) == 'draft' ? 'selected' : '' }}>Draf (Sembunyikan)</option>
                </select>
                @error('status')
                    <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tombol Aksi -->
            <div style="display: flex; gap: 16px; margin-top: 12px;">
                <button type="submit" class="btn-admin btn-admin-primary">
                    <span class="material-icons">save</span>
                    <span>Simpan Perubahan</span>
                </button>
                <a href="{{ route('admin.agenda.index') }}" class="btn-admin btn-admin-secondary">
                    <span>Batal</span>
                </a>
            </div>

        </form>

    </div>
</div>
@endsection
