@extends('admin.layouts.admin')

@section('title', 'Edit Kartu Pagoda Sehat')
@section('header_title', 'Edit Kartu Pagoda Sehat')

@section('content')


<div class="card card-outline card-success">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between" style="gap: 12px; padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
        <span class="d-flex align-items-center" style="gap: 8px;">
            <span class="material-icons text-success" style="font-size:20px;">edit_note</span>
            <span class="font-weight-bold card-title-label">Edit Kartu Pagoda Sehat</span>
        </span>
        <a href="{{ route('admin.pagodasehat.index') }}" class="btn btn-sm btn-outline-secondary ml-auto">
            <span class="material-icons" style="font-size:16px;">arrow_back</span> Kembali
        </a>
    </div>

    <div class="card-body" style="padding: 24px;">
        <form action="{{ route('admin.pagodasehat.update', $pagodasehat->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title" class="font-weight-bold" style="font-size: 13.5px; color: #1E293B;">Judul Kartu <span class="text-danger">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $pagodasehat->title) }}"
                    class="form-control @error('title') is-invalid @enderror"
                    placeholder="Contoh: Dinas Kesehatan" required>
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="description" class="font-weight-bold" style="font-size: 13.5px; color: #1E293B;">Deskripsi</label>
                <textarea name="description" id="description" rows="3"
                    class="form-control @error('description') is-invalid @enderror"
                    placeholder="Contoh: Visi misi, struktur organisasi, dan kontak resmi Dinas Kesehatan Cianjur.">{{ old('description', $pagodasehat->description) }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="image" class="font-weight-bold" style="font-size: 13.5px; color: #1E293B;">Gambar Kartu</label>
                @if($pagodasehat->image)
                    <div style="margin-bottom: 8px;">
                        @if(str_starts_with($pagodasehat->image, 'Assets/') || str_starts_with($pagodasehat->image, 'uploads/'))
                            <img src="{{ asset($pagodasehat->image) }}" alt="Gambar saat ini" style="max-width: 80px; max-height: 80px; border: 1px solid #E5E7EB; border-radius: 3px; padding: 4px;">
                        @else
                            <img src="{{ asset('storage/' . $pagodasehat->image) }}" alt="Gambar saat ini" style="max-width: 80px; max-height: 80px; border: 1px solid #E5E7EB; border-radius: 3px; padding: 4px;">
                        @endif
                    </div>
                @endif
                <input type="file" name="image" id="image" accept="image/*"
                    class="form-control-file @error('image') is-invalid @enderror">
                <small class="form-text text-muted">Format: PNG, JPG, WebP, SVG. Maks 5MB. Kosongkan jika tidak ingin mengganti.</small>
                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="url" class="font-weight-bold" style="font-size: 13.5px; color: #1E293B;">
                    Link Tujuan / Tombol Cepat <small class="text-muted font-weight-normal">(Opsional)</small>
                </label>
                <div class="row">
                    <div class="col-md-5 col-12 mb-2">
                        <select id="url_preset" class="custom-select" onchange="applyUrlPreset(this.value)">
                            <option value="" selected>-- Pilih Pintasan Cepat --</option>
                            <optgroup label="Profil & Layanan">
                                <option value="/profil/tentang-dinkes">Profil Dinkes (/profil/tentang-dinkes)</option>
                                <option value="/profil/visi-misi">Visi & Misi (/profil/visi-misi)</option>
                                <option value="/profil/struktur-organisasi">Struktur Organisasi (/profil/struktur-organisasi)</option>
                                <option value="/layanan-terpadu">Layanan Terpadu (/layanan-terpadu)</option>
                                <option value="/faskes">Peta & Info Faskes (/faskes)</option>
                                <option value="/labkesda">Layanan Labkesda (/labkesda)</option>
                            </optgroup>
                            <optgroup label="Program Prioritas Kesehatan">
                                <option value="/program/cianjur-bebas-stunting">Program Cianjur Bebas Stunting</option>
                                <option value="/program/kesehatan-ibu-anak">Program Kesehatan Ibu & Anak (KIA)</option>
                            </optgroup>
                            <optgroup label="PPID & Partisipasi Publik">
                                <option value="/ppid">Portal PPID (/ppid)</option>
                                <option value="/permohonan">Permohonan Informasi (/permohonan)</option>
                                <option value="/cek-status">Cek Status Permohonan (/cek-status)</option>
                                <option value="/ikm">Indeks Kepuasan Masyarakat (/ikm)</option>
                            </optgroup>
                            <optgroup label="Berita, Media & Satu Data">
                                <option value="/berita">Berita & Artikel (/berita)</option>
                                <option value="/agenda">Agenda Kegiatan (/agenda)</option>
                                <option value="/media/galeri-kegiatan">Galeri Foto Kegiatan</option>
                                <option value="/media/infografis">Infografis Kesehatan</option>
                                <option value="/satu-data/statistik">Satu Data Kesehatan (Statistik)</option>
                                <option value="/satu-data/laporan">Satu Data Kesehatan (Laporan)</option>
                                <option value="/satu-data/regulasi">Satu Data Kesehatan (Regulasi)</option>
                            </optgroup>
                            <optgroup label="Layanan Eksternal / Nasional">
                                <option value="https://satusehat.kemkes.go.id">SatuSehat Kemenkes RI</option>
                                <option value="https://bpjs-kesehatan.go.id">BPJS Kesehatan</option>
                                <option value="https://kemkes.go.id">Kementerian Kesehatan RI</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="col-md-7 col-12">
                        <input type="text" name="url" id="url" value="{{ old('url', $pagodasehat->url) }}"
                            class="form-control @error('url') is-invalid @enderror"
                            placeholder="Contoh: /profil/tentang-dinkes atau https://...">
                    </div>
                </div>
                <small class="text-muted d-block mt-1" style="font-size: 12px;">
                    <span class="material-icons text-success" style="font-size:14px; vertical-align:text-bottom;">info</span>
                    Pilih salah satu pintasan di atas untuk otomatis mengisi link, atau ketik link tujuan kustom secara manual.
                </small>
                @error('url') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>

            <script>
                function applyUrlPreset(val) {
                    if (val) {
                        document.getElementById('url').value = val;
                    }
                }
            </script>

            <div class="d-flex align-items-center justify-content-end" style="gap:10px;">
                <a href="{{ route('admin.pagodasehat.index') }}" class="btn btn-outline-secondary">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">close</span> Batal
                </a>
                <button type="submit" class="btn btn-success font-weight-bold">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">save</span> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
