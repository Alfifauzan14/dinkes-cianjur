@extends('admin.layouts.admin')
@section('title', 'Kelola Layanan Terpadu')
@section('header_title', 'Kelola Layanan Terpadu')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-3" style="gap:8px; border-radius: 3px;">
        <span class="material-icons">check_circle</span>
        <span>{{ session('success') }}</span>
        <button type="button" class="close ml-auto" data-dismiss="alert"><span>&times;</span></button>
    </div>
@endif

<div class="card card-outline card-success">
    <div class="card-header d-flex flex-wrap align-items-center" style="gap: 12px; padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
        <span class="d-flex align-items-center" style="gap: 8px;">
            <span class="material-icons text-success" style="font-size:20px;">widgets</span>
            <span class="font-weight-bold card-title-label">Kelola Layanan Terpadu</span>
        </span>

        <form action="{{ route('admin.layanan.index') }}" method="GET" class="d-flex flex-wrap align-items-center" style="gap: 8px;">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Cari layanan..." style="width: 220px;">
            <select name="type" class="custom-select custom-select-sm" onchange="this.form.submit()" style="width: 160px;">
                <option value="">Semua Kategori</option>
                <option value="Warga" {{ request('type') === 'Warga' ? 'selected' : '' }}>Layanan Warga</option>
                <option value="Faskes" {{ request('type') === 'Faskes' ? 'selected' : '' }}>Layanan Faskes</option>
                <option value="Nakes" {{ request('type') === 'Nakes' ? 'selected' : '' }}>Layanan Nakes</option>
            </select>
            @if(request('search') || request('type'))
                <a href="{{ route('admin.layanan.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
            @endif
        </form>

        <div class="d-flex ml-auto" style="gap: 8px;">
            <button type="button" class="btn btn-sm btn-outline-success d-flex align-items-center" style="gap: 4px;" data-toggle="modal" data-target="#modalKelolaLogo">
                <span class="material-icons" style="font-size:16px;">image</span> Ganti Logo Instansi
            </button>
            <a href="{{ route('admin.layanan.create') }}" class="btn btn-sm btn-success d-flex align-items-center" style="gap: 4px;">
                <span class="material-icons" style="font-size:16px;">add</span> Tambah Layanan
            </a>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width: 70px; text-align: center;">Icon</th>
                        <th>Nama Layanan</th>
                        <th style="width: 160px; text-align: center;">Segmen Penerima</th>
                        <th class="text-center" style="width: 100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($layanans as $layanan)
                    <tr>
                        <td style="text-align: center; vertical-align: middle;">
                            <div style="width:38px;height:38px;background:#E6F7F0;color:#009966;border-radius:3px;display:inline-flex;align-items:center;justify-content:center;">
                                @php
                                    $iconMap = ['users'=>'people','smile'=>'sentiment_satisfied_alt','chat'=>'chat','desktop'=>'desktop_windows','bag'=>'shopping_bag','globe'=>'language','file'=>'description'];
                                @endphp
                                <span class="material-icons" style="font-size:20px;">{{ $iconMap[$layanan->icon] ?? 'help_outline' }}</span>
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="font-weight-bold text-dark">{{ $layanan->name }}</div>
                            @if($layanan->processing_time || $layanan->tariff)
                                <small class="text-muted">
                                    @if($layanan->processing_time) Waktu: {{ $layanan->processing_time }} @endif
                                    @if($layanan->processing_time && $layanan->tariff) &bull; @endif
                                    @if($layanan->tariff) Biaya: {{ $layanan->tariff }} @endif
                                </small>
                            @endif
                        </td>
                        <td class="text-center align-middle">
                            @if($layanan->type === 'Warga')
                                <span class="badge" style="background:#DBEAFE;color:#1E40AF;padding:4px 10px;border-radius:3px;font-size:11px;font-weight:700;">Layanan Warga</span>
                            @elseif($layanan->type === 'Faskes')
                                <span class="badge" style="background:#EDE9FE;color:#5B21B6;padding:4px 10px;border-radius:3px;font-size:11px;font-weight:700;">Layanan Faskes</span>
                            @else
                                <span class="badge" style="background:#D1FAE5;color:#065F46;padding:4px 10px;border-radius:3px;font-size:11px;font-weight:700;">Layanan Nakes</span>
                            @endif
                        </td>

                        <td class="text-center align-middle">
                            <div class="btn-action-group">
                                <a href="{{ route('admin.layanan.edit', $layanan->id) }}" class="btn-action btn-action-edit" title="Edit">
                                    <span class="material-icons" style="font-size: 16px;">edit</span>
                                </a>
                                <form action="{{ route('admin.layanan.destroy', $layanan->id) }}" method="POST" id="del-layanan-{{ $layanan->id }}" style="margin: 0; display: inline;">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn-action btn-action-delete" title="Hapus"
                                        onclick="confirmDelete('del-layanan-{{ $layanan->id }}')">
                                        <span class="material-icons" style="font-size: 16px;">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">
                            <span class="material-icons" style="font-size: 48px; display: block; margin-bottom: 8px; color: #CBD5E1;">widgets</span>
                            <p class="font-weight-bold mb-1">Belum ada data layanan terpadu.</p>
                            @if(request('search') || request('type'))
                                <small class="text-muted">Tidak ada hasil pencarian yang sesuai.</small>
                            @else
                                <small class="text-muted">Klik <strong>"Tambah Layanan"</strong> untuk memulai penambahan layanan baru.</small>
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($layanans->hasPages())
        <div class="card-footer bg-white p-3 border-top">
            {{ $layanans->links() }}
        </div>
    @endif
</div>

{{-- Modal Kelola Logo Instansi & Mitra --}}
<div class="modal fade" id="modalKelolaLogo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 3px; border: 1px solid #CBD5E1;">
            <div class="modal-header" style="background:#F8FAFC; border-bottom: 1px solid #E2E8F0; padding: 14px 20px;">
                <h5 class="modal-title font-weight-bold d-flex align-items-center" style="font-size:15px; color:#1E293B; gap:8px;">
                    <span class="material-icons text-success" style="font-size:20px;">photo_library</span>
                    Ganti Gambar Logo Instansi & Mitra
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.layanan.logos.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <p class="text-muted" style="font-size: 13px; margin-bottom: 20px;">
                        Unggah logo instansi atau mitra kesehatan yang tampil di bagian bawah halaman Layanan Terpadu (Format: PNG transparan, WebP, SVG, Maks: 5MB).
                    </p>

                    @php
                        $defaultLogos = [
                            1 => ['label' => 'Logo 1 (Kemenkes RI)', 'path' => 'Assets/layanan-terpadu/Image-24.png'],
                            2 => ['label' => 'Logo 2 (SatuSehat / BPJS)', 'path' => 'Assets/layanan-terpadu/Image-25.png'],
                            3 => ['label' => 'Logo 3 (Pemkab Cianjur)', 'path' => 'Assets/layanan-terpadu/Image-26.png'],
                            4 => ['label' => 'Logo 4 (Dinas Kesehatan)', 'path' => 'Assets/layanan-terpadu/Image-27.png'],
                            5 => ['label' => 'Logo 5 (Germas / Mitra)', 'path' => 'Assets/layanan-terpadu/Image-28.png'],
                        ];
                    @endphp

                    <div class="row">
                        @for($i = 1; $i <= 5; $i++)
                            @php
                                $currentLogo = \App\Models\Setting::get("layanan_logo_{$i}", $defaultLogos[$i]['path']);
                            @endphp
                            <div class="col-md-6 col-12 mb-3">
                                <div class="p-3" style="border: 1px solid #E2E8F0; border-radius: 3px; background: #FFFFFF;">
                                    <label class="font-weight-bold d-block mb-2" style="font-size: 12.5px; color: #334155;">
                                        {{ $defaultLogos[$i]['label'] }}
                                    </label>
                                    <div class="d-flex align-items-center" style="gap: 12px;">
                                        <div style="width: 56px; height: 56px; background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 3px; display: flex; align-items: center; justify-content: center; padding: 4px;">
                                            <img src="{{ asset($currentLogo) }}" alt="Logo {{ $i }}" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                        </div>
                                        <div style="flex: 1;">
                                            <input type="file" name="logo_{{ $i }}" accept="image/*" class="form-control-file" style="font-size: 12px;">
                                            <small class="text-muted d-block mt-1" style="font-size: 11px;">Pilih berkas baru untuk mengganti</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
                <div class="modal-footer" style="background:#F8FAFC; border-top: 1px solid #E2E8F0; padding: 12px 20px;">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success font-weight-bold">
                        <span class="material-icons" style="font-size:16px; vertical-align:middle;">save</span> Simpan Perubahan Logo
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
