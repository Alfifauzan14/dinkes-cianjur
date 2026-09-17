@extends('admin.layouts.admin')
@section('title', 'Detail Permohonan Informasi Publik')
@section('header_title', 'Detail Permohonan ' . $permohonan->token)

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.ppid.permohonan.index') }}" class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center" style="gap: 4px;">
        <span class="material-icons" style="font-size: 16px;">arrow_back</span> Kembali ke Daftar
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-3" style="gap:8px; border-radius: 3px;">
        <span class="material-icons">check_circle</span>
        <span>{{ session('success') }}</span>
        <button type="button" class="close ml-auto" data-dismiss="alert"><span>&times;</span></button>
    </div>
@endif

<div class="row">
    {{-- Sisi Kiri: Detail Informasi --}}
    <div class="col-lg-8 col-12">
        <div class="card card-outline card-success mb-4">
            <div class="card-header bg-white" style="padding: 16px 20px; border-bottom: 1px solid #E2E8F0;">
                <span class="d-flex align-items-center" style="gap: 8px;">
                    <span class="material-icons text-success" style="font-size: 20px;">badge</span>
                    <span class="font-weight-bold card-title-label">Identitas Pemohon</span>
                </span>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6 col-12 mb-3">
                        <label class="text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase;">Nama Lengkap</label>
                        <div class="text-dark font-weight-bold" style="font-size: 15px;">{{ $permohonan->nama_pemohon }}</div>
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <label class="text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase;">NIK</label>
                        <div class="text-dark font-weight-bold" style="font-size: 15px; letter-spacing: 0.5px;">{{ $permohonan->nik }}</div>
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <label class="text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase;">Nomor HP / WhatsApp</label>
                        <div class="text-dark font-weight-bold" style="font-size: 15px;">{{ $permohonan->no_hp }}</div>
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <label class="text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase;">Email</label>
                        <div class="text-dark font-weight-bold" style="font-size: 15px;">{{ $permohonan->email ?? '-' }}</div>
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <label class="text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase;">Pekerjaan</label>
                        <div class="text-dark font-weight-bold" style="font-size: 15px;">{{ $permohonan->pekerjaan }}</div>
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <label class="text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase;">Alamat Lengkap</label>
                        <div class="text-dark" style="font-size: 14.5px; line-height: 1.5;">{{ $permohonan->alamat }}</div>
                    </div>
                </div>

                {{-- Lampiran KTP --}}
                <div class="border-top pt-4 mt-2">
                    <label class="text-muted font-weight-bold d-block mb-3" style="font-size: 11px; text-transform: uppercase;">Dokumen Identitas (KTP)</label>
                    @php
                        $isPdf = str_ends_with(strtolower($permohonan->foto_ktp), '.pdf');
                    @endphp
                    @if($isPdf)
                        <div class="p-3 border rounded d-flex align-items-center justify-content-between" style="background:#F8FAFC; border-color:#E2E8F0; border-radius: 3px;">
                            <span class="d-flex align-items-center" style="gap: 10px;">
                                <span class="material-icons text-danger" style="font-size: 32px;">picture_as_pdf</span>
                                <div>
                                    <div class="font-weight-bold text-dark" style="font-size: 14px;">Dokumen Identitas KTP.pdf</div>
                                    <div class="text-muted" style="font-size: 12px;">Format PDF</div>
                                </div>
                            </span>
                            <a href="{{ asset('storage/' . $permohonan->foto_ktp) }}" target="_blank" class="btn btn-sm btn-success font-weight-bold d-inline-flex align-items-center" style="gap: 4px;">
                                <span class="material-icons" style="font-size: 16px;">visibility</span> Lihat PDF
                            </a>
                        </div>
                    @else
                        <div class="d-inline-block border p-2 mb-2" style="background:#F8FAFC; border-color:#CBD5E1; border-radius: 3px;">
                            <img src="{{ asset('storage/' . $permohonan->foto_ktp) }}" alt="KTP Pemohon" class="img-fluid" style="max-height: 200px; object-fit: cover; border-radius: 2px;">
                        </div>
                        <div class="mt-1">
                            <a href="{{ asset('storage/' . $permohonan->foto_ktp) }}" target="_blank" class="btn btn-sm btn-outline-success font-weight-bold d-inline-flex align-items-center" style="gap: 4px;">
                                <span class="material-icons" style="font-size: 16px;">open_in_new</span> Lihat Ukuran Penuh
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Card Detail Permohonan --}}
        <div class="card card-outline card-success mb-4">
            <div class="card-header bg-white" style="padding: 16px 20px; border-bottom: 1px solid #E2E8F0;">
                <span class="d-flex align-items-center" style="gap: 8px;">
                    <span class="material-icons text-success" style="font-size: 20px;">help_outline</span>
                    <span class="font-weight-bold card-title-label">Detail Permohonan Informasi</span>
                </span>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6 col-12 mb-3">
                        <label class="text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase;">Jenis Informasi</label>
                        <div>
                            <span class="badge" style="background-color: #E2E8F0; color: #475569; font-size: 12px; padding: 5px 10px; border-radius: 3px; font-weight: 700;">
                                {{ str_replace('_', ' ', ucwords($permohonan->jenis_informasi)) }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <label class="text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase;">Tujuan Penggunaan</label>
                        <div>
                            <span class="badge" style="background-color: #E2E8F0; color: #475569; font-size: 12px; padding: 5px 10px; border-radius: 3px; font-weight: 700;">
                                {{ str_replace('_', ' ', ucwords($permohonan->tujuan_penggunaan)) }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <label class="text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase;">Cara Memperoleh</label>
                        <div class="text-dark font-weight-bold" style="font-size: 14.5px;">{{ ucwords($permohonan->cara_memperoleh) }}</div>
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <label class="text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase;">Format Informasi Diinginkan</label>
                        <div>
                            @if(is_array($permohonan->format_informasi) && count($permohonan->format_informasi) > 0)
                                @foreach($permohonan->format_informasi as $fmt)
                                    <span class="badge badge-light border text-dark px-2 py-1 mr-1" style="font-size: 11.5px; border-radius: 3px;">{{ ucwords($fmt) }}</span>
                                @endforeach
                            @else
                                <span class="text-muted" style="font-size: 13.5px; font-style: italic;">Tidak ada format khusus dipilih</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 mb-3 border-top pt-3">
                        <label class="text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase;">Rincian Informasi yang Diminta</label>
                        <div class="p-3 text-dark" style="font-size: 14.5px; line-height: 1.6; background:#F8FAFC; border: 1px solid #E2E8F0; border-left: 4px solid #009966; border-radius: 3px; white-space: pre-wrap;">{{ $permohonan->rincian_informasi }}</div>
                    </div>
                    <div class="col-12 mb-0">
                        <label class="text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase;">Alasan Permohonan</label>
                        <div class="p-3 text-dark" style="font-size: 14.5px; line-height: 1.6; background:#F8FAFC; border: 1px solid #E2E8F0; border-left: 4px solid #64748B; border-radius: 3px; white-space: pre-wrap;">{{ $permohonan->alasan_permohonan ?? 'Tidak ada alasan khusus yang dicantumkan' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Sisi Kanan: Action & Status --}}
    <div class="col-lg-4 col-12">
        <div class="card card-outline card-success mb-4">
            <div class="card-header bg-white" style="padding: 16px 20px; border-bottom: 1px solid #E2E8F0;">
                <span class="d-flex align-items-center" style="gap: 8px;">
                    <span class="material-icons text-success" style="font-size: 20px;">tune</span>
                    <span class="font-weight-bold card-title-label">Kelola Status</span>
                </span>
            </div>
            <div class="card-body p-4">
                {{-- Status Saat Ini --}}
                <div class="mb-4">
                    <label class="text-muted font-weight-bold d-block mb-1" style="font-size: 11px; text-transform: uppercase;">Status Saat Ini</label>
                    @if($permohonan->status === 'pending')
                        <span class="badge px-3 py-2 font-weight-bold" style="background-color: #FEF3C7; color: #D97706; border-radius: 3px; font-size: 12.5px; display: inline-block;">
                            Menunggu Review (Pending)
                        </span>
                    @elseif($permohonan->status === 'disetujui')
                        <span class="badge px-3 py-2 font-weight-bold" style="background-color: #DEF7EC; color: #03543F; border-radius: 3px; font-size: 12.5px; display: inline-block;">
                            Disetujui
                        </span>
                    @else
                        <span class="badge px-3 py-2 font-weight-bold" style="background-color: #FDE8E8; color: #9B1C1C; border-radius: 3px; font-size: 12.5px; display: inline-block;">
                            Ditolak
                        </span>
                    @endif
                </div>

                @if($permohonan->file_tanggapan)
                    <div class="mb-4">
                        <label class="text-muted font-weight-bold d-block mb-1" style="font-size: 11px; text-transform: uppercase;">Dokumen Terkirim</label>
                        <div class="p-2 border d-flex align-items-center justify-content-between" style="background:#F8FAFC; border-color:#E2E8F0; border-radius: 3px;">
                            <span class="d-flex align-items-center overflow-hidden" style="gap: 8px;">
                                <span class="material-icons text-success" style="font-size: 18px;">description</span>
                                <span class="text-truncate text-dark font-weight-bold" style="font-size: 13px; max-width: 140px;" title="{{ basename($permohonan->file_tanggapan) }}">
                                    {{ basename($permohonan->file_tanggapan) }}
                                </span>
                            </span>
                            <a href="{{ asset('storage/' . $permohonan->file_tanggapan) }}" target="_blank" class="btn btn-xs btn-outline-success font-weight-bold py-1 px-2 d-inline-flex align-items-center" style="gap: 3px; font-size: 11px;">
                                <span class="material-icons" style="font-size: 12px;">visibility</span> Lihat
                            </a>
                        </div>
                    </div>
                @endif

                @if(!$permohonan->email)
                    <div class="alert alert-warning py-2 px-3 mb-3 d-flex align-items-center" style="font-size: 12px; border-radius: 3px; border-left: 3px solid #D97706; color: #92400E; background-color: #FEF3C7; border-color: #FCD34D;">
                        <span class="material-icons mr-2" style="font-size: 18px;">warning</span>
                        <span>Pemohon tidak menyertakan email. Tanggapan & dokumen tidak dapat dikirim via email.</span>
                    </div>
                @endif

                <form action="{{ route('admin.ppid.permohonan.update-status', $permohonan->id) }}" method="POST" enctype="multipart/form-data" class="border-top pt-3">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="status" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">Ubah Status <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-control custom-select" required>
                            <option value="pending" {{ $permohonan->status === 'pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                            <option value="disetujui" {{ $permohonan->status === 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="ditolak" {{ $permohonan->status === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="tanggapan" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">Tanggapan / Catatan Admin</label>
                        <textarea name="tanggapan" id="tanggapan" rows="5" class="form-control" placeholder="Tulis catatan, nomor surat, alasan persetujuan/penolakan, atau info pengambilan informasi di sini..." style="font-size: 13.5px;">{{ old('tanggapan', $permohonan->tanggapan) }}</textarea>
                        <small class="text-muted d-block mt-1">Tanggapan ini akan disimpan sebagai catatan untuk pemrosesan permohonan.</small>
                    </div>

                    <div class="form-group mb-4">
                        <label for="file_tanggapan" class="font-weight-bold" style="font-size: 13px; color: #1E293B;">Dokumen Pendukung / Data yang Diminta</label>
                        <input type="file" name="file_tanggapan" id="file_tanggapan" class="form-control-file" style="font-size: 13px;">
                        <small class="text-muted d-block mt-1">Format: PDF, Word, Excel, ZIP, dll. (Maks. 20MB). File ini akan dikirimkan ke email pemohon sebagai lampiran.</small>
                    </div>

                    <button type="submit" class="btn btn-success btn-block font-weight-bold d-flex align-items-center justify-content-center" style="gap: 6px; padding: 10px;">
                        <span class="material-icons" style="font-size: 18px;">save</span> Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
