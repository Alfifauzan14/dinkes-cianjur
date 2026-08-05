@extends('admin.layouts.admin')
@section('title', 'Tata Cara & Aksi PPID')
@section('header_title', 'Tata Cara & Aksi PPID')

@section('styles')
<style>
    .custom-form-card {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: var(--card-shadow);
        border: none;
        padding: 30px;
        margin-bottom: 24px;
    }
    .form-section-title {
        font-size: 16px;
        font-weight: 700;
        color: #004F3B;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
        border-bottom: 1px solid var(--border-subtle);
        padding-bottom: 10px;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-12">

        <div class="custom-form-card">
            <form action="{{ route('admin.ppid.update') }}" method="POST" id="ppid-form">
                @csrf
                @method('PUT')
                <input type="hidden" name="section" value="tatacara">

                <div class="form-section-title">
                    <span class="material-icons text-success">playlist_add_check</span>
                    <span>Tata Cara Permohonan Informasi</span>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tata_cara_badge">Badge Tata Cara</label>
                            <input type="text" name="tata_cara_badge" id="tata_cara_badge" value="{{ old('tata_cara_badge', $ppid->tata_cara_badge) }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="tata_cara_heading">Heading Tata Cara</label>
                            <input type="text" name="tata_cara_heading" id="tata_cara_heading" value="{{ old('tata_cara_heading', $ppid->tata_cara_heading) }}" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-section-title mt-4">
                    <span class="material-icons text-success">check_double</span>
                    <span>Data 4 Langkah Tata Cara</span>
                </div>

                <div class="row border-bottom pb-4 mb-4">
                    @foreach(range(1, 4) as $i)
                        <div class="col-md-6 mb-3">
                            <div class="card p-3 mb-0" style="background:#F8FAFC; border:1px solid var(--border-subtle); border-radius:8px;">
                                <span class="badge badge-success mb-3 align-self-start" style="padding: 4px 10px; font-weight: 700; border-radius: 4px;">LANGKAH {{ $i }}</span>
                                <div class="form-group mb-2">
                                    <label style="font-size:11.5px; font-weight:700; color:#475569;">Judul Langkah</label>
                                    <input type="text" name="tata_cara_card_{{ $i }}_title" value="{{ old('tata_cara_card_'.$i.'_title', $ppid->{'tata_cara_card_'.$i.'_title'}) }}" class="form-control form-control-sm">
                                </div>
                                <div class="form-group mb-0">
                                    <label style="font-size:11.5px; font-weight:700; color:#475569;">Penjelasan Deskripsi</label>
                                    <textarea name="tata_cara_card_{{ $i }}_text" rows="2" class="form-control form-control-sm">{{ old('tata_cara_card_'.$i.'_text', $ppid->{'tata_cara_card_'.$i.'_text'}) }}</textarea>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="form-section-title">
                    <span class="material-icons text-success">mouse</span>
                    <span>Tautan Tombol Aksi di Bawah</span>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="card p-3" style="background:#F8FAFC; border:1px solid var(--border-subtle); border-radius:8px;">
                            <span class="badge badge-info mb-3 align-self-start" style="padding: 4px 10px; font-weight: 700; border-radius: 4px;">TOMBOL DAFTAR PPID</span>
                            <div class="form-group mb-2">
                                <label style="font-size:11.5px; font-weight:700; color:#475569;">Label Tombol</label>
                                <input type="text" name="btn_daftar_label" value="{{ old('btn_daftar_label', $ppid->btn_daftar_label) }}" class="form-control form-control-sm">
                            </div>
                            <div class="form-group mb-0">
                                <label style="font-size:11.5px; font-weight:700; color:#475569;">URL Redirect</label>
                                <input type="text" name="btn_daftar_url" value="{{ old('btn_daftar_url', $ppid->btn_daftar_url) }}" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card p-3" style="background:#F8FAFC; border:1px solid var(--border-subtle); border-radius:8px;">
                            <span class="badge badge-info mb-3 align-self-start" style="padding: 4px 10px; font-weight: 700; border-radius: 4px;">TOMBOL LOGIN PPID</span>
                            <div class="form-group mb-2">
                                <label style="font-size:11.5px; font-weight:700; color:#475569;">Label Tombol</label>
                                <input type="text" name="btn_login_label" value="{{ old('btn_login_label', $ppid->btn_login_label) }}" class="form-control form-control-sm">
                            </div>
                            <div class="form-group mb-0">
                                <label style="font-size:11.5px; font-weight:700; color:#475569;">URL Redirect</label>
                                <input type="text" name="btn_login_url" value="{{ old('btn_login_url', $ppid->btn_login_url) }}" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-top pt-4 mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success px-4" id="ppid-save-btn">
                        <span class="material-icons" style="font-size: 16px; vertical-align: middle; margin-right: 4px;">save</span> Simpan Tata Cara &amp; Aksi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('ppid-form').addEventListener('submit', function() {
        const btn = document.getElementById('ppid-save-btn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-sync-alt fa-spin mr-1"></i> Menyimpan...';
    });
</script>
@endsection
