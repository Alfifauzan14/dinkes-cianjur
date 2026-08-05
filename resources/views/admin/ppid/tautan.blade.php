@extends('admin.layouts.admin')
@section('title', 'Tautan PPID')
@section('header_title', 'Tautan PPID')

@section('content')
@include('admin.partials.alerts')

<div class="row">
    <div class="col-12">
        <div class="card card-outline card-success">
            <div class="card-header d-flex align-items-center" style="padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
                <span class="material-icons text-success">link</span>
                <span>Pengaturan Seksi Tautan PPID</span>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.ppid.update') }}" method="POST" id="ppid-form">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="section" value="tautan">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tautan_badge">Badge Tautan</label>
                            <input type="text" name="tautan_badge" id="tautan_badge" value="{{ old('tautan_badge', $ppid->tautan_badge) }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="tautan_title">Judul Seksi Tautan</label>
                            <input type="text" name="tautan_title" id="tautan_title" value="{{ old('tautan_title', $ppid->tautan_title) }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="tautan_subtitle">Subjudul Seksi Tautan</label>
                            <input type="text" name="tautan_subtitle" id="tautan_subtitle" value="{{ old('tautan_subtitle', $ppid->tautan_subtitle) }}" class="form-control">
                        </div>
                    </div>
                </div>

                <div style="font-size:15px;font-weight:700;color:#004F3B;margin:24px 0 16px;display:flex;align-items:center;gap:8px;border-bottom:1px solid #E2E8F0;padding-bottom:10px;">
                    <span class="material-icons text-success">list</span>
                    <span>Daftar 5 Tautan Publik</span>
                </div>

                <div class="row">
                    @foreach(range(1, 5) as $i)
                        <div class="col-md-6 mb-3">
                            <div class="card p-3" style="background: #F8FAFC; border: 1px solid var(--border-subtle); border-radius: 8px;">
                                <span class="badge badge-success mb-3 align-self-start" style="padding: 4px 10px; font-weight: 700; border-radius: 4px;">TAUTAN {{ $i }}</span>
                                <div class="form-group mb-2">
                                    <label style="font-size: 11.5px; font-weight: 700; color: #475569;">Label Tombol</label>
                                    <input type="text" name="tautan_{{ $i }}_label" value="{{ old('tautan_'.$i.'_label', $ppid->{'tautan_'.$i.'_label'}) }}" class="form-control form-control-sm">
                                </div>
                                <div class="form-group mb-0">
                                    <label style="font-size: 11.5px; font-weight: 700; color: #475569;">Alamat URL Link</label>
                                    <input type="text" name="tautan_{{ $i }}_url" value="{{ old('tautan_'.$i.'_url', $ppid->{'tautan_'.$i.'_url'}) }}" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="border-top pt-4 mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success px-4" id="ppid-save-btn">
                        <span class="material-icons" style="font-size: 16px; vertical-align: middle; margin-right: 4px;">save</span> Simpan Tautan
                    </button>
                </div>
            </form>
            </div>
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
