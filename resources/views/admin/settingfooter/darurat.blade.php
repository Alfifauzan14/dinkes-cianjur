@extends('admin.layouts.admin')
@section('title', 'Layanan Darurat')
@section('header_title', 'Layanan Darurat')

@section('content')


<div class="row">
    <div class="col-12">
        <div class="card card-outline card-success">
            <div class="card-header d-flex align-items-center" style="padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
                <span class="material-icons text-danger">emergency</span>
                <span>Layanan Gawat Darurat (PSC 119)</span>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.settingfooter.update') }}" method="POST" id="setting-form">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="section" value="darurat">

                <div class="form-group">
                    <label for="emergency_call">Nomor Emergency Call <span class="text-danger">*</span></label>
                    <input type="text" name="emergency_call" id="emergency_call" value="{{ old('emergency_call', $setting->emergency_call) }}" class="form-control @error('emergency_call') is-invalid @enderror" required>
                    @error('emergency_call') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="emergency_title">Judul / Nama Layanan Darurat <span class="text-danger">*</span></label>
                    <input type="text" name="emergency_title" id="emergency_title" value="{{ old('emergency_title', $setting->emergency_title) }}" class="form-control @error('emergency_title') is-invalid @enderror" required>
                    @error('emergency_title') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="border-top pt-4 mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success px-4" id="btn-save-setting">
                        <span class="material-icons" style="font-size: 16px; vertical-align: middle; margin-right: 4px;">save</span> Simpan Layanan Darurat
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
    document.getElementById('setting-form').addEventListener('submit', function() {
        const btn = document.getElementById('btn-save-setting');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-sync-alt fa-spin mr-1"></i> Menyimpan...';
    });
</script>
@endsection
