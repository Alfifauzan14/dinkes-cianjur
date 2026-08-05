@extends('admin.layouts.admin')
@section('title', 'Media Sosial')
@section('header_title', 'Media Sosial')

@section('content')


<div class="row">
    <div class="col-12">
        <div class="card card-outline card-success">
            <div class="card-header d-flex align-items-center" style="padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
                <span class="material-icons text-success">share</span>
                <span>Tautan Media Sosial Resmi</span>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.settingfooter.update') }}" method="POST" id="setting-form">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="section" value="sosmed">

                <div class="form-group">
                    <label for="social_facebook"><i class="fab fa-facebook mr-1" style="color: #1877F2;"></i> Link Facebook</label>
                    <input type="url" name="social_facebook" id="social_facebook" value="{{ old('social_facebook', $setting->social_facebook) }}" class="form-control @error('social_facebook') is-invalid @enderror" placeholder="https://facebook.com/username">
                    @error('social_facebook') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="social_instagram"><i class="fab fa-instagram mr-1" style="color: #E1306C;"></i> Link Instagram</label>
                    <input type="url" name="social_instagram" id="social_instagram" value="{{ old('social_instagram', $setting->social_instagram) }}" class="form-control @error('social_instagram') is-invalid @enderror" placeholder="https://instagram.com/username">
                    @error('social_instagram') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="social_twitter"><i class="fab fa-twitter mr-1" style="color: #1DA1F2;"></i> Link X (Twitter)</label>
                    <input type="url" name="social_twitter" id="social_twitter" value="{{ old('social_twitter', $setting->social_twitter) }}" class="form-control @error('social_twitter') is-invalid @enderror" placeholder="https://x.com/username">
                    @error('social_twitter') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="social_youtube"><i class="fab fa-youtube mr-1" style="color: #FF0000;"></i> Link YouTube</label>
                    <input type="url" name="social_youtube" id="social_youtube" value="{{ old('social_youtube', $setting->social_youtube) }}" class="form-control @error('social_youtube') is-invalid @enderror" placeholder="https://youtube.com/channel/id">
                    @error('social_youtube') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="social_tiktok"><i class="fab fa-tiktok mr-1" style="color: #010101;"></i> Link TikTok</label>
                    <input type="url" name="social_tiktok" id="social_tiktok" value="{{ old('social_tiktok', $setting->social_tiktok) }}" class="form-control @error('social_tiktok') is-invalid @enderror" placeholder="https://tiktok.com/@username">
                    @error('social_tiktok') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="border-top pt-4 mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success px-4" id="btn-save-setting">
                        <span class="material-icons" style="font-size: 16px; vertical-align: middle; margin-right: 4px;">save</span> Simpan Media Sosial
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
