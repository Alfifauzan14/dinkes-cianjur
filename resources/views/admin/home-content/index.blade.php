@extends('admin.layouts.admin')

@section('title', 'Edit Info Card')
@section('header_title', 'Edit Info Card')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" style="gap:8px; margin-bottom:16px;">
        <span class="material-icons">check_circle</span>
        <span>{{ session('success') }}</span>
        <button type="button" class="close ml-auto" data-dismiss="alert"><span>&times;</span></button>
    </div>
@endif

<div class="card card-outline card-success">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between" style="gap: 12px;">
        <span class="d-flex align-items-center" style="gap: 8px;">
            <span class="material-icons text-success">home</span>
            <span class="font-weight-bold card-title-label">Kelola Info Card & Sosial Media</span>
        </span>
    </div>

    <div class="card-body p-0">
        {{-- Info Cards Table --}}
        <div style="padding: 16px 20px 8px; border-bottom: 1px solid #E2E8F0;">
            <h6 class="font-weight-bold text-dark mb-1">Info Card Beranda</h6>
            <p class="text-muted mb-0" style="font-size: 13px;">Edit kartu informasi di halaman beranda. Kartu tidak dapat ditambah atau dihapus.</p>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width: 70px; text-align: center;">Ikon</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th style="width: 100px; text-align: center;">Urutan</th>
                        <th style="width: 100px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cards as $card)
                        <tr>
                            <td class="text-center align-middle">
                                <div style="width: 44px; height: 44px; background-color: #E6F7F0; border-radius: 3px; display: inline-flex; align-items: center; justify-content: center;">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#009966" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        @include('admin.home-content.icon', ['icon' => $card->icon_name])
                                    </svg>
                                </div>
                            </td>
                            <td class="align-middle">
                                <div class="font-weight-bold text-dark">{{ $card->title }}</div>
                            </td>
                            <td class="align-middle">
                                <div class="text-muted" style="font-size: 13px; max-width: 340px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $card->description ?: '-' }}</div>
                            </td>
                            <td class="text-center align-middle text-muted" style="font-size: 14px;">
                                {{ $loop->iteration }}
                            </td>
                            <td class="text-center align-middle">
                                <div class="btn-action-group" style="justify-content: center;">
                                    <a href="{{ route('admin.home-content.edit', $card->id) }}" class="btn-action btn-action-edit" title="Edit">
                                        <span class="material-icons">edit</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center" style="padding: 40px; color: #94A3B8;">
                                <span class="material-icons" style="font-size: 40px; display: block; margin-bottom: 8px; color: #CBD5E1;">info</span>
                                Belum ada Info Card.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Social Media Card --}}
<div class="card card-outline card-success">
    <div class="card-header d-flex align-items-center" style="gap: 8px;">
        <span class="material-icons text-success">share</span>
        <span class="font-weight-bold card-title-label">Kelola Link Media Sosial</span>
        <span class="badge badge-success ml-2" style="font-size: 11px; font-weight: 600;">Beranda &amp; Footer</span>
    </div>

    <div class="card-body">
        <p class="text-muted mb-3" style="font-size: 13px;">Edit link media sosial. Perubahan akan langsung berlaku di <strong>halaman beranda</strong> dan <strong>footer</strong> website. Kosongkan jika belum ada.</p>

        <form action="{{ route('admin.home-content.social.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                @foreach($socialLinks->sortBy('order_index') as $link)
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="social_{{ $link->platform }}">
                                <i class="fa-brands fa-{{ $link->platform === 'facebook' ? 'facebook-f' : $link->platform }}" style="color: #009966; margin-right: 6px;"></i>
                                {{ ucfirst($link->platform) }}
                            </label>
                            <input
                                type="url"
                                name="social_links[{{ $link->platform }}][url]"
                                id="social_{{ $link->platform }}"
                                value="{{ old('social_links.' . $link->platform . '.url', $link->url) }}"
                                class="form-control"
                                placeholder="https://"
                            >
                            @error('social_links.'.$link->platform.'.url')
                                <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-end" style="margin-top: 8px;">
                <button type="submit" class="btn btn-success">
                    <span class="material-icons" style="font-size:16px;vertical-align:middle;">save</span> Simpan Link Sosial Media
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
