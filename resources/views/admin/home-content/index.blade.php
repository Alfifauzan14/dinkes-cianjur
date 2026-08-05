@extends('admin.layouts.admin')

@section('title', 'Edit Info Card')
@section('header_title', 'Edit Info Card')

@section('content')
@include('admin.partials.alerts')

<div class="card card-outline card-success">
    <div class="card-header" style="padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
        <div class="font-weight-bold text-dark" style="font-size: 18px;">Daftar Info Card</div>
        <div class="text-secondary" style="font-size: 13px; margin-top: 4px;">Edit kartu informasi di halaman beranda. Kartu tidak dapat ditambah atau dihapus.</div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 70px;">Ikon</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th class="text-center" style="width: 80px;">Urutan</th>
                        <th class="text-center" style="width: 100px;">Aksi</th>
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
                            <td class="align-middle font-weight-bold text-dark">{{ $card->title }}</td>
                            <td class="align-middle">
                                <div class="text-secondary" style="font-size: 13px; max-width: 340px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $card->description ?: '-' }}</div>
                            </td>
                            <td class="text-center align-middle text-secondary" style="font-size: 14px;">{{ $loop->iteration }}</td>
                            <td class="text-center align-middle">
                                <div class="btn-action-group">
                                    <a href="{{ route('admin.home-content.edit', $card->id) }}" class="btn-action btn-action-edit" title="Edit">
                                        <span class="material-icons" style="font-size:16px;">edit</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
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

<div class="card card-outline card-success">
    <div class="card-header" style="padding: 16px 20px; background-color: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
        <div class="font-weight-bold text-dark" style="font-size: 18px;">Sosial Media Hero</div>
        <div class="text-secondary" style="font-size: 13px; margin-top: 4px;">Edit link media sosial di halaman beranda. Kosongkan jika belum ada.</div>
    </div>

    <div class="card-body">
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

            <div style="display: flex; gap: 10px; margin-top: 10px;">
                <button type="submit" class="btn btn-success">
                    <span class="material-icons" style="font-size:16px; vertical-align:middle;">save</span> Simpan Link Sosial Media
                </button>
            </div>
        </form>
    </div>
</div>
@endsection