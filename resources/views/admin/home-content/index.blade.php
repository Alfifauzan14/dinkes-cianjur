@extends('admin.layouts.admin')

@section('title', 'Edit Info Card')
@section('header_title', 'Edit Info Card')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/pagodasehat.css') }}?v={{ time() }}">
@endsection

@section('content')
<div class="berita-admin-wrapper">

    @if(session('success'))
        <div class="admin-alert admin-alert-success">
            <span class="material-icons">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="admin-card">
        <div class="card-header-actions">
            <div>
                <div style="font-size: 18px; font-weight: 800; color: #004F3B;">Kelola Info Card</div>
                <div style="font-size: 14px; color: #6B7280; margin-top: 4px;">Edit kartu informasi di halaman beranda. Kartu tidak dapat ditambah atau dihapus.</div>
            </div>
        </div>

        <div class="admin-table-wrapper">
            <table class="admin-table">
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
                            <td style="text-align: center;">
                                <div style="width: 44px; height: 44px; background-color: #E6F7F0; border-radius: 3px; display: inline-flex; align-items: center; justify-content: center;">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#009966" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        @include('admin.home-content.icon', ['icon' => $card->icon_name])
                                    </svg>
                                </div>
                            </td>
                            <td>
                                <div style="font-weight: 700; color: #111827;">{{ $card->title }}</div>
                            </td>
                            <td>
                                <div style="font-size: 13px; color: #6B7280; max-width: 340px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $card->description ?: '-' }}</div>
                            </td>
                            <td style="text-align: center; color: #6B7280; font-size: 14px;">
                                {{ $loop->iteration }}
                            </td>
                            <td style="text-align: center;">
                                <div class="actions-cell" style="justify-content: center;">
                                    <a href="{{ route('admin.home-content.edit', $card->id) }}" class="btn-action-edit" title="Edit">
                                        <span class="material-icons">edit</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding: 40px; text-align: center; color: #94A3B8;">
                                <span class="material-icons" style="font-size: 40px; display: block; margin-bottom: 8px; color: #CBD5E1;">info</span>
                                Belum ada Info Card.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="admin-card" style="margin-top: 20px;">
        <div class="card-header-actions">
            <div>
                <div style="font-size: 18px; font-weight: 800; color: #004F3B;">Kelola Sosial Media Hero</div>
                <div style="font-size: 14px; color: #6B7280; margin-top: 4px;">Edit link media sosial di halaman beranda. Kosongkan jika belum ada.</div>
            </div>
        </div>

        <form action="{{ route('admin.home-content.social.update') }}" method="POST" class="admin-form">
            @csrf
            @method('PUT')

            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px;">
                @foreach($socialLinks->sortBy('order_index') as $link)
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
                            class="form-control-input"
                            placeholder="https://"
                        >
                        @error('social_links.'.$link->platform.'.url')
                            <span class="field-error" style="color: #EF4444; font-size: 13px;">{{ $message }}</span>
                        @enderror
                    </div>
                @endforeach
            </div>

            <div class="form-actions" style="display: flex; gap: 10px; margin-top: 10px;">
                <button type="submit" class="btn-admin btn-admin-primary">
                    <span class="material-icons">save</span>
                    Simpan Link Sosial Media
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
