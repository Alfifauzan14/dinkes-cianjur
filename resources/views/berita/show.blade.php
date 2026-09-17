<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $berita->title }} - Dinas Kesehatan Kabupaten Cianjur</title>

    {{-- Google Fonts: Plus Jakarta Sans --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

    {{-- Material Icons --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    {{-- FontAwesome for Brands/Social Icons --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    {{-- Custom Stylesheet --}}
    <link rel="stylesheet" href="{{ asset('css/Lihat_semua/detail-berita.css') }}?v={{ time() }}">
    <style>
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #F9FAFB;
            color: #111827;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        main {
            flex: 1;
        }
    </style>
</head>
<body>

    {{-- Navbar Component --}}
    @include('layouts.navbar')

    <div class="detail-page-wrapper">
        <div class="detail-container">
            
            <!-- Kembali ke Berita -->
            <a href="{{ url('/#berita') }}" class="btn-back-archive">
                <span class="material-icons">arrow_back</span>
                <span>Kembali ke Berita</span>
            </a>

            <div class="detail-layout">
                <!-- Kolom Utama: Konten Berita (Kiri) -->
                <article class="article-card">
                    <div class="article-header">
                        <div class="article-meta-row">
                            <span class="article-badge">{{ $berita->category }}</span>
                            <div class="article-meta-item">
                                <span class="material-icons" style="font-size: 16px;">calendar_today</span>
                                <span>{{ $berita->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="article-meta-item">
                                <span class="material-icons" style="font-size: 16px;">visibility</span>
                                <span>{{ $berita->views }} kali dilihat</span>
                            </div>
                        </div>
                        <h1 class="article-title">{{ $berita->title }}</h1>
                    </div>

                    <!-- Gambar Utama -->
                    <div class="article-image-wrap">
                        @if($berita->image)
                            <img src="{{ asset('uploads/berita/' . $berita->image) }}" alt="{{ $berita->title }}" class="article-image">
                        @else
                            <div class="article-image" style="background-color: #004F3B; display: flex; align-items: center; justify-content: center; color: rgba(255,255,255,0.2); height: 380px; width: 100%;">
                                <span class="material-icons" style="font-size: 96px;">image</span>
                            </div>
                        @endif
                    </div>

                    <!-- Isi Berita -->
                    <div class="article-body">
                        {!! nl2br(e($berita->content)) !!}
                    </div>
                </article>

                <!-- Kolom Sidebar: Berita Terpopuler (Kanan) -->
                <aside class="sidebar-card" id="sidebarPopular">
                    <button class="sidebar-close-btn" id="closeSidebar" title="Tutup">
                        <span class="material-icons">close</span>
                    </button>
                    <h2 class="sidebar-title">Berita Terpopuler</h2>
                    <div class="popular-list">
                        @forelse($popularBeritas as $popular)
                            <a href="{{ route('berita.show', $popular->slug) }}" class="popular-item">
                                @if($popular->image)
                                    <img src="{{ asset('uploads/berita/' . $popular->image) }}" alt="" class="popular-thumbnail">
                                @else
                                    <div class="popular-thumbnail" style="display: flex; align-items: center; justify-content: center; background-color: #E5E7EB; color: #9CA3AF;">
                                        <span class="material-icons" style="font-size: 20px;">image</span>
                                    </div>
                                @endif
                                <div class="popular-item-info">
                                    <span class="popular-item-date">{{ $popular->created_at->format('d M Y') }}</span>
                                    <h3 class="popular-item-title">{{ $popular->title }}</h3>
                                </div>
                            </a>
                        @empty
                            <p style="font-size: 14px; color: #9CA3AF; font-weight: 500; text-align: center;">Belum ada berita terpopuler lain.</p>
                        @endforelse
                    </div>
                </aside>
            </div>
            
        </div>
    </div>

    {{-- Footer Component --}}
    @include('layouts.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebarPopular');
            const closeBtn = document.getElementById('closeSidebar');
            const layout = document.querySelector('.detail-layout');

            // Create open button
            const openBtn = document.createElement('button');
            openBtn.id = 'openSidebar';
            openBtn.className = 'sidebar-open-btn';
            openBtn.title = 'Tampilkan Berita Populer';
            openBtn.innerHTML = '<span class="material-icons">format_list_bulleted</span>';
            document.querySelector('.detail-page-wrapper').appendChild(openBtn);

            function closeSidebar() {
                sidebar.classList.add('hidden');
                layout.classList.add('sidebar-closed');
                openBtn.classList.add('visible');
            }

            function openSidebar() {
                sidebar.classList.remove('hidden');
                layout.classList.remove('sidebar-closed');
                openBtn.classList.remove('visible');
            }

            closeBtn.addEventListener('click', closeSidebar);
            openBtn.addEventListener('click', openSidebar);
        });
    </script>

</body>
</html>
