<link rel="stylesheet" href="{{ asset('css/home/berita.css') }}?v={{ time() }}">

<section class="berita-section">
    <div class="berita-inner">
    <div class="berita-header">
        <p class="berita-category">Kabar Sehat</p>
        <div class="berita-header-main">
            <h2 class="berita-title">Kabar Sehat Cianjur</h2>
            <a href="{{ route('berita') }}" class="berita-more-link">
                Lihat Semua Berita
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 5L19 12L12 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
    </div>

    <div class="berita-container">
        <!-- Row 1: Landscape Cards -->
        <div class="berita-row-landscape">
            @forelse($homeBeritas->take(2) as $berita)
                <a href="{{ route('berita.show', $berita->slug) }}" class="berita-card landscape">
                    @if($berita->image)
                        <img src="{{ asset('uploads/berita/' . $berita->image) }}" alt="{{ $berita->title }}" class="berita-card-image" loading="lazy">
                    @else
                        <div class="berita-card-image" style="background-color: #065F46; display: flex; align-items: center; justify-content: center; color: rgba(255,255,255,0.3); width: 100%; height: 100%;">
                            <span class="material-icons" style="font-size: 48px;">image</span>
                        </div>
                    @endif
                    <div class="berita-card-overlay"></div>
                    <div class="berita-card-content">
                        <span class="berita-card-date">{{ $berita->created_at->format('d M Y') }}</span>
                        <h3 class="berita-card-title">{{ $berita->title }}</h3>
                    </div>
                </a>
            @empty
                <div style="grid-column: span 2; text-align: center; padding: 48px; color: #9CA3AF; width: 100%;">
                    <span class="material-icons" style="font-size: 48px; margin-bottom: 12px; display: block;">newspaper</span>
                    <p style="font-size: 15px; font-weight: 600;">Belum ada rilis berita terbaru.</p>
                </div>
            @endforelse
        </div>

        <!-- Row 2: Square Cards -->
        @if($homeBeritas->count() > 2)
            <div class="berita-row-square">
                @foreach($homeBeritas->skip(2)->take(4) as $berita)
                    <a href="{{ route('berita.show', $berita->slug) }}" class="berita-card square">
                        @if($berita->image)
                            <img src="{{ asset('uploads/berita/' . $berita->image) }}" alt="{{ $berita->title }}" class="berita-card-image" loading="lazy">
                        @else
                            <div class="berita-card-image" style="background-color: #065F46; display: flex; align-items: center; justify-content: center; color: rgba(255,255,255,0.3); width: 100%; height: 100%;">
                                <span class="material-icons" style="font-size: 36px;">image</span>
                            </div>
                        @endif
                        <div class="berita-card-overlay"></div>
                        <div class="berita-card-content">
                            <span class="berita-card-date">{{ $berita->created_at->format('d M Y') }}</span>
                            <h3 class="berita-card-title">{{ $berita->title }}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
    </div>
</section>
