<link rel="stylesheet" href="{{ asset('css/home/layanan.css') }}?v={{ time() }}">

<section class="layanan-section">
    <div class="layanan-inner-container">
        <!-- Header -->
        <div class="layanan-header">
            <h2 class="layanan-title">PAGODA SEHAT</h2>
            <p class="layanan-subtitle">Portal Akses Gawat Darurat &amp; Layanan Sehat Cianjur</p>
        </div>

        <!-- Grid Kartu -->
        <div class="layanan-grid">
            @forelse($pagodaCards as $card)
                <a href="{{ $card->url ?: '#' }}" class="layanan-card">
                    <div class="card-icon-wrap">
                        @if($card->image)
                            @if(str_starts_with($card->image, 'Assets/'))
                                <img src="{{ asset($card->image) }}" alt="{{ $card->title }}">
                            @else
                                <img src="{{ asset('storage/' . $card->image) }}" alt="{{ $card->title }}">
                            @endif
                        @else
                            <span class="material-icons" style="font-size: 48px; color: #CBD5E1;">help_outline</span>
                        @endif
                    </div>
                    <h3 class="card-title">{{ $card->title }}</h3>
                    <p class="card-desc">{{ $card->description }}</p>
                </a>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 40px 20px; color: #94A3B8;">
                    <p>Belum ada kartu layanan.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
