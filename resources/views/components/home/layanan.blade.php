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
                            @if(str_starts_with($card->image, 'Assets/') || str_starts_with($card->image, 'uploads/'))
                                <img src="{{ asset($card->image) }}" alt="{{ $card->title }}">
                            @else
                                <img src="{{ asset('storage/' . $card->image) }}" alt="{{ $card->title }}">
                            @endif
                        @else
                            <span class="material-icons home-layanan-icon-lg">help_outline</span>
                        @endif
                    </div>
                    <h3 class="card-title">{{ $card->title }}</h3>
                    <p class="card-desc">{{ $card->description }}</p>
                </a>
            @empty
                <div class="home-layanan-empty">
                    <p class="card-desc">Belum ada layanan yang tersedia saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
