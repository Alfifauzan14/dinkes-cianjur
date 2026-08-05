<link rel="stylesheet" href="{{ asset('css/home/cards.css') }}?v={{ time() }}">

<section class="info-cards-section">
    <div class="info-cards-container">

        @forelse($infoCards ?? [] as $card)
            <div class="info-card">
                <div class="info-card-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#009966" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        @include('admin.home-content.icon', ['icon' => $card->icon_name])
                    </svg>
                </div>
                <h3 class="info-card-title">{{ $card->title }}</h3>
                <p class="info-card-desc">{{ $card->description }}</p>
            </div>
        @empty
            <div class="info-card">
                <div class="info-card-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#009966" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                </div>
                <h3 class="info-card-title">Peta Sebaran Faskes</h3>
                <p class="info-card-desc">Temukan lokasi puskesmas & faskes terdekat di Kabupaten Cianjur.</p>
            </div>
        @endforelse

    </div>
</section>
