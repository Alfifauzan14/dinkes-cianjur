<link rel="stylesheet" href="{{ asset('css/Labkesda/labkesda.css') }}?v={{ time() }}">

<div class="labkesda-page-wrapper">
    @php
        $headerSetting = \App\Models\HeaderSetting::getByKey('labkesda', 'Labkesda Cianjur', 'Unit Pelaksana Teknis Daerah (UPTD) pelayanan pengujian sampel klinis dan lingkungan secara profesional.');
    @endphp
    <!-- Header Section -->
    <header class="labkesda-header">
        <div class="labkesda-header-container">
            <h1 class="labkesda-header-title">{{ \App\Models\Setting::get('page_labkesda_title', 'Laboratorium Kesehatan Daerah') }}</h1>
            <p class="labkesda-header-subtitle">{{ \App\Models\Setting::get('page_labkesda_subtitle', 'Fasilitas Lab Uji Terpadu Daerah untuk pengujian kesehatan masyarakat Kabupaten Cianjur.') }}</p>
        </div>
    </header>

    <!-- Main Content Section -->
    <main class="labkesda-content">
        <div class="labkesda-container">

            <!-- Title Section -->
            <div class="labkesda-title-section">
                <h2 class="labkesda-main-title">Laboratorium Kesehatan Daerah (Labkesda)</h2>
                <p class="labkesda-main-subtitle">Penilaian Anda sangat berharga untuk meningkatkan mutu pelayanan kesehatan di Kabupaten Cianjur.</p>
            </div>

            <!-- Info Card -->
            <div class="labkesda-info-card">
                <div class="labkesda-info-item">
                    <span class="labkesda-info-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </span>
                    <div class="labkesda-info-text">
                        <p class="labkesda-info-label">Alamat Lokasi</p>
                        <p class="labkesda-info-value">{{ $settings->alamat ?: 'Jl. Pasir Gede Raya No. 12, Cianjur' }}</p>
                    </div>
                </div>
                <div class="labkesda-info-divider"></div>
                <div class="labkesda-info-item">
                    <span class="labkesda-info-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </span>
                    <div class="labkesda-info-text">
                        <p class="labkesda-info-label">Jam Operasional</p>
                        <p class="labkesda-info-value">{{ $settings->jam_operasional ?: 'Senin - Jumat, 07.30 - 15.30 WIB' }}</p>
                    </div>
                </div>
                <div class="labkesda-info-divider"></div>
                <div class="labkesda-info-item">
                    <span class="labkesda-info-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    </span>
                    <div class="labkesda-info-text">
                        <p class="labkesda-info-label">Kontak Labkesda</p>
                        <p class="labkesda-info-value">{{ $settings->kontak ?: '(0263) 2638891 / 0812-3456-7891' }}</p>
                    </div>
                </div>
            </div>

            <!-- Service Cards Grid -->
            <div class="labkesda-cards-grid">
                @forelse($categories as $category)
                <div class="labkesda-service-card">
                    <div class="labkesda-card-top">
                        <span class="labkesda-card-icon">
                            <span class="material-icons">{{ $category->icon_name }}</span>
                        </span>
                        @if($category->badge_text)
                            <span class="labkesda-card-tag">{{ $category->badge_text }}</span>
                        @endif
                    </div>
                    <h3 class="labkesda-card-title">{{ $category->title }}</h3>
                    <p class="labkesda-card-desc">{{ $category->description }}</p>
                    @if($category->items->count())
                    <ul class="labkesda-card-features">
                        @foreach($category->items as $item)
                            <li>{{ $item->item_name }}</li>
                        @endforeach
                    </ul>
                    @endif
                    @if($category->button_text)
                        <a href="{{ $category->button_url ?: '#' }}" class="labkesda-card-btn">{{ $category->button_text }} &rarr;</a>
                    @endif
                </div>
                @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px; color: #94A3B8;">
                    <p style="font-size: 16px;">Belum ada layanan labkesda yang tersedia.</p>
                </div>
                @endforelse
            </div>

        </div>
    </main>
</div>
