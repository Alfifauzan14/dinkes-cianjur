<link rel="stylesheet" href="{{ asset('css/LayananTerpadu/layanan-terpadu.css') }}?v={{ time() }}">

<div class="lt-page-wrapper">
    <!-- Header Section -->
    <header class="lt-header">
        <div class="lt-header-container">
            <h1 class="lt-header-title">Layanan Terpadu Kesehatan Kabupaten Cianjur</h1>
            <p class="lt-header-subtitle">Pusat pelayanan perizinan, rekomendasi medis, dan sertifikasi kesehatan secara cepat, transparan, dan terintegrasi.</p>
        </div>
    </header>

    <!-- Main Content Section -->
    <main class="lt-content">
        <div class="lt-container">

            <!-- Layanan Untuk Warga -->
            <div class="lt-category-section">
                <div class="lt-title-section">
                    <h2 class="lt-main-title">Layanan Untuk Warga</h2>
                </div>

                <div class="lt-services-grid">
                    @forelse($wargaServices as $service)
                        @if($service->link)
                            <a href="{{ $service->link }}" target="_blank" class="lt-service-item lt-service-item-clickable" style="text-decoration: none; color: inherit;">
                        @else
                            <div class="lt-service-item">
                        @endif
                            <span class="lt-service-icon">
                                @include('components.LayananTerpadu.service-icon', ['icon' => $service->icon])
                            </span>
                            <span class="lt-service-text">{{ $service->name }}</span>
                        @if($service->link)
                            </a>
                        @else
                            </div>
                        @endif
                    @empty
                        <div style="grid-column: 1 / -1; color: #94A3B8; text-align: center; padding: 20px;">Belum ada layanan untuk warga.</div>
                    @endforelse
                </div>
            </div>

            <!-- Layanan Untuk Faskes -->
            <div class="lt-category-section">
                <div class="lt-title-section">
                    <h2 class="lt-main-title">Layanan Untuk Faskes</h2>
                </div>

                <div class="lt-services-grid">
                    @forelse($faskesServices as $service)
                        @if($service->link)
                            <a href="{{ $service->link }}" target="_blank" class="lt-service-item lt-service-item-clickable" style="text-decoration: none; color: inherit;">
                        @else
                            <div class="lt-service-item">
                        @endif
                            <span class="lt-service-icon">
                                @include('components.LayananTerpadu.service-icon', ['icon' => $service->icon])
                            </span>
                            <span class="lt-service-text">{{ $service->name }}</span>
                        @if($service->link)
                            </a>
                        @else
                            </div>
                        @endif
                    @empty
                        <div style="grid-column: 1 / -1; color: #94A3B8; text-align: center; padding: 20px;">Belum ada layanan untuk faskes.</div>
                    @endforelse
                </div>
            </div>

            <!-- Layanan Untuk Nakes -->
            <div class="lt-category-section">
                <div class="lt-title-section">
                    <h2 class="lt-main-title">Layanan Untuk Nakes</h2>
                </div>

                <div class="lt-services-grid">
                    @forelse($nakesServices as $service)
                        @if($service->link)
                            <a href="{{ $service->link }}" target="_blank" class="lt-service-item lt-service-item-clickable" style="text-decoration: none; color: inherit;">
                        @else
                            <div class="lt-service-item">
                        @endif
                            <span class="lt-service-icon">
                                @include('components.LayananTerpadu.service-icon', ['icon' => $service->icon])
                            </span>
                            <span class="lt-service-text">{{ $service->name }}</span>
                        @if($service->link)
                            </a>
                        @else
                            </div>
                        @endif
                    @empty
                        <div style="grid-column: 1 / -1; color: #94A3B8; text-align: center; padding: 20px;">Belum ada layanan untuk nakes.</div>
                    @endforelse
                </div>
            </div>

            <!-- Logos Section -->
            <div class="lt-logos-section">
                <div class="lt-logos-grid">
                    <div class="lt-logo-item">
                        <div class="lt-logo-placeholder">
                            <img src="{{ asset('Assets/layanan terpadu/Image-24.png') }}" alt="Kemenkes RI">
                        </div>
                    </div>
                    <div class="lt-logo-item">
                        <div class="lt-logo-placeholder">
                            <img src="{{ asset('Assets/layanan terpadu/Image-25.png') }}" alt="BPJS">
                        </div>
                    </div>
                    <div class="lt-logo-item">
                        <div class="lt-logo-placeholder">
                            <img src="{{ asset('Assets/layanan terpadu/Image-26.png') }}" alt="Pemkab Cianjur">
                        </div>
                    </div>
                    <div class="lt-logo-item">
                        <div class="lt-logo-placeholder">
                            <img src="{{ asset('Assets/layanan terpadu/Image-27.png') }}" alt="Dinkes">
                        </div>
                    </div>
                    <div class="lt-logo-item">
                        <div class="lt-logo-placeholder">
                            <img src="{{ asset('Assets/layanan terpadu/Image-28.png') }}" alt="Logo">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>
