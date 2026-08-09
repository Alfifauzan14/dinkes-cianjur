<link rel="stylesheet" href="{{ asset('css/LayananTerpadu/layanan-terpadu.css') }}?v={{ time() }}">

<div class="lt-page-wrapper">
    @php
        $headerSetting = \App\Models\HeaderSetting::getByKey('layanan-terpadu', 'Layanan Terpadu', 'Portal perizinan praktis dan pelayanan informasi terintegrasi bagi masyarakat, faskes, dan tenaga kesehatan.');
    @endphp
    <!-- Header Section -->
    <header class="lt-header">
        <div class="lt-header-container">
            <h1 class="lt-header-title">{{ \App\Models\Setting::get('page_layanan_title', 'Layanan Terpadu Kesehatan Kabupaten Cianjur') }}</h1>
            <p class="lt-header-subtitle">{{ \App\Models\Setting::get('page_layanan_subtitle', 'Pusat pelayanan perizinan, rekomendasi medis, dan sertifikasi kesehatan secara cepat, transparan, dan terintegrasi.') }}</p>
        </div>
    </header>

    <!-- Main Content Section -->
    <main class="lt-content">
        <div class="lt-container">

            <!-- Filter & Search Section -->
            <div class="lt-filter-bar">
                <div class="lt-search-wrapper">
                    <span class="material-icons lt-search-icon">search</span>
                    <input type="text" id="layananSearchInput" class="lt-search-input" placeholder="Cari layanan perizinan, sertifikat, atau rekomendasi...">
                </div>
                <div class="lt-topic-pills">
                    <button type="button" class="lt-topic-pill-btn active" data-type="all">Semua Layanan</button>
                    <button type="button" class="lt-topic-pill-btn" data-type="warga">Untuk Warga</button>
                    <button type="button" class="lt-topic-pill-btn" data-type="faskes">Untuk Faskes</button>
                    <button type="button" class="lt-topic-pill-btn" data-type="nakes">Untuk Nakes</button>
                </div>
            </div>

            <!-- Layanan Untuk Warga -->
            <div class="lt-category-section" data-type="warga">
                <div class="lt-title-section">
                    <span class="lt-category-tag">Untuk Masyarakat</span>
                    <h2 class="lt-main-title">Layanan Untuk Warga</h2>
                </div>

                <div class="lt-services-grid">
                    @forelse($wargaServices as $service)
                        <a href="{{ route('layanan-terpadu.show', $service->id) }}" class="lt-service-item">
                            <span class="lt-service-icon">
                                @include('components.LayananTerpadu.service-icon', ['icon' => $service->icon])
                            </span>
                            <span class="lt-service-text">{{ $service->name }}</span>
                        </a>
                    @empty
                        <div class="lt-empty-state">Belum ada layanan untuk warga.</div>
                    @endforelse
                </div>
            </div>

            <!-- Layanan Untuk Faskes -->
            <div class="lt-category-section" data-type="faskes">
                <div class="lt-title-section">
                    <span class="lt-category-tag">Fasilitas Kesehatan</span>
                    <h2 class="lt-main-title">Layanan Untuk Faskes</h2>
                </div>

                <div class="lt-services-grid">
                    @forelse($faskesServices as $service)
                        <a href="{{ route('layanan-terpadu.show', $service->id) }}" class="lt-service-item">
                            <span class="lt-service-icon">
                                @include('components.LayananTerpadu.service-icon', ['icon' => $service->icon])
                            </span>
                            <span class="lt-service-text">{{ $service->name }}</span>
                        </a>
                    @empty
                        <div class="lt-empty-state">Belum ada layanan untuk faskes.</div>
                    @endforelse
                </div>
            </div>

            <!-- Layanan Untuk Nakes -->
            <div class="lt-category-section" data-type="nakes">
                <div class="lt-title-section">
                    <span class="lt-category-tag">Tenaga Kesehatan</span>
                    <h2 class="lt-main-title">Layanan Untuk Nakes</h2>
                </div>

                <div class="lt-services-grid">
                    @forelse($nakesServices as $service)
                        <a href="{{ route('layanan-terpadu.show', $service->id) }}" class="lt-service-item">
                            <span class="lt-service-icon">
                                @include('components.LayananTerpadu.service-icon', ['icon' => $service->icon])
                            </span>
                            <span class="lt-service-text">{{ $service->name }}</span>
                        </a>
                    @empty
                        <div class="lt-empty-state">Belum ada layanan untuk nakes.</div>
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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('layananSearchInput');
        const tabBtns = document.querySelectorAll('.lt-topic-pill-btn');
        const categorySections = document.querySelectorAll('.lt-category-section');

        let activeType = 'all';

        function filterLayanan() {
            const query = searchInput ? searchInput.value.toLowerCase().trim() : '';

            categorySections.forEach(section => {
                const sectionType = section.getAttribute('data-type');
                const matchesType = (activeType === 'all') || (sectionType === activeType);

                if (!matchesType) {
                    section.style.display = 'none';
                    return;
                }

                // Filter individual service items inside this section
                const serviceItems = section.querySelectorAll('.lt-service-item');
                let hasVisibleItems = false;

                serviceItems.forEach(item => {
                    const text = item.textContent.toLowerCase();
                    if (query === '' || text.includes(query)) {
                        item.style.display = 'flex';
                        hasVisibleItems = true;
                    } else {
                        item.style.display = 'none';
                    }
                });

                if (hasVisibleItems) {
                    section.style.display = 'block';
                } else {
                    section.style.display = 'none';
                }
            });
        }

        if (searchInput) {
            searchInput.addEventListener('input', filterLayanan);
        }

        tabBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                tabBtns.forEach(b => {
                    b.classList.remove('active');
                    b.style.background = '#F9FAFB';
                    b.style.color = '#374151';
                    b.style.borderColor = '#E5E7EB';
                });

                this.classList.add('active');
                this.style.background = '#009966';
                this.style.color = '#FFFFFF';
                this.style.borderColor = '#009966';

                activeType = this.getAttribute('data-type');
                filterLayanan();
            });
        });
    });
    </script>

