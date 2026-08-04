<link rel="stylesheet" href="{{ asset('css/LayananTerpadu/layanan-terpadu.css') }}?v={{ time() }}">

<div class="lt-page-wrapper">
    @php
        $headerSetting = \App\Models\HeaderSetting::getByKey('layanan-terpadu', 'Layanan Terpadu', 'Portal perizinan praktis dan pelayanan informasi terintegrasi bagi masyarakat, faskes, dan tenaga kesehatan.');
    @endphp
    <!-- Header Section -->
    <header class="lt-header">
        <div class="lt-header-container">
            <h1 class="lt-header-title">{{ $headerSetting->title }}</h1>
            <p class="lt-header-subtitle">{{ $headerSetting->subtitle }}</p>
        </div>
    </header>

    <!-- Filter & Search Section -->
    <div class="lt-filter-bar" style="max-width: 1200px; margin: 24px auto 0 auto; padding: 0 24px; display: flex; flex-wrap: wrap; gap: 16px; align-items: center; justify-content: space-between;">
        <div style="position: relative; flex: 1; min-width: 280px;">
            <span class="material-icons" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #64748B; font-size: 20px;">search</span>
            <input type="text" id="layananSearchInput" placeholder="Cari layanan perizinan, sertifikat, atau rekomendasi..." style="width: 100%; padding: 12px 16px 12px 42px; border: 1px solid #E2E8F0; border-radius: 10px; font-size: 14px; outline: none; box-sizing: border-box; background: #FFFFFF; box-shadow: 0 2px 8px rgba(0,0,0,0.04); transition: border-color 0.2s;" onfocus="this.style.borderColor='#009966'" onblur="this.style.borderColor='#E2E2E8F0'">
        </div>

        <div class="lt-category-tabs" style="display: flex; gap: 8px; flex-wrap: wrap;">
            <button type="button" class="lt-tab-btn active" data-type="all" style="display: inline-flex; align-items: center; gap: 6px; padding: 10px 18px; border-radius: 9999px; border: 1px solid #009966; background: #009966; color: #FFFFFF; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.2s;">
                <span class="material-icons" style="font-size: 18px;">groups</span>
                <span>Semua Layanan</span>
            </button>
            <button type="button" class="lt-tab-btn" data-type="warga" style="display: inline-flex; align-items: center; gap: 6px; padding: 10px 18px; border-radius: 9999px; border: 1px solid #E2E8F0; background: #FFFFFF; color: #475569; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.2s;">
                <span class="material-icons" style="font-size: 18px;">person</span>
                <span>Untuk Warga</span>
            </button>
            <button type="button" class="lt-tab-btn" data-type="faskes" style="display: inline-flex; align-items: center; gap: 6px; padding: 10px 18px; border-radius: 9999px; border: 1px solid #E2E8F0; background: #FFFFFF; color: #475569; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.2s;">
                <span class="material-icons" style="font-size: 18px;">local_hospital</span>
                <span>Untuk Faskes</span>
            </button>
            <button type="button" class="lt-tab-btn" data-type="nakes" style="display: inline-flex; align-items: center; gap: 6px; padding: 10px 18px; border-radius: 9999px; border: 1px solid #E2E8F0; background: #FFFFFF; color: #475569; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.2s;">
                <span class="material-icons" style="font-size: 18px;">medical_services</span>
                <span>Untuk Nakes</span>
            </button>
        </div>
    </div>

    <!-- Main Content Section -->
    <main class="lt-content">
        <div class="lt-container">

            <!-- Layanan Untuk Warga -->
            <div class="lt-category-section" data-type="warga">
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
            <div class="lt-category-section" data-type="faskes">
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
            <div class="lt-category-section" data-type="nakes">
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('layananSearchInput');
    const tabBtns = document.querySelectorAll('.lt-tab-btn');
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
                b.style.background = '#FFFFFF';
                b.style.color = '#475569';
                b.style.borderColor = '#E2E8F0';
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

