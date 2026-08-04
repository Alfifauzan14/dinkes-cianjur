@php
    $ppid = \App\Models\PpidSetting::instance();
@endphp
<link rel="stylesheet" href="{{ asset('css/PPID/ppid.css') }}?v={{ time() }}">

<div class="ppid-page-wrapper">
    <!-- Header Section -->
    <header class="ppid-header">
        <div class="ppid-header-container">
            <h1 class="ppid-header-title">{{ $ppid->page_title }}</h1>
            <p class="ppid-header-subtitle">{{ $ppid->page_subtitle }}</p>
        </div>
    </header>

    <!-- Stats Cards Section -->
    <section class="ppid-stats-section">
        <div class="ppid-stats-container">
            <!-- Stat Card 1 -->
            <div class="ppid-stat-card">
                <h3 class="ppid-stat-number">{{ $ppid->stat_1_number }}</h3>
                <p class="ppid-stat-desc">{{ $ppid->stat_1_desc }}</p>
            </div>
            <!-- Stat Card 2 -->
            <div class="ppid-stat-card">
                <h3 class="ppid-stat-number">{{ $ppid->stat_2_number }}</h3>
                <p class="ppid-stat-desc">{{ $ppid->stat_2_desc }}</p>
            </div>
            <!-- Stat Card 3 -->
            <div class="ppid-stat-card">
                <h3 class="ppid-stat-number">{{ $ppid->stat_3_number }}</h3>
                <p class="ppid-stat-desc">{{ $ppid->stat_3_desc }}</p>
            </div>
        </div>
    </section>

    <!-- Main Content Section -->
    <main class="ppid-content">
        <div class="ppid-main-container">
            <!-- Accordion Wrapper Card -->
            <div class="ppid-card-wrapper">
                <h2 class="ppid-section-title">Layanan Informasi Publik</h2>

                <!-- Filter Form -->
                <div class="filter-box-card">
                    <h4 class="filter-title">Informasi Publik</h4>
                    <p class="filter-desc">Silahkan cari Informasi Publik melalui form di bawah ini:</p>

                    <form class="filter-form" id="ppid-search-form" onsubmit="event.preventDefault();">
                        <!-- Search input wrapper -->
                        <div class="search-input-wrap">
                            <span class="material-icons search-icon">search</span>
                            <input type="text" id="ppid-search-input" class="search-input-field" placeholder="Cari Informasi....">
                        </div>

                        <!-- Category select dropdown -->
                        <div class="category-select-wrap">
                            <select id="ppid-category-select" class="category-select-field">
                                <option value="semua">Semua Kategori</option>
                                <option value="berkala">Informasi Berkala</option>
                                <option value="serta-merta">Informasi Serta Merta</option>
                                <option value="setiap-saat">Informasi Setiap Saat</option>
                            </select>
                        </div>

                        <!-- Button -->
                        <button type="submit" class="filter-submit-btn">Lihat Data</button>
                    </form>
                </div>

                <!-- Accordion Items -->
                <div class="accordion-container" style="margin-top: 32px;">
                    @php
                        $items = $ppid->accordion_items;
                        if (empty($items)) {
                            // Fallback to legacy fields
                            $items = [];
                            foreach(range(1,6) as $i) {
                                $t = $ppid->{'accordion_'.$i.'_title'};
                                $c = $ppid->{'accordion_'.$i.'_content'};
                                if ($t) {
                                    $items[] = [
                                        'title' => $t,
                                        'content' => $c,
                                        'category' => $i % 2 === 0 ? 'setiap-saat' : ($i === 5 ? 'serta-merta' : 'berkala')
                                    ];
                                }
                            }
                        }
                    @endphp

                    @forelse($items as $item)
                        <div class="accordion-item" data-category="{{ $item['category'] ?? 'berkala' }}" data-title="{{ strtolower($item['title'] ?? '') }}" data-content="{{ strtolower($item['content'] ?? '') }}">
                            <button class="accordion-header" aria-expanded="false">
                                <span class="header-text">{{ $item['title'] }}</span>
                                <span class="material-icons chevron-icon">expand_more</span>
                            </button>
                            <div class="accordion-content">
                                <div class="accordion-content-inner">
                                    <p class="placeholder-text">{{ $item['content'] }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="no-results-msg" style="text-align: center; padding: 40px 20px; color: #64748B;">
                            <span class="material-icons" style="font-size: 48px; color: #CBD5E1; display: block; margin-bottom: 12px;">info</span>
                            Tidak ada informasi publik yang ditemukan.
                        </div>
                    @endforelse
                    
                    {{-- Message shown when client-side filter returns empty --}}
                    <div id="no-filter-results" class="no-results-msg" style="display: none; text-align: center; padding: 40px 20px; color: #64748B;">
                        <span class="material-icons" style="font-size: 48px; color: #CBD5E1; display: block; margin-bottom: 12px;">search_off</span>
                        Tidak ada informasi publik yang cocok dengan pencarian Anda.
                    </div>
                </div>
            </div>

            <!-- Section Informasi Tautan -->
            <div class="tautan-section">
                <span class="tautan-badge-title">{{ $ppid->tautan_badge }}</span>
                <h2 class="tautan-title">{{ $ppid->tautan_title }}</h2>
                <p class="tautan-subtitle">{{ $ppid->tautan_subtitle }}</p>

                <div class="tautan-grid">
                    @foreach(range(1,5) as $i)
                        @php
                            $label = $ppid->{'tautan_'.$i.'_label'};
                            $url   = $ppid->{'tautan_'.$i.'_url'} ?: '#';
                        @endphp
                        @if($label)
                        <a href="{{ $url }}" class="tautan-card">
                            <div class="tautan-icon-wrap">
                                <img src="{{ asset('Assets/ppdi/Rectangle '.($i + 94).'.png') }}" alt="{{ $label }}">
                            </div>
                            <span class="tautan-card-text">{{ $label }}</span>
                        </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </main>

<!-- Tata Cara Permohonan Section -->
<section class="tata-cara-outer">
    <div class="tata-cara-section">
        <!-- Left Side: Doctor Image -->
        <div class="tata-cara-image-wrapper">
            <img src="{{ asset('Assets/ppdi/doctor_landscape_illustration_1785205715145.png') }}" alt="Ilustrasi Tata Cara Permohonan" class="tata-cara-image">
        </div>

        <!-- Right Side: Content -->
        <div class="tata-cara-content-box">
            <span class="tata-cara-badge">{{ $ppid->tata_cara_badge }}</span>
            <h2 class="tata-cara-heading">{{ $ppid->tata_cara_heading }}</h2>

            <div class="tata-cara-grid">
                @foreach(range(1,4) as $i)
                    @php
                        $cardTitle = $ppid->{'tata_cara_card_'.$i.'_title'};
                        $cardText  = $ppid->{'tata_cara_card_'.$i.'_text'};
                    @endphp
                    @if($cardTitle)
                    <div class="tata-cara-card">
                        <h3 class="tata-cara-card-title">{{ $cardTitle }}</h3>
                        <p class="tata-cara-card-text">{{ $cardText }}</p>
                    </div>
                    @endif
                @endforeach
            </div>

            <!-- Action Buttons -->
            <div class="tata-cara-actions">
                <a href="{{ $ppid->btn_daftar_url ?: '#' }}" class="action-btn-green">{{ $ppid->btn_daftar_label }}</a>
                <a href="{{ $ppid->btn_login_url ?: '#' }}" class="action-btn-outline">{{ $ppid->btn_login_label }}</a>
            </div>
        </div>
    </div>
</section>
</div>

<!-- Accordion Interactive JavaScript & Search Logic -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const accordionHeaders = document.querySelectorAll('.accordion-header');

        accordionHeaders.forEach(header => {
            header.addEventListener('click', () => {
                const item = header.parentElement;
                const content = header.nextElementSibling;
                const isExpanded = header.getAttribute('aria-expanded') === 'true';

                // Close all other items
                document.querySelectorAll('.accordion-item').forEach(otherItem => {
                    if (otherItem !== item) {
                        otherItem.classList.remove('active');
                        const otherContent = otherItem.querySelector('.accordion-content');
                        if (otherContent) otherContent.style.maxHeight = null;
                        otherItem.querySelector('.accordion-header').setAttribute('aria-expanded', 'false');
                    }
                });

                // Toggle current item
                if (isExpanded) {
                    item.classList.remove('active');
                    content.style.maxHeight = null;
                    header.setAttribute('aria-expanded', 'false');
                } else {
                    item.classList.add('active');
                    content.style.maxHeight = content.scrollHeight + 'px';
                    header.setAttribute('aria-expanded', 'true');
                }
            });
        });

        // Search & filter logic
        const searchForm = document.getElementById('ppid-search-form');
        const searchInput = document.getElementById('ppid-search-input');
        const categorySelect = document.getElementById('ppid-category-select');
        const accordionItems = document.querySelectorAll('.accordion-item');
        const noResultsMsg = document.getElementById('no-filter-results');

        function filterItems() {
            const query = searchInput.value.toLowerCase().trim();
            const category = categorySelect.value;
            let visibleCount = 0;

            accordionItems.forEach(item => {
                const itemCategory = item.getAttribute('data-category');
                const title = item.getAttribute('data-title');
                const content = item.getAttribute('data-content');

                const matchesQuery = !query || title.includes(query) || content.includes(query);
                const matchesCategory = category === 'semua' || itemCategory === category;

                if (matchesQuery && matchesCategory) {
                    item.style.display = 'block';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                    // Collapse hidden items
                    item.classList.remove('active');
                    const itemContent = item.querySelector('.accordion-content');
                    if (itemContent) itemContent.style.maxHeight = null;
                    const itemHeader = item.querySelector('.accordion-header');
                    if (itemHeader) itemHeader.setAttribute('aria-expanded', 'false');
                }
            });

            if (visibleCount === 0 && accordionItems.length > 0) {
                noResultsMsg.style.display = 'block';
            } else {
                noResultsMsg.style.display = 'none';
            }
        }

        // Trigger filters
        if (searchForm) {
            searchForm.addEventListener('submit', (e) => {
                e.preventDefault();
                filterItems();
            });
        }
        if (searchInput) {
            searchInput.addEventListener('input', filterItems);
        }
        if (categorySelect) {
            categorySelect.addEventListener('change', filterItems);
        }

        window.addEventListener('resize', () => {
            const activeItem = document.querySelector('.accordion-item.active');
            if (activeItem) {
                const content = activeItem.querySelector('.accordion-content');
                if (content.style.maxHeight && content.style.maxHeight !== 'none') {
                    content.style.maxHeight = content.scrollHeight + 'px';
                }
            }
        });
    });
</script>
