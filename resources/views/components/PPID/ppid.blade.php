@php
    $header = \App\Models\HeaderSetting::getByKey('ppid', 'PPID Pembantu', 'Pejabat Pengelola Informasi dan Dokumentasi Dinas Kesehatan Kabupaten Cianjur.');
    $ppid = \App\Models\PpidSetting::instance();
@endphp
<link rel="stylesheet" href="{{ asset('css/PPID/ppid.css') }}?v={{ time() }}">

<div class="ppid-page-wrapper">
    <!-- Header Section -->
    <header class="ppid-header">
        <div class="ppid-header-container">
            <h1 class="ppid-header-title">{{ $header->title }}</h1>
            <p class="ppid-header-subtitle">{{ $header->subtitle }}</p>
        </div>
    </header>

    <!-- Section Layanan PPID (Akses Layanan Utama) -->
    <section class="layanan-ppid-section">
        <div class="layanan-ppid-container">
            <div class="layanan-ppid-header">
                <div class="header-left">
                    <span class="badge-title">LAYANAN PPID</span>
                    <h2 class="section-title">Akses layanan utama</h2>
                </div>
            </div>

            <div class="layanan-ppid-grid">
                <!-- Card 1: Ajukan Permohonan -->
                <div class="layanan-ppid-card card-permohonan">
                    <div class="card-icon-wrapper icon-permohonan">
                        <svg class="card-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="12" y1="18" x2="12" y2="12"></line>
                            <line x1="9" y1="15" x2="15" y2="15"></line>
                        </svg>
                    </div>
                    <h3 class="card-title">Ajukan Permohonan</h3>
                    <p class="card-desc">Gunakan layanan ini untuk meminta informasi publik yang belum tersedia.</p>
                    <a href="{{ route('permohonan') }}" class="card-btn">
                        <span>Buat Permohonan</span>
                        <svg class="arrow-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </div>

                <!-- Card 2: Ajukan Keberatan -->
                <div class="layanan-ppid-card card-keberatan">
                    <div class="card-icon-wrapper icon-keberatan">
                        <svg class="card-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <circle cx="12" cy="13" r="1"></circle>
                            <line x1="12" y1="16" x2="12" y2="18"></line>
                            <!-- Alert icon custom -->
                            <path d="M12 9v2" stroke-width="2"></path>
                            <path d="M12 14v.01" stroke-width="2"></path>
                        </svg>
                    </div>
                    <h3 class="card-title">Ajukan Keberatan</h3>
                    <p class="card-desc">Sampaikan keberatan bila proses atau hasil permohonan belum sesuai.</p>
                    <a href="{{ route('keberatan') }}" class="card-btn">
                        <span>Ajukan Keberatan</span>
                        <svg class="arrow-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </div>

                <!-- Card 3: Cek Status -->
                <div class="layanan-ppid-card card-status">
                    <div class="card-icon-wrapper icon-status">
                        <svg class="card-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </div>
                    <h3 class="card-title">Cek Status</h3>
                    <p class="card-desc">Pantau perkembangan permohonan informasi yang sudah Anda kirim.</p>
                    <a href="{{ route('cek-status') }}" class="card-btn">
                        <span>Cek Status</span>
                        <svg class="arrow-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
