<link rel="stylesheet" href="{{ asset('css/Profile/profile.css') }}?v={{ time() }}">

<div class="profile-page-wrapper">
    <!-- Header Section -->
    <header class="profile-header">
        <div class="profile-header-container">
            <h1 class="profile-header-title">Profil Dinas Kesehatan Kabupaten Cianjur</h1>
            <p class="profile-header-subtitle">Mewujudkan Transformasi Pelayanan Kesehatan Masyarakat yang Profesional, Merata, dan Terintegrasi.</p>
        </div>
    </header>

    <!-- Main Content Section -->
    <main class="profile-content">
        <div class="profile-container">
            
            <!-- Sejarah dan Latar Belakang Section -->
            <div class="history-card-container">
                <div class="history-logo-wrap">
                    @if($profile && $profile->sejarah_image)
                        @if(file_exists(public_path('uploads/profile/' . $profile->sejarah_image)))
                            <img src="{{ asset('uploads/profile/' . $profile->sejarah_image) }}" alt="Logo Sejarah">
                        @else
                            <img src="{{ asset('images/' . $profile->sejarah_image) }}" alt="Logo Sejarah">
                        @endif
                    @else
                        <img src="{{ asset('Assets/layouts/Nav/logo_dinkes_cropped.png') }}" alt="Logo Dinkes Cianjur">
                    @endif
                </div>
                <div class="history-body">
                    <span class="history-badge">Sejarah & Latar Belakang</span>
                    <h2 class="history-title">{{ $profile ? $profile->sejarah_title : 'Perjalanan Dinas Kesehatan Kabupaten Cianjur' }}</h2>
                    <div class="history-content">
                        <p class="history-text">
                            {{ $profile ? $profile->sejarah_text_1 : 'Dinas Kesehatan Kabupaten Cianjur adalah unsur pelaksana otonomi daerah yang menjadi garda terdepan dalam meningkatkan derajat kesehatan masyarakat di wilayah seluas ±3.501,48 km² dengan 2,3 juta jiwa penduduk.' }}
                        </p>
                        <p class="history-text">
                            {{ $profile ? $profile->sejarah_text_2 : 'Mengelola 47 Puskesmas di 32 kecamatan beserta Labkesda, kami berkomitmen penuh menyelenggarakan pelayanan kesehatan yang profesional, merata, dan terintegrasi demi mewujudkan masyarakat Cianjur yang sehat dan mandiri.' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Visi Section Card -->
            <div class="visi-card-container">
                <span class="visi-badge">Visi Kami</span>
                
                <h2 class="visi-title">"{{ $profile ? $profile->visi_title : 'Mewujudkan Masyarakat Kabupaten Cianjur yang Sehat, Mandiri, Berkeadilan, dan Berdaya Saing.' }}"</h2>
                
                <p class="visi-desc">
                    {{ $profile ? $profile->visi_desc : 'Dinas Kesehatan Kabupaten Cianjur berkomitmen penuh mendorong transformasi pelayanan kesehatan agar seluruh warga memiliki akses yang setara, cepat, dan terjangkau terhadap layanan medis berkualitas.' }}
                </p>

                <!-- Bottom Stats Cards -->
                <div class="stats-cards-grid">
                    <div class="stat-btn-card">
                        <span class="material-icons stat-icon" style="color: #009966;">favorite</span>
                        <span class="stat-btn-text">{{ $profile ? $profile->stat_1_text : '47 Puskesmas Rujukan' }}</span>
                    </div>

                    <div class="stat-btn-card">
                        <span class="material-icons stat-icon" style="color: #009966;">place</span>
                        <span class="stat-btn-text">{{ $profile ? $profile->stat_2_text : '32 Kecamatan Terjangkau' }}</span>
                    </div>
                </div>
            </div>

            <!-- Misi Section Card -->
            <div class="misi-card-container">
                <span class="misi-badge">Misi Kami</span>
                
                <div class="misi-two-col-grid">
                    @if($profile && !empty($profile->misi))
                        @foreach($profile->misi as $item)
                            <div class="misi-item-card">
                                <h3 class="misi-item-title">{{ $item['title'] }}</h3>
                                <p class="misi-item-desc">{{ $item['desc'] }}</p>
                            </div>
                        @endforeach
                    @else
                        <div class="misi-item-card">
                            <h3 class="misi-item-title">1. Pemerataan Pelayanan</h3>
                            <p class="misi-item-desc">Menjamin ketersediaan layanan kesehatan yang merata, cepat, dan terjangkau bagi seluruh masyarakat.</p>
                        </div>
                        <div class="misi-item-card">
                            <h3 class="misi-item-title">2. Tata Kelola Adil</h3>
                            <p class="misi-item-desc">Membangun manajemen pelayanan kesehatan yang efisien, transparan, dan berbasis teknologi informasi.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
</div>
