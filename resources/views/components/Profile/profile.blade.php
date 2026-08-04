<link rel="stylesheet" href="{{ asset('css/Profile/profile.css') }}?v={{ time() }}">

<div class="profile-page-wrapper">
    @php
        $headerSetting = \App\Models\HeaderSetting::getByKey('profil', 'Profil Dinas Kesehatan', 'Mengenal lebih dekat Dinas Kesehatan Kabupaten Cianjur, struktur organisasi, tugas pokok dan fungsinya.');
    @endphp
    <!-- Header Section -->
    <header class="profile-header">
        <div class="profile-header-container">
            <h1 class="profile-header-title">{{ $headerSetting->title }}</h1>
            <p class="profile-header-subtitle">{{ $headerSetting->subtitle }}</p>
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


        </div>
    </main>
</div>
