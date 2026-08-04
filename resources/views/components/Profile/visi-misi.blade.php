<!-- Visi Section Card -->
<div class="visi-card-container" style="margin-bottom: 32px;">
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
