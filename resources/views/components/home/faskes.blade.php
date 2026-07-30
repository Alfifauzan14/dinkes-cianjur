<link rel="stylesheet" href="{{ asset('css/home/faskes.css') }}?v={{ time() }}">

<div class="faskes-page-wrapper">
    <!-- Header Section -->
    <header class="profile-header">
        <div class="profile-header-container">
            <h1 class="profile-header-title">Fasilitas Kesehatan Kabupaten Cianjur</h1>
            <p class="profile-header-subtitle">Pusat data terpadu, indikator kinerja kesehatan, angka kecukupan faskes/nakes, publikasi profil tahunan, dan produk hukum daerah.</p>
        </div>
    </header>

    <!-- Main Content Section -->
    <main class="faskes-content">
        <div class="faskes-container">

            <!-- Title Section -->
            <div class="faskes-title-section">
                <h2 class="faskes-main-title">Peta & Daftar Puskesmas & Rumah Sakit</h2>
                <p class="faskes-main-subtitle">Penilaian Anda sangat berharga untuk meningkatkan mutu pelayanan kesehatan di Kabupaten Cianjur.</p>
            </div>

            <!-- Search & Filter Card -->
            <div class="faskes-filter-card">
                <div class="faskes-filter-section">
                    <div class="faskes-search-wrap">
                        <input type="text" class="faskes-search-input" placeholder="Cari nama Puskesmas...">
                        <button class="faskes-search-btn">Cari</button>
                    </div>
                    <div class="faskes-filter-wrap">
                        <select class="faskes-filter-select">
                            <option value="">Semua Wilayah...</option>
                            <option value="cianjur">Cianjur</option>
                            <option value="cianjur-kota">Cianjur Kota</option>
                            <option value="sukabumi">Sukabumi</option>
                            <option value="karangtengah">Karangtengah</option>
                            <option value="cikalongkulon">Cikalongkulon</option>
                            <option value="warungkondang">Warungkondang</option>
                        </select>
                    </div>
                    <div class="faskes-filter-wrap">
                        <select class="faskes-filter-select">
                            <option value="">Semua Layanan...</option>
                            <option value="rawat-inap">Rawat Inap</option>
                            <option value="igd">IGD</option>
                            <option value="laboratorium">Laboratorium</option>
                            <option value="poli-umum">Poli Umum</option>
                            <option value="poli-gigi">Poli Gigi</option>
                            <option value="kb">Kesehatan Ibu & Anak</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Map & List Layout -->
            <div class="faskes-main-layout">

                <!-- Map Section (Left) -->
                <div class="faskes-map-container">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126919.27365881352!2d107.10740579179685!3d-6.818661642056944!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6849e48910e0f1%3A0x39c5a4c67d77f748!2sKabupaten%20Cianjur%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                <!-- Facility List (Right) -->
                <div class="faskes-list">

                    <!-- Card 1 -->
                    <div class="faskes-card">
                        <div class="faskes-card-header">
                            <h3 class="faskes-card-name">Rumah Sakit Sayang</h3>
                            <div class="faskes-card-badges">
                                <span class="faskes-badge faskes-badge-green">Rawat Inap</span>
                                <span class="faskes-badge faskes-badge-blue">Akreditasi Paripurna</span>
                            </div>
                        </div>
                        <div class="faskes-card-info">
                            <div class="faskes-info-item">
                                <span class="faskes-info-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                </span>
                                <span>Jl. Suroso No.1 Kec. Cianjur, Kabupaten Cianjur</span>
                            </div>
                            <div class="faskes-info-item">
                                <span class="faskes-info-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                </span>
                                <span>(0263) 26318</span>
                            </div>
                            <div class="faskes-info-item">
                                <span class="faskes-info-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                </span>
                                <span>Senin - Sabtu, 07.30 - 14.00 (Gawat Darurat 24 jam)</span>
                            </div>
                        </div>
                        <div class="faskes-card-actions">
                            <a href="#" class="faskes-btn faskes-btn-peta">
                                <span class="faskes-btn-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                </span>
                                Lihat di Peta
                            </a>
                            <a href="https://wa.me/6281234567890" target="_blank" class="faskes-btn faskes-btn-wa">
                                <span class="faskes-btn-icon">
                                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                </span>
                                Hubungi WA
                            </a>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="faskes-card">
                        <div class="faskes-card-header">
                            <h3 class="faskes-card-name">Puskesmas Cianjur</h3>
                            <div class="faskes-card-badges">
                                <span class="faskes-badge faskes-badge-green">Rawat Jalan</span>
                            </div>
                        </div>
                        <div class="faskes-card-info">
                            <div class="faskes-info-item">
                                <span class="faskes-info-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                </span>
                                <span>Jl. Raya Cianjur No.23, Kabupaten Cianjur</span>
                            </div>
                            <div class="faskes-info-item">
                                <span class="faskes-info-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                </span>
                                <span>(0263) 26234</span>
                            </div>
                            <div class="faskes-info-item">
                                <span class="faskes-info-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                </span>
                                <span>Senin - Jumat, 08.00 - 15.00</span>
                            </div>
                        </div>
                        <div class="faskes-card-actions">
                            <a href="#" class="faskes-btn faskes-btn-peta">
                                <span class="faskes-btn-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                </span>
                                Lihat di Peta
                            </a>
                            <a href="https://wa.me/6281234567891" target="_blank" class="faskes-btn faskes-btn-wa">
                                <span class="faskes-btn-icon">
                                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                </span>
                                Hubungi WA
                            </a>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="faskes-card">
                        <div class="faskes-card-header">
                            <h3 class="faskes-card-name">Puskesmas Suryakencana</h3>
                            <div class="faskes-card-badges">
                                <span class="faskes-badge faskes-badge-green">Rawat Jalan</span>
                                <span class="faskes-badge faskes-badge-blue">Akreditasi Madya</span>
                            </div>
                        </div>
                        <div class="faskes-card-info">
                            <div class="faskes-info-item">
                                <span class="faskes-info-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                </span>
                                <span>Jl. Suryakencana No.15, Kabupaten Cianjur</span>
                            </div>
                            <div class="faskes-info-item">
                                <span class="faskes-info-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                </span>
                                <span>(0263) 26456</span>
                            </div>
                            <div class="faskes-info-item">
                                <span class="faskes-info-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                </span>
                                <span>Senin - Sabtu, 07.00 - 13.00</span>
                            </div>
                        </div>
                        <div class="faskes-card-actions">
                            <a href="#" class="faskes-btn faskes-btn-peta">
                                <span class="faskes-btn-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                </span>
                                Lihat di Peta
                            </a>
                            <a href="https://wa.me/6281234567892" target="_blank" class="faskes-btn faskes-btn-wa">
                                <span class="faskes-btn-icon">
                                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                </span>
                                Hubungi WA
                            </a>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="faskes-card">
                        <div class="faskes-card-header">
                            <h3 class="faskes-card-name">Puskesmas Muka Cianjur</h3>
                            <div class="faskes-card-badges">
                                <span class="faskes-badge faskes-badge-green">IGD 24 Jam</span>
                            </div>
                        </div>
                        <div class="faskes-card-info">
                            <div class="faskes-info-item">
                                <span class="faskes-info-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                </span>
                                <span>Jl. Raya Muka No.8, Kabupaten Cianjur</span>
                            </div>
                            <div class="faskes-info-item">
                                <span class="faskes-info-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                </span>
                                <span>(0263) 26567</span>
                            </div>
                            <div class="faskes-info-item">
                                <span class="faskes-info-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                </span>
                                <span>Senin - Minggu, 24 Jam</span>
                            </div>
                        </div>
                        <div class="faskes-card-actions">
                            <a href="#" class="faskes-btn faskes-btn-peta">
                                <span class="faskes-btn-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                </span>
                                Lihat di Peta
                            </a>
                            <a href="https://wa.me/6281234567893" target="_blank" class="faskes-btn faskes-btn-wa">
                                <span class="faskes-btn-icon">
                                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                </span>
                                Hubungi WA
                            </a>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </main>
</div>
