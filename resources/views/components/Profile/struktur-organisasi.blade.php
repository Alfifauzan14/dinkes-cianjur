<!-- Struktur Organisasi Section -->
<div class="struktur-organisasi-section">
    <div class="struktur-header-wrap">
        <span class="struktur-subtitle">Profil Organisasi</span>
        <h2 class="struktur-title">Struktur organisasi</h2>
    </div>

    <div class="struktur-card-container">
        <div class="struktur-image-wrap">
            @if($profile && $profile->struktur_organisasi_image)
                @if(file_exists(public_path('uploads/profile/' . $profile->struktur_organisasi_image)))
                    <img src="{{ asset('uploads/profile/' . $profile->struktur_organisasi_image) }}" alt="Bagan Struktur Organisasi Dinkes Cianjur" class="struktur-img-main lightbox-trigger">
                @else
                    <img src="{{ asset('images/' . $profile->struktur_organisasi_image) }}" alt="Bagan Struktur Organisasi Dinkes Cianjur" class="struktur-img-main lightbox-trigger">
                @endif
            @else
                <!-- Default placeholder structure image if not uploaded -->
                <div class="struktur-empty-wrap">
                    <span class="material-icons struktur-empty-icon">account_tree</span>
                    <p class="struktur-empty-title">Bagan Struktur Organisasi Belum Diunggah</p>
                    <p class="struktur-empty-desc">Struktur organisasi Dinas Kesehatan Kabupaten Cianjur.</p>
                </div>
            @endif
        </div>
    </div>

    <div class="struktur-bottom-actions">
        <div class="struktur-info-text">
            <p class="struktur-info-p">
                Struktur organisasi disusun <strong class="struktur-info-strong">sesuai Peraturan Bupati Cianjur Nomor 85 Tahun 2021</strong> tentang Tugas dan Fungsi serta Tata Kerja Unit Organisasi di Lingkungan Dinas Kesehatan Kabupaten Cianjur, yang berkedudukan di bawah dan bertanggung jawab kepada Bupati Cianjur melalui Sekretaris Daerah.
            </p>
        </div>
        <div class="struktur-buttons">
            @if($profile && $profile->struktur_organisasi_image)
                <a href="{{ file_exists(public_path('uploads/profile/' . $profile->struktur_organisasi_image)) ? asset('uploads/profile/' . $profile->struktur_organisasi_image) : asset('images/' . $profile->struktur_organisasi_image) }}" download="Struktur_Organisasi_Dinkes.png" class="struktur-btn-primary">
                    <span class="material-icons struktur-btn-icon">file_download</span> Simpan Struktur Organisasi
                </a>
            @endif
            <button onclick="window.print()" class="struktur-btn-outline">
                <span class="material-icons struktur-btn-icon">print</span> Cetak Halaman
            </button>
        </div>
    </div>
</div>
