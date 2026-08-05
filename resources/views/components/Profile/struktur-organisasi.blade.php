<!-- Struktur Organisasi Section -->
<div id="struktur-organisasi" class="struktur-section">
    <div class="struktur-header">
        <span class="struktur-subtitle">Profil Organisasi</span>
        <h2 class="struktur-title">Struktur organisasi</h2>
    </div>

    @if($profile && $profile->struktur_organisasi_image)
        @if(file_exists(public_path('uploads/profile/' . $profile->struktur_organisasi_image)))
            <div class="struktur-image-wrapper">
                <img src="{{ asset('uploads/profile/' . $profile->struktur_organisasi_image) }}" alt="Struktur Organisasi Dinas Kesehatan Kabupaten Cianjur" class="struktur-image">
            </div>

            <!-- Keterangan -->
            <div class="struktur-description">
                <p>Struktur organisasi disusun <strong>sesuai Peraturan Bupati Cianjur Nomor 85 Tahun 2021</strong> tentang Tugas dan Fungsi serta Tata Kerja Unit Organisasi di Lingkungan Dinas Kesehatan Kabupaten Cianjur, yang berkedudukan di bawah dan bertanggung jawab kepada Bupati Cianjur melalui Sekretaris Daerah.</p>
            </div>

            <!-- Action Buttons -->
            <div class="struktur-actions">
                <a href="{{ asset('uploads/profile/' . $profile->struktur_organisasi_image) }}" download="sturkture-dinkes" class="struktur-btn struktur-btn-primary">
                    <span class="material-icons">file_download</span>
                    <span>Simpan Struktur Organisasi</span>
                </a>
                <button type="button" class="struktur-btn struktur-btn-outline" onclick="window.print()">
                    <span class="material-icons">print</span>
                    <span>Cetak Halaman</span>
                </button>
            </div>
        @else
            <div class="struktur-empty-state">
                <span class="material-icons struktur-empty-icon">account_tree</span>
                <p class="struktur-empty-text">Struktur Organisasi tidak tersedia</p>
                <p class="struktur-empty-subtext">Gambar struktur organisasi belum ditemukan di server.</p>
            </div>
        @endif
    @else
        <div class="struktur-empty-state">
            <span class="material-icons struktur-empty-icon">account_tree</span>
            <p class="struktur-empty-text">Struktur Organisasi tidak tersedia</p>
            <p class="struktur-empty-subtext">Belum ada gambar struktur organisasi yang diunggah melalui halaman admin.</p>
        </div>
    @endif
</div>
