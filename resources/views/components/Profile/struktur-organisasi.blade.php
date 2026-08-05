<!-- Struktur Organisasi Section -->
<div class="struktur-organisasi-section" style="max-width: 1000px; margin: 0 auto;">
    <div style="text-align: left; margin-bottom: 24px;">
        <span class="struktur-subtitle" style="display: block; color: #009966; font-size: 16px; font-weight: 700; margin-bottom: 4px;">Profil Organisasi</span>
        <h2 style="font-size: 32px; font-weight: 800; color: #111827; margin: 0; letter-spacing: -0.5px;">Struktur organisasi</h2>
    </div>

    <div class="struktur-card-container" style="background: #FFFFFF; border: 1px solid #E2E8F0; padding: 32px; border-radius: 16px; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05); margin-bottom: 24px;">
        <div class="struktur-image-wrap" style="text-align: center; border-radius: 12px; background-color: #F8FAFC; padding: 20px; border: 1px dashed #CBD5E1;">
            @if($profile && $profile->struktur_organisasi_image)
                @if(file_exists(public_path('uploads/profile/' . $profile->struktur_organisasi_image)))
                    <img src="{{ asset('uploads/profile/' . $profile->struktur_organisasi_image) }}" alt="Bagan Struktur Organisasi Dinkes Cianjur" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);" class="lightbox-trigger">
                @else
                    <img src="{{ asset('images/' . $profile->struktur_organisasi_image) }}" alt="Bagan Struktur Organisasi Dinkes Cianjur" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);" class="lightbox-trigger">
                @endif
            @else
                <!-- Default placeholder structure image if not uploaded -->
                <div style="padding: 80px 20px; color: #94A3B8;">
                    <span class="material-icons" style="font-size: 80px; color: #E2E8F0; margin-bottom: 16px;">account_tree</span>
                    <p style="font-size: 18px; font-weight: 600; margin: 0 0 8px 0; color: #64748B;">Bagan Struktur Organisasi Belum Diunggah</p>
                    <p style="font-size: 14px; margin: 0; color: #94A3B8;">Struktur organisasi Dinas Kesehatan Kabupaten Cianjur.</p>
                </div>
            @endif
        </div>
    </div>

    <div class="struktur-bottom-actions" style="background: #FFFFFF; padding: 24px 32px; border-radius: 4px; border: 1px solid #F1F5F9; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03); margin-bottom: 24px;">
        <div class="struktur-info-text" style="text-align: center; margin-bottom: 24px;">
            <p style="margin: 0; font-size: 14.5px; color: #475569; line-height: 1.7;">
                Struktur organisasi disusun <strong style="color: #009966;">sesuai Peraturan Bupati Cianjur Nomor 85 Tahun 2021</strong> tentang Tugas dan Fungsi serta Tata Kerja Unit Organisasi di Lingkungan Dinas Kesehatan Kabupaten Cianjur, yang berkedudukan di bawah dan bertanggung jawab kepada Bupati Cianjur melalui Sekretaris Daerah.
            </p>
        </div>
        <div class="struktur-buttons" style="display: flex; gap: 16px; justify-content: center;">
            @if($profile && $profile->struktur_organisasi_image)
                <a href="{{ file_exists(public_path('uploads/profile/' . $profile->struktur_organisasi_image)) ? asset('uploads/profile/' . $profile->struktur_organisasi_image) : asset('images/' . $profile->struktur_organisasi_image) }}" download="Struktur_Organisasi_Dinkes.png" class="btn-download" style="display: inline-flex; align-items: center; justify-content: center; background-color: #00CC88; color: white; padding: 12px 24px; border-radius: 4px; font-size: 15px; font-weight: 700; text-decoration: none; transition: background-color 0.2s;">
                    <span class="material-icons" style="font-size: 20px; margin-right: 8px;">file_download</span> Simpan Struktur Organisasi
                </a>
            @endif
            <button onclick="window.print()" class="btn-print" style="display: inline-flex; align-items: center; justify-content: center; background-color: #FFFFFF; color: #00CC88; border: 1px solid #E2E8F0; padding: 12px 24px; border-radius: 4px; font-size: 15px; font-weight: 700; cursor: pointer; transition: all 0.2s;">
                <span class="material-icons" style="font-size: 20px; margin-right: 8px;">print</span> Cetak Halaman
            </button>
        </div>
    </div>
</div>

<style>
    @media (max-width: 768px) {
        .struktur-bottom-actions {
            flex-direction: column;
            align-items: stretch;
            text-align: center;
        }
        .struktur-buttons {
            justify-content: center;
        }
    }
    .btn-download:hover {
        background-color: #00B377 !important;
    }
    .btn-print:hover {
        background-color: #F8FAFC !important;
        border-color: #00CC88 !important;
    }
</style>
