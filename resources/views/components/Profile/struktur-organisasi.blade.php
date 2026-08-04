<!-- Struktur Organisasi Section Card -->
<div class="struktur-card-container" style="background: #FFFFFF; border: 1px solid #E2E8F0; padding: 24px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
    <span class="struktur-badge" style="display: inline-block; background-color: #E6F4EA; color: #009966; padding: 6px 12px; border-radius: 9999px; font-size: 12px; font-weight: 700; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 0.5px;">Bagan Struktur</span>
    
    <div class="struktur-image-wrap" style="text-align: center; border: 1px solid #F1F5F9; border-radius: 8px; padding: 16px; background-color: #F8FAFC;">
        @if($profile && $profile->struktur_organisasi_image)
            @if(file_exists(public_path('uploads/profile/' . $profile->struktur_organisasi_image)))
                <img src="{{ asset('uploads/profile/' . $profile->struktur_organisasi_image) }}" alt="Bagan Struktur Organisasi Dinkes Cianjur" style="max-width: 100%; height: auto; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);" class="lightbox-trigger">
            @else
                <img src="{{ asset('images/' . $profile->struktur_organisasi_image) }}" alt="Bagan Struktur Organisasi Dinkes Cianjur" style="max-width: 100%; height: auto; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);" class="lightbox-trigger">
            @endif
        @else
            <!-- Default placeholder structure image if not uploaded -->
            <div style="padding: 60px 20px; color: #94A3B8;">
                <span class="material-icons" style="font-size: 64px; color: #CBD5E1; margin-bottom: 12px;">account_tree</span>
                <p style="font-size: 15px; font-weight: 500; margin: 0 0 4px 0;">Bagan Struktur Organisasi Belum Diunggah</p>
                <p style="font-size: 13px; margin: 0; color: #94A3B8;">Silakan unggah bagan melalui Panel Admin pada menu Edit Profil.</p>
            </div>
        @endif
    </div>
</div>
