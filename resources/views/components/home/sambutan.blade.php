<link rel="stylesheet" href="{{ asset('css/home/sambutan.css') }}?v={{ time() }}">

<section class="sambutan-section" aria-labelledby="sambutan-heading">
    <div class="sambutan-container">
        
        {{-- Kolom Kiri: Teks & Informasi --}}
        <div class="sambutan-content">
            <span class="sambutan-badge">Sambutan Pimpinan</span>
            <h2 id="sambutan-heading" class="sambutan-title">
                {!! nl2br(e($profile ? $profile->sambutan_title : 'Selamat Datang di Portal Resmi Dinkes Cianjur')) !!}
            </h2>
            
            <p class="sambutan-quote">
                "{!! e($profile ? $profile->sambutan_quote : 'Kesehatan masyarakat adalah fondasi utama pembangunan daerah. Kami berkomitmen memberikan keterbukaan data dan kemudahan akses medis bagi seluruh warga Cianjur.') !!}"
            </p>
            
            <p class="sambutan-desc">
                {!! e($profile ? $profile->sambutan_desc_1 : 'Melalui portal ini, kami berupaya mendekatkan pelayanan kesehatan kepada masyarakat secara digital. Mulai dari pendaftaran pasien, pencarian klinik, hingga publikasi status sebaran gizi dan stunting untuk mewujudkan Cianjur sehat.') !!}
            </p>
            
            <p class="sambutan-desc">
                {!! e($profile ? $profile->sambutan_desc_2 : 'Mari kita bersama-sama menerapkan Pola Hidup Bersih dan Sehat (PHBS) demi masa depan keluarga kita yang lebih baik.') !!}
            </p>

            <div class="sambutan-author">
                <h3 class="sambutan-author-name">{{ $profile ? $profile->kepala_dinas_name : 'Dr. I Made Setiawan' }}</h3>
                <p class="sambutan-author-role">{{ $profile ? $profile->kepala_dinas_role : 'Kepala Dinas Kesehatan Kabupaten Cianjur' }}</p>
            </div>
        </div>

        {{-- Kolom Kanan: Foto Pimpinan --}}
        <div class="sambutan-visual">
            @if($profile && $profile->kepala_dinas_image)
                @if(file_exists(public_path('uploads/profile/' . $profile->kepala_dinas_image)))
                    <img 
                        src="{{ asset('uploads/profile/' . $profile->kepala_dinas_image) }}" 
                        alt="{{ $profile->kepala_dinas_name }}" 
                        class="sambutan-photo"
                        loading="lazy"
                        decoding="async"
                    />
                @else
                    <img 
                        src="{{ asset('images/' . $profile->kepala_dinas_image) }}" 
                        alt="{{ $profile->kepala_dinas_name }}" 
                        class="sambutan-photo"
                        loading="lazy"
                        decoding="async"
                    />
                @endif
            @else
                <img 
                    src="{{ asset('Assets/home/sambutan/Group 83.png') }}" 
                    alt="Dr. I Made Setiawan - Kepala Dinas Kesehatan Kabupaten Cianjur" 
                    class="sambutan-photo"
                    loading="lazy"
                    decoding="async"
                />
            @endif
        </div>

    </div>
</section>
