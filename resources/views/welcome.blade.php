<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Dinas Kesehatan Kabupaten Cianjur - Mewujudkan masyarakat Cianjur yang sehat, mandiri, dan berkeadilan.">
    <title>Dinas Kesehatan Kabupaten Cianjur</title>

    {{-- Google Fonts: Plus Jakarta Sans --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FFFFFF;
            color: #111827;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            padding-top: 120px;
            -webkit-font-smoothing: antialiased;
        }

        main {
            flex: 1;
        }

        /* ============================================================
           SECTION SAMBUTAN PIMPINAN STYLES
           ============================================================ */
        .sambutan-section {
            padding: 80px 0;
            background-color: #ffffff;
            overflow: hidden;
        }

        .sambutan-container {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 40px;
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
            gap: 60px;
            align-items: center;
        }

        /* ---- Left Column: Content ---- */
        .sambutan-content {
            display: flex;
            flex-direction: column;
        }

        .sambutan-badge {
            font-size: 18px;
            font-weight: 700;
            color: #00a859;
            margin-bottom: 12px;
            letter-spacing: -0.2px;
        }

        .sambutan-title {
            font-size: 38px;
            font-weight: 800;
            color: #0d2818;
            line-height: 1.25;
            margin-bottom: 24px;
            letter-spacing: -0.5px;
        }

        .sambutan-quote {
            font-size: 16.5px;
            font-weight: 700;
            color: #1a1a1a;
            line-height: 1.55;
            margin-bottom: 20px;
        }

        .sambutan-desc {
            font-size: 14px;
            font-weight: 400;
            color: #555555;
            line-height: 1.7;
            margin-bottom: 14px;
        }

        .sambutan-author {
            margin-top: 28px;
        }

        .sambutan-author-name {
            font-size: 18px;
            font-weight: 700;
            color: #00a859;
            margin-bottom: 4px;
        }

        .sambutan-author-role {
            font-size: 13.5px;
            font-weight: 500;
            color: #888888;
        }

        /* ---- Right Column: Visual Graphic & Photo ---- */
        .sambutan-visual {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: flex-end;
            min-height: 480px;
        }

        /* Shape Latar Belakang Hijau */
        .sambutan-shape-bg {
            position: absolute;
            right: 0;
            bottom: 20px;
            width: 82%;
            height: 78%;
            background: linear-gradient(135deg, #00c853 0%, #00a859 100%);
            border-radius: 28px 0 28px 28px;
            z-index: 1;
            overflow: hidden;
        }

        /* Ornamen Lingkaran Transparan */
        .sambutan-shape-bg::after {
            content: '';
            position: absolute;
            right: -60px;
            bottom: -60px;
            width: 260px;
            height: 260px;
            border-radius: 50%;
            border: 35px solid rgba(255, 255, 255, 0.12);
            pointer-events: none;
        }

        /* Foto Pimpinan */
        .sambutan-photo {
            position: relative;
            z-index: 2;
            max-height: 500px;
            width: auto;
            object-fit: contain;
            filter: drop-shadow(0 12px 24px rgba(0, 0, 0, 0.15));
        }

        /* ---- Responsive Design ---- */
        @media (max-width: 1024px) {
            .sambutan-container {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .sambutan-title {
                font-size: 32px;
            }

            .sambutan-visual {
                min-height: 400px;
            }

            .sambutan-shape-bg {
                width: 70%;
                height: 80%;
            }

            .sambutan-photo {
                max-height: 420px;
            }
        }

        @media (max-width: 640px) {
            .sambutan-section {
                padding: 50px 0;
            }

            .sambutan-container {
                padding: 0 20px;
            }

            .sambutan-badge {
                font-size: 16px;
            }

            .sambutan-title {
                font-size: 26px;
            }

            .sambutan-quote {
                font-size: 15px;
            }

            .sambutan-desc {
                font-size: 13.5px;
            }

            .sambutan-shape-bg {
                width: 85%;
            }

            .sambutan-photo {
                max-height: 360px;
            }
        }
    </style>
</head>
<body>

    {{-- Navbar Component --}}
    @include('layouts.navbar')

    <main>
        {{-- Hero Component --}}
        @include('layouts.hero')

        {{-- Section Sambutan Pimpinan --}}
        <section class="sambutan-section" aria-labelledby="sambutan-heading">
            <div class="sambutan-container">
                
                {{-- Kolom Kiri: Teks & Informasi --}}
                <div class="sambutan-content">
                    <span class="sambutan-badge">Sambutan Pimpinan</span>
                    <h2 id="sambutan-heading" class="sambutan-title">
                        Selamat Datang di Portal Resmi<br>Dinkes Cianjur
                    </h2>
                    
                    <p class="sambutan-quote">
                        "Kesehatan masyarakat adalah fondasi utama pembangunan daerah. Kami berkomitmen memberikan keterbukaan data dan kemudahan akses medis bagi seluruh warga Cianjur."
                    </p>
                    
                    <p class="sambutan-desc">
                        Melalui portal ini, kami berupaya mendekatkan pelayanan kesehatan kepada masyarakat secara digital. Mulai dari pendaftaran pasien, pencarian klinik, hingga publikasi status sebaran gizi dan stunting untuk mewujudkan Cianjur sehat.
                    </p>
                    
                    <p class="sambutan-desc">
                        Mari kita bersama-sama menerapkan Pola Hidup Bersih dan Sehat (PHBS) demi masa depan keluarga kita yang lebih baik.
                    </p>

                    <div class="sambutan-author">
                        <h3 class="sambutan-author-name">Dr. I Made Setiawan</h3>
                        <p class="sambutan-author-role">Kepala Dinas Kesehatan Kabupaten Cianjur</p>
                    </div>
                </div>

                {{-- Kolom Kanan: Foto Pimpinan & Graphic Shape --}}
                <div class="sambutan-visual">
                    <div class="sambutan-shape-bg" aria-hidden="true"></div>
                    <img 
                        src="{{ asset('images/pimpinan.png') }}" 
                        alt="Dr. I Made Setiawan - Kepala Dinas Kesehatan Kabupaten Cianjur" 
                        class="sambutan-photo"
                        loading="lazy"
                        decoding="async"
                        onerror="this.onerror=null; this.src='https://placehold.co/400x500/transparent/00a859?text=Dr.+I+Made+Setiawan';"
                    />
                </div>

            </div>
        </section>
    </main>

    {{-- Footer Component --}}
    @include('layouts.footer')

</body>
</html>
