<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            background-color: #f5f5f5;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .page-placeholder {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 20px;
            background: linear-gradient(135deg, #1e6b3c 0%, #2d8a50 100%);
            color: #fff;
            text-align: center;
        }

        .page-placeholder h1 {
            font-size: 2rem;
            margin-bottom: 12px;
            font-weight: 700;
        }

        .page-placeholder p {
            font-size: 1rem;
            opacity: 0.85;
        }
    </style>
</head>
<body>

    {{-- Konten Halaman Utama (placeholder) --}}
    <main class="page-placeholder">
        <div>
            <h1>Dinas Kesehatan Kabupaten Cianjur</h1>
            <p>Selamat datang di portal resmi Dinas Kesehatan Kabupaten Cianjur.</p>
        </div>
    </main>

    {{-- Footer Layout --}}
    @include('layouts.footer')

</body>
</html>
