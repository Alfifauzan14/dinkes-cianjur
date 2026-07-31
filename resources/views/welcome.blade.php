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

    {{-- Material Icons --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    {{-- FontAwesome for Brands/Social Icons --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

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
            -webkit-font-smoothing: antialiased;
        }

        main {
            flex: 1;
        }
    </style>
</head>
<body>

    {{-- Navbar Component --}}
    @include('layouts.navbar')

    <main>
        {{-- Hero Component --}}
        @include('components.home.hero')

        {{-- Info Cards --}}
        @include('components.home.cards')

        {{-- Section Sambutan Pimpinan Component --}}
        @include('components.home.sambutan')

        {{-- Layanan Component --}}
        @include('components.home.layanan')

        {{-- Berita Component --}}
        @include('components.home.berita')

        {{-- Media & Agenda Component --}}
        @include('components.home.mediaagenda')
    </main>

    {{-- Footer Layout --}}
    @include('layouts.footer')

</body>
</html>
