<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Agenda Kegiatan Dinas Kesehatan Kabupaten Cianjur - Informasi jadwal acara dan program kerja.">
    <title>Agenda Kegiatan - Dinas Kesehatan Kabupaten Cianjur</title>

    {{-- Google Fonts: Plus Jakarta Sans --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    {{-- Material Icons --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    {{-- FontAwesome for Brands --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body style="background-color: #FFFFFF; margin: 0; padding: 0; min-height: 100vh; font-family: 'Plus Jakarta Sans', sans-serif;">

    {{-- Navbar --}}
    @include('layouts.navbar')

    {{-- Main Component --}}
    @include('components.Lihat_semua.agenda')

    {{-- Footer --}}
    @include('layouts.footer')

</body>
</html>
