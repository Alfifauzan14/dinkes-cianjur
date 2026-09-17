<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $galeri->title }} - Galeri Kegiatan Dinas Kesehatan Kabupaten Cianjur">
    <title>{{ $galeri->title }} - Galeri Kegiatan</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/Lihat_semua/media-show.css') }}?v={{ time() }}">
</head>
<body style="background-color: #FFFFFF; margin: 0; padding: 0; min-height: 100vh; font-family: 'Plus Jakarta Sans', sans-serif;">

    @include('layouts.navbar')

    @include('components.Lihat_semua.media-show')

    @include('layouts.footer')

</body>
</html>
