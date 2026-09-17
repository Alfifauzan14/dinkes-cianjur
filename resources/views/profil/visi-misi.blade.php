<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Visi & Misi - Dinkes Cianjur</title>
    {{-- Material Icons --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    {{-- FontAwesome for Brands --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body style="background-color: #FFFFFF; margin: 0; padding: 0; min-height: 100vh;">
    @include('layouts.navbar')

    <link rel="stylesheet" href="{{ asset('css/Profile/profile.css') }}?v={{ time() }}">

    <div class="profile-page-wrapper">
        <header class="profile-header">
            <div class="profile-header-container">
                <h1 class="profile-header-title">Visi & Misi</h1>
                <p class="profile-header-subtitle">Arah kebijakan strategis dan komitmen pelayanan kesehatan Dinas Kesehatan Kabupaten Cianjur.</p>
            </div>
        </header>

        <main class="profile-content">
            <div class="profile-container">
                @include('components.Profile.visi-misi', ['profile' => $profile, 'puskesmasCount' => $puskesmasCount, 'kecamatanCount' => $kecamatanCount])
            </div>
        </main>
    </div>

    @include('layouts.footer')
</body>
</html>
