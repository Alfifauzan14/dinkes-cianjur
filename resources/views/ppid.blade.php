<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PPID - Dinkes Cianjur</title>
    {{-- Material Icons --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    {{-- FontAwesome for Brands --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body style="background-color: #FFFFFF; margin: 0; padding: 0; min-height: 100vh;">
    @include('layouts.navbar')
    @include('components.PPID.ppid')
    @include('layouts.footer')
</body>
</html>
