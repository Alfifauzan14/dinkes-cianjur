<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fasilitas Kesehatan - Dinkes Cianjur</title>
</head>
<body style="background-color: #FFFFFF; margin: 0; padding: 0; min-height: 100vh;">
    @include('layouts.navbar')
    @include('components.home.faskes')
</body>
</html>
