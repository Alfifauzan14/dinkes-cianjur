<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $program->title }} - Dinkes Cianjur</title>
</head>
<body style="background-color: #FFFFFF; margin: 0; padding: 0; min-height: 100vh;">
    @include('layouts.navbar')

    <link rel="stylesheet" href="{{ asset('css/ProgramKesehatan/program.css') }}?v={{ time() }}">

    <div class="prog-page-wrapper">
        <!-- Header Section -->
        <header class="prog-header">
            <div class="prog-header-container">
                <h1 class="prog-header-title">{{ $program->title }}</h1>
                @if($program->subtitle)
                    <p class="prog-header-subtitle">{{ $program->subtitle }}</p>
                @endif
            </div>
        </header>

        <!-- Main Content Section -->
        <main class="prog-content">
            <div class="prog-container">

                <!-- Data Statistik Terkini (Optional, only shows if populated) -->
                @if($program->stat_1_num || $program->stat_2_num || $program->stat_3_num)
                    <div class="prog-category-section">
                        <div class="prog-title-section">
                            <h2 class="prog-main-title">Data Terkini</h2>
                            <p class="prog-main-subtitle">Angka pencapaian dan data indikator program terbaru di Kabupaten Cianjur.</p>
                        </div>
                        <div class="prog-info-grid">
                            @if($program->stat_1_num)
                                <div class="prog-info-card">
                                    <p class="prog-info-number">{{ $program->stat_1_num }}</p>
                                    <p class="prog-info-label">{{ $program->stat_1_label }}</p>
                                </div>
                            @endif
                            @if($program->stat_2_num)
                                <div class="prog-info-card">
                                    <p class="prog-info-number">{{ $program->stat_2_num }}</p>
                                    <p class="prog-info-label">{{ $program->stat_2_label }}</p>
                                </div>
                            @endif
                            @if($program->stat_3_num)
                                <div class="prog-info-card">
                                    <p class="prog-info-number">{{ $program->stat_3_num }}</p>
                                    <p class="prog-info-label">{{ $program->stat_3_label }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Program Intervensi (Optional, only shows if populated) -->
                @if($program->intervensi && count($program->intervensi) > 0)
                    <div class="prog-category-section">
                        <div class="prog-title-section">
                            <h2 class="prog-main-title">Program Intervensi</h2>
                        </div>
                        <div class="prog-program-grid">
                            @foreach($program->intervensi as $item)
                                <div class="prog-program-item">
                                    <h3 class="prog-program-number">{{ $loop->iteration }}. {{ $item['title'] }}</h3>
                                    <p class="prog-program-desc">{{ $item['description'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Content Article Details (Optional, only shows if populated) -->
                @if($program->content)
                    <div class="prog-content-card">
                        {!! $program->content !!}
                    </div>
                @endif

            </div>
        </main>
    </div>

    @include('layouts.footer')
</body>
</html>
