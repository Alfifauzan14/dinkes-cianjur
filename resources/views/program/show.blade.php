<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $program->title }} - Dinkes Cianjur</title>

    {{-- Google Fonts: Plus Jakarta Sans --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

    {{-- Material Icons --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body style="background-color: #FFFFFF; margin: 0; padding: 0; min-height: 100vh;">
    @include('layouts.navbar')

@php
    // Plain-text parser helper to render content beautifully without raw HTML input
    $parsePlainText = function($text, $titleClass, $textClass, $listClass) {
        $blocks = preg_split('/\n\s*\n/', trim($text));
        $html = '';
        foreach ($blocks as $block) {
            $block = trim($block);
            if (empty($block)) continue;
            
            // Check if it's a list (all non-empty lines start with bullet markers)
            $lines = explode("\n", $block);
            $isList = true;
            foreach ($lines as $line) {
                $line = trim($line);
                if (!empty($line) && !preg_match('/^[\-\*\x{2022}]\s|^\d+\.\s/u', $line)) {
                    $isList = false;
                    break;
                }
            }
            
            if ($isList && count($lines) > 0) {
                $html .= '<ul class="' . e($listClass) . '">';
                foreach ($lines as $line) {
                    $line = trim($line);
                    if (empty($line)) continue;
                    $cleanedLine = preg_replace('/^[\-\*\x{2022}]\s*|^\d+\.\s*/u', '', $line);
                    $html .= '<li>' . e($cleanedLine) . '</li>';
                }
                $html .= '</ul>';
            } else {
                // If it's short and doesn't end with a period, or ends with a colon, it's a heading
                $isHeading = (strlen($block) < 80 && !str_ends_with($block, '.')) || str_ends_with($block, ':');
                if ($isHeading) {
                    $headingText = rtrim($block, ':');
                    $html .= '<h3 class="' . e($titleClass) . '">' . e($headingText) . '</h3>';
                } else {
                    $html .= '<p class="' . e($textClass) . '">' . nl2br(e($block)) . '</p>';
                }
            }
        }
        return $html;
    };
@endphp

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
                        @if(Str::contains($program->content, ['<p>', '<h3>', '<ul>', '<div>', '<br>']))
                            {!! $program->content !!}
                        @else
                            {!! $parsePlainText($program->content, 'prog-content-title', 'prog-content-text', 'prog-content-list') !!}
                        @endif
                    </div>
                @endif

            </div>
        </main>
    </div>

    @include('layouts.footer')
</body>
</html>
