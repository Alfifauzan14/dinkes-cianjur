<link rel="stylesheet" href="{{ asset('css/Stunting/stunting.css') }}?v={{ time() }}">

@php
    $program = $program ?? \App\Models\ProgramKesehatan::where('slug', 'cianjur-bebas-stunting')->first();
    
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

<div class="st-page-wrapper">
    <header class="st-header">
        <div class="st-header-container">
            <h1 class="st-header-title">{{ $program ? $program->title : 'Cianjur Bebas Stunting' }}</h1>
            @if($program && $program->subtitle)
                <p class="st-header-subtitle">{{ $program->subtitle }}</p>
            @else
                <p class="st-header-subtitle">Program komprehensif untuk mencegah dan menurunkan angka stunting di Kabupaten Cianjur melalui intervensi gizi dan edukasi.</p>
            @endif
        </div>
    </header>

    <main class="st-content">
        <div class="st-container">

            <!-- Data Stunting Terkini -->
            @if($program && ($program->stat_1_num || $program->stat_2_num || $program->stat_3_num))
            <div class="st-category-section">
                <div class="st-title-section">
                    <h2 class="st-main-title">Data Stunting Terkini</h2>
                    <p class="st-main-subtitle">Angka pencapaian dan data indikator program terbaru di Kabupaten Cianjur.</p>
                </div>
                <div class="st-info-grid">
                    @if($program->stat_1_num)
                        <div class="st-info-card">
                            <p class="st-info-number">{{ $program->stat_1_num }}</p>
                            <p class="st-info-label">{{ $program->stat_1_label }}</p>
                        </div>
                    @endif
                    @if($program->stat_2_num)
                        <div class="st-info-card">
                            <p class="st-info-number">{{ $program->stat_2_num }}</p>
                            <p class="st-info-label">{{ $program->stat_2_label }}</p>
                        </div>
                    @endif
                    @if($program->stat_3_num)
                        <div class="st-info-card">
                            <p class="st-info-number">{{ $program->stat_3_num }}</p>
                            <p class="st-info-label">{{ $program->stat_3_label }}</p>
                        </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Program Intervensi -->
            @if($program && $program->intervensi && count($program->intervensi) > 0)
            <div class="st-category-section">
                <div class="st-title-section">
                    <h2 class="st-main-title">Program Intervensi</h2>
                </div>
                <div class="st-program-grid">
                    @foreach($program->intervensi as $item)
                        <div class="st-program-item">
                            <div class="st-program-header" style="display: flex; align-items: center; gap: 12px;">
                                <div class="st-program-icon-wrap" style="display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; background-color: #E6F4EA; border-radius: 50%; flex-shrink: 0;">
                                    <span class="material-icons" style="font-size: 20px; color: #009966;">{{ $item['icon'] ?? 'check_circle' }}</span>
                                </div>
                                <h3 class="st-program-number" style="margin: 0;">{{ $item['title'] }}</h3>
                            </div>
                            <p class="st-program-desc" style="margin-top: 4px; padding-left: 52px;">{{ $item['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Edukasi & Detail Program -->
            @if($program && $program->content)
            <div class="st-content-card">
                @if(Str::contains($program->content, ['<p>', '<h3>', '<ul>', '<div>', '<br>']))
                    {!! $program->content !!}
                @else
                    {!! $parsePlainText($program->content, 'st-content-title', 'st-content-text', 'st-content-list') !!}
                @endif
            </div>
            @endif
        </div>
    </main>
</div>
