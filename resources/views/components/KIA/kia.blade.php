<link rel="stylesheet" href="{{ asset('css/KIA/kia.css') }}?v={{ time() }}">

@php
    $program = $program ?? \App\Models\ProgramKesehatan::where('slug', 'kesehatan-ibu-anak')->first();
    
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

<div class="kia-page-wrapper">
    <!-- Header Section -->
    <header class="kia-header">
        <div class="kia-header-container">
            <h1 class="kia-header-title">{{ $program ? $program->title : 'Kesehatan Ibu & Anak (KIA)' }}</h1>
            @if($program && $program->subtitle)
                <p class="kia-header-subtitle">{{ $program->subtitle }}</p>
            @else
                <p class="kia-header-subtitle">Pelayanan kesehatan komprehensif untuk ibu dan anak yang meliputi periode pra-konsepsi, kehamilan, persalinan, nifas, dan bayi.</p>
            @endif
        </div>
    </header>

    <!-- Main Content Section -->
    <main class="kia-content">
        <div class="kia-container">

            <!-- Program KIA -->
            @if($program && $program->intervensi && count($program->intervensi) > 0)
            <div class="kia-category-section">
                <div class="kia-title-section">
                    <h2 class="kia-main-title">Program Kesehatan Ibu & Anak</h2>
                </div>
                <div class="kia-program-grid">
                    @foreach($program->intervensi as $item)
                        <div class="kia-program-item">
                            <div class="kia-program-header" style="display: flex; align-items: center; gap: 12px;">
                                <div class="kia-program-icon-wrap" style="display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; background-color: #E6F4EA; border-radius: 50%; flex-shrink: 0;">
                                    <span class="material-icons" style="font-size: 20px; color: #009966;">{{ $item['icon'] ?? 'check_circle' }}</span>
                                </div>
                                <h3 class="kia-program-number" style="margin: 0;">{{ $item['title'] }}</h3>
                            </div>
                            <p class="kia-program-desc" style="margin-top: 4px; padding-left: 52px;">{{ $item['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Detail Program / Edukasi -->
            @if($program && $program->content)
            <div class="kia-content-card">
                @if(Str::contains($program->content, ['<p>', '<h3>', '<ul>', '<div>', '<br>']))
                    {!! $program->content !!}
                @else
                    {!! $parsePlainText($program->content, 'kia-content-title', 'kia-content-text', 'kia-content-list') !!}
                @endif
            </div>
            @endif
        </div>
    </main>
</div>
