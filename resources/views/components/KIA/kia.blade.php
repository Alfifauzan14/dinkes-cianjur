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

<style>
.kia-info-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    margin-bottom: 40px;
}
.kia-info-card {
    background: #FFFFFF;
    border: 1px solid #E5E7EB;
    border-radius: 1px;
    padding: 32px;
    box-shadow: 0 0 35px rgba(0, 0, 0, 0.05);
    box-sizing: border-box;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    text-align: center;
}
.kia-info-card:hover {
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    transform: translateY(-4px);
}
.kia-info-number {
    font-size: 48px;
    font-weight: 800;
    color: #009966;
    margin: 0 0 8px 0;
    line-height: 1;
}
.kia-info-label {
    font-size: 16px;
    font-weight: 600;
    color: #374151;
    margin: 0;
    line-height: 1.4;
}
@media (max-width: 768px) {
    .kia-info-grid {
        grid-template-columns: 1fr;
    }
}
</style>

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

            <!-- Data & Statistik Terkini -->
            @if($program && ($program->stat_1_num || $program->stat_2_num || $program->stat_3_num))
            <div class="kia-category-section">
                <div class="kia-title-section">
                    <h2 class="kia-main-title">Data & Statistik Terkini</h2>
                </div>
                <div class="kia-info-grid">
                    @if($program->stat_1_num)
                        <div class="kia-info-card">
                            <p class="kia-info-number">{{ $program->stat_1_num }}</p>
                            <p class="kia-info-label">{{ $program->stat_1_label }}</p>
                        </div>
                    @endif
                    @if($program->stat_2_num)
                        <div class="kia-info-card">
                            <p class="kia-info-number">{{ $program->stat_2_num }}</p>
                            <p class="kia-info-label">{{ $program->stat_2_label }}</p>
                        </div>
                    @endif
                    @if($program->stat_3_num)
                        <div class="kia-info-card">
                            <p class="kia-info-number">{{ $program->stat_3_num }}</p>
                            <p class="kia-info-label">{{ $program->stat_3_label }}</p>
                        </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Program KIA -->
            @if($program && $program->intervensi && count($program->intervensi) > 0)
            <div class="kia-category-section">
                <div class="kia-title-section">
                    <h2 class="kia-main-title">Program Kesehatan Ibu & Anak</h2>
                </div>
                <div class="kia-program-grid">
                    @foreach($program->intervensi as $item)
                        <div class="kia-program-item">
                            <h3 class="kia-program-number">{{ $loop->iteration }}. {{ $item['title'] }}</h3>
                            <p class="kia-program-desc">{{ $item['description'] }}</p>
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
