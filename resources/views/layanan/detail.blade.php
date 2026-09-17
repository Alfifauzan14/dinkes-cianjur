<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $service->name }} - Layanan Terpadu Dinkes Cianjur</title>

    {{-- Google Fonts: Plus Jakarta Sans --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

    {{-- Material Icons --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/LayananTerpadu/layanan-terpadu-detail.css') }}?v={{ time() }}">
</head>
<body style="background-color: #FFFFFF; margin: 0; padding: 0; min-height: 100vh;">
    @include('layouts.navbar')

    @php
        $subtitle = '';
        if ($service->type === 'Warga') {
            $subtitle = 'Pelayanan Informasi & Administrasi Terpadu untuk Masyarakat';
        } elseif ($service->type === 'Faskes') {
            $subtitle = 'Portal Administrasi & Perizinan Terpadu untuk Fasilitas Kesehatan';
        } else {
            $subtitle = 'Portal Perizinan & Rekomendasi Terpadu untuk Tenaga Kesehatan';
        }
    @endphp

    <div class="ltd-page-wrapper">
        <!-- Header Section -->
        <header class="ltd-header">
            <div class="ltd-header-container">
                <h1 class="ltd-header-title">{{ $service->name }}</h1>
                <p class="ltd-header-subtitle">{{ $subtitle }}</p>
            </div>
        </header>

        <!-- Main Content (Single-Column) -->
        <main class="ltd-content">
            <div class="ltd-container ltd-main-col">
                <!-- Back Link (No card/box, aligned on the left) -->
                <div style="margin-bottom: 8px;">
                    <a href="{{ route('layanan-terpadu') }}" class="ltd-back-link">
                        <span class="material-icons ltd-back-icon">arrow_back</span>
                        <span class="ltd-back-text">Kembali ke Layanan Terpadu</span>
                    </a>
                </div>
                <div class="ltd-card">
                    <h2 class="ltd-card-title">Deskripsi Layanan</h2>
                    <div class="ltd-card-body">
                        @if($service->description)
                            @php
                                $parsePlainText = function($text, $textClass) {
                                    $blocks = preg_split('/\n\s*\n/', trim($text));
                                    $html = '';
                                    foreach ($blocks as $block) {
                                        $block = trim($block);
                                        if (empty($block)) continue;
                                        
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
                                            $html .= '<ul style="margin: 0 0 16px 0; padding-left: 20px; list-style-type: disc; color: #475569;">';
                                            foreach ($lines as $line) {
                                                $line = trim($line);
                                                if (empty($line)) continue;
                                                $cleanedLine = preg_replace('/^[\-\*\x{2022}]\s*|^\d+\.\s*/u', '', $line);
                                                $html .= '<li style="margin-bottom: 6px; line-height: 1.6; font-size: 16px;">' . e($cleanedLine) . '</li>';
                                            }
                                            $html .= '</ul>';
                                        } else {
                                            $html .= '<p class="' . e($textClass) . '">' . nl2br(e($block)) . '</p>';
                                        }
                                    }
                                    return $html;
                                };
                            @endphp
                            {!! $parsePlainText($service->description, 'ltd-text') !!}
                        @else
                            <p class="ltd-text ltd-text-muted">Pelayanan resmi yang diselenggarakan oleh Dinas Kesehatan Kabupaten Cianjur untuk memproses rekomendasi, izin, atau sertifikasi terkait kesehatan masyarakat.</p>
                        @endif
                    </div>
                </div>

                <!-- Requirements Card -->
                <div class="ltd-card">
                    <h2 class="ltd-card-title">Persyaratan Dokumen</h2>
                    <div class="ltd-card-body">
                        <ul class="ltd-requirements-list">
                            @if(!empty($service->requirements))
                                @foreach(explode("\n", trim($service->requirements)) as $reqLine)
                                    @php $reqLine = trim($reqLine); @endphp
                                    @if(!empty($reqLine))
                                        <li>{{ preg_replace('/^[\-\*\x{2022}]\s*/u', '', $reqLine) }}</li>
                                    @endif
                                @endforeach
                            @else
                                @if($service->type === 'Warga')
                                    <li>Kartu Tanda Penduduk (KTP) Pemohon yang masih berlaku (asli/scan)</li>
                                    <li>Kartu Keluarga (KK) terbaru (asli/scan)</li>
                                    <li>Surat Pengantar / Surat Keterangan dari RT/RW setempat</li>
                                    <li>Formulir permohonan yang telah diisi lengkap dan ditandatangani</li>
                                    <li>Dokumen rekam medis atau rekomendasi puskesmas (jika diperlukan)</li>
                                @elseif($service->type === 'Faskes')
                                    <li>Surat Permohonan Izin/Rekomendasi resmi ditujukan kepada Kepala Dinas Kesehatan</li>
                                    <li>Denah lokasi dan denah tata ruang bangunan fasilitas kesehatan lengkap</li>
                                    <li>Daftar inventaris sarana, prasarana, dan peralatan medis yang dimiliki</li>
                                    <li>Surat pernyataan kepatuhan terhadap standar pelayanan kesehatan</li>
                                    <li>Fotokopi STR/SIP aktif penanggung jawab teknis medis</li>
                                    <li>Dokumen izin lingkungan hidup (SPPL/UKL-UPL)</li>
                                @else {{-- Nakes --}}
                                    <li>Surat Tanda Registrasi (STR) yang masih berlaku dan dilegalisir</li>
                                    <li>Ijazah pendidikan terakhir bidang kesehatan (legalisir)</li>
                                    <li>Surat Keterangan Sehat dari dokter yang memiliki Surat Izin Praktik (SIP)</li>
                                    <li>Surat Keterangan rekomendasi dari organisasi profesi (IDI/PPNI/IBI, dll)</li>
                                    <li>Surat Keterangan memiliki tempat kerja/praktik (mandiri atau faskes)</li>
                                    <li>Pas foto terbaru ukuran 4x6 berwarna (latar belakang merah)</li>
                                @endif
                            @endif
                        </ul>
                    </div>
                </div>

                <!-- Alur Pengajuan Card (List style matching other pages, no circles) -->
                <div class="ltd-card">
                    <h2 class="ltd-card-title">Alur & Prosedur Pengajuan</h2>
                    <div class="ltd-card-body">
                        <div class="ltd-workflow-list">
                            @if(!empty($service->procedures))
                                @php
                                    $hasDoubleNewline = strpos($service->procedures, "\n\r\n") !== false || strpos($service->procedures, "\n\n") !== false;
                                    if ($hasDoubleNewline) {
                                        $steps = preg_split('/\n\s*\n/', trim($service->procedures));
                                    } else {
                                        $steps = explode("\n", trim($service->procedures));
                                    }
                                    $stepIndex = 1;
                                @endphp
                                @foreach($steps as $stepBlock)
                                    @php
                                        $stepBlock = trim($stepBlock);
                                        if (empty($stepBlock)) continue;
                                        
                                        if ($hasDoubleNewline) {
                                            $stepLines = explode("\n", $stepBlock);
                                            $title = trim($stepLines[0] ?? '');
                                            $desc = implode("\n", array_slice($stepLines, 1));
                                        } else {
                                            $title = $stepBlock;
                                            $desc = '';
                                        }
                                        
                                        if (empty($title)) continue;
                                        
                                        // Clean leading numbers/bullets if already written
                                        $title = preg_replace('/^\d+[\.\)\s\-]+/u', '', $title);
                                        $title = $stepIndex . '. ' . $title;
                                        $stepIndex++;
                                    @endphp
                                    <div class="ltd-workflow-item">
                                        <h3 class="ltd-workflow-title">{{ $title }}</h3>
                                        @if(!empty($desc))
                                            <p class="ltd-workflow-text">{!! nl2br(e(trim($desc))) !!}</p>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="ltd-workflow-item">
                                    <h3 class="ltd-workflow-title">1. Pengajuan Berkas</h3>
                                    <p class="ltd-workflow-text">Pemohon menyiapkan seluruh dokumen persyaratan dan mengajukan pendaftaran secara online atau datang langsung ke loket pelayanan terpadu Dinas Kesehatan.</p>
                                </div>
                                <div class="ltd-workflow-item">
                                    <h3 class="ltd-workflow-title">2. Verifikasi Administrasi</h3>
                                    <p class="ltd-workflow-text">Petugas melakukan pemeriksaan kelengkapan berkas. Pemohon akan menerima notifikasi jika berkas disetujui atau memerlukan perbaikan.</p>
                                </div>
                                @if($service->type === 'Faskes')
                                <div class="ltd-workflow-item">
                                    <h3 class="ltd-workflow-title">3. Survei & Visitasi Lapangan</h3>
                                    <p class="ltd-workflow-text">Tim teknis Dinas Kesehatan melakukan survei kelayakan fisik dan peralatan ke lokasi fasilitas kesehatan yang diajukan.</p>
                                </div>
                                @endif
                                <div class="ltd-workflow-item">
                                    <h3 class="ltd-workflow-title">{{ $service->type === 'Faskes' ? '4' : '3' }}. Penerbitan Dokumen</h3>
                                    <p class="ltd-workflow-text">Setelah dinyatakan layak dan memenuhi persyaratan, dokumen surat izin, sertifikat, atau rekomendasi resmi ditandatangani secara elektronik dan diterbitkan.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Detail & Bantuan Row (Side-by-Side) -->
                <div class="ltd-grid-two-cols">
                    <!-- Detail & Akses Layanan Card -->
                    <div class="ltd-card">
                        <h2 class="ltd-card-title">Detail & Akses Pelayanan</h2>
                        <div class="ltd-card-body ltd-info-grid">
                            <div class="ltd-info-item">
                                <span class="material-icons ltd-info-icon">schedule</span>
                                <div>
                                    <span class="ltd-info-label">Estimasi Waktu Proses</span>
                                    <span class="ltd-info-value">
                                        {{ $service->processing_time ?: ($service->type === 'Warga' ? '3 - 5 Hari Kerja' : ($service->type === 'Faskes' ? '7 - 14 Hari Kerja' : '5 - 7 Hari Kerja')) }}
                                    </span>
                                </div>
                            </div>
                            <div class="ltd-info-item">
                                <span class="material-icons ltd-info-icon">payments</span>
                                <div>
                                    <span class="ltd-info-label">Biaya / Tarif Layanan</span>
                                    <span class="ltd-info-value @if(str_contains(strtolower($service->tariff ?: 'gratis'), 'gratis')) ltd-text-free @endif">
                                        {{ $service->tariff ?: 'Gratis (Rp 0)' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bantuan Card -->
                    <div class="ltd-card">
                        <h2 class="ltd-card-title">Bantuan Pelayanan</h2>
                        <div class="ltd-card-body">
                            <p class="ltd-text" style="margin-bottom: 16px;">Mengalami kesulitan saat pengajuan? Hubungi unit helpdesk kami:</p>
                            <div class="ltd-contact-stack">
                                <div class="ltd-contact-item">
                                    <span class="material-icons">mail</span>
                                    <span>{{ $service->helpdesk_email ?: 'layanan@dinkes.cianjurkab.go.id' }}</span>
                                </div>
                                <div class="ltd-contact-item">
                                    <span class="material-icons">call</span>
                                    <span>{{ $service->helpdesk_phone ?: '(0263) 261173 (Jam Kerja)' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    @include('layouts.footer')
</body>
</html>
