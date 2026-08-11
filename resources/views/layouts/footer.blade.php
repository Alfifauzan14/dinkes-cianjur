<link rel="stylesheet" href="{{ asset('css/layouts/footer.css') }}?v={{ time() }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<footer class="dinkes-footer" role="contentinfo">
    <div class="footer-main">
        <div class="footer-container">

            {{-- Kolom 1: Brand & Logo --}}
            <div class="footer-col footer-brand">
                <div class="footer-logo-wrap">
                    <a href="{{ url('/') }}" class="footer-logo-link" title="Beranda {{ $site_settings->site_name ?? 'Dinas Kesehatan Kabupaten Cianjur' }}">
                        <img
                            src="{{ isset($site_settings) && $site_settings->site_logo ? asset('uploads/settings/' . $site_settings->site_logo) : asset('images/logo.png') }}"
                            alt="Logo Resmi {{ $site_settings->site_name ?? 'Dinas Kesehatan Kabupaten Cianjur' }}"
                            class="footer-logo-img"
                            loading="lazy"
                            decoding="async"
                        />
                    </a>
                </div>
                <p class="footer-tagline">
                    {!! nl2br(e($site_settings->site_tagline ?? 'Mewujudkan masyarakat Cianjur yang sehat, mandiri, dan berkeadilan.')) !!}
                </p>
            </div>

            {{-- Kolom 2: Kontak Hubung --}}
            <div class="footer-col">
                <h3 class="footer-col-title">Kontak Hubung</h3>
                <ul class="footer-contact-list">
                    <li class="footer-contact-item">
                        <span class="footer-contact-icon material-icons" aria-hidden="true">place</span>
                        <span>{{ $site_settings->address ?? 'Jl. Pangeran No. 105, Cianjur, Jawa Barat.' }}</span>
                    </li>
                    <li class="footer-contact-item">
                        <span class="footer-contact-icon material-icons" aria-hidden="true">phone</span>
                        <a href="tel:{{ preg_replace('/[^0-9]/', '', $site_settings->phone ?? '0263261000') }}" class="footer-contact-link">{{ $site_settings->phone ?? '(0263) 261XXX' }}</a>
                    </li>
                    <li class="footer-contact-item">
                        <span class="footer-contact-icon material-icons" aria-hidden="true">email</span>
                        <a href="mailto:{{ $site_settings->email ?? 'kontak@dinkes.cianjurkab.go.id' }}" class="footer-contact-link">{{ $site_settings->email ?? 'kontak@dinkes.cianjurkab.go.id' }}</a>
                    </li>
                </ul>

                {{-- Emergency Callout Button --}}
                <a href="tel:{{ $site_settings->emergency_call ?? '119' }}" class="footer-emergency-btn" id="footer-emergency-btn" role="button" aria-label="Ambulans Gawat Darurat">
                    <span class="footer-emergency-icon material-icons" aria-hidden="true">warning</span>
                    <span>{{ $site_settings->emergency_title ?? 'Ambulans Gawat Darurat: PSC 119 Cianjur' }}</span>
                </a>
            </div>

            {{-- Kolom 3: Navigasi Cepat --}}
            <div class="footer-col">
                <h3 class="footer-col-title">Navigasi Cepat</h3>
                <ul class="footer-nav-list">
                    <li><a href="{{ route('satudata.regulasi') }}" class="footer-nav-link" id="footer-nav-1">Regulasi &amp; Kebijakan</a></li>
                    <li><a href="{{ route('ppid') }}" class="footer-nav-link" id="footer-nav-2">Informasi PPID</a></li>
                    <li><a href="{{ route('faskes') }}" class="footer-nav-link" id="footer-nav-3">Peta Sebaran Faskes</a></li>
                    <li><a href="{{ route('ikm') }}" class="footer-nav-link" id="footer-nav-4">Indeks Kepuasan (IKM)</a></li>
                </ul>
            </div>

            {{-- Kolom 4: Media Sosial --}}
            <div class="footer-col">
                <h3 class="footer-col-title">Media Sosial</h3>
                <p class="footer-social-desc">Ikuti Informasi Kesehatan Terkini:</p>
                <div class="footer-social-icons">
                    @if(!empty($site_settings->social_facebook))
                    <a href="{{ $site_settings->social_facebook }}" target="_blank" rel="noopener noreferrer" class="footer-social-btn" id="footer-social-fb" aria-label="Facebook Dinkes Cianjur" title="Facebook">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    @endif
                    @if(!empty($site_settings->social_instagram))
                    <a href="{{ $site_settings->social_instagram }}" target="_blank" rel="noopener noreferrer" class="footer-social-btn" id="footer-social-ig" aria-label="Instagram Dinkes Cianjur" title="Instagram">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    @endif
                    @if(!empty($site_settings->social_twitter))
                    <a href="{{ $site_settings->social_twitter }}" target="_blank" rel="noopener noreferrer" class="footer-social-btn" id="footer-social-x" aria-label="X (Twitter) Dinkes Cianjur" title="X (Twitter)">
                        <i class="fa-brands fa-x-twitter"></i>
                    </a>
                    @endif
                    @if(!empty($site_settings->social_youtube))
                    <a href="{{ $site_settings->social_youtube }}" target="_blank" rel="noopener noreferrer" class="footer-social-btn" id="footer-social-yt" aria-label="YouTube Dinkes Cianjur" title="YouTube">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                    @endif
                    @if(!empty($site_settings->social_tiktok))
                    <a href="{{ $site_settings->social_tiktok }}" target="_blank" rel="noopener noreferrer" class="footer-social-btn" id="footer-social-tt" aria-label="TikTok Dinkes Cianjur" title="TikTok">
                        <i class="fa-brands fa-tiktok"></i>
                    </a>
                    @endif
                </div>
            </div>

        </div>
    </div>

    {{-- Copyright Bar --}}
    <div class="footer-copyright">
        <p>&copy; {{ date('Y') }} {{ $site_settings->site_name ?? 'Dinas Kesehatan Kabupaten Cianjur' }}. Hak Cipta Dilindungi Undang-Undang.</p>
    </div>
</footer>
