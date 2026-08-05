@php
    $siteSettings = \App\Models\Setting::all()->pluck('value', 'key')->toArray();
@endphp
<link rel="stylesheet" href="{{ asset('css/layouts/footer.css') }}?v={{ time() }}">

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
                    {!! nl2br(e($siteSettings['footer_tagline'] ?? 'Mewujudkan masyarakat Cianjur yang sehat, mandiri, dan berkeadilan.')) !!}
                </p>
            </div>

            {{-- Kolom 2: Kontak Hubung --}}
            <div class="footer-col">
                <h3 class="footer-col-title">Kontak Hubung</h3>
                <ul class="footer-contact-list">
                    <li class="footer-contact-item">
                        <span class="footer-contact-icon material-icons" aria-hidden="true">place</span>
                        <span>{{ $siteSettings['footer_address'] ?? 'Jl. Pangeran No. 105, Cianjur, Jawa Barat.' }}</span>
                    </li>
                    <li class="footer-contact-item">
                        <span class="footer-contact-icon material-icons" aria-hidden="true">phone</span>
                        <a href="tel:{{ preg_replace('/[^0-9]/', '', $siteSettings['footer_phone'] ?? '0263261000') }}" class="footer-contact-link">{{ $siteSettings['footer_phone'] ?? '(0263) 261XXX' }}</a>
                    </li>
                    <li class="footer-contact-item">
                        <span class="footer-contact-icon material-icons" aria-hidden="true">email</span>
                        <a href="mailto:{{ $siteSettings['footer_email'] ?? 'kontak@dinkes.cianjurkab.go.id' }}" class="footer-contact-link">{{ $siteSettings['footer_email'] ?? 'kontak@dinkes.cianjurkab.go.id' }}</a>
                    </li>
                </ul>

                {{-- Emergency Callout Button --}}
                <a href="tel:{{ $siteSettings['footer_emergency_phone'] ?? '119' }}" class="footer-emergency-btn" id="footer-emergency-btn" role="button" aria-label="Ambulans Gawat Darurat">
                    <span class="footer-emergency-icon material-icons" aria-hidden="true">warning</span>
                    <span>{{ $siteSettings['footer_emergency_text'] ?? 'Ambulans Gawat Darurat: PSC 119 Cianjur' }}</span>
                </a>
            </div>

            {{-- Kolom 3: Navigasi Cepat --}}
            <div class="footer-col">
                <h3 class="footer-col-title">Navigasi Cepat</h3>
                <ul class="footer-nav-list">
                    @for($i = 1; $i <= 4; $i++)
                        @php
                            $defaults = ['Regulasi & Kebijakan', 'Informasi PPID', 'Karir & Rekrutmen Nakes', 'Peta Situs'];
                            $label = $siteSettings['footer_nav_'.$i.'_label'] ?? $defaults[$i-1];
                            $url   = $siteSettings['footer_nav_'.$i.'_url'] ?? '#';
                        @endphp
                        @if($label)
                        <li>
                            <a href="{{ $url }}" class="footer-nav-link" id="footer-nav-{{ $i }}">{{ $label }}</a>
                        </li>
                        @endif
                    @endfor
                </ul>
            </div>

            {{-- Kolom 4: Media Sosial --}}
            <div class="footer-col">
                <h3 class="footer-col-title">Media Sosial</h3>
                <p class="footer-social-desc">Ikuti Informasi Kesehatan Terkini:</p>
                <div class="footer-social-icons">
                    @if(!empty($siteSettings['social_facebook']))
                    <a href="{{ $siteSettings['social_facebook'] }}" target="_blank" rel="noopener noreferrer" class="footer-social-btn" id="footer-social-fb" aria-label="Facebook Dinkes Cianjur" title="Facebook">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    @endif
                    @if(!empty($siteSettings['social_instagram']))
                    <a href="{{ $siteSettings['social_instagram'] }}" target="_blank" rel="noopener noreferrer" class="footer-social-btn" id="footer-social-ig" aria-label="Instagram Dinkes Cianjur" title="Instagram">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    @endif
                    @if(!empty($siteSettings['social_twitter']))
                    <a href="{{ $siteSettings['social_twitter'] }}" target="_blank" rel="noopener noreferrer" class="footer-social-btn" id="footer-social-x" aria-label="X (Twitter) Dinkes Cianjur" title="X (Twitter)">
                        <i class="fa-brands fa-x-twitter"></i>
                    </a>
                    @endif
                    @if(!empty($siteSettings['social_youtube']))
                    <a href="{{ $siteSettings['social_youtube'] }}" target="_blank" rel="noopener noreferrer" class="footer-social-btn" id="footer-social-yt" aria-label="YouTube Dinkes Cianjur" title="YouTube">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                    @endif
                    @if(!empty($siteSettings['social_tiktok']))
                    <a href="{{ $siteSettings['social_tiktok'] }}" target="_blank" rel="noopener noreferrer" class="footer-social-btn" id="footer-social-tt" aria-label="TikTok Dinkes Cianjur" title="TikTok">
                        <i class="fa-brands fa-tiktok"></i>
                    </a>
                    @endif
                </div>
            </div>

        </div>
    </div>

    {{-- Copyright Bar --}}
    <div class="footer-copyright">
        <p>&copy; {{ date('Y') }} {{ $siteSettings['footer_copyright'] ?? 'Dinas Kesehatan Kabupaten Cianjur. Hak Cipta Dilindungi Undang-Undang.' }}</p>
    </div>
</footer>

{{-- ============================================================
     Footer Professional Styles
     ============================================================ --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap');

:root {
    --footer-bg: #212121;
    --footer-copyright-bg: #1a1a1a;
    --footer-border: #2d2d2d;
    --footer-title-color: #ffffff;
    --footer-text-muted: #888888;
    --footer-text-hover: #ffffff;
    --footer-accent-green: #00c853;
    --footer-emergency-bg: #3b2223;
    --footer-emergency-border: #5a2c2d;
    --footer-emergency-text: #ff5252;
    --footer-emergency-hover-bg: #4a282a;
    --footer-social-btn-bg: #333333;
    --footer-social-btn-text: #cccccc;
}

.dinkes-footer {
    font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background-color: var(--footer-bg);
    color: var(--footer-text-muted);
    width: 100%;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

/* ---- Main Footer Container ---- */
.footer-main {
    padding: 60px 0 48px;
    border-bottom: 1px solid var(--footer-border);
}

.footer-container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 40px;
    display: grid;
    grid-template-columns: 1.3fr 1.3fr 1fr 1.1fr;
    gap: 36px;
}

/* ---- Brand Column ---- */
.footer-brand {
    display: flex;
    flex-direction: column;
}

.footer-logo-wrap {
    margin-bottom: 0;
}

.footer-logo-link {
    display: inline-block;
    text-decoration: none;
}

.footer-logo-img {
    height: 130px;
    width: auto;
    max-width: 100%;
    object-fit: contain;
    display: block;
    margin-top: -38px;
    transition: opacity 0.2s ease;
}

.footer-logo-link:hover .footer-logo-img {
    opacity: 0.9;
}

.footer-tagline {
    font-size: 13.5px;
    color: var(--footer-text-muted);
    line-height: 1.6;
    margin-top: -24px;
}

/* ---- Column Titles ---- */
.footer-col-title {
    font-size: 17px;
    font-weight: 700;
    color: var(--footer-title-color);
    margin-bottom: 22px;
    letter-spacing: 0.1px;
}

/* ---- Contact List ---- */
.footer-contact-list {
    list-style: none;
    padding: 0;
    margin: 0 0 20px 0;
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.footer-contact-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    font-size: 13.5px;
    color: var(--footer-text-muted);
    line-height: 1.5;
}

.footer-contact-link {
    color: var(--footer-text-muted);
    text-decoration: none;
    transition: color 0.2s ease;
}

.footer-contact-link:hover {
    color: var(--footer-text-hover);
    text-decoration: underline;
}

.footer-contact-icon {
    font-size: 18px !important;
    color: var(--footer-accent-green);
    flex-shrink: 0;
    margin-top: 1px;
    display: inline-block;
}

/* ---- Emergency Button ---- */
.footer-emergency-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background-color: var(--footer-emergency-bg);
    border: 1px solid var(--footer-emergency-border);
    color: var(--footer-emergency-text);
    font-size: 13px;
    font-weight: 600;
    padding: 12px 16px;
    border-radius: 4px;
    text-decoration: none;
    line-height: 1.4;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}

.footer-emergency-btn:hover,
.footer-emergency-btn:focus-visible {
    background-color: var(--footer-emergency-hover-bg);
    border-color: #733436;
    color: #ff6b6b;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(255, 82, 82, 0.15);
}

.footer-emergency-icon {
    font-size: 16px !important;
    flex-shrink: 0;
    display: inline-block;
}

/* ---- Quick Nav ---- */
.footer-nav-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.footer-nav-link {
    text-decoration: none;
    font-size: 13.5px;
    color: var(--footer-text-muted);
    transition: color 0.2s ease, transform 0.2s ease;
    display: inline-block;
}

.footer-nav-link:hover,
.footer-nav-link:focus-visible {
    color: var(--footer-text-hover);
    transform: translateX(2px);
}

/* ---- Social Media ---- */
.footer-social-desc {
    font-size: 13.5px;
    color: var(--footer-text-muted);
    margin-bottom: 18px;
}

.footer-social-icons {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: nowrap;
}

.footer-social-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background-color: var(--footer-social-btn-bg);
    color: var(--footer-social-btn-text);
    text-decoration: none;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    flex-shrink: 0;
}

.footer-social-btn i {
    font-size: 15px;
}

.footer-social-btn:hover,
.footer-social-btn:focus-visible {
    background-color: #444444;
    color: #ffffff;
    transform: translateY(-3px);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
}

/* ---- Copyright Bar ---- */
.footer-copyright {
    padding: 22px 40px;
    text-align: center;
    background-color: var(--footer-bg);
}

.footer-copyright p {
    font-size: 12.5px;
    color: #777777;
    margin: 0;
}

/* ---- Responsive Breakpoints ---- */
@media (max-width: 1024px) {
    .footer-container {
        grid-template-columns: 1fr 1fr;
        gap: 36px;
    }
    .footer-social-icons {
        flex-wrap: wrap;
    }
}

@media (max-width: 640px) {
    .footer-container {
        grid-template-columns: 1fr;
        gap: 32px;
        padding: 0 20px;
    }

    .footer-main {
        padding: 40px 0 30px;
    }

    .footer-copyright {
        padding: 16px 20px;
    }

    .footer-logo-img {
        margin-top: 0;
    }

    .footer-tagline {
        margin-top: 0;
    }
}
</style>
