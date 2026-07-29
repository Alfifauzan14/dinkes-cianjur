{{-- ============================================================
     Footer Layout Component - Dinas Kesehatan Kabupaten Cianjur
     Lokasi  : resources/views/layouts/footer.blade.php
     Warna   : Dark Theme (#212121) dengan aksen Hijau & Merah Gawat Darurat
     Font    : Plus Jakarta Sans
     ============================================================ --}}

<footer class="dinkes-footer" role="contentinfo">
    <div class="footer-main">
        <div class="footer-container">

            {{-- Kolom 1: Brand & Logo --}}
            <div class="footer-col footer-brand">
                <div class="footer-logo-wrap">
                    <a href="{{ url('/') }}" class="footer-logo-link" title="Beranda Dinas Kesehatan Kabupaten Cianjur">
                        <img
                            src="{{ asset('images/logo.png') }}"
                            alt="Logo Resmi Dinas Kesehatan Kabupaten Cianjur"
                            class="footer-logo-img"
                            loading="lazy"
                            decoding="async"
                        />
                    </a>
                </div>
                <p class="footer-tagline">
                    Mewujudkan masyarakat<br>Cianjur yang sehat, mandiri,<br>dan berkeadilan.
                </p>
            </div>

            {{-- Kolom 2: Kontak Hubung --}}
            <div class="footer-col">
                <h3 class="footer-col-title">Kontak Hubung</h3>
                <ul class="footer-contact-list">
                    <li class="footer-contact-item">
                        <span class="footer-contact-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                        </span>
                        <span>Jl. Pangeran No. 105, Cianjur, Jawa Barat.</span>
                    </li>
                    <li class="footer-contact-item">
                        <span class="footer-contact-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                        </span>
                        <a href="tel:0263261000" class="footer-contact-link">(0263) 261XXX</a>
                    </li>
                    <li class="footer-contact-item">
                        <span class="footer-contact-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                        </span>
                        <a href="mailto:kontak@dinkes.cianjurkab.go.id" class="footer-contact-link">kontak@dinkes.cianjurkab.go.id</a>
                    </li>
                </ul>

                {{-- Emergency Callout Button --}}
                <a href="tel:119" class="footer-emergency-btn" id="footer-emergency-btn" role="button" aria-label="Ambulans Gawat Darurat PSC 119 Cianjur">
                    <span class="footer-emergency-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                            <line x1="12" y1="9" x2="12" y2="13"></line>
                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                        </svg>
                    </span>
                    <span>Ambulans Gawat Darurat: PSC 119 Cianjur</span>
                </a>
            </div>

            {{-- Kolom 3: Navigasi Cepat --}}
            <div class="footer-col">
                <h3 class="footer-col-title">Navigasi Cepat</h3>
                <ul class="footer-nav-list">
                    <li><a href="#" class="footer-nav-link" id="footer-nav-regulasi">Regulasi &amp; Kebijakan</a></li>
                    <li><a href="#" class="footer-nav-link" id="footer-nav-ppid">Informasi PPID</a></li>
                    <li><a href="#" class="footer-nav-link" id="footer-nav-karir">Karir &amp; Rekrutmen Nakes</a></li>
                    <li><a href="#" class="footer-nav-link" id="footer-nav-peta">Peta Situs</a></li>
                </ul>
            </div>

            {{-- Kolom 4: Media Sosial --}}
            <div class="footer-col">
                <h3 class="footer-col-title">Media Sosial</h3>
                <p class="footer-social-desc">Ikuti Informasi Kesehatan Terkini:</p>
                <div class="footer-social-icons">
                    {{-- Facebook --}}
                    <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" class="footer-social-btn" id="footer-social-fb" aria-label="Facebook Dinkes Cianjur" title="Facebook">
                        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                        </svg>
                    </a>
                    {{-- Instagram --}}
                    <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="footer-social-btn" id="footer-social-ig" aria-label="Instagram Dinkes Cianjur" title="Instagram">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                        </svg>
                    </a>
                    {{-- X / Twitter --}}
                    <a href="https://x.com" target="_blank" rel="noopener noreferrer" class="footer-social-btn" id="footer-social-x" aria-label="X (Twitter) Dinkes Cianjur" title="X (Twitter)">
                        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.73-8.835L1.254 2.25H8.08l4.253 5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </a>
                    {{-- YouTube --}}
                    <a href="https://youtube.com" target="_blank" rel="noopener noreferrer" class="footer-social-btn" id="footer-social-yt" aria-label="YouTube Dinkes Cianjur" title="YouTube">
                        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </a>
                    {{-- TikTok --}}
                    <a href="https://tiktok.com" target="_blank" rel="noopener noreferrer" class="footer-social-btn" id="footer-social-tt" aria-label="TikTok Dinkes Cianjur" title="TikTok">
                        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 0 0-.79-.05 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.33-6.34V8.79a8.18 8.18 0 0 0 4.78 1.54V6.89a4.85 4.85 0 0 1-1.01-.2z"/>
                        </svg>
                    </a>
                </div>
            </div>

        </div>
    </div>

    {{-- Copyright Bar --}}
    <div class="footer-copyright">
        <p>&copy; {{ date('Y') }} Dinas Kesehatan Kabupaten Cianjur. Hak Cipta Dilindungi Undang-Undang.</p>
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
    max-width: 1240px;
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
    width: 18px;
    height: 18px;
    color: var(--footer-accent-green);
    flex-shrink: 0;
    margin-top: 1px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.footer-contact-icon svg {
    width: 100%;
    height: 100%;
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
    width: 16px;
    height: 16px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.footer-emergency-icon svg {
    width: 100%;
    height: 100%;
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

.footer-social-btn svg {
    width: 15px;
    height: 15px;
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
