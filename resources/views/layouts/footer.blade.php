<link rel="stylesheet" href="{{ asset('css/layouts/footer.css') }}?v={{ time() }}">

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
