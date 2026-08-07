<!-- Lightbox Modal -->
<div id="imageLightbox" class="lightbox-overlay" style="display: none;">
    <div class="lightbox-container">
        <!-- Top Bar -->
        <div class="lightbox-topbar">
            <button class="lightbox-back" onclick="closeLightbox()" aria-label="Kembali">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 12H5"/>
                    <path d="M12 5l-7 7 7 7"/>
                </svg>
                <span>Kembali</span>
            </button>
            <div class="lightbox-counter" id="lightboxCounter"></div>
            <a id="lightboxDownload" href="#" download class="lightbox-download" aria-label="Unduh gambar">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                    <polyline points="7 10 12 15 17 10"/>
                    <line x1="12" y1="15" x2="12" y2="3"/>
                </svg>
                <span>Unduh</span>
            </a>
        </div>

        <!-- Nav Prev -->
        <button class="lightbox-nav lightbox-prev" onclick="navigateLightbox(-1)" aria-label="Sebelumnya">&#8249;</button>

        <!-- Image -->
        <div class="lightbox-content">
            <img id="lightboxImage" src="" alt="" class="lightbox-image">
        </div>

        <!-- Nav Next -->
        <button class="lightbox-nav lightbox-next" onclick="navigateLightbox(1)" aria-label="Berikutnya">&#8250;</button>

        <!-- Caption -->
        <div class="lightbox-caption" id="lightboxCaption"></div>
    </div>
</div>

<style>
.lightbox-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.93);
    z-index: 9999;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}
.lightbox-overlay.active {
    opacity: 1;
}
.lightbox-container {
    position: relative;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

/* Top bar */
.lightbox-topbar {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 20px;
    background: linear-gradient(to bottom, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0) 100%);
    z-index: 10002;
}
.lightbox-back {
    display: flex;
    align-items: center;
    gap: 8px;
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.15);
    color: #fff;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    padding: 8px 16px;
    border-radius: 3px;
    transition: background 0.2s, border-color 0.2s;
    backdrop-filter: blur(4px);
    letter-spacing: 0.01em;
}
.lightbox-back:hover {
    background: rgba(255,255,255,0.2);
    border-color: rgba(255,255,255,0.3);
}
.lightbox-download {
    display: flex;
    align-items: center;
    gap: 8px;
    background: rgba(0, 153, 102, 0.85);
    border: 1px solid rgba(0, 153, 102, 1);
    color: #fff;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    padding: 8px 16px;
    border-radius: 3px;
    text-decoration: none;
    transition: background 0.2s, border-color 0.2s;
    backdrop-filter: blur(4px);
    letter-spacing: 0.01em;
}
.lightbox-download:hover {
    background: rgba(0, 153, 102, 1);
    border-color: rgba(0, 180, 120, 1);
    color: #fff;
}

/* Content */
.lightbox-content {
    display: flex;
    align-items: center;
    justify-content: center;
    max-width: 95vw;
    max-height: 95vh;
}
.lightbox-image {
    max-width: 95vw;
    max-height: 95vh;
    object-fit: contain;
    border-radius: 3px;
    box-shadow: 0 8px 40px rgba(0,0,0,0.5);
    transition: opacity 0.2s ease;
}

/* Nav buttons */
.lightbox-nav {
    position: fixed;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.12);
    color: #fff;
    font-size: 48px;
    cursor: pointer;
    z-index: 10001;
    width: 52px;
    height: 52px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 3px;
    transition: background 0.2s;
    user-select: none;
    backdrop-filter: blur(4px);
}
.lightbox-nav:hover {
    background: rgba(255,255,255,0.2);
}
.lightbox-prev { left: 16px; }
.lightbox-next { right: 16px; }

/* Caption */
.lightbox-caption {
    position: fixed;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    color: #fff;
    font-size: 14px;
    font-weight: 500;
    text-align: center;
    background: rgba(0,0,0,0.55);
    padding: 7px 20px;
    border-radius: 3px;
    max-width: 80vw;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    backdrop-filter: blur(4px);
}

/* Counter */
.lightbox-counter {
    color: rgba(255,255,255,0.75);
    font-size: 13px;
    font-weight: 500;
    letter-spacing: 0.05em;
}

@media (max-width: 640px) {
    .lightbox-nav { width: 40px; height: 40px; font-size: 32px; }
    .lightbox-prev { left: 6px; }
    .lightbox-next { right: 6px; }
    .lightbox-back span, .lightbox-download span { display: none; }
    .lightbox-back, .lightbox-download { padding: 8px 10px; }
    .lightbox-topbar { padding: 0 10px; }
}
</style>

<script>
(function() {
    let images = [];
    let currentIndex = 0;

    function getFilename(src) {
        return src.split('/').pop().split('?')[0] || 'gambar';
    }

    window.initLightbox = function(selector) {
        const els = document.querySelectorAll(selector);
        images = [];
        els.forEach((el, i) => {
            const src = el.getAttribute('data-lightbox-src') || el.src;
            const alt = el.getAttribute('data-lightbox-alt') || el.alt || '';
            images.push({ src, alt });
            el.style.cursor = 'pointer';
            el.addEventListener('click', () => openLightbox(i));
        });
    };

    window.openLightbox = function(index) {
        currentIndex = index;
        const overlay = document.getElementById('imageLightbox');
        const img = document.getElementById('lightboxImage');
        const caption = document.getElementById('lightboxCaption');
        const counter = document.getElementById('lightboxCounter');
        const dlBtn = document.getElementById('lightboxDownload');

        img.src = images[index].src;
        img.alt = images[index].alt;
        caption.textContent = images[index].alt;
        counter.textContent = (index + 1) + ' / ' + images.length;
        dlBtn.href = images[index].src;
        dlBtn.download = getFilename(images[index].src);

        overlay.style.display = 'flex';
        requestAnimationFrame(() => overlay.classList.add('active'));
        document.body.style.overflow = 'hidden';
    };

    window.closeLightbox = function() {
        const overlay = document.getElementById('imageLightbox');
        overlay.classList.remove('active');
        setTimeout(() => {
            overlay.style.display = 'none';
            document.body.style.overflow = '';
        }, 300);
    };

    window.navigateLightbox = function(dir) {
        currentIndex = (currentIndex + dir + images.length) % images.length;
        const img = document.getElementById('lightboxImage');
        const caption = document.getElementById('lightboxCaption');
        const counter = document.getElementById('lightboxCounter');
        const dlBtn = document.getElementById('lightboxDownload');

        img.style.opacity = '0';
        setTimeout(() => {
            img.src = images[currentIndex].src;
            img.alt = images[currentIndex].alt;
            caption.textContent = images[currentIndex].alt;
            counter.textContent = (currentIndex + 1) + ' / ' + images.length;
            dlBtn.href = images[currentIndex].src;
            dlBtn.download = getFilename(images[currentIndex].src);
            img.style.opacity = '1';
        }, 150);
    };

    document.addEventListener('keydown', function(e) {
        const overlay = document.getElementById('imageLightbox');
        if (!overlay || overlay.style.display === 'none') return;
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowLeft') navigateLightbox(-1);
        if (e.key === 'ArrowRight') navigateLightbox(1);
    });

    document.addEventListener('click', function(e) {
        const overlay = document.getElementById('imageLightbox');
        if (overlay && e.target === overlay) closeLightbox();
    });
})();
</script>
