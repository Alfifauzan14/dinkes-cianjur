<style>
    .satudata-subnav-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        margin-top: 24px;
        flex-wrap: wrap;
    }

    .satudata-subnav-item {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 9999px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease-in-out;
        border: 1px solid rgba(255, 255, 255, 0.25);
        color: rgba(255, 255, 255, 0.85);
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(4px);
    }

    .satudata-subnav-item:hover {
        background: rgba(255, 255, 255, 0.2);
        color: #FFFFFF;
        border-color: rgba(255, 255, 255, 0.4);
        transform: translateY(-1px);
    }

    .satudata-subnav-item.active {
        background: #FFFFFF;
        color: #004F3B;
        border-color: #FFFFFF;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .satudata-subnav-item .material-icons {
        font-size: 18px;
    }
</style>

<nav class="satudata-subnav-wrapper" aria-label="Sub-navigasi Satu Data Kesehatan">
    <a href="{{ route('satudata.statistik') }}" class="satudata-subnav-item {{ ($activeTab ?? '') === 'statistik' ? 'active' : '' }}">
        <span class="material-icons">bar_chart</span>
        <span>Statistik Indikator</span>
    </a>
    <a href="{{ route('satudata.laporan') }}" class="satudata-subnav-item {{ ($activeTab ?? '') === 'laporan' ? 'active' : '' }}">
        <span class="material-icons">description</span>
        <span>Dokumen Laporan</span>
    </a>
    <a href="{{ route('satudata.regulasi') }}" class="satudata-subnav-item {{ ($activeTab ?? '') === 'regulasi' ? 'active' : '' }}">
        <span class="material-icons">gavel</span>
        <span>Produk Regulasi</span>
    </a>
</nav>
