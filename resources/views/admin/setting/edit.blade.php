@extends('admin.layouts.admin')

@section('title', 'Pengaturan Situs')
@section('header_title', 'Pengaturan Situs')

@section('styles')
<style>
/* ---- Setting Page ---- */
.setting-page { display: flex; flex-direction: column; gap: 28px; }

.setting-section {
    background: #fff;
    border: 1px solid #e8edf3;
    border-radius: 12px;
    overflow: hidden;
}

.setting-section-header {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 18px 24px;
    border-bottom: 1px solid #e8edf3;
    background: #f8fafc;
}

.section-icon {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #e8f5e9;
}

.section-icon .material-icons { font-size: 18px; color: #009966; }

.setting-section-header h3 {
    font-size: 15px;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
}

.setting-section-header p {
    font-size: 12px;
    color: #94a3b8;
    margin: 2px 0 0;
}

.setting-section-body { padding: 24px; }

.form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
.form-grid.single { grid-template-columns: 1fr; }
.form-grid.triple { grid-template-columns: 1fr 1fr 1fr; }

.form-group { display: flex; flex-direction: column; gap: 6px; }
.form-group.full { grid-column: 1 / -1; }

.form-group label {
    font-size: 13px;
    font-weight: 600;
    color: #475569;
    display: flex;
    align-items: center;
    gap: 6px;
}

.form-group label .label-badge {
    font-size: 10px;
    font-weight: 600;
    background: #D1FAE5;
    color: #065F46;
    padding: 2px 6px;
    border-radius: 4px;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 10px 14px;
    border: 1.5px solid #e2e8f0;
    border-radius: 8px;
    font-size: 13.5px;
    color: #1e293b;
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: #fff;
    transition: border-color 0.2s, box-shadow 0.2s;
    box-sizing: border-box;
}

.form-group input:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #009966;
    box-shadow: 0 0 0 3px rgba(0, 153, 102, 0.12);
}

.form-group textarea { resize: vertical; min-height: 80px; }

.nav-link-pair {
    display: grid;
    grid-template-columns: 1fr 1.5fr;
    gap: 12px;
    align-items: end;
}

.nav-link-row {
    background: #f8fafc;
    border: 1px solid #e8edf3;
    border-radius: 10px;
    padding: 16px;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.nav-link-row .row-title {
    font-size: 12px;
    font-weight: 700;
    color: #009966;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.social-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    gap: 16px;
}

.social-item {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.social-item label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    font-weight: 600;
    color: #475569;
}

.social-icon {
    width: 28px;
    height: 28px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    font-weight: 700;
    color: #fff;
}

.social-icon.fb { background: #1877f2; }
.social-icon.ig { background: linear-gradient(135deg, #f58529, #dd2a7b, #8134af); }
.social-icon.tw { background: #000; }
.social-icon.yt { background: #ff0000; }
.social-icon.tt { background: #010101; }

/* Alert success */
.alert-success {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 20px;
    background: #d1fae5;
    border: 1px solid #a7f3d0;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
    color: #065f46;
    margin-bottom: 4px;
}

.alert-success .material-icons { font-size: 20px; color: #059669; }

/* Form Actions */
.form-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 12px;
    padding: 20px 24px;
    border-top: 1px solid #e8edf3;
    background: #f8fafc;
}

.btn-save {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 11px 28px;
    background: linear-gradient(135deg, #009966, #00c853);
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 700;
    font-family: 'Plus Jakarta Sans', sans-serif;
    cursor: pointer;
    transition: all 0.2s ease;
    box-shadow: 0 2px 8px rgba(0, 153, 102, 0.3);
}

.btn-save:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 14px rgba(0, 153, 102, 0.4);
}

.btn-save .material-icons { font-size: 18px; }

/* Divider */
.section-divider {
    border: none;
    border-top: 1px dashed #e2e8f0;
    margin: 20px 0;
}
</style>
@endsection

@section('content')
<div class="setting-page">

    <form action="{{ route('admin.setting.update') }}" method="POST" id="settings-form">
        @csrf
        @method('PUT')

        {{-- ==================== SECTION 1: HEADER ==================== --}}
        <div class="setting-section">
            <div class="setting-section-header">
                <div class="section-icon"><span class="material-icons">web_asset</span></div>
                <div>
                    <h3>Pengaturan Header</h3>
                    <p>Teks yang tampil di bagian atas semua halaman publik</p>
                </div>
            </div>
            <div class="setting-section-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="header_site_name">
                            Nama Instansi / Situs
                            <span class="label-badge">Wajib</span>
                        </label>
                        <input type="text" id="header_site_name" name="header_site_name"
                            value="{{ $settings['header_site_name'] ?? 'Dinas Kesehatan Kabupaten Cianjur' }}"
                            placeholder="Contoh: Dinas Kesehatan Kabupaten Cianjur" required>
                    </div>
                    <div class="form-group">
                        <label for="header_tagline">Tagline / Sub-judul Header</label>
                        <input type="text" id="header_tagline" name="header_tagline"
                            value="{{ $settings['header_tagline'] ?? 'Mewujudkan Masyarakat Cianjur yang Sehat' }}"
                            placeholder="Contoh: Mewujudkan Masyarakat Cianjur yang Sehat">
                    </div>
                </div>
            </div>
        </div>

        {{-- ==================== SECTION 2: FOOTER KONTAK ==================== --}}
        <div class="setting-section">
            <div class="setting-section-header">
                <div class="section-icon"><span class="material-icons">contact_mail</span></div>
                <div>
                    <h3>Footer — Kontak & Info</h3>
                    <p>Informasi kontak dan tagline yang tampil di footer</p>
                </div>
            </div>
            <div class="setting-section-body">
                <div class="form-grid">
                    <div class="form-group full">
                        <label for="footer_tagline">Tagline Footer</label>
                        <textarea id="footer_tagline" name="footer_tagline" rows="2"
                            placeholder="Contoh: Mewujudkan masyarakat Cianjur yang sehat, mandiri, dan berkeadilan.">{{ $settings['footer_tagline'] ?? 'Mewujudkan masyarakat Cianjur yang sehat, mandiri, dan berkeadilan.' }}</textarea>
                    </div>
                    <div class="form-group full">
                        <label for="footer_address">Alamat Kantor</label>
                        <input type="text" id="footer_address" name="footer_address"
                            value="{{ $settings['footer_address'] ?? 'Jl. Pangeran No. 105, Cianjur, Jawa Barat.' }}"
                            placeholder="Alamat lengkap kantor">
                    </div>
                    <div class="form-group">
                        <label for="footer_phone">Nomor Telepon</label>
                        <input type="text" id="footer_phone" name="footer_phone"
                            value="{{ $settings['footer_phone'] ?? '(0263) 261XXX' }}"
                            placeholder="(0263) 261000">
                    </div>
                    <div class="form-group">
                        <label for="footer_email">Alamat Email</label>
                        <input type="email" id="footer_email" name="footer_email"
                            value="{{ $settings['footer_email'] ?? 'kontak@dinkes.cianjurkab.go.id' }}"
                            placeholder="kontak@dinkes.cianjurkab.go.id">
                    </div>
                </div>

                <hr class="section-divider">

                <div class="form-grid">
                    <div class="form-group">
                        <label for="footer_emergency_text">Teks Tombol Darurat</label>
                        <input type="text" id="footer_emergency_text" name="footer_emergency_text"
                            value="{{ $settings['footer_emergency_text'] ?? 'Ambulans Gawat Darurat: PSC 119 Cianjur' }}"
                            placeholder="Ambulans Gawat Darurat: PSC 119 Cianjur">
                    </div>
                    <div class="form-group">
                        <label for="footer_emergency_phone">Nomor Darurat (untuk link tel:)</label>
                        <input type="text" id="footer_emergency_phone" name="footer_emergency_phone"
                            value="{{ $settings['footer_emergency_phone'] ?? '119' }}"
                            placeholder="119">
                    </div>
                    <div class="form-group full">
                        <label for="footer_copyright">Teks Copyright</label>
                        <input type="text" id="footer_copyright" name="footer_copyright"
                            value="{{ $settings['footer_copyright'] ?? 'Dinas Kesehatan Kabupaten Cianjur. Hak Cipta Dilindungi Undang-Undang.' }}"
                            placeholder="Dinas Kesehatan Kabupaten Cianjur. Hak Cipta Dilindungi.">
                    </div>
                </div>
            </div>
        </div>

        {{-- ==================== SECTION 3: NAVIGASI CEPAT FOOTER ==================== --}}
        <div class="setting-section">
            <div class="setting-section-header">
                <div class="section-icon"><span class="material-icons">link</span></div>
                <div>
                    <h3>Footer — Navigasi Cepat</h3>
                    <p>Tautan yang tampil di kolom "Navigasi Cepat" footer (maks. 4 tautan)</p>
                </div>
            </div>
            <div class="setting-section-body" style="display: flex; flex-direction: column; gap: 12px;">
                @foreach([1,2,3,4] as $i)
                <div class="nav-link-row">
                    <span class="row-title">Tautan {{ $i }}</span>
                    <div class="nav-link-pair">
                        <div class="form-group">
                            <label for="footer_nav_{{ $i }}_label">Label Tautan</label>
                            <input type="text" id="footer_nav_{{ $i }}_label" name="footer_nav_{{ $i }}_label"
                                value="{{ $settings['footer_nav_'.$i.'_label'] ?? ['Regulasi & Kebijakan','Informasi PPID','Karir & Rekrutmen Nakes','Peta Situs'][$i-1] }}"
                                placeholder="Nama tautan yang tampil">
                        </div>
                        <div class="form-group">
                            <label for="footer_nav_{{ $i }}_url">URL Tujuan</label>
                            <input type="text" id="footer_nav_{{ $i }}_url" name="footer_nav_{{ $i }}_url"
                                value="{{ $settings['footer_nav_'.$i.'_url'] ?? '#' }}"
                                placeholder="https://... atau /path/halaman">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- ==================== SECTION 4: MEDIA SOSIAL ==================== --}}
        <div class="setting-section">
            <div class="setting-section-header">
                <div class="section-icon"><span class="material-icons">share</span></div>
                <div>
                    <h3>Footer — Media Sosial</h3>
                    <p>URL akun media sosial resmi instansi</p>
                </div>
            </div>
            <div class="setting-section-body">
                <div class="social-grid">
                    <div class="social-item">
                        <label for="social_facebook">
                            <span class="social-icon fb">f</span> Facebook
                        </label>
                        <input type="url" id="social_facebook" name="social_facebook"
                            value="{{ $settings['social_facebook'] ?? 'https://facebook.com' }}"
                            placeholder="https://facebook.com/dinkescianjur">
                    </div>
                    <div class="social-item">
                        <label for="social_instagram">
                            <span class="social-icon ig">&#9650;</span> Instagram
                        </label>
                        <input type="url" id="social_instagram" name="social_instagram"
                            value="{{ $settings['social_instagram'] ?? 'https://instagram.com' }}"
                            placeholder="https://instagram.com/dinkescianjur">
                    </div>
                    <div class="social-item">
                        <label for="social_twitter">
                            <span class="social-icon tw">X</span> X (Twitter)
                        </label>
                        <input type="url" id="social_twitter" name="social_twitter"
                            value="{{ $settings['social_twitter'] ?? 'https://x.com' }}"
                            placeholder="https://x.com/dinkescianjur">
                    </div>
                    <div class="social-item">
                        <label for="social_youtube">
                            <span class="social-icon yt">&#9654;</span> YouTube
                        </label>
                        <input type="url" id="social_youtube" name="social_youtube"
                            value="{{ $settings['social_youtube'] ?? 'https://youtube.com' }}"
                            placeholder="https://youtube.com/@dinkescianjur">
                    </div>
                    <div class="social-item">
                        <label for="social_tiktok">
                            <span class="social-icon tt">&#9835;</span> TikTok
                        </label>
                        <input type="url" id="social_tiktok" name="social_tiktok"
                            value="{{ $settings['social_tiktok'] ?? 'https://tiktok.com' }}"
                            placeholder="https://tiktok.com/@dinkescianjur">
                    </div>
                </div>
            </div>
        </div>

        {{-- ==================== SECTION 5: HEADER PER HALAMAN ==================== --}}
        <div class="setting-section">
            <div class="setting-section-header">
                <div class="section-icon"><span class="material-icons">article</span></div>
                <div>
                    <h3>Header Per Halaman</h3>
                    <p>Judul dan sub-judul banner yang tampil di bagian atas setiap halaman</p>
                </div>
            </div>
            <div class="setting-section-body" style="display: flex; flex-direction: column; gap: 16px;">
                @php
                $pageHeaders = [
                    'profil'   => ['label' => 'Halaman Profil',                 'title_default' => 'Profil Dinas Kesehatan Kabupaten Cianjur',   'sub_default' => 'Mewujudkan Transformasi Pelayanan Kesehatan Masyarakat yang Profesional, Merata, dan Terintegrasi.'],
                    'berita'   => ['label' => 'Halaman Berita',                  'title_default' => 'Rilis Berita & Informasi Terkini',           'sub_default' => 'Informasi seputar kesehatan terkini dan kegiatan yang dilaksanakan oleh Dinas Kesehatan Kabupaten Cianjur'],
                    'agenda'   => ['label' => 'Halaman Agenda',                  'title_default' => 'Agenda Kesehatan',                          'sub_default' => 'Kumpulan Agenda dan Acara yang dijadwalkan di Dinas Kesehatan Kabupaten Cianjur'],
                    'media'    => ['label' => 'Halaman Galeri / Media',          'title_default' => 'Galeri Kegiatan',                           'sub_default' => 'Kumpulan dokumentasi foto dan video dari berbagai acara dan kegiatan Dinas Kesehatan Kota Cianjur'],
                    'faskes'   => ['label' => 'Halaman Fasilitas Kesehatan',     'title_default' => 'Fasilitas Kesehatan Kabupaten Cianjur',     'sub_default' => 'Pusat data terpadu, indikator kinerja kesehatan, angka kecukupan faskes/nakes, publikasi profil tahunan, dan produk hukum daerah.'],
                    'labkesda' => ['label' => 'Halaman Labkesda',                'title_default' => 'Laboratorium Kesehatan Daerah',             'sub_default' => 'Fasilitas Lab Uji Terpadu Daerah untuk pengujian kesehatan masyarakat Kabupaten Cianjur.'],
                    'ppid'     => ['label' => 'Halaman PPID',                    'title_default' => 'PPID Dinas Kesehatan Kabupaten Cianjur',    'sub_default' => 'Pusat layanan informasi publik, permohonan dokumen resmi, serta transparansi kinerja Dinas Kesehatan.'],
                    'layanan'  => ['label' => 'Halaman Layanan Terpadu',         'title_default' => 'Layanan Terpadu Kesehatan Kabupaten Cianjur','sub_default' => 'Pusat pelayanan perizinan, rekomendasi medis, dan sertifikasi kesehatan secara cepat, transparan, dan terintegrasi.'],
                    'kia'      => ['label' => 'Halaman Kesehatan Ibu & Anak',    'title_default' => 'Kesehatan Ibu & Anak (KIA)',                'sub_default' => 'Pelayanan kesehatan komprehensif untuk ibu dan anak yang meliputi periode pra-konsepsi, kehamilan, persalinan, nifas, dan bayi.'],
                    'stunting' => ['label' => 'Halaman Stunting',                'title_default' => 'Cianjur Bebas Stunting',                   'sub_default' => 'Program komprehensif untuk mencegah dan menurunkan angka stunting di Kabupaten Cianjur melalui intervensi gizi dan edukasi.'],
                ];
                @endphp

                @foreach($pageHeaders as $slug => $page)
                <div class="nav-link-row">
                    <span class="row-title">{{ $page['label'] }}</span>
                    <div class="form-grid" style="margin-top: 8px;">
                        <div class="form-group">
                            <label for="page_{{ $slug }}_title">Judul</label>
                            <input type="text"
                                id="page_{{ $slug }}_title"
                                name="page_{{ $slug }}_title"
                                value="{{ $settings['page_'.$slug.'_title'] ?? $page['title_default'] }}"
                                placeholder="{{ $page['title_default'] }}">
                        </div>
                        <div class="form-group">
                            <label for="page_{{ $slug }}_subtitle">Sub-judul</label>
                            <input type="text"
                                id="page_{{ $slug }}_subtitle"
                                name="page_{{ $slug }}_subtitle"
                                value="{{ $settings['page_'.$slug.'_subtitle'] ?? $page['sub_default'] }}"
                                placeholder="{{ $page['sub_default'] }}">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- ==================== SAVE BUTTON ==================== --}}
        <div class="setting-section">
            <div class="form-actions">
                <span style="font-size:13px; color:#94a3b8;">Perubahan akan langsung berlaku di seluruh halaman publik.</span>
                <button type="submit" class="btn-save">
                    <span class="material-icons">save</span>
                    Simpan Pengaturan
                </button>
            </div>
        </div>

    </form>
</div>
@endsection
