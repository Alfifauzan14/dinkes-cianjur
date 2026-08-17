<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cek Status Permohonan - PPID Dinkes Cianjur</title>
    <meta name="description" content="Cek status permohonan informasi publik Anda di PPID Dinas Kesehatan Kabupaten Cianjur.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/PPID/cek-status.css') }}?v={{ time() }}">
</head>
<body>
    @include('layouts.navbar')

    <div class="cs-wrapper">
        <header class="cs-header">
            <div class="cs-header-container">
                <h1 class="cs-header-title">Cek Status Permohonan</h1>
                <p class="cs-header-subtitle">Masukkan token permohonan Anda untuk melihat status dan detail permohonan informasi publik secara real-time.</p>
            </div>
        </header>

        <main class="cs-main">
            <div class="cs-container">

                @if(session('success'))
                    <div class="cs-alert cs-alert-success">
                        <span class="material-icons">check_circle</span>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="cs-alert cs-alert-error">
                        <span class="material-icons">error</span>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <div class="cs-info-box">
                    <span class="material-icons">info</span>
                    <p>Token permohonan terdiri dari <strong>7 karakter</strong> (huruf dan/atau angka) yang diberikan saat Anda mengajukan permohonan. Simpan token ini untuk memantau status permohonan Anda.</p>
                </div>

                {{-- Form Pencarian --}}
                <div class="cs-card">
                    <div class="cs-card-header">
                        <div class="cs-step-num">1</div>
                        <div>
                            <h2 class="cs-card-title">Masukkan Token Permohonan</h2>
                            <p class="cs-card-desc">Ketik 7 digit token yang Anda dapatkan saat mengajukan permohonan.</p>
                        </div>
                    </div>

                    <div class="cs-fields">
                        <div class="cs-field-group">
                            <label class="cs-field-label" for="token">Token Permohonan <span class="cs-req">*</span></label>
                            <div class="cs-field-prefix-wrap">
                                <span class="cs-field-prefix"><span class="material-icons">vpn_key</span></span>
                                <input type="text" id="token"
                                    class="cs-field-input has-prefix"
                                    placeholder="Masukkan 7 karakter token (contoh: TFQ3QCC)"
                                    maxlength="7" style="text-transform:uppercase;letter-spacing:1px;font-family:monospace;font-weight:600;">
                            </div>
                            <span class="cs-field-err" id="tokenErr"></span>
                        </div>

                        <div>
                            <button type="button" class="cs-cek-btn" id="cekBtn" onclick="cekStatus()">
                                <span class="material-icons">search</span>
                                Cek Status Permohonan
                            </button>
                        </div>

                        <div id="warningBox" style="display:none;"></div>
                    </div>
                </div>

                {{-- Hasil (akan diisi oleh JS) --}}
                <div id="resultArea"></div>

            </div>
        </main>
    </div>


    <script>
    var storageBaseUrl = '{{ asset("storage") }}';

    function cekStatus() {
        var token = document.getElementById('token').value.trim().toUpperCase();
        var cekBtn = document.getElementById('cekBtn');
        var warningBox = document.getElementById('warningBox');
        var resultArea = document.getElementById('resultArea');
        var tokenErr = document.getElementById('tokenErr');

        warningBox.style.display = 'none';
        resultArea.innerHTML = '';
        tokenErr.textContent = '';
        document.getElementById('token').classList.remove('is-error');

        if (!token || token.length !== 7 || !/^[A-Za-z0-9]{7}$/.test(token)) {
            tokenErr.textContent = 'Token harus 7 karakter (huruf atau angka).';
            document.getElementById('token').classList.add('is-error');
            document.getElementById('token').scrollIntoView({ behavior: 'smooth', block: 'center' });
            return;
        }

        cekBtn.disabled = true;
        cekBtn.innerHTML = '<span class="material-icons cs-spinning">autorenew</span> Mengecek...';

        var formData = new FormData();
        formData.append('token', token);
        formData.append('_token', '{{ csrf_token() }}');

        fetch('{{ route("cek-status.api") }}', {
            method: 'POST',
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
            body: formData
        })
        .then(function(response) { return response.json(); })
        .then(function(data) {
            cekBtn.disabled = false;
            cekBtn.innerHTML = '<span class="material-icons">search</span> Cek Status Permohonan';

            if (data.found) {
                renderResult(data.data);
            } else {
                warningBox.innerHTML = '<div class="cs-warning"><span class="material-icons">error</span><span>' + escHtml(data.message) + '</span></div>';
                warningBox.style.display = 'block';
            }
        })
        .catch(function() {
            cekBtn.disabled = false;
            cekBtn.innerHTML = '<span class="material-icons">search</span> Cek Status Permohonan';
            warningBox.innerHTML = '<div class="cs-warning"><span class="material-icons">error</span><span>Terjadi kesalahan. Silakan coba lagi.</span></div>';
            warningBox.style.display = 'block';
        });
    }

    function renderResult(d) {
        var area = document.getElementById('resultArea');
        var statusClass = d.status;
        var statusLabel = d.status === 'pending' ? 'Menunggu Review' : (d.status === 'disetujui' ? 'Disetujui' : 'Ditolak');
        var statusIcon = d.status === 'pending' ? 'hourglass_empty' : (d.status === 'disetujui' ? 'check_circle' : 'cancel');

        var formatBadges = '';
        if (d.format_informasi && d.format_informasi.length > 0) {
            d.format_informasi.forEach(function(f) {
                formatBadges += '<span class="cs-badge">' + escHtml(capitalize(f)) + '</span> ';
            });
        } else {
            formatBadges = '<span style="color:#94A3B8;font-style:italic;font-size:14px;">Tidak ada format khusus</span>';
        }

        var tanggapanHtml = '';
        if (d.tanggapan) {
            tanggapanHtml = '<div class="cs-tanggapan-card">' +
                '<div class="cs-tanggapan-header">' +
                    '<span class="material-icons">speaker_notes</span>' +
                    '<h3 class="cs-tanggapan-title">Tanggapan dari PPID</h3>' +
                '</div>' +
                '<div class="cs-tanggapan-text">' + escHtml(d.tanggapan) + '</div>' +
                (d.file_tanggapan ?
                    '<div class="cs-tanggapan-file">' +
                        '<div class="cs-tanggapan-file-icon"><span class="material-icons">description</span></div>' +
                        '<div class="cs-tanggapan-file-info">' +
                            '<div class="cs-tanggapan-file-name">' + escHtml(basename(d.file_tanggapan)) + '</div>' +
                            '<div class="cs-tanggapan-file-hint">Dokumen pendukung dari admin</div>' +
                        '</div>' +
                        '<a href="' + storageBaseUrl + '/' + escHtml(d.file_tanggapan) + '" target="_blank" class="cs-tanggapan-file-link">' +
                            '<span class="material-icons">visibility</span> Lihat' +
                        '</a>' +
                    '</div>' : '') +
            '</div>';
        }

        var ktpHtml = '';
        if (d.foto_ktp) {
            var isPdf = d.foto_ktp.toLowerCase().endsWith('.pdf');
            if (isPdf) {
                ktpHtml = '<div style="display:flex;align-items:center;gap:12px;padding:14px 16px;background:#F8FAFC;border:1px solid #E2E8F0;border-radius:3px;">' +
                    '<span class="material-icons" style="font-size:28px;color:#EF4444;">picture_as_pdf</span>' +
                    '<div style="flex:1;">' +
                        '<div style="font-weight:600;color:#1E293B;font-size:14px;">Dokumen KTP (PDF)</div>' +
                    '</div>' +
                    '<a href="' + storageBaseUrl + '/' + escHtml(d.foto_ktp) + '" target="_blank" class="cs-tanggapan-file-link">' +
                        '<span class="material-icons">visibility</span> Lihat' +
                    '</a>' +
                '</div>';
            } else {
                ktpHtml = '<div class="cs-ktp-wrap">' +
                    '<img src="' + storageBaseUrl + '/' + escHtml(d.foto_ktp) + '" alt="KTP Pemohon" class="cs-ktp-img">' +
                    '<a href="' + storageBaseUrl + '/' + escHtml(d.foto_ktp) + '" target="_blank" class="cs-ktp-link">' +
                        '<span class="material-icons">open_in_new</span> Lihat Ukuran Penuh' +
                    '</a>' +
                '</div>';
            }
        }

        var html =
            // Status Hero
            '<div class="cs-status-hero ' + statusClass + '">' +
                '<div class="cs-status-hero-icon"><span class="material-icons">' + statusIcon + '</span></div>' +
                '<p class="cs-status-hero-label">Status Permohonan</p>' +
                '<h2 class="cs-status-hero-text">' + statusLabel + '</h2>' +
                '<p class="cs-status-hero-date">Diperbarui: ' + escHtml(d.updated_at) + '</p>' +
            '</div>' +

            // Tanggapan
            tanggapanHtml +

            // Identitas Pemohon
            '<div class="cs-detail-section">' +
                '<div class="cs-detail-section-header">' +
                    '<span class="material-icons">badge</span>' +
                    '<h3 class="cs-detail-section-title">Identitas Pemohon</h3>' +
                '</div>' +
                '<div class="cs-detail-grid">' +
                    '<div class="cs-detail-item"><span class="cs-detail-label">Nama Lengkap</span><span class="cs-detail-value">' + escHtml(d.nama_pemohon) + '</span></div>' +
                    '<div class="cs-detail-item"><span class="cs-detail-label">NIK</span><span class="cs-detail-value">' + escHtml(d.nik) + '</span></div>' +
                    '<div class="cs-detail-item"><span class="cs-detail-label">No. HP / WhatsApp</span><span class="cs-detail-value">' + escHtml(d.no_hp) + '</span></div>' +
                    '<div class="cs-detail-item"><span class="cs-detail-label">Email</span><span class="cs-detail-value">' + escHtml(d.email) + '</span></div>' +
                    '<div class="cs-detail-item"><span class="cs-detail-label">Pekerjaan</span><span class="cs-detail-value">' + escHtml(d.pekerjaan) + '</span></div>' +
                    '<div class="cs-detail-item"><span class="cs-detail-label">Alamat Lengkap</span><span class="cs-detail-value">' + escHtml(d.alamat) + '</span></div>' +
                '</div>' +
                (d.foto_ktp ?
                    '<div style="margin-top:20px;">' +
                        '<span class="cs-detail-label" style="display:block;margin-bottom:8px;">Dokumen Identitas (KTP)</span>' +
                        ktpHtml +
                    '</div>' : '') +
            '</div>' +

            // Detail Permohonan
            '<div class="cs-detail-section">' +
                '<div class="cs-detail-section-header">' +
                    '<span class="material-icons">help</span>' +
                    '<h3 class="cs-detail-section-title">Detail Permohonan Informasi</h3>' +
                '</div>' +
                '<div class="cs-detail-grid">' +
                    '<div class="cs-detail-item"><span class="cs-detail-label">Token</span><span class="cs-detail-value" style="font-family:monospace;font-size:18px;color:#009966;letter-spacing:1px;">' + escHtml(d.token) + '</span></div>' +
                    '<div class="cs-detail-item"><span class="cs-detail-label">Tanggal Pengajuan</span><span class="cs-detail-value">' + escHtml(d.created_at) + '</span></div>' +
                    '<div class="cs-detail-item"><span class="cs-detail-label">Jenis Informasi</span><span class="cs-detail-value"><span class="cs-badge">' + escHtml(formatLabel(d.jenis_informasi)) + '</span></span></div>' +
                    '<div class="cs-detail-item"><span class="cs-detail-label">Tujuan Penggunaan</span><span class="cs-detail-value"><span class="cs-badge">' + escHtml(formatLabel(d.tujuan_penggunaan)) + '</span></span></div>' +
                    '<div class="cs-detail-item"><span class="cs-detail-label">Cara Memperoleh</span><span class="cs-detail-value">' + escHtml(capitalize(d.cara_memperoleh ? d.cara_memperoleh.replace('_', ' ') : '-')) + '</span></div>' +
                    '<div class="cs-detail-item"><span class="cs-detail-label">Format Informasi</span><span class="cs-detail-value" style="display:flex;flex-wrap:wrap;gap:6px;">' + formatBadges + '</span></div>' +
                    '<div class="cs-detail-item cs-detail-full"><span class="cs-detail-label">Rincian Informasi yang Diminta</span><div class="cs-detail-value-block">' + escHtml(d.rincian_informasi) + '</div></div>' +
                    (d.alasan_permohonan ?
                        '<div class="cs-detail-item cs-detail-full"><span class="cs-detail-label">Alasan Permohonan</span><div class="cs-detail-value-block" style="border-left-color:#475569;">' + escHtml(d.alasan_permohonan) + '</div></div>' : '') +
                '</div>' +
            '</div>';

        area.innerHTML = html;
        area.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    function formatLabel(str) {
        if (!str) return '-';
        return String(str).replace(/_/g, ' ').replace(/\b\w/g, function(c) { return c.toUpperCase(); });
    }

    function capitalize(str) {
        if (!str) return '-';
        return String(str).replace(/\b\w/g, function(c) { return c.toUpperCase(); });
    }

    function basename(path) {
        return path ? path.split('/').pop() : '';
    }

    function escHtml(text) {
        if (text === null || text === undefined) return '';
        var div = document.createElement('div');
        div.appendChild(document.createTextNode(String(text)));
        return div.innerHTML;
    }

    // Enter key triggers search
    document.getElementById('token').addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            cekStatus();
        }
    });
    </script>
    @include('layouts.footer')
</body>
</html>
