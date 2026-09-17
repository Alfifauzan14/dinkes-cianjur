<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajukan Keberatan - PPID Dinkes Cianjur</title>
    <meta name="description" content="Sampaikan keberatan terhadap permohonan informasi publik kepada PPID Dinas Kesehatan Kabupaten Cianjur.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/PPID/keberatan.css') }}?v={{ time() }}">
</head>
<body>
    @include('layouts.navbar')

    <div class="keb-wrapper">
        <header class="keb-header">
            <div class="keb-header-container">
                <h1 class="keb-header-title">Ajukan Keberatan</h1>
                <p class="keb-header-subtitle">Sampaikan keberatan Anda terhadap proses atau hasil permohonan informasi publik yang sudah diajukan kepada PPID Dinas Kesehatan Kabupaten Cianjur.</p>
            </div>
        </header>

        <main class="keb-main">
            <div class="keb-container">

                @if(session('success'))
                    <div class="keb-alert keb-alert-success">
                        <span class="material-icons">check_circle</span>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="keb-alert keb-alert-error">
                        <span class="material-icons">error</span>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="keb-alert keb-alert-error">
                        <span class="material-icons">warning</span>
                        <ul style="margin:0;padding-left:18px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="keb-info-box">
                    <span class="material-icons">info</span>
                    <p>Berdasarkan <strong>UU No. 14 Tahun 2008</strong> tentang Keterbukaan Informasi Publik, setiap pemohon informasi berhak mengajukan keberatan apabila permohonan tidak ditanggapi atau ditolak.</p>
                </div>

                <form action="{{ route('keberatan.store') }}" method="POST" id="keberatanForm" novalidate>
                    @csrf

                    <div class="keb-card">
                        <div class="keb-card-header">
                            <div class="keb-step-num">1</div>
                            <div>
                                <h2 class="keb-card-title">Verifikasi Permohonan</h2>
                                <p class="keb-card-desc">Masukkan token permohonan dan email untuk memverifikasi identitas Anda.</p>
                            </div>
                        </div>

                        <div class="keb-fields">
                            <div class="keb-field-row">
                                <div class="keb-field-group">
                                    <label class="keb-field-label" for="token">Token Permohonan <span class="keb-req">*</span></label>
                                    <div class="keb-field-prefix-wrap">
                                        <span class="keb-field-prefix"><span class="material-icons">vpn_key</span></span>
                                        <input type="text" id="token" name="token"
                                            class="keb-field-input has-prefix @error('token') is-error @enderror"
                                            placeholder="7 digit token (contoh: TFQ3QCC)"
                                            value="{{ old('token') }}" maxlength="7" inputmode="numeric" required>
                                    </div>
                                    @error('token')<span class="keb-field-err">{{ $message }}</span>@enderror
                                </div>

                                <div class="keb-field-group">
                                    <label class="keb-field-label" for="email">Email <span class="keb-req">*</span></label>
                                    <div class="keb-field-prefix-wrap">
                                        <span class="keb-field-prefix"><span class="material-icons">email</span></span>
                                        <input type="email" id="email" name="email"
                                            class="keb-field-input has-prefix @error('email') is-error @enderror"
                                            placeholder="email@contoh.com"
                                            value="{{ old('email') }}" required>
                                    </div>
                                    @error('email')<span class="keb-field-err">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div>
                                <button type="button" class="keb-cek-btn" id="cekBtn" onclick="cekPermohonan()">
                                    <span class="material-icons">search</span>
                                    Lihat Detail Permohonan
                                </button>
                            </div>

                            <div id="warningBox" style="display:none;"></div>
                            <div id="detailPanel"></div>
                        </div>
                    </div>

                    <div class="keb-card">
                        <div class="keb-card-header">
                            <div class="keb-step-num">2</div>
                            <div>
                                <h2 class="keb-card-title">Alasan Keberatan</h2>
                                <p class="keb-card-desc">Jelaskan alasan keberatan Anda terhadap permohonan informasi tersebut.</p>
                            </div>
                        </div>

                        <div class="keb-fields">
                            <div class="keb-field-group keb-field-full">
                                <label class="keb-field-label" for="alasan_keberatan">Alasan Keberatan <span class="keb-req">*</span></label>
                                <textarea id="alasan_keberatan" name="alasan_keberatan" rows="6"
                                    class="keb-field-textarea @error('alasan_keberatan') is-error @enderror"
                                    placeholder="Jelaskan secara detail alasan keberatan Anda, misalnya: informasi yang diberikan tidak lengkap, tidak sesuai dengan yang diminta, atau permohonan ditolak tanpa alasan yang jelas..."
                                    required>{{ old('alasan_keberatan') }}</textarea>
                                <span class="keb-field-hint">Maksimal 5000 karakter.</span>
                                @error('alasan_keberatan')<span class="keb-field-err">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="keb-card keb-submit-wrap">
                        <label class="keb-persetujuan-label">
                            <input type="checkbox" name="persetujuan" id="persetujuan" class="keb-check-input" required>
                            <span class="keb-check-box"></span>
                            <span class="keb-persetujuan-text">
                                Saya menyatakan bahwa data yang saya isi adalah <strong>benar dan dapat dipertanggungjawabkan</strong>.
                                Saya memahami bahwa penyampaian data yang tidak benar dapat dikenakan sanksi sesuai peraturan perundang-undangan yang berlaku.
                            </span>
                        </label>

                        <div class="keb-submit-row">
                            <a href="{{ route('ppid') }}" class="keb-btn-back">
                                <span class="material-icons">arrow_back</span>
                                Batal
                            </a>
                            <button type="submit" class="keb-btn-submit" id="btnSubmit">
                                <span class="material-icons">send</span>
                                Kirim Keberatan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>


    <script>
    var permohonanVerified = false;

    function cekPermohonan() {
        var token = document.getElementById('token').value.trim();
        var email = document.getElementById('email').value.trim();
        var cekBtn = document.getElementById('cekBtn');
        var warningBox = document.getElementById('warningBox');
        var detailPanel = document.getElementById('detailPanel');

        warningBox.style.display = 'none';
        detailPanel.innerHTML = '';

        if (!token || token.length !== 7) {
            warningBox.innerHTML = '<div class="keb-warning"><span class="material-icons">warning</span><span>Token permohonan harus 7 digit.</span></div>';
            warningBox.style.display = 'block';
            permohonanVerified = false;
            return;
        }
        if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            warningBox.innerHTML = '<div class="keb-warning"><span class="material-icons">warning</span><span>Masukkan alamat email yang valid.</span></div>';
            warningBox.style.display = 'block';
            permohonanVerified = false;
            return;
        }

        cekBtn.disabled = true;
        cekBtn.innerHTML = '<span class="material-icons keb-spinning">autorenew</span> Mengecek...';

        var formData = new FormData();
        formData.append('token', token);
        formData.append('email', email);
        formData.append('_token', '{{ csrf_token() }}');

        fetch('{{ route("keberatan.cek") }}', {
            method: 'POST',
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
            body: formData
        })
        .then(function(response) { return response.json(); })
        .then(function(data) {
            cekBtn.disabled = false;
            cekBtn.innerHTML = '<span class="material-icons">search</span> Lihat Detail Permohonan';

            if (data.found) {
                permohonanVerified = true;
                var d = data.data;
                var statusClass = 'keb-status-' + d.status;
                var statusLabel = d.status === 'pending' ? 'Menunggu' : (d.status === 'disetujui' ? 'Disetujui' : 'Ditolak');

                detailPanel.innerHTML =
                    '<button type="button" class="keb-detail-toggle open" onclick="toggleDetail(this)">' +
                        '<span class="material-icons">description</span>' +
                        '<span class="keb-detail-toggle-label">Detail Permohonan</span>' +
                        '<span class="material-icons keb-detail-toggle-arrow">expand_more</span>' +
                    '</button>' +
                    '<div class="keb-detail-panel show">' +
                        '<div class="keb-detail-grid">' +
                            '<div class="keb-detail-item"><span class="keb-detail-label">Nama Pemohon</span><span class="keb-detail-value">' + escHtml(d.nama_pemohon) + '</span></div>' +
                            '<div class="keb-detail-item"><span class="keb-detail-label">NIK</span><span class="keb-detail-value">' + escHtml(d.nik) + '</span></div>' +
                            '<div class="keb-detail-item"><span class="keb-detail-label">Email</span><span class="keb-detail-value">' + escHtml(d.email) + '</span></div>' +
                            '<div class="keb-detail-item"><span class="keb-detail-label">No. HP</span><span class="keb-detail-value">' + escHtml(d.no_hp) + '</span></div>' +
                            '<div class="keb-detail-item"><span class="keb-detail-label">Jenis Informasi</span><span class="keb-detail-value">' + escHtml(d.jenis_informasi) + '</span></div>' +
                            '<div class="keb-detail-item"><span class="keb-detail-label">Status</span><span class="keb-detail-value"><span class="keb-status-badge ' + statusClass + '">' + statusLabel + '</span></span></div>' +
                            '<div class="keb-detail-item"><span class="keb-detail-label">Tanggal Pengajuan</span><span class="keb-detail-value">' + escHtml(d.created_at) + '</span></div>' +
                            '<div class="keb-detail-item keb-detail-full"><span class="keb-detail-label">Rincian Informasi</span><span class="keb-detail-value full-width">' + escHtml(d.rincian_informasi) + '</span></div>' +
                        '</div>' +
                    '</div>';
            } else {
                permohonanVerified = false;
                warningBox.innerHTML = '<div class="keb-warning"><span class="material-icons">error</span><span>' + escHtml(data.message) + '</span></div>';
                warningBox.style.display = 'block';
            }
        })
        .catch(function() {
            cekBtn.disabled = false;
            cekBtn.innerHTML = '<span class="material-icons">search</span> Lihat Detail Permohonan';
            warningBox.innerHTML = '<div class="keb-warning"><span class="material-icons">error</span><span>Terjadi kesalahan. Silakan coba lagi.</span></div>';
            warningBox.style.display = 'block';
            permohonanVerified = false;
        });
    }

    function toggleDetail(btn) {
        btn.classList.toggle('open');
        var panel = btn.nextElementSibling;
        panel.classList.toggle('show');
    }

    function escHtml(text) {
        if (text === null || text === undefined) return '';
        var div = document.createElement('div');
        div.appendChild(document.createTextNode(String(text)));
        return div.innerHTML;
    }

    document.getElementById('keberatanForm').addEventListener('submit', function(e) {
        var token = document.getElementById('token').value.trim();
        var email = document.getElementById('email').value.trim();
        var alasan = document.getElementById('alasan_keberatan').value.trim();
        var persetujuan = document.getElementById('persetujuan').checked;
        var valid = true;

        if (!permohonanVerified) {
            e.preventDefault();
            var warningBox = document.getElementById('warningBox');
            warningBox.innerHTML = '<div class="keb-warning"><span class="material-icons">warning</span><span>Silakan verifikasi permohonan terlebih dahulu dengan menekan tombol "Lihat Detail Permohonan".</span></div>';
            warningBox.style.display = 'block';
            document.getElementById('token').scrollIntoView({ behavior: 'smooth', block: 'center' });
            return false;
        }

        if (!alasan) {
            e.preventDefault();
            document.getElementById('alasan_keberatan').classList.add('is-error');
            document.getElementById('alasan_keberatan').scrollIntoView({ behavior: 'smooth', block: 'center' });
            document.getElementById('alasan_keberatan').focus();
            return false;
        }

        var btn = document.getElementById('btnSubmit');
        btn.innerHTML = '<span class="material-icons keb-spinning">autorenew</span> Mengirim...';
        btn.disabled = true;
    });
    </script>
    @include('layouts.footer')
</body>
</html>
