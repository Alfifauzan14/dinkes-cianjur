<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Permohonan Informasi Publik - PPID Dinkes Cianjur</title>
    <meta name="description" content="Ajukan permohonan informasi publik kepada PPID Dinas Kesehatan Kabupaten Cianjur secara online.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/PPID/permohonan.css') }}?v={{ time() }}">
</head>
<body>
    @include('layouts.navbar')

    <div class="perm-wrapper">
        <header class="perm-header">
            <div class="perm-header-container"> 
                <h1 class="perm-header-title">Permohonan Informasi Publik</h1>
                <p class="perm-header-subtitle">Isi formulir berikut untuk mengajukan permohonan kepada PPID Dinas Kesehatan Kabupaten Cianjur. Permohonan diproses dalam <strong>10 hari kerja</strong>.</p>
            </div>
        </header>

        <main class="perm-main">
            <div class="perm-container">

                @if(session('success'))
                    <div class="perm-alert perm-alert-success">
                        <span class="material-icons">check_circle</span>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="perm-alert perm-alert-error">
                        <span class="material-icons">error</span>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="perm-alert perm-alert-error">
                        <span class="material-icons">warning</span>
                        <ul class="alert-list">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="perm-info-box">
                    <span class="material-icons">info</span>
                    <p>Berdasarkan <strong>UU No. 14 Tahun 2008</strong> tentang Keterbukaan Informasi Publik, setiap warga negara berhak memperoleh informasi publik dari badan publik.</p>
                </div>

                <form action="{{ route('permohonan.store') }}" method="POST" id="permohonanForm" enctype="multipart/form-data" novalidate>
                    @csrf

                    {{-- Section 1 --}}
                    <div class="perm-card">
                        <div class="perm-card-header">
                            <div class="perm-step-num">1</div>
                            <div>
                                <h2 class="perm-card-title">Data Pemohon</h2>
                                <p class="perm-card-desc">Lengkapi identitas Anda sebagai pemohon informasi.</p>
                            </div>
                        </div>

                        <div class="perm-fields">
                            <div class="field-row">
                                <div class="field-group">
                                    <label class="field-label" for="nama_pemohon">Nama Lengkap <span class="req">*</span></label>
                                    <input type="text" id="nama_pemohon" name="nama_pemohon"
                                        class="field-input @error('nama_pemohon') is-error @enderror"
                                        placeholder="Nama lengkap sesuai KTP"
                                        value="{{ old('nama_pemohon') }}" required>
                                    @error('nama_pemohon')<span class="field-err">{{ $message }}</span>@enderror
                                </div>

                                <div class="field-group">
                                    <label class="field-label" for="nik">NIK <span class="req">*</span></label>
                                    <input type="text" id="nik" name="nik"
                                        class="field-input @error('nik') is-error @enderror"
                                        placeholder="16 digit NIK sesuai KTP"
                                        value="{{ old('nik') }}" maxlength="16" inputmode="numeric" required>
                                    <span class="field-err" id="nik_err">@error('nik'){{ $message }}@enderror</span>
                                </div>
                            </div>

                            <div class="field-row">
                                <div class="field-group">
                                    <label class="field-label" for="no_hp">No. HP / WhatsApp <span class="req">*</span></label>
                                    <div class="field-prefix-wrap">
                                        <span class="field-prefix"><span class="material-icons">phone</span></span>
                                        <input type="tel" id="no_hp" name="no_hp"
                                            class="field-input has-prefix @error('no_hp') is-error @enderror"
                                            placeholder="08123456789"
                                            value="{{ old('no_hp') }}" required>
                                    </div>
                                    <span class="field-err" id="no_hp_err">@error('no_hp'){{ $message }}@enderror</span>
                                </div>

                                <div class="field-group">
                                    <label class="field-label" for="email">Email <span class="req">*</span></label>
                                    <div class="field-prefix-wrap">
                                        <span class="field-prefix"><span class="material-icons">email</span></span>
                                        <input type="email" id="email" name="email"
                                            class="field-input has-prefix @error('email') is-error @enderror"
                                            placeholder="email@contoh.com"
                                            value="{{ old('email') }}" required>
                                    </div>
                                    @error('email')<span class="field-err">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="field-group field-full">
                                <label class="field-label" for="pekerjaan">Pekerjaan <span class="req">*</span></label>
                                <input type="text" id="pekerjaan" name="pekerjaan"
                                    class="field-input @error('pekerjaan') is-error @enderror"
                                    placeholder="Contoh: Mahasiswa, PNS, Wiraswasta"
                                    value="{{ old('pekerjaan') }}" required>
                                @error('pekerjaan')<span class="field-err">{{ $message }}</span>@enderror
                            </div>

                            <div class="field-group field-full">
                                <label class="field-label" for="alamat">Alamat Lengkap <span class="req">*</span></label>
                                <textarea id="alamat" name="alamat" rows="3"
                                    class="field-textarea @error('alamat') is-error @enderror"
                                    placeholder="Alamat lengkap sesuai KTP atau domisili" required>{{ old('alamat') }}</textarea>
                                @error('alamat')<span class="field-err">{{ $message }}</span>@enderror
                            </div>

                            <div class="field-group field-full">
                                <label class="field-label" for="foto_ktp">Foto / Scan KTP <span class="req">*</span></label>
                                <div class="upload-zone @error('foto_ktp') is-error @enderror" id="uploadZone">
                                    <input type="file" id="foto_ktp" name="foto_ktp"
                                        class="upload-input" accept="image/jpeg,image/png,image/webp,application/pdf"
                                        required>
                                    <div class="upload-idle" id="uploadIdle">
                                        <span class="material-icons upload-icon">badge</span>
                                        <p class="upload-title">Drag & drop file KTP di sini</p>
                                        <p class="upload-sub">atau <button type="button" class="upload-browse-btn" id="uploadBrowseBtn">pilih file</button></p>
                                        <p class="upload-hint">JPG, PNG, WEBP, atau PDF &bull; Maks. 10 MB</p>
                                    </div>
                                    <div class="upload-preview" id="uploadPreview" style="display:none;">
                                        <img id="uploadPreviewImg" src="" alt="Preview KTP" class="upload-preview-img">
                                        <div class="upload-preview-info">
                                            <span class="material-icons" style="color:#009966;font-size:20px;">check_circle</span>
                                            <span id="uploadFileName" class="upload-file-name"></span>
                                            <button type="button" class="upload-remove-btn" id="uploadRemoveBtn" title="Hapus file">
                                                <span class="material-icons">close</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @error('foto_ktp')<span class="field-err">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    {{-- Section 2 --}}
                    <div class="perm-card">
                        <div class="perm-card-header">
                            <div class="perm-step-num">2</div>
                            <div>
                                <h2 class="perm-card-title">Detail Permohonan Informasi</h2>
                                <p class="perm-card-desc">Jelaskan informasi yang Anda butuhkan secara detail.</p>
                            </div>
                        </div>

                        <div class="perm-fields">
                            <div class="field-row">
                                <div class="field-group">
                                    <label class="field-label" for="jenis_informasi">Jenis Informasi <span class="req">*</span></label>
                                    <div class="cst-select" id="cstJenisWrap">
                                        <button type="button" class="cst-select-btn" id="cstJenisBtn" aria-haspopup="listbox" aria-expanded="false">
                                            <span class="cst-select-lbl" id="cstJenisLbl">Pilih jenis informasi</span>
                                            <svg class="cst-chevron" viewBox="0 0 10 6" fill="none"><path d="M1 1L5 5L9 1" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        </button>
                                        <ul class="cst-select-list" role="listbox" id="cstJenisList">
                                            <li class="cst-option" data-value="data_kesehatan" role="option">Data Kesehatan Masyarakat</li>
                                            <li class="cst-option" data-value="anggaran" role="option">Anggaran dan Realisasi</li>
                                            <li class="cst-option" data-value="program" role="option">Program Kesehatan</li>
                                            <li class="cst-option" data-value="regulasi" role="option">Regulasi / Peraturan</li>
                                            <li class="cst-option" data-value="profil" role="option">Profil Dinas Kesehatan</li>
                                            <li class="cst-option" data-value="fasilitas" role="option">Fasilitas Kesehatan</li>
                                            <li class="cst-option" data-value="lainnya" role="option">Lainnya</li>
                                        </ul>
                                        <input type="hidden" name="jenis_informasi" id="cstJenisInput" value="{{ old('jenis_informasi') }}" required>
                                    </div>
                                    @error('jenis_informasi')<span class="field-err">{{ $message }}</span>@enderror
                                </div>

                                <div class="field-group">
                                    <label class="field-label" for="tujuan_penggunaan">Tujuan Penggunaan <span class="req">*</span></label>
                                    <div class="cst-select" id="cstTujuanWrap">
                                        <button type="button" class="cst-select-btn" id="cstTujuanBtn" aria-haspopup="listbox" aria-expanded="false">
                                            <span class="cst-select-lbl" id="cstTujuanLbl">Pilih tujuan</span>
                                            <svg class="cst-chevron" viewBox="0 0 10 6" fill="none"><path d="M1 1L5 5L9 1" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        </button>
                                        <ul class="cst-select-list" role="listbox" id="cstTujuanList">
                                            <li class="cst-option" data-value="penelitian" role="option">Penelitian / Akademik</li>
                                            <li class="cst-option" data-value="jurnalistik" role="option">Jurnalistik / Pers</li>
                                            <li class="cst-option" data-value="pengawasan" role="option">Pengawasan Publik</li>
                                            <li class="cst-option" data-value="pribadi" role="option">Kepentingan Pribadi</li>
                                            <li class="cst-option" data-value="lainnya" role="option">Lainnya</li>
                                        </ul>
                                        <input type="hidden" name="tujuan_penggunaan" id="cstTujuanInput" value="{{ old('tujuan_penggunaan') }}" required>
                                    </div>
                                    @error('tujuan_penggunaan')<span class="field-err">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="field-group field-full">
                                <label class="field-label" for="rincian_informasi">Rincian Informasi yang Diminta <span class="req">*</span></label>
                                <textarea id="rincian_informasi" name="rincian_informasi" rows="5"
                                    class="field-textarea @error('rincian_informasi') is-error @enderror"
                                    placeholder="Jelaskan secara detail informasi yang Anda butuhkan, termasuk periode waktu, cakupan wilayah, atau spesifikasi lainnya..." required>{{ old('rincian_informasi') }}</textarea>
                                <span class="field-hint">Semakin detail penjelasan Anda, semakin cepat permohonan dapat diproses.</span>
                                @error('rincian_informasi')<span class="field-err">{{ $message }}</span>@enderror
                            </div>

                            <div class="field-group field-full">
                                <label class="field-label" for="alasan_permohonan">Alasan Permohonan <span class="opt">(Opsional)</span></label>
                                <textarea id="alasan_permohonan" name="alasan_permohonan" rows="3"
                                    class="field-textarea @error('alasan_permohonan') is-error @enderror"
                                    placeholder="Jelaskan alasan mengapa informasi ini Anda butuhkan...">{{ old('alasan_permohonan') }}</textarea>
                                @error('alasan_permohonan')<span class="field-err">{{ $message }}</span>@enderror
                            </div>


                        </div>
                    </div>

                    {{-- Section 3: Metode Layanan --}}
                    <div class="perm-card">
                        <div class="perm-card-header">
                            <div class="perm-step-num">3</div>
                            <div>
                                <h2 class="perm-card-title">Metode Layanan</h2>
                                <p class="perm-card-desc">Pilih cara Anda ingin mengakses dan menerima informasi.</p>
                            </div>
                        </div>

                        <div class="perm-fields">
                            <div class="metode-grid">
                                {{-- Cara Informasi --}}
                                <div class="metode-col">
                                    <p class="field-label mb-2">Cara Informasi <span class="req">*</span></p>
                                    <div class="radio-list">
                                        @foreach([
                                            ['melihat', 'Melihat'],
                                            ['mendengarkan', 'Mendengarkan'],
                                            ['membaca', 'Membaca'],
                                            ['mencatat', 'Mencatat'],
                                        ] as [$val, $label])
                                        <label class="radio-option {{ old('cara_informasi', 'melihat') === $val ? 'selected' : '' }}">
                                            <input type="radio" name="cara_informasi" value="{{ $val }}" class="radio-input"
                                                {{ old('cara_informasi', 'melihat') === $val ? 'checked' : '' }}>
                                            <span class="radio-dot"></span>
                                            {{ $label }}
                                        </label>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- Bentuk Informasi --}}
                                <div class="metode-col">
                                    <p class="field-label mb-2">Bentuk Informasi <span class="req">*</span></p>
                                    <div class="radio-list">
                                        @foreach([
                                            ['softcopy', 'Soft Copy (Digital)'],
                                            ['hardcopy', 'Hard Copy (Cetak)'],
                                        ] as [$val, $label])
                                        <label class="radio-option {{ old('bentuk_informasi', 'softcopy') === $val ? 'selected' : '' }}">
                                            <input type="radio" name="bentuk_informasi" value="{{ $val }}" class="radio-input"
                                                {{ old('bentuk_informasi', 'softcopy') === $val ? 'checked' : '' }}>
                                            <span class="radio-dot"></span>
                                            {{ $label }}
                                        </label>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- Cara Mendapatkan --}}
                                <div class="metode-col">
                                    <p class="field-label mb-2">Cara Mendapatkan <span class="req">*</span></p>
                                    <div class="radio-list">
                                        @foreach([
                                            ['email', 'Email'],
                                            ['mengambil_langsung', 'Ambil Langsung'],
                                        ] as [$val, $label])
                                        <label class="radio-option {{ old('cara_memperoleh', 'email') === $val ? 'selected' : '' }}">
                                            <input type="radio" name="cara_memperoleh" value="{{ $val }}" class="radio-input"
                                                {{ old('cara_memperoleh', 'email') === $val ? 'checked' : '' }}>
                                            <span class="radio-dot"></span>
                                            {{ $label }}
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Informasi Penting --}}
                    <div class="info-penting-box">
                        <div class="info-penting-icon">
                            <span class="material-icons">info</span>
                        </div>
                        <div>
                            <p class="info-penting-title">Informasi Penting:</p>
                            <ul class="info-penting-list">
                                <li>Permohonan diproses maksimal <strong>14 hari kerja</strong></li>
                                <li>Notifikasi status dikirim via email</li>
                                <li>Pastikan data benar dan lengkap</li>
                            </ul>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="perm-card perm-submit-wrap">
                        <label class="persetujuan-label">
                            <input type="checkbox" name="persetujuan" id="persetujuan" class="check-input" required>
                            <span class="check-box"></span>
                            <span class="persetujuan-text">
                                Saya menyatakan bahwa data yang saya isi adalah <strong>benar dan dapat dipertanggungjawabkan</strong>.
                                Saya memahami bahwa penyampaian data yang tidak benar dapat dikenakan sanksi sesuai peraturan perundang-undangan yang berlaku.
                            </span>
                        </label>

                        <div class="submit-row">
                            <a href="{{ route('ppid') }}" class="btn-back">
                                <span class="material-icons">arrow_back</span>
                                Batal
                            </a>
                            <button type="submit" class="btn-submit" id="btnSubmit">
                                <span class="material-icons">send</span>
                                Kirim Permohonan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>


    @if(session('permohonan_token'))
    {{-- Modal Pop-up Token --}}
    <div class="token-modal-overlay active" id="tokenModalOverlay">
        <div class="token-modal-card">
            <div class="token-modal-icon-wrap">
                <span class="material-icons">check_circle</span>
            </div>
            <h3 class="token-modal-title">Permohonan Berhasil!</h3>
            <p class="token-modal-desc">Simpan atau catat <strong>Token Permohonan</strong> berikut untuk melakukan pengecekan status permohonan Anda.</p>
            
            <div class="token-display-box">
                <span class="token-code" id="tokenCodeText">{{ session('permohonan_token') }}</span>
                <button type="button" class="btn-copy-token" id="btnCopyToken">
                    <span class="material-icons">content_copy</span> <span id="copyText">Salin</span>
                </button>
            </div>

            <p class="token-note">* Notifikasi status permohonan juga telah dikirimkan ke alamat email Anda.</p>

            <div class="token-modal-actions">
                <button type="button" class="btn-modal-close" id="btnCloseTokenModal">Mengerti & Tutup</button>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var copyBtn = document.getElementById('btnCopyToken');
        var tokenText = document.getElementById('tokenCodeText');
        var copyLabel = document.getElementById('copyText');
        var closeBtn = document.getElementById('btnCloseTokenModal');
        var overlay = document.getElementById('tokenModalOverlay');

        if (copyBtn && tokenText) {
            copyBtn.addEventListener('click', function() {
                navigator.clipboard.writeText(tokenText.textContent.trim()).then(function() {
                    copyLabel.textContent = 'Tersalin!';
                    copyBtn.style.background = '#004F3B';
                    setTimeout(function() {
                        copyLabel.textContent = 'Salin';
                        copyBtn.style.background = '#009966';
                    }, 2000);
                });
            });
        }

        if (closeBtn && overlay) {
            closeBtn.addEventListener('click', function() {
                overlay.classList.remove('active');
            });
        }
    });
    </script>
    @endif

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        function initSelect(wrapId, btnId, lblId, listId, inputId) {
            const wrap  = document.getElementById(wrapId);
            const btn   = document.getElementById(btnId);
            const lbl   = document.getElementById(lblId);
            const list  = document.getElementById(listId);
            const input = document.getElementById(inputId);
            if (!wrap) return;

            const oldVal = input.value;
            if (oldVal) {
                const opt = list.querySelector('[data-value="' + oldVal + '"]');
                if (opt) { lbl.textContent = opt.textContent; opt.classList.add('selected'); }
            }

            btn.addEventListener('click', function (e) {
                e.stopPropagation();
                const open = wrap.classList.toggle('open');
                btn.setAttribute('aria-expanded', open);
                document.querySelectorAll('.cst-select.open').forEach(function(el) {
                    if (el !== wrap) { el.classList.remove('open'); el.querySelector('.cst-select-btn').setAttribute('aria-expanded', false); }
                });
            });

            list.querySelectorAll('.cst-option').forEach(function(opt) {
                opt.addEventListener('click', function () {
                    list.querySelectorAll('.cst-option').forEach(function(o) { o.classList.remove('selected'); });
                    this.classList.add('selected');
                    lbl.textContent = this.textContent;
                    input.value = this.dataset.value;
                    wrap.classList.remove('open');
                    btn.setAttribute('aria-expanded', false);
                });
            });
        }

        initSelect('cstJenisWrap',  'cstJenisBtn',  'cstJenisLbl',  'cstJenisList',  'cstJenisInput');
        initSelect('cstTujuanWrap', 'cstTujuanBtn', 'cstTujuanLbl', 'cstTujuanList', 'cstTujuanInput');

        document.addEventListener('click', function () {
            document.querySelectorAll('.cst-select.open').forEach(function(el) {
                el.classList.remove('open');
                el.querySelector('.cst-select-btn').setAttribute('aria-expanded', false);
            });
        });

        // ── Radio Option Toggle ────────────────────────────────────
        document.querySelectorAll('.radio-option').forEach(function(label) {
            label.addEventListener('click', function() {
                var radio = this.querySelector('.radio-input');
                var name  = radio.getAttribute('name');
                document.querySelectorAll('.radio-option input[name="' + name + '"]').forEach(function(r) {
                    r.closest('.radio-option').classList.remove('selected');
                });
                this.classList.add('selected');
                radio.checked = true;
            });
        });

        var nikInput = document.getElementById('nik');
        var nikErr = document.getElementById('nik_err');
        var noHpInput = document.getElementById('no_hp');
        var noHpErr = document.getElementById('no_hp_err');

        function validateNik() {
            var val = nikInput.value.trim();
            if (val === '') {
                nikInput.classList.remove('is-error');
                nikErr.textContent = '';
                return true;
            }
            if (!/^[0-9]+$/.test(val) || val.length !== 16) {
                nikInput.classList.add('is-error');
                nikErr.textContent = 'NIK harus 16 digit angka.';
                return false;
            } else {
                nikInput.classList.remove('is-error');
                nikErr.textContent = '';
                return true;
            }
        }

        function validateNoHp() {
            var val = noHpInput.value.trim();
            if (val === '') {
                noHpInput.classList.remove('is-error');
                noHpErr.textContent = '';
                return true;
            }
            if (!/^[0-9]+$/.test(val) || val.length < 10 || val.length > 13) {
                noHpInput.classList.add('is-error');
                noHpErr.textContent = 'Nomor HP harus berupa angka dan antara 10-13 digit.';
                return false;
            } else {
                noHpInput.classList.remove('is-error');
                noHpErr.textContent = '';
                return true;
            }
        }

        if (nikInput) {
            nikInput.addEventListener('input', validateNik);
            nikInput.addEventListener('blur', validateNik);
        }
        if (noHpInput) {
            noHpInput.addEventListener('input', validateNoHp);
            noHpInput.addEventListener('blur', validateNoHp);
        }

        document.getElementById('permohonanForm').addEventListener('submit', function (e) {
            var isNikValid = validateNik();
            var isNoHpValid = validateNoHp();

            if (nikInput && nikInput.value.trim() === '') {
                nikInput.classList.add('is-error');
                nikErr.textContent = 'NIK wajib diisi.';
                isNikValid = false;
            }
            if (noHpInput && noHpInput.value.trim() === '') {
                noHpInput.classList.add('is-error');
                noHpErr.textContent = 'Nomor HP wajib diisi.';
                isNoHpValid = false;
            }

            if (!isNikValid || !isNoHpValid) {
                e.preventDefault();
                var firstErr = document.querySelector('.field-input.is-error');
                if (firstErr) {
                    firstErr.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstErr.focus();
                }
                return false;
            }

            var btn = document.getElementById('btnSubmit');
            btn.innerHTML = '<span class="material-icons spinning">autorenew</span> Mengirim...';
            btn.disabled = true;
        });

        // ── Upload KTP ────────────────────────────────────────────
        var zone        = document.getElementById('uploadZone');
        var input       = document.getElementById('foto_ktp');
        var idle        = document.getElementById('uploadIdle');
        var preview     = document.getElementById('uploadPreview');
        var previewImg  = document.getElementById('uploadPreviewImg');
        var fileName    = document.getElementById('uploadFileName');
        var browseBtn   = document.getElementById('uploadBrowseBtn');
        var removeBtn   = document.getElementById('uploadRemoveBtn');

        function showPreview(file) {
            fileName.textContent = file.name + ' (' + (file.size / 1024).toFixed(0) + ' KB)';
            if (file.type.startsWith('image/')) {
                var reader = new FileReader();
                reader.onload = function(e) { previewImg.src = e.target.result; previewImg.style.display = 'block'; };
                reader.readAsDataURL(file);
            } else {
                previewImg.style.display = 'none'; // PDF — hide img
            }
            idle.style.display    = 'none';
            preview.style.display = 'flex';
            zone.classList.add('has-file');
        }

        function clearFile() {
            input.value        = '';
            previewImg.src     = '';
            idle.style.display    = 'flex';
            preview.style.display = 'none';
            zone.classList.remove('has-file', 'drag-over');
        }

        browseBtn.addEventListener('click', function() { input.click(); });
        removeBtn.addEventListener('click', function(e) { e.stopPropagation(); clearFile(); });
        zone.addEventListener('click', function(e) {
            if (e.target === zone || e.target === idle || e.target.classList.contains('upload-title') || e.target.classList.contains('upload-hint')) {
                input.click();
            }
        });

        input.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                if (this.files[0].size > 10 * 1024 * 1024) {
                    alert('Ukuran file melebihi 10 MB.');
                    clearFile();
                    return;
                }
                showPreview(this.files[0]);
            }
        });

        zone.addEventListener('dragover', function(e) { e.preventDefault(); zone.classList.add('drag-over'); });
        zone.addEventListener('dragleave', function()  { zone.classList.remove('drag-over'); });
        zone.addEventListener('drop', function(e) {
            e.preventDefault();
            zone.classList.remove('drag-over');
            var f = e.dataTransfer.files[0];
            if (!f) return;
            var allowed = ['image/jpeg','image/png','image/webp','application/pdf'];
            if (!allowed.includes(f.type)) { alert('Format tidak didukung. Gunakan JPG, PNG, WEBP, atau PDF.'); return; }
            if (f.size > 10 * 1024 * 1024) { alert('Ukuran file melebihi 10 MB.'); return; }
            var dt = new DataTransfer(); dt.items.add(f); input.files = dt.files;
            showPreview(f);
        });
    });
    </script>
    @include('layouts.footer')
</body>
</html>
