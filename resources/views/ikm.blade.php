<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Indeks Kepuasan Masyarakat - Dinkes Cianjur</title>

    {{-- Google Fonts: Plus Jakarta Sans --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    {{-- Material Icons --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #F8FAFC; margin: 0; padding: 0; }
        .ikm-container { max-width: 1000px; margin: 60px auto; padding: 0 20px; }
        .ikm-header { text-align: center; margin-bottom: 40px; }
        .ikm-header .subtitle { color: #009966; font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; }
        .ikm-header h1 { font-size: 36px; color: #004F3B; font-weight: 800; margin: 10px 0; }
        .ikm-header p { color: #64748B; font-size: 16px; max-width: 600px; margin: 0 auto; line-height: 1.5; }
        
        .ikm-card { background: #FFFFFF; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); padding: 40px; }
        
        .form-row { display: flex; gap: 20px; margin-bottom: 24px; flex-wrap: wrap; }
        .form-group { flex: 1; min-width: 200px; }
        .form-label { display: block; font-weight: 600; color: #1E293B; margin-bottom: 8px; font-size: 14px; }
        .form-control { width: 100%; padding: 12px 16px; border: 1px solid #E2E8F0; border-radius: 8px; font-size: 15px; color: #1E293B; font-family: inherit; transition: all 0.2s; box-sizing: border-box; }
        .form-control:focus { outline: none; border-color: #009966; box-shadow: 0 0 0 3px rgba(0,153,102,0.1); }
        
        .rating-group { display: flex; gap: 10px; margin-bottom: 24px; flex-wrap: wrap; }
        .rating-option {
            flex: 1; min-width: 120px; border: 1px solid #E2E8F0; border-radius: 8px; padding: 16px 10px; text-align: center;
            cursor: pointer; transition: all 0.2s; display: flex; flex-direction: column; align-items: center; gap: 8px;
            background: #fff;
        }
        .rating-option:hover { border-color: #009966; background: #F0FDF4; }
        .rating-option.active { border-color: #009966; background: #F0FDF4; box-shadow: 0 0 0 1px #009966; }
        .rating-option .material-icons { font-size: 32px; color: #94A3B8; transition: color 0.2s; }
        .rating-option.active .material-icons { color: #009966; }
        .rating-option .rating-text { font-size: 14px; font-weight: 600; color: #475569; }
        .rating-option.active .rating-text { color: #009966; }
        
        /* Hide radio buttons */
        input[type="radio"][name="rating"] { display: none; }
        
        .btn-submit { width: 100%; background: #009966; color: #fff; border: none; padding: 16px; border-radius: 8px; font-size: 16px; font-weight: 700; cursor: pointer; transition: background 0.2s; font-family: inherit; }
        .btn-submit:hover { background: #007A52; }
        .btn-submit:disabled { background: #94A3B8; cursor: not-allowed; }
        
        .alert { padding: 16px; border-radius: 8px; margin-bottom: 24px; font-weight: 500; }
        .alert-success { background: #F0FDF4; color: #166534; border: 1px solid #BBF7D0; }
        .alert-error { background: #FEF2F2; color: #991B1B; border: 1px solid #FECACA; }
        
        @media (max-width: 768px) {
            .ikm-card { padding: 24px; }
            .form-row { flex-direction: column; gap: 16px; }
            .rating-option { min-width: 48%; }
        }
    </style>
</head>
<body>
    @include('layouts.navbar')

    <div class="ikm-container">
        <div class="ikm-header">
            <div class="subtitle">Indeks Kepuasan Masyarakat</div>
            <h1>Bantu Kami Melayani Lebih Baik</h1>
            <p>Penilaian Anda sangat berharga untuk meningkatkan mutu pelayanan kesehatan di Kabupaten Cianjur.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <span class="material-icons" style="vertical-align: middle; margin-right: 8px;">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <span class="material-icons" style="vertical-align: middle; margin-right: 8px;">error</span>
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="ikm-card">
            <form action="{{ route('ikm.store') }}" method="POST" id="ikmForm">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap (Opsional)</label>
                        <input type="text" name="name" class="form-control" placeholder="Nama Lengkap Anda" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nomor WhatsApp</label>
                        <input type="number" name="whatsapp" class="form-control" placeholder="Contoh: 081234567xxx" value="{{ old('whatsapp') }}">
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 12px;">
                    <label class="form-label">Bagaimana kualitas pelayanan Faskes/Dinkes Cianjur menurut Anda?</label>
                </div>
                
                <div class="rating-group">
                    <label class="rating-option" id="opt_sangat_puas">
                        <input type="radio" name="rating" value="sangat_puas" required>
                        <span class="material-icons">sentiment_very_satisfied</span>
                        <span class="rating-text">Sangat Puas</span>
                    </label>
                    <label class="rating-option" id="opt_puas">
                        <input type="radio" name="rating" value="puas">
                        <span class="material-icons">sentiment_satisfied</span>
                        <span class="rating-text">Puas</span>
                    </label>
                    <label class="rating-option" id="opt_cukup">
                        <input type="radio" name="rating" value="cukup">
                        <span class="material-icons">sentiment_neutral</span>
                        <span class="rating-text">Cukup</span>
                    </label>
                    <label class="rating-option" id="opt_kurang">
                        <input type="radio" name="rating" value="kurang">
                        <span class="material-icons">sentiment_dissatisfied</span>
                        <span class="rating-text">Kurang</span>
                    </label>
                </div>

                <div class="form-group" style="margin-bottom: 24px;">
                    <label class="form-label">Masukan dan Keluhan</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Tulis masukan atau keluhan Anda di sini.....">{{ old('description') }}</textarea>
                </div>

                <button type="submit" class="btn-submit" id="btnSubmit">Kirim Penilaian Real-Time</button>
            </form>
        </div>
    </div>

    @include('layouts.footer')

    <script>
        // Handle rating visual selection
        const ratingOptions = document.querySelectorAll('.rating-option');
        const radios = document.querySelectorAll('input[name="rating"]');

        ratingOptions.forEach(option => {
            option.addEventListener('click', function() {
                // Remove active class from all
                ratingOptions.forEach(opt => opt.classList.remove('active'));
                // Add active class to clicked
                this.classList.add('active');
            });
        });

        // Handle single click submit
        document.getElementById('ikmForm').addEventListener('submit', function() {
            const btn = document.getElementById('btnSubmit');
            btn.innerHTML = '<span class="material-icons" style="animation: spin 1s linear infinite; vertical-align: middle;">autorenew</span> Mengirim...';
            btn.disabled = true;
        });
    </script>
    <style>
        @keyframes spin { 100% { transform: rotate(360deg); } }
    </style>
</body>
</html>
