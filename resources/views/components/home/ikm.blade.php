<link rel="stylesheet" href="{{ asset('css/home/ikm.css') }}?v={{ time() }}">

<section class="ikm-section">
    <div class="ikm-container">
        
        <!-- Header -->
        <div class="ikm-header">
            <span class="ikm-tag">Indeks Kepuasan Masyarakat</span>
            <h2 class="ikm-title">Bantu Kami Melayani Lebih Baik</h2>
            <p class="ikm-subtitle">Penilaian Anda sangat berharga untuk meningkatkan mutu pelayanan kesehatan di Kabupaten Cianjur.</p>
        </div>

        <!-- Content Area: Left (Illustration) & Right (Form Card) -->
        <div class="ikm-content-grid">
            
            <!-- Left Side: Illustration Image with background shape -->
            <div class="ikm-left">
                <img src="{{ asset('Assets/home/ikm/Union.png') }}" alt="Background Shape" class="ikm-bg-shape">
                <img src="{{ asset('Assets/home/ikm/feedback_illustration.png') }}" alt="Feedback Illustration" class="ikm-illustration">
            </div>

            <!-- Right Side: Form Card -->
            <div class="ikm-right">
                @if(session('success'))
                    <div style="background: #F0FDF4; border: 1px solid #BBF7D0; color: #166534; padding: 12px 16px; border-radius: 8px; margin-bottom: 16px; font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 8px;">
                        <span class="material-icons" style="font-size: 18px;">check_circle</span>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div style="background: #FEF2F2; border: 1px solid #FECACA; color: #991B1B; padding: 12px 16px; border-radius: 8px; margin-bottom: 16px; font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 8px;">
                        <span class="material-icons" style="font-size: 18px;">error</span>
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div style="background: #FEF2F2; border: 1px solid #FECACA; color: #991B1B; padding: 12px 16px; border-radius: 8px; margin-bottom: 16px; font-size: 13px;">
                        <ul style="margin: 0; padding-left: 16px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('ikm.store') }}" method="POST" class="ikm-form-card" id="homeIkmForm">
                    @csrf
                    <!-- Row 1: Nama & WhatsApp -->
                    <div class="form-row-2">
                        <div class="form-group">
                            <label class="form-label" for="ikm-name">Nama Lengkap (Opsional)</label>
                            <input type="text" name="name" id="ikm-name" class="form-input" placeholder="Nama Lengkap Anda" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="ikm-wa">Nomor WhatsApp</label>
                            <input type="number" name="whatsapp" id="ikm-wa" class="form-input" placeholder="Contoh: 081234567xxx" value="{{ old('whatsapp') }}">
                        </div>
                    </div>
 
                    <!-- Row 2: Rating Buttons -->
                    <div class="form-group">
                        <label class="form-label">Bagaimana kualitas pelayanan Faskes/Dinkes Cianjur menurut Anda?</label>
                        <input type="hidden" name="rating" id="ikm-rating-value" required>
                        <div class="rating-btn-group">
                            <button type="button" class="rating-btn" data-value="sangat_puas" onclick="selectRating(this)">Sangat Puas</button>
                            <button type="button" class="rating-btn" data-value="puas" onclick="selectRating(this)">Puas</button>
                            <button type="button" class="rating-btn" data-value="cukup" onclick="selectRating(this)">Cukup</button>
                            <button type="button" class="rating-btn" data-value="kurang" onclick="selectRating(this)">Kurang</button>
                        </div>
                    </div>
 
                    <!-- Row 3: Message Textarea -->
                    <div class="form-group">
                        <label class="form-label" for="ikm-message">Masukan dan Keluhan</label>
                        <textarea name="description" id="ikm-message" class="form-textarea" placeholder="Tulis masukan atau keluhan Anda di sini.....">{{ old('description') }}</textarea>
                    </div>
 
                    <!-- Submit Button -->
                    <button type="submit" class="submit-btn" id="homeIkmSubmitBtn">Kirim Penilaian Real-Time</button>
                </form>
            </div>
 
        </div>
 
    </div>
</section>
 
<script>
function selectRating(button) {
    // Remove active class from all buttons in the same group
    const buttons = button.parentElement.querySelectorAll('.rating-btn');
    buttons.forEach(btn => btn.classList.remove('active'));
    // Add active class to clicked button
    button.classList.add('active');
    // Set value of hidden input
    document.getElementById('ikm-rating-value').value = button.getAttribute('data-value');
}

// Single click submit
document.getElementById('homeIkmForm').addEventListener('submit', function(e) {
    const ratingVal = document.getElementById('ikm-rating-value').value;
    if (!ratingVal) {
        e.preventDefault();
        alert('Silakan pilih salah satu opsi tingkat kepuasan Anda terlebih dahulu.');
        return false;
    }
    
    const btn = document.getElementById('homeIkmSubmitBtn');
    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Mengirim...';
    btn.disabled = true;
});
</script>
