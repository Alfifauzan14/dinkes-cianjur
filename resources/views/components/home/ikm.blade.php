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
                <form class="ikm-form-card" onsubmit="event.preventDefault(); alert('Terima kasih atas penilaian Anda!');">
                    
                    <!-- Row 1: Nama & WhatsApp -->
                    <div class="form-row-2">
                        <div class="form-group">
                            <label class="form-label" for="ikm-name">Nama Lengkap (Opsional)</label>
                            <input type="text" id="ikm-name" class="form-input" placeholder="Nama Lengkap Anda">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="ikm-wa">Nomor WhatsApp</label>
                            <input type="text" id="ikm-wa" class="form-input" placeholder="Contoh: 081234567xxx">
                        </div>
                    </div>

                    <!-- Row 2: Rating Buttons -->
                    <div class="form-group">
                        <label class="form-label">Bagaimana kualitas pelayanan Faskes/Dinkes Cianjur menurut Anda?</label>
                        <div class="rating-btn-group">
                            <button type="button" class="rating-btn" onclick="selectRating(this)">Sangat Puas</button>
                            <button type="button" class="rating-btn" onclick="selectRating(this)">Puas</button>
                            <button type="button" class="rating-btn" onclick="selectRating(this)">Cukup</button>
                            <button type="button" class="rating-btn" onclick="selectRating(this)">Kurang</button>
                        </div>
                    </div>

                    <!-- Row 3: Message Textarea -->
                    <div class="form-group">
                        <label class="form-label" for="ikm-message">Masukan dan Keluhan</label>
                        <textarea id="ikm-message" class="form-textarea" placeholder="Tulis masukan atau keluhan Anda di sini....."></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="submit-btn">Kirim Penilaian Real-Time</button>
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
}
</script>
