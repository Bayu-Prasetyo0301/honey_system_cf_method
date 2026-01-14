<section class="hero-section">
    <!-- Background Image -->
    <div class="hero-bg">
        <img src="assets/images/madu/banner-new.png"
            alt="Background Madu" class="hero-background">
        <div class="hero-overlay"></div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center text-white">
                <h1 class="display-4 fw-bold mb-4">Sistem Rekomendasi Jenis Madu untuk Kesehatan</h1>
                <p class="lead mb-4">Temukan jenis madu yang tepat untuk kondisi kesehatan Anda menggunakan metode Certainty Factor</p>
                <a href="?page=konsultasi" class="btn btn-warning btn-lg px-5 py-3">
                    <i class="fas fa-stethoscope me-2"></i>Konsultasi Sekarang
                </a>
                <!-- BUTTON KE MANFAAT MADU -->
                <a href="#manfaat-madu" class="btn btn-outline-light btn-lg px-5 py-3">
                    <i class="fas fa-chevron-down me-2"></i>Manfaat Madu
                </a>

            </div>
        </div>
    </div>
</section>

<style>
    .hero-section {
        position: relative;
        color: white;
        /* Tetap putih agar kontras dengan teks shadow */
        padding: 150px 0;
        text-align: center;
        overflow: hidden;
        min-height: 100vh;
        display: flex;
        align-items: center;
    }

    .hero-bg {
        /* MENGHILANGKAN linear-gradient hitam/gelap di sini */
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
    }

    .hero-background {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        filter: brightness(1.1) contrast(1.05);
    }

    .hero-overlay {
        display: none;
    }

    .hero-section h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        line-height: 1.2;
        color: #d4af37;
    }

    .hero-section h1,
    .hero-section p {
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
    }

    .hero-section .lead {
        color: #333;
        font-size: 1.4rem;
        margin-bottom: 2.5rem;
        font-weight: 500;
        line-height: 1.6;
    }

    .btn-warning {
        background: linear-gradient(135deg, #d4af37, #b8860b);
        border: none;
        font-weight: 600;
        padding: 15px 40px;
        border-radius: 50px;
        transition: all 0.3s ease;
        font-size: 1.2rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-warning:hover {
        background: linear-gradient(135deg, #b8860b, #996515);
        transform: translateY(-3px) scale(1.05);
    }

    /* Animasi untuk konten */
    .hero-section .container {
        animation: fadeInUp 1s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .hero-section {
            padding: 100px 0;
            min-height: 80vh;
        }

        .hero-section h1 {
            font-size: 2.3rem;
            margin-bottom: 1rem;
        }

        .hero-section .lead {
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }

        .btn-warning {
            padding: 12px 30px;
            font-size: 1rem;
        }
    }

    @media (max-width: 576px) {
        .hero-section h1 {
            font-size: 2rem;
        }

        .hero-section .lead {
            font-size: 1rem;
        }

        .btn-warning {
            padding: 10px 25px;
            font-size: 0.9rem;
        }
    }
</style>

<style>
    /* VARIABEL WARNA */
    :root {
        --honey-gold: #d4af37;
        --honey-dark: #b8860b;
        --soft-bg: #fefcf3;
    }

    /* HERO STYLING */
    .hero-section {
        position: relative;
        min-height: 90vh;
        display: flex;
        align-items: center;
        overflow: hidden;
    }

    .hero-bg {
        position: absolute;
        inset: 0;
        z-index: -1;
    }

    .hero-background {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: brightness(1.05);
        /* Gambar tetap jernih */
    }

    .hero-content-box {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(8px);
        padding: 3rem;
        border-radius: 30px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .hero-title {
        font-size: 3rem;
        font-weight: 800;
        color: #2c3e50;
        margin-bottom: 1.5rem;
        line-height: 1.2;
    }

    .hero-subtitle {
        color: #555 !important;
        font-size: 1.25rem;
    }

    .btn-honey-main {
        background: linear-gradient(135deg, var(--honey-gold), var(--honey-dark));
        color: white;
        padding: 18px 45px;
        border-radius: 50px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        border: none;
        box-shadow: 0 10px 20px rgba(184, 134, 11, 0.3);
        transition: all 0.4s;
    }

    .btn-honey-main:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(184, 134, 11, 0.4);
        color: white;
    }

    /* CARD STYLING */
    .text-honey {
        color: var(--honey-gold);
    }

    .honey-divider {
        width: 80px;
        height: 4px;
        background: var(--honey-gold);
        border-radius: 10px;
    }

    .product-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        transition: all 0.4s ease;
    }

    .product-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
    }

    .product-img-container {
        position: relative;
        overflow: hidden;
        height: 250px;
        background: #f9f9f9;
    }

    .product-img-container img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 20px;
        transition: transform 0.6s ease;
    }

    .product-card:hover .product-img-container img {
        transform: scale(1.1);
    }

    .product-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: var(--honey-gold);
        color: white;
        padding: 5px 12px;
        border-radius: 10px;
        font-weight: 800;
        font-size: 0.8rem;
    }

    .product-name {
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 10px;
    }

    .product-desc {
        font-size: 0.9rem;
        color: #777;
        line-height: 1.5;
        height: 4.5em;
        overflow: hidden;
    }

    .price-tag {
        font-size: 1.25rem;
        font-weight: 800;
        color: #e67e22;
    }

    .size-info {
        background: #f1f2f6;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 700;
        color: #666;
    }

    /* ALERT STYLING */
    .honey-alert {
        background: #fff9e6;
        border: 1px dashed var(--honey-gold);
        border-radius: 20px;
        padding: 20px 30px;
    }

    .alert-icon-circle {
        width: 50px;
        height: 50px;
        background: var(--honey-gold);
        border-radius: 50%;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    /* ANIMATION */
    .container {
        animation: fadeInUp 0.8s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<style>
    /* VARIABEL WARNA */
    :root {
        --honey-gold: #d4af37;
        --honey-dark: #b8860b;
        --soft-bg: #fefcf3;
    }

    /* HERO STYLING */
    .hero-section {
        position: relative;
        min-height: 90vh;
        display: flex;
        align-items: center;
        overflow: hidden;
    }

    .hero-bg {
        position: absolute;
        inset: 0;
        z-index: -1;
    }

    .hero-background {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: brightness(1.05);
        /* Gambar tetap jernih */
    }

    .hero-content-box {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(8px);
        padding: 3rem;
        border-radius: 30px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .hero-title {
        font-size: 3rem;
        font-weight: 800;
        color: #2c3e50;
        margin-bottom: 1.5rem;
        line-height: 1.2;
    }

    .hero-subtitle {
        color: #555 !important;
        font-size: 1.25rem;
    }

    .btn-honey-main {
        background: linear-gradient(135deg, var(--honey-gold), var(--honey-dark));
        color: white;
        padding: 18px 45px;
        border-radius: 50px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        border: none;
        box-shadow: 0 10px 20px rgba(184, 134, 11, 0.3);
        transition: all 0.4s;
    }

    .btn-honey-main:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(184, 134, 11, 0.4);
        color: white;
    }

    /* CARD STYLING */
    .text-honey {
        color: var(--honey-gold);
    }

    .honey-divider {
        width: 80px;
        height: 4px;
        background: var(--honey-gold);
        border-radius: 10px;
    }

    .product-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        transition: all 0.4s ease;
    }

    .product-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
    }

    .product-img-container {
        position: relative;
        overflow: hidden;
        height: 250px;
        background: #f9f9f9;
    }

    .product-img-container img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 20px;
        transition: transform 0.6s ease;
    }

    .product-card:hover .product-img-container img {
        transform: scale(1.1);
    }

    .product-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: var(--honey-gold);
        color: white;
        padding: 5px 12px;
        border-radius: 10px;
        font-weight: 800;
        font-size: 0.8rem;
    }

    .product-name {
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 10px;
    }

    .product-desc {
        font-size: 0.9rem;
        color: #777;
        line-height: 1.5;
        height: 4.5em;
        overflow: hidden;
    }

    .price-tag {
        font-size: 1.25rem;
        font-weight: 800;
        color: #e67e22;
    }

    .size-info {
        background: #f1f2f6;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 700;
        color: #666;
    }

    /* ALERT STYLING */
    .honey-alert {
        background: #fff9e6;
        border: 1px dashed var(--honey-gold);
        border-radius: 20px;
        padding: 20px 30px;
    }

    .alert-icon-circle {
        width: 50px;
        height: 50px;
        background: var(--honey-gold);
        border-radius: 50%;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    /* ANIMATION */
    .container {
        animation: fadeInUp 0.8s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* VARIABEL WARNA */
    :root {
        --honey-gold: #d4af37;
        --honey-dark: #b8860b;
        --soft-bg: #fefcf3;
    }

    /* HERO STYLING */
    .hero-section {
        position: relative;
        min-height: 90vh;
        display: flex;
        align-items: center;
        overflow: hidden;
    }

    .hero-bg {
        position: absolute;
        inset: 0;
        z-index: -1;
    }

    .hero-background {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: brightness(1.05);
        /* Gambar tetap jernih */
    }

    .hero-content-box {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(8px);
        padding: 3rem;
        border-radius: 30px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .hero-title {
        font-size: 3rem;
        font-weight: 800;
        color: #2c3e50;
        margin-bottom: 1.5rem;
        line-height: 1.2;
    }

    .hero-subtitle {
        color: #555 !important;
        font-size: 1.25rem;
    }

    .btn-honey-main {
        background: linear-gradient(135deg, var(--honey-gold), var(--honey-dark));
        color: white;
        padding: 18px 45px;
        border-radius: 50px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        border: none;
        box-shadow: 0 10px 20px rgba(184, 134, 11, 0.3);
        transition: all 0.4s;
    }

    .btn-honey-main:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(184, 134, 11, 0.4);
        color: white;
    }

    /* CARD STYLING */
    .text-honey {
        color: var(--honey-gold);
    }

    .honey-divider {
        width: 80px;
        height: 4px;
        background: var(--honey-gold);
        border-radius: 10px;
    }

    .product-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        transition: all 0.4s ease;
    }

    .product-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
    }

    .product-img-container {
        position: relative;
        overflow: hidden;
        height: 250px;
        background: #f9f9f9;
    }

    .product-img-container img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 20px;
        transition: transform 0.6s ease;
    }

    .product-card:hover .product-img-container img {
        transform: scale(1.1);
    }

    .product-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: var(--honey-gold);
        color: white;
        padding: 5px 12px;
        border-radius: 10px;
        font-weight: 800;
        font-size: 0.8rem;
    }

    .product-name {
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 10px;
    }

    .product-desc {
        font-size: 0.9rem;
        color: #777;
        line-height: 1.5;
        height: 4.5em;
        overflow: hidden;
    }

    .price-tag {
        font-size: 1.25rem;
        font-weight: 800;
        color: #e67e22;
    }

    .size-info {
        background: #f1f2f6;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 700;
        color: #666;
    }

    /* ALERT STYLING */
    .honey-alert {
        background: #fff9e6;
        border: 1px dashed var(--honey-gold);
        border-radius: 20px;
        padding: 20px 30px;
    }

    .alert-icon-circle {
        width: 50px;
        height: 50px;
        background: var(--honey-gold);
        border-radius: 50%;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    /* ANIMATION */
    .container {
        animation: fadeInUp 0.8s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

</style>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-lg-8 mx-auto">
                <h2 class="fw-bold text-warning">Manfaat Madu untuk Kesehatan</h2>
                <p class="text-muted">Setiap jenis madu memiliki khasiat unik yang berbeda-beda</p>
            </div>
        </div>

        <div class="row g-4">

            <!-- M01 -->
            <div class="col-md-6 col-lg-4">
                <div class="card solution-card h-100">
                    <img src="assets/images/madu/madu-kelengkeng.png" alt="Madu Kelengkeng">
                    <div class="card-body p-4">
                        <span class="honey-badge">
                            <h4>M01</h4>
                        </span>
                        <h5 class="card-title">Madu Kelengkeng</h5>
                        <p class="card-text text-muted">
                            Meningkatkan stamina dan energi tubuh karena kandungan glukosa dan fruktosa alami,
                            menjaga kesehatan jantung berkat antioksidan flavonoid,
                            menenangkan sistem saraf dan membantu tidur lebih nyenyak,
                            meningkatkan daya tahan tubuh terhadap infeksi ringan
                        </p>
                        <div>
                            <span class="badge bg-warning text-dark">Rp 41.000 / 250 ML</span>

                        </div>
                    </div>
                </div>
            </div>

            <!-- M02 -->
            <div class="col-md-6 col-lg-4">
                <div class="card solution-card h-100">
                    <img src="assets/images/madu/madu-randu.png" alt="Madu Randu">
                    <div class="card-body p-4">
                        <span class="honey-badge">
                            <h4>M02</h4>
                        </span>
                        <h5 class="card-title">Madu Randu</h5>
                        <p class="card-text text-muted">
                            Meredakan batuk dan pilek secara alami,
                            menurunkan kadar kolesterol dan menjaga kesehatan jantung,
                            melembabkan dan mencerahkan kulit jika digunakan sebagai masker alami,
                            bersifat antibakteri dan membantu penyembuhan luka
                        </p>
                        <div>
                            <span class="badge bg-warning text-dark">Rp 39.000 / 250 ML</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- M03 -->
            <div class="col-md-6 col-lg-4">
                <div class="card solution-card h-100">
                    <img src="assets/images/madu/madu-kopi.png" alt="Madu Kopi">
                    <div class="card-body p-4">
                        <span class="honey-badge">
                            <h4>M03</h4>
                        </span>
                        <h5 class="card-title">Madu Kopi</h5>
                        <p class="card-text text-muted">
                            Antioksidan tinggi yang membantu melawan radikal bebas,
                            meningkatkan konsentrasi dan fokus,
                            menurunkan risiko penyakit degeneratif seperti diabetes dan hipertensi,
                            membantu detoksifikasi hati
                        </p>
                        <div>
                            <span class="badge bg-warning text-dark">Rp 39.000 / 250 ML</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- M04 -->
            <div class="col-md-6 col-lg-4">
                <div class="card solution-card h-100">
                    <img src="assets/images/madu/madu-hutan.png" alt="Madu Hutan">
                    <div class="card-body p-4">
                        <span class="honey-badge">
                            <h4>M04</h4>
                        </span>
                        <h5 class="card-title">Madu Hutan</h5>
                        <p class="card-text text-muted">
                            Efek antibakteri dan antiradang yang kuat,
                            meningkatkan sistem imun secara menyeluruh,
                            membantu penyembuhan luka dan infeksi kulit,
                            mengandung mineral penting seperti magnesium, fosfor, dan zinc
                        </p>
                        <div>
                            <span class="badge bg-warning text-dark">Rp 44.000 / 250 ML</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- M05 -->
            <div class="col-md-6 col-lg-4">
                <div class="card solution-card h-100">
                    <img src="assets/images/madu/madu-multiflora.png" alt="Madu Multiflora">
                    <div class="card-body p-4">
                        <span class="honey-badge">
                            <h4>M05</h4>
                        </span>
                        <h5 class="card-title">Madu Multiflora</h5>
                        <p class="card-text text-muted">
                            Cocok untuk semua usia karena sifatnya yang netral,
                            menyeimbangkan metabolisme tubuh,
                            meningkatkan fungsi pencernaan dan mengatasi gangguan ringan seperti kembung,
                            mendukung pertumbuhan anak karena kandungan nutrisi
                        </p>
                        <div>
                            <span class="badge bg-warning text-dark">Rp 43.000 / 250 ML</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- M06 -->
            <div class="col-md-6 col-lg-4">
                <div class="card solution-card h-100">
                    <img src="assets/images/madu/madu-propolis.png" alt="Madu Propolis">
                    <div class="card-body p-4">
                        <span class="honey-badge">
                            <h4>M06</h4>
                        </span>
                        <h5 class="card-title">Madu Propolis</h5>
                        <p class="card-text text-muted">
                            Antivirus dan antibakteri kuat cocok untuk infeksi saluran napas,
                            meningkatkan regenerasi sel dan mempercepat penyembuhan luka,
                            menurunkan risiko kanker berkat kandungan flavonoid dan asam fenolik,
                            meningkatkan imunitas tubuh secara signifikan
                        </p>
                        <div>
                            <span class="badge bg-warning text-dark">Rp 68.000 / 250 ML</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <!-- Additional Information -->
        <div class="row mt-5">
            <div class="col-lg-10 mx-auto">
                <div class="alert alert-warning text-center">
                    <h5><i class="fas fa-info-circle me-2"></i>Tips Konsumsi Madu yang Tepat</h5>
                    <p class="mb-0">Konsumsi madu sesuai anjuran untuk setiap jenis. <strong>Hindari pemanasan di atas 40°C</strong> untuk menjaga kandungan enzim dan nutrisinya. Simpan di tempat sejuk dan kering.</p>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="row mt-4">
            <div class="col-lg-8 mx-auto text-center">
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="?page=konsultasi" class="btn btn-warning btn-lg">
                        <i class="fas fa-stethoscope me-2"></i>Konsultasi Gratis
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .honey-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        background: white;
        border-top: 4px solid transparent;
    }

    .honey-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        border-top: 4px solid #d4af37;
    }

    .feature-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #d4af37, #b8860b);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
        box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
    }

    .benefits-list {
        text-align: left;
        margin: 15px 0;
    }

    .benefits-list small {
        font-size: 0.85rem;
    }

    .consumption-tips {
        background: #f8f9fa;
        padding: 10px;
        border-radius: 8px;
        border-left: 3px solid #d4af37;
    }

    .card-img-top.rounded-circle {
        border: 3px solid #f8f9fa;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }

    .badge.bg-warning {
        font-size: 1rem;
        padding: 8px 15px;
        font-weight: 600;
    }

    .btn-warning {
        background-color: #d4af37;
        border-color: #d4af37;
        font-weight: 600;
    }

    .btn-warning:hover {
        background-color: #b8860b;
        border-color: #b8860b;
    }
</style>