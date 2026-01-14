<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gejala & Solusi - Toko Madu Seribu Bunga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #d4af37;
            --secondary-color: #b8860b;
            --accent-color: #f1c40f;
            --dark-color: #2c3e50;
            --light-color: #fef9e7;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .nav-logo {
            font-weight: 700;
            color: var(--dark-color);
        }

        .nav-logo i {
            color: var(--primary-color);
        }

        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)),
                url("assets/images/gejala/banner.png");

            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
            text-align: center;
        }

        .section-title {
            position: relative;
            padding-bottom: 15px;
            margin-bottom: 40px;
            text-align: center;
            color: var(--dark-color);
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: var(--primary-color);
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .symptom-card {
            border-left: 4px solid #e74c3c;
        }

        .solution-card {
            border-left: 4px solid #27ae60;
        }

        .symptom-icon {
            width: 60px;
            height: 60px;
            background: #ffeaea;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            color: #e74c3c;
            font-size: 1.5rem;
        }

        .solution-icon {
            width: 60px;
            height: 60px;
            background: #e8f5e8;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            color: #27ae60;
            font-size: 1.5rem;
        }

        .honey-badge {
            background: var(--primary-color);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 10px;
        }

        .btn-warning {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            font-weight: 600;
            padding: 10px 25px;
            border-radius: 25px;
            transition: all 0.3s;
        }

        .btn-warning:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            transform: translateY(-2px);
        }

        .info-box {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
        }

        .benefit-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .benefit-icon {
            background: var(--light-color);
            color: var(--primary-color);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
        }

        footer {
            background: var(--dark-color);
            color: white;
            padding: 50px 0 20px;
            margin-top: 50px;
        }

        .footer-title {
            color: var(--accent-color);
            margin-bottom: 20px;
        }

        .social-icons a {
            width: 40px;
            height: 40px;
            background: #34495e;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            color: white;
            text-decoration: none;
            transition: all 0.3s;
        }

        .social-icons a:hover {
            background: var(--primary-color);
            transform: translateY(-5px);
        }

        .consultation-cta {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 50px 0;
            border-radius: 15px;
            margin: 50px 0;
        }

        /* CARD UTAMA */
        .symptom-card {
            display: flex;
            flex-direction: column;
            height: 100%;
            border-radius: 15px;
            overflow: hidden;
            /* PENTING: supaya gambar tidak keluar */
        }

        /* GAMBAR GEJALA */
        .symptom-card .symptom-img {
            width: 100%;
            height: 180px;
            /* SEMUA GAMBAR SAMA TINGGI */
            object-fit: cover;
            /* POTONG RAPI */
            display: block;
        }

        /* BODY CARD */
        .symptom-card .card-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 1.25rem;
        }

        /* JUDUL GEJALA */
        .symptom-card h5 {
            min-height: 48px;
            /* JUDUL SEJAJAR */
            margin-top: 8px;
        }

        /* DESKRIPSI GEJALA */
        .symptom-info {
            font-size: 0.9rem;
            color: #555;
            margin-top: 6px;
            flex-grow: 1;
            /* ISI RUANG TENGAH */
        }

        /* TEKS SOLUSI DI BAWAH */
        .solution-text {
            font-size: 0.85rem;
            margin-top: auto;
            /* SELALU DI BAWAH */
            color: #2c3e50;
            font-weight: 500;
        }
    </style>
</head>

<body>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center justify-content-center">

                <!-- TEKS -->
                <div class="col-lg-6 text-center text-lg-start mb-4 mb-lg-0">
                    <h1 class="display-4 fw-bold mb-4">Gejala & Solusi Kesehatan</h1>
                    <p class="lead mb-4">
                        Temukan solusi madu yang tepat berdasarkan gejala kesehatan yang Anda alami
                    </p>
                    <a href="?page=konsultasi" class="btn btn-warning btn-lg">
                        <i class="fas fa-stethoscope me-2"></i>Konsultasi Gratis
                    </a>
                </div>

            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2 class="section-title">Gejala Kesehatan</h2>
                    <p class="text-center text-muted mb-5">
                        Daftar gejala kesehatan yang digunakan sebagai dasar konsultasi sistem pakar
                    </p>
                </div>
            </div>

            <div class="row g-4">

                <!-- G01 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card symptom-card h-100">
                        <img src="assets/images/gejala/g01.png" class="symptom-img">
                        <div class="card-body p-4">
                            <span class="honey-badge">G01</span>
                            <h5>Batuk dan radang tenggorokan</h5>
                            <p class="symptom-info">
                                Batuk kering atau berdahak, tenggorokan terasa perih, gatal, dan nyeri saat menelan.
                            </p>
                            <p class="solution-text">
                                <strong>Solusi Madu:</strong> M02 (Madu Randu), M06 (Madu Propolis)
                            </p>
                        </div>
                    </div>
                </div>

                <!-- G02 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card symptom-card h-100">
                        <img src="assets/images/gejala/g02.png" class="symptom-img">
                        <div class="card-body p-4">
                            <span class="honey-badge">G02</span>
                            <h5>Kelelahan / stamina rendah</h5>
                            <p class="symptom-info">
                                Tubuh terasa lemas, mudah lelah, dan energi cepat habis.
                            </p>
                            <p class="solution-text">
                                <strong>Solusi Madu:</strong> M04 (Madu Hutan)
                            </p>
                        </div>
                    </div>
                </div>

                <!-- G03 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card symptom-card h-100">
                        <img src="assets/images/gejala/g03.png" class="symptom-img">
                        <div class="card-body p-4">
                            <span class="honey-badge">G03</span>
                            <h5>Daya tahan tubuh menurun</h5>
                            <p class="symptom-info">
                                Mudah terserang penyakit dan proses pemulihan tubuh melambat.
                            </p>
                            <p class="solution-text">
                                <strong>Solusi Madu:</strong> M01 (Madu Kelengkeng), M02 (Madu Randu), M04 (Madu Hutan), dan M06 (Madu Propolis)
                            </p>
                        </div>
                    </div>
                </div>

                <!-- G04 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card symptom-card h-100">
                        <img src="assets/images/gejala/g04.png" class="symptom-img">
                        <div class="card-body p-4">
                            <span class="honey-badge">G04</span>
                            <h5>Gangguan pencernaan ringan</h5>
                            <p class="symptom-info">
                                Perut kembung, mual ringan, dan ketidaknyamanan setelah makan.
                            </p>
                            <p class="solution-text">
                                <strong>Solusi Madu:</strong> M04 (Madu Hutan), M05 (Madu Multiflora)
                            </p>
                        </div>
                    </div>
                </div>

                <!-- G05 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card symptom-card h-100">
                        <img src="assets/images/gejala/g05.png" class="symptom-img">
                        <div class="card-body p-4">
                            <span class="honey-badge">G05</span>
                            <h5>Stres dan sulit tidur</h5>
                            <p class="symptom-info">
                                Sulit tidur, sering terbangun, dan tubuh terasa tidak segar.
                            </p>
                            <p class="solution-text">
                                <strong>Solusi Madu:</strong> M01 (Madu Kelengkeng)
                            </p>
                        </div>
                    </div>
                </div>

                <!-- G06 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card symptom-card h-100">
                        <img src="assets/images/gejala/g06.png" class="symptom-img">
                        <div class="card-body p-4">
                            <span class="honey-badge">G06</span>
                            <h5>Kolesterol tinggi</h5>
                            <p class="symptom-info">
                                Pegal pada tengkuk dan meningkatnya risiko gangguan jantung.
                            </p>
                            <p class="solution-text">
                                <strong>Solusi Madu:</strong> M02 (Madu Randu)
                            </p>
                        </div>
                    </div>
                </div>

                <!-- G07 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card symptom-card h-100">
                        <img src="assets/images/gejala/g07.png" class="symptom-img">
                        <div class="card-body p-4">
                            <span class="honey-badge">G07</span>
                            <h5>Konsentrasi menurun</h5>
                            <p class="symptom-info">
                                Sulit fokus dan daya ingat menurun.
                            </p>
                            <p class="solution-text">
                                <strong>Solusi Madu:</strong> M03 (Madu Kopi)
                            </p>
                        </div>
                    </div>
                </div>

                <!-- G08 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card symptom-card h-100">
                        <img src="assets/images/gejala/g08.png" class="symptom-img">
                        <div class="card-body p-4">
                            <span class="honey-badge">G08</span>
                            <h5>Detoksifikasi hati</h5>
                            <p class="symptom-info">
                                Tubuh terasa berat dan metabolisme melambat.
                            </p>
                            <p class="solution-text">
                                <strong>Solusi Madu:</strong> M03 (Madu Kopi)
                            </p>
                        </div>
                    </div>
                </div>

                <!-- G09 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card symptom-card h-100">
                        <img src="assets/images/gejala/g09.png" class="symptom-img">
                        <div class="card-body p-4">
                            <span class="honey-badge">G09</span>
                            <h5>Kekurangan kebutuhan nutrisi anak</h5>
                            <p class="symptom-info">
                                Pertumbuhan anak melambat dan daya tahan tubuh rendah.
                            </p>
                            <p class="solution-text">
                                <strong>Solusi Madu:</strong> M05 (Madu Multiflora)
                            </p>
                        </div>
                    </div>
                </div>

                <!-- G10 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card symptom-card h-100">
                        <img src="assets/images/gejala/g10.png" class="symptom-img">
                        <div class="card-body p-4">
                            <span class="honey-badge">G10</span>
                            <h5>Infeksi saluran pernapasan</h5>
                            <p class="symptom-info">
                                Batuk berat, sesak napas, dan infeksi pada saluran pernapasan.
                            </p>
                            <p class="solution-text">
                                <strong>Solusi Madu:</strong> M06 (Madu Propolis)
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- Solusi Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2 class="section-title">Jenis-jenis Madu</h2>
                    <p class="text-center text-muted mb-5">
                        Setiap jenis madu memiliki khasiat khusus berdasarkan basis pengetahuan pakar
                    </p>
                </div>
            </div>

            <div class="row g-4">

                <!-- M01 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card solution-card h-100">
                        <!-- SLOT FOTO -->
                        <img src="assets/images/madu/madu-kelengkeng.png" class="card-img-top" alt="Madu Kelengkeng">
                        <div class="card-body p-4">
                            <span class="honey-badge">M01</span>
                            <h5 class="card-title">Madu Kelengkeng</h5>
                            <p class="card-text text-muted">
                                Meningkatkan stamina dan energi tubuh karena kandungan glukosa dan fruktosa alami,
                                menjaga kesehatan jantung berkat antioksidan flavonoid,
                                menenangkan sistem saraf dan membantu tidur lebih nyenyak,
                                meningkatkan daya tahan tubuh terhadap infeksi ringan.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- M02 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card solution-card h-100">
                        <img src="assets/images/madu/madu-randu.png" class="card-img-top" alt="Madu Randu">
                        <div class="card-body p-4">
                            <span class="honey-badge">M02</span>
                            <h5 class="card-title">Madu Randu</h5>
                            <p class="card-text text-muted">
                                Meredakan batuk dan pilek secara alami,
                                menurunkan kadar kolesterol dan menjaga kesehatan jantung,
                                melembabkan dan mencerahkan kulit jika digunakan sebagai masker alami,
                                bersifat antibakteri dan membantu penyembuhan luka.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- M03 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card solution-card h-100">
                        <img src="assets/images/madu/madu-kopi.png" class="card-img-top" alt="Madu Kopi">
                        <div class="card-body p-4">
                            <span class="honey-badge">M03</span>
                            <h5 class="card-title">Madu Kopi</h5>
                            <p class="card-text text-muted">
                                Antioksidan tinggi yang membantu melawan radikal bebas,
                                meningkatkan konsentrasi dan fokus,
                                menurunkan risiko penyakit degeneratif seperti diabetes dan hipertensi,
                                membantu detoksifikasi hati.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- M04 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card solution-card h-100">
                        <img src="assets/images/madu/madu-hutan.png" class="card-img-top" alt="Madu Hutan">
                        <div class="card-body p-4">
                            <span class="honey-badge">M04</span>
                            <h5 class="card-title">Madu Hutan</h5>
                            <p class="card-text text-muted">
                                Efek antibakteri dan antiradang yang kuat,
                                meningkatkan sistem imun secara menyeluruh,
                                membantu penyembuhan luka dan infeksi kulit,
                                mengandung mineral penting seperti magnesium, fosfor, dan zinc.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- M05 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card solution-card h-100">
                        <img src="assets/images/madu/madu-multiflora.png" class="card-img-top" alt="Madu Multiflora">
                        <div class="card-body p-4">
                            <span class="honey-badge">M05</span>
                            <h5 class="card-title">Madu Multiflora</h5>
                            <p class="card-text text-muted">
                                Cocok untuk semua usia karena sifatnya yang netral,
                                menyeimbangkan metabolisme tubuh,
                                meningkatkan fungsi pencernaan dan mengatasi gangguan ringan seperti kembung,
                                mendukung pertumbuhan anak karena kandungan nutrisi.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- M06 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card solution-card h-100">
                        <img src="assets/images/madu/madu-propolis.png" class="card-img-top" alt="Madu Propolis">
                        <div class="card-body p-4">
                            <span class="honey-badge">M06</span>
                            <h5 class="card-title">Madu Propolis</h5>
                            <p class="card-text text-muted">
                                Antivirus dan antibakteri kuat cocok untuk infeksi saluran napas,
                                meningkatkan regenerasi sel dan mempercepat penyembuhan luka,
                                menurunkan risiko kanker berkat kandungan flavonoid dan asam fenolik,
                                meningkatkan imunitas tubuh secara signifikan.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- Consultation CTA -->
    <section class="consultation-cta">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h3 class="fw-bold mb-3">Masih Bingung Memilih Madu yang Tepat?</h3>
                    <p class="mb-0">Gunakan sistem konsultasi kami untuk mendapatkan rekomendasi madu yang sesuai dengan kondisi kesehatan Anda.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="?page=konsultasi" class="btn btn-light btn-lg">
                        <i class="fas fa-stethoscope me-2"></i>Konsultasi Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Info Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="info-box h-100">
                        <h4 class="mb-4"><i class="fas fa-info-circle text-warning me-2"></i>Cara Menggunakan Madu</h4>
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-temperature-low"></i>
                            </div>
                            <div>
                                <h6>Jangan Dicampur Air Panas</h6>
                                <p class="text-muted mb-0">Gunakan air hangat (maksimal 40°C) untuk menjaga enzim dan nutrisi madu</p>
                            </div>
                        </div>
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <h6>Waktu Terbaik</h6>
                                <p class="text-muted mb-0">Konsumsi pagi hari sebelum makan atau malam hari sebelum tidur</p>
                            </div>
                        </div>
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-prescription-bottle"></i>
                            </div>
                            <div>
                                <h6>Dosis yang Tepat</h6>
                                <p class="text-muted mb-0">1-2 sendok makan per hari untuk orang dewasa, sesuaikan dengan kebutuhan</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="info-box h-100">
                        <h4 class="mb-4"><i class="fas fa-lightbulb text-warning me-2"></i>Tips Pemilihan Madu</h4>
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div>
                                <h6>Madu Asli vs Palsu</h6>
                                <p class="text-muted mb-0">Madu asli tidak mudah tumpah, memiliki tekstur kental, dan aroma khas</p>
                            </div>
                        </div>
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-wine-bottle"></i>
                            </div>
                            <div>
                                <h6>Penyimpanan yang Benar</h6>
                                <p class="text-muted mb-0">Simpan di tempat sejuk dan kering, hindari sinar matahari langsung</p>
                            </div>
                        </div>
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div>
                                <h6>Masa Simpan</h6>
                                <p class="text-muted mb-0">Madu asli dapat bertahan bertahun-tahun tanpa kadaluarsa jika disimpan dengan benar</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>