<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Developer Sistem - Toko Madu Seribu Bunga</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #d4af37;
            --secondary-color: #b8860b;
            --dark-color: #2c3e50;
            --light-color: #fef9e7;
        }

        body {
            background-color: var(--light-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        /* ===== JUDUL ===== */
        .section-title {
            color: var(--dark-color);
            font-weight: 700;
            letter-spacing: 2px;
        }

        .section-title::before,
        .section-title::after {
            display: none !important;
            content: none !important;
        }

        /* ===== CARD DEVELOPER ===== */
        .developer-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            background: white;
            height: 100%;
        }

        .developer-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .developer-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            object-position: center top;
            border: 4px solid var(--light-color);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
        }

        .lecturer-card,
        .expert-card {
            border-top: 4px solid var(--primary-color);
        }

        .student-card {
            border-top: 4px solid #3498db;
        }

        .role-badge {
            background: var(--primary-color);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <!-- ===== SECTION DEVELOPER ===== -->
    <section class="py-5">
        <div class="container">

            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="section-title">DEVELOPER</h2>
                    <p class="text-muted mt-3">
                        Kolaborasi antara dosen, pakar madu, dan mahasiswa Informatika
                        dalam pengembangan sistem rekomendasi madu untuk kesehatan
                    </p>
                </div>
            </div>

            <!-- Dosen & Pakar -->
            <div class="row justify-content-center g-4 mb-5">

                <div class="col-md-6 col-lg-4">
                    <div class="card developer-card lecturer-card p-4 text-center">
                        <img src="assets/images/foto-bumarlin.png" class="developer-img mb-4" alt="Dosen Pembimbing">
                        <span class="role-badge">Dosen Pembimbing</span>
                        <h5 class="mt-2">Yumarlin MZ, S.Kom., M.Pd., M.Kom.</h5>
                        <p class="mb-0">
                            Pembimbing akademik dan teknis dalam pengembangan sistem
                            rekomendasi menggunakan metode Certainty Factor.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card developer-card expert-card p-4 text-center">
                        <img src="assets/images/foto-agus.png" class="developer-img mb-4" alt="Pakar Jenis Madu">
                        <span class="role-badge">Pakar Jenis Madu</span>
                        <h5 class="mt-2">Agus</h5>
                        <p class="mb-0">
                            Pakar dalam bidang jenis dan manfaat madu sebagai sumber
                            pengetahuan dalam penentuan nilai Certainty Factor.
                        </p>
                    </div>
                </div>

            </div>

            <!-- Mahasiswa -->
            <div class="row g-4">

                <div class="col-md-6 col-lg-4">
                    <div class="card developer-card student-card p-4 text-center">
                        <img src="assets/images/foto-bayu.png" class="developer-img mb-4" alt="Bayu Prasetyo">
                        <span class="role-badge">Mahasiswa Informatika</span>
                        <h5 class="mt-2">Bayu Prasetyo</h5>
                        <p class="mb-0">
                            Bertanggung jawab dalam pengembangan Back End, Front End,
                            dan implementasi algoritma Certainty Factor.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card developer-card student-card p-4 text-center">
                        <img src="assets/images/foto-gunung.png" class="developer-img mb-4" alt="Gunung Ramadhan">
                        <span class="role-badge">Mahasiswa Informatika</span>
                        <h5 class="mt-2">Gunung Ramadhan</h5>
                        <p class="mb-0">Membantu penghitungan metode Certainty Factor.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card developer-card student-card p-4 text-center">
                        <img src="assets/images/foto-ridho.png" class="developer-img mb-4" alt="Muhammad Ridho">
                        <span class="role-badge">Mahasiswa Informatika</span>
                        <h5 class="mt-2">Muhammad Ridho</h5>
                        <p class="mb-0">Membantu pengelolaan database sistem.</p>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>