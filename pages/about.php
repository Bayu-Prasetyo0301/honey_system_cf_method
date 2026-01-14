<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Toko Madu Seribu Bunga</title>
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
            background-color: var(--light-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            line-height: 1.6;
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 80px 0;
            border-radius: 0 0 30px 30px;
            margin-bottom: 40px;
        }

        .section-title {
            position: relative;
            padding-bottom: 15px;
            margin-bottom: 25px;
            color: var(--dark-color);
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: var(--primary-color);
        }

        .store-info-card {
            border-left: 4px solid var(--primary-color);
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .store-info-card i {
            color: var(--primary-color);
            margin-right: 10px;
            width: 20px;
        }

        .hours-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .day-card {
            background: white;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            border: 1px solid #eee;
            transition: transform 0.3s;
        }

        .day-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .day-card.active {
            background: var(--primary-color);
            color: white;
        }

        .day-name {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .map-container {
            border-radius: 10px;
            overflow: hidden;
            height: 300px;
            margin-top: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: var(--light-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: var(--primary-color);
            font-size: 1.5rem;
        }

        .system-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            margin-bottom: 30px;
        }

        .system-card:hover {
            transform: translateY(-10px);
        }

        .system-card .card-header {
            background: linear-gradient(135deg, var(--dark-color), #34495e);
            border-bottom: none;
            padding: 20px;
        }

        .system-card .card-body {
            padding: 30px;
        }

        .honey-badge {
            background: var(--primary-color);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .contact-link {
            color: var(--dark-color);
            text-decoration: none;
            transition: color 0.3s;
        }

        .contact-link:hover {
            color: var(--primary-color);
        }

        footer {
            background: var(--dark-color);
            color: white;
            padding: 40px 0 20px;
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
    </style>
</head>

<body>

    <!-- Project Info -->
    <div class="row mt-5">
        <div class="col-lg-10 mx-auto">
            <div class="card border-0 bg-light">
                <div class="card-body text-center p-4">
                    <h2 class="card-title text-warning mb-3">Tentang Sistem Yang Dikembangkan</h2>
                    <p class="card-text">
                        <strong>Sistem Rekomendasi Jenis Madu untuk Kesehatan</strong> dikembangkan menggunakan metode
                        <strong>Certainty Factor (CF)</strong> yang mampu menganalisis gejala kesehatan pengguna dan memberikan
                        rekomendasi jenis madu yang paling sesuai berdasarkan basis pengetahuan yang telah dibangun.
                    </p>
                </div>
            </div>
        </div>
    </div>
    </div>
    </section>

    <style>
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

        .section-title::before,
        .section-title::after {
            content: none !important;
            display: none !important;
        }
    </style>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold">Tentang Toko Madu Seribu Bunga</h1>
                    <p class="lead">Setiap botol adalah hasil seleksi ketat, menjamin kemurnian dan kualitas tinggi madu demi kesehatan keluarga Anda.</p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fas fa-honey-pot" style="font-size: 8rem; opacity: 0.8;"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container py-5">
        <!-- Store Information -->
        <div class="row mb-5">
            <div class="col-lg-8">
                <h2 class="section-title">Tentang Toko Kami</h2>
                <p class="mb-4">Toko Madu Seribu Bunga telah menjadi pilihan utama masyarakat Yogyakarta dan sekitarnya untuk mendapatkan madu alami berkualitas tinggi. Kami berkomitmen untuk menyediakan produk madu murni yang dihasilkan dari nektar beraneka ragam bunga, memberikan cita rasa yang khas dan khasiat yang optimal untuk kesehatan.</p>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="store-info-card">
                            <p><i class="fas fa-map-marker-alt"></i> <strong>Alamat:</strong> Jl. Veteran No.35 A, Muja Muju, Kec. Umbulharjo, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55164</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="store-info-card">
                            <p><i class="fas fa-phone"></i> <strong>Telepon:</strong> <a href="tel:082220939189" class="contact-link">0822-2093-9189</a></p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="store-info-card">
                            <p><i class="fas fa-envelope"></i> <strong>Email:</strong> <a href="mailto:info@maduseribubunga.com" class="contact-link">info@maduseribubunga.com</a></p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="store-info-card">
                            <p><i class="fas fa-clock"></i> <strong>Jam Operasional:</strong> Setiap Hari 07.00 - 21.00 WIB</p>
                        </div>
                    </div>
                </div>

                <h3 class="section-title mt-5">Jam Operasional</h3>
                <div class="hours-grid">
                    <div class="day-card" id="sunday">
                        <div class="day-name">Minggu</div>
                        <div class="day-hours">07.00–21.00</div>
                    </div>
                    <div class="day-card" id="monday">
                        <div class="day-name">Senin</div>
                        <div class="day-hours">07.00–21.00</div>
                    </div>
                    <div class="day-card" id="tuesday">
                        <div class="day-name">Selasa</div>
                        <div class="day-hours">07.00–21.00</div>
                    </div>
                    <div class="day-card" id="wednesday">
                        <div class="day-name">Rabu</div>
                        <div class="day-hours">07.00–21.00</div>
                    </div>
                    <div class="day-card" id="thursday">
                        <div class="day-name">Kamis</div>
                        <div class="day-hours">07.00–21.00</div>
                    </div>
                    <div class="day-card" id="friday">
                        <div class="day-name">Jumat</div>
                        <div class="day-hours">07.00–21.00</div>
                    </div>
                    <div class="day-card" id="saturday">
                        <div class="day-name">Sabtu</div>
                        <div class="day-hours">07.00–21.00</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.238274683064!2d110.3747749747005!3d-7.762906977049092!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59a5e9c4b2c5%3A0x6c2e1e4c4d4c4d4c!2sJl.%20Veteran%20No.35%2C%20Muja%20Muju%2C%20Kec.%20Umbulharjo%2C%20Kota%20Yogyakarta%2C%20Daerah%20Istimewa%20Yogyakarta%2055164!5e0!3m2!1sid!2sid!4v1690000000000!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

                <div class="card mt-4 system-card">
                    <div class="card-header text-white">
                        <h5 class="card-title mb-0"><i class="fas fa-store me-2"></i>Profil Toko</h5>
                    </div>
                    <div class="card-body">
                        <div class="feature-icon">
                            <i class="fas fa-honey-pot"></i>
                        </div>
                        <h5 class="text-center">Toko Madu Seribu Bunga</h5>
                        <p class="text-center">Menyediakan berbagai jenis madu alami dengan kualitas terbaik untuk kesehatan Anda dan keluarga.</p>

                        <div class="d-flex justify-content-between mt-4">
                            <div class="text-center">
                                <h5 class="text-warning">10+</h5>
                                <small>Jenis Madu</small>
                            </div>
                            <div class="text-center">
                                <h5 class="text-warning">12+</h5>
                                <small>Tahun Pengalaman</small>
                            </div>
                            <div class="text-center">
                                <h5 class="text-warning">1000+</h5>
                                <small>Pelanggan</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Information -->
        <div class="row justify-content-center mt-5">
            <div class="col-lg-10">
                <div class="card system-card">
                    <div class="card-header text-white">
                        <h3 class="card-title mb-0"><i class="fas fa-info-circle me-2"></i>Tentang Sistem</h3>
                    </div>
                    <div class="card-body p-4">
                        <h5 class="text-warning">Sistem Rekomendasi Jenis Madu untuk Kesehatan</h5>
                        <p>Sistem ini menggunakan metode <strong>Certainty Factor (CF)</strong> untuk memberikan rekomendasi jenis madu yang tepat berdasarkan kondisi kesehatan pengguna.</p>

                        <h6 class="text-success mt-4">Fitur Utama:</h6>
                        <ul>
                            <li>Menu Home</li>
                            <li>Menu Konsultasi (Inputan User)</li>
                            <li>Basis Pengetahuan (Berisi Gejala Kesehatan & Solusi Jenis Madu)</li>
                            <li>Petunjuk (Penggunaan Sistem)</li>
                            <li>Menu Tentang (Berisi Ringkasan Tentang Sistem Serta Toko Madu)</li>
                            <li>Menu Developer</li>
                            <li>Menu Admin</li>
                            <li>Pengelolaan Data Gejala</li>
                            <li>Pengelolaan Data Solusi</li>
                            <li>Pengelolaan Data Rule</li>
                            <li>Hasil Diagnosis Sistem Dengan Persentase Dan Rekomendasi Serta Deskripsi</li>
                            <li>Riwayat Konsultasi Realtime</li>

                        </ul>

                        <h6 class="text-success mt-4">Teknologi:</h6>
                        <p>HTML, CSS, MySQL Database, Bootstrap 5, JavaScript, PHP</p>

                        <div class="mt-4">
                            <span class="honey-badge me-2"><i class="fas fa-cogs me-1"></i>Certainty Factor</span>
                            <span class="honey-badge me-2"><i class="fas fa-database me-1"></i>Basis Pengetahuan</span>
                            <span class="honey-badge me-2"><i class="fas fa-stethoscope me-1"></i>Konsultasi Kesehatan</span>
                            <span class="honey-badge"><i class="fas fa-brain me-1"></i>Sistem Pakar</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="row mt-5">
            <div class="col-12">
                <h2 class="section-title text-center">Mengapa Memilih Kami?</h2>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card system-card h-100">
                    <div class="card-body text-center">
                        <div class="feature-icon">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <h5>Madu Alami 100%</h5>
                        <p>Madu murni tanpa campuran bahan kimia atau pengawet, diambil langsung dari sarang lebah alami.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card system-card h-100">
                    <div class="card-body text-center">
                        <div class="feature-icon">
                            <i class="fas fa-stethoscope"></i>
                        </div>
                        <h5>Konsultasi Kesehatan</h5>
                        <p>Sistem rekomendasi untuk membantu Anda memilih jenis madu yang tepat berdasarkan kondisi kesehatan.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card system-card h-100">
                    <div class="card-body text-center">
                        <div class="feature-icon">
                            <i class="fas fa-award"></i>
                        </div>
                        <h5>Berkualitas Tinggi</h5>
                        <p>Setiap produk melalui proses seleksi ketat untuk memastikan kualitas dan kemurniannya.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Menandai hari aktif
        document.addEventListener('DOMContentLoaded', function() {
            const days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
            const today = new Date().getDay();
            const activeDay = document.getElementById(days[today]);

            if (activeDay) {
                activeDay.classList.add('active');
            }
        });
    </script>

</body>

</html>