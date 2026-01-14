<footer class="bg-dark text-white mt-5">
    <div class="container py-5">
        <div class="row">
            <!-- About System -->
            <div class="col-md-4 mb-4">
                <h5 class="text-warning mb-3">
                    <i class="fas fa-honey-pot me-2"></i>Sistem Rekomendasi Madu
                </h5>
                <p class="text-light">
                    Sistem pakar untuk merekomendasikan jenis madu terbaik berdasarkan kondisi kesehatan
                    menggunakan metode Certainty Factor.
                </p>
                <div class="social-links">
                    <a href="#" class="text-warning me-3" title="Facebook">
                        <i class="fab fa-facebook fa-lg"></i>
                    </a>
                    <a href="https://www.instagram.com/maduseribubungaofficial/" class="text-warning me-3" title="Instagram">
                        <i class="fab fa-instagram fa-lg"></i>
                    </a>
                    <a href="#" class="text-warning me-3" title="Twitter">
                        <i class="fab fa-twitter fa-lg"></i>
                    </a>
                    <a href="#" class="text-warning" title="YouTube">
                        <i class="fab fa-youtube fa-lg"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-md-2 mb-4">
                <h6 class="text-warning mb-3">Menu Utama</h6>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="#" class="text-light text-decoration-none">
                            <i class="fas fa-home me-1"></i> Home
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-light text-decoration-none">
                            <i class="fas fa-stethoscope me-1"></i> Konsultasi
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-light text-decoration-none">
                            <i class="fas fa-database me-1"></i> Basis Pengetahuan
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-light text-decoration-none">
                            <i class="fas fa-book me-1"></i> Petunjuk
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Informasi -->
            <div class="col-md-3 mb-4">
                <h6 class="text-warning mb-3">Informasi</h6>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="#" class="text-light text-decoration-none">
                            <i class="fas fa-info-circle me-1"></i> Tentang Sistem
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-light text-decoration-none">
                            <i class="fas fa-question-circle me-1"></i> Bantuan
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-light text-decoration-none">
                            <i class="fas fa-shield-alt me-1"></i> Kebijakan Privasi
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-light text-decoration-none">
                            <i class="fas fa-file-contract me-1"></i> Syarat & Ketentuan
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-md-3 mb-4">
                <h6 class="text-warning mb-3">Kontak</h6>
                <div class="contact-info">
                    <div class="mb-3">
                        <i class="fas fa-map-marker-alt text-warning me-2"></i>
                        <span class="text-light">Jl. Veteran No.35 A, Muja Muju, Kec. Umbulharjo, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55164</span>
                    </div>
                    <div class="mb-3">
                        <i class="fas fa-phone text-warning me-2"></i>
                        <span class="text-light">082-2209-39189</span>
                    </div>
                    <div class="mb-3">
                        <i class="fas fa-envelope text-warning me-2"></i>
                        <span class="text-light">info@maduseribubunga.com</span>
                    </div>
                    <div class="mb-3">
                        <i class="fas fa-clock text-warning me-2"></i>
                        <span class="text-light">Senin - Minggu: 07:00 - 21:00</span>
                    </div>
                </div>
            </div>
        </div>

        <hr class="bg-warning">

        <!-- Copyright & Additional Info -->
        <div class="row align-items-center">
            <div class="col-md-6">
            </div>
            <div class="col-md-6 text-md-end">
                <div class="tech-info">
                    <small class="text-muted">
                        <i class="fas fa-code me-1"></i>
                        Built with PHP, MySQL, Bootstrap 5

                        Using Certainty Factor Method
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Back to Top Button -->
    <button onclick="scrollToTop()" id="backToTop" class="btn btn-warning btn-lg rounded-circle position-fixed"
        style="bottom: 20px; right: 20px; display: none;">
        <i class="fas fa-chevron-up"></i>
    </button>
</footer>

<style>
    .footer {
        background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
    }

    .social-links a {
        transition: transform 0.3s ease, color 0.3s ease;
    }

    .social-links a:hover {
        transform: translateY(-3px);
        color: #f39c12 !important;
    }

    .contact-info div {
        transition: transform 0.2s ease;
    }

    .contact-info div:hover {
        transform: translateX(5px);
    }

    .list-unstyled li a {
        transition: color 0.3s ease, transform 0.2s ease;
    }

    .list-unstyled li a:hover {
        color: #f39c12 !important;
        transform: translateX(5px);
    }

    #backToTop {
        transition: all 0.3s ease;
        z-index: 1000;
    }

    #backToTop:hover {
        transform: scale(1.1);
    }
</style>

<script>
    // Back to top functionality
    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    // Show/hide back to top button
    window.addEventListener('scroll', function() {
        const backToTop = document.getElementById('backToTop');
        if (window.pageYOffset > 300) {
            backToTop.style.display = 'block';
        } else {
            backToTop.style.display = 'none';
        }
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add current year to copyright
    document.addEventListener('DOMContentLoaded', function() {
        const yearElement = document.querySelector('.current-year');
        if (yearElement) {
            yearElement.textContent = new Date().getFullYear();
        }
    });
</script>