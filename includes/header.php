<?php
$current_page = $_GET['page'] ?? 'home';
// Jika BASE_URL tidak didefinisikan, buat default
if (!defined('BASE_URL')) {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $host = $_SERVER['HTTP_HOST'];
    $project_folder = 'honey_system';
    define('BASE_URL', $protocol . "://" . $host . "/" . $project_folder);
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="?page=home">
            <i class="fas fa-honey-pot me-2"></i>Sistem Rekomendasi Madu
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link <?= ($page == 'home') ? 'active' : '' ?>" href="?page=home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($page == 'konsultasi') ? 'active' : '' ?>" href="?page=konsultasi">Konsultasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($page == 'gejala_solusi') ? 'active' : '' ?>" href="?page=gejala_solusi">Basis Pengetahuan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($page == 'petunjuk') ? 'active' : '' ?>" href="?page=petunjuk">Petunjuk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($page == 'about') ? 'active' : '' ?>" href="?page=about">Tentang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($page == 'developer') ? 'active' : '' ?>" href="?page=developer">Developer</a>
                </li>
            </ul>
            <div class="navbar-nav">
                <a href="admin/login.php" class="btn btn-outline-warning btn-sm">
                    <i class="fas fa-user-shield me-1"></i>Login
                </a>
            </div>
        </div>
    </div>
</nav>