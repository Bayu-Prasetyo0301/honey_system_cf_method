<?php
session_start();

// Define BASE_URL untuk link yang konsisten
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$project_folder = 'honey_system'; // sesuaikan dengan folder project Anda
define('BASE_URL', $protocol . "://" . $host . "/" . $project_folder);

$page = $_GET['page'] ?? 'home';
$allowed_pages = ['home', 'konsultasi', 'hasil', 'petunjuk', 'about', 'gejala_solusi', 'developer'];

// Security: Validasi page
if (!in_array($page, $allowed_pages)) {
    $page = 'home';
}

// Security: Validasi file exists
$page_file = "pages/{$page}.php";
if (!file_exists($page_file)) {
    $page = 'home';
    $page_file = "pages/home.php";
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Rekomendasi Jenis Madu - Certainty Factor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <main>
        <?php include "pages/{$page}.php"; ?>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>