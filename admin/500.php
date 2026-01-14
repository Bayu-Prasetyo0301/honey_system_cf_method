<?php
http_response_code(500);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Server - Sistem Rekomendasi Madu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .error-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        }
    </style>
</head>

<body>
    <div class="error-container">
        <div class="text-center text-white">
            <h1 class="display-1 fw-bold">500</h1>
            <h2 class="mb-4">Error Server</h2>
            <p class="mb-4">Terjadi kesalahan pada server. Silakan coba lagi nanti.</p>
            <a href="/" class="btn btn-light btn-lg">
                <i class="fas fa-home me-2"></i>Kembali ke Home
            </a>
        </div>
    </div>
</body>

</html>