<?php
session_start();
require_once __DIR__ . '/../config/database.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

$database = new Database();
$db = $database->getConnection();

// Hitung statistik
$stats = [];

// Total gejala
$query = "SELECT COUNT(*) as total FROM gejala";
$stmt = $db->prepare($query);
$stmt->execute();
$stats['total_gejala'] = $stmt->fetch()['total'];

// Total solusi (jenis madu)
$query = "SELECT COUNT(*) as total FROM solusi";
$stmt = $db->prepare($query);
$stmt->execute();
$stats['total_solusi'] = $stmt->fetch()['total'];

// Total rules
$query = "SELECT COUNT(*) as total FROM rules";
$stmt = $db->prepare($query);
$stmt->execute();
$stats['total_rules'] = $stmt->fetch()['total'];

// Total konsultasi
$query = "SELECT COUNT(*) as total FROM konsultasi";
$stmt = $db->prepare($query);
$stmt->execute();
$stats['total_konsultasi'] = $stmt->fetch()['total'];

// Konsultasi hari ini
$query = "SELECT COUNT(*) as total FROM konsultasi WHERE DATE(tanggal) = CURDATE()";
$stmt = $db->prepare($query);
$stmt->execute();
$stats['konsultasi_hari_ini'] = $stmt->fetch()['total'];

// Data rekomendasi terpopuler
$query = "SELECT jenis_madu, COUNT(*) as jumlah 
          FROM detail_konsultasi 
          GROUP BY jenis_madu 
          ORDER BY jumlah DESC 
          LIMIT 5";
$stmt = $db->prepare($query);
$stmt->execute();
$rekomendasi_populer = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Konsultasi terbaru
$query = "SELECT k.*, COUNT(d.id) as total_rekomendasi 
          FROM konsultasi k 
          LEFT JOIN detail_konsultasi d ON k.id = d.konsultasi_id 
          GROUP BY k.id 
          ORDER BY k.tanggal DESC 
          LIMIT 5";
$stmt = $db->prepare($query);
$stmt->execute();
$konsultasi_terbaru = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Sistem Rekomendasi Madu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .dashboard-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
        }

        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .stat-card-2 {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }

        .stat-card-3 {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }

        .stat-card-4 {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            color: white;
        }

        .sidebar {
            background: #343a40;
            min-height: 100vh;
            color: white;
        }

        .sidebar .nav-link {
            color: #adb5bd;
            padding: 12px 20px;
            margin: 5px 0;
            border-radius: 5px;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: #495057;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar p-0">
                <div class="p-4">
                    <h4 class="text-warning mb-4">
                        <i class="fas fa-honey-pot me-2"></i>Admin Panel
                    </h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="dashboard.php">
                                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="gejala.php">
                                <i class="fas fa-project-diagram me-2"></i>Kelola Gejala
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="solusi.php">
                                <i class="fas fa-project-diagram me-2"></i>Kelola Solusi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="rules.php">
                                <i class="fas fa-project-diagram me-2"></i>Kelola Rules
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 ml-sm-auto p-4">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-warning">
                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                    </h2>
                    <div class="text-muted">
                        <i class="fas fa-user me-1"></i>Welcome, <?= $_SESSION['admin_name'] ?>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="row mb-4">
                    <div class="col-md-3 mb-3">
                        <div class="card dashboard-card stat-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4 class="card-title"><?= $stats['total_gejala'] ?></h4>
                                        <p class="card-text">Total Gejala</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-symptoms fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card dashboard-card stat-card-2">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4 class="card-title"><?= $stats['total_solusi'] ?></h4>
                                        <p class="card-text">Jenis Madu</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-honey-pot fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card dashboard-card stat-card-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4 class="card-title"><?= $stats['total_rules'] ?></h4>
                                        <p class="card-text">Total Rules</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-project-diagram fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card dashboard-card stat-card-4">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4 class="card-title"><?= $stats['total_konsultasi'] ?></h4>
                                        <p class="card-text">Total Konsultasi</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-stethoscope fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Rekomendasi Terpopuler -->
                    <div class="col-md-6 mb-4">
                        <div class="card dashboard-card">
                            <div class="card-header bg-warning text-white">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-chart-bar me-2"></i>Rekomendasi Terpopuler
                                </h5>
                            </div>
                            <div class="card-body">
                                <?php if (empty($rekomendasi_populer)): ?>
                                    <p class="text-muted">Belum ada data rekomendasi</p>
                                <?php else: ?>
                                    <div class="list-group">
                                        <?php foreach ($rekomendasi_populer as $index => $item): ?>
                                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                                <div>
                                                    <span class="badge bg-warning me-2">#<?= $index + 1 ?></span>
                                                    <?= $item['jenis_madu'] ?>
                                                </div>
                                                <span class="badge bg-primary rounded-pill"><?= $item['jumlah'] ?></span>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Konsultasi Terbaru -->
                    <div class="col-md-6 mb-4">
                        <div class="card dashboard-card">
                            <div class="card-header bg-info text-white">
                                <h5 class="card-title mb-0"> <i class="fas fa-history me-2"></i>Konsultasi Terbaru </h5>
                            </div>
                            <div class="card-body"> <?php if (empty($konsultasi_terbaru)): ?> <p class="text-muted">Belum ada konsultasi</p> <?php else: ?> <div class="list-group"> <?php foreach ($konsultasi_terbaru as $konsultasi): ?> <div class="list-group-item">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h6 class="mb-1"> <?= $konsultasi['nama_pengguna'] ?: 'Anonim' ?> </h6> <small><?= date('d M Y H:i', strtotime($konsultasi['tanggal'])) ?></small>
                                                </div> <!-- TAMBAHAN DATA DARI DATABASE -->
                                                <p class="mb-1">Email: <?= $konsultasi['email'] ?></p>
                                                <p class="mb-1">Umur: <?= $konsultasi['umur'] ?> tahun</p>
                                                <p class="mb-1">Pekerjaan: <?= $konsultasi['pekerjaan'] ?></p>
                                                <p class="mb-1">Alamat: <?= $konsultasi['alamat'] ?></p> <!-- BARIS ASLI -->
                                                <p class="mb-1"><?= $konsultasi['total_rekomendasi'] ?> rekomendasi</p>
                                            </div> <?php endforeach; ?> </div> <?php endif; ?> </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="row">
                    <div class="col-12">
                        <div class="card dashboard-card">
                            <div class="card-header bg-success text-white">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-bolt me-2"></i>Quick Actions
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 text-center mb-3">
                                        <a href="gejala.php" class="btn btn-outline-primary btn-lg w-100 py-3">
                                            <i class="fas fa-plus-circle fa-2x mb-2"></i><br>
                                            Tambah Gejala
                                        </a>
                                    </div>
                                    <div class="col-md-3 text-center mb-3">
                                        <a href="solusi.php" class="btn btn-outline-success btn-lg w-100 py-3">
                                            <i class="fas fa-plus-circle fa-2x mb-2"></i><br>
                                            Tambah Madu
                                        </a>
                                    </div>
                                    <div class="col-md-3 text-center mb-3">
                                        <a href="rules.php" class="btn btn-outline-warning btn-lg w-100 py-3">
                                            <i class="fas fa-project-diagram fa-2x mb-2"></i><br>
                                            Kelola Rules
                                        </a>
                                    </div>
                                    <div class="col-md-3 text-center mb-3">
                                        <a href="../" class="btn btn-outline-info btn-lg w-100 py-3">
                                            <i class="fas fa-eye fa-2x mb-2"></i><br>
                                            Lihat Website
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Today's Stats -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card dashboard-card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-calendar-day me-2"></i>Statistik Hari Ini
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-md-4">
                                        <h3 class="text-primary"><?= $stats['konsultasi_hari_ini'] ?></h3>
                                        <p class="text-muted">Konsultasi Hari Ini</p>
                                    </div>
                                    <div class="col-md-4">
                                        <h3 class="text-success"><?= $stats['total_konsultasi'] ?></h3>
                                        <p class="text-muted">Total Konsultasi</p>
                                    </div>
                                    <div class="col-md-4">
                                        <h3 class="text-warning"><?= $stats['total_rules'] ?></h3>
                                        <p class="text-muted">Active Rules</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto refresh stats every 30 seconds
        setInterval(function() {
            location.reload();
        }, 30000);
    </script>
</body>

</html>