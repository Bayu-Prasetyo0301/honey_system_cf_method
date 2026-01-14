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

$success = '';
$error = '';

// Tambah gejala baru
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
    $kode_gejala = $_POST['kode_gejala'];
    $nama_gejala = $_POST['nama_gejala'];

    try {
        $query = "INSERT INTO gejala (kode_gejala, nama_gejala) VALUES (?, ?)";
        $stmt = $db->prepare($query);
        $stmt->execute([$kode_gejala, $nama_gejala]);
        $success = "Gejala berhasil ditambahkan!";
    } catch (PDOException $e) {
        $error = "Gagal menambah gejala: " . $e->getMessage();
    }
}

// Edit gejala
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    $id = $_POST['id'];
    $kode_gejala = $_POST['kode_gejala'];
    $nama_gejala = $_POST['nama_gejala'];

    try {
        $query = "UPDATE gejala SET kode_gejala = ?, nama_gejala = ? WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$kode_gejala, $nama_gejala, $id]);
        $success = "Gejala berhasil diupdate!";
    } catch (PDOException $e) {
        $error = "Gagal mengupdate gejala: " . $e->getMessage();
    }
}

// Hapus gejala
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    try {
        $query = "DELETE FROM gejala WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        $success = "Gejala berhasil dihapus!";
    } catch (PDOException $e) {
        $error = "Gagal menghapus gejala: " . $e->getMessage();
    }
}

// Ambil semua data gejala
$query = "SELECT * FROM gejala ORDER BY kode_gejala";
$stmt = $db->prepare($query);
$stmt->execute();
$gejala_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Ambil data untuk edit
$edit_data = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $query = "SELECT * FROM gejala WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$id]);
    $edit_data = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Gejala - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
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

        .table-actions {
            white-space: nowrap;
        }

        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
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
                            <a class="nav-link" href="dashboard.php">
                                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="gejala.php">
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
                        <i class="fas fa-symptoms me-2"></i>Kelola Data Gejala
                    </h2>
                    <div class="text-muted">
                        <i class="fas fa-user me-1"></i>Welcome, <?= $_SESSION['admin_name'] ?>
                    </div>
                </div>

                <!-- Alert Messages -->
                <?php if ($success): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i><?= $success ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if ($error): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i><?= $error ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <div class="row">
                    <!-- Form Tambah/Edit Gejala -->
                    <div class="col-lg-4 mb-4">
                        <div class="card">
                            <div class="card-header bg-<?= $edit_data ? 'warning' : 'primary' ?> text-white">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-<?= $edit_data ? 'edit' : 'plus' ?> me-2"></i>
                                    <?= $edit_data ? 'Edit Gejala' : 'Tambah Gejala Baru' ?>
                                </h5>
                            </div>
                            <div class="card-body">
                                <form method="POST">
                                    <?php if ($edit_data): ?>
                                        <input type="hidden" name="id" value="<?= $edit_data['id'] ?>">
                                        <input type="hidden" name="edit" value="1">
                                    <?php else: ?>
                                        <input type="hidden" name="tambah" value="1">
                                    <?php endif; ?>

                                    <div class="mb-3">
                                        <label for="kode_gejala" class="form-label">Kode Gejala</label>
                                        <input type="text" class="form-control" id="kode_gejala" name="kode_gejala"
                                            value="<?= $edit_data ? $edit_data['kode_gejala'] : '' ?>"
                                            placeholder="Contoh: G01, G02" required>
                                        <div class="form-text">Format: G diikuti angka (G01, G02, dst)</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="nama_gejala" class="form-label">Nama Gejala</label>
                                        <textarea class="form-control" id="nama_gejala" name="nama_gejala"
                                            rows="3" placeholder="Masukkan deskripsi gejala..." required><?= $edit_data ? $edit_data['nama_gejala'] : '' ?></textarea>
                                    </div>

                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-<?= $edit_data ? 'warning' : 'primary' ?>">
                                            <i class="fas fa-<?= $edit_data ? 'save' : 'plus' ?> me-2"></i>
                                            <?= $edit_data ? 'Update Gejala' : 'Tambah Gejala' ?>
                                        </button>

                                        <?php if ($edit_data): ?>
                                            <a href="gejala.php" class="btn btn-secondary">
                                                <i class="fas fa-times me-2"></i>Batal Edit
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Info -->
                        <div class="card mt-4">
                            <div class="card-header bg-info text-white">
                                <h6 class="card-title mb-0">
                                    <i class="fas fa-info-circle me-2"></i>Informasi
                                </h6>
                            </div>
                            <div class="card-body">
                                <small class="text-muted">
                                    <strong>Total Gejala:</strong> <?= count($gejala_list) ?><br>
                                    <strong>Format Kode:</strong> G01, G02, G03, ...<br>
                                    <strong>Deskripsi:</strong> Jelaskan gejala dengan jelas dan spesifik.
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Daftar Gejala -->
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header bg-success text-white">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-list me-2"></i>Daftar Gejala
                                    <span class="badge bg-light text-dark ms-2"><?= count($gejala_list) ?></span>
                                </h5>
                            </div>
                            <div class="card-body">
                                <?php if (empty($gejala_list)): ?>
                                    <div class="text-center py-4">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">Belum ada data gejala.</p>
                                    </div>
                                <?php else: ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead class="table-light">
                                                <tr>
                                                    <th width="15%">Kode</th>
                                                    <th width="55%">Nama Gejala</th>
                                                    <th width="20%">Tanggal</th>
                                                    <th width="10%" class="text-center">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($gejala_list as $gejala): ?>
                                                    <tr>
                                                        <td>
                                                            <span class="badge bg-primary"><?= $gejala['kode_gejala'] ?></span>
                                                        </td>
                                                        <td><?= $gejala['nama_gejala'] ?></td>
                                                        <td>
                                                            <small class="text-muted">
                                                                <?= date('d M Y', strtotime($gejala['created_at'])) ?>
                                                            </small>
                                                        </td>
                                                        <td class="table-actions text-center">
                                                            <a href="?edit=<?= $gejala['id'] ?>" class="btn btn-sm btn-warning" title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a href="?hapus=<?= $gejala['id'] ?>" class="btn btn-sm btn-danger"
                                                                title="Hapus" onclick="return confirm('Hapus gejala <?= $gejala['kode_gejala'] ?>?')">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="card mt-4">
                            <div class="card-header bg-secondary text-white">
                                <h6 class="card-title mb-0">
                                    <i class="fas fa-bolt me-2"></i>Quick Actions
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <a href="solusi.php" class="btn btn-outline-primary w-100">
                                            <i class="fas fa-honey-pot me-2"></i>Kelola Jenis Madu
                                        </a>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <a href="rules.php" class="btn btn-outline-success w-100">
                                            <i class="fas fa-project-diagram me-2"></i>Kelola Rules
                                        </a>
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
        // Auto focus pada form input
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('kode_gejala').focus();
        });

        // Confirm sebelum hapus
        function confirmDelete(kode) {
            return confirm('Apakah Anda yakin ingin menghapus gejala ' + kode + '?');
        }
    </script>
</body>

</html>