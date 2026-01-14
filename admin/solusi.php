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

// Tambah solusi baru
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
    $kode_solusi = $_POST['kode_solusi'];
    $jenis_madu = $_POST['jenis_madu'];
    $deskripsi = $_POST['deskripsi'];
    $manfaat = $_POST['manfaat'];
    $cara_konsumsi = $_POST['cara_konsumsi'];
    $saran = $_POST['saran'];
    $keterangan = $_POST['keterangan'];
    $harga_250ml = $_POST['harga_250ml'];

    try {
        $query = "INSERT INTO solusi (kode_solusi, jenis_madu, deskripsi, manfaat, cara_konsumsi, saran, keterangan, harga_250ml) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->execute([$kode_solusi, $jenis_madu, $deskripsi, $manfaat, $cara_konsumsi, $saran, $keterangan, $harga_250ml]);
        $success = "Jenis madu berhasil ditambahkan!";
    } catch (PDOException $e) {
        $error = "Gagal menambah jenis madu: " . $e->getMessage();
    }
}

// Edit solusi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    $id = $_POST['id'];
    $kode_solusi = $_POST['kode_solusi'];
    $jenis_madu = $_POST['jenis_madu'];
    $deskripsi = $_POST['deskripsi'];
    $manfaat = $_POST['manfaat'];
    $cara_konsumsi = $_POST['cara_konsumsi'];
    $saran = $_POST['saran'];
    $keterangan = $_POST['keterangan'];
    $harga_250ml = $_POST['harga_250ml'];

    try {
        $query = "UPDATE solusi SET kode_solusi = ?, jenis_madu = ?, deskripsi = ?, manfaat = ?, 
                  cara_konsumsi = ?, saran = ?, keterangan = ?, harga_250ml = ? WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$kode_solusi, $jenis_madu, $deskripsi, $manfaat, $cara_konsumsi, $saran, $keterangan, $harga_250ml, $id]);
        $success = "Jenis madu berhasil diupdate!";
    } catch (PDOException $e) {
        $error = "Gagal mengupdate jenis madu: " . $e->getMessage();
    }
}

// Hapus solusi
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    try {
        // Cek apakah solusi digunakan di rules
        $check_query = "SELECT COUNT(*) as total FROM rules WHERE kode_solusi = (SELECT kode_solusi FROM solusi WHERE id = ?)";
        $check_stmt = $db->prepare($check_query);
        $check_stmt->execute([$id]);
        $used_count = $check_stmt->fetch()['total'];

        if ($used_count > 0) {
            $error = "Tidak bisa menghapus! Jenis madu ini masih digunakan dalam " . $used_count . " rule.";
        } else {
            $query = "DELETE FROM solusi WHERE id = ?";
            $stmt = $db->prepare($query);
            $stmt->execute([$id]);
            $success = "Jenis madu berhasil dihapus!";
        }
    } catch (PDOException $e) {
        $error = "Gagal menghapus jenis madu: " . $e->getMessage();
    }
}

// Ambil semua data solusi
$query = "SELECT * FROM solusi ORDER BY kode_solusi";
$stmt = $db->prepare($query);
$stmt->execute();
$solusi_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Ambil data untuk edit
$edit_data = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $query = "SELECT * FROM solusi WHERE id = ?";
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
    <title>Kelola Solusi - Admin Panel</title>
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

        .price-tag {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
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
                            <a class="nav-link" href="gejala.php">
                                <i class="fas fa-project-diagram me-2"></i>Kelola Gejala
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="solusi.php">
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
                        <i class="fas fa-honey-pot me-2"></i>Kelola Jenis Madu
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
                    <!-- Form Tambah/Edit Solusi -->
                    <div class="col-lg-5 mb-4">
                        <div class="card">
                            <div class="card-header bg-<?= $edit_data ? 'warning' : 'primary' ?> text-white">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-<?= $edit_data ? 'edit' : 'plus' ?> me-2"></i>
                                    <?= $edit_data ? 'Edit Jenis Madu' : 'Tambah Jenis Madu Baru' ?>
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

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="kode_solusi" class="form-label">Kode Madu</label>
                                            <input type="text" class="form-control" id="kode_solusi" name="kode_solusi"
                                                value="<?= $edit_data ? $edit_data['kode_solusi'] : '' ?>"
                                                placeholder="Contoh: M01, M02" required>
                                            <div class="form-text">Format: M diikuti angka</div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="harga_250ml" class="form-label">Harga 250ml (Rp)</label>
                                            <input type="number" class="form-control" id="harga_250ml" name="harga_250ml"
                                                value="<?= $edit_data ? $edit_data['harga_250ml'] : '' ?>"
                                                placeholder="Contoh: 41000" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="jenis_madu" class="form-label">Jenis Madu</label>
                                        <input type="text" class="form-control" id="jenis_madu" name="jenis_madu"
                                            value="<?= $edit_data ? $edit_data['jenis_madu'] : '' ?>"
                                            placeholder="Contoh: Madu Kelengkeng, Madu Randu" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="deskripsi" class="form-label">Deskripsi</label>
                                        <textarea class="form-control" id="deskripsi" name="deskripsi"
                                            rows="2" placeholder="Deskripsi singkat tentang madu..." required><?= $edit_data ? $edit_data['deskripsi'] : '' ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="manfaat" class="form-label">Manfaat Kesehatan</label>
                                        <textarea class="form-control" id="manfaat" name="manfaat"
                                            rows="2" placeholder="Manfaat utama untuk kesehatan..." required><?= $edit_data ? $edit_data['manfaat'] : '' ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="cara_konsumsi" class="form-label">Cara Konsumsi</label>
                                        <textarea class="form-control" id="cara_konsumsi" name="cara_konsumsi"
                                            rows="2" placeholder="Cara mengonsumsi yang dianjurkan..." required><?= $edit_data ? $edit_data['cara_konsumsi'] : '' ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="saran" class="form-label">Saran Penggunaan</label>
                                        <textarea class="form-control" id="saran" name="saran"
                                            rows="2" placeholder="Saran khusus untuk penggunaan..."><?= $edit_data ? $edit_data['saran'] : '' ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="keterangan" class="form-label">Keterangan Tambahan</label>
                                        <textarea class="form-control" id="keterangan" name="keterangan"
                                            rows="2" placeholder="Keterangan lain yang perlu diketahui..."><?= $edit_data ? $edit_data['keterangan'] : '' ?></textarea>
                                    </div>

                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-<?= $edit_data ? 'warning' : 'primary' ?>">
                                            <i class="fas fa-<?= $edit_data ? 'save' : 'plus' ?> me-2"></i>
                                            <?= $edit_data ? 'Update Madu' : 'Tambah Madu' ?>
                                        </button>

                                        <?php if ($edit_data): ?>
                                            <a href="solusi.php" class="btn btn-secondary">
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
                                    <strong>Total Jenis Madu:</strong> <?= count($solusi_list) ?><br>
                                    <strong>Format Kode:</strong> M01, M02, M03, ...<br>
                                    <strong>Harga:</strong> Masukkan harga untuk ukuran 250ml<br>
                                    <strong>Semua field wajib diisi</strong> kecuali saran dan keterangan.
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Daftar Solusi -->
                    <div class="col-lg-7">
                        <div class="card">
                            <div class="card-header bg-success text-white">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-list me-2"></i>Daftar Jenis Madu
                                    <span class="badge bg-light text-dark ms-2"><?= count($solusi_list) ?></span>
                                </h5>
                            </div>
                            <div class="card-body">
                                <?php if (empty($solusi_list)): ?>
                                    <div class="text-center py-4">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">Belum ada data jenis madu.</p>
                                        <a href="?tambah=true" class="btn btn-primary">
                                            <i class="fas fa-plus me-2"></i>Tambah Jenis Madu Pertama
                                        </a>
                                    </div>
                                <?php else: ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead class="table-light">
                                                <tr>
                                                    <th width="10%">Kode</th>
                                                    <th width="25%">Jenis Madu</th>
                                                    <th width="15%">Harga</th>
                                                    <th width="30%">Manfaat</th>
                                                    <th width="10%" class="text-center">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($solusi_list as $solusi): ?>
                                                    <tr>
                                                        <td>
                                                            <span class="badge bg-primary"><?= $solusi['kode_solusi'] ?></span>
                                                        </td>
                                                        <td>
                                                            <strong><?= $solusi['jenis_madu'] ?></strong>
                                                            <br>
                                                            <small class="text-muted"><?= substr($solusi['deskripsi'], 0, 50) ?>...</small>
                                                        </td>
                                                        <td>
                                                            <span class="price-tag">
                                                                Rp <?= number_format($solusi['harga_250ml'], 0, ',', '.') ?>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <small><?= substr($solusi['manfaat'], 0, 60) ?>...</small>
                                                        </td>
                                                        <td class="table-actions text-center">
                                                            <a href="?edit=<?= $solusi['id'] ?>" class="btn btn-sm btn-warning" title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a href="?hapus=<?= $solusi['id'] ?>" class="btn btn-sm btn-danger"
                                                                title="Hapus" onclick="return confirm('Hapus <?= $solusi['jenis_madu'] ?>?')">
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

                        <!-- Quick Stats -->
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="card bg-primary text-white">
                                    <div class="card-body text-center">
                                        <h4><?= count($solusi_list) ?></h4>
                                        <p class="mb-0">Total Jenis Madu</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-success text-white">
                                    <div class="card-body text-center">
                                        <h4>
                                            <?php
                                            $total_harga = 0;
                                            foreach ($solusi_list as $solusi) {
                                                $total_harga += $solusi['harga_250ml'];
                                            }
                                            $avg_harga = count($solusi_list) > 0 ? $total_harga / count($solusi_list) : 0;
                                            echo 'Rp ' . number_format($avg_harga, 0, ',', '.');
                                            ?>
                                        </h4>
                                        <p class="mb-0">Rata-rata Harga</p>
                                    </div>
                                </div>
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
                                        <a href="gejala.php" class="btn btn-outline-primary w-100">
                                            <i class="fas fa-project-diagram me-2"></i>Kelola Gejala
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
            document.getElementById('kode_solusi').focus();
        });

        // Format harga input
        document.getElementById('harga_250ml').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            e.target.value = value;
        });

        // Auto capitalize jenis madu
        document.getElementById('jenis_madu').addEventListener('input', function(e) {
            let words = e.target.value.split(' ');
            for (let i = 0; i < words.length; i++) {
                words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1).toLowerCase();
            }
            e.target.value = words.join(' ');
        });
    </script>
</body>

</html>