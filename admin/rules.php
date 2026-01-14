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

// Tambah rule baru
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
    $kode_rule = $_POST['kode_rule'];
    $kondisi_array = $_POST['kondisi']; // array gejala
    $kondisi = implode(' AND ', $kondisi_array); // gabung pakai AND
    $kode_solusi = $_POST['kode_solusi'];
    $cf_pakar = $_POST['cf_pakar'];

    try {
        $query = "INSERT INTO rules (kode_rule, kondisi, kode_solusi, cf_pakar) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->execute([$kode_rule, $kondisi, $kode_solusi, $cf_pakar]);
        $success = "Rule berhasil ditambahkan!";
    } catch (PDOException $e) {
        $error = "Gagal menambah rule: " . $e->getMessage();
    }
}

// Edit rule
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    $id = $_POST['id'];
    $kode_rule = $_POST['kode_rule'];
    $kondisi = isset($_POST['kondisi'])
        ? implode(' AND ', $_POST['kondisi'])
        : '';
    $kode_solusi = $_POST['kode_solusi'];
    $cf_pakar = $_POST['cf_pakar'];

    try {
        $query = "UPDATE rules SET kode_rule = ?, kondisi = ?, kode_solusi = ?, cf_pakar = ? WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$kode_rule, $kondisi, $kode_solusi, $cf_pakar, $id]);
        $success = "Rule berhasil diupdate!";
    } catch (PDOException $e) {
        $error = "Gagal mengupdate rule: " . $e->getMessage();
    }
}

// Hapus rule
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    try {
        $query = "DELETE FROM rules WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        $success = "Rule berhasil dihapus!";
    } catch (PDOException $e) {
        $error = "Gagal menghapus rule: " . $e->getMessage();
    }
}

// Ambil semua data rules dengan join ke solusi
$query = "SELECT r.*, s.jenis_madu, s.deskripsi 
          FROM rules r 
          JOIN solusi s ON r.kode_solusi = s.kode_solusi 
          ORDER BY r.kode_rule";
$stmt = $db->prepare($query);
$stmt->execute();
$rules_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Ambil data gejala untuk dropdown kondisi
$query_gejala = "SELECT nama_gejala FROM gejala ORDER BY kode_gejala";
$stmt_gejala = $db->prepare($query_gejala);
$stmt_gejala->execute();
$gejala_list = $stmt_gejala->fetchAll(PDO::FETCH_COLUMN);

// Ambil data solusi untuk dropdown
$query_solusi = "SELECT kode_solusi, jenis_madu FROM solusi ORDER BY kode_solusi";
$stmt_solusi = $db->prepare($query_solusi);
$stmt_solusi->execute();
$solusi_list = $stmt_solusi->fetchAll(PDO::FETCH_ASSOC);

// Ambil data untuk edit
$edit_data = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $query = "SELECT * FROM rules WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$id]);
    $edit_data = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Generate kode rule otomatis
function generateKodeRule($rules_list)
{
    $last_number = 0;
    foreach ($rules_list as $rule) {
        if (preg_match('/R(\d+)/', $rule['kode_rule'], $matches)) {
            $number = (int)$matches[1];
            if ($number > $last_number) {
                $last_number = $number;
            }
        }
    }
    return 'R' . str_pad($last_number + 1, 3, '0', STR_PAD_LEFT);
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Rules - Admin Panel</title>
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

        .rule-condition {
            background: #e9ecef;
            padding: 8px 12px;
            border-radius: 5px;
            border-left: 4px solid #007bff;
        }

        .rule-result {
            background: #d4edda;
            padding: 8px 12px;
            border-radius: 5px;
            border-left: 4px solid #28a745;
        }

        .cf-badge {
            background: linear-gradient(135deg, #ff6b6b, #ee5a24);
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
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
                            <a class="nav-link" href="solusi.php">
                                <i class="fas fa-project-diagram me-2"></i>Kelola Solusi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="rules.php">
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
                        <i class="fas fa-project-diagram me-2"></i>Kelola Rule Base
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
                    <!-- Form Tambah/Edit Rule -->
                    <div class="col-lg-4 mb-4">
                        <div class="card">
                            <div class="card-header bg-<?= $edit_data ? 'warning' : 'primary' ?> text-white">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-<?= $edit_data ? 'edit' : 'plus' ?> me-2"></i>
                                    <?= $edit_data ? 'Edit Rule' : 'Tambah Rule Baru' ?>
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
                                        <label for="kode_rule" class="form-label">Kode Rule</label>
                                        <input type="text" class="form-control" id="kode_rule" name="kode_rule"
                                            value="<?= $edit_data ? $edit_data['kode_rule'] : generateKodeRule($rules_list) ?>"
                                            placeholder="Contoh: R001, R002" required>
                                        <div class="form-text">Format: R diikuti angka (R001, R002, dst)</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="kondisi" class="form-label">Kondisi (IF)</label>
                                        <select class="form-select" id="kondisi" name="kondisi[]" multiple required>
                                            <option value="">Pilih Kondisi Gejala</option>
                                            <?php foreach ($gejala_list as $gejala): ?>
                                                <option value="<?= $gejala ?>"
                                                    <?= ($edit_data && $edit_data['kondisi'] == $gejala) ? 'selected' : '' ?>>
                                                    <?= $gejala ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="form-text">Tekan CTRL (Windows) untuk memilih lebih dari satu gejala</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="kode_solusi" class="form-label">Solusi (THEN)</label>
                                        <select class="form-select" id="kode_solusi" name="kode_solusi" required>
                                            <option value="">Pilih Jenis Madu</option>
                                            <?php foreach ($solusi_list as $solusi): ?>
                                                <option value="<?= $solusi['kode_solusi'] ?>"
                                                    <?= ($edit_data && $edit_data['kode_solusi'] == $solusi['kode_solusi']) ? 'selected' : '' ?>>
                                                    <?= $solusi['kode_solusi'] ?> - <?= $solusi['jenis_madu'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="form-text">Pilih jenis madu yang direkomendasikan</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="cf_pakar" class="form-label">CF Pakar</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="cf_pakar" name="cf_pakar"
                                                value="<?= $edit_data ? $edit_data['cf_pakar'] : '0.8' ?>"
                                                step="0.1" min="0" max="1" required>
                                            <span class="input-group-text">0.0 - 1.0</span>
                                        </div>
                                        <div class="form-text">
                                            Nilai Certainty Factor dari pakar (0.0 - 1.0)<br>
                                            <small>
                                                <strong>Rekomendasi:</strong><br>
                                                0.9 = Sangat Yakin<br>
                                                0.8 = Yakin<br>
                                                0.7 = Cukup Yakin<br>
                                                0.6 = Agak Yakin
                                            </small>
                                        </div>
                                    </div>

                                    <!-- Preview Rule -->
                                    <div class="mb-3 p-3 bg-light rounded">
                                        <h6 class="text-primary mb-2">Preview Rule:</h6>
                                        <div class="rule-condition mb-2">
                                            <strong>IF</strong> <span id="preview-kondisi"><?= $edit_data ? $edit_data['kondisi'] : '[Gejala]' ?></span>
                                        </div>
                                        <div class="rule-result">
                                            <strong>THEN</strong> <span id="preview-solusi"><?= $edit_data ? $edit_data['kode_solusi'] : '[Jenis Madu]' ?></span>
                                            <br>
                                            <strong>CF:</strong> <span id="preview-cf"><?= $edit_data ? $edit_data['cf_pakar'] : '0.8' ?></span>
                                        </div>
                                    </div>

                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-<?= $edit_data ? 'warning' : 'primary' ?>">
                                            <i class="fas fa-<?= $edit_data ? 'save' : 'plus' ?> me-2"></i>
                                            <?= $edit_data ? 'Update Rule' : 'Tambah Rule' ?>
                                        </button>

                                        <?php if ($edit_data): ?>
                                            <a href="rules.php" class="btn btn-secondary">
                                                <i class="fas fa-times me-2"></i>Batal Edit
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Info Panel -->
                        <div class="card mt-4">
                            <div class="card-header bg-info text-white">
                                <h6 class="card-title mb-0">
                                    <i class="fas fa-info-circle me-2"></i>Informasi Rule Base
                                </h6>
                            </div>
                            <div class="card-body">
                                <small class="text-muted">
                                    <strong>Total Rules:</strong> <?= count($rules_list) ?><br>
                                    <strong>Format:</strong> IF [Gejala] THEN [Jenis Madu]<br>
                                    <strong>CF Pakar:</strong> 0.0 - 1.0<br>
                                    <strong>Contoh:</strong> IF Batuk THEN Madu Kelengkeng CF=0.8
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Daftar Rules -->
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header bg-success text-white">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-list me-2"></i>Daftar Rule Base
                                    <span class="badge bg-light text-dark ms-2"><?= count($rules_list) ?></span>
                                </h5>
                            </div>
                            <div class="card-body">
                                <?php if (empty($rules_list)): ?>
                                    <div class="text-center py-4">
                                        <i class="fas fa-project-diagram fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">Belum ada data rule.</p>
                                        <a href="?tambah=true" class="btn btn-primary">
                                            <i class="fas fa-plus me-2"></i>Tambah Rule Pertama
                                        </a>
                                    </div>
                                <?php else: ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead class="table-light">
                                                <tr>
                                                    <th width="10%">Kode</th>
                                                    <th width="40%">Rule</th>
                                                    <th width="20%">Jenis Madu</th>
                                                    <th width="15%">CF Pakar</th>
                                                    <th width="15%" class="text-center">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($rules_list as $rule): ?>
                                                    <tr>
                                                        <td>
                                                            <span class="badge bg-primary"><?= $rule['kode_rule'] ?></span>
                                                        </td>
                                                        <td>
                                                            <div class="rule-condition mb-1">
                                                                <strong>IF</strong> <?= $rule['kondisi'] ?>
                                                            </div>
                                                            <div class="rule-result">
                                                                <strong>THEN</strong> <?= $rule['kode_solusi'] ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <strong><?= $rule['jenis_madu'] ?></strong>
                                                            <br>
                                                            <small class="text-muted"><?= substr($rule['deskripsi'], 0, 40) ?>...</small>
                                                        </td>
                                                        <td>
                                                            <span class="cf-badge"><?= $rule['cf_pakar'] ?></span>
                                                        </td>
                                                        <td class="table-actions text-center">
                                                            <a href="?edit=<?= $rule['id'] ?>" class="btn btn-sm btn-warning" title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a href="?hapus=<?= $rule['id'] ?>" class="btn btn-sm btn-danger"
                                                                title="Hapus" onclick="return confirm('Hapus rule <?= $rule['kode_rule'] ?>?')">
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

                        <!-- Statistics -->
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <div class="card bg-primary text-white">
                                    <div class="card-body text-center">
                                        <h4><?= count($rules_list) ?></h4>
                                        <p class="mb-0">Total Rules</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-success text-white">
                                    <div class="card-body text-center">
                                        <h4><?= count($gejala_list) ?></h4>
                                        <p class="mb-0">Gejala Tersedia</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-warning text-white">
                                    <div class="card-body text-center">
                                        <h4><?= count($solusi_list) ?></h4>
                                        <p class="mb-0">Jenis Madu</p>
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
                                            <i class="fas fa-symptoms me-2"></i>Kelola Gejala
                                        </a>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <a href="solusi.php" class="btn btn-outline-success w-100">
                                            <i class="fas fa-honey-pot me-2"></i>Kelola Solusi
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
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('kode_rule').focus();
        });

        const kondisiSelect = document.getElementById('kondisi');
        const solusiSelect = document.getElementById('kode_solusi');
        const cfInput = document.getElementById('cf_pakar');

        const previewKondisi = document.getElementById('preview-kondisi');
        const previewSolusi = document.getElementById('preview-solusi');
        const previewCf = document.getElementById('preview-cf');

        function updatePreview() {
            // ===== IF (MULTIPLE AND) =====
            const selected = Array.from(kondisiSelect.selectedOptions)
                .map(opt => opt.value);

            previewKondisi.textContent = selected.length ?
                selected.join(' AND ') :
                '[Gejala]';

            // ===== THEN =====
            if (solusiSelect.value) {
                const opt = solusiSelect.options[solusiSelect.selectedIndex];
                previewSolusi.textContent = opt.text;
            }

            // ===== CF =====
            if (cfInput.value) {
                previewCf.textContent = cfInput.value;
            }
        }

        kondisiSelect.addEventListener('change', updatePreview);
        solusiSelect.addEventListener('change', updatePreview);
        cfInput.addEventListener('input', updatePreview);

        cfInput.addEventListener('change', function() {
            let v = parseFloat(this.value);
            if (isNaN(v) || v < 0) this.value = 0.8;
            if (v > 1) this.value = 1;
        });

        updatePreview();
    </script>

</body>

</html>