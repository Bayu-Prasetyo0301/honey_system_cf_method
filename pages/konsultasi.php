<?php
require_once 'includes/functions.php';
$all_conditions = getAllConditions();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_pengguna = $_POST['nama_pengguna'] ?? 'Anonim';
    $umur      = $_POST['umur'] ?? null;
    $email     = $_POST['email'] ?? null;
    $alamat    = $_POST['alamat'] ?? null;
    $pekerjaan = $_POST['pekerjaan'] ?? null;

    $selected_conditions_with_cf = [];
    foreach ($all_conditions as $condition) {
        $cf_key = 'cf_' . md5($condition);
        if (isset($_POST[$cf_key]) && $_POST[$cf_key] !== '' && $_POST[$cf_key] !== 'Pilih Kondisi') {
            $pilihan = $_POST[$cf_key];
            $cf_user = convertPilihanToCF($pilihan);
            if ($cf_user > 0) {
                $selected_conditions_with_cf[$condition] = $cf_user;
            }
        }
    }

    if (!empty($selected_conditions_with_cf)) {
        try {
            $database = new Database();
            $db = $database->getConnection();
            $db->beginTransaction(); // aman kalau rollback

            // INSERT konsultasi
            $stmt = $db->prepare("
                INSERT INTO konsultasi (nama_pengguna, umur, email, alamat, pekerjaan)
                VALUES (?, ?, ?, ?, ?)
            ");
            $stmt->execute([$nama_pengguna, $umur, $email, $alamat, $pekerjaan]);
            $konsultasi_id = $db->lastInsertId();

            // Hitung hasil CF
            $results = calculateCFWithRuleBase($selected_conditions_with_cf);

            // INSERT detail konsultasi
            $stmt = $db->prepare("
                INSERT INTO detail_konsultasi (konsultasi_id, kode_solusi, jenis_madu, nilai_cf)
                VALUES (?, ?, ?, ?)
            ");
            foreach ($results as $solusi_kode => $result) {
                $stmt->execute([$konsultasi_id, $solusi_kode, $result['jenis_madu'], $result['cf_combine']]);
            }

            $db->commit(); // commit semua

            // Set session user
            $_SESSION['user'] = [
                'nama'      => $nama_pengguna,
                'email'     => $email,
                'umur'      => $umur,
                'pekerjaan' => $pekerjaan,
                'alamat'    => $alamat
            ];
            $_SESSION['konsultasi_id'] = $konsultasi_id;
            $_SESSION['hasil'] = $results;
            $_SESSION['selected_conditions'] = $selected_conditions_with_cf;

            header('Location: ?page=hasil');
            exit;
        } catch (PDOException $e) {
            $db->rollBack();
            $error = "Terjadi kesalahan: " . $e->getMessage();
        }
    } else {
        $error = "Silakan pilih kondisi dan berikan tingkat keyakinan!";
    }
}

?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header bg-warning text-white">
                    <h3 class="card-title mb-0"><i class="fas fa-stethoscope me-2"></i>Diagnosa Kondisi Kesehatan</h3>
                    <p class="mb-0 mt-1 small">Pilih kondisi yang Anda alami dan tentukan tingkat keyakinannya</p>
                </div>
                <div class="card-body p-4">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-4">
                            <label for="nama_pengguna" class="form-label">Nama Anda</label>
                            <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna" placeholder="Masukkan nama Anda">
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Umur</label>
                                <input type="number" class="form-control" name="umur" placeholder="Contoh: 20">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="nama@email.com">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">Pekerjaan</label>
                                <input type="text" class="form-control" name="pekerjaan" placeholder="Contoh: Mahasiswa">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea class="form-control" name="alamat" rows="2" placeholder="Alamat lengkap"></textarea>
                            </div>
                        </div>


                        <div class="mb-4">
                            <h5 class="text-warning mb-3">Pilih Kondisi yang Anda Alami:</h5>

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-warning">
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="55%">Kondisi Kesehatan</th>
                                            <th width="40%">Tingkat Keyakinan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($all_conditions as $condition): ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td>
                                                    <label class="form-label mb-0">
                                                        <strong><?= $condition ?></strong>
                                                    </label>
                                                </td>
                                                <td>
                                                    <select class="form-select" name="cf_<?= md5($condition) ?>">
                                                        <option value="Pilih Kondisi">Pilih Kondisi</option>
                                                        <option value="Tidak">Tidak</option>
                                                        <option value="Kurang Yakin">Kurang Yakin</option>
                                                        <option value="Mungkin">Mungkin</option>
                                                        <option value="Yakin">Yakin</option>
                                                        <option value="Sangat Yakin">Sangat Yakin</option>
                                                        <option value="Pasti">Pasti</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-warning btn-lg px-5">
                                <i class="fas fa-calculator me-2"></i>Hitung Rekomendasi Madu
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>