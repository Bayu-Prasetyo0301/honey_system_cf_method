<?php
date_default_timezone_set('Asia/Jakarta');
require_once 'includes/functions.php';

if (!isset($_SESSION['hasil']) || !isset($_SESSION['user'])) {
    header('Location: ?page=konsultasi');
    exit;
}

$results = $_SESSION['hasil'];
$user = $_SESSION['user'];
$selectedConditions = $_SESSION['selected_conditions'] ?? [];

$nama      = htmlspecialchars($user['nama']);
$email     = htmlspecialchars($user['email']);
$umur      = htmlspecialchars($user['umur']);
$pekerjaan = htmlspecialchars($user['pekerjaan']);
$alamat    = htmlspecialchars($user['alamat']);

$total_rekomendasi = count($results);
?>

<div class="container py-5">

    <!-- ===================== 2 CARD SEJAJAR ===================== -->
    <div class="row mb-4">

        <!-- ===== CARD KIRI : DATA USER ===== -->
        <div class="col-md-6">
            <div class="card h-100 shadow">
                <div class="card-header bg-warning text-white">
                    <strong>Data Konsultasi</strong>
                </div>
                <div class="card-body">
                    <h5 class="fw-bold mb-1"><?= $nama ?></h5>
                    <p class="text-muted mb-3">
                        <?= date('d M Y, H:i') ?>
                    </p>
                    <p class="mb-1"><strong>Email:</strong> <?= $email ?></p>
                    <p class="mb-1"><strong>Umur:</strong> <?= $umur ?> tahun</p>
                    <p class="mb-1"><strong>Pekerjaan:</strong> <?= $pekerjaan ?></p>
                    <p class="mb-1"><strong>Alamat:</strong> <?= $alamat ?></p>

                    <span class="badge bg-primary mt-3 fs-6">
                        <?= $total_rekomendasi ?> rekomendasi
                    </span>
                </div>
            </div>
        </div>

        <!-- ===== CARD KANAN : GEJALA USER ===== -->
        <div class="col-md-6">
            <div class="card h-100 shadow">
                <div class="card-header bg-secondary text-white">
                    <strong>Gejala yang Dipilih</strong>
                </div>
                <div class="card-body p-0">
                    <?php if (!empty($selectedConditions)): ?>
                        <table class="table table-bordered mb-0 text-center align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th width="10%">No</th>
                                    <th width="70%">Gejala</th>
                                    <th width="20%">CF</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($selectedConditions as $gejala => $cf): ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td class="text-start"><?= htmlspecialchars($gejala); ?></td>
                                        <td><?= $cf; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="p-3 text-center text-muted">
                            Tidak ada gejala yang dipilih
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>



    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h3 class="card-title mb-0"><i class="fas fa-calculator me-2"></i>HASIL REKOMENDASI BERDASARKAN RULE BASE</h3>
                    </div>

                    <!-- Hasil Rekomendasi dengan SARAN dan KETERANGAN -->
                    <div class="mb-4">

                        <?php if (empty($results)): ?>
                            <div class="alert alert-warning text-center">
                                <h5>Tidak ada rekomendasi yang ditemukan</h5>
                                <p class="mb-0">Silakan pilih kondisi yang sesuai dengan kesehatan Anda.</p>
                            </div>
                        <?php else: ?>
                            <?php
                            $counter = 0;
                            foreach ($results as $solusi_kode => $result):
                                $counter++;
                                $percentage = round($result['cf_combine'] * 100, 2);
                            ?>
                                <div class="card mb-4 honey-card">
                                    <div class="card-header bg-light">
                                        <h4 class="text-warning mb-0">
                                            #<?= $counter ?> <?= $result['jenis_madu'] ?>
                                            <span class="badge bg-<?= $counter == 1 ? 'success' : 'warning' ?> float-end fs-6">
                                                Tingkat Keyakinan: <?= $percentage ?>%
                                            </span>
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="mb-3">
                                                    <h6 class="text-success"><i class="fas fa-info-circle me-2"></i>Deskripsi:</h6>
                                                    <p><?= $result['deskripsi'] ?? '-' ?></p>
                                                </div>

                                                <div class="mb-3">
                                                    <h6 class="text-success"><i class="fas fa-heart me-2"></i>Manfaat:</h6>
                                                    <p><?= $result['manfaat'] ?? '-' ?></p>
                                                </div>

                                                <div class="mb-3">
                                                    <h6 class="text-success"><i class="fas fa-utensils me-2"></i>Cara Konsumsi:</h6>
                                                    <p><?= $result['cara_konsumsi'] ?? '-' ?></p>
                                                </div>

                                                <!-- SARAN KHUSUS -->
                                                <div class="mb-3">
                                                    <h6 class="text-primary"><i class="fas fa-lightbulb me-2"></i>Saran Penggunaan:</h6>
                                                    <div class="alert alert-info">
                                                        <i class="fas fa-tips me-2"></i>
                                                        <?= $result['saran'] ?? 'Tidak ada saran khusus' ?>
                                                    </div>
                                                </div>

                                                <!-- KETERANGAN TAMBAHAN -->
                                                <div class="mb-3">
                                                    <h6 class="text-primary"><i class="fas fa-sticky-note me-2"></i>Keterangan:</h6>
                                                    <div class="alert alert-warning">
                                                        <i class="fas fa-info-circle me-2"></i>
                                                        <?= $result['keterangan'] ?? 'Tidak ada keterangan tambahan' ?>
                                                    </div>
                                                </div>

                                                <!-- Informasi Harga -->
                                                <div class="mt-4">
                                                    <h6 class="text-success"><i class="fas fa-tag me-2"></i>Daftar Harga:</h6>
                                                    <div class="row">
                                                        <div class="col-md-3 mb-2">
                                                            <div class="card bg-light">
                                                                <div class="card-body text-center p-2">
                                                                    <small class="text-muted d-block">250 ML</small>
                                                                    <strong class="text-success">Rp. <?= number_format(getHargaMadu($result['jenis_madu'], '250 ML'), 0, ',', '.') ?></strong>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mb-2">
                                                            <div class="card bg-light">
                                                                <div class="card-body text-center p-2">
                                                                    <small class="text-muted d-block">325 ML</small>
                                                                    <strong class="text-success">Rp. <?= number_format(getHargaMadu($result['jenis_madu'], '325 ML'), 0, ',', '.') ?></strong>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mb-2">
                                                            <div class="card bg-light">
                                                                <div class="card-body text-center p-2">
                                                                    <small class="text-muted d-block">650 ML</small>
                                                                    <strong class="text-success">Rp. <?= number_format(getHargaMadu($result['jenis_madu'], '650 ML'), 0, ',', '.') ?></strong>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mb-2">
                                                            <div class="card bg-light">
                                                                <div class="card-body text-center p-2">
                                                                    <small class="text-muted d-block">1 Liter</small>
                                                                    <strong class="text-success">Rp. <?= number_format(getHargaMadu($result['jenis_madu'], '1 Liter'), 0, ',', '.') ?></strong>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 text-center">
                                                <div class="progress-circle" data-percentage="<?= $percentage ?>">
                                                    <span class="progress-value fw-bold fs-4"><?= $percentage ?>%</span>
                                                </div>
                                                <p class="text-muted mt-2">Tingkat Keyakinan Sistem</p>

                                                <?php if ($counter == 1): ?>
                                                    <div class="alert alert-success mt-3">
                                                        <i class="fas fa-trophy me-2"></i>
                                                        <strong>Rekomendasi Terbaik</strong>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div class="text-center mt-4">
                        <a href="?page=konsultasi" class="btn btn-warning me-3">
                            <i class="fas fa-redo me-2"></i>Konsultasi Ulang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .progress-circle {
        position: relative;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: conic-gradient(#28a745 var(--percentage), #e9ecef 0deg);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
    }

    .progress-circle::before {
        content: '';
        position: absolute;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: white;
    }

    .progress-value {
        position: relative;
        z-index: 1;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const circles = document.querySelectorAll('.progress-circle');
        circles.forEach(circle => {
            const percentage = circle.getAttribute('data-percentage');
            circle.style.setProperty('--percentage', percentage + '%');
        });
    });
</script>