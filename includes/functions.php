<?php
require_once __DIR__ . '/../config/database.php';

function getRuleBaseSystem()
{
    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT r.*, s.jenis_madu FROM rules r 
              JOIN solusi s ON r.kode_solusi = s.kode_solusi 
              ORDER BY r.kode_rule";
    $stmt = $db->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAllConditions()
{
    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT nama_gejala FROM gejala ORDER BY kode_gejala ASC";
    $stmt = $db->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}


function calculateCFWithRuleBase($selected_conditions_with_cf)
{
    $database = new Database();
    $db = $database->getConnection();

    if (empty($selected_conditions_with_cf)) {
        return [];
    }

    $rules = getRuleBaseSystem();
    $cf_results = [];

    foreach ($rules as $rule) {

        // ===== 1. PECAH KONDISI AND =====
        $conditions = explode(' AND ', $rule['kondisi']);

        // ===== 2. CEK GEJALA YANG COCOK =====
        $matched_conditions = [];

        foreach ($conditions as $cond) {
            $cond = trim($cond);
            if (isset($selected_conditions_with_cf[$cond])) {
                $matched_conditions[] = $cond;
            }
        }

        if (count($matched_conditions) === 0) {
            continue;
        }


        $solusi_kode = $rule['kode_solusi'];
        $cf_pakar = $rule['cf_pakar'];

        if (!isset($cf_results[$solusi_kode])) {
            $cf_results[$solusi_kode] = [
                'jenis_madu' => $rule['jenis_madu'],
                'rules' => [],
                'cf_combine' => 0
            ];
        }

        // ===== 3. HITUNG CF TIAP GEJALA =====
        foreach ($matched_conditions as $cond) {
            $cond = trim($cond);
            $cf_user = $selected_conditions_with_cf[$cond];
            $cf_value = $cf_pakar * $cf_user;

            $cf_results[$solusi_kode]['rules'][] = [
                'rule_code' => $rule['kode_rule'],
                'condition' => $cond,
                'cf_pakar' => $cf_pakar,
                'cf_user' => $cf_user,
                'cf_value' => $cf_value
            ];

            // ===== 4. CF COMBINE (SHORTLIFFE) =====
            $cf_old = $cf_results[$solusi_kode]['cf_combine'];
            $cf_results[$solusi_kode]['cf_combine'] =
                $cf_old + ($cf_value * (1 - $cf_old));
        }
    }

    // ===== 5. DETAIL SOLUSI =====
    foreach ($cf_results as $solusi_kode => &$result) {
        $stmt = $db->prepare("SELECT * FROM solusi WHERE kode_solusi = ?");
        $stmt->execute([$solusi_kode]);
        $solusi_detail = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($solusi_detail) {
            $result['deskripsi'] = $solusi_detail['deskripsi'];
            $result['manfaat'] = $solusi_detail['manfaat'];
            $result['cara_konsumsi'] = $solusi_detail['cara_konsumsi'];
            $result['saran'] = $solusi_detail['saran'];
            $result['keterangan'] = $solusi_detail['keterangan'];
            $result['harga_250 ML'] = $solusi_detail['harga_250 ML'];
        }
    }

    // ===== 6. SORT CF TERTINGGI =====
    uasort($cf_results, function ($a, $b) {
        return $b['cf_combine'] <=> $a['cf_combine'];
    });

    return $cf_results;
}


function convertPilihanToCF($pilihan)
{
    $cf_values = [
        'Tidak' => 0.0,
        'Kurang Yakin' => 0.2,
        'Mungkin' => 0.4,
        'Yakin' => 0.6,
        'Sangat Yakin' => 0.8,
        'Pasti' => 1.0
    ];

    return $cf_values[$pilihan] ?? 0.0;
}

function getHargaMadu($jenis_madu, $ukuran = '250 ML')
{
    $harga_madu = [
        'Madu Kelengkeng' => ['250 ML' => 41000, '325 ML' => 51000, '650 ML' => 87000, '1 Liter' => 87000],
        'Madu Randu' => ['250 ML' => 39000, '325 ML' => 48000, '650 ML' => 82000, '1 Liter' => 82000],
        'Madu Kopi' => ['250 ML' => 39000, '325 ML' => 48000, '650 ML' => 82000, '1 Liter' => 82000],
        'Madu Hutan' => ['250 ML' => 44000, '325 ML' => 54000, '650 ML' => 100000, '1 Liter' => 100000],
        'Madu Multiflora' => ['250 ML' => 43000, '325 ML' => 53000, '650 ML' => 93000, '1 Liter' => 93000],
        'Madu Propolis' => ['250 ML' => 68000, '325 ML' => 80000, '500 ML' => 130000, '650 ML' => 155000, '1 Liter' => 235000]
    ];

    return isset($harga_madu[$jenis_madu][$ukuran]) ? $harga_madu[$jenis_madu][$ukuran] : 0;
}

function simpanHasilKonsultasi($id_konsultasi, $results)
{
    $database = new Database();
    $db = $database->getConnection();

    if (empty($results)) return;

    // Ambil hasil terbaik (ranking 1)
    $best = array_key_first($results);
    $maduTerbaik = $results[$best]['jenis_madu'];
    $keyakinan = round($results[$best]['cf_combine'] * 100, 2);

    // Ringkasan semua hasil
    $ringkasan = [];
    foreach ($results as $r) {
        $ringkasan[] = $r['jenis_madu'] . ' (' . round($r['cf_combine'] * 100, 2) . '%)';
    }

    $stmt = $db->prepare("
        UPDATE konsultasi SET
            madu_terbaik = ?,
            tingkat_keyakinan = ?,
            hasil_rekomendasi = ?
        WHERE id = ?
    ");

    $stmt->execute([
        $maduTerbaik,
        $keyakinan,
        implode(', ', $ringkasan),
        $id_konsultasi
    ]);
}
