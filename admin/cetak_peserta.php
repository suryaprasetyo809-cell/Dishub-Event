<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../vendor/autoload.php'; // autoload Dompdf

use Dompdf\Dompdf;
use Dompdf\Options;

// ── FILTERING ────────────────────────────────
$event_id = isset($_GET['event_id']) ? (int)$_GET['event_id'] : 0;
$where = $event_id ? "WHERE p.event_id = $event_id" : "";

// Ambil data event jika difilter
$event_name = "Semua Event";
if ($event_id) {
    $e_query = mysqli_query($conn, "SELECT nama_event FROM events WHERE id = $event_id");
    if ($ev = mysqli_fetch_assoc($e_query)) {
        $event_name = $ev['nama_event'];
    }
}

// Ambil data peserta
$sql = "SELECT p.*, e.nama_event 
        FROM peserta p
        LEFT JOIN events e ON p.event_id = e.id
        $where 
        ORDER BY p.id DESC";
$result = mysqli_query($conn, $sql);

// Path logo (lebih aman pakai path absolute di Dompdf)
$logoPath = __DIR__ . '/../assets/img/jateng.png';
$logoData = "";
if (file_exists($logoPath)) {
    $type = pathinfo($logoPath, PATHINFO_EXTENSION);
    $data = file_get_contents($logoPath);
    $logoBase64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
}

// Mulai output buffer untuk HTML
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 11pt; color: #333; margin: 0; padding: 0; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; margin-bottom: 20px; }
        .logo { width: 60px; height: auto; position: absolute; left: 0; top: 0; }
        .title { font-size: 16pt; font-weight: bold; margin-bottom: 5px; text-transform: uppercase; }
        .subtitle { font-size: 12pt; font-weight: normal; margin-bottom: 0px; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 20px; table-layout: fixed; }
        th { background-color: #f2f2f2; font-weight: bold; padding: 8px; border: 1px solid #ccc; font-size: 10pt; }
        td { padding: 8px; border: 1px solid #ccc; font-size: 10pt; vertical-align: middle; word-wrap: break-word; }
        
        .footer { position: fixed; bottom: -30px; left: 0; right: 0; height: 30px; text-align: right; font-size: 8pt; color: #999; }
        .text-center { text-align: center; }
        .no-wrap { white-space: nowrap; }
        
        .signature-box { text-align: center; min-height: 60px; }
        .signature-img { height: 50px; max-width: 100px; object-contain: fill; }
    </style>
</head>
<body>

    <div class="header">
        <?php if (!empty($logoBase64)): ?>
            <img src="<?= $logoBase64 ?>" class="logo">
        <?php endif; ?>
        <div class="title">PEMERINTAH PROVINSI JAWA TENGAH</div>
        <div class="title">DINAS PERHUBUNGAN</div>
        <div class="subtitle">Daftar Hadir Peserta - <?= htmlspecialchars($event_name) ?></div>
    </div>

    <table>
        <thead>
            <tr>
                <th width="30px">No</th>
                <th>Nama Peserta</th>
                <th width="120px">Jabatan</th>
                <th width="120px">Bidang</th>
                <th width="100px">No HP</th>
                <th width="90px">Tanggal</th>
                <th width="110px">Tanda Tangan</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            while($row = mysqli_fetch_assoc($result)) {
                $tanggal = !empty($row['tanggal_event']) ? date('d-m-Y', strtotime($row['tanggal_event'])) : '-';
                echo "<tr>";
                echo "<td class='text-center'>{$no}</td>";
                echo "<td><strong>" . htmlspecialchars($row['nama']) . "</strong></td>";
                echo "<td>" . htmlspecialchars($row['jabatan'] ?? '-') . "</td>";
                echo "<td>" . htmlspecialchars($row['bidang'] ?? '-') . "</td>";
                echo "<td>" . htmlspecialchars($row['no_hp'] ?? '-') . "</td>";
                echo "<td class='text-center'>{$tanggal}</td>";
                echo "<td class='text-center'>";
                
                // Cek apakah data tanda tangan valid (berisi base64 image data)
                if(!empty($row['tanda_tangan']) && strpos($row['tanda_tangan'], 'data:image') === 0){
                    echo '<img src="'.$row['tanda_tangan'].'" class="signature-img">';
                } else {
                    echo '<span style="color:#ccc; font-style:italic; font-size:8pt;">(Tidak Ada)</span>';
                }
                
                echo "</td>";
                echo "</tr>";
                $no++;
            }
            if ($no === 1) {
                echo "<tr><td colspan='7' style='text-align:center; padding: 20px; color: #999;'>Belum ada data peserta untuk event ini.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: <?= date('d/m/Y H:i:s') ?> | Dishub Event Portal
    </div>

</body>
</html>
<?php
$html = ob_get_clean();

// Inisialisasi Dompdf dengan options untuk performa dan keamanan
$options = new Options();
$options->set('isRemoteEnabled', true);
$options->set('defaultFont', 'Helvetica');
$options->set('isHtml5ParserEnabled', true);

$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();

// Nama file download
$filename = "Daftar_Peserta_" . str_replace(' ', '_', $event_name) . "_" . date('Ymd') . ".pdf";

// Output PDF
$dompdf->stream($filename, ["Attachment" => 1]);
exit; 
