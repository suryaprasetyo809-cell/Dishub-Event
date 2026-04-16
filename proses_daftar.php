<?php
require 'config/database.php';

if (!$conn) {
    die("Koneksi database gagal");
}

/* === AMBIL DATA DARI FORM (AMAN) === */
$nama          = trim($_POST['nama'] ?? '');
$jabatan       = trim($_POST['jabatan'] ?? '');
$bidang        = trim($_POST['bidang'] ?? '');
$no_hp         = trim($_POST['no_hp'] ?? '');
$id_acara      = intval($_POST['id_acara'] ?? 0);
$tanda_tangan  = $_POST['tanda_tangan'] ?? '';

/* === AMBIL TANGGAL EVENT DARI DATABASE === */
$tanggal_event = null;
if ($id_acara > 0) {
    $stmt_event = mysqli_prepare($conn, "SELECT tanggal_event FROM events WHERE id = ?");
    mysqli_stmt_bind_param($stmt_event, "i", $id_acara);
    mysqli_stmt_execute($stmt_event);
    $result_event = mysqli_stmt_get_result($stmt_event);
    if ($row = mysqli_fetch_assoc($result_event)) {
        $tanggal_event = $row['tanggal_event'];
    }
    mysqli_stmt_close($stmt_event);
}

/* === QUERY INSERT DENGAN PREPARE STATEMENT (AMAN) === */
$sql = "INSERT INTO peserta 
        (nama, jabatan, bidang, no_hp, tanggal_event, event_id, tanda_tangan) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);
if (!$stmt) {
    die("Gagal menyiapkan statement: " . mysqli_error($conn));
}

/* === Bind param: gunakan 's' untuk string, 'i' untuk integer === */
mysqli_stmt_bind_param(
    $stmt,
    "sssssis",
    $nama,
    $jabatan,
    $bidang,
    $no_hp,
    $tanggal_event, // can be null
    $id_acara,
    $tanda_tangan
);

if (!mysqli_stmt_execute($stmt)) {
    die("Gagal mengeksekusi query: " . mysqli_stmt_error($stmt));
}

/* === REDIRECT SETELAH BERHASIL === */
header("Location: index.php?status=sukses");
exit;
?>
