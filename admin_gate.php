<?php
session_start();
require_once __DIR__ . '/config/database.php';

echo "<h1>🛠️ Emergency Login Gate</h1>";

try {
    // 1. Ambil admin pertama yang ada
    $result = mysqli_query($conn, "SELECT id, username FROM admin LIMIT 1");
    $admin = mysqli_fetch_assoc($result);

    if ($admin) {
        // 2. Paksa Set Session
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['username'] = $admin['username'];
        $_SESSION['is_logged_in'] = true;

        echo "<p>✅ Login Berhasil sebagai: <b>" . $admin['username'] . "</b></p>";
        echo "<script>setTimeout(function(){ window.location.href = 'admin/dashboard.php'; }, 2000);</script>";
        echo "<p>Mengalihkan ke Dashboard dalam 2 detik...</p>";
        echo "<p><a href='admin/dashboard.php'>Klik di sini jika tidak otomatis pindah</a></p>";
    } else {
        echo "<p>❌ Gagal: Tidak ada user di tabel admin. Silakan jalankan reset_admin.php dulu.</p>";
    }

} catch (mysqli_sql_exception $e) {
    die("❌ Error System: " . $e->getMessage());
}
