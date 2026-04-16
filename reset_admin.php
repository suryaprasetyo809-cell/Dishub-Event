<?php
require_once __DIR__ . '/config/database.php';

echo "<h1>Resetting Admin Password...</h1>";

$new_username = 'admin';
$new_password = 'admin'; // Dipermudah menjadi 'admin'
$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

echo "<p>Debug Hash: <code>" . $hashed_password . "</code> (Length: " . strlen($hashed_password) . ")</p>";

try {
    // 1. Cek apakah user admin ada
    $check = mysqli_query($conn, "SELECT id FROM admin WHERE username = 'admin' LIMIT 1");
    
    if (mysqli_num_rows($check) > 0) {
        // Update password jika sudah ada
        $stmt = mysqli_prepare($conn, "UPDATE admin SET password = ? WHERE username = ?");
        mysqli_stmt_bind_param($stmt, "ss", $hashed_password, $new_username);
        mysqli_stmt_execute($stmt);
        echo "<p>✅ Password admin BERHASIL direset menjadi: <b>admin123</b></p>";
    } else {
        // Buat baru jika belum ada
        $stmt = mysqli_prepare($conn, "INSERT INTO admin (username, password) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, "ss", $new_username, $hashed_password);
        mysqli_stmt_execute($stmt);
        echo "<p>✅ User admin baru BERHASIL dibuat dengan password: <b>admin123</b></p>";
    }

    echo "<p><a href='admin/login.php'>Klik di sini untuk Login</a></p>";

} catch (mysqli_sql_exception $e) {
    die("❌ GAGAL reset: " . $e->getMessage());
}
